<?php

include "/var/www/html/protected/global.php";
//chmod(basename($_SERVER['PHP_SELF']),777);
//dailyu crons only



function exists_util_stops($util_sched){
    global $db;
    $exists = $db->where("utility_sched_id",$util_sched)->get("iwp_utility2","$util_sched");
    if(count($exists)>0){// already exists in archive
        $db->where("utility_sched_id",$util_sched)->delete("iwp_utility");
    }else {
        if($db->query("INSERT INTO iwp_utility2  SELECT d.* FROM iwp_utility d WHERE d.utility_sched_id = $util_sched ")){//archive entry
            $db->where("utility_sched_id",$util_sched)->delete("iwp_utility");// delete from original source if successful
        }
    }
    unset($db);
}

function exists_util_routes($route_id){
    global $db;
    $exists = $db->where("route_id",$route_id)->get("iwp_ikg_utility2","$route_id");
    if(count($exists)>0){// already exists in archive ?
        $db->where("route_id",$route_id)->delete("iwp_ikg_utility");
    }else {
        if($db->query("INSERT INTO iwp_ikg_utility2  SELECT d.* FROM iwp_ikg_utility d WHERE d.route_id = $route_id ")){//archive entry
            $db->where("route_id",$route_id)->delete("iwp_ikg_utility");// delete from original source if successful
        }
    }
    unset($db);
}

function exists_util_data($route_id,$schedule_id,$account_no){
    global $db;
    $exists = $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->get("iwp_utility_data_table2","route_id,schedule_id,account_no");
    if(count($exists)>0){
        $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->delete("iwp_utility_data_table");
    }else {
        if($db->query("INSERT INTO iwp_utility_data_table2 SELECT d.* FROM iwp_utility_data_table d WHERE d.route_id = $route_id AND d.schedule_id = $schedule_id AND d.account_no = $account_no  ")){
            $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->delete("iwp_utility_data_table");
        }
    }
}




function exists($route_id,$schedule_id,$account_no){
    global $db;
    $exist = $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where('account_no',$account_no)->get("iwp_data_table2","route_id");
    if(count($exist)>0){
       $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->delete("iwp_data_table");
    }else{
        if($db->query("INSERT INTO iwp_data_table2 SELECT d.* FROM iwp_data_table d WHERE d.schedule_id = $schedule_id")){//copy to archive
            $db->WHERE('schedule_id',"$schedule_id")->delete('iwp_data_table');//delete original
        }
    }
    unset($db);    
}

function exists_stops($route_id,$schedule_id,$account_no){
    global $db;
    $exist = $db->query("SELECT schedule_id FROM iwp_scheduled_routes2 WHERE schedule_id = $schedule_id");
    if(count($exist)>0){// does this entry already exist in the archive?
         $db->where('schedule_id',"$schedule_id")->delete('iwp_scheduled_routes');//delete original
         echo " already archived<br/>";
    }else{
        if($db->query("INSERT INTO iwp_scheduled_routes2 SELECT d.* FROM iwp_scheduled_routes d WHERE d.schedule_id = $schedule_id")){//copy to archive
            $db->WHERE('schedule_id',"$schedule_id")->delete('iwp_scheduled_routes');//delete original
        }
        echo " - inserted deleted<br/>";
    }
    unset($db);
}

function exists_routes($route_id){
    global $db;
    $exist = $db->where("route_id",$route_id)->get("iwp_ikg_manifest_info2","route_id");//does it exist? 
    if(count($exist)>0){
        $db->where("route_id",$route_id)->delete("iwp_ikg_manifest_info");// if it already exists in archive, remove it
        echo " exists<br/>"; 
    }else{
        if($db->query("INSERT INTO iwp_ikg_manifest_info2 SELECT d.* FROM iwp_ikg_manifest_info d WHERE d.route_id = $route_id")){ // copy it into archive then delete it from regular
            $db->where("route_id",$route_id)->delete("iwp_ikg_manifest_info");
        }
        echo "insert<br/>";
        
        
        if($db->query("INSERT INTO iwp_list_of_routes2 SELECT d.* FROM iwp_list_of_routes d WHERE d.route_id = $route_id")){ // copy it into archive then delete it from regular
            $db->where("route_id",$route_id)->delete("iwp_list_of_routes");
        }
        echo "insert<br/>";
        
    }
}



function date_dif_last_two($account_no){//two or 3 pickups
    global $db;
    global $dbprefix;
    $infox = 0;
    $data_table = $dbprefix."_data_table";
    $info = $db->query("SELECT date_of_pickup FROM $data_table WHERE account_no = $account_no ORDER BY date_of_pickup DESC LIMIT 0,3");
    if(count($info)>0){
        //latest|first
        $first = $info[0]['date_of_pickup'];
        $last = $info[ count($info)-1  ]['date_of_pickup'];
        $infox = date_different($last,$first);
    }
    return $infox;
}

function date_dif_last_four($account_no){//four or more
    global $db;
    global $dbprefix;
    $infox = 0;
    $data_table = $dbprefix."_data_table";
    $info = $db->query("SELECT date_of_pickup FROM $data_table WHERE account_no = $account_no ORDER BY date_of_pickup DESC LIMIT 0,4");
    if(count($info)>0){
        //latest|first
        $first = $info[0]['date_of_pickup'];
        $last = $info[3]['date_of_pickup'];
        $infox = date_different($last,$first);
    }
    return $infox;
}


//********************** predictor 

$count =1;
$accounts_pickedup = $db->query("SELECT account_ID,estimated_volume,pickup_frequency,created FROM iwp_accounts WHERE status in ('Active','new')");

$atr = new Account();

//var_dump($accounts_pickedup);

if(count($accounts_pickedup)>0){
    foreach($accounts_pickedup as $nos){
       $total = 0;
       echo  "<br/><br/>$count ".account_NumToName($nos['account_ID'])."<br/>";
       $how_many_picks = $db->query("SELECT DISTINCT (schedule_id) date_of_pickup,sum  FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY schedule_id ORDER BY date_of_pickup DESC ");
       //echo "fault after..<br/>";
       /**/
       
       if(count($how_many_picks)>=5) {//pickups 5+
           if( $nos['pickup_frequency']  <30){// if frequency is less than 30 days , average out the last 5+n amount of pickups b
                $pickups = count($how_many_picks);
                
                if($pickups>15){
                    $pickups = 15;
                }    
                echo "Has 5 or more pickups and pickup frequency is less than 30 days<br/>";
                $check = $db->query("SELECT DISTINCT (schedule_id), date_of_pickup,sum,inches_to_gallons  FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY schedule_id ORDER BY date_of_pickup DESC  LIMIT 0,$pickups");
                $for_this  = 0;
                foreach($check as $pus){
                    echo $pus['date_of_pickup']." $pus[sum]"."<br/>";
                    $for_this = $for_this + $pus['sum'];
                }
                echo "total of last $pickups pickups: ".$for_this."<br/>";
                
                
                
                $ticks = $for_this/date_dif($check[$pickups-1]['date_of_pickup'],$check[0]['date_of_pickup']);
                echo "ticks per day: ".$ticks."<br/>";
                $next_sched = $db->query("SELECT schedule_id, scheduled_start_date FROM iwp_scheduled_routes WHERE account_no =$nos[account_ID] AND route_status IN ('scheduled', 'enroute') ORDER BY scheduled_start_date DESC ");
                echo "next scheduled pickup ". $next_sched[0]['scheduled_start_date']."<br/>";
                echo "difference between todys date and last pickup: ". date_dif($check[0]['date_of_pickup'],date("Y-m-d"))."<br/>";
                 
                $new_oil_on_site = $ticks * date_dif($check[0]['date_of_pickup'],date("Y-m-d") ) ;
                echo round($new_oil_on_site,2) ." oil onsite after tick<br/>";
                echo "difference of next scheduled start and the last pickup". date_dif($check[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date'])."<br/>";
                
                $avg = round($ticks * date_dif($check[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date']),2);
                echo "expected : ".$avg;
                echo "<br/><br/>"; 
            }else {
                echo "Has 5 or more pickups and pickup frequency is 30 or greater<br/>";
                $check = $db->query("SELECT DISTINCT (schedule_id), date_of_pickup,sum,inches_to_gallons  FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY schedule_id ORDER BY date_of_pickup DESC  LIMIT 0,4");
                $for_this  = 0;
                foreach($check as $pus){
                    echo $pus['date_of_pickup']." $pus[sum]"."<br/>";
                    $for_this = $for_this + $pus['sum'];
                }
                
               
                echo "total of last 4 pickups: ".$for_this."<br/>";
                $ticks = round($for_this,2) / date_dif($check[3]['date_of_pickup'],$check[0]['date_of_pickup'])."<br/>";
                echo "ticks per day: ".$ticks."<br/>";
                $next_sched = $db->query("SELECT schedule_id, scheduled_start_date FROM iwp_scheduled_routes WHERE account_no =$nos[account_ID] AND route_status IN ('scheduled', 'enroute') ORDER BY scheduled_start_date DESC ");
                echo "next scheduled pickup ". $next_sched[0]['scheduled_start_date']."<br/>";
                echo "difference between todys date and last pickup: ". date_dif($check[0]['date_of_pickup'],date("Y-m-d"))."<br/>";
                 
                $new_oil_on_site = $ticks * date_dif($check[0]['date_of_pickup'],date("Y-m-d") ) ;
                echo round($new_oil_on_site,2) ." oil onsite after tick<br/>";
                echo "difference of next scheduled start and the last pickup". date_dif($check[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date'])."<br/>";
                
                $avg = round($ticks * date_dif($check[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date']),2);
                echo "expected : ".$avg;
                echo "<br/><br/>"; 
                
            }
            
            
            
        
       } else if(count($how_many_picks)>3 && count($how_many_picks)<5) {     
            echo "Has 4 or more pickups<br/>";
            $check = $db->query("SELECT DISTINCT (schedule_id), date_of_pickup,sum,inches_to_gallons  FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY schedule_id ORDER BY date_of_pickup DESC  LIMIT 0,4");
            $for_this  = 0;
            foreach($check as $pus){
                echo $pus['date_of_pickup']." $pus[sum]"."<br/>";
                $for_this = $for_this + $pus['sum'];
            }
            
           
            echo "total of last 4 pickups: ".$for_this."<br/>";
            $ticks = round($for_this,2) / date_dif($check[3]['date_of_pickup'],$check[0]['date_of_pickup'])."<br/>";
            echo "ticks per day: ".$ticks."<br/>";
            
            $next_sched = $db->query("SELECT schedule_id, scheduled_start_date FROM iwp_scheduled_routes WHERE account_no =$nos[account_ID] AND route_status IN ('scheduled', 'enroute') ORDER BY scheduled_start_date DESC ");
            
            echo "next scheduled pickup ". $next_sched[0]['scheduled_start_date']."<br/>";
            echo "difference between todys date and last pickup: ". date_dif($check[0]['date_of_pickup'],date("Y-m-d"))."<br/>";
             
            $new_oil_on_site = $ticks * date_dif($check[0]['date_of_pickup'],date("Y-m-d") ) ;
            echo round($new_oil_on_site,2) ." oil onsite after tick<br/>";
            echo "difference of next scheduled start and the last pickup". date_dif($check[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date'])."<br/>";
            
            $avg = round($ticks * date_dif($check[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date']),2);
            echo "expected : ".$avg;
            echo "<br/><br/>"; 
            
       }
       else if( count($how_many_picks)<=3 && count($how_many_picks)>0 ){
        
            $latest = $db->query("SELECT DISTINCT(date_of_pickup) FROM iwp_data_table WHERE account_no =$nos[account_ID] ORDER BY date_of_pickup DESC LIMIT 0,1");
            
            echo "Has less  than 4 pickups but more than 0<br/>";
            echo " last: ".$latest[0]['date_of_pickup']."<br/>";
            echo "estimated: ".$nos['estimated_volume']."<br/>";            
            $diff = date_dif($latest[0]['date_of_pickup'],date("Y-m-d"));
            echo "difference :".$diff."<br/>";
            $avg = $nos['estimated_volume'];
            $averg = $nos['estimated_volume'] / 30;
            echo "ticker: ".$averg;
            $new_oil_on_site = $averg * $diff;
            $ticks = $averg;
       } else {
            echo " created date: ".$nos['created']."<br/>";
            echo "Has less  0 pickups<br/>";
            echo "estimated: ".$nos['estimated_volume']."<br/>";
            echo "Date Difference: $diff<br/>";
            $diff = date_dif($nos['created'],date("Y-m-d"));
            echo "difference :".$diff;
            $avg = $nos['estimated_volume'];
            $averg = $nos['estimated_volume'] / 30;
            echo "ticker: ".$averg;
            $new_oil_on_site = $averg * $diff;
            $ticks = $averg;
       }
       
       
       $package = array(
            "avg_gallons_per_Month"=>round($new_oil_on_site,2),//how much oil is onsite ?
            "estimated_volume"=>$avg, // expected (average of last 4 unique pickups)
            "ticks_per_day"=>$ticks
       );
       
       echo "<pre>";
       print_r($package);
       echo "</pre>";
       echo "********************************************************************************<br/><br/><br/>";
       
       
       $nb = $db->query("SELECT route_status FROM iwp_scheduled_routes WHERE account_no = $nos[account_ID] ORDER BY scheduled_start_date DESC");
       
       
       if(count($nb)>0){
           if($nb[0]['route_status'] !="enroute"){
                echo "status: ".$db->where("account_ID",$nos['account_ID'])->update($dbprefix."_accounts",$package);
           }
       }
       $count++;   
    } 
}






$count =1;
$accounts_pickedupx = $db->query("SELECT account_ID,estimated_volume,pickup_frequency,created FROM iwp_accounts WHERE status in ('active','new')");
$atr = new Account();
 $total = 0;
       if(count($accounts_pickedupx)>0){
    foreach($accounts_pickedupx as $nos){
       $total = 0;
       
       $how_many_picks = $db->query("SELECT DISTINCT (schedule_id) date_of_pickup,sum  FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY schedule_id ORDER BY date_of_pickup DESC ");
       //echo "fault after..<br/>";
       /**/
       if(count($how_many_picks)>3) {     
           
            $check = $db->query("SELECT DISTINCT (schedule_id), date_of_pickup,sum  FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY schedule_id ORDER BY date_of_pickup DESC  LIMIT 0,4");
            $for_this  = 0;
            
            
           
          
            $next_sched = $db->query("SELECT schedule_id, scheduled_start_date,route_status FROM iwp_scheduled_routes WHERE account_no =$nos[account_ID] ORDER BY scheduled_start_date DESC LIMIT 0,1");
                if(count($next_sched)>0){
                        if($next_sched[0]['route_status'] == "completed" || $next_sched[0]['route_status'] == "complete"){
                            echo  "<br/><br/>$count ".account_NumToName($nos['account_ID'])."  account is picked up up, but route is not completed.<br/>";
                            foreach($check as $pus){
                                echo $pus['date_of_pickup']." $pus[sum]"."<br/>";
                                $for_this = $for_this + $pus['sum'];
                            }
                        
                          echo "Has 4 or more pickups<br/>";
                          echo "total of last 4 pickups: ".$for_this."<br/>";
                          $ticks = round($for_this,2) / date_dif($check[3]['date_of_pickup'],$check[0]['date_of_pickup'])."<br/>";
                          echo "ticks per day: ".$ticks."<br/>";
                        
                          echo "difference between todys date and last pickup: ". date_dif($check[0]['date_of_pickup'],date("Y-m-d"))."<br/>";                 
                          $new_oil_on_site = $ticks * date_dif($check[0]['date_of_pickup'],date("Y-m-d") ) ;
                          echo round($new_oil_on_site,2) ." oil onsite after tick<br/>";
                          echo "difference of between the last two pickups". date_dif($check[0]['date_of_pickup'],$check[1]['date_of_pickup'])."<br/>";
                    
                          $avg = round($ticks * date_dif($check[0]['date_of_pickup'],$check[1]['date_of_pickup']),2);
                          echo "expected : ".$avg;
                          
                          $package = array(
                                "avg_gallons_per_Month"=>round($new_oil_on_site,2),//how much oil is onsite ?
                                "estimated_volume"=>$avg, // expected (average of last 4 unique pickups)
                                "ticks_per_day"=>$ticks
                           );
                           
                           echo "<pre>";
                           print_r($package);
                           echo "</pre>";
                           echo "********************************************************************************<br/><br/><br/>";
                           $nb = $db->query("SELECT route_status FROM iwp_scheduled_routes WHERE account_no = $nos[account_ID] ORDER BY scheduled_start_date DESC");
       
       
                           if(count($nb)>0){
                               if($nb[0]['route_status'] !="enroute"){
                                    echo "status: ".$db->where("account_ID",$nos['account_ID'])->update($dbprefix."_accounts",$package);
                               }
                           }
                        }
                }
            }
        }
    }


$get = $db->query("SELECT account_ID FROM iwp_accounts WHERE status IN ('Active')");
if(count($get)>0){
    foreach ($get as $acnts){
        $account = new Account($acnts['account_ID']);
        $db->query("UPDATE iwp_accounts SET barrel_capacity = ".$account->total_barrel_capacity." WHERE account_ID=$acnts[account_ID]");
    }
}



//********************** predictor




//******************************* FIND DUPE  ***********************************//
$last = date("Y")-1;
$this_year = date("Y");
$dup_scheds = $db->query("SELECT DISTINCT account_no, count( * ) AS scheduled_stops FROM iwp_scheduled_routes WHERE route_status = 'scheduled' GROUP BY account_no HAVING count( * ) >1");
if(count($dup_scheds)>0){
    foreach($dup_scheds as $scheds){
        echo $scheds['account_no']. " ".$scheds['scheduled_stops']."<br/>";
        $second  = $db->query("SELECT schedule_id,route_status,scheduled_start_date FROM iwp_scheduled_routes WHERE account_no =".$scheds['account_no']." AND route_status ='scheduled' ORDER BY scheduled_start_date DESC");
        if(count($second)>0){
            foreach($second as $dupes ){
                echo $dupes['schedule_id']." ".$dupes['route_status']. " $dupes[scheduled_start_date] <br/>";
            }
            echo "---------------these to be deleted------------------<br/>";
            for($i = 1 ;$i<count($second);$i++){
                echo $second[$i]['schedule_id']." ".$second[$i]['route_status']." ".$second[$i]['scheduled_start_date']."<br/>";       
                $db->query("DELETE FROM iwp_scheduled_routes WHERE schedule_id =".$second[$i]['schedule_id']);
            }
        }
        echo "<br/><br/>";
    }
}
//******************************* FIND DUPE  ***********************************//



//******************************* Archiver OIL*************************//


//********************************** oil_data *************************//
$yc = $db->query("SELECT route_id,schedule_id,account_no,date_of_pickup FROM iwp_data_table WHERE `date_of_pickup` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR) OR date_of_pickup IS NULL OR date_of_pickup ='0000-00-00' ");
if(count($yc)>0){
    foreach($yc as $data){
        echo "route_id: $data[route_id] account_no: $data[account_no] schedule_id: $data[schedule_id] date of pickup: $data[date_of_pickup]";
        exists($data['route_id'],$data['schedule_id'],$data['account_no']);
    }
}else {
    echo "No entries older than a year<br/>";
}
//********************************** oil_data *************************//


//********************************** oil_stops *************************//
$ju =  $db->query("select schedule_id,account_no,route_id,scheduled_start_date FROM `iwp_scheduled_routes` 
  where `scheduled_start_date` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR OR scheduled_start_date ='0000-00-00')");// select entrie more than a year old
  
  if(count($ju)>0){
    foreach($ju as $kc ){
        echo "schedule_id:".$kc['schedule_id']." ".$kc['account_no']." ".$kc['route_id']." $kc[scheduled_start_date]";
        exists_stops($kc['route_id'],$kc['schedule_id'],$kc['account_no']);
    }
  }else {
    echo "No entries older than a year<br/>";
  }


//********************************** oil_stops *************************//


//********************************** oil_routes *************************//

$ic = $db->query("SELECT route_id,completed_date FROM iwp_ikg_manifest_info  WHERE `completed_date` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR ) OR `completed_date` IS NULL OR completed_date='0000-00-00'");
if(count($ic)>0){
    foreach($ic as $routes){
        echo "$routes[route_id] $routesp[completed_date] ";
        exists_routes($routes['route_id']);
        
    }    
}else {
    echo "No entries older than a year<br/>";
}

//********************************** oil_routes *************************//




//******************************* Archiver OIL*************************//


//util data//
$yb = $db->query("SELECT route_id,schedule_id,account_no FROM iwp_utility_data_table WHERE `date_of_pickup` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");
if(count($yb)>0){
    foreach($yb as $util_data){
        exists_util_data($util_data['route_id'],$util_data['schedule_id'],$util_data['account_no']);
    }
}

$util = $db->query("SELECT route_id FROM iwp_ikg_utility WHERE `completed_date` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");
if(count($util)>0){
    foreach($util as $routes){
        exists_util_routes($routes['route_id']);
    }
}else {
    echo "No entries older than 1 year<br/>";
}

$yc = $db->query("SELECT utility_sched_id FROM iwp_utility WHERE `date_of_service` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");

if(count($yc)>0){
    foreach($yc as $utils_stops){
        exists_util_stops($utils_stops['utility_sched_id']);
    }
}else{
    echo "No entries older than a year<br/>";
}
//util data//




//****Estimated expected *****//

$all = $db->query("SELECT account_ID,estimated_monthly FROM iwp_accounts WHERE status IN ('Active')");
foreach($all as $value){
    
   $expected = 0;
    $askthree = $db->where('account_no',$value['account_ID'])->orderby("date_of_pickup","DESC")->get($dbprefix."_data_table","inches_to_gallons,date_of_pickup");
    if(count($askthree)>0){
        $i = count($askthree);                    
        if($i>=4){
            //start completed pickups formula
           for($i=0;$i<5;$i++){           
                $expected = $expected + $askthree[$i]['inches_to_gallons'];
           }                            
           $expected_pickup_total =  $expected/4 ;
        }
        else {
            $expected_pickup_total=$value['estimated_monthly'];
        }
        
        $buffer = array(
            "estimated_volume"=>round($expected_pickup_total,2)
        );
        $db->where("account_ID",$value['account_ID'])->update($dbprefix."_accounts",$buffer);
        
    }
}


$db->close();
unset($db);
?>