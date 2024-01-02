<?php
include "../protected/global.php";
$data_table = $dbprefix."_data_table";
error_reporting(1);
ini_set("max_execution_time",300);
//********************************* THIS SCRIPT TO BE RUN DAILY (CRON JOB)*******************************************//s


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

$count =1;
$accounts_pickedup = $db->query("SELECT account_ID,estimated_volume,pickup_frequency,created FROM iwp_accounts");

$atr = new Account();

//var_dump($accounts_pickedup);

if(count($accounts_pickedup)>0){
    foreach($accounts_pickedup as $nos){
       $total = 0;
       echo  "<br/><br/>$count ".account_NumToName($nos['account_ID'])."<br/>";
       $how_many_picks = $db->query("SELECT date_of_pickup, COUNT( * ) AS count FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY date_of_pickup ORDER BY `iwp_data_table`.`date_of_pickup` DESC ");
       //echo "fault after..<br/>";
       
       
       
       
       if(count($how_many_picks)>3) { // if account has 4 pickups or more pickups
             echo "Has 4 or more pickups<br/>";
            $check = $db->query("SELECT DISTINCT (date_of_pickup) as num_of_picks, count( date_of_pickup ) AS num, SUM( inches_to_gallons ) AS tot_for_pickup, account_no, inches_to_gallons FROM iwp_data_table WHERE account_no =$nos[account_ID] GROUP BY schedule_id ORDER BY date_of_pickup DESC LIMIT 0 , 4");
            
            $for_this= 0;
            foreach($check as $individ){
                $for_this = $for_this + $individ['tot_for_pickup'];
            }
            
            echo "total of last four pickups :".$for_this."<br/>";
            $info = $db->query("SELECT date_of_pickup FROM iwp_data_table WHERE account_no = $nos[account_ID] ORDER BY date_of_pickup DESC LIMIT 0,4");
            echo "Dates of last 4 pickups ".$info[0]['date_of_pickup']." | ".$info[1]['date_of_pickup']." | ".$info[2]['date_of_pickup']." | ".$info[3]['date_of_pickup']." difference ".date_different($info[3]['date_of_pickup'],$info[0]['date_of_pickup'])."<br/>";                        
            
            $ticks = round($for_this,2) / date_different($info[3]['date_of_pickup'],$info[0]['date_of_pickup'])."<br/>";
            echo "ticks per day: ". round($ticks,2)."<br/>" ;
            
            
            $next_sched = $db->query("SELECT schedule_id, scheduled_start_date FROM iwp_scheduled_routes WHERE account_no =$nos[account_ID] AND route_status IN ('scheduled', 'enroute') ORDER BY scheduled_start_date DESC ");
            echo "next scheduled pickup ". $next_sched[0]['scheduled_start_date']."<br/>";
            
            
            echo "difference between todys date and last pickup: ". date_different($info[0]['date_of_pickup'],date("Y-m-d"))."<br/>";
            
            $new_oil_on_site = $ticks * date_different($info[0]['date_of_pickup'],date("Y-m-d") ) ;
            echo round($new_oil_on_site,2) ." oil onsite after tick<br/>";
            echo "difference of next scheduled start and the last pickup". date_different($info[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date'])."<br/>";
            
            $avg = round($ticks * date_different($info[0]['date_of_pickup'],$next_sched[0]['scheduled_start_date']),2);
            echo "expected : ".$avg;
            
            echo "<br/><br/>";      
       }
       else if($how_many_picks<4 && $how_many_picks >0){
             echo "Has less than 4 pickups but more than 0<br/>";             
             $diff = date_different($how_many_picks[0]['date_of_pickup'],date("Y-m-d")); 
             echo "Date Difference: $diff<br/>";
             $avg = $nox['estimated_volume'];
             $averg = $nox['estimated_volume'] / 30;
             echo "ticker: ".$averg;
             $new_oil_on_site = $averg * $diff;
       }   else if($how_many_picks == 0){
            echo "Has less  0 pickups<br/>";
            echo "Date Difference: $diff<br/>";
            $diff = date_different($nos['created'],date("Y-m-d"));
            echo "difference :".$diff;
            $avg = $nox['estimated_volume'];
            $averg = $nox['estimated_volume'] / 30;
            echo "ticker: ".$averg;
            $new_oil_on_site = $averg * $diff;
       }
       
       
       $package = array(
            "avg_gallons_per_Month"=>round($new_oil_on_site,2),//how much oil is onsite ?
            "estimated_volume"=>$avg // expected (average of last 4 unique pickups)
       );
       
       echo "<pre>";
       print_r($package);
       echo "</pre>";
       echo "********************************************************************************<br/><br/><br/>";
       echo "status: ".$db->where("account_ID",$nos['account_ID'])->update($dbprefix."_accounts",$package);
        $count++;   
    }   
    
}








?>