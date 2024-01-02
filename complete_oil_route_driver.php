<?php
// complete route from data enter page
include "protected/global.php";
//ini_set("display_errors",1);
$person = new Person();
$data_table = $dbprefix."_data_table";
echo $_GET['route_id']."<br/>";
$date = date("Y-m-d H:i:s");
$ikg = new IKG($_GET['route_id']);

function get_index(){
    global $db;
    $xo =  $db->query("SELECT date,percentage FROM iwp_jacobsen ORDER BY DATE DESC LIMIT 0,1 ");
    
    if(count($xo)>0){
        return $xo;
    } else {
        return 0;
    }
}



$req = $db->query("SELECT iwp_data_table.*,iwp_accounts.avg_gallons_per_Month FROM `iwp_data_table` LEFT JOIN iwp_accounts ON iwp_accounts.account_ID = iwp_data_table.account_no WHERE route_id =$_GET[route_id] GROUP BY schedule_id");
$count =0;
$tot = 0;
$avg =0;
$nums ="";

if(count($req)>0){
    foreach($req as $stops){        
        echo "schedule id: ".$stops['schedule_id']." date of pickup: ".$stops['date_of_pickup']." account number: ".$stops['account_no']."<br/>";
        //echo "<pre>";
        $ant = new Account($stops['account_no']);
        $sched = new Scheduled_Routes($stops['schedule_id']);
        
        if(   ( $stops['zero_gallon_reasons'] ==10 || $stops['zero_gallon_reasons'] ==12) ||  
                ( $stops['zero_gallon_reasons2'] ==10 || $stops['zero_gallon_reasons2'] ==12) || 
                ( $stops['zero_gallon_reasons3'] ==10 || $stops['zero_gallon_reasons3'] ==12) || 
                ( $stops['zero_gallon_reasons4'] ==10 || $stops['zero_gallon_reasons4'] ==12) || 
                ( $stops['zero_gallon_reasons5'] ==10 || $stops['zero_gallon_reasons5'] ==12)   || $stops['inches_to_gallons'] <= 0.00
            ){
            
        }else{
            $db->query("UPDATE iwp_accounts SET avg_gallons_per_Month= avg_gallons_per_Month - $stops[inches_to_gallons] WHERE account_ID = $stops[account_no]");//reset account oil guage back to 0  if there were no issues or there was oil pumped.
            //barrel amount will now reflect current level - how much was pumped.
        }
        
        
        //** IF THERES AN ISSUE COMPLETE IT **//
        if(strlen(trim($sched->issue_associated)) >0  ){
            $db->query("UPDATE iwp_issues SET issue_status='closed',completed_explaination='Issue $sched->issue_code completed on $stops[date_of_pickup] Route: $stops[route_id] Schedule: $stops[schedule_id] Account:".$ant->name_plain." by ".uNumToName_plain($ikg)." ' WHERE issue_no = $sched->issue_associated");
        }
        //** IF THERES AN ISSUE COMPLETE IT **//
        
        
        $nums .=$stops['account_no']."|";
        $tot +=$stops['sum'];
        $avg +=$stops['avg_exp'];
        $count++;
        
        switch($stops['zero_gallon_reasons']){
            case 10: case 12:
            break;
            default:
                //echo "UPDATE iwp_accounts SET avg_gallons_per_Month=0 WHERE account_ID = $stops[account_no]<br/>";
                $db->query("UPDATE iwp_accounts SET avg_gallons_per_Month=0 WHERE account_ID = $stops[account_no]");//reset account oil guage back to 0  
            break;
        } 
    
    $db->query("UPDATE iwp_ikg_manifest_info SET account_numbers='$nums',driver_completed_date='$date' WHERE route_id=$_GET[route_id]");
     
    //echo "stops: ".$count."<br/>";    
    //echo $tot."<br/>";
    //echo "expected ".$avg."<br/>";
    }
}
        
   $uo = $db->query("SELECT iwp_data_table.entry_number,iwp_data_table.date_of_pickup,iwp_data_table.schedule_id,iwp_data_table.sum, (iwp_data_table.sum - (iwp_data_table.sum * iwp_accounts.miu) ) as adj,iwp_data_table.route_id, iwp_accounts.name,iwp_accounts.payment_method, iwp_accounts.miu,iwp_accounts.index_percentage,iwp_accounts.ppg_jacobsen_percentage,iwp_accounts.price_per_gallon,iwp_accounts.account_ID FROM iwp_data_table LEFT JOIN iwp_accounts ON iwp_accounts.account_ID = iwp_data_table.account_no WHERE iwp_data_table.route_id =$_GET[route_id] ");
$ko =get_index();
if(count($uo)>0){
    foreach($uo as $stops){
           
            $jux = $db->query("SELECT paid FROM iwp_accounts WHERE account_ID = $stops[account_ID]");
            echo "<br/>--------";
            switch($stops['payment_method']){
                case "Jacobson": case "Index":
                    $ppg = number_format($stops['index_percentage'] *$ko[0]['percentage'] *7.56,2);
                break;
                default:
                case "Per Gallon": 
                    $ppg =  $stops['ppg_jacobsen_percentage'];
                break;
                case "Normal":
                    $ppg =  0.00;
                break;
               case "O.T.P. Per Gallon": case "O.T.P. PG":            
                if(  $jux[0]['paid'] == 0 || $jux[0]['paid'] == null  ){               
                    $one_time = $stops['ppg_jacobsen_percentage']; 
                    $ppg =  $ppg + $stops['ppg_jacobsen_percentage']; 
                } else {
                    $one_time = "";
                    $ppg =  $ppg;
                }           
                break;
            }
            
            switch($stops['payment_method']){
                case "Jacobson":case "Index":
                $paid =  $stops['index_percentage'] *$ko[0]['percentage'] * $stops['adj']*7.56;
                //echo "<br/>Jacobsen / Index ".$stops['index_percentage']." * ".$ko[0]['percentage']." * ".$stops['adj']." * 7.56<br/>";
                break;
                default:
                case "Per Gallon":
                
                $paid = $stops['ppg_jacobsen_percentage']* $stops['adj'];
                break;
                case "O.T.P. Per Gallon": case "O.T.P. PG":
                    $ppg = $stops['price_per_gallon'] *$stops['adj'];
                    if(  $jux[0]['paid'] == 0 || $jux[0]['paid'] == null  ){
                         $db->query("UPDATE iwp_accounts SET paid = 1 WHERE account_ID = $stops[account_ID]");
                         $one_time = $stops['ppg_jacobsen_percentage']; 
                        $paid = $ppg + $stops['ppg_jacobsen_percentage'];
                        echo "<br/>$stops[account_ID] First time paid for this account<br/>"; 
                    } else {
                        $one_time = "";
                        $paid = $ppg;
                        echo "<br/>$stops[account_ID] already paid for this account<br/>";
                    }
                break;
                case "No Pay": case "Normal":
                    $paid = 0.00;
                break;
            }
            switch($stops['payment_method']){
                case "Jacobson":  case"Index":
                    $rate = $stops['index_percentage'];
                    break;
                case "Per Gallon":
                    $rate = $stops['ppg_jacobsen_percentage'];
                    break;
                case "Normal":
                    $rate = $stops['price_per_gallon'];
                    break;
                case "O.T.P. Per Gallon": case "O.T.P. PG":            
                    if(  $jux[0]['paid'] == 0 || $jux[0]['paid'] == null  ){
                        $ratex[]=$stops['account_ID'];
                        $rate = $one_time + $stops['price_per_gallon'];
                    } else {
                        $rate = $stops['price_per_gallon'];
                    }
                    break;
                 case "No Pay":
                    $rate = 0.00;
                    break;
            }
            
            
            if(strlen($ppg)<0 || strlen($ppg) == 0){
                $ppg = 0;
            }
            
            if(strlen($rate)<0 || strlen($rate) == 0){
                $rate = 0;
            }
            
            $indice = $ko[0]['percentage'];
            
            $db->query("UPDATE iwp_data_table SET rate=$rate,	ppg= $ppg,index_at_pickup = $indice, temp_miu = $stops[miu],paid = $paid,payment_method='$stops[payment_method]' WHERE entry_number = $stops[entry_number]");
            
            
            $cr = 0;
            if(strlen(trim($person->user_id))>0){
                $user_id = $person->user_id;
                $s_notes ="Driver closed";
            }else{
                $user_id = 99;
                $s_notes ="User session expired when closing this route. Driver closed";
            }
            $ant = new Account($stops['account_ID']);
            $schedule_info = array(
                "scheduled_start_date"=>addDayswithdate(date("Y-m-d"),$ant->pick_up_freq),
                "account_no"=>$stops['account_no'],
                "route_status"=>"scheduled",
                "date_created"=>date("Y-m-d"),
                "created_by"=>$user_id,
                "code_red"=>$cr,
                "facility_origin"=>$ant->division,
                "stop_notes"=>$s_notes
            );
            //echo "<pre>";
            //print_r($schedule_info);
            //echo "</pre>";
            $db->insert("iwp_scheduled_routes",$schedule_info)."</br>";
            
        }
}else {
    echo "No completed stops.";
   
}

$db->query("UPDATE iwp_ikg_manifest_info SET driver_completed_date='$date' WHERE route_id=$_GET[route_id]");
$db->query("UPDATE iwp_list_of_routes SET stops = $count, collected = $tot, expected = $avg,driver_completed_date='$date' , inc = inc - $countWHERE route_id=$_GET[route_id]");
 


//************************************* RETURN uncomplete stops to pickups pool ********************************//    
 //$db->query("UPDATE iwp_scheduled_routes set route_status='scheduled',route_id=null WHERE route_id=$_GET[route_id] AND route_status in ('enroute','scheduled')");
//************************************* RETURN uncomplete stops to pickups pool ********************************//
 
 
 
 


?>