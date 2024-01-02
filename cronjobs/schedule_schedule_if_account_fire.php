<?php
include "../protected/global.php";

$numbers = $db->get($dbprefix."_accounts","account_ID");
$account = new Account();
$next_pickup="";
foreach($numbers as $anums){
    if($account->barrel_cap($anums['account_ID'])>0){        
        $percent_full = $account->singleField($anum['account_ID'],"avg_gallons_per_Month") / $account->barrel_cap($anums['account_ID']);      
        
        $get_route_date = $db->where("account_no",$anums['account_ID'])->where("route_status","Scheduled")->orderby('scheduled_start_date',"DESC")->get($dbprefix."_scheduled_routes","scheduled_start_date");
        
        if(count($get_route_date)>0){
            $next_pickup = $get_route_date[0]['scheduled_start_date'];
        }
                
        if($percent_full >= .75  || date("Y-m-d") > addDayswithdate($next_pickup,$account->singleField($anums['account_ID'],"pickup_Frequency")   )  ){
            
            $check = $db->where("account_no",$anums['account_ID'])->where("route_status","Scheduled")->get($dbprefix."_scheduled_routes");
                if(count($check)>0){
                $code_red = array(
                    "code_red"=>1
                );
                $db->where("account_no",$acnums['acount_ID'])->where("route_status","Completed")->update($dbprefix."_scheduled_routes",$code_red);
            }else {
                
                $get_last_pickup = $db->where("account_no",$anums['account_ID'])->orderby('date_of_pickup',"DESC")->get($dbprefix.'_data_table','date_of_pickup');
                $sched_route = array(
                    "code_red"=>1,
                    "account_no"=>$anums['account_ID'],
                    "route_status"=>"Scheduled",
                    "date_created"=>date("Y-m-d"),
                    "scheduled_start_date"=>addDayswithdate($get_last_pickup[0]['date_of_pickup'],$account->singleField($anums['account_ID'],"pickup_Frequency"))
                );
                $db->insert($dbprefix."_scheduled_routes",$sched_route);
            }
            
        }
    }
    
    
}

?>