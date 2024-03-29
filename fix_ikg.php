<?php
include "protected/global.php";


$already_scheduled = array();

$po = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE route_status IN (
'scheduled', 'new', 'en-route'
)");

if(count($po)>0){
    foreach($po as $already_){
        $already_scheduled[] = $already_['account_no'];
    }
}

$k = $db->query("SELECT DISTINCT iwp_data_table.account_no, iwp_accounts.status,iwp_accounts.account_ID FROM iwp_data_table INNER JOIN iwp_accounts ON iwp_data_table.account_no = iwp_accounts.account_ID WHERE iwp_accounts.status ='Active' || iwp_accounts.status ='New' ");

if(count($k)>0){
    
    foreach($k as $o){
        
        if(!in_array($o['account_no'],$already_scheduled)){
            $ant = new Account();
            $dte = $db->query("SELECT date_of_pickup FROM iwp_data_table WHERE account_no = $o[account_no] ORDER by date_of_pickup DESC");
                    
            if(count($dte)>0){
                
                $schedule_info = array(
                    "scheduled_start_date"=>addDayswithdate($dte[0]['date_of_pickup'],$ant->singleField($o['account_no'],"pickup_frequency")),
                    "account_no"=>$o['account_no'],
                    "route_status"=>"scheduled",
                    "date_created"=>date("Y-m-d"),
                    "created_by"=>99,
                    "code_red"=>0,
                    "facility_origin"=>(int)$ant->singleField($o['account_no'],"division")
                );
                echo "status: ".$db->insert("iwp_scheduled_routes",$schedule_info)."<br/>";
                var_dump($schedule_info);
                echo "account $o[account_no] last picked up on ".$dte[0]['date_of_pickup']."<br/><br/>";
                
                
            }
        }
       
    }
}
?>