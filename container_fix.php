<?php
include "protected/global.php";
ini_set("display_errors",1);

function find_date($account_no){
    global $db;
     $check_first = $db->query("SELECT scheduled_start_date FROM iwp_scheduled_routes WHERE account_no = $account_no AND scheduled_start_date !='0000-00-00' ORDER BY scheduled_start_date ASC LIMIT 0,1");
     
     if(count($check_first)>0){
        return $check_first[0]['scheduled_start_date'];
     }else{
        return 'N/A';
     }
}

$x = $db->query("SELECT account_ID,Name,status,state_date,pickup_frequency,division,avg_gallons_per_Month FROM iwp_accounts WHERE status= 'Active' AND account_ID NOT IN ( SELECT account_no FROM iwp_scheduled_routes) AND account_ID NOT IN (SELECT account_no FROM iwp_data_table) AND state_date !='0000-00-00' AND pickup_frequency !=0");

if(count($x)>0){
   foreach($x as $ki){
        //$d = find_date($ki['account_ID']);
        $o = addDayswithdate($ki['state_date'],$ki['pickup_frequency']);
        echo $ki['Name']." $o<br/>";  
        $pack = array(
            "scheduled_start_date"=>$o,
            "account_no"=>$ki['account_ID'],
            "route_id"=>"NULL",
            "facility_origin"=>$ki['division'],
            "route_status"=>"scheduled",
            "created_by"=>99,
            "code_red"=>0,
            "date_created"=>date("Y-m-d"),
            "oil_onsite"=>$ki['avg_gallons_per_Month']
        );  
        print_r($pack);
        $db->insert("iwp_scheduled_routes",$pack);
       
   }
}


?>