<?php
include "protected/global.php";
ini_set("display_errors",1);


$check = $db->query("SELECT account_ID,name,division
FROM iwp_accounts
WHERE account_ID NOT
IN (

SELECT account_no
FROM iwp_scheduled_routes
)
AND STATUS = 'Active'");


if(count($check)>0){
    foreach($check as $nx){
        $account_info = array(
            "account_no"=>$nx['account_ID'],
            "route_id"=>null,
            "scheduled_start_date"=>date("Y-m-d"),
            "facility_origin"=>$nx['division'],
            "route_status"=>"scheduled",
            "created_by"=>99,
            "date_created"=>date("Y-m-d")
        );
        $db->insert("iwp_scheduled_routes",$account_info);
    }
}




?>