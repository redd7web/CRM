<?php
ini_set("display_errors",1);
include "protected/global.php";


echo "sdfdslfjdskls";

$dy = $db->query("SELECT account_ID,Name,division,avg_gallons_per_Month FROM iwp_accounts WHERE account_ID NOT IN (SELECT account_no FROM iwp_scheduled_routes ) and status IN ('Active','New')");


if(count($dy)>0){
    echo "<ul>";
    foreach ($dy as $n){
        $tote = $db->query("SELECT account_no FROM iwp_containers WHERE account_no = $n[account_ID]");
        
        if(count($tote)>0){
            echo "<li>$n[Name] - tote exists</li>";
        }else{
            echo "<li>$n[Name] - tote missing</li>";
        }
        $stop = array(
            "scheduled_start_date"=>"0000-00-00",
            "facility_origin"=>$n['division'],
            "route_status"=>"scheduled",
            "created_by"=>99,
            "account_no"=>$n['account_ID'],
            "code_red"=>0,
            "date_created"=>date("Y-m-d"),
            "oil_onsite"=>$n['avg_gallons_per_Month']
        );
        $db->insert("iwp_scheduled_routes",$stop);
    }
    echo "</ul>";
}else{
    echo "empty";
}


?>