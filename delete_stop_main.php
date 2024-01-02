<?php
include "protected/global.php";
ini_set("display_errors",1);


$oii_stop = $db->query("SELECT * FROM iwp_scheduled_routes WHERE schedule_id=$_POST[schedule_id] ");

if( count($oii_stop) >0  ){
    
    if($oii_stop[0]['route_id'] !=null AND strlen(trim($oii_stop[0]['route_id']))>0){
        $db->query("UPDATE iwp_ikg_manifest_info SET account_numbers = REPLACE(account_numbers, '".$oii_stop[0]['account_no']."|', '') WHERE route_id = ".$oii_stop[0]['route_id']);//remove account_number from route string
        
        $db->query("UPDATE iwp_data_table SET deleted =1 WHERE route_id = ".$oii_stop[0]['route_id']." AND schedule_id =".$oii_stop[0]['schedule_id']." AND account_no =".$oii_stop[0]['account_no']."");//mark data entry deleted
    }
    
    
    
    
    $db->query("UPDATE iwp_scheduled_routes SET deleted = 1 WHERE schedule_id =".$oii_stop[0]['schedule_id']);// mark stop as deleted
}




?>