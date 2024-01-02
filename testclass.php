<?php
include "protected/global.php";
ini_set("display_errors",1);
 
 $rid = 41534;
 
$ghy = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE route_id =$rid");

if(count($ghy)>0){
    $full_string ="";
    foreach($ghy as $numbers){
        $full_string .=$numbers['account_no']."|";
    }
    echo $full_string;
    
    $fix = array(
        "account_numbers"=>$full_string
    );
    $db->query("UPDATE iwp_ikg_manifest_info SET account_numbers ='$full_string' WHERE route_id=$rid");
}
 




?>