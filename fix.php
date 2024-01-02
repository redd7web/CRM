<?php
include "protected/global.php";
ini_set("display_errors",1);
$j ="";
$h  = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE route_id = 45352 AND deleted = 0");
if(count($h)>0){
    foreach($h as $f){
        $j .="$f[account_no]|";
        echo "$f[account_no]|";
    }
}

$db->query("UPDATE iwp_ikg_manifest_info SET account_numbers ='$j' WHERE route_id = 45352");







?>