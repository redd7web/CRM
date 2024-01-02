<?php
include "protected/global.php";

$xp = $db->query("SELECT route_id,account_numbers,ikg_manifest_route_number FROM iwp_ikg_manifest_info");



if(count($xp)>0){
    foreach($xp as $px){
        echo "route id: ".$px['route_id']." $px[ikg_manifest_route_number]<br/>";
        $uffer = explode("|",$px['account_numbers']);
        array_pop($uffer);//get current account list
         
         echo "<pre>";
         print_r($uffer);
         echo "</pre>";
    }
    
}





?>