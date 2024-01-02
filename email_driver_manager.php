<?php
include "protected/global.php";

$ikg_info = new IKG($_POST['route_id']);
if($ikg_info->net_weight >0){
    $perc_full = round($ikg->collected_Weight/$ikg_info->net_weight,2);    
} else {
    $perc_full = 0;
}

$headers = 'From: last_stop_check_no-reply@iwpusa.com' . "\r\n" .
    'Reply-To: last_stop_check_no-reply@iwpusa.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


mail(user_info($ikg_info->created_by,"email"),"Last Stop truck info for route $ikg_info->route_id, $ikg_info->ikg_manifest_route_number","Total Collected Weight :".$ikg->collected_Weight."/".$ikg_info->net_weight." for route $ikg_info->route_id, $ikg_info->ikg_manifest_route_number \r\n $perc_full % full",$headers);


?>