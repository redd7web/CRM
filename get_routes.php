<?php
include "protected/global.php";

switch($_GET['type']){
    case "oil":
        $table = "iwp_list_of_routes";
    break;
    
    case "util":
        $table = "iwp_list_of_utility";
    break;
}

$scrts = $db->where("status","enroute")->where("deleted", 0)->get("$table","route_id,ikg_manifest_route_number,driver");


if(count($scrts)>0){
    foreach($scrts as $add_existing){
        echo "<option value='$add_existing[route_id]'>$add_existing[route_id] $add_existing[ikg_manifest_route_number] (".  uNumToName($add_existing['driver']).")</option>";
    }
}


?>