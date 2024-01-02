<?php
include "../protected/global.php";

function exists($route_id){
    global $db;
    $exists = $db->where("route_id",$route_id)->get("iwp_ikg_utility2","$route_id");
    if(count($exists)>0){// already exists in archive ?
        $db->where("route_id",$route_id)->delete("iwp_ikg_utility");
    }else {
        if($db->query("INSERT INTO iwp_ikg_utility2  SELECT d.* FROM iwp_ikg_utility d WHERE d.route_id = $route_id ")){//archive entry
            $db->where("route_id",$route_id)->delete("iwp_ikg_utility");// delete from original source if successful
        }
    }
    unset($db);
}


$util = $db->query("SELECT route_id FROM iwp_ikg_utility WHERE `completed_date` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");
if(count($util)>0){
    foreach($util as $routes){
        exists($routes['route_id']);
    }
}else {
    echo "No entries older than 1 year<br/>";
}
unset($db);
?>