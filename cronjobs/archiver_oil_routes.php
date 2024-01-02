<?php
include "../protected/global.php";


function exists($route_id){
    global $db;
    $exist = $db->where("route_id",$route_id)->get("iwp_ikg_manifest_info2","route_id");//does it exist? 
    if(count($exist)>0){
        $db->where("route_id",$route_id)->delete("iwp_ikg_manifest_info");// if it already exists in archive, remove it
        echo " exists<br/>"; 
    }else{
        if($db->query("INSERT INTO iwp_ikg_manifest_info2 SELECT d.* FROM iwp_ikg_manifest_info d WHERE d.route_id = $route_id")){ // copy it into archive then delete it from regular
            $db->where("route_id",$route_id)->delete("iwp_ikg_manifest_info");
        }
        echo "insert<br/>";
    }
}

$ic = $db->query("SELECT route_id,completed_date FROM iwp_ikg_manifest_info  WHERE `completed_date` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");

if(count($ic)>0){
    foreach($ic as $routes){
        echo "$routes[route_id] $routesp[completed_date] ";
        exists($routes['route_id']);
    }    
}else {
    echo "No entries older than a year<br/>";
}
unset($db);

?>