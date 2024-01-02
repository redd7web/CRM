<?php
include "protected/global.php";


$db->query("UPDATE iwp_ikg_manifest_info SET deleted=1 WHERE route_id = $_POST[route_id]");//remove route from route manifest (mark as deleted)
$db->query("UPDATE iwp_list_of_routes SET deleted =1 WHERE route_id = $_POST[route_id]");//remote route from route list (mark as deleted)

$search_stops = $db->query("UPDATE iwp_scheduled_routes SET route_id = NULL,route_status='scheduled' WHERE route_id=$_POST[route_id] AND route_status IN ('enroute','scheduled')");//set stops that are enroute or scheduled back to scheduled pickup pool
?>