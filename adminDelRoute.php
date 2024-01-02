<?php
include "protected/global.php";

$db->query("DELETE FROM iwp_list_of_routes WHERE route_id = $_GET[route_id]");
$db->query("DELETE FROM iwp_ikg_manifest_info WHERE route_id = $_GET[route_id]");
$db->query("DELETE FROM iwp_data_table WHERE route_id=$_GET[route_id]");
$db->query("DELETE FROM iwp_rout_history WHERE route_no=$_GET[route_id]");
$db->query("UPDATE iwp_scheduled_routes set route_status='scheduled' WHERE route_id=$_GET[route_id]  AND route_status='enroute'");


?>