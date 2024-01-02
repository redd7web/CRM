<?php

include "protected/global.php";

$db->query("DELETE FROM iwp_list_of_grease WHERE route_id = $_GET[route_id]");
$db->query("DELETE FROM iwp_ikg_grease WHERE route_id=$_GET[route_id]");
$db->query("DELETE FROM iwp_grease_data WHERE route_id=$_GET[route_id]");
$db->query("UPDATE iwp_grease_traps set route_status='scheduled' WHERE grease_route_no = $_GET[route_id] AND route_status='enroute'");

?>