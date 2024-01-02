<?php

include "protected/global.php";

$db->query("DELETE FROM iwp_ikg_util_info WHERE route_id =$_GET[util_route_no]");
$db->query("DELETE FROM iwp_list_of_utility WHERE route_id=$_GET[util_route_no]");
$db->query("DELETE FROM iwp_utility_data_table WHERE route_id=$_GET[util_route_no]");
$db->query("UPDATE iwp_utility set route_status='scheduled' WHERE rout_no = $_GET[util_route_no]  AND route_status='enroute'");

?>