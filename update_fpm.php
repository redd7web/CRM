<?php
include "protected/global.php";
ini_set("display_errors",1);
$db->query("UPDATE iwp_ikg_manifest_info SET fuel_per_gallon =$_POST[new_fpm] WHERE route_id = $_POST[route_id] ");

?>