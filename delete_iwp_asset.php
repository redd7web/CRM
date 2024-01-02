<?php
include "protected/global.php";
ini_set("display_errors",1);
$db->query("DELETE FROM assets.truck WHERE truck_id = $_POST[id]");
$db->query("DELETE FROM iwp_truck_id WHERE module_id = $_POST[id]");


?>