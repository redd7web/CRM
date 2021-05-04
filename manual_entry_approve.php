<?php
include "protected/global.php";
ini_set("display_errors",1);

$db->query("UPDATE iwp_test_scale SET manual_entry =2 WHERE tk=$_POST[tk] ");



?>