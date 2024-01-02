<?php
include "protected/global.php";
ini_set("display_errors",1);

$db->query("UPDATE iwp_test_scale SET manage_approve =1 WHERE tk=$_POST[tk] ");



?>