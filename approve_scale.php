<?php
include "protected/global.php";

$db->query("UPDATE iwp_test_scale SET scale_approved = $_GET[value] WHERE TransactionKey = $_GET[entry]");


?>