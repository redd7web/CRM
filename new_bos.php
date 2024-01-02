<?php


include "protected/global.php";

$db->query("UPDATE iwp_test_scale SET new_bos_number = $_GET[new_bos] WHERE TransactionKey = $_GET[truckkey]");


?>