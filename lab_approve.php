<?php
include "protected/global.php";

ini_set("display_errors",1);

switch($_POST['mode']){
    case "ma":
        $field = "manage_approve";
    break;
    
    case "ta":
        $field = "tech_approve";
    break;
    
}

$db->query("UPDATE iwp_test_scale SET $field = $_POST[value] WHERE TransactionKey = $_POST[id]");

?>