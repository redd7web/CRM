<?php
include "protected/global.php";

switch($_POST['mode']){
    case "lot":
        $db->query("UPDATE iwp_test_scale SET lot_number='$_POST[value]' WHERE tk=$_POST[weight]");
    break;
    case "lot2":
        $db->query("UPDATE iwp_test_scale SET lot_number2='$_POST[value]' WHERE tk=$_POST[weight]");
    break;
    case "seal":
        $db->query("UPDATE iwp_test_scale SET seal_number='$_POST[value]' WHERE tk=$_POST[weight]");
    break;
    case "addt":
         $db->query("UPDATE iwp_test_scale SET additiona_notes='$_POST[value]' WHERE tk=$_POST[weight]");
    break;
}


?>