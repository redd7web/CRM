<?php
include "protected/global.php";
ini_set("display_errors",1);
switch($_POST['sample']){
    case 1:
        $db->query("UPDATE iwp_test_scale SET sample_bag_score = $_POST[pppb_value] WHERE tk = '$_POST[weight]' ");
    break;
    case 2:
        $db->query("UPDATE iwp_test_scale SET sample_bag_score2 = $_POST[pppb_value] WHERE tk = '$_POST[weight]' ");
    break;
}

?>