<?php
include "protected/global.php";
ini_set("display_errors",1);
$person = new Person();


switch($_POST['table']){
    case "jake":
        $table = "iwp.iwp_jacobsen";
        $table_info = array(
            "percentage"=>$_POST['value'],
            "user"=>99,
            "date"=>date("Y-m-d"),
            "modified"=>date("Y-m-d")
        );
        $db->insert("$table",$table_info);
        
    break;
    case "soybean":
        $table = "iwp.iwp_soybean";
        $db->query("UPDATE $table SET percentage = $_POST[value]");
    break;
    case "fuel_price":
        $table = "iwp.iwp_fuel_price";
        $db->query("UPDATE $table SET percentage = $_POST[value]");
    break;
}






?>