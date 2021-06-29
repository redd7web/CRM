<?php
include "protected/global.php";
include "scaleFunctions.php";
ini_set("display_errors",1);

$manage = array (1,3);
$calc_check = array(82,86,20);
$billers = array(1,2);
$product_restrict = array(4,5,6,9,10,11,12,13,14,15,20,22,25,28,29,30,31,34,36,37,38,39,40,41,47,48,49,50,51,54,55,63,67,69,71,72,76,77,80,82,84,86,87,88,89,90);

if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    
    session_destroy();
}

include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",0);

?>

