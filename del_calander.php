<?php
include "protected/global.php";
ini_set("display_errors",1);


if($_GET['all'] == 0){
    $db->query("DELETE FROM Inetforms.ap_form_47591 WHERE ap_form_47591.id = $_GET[idididi]");
}else{
    $db->query("DELETE FROM Inetforms.ap_form_47591 WHERE YEAR(ap_form_47591.element_6) = $_GET[year] AND MONTH(ap_form_47591.element_6) = $_GET[month] AND DAY(ap_form_47591.element_6) = $_GET[day]");
}


?>