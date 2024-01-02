<?php
include "protected/global.php";
ini_set("display_errors",1);
$result = $db->query("SELECT COALESCE(SUM(Inetforms.ap_form_23024.element_17),NULL,0) as ttotal FROM Inetforms.ap_form_23024 WHERE  ap_form_23024.element_10= $_POST[driver_id]  AND ap_form_23024.element_46 = $_POST[delivery_number] AND ap_form_23024.element_1 ='$_POST[year]-$_POST[month]-$_POST[day]'");

echo $result[0]['ttotal']; 
?>