<?php
include "protected/global.php";
ini_set("display_errors",1);
$wi = explode(" ",$_POST['weighin']);



$db->query("UPDATE Inetforms.ap_form_64000 SET element_16 = $_POST[sn] WHERE ap_form_64000.element_2 =$_POST[truckkey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]'");
echo "UPDATE Inetforms.ap_form_64000 SET element_16 = $_POST[sn] WHERE ap_form_64000.element_2 =$_POST[truckkey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]'";
?>