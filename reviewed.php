<?php
include "protected/global.php";

$db->query("UPDATE Inetforms.ap_form_27963 SET ap_form_27963.element_50_1=$_POST[value] WHERE id=$_POST[entry]");

?>