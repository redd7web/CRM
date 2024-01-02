<?php

include "protected/global.php";
ini_set("display_errors",1);

$db->query("UPDATE Inetforms.ap_form_44342 SET ap_form_44342.element_3 ='$_POST[status]',element_81=2 WHERE id=$_POST[id]");
echo "Sample Rejected";

?>