<?php
include "protected/global.php";

if($db->query("UPDATE Inetforms.ap_form_43256 SET='Pending' WHERE ap_form_43256.id=$_POST[tsl_entry]")){
    $db->query("DELETE FROM Inetforms.ap_form_49773 WHERE ap_form_49773.id = $_POST[entry]");
}




?>