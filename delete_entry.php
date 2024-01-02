<?php
include "protected/global.php";
ini_set("display_errors",1);
$db->query("DELETE FROM Inetforms.ap_form_44342 WHERE ap_form_44342.id = $_POST[er_id] ");//delete lab entry


?>