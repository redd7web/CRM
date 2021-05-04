<?php
include "protected/global.php";
ini_set("display_errors",1);
$x = $db->query("SELECT element_144  FROM Inetforms.ap_forms_43256 WHERE id=$_POST[id]");

if(count($x)>0){
    unlink("/machforms/machform/data/form_43256/files/".$bol_del[0]['element_144']);  
}


$db->query("UPDATE Inetforms.ap_forms_43256  SET element_144 =NULL WHERE id=$_POST[id]")


?>