<?php
include "protected/global.php";
ini_set("display_errors",1);
$pox = $db->query("SELECT element_85 FROM Inetforms.ap_form_44342 WHERE ap_form_44342.id = $_POST[er_id] ");

if(count($pox)>0){
    if($pox[0]['element_85'] !=NULL && $pox[0]['element_85'] !=' ' && strlen($pox[0]['element_85']) >0){
        $db->query("DELETE FROM Inetforms.ap_form_44342 WHERE ap_form_44342.id = ".$pox[0]['element_85']);
    }
}


?>