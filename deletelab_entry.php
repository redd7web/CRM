<?php
include "protected/global.php";
ini_set("display_errors",1);
$pox = $db->query("SELECT element_16,element_76,element_85 FROM Inetforms.ap_form_44342 WHERE ap_form_44342.id = $_POST[er_id] ");


if(count($pox)>0){
    if($pox[0]['element_16'] !=NULL && $pox[0]['element_16'] !=' '){// did this come from OSR?
        $db->query("DELETE FROM Inetforms.ap_form_42682 WHERE id =".$pox[0]['element_16']);
    } 
    
    if($pox[0]['element_76'] !=NULL && $pox[0]['element_76'] !=' '){// did this come from TSL ?
        $db->query("DELETE FROM Inetforms.ap_form_43256 WHERE id=".$pox[0]['element_76']);
    }
    
   
}


?>