<?php
include "protected/global.php";
ini_set("display_errors",1);
$osr = $db->query("SELECT * FROM Inetforms.ap_form_42682 WHERE element_27  ='Pending'");

if(count($osr)>0){
    foreach($osr as $orig){
        $osr2 = array(
            "id"=>$orig['id'],
            "element_25"=>$orig['element_25'],
            "element_26"=>$orig['element_26'],
            "element_27"=>$orig['element_27'],
            "element_37"=>$orig['element_2'],
            "element_39"=>$orig['element_1'],
            "element_42"=>$orig['element_5'],
            "element_43"=>$orig['element_6'],
            "element_44"=>$orig['element_7'],
            "element_46"=>$orig['element_9'],
            "element_47"=>$orig['element_10'],
            "element_48"=>$orig['element_11'],
            "element_50"=>$orig['element_13'],
            "element_51"=>$orig['element_14'],
            "element_53"=>$orig['element_16'],
            "element_54"=>$orig['element_17'],
            "element_55"=>$orig['element_18'],
            "element_57"=>$orig['element_20'],
            "element_58"=>$orig['element_21'],
            "element_60"=>$orig['element_23'],
            "element_61"=>$orig['element_24']
        );
        
        $db->insert("Inetforms.ap_form_47049",$osr2);
        $osr2_id = $db->getInsertId();
        
        $db->query("UPDATE Inetforms.ap_form_44342 SET element_16 =$osr2_id WHERE element_16 = $orig[id]");
        
        echo "********************************<br/>";        
        echo "<pre>";
        print_r($osr2);
        echo "</pre><br/><br/>************************<br/>";
    }
}


?>