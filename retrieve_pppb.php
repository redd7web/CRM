<?php
include "protected/global.php";
ini_set("display_errors",1);


switch($_POST['pppb_entry']){
    case 1:
        $k ="SELECT element_10 FROM Inetforms.ap_form_43646 WHERE element_7 = '$_POST[lot]' AND ( element_15 IS NULL OR LENGTH( TRIM(element_15 ) ) =0 ) AND element_16=1 and element_26 = 4 ORDER BY date_created DESC LIMIT 0,1";
    break;
    case 2:
        $k ="SELECT element_28 as elemet_10 FROM Inetforms.ap_form_43646 WHERE element_30 = '$_POST[lot]' AND ( element_15 IS NULL OR LENGTH( TRIM(element_15 ) ) =0 ) element_16=1 and element_26 = 4 ORDER BY date_created DESC LIMIT 0,1";
    break;   
}

$j = $db->query($k);

if(count($j)>0){
    echo $j[0]['element_10'];
}else{
    echo 0;
}

?>