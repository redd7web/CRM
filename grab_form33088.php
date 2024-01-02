<?php
include "protected/global.php";
$data = $db->query("SELECT * FROM Inetforms.ap_form_33088 ORDER BY id DESC LIMIT 0,10");

//element_73 - time
//element_75 - gallons
//element_76 - product
//element_99 - drop down
//element_77 - destination
//element_78 - initials

if(count($data)>0){
    foreach($data as $line_items){
        echo "$line_items[element_73]~$line_items[element_75]~$line_items[element_76]~$line_items[element_99]~$line_items[element_77]~$line_items[element_78]<br/>";
    }
}
?>