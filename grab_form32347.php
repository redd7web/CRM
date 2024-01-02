<?php
include "protected/global.php";
ini_set("display_errors",0);
$lines="";
$data = $db->query("SELECT * FROM Inetforms.ap_form_32347 ORDER BY id DESC LIMIT 0,10");
if(count($data)>0){//if there was data returned
    foreach($data as $line_items){//time~indication~gallons
        $lines .="$line_items[element_73]~$line_items[element_74]~$line_items[element_75]~$line_items[element_76]~$line_items[element_77]~$line_items[element_131]~$line_items[element_132]~$line_items[element_133]~$line_items[element_78]~$line_items[element_134]<br/>";
    }
    echo $lines;
}
?>