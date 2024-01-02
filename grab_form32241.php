<?php

include "protected/global.php";
ini_set("display_errors",1);
$result = array();
$lines="";
$data = $db->query("SELECT element_79,element_73,IFNULL(element_5,0) as element_5,IFNULL(element_7,0) as element_7,element_6,IFNULL(element_37,0) as element_37,element_4 FROM Inetforms.ap_form_32241 ORDER BY id DESC LIMIT 0,10");

if(count($data)>0){//if there was data returned
    foreach($data as $line_items){
        //month-day-year-start_measure-stage1-miu
      $lines .= $line_items['element_79']."~".$line_items['element_73']."~".$line_items['element_5']."~".$line_items['element_7']."~".$line_items['element_6']."~".$line_items['element_37']."~".$line_items['element_4']."<br/>";
    }
    
    echo $lines;
}


?>

