<?php
include "protected/global.php";
ini_set("display_errors",1);
$lines =file('reload.csv');
  $count = 1;
foreach($lines as $data){
  
    echo $count.")";
    $line =  explode(",",$data);
    echo $line[0]."<br/>";
    
    
    
    $count++;
}


?>