<?php
ini_set("display_errors",1);
include "protected/global.php";

$file = fopen('products.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE) {
   //$line[0] = '1004000018' in first iteration
   $x =$db->query("SELECT ProductKey FROM iwo_products WHERE Name like '%".trim($line[0])."%'");
   echo "SELECT ProductKey FROM iwo_products WHERE Name like '%$line[0]%'<br/>";
   if(count($x)>0){
        echo "UPDATE iwo_products SET division = '$line[1]' WHERE Name like '%$line[0]%'<br/><br/>";     
   }else{
        echo "INSERT INTO iwo_products  $line[0] : $line[1]<br/><br/>";
   }
   
   
   //$db->query("UPDATE iwo_products SET division = '$line[1]' WHERE Name like '%$line[0]%'");
}
fclose($file);
?>