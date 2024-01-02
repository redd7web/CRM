<?php
//#!/usr/bin/php5 -q
ini_set("display_errors",0);


$k = 1;
switch($k){
    case 1:
        include "/var/www/html/protected/global.php";
        $file = "/var/www/html/croncsv/haulers.csv";
        //$file2 = "/var/www/html/croncsv/weighin.csv";
    break;
    default:
        include "protected/global.php";
        $file = "croncsv/haulers.csv";
        //$file2 = "croncsv/weighin.csv";
    break;
}

$count =1;
if(file_exists($file)){
    $lines =file($file);
   
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $line = explode(",",$break[0]);
        
        $newname = str_replace('"'," ",$line[7]);
        $haul = str_replace('"'," ",$line[11]); 
        $pack = array(
            "HaulerKey"=>$line[6],
            "Name"=>$newname,
            "AddressKey"=>$line[8],
            "Phone"=>$line[9],
            "Fax"=>$line[10],
            "ContactName"=>$haul
        );
        
        echo "<pre>";
        print_r($pack);
        echo "</pre>";
        
        $p = $db->where("HaulerKey",$line[6])->get("iwp_truck_haulers");
         if(count($p)>0){
            $db->where("HaulerKey",$line[6])->update("iwp_truck_haulers",$pack);
         }else{
            $db->insert("iwp_truck_haulers",$pack);
         }/* /**/
        
    }
}else{
    echo "DNE<br/>";
}
?>