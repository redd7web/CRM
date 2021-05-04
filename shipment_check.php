<?php

ini_set("display_errors",1);


$k = 1;
switch($k){
    case 1:
        include "/var/www/html/protected/global.php";
        $file = "/var/www/html/croncsv/shipmentcheck.csv";
        //$file2 = "/var/www/html/croncsv/weighin.csv";
    break;
    default:
        include "protected/global.php";
        $file = "croncsv/shipmentcheck.csv";
        //$file2 = "croncsv/weighin.csv";
    break;
}

$num_of_updates = 1;
if(file_exists($file)){
    $lines =file($file);
   
    foreach($lines as $data){
        echo $num_of_updates.") <br/>";
        $ship = explode(",",$data);
        $wi = date("Y-m-d", strtotime($ship[5]) );
        echo"<pre>";
        var_dump($ship);
        echo "</pre>";
        $tk = str_replace('"',"","$ship[7]");
        
        $prev_date = date('Y-m-d', strtotime($wi .' -1 day'));
        $next_date = date('Y-m-d', strtotime($wi .' +1 day'));
        
        //element_12 = Net
        //element_16 = Shipping number
        //element_7 = weighin
        $kc = "UPDATE Inetforms.ap_form_64000 SET element_16 = $ship[4] WHERE element_12= $ship[6] AND date_created>='$prev_date' AND element_1 like '%".trim($tk)."%'";
       $db->query($kc);
       echo $kc."<br/><br/>";
       $num_of_updates++;
    }
}


?>