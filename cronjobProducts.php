<?php
#!/usr/bin/php5 -q
date_default_timezone_set('America/Los_Angeles');
ini_set("display_errors",1);
//include "/var/www/html/protected/global.php";
$local_path = "/var/www/html/croncsv/OnTrakProducts.csv";

include "protected/global.php";

$count =1;
if(file_exists("/var/www/html/croncsv/OnTrakProducts.csv")){
    $lines =file($local_path);
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $k = explode(",",$break[0]);
        
//        echo "<pre>";
//        print_r($k);
//        echo "</pre>";

        $pack = array(
            "ProductKey"=>$k[9],
            "Name"=>str_replace("\"","",$k[11]),
            "Price"=>$k[12],
            "MinimumCharge"=>$k[13],
            "Notes"=>$k[14],
            "Inactive"=>$k[15],
            "PriceUnit"=>$k[16]

        );


        echo "<pre>";
        print_r($pack);
        echo "</pre>";

        //Old Array
//        $pack = array(
//            "ProductKey"=>$k[11],
//            "ProductID"=>$k[12],
//            "Name"=>$k[13],
//            "Price"=>$k[14],
//            "Description"=>$k[5],
//            "MinimumCharge"=>$k[16],
//            "Notes"=>$k[17],
//            "Inactive"=>$k[18],
//            "PriceUnit"=>$k[19],
//            "Inventory"=>$k[20]
//        );
        if($count !=1 && strlen(trim($k[9]))>0 ){//skip 1st line

            $check_ = $db->query("SELECT ProductKey FROM iwo_products WHERE ProductKey = $k[9]");
            if(count($check_)==0){
                $db->insert("iwo_products",$pack);
                echo "Product TO BE Inserted<br>";
                echo "<pre>";
                print_r($pack);
                echo "</pre>";
            }
        }
        $count++;
    }
}

unset($db);


?>