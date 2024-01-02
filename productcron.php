
<?php
#!/usr/bin/php5 -q
date_default_timezone_set('America/Los_Angeles');
ini_set("display_errors",1);
include "/var/www/html/protected/global.php";
//$local_path = "/var/www/html/croncsv/Products.csv";

//include "protected/global.php";

$count =1;
if(file_exists("/var/www/html/croncsv/Products.csv")){
    $lines =file($local_path);
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $k = explode(",",$break[0]);
        
        echo "<pre>";
        print_r($k);
        echo "</pre>";
        
        $pack = array(
            "ProductKey"=>$k[0],
            "ProductID"=>$k[1],
            "Name"=>$k[2],
            "Price"=>$k[3],
            "Description"=>$k[4],
            "MinimumCharge"=>$k[5],
            "Notes"=>$k[6],
            "Inactive"=>$k[7],
            "PriceUnit"=>$k[8],
            "Inventory"=>$k[9]
        );
        if($count !=1 && strlen(trim($k[0]))>0  && count($k)>3 ){//skip 1st line
            $check_ = $db->query("SELECT ProductKey FROM iwo_products WHERE ProductKey = $k[0]");
            if(count($check_)==0){
                $db->insert("iwo_products",$pack);
            }
        }
        $count++;
    }
}

unset($db);


?>