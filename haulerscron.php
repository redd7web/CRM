
<?php
#!/usr/bin/php5 -q
date_default_timezone_set('America/Los_Angeles');
ini_set("display_errors",0);
//include "/var/www/html/bakery/protected/global.php";
//$local_path = "/home/iwp2/Desktop/Bimbo1.CSV.CSV";

include "/var/www/html/protected/global.php";


if(file_exists("croncsv/Haulers.csv")){
    $lines =file('/var/www/html/croncsv/haulers.csv');
    $count = 1;
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $k = explode(",",$break[0]);
        
        echo "<pre>";
        print_r($k);
        echo "</pre>";
        
        if( $count !=1){
                
            
            $check_ = $db->query("SELECT HaulerKey FROM iwp_haulers WHERE HaulerKey = $k[0] ");
            $pack = array(
                "HaulerKey"=>$k[0],
                "Name"=>$k[1],
                "AddressKey"=>$k[2],
                "Phone"=>$k[3],
                "Fax"=>$k[4],
                "ContactName"=>$k[5]
            );
            if(count($check_)==0){
                $db->insert("iwp_haulers",$pack);
            }
        }
        $count++;
    }
}

unset($db);


?>