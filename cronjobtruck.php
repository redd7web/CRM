
<?php
//#!/usr/bin/php5 -q
ini_set("display_errors",1);


$k = 1;
switch($k){
    case 1:
        include "/var/www/html/protected/global.php";
        $file = "/var/www/html/croncsv/trucks.csv";
        //$file2 = "/var/www/html/croncsv/weighin.csv";
    break;
    default:
        include "protected/global.php";
        $file = "croncsv/trucks.csv";
        //$file2 = "croncsv/weighin.csv";
    break;
}

$count =1;
if(file_exists($file)){
    $lines =file($file);
   
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $line = explode(",",$break[0]);
        
        $acquired =  explode("  ",$line[25]);
        $acq_date = date("Y-m-d", strtotime($acquired[0]) );
        $acq_time  = date("H:i:s", strtotime("$acquired[1]"));
        
        if(strlen(trim($line[26]))>0){
            $expired = explode("  ",$line[26]);
            $exp_date = date("Y-m-d", strtotime($expired[0]) );
            $exp_time = date("H:i:s", strtotime("$expired[1]"));
        }else{
            $exp_date = "0000-00-00";
            $exp_time = "00:00:00";
        }
        
        
        $insurance = explode("  ",$line[38]);
        $insu_date = date("Y-m-d", strtotime($insurance[0]) );
        $Insu_time = date("H:i:s", strtotime($insurance[1]) );
        
        
        echo "<pre>";
        print_r($line);
        echo "</pre>";
         
        $package = array(
            "TruckKey"=>$line[22],
            "TruckID"=>str_replace('"','',$line[23]),
            "Tare"=>$line[24],
            "TareAcquired"=>"$acq_date $acq_time",
            "TareExpiration"=>"$exp_date $exp_time",
            "TareType"=>$line[27],
            "Name"=>str_replace('"','',$line[28]),
            "MinimumWeight"=>$line[29],
            "MaximumWeight"=>$line[30],
            "RadioTagID"=>$line[31],
            "CustomerKey"=>$line[32],
            "JobKey"=>$line[33],
            "ProductKey"=>$line[34],
            "HaulerKey"=>$line[35],
            "Transient"=>$line[36],
            "Inactive"=>$line[37],
            "InsuranceExpiration"=>"$insu_date $Insu_time",
            "TrailerID1"=>str_replace('"','',$line[39]),
            "TrailerID2"=>$line[40],
            "TrailerID3"=>$line[41],
            "VendorKey"=>$line[42],
            "TrailerKey"=>$line[43]
        );
        
        echo "<pre>";
        print_r($package);
        echo "</pre>";
        
        
        $p = $db->where("TruckKey",$line[22])->get("iwp_scale_truck");
         if(count($p)>0){
            $db->where("TruckKey",$line[22])->update("iwp_scale_truck",$package);
            echo "updated!<br/>";
         }else{
             /*/**/if($db->insert("iwp_scale_truck",$package) ){
                echo "Inserted perfectly";
            }
         }
        
    }
}else{
    echo "DNE<br/>";
}

?>
