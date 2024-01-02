//#!/usr/bin/php5 -q
<?php

ini_set("display_errors",1);


$k = 0;
switch($k){
    case 1:
        include "/var/www/html/protected/global.php";
        $file = "/var/www/html/croncsv/vendors.csv";
       
    break;
    default:
        include "protected/global.php";
        $file = "croncsv/vendors.csv";
    break;
}

$count =1;


echo "<br/>-------------------------------------<br/>";

if(file_exists($file)){
    $lines =file($file);
   
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $k = explode(",",$break[0]);
       
      
        
        
        
        echo "<pre>";
        print_r($k);
        echo "</pre>";
        $vname = str_replace('"','',$k[15]);
        $vendor = array(
            "VendorKey"=>$k[13],
            "VendorID"=>$k[14],
            "Name"=>$vname,
            "BillToAddressKey"=>$k[16],
            "ShipToAddressKey"=>$k[17],
            "Phone"=>$k[18],
            "Fax"=>$k[19],
            "ContactName"=>$k[20],
            "Inactive"=>$k[21],
            "DiscountKey"=>$k[22],
            "Notes"=>$k[23],
            "InboundTicket"=>$k[24],
            "OutboundTicket"=>$k[25]
        );
        
        $i = $db->query("SELECT * FROM iwp_vendors WHERE VendorKey = $k[13]");
        if(count($i)>0){
            $db->where("VendorKey",$k[13])->update("iwp_vendors",$vendor);
        }else{
            $db->insert("iwp_vendors",$vendor);
        }
    }
        
    
}else{
    echo "DNE<br/>";
}

?>
