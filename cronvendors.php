<?php
include "protected/global.php";
ini_set("display_errors",1);

if(file_exists("/var/www/html/croncsv/vendors.csv")){
    $lines =file('/var/www/html/croncsv/vendors.csv');
    $count = 1;
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $k = explode(",",$break[0]); 
         echo "<pre>";
        print_r($k);
       echo "</pre>";
        
        $pack = array(
            "VendorKey"=>$k[13],
            "VendorID"=>str_replace('"',"",$k[14]),
            "Name"=>str_replace("\"","",$k[15]),
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
         echo "<pre>";
        print_r($pack);
        echo "</pre>";
        
        if($count !=1  ){//skip 1st line
        
            if( strlen(trim($k[13])) >0 ){
               $check_ = $db->query("SELECT VendorKey FROM iwp_vendors WHERE VendorKey = $k[13]");
                if(count($check_)==0){
                    $db->insert("iwp_vendors",$pack);
                }else{
                    $db->where("VendorKey",$k[13])->update("iwp_vendors",$pack);
                } 
            }
        
            
        }
        $count++;
    }
}

?>