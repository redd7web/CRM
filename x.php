<?php
include "protected/global.php";
ini_set("display_errors",1);

function CustomerKey($customerKey){
    $customer = "N/A";
    global $db;
    $cust = $db->where("CustomerKey",$customerKey)->get("iwp_customers","Name");
    if(count($cust)>0){
        $customer = $cust[0]['Name'];
    }
    return $customer;
}


function Vendors($vKey){
    $customer = "N/A";
    global $db;
    $cust = $db->where("VendorKey",$vKey)->get("iwp_vendors","Name");
    if(count($cust)>0){
        $customer = $cust[0]['Name'];
    }
    return $customer;
}

$y = $db->query("SELECT CustomerKey,VendorKey FROM iwp_test_scale WHERE DATE(WeighIn) >='2020-05-01'");
if(count($y)>0){
    echo count($y)." stops found.<br/>";
    foreach($y as $m){
        echo CustomerKey($m['CustomerKey'])." ".Vendors($m['VendorKey'])."<br/><br/>";   
    }
    
}

?>