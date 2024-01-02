//#!/usr/bin/php5 -q
<?php

$product_check = array(20,29,82,90,16,19,46,53,77,91,92);

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

function productKey($productKey){
    global $db;
    
    if($productKey !=NULL){
        $trans = $db->query("SELECT Name FROM iwo_products WHERE ProductKey = $productKey");
        if(count($trans)>0){
            return $trans[0]['Name'];
        }else{
            return "N/A";
        }
    }else{
        return "N/A";
    }
    
}

function ftime($time,$f) {
    if (gettype($time)=='string')	
	  $time = strtotime($time);	 
  
    return ($f==24) ? date("G:i:s", $time) : date("g:i:s a", $time);	
}

$k = 1;
switch($k){
    case 1:
        include "/var/www/html/protected/global.php";
        $file = "/var/www/html/croncsv/transaction.csv";
        $file2 = "/var/www/html/croncsv/weighin.csv";
    break;
    default:
        include "protected/global.php";
        $file = "croncsv/transaction.csv";
        $file2 = "croncsv/weighin.csv";
    break;
}

$count =1;


if(file_exists($file2)){//weigh in
    $lines =file($file2);
    foreach($lines as $data){
        $break2 = explode("\r",$data);
        $k2 = explode(",",$break2[0]);
        
        print_r($k2);
        
        $wi_split2 = explode ("  ",$k2[24]);
        print_r($wi_split2[1]);
        $strip_quoations = str_replace("\"","",$k[26]);
        print_r($wi_split2);
        $wi2 = date("Y-m-d", strtotime($wi_split2[0]) );
        //echo "SELECT * FROM iwp_test_scale WHERE TruckKey = $k2[20] AND WeighIn ='$wi2' <br/>";
        $time_in_24_hour_format  = date("H:i:s", strtotime("$wi_split2[1]"));
        $time_break = explode(":","$time_in_24_hour_format");
        $date_break = explode("-","$wi2");
      
       $sm = str_replace("\"","",$k2[37]);
      
        
        if( $k2[37] == "S"){
            $cusomter_vendor = CustomerKey($k2[21]);
        }else if($k2[37]){
            $cusomter_vendor = Vendors($k2[23]);
        } 
        
        
        
         $pacage = array(
            "TruckKey"=>$k2[20],
            "CustomerKey"=>$k2[21],
            "JobKey"=>$k2[22],
            "ProductKey"=>$k2[23],
            "WeighIn"=>"$wi2 $time_in_24_hour_format",
            "Units"=>$strip_quoations,
            "ShipMode"=>$sm,
            "Notes"=>$k2[27],
            "UF1Data"=>$k2[28],
            "UF1Label"=>$k2[29],
            "UF2Data"=>$k2[30],
            "UF2Label"=>$k2[31],
            "UF3Data"=>$k2[32],
            "UF3Label"=>$k2[33],
            "VendorKey"=>$k2[34],
            "Manual"=>$k2[35],
            "TrailerKey"=>$k2[36],
            "Net"=>$k2[25]
        );
        
       
        
       
        /* */
        echo "<pre>";
        print_r($pacage);
        echo "</pre>";
       
        if(strlen(trim($k2[23]))>0){
            $o = $db->query("SELECT * FROM iwp_test_scale WHERE ProductKey = $k2[23] AND WeighIn ='$wi2 $time_in_24_hour_format' ");
            if(count($o)>0){
                $db->where("TruckKey",$k2[20])->where("WeighIn","$wi2 $time_in_24_hour_format")->update("iwp_test_scale",$pacage);
            }else{
                if( strlen(trim($k2[28])) >0  ){
                     echo " ship mode : $k2[28] ?? <br/> ";
                    $db->insert("iwp_test_scale",$pacage);
                }
                
            } 
        }
       
        $message .= implode(",",$k2)." - ".date("Y-m-d H:i:s")."\r\n"; 
    }
    
   
    
    

    $method = (file_exists("scale_weighi_log.txt")) ? 'a' : 'w';
    $fh = fopen("scale_weighi_log.txt",$method);
    fwrite($fh, $message);
    fclose($fh);
    
}else{
    echo "DNE<br/>";
}


echo "<br/>-------------------------------------<br/>";

if(file_exists($file)){
    $file = fopen("$file", "r");
    if(!feof($file)) { fgetcsv($file); }
   // continue reading the rest of the file
    while(! feof($file)){
        $k = fgetcsv($file);
        
       
        
        
        (int)$var =str_replace("\"","",$k[0]);//transaction key
        
        $wi_split = explode ("  ",$k[5]);
        $wo_split = explode ("  ",$k[6]);
         
        
        
        $wi = date("Y-m-d", strtotime($wi_split[0]) );
        $time_in_24_hour_formatIn  = date("H:i:s", strtotime("$wi_split[1]"));
        
        
        
        $wo = date("Y-m-d", strtotime($wo_split[0]) );
         $time_in_24_hour_formatOut  = date("H:i:s", strtotime("$wo_split[1]"));
        
        $sm = str_replace("\"","",$k[13]);
        
        $pack = array(
            "TransactionKey"=>$var,
            "TruckKey"=>$k[1],
            "CustomerKey"=>$k[2],
            "JobKey"=>$k[3],
            "ProductKey"=>$k[4],
            "WeighIn"=>"$wi $time_in_24_hour_formatIn",
            "WeighOut"=>"$wo $time_in_24_hour_formatOut",
            "Gross"=>$k[7],
            "Tare"=>$k[8],
            "Net"=>$k[9],
            "TareType"=>$k[10],
            "Units"=>$strip_quoations,
            "Void"=>$k[12],
            "ShipMode"=>$sm,
            "Notes"=>$k[14],
            "UserName"=>str_replace("\"","",$k[15]),
            "UF1Data"=>$k[16],
            "UF1Label"=>$k[17],
            "UF2Data"=>$k[18],
            "UF2Label"=>$k[19],
            "UF3Data"=>$k[20],
            "UF3Label"=>$k[21],
            "VendorKey"=>$k[22],
            "Manual"=>$k[23],
            "TrailerKey"=>$k[24],
            "TrailerTare"=>$k[25],
            "TrailerTareType"=>$k[26],
            "tk"=>$var
        );
        
        echo "<pre>";
        print_r($pack);
        echo "</pre>";
        if(strlen(trim($k[1]))>0){
            
                    $pl = $db->where("ProductKey",$k[4])->where("WeighIn","$wi $time_in_24_hour_formatIn")->get("iwp_test_scale");
                    
                    if(count($pl)>0 && strlen(trim($k[4]))>0  ){
                        $db->where("TruckKey",$k[1])->where("WeighIn",$wi." ".$time_in_24_hour_formatIn)->update("iwp_test_scale",$pack);  
                        
                        if(strlen(trim($pl[0]['CustomerKey'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET CustomerKey ='$k[2]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['JobKey'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET JobKey =$k[3] WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['ProductKey'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET ProductKey =$k[4] WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        
                        if(strlen(trim($pl[0]['Units'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET Units ='$strip_quoations' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['Notes'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET Notes ='$k[14]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['UF1Data'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET UF1Data ='$k[16]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey ='$k[4]' ");
                        }
                        
                        if(strlen(trim($pl[0]['UF1Label'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET UF1Label ='$k[17]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['UF2Data'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET UF2Data ='$k[18]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey ='$k[4]' ");
                        }
                        
                        if(strlen(trim($pl[0]['UF2Label'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET UF2Label ='$k[46]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['UF3Data'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET UF3Data ='$k[47]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['UF3Label'])) <=0 ){
                            $db->query("UPDATE iwp_test_scale SET UF3Label ='$k[19]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['WeighOut'])) <=0  || $pl[0]['WeighOut'] == NULL ){
                            echo "UPDATE iwp_test_scale SET WeighOut ='$wo $time_in_24_hour_formatOut' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ";
                            $db->query("UPDATE iwp_test_scale SET WeighOut ='$wo $time_in_24_hour_formatOut' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        
                        if(strlen(trim($pl[0]['Manual'])) <=0 || $pl[0]['Manual'] == NULL ){
                            $db->query("UPDATE iwp_test_scale SET Manual ='$k[23]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['Gross'])) <=0 || $pl[0]['Gross'] == NULL ){
                            //echo "UPDATE iwp_test_scale SET Gross =$k[34] WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[31] ";
                            $db->query("UPDATE iwp_test_scale SET Gross =$k[7] WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['Tare'])) <=0 || $pl[0]['Tare'] == NULL ){
                            $db->query("UPDATE iwp_test_scale SET Tare =$k[8] WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['Net'])) <=0 || $pl[0]['Net'] == NULL ){
                            $db->query("UPDATE iwp_test_scale SET Net =$k[9] WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        
                        if(strlen(trim($pl[0]['UserName'])) <=0 || $pl[0]['UserName'] == NULL ){
                            $db->query("UPDATE iwp_test_scale SET UserName ='$k[15]' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        }
                        $db->query("UPDATE iwp_test_scale SET tk = $var  WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ");
                        
                        
                    }else{
                        $db->insert("iwp_test_scale",$pack);
                    }
        
        }
        
    }
    fclose($file);

}



 


$outbound = $db->query("SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND CustomerKey NOT IN (477,496,518,475,519,479)  AND ProductKey IN(4,5,6,15,17,23,49,50,51,69,78,80,88)   ");

if(count($outbound)>0){
    foreach($outbound as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>CustomerKey($k['CustomerKey']),//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>str_replace("\"","",$k['ShipMode']),// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            //Updating Where clause to only have one instance of Where
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        } 
    }
}



$inbound = $db->query("SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%R%' AND ProductKey IN (7,22,24,25,27,28,30,31,32,34,41,42,43,44,54,57,58,59,60,62,63,65,67,68,72,75,79,83,84,87,89) ");//  AND ProductKey IN (7,22,24,25,27,28,31,32,34,41,42,43,44,57,58,59,60,62,63,65,67,68,72,75,79,84,87,89)  

if(count($inbound)>0){
    foreach($inbound as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>Vendors($k['VendorKey']),//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key
            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>str_replace("\"","",$k['ShipMode']),// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        echo "check: SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' <br/> ";
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
}


$outboundgrease = $db->query("SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%S%'AND CustomerKey IN ( 521, 508 ) ");

if(count($outboundgrease)>0){
    foreach($outboundgrease as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>CustomerKey($k['CustomerKey']),//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key
            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>$k['ShipMode'],// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
}


 $outboundbio = $db->query("SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND ProductKey IN(9,10,11,12,13,14,18,26,28,36,37,38,39,40,45,47,48,54,55,56,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,79,80,81)  AND CustomerKey NOT IN (477,496,518,475,519,479) ");
 
 if(count($outboundbio>0) ){
    foreach($outboundbio as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>CustomerKey($k['CustomerKey']),//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key
            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>$k['ShipMode'],// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }


 $outboundmxgrease = $db->query("SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND ProductKey IN (20,40,47) AND CustomerKey IN(477,496,518,475,519,479)");
 
 if(count($outboundmxgrease)>0){
    foreach($outboundmxgrease as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>CustomerKey($k['CustomerKey']),//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key
            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>$k['ShipMode'],// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }
 
 $outboundmx = $db->query("SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND  CustomerKey IN(496,477,518,475,519,479) AND ProductKey IN (88) ");
 
 if(count($outboundmx)>0){
    foreach($outboundmx as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>CustomerKey($k['CustomerKey']),//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key
            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>$k['ShipMode'],// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }
 
 $ingrease = $db->query("SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%R%'  AND ProductKey IN(20,29,82,90) ");
 if(count($ingrease)>0){
    foreach($ingrease as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");
            
         if( strlen(trim($k['VendorKey']))>0 || $k['VendorKey'] != NULL ){
            $cc = Vendors($k['VendorKey']);
         }else if( strlen(trim($k['CustomerKey']))>0  || $k['CustomerKey'] != NULL  ){
            $cc =  CustomerKey($k['CustomerKey']);
         }else{
            $cc =  "N/A";
         }   
            
            
         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>$cc,//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key
            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>$k['ShipMode'],// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }
 
 
 $rwater = $db->query("SELECT * FROM iwp_test_scale WHERE ProductKey  IN(16,19,46,53,77,91,92)");
 if(count($rwater)>0){
    foreach($rwater as $k){
         $wi = explode(" ","$k[WeighIn]");
         $wo = explode(" ","$k[WeighOut]");
            
         if( strlen(trim($k['VendorKey']))>0 || $k['VendorKey'] != NULL ){
            $cc = Vendors($k['VendorKey']);
         }else if( strlen(trim($k['CustomerKey']))>0  || $k['CustomerKey'] != NULL  ){
            $cc =  CustomerKey($k['CustomerKey']);
         }else{
            $cc =  "N/A";
         }   
            
         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>$cc,//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>productKey($k['ProductKey']),//Product Key
            
            "element_8"=>$wo[0],//weight out date
            "element_9"=>$wo[1],//weight out time
            "element_10"=>$k['Gross'],//gross
            "element_11"=>$k['Tare'],//tare
            "element_12"=>$k['Net'],//net
            "element_13"=>$k['ShipMode'],// shipmode
            "element_14"=>$k['UserName'],//Username
            "element_15"=>$k['Void'],//void
            "date_updated"=>date("Y-m-d H:i:s")
        );
        $check_mach_forms = $db->query("SELECT * FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi[0],// weigh in date     
            );
         
            echo "source ?: ".$machforms['element_2']."<br/>";
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }
 
 
 
 
?>
