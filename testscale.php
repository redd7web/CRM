//#!/usr/bin/php5 -q
<?php

$product_check = array(20,29,82,90,16,19,46,53,77,91,92);

ini_set("display_errors",1);
 $header = "From: iwppassreset@iwpusa.com\r\n";
    $header .= "Reply-To: No-reply@iwpusa.com\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"1\"\r\n\r\n";


function update_row($column,$value,$weighIn,$productKey){
    global $db;
    $package = array(  "$column"=>$value );
    //UPDATE iwp_test_scale SET Units ='$strip_quoations' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] 
    $db->where('WeighIn',$weighIn)->where('ProductKey',$productKey)->update('iwp_test_scale',$package);
}

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
    return $vKey;
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
ob_start();

if(file_exists($file2)){//weigh in
    $lines =file($file2);
    echo "<pre>";
    //var_dump($lines);
    echo "</pre>";
    foreach($lines as $break2){
        echo "<br/>**********************************<br/>"; 
        $k2 = explode(",",$break2);
         
       
        $wi_split2 = explode ("  ",$k2[24]);
        //print_r($wi_split2[1]);
        $strip_quoations = str_replace("\"","",$k[26]);
        //print_r($wi_split2);
        $wi2 = date("Y-m-d", strtotime($wi_split2[0]) );
        
        $time_in_24_hour_format  = date("H:i:s", strtotime("$wi_split2[1]"));
        $time_break = explode(":","$time_in_24_hour_format");
        $date_break = explode("-","$wi2");
      
       $sm = str_replace('"',"",$k2[37]);
       $sm = str_replace("'",'',$sm);
      echo "$sm <br/>";
        
         echo "<pre>";
        //var_dump($k2);
        echo "</pre>";
        
        
         $pacage = array(
            "TruckKey"=>$k2[20],
            "CustomerKey"=>$k2[21],
            "JobKey"=>$k2[22],
            "ProductKey"=>$k2[23],
            "WeighIn"=>"$wi2 $time_in_24_hour_format",
            "Units"=>$strip_quoations,
            "ShipMode"=>trim($sm),
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
         
         
        if($wi2 !="1969-12-31"){
            echo "<pre>";
            var_dump($pacage);
            echo "</pre>";
            $db->insert("iwp_test_scale",$pacage);
            echo "<br/>**********************************<br/>";    
        }
        
    }
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
                    $db->where("TruckKey",$k[1])->where("WeighIn",$wi.' '.$time_in_24_hour_formatIn)->update("iwp_test_scale",$pack);  
                    
                    if(strlen(trim($pl[0]['CustomerKey'])) <=0 ){
                        update_row("CustomerKey",$k[2],"$wi $time_in_24_hour_formatIn",$k[4]);   
                    }
                    
                    if(strlen(trim($pl[0]['JobKey'])) <=0 ){
                        update_row("JobKey",$k[3],"$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['ProductKey'])) <=0 ){
                        update_row("ProductKey",$k[4],"$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['Units'])) <=0 ){
                        update_row("Units","$strip_quoations","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['Notes'])) <=0 ){
                        update_row("Notes","$k[14]","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['UF1Data'])) <=0 ){
                        update_row("UF1Data","$k[16]","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['UF1Label'])) <=0 ){
                        update_row("UF1Label","$k[17]","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['UF2Data'])) <=0 ){
                        update_row("UF2Data","$k[18]","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['UF2Label'])) <=0 ){
                        update_row("UF2Label","$k[46]","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['UF3Data'])) <=0 ){
                        update_row("UF3Data","$k[47]","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['UF3Label'])) <=0 ){
                        update_row("UF3Label","$k[19]","$wi $time_in_24_hour_formatIn",$k[4]);
                    }
                    
                    if(strlen(trim($pl[0]['WeighOut'])) <=0  || $pl[0]['WeighOut'] == NULL ){
                        echo "UPDATE iwp_test_scale SET WeighOut ='$wo $time_in_24_hour_formatOut' WHERE WeighIn ='$wi $time_in_24_hour_formatIn' AND ProductKey =$k[4] ";
                        update_row("WeighOut","$wo","$wi $time_in_24_hour_formatIn",$k[4]);
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



 

 
 $s2 = ob_get_contents();
 //mail("edizon@iwpusa.com","testscale errors",$s2,$headers);
 
?>
