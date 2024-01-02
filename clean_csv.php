<?php
$file2 = "croncsv/weighin.csv";


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
 include "protected/global.php";
 ini_set("display_errors",1);
 
 
 
 
 if(file_exists($file2)){//weigh in
    $lines =file($file2);
    foreach($lines as $data){
        $break2 = explode("\r",$data);
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $k2 = explode(",",$break2[0]);
        
        print_r($k2);
        
        $wi_split2 = explode ("  ",$k2[24]);
        print_r($wi_split2[1]);
        $strip_quoations = str_replace("\"","",$k2[26]);
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
       
       
        if(strlen(trim($k2[23]))>0){
            $o = $db->query("SELECT * FROM iwp_test_scale WHERE ProductKey = $k2[23] AND WeighIn ='$wi2 $time_in_24_hour_format' ");
            if(count($o)>0){
                $db->where("TruckKey",$k2[20])->where("WeighIn","$wi2 $time_in_24_hour_format")->update("iwp_test_scale",$pacage);
                
            }else{
                echo "DNE<br/><br/>";
                 $db->insert("iwp_test_scale",$pacage);
                
            } 
        }
       
        //$message .= implode(",",$k2)." - ".date("Y-m-d H:i:s")."\r\n"; 
    }
    
   
    
    

    
    
}

?>