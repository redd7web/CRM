<?php

include "protected/global.php";



$outbound = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void  FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND CustomerKey NOT IN (477,496,518,475,519,479)  AND ProductKey IN(4,5,6,15,17,23,49,50,51,69,78,80,88)   ");

if(count($outbound)>0){
    foreach($outbound as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);   
         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key            
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
        //
        $check_mach_forms = $db->query("SELECT id FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        if(count($check_mach_forms)>0){
            //Updating Where clause to only have one instance of Where
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi_fix,// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        } 
    }
}



$inbound = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void FROM iwp_test_scale WHERE ShipMode LIKE '%R%' AND ProductKey IN (7,22,24,25,27,28,30,31,32,34,41,42,43,44,54,57,58,59,60,62,63,65,67,68,72,75,79,83,84,87,89) ");//  AND ProductKey IN (7,22,24,25,27,28,31,32,34,41,42,43,44,57,58,59,60,62,63,65,67,68,72,75,79,84,87,89)  

if(count($inbound)>0){
    foreach($inbound as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);  

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key   
            
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
        $check_mach_forms = $db->query("SELECT id FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        
        echo "check: SELECT TruckKey FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' <br/> ";
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi_fix,// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
}


$outboundgrease = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void  FROM iwp_test_scale WHERE ShipMode LIKE '%S%'AND CustomerKey IN ( 521, 508 ) ");

if(count($outboundgrease)>0){
    foreach($outboundgrease as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);  

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key   
            
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
        $check_mach_forms = $db->query("SELECT TruckKey,id FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi_fix,// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
}


 $outboundbio = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void  FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND ProductKey IN(9,10,11,12,13,14,18,26,28,36,37,38,39,40,45,47,48,54,55,56,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,79,80,81)  AND CustomerKey NOT IN (477,496,518,475,519,479) ");
 
 if(count($outboundbio>0) ){
    foreach($outboundbio as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);  

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
            "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key   
            
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
        $check_mach_forms = $db->query("SELECT id FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>str_replace(' ','',$wi[0]),// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }


 $outboundmxgrease = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void  FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND ProductKey IN (20,40,47) AND CustomerKey IN(477,496,518,475,519,479)");
 
 if(count($outboundmxgrease)>0){
    foreach($outboundmxgrease as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);  

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
           "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key   
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
        $check_mach_forms = $db->query("SELECT id FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi_fix,// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }
 
 $outboundmx = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void  FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND  CustomerKey IN(496,477,518,475,519,479) AND ProductKey IN (88) ");
 
 if(count($outboundmx)>0){
    foreach($outboundmx as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);  

         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
           "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key   
            
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
        $check_mach_forms = $db->query("SELECT TruckKey FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi_fix,// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }
 
 $ingrease = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void  FROM iwp_test_scale WHERE ShipMode LIKE '%R%'  AND ProductKey IN(20,29,82,90) ");
 if(count($ingrease)>0){
    foreach($ingrease as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);  
            
         if( strlen(trim($k['VendorKey']))>0 || $k['VendorKey'] != NULL ){
            $cc = Vendors($k['VendorKey']);
         }else if( strlen(trim($k['CustomerKey']))>0  || $k['CustomerKey'] != NULL  ){
            $cc =  0;
         }else{
            $cc =  "N/A";
         }   
            
            
         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
           "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key   
            
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
        $check_mach_forms = $db->query("SELECT id FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi_fix,// weigh in date     
            );
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }
 
 
 $rwater = $db->query("SELECT WeighIn,WeighOut,VendorKey,tk,TruckKey,UF1Data,ProductKey,Gross,Tare,Net,ShipMode,UserName,Void FROM iwp_test_scale WHERE ProductKey  IN(16,19,46,53,77,91,92)");
 if(count($rwater)>0){
    foreach($rwater as $k){
         $wi = explode(' ',"$k[WeighIn]");
         $wo = explode(' ',"$k[WeighOut]");
         $wi_fix = str_replace(' ','',$wi[0]);  
            
         if( strlen(trim($k['VendorKey']))>0 || $k['VendorKey'] != NULL ){
            $cc = Vendors($k['VendorKey']);
         }else if( strlen(trim($k['CustomerKey']))>0  || $k['CustomerKey'] != NULL  ){
            $cc =  0;
         }else{
            $cc =  "N/A";
         }   
            
         $machforms = array(  
            "element_1"=>$k['tk'],//weight certificate
            "element_2"=>$k['TruckKey'],// truck key
           "element_3"=>$k['VendorKey'],//buyer / seller
            "element_4"=>$k['UF1Data'],//release number
            "element_5"=>$k['ProductKey'],//Product Key   
            
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
        $check_mach_forms = $db->query("SELECT id FROM Inetforms.ap_form_64000 WHERE ap_form_64000.element_2 =$k[TruckKey] AND ap_form_64000.element_7='$wi_fix' AND ap_form_64000.element_6 ='$wi[1]' ");
        
        if(count($check_mach_forms)>0){
            $db->where("id",$check_mach_forms[0]['id'])->update("Inetforms.ap_form_64000",$machforms);
        }else{
            $machforms += $extra = array("date_created"=>date("Y-m-d H:i:s"), "element_6"=>$wi[1],//weigh in time
            "element_7"=>$wi_fix,// weigh in date     
            );
         
            //echo "source ?: ".$machforms['element_2']."<br/>";
            $db->insert("Inetforms.ap_form_64000",$machforms);
        }
    }
 }


?>