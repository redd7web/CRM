<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";

ini_set('display_errors', 1); 
echo "origid".$_GET['origid']."<br/>";

$html = "";
//ini_set("display_errors",1);
if(isset($_GET['origid']) && strlen( trim($_GET['origid'])>0  ) ){
    $kl = $db->query("SELECT  ap_form_49773.element_184 as net_load_weight, ap_form_49773.element_136 as load_type,ap_form_43256.element_131 as ship_from, ap_form_43256.element_140 as trailer_number, ap_form_43256.element_18 as incoming_net, ap_form_43256.element_19 as wtcc, ap_form_43256.element_144 as tsl_wtn_pic,ap_form_49773.element_85,ap_form_49773.element_146_1,ap_form_49773.element_88, ap_form_49773.element_1 as dte,ap_form_43256.element_134 as wc,ap_form_49773.element_189 as net_weight,ap_form_49773.element_81,ap_form_49773.element_16,ap_form_49773.element_77 FROM Inetforms.ap_form_49773 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_43256.id = ap_form_49773.element_76 WHERE ap_form_49773.id=$_GET[currentry]");
    
    $orig = $db->query("SELECT * FROM Inetforms.ap_form_49773 WHERE ap_form_49773.id= $_GET[origid]");
     
    echo "<pre>";
    print_r($kl);
    echo "</pre>"; 
     
     if(strlen(trim($kl[0]['element_146_1']))>0 && $kl[0]['element_146_1'] !=0){ //are you completing from 44342? or 49773 ?
        switch($kl[0]['element_81']){//status of just submitted deconstruction form from 49773
            case 1://just submitted was set to pending
                $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_3='Original Pending' WHERE ap_form_49773.id=$_GET[origid]");
            break;
            case 2://just submitted was set to Rejected
                $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_3='Original Rejected' WHERE ap_form_49773.id=$_GET[origid]");               
            break;
            case 3://just submitted was set to Issue Detected
                $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_3='Original Issue Detected' WHERE id=$_GET[origid]");
            break;
            case 4://just submitted was set to Approved                
                $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_3 ='Original Approved' WHERE ap_form_49773.id=$_GET[origid]");// set duplicate to original approved
                $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_3='Approved',ap_form_49773.element_134='".$kl[0]['wc']."' WHERE ap_form_49773.id=$_GET[currentry]");  //update current to Approved  
                
                
                
                
                
                $html .="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\"><html><head><style type=\"text/css\"> @page{size: 8.5in 11in;margin: 0.5in;}</style></head><head><body><table style='width:90%;margin:auto;height:80%;'><tr><td colspan='3' style='text-align:center;'><img src='https://inet.iwpusa.com/img/iwp_logo2.png'/><br/><span style='font-weight:bold;'>IMPERIAL WESTERN PRODUCTS, INC.</span>\r\n<br/>86-600 Avenue 54\r\nCoachella, CA 92236\r\n<br/> (760)398-0815<br/><br/> \r\n \r\n<span style='font-weight:bold;'>CERTIFICATE OF DESTRUCTION</span></td></tr><tr><td style='text-align:left;vertical-align:top;' colspan='3'>".$kl[0]['dte']."<br/></td></tr><tr><td style='text-align:left;vertical-align:top;height:10px;' colspan='3'>To Whom It May Concern:\r\n<br/>\r\n<br/>\r\n<br/>\r\n<br/>\r\n<br/>\r\n<br/></td></tr><tr><td style='width:33%;vertical-align:top;'>Re: Waste Bakery Material from</td><td style='width:33%;vertical-align:top;'>Northstar Recycling\r\n<br/>101 Prairie Village Drive\r\n<br/>New Century, KS 66031\r\n<br/>LOAD #".$kl[0]['element_88']."</td><td style='width:33%;vertical-align:top;'>WC# ".$kl[0]['element_77']."</td></tr><tr><td style='text-align:left;' colspan='3'><p style='text-align:justify;'>This is to acknowledge the receipt of ".$kl[0]['net_load_weight']." pounds of (see attached material sheet) on ".$kl[0]['dte']." and to confirm that these items were destroyed.  If you have any questions, I can be reached at (760)398-0815 ext.234</p></td></tr><tr><td colspan='3' style='text-align:left;height:10px;'>Regards,\r\n\r\n<br/><br/> <br/><br/><img src='https://inet.iwpusa.com/img/signature.jpg'/>\r\n\r\n<br/><br/>Jason Cabanyog<br/><br/>\r\n\r\n Imperial Western Products, Inc.</td></tr></table><div class=\"phpToPDF-page-break\" style='width:100%;'></div><img src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$kl[0]['tsl_wtn_pic']."'/></body></html>";               
                $path = "deconstruction_certificates/";
                $new_string = "$_GET[currentry]_Deconstruction_Certificate".date("Ymd_his").".pdf";
                $file = "deconstruction_certificates/$new_string.pdf";      
                $pdf_options = array(
                  "source_type" => 'html',
                  "source" => $html,
                  "action" => 'save',
                  "save_directory" => $path,
                  "page_orientation" => 'portrait',
                  "file_name" => $new_string,
                  "page_size" => 'letter'
                );
                phptopdf($pdf_options);  
                $db->query("UPDATE Inetforms.ap_form_49773 SET cert_link ='$new_string' WHERE id= $_GET[currentry]"); 
                
                if($kl[0]['load_type'] == 3){
                    $new_string222 = "$_GET[currentry]_Deconstruction_Certificate_2".date("Ymd_his").".pdf";
                    $dogfood_cert_link_2 = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\"><html><head><style type=\"text/css\">body{background:#E8E8E8;} @page{size: 8.5in 11in;margin: 0.5in;}</style></head><head><body><table style='width:90%;margin:auto;height:80%;'><tr><td style='text-align:left;'>To Whom It May Concern :<br/>RE: Waste Bakery Material From: Pet Food Material from Mars<br/>This is to acknowledge the receipt of products outlined in the supply agreement between Co-West Commodities, Inc., Northstar Recycling Company, Inc. and Mars Pet Care signed on ".date("m-d-Y")." (date) to confirm that these Pet Food Materials were ground, destroyed, and further heat processed into a feed for non-ruminant animal consumption,  These products are not to be used for any purpose other than non-ruminant animal feed.  If you have any questions, our Safety and Compliance Department can be reached at (760) 398-0815.</td></tr><tr><td style='text-align:left;color:#717173;padding-left:5px;font-weight:bold;'>Shipdate: ".date("m-d-Y")."<br/>Net Load Weight: ".$kl[0]['net_load_weight']."<br/>Origin: ".$kl[0]['ship_from']."<br/>Trailer Number: <br/>".$kl[0]['trailer_number']."</td></tr><tr><td style='text-align:left;'><img src='https://inet.iwpusa.com/img/second_cod_bottom.jpg'></td></tr></table></body><div id='break' style='page-break-after:always;width:100%;'></div><img src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$kl[0]['tsl_wtn_pic']."' /></html>";
                    $pdf_options2 = array(
                      "source_type" => 'html',
                      "source" => $dogfood_cert_link_2,
                      "action" => 'save',
                      "save_directory" => $path,
                      "page_orientation" => 'portrait',
                      "file_name" => $new_string222,
                      "page_size" => 'letter'
                    );
                    phptopdf($pdf_options2);  
                    $db->query("UPDATE Inetforms.ap_form_49773 SET cer_link_2='$new_string222' WHERE id= $_GET[currentry]"); 
                }      
                               
                break;
        }
        header("Location:PaymentDogFood.php"); 
     }else{
        /*echo $_GET['currentry'];
        
        print_r($kl);

        */
        
        $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_3 ='Completed',ap_form_49773.status=4 WHERE ap_form_49773.id =$_GET[currentry]");
        //$db->query("UPDATE  Inetforms.ap_form_4434 SET 2 WHERE id=$_GET[origid]");//remove 44342 entry        
        header("Location:CompletedDogFood.php");  
     }
    
    
    
    
    
    
    
    
    
    
}else{
    echo "Original Request not set.<br/>";
}
?>