<?php
include "protected/global.php";
ini_set("display_errors",1);




echo "SELECT * FROM Inetform.ap_form_35831 ap_form_35831.id= $_GET[currentry]<br/>";
$lc = $db->query("SELECT element_10,element_16_1,element_16_2,element_27,element_31_1,element_31_2,element_41,element_45_1,element_45_2,element_55,element_60_1,element_60_2,element_69,element_73_1,element_73_2,element_83,element_87_1,element_87_2,element_97,element_101_1,element_101_2,element_111,element_115_1,element_115_2,element_125,element_129_1,element_129_2,element_139,element_162,element_163,element_164 FROM Inetforms.ap_form_35831 WHERE ap_form_35831.id= $_GET[currentry]");

$recip = array();
$extra="";
$message ="";
if( count($lc)>0 ){
    
    if(strlen(trim($lc[0]['element_164']))>0){
        $recip[] = $lc[0]['element_164'];
    }
    
    if(strlen(trim($lc[0]['element_163']))>0){
        $recip[] = $lc[0]['element_163'];
    }
    
    if(strlen(trim($lc[0]['element_162']))>0){
        $recip[] = $lc[0]['element_162'];
    }
    
    
    if(!empty($recip)){
        $extra = ",".implode(",",$recip);
    }
    
    $to = 'einfante@iwpusa.com'.$extra;
    $subject = 'Driver Inspection Report';
    $from = 'no-reply@iwpusa.com';
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $headers .= 'From: '.$from."\r\n".'Reply-To: '.$from."\r\n" .'X-Mailer: PHP/' . phpversion();
    
    if($lc[0]['element_16_1'] == 1){
        $message .=" Another discrepancy \r\n";
    }
    
    if(strlen(trim($lc[0]['element_10']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_10']."'/>\r\n";    
    }
    
    if($lc[0]['element_31_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_27']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_27']."'/>\r\n";    
    }
    
    if($lc[0]['element_45_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_55']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_55']."'/>\r\n";    
    }
    
    if($lc[0]['element_60_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_69']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_69']."'/>\r\n";    
    }
    
    if($lc[0]['element_73_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_69']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_69']."'/>\r\n";    
    }
    
    if($lc[0]['element_83_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_83']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_83']."'/>\r\n";    
    }
    
    if($lc[0]['element_87_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_83']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_83']."'/>\r\n";    
    }
    
    if($lc[0]['element_101_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_97']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_97']."'/>\r\n";    
    }
    
    if($lc[0]['element_115_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_111']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_111']."'/>\r\n";    
    }
    
    if($lc[0]['element_129_1'] == 1){
        $message .=" Another discrepancy YES \r\n";
    }
    
    if(strlen(trim($lc[0]['element_125']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_125']."'/>\r\n";    
    }
    
    if(strlen(trim($lc[0]['element_139']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_35831/files/".$lc[0]['element_139']."'/>\r\n";    
    }
    
    mail("einfante@iwpusa.com,edizon@iwpusa.com","INSPECTION REPORT",$message,$headers);
    print_r($lc); 
}




?>