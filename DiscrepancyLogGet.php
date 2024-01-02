<?php
include "protected/global.php";
ini_set("display_errors",1);


$to = 'einfante@iwpusa.com';
$subject = 'Driver Inspection Log Report';
$from = 'no-reply@iwpusa.com';
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Create email headers
$headers .= 'From: '.$from."\r\n".'Reply-To: '.$from."\r\n" .'X-Mailer: PHP/' . phpversion();
$message ="";
$log_report = $db->query("SELECT element_10,element_16_1,element_16_2,element_146,element_27,element_31_1,element_31_2,element_148,element_41,element_45_1,element_45_2,element_150,element_55,element_60_1,element_60_2,element_152,element_69,element_73_1,element_73_2,element_154,element_83,element_87_1,element_87_2,element_156,element_97,element_101_1,element_101_2,element_158,element_111,element_115_1,element_115_2,element_111,element_115_1,element_115_2,element_160,element_125,element_129_1,element_129_2,element_162,element_139,element_187_1,element_187_2,element_190,element_182,element_204_1,element_204_2,element_164,element_200,element_188_1,element_188_2,element_206,element_217,element_221_1,element_221_2,element_223,element_233,element_237_1,element_237_2,element_239,element_249,element_253_1,element_253_2,element_255,element_259_1,element_259_2,element_257,element_274_1,element_274_2,element_272,element_291_1,element_291_2,element_287,element_305_1,element_305_2,element_303,element_317,element_332,element_333,element_334,element_335 FROM Inetforms.ap_form_17457 WHERE id=$_GET[currentry]");


if(count($log_report)>0){
    if(strlen(trim($log_report[0]['element_10']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_10']."'/>\r\n";
        $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_145_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }
    
    if($log_report[0]['element_16_1'] == 1 && strlen(trim($log_report[0]['element_146']))>0 ){
       $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_146']."'/>\r\n";
      
    }
    
    if(strlen(trim($log_report[0]['element_27']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_27']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_147_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_147_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_31_1'] == 1 && strlen(trim($log_report[0]['element_148']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_148']."'/>\r\n";
       
    }//
    
    if(strlen(trim($log_report[0]['element_41']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_41']."'/>\r\n";
        $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_147_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }
    
    if($log_report[0]['element_45_1'] == 1 && strlen(trim($log_report[0]['element_150']))>0){
        $message .="\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_150']."'/>\r\n";
        
    }
    
    if(strlen(trim($log_report[0]['element_55']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_55']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_149_1'>Click here to complete this Discrepency.</a>\r\n";
    }
    
    if($log_report[0]['element_60_1'] == 1 && strlen(trim($log_report[0]['element_152']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_152']."'/>\r\n";
        
    }
    
    if(strlen(trim($log_report[0]['element_69']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_69']."'/>\r\n";
        $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_151_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }
    
    if($log_report[0]['element_73_1'] == 1 && strlen(trim($log_report[0]['element_55']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['154']."'/>\r\n";
        
    }
    
    if(strlen(trim($log_report[0]['element_83']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_83']."'/>\r\n";
        $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_153_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }
    
    if($log_report[0]['element_87_1'] == 1 && strlen(trim($log_report[0]['element_156']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_156']."'/>\r\n";
        
    }
    
    if(strlen(trim($log_report[0]['element_97']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_97']."'/>\r\n";
        $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_155_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    
    if($log_report[0]['element_101_1'] == 1 && strlen(trim($log_report[0]['element_158']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_158']."'/>\r\n";
        
    }//
    
    if(strlen(trim($log_report[0]['element_111']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_111']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_157_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_157_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_115_1'] == 1 && strlen(trim($log_report[0]['element_160']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_160']."'/>\r\n";
       
    }//
    
    if(strlen(trim($log_report[0]['element_125']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_125']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_159_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_159_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_129_1'] == 1  && strlen(trim($log_report[0]['element_162']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_162']."'/>\r\n";
        
    }//
    
    if(strlen(trim($log_report[0]['element_139']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_139']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_161_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_161_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_187_1'] == 1 &&  strlen(trim($log_report[0]['element_190']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_190']."'/>\r\n";
    }//
    
    if(strlen(trim($log_report[0]['element_182']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_182']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_163_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_163_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_204_1'] == 1 &&  strlen(trim($log_report[0]['element_164']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_164']."'/>\r\n";
        
    }// 
    
    if(strlen(trim($log_report[0]['element_200']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_200']."'/>\r\n";         $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_186_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_188_1']==1 &&  strlen(trim($log_report[0]['element_206']))>0){
       $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_206']."'/>\r\n";
      
    }//
    
    if(strlen(trim($log_report[0]['element_217']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_217']."'/>\r\n";         $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_222_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_221_1']==1  &&  strlen(trim($log_report[0]['element_223']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_223']."'/>\r\n";
        
    }//
    
    
    if(strlen(trim($log_report[0]['element_233']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_233']."'/>\r\n";         $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_238_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_237_1']==1  &&  strlen(trim($log_report[0]['element_239']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_239']."'/>\r\n";
        
    }//
    
    if(strlen(trim($log_report[0]['element_249']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_249']."'/>\r\n";         $message .="<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_254_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_253_1']==1  &&  strlen(trim($log_report[0]['element_255']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_255']."'/>\r\n";
        
    }//
    
    if(strlen(trim($log_report[0]['element_332']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_332']."'/>\r\n";         $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_258_1'>Click here to complete this Discrepency.</a>\r\n<form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_258_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>";
    }//
    
    if($log_report[0]['element_259_1']==1  &&  strlen(trim($log_report[0]['element_257']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_257']."'/>\r\n";
        
    }//
    
    if(strlen(trim($log_report[0]['element_333']))>0){
        $message .= "<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_333']."'/>\r\n";         $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_273_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_273_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    if($log_report[0]['element_274_1']==1  &&  strlen(trim($log_report[0]['element_272']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_272']."'/>\r\n";
        
    }//
    

    
    if($log_report[0]['element_291_1']==1  &&  strlen(trim($log_report[0]['element_287']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_287']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_290_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_290_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    
    
    if($log_report[0]['element_305_1']==1  &&  strlen(trim($log_report[0]['element_303']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_303']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_304_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_304_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
   
    if(strlen(trim($log_report[0]['element_317']))>0){
        $message .= "\r\nAnother Discrepancy.&nbsp;&nbsp;<img src='https://inet.iwpusa.com/machforms/machform/data/form_17457/files/".$log_report[0]['element_317']."'/>\r\n";
        $message .="<a href='https://inet.iwpusa.com/complete_discrepency.php?form_id=$_GET[currentry]&discep=element_318_1'>Click here to complete this Discrepency.</a><form action='complete_discrepency.php' method='post'><input type='hidden' name='form_id' value='$_GET[currentry]'/><input type='hidden' value='element_318_1' name='discrep' /><input type='submit'  value='Complete Descrepancy' /></form>\r\n";
    }//
    
    switch($log_report[0]['element_4']){
         
	
        case 34: //2 - Containers 
            $recipients = "lnavarro@iwpusa.com";
        break;
        case 35: //4 - Grease Procurement
            $recipients = "rparsons@iwpusa.com";
        break;
       case 36: //7 - Bakery
            $recipients = "ttrawick@iwpusa.com";
       break;
       case 37: //B - Biodiesel Plant Processing
            $recipients = "lmunoz@iwpusa.com,ekayser@iwpusa.com";
       break;
        case 38:  //C - Buckeye Plant
            $recipients = "orodriguez@iwpusa.com,mcolbert@iwpusa.com";
        break;
            
        case 39: //E - Mechanics 
            $recipients = "lnavarro@iwpusa.com,MRolon@iwpusa.com";
        break;
        
        case 40: //F - Cottonseed Trucking
            $recipients = "JReyes@iwpusa.com";
        break;
        case 41: //G - Yellow Grease Process< 
            $recipients = "jhernandez@iwpusa.com";
        break;
        case 42 : //H - Corporate Office
            $recipients = "aburkett@iwpusa.com";
        break;
       case 43: //I - Silage
            $recipients = "Dduarte@iwpusa.com";
       break;
         case 44: //J - ByProducts Corona 
            $recipients = "jduke@iwpusa.com";
         break;
         case 45 : //K - ByProducts Corona Trucking
             $recipients = "jduke@iwpusa.com";
         break;
         case 46: //L - Soap
            $recipients = "jduke@iwpusa.com";
         break;
        case 47: //M - Corona Bakery Process 
            $recipients = "jmendoza@iwpusa.com,jgravanda@iwpusa.com,dgonzales571@gmail.com";
        break;
        case 48: //N - Whey, Molases, Silage
            $recipients = "kwatson@iwpusa.com,lwood@iwpusa.com";
        break;
        case 49 : //O - NM Trucking
            $recipients = "kwatson@iwpusa.com,lwood@iwpusa.com";
        break;
        case 50: //P - Plant Processing 
            $recipients = "Lnavarro@iwpusa.com,Nramirez@iwpusa.com";
        break;
        case 51: //Q - Plant Repair
             $recipients = "Lnavarro@iwpusa.com,Nramirez@iwpusa.com";
        break;
        case 52: //R - Recycle, Grease, Bakery 
            $recipients = "Lnavarro@iwpusa.com,jjara@iwpusa.com,oespinoza@iwpusa.com";
        break;
        case 53 : //T - Buckeye Trucking
            $recipients = "orodriguez@iwpusa.com,mcolbert@iwpusa.com";
        break;
        case 54: //UC - Grease Procurement
            $recipients = "aparsons@iwpusa.com";
        break;
        case 55: //US - CV Grease Procurement
            $recipients = "aparsons@iwpusa.com";
        break;
         case 56 : //V - Plant 
            $recipients = "mpires@iwpusa.com,ddunker@iwpusa.com";
         break;
        case 57; //W - ByProduct AZ
            $recipients = "orodriguez@iwpusa.com,mcolbert@iwpusa.com";
        break;
        case 58: //LAB
            $recipients = "jboyd@iwpusa.com";
        break;
        case 59: //Co West
            $recipients = "ttrawick@iwpusa.com,aparsons@iwpusa.com,sergio@co-west.com";
        break;
        
        		
    }
    
    
    mail("$recipients","Discrepency Report Log",$message,$headers);
}

?>