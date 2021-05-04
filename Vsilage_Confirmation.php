<?php
include "protected/global.php";





if(isset($_GET['currentry'])){
    echo  "entry: ".$_GET['currentry'];
    $request = $db->query("SELECT element_268,element_269,element_294 FROM Inetforms.ap_form_13504 WHERE id=$_GET[currentry]");
    
    if(count($request)>0){
        $nmessage="";
         if(strlen(trim($request[0]['element_268']))>0){
            $bound_text = $request[0]['element_268'];
            $file =  file_get_contents("machforms/machform/data/form_13504/files/".$request[0]['element_268']);
            
            $headers = "From: V-Silage-Pictures@iwpusa.com\r\n";
            $headers .= "Reply-To: No-reply@iwpusa.com\r\n";
           $headers =     "MIME-Version: 1.0\r\n"
."Content-Type: multipart/mixed; boundary=\"$bound_text\"". PHP_EOL;
           
            $bound =   "--".$bound_text."\r\n";
            $bound_last =  "--".$bound_text."--\r\n";
            $message =    "If you can see this MIME than your client doesn't accept MIME types!\r\n"
            .$bound;
            
            $message .=   "Content-Type: image/jpeg; charset=\"iso-8859-1\"\r\n"
            ."Content-Transfer-Encoding: 7bit\r\n\r\n"
            .$bound;
            
            $message .= "Content-Type: image/jpeg; name=".($request[0]['element_268'])."\r\n"
            ."Content-Transfer-Encoding: base64\r\n"
            ."Content-disposition: attachment; file=".($request[0]['element_268'])."\r\n"
            ."\r\n"
            .chunk_split(base64_encode($file)); 
                
            if (mail("ediaz@iwpusa.com", "V-Silage Pictures ", $message, $headers)) {
                echo "Mail sent.<br/>";
            } else {
                echo "mail send ... ERROR!";
                print_r( error_get_last() );
            }
              
         }
         
         if(strlen(trim($request[0]['element_294']))>0){
            $bound_text = $request[0]['element_294'];
            $file =  file_get_contents("machforms/machform/data/form_13504/files/".$request[0]['element_294']);
            
            $headers = "From: V-Silage-Pictures@iwpusa.com\r\n";
            $headers .= "Reply-To: No-reply@iwpusa.com\r\n";
           $headers =     "MIME-Version: 1.0\r\n"
."Content-Type: multipart/mixed; boundary=\"$bound_text\"". PHP_EOL;
           
            $bound =   "--".$bound_text."\r\n";
            $bound_last =  "--".$bound_text."--\r\n";
            $message =    "If you can see this MIME than your client doesn't accept MIME types!\r\n"
            .$bound;
            
            $message .=   "Content-Type: image/jpeg; charset=\"iso-8859-1\"\r\n"
            ."Content-Transfer-Encoding: 7bit\r\n\r\n"
            .$bound;
            
            $message .= "Content-Type: image/jpeg; name=".($request[0]['element_294'])."\r\n"
            ."Content-Transfer-Encoding: base64\r\n"
            ."Content-disposition: attachment; file=".($request[0]['element_294'])."\r\n"
            ."\r\n"
            .chunk_split(base64_encode($file)); 
                
            if (mail("ediaz@iwpusa.com", "V-Silage Pictures ", $message, $headers)) {
                echo "Mail sent.<br/>";
            } else {
                echo "mail send ... ERROR!";
                print_r( error_get_last() );
            }
         }
         
        if(strlen(trim($request[0]['element_269']))>0){
            $bound_text = $request[0]['element_269'];
            $file =  file_get_contents("machforms/machform/data/form_13504/files/".$request[0]['element_269']);
            
            $headers = "From: V-Silage-Pictures@iwpusa.com\r\n";
            $headers .= "Reply-To: No-reply@iwpusa.com\r\n";
           $headers =     "MIME-Version: 1.0\r\n"
."Content-Type: multipart/mixed; boundary=\"$bound_text\"". PHP_EOL;
           
            $bound =   "--".$bound_text."\r\n";
            $bound_last =  "--".$bound_text."--\r\n";
            $message =    "If you can see this MIME than your client doesn't accept MIME types!\r\n"
            .$bound;
            
            $message .=   "Content-Type: image/jpeg; charset=\"iso-8859-1\"\r\n"
            ."Content-Transfer-Encoding: 7bit\r\n\r\n"
            .$bound;
            
            $message .= "Content-Type: image/jpeg; name=".($request[0]['element_269'])."\r\n"
            ."Content-Transfer-Encoding: base64\r\n"
            ."Content-disposition: attachment; file=".($request[0]['element_269'])."\r\n"
            ."\r\n"
            .chunk_split(base64_encode($file)); 
                
            if (mail("ediaz@iwpusa.com", "V-Silage Pictures ", $message, $headers)) {
                echo "Mail sent.<br/>";
            } else {
                echo "mail send ... ERROR!";
                print_r( error_get_last() );
            }
         }
        // header
        
        
        
    }

}

echo "Form has been submitted successfully, picture(s) emailed."








?>