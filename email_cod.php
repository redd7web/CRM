<?php
include "protected/global.php";
ini_set("display_errors",1);
if(isset($_POST['send_cod'])){
    
    $lk = $db->query("SELECT cert_link,cer_link_2 FROM Inetforms.ap_form_49773 WHERE ap_form_49773.id = $_POST[attach_id]");
    if(count($lk)>0){
        
        switch($_GET['mode']){
            case 1:
                $filename =$lk[0]['cert_link'];
                $subject = "IWP Certification of Deconstruction ".date("Y-m-d H:i:s");
            break;
            case 2:
                $filename =$lk[0]['cer_link_2'];
                $subject = "IWP Certification of Deconstruction 2".date("Y-m-d H:i:s");
            break;
        }
        
        $path = "deconstruction_certificates/";
        // header
        $file = $path.$filename;
        $content = file_get_contents( $file);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));
        $name = basename($file);
        $message = "Please see attached.";
        // header
        $header = "From: no-reply<no-reply>\r\n";
        $header .= "Reply-To: No-reply@iwpusa.com\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
        
        // message & attachment
        $nmessage = "Please see attached.\r\n--".$uid."\r\n";
        $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $nmessage .= $message."\r\n\r\n";
        $nmessage .= "--".$uid."\r\n";
        $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
        $nmessage .= "Content-Transfer-Encoding: base64\r\n";
        $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
        $nmessage .= $content."\r\n\r\n";
        $nmessage .= "--".$uid."--";
        
        if (mail($_POST['recipient'], $subject, $nmessage, $header)) {
            echo "mail send ... OK"; // or use booleans here
        } else {
            echo "mail send ... ERROR!";
            print_r( error_get_last() );
        }
    }
    
}

?>
<style>
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<h1>Please Enter email address(es) separate multiple addresses with comma</h1>
<form action="email_cod.php?approve_id=<?php echo $_GET['approve_id']."&mode=$_GET[mode]"; ?>" method="POST">
<input type="hidden" value="<?php echo $_GET['approve_id']; ?>" name="attach_id"/>
<input type="text" placeholder="Email Recipient" name="recipient"/>&nbsp;<input type="submit" value="Send COD" name="send_cod"/>
</form>

