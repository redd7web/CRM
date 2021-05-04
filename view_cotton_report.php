<?php
include "protected/global.php";
ini_set("display_errors",1);
include "source/scripts.php"; 
include "source/css.php";

$reason ="";
$kk ="";
$string ="";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: No-reply@iwpusa.com'."\r\n".'Reply-To: No-reply@iwpusa.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
if(isset($_POST['send_report'])){
        $pol = $db->query("SELECT * FROM Inetforms.ap_form_43646 WHERE ap_form_43646.id = $_POST[idd] AND approved = 0");
        //echo "SELECT * FROM Inetforms.ap_form_43646 WHERE ap_form_43646.id = $_POST[idd]<br/><br/> $_POST[reportss]<br/>";
        
       
      if(count($pol)>0){
        $filename = $_POST['reportss'];
        // header
        $path = "machforms/machform/data/form_43646/files/";
        $file = $path.$filename;
        $content = file_get_contents( $file);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));
        $name = basename($file);
        $message = "Please see attached.";
        // header
        $header = "From: no-reply@iwpusa.com\r\n";
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
        
        if(   $pol[0]['approved'] == 0 ){
            
            if( strlen(trim($pol[0]['element_18']))>0   || strlen(trim($pol[0]['element_19']))>0  ){
                if( strlen(trim($pol[0]['element_18']))>0 ){
                    $email_string[] = trim($pol[0]['element_18']);
                }
                
                if( strlen(trim($pol[0]['element_19']))>0 ){
                    $email_string[] = trim($pol[0]['element_19']);
                }
            }
            
            if(!empty($email_string)){                 
                 $string = ",".implode(",",$email_string);
            }
                 mail("lnavarro@iwpusa.com,Tprokop@iwpusa.com,JReyes@iwpusa.com,lnavarro@imperialwesternproducts.com,MColbert@iwpusa.com,ORodriguez@iwpusa.com,JBoyd@iwpusa.com,mallett33@frontier.com,racinwidow21@aol.com,tonyamgc@aol.com,jvaldez@iwpusa.com $string","Cotton Seed Testing Alert ".$pol[0]['element_26'],$nmessage,$header );
                 
                $db->query("UPDATE Inetforms.ap_form_43646 SET approved =1 WHERE id= $_POST[idd]");
                mail("Tprokop@iwpusa.com,Gruff@iwpusa.com","Cotton Seed report ".$pol[0]['element_26']." $_POST[idd] has been sent!","Cotton Seed report $_POST[idd] has been sent!",$header);
                echo "<span style='color:green;font-size:20px;font-weight:bold;'>Cotton Testing Report attached and sent!.</span><br/>";
        }else{
            switch($pol[0]['approved']){
                case 1:
                    $kk = " Approved "; 
                break;
                case 2:
                    $kk = " Rejected "; 
                    $reason = $pol[0]['deny_reason'];
                break;
            }
            echo "<span style='font-size:20px;font-weight:bold;'>This report has already been $kk,$reason</span><br/>";
        }
        
        
      }
        
        
        
       
}

if(isset($_POST['deny_reason'])){
    $db->query("UPDATE Inetforms.ap_form_43646 SET approved =2 ,deny_reason = '$_POST[deny_reason]' WHERE id=$_POST[idd]");
    $pol = $db->query("SELECT * FROM Inetforms.ap_form_43646 WHERE ap_form_43646.id = $_POST[idd]");
    switch($pol[0]['approved']){
        case 1:
            $kk = " Approved "; 
        break;
        case 2:
            $kk = " Rejected "; 
            $reason = $pol[0]['deny_reason'];
        break;
    }
    mail("JBoyd@iwpusa.com","Cotton report rejected","Rejected because : $reason \r\n<a href='https://inet.iwpusa.com/stopgap.php?form_id=$_POST[idd]' target='_blank'>Click here to edit this report</a>",$headers);
}

?>

<iframe style="margin:auto;margin-top:20px;width:1200px;height:1000px;" src="<?php echo 'machforms/machform/data/form_43646/files/'.$_GET['file']; ?>"></iframe>
<form action="view_cotton_report.php?file=<?php echo $_GET['file']; ?>&entry_=<?php echo $_GET['entry_']; ?>" method="POST">
    <input type="submit" value="Send Report" name="send_report" id="send_report"/>
    <input type="text" readonly="" value="<?php echo $_GET['file']; ?>" name="reportss"/>
    <input type="text" value="<?php echo $_GET['entry_']; ?>" name="idd"/>
</form>



<form action="view_cotton_report.php?file=<?php echo $_GET['file']; ?>&entry_=<?php echo $_GET['entry_']; ?>" method="POST">
    <input type="submit" name="deny" value="Deny Report"/>
    <textarea name="deny_reason" id="deny_reason" placeholder="If Denying Please state the reason here"></textarea>
    <input type="text" readonly="" value="<?php echo $_GET['file']; ?>" name="reportss"/>
    <input type="text" value="<?php echo $_GET['entry_']; ?>" name="idd"/>
</form>





