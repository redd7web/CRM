<?php
include "protected/global.php";
include "source/css.php";
include "source/scripts.php";
ini_set("display_errors",1);

$result_privilage = array(1,3,4);
?>        
<style>
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
} 
ul {list-style:none; text-align:center; margin:0;}
ul li {display:inline-block; zoom:1; *display:inline; vertical-align:top; width:25%; margin:10px 1%;margin-bottom:75px;}
</style>        
    

<?php

if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['division']);
    session_destroy();
}


if(isset($_POST['scale_login'])){
    $hash = crypt(trim($_POST['scale_password']),'$ap_form_64550');
    if($_SESSION['username'] =="RDizon"){
        echo "$hash $_POST[scale_name] ";
        echo "SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'";
    }
    
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1,element_10_1,element_10_2,element_10_3,element_10_4,element_10_5,element_10_6,element_10_7,element_10_8,element_10_9,element_10_10,element_10_11,element_10_12,element_10_13,element_10_14,element_10_15,element_10_16,element_10_17,element_10_18,element_10_19,element_10_20,element_10_21,element_10_22,element_10_23,element_10_24,element_10_25,element_10_26,element_10_27,element_10_28,element_10_29,element_10_30,element_10_32 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'");
  
    
    if(count($lookup)>0  ){
        if(strlen(trim($lookup[0]['element_10_1']))>0 && $lookup[0]['element_10_1'] !=0){
            $_SESSION['division'][]= "'2'";
        }
            
        if(strlen(trim($lookup[0]['element_10_2']))>0 && $lookup[0]['element_10_2'] !=0){
            $_SESSION['division'][]= "'4'";
        }
           
        if(strlen(trim($lookup[0]['element_10_3']))>0 && $lookup[0]['element_10_3'] !=0){
            $_SESSION['division'][]= "'7'";
        }
            
        if(strlen(trim($lookup[0]['element_10_4']))>0 && $lookup[0]['element_10_4'] !=0){
            $_SESSION['division'][]= "'B'";
        }
        if(strlen(trim($lookup[0]['element_10_5']))>0 && $lookup[0]['element_10_5'] !=0){
            $_SESSION['division'][]= "'C'";
        }
            
        if(strlen(trim($lookup[0]['element_10_6']))>0 && $lookup[0]['element_10_6'] !=0){
            $_SESSION['division'][]= "'D'";
        }
            
        if(strlen(trim($lookup[0]['element_10_8']))>0 && $lookup[0]['element_10_8'] !=0){
            $_SESSION['division'][]= "'F'";
        }
        if(strlen(trim($lookup[0]['element_10_9']))>0 && $lookup[0]['element_10_9'] !=0){
            $_SESSION['division'][]= "'G'";
        }
            
        if(strlen(trim($lookup[0]['element_10_10']))>0 && $lookup[0]['element_10_10'] !=0){
            $_SESSION['division'][]= "'H'";
        }
        if(strlen(trim($lookup[0]['element_10_11']))>0 && $lookup[0]['element_10_11'] !=0){
            $_SESSION['division'][]= "'I'";
        }
            
        if(strlen(trim($lookup[0]['element_10_12']))>0 && $lookup[0]['element_10_12'] !=0){
            $_SESSION['division'][]= "'J'";
        }
        if(strlen(trim($lookup[0]['element_10_13']))>0 && $lookup[0]['element_10_13'] !=0){
            $_SESSION['division'][]= "'K'";
        }
            
        if(strlen(trim($lookup[0]['element_10_14']))>0 && $lookup[0]['element_10_14'] !=0){
            $_SESSION['division'][]= "'L'";
        }
        if(strlen(trim($lookup[0]['element_10_15']))>0 && $lookup[0]['element_10_15'] !=0){
            $_SESSION['division'][]= "'M'";
        }
            
        if(strlen(trim($lookup[0]['element_10_16']))>0 && $lookup[0]['element_10_16'] !=0){
            $_SESSION['division'][]= "'N'";
        }
        if(strlen(trim($lookup[0]['element_10_17']))>0 && $lookup[0]['element_10_17'] !=0){
            $_SESSION['division'][]= "'O'";
        }
      
        if(strlen(trim($lookup[0]['element_10_20']))>0 && $lookup[0]['element_10_20'] !=0){
            $_SESSION['division'][]= "'R'";
        }
        if(strlen(trim($lookup[0]['element_10_21']))>0 && $lookup[0]['element_10_21'] !=0){
            $_SESSION['division'][]= "'RP'";
        }
            
        if(strlen(trim($lookup[0]['element_10_22']))>0 && $lookup[0]['element_10_22'] !=0){
            $_SESSION['division'][]= "'RW'";
        }
        if(strlen(trim($lookup[0]['element_10_23']))>0 && $lookup[0]['element_10_23'] !=0){
            $_SESSION['division'][]= "'S'";
        }
            
        if(strlen(trim($lookup[0]['element_10_24']))>0 && $lookup[0]['element_10_24'] !=0){
            $_SESSION['division'][]= "'T'";
        }
        if(strlen(trim($lookup[0]['element_10_25']))>0 && $lookup[0]['element_10_25'] !=0){
            $_SESSION['division'][]= "'UC'";
        }
            
        if(strlen(trim($lookup[0]['element_10_26']))>0 && $lookup[0]['element_10_26'] !=0){
            $_SESSION['division'][]= "'UD'";
        }
        if(strlen(trim($lookup[0]['element_10_27']))>0 && $lookup[0]['element_10_27'] !=0){
            $_SESSION['division'][]= "'US'";
        }
            
        if(strlen(trim($lookup[0]['element_10_28']))>0 && $lookup[0]['element_10_28'] !=0){
            $_SESSION['division'][]= "'V'";
        }   
               
        if(strlen(trim($lookup[0]['element_10_29']))>0 && $lookup[0]['element_10_29'] !=0){
            $_SESSION['division'][]= "'W'";
        }   
        
        if(strlen(trim($lookup[0]['element_10_30']))>0 && $lookup[0]['element_10_30'] !=0){
            $_SESSION['division'][]= "'WT'";
        }   
        
        if(strlen(trim($lookup[0]['element_10_32']))>0 && $lookup[0]['element_10_32'] !=0){
            //$_SESSION['division'][]= "";
        }  
        
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }
    print_r($_SESSION);
    print_r($result_privilage);
}   




if(  isset($_SESSION['billing']) && in_array($_SESSION['billing'],$result_privilage)   ){// are you loggedin and are you a lab tech or manager?
    ?>
    <a href='labpass.php?task=logout'><img src='img/logout.jpg' title='Logout' style="float:right;"/></a>
    <ul>
    
<li><div class="frame" style="background: url(img/IOlog.png) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Inbound and Outbound Sample Log"><a href="https://inet.iwpusa.com/TCL.php" target="_blank"><img src="img/transparent.png" /><br/>Inbound and Outbound Sample Log</a></div></li>

<li><div class="frame" style="background: url(img/pending.png) no-repeat left 15px;background-size:contain;width:122px;height:122px;" title="Pending Tests"><a href="https://inet.iwpusa.com/PendingTests.php" target="_blank"><img src="img/transparent.png" style="width: 122px;height:122px;"/><br/>Pending Lab Samples</a></div></li>



<li><div class="frame" style="background: url(img/completedlab.jpg) no-repeat left top;background-size:contain;width:122px;height:122px;" ><a href="https://inet.iwpusa.com/CompletedTests.php" target="_blank"><img src="img/transparent.png" title="Completed Lab Samples"/><br/>Completed Lab Samples</a></div></li>

<li><div class="frame" style="background: url(img/lotdash.png) no-repeat left top;width:122px;height:122px;" title="Lot Dashboard"><a href="3.php?mode=lotdash" rel="shadowbox"><img src="img/transparent.png"/><br />Lot Dashboard</a></div></li>



<li><div class="frame" style="background: url(img/analytics.png) no-repeat left top;width:122px;height:122px;" title="Analytics"><a href="3.php?mode=lotdash" rel="shadowbox"><a href="3.php?mode=analytics" rel="shadowbox"><img src="img/transparent.png"/>Analytics</a></div></li>






<li><div class="frame" style="background: url(img/BOL.jpg) no-repeat left top;width:122px;height:122px;background-size:contain;" title="Bill of Lading"><a href="bols.php?mode=bol" rel="shadowbox"><img src="img/transparent.png"/><br/>BOL</a></li>



<li><div class="frame" style="background: url(img/bakerydump.png) no-repeat left top;width:122px;height:122px;background-size:contain;" title="BAK"><a href="bols.php?mode=bak" rel="shadowbox"><img src="img/transparent.png"/>BAK</a></div></li>



<li><div class="frame" style="background: url(img/iodash.png) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Completed Inbound / Outbound"><a href="https://inet.iwpusa.com/CompletedIO.php" target="_blank"><img src="img/transparent.png" title="Inbound and Outbound Dashboard"/><br/>Inbound and Outbound Dashboard</a></div></li>
    </ul>
   
    <?php
}else{
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['division']);
    session_destroy();    
    ?>
    <form action="labpass.php" method="POST" style="margin-bottom: 50px;">
        <table style="width:200px;position:fixed;top:5px;right:5px;border-radius:10px 10px 10px 10px;border:2px solid green;padding:5px 5px 5px 5px;">
        <tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;" type="text" name="scale_name" placeholder="Username"/></td></tr>
        <tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;box-shadow:inset 0 0 5px green;padding:5px 5px 5px 5px;"  type="password" name="scale_password" placeholder="Password"/></td></tr>
        <tr><td colspan="2" style="text-align: right;border:0px solid #bbbbbb;"><input style="width: 100px;height:30px;background:url(img/login_clean.png) no-repeat center center;background-size:100% 100%;border:0px solid #bbbbbb;margin-top:4px;padding:5px 5px 5px 5px;" type="submit" value="" name="scale_login"/></td></tr>
        </table>
    </form>
    <?php
}

?>