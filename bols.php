 <link type="text/css" rel="stylesheet" href="plugins/shadow/shadowbox.css" />
<style>
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
} 
ul {list-style:none; text-align:center; margin:0;}
ul li {display:inline-block; zoom:1; *display:inline; vertical-align:top; width:25%; margin:10px 1%;margin-bottom:75px;}
</style>

<ul>
<?php

switch($_GET['mode']){
    case "bol":
    echo '
        <li><div class="frame" style="background: url(img/BOLready.jpg) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Bill of Lading"><img src="img/transparent.png"/><a href="https://inet.iwpusa.com/BOL.php" target="_blank">Bill of Lading</a></div></li>
        <li><div class="frame" style="background: url(img/boldetails.jpg) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Bol Details"><img src="img/transparent.png"/><a href="https://inet.iwpusa.com/BOLD.php" target="_blank">BOL Detail Entry</a></div></li>
        <li><a href="https://inet.iwpusa.com/CompletedTests.php" target="_blank">Completed Lab Samples</a></li>';
    break;
    case "bak":
        echo '
        <li><div class="frame" style="background: url(img/destroypending.jpg) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Pending Dog Food"><a href="https://inet.iwpusa.com/PendingDogFood.php" target="_blank"><img src="img/transparent.png"/><br/>Pending</a></div></li>
        
        
        <li><div class="frame" style="background: url(img/destroycompleted.jpg) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Completed Dog Food"><a href="CompletedDogFood.php" target="_blank"><img src="img/transparent.png"/><br/>Completed</a></div></li>
        
        
        
        <li><div class="frame" style="background: url(img/CertificateDestruction.png) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Certication of Destruction"><img src="img/transparent.png"/><a href="https://inet.iwpusa.com/DECONSTRUCT.php" target="_blank">Destruction Form</a></div></li>
        <li><div class="frame"  title="Completed Dog Food Payments" style="background:url(img/finalapproval.jpg) no-repeat left top;width:122px;height:122px;"><a href="bols.php?mode=bak" rel="shadowbox"><div class="frame" title="Final Approval"><a href="PaymentDogFood.php" target="_blank"><img src="img/transparent.png"/><br />Final Approval</a></div></li>
        <li><div class="frame" style="background:url(http://www.free-icons-download.net/images/route-icon-86615.png) no-repeat left top;background-size:contain;width:122px;height:122px;" title="Bill of Lading"><a href="lab_routes.php" target="_blank"><img src="img/transparent.png"/><br />Lab Routes</a></div></li>
        ';
        
    break;
}


?>
</ul>