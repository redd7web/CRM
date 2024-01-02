<?php
include "protected/global.php";
$account = new Account();
$exp = 0;
$total = 0;
$answer = 0;
$exp = $account->onsite($_POST['accountx']);
$total = (float)$_POST['total']; 
$exp =  $total - round($exp,2);
 echo   $exp;


?>