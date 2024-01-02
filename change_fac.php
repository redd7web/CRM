<?php
include "protected/global.php";

$pack = array(
    "division"=>$_POST['facility']
);
$db->where("account_ID",$_POST['account_no'])->update("iwp_accounts",$pack);
?>

