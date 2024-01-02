<?php
include "protected/global.php";

$buffer = htmlspecialchars($_POST['notes']);

$data = array(
    "notes"=>trim($buffer)
);

$db->where("account_ID",$_POST['account_no'])->update("iwp_accounts",$data);

$newvalue = $db->where("account_ID",$_POST['account_no'])->get("iwp_accounts","notes");

echo $newvalue[0]['notes'];

?>