<?php
include "protected/global.php";
ini_set("display_errors",1);
$db->query("UPDATE iwp_accounts SET address='$_POST[address]',city='$_POST[city]',state='$_POST[state]',zip ='$_POST[zip]',country='$_POST[country]' WHERE account_ID = $_POST[account]");

?>