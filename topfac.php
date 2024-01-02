<?php
include "protected/global.php";

$db->query("UPDATE iwp_accounts SET division = $_POST[facnum] WHERE account_ID= $_POST[account_no]");

?>