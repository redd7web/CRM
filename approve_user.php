<?php
include "protected/global.php";
ini_set("display_errors",1);
echo "UPDATE iwp_users SET approved = 1 WHERE user_id = $_POST[user]";
$db->query("UPDATE iwp_users SET approved = 1 WHERE user_id = $_POST[user]");

?>