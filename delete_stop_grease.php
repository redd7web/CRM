<?php
include "protected/global.php";
ini_set("display_errors",1);
echo "DELETE FROM $_POST[table] WHERE $_POST[field] = $_POST[schedule]";
$db->query("DELETE FROM $_POST[table] WHERE $_POST[field] = $_POST[schedule]");

?>