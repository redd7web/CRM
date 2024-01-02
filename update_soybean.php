<?php
include "protected/global.php";


$value = $db->query("SELECT * FROM iwp_soybean ORDER BY date DESC LIMIT 0,1");

echo $value[0]['percentage'];




?>