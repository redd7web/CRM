<?php
include "protected/global.php";
$soy_price = $db->query("SELECT * FROM iwp_soybean ORDER BY date DESC LIMIT 0,1");

$over = round(  ($soy_price[0]['percentage'] - 310)  /10);
echo ($over*5) +$soy_price[0]['percentage'];
?>