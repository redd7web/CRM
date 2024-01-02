<?php
include "protected/global.php";


$value = $db->query("SELECT * FROM iwp_jacobsen ORDER BY date DESC LIMIT 0,1");

echo $value[0]['percentage'];




?>