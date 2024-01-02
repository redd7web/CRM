<?php
include "protected/global.php";


$pax = array(
    "extra_miles"=>$_POST['extra_miles'],
    "backhaul"=>$_POST['backhaul'],
    "total_miles"=>$_POST['total_miles']
);

$db->where("tk",$_POST['weight'])->update("iwp_test_scale",$pax);



?>