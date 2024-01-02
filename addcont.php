<?php
include "protected/global.php";
$request = date("Y-m-d");
$label = $db->where("container_id",$_POST['container_id'])->get($dbprefix."_list_of_containers","container_label");

$buffer = array(
    "delivery_date"=>date("Y-m-d"),
    "container_no"=>$_POST['container_id'],
    "account_no"=>$_POST['account_no'],
    "request_date"=>$request,
    "container"=>$label[0]['container_label']
);


$db->insert($dbprefix.'_containers',$buffer);