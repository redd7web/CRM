<?php
include "protected/global.php";

$uv = $db->where("id",$_POST['id'])->get("scale_ticket_images","image_path");


unlink($uv[0]['image_path']);
$db->where("id",$_POST['id'])->delete("scale_ticket_images");



?>