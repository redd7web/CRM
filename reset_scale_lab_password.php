<?php
include "protected/global.php";

$io = crypt("IwpRunning123!",'$ap_form_64550');

$k = array(
    "password"=>$io,
    "element_2"=>null
);

$db->where("id",41)->update("Inetforms.ap_form_64550",$k);

?>