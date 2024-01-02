<?php
include 'protected/global.php';

$k  = array(
    "section_name"=>$_POST['data']
);

 $db->insert("b_division_sections",$k);



?>