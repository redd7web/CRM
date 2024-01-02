<?php
include "protected/global.php";
//ini_set("display_errors",1);

$info = $db->query("SELECT * FROM assets.trailer WHERE trailer.truck_id = $_POST[id]");

switch($_POST['choose']){
    
    case 1:
        echo  $info[0]['plates'];
        break;
    case 2:
        echo $info[0]['ikg_decal'];
        break;
}

?>