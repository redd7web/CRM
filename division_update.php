<?php
    include "protected/global.php";
    ini_set("display_errors",1);
    
    if(strlen(trim($_POST['weight']))>0){
        $db->query("UPDATE iwp_test_scale SET division = '$_POST[value]' WHERE tk = $_POST[weight] ");    
    }else{
        echo "Weight Certificate not set!";
    }
    



?>