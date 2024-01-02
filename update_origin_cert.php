<?php
include "protected/global.php";


if(isset($_POST['second'])){
    $db->query("UPDATE iwp_test_scale SET origin_weight_cert2= $_POST[value] WHERE tk=$_POST[tk]");    
}else{
    $db->query("UPDATE iwp_test_scale SET origin_weight_cert= $_POST[value] WHERE tk=$_POST[tk]");    
}



echo $_POST['tk']." ".$_POST['value'];

?>