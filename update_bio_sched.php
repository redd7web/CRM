<?php
include "protected/global.php";
ini_set("display_errors",1);
echo "UPDATE Inetforms.ap_form_47591 SET $_POST[field]=$_POST[value] WHERE id= $_POST[id]";

if( isset($_POST['value'])){
  $db->query("UPDATE Inetforms.ap_form_47591 SET $_POST[field]=$_POST[value] WHERE id= $_POST[id]");  
}else{
    echo "Please choose a tank.";
}

?>