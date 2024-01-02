<?php
session_start();
if(!isset( $_SESSION['org_id'] ) || $_SESSION['org_id'] == false){
    //expired
    echo "-1";
    session_destroy();
}else{
    //not expired
    echo "1";
}
?>