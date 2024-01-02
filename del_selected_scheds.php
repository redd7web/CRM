<?php

include "protected/global.php";
ini_set("display_errors",1);
if( strlen(trim($_POST['selected_scheds']))> 0 ){
    
     $first_stop = explode("|",$_POST['selected_scheds']);
    array_pop($first_stop);
    
    
    print_r($first_stop);
    
    
    $db->query("UPDATE iwp_scheduled_routes SET route_status='deleted' deleted = 1 WHERE schedule_id IN(".implode(",",$first_stop).")" ); 
    //echo "UPDATE iwp_scheduled_routes SET route_status='deleted' deleted = 1 WHERE schedule_id IN(".implode(",",$first_stop).")"; 
    echo "Stops Deleted!";
    /* 
    
    */
    //UNSET($_SESSION['temp_stops']);
}else{
    echo "No stops seleceted!";
}



?>