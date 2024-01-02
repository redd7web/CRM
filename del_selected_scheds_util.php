<?php

include "protected/global.php";
ini_set("display_errors",1);
if(strlen($_POST['selected_scheds'])>0 && $_POST['selected_scheds'] !=' ' && isset($_POST['selected_scheds'])){
    $first_stop = explode("|",$_POST['selected_scheds']);
    array_pop($first_stop);
    //print_r($first_stop);
    
    if(!empty($_SESSION['temp_stops'])){
        foreach($first_stop as $remove_temp){
            if(in_array($remove_temp,$_SESSION['temp_stops'])){
                unset($_SESSION['temp_stops'][array_search($remove_temp, $_SESSION['temp_stops'])]);// when finalizing your route remove stops from temp
            }
        }
    }
    
    
    if($db->query("DELETE FROM iwp_utility WHERE utility_sched_id IN(".implode(",",$first_stop).")" )){
        echo "Stops Deleted!";
    }    
}else{
    echo "No stops seleceted!";
}



?>