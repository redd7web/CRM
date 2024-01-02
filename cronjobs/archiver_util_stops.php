<?php
include "../protected/global.php";

function exists($util_sched){
    global $db;
    $exists = $db->where("utility_sched_id",$util_sched)->get("iwp_utility2","$util_sched");
    if(count($exists)>0){// already exists in archive
        $db->where("utility_sched_id",$util_sched)->delete("iwp_utility");
    }else {
        if($db->query("INSERT INTO iwp_utility2  SELECT d.* FROM iwp_utility d WHERE d.utility_sched_id = $util_sched ")){//archive entry
            $db->where("utility_sched_id",$util_sched)->delete("iwp_utility");// delete from original source if successful
        }
    }
    unset($db);
}


$yc = $db->query("SELECT utility_sched_id FROM iwp_utility WHERE `date_of_service` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");

if(count($yc)>0){
    foreach($yc as $utils_stops){
        exists($utils_stops['utility_sched_id']);
    }
}else{
    echo "No entries older than a year<br/>";
}
unset($db);


?>