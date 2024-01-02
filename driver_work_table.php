<?php

include "protected/global.php";
ini_set("display_errors",1);

$pop = $db->query("SELECT DISTINCT(iwp_rout_history.driver) FROM iwp_rout_history INNER JOIN iwp_list_of_routes ON iwp_rout_history.route_no = iwp_list_of_routes.route_id WHERE status IN('completed') AND iwp_rout_history.driver IS NOT NULL GROUP BY iwp_rout_history.driver ");

if(count($pop)>0){    
    foreach($pop as $drivers){
        $indi = $db->query("SELECT route_no,start_date,end_date FROM iwp_rout_history WHERE driver = $drivers[driver] GROUP BY WEEK(start_date,1) ORDER BY start_date ASC");
        if(count($indi)>0){
            echo "<table style='width:800px;'>";
            echo "<tr><td colspan='4' style='text-align:center;'>".uNumToName($drivers['driver'])."</td></tr>";
            echo "<tr><td>Route No</td><td>First stop</td><td>Last stop</td><td>Total Hours</td></tr>";
            foreach($indi as $hours){
                echo "<tr><td>$hours[route_no]</td><td>$hours[start_date]</td><td>$hours[end_date]</td><td>"; 
                    $date1 = new DateTime("$hours[start_date]");
                    $date2 = new DateTime("$hours[end_date]");
                    $diff = $date1->diff($date2);
                    // Call the format method on the DateInterval-object
                    echo $diff->format('%a Day(s) and %h hours %m minutes');
                echo "</td></tr>";
            }
            echo "</table>";
        }
    }
}


?>