<?php
include "protected/global.php";
ini_set("display_errors",1);
$n = $db->query("SELECT DISTINCT(route_id)
FROM `iwp_data_table`
WHERE inches_to_gallons != 0.00
AND sum = 0.00");

if(count($n)>0){
    foreach($n as $z){
        echo "<br/>----------------------------------------------<br/>";
        $b = $db->query("SELECT route_id, count( account_no ) , account_no, inches_to_gallons, sum, SUM(inches_to_gallons) as y FROM `iwp_data_table` WHERE route_id =$z[route_id] GROUP BY account_no HAVING count( account_no ) >1 UNION SELECT route_id, count( account_no ) , account_no, inches_to_gallons, sum, SUM(inches_to_gallons) as y FROM `iwp_data_table` WHERE route_id =$z[route_id] GROUP BY account_no HAVING count( account_no ) <2  ");
        if(count($b)>0){
            foreach($b as $i){
                $db->query("UPDATE iwp_data_table SET sum = ".$i['y']." WHERE route_id = $z[route_id] AND account_no =".$i['account_no']   );
                echo "UPDATE iwp_data_table SET sum = ".$i['y']." WHERE route_id = $z[route_id] AND account_no =".$i['account_no']."<br/><br/>";
            }
        }
      echo "<br/>-----------------------------------------<br/>"; 
    }
}


?>