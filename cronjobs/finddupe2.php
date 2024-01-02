#!/usr/bin/php5 -q
<?php
include "/var/www/html/protected/global.php";
//chmod(basename($_SERVER['PHP_SELF']),777);
$last = date("Y")-1;
$this_year = date("Y");
$dup_scheds = $db->query("SELECT DISTINCT account_no, count( * ) AS scheduled_stops FROM iwp_scheduled_routes WHERE route_status = 'scheduled' GROUP BY account_no HAVING count( * ) >1");

if(count($dup_scheds)>0){
    foreach($dup_scheds as $scheds){
        echo $scheds['account_no']. " ".$scheds['scheduled_stops']."<br/>";
        $second  = $db->query("SELECT schedule_id,route_status,scheduled_start_date FROM iwp_scheduled_routes WHERE account_no =".$scheds['account_no']." AND route_status ='scheduled' ORDER BY scheduled_start_date DESC");
        if(count($second)>0){
            foreach($second as $dupes ){
                echo $dupes['schedule_id']." ".$dupes['route_status']. " $dupes[scheduled_start_date] <br/>";
            }
            echo "---------------these to be deleted------------------<br/>";
            for($i = 1 ;$i<count($second);$i++){
                echo $second[$i]['schedule_id']." ".$second[$i]['route_status']." ".$second[$i]['scheduled_start_date']."<br/>";       
                $db->query("DELETE FROM iwp_scheduled_routes WHERE schedule_id =".$second[$i]['schedule_id']);
            }
        }
        echo "<br/><br/>";
    }
}




?>