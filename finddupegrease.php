<?php
include "protected/global.php";

$k = $db->query("SELECT iwp_list_of_grease.status, iwp_grease_traps.grease_no, iwp_data_table.schedule_id FROM iwp_scheduled_routes INNER JOIN iwp_data_table ON iwp_scheduled_routes.schedule_id = iwp_data_table.schedule_id INNER JOIN iwp_list_of_routes. WHERE iwp_scheduled_routes.route_status = 'scheduled' ORDER BY iwp_scheduled_routes.account_no");

foreach($k as $stops_should_be_completed){
    echo  account_NumToName($stops_should_be_completed['account_no'])." ".$stops_should_be_completed['schedule_id']." ".$stops_should_be_completed['date_of_pickup']."<br/>";
    //$db->query("UPDATE iwp_scheduled_routes set route_status='completed' WHERE schedule_id = $stops_should_be_completed[schedule_id]");
}


?>