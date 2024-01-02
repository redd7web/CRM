<?php
include "protected/global.php";
$db->query("UPDATE iwp_scheduled_routes SET deleted = 1 WHERE schedule_id= $_GET[sched_id]");
?>