<?php
include "protected/global.php";
ini_set("display_errors",0);
$stop = new Scheduled_Routes($_POST['schedule_id']);
echo "<tr><td>$stop->account_name</td><td>$stop->schedule_id</td><td>$stop->scheduled_start_date</td><td><img src='img/delete-icon.jpg' style='cursor:pointer;' rel='$stop->scheduled_id' xlr='$stop->account_number'/></td></tr>";


?>