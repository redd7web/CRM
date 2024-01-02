<?php

include "protected/global.php";

$db->query("UPDATE iwp_utility SET deleted =1 WHERE utility_sched_id = $_GET[util_id]");

?>
