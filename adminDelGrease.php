<?php

include "protected/global.php";

$db->query("DELETE FROM iwp_grease_traps WHERE grease_no = $_GET[grease_no]");

?>