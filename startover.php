<?php
session_start();
unset($_SESSION['preview']);
$_SESSION = array();
session_regenerate_id();

?>



