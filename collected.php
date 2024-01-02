<?php
include "protected/global.php";

$ikg_info = new IKG($_GET['ikg']);

echo $ikg_info->collected;


?>