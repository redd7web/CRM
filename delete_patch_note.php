<?php

include "protected/global.php";
ini_set("display_errors",1);

$db->where("entry","$_POST[entry_id]")->delete("iwp_patch_notes");


?>