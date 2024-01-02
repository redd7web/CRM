<?php
include "protected/global.php";

$pack = array(
    "friendly"=>$_POST['friend']
);

$db->where("account_ID","$_POST[account]")->update("iwp_accounts",$pack);

?>