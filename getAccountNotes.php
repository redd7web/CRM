<?php
include "protected/global.php";

$notes =  $db->where('account_ID',$_GET['account_id'])->get($dbprefix.'_accounts',"notes");

if(count($notes)>0){
    echo $notes[0]['notes'];
}


?>