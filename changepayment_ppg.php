<?php
include "protected/global.php";

$person = new Person();
$array = array(   
    "payment_method"=>$_POST['payment_type'],
    "index_percentage"=>"",
    "ppg_jacobsen_percentage"=>$_POST['ppgval']
);
var_dump($array);

echo $db->where("account_ID",$_POST['account'])->update($dbprefix.'_accounts',$array);

$track = array(
    "date"=>date("Y-m-d H:i:s"),
    "user"=> $person->user_id,
    "actionType"=>"Payment Type Changed",
    "descript"=>"Payment Type Changed to $_POST[payment_type] PPG: ".$_POST['ppgval'],
    "account"=>$_POST['account'],
    "pertains"=>2,
    "type"=>7
);
$db->insert($dbprefix."_activity",$track);
?>