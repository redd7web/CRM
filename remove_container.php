<?php
    include "protected/global.php";
    $person = new Person();
    $deleted = array(
        "deleted"=>1
    );
    
    $db->where("entry",$_POST['entry'])->update("iwp_containers",$deleted);
    
    $db->where('account_ID',$_POST['account_no'])->update("iwp_accounts",$data);
    $track = array(
        "date"=>date("Y-m-d H:i:s"),
        "user"=>$person->user_id,
        "actionType"=>"Tote Deleted",
        "descript"=>"Tote deleted by ".uNumToName($person->user_id),
        "account"=>$_POST['account_no'],
        "pertains"=>9,
        "type"=>7
    );
    

    $db->insert("xlogs.".$dbprefix."_activity",$track);
?>