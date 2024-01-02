<?php
include "protected/global.php";
ini_set("display_errors",1);
$cn = new Account();
$cc = $db->query("SELECT account_ID FROM iwp_accounts");

if(count($cc)>0){
    foreach( $cc as $accounts){
        $pack = array(
            "date_of_last_pickup"=>$cn->date_of_last_pickup($accounts['account_ID']),
            "amount_of_last_pickup"=>$cn->amount_of_last_pickup($accounts['account_ID'])
        );
        $db->where("account_ID",$accounts['account_ID'])->update("iwp_accounts",$pack);
    }
}



?>