<?php
include 'protected/global.php';
ini_set("display_errors",1);


$i = $db->query("SELECT account_no FROM iwp_containers WHERE delivery_date='0000-00-00' AND deleted =0");

if(count($i)>0){
    foreach($i as $n){
        $u = $db->query("SELECT scheduled_start_date FROM iwp_scheduled_routes WHERE  account_no = $n[account_no] ORDER BY scheduled_start_date DESC LIMIT 0,1");
        if(count($u)>0){
            echo account_NumToName($n['account_no'])." container delivery date: <br/>";
            $db->query("UPDATE iwp_containers SET delivery_date='".$u[0]['scheduled_start_date']."' WHERE account_no = $n[account_no]");
        }else{
            echo account_NumToName($n['account_no'])." container delivery date: none<br/>";
        }
    }
}

?>