<?php
include "protected/global.php";
ini_set("display_errors",1);

$allpro = $db->query("SELECT account_ID,name FROM iwp_accounts WHERE division >=34 AND division <=50 AND status ='Active'");

if(count($allpro)>0){
    foreach($allpro as $n){
        
        $bn = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE account_no = $n[account_ID]");
        
        if(count($bn)==0){
            $account = new Account($n['account_ID']);
            echo $n['name']."$n[account_ID]<br/>";
            $p = array(
                "account_no"=>$n['account_ID'],
                "route_id"=>null,
                "scheduled_start_date"=>date("Y-m-d"),
                "facility_origin"=>$account->division,
                "route_status"=>"scheduled",
                "created_by"=>99,
                "code_red"=>0,
                "date_created"=>date("Y-m-d"),
                "oil_onsite"=>$account->avg_gallon,
                "deleted"=>0
            );
            echo "<pre>".var_dump($p)."</pre>";
            //$db->insert("iwp_scheduled_routes",$p);
        }
       
        
    }
}


?>