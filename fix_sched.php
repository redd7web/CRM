<?php
include "protected/global.php";
ini_set("display_errors",1);
$k ="";

/**/
$stack = explode("|","41612|26970|27215|28315|29256|42988|33401|43719|34044|33423|26546|26387|26164|27872|43264|26423|43062|42832|27334|26422|43680|28404|27853|43213|27566|26491|29307|28428|43300|34545|27157|26755|42953|42906|43462|27982|42670|28147|43201|43274|33579|43276|43246|27153|27854|26736|27918|27154|26784|33311|42804|28804|43692|25183|25581|28591|35681|26667|43210|27848|26233|28459|42568|27354|28142|27688|26625|25621|28023|43193|43251|");

array_pop($stack);
print_r($stack);

function next_sched($account){
    global $db;
    
    $k = $db->query("SELECT schedule_id FROM iwp_scheduled_routes WHERE account_no = $account AND route_status='scheduled'");
    if(count($k)>0){
        $db->query("UPDATE iwp_scheduled_routes SET route_status='enroute',route_id=45351 WHERE schedule_id=".$k[0]['schedule_id']);
        return $k[0]['schedule_id'];
    }else{
        return "DNE";
    }
}


foreach($stack as $fix){
    echo account_NumtoName($fix)." - ".next_sched($fix)."<br/>";
}

?>