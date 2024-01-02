<?php

include "protected/global.php";
ini_set("display_errors",1);

function next_business_day($date) {
  $add_day = 0;
  do {
    $add_day++;
    $new_date = date('Y-m-d', strtotime("$date +$add_day Days"));
    $new_day_of_week = date('w', strtotime($new_date));
  } while($new_day_of_week == 6 || $new_day_of_week == 0);

  return $new_date;
}


$ip = $db->query("SELECT tk,WeighIn FROM iwp_test_scale WHERE manage_approve = 0");

if(count($ip)>0){
    foreach($ip as $c){
        echo "$c[tk] $c[WeighIn] next day: ".next_business_day($c['WeighIn'])."<br/>";
    }
}


?>