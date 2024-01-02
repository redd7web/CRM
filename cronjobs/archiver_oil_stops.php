<?php
include "../protected/global.php";

function exists($route_id,$schedule_id,$account_no){
    global $db;
    $exist = $db->query("SELECT schedule_id FROM iwp_scheduled_routes2 WHERE schedule_id = $schedule_id");
    if(count($exist)>0){// does this entry already exist in the archive?
         $db->where('schedule_id',"$schedule_id")->delete('iwp_scheduled_routes');//delete original
         echo " already archived<br/>";
    }else{
        if($db->query("INSERT INTO iwp_scheduled_routes2 SELECT d.* FROM iwp_scheduled_routes d WHERE d.schedule_id = $schedule_id")){//copy to archive
            $db->WHERE('schedule_id',"$schedule_id")->delete('iwp_scheduled_routes');//delete original
        }
        echo " - inserted deleted<br/>";
    }
    unset($db);
}


$ju =  $db->query("select schedule_id,account_no,route_id,scheduled_start_date FROM `iwp_scheduled_routes` 
  where `scheduled_start_date` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");// select entrie more than a year old
  
  if(count($ju)>0){
    foreach($ju as $kc ){
        echo "schedule_id:".$kc['schedule_id']." ".$kc['account_no']." ".$kc['route_id']." $kc[scheduled_start_date]";
        exists($kc['route_id'],$kc['schedule_id'],$kc['account_no']);
    }
  }else {
    echo "No entries older than a year<br/>";
  }
  
  unset($db);
  



?>