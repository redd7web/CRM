<?php
include "../protected/global.php";
ini_set("display_errors",1);
function exists($route_id,$schedule_id,$account_no){
    global $db;
    $exist = $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where('account_no',$account_no)->get("iwp_data_table2","route_id");
    if(count($exist)>0){
       $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->delete("iwp_data_table");
    }else{
        if($db->query("INSERT INTO iwp_data_table2 SELECT d.* FROM iwp_data_table d WHERE d.schedule_id = $schedule_id")){//copy to archive
            $db->WHERE('schedule_id',"$schedule_id")->delete('iwp_data_table');//delete original
        }
    }
    unset($db);    
}

$yc = $db->query("SELECT route_id,schedule_id,account_no,date_of_pickup FROM iwp_data_table WHERE `date_of_pickup` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ");
if(count($yc)>0){
    foreach($yc as $data){
        echo "route_id: $data[route_id] account_no: $data[account_no] schedule_id: $data[schedule_id] date of pickup: $data[date_of_pickup]";
        exists($data['route_id'],$data['schedule_id'],$data['account_no']);
    }
}else {
    echo "No entries older than a year<br/>";
}
unset($db);

?>