<?php
include "../protected/global.php";

function exist($route_id,$schedule_id,$account_no){
    global $db;
    $exists = $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->get("iwp_utility_data_table2","route_id,schedule_id,account_no");
    if(count($exists)>0){
        $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->delete("iwp_utility_data_table");
    }else {
        if($db->query("INSERT INTO iwp_utility_data_table2 SELECT d.* FROM iwp_utility_data_table d WHERE d.route_id = $route_id AND d.schedule_id = $schedule_id AND d.account_no = $account_no  ")){
            $db->where("route_id",$route_id)->where("schedule_id",$schedule_id)->where("account_no",$account_no)->delete("iwp_utility_data_table");
        }
    }
}


$yb = $db->query("SELECT route_id,schedule_id,account_no FROM iwp_utility_data_table WHERE `date_of_pickup` < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");
if(count($yb)>0){
    foreach($yb as $util_data){
        exist($util_data['route_id'],$util_data['schedule_id'],$util_data['account_no']);
    }
}


?>