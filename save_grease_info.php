<?php
ini_set('error_reporting', E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "protected/global.php";
$person = new Person();
$ant = new Account($_POST['account_no']);





$check_ = $db->query("SELECT * FROM iwp_grease_data_table WHERE route_id=$_POST[route_id] AND schedule_id=$_POST[schedule_number] AND account_no=$_POST[account_no]");



if(count($check_) >0){
    $data = Array(
        "schedule_id"=>$_POST['schedule_number'],
        "inches_to_gallons"=>$_POST['picked_up'],
        "account_no"=>$_POST['account_no'],
        "completed"=>1,
        "fieldreport"=>$_POST['field_note'],
        "zero_gallon_reason"=>$_POST['skip'],
        "driver"=>$_POST['driver'],
        "date_of_pickup"=>$_POST['dop']
    );
   $db->where("route_id",$_POST['route_id'])->update("iwp_grease_data_table",$data);  
} else {
    $data = Array(
        "route_id"=> $_POST['route_id'],
        "schedule_id"=>$_POST['schedule_number'],
        "inches_to_gallons"=>$_POST['picked_up'],
        "account_no"=>$_POST['account_no'],
        "completed"=>1,
        "fieldreport"=>$_POST['field_note'],
        "zero_gallon_reason"=>$_POST['skip'],
        "driver"=>$_POST['driver'],
        "date_of_pickup"=>$_POST['dop']
    );
    $db->insert($dbprefix.'_grease_data_table',$data);    
}


$dte = date("Y-m-d");
$status = array(
    "route_status"=>"completed"
);
$db->where('grease_no',$_POST['schedule_number'])->update($dbprefix.'_grease_traps',$status);

//echo "SELECT * FROM iwp_grease_traps WHERE grease_no = $_POST[schedule_number]<br/>";
$getsched = $db->query("SELECT * FROM iwp_grease_traps WHERE grease_no = $_POST[schedule_number]");
//var_dump($getsched);

if(count($getsched)>0){ 
 $sched_params = array(
        "account_no"=>$_POST['account_no'],
        "date"=>$dte,
        "created_by"=>$person->user_id,
        "frequency"=>$getsched[0]['frequency'],         
        "service_date"=>addDayswithdate($dte,$getsched[0]['frequency']),
        "route_status"=>"scheduled"
    );

    echo $db->insert("iwp_grease_traps",$sched_params);
    
}





//reschedule trap frequency days later with same parameters as previous



        
$track = array(
    "date"=>date("Y-m-d H:i:s"),
    "user"=>$person->user_id,
    "actionType"=>"Grease Trap Serviced",
    "descript"=>"Grease Trap Serviced ".$id,
    "pertains"=>6,
    "type"=>14
);
$db->insert($dbprefix."_activity",$track);






?>