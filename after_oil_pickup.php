<?php
error_reporting(E_WARNING | E_PARSE | E_NOTICE);
include "protected/global.php";
$person = new Person();
$ant = new Account($_POST['account_no']);
$scheduled_list = $dbprefix."_scheduled_routes";
$account_table = $dbprefix."_accounts";
$list_of_routes = $dbprefix."_list_of_routes";






//mark current schedule complete
$db->query("UPDATE $scheduled_list set route_status ='completed' WHERE schedule_id = $_POST[schedule_number]");

//reset gauage
$db->query("UPDATE $account_table set avg_gallons_per_Month = 0 WHERE account_ID = $_POST[account_no]");





//once complete is clicked re-schedule route 30 days later




$schedule_info = array(
    "scheduled_start_date"=>addDayswithdate($_POST['dop'],$ant->pick_up_freq),
    "account_no"=>$_POST['account_no'],
    "route_status"=>"scheduled",
    "date_created"=>date("Y-m-d"),
    "created_by"=>$person->user_id,
    "code_red"=>0
);
var_dump($schedule_info);

echo "<br/>schedule creation status: ". $db->insert($dbprefix."_scheduled_routes",$schedule_info);
/**/

//***************************** UPDATE LIST OF ROUTES TABLE*************************//

$check_how_much = $db->where("route_id",$_POST['route_id'])->get($dbprefix."_list_of_routes","collected");

if(count($check_how_much)>0){
    $collected = $_POST['picked_up'] + $check_how_much[0]['collected'];    
} else {
    $collected = $_POST['picked_up'];
}

 


$list_of_routes = array(
    "collected"=>$collected
);
$db->where("route_id",$_POST['route_id'])->update($dbprefix."_list_of_routes",$list_of_routes);


/**/
//******* UPDATE LIST OF ROUTES TABLE*************************//



if(isset($_POST['field_note'])){
    $note = array(
        "schedule_id"=>$_POST['schedule_number'],
        "route_id"=>$_POST['route_id'],
        "author_id"=>$person->user_id,
        "date"=>date("Y-m-d"),
        "notes"=>$_POST['field_note'],
        "account_no"=>$_POST['account_no']
    );
    
    $db->insert($dbprefix."_notes",$note);
}


$track = array(
    "date"=>date("Y-m-d H:i:s"),
    "user"=> $person->user_id,
    "actionType"=>"Oil Picked up",
    "descript"=>"Oil Picked up For ".account_NumToName($_POST['account_no'])." Route <form action='oil_routing.php' target='_blank' method='post' class='ikg_form'><span style='font-decoration:underline;color:blue;cursor:pointer;'>$_POST[route_id]</span><input type='hidden' value='$_POST[route_id]' name='manifest'/><input type='hidden' value='1' name='from_routed_oil_pickups'/></form> Driver :". uNumTonName($_POST['driver']),
    "account"=>$_POST['account_no'],
    "pertains"=>6,
    "type"=>14
);
$db->insert($dbprefix."_activity",$track);

?>