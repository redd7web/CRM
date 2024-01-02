<?php // from util
error_reporting(1);
include "protected/global.php";
$list_of_grease = $dbprefix."_list_of_grease";
$person = new Person();
ini_set("display_errors",1);

$grease_ikg = new Grease_IKG($_POST['rid']);

$jix = preg_replace('/[^A-Za-z0-9\-]/', '', trim($_POST['ikg_manifest_route_number']));
$ikg = Array(
    "ikg_manifest_route_number"=>$jix,
    "tank1"=>$_POST['tank_1'],
    "tank2"=>$_POST['tank_2'],
    "time_start"=>$_POST['time_start'],
    "start_mileage"=>$_POST['start_mileage'],
    "scheduled_date"=>$_POST['sched_route_start'],
    "truck"=>$_POST['vehicle'],
    "first_stop"=>$_POST['first_stop'],
    "first_stop_mileage"=>$_POST['first_stop_mileage'],
    "completed_date"=>$_POST['completion_date'],
    "license_plate"=>$_POST['lic_plate'],
    "last_stop"=>$_POST['last_stop'],
    "last_top_mileage"=>$_POST['last_stop_mileage'],    
    "ikg_decal"=>$_POST['ikg_decal'],
    "end_time"=>$_POST['end_time'],
    "end_mileage"=>$_POST['end_mileage'],
    "ikg_collected"=>$_POST['ikg_collected'],
    "fuel"=>$_POST['fuel'],
    "inventory_code"=>$_POST['inventory_code'],
    "lot_no"=>$_POST['lot_no'],
    "gross_weight"=>$_POST['gross_weight'],
    "recieving_facility"=>$_POST['reciev_fac'],
    "tare_weight"=>$_POST['tara_weight'],
    "facility_address"=>$_POST['fac_address'],
    "net_weight"=>$_POST['net_weight'],
    "facility_rep"=>$_POST['fac_rep'],
    "ikg_transporter"=>$_POST['ikg_transporter'],
    "number_days_route"=>$_POST['mult_day_route'],
    "driver"=>$_POST['drivers'],
    "account_numbers"=>$_POST['accounts'],
    "location"=>$_POST['location']
);

$db->where("route_id",$_POST['rid'])->update($dbprefix."_ikg_grease",$ikg);

$yt = $db->query("SELECT count(grease_no) as icn FROM iwp_grease_traps WHERE grease_route_no=$_POST[rid] AND route_status='enroute'");



if(strlen($_POST['drivers'])>0 && $_POST['drivers'] != "-"){
    $drivers = $_POST['drivers'];
} else {
    $drivers =0;
}

if(strlen($_POST['reciev_fac'])>0 && $_POST['reciev_fac'] != "ignore"){
    $fac = $_POST['reciev_fac'];
} else {
    $fac =0;
}

echo "UPDATE iwp_list_of_grease SET ikg_manifest_route_number ='$jix',driver=$drivers,facility=$fac,scheduled='$_POST[sched_route_start]',inc=".$yt[0]['icn']." WHERE route_id=$_POST[rid]";

$db->query("UPDATE iwp_list_of_grease SET ikg_manifest_route_number ='$jix',driver=$drivers,facility=$fac,scheduled='$_POST[sched_route_start]',inc=".$yt[0]['icn']." WHERE route_id=$_POST[rid]");




if( isset($_POST['remove_stops']) && strlen($_POST['remove_stops'])>0  ){//did the user remove any stops?
    $removed_stops = explode('|',$_POST['remove_stops']);
    array_pop($removed_stops);
    
    $ko = count($removed_stops);
    $stat = array( 
        "route_status"=>"scheduled",
        "grease_route_no"=>NULL
    );
    
    foreach($removed_stops as $stops ){
        $db->where('grease_no',$stops)->update($dbprefix."_grease_traps",$stat);
        $hj = $db->query("SELECT account_no FROM iwp_grease_traps WHERE grease_no = ".$stops);
        $kc .=$hj[0]['account_no']."|";
    }
    $db->query("UPDATE iwp_ikg_grease SET account_numbers = REPLACE(account_numbers, '$kc', '') WHERE route_id=$_POST[rid]");
}


if ( isset($_POST['new_stops']) && isset($_POST['new_accounts']) && strlen($_POST['new_stops'])>0 && strlen($_POST['new_accounts'])  >0 ){
    $add_these = array_map('intval',  explode("|",$_POST['new_stops'])   );
    array_pop($add_these);
    $add = count($add_these);   
    $db->query("UPDATE iwp_grease_traps SET grease_route_no = $_POST[rid], route_status='enroute' WHERE grease_no IN(". implode(",",$add_these) .")");
    $db->query("UPDATE iwp_list_of_grease SET stops = stops + $add, inc = inc+ $add WHERE route_id= $_POST[rid]");   
}


$grease_ikg->fix_self();

$history = array(    
    "route_no"=>(int)$_POST['rid'],
    "what_day"=>(int)$_POST['what_day'],
    "start_mileage"=>trim($_POST['start_mileage']),
    "first_stop_mileage"=>trim($_POST['first_stop_mileage']),
    "last_stop_mileage"=>$_POST['last_stop_mileage'],
    "first_stop"=>trim($_POST['first_stop']),
    "last_stop"=>trim($_POST['last_stop']),
    "driver"=>$_POST['drivers'],
    "truck_id"=>trim($_POST['vehicle']),
    "gross_weight"=>$_POST['gross_weight'],
    "tare_weight"=>$_POST['tara_weight'],
    "start_date"=>date("Y-m-d")." ".$_POST['time_start'],
    "end_mileage"=>$_POST['end_mileage'],
    "end_date"=>$_POST['completion_date']." ".date("H:i:s"),
    "last_stop_mileage"=>$_POST['last_stop_mileage'],
    "type"=>'grease'       
);

$exist_ = $db->where('route_no',$_POST['rid'])->where('what_day',$_POST['what_day'])->get($dbprefix."_rout_history");

if( count($exist_) == 0 ){
    $db->insert($dbprefix."_rout_history",$history);
}  else {
    $db->where('route_no',$_POST['rid'])->where('what_day',$_POST['what_day'])->update($dbprefix."_rout_history",$history);
}

$track = array(
    "date"=>date("Y-m-d H:i:s"),
    "user"=>$person->user_id,
    "actionType"=>"Grease Route Updated",
    "descript"=>"Grease Route Updated <form action='grease_ikg.php' target='_blank' method='post' class='ikg_form' style='cursor:pointer;'><span style='color:blue;text-decoration:underline;'>$_POST[rid]</span><input type='hidden' value='$_POST[rid]' name='util_routes'/><input type='hidden' value='1' name='from_routed_grease_list'/></form>",
    "pertains"=>6,
    "type"=>14
);
$db->insert($dbprefix."_activity",$track);
?>