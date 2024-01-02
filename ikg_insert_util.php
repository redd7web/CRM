<?php
/* 

TABLES TO BE INSERTED / UPDATED  - 
    
_ikg_manifest_info
_list_of_routes
_scheduled_routes
    -status, route_no
_notes
    -route_no

*/



include "protected/global.php";
ini_set('display_errors',1); 

if(isset($_SESSION['id'])){
    $person = new Person();
    $ikg = Array(
        "ikg_manifest_route_number"=>trim($_POST['ikg_manifest_route_number']),
        "time_start"=>$_POST['time_start'],
        "start_mileage"=>$_POST['start_mileage'],
        "scheduled_date"=>$_POST['sched_route_start'],
        "truck"=>$_POST['vehicle'],
        "first_stop"=>$_POST['first_stop'],
        "first_stop_mileage"=>$_POST['first_stop_mileage'],
        "completed_date"=>$_POST['completion_date'],
        "license_plate"=>$_POST['lic_plate'],
        "last_stop"=> $_POST['last_stop'],
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
    
    
    $db->insert($dbprefix."_ikg_utility",$ikg);
    $id = $db->getInsertId();
    
    $ikg2 = array(
        "status"=>"enroute",
        "ikg_manifest_route_number"=>trim($_POST['ikg_manifest_route_number']),
        "facility"=>$_POST['reciev_fac'],
        "scheduled"=>trim($_POST['sched_route_start']),
        "completed_date"=>$_POST['completion_date'],
        "stops"=>$_POST['number_of_picksup'],
        "created_date"=> date("Y-m-d"),
        "created_by"=>$person->user_id,
        "inc"=>$_POST['number_of_picksup'] , 
        "route_id"=>$id      
    );
    
    
    $db->insert($dbprefix."_list_of_utility",$ikg2);
    $these_schedules = explode("|",$_POST['schedules']);
    array_pop($these_schedules);
    $note2 =Array(
        "route_id"=>$id,
        "type"=>"utility"
    );
    $buffer= array(
        "rout_no"=>$id,
        "route_status"=>"enroute"
    );
    foreach ($these_schedules as $value2){
        
        $util_sched = new Util_Stop($value2);
        
        if( strlen(trim($util_sched->issue_associated)) >0 ){// Does this util stop have an issue associated with it ? If so mark that issue as active
            $db->query("UPDATE iwp_issues SET issue_status='active',message='Util service routed for Account: ".account_NumtoName_plain( $util_sched->account_number )." ".date("Y-m-d")." Route:  $id schedule $value2',date_routed=$_POST[sched_route_start] WHERE issue_no = $util_sched->issue_associated ");
        }
        
       $db->where('utility_sched_id',$value2)->update($dbprefix."_utility",$buffer);
       $db->where('schedule_id',$value2)->update($dbprefix."_notes",$note2);   
    }
    $track = array(
        "date"=>date("Y-m-d H:i:s"),
        "user"=>$person->user_id,
        "actionType"=>"Utility Route Updated",
        "descript"=>"Utility Route Updated <form action='ikg_routing.php' target='_blank' method='post' class='ikg_form'><span style='cursor:pointer;color:blue;text-decoration:underline;'>$id</span><input type='hidden' value='$id' name='util_number'/><input type='hidden' value='1' name='from_routed_util_list'/></form>",
        "pertains"=>6,
        "type"=>14
    );
    
    echo $id;
}else{
    echo "1";
}


?>