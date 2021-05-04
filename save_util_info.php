
<?php
include "protected/global.php";
$list_of_utility_route = $dbprefix."_list_of_utility";
ini_set("display_errors",1);
$dte = date("Y-m-d");

$person = new Person();
$ant = new Account($_POST['account_no']);
$util_sched = new Util_Stop($_POST['schedule_number']);


/**/







if($util_sched->service_type == 3 && strtolower($ant->status)  == "new"){
    $schedule_info = array(
        "scheduled_start_date"=>addDayswithdate(date("Y-m-d"),$ant->pick_up_freq),
        "account_no"=>$_POST['account_no'],
        "route_status"=>"scheduled",
        "date_created"=>date("Y-m-d"),
        "created_by"=>$person->user_id,
        "code_red"=>0,
        "facility_origin"=>$ant->division
    );
    $db->insert("iwp_scheduled_routes",$schedule_info);
   
    $db->query("UPDATE iwp_accounts SET status='Active',is_oil=1 WHERE account_ID = $ant->acount_id");
    
    $mmm = $db->query("SELECT * FROM iwp_containers WHERE account_no = $ant->acount_id AND container_no=$util_sched->container_label");
    
    if(count($mmm)>0){
        $db->query("UPDATE iwp_containers SET delivery_date = '$dte' WHERE account_no = $ant->acount_id AND container_no = $util_sched->container_label");//set container delivered
    } else {
        
           $yu = $db->query("SELECT container_label FROM iwp_list_of_containers WHERE container_id=$util_sched->container_label");
            
        $container = array(
            "container_no"=>$util_sched->container_label,
            "account_no"=>$ant->acount_id,
            "request_date"=>$util_sched->scheduled_start_date,
            "delivery_date"=>"$dte",
            "container"=>$yu[0]['container_label']
        );
        
        $db->insert("iwp_containers",$container);
    }
}




 else if ( $util_sched->service_type == 3 ){
    $container = array(
        "container_no"=>$util_sched->container_label,
        "account_no"=>$ant->acount_id,
        "request_date"=>$util_sched->scheduled_start_date,
        "delivery_date"=>"$dte",
        "container"=>$util_sched->container_label
    );    
    $db->insert("iwp_containers",$container);
} 






else if( $util_sched->service_type == 100 ){    //service swap
    
    echo "delete this :". $util_sched->entry_for_deletion."<br/>";
    
    $db->query("DELETE FROM iwp_containers WHERE account_no=$ant->acount_id AND entry=$util_sched->entry_for_deletion");
    echo "DELETE FROM iwp_containers WHERE account_no=$ant->acount_id AND entry=$util_sched->entry_for_deletion<br/>";
    //delete prior container
    
    $container = array(// new barrel being inserted into system
        "container_no"=>$util_sched->container_label,
        "account_no"=>$ant->acount_id,
        "request_date"=>$util_sched->scheduled_start_date,
        "delivery_date"=>"$dte",
        "container"=>containerNumToName($util_sched->container_label),
        "notes"=>$util_sched->special_instructions." <br/>".$util_sched->notes
    );
    echo "<pre>";
    var_dump($container);
    echo "</pre>";
    $db->insert("iwp_containers",$container);
    
    
} else if ($util_sched->service_type == 4){
    $hold = $db->query("SELECT container_no FROM iwp_containers WHERE account_no = $ant->acount_id AND entry = $util_sched->entry_for_deletion");
    $db->query("DELETE FROM iwp_containers WHERE account_no=$ant->acount_id AND entry = $util_sched->entry_for_deletion");   
    $db->query("UPDATE iwp_utility SET container_label = ".$hold[0]['container_no']." WHERE utility_sched_id = $util_sched->schedule_id");
    
    
}


/**/
$data = Array(
    "route_id"=> $_POST['route_id'],
    "schedule_id"=>$_POST['schedule_number'],    
    "issue_number"=>'',
    "account_no"=>$_POST['account_no'],
    "completed"=>1,
    "fieldreport"=>$_POST['field_note'],
    "zero_gallon_reason"=>$_POST['zero_gallon_reason'],
    "driver"=>$_POST['driver'],
    "date_of_pickup"=>$_POST['dop']
);

//var_dump($data);
$db->insert($dbprefix.'_utility_data_table',$data);
echo "sched update status: ".$db->query("UPDATE iwp_utility SET route_status='completed' WHERE utility_sched_id = $_POST[schedule_number] AND rout_no=$_POST[route_id]")." ";  
service_call_decode($util_sched->service_type);
echo  " completed";

//schedule stop 



?>