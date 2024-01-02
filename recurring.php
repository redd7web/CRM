
<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
$person = new Person();
if(isset($_GET['prev_route'])){
    $details = $db->query("SELECT * FROM iwp_ikg_manifest_info WHERE route_id=$_GET[prev_route]");
    echo "account_numbers: ". $details[0]['account_numbers'];
    $get_new = explode("|",$details[0]['account_numbers']);
    array_pop($get_new);
    
    echo "<br/>SELECT * FROM iwp_scheduled_routes WHERE route_status='scheduled' AND account_no in(".implode(",",$get_new).")<br/>";
    $check_new = $db->query("SELECT schedule_id FROM iwp_scheduled_routes WHERE route_status='scheduled' AND account_no in(".implode(",",$get_new).")");
}



if(isset($_POST['new_route'])){
    
    $prev_info = new IKG($_POST['previous_route']);
    $aco = new Account();
    $jix = str_replace(" ","-",$_POST['title']);
    $jix = preg_replace('/[^A-Za-z0-9\-]/', '', trim($jix));
    
    $b = explode("|",$_POST['scheds_to_be_added']);
    array_pop($b);
    
    $c = explode("|",$_POST['account_to_be_added']);
    array_pop($c);
    
    $exp =0;
    
    foreach($c as $account_expected){
        $exp += $aco->expected_gallons($account_expected);
    }
    
    $route_info = array(
        "ikg_manifest_route_number"=>$jix,
        "scheduled_date"=>$_POST['scheduled_date'],
        "driver"=>$_POST['drivers'],
        "account_numbers"=>$_POST['account_to_be_added'],        
        "location"=>$prev_info->location,
        "inventory_code"=>$prev_info->inventory_code,
        "lot_no"=>$prev_info->lot_no,
        "recieving_facility"=>$prev_info->recieving_facility_no,
        "facility_address"=>$prev_info->facility_address,
        "facility_rep"=>$prev_info->facility_rep,
        "truck"=>$prev_info->truck,
        "license_plate"=>$prev_info->license_plate,
        "recurring"=>1
    );
    $db->insert("iwp_ikg_manifest_info",$route_info); 
    $id = $db->getInsertId();
    
    $route_list = array(
        "status"=>"enroute",
        "ikg_manifest_route_number"=>$jix,
        "facility"=>$prev_info->recieving_facility_no,
        "created_date"=>date("Y-m-d"),
        "created_by"=>$person->user_id,
        "scheduled"=>$_POST['scheduled_date'],
        "driver"=>$_POST['drivers'],
        "stops"=>count($b),
        "inc"=>count($b),
        "expected"=>$exp,        
        "route_id"=>$id
    );
    
    print_r($route_list);
    
    $db->insert("iwp_list_of_routes",$route_list);   
    
    echo "<br/>UPDATE iwp_scheduled_routes SET route_status='enroute',route_id=$id WHERE schedule_id IN (". implode(",",$b) .")<br/>";
    $db->query("UPDATE iwp_scheduled_routes SET route_status='enroute',route_id=$id,	scheduled_start_date='$_POST[scheduled_date]' WHERE schedule_id IN (". implode(",",$b) .")");
    
   
    
}


?>


Create recurring route ?<br />

<form action="recurring.php" method="post" style="margin-top: 20px;">
Rout Title: <input type="text" value="" placeholder=""  id="title" name="title"/><br /><br />

Set Driver: <?php getDrivers(); ?><br /><br />

Set Scheduled Date: <input type="text" id="scheduled_date" name="scheduled_date" placeholder="Please Click here to choose a date" value="<?php 

    if($details[0]['recur_days']>0){
        $rec = $details[0]['recur_days'];
    } else {
        $rec = 0;
    }
    
    
    echo date('Y-m-d', strtotime(date("Y-m-d"). ' + '.$rec.' days')); ?>" /><br /><br />
<input type="text" readonly="" name="scheds_to_be_added" value="<?php if(count($check_new)>0){  
    foreach($check_new as $update_scheds){
        echo $update_scheds['schedule_id']."|";
    }
    
} ?>" placeholder="Schedules to be added to recurring route" title="Schedules to be added"/>

<input type="text" readonly="" value="<?php echo $_GET['prev_route']; ?>" name="previous_route"  id="previous_route" title="Previous Route"/>

<input type="text" readonly="" name="account_to_be_added" value="<?php echo $details[0]['account_numbers']; ?>"  title="Accounts"/><br />

<input type="submit" value="Set Route" id="new_route" name="new_route"/>
</form>
<script>
$("input#scheduled_date").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true,yearRange: "1:c+10"});

//$(".view_route").submit();
</script>