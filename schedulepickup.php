

<?php
include "protected/global.php";
$person = new Person();

$it = array(
    2060,
    2028,
    99
);



if( in_array($person->user_id,$it) ){
    ini_set("display_errors",1);    
}
$account = new Account($_GET['account_no']);
$this_route = "";
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html" />
<meta name="author" content="Ede Dizon" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="css/style.css"/>
<style type="text/css">
body{
    background:rgb(242,242,242);
    font-family:arial;
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
    -webkit-overflow-scrolling: touch;
}

td{
    text-align:left;
    padding:0px 0px 0px 0px;
}
::-webkit-scrollbar {
    width: 15px;
    height: 15px;
    border-bottom: 1px solid #eee; 
    border-top: 1px solid #eee;
}
::-webkit-scrollbar-thumb {
    border-radius: 8px;
    background-color: #C3C3C3;
    border: 2px solid #eee;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.2); 
} 
</style>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<?php

if(  isset($_POST['schedulepickup'])  ){  
    if(isset($_POST['date_sched_pickup_month'])  && strlen($_POST['date_sched_pickup_month'])>0){
        $scheddate =$_POST['date_sched_pickup_month'];
    } else {
        $scheddate = date("Y-m-d");
    }
    
    $notex = NULL;
    $fire="";    
    if (isset($_POST['is_fire'])){
        $fire =1;
    } else {
        $fire =0;
    }
    
    $k =date('Y-m-d');
   
     $x = $db->query("SELECT scheduled_start_date,account_no,route_id,schedule_id,route_status FROM iwp_scheduled_routes WHERE account_no=$_POST[account_no] AND route_status IN ('enroute','scheduled') AND deleted =0");
     if(count($x)>0){
        if($x[0]['route_id'] != NULL){
            $route_info = $db->query("SELECT ikg_manifest_route_number FROM iwp_ikg_manifest_info WHERE route_id = ".$x[0]['route_id']);
            $this_route = " <form style='cursor:pointer;' target='_blank' action='oil_routing.php' method='post' class='ikg_check'><input type='hidden' name='from_routed_oil_pickups' value='1'><input type='hidden' value='".$x[0]['route_id']."' name='manifest'/><span style='text-decoration:underline;'>Click here to see route ".$route_info[0]['ikg_manifest_route_number']."</span></form> ";
        }else{
            $this_route = "and is scheduled for ".$x[0]['scheduled_start_date'];
        }
     }
    
    switch($_POST['later_or_new']){
        case "add_to":
            if(count($x)>0){//does the stop already exist?                
               switch($x[0]['route_status']){
                    case "scheduled":
                    ?>
                    <form action="oil_routing.php" method="post" id="add_to_x" target="_blank">
                    <input type="hidden" name="from_routed_oil_pickups" id="from_routed_oil_pickups" title="from_routed_oil_pickups" value="1"/>
                                        
                    <input type="text" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers" value="<?php echo $x[0]['schedule_id']."|"; ?>" readonly=""/>
                    <input type="text" class="accounts_checked" name="accounts_checked" placeholder="account numbers" readonly="" value="<?php echo $_POST['account_no']."|"; ?>"/>
                   <input type="text" name="from_routed_oil_pickups" value="1"/>
                   <input type="hidden" name="extra_mode" value="1"/>
                   <input type="hidden" name="manifest"  value="<?php echo $_POST['existing_routes']; ?>"/>
                   </form>
                   <script>
                    $("form#add_to_x").submit();
                   </script>
                   <?php
                    break;
                    case "enroute":case "completed": // if stop is already routed or completed but route is still open
                         echo "<span style='font-size:24px;font-weight:bold;color:red;'>Schedule already exists $this_route</span>";
                    break;
               }
            }else{
                $kut = $db->where("route_id",$_POST['existing_routes'])->get($dbprefix."_ikg_manifest_info","driver");
                $addinfo = Array(
                    "route_id"=>$_POST['existing_routes'],
                    "scheduled_start_date"=>$scheddate,
                    "facility_origin"=>23,
                    "code_red"=>$fire,
                    "account_no"=>$_GET['account_no'],
                    "route_status"=>"scheduled",
                    "created_by"=>$person->user_id,
                    "date_created"=>$k,
                    "driver"=>$kut[0]['driver']
                );//create schedule if it doesn't exist
            
                 $db->insert($dbprefix."_scheduled_routes",$addinfo);
                 $sched_num = $db->getInsertId(); 
                 echo "Scheduled pickup for ". account_NumtoName($_GET['account_no']). "added to route ". $_POST['existing_routes'];// if Scheduled route was inserted  insert the corresponding notes if they exist 
                /*if (){
                    
                    
                    if(   ( isset($_POST['dispatcher_note']) && strlen(trim($_POST['dispatcher_note'])) ) || ( isset($_POST['special_instructions']) && strlen(trim($_POST['special_instructions'])) >0   )  ){
                        if(isset($_POST['dispatcher_note'])  && strlen(trim($_POST['dispatcher_note']))>0){
                            $notex = $_POST['dispatcher_note'];
                        }
                        if(isset($_POST['special_instructions']) && strlen(trim($_POST['special_instructions'])) ){
                            $notex .= "|".$_POST['special_instructions'];
                        }
                        $schednotes = Array(  //route_no will be updated upon route creation                            
                            "schedule_id"=>$sched_num,          
                            "author_id"=>$person->user_id,
                            "date"=>date('Y-m-d h:i:s'),
                            "notes"=>$notex,                
                            "created_by"=>$person->user_id,
                            "account_no"=>"$_POST[account_no]",
                        );
                        $db->insert($dbprefix."_notes",$schednotes);
                    }
                } */
                
                /*
                $track = array(
                    "date"=>date("Y-m-d H:i:s"),
                    "user"=>$person->user_id,
                    "actionType"=>"Scheduled added to Route",
                    "descript"=>"Schedule $sched_num added to Route ".$_POST['existing_routes'],
                    "account"=>$_GET['account_no'],
                    "pertains"=>2
                );
                $db->insert("xlogs.".$dbprefix."_activity",$track);*/
                
                ?>
                <form action="oil_routing.php" method="post" id="add_to_x"  target="_blank">
                <input type="hidden" name="from_routed_oil_pickups" id="from_routed_oil_pickups" title="from_routed_oil_pickups" value="1"/>
                                    
                <input type="text" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers" value="<?php echo "$sched_num|"; ?>" readonly=""/>
                    <input type="text" class="accounts_checked" name="accounts_checked" placeholder="account numbers" readonly="" value="<?php echo $_POST['account_no']."|"; ?>"/>
               <input type="hidden" name="extra_mode" value="1"/>
               <input type="hidden" name="manifest"  value="<?php echo $_POST['existing_routes']; ?>"/>
               </form>
               <script>
                $("form#add_to_x").submit();
               </script>
               <?php
            }
            break;
        case "later":     
           if(count($x)>0){                
                echo "<span style='font-size:24px;font-weight:bold;color:red;'>Schedule already exists $this_route</span>";
            }else{
                $schedinfo = Array(//id will be automatically assigned in database , route_no will be updated upon route creation 
                    "scheduled_start_date"=>$scheddate,
                    "facility_origin"=>$account->division,
                    "code_red"=>$fire,
                    "account_no"=>"$_GET[account_no]",
                    "route_status"=>"scheduled",
                    "created_by"=>$person->user_id,
                    "date_created"=>$k       
                );
                var_dump($schedinfo);
                if( $db->insert("iwp_scheduled_routes",$schedinfo) ){
                    $sched_num = $db->getInsertId();
                    //echo "sched_num: ".$sched_num;      
                     if(   ( isset($_POST['dispatcher_note']) && strlen($_POST['dispatcher_note']) ) || ( isset($_POST['special_instructions']) && strlen($_POST['special_instructions']) >0   )  ){
                        if(isset($_POST['dispatcher_note']) && strlen($_POST['dispatcher_note'])>0){
                            $notex = $_POST['dispatcher_note'];
                        }
                        if(isset($_POST['special_instructions']) && strlen($_POST['special_instructions']) ){
                            $notex .= "|".$_POST['special_instructions'];
                        }
                        
                        $schednotes = Array(  //route_no will be updated upon route creation                            
                            "schedule_id"=>$sched_num,          
                            "author_id"=>$person->user_id,
                            "date"=>date('Y-m-d h:i:s'),
                            "notes"=>$notex,                
                            "created_by"=>$person->user_id,
                            "account_no"=>"$_POST[account_no]",
                        );
                        $db->insert($dbprefix."_notes",$schednotes);
                        echo "Note: $notex for schedule $sched_num successfully made<br/><br/>";
                    }
                    echo "Successfully scheduled ".account_NumtoName($_GET['account_no']) ." for later";
                 }
                 
                $track = array(
                    "date"=>date("Y-m-d H:i:s"),
                    "user"=>$person->user_id,
                    "actionType"=>"Scheduled for Later",
                    "descript"=>"Scheduled $sched_num",
                    "account"=>$_GET['account_no'],
                    "pertains"=>2
                );
                $db->insert("xlogs.".$dbprefix."_activity",$track);
            }
        
            
            break;
            case "new":
                if(count($x)>0){                
                    echo "<span style='font-size:24px;font-weight:bold;color:red;'>Schedule already exists $this_route</span>";
                }else{
                    $schedinfo = Array(//id will be automatically assigned in database , route_no will be updated upon route creation 
                        "scheduled_start_date"=>$scheddate,
                        "facility_origin"=>$account->division,
                        "code_red"=>$fire,
                        "account_no"=>"$_GET[account_no]",
                        "route_status"=>"scheduled",
                        "created_by"=>$person->user_id,
                        "date_created"=>$k       
                    );
                    $db->query("DELETE FROM iwp_scheduled_routes WHERE account_no = $_GET[account_no]");
                    var_dump($schedinfo);
                    if( $db->insert("iwp_scheduled_routes",$schedinfo) ){
                
                        $sched_num = $db->getInsertId();
                        echo $sched_num;
                        ?>
                        <!--- for immediate routing ---!>
                        <form action="oil_routing.php" id="route_now" method="post" target="_blank">
                        <input type="hidden"  name="from_schoipu" value="1" />
                        <input type="hidden" class="schecheduled_ids" value="<?php echo $sched_num."|"; ?>"  name="schecheduled_ids" placeholder="schedule numbers"/> 
                        <input type="hidden" name="accounts_checked" id="accounts_checked" value="<?php echo $_GET['account_no']."|"; ?>"/>
                        </form>
                        <script>
                            $("#route_now").submit();
                        </script>
                        <!--- for immediate routing ---!>
                    <?php
                    }
                }
            break;
        default:
            echo "Please choose Later, Route Now, or Add to a route."; 
    }
}
?>
</head>
<body>
<div style="left: 471px; top: 550px; display: block;" id="edit_pickup_box" class="edit_box_pickup">
<form method="post" action="schedulepickup.php?account_no=<?php echo $_GET['account_no']; ?>"  style="height: 350px;">
<table align="center"  style="padding: 0px 0px 0px 0px;width:100%;">

    <tbody>
    <tr><td colspan="10" style="text-align: center;"><span style="width:80%;padding:12px;margin:auto;text-align:center;font-weight:bold;font-size:16px;text-transform:uppercase;">Schedule an Oil Pickup</span><br/></td></tr>
    <tr class="table_row">
        <td class="table_label" align="right" nowrap="" valign="top">Date of Pickup</td>
        <td class="table_data" align="left" valign="top">

<input type="text"  name="date_sched_pickup_month" value="<?php echo $account->schedule['scheduled_start_date']; ?>" id="date_sched_pickup_month" placeholder="Click to select pick up date"/>
</td>
</tr>
<tr class="table_row">

<tr><td colspan="10" style="text-align: center;">
<input type="radio" name="later_or_new" value="later"/>&nbsp;Route Later&nbsp;&nbsp; <input type="radio" name="later_or_new" id="new" value="new"/>&nbsp;Create New Route&nbsp;&nbsp;<input type="radio" id="add_to" name="later_or_new" value="add_to"/> Add to Existing Route&nbsp;&nbsp;<select name="existing_routes">
    <?php  
            $route_list_table = $dbprefix."_list_of_routes";
            $scrts = $db->query("SELECT route_id,ikg_manifest_route_number,driver FROM $route_list_table WHERE status IN('new','enroute','scheduled') AND deleted = 0 ORDER BY ikg_manifest_route_number ASC");
            
            if(count($scrts)>0){
                foreach($scrts as $add_existing){
                    echo "<option value='$add_existing[route_id]'>$add_existing[route_id] $add_existing[ikg_manifest_route_number] (".  uNumToName($add_existing['driver']).")</option>";
                }
            }
    ?>
</select>
</td></tr>


</tr>

<tr class="table_row">
<td class="table_label" align="right" nowrap="" valign="top">Note<br><span style="font-size:smaller;">For the Dispatcher</span><br/><span style="font-size:70%;">( Optional )</span></td>
<td class="table_data" align="left" valign="top"><textarea cols="10" rows="4" name="dispatcher_note" id="dispatcher_note"></textarea></td>
</tr>
<tr class="table_row">
<td class="table_label" align="right" nowrap="" valign="top">Special<br>Instructions<br><span style="font-size:smaller;">For the Driver</span><br/><span style="font-size:7;">( Optional )</span></td>
<td class="table_data" align="left" valign="top"><textarea cols="10" rows="4" name="special_instructions" id="special_instructions"></textarea></td>
</tr>
<tr class="table_row">
<td class="table_label" align="right" nowrap="" valign="top"></td>
<td class="table_data" align="left" valign="top"><table align="left"><tbody><tr><td class="table_label" align="right" nowrap="" valign="middle"><input name="is_fire" type="checkbox" id="is_fire" value="1"/></td>
<td class="table_data" colspan="10"><span style="color:#ff0000;font-weight:bold;text-transform: uppercase;">Emergency</span>&nbsp;&nbsp;&nbsp;&nbsp;<input id="schedulepickup" name="schedulepickup" value="Schedule Now" type="submit" style="float:right;" /></td>
</tr></tbody></table></td>
</tr>
<input type="hidden" value="<?php echo $_GET['account_no']; ?>" name="account_no"/>
<input type="hidden" value="<?php  echo $account->schedule['schedule_id'];   ?>"  name="scedule_id_"  /> 
</tbody></table></form></div>
<script>
$("#date_sched_pickup_month").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true,yearRange: "1:c+10"});
$(".ikg_check").click(function(){
   $(this).submit(); 
});
</script>
</body>
</html>