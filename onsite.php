<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set('display_errors',0); 
//error_reporting(E_ALL);


$person = new Person();
$account = new Account($_GET['account']);


if(isset($_POST['bob'])){
    $compare =$_POST['dos']." ".$_POST['dostime'];
    if(isset($_POST['is_fire'])){
        $cr = 1;
    }
    else {
        $cr =0;
    }
    
    /******************** 
    container_size is the account owned container(s) - using entry number for future deletion
    swap_list is the one you want
    *****************************************************************/
    
    switch($_POST['call_type']){
        case 100: // swap
            $array = array(
                "account_no"=>$_GET['account'],
                "type_of_service"=>$_POST['call_type'],       
                "date_of_service"=>$_POST['dos']." ".$_POST['dostime'],
                "container_size"=>container_amountHolds($_POST['swap_list']),
                "container_label"=>$_POST['swap_list'],        
                "dispatcher_note"=>$_POST['dispatcher_note'],
                "driver_note"=>$_POST['special_instructions'],
                "quantity"=>$_POST['num_containers'],
                "route_status"=>"scheduled",
                "code_red"=>$cr,
                "container_being_swapped_size"=>container_amountHolds_from_containers($_POST['container_size']),//amounts_holds
                "container_being_swapped_label"=>container_own_label($_POST['container_size']),       //id->label
                "entry_for_deletion"=>$_POST['container_size'],
                "created_by"=>$person->user_id
            );
            
        break;
        case 4: // container retrieval
             $uy = $db->query("SELECT container_no from iwp_containers WHERE entry = $_POST[container_size] AND account_no= $_GET[account]");
            
            $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$uy[0]['container_no']);
            
            $array = array(
                "account_no"=>$_GET['account'],
                "type_of_service"=>$_POST['call_type'],       
                "date_of_service"=>$_POST['dos']." ".$_POST['dostime'],
                "container_size"=>$yv[0]['amount_holds'],
                "container_label"=>$_POST['container_size'],        
                "dispatcher_note"=>$_POST['dispatcher_note'],
                "driver_note"=>$_POST['special_instructions'],
                "quantity"=>$_POST['num_containers'],
                "route_status"=>"scheduled",
                "code_red"=>$cr,
                "entry_for_deletion"=>$_POST['container_size'],
                "created_by"=>$person->user_id
            );    
        break;
        default:
             $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$_POST['container_size']);
            $array = array(
                "account_no"=>$_GET['account'],
                "type_of_service"=>$_POST['call_type'],       
                "date_of_service"=>$_POST['dos']." ".$_POST['dostime'],
                "container_size"=>$yv[0]['amount_holds'],
                "container_label"=>$_POST['container_size'],        
                "dispatcher_note"=>$_POST['dispatcher_note'],
                "driver_note"=>$_POST['special_instructions'],
                "quantity"=>$_POST['num_containers'],
                "route_status"=>"scheduled",
                "code_red"=>$cr,
                "created_by"=>$person->user_id
            );    
        break;
    }
    
    
   
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
    
    switch($_POST['new_route']){
        case "later":
            $db->insert($dbprefix."_utility",$array);
            $id =$db->getInsertId();
             $track = array(
                "date"=>date("Y-m-d H:i:s"),
                "user"=>$person->user_id,
                "actionType"=>"Utility Created For Later",
                "descript"=>"Schedule $id",
                "account"=>"$_GET[account]",
                 "pertains"=>2
            );
            $db->insert("xlogs.".$dbprefix."_activity",$track);
            break;
        case "new":
            if($db->insert($dbprefix."_utility",$array)){
                $id =$db->getInsertId();
                echo "util sched id :". $id;
                 $track = array(
                    "date"=>date("Y-m-d H:i:s"),
                    "user"=>$person->user_id,
                    "actionType"=>"New Container Delivery created",
                    "descript"=>"schedule: ".$id,
                    "account"=>"$_GET[account]",
                    "pertains"=>2,
                    "type"=>12,
                );
                $db->insert("xlogs.".$dbprefix."_activity",$track);
                ?>
                 <form id="sent_to_ikg_routing" method="post" action="ikg_routing.php" target="_blank">
                    <input type="text" value="1" name="from_schedule_list"/>
                    <input type="text" class="schecheduled_ids" value="<?php echo $id."|"; ?>"  name="schecheduled_ids"  placeholder="schedule numbers"/>
                    <input type="text" class="accounts_checked" value=" <?php echo $_GET['account']."|"; ?>" name="accounts_checked" placeholder="account numbers" />
                </form>
                <script>
                    $("#sent_to_ikg_routing").submit();
                </script>
                <?php
            }        
            break;
        case "add":
        if($db->insert($dbprefix."_utility",$array)){
                $id =$db->getInsertId();
                ?>
                <form id="sent_to_ikg_routing" method="post" action="ikg_routing.php" target="_blank">
                    <input type="hidden" name="add_to_existing" id="add_to_existing" value="1" readonly="" title="Add to existing value"/>
                    <input type="text" value="1" name="from_routed_util_list"/>
                    <input type="text" class="schecheduled_ids" value="<?php echo $id."|"; ?>"  name="schecheduled_ids"  placeholder="schedule numbers"/>
                    <input type="text" class="accounts_checked" value=" <?php echo $_GET['account']."|"; ?>" name="accounts_checked" placeholder="account numbers" />
                    <input type="text" name="util_number" id="util_number" value="<?php echo $_POST['util_routes']; ?>"/>
                </form>
                <script>
                    $("#sent_to_ikg_routing").submit();
                </script>
                <?php
                
                $track = array(
                    "date"=>date("Y-m-d H:i:s"),
                    "user"=>$person->user_id,
                    "actionType"=>"Container Delivery added to route",
                    "descript"=>"$_GET[account] added to route $_POST[util_routes]",
                    "pertains"=>2,
                    "account"=>"$_GET[account]"
                );
                $db->insert("xlogs.".$dbprefix."_activity",$track);
            }
            break;        
    }
}

?>
<style type="text/css">
body{
    padding:5px 5px 5px 5px;
    margin:0px 0px 0px 0px;
}
td{
    font-size:12px;
    vertical-align:top;
}

.table_data{
    width:250px;
}

input[type=text]{
    width:50px;
}

textarea{
    width:100px;
    height:50px;
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

<div style="width:450px;margin-left:5px;">

    <div class="edit_box_service_call" id="edit_service_call_box" style="top: 215px; display: block;">
    
    <div style="width:450px;padding:12px;margin:auto;text-align:center;">
    
    <h2 style="width: 400px;margin:auto;line-height:35px;">Schedule On Site Service for <?php echo account_NumToName($_GET['account']); ?></h2></div>
    
    
    <form name="add_service_call_form" action="onsite.php?account=<?php echo $_GET['account']; ?>" method="post">
<input type="hidden" value="<?php echo $_GET['account']; ?>" name="location_id" />
<table  style="width: 450px;"><tbody>
<tr><td colspan="10" style="text-align:center;">To close this window, click anywhere outside this box<br /> Pleae disable any pop-up blocker for instant routing.</td></tr>

<tr class="table_row">

<td  class="table_label">Date of Service</td>
<td  class="table_data">
<input type="text" name="dos" value="<?php  if(isset($_GET['sched_util'])){ echo addDayswithdate(date("Y-m-d"),10);} ?>" placeholder="Date here" id="dos" style="width: 100px;border-radius:0px 0px 0px 0px;float:left;"/> <input type="text" placeholder="Time here" name="dostime" id="dostime" style="width: 100px;border-radius:0px 0px 0px 0px;float:left;"/>
</td>
</tr>
</tbody></table>


<fieldset style="text-align:left"><legend>Type of Service</legend><table  style="width: 400px;">
    <tbody>
        <tr><td style="width: 200px;">
            <table style="width: 100%;"><tbody>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type" type="radio" value="6" name="call_type" id="call_type_6" /></td>
                    <td  class="table_data">Site Cleanup</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" value="392" name="call_type" id="call_type_392" /></td>
                    <td  class="table_data">Verify Containment</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" checked="" value="3" name="call_type" id="call_type_3"/></td>
                    <td  class="table_data">Container Delivery</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label">
                    <input class="service_type"  type="radio" value="4" name="call_type" id="call_type_4" /></td>
                    <td  class="table_data">Container Retrieval</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" value="7" name="call_type" id="call_type_7" /></td>
                    <td  class="table_data">Lid Delivery</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" value="8" name="call_type" id="call_type_8" /></td>
                    <td  class="table_data">Wheels: Add/Modify</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" value="10" name="call_type" id="call_type_10" /></td>
                    <td  class="table_data">Lock: Add/Modify</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" value="24" name="call_type" id="call_type_24" /></td>
                    <td  class="table_data">Sensors: Add/Modify</td>
                </tr>
                <tr>
                    <td  class="table_label"><input class="service_type"  type="radio" value="100" name="call_type" id="call_type_100" /></td>
                     <td  class="table_data">Swap <div id="totelist">
                     <?php containerList("","swap_list",""); ?>
                     </div></td>
                    
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" value="20" name="call_type" id="call_type_20" /></td>
                    <td  class="table_data">Other</td>
                </tr>
            </tbody></table>

</td>
 <script>
 $("#totelist").hide();
 $(".service_type").click(function(){
    if( $(this).attr('id') == "call_type_100"  ){
         $("#totelist").show();
    } else {
         $("#totelist").hide();
    }
 });
 </script>

<td>
            <table width="100%" align="center"><tbody><tr class="table_row">
            <td  class="table_label">Class</td>
            <td  class="table_data">
            <?php 
                
                if(count($account->barrel_info)>0){
                    foreach ( $account->barrel_info as $totes ){
                        //echo "<input type='checkbox' value='$totes[container_id]'/>&nbsp; $totes[container_label]<br/>";
                    }  
                }
                containerList("","");
            ?>
            </td></tr><tr class="table_row">
            <td  class="table_label"><span title="How many containers?">Qty</span></td>
            <td  class="table_data"><input type="text" value="1" size="3" name="num_containers" /><br /> <span class="mini">(optional)</span></td>
            </tr>
            
            
            <tr class="table_row">
            <td  class="table_label">Dispatcher<br>Note</td>
            <td  class="table_data"><textarea name="dispatcher_note" ></textarea></td>
            </tr>
            <tr class="table_row">
            <td  class="table_label">Special<br>Instructions<br><span style="font-size:smaller;">For the Driver</span></td>
            <td  class="table_data"><textarea name="special_instructions"></textarea></td>
            </tr>
            </tbody>
            </table>



</td></tr></tbody></table>




</fieldset>



<fieldset style="text-align:left"><legend>Routing</legend>

<table style="width:400px;"><tbody><tr class="table_row" >
<td  class="table_label"><input type="radio" checked="" value="later" name="new_route" /> </td>
<td  class="table_data">Route Later</td>
</tr>
<tr class="table_row">
<td  class="table_label"><input type="radio" value="new" name="new_route" /></td>
<td  class="table_data">Create New Route <br/></b>( <b>Please be sure your pop-up blocker is off</b> )</td>
</tr>
<tr class="table_row">
<td  class="table_label"><input type="radio" value="add" name="new_route" /></td>
<td  class="table_data">Add to Route <select id="util_routes"  name="util_routes">
<?php
$ruc = $db->where("status","enroute")->get($dbprefix."_list_of_utility");

if(count($ruc)>0){
    foreach($ruc as $routes){
        echo "<option value='$routes[route_id]'>$routes[ikg_manifest_route_number]</option>";
    }
}

?>
</tr>
</tbody></table></fieldset>

<table style="width:150px;"><tbody><tr class="table_row">
<td  class="table_label" style="text-align: left;width:75px;"><input type="checkbox" name="is_fire" />&nbsp;<span style="color:#ff0000;font-weight:bold;">Code Red</span></td>
</tr>
<tr><td width="30"></td><td></td></tr></tbody></table><div align="center">
<input type="submit" value="Schedule This Service Call" name="bob" /></div></form></div>
</div>

<script>
$("#close").click(function(){
    alert("clicked");
   window.parent.Shadowbox.close(); 
});

$("#call_type_4,#call_type_100").click(function(){
   $.get("own_container.php",{account_no:<?php echo $_GET['account']; ?>},function(data){
        $("#container_size").html(data);
   }); 
});

$("#call_type_6,#call_type_392,#call_type_3,#call_type_7,#call_type_8,#call_type_10,#call_type_24,#call_type_20").click(function(){
   $.get("all_containers.php",function(data){
        $("#container_size").html(data);
   }); 
});


$("input#dos").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("input#dostime").timepicker();
</script>