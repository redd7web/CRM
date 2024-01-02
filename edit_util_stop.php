<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set('display_errors',0); 
//error_reporting(E_ALL);

//echo "schedule id:$_GET[schedule_id]<br/>";
$person = new Person();



if(isset($_POST['bob'])){
    
    //print_r($_POST);
   
    
    if(strlen(trim($_POST['dos'])) > 0   ){
        $date = $_POST['dos'];
    }else{
        $date = date("Y-m-d");
    }
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
                "date_of_service"=>"$date",
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
                "date_of_service"=>"$date",
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
                "date_of_service"=>"$date",
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
    
    //echo "<pre>";
    //var_dump($array);
    //echo "</pre>";
    $db->where("utility_sched_id",$_GET['schedule_id'])->update($dbprefix."_utility",$array);
    
}
$account = new Account($_GET['account']);
$util_stop = new Util_Stop($_GET['schedule_id']);
//print_r($util_stop);
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
</style>

<div style="width:450px;margin-left:5px;">

    <div class="edit_box_service_call" id="edit_service_call_box" style="top: 215px; display: block;">
    
    <div style="width:450px;padding:12px;margin:auto;text-align:center;">
    
    <h2 style="width: 400px;margin:auto;line-height:35px;">Schedule On Site Service for <?php echo account_NumToName($_GET['account']); ?></h2></div>
    
    
    <form name="add_service_call_form" action="edit_util_stop.php?account=<?php echo $_GET['account']; ?>&schedule_id=<?php echo $_GET['schedule_id'] ?>" method="post">
<input type="hidden" value="<?php echo $_GET['account']; ?>" name="location_id" />
<table  style="width: 450px;"><tbody>
<tr><td colspan="10" style="text-align:center;">To close this window, click anywhere outside this box<br /> Pleae disable any pop-up blocker for instant routing.</td></tr>

<tr class="table_row">

<td  class="table_label">Date of Service</td>
<td  class="table_data">
<input type="text" name="dos" value="<?php echo $util_stop->scheduled_start_date; ?>" placeholder="Date here" id="dos" style="width: 100px;border-radius:0px 0px 0px 0px;float:left;"/>
</td>
</tr>
</tbody></table>


<fieldset style="text-align:left"><legend>Type of Service</legend><table  style="width: 400px;">
    <tbody>
        <tr><td style="width: 200px;">
            <table style="width: 100%;"><tbody>
                <tr class="table_row">
                    <td  class="table_label"><input <?php if($util_stop->service_type == 6){
                        echo " checked ";
                    }  ?>  class="service_type" type="radio" value="6" name="call_type" id="call_type_6" /></td>
                    <td  class="table_data">Site Cleanup</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input  <?php if($util_stop->service_type == 392){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" value="392" name="call_type" id="call_type_392" /></td>
                    <td  class="table_data">Verify Containment</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input  <?php if($util_stop->service_type == 3){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" checked="" value="3" name="call_type" id="call_type_3"/></td>
                    <td  class="table_data">Container Delivery</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label">
                    <input class="service_type"  <?php if($util_stop->service_type == 4 ){
                        echo " checked ";
                    }  ?>  type="radio" value="4" name="call_type" id="call_type_4" /></td>
                    <td  class="table_data">Container Retrieval</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input  <?php if($util_stop->service_type == 7){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" value="7" name="call_type" id="call_type_7" /></td>
                    <td  class="table_data">Lid Delivery</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input  <?php if($util_stop->service_type == 8){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" value="8" name="call_type" id="call_type_8" /></td>
                    <td  class="table_data">Wheels: Add/Modify</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input  <?php if($util_stop->service_type == 10){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" value="10" name="call_type" id="call_type_10" /></td>
                    <td  class="table_data">Lock: Add/Modify</td>
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input  <?php if($util_stop->service_type ==24 ){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" value="24" name="call_type" id="call_type_24" /></td> 
                    <td  class="table_data">Sensors: Add/Modify</td>
                </tr>
                <tr>
                    <td  class="table_label"><input  <?php if($util_stop->service_type ==100 ){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" value="100" name="call_type" id="call_type_100" /></td>
                     <td  class="table_data">Swap <div id="totelist">
                     <?php containerList($util_stop->container_label,"swap_list"); ?>
                     </div></td>
                    
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input  <?php if($util_stop->service_type == 20){
                        echo " checked ";
                    }  ?> class="service_type"  type="radio" value="20" name="call_type" id="call_type_20" /></td>
                    <td  class="table_data">Other</td>
                </tr>
            </tbody></table>

</td>


<td>
            <table width="100%" align="center"><tbody><tr class="table_row">
            <td  class="table_label">Class</td>
            <td  class="table_data">
            <?php 
                
                if(count($account->barrel_info)>0){
                    $compare ="";
                    if($util_stop->container_label !=NULL){
                        $compare = $util_stop->container_label;
                    }
                    foreach ( $account->barrel_info as $totes ){
                        //echo "<input type='checkbox' value='$totes[container_id]'/>&nbsp; $totes[container_label]<br/>";
                    }  
                }
                containerList($compare,"");
            ?>
            </td></tr><tr class="table_row">
            <td  class="table_label"><span title="How many containers?">Qty</span></td>
            <td  class="table_data"><input type="text" value="<?php 
                if($util_stop->quantity == NULL || $util_stop->quantity<2){ 
                    echo "1";
                } else { 
                    echo $util_stop->quantity;
                } ?>" size="3" name="num_containers" /><br /> <span class="mini">(optional)</span></td>
            </tr>
            
            
            <tr class="table_row">
            <td  class="table_label">Dispatcher<br/>Note</td>
            <td  class="table_data"><textarea name="dispatcher_note" ><?php 
                echo $util_stop->notes;
            ?></textarea></td>
            </tr>
            <tr class="table_row">
            <td  class="table_label">Special<br/>Instructions<br/><span style="font-size:smaller;">For the Driver</span></td>
            <td  class="table_data"><textarea name="special_instructions"><?php echo $util_stop->special_instructions; ?></textarea></td>
            </tr>
            </tbody>
            </table>



</td></tr></tbody></table>




</fieldset>





<table style="width:150px;"><tbody><tr class="table_row">
<td class="table_label" style="text-align: left;width:75px;"><input type="checkbox" name="is_fire" />&nbsp;<span style="color:#ff0000;font-weight:bold;">Code Red</span></td>
</tr>
<tr><td width="30"></td><td></td></tr></tbody></table><div align="center">
<input type="submit" value="Update This Service Call" name="bob" /></div></form></div>
</div>

<script>
$("#close").click(function(){
    alert("clicked");
   window.parent.Shadowbox.close(); 
});


 <?php 
 if($util_stop->service_type == 100){
    ?>
    $("#totelist").show();
    $.get("own_container.php",{account_no:<?php echo $_GET['account'] ?>},function(data){
        $("#container_size").html(data);
   }); 
    <?php
 }else{
    ?>
    $("#totelist").hide();
    <?php
 }
 
 ?>
 
 
 $(".service_type").click(function(){
    if( $(this).attr('id') == "call_type_100"  ){
         $("#totelist").show();
    } else {
         $("#totelist").hide();
    }
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