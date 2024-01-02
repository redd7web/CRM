<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",0);
$account = new Account($_GET['account_no']);

?>
<fieldset style="text-align:left"><legend>Type of Service</legend>
    <table  style="width: 100%;">
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
                     <?php containerList("","swap_list"); ?>
                     </div></td>
                    
                </tr>
                <tr class="table_row">
                    <td  class="table_label"><input class="service_type"  type="radio" value="20" name="call_type" id="call_type_20" /></td>
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
                    foreach ( $account->barrel_info as $totes ){
                        //echo "<input type='checkbox' value='$totes[container_id]'/>&nbsp; $totes[container_label]<br/>";
                    }  
                }
                containerList("","","");
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



</td></tr><tr><td colspan="3">
 
            
            <input type='hidden' value='1' name='from_routed_grease_list'/>
</td></tr></tbody></table>




</fieldset>
 <script>
 $("#totelist").hide();
 $(".service_type").click(function(){
    if( $(this).attr('id') == "call_type_100"  ){
         $("#totelist").show();
    } else {
         $("#totelist").hide();
    }
 });
 
 $("#call_type_4,#call_type_100").click(function(){
   $.get("own_container.php",{account_no:<?php echo "'".$_GET['account_no']."'"; ?>},function(data){
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