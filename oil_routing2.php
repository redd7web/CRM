<head>
<meta charset="UTF-8" />
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
<?php   



include "protected/global.php";

$it = array(
    2060,
    2028,
    99
);

ini_set('memory_limit', '4096M');
if( in_array($person->user_id,$it) ){
    ini_set("display_errors",1);    
}

include "source/scripts.php"; 
include "source/css.php";


function geocode($address){
    $region = "US";
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    //$url = "http://maps.google.com/maps/api/geocode/json?address={$address}&key=RYEdcTxmYN7GgIMOHCvCuHL56k4";
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=true&region=$region&key=AIzaSyC7RNYIQEkNcr0lzieZFLgPY09jdeWnRtM";
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    return $resp['status'];
}

$data_table = $dbprefix."_data_table";
$newlist_accounts=""; // initialization
$newlist_scheds=""; // initialization
$actns = "";
$schnums = "";
$total_col =0;
$total_dif_mile = 0;
$bp = new Account();

 
	

if(isset($_SESSION['id'])){ 
    $person = new Person();
}
?>
<script type="text/javascript" src="plugins/jq-signature-master/jq-signature.js"></script>
<?php

//var_dump($_POST);

if(isset($_POST['from_routed_oil_pickups'])){
    //echo $_POST['manifest']."<br/>";
    
    $ikg_info = new IKG($_POST['manifest']);
    
    if( in_array($person->user_id,$it) ){
        //var_dump($ikg_info);
    }
    
    

    
    if(isset($_POST['extra_mode'])){//are you adding stops to an existing route?
        //echo "extra mode set, inserting new accounts: $_POST[accounts_checked] into existing route $_POST[manifest]";
        
        $acnts = array_map('intval', explode ("|", $_POST['accounts_checked'])  );//additional accounts
        $schnums = array_map('intval', explode("|",$_POST['schecheduled_ids']) );//additional schedules
        //echo "sdfsdfd";
        array_pop($acnts);
        array_pop($schnums);
        $newlist_accounts = array_merge($ikg_info->account_numbers,$acnts);
        $newlist_scheds = array_merge($ikg_info->scheduled_routes,$schnums);
        $newlist_accounts = array_unique($newlist_accounts);
        $newlist_scheds = array_unique($newlist_scheds);
    }else {
        $newlist_accounts = $ikg_info->account_numbers;
        $newlist_scheds = $ikg_info->scheduled_routes;
        $newlist_accounts = array_unique($newlist_accounts);
        $newlist_scheds = array_unique($newlist_scheds);
        
        /*echo"<pre>";
        print_r($newlist_scheds);
        echo "</pre>";*/
    }
    
   
}
else if( isset($_POST['from_schoipu'])  ){  //from scheduled pickups page
    //echo "New route";     
    //$ikg_info = new IKG(0); 
    
    $actns = explode("|",$_POST['accounts_checked']);
    $schnums = explode("|",$_POST['schecheduled_ids']);
    array_pop($actns);
    array_pop($schnums);
    $acnts = array_unique($acnts);
    $scheds = array_unique($scheds);    
} 


?>

<style type="text/css">

input[type="text"] {
    border: 1px solid #bbb;
    border-radius: 5px;
    height: 25px;
    width: 140px;
    margin-left:5px;
}

.account_row{
    cursor:pointer;
}
table#sortable{
    border-collapse: collapse;
}

</style>
<div id="debug" style="height: auto;"></div>
<input type="hidden" name="mode" id="mode"  value="<?php if(isset($_POST['from_routed_oil_pickups'])){//echo "update";
}else {
    //echo "save";
    }
?>

"/>

</head>
<body>
<div id="loading" style="position: fixed;width:100%;height:100%;z-index:9999;background:rgba(255,255,255,.7) url(img/loading.gif) no-repeat center center;text-align:center; font-weight:bold;font-size:30px;top:0px;left:0px;">
<br /><br />
Processing...
</div>
<div id="wrapper">
<div id="spacer" style="width: 100%;height:10px;">&nbsp;</div>

<div class="content-wrapper" style="min-height:450px;height: auto;">
    <div id="fullgray" style="width: 100%;height:auto;background: linear-gradient(#F0F0F0, #CFCFCF) repeat scroll 0 0 rgba(0, 0, 0, 0);border-bottom: 1px solid #808080;margin-bottom:10px;">
            <div id="info_hold" style="width: 800px;margin:auto;height:auto;background:transparent;padding">
            <table style="width:800px;height:auto;">
                <tr>
                <td colspan="5" style="color: red;font-size:12px;text-align:center;text-transform: uppercase;">Please do not click the back or refresh button on the browser, if you need to refresh please click the manual refresh button</td></tr>
                <tr>
                    <td>Route ID:</td>
                    <td id="rid"> 
                    <?php 
                        if( isset($_POST['from_routed_oil_pickups']) ){echo "$ikg_info->route_id";}?> 
                    </td>
                    <td>Created: 
                    <?php   
                        if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->created_date; }else { echo date("Y-m-d");}   ?>
                    </td>
                    <td>By:<?php 
                            if( !isset($_POST['from_routed_oil_pickups'])  ){
                                echo uNumToName($person->user_id);  
                            }else{
                                echo $ikg_info->created_by;
                                
                            }?> 
                    </td>
                    <td>Facility: <span id="facholder"><?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->recieving_facility; }?></span> 
                    </td>
                </tr>            
            </table>
            <div style="clear: both;"></div>
            </div>
            <div style="clear: both;"></div>
    </div>
    
    <div id="fullgray" style="width: 100%;height:150px;background: linear-gradient(#F0F0F0, #CFCFCF) repeat scroll 0 0 rgba(0, 0, 0, 0);border-bottom: 1px solid #808080;margin-bottom:10px;">
        <div id="info_hold" style="width: 1000px;margin:auto;height:100px;background:transparent;padding">
                <div id="leftsideboxes" style="float: left;width:600px;height:100px;">
                       <div class="leftsides" style="width:600px;height:100px;float:left;">
                       
                        <div class="box" style="width:250px;border-radius:7px;height:60px;margin-bottom:5px;cursor:pointer;">
                        <table><tr><td style="text-align: center;vertical-align:middle;width:250px;height:60px;" id="edata">
                        <?php if(isset($_POST['from_routed_oil_pickups'])){    ?>
                        
                            <a class="enterDataLink" href="enterData.php?route_id=<?php echo $ikg_info->route_id;?>&day=1" target="_blank"><img src="img/enterdata.jpg"/></a>                         
                         <?php }else{
                            echo "<span style='font-size:12px;'>Please save the route to enter data.</span>";
                         } ?>
                         
                         </td></tr></table>
                        </div>
                        <div <?php  if(isset($_POST['from_routed_oil_pickups'])){ echo 'id="refresh"';} else { echo "title='Please Create a route before refreshing.' id='null'";  } ?> class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;background:url(img/refresh.png) no-repeat center top;background-size:contain;cursor:pointer;"></div>  
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;text-align:center;cursor:pointer;" id="friendly">
                            <?php  if(isset($_POST['from_routed_oil_pickups'])){ ?>
                            <a style="font-size: 30px;font-weight:bold;position:relative;" title="Friendly / IWP accounts" href="friendly_breakdown.php?route_id=<?php echo $_POST['manifest']; ?>" rel="shadowbox"><img style='width:60px;height:60px;' src='img/hands.jpg'/></a>
                            <?php } ?>
                        </div>
                        
                        
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;">
                        <?php 
                        if( isset($_POST['from_routed_oil_pickups']) ) {
                            
                            echo "<a href='indexmap.php?route=$_POST[manifest]&type=oil' target='_blank'>";
                            
                        ?>
                        <?php 
                        }
                        ?>
                        <img src="img/route.jpg"/></a>
                        </div>
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;background-size:contain;text-align:center;" id="exp" xlr="<?php if(isset($_POST['from_routed_oil_pickups'])){
                            echo $ikg_info->route_id;}
                        ?>">
                        
                        <?php  if(isset($_POST['from_routed_oil_pickups'])){ ?><a href="export_route.php?ikg=<?php
                            echo $ikg_info->route_id;  ?>" target="_blank"><img src="img/xls.jpg"/></a><?php } ?>
                        </div>
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;background-size:contain;" id="pdfexp">
                       <?php  if(isset($_POST['from_routed_oil_pickups'])){ ?> <a href="downloadreceipt.php?route_no=<?php echo "$_POST[manifest]";  ?>" target="_blank"><img src="img/pdf.jpg"/></a> <?php } ?>
                        
                        </div>
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;background-size:contain;" id="print" >
                        <?php  if(isset($_POST['from_routed_oil_pickups'])){ ?> <a href="print_oil_ikg.php?ikg=<?php   echo $ikg_info->route_id;   ?>" target="_blank"><img src="img/print.jpg"/></a> <?php } ?>
                        
                        </div>
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;background:url(img/createmod.jpg) no-repeat center center;background-size:contain;cursor:pointer;" <?php if(isset($_POST['from_routed_oil_pickups'])){ echo "title='Update' id='ikg_update'";} else {?>  title="Save"   id="ikg_create" <?php } ?>></div>
                        <div class="box" style="width: 60px;height:60px;box-shadow:2px 2px 5px #888888;float:left;backgroundsize:contain;" id="field_report">
                         <?php  if(isset($_POST['from_routed_oil_pickups'])){ ?> <a href="field_report.php?ikg=<?php   echo $ikg_info->route_id."&type=oil";   ?>"  rel="shadowbox;width=600px;height=500px;"><img src="img/bullhorn.png" style="width: 60px;height:60px;"/></a> <?php } ?>
                        </div>
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;" title="Manual Reorder" id="manual_reorder" >
                            <?php if(isset($_POST['from_routed_oil_pickups'])){ echo '<a href="manualreorder.php?type=oil&route_id='.$_POST['manifest'].'" rel="shadowbox;width=500;height=500;"><img src="img/reorder.png"/></a>';   } ?>
                        </div>
                        <div class="box" style="width: 60px;height:60px;box-shadow: 2px 2px 5px #888888;float:left;" title="Recover Stops" id="recover" title="Warning this will undo optimization">
                            <img src="img/Recover-512.png" style="width:60px;height:60px;cursor:pointer;"/>
                        </div>
                    </div>             
                </div>
                <div id="rightsideboxes" style="width: 400px;height:100px;float:left;">
                    <table style="width: 400px;height:100px;font-size:10px;"><tr><td>Enter Data In</td><td>
                    
                    <select name="entered_data" id="entered_data">
                        <option value="gallons">gallons</option></select></td>
                        
                        <td>Status</td>
                        <td style="font-size: 22px;font-weight:bold;" id="statquo">
                        <?php
                        if(isset($_POST['from_routed_oil_pickups'])){  
                            echo $ikg_info->route_status;
                        }
                        
                        ?>


</td></tr>
                    <tr><td style="vertical-align: top;">Recurring</td><td style="vertical-align: top;"><input type="checkbox" id="recurring" <?php
                    if($_POST['from_routed_oil_pickups']){
                        if($ikg_info->recur ==1){
                            echo " checked='checked' ";
                        }
                    }
                    ?> /><br /><input type="text" id="recurring_value" value="<?php 
                    if(isset($_POST['from_routed_oil_pickups'])){
                        echo $ikg_info->recur_days;
                        
                    }
                     ?>" style="width: 50px;height:25px;" /></td><td colspan="2">How Many Days In Route</td><td colspan="2">
                    <select name="days_in_route" id="mult_day_route">
                        <?php
                          $compare =0;
                          if( isset($_POST['from_routed_oil_pickups']) ){
                            $compare = $ikg_info->number_days_route; 
                          }  
                            
                          for($i=1;$i<6;$i++){
                            $selected ="";
                            if( $compare == $i){
                                $selected = "selected";
                            }
                            echo "<option $selected value='$i'>$i</option>";
                          }
                        
                        ?>
                    </select></td></tr>
                    </table>
                </div>                
        </div>    
    </div>
    
    <div id="fields" style="width: 1000px;min-height:300px;height:auto;margin:auto;">
    <table style="width: 100%;font-size:10px;" id="meatikg">
        <tr>
            <td>IKG Ttitle</td>
            <td><input type="text" id="ikgmanifestnumber" value="<?php 
                if(isset($ikg_info->ikg_manifest_route_number)) {  
                     echo $ikg_info->ikg_manifest_route_number;
                } else{
                    echo "bio-".date("YmdHis");  
} ?>" name="ikgmanifestnumber"/></td>
            <td>Trailer</td>
            <td>
            <select name="trailer" id="trailer">
            <option value="">--</option>
            <?php
            
                $comp ="";
                if(isset($_POST['from_routed_grease_list'])){
                    $comp = $ikg_info->trailer;
                     
                }
                $bvc = $db->query("SELECT trailer.truck_id,trailer.name FROM assets.trailer WHERE enabled =1  AND trailer.sold = 0 AND module='grease'");
                if(count($bvc)>0){
                    foreach($bvc as $trailers){
                        echo "<option ";
                            if($trailers['truck_id'] == $comp){
                                echo " selected ";
                            }
                        echo " value='$trailers[truck_id]'>$trailers[name]</option>";
                    }
                }   
            ?></select>
            </td>
            <td>Time Start</td>
            
            <td><input value="<?php if( isset($ikg_info) ){ echo $ikg_info->time_start; } ?>"  id="timestart" name="timestart" type="text"/></td>
            
            <td>Start Mileage</td>
            
            <td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){  echo $ikg_info->start_mileage;} ?>" id="start_mileage" name="start_mileage" type="text"/></td>
        </tr>
        
        <tr>
            <td>Scheduled Date</td>
            <td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->scheduled_date;} ?>" type="text" id="sched_route_start" name="sched_route_start"/></td>
            <td>Trailer License Plate</td><td><input type="text" id="trailer_lp" name="trailer_lp"/></td>
            <td>First Stop</td>
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->first_stop;} ?>" id="firststop" name="firststop" type="text"/></td>
            <td>First Stop Mileage</td>
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->first_stop_mileage;} ?>" type="text" id="first_stop_mileage" name="first_stop_mileage"/></td>
        </tr>
        
        <tr>
            <td>Completion Date</td>
            <td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->completed_date;} ?>" id="completion" type="text" readonly=""/></td>
            <td>Truck</td>
            <td>
            <?php
                
                if( isset($_POST['from_routed_oil_pickups']) ){ 
                    echo getVehiclesList($ikg_info->truck);
                }else {
                    echo getVehiclesList("");
                }            
               
            ?>
            </td>
            <td>Last Stop</td>
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->last_stop;} ?>" id="laststop" name="laststop" type="text"/></td>
            <td>Last Stop Mileage</td>
            <td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->last_stop_mileage;} ?>" id="last_stop_mileage" name="last_top_mileage"  type="text"/></td>
        </tr>
        
        <tr>
            <td>IKG Manifest Number</td>
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups'])  ){ echo $ikg_info->route_id;} ?>" id="unique_route_no"  type="text" readonly="" /></td>
            <td>License Plate</td>
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->license_plate;} ?>" type="text" name="lic_plate" id="lic_plate"/></td>
            <td>End Time</td>
            <td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->end_time;} ?>"  type="text" name="endtime" id="endtime"/></td>
             <td>End Mileage</td> 
             <td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->end_mileage;} ?>" id="end_mileage" name="end_mileage" type="text"/></td>
        </tr>
        
        <tr>
            <td>Location</td>
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->location;} ?>"  id="location" name="location" type="text"/></td>
            <td>IKG Decal</td>
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->ikg_decal;} ?>" id="ikg_decal" name="ikg_decal" type="text"/></td>
            <td>Total Time Elapsed</td><td><input type="text" value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->time_elapsed;} ?>"/></td>
            <td>Total Mileage</td><td><input type="text" value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->total_mileage;} ?>" /></td>
        </tr>
        
        
        <tr>
            <td>INVENTORY CODE</td><td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->inventory_code;} ?>" name="inventory_code" id="inventory_code" type="text"/></td>
            <td>IKG Collected</td>
            <td><input  name="ikg_collected" value="Used Cooking Oil" id="ikg_collected" readonly="" type="text"/></td>
          
            <td>Fuel</td><td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->fuel;} ?>" name="fuel" id="fuel" type="text"/></td>
              <td>Total Lbs/Mile</td><td><input type="text" value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->lb_per_mile;} ?>" /></td>
        </tr>
        
        
        <tr>
            <td>Lot #</td>            
            <td><input value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->lot_no;} ?>" id="lot_no" name="lot_no" type="text"/></td>
            <td>Driver Completed Date</td>
            
            <td><input type="text" readonly="" value="<?php if(  isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->driver_completed_date;} ?>"/></td>
            
            
            <td id="output" rowspan="3" style="text-align: center;font-size:20px;">
            <?php 
                if(isset($_POST['from_routed_oil_pickups'])){
                     $differ = $ikg_info->collected_Weight -  ( $ikg_info->ikg_gross_weight - $ikg_info->tare_weight ) ;
                     $perc = $differ/ ($ikg_info->ikg_gross_weight - $ikg_info->tare_weight );
                     echo "update:". $perc."<br/>";
                     if( $differ >= 500 ||   $perc> .10  || $ikg_info->ikg_gross_weight<50  || $perc < -10   ){
                        echo "<img src='img/graphics-flashing-light-245546.gif' style='width:20px;height:20px;'/>";
                        $db->query("UPDATE iwp_ikg_manifest_info SET can_close =0 WHERE route_id=$_POST[manifest]");
                     }else {
                        echo "<img src='img/check_green_2s.png' style='width:20px;height:20px;'/>";
                        $db->query("UPDATE iwp_ikg_manifest_info SET can_close =1 WHERE route_id=$_POST[manifest]");
                     }
                     echo "<br/>".$perc; //echo " %";
                 }else {
                    echo "<img src='img/graphics-flashing-light-245546.gif' style='width:20px;height:20px;'/><br/> 0 %";
                 }
            ?> 
            </td>
        </tr>
        <tr>
            <td>Receiving Facility</td><td><?php 
                if(isset($_POST['from_routed_oil_pickups']) ) {
                    getFacilityList("",$ikg_info->recieving_facility_no);
                } else {
                    getFacilityList("","");
                }
            
            ?></td>
       <td>Gross Weight</td>
            
            <td><input value="<?php if( isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->ikg_gross_weight;} ?>" id="gross_weight" name="gross_weight" type="text"/></td>
        <td>Collected Weight (lbs)</td>
        <td> <input type="text"  readonly="true"  id="cw" value="<?php if(isset($_POST['from_routed_oil_pickups'])){ echo $ikg_info->collected_Weight;  }   ?>"/>  </td>
           </tr>
            <tr>
            <td>Facility Address</td>
            <td><input value="<?php if(isset($_POST['from_routed_oil_pickups'])){ echo $ikg_info->facility_address;} ?>" name="fac_address" id="fac_address" type="text"/></td>
            
            <td>Differencee </td>
            <td><input type="text" value="<?php if(isset($_POST['from_routed_oil_pickups'])){ echo $ikg_info->difference_weight;} ?>" id="diference" readonly="true" /> </td>
        </tr>
        <script>
       
        
        <?php if(isset($_POST['from_routed_oil_pickups'])){  ?>
            
        
        <?php } ?>
        </script>
        <tr>
            <td>Facility Rep</td>
            <td><input value="N/A" id="fac_rep" name="fac_rep" type="text" readonly="" /></td>
            <td>Tare Weight</td>
            <td><input value="<?php if(isset($_POST['from_routed_oil_pickups']) ){ echo $ikg_info->tare_weight;} ?>" type="text" name="tara_weight" id="tara_weight"/></td>
            
            <td  colspan="5">
            <?php
                if(isset($_POST['from_routed_oil_pickups']) ){ 
                     if(strlen(trim($ikg_info->facility_sig))>0){
                        echo "<img src='$ikg_info->facility_sig'/>";
                     }else{
                        ?>
                         Facility Rep <div class='js-signature'  data-background='#FFFFFF' data-width='550' data-height='80' data-border='1px solid black' data-line-color='#000000' data-auto-fit='false'></div>
                        <?php
                     }
                    
                     if(strlen(trim($ikg_info->driver_sig))>0){
                         echo "<br/><img src='$ikg_info->driver_sig'/>";
                     }else{
                        ?>
                          Driver <div class='js-signaturex'  data-background='#FFFFFF' data-width='550' data-height='80' data-border='1px solid black' data-line-color='#000000' data-auto-fit='false'></div>
                        <?php
                     }
                }else{
                    ?>
                     Facility Rep <div class='js-signature'  data-background='#FFFFFF' data-width='550' data-height='80' data-border='1px solid black' data-line-color='#000000' data-auto-fit='false'></div><br /><br />
             Driver <div class='js-signaturex'  data-background='#FFFFFF' data-width='550' data-height='80' data-border='1px solid black' data-line-color='#000000' data-auto-fit='false'></div>
                    <?php
                }
            
            ?>
            </td>
        </tr>
        
        <tr>
            <td>Driver</td><td>
           
                <?php
                    if( isset($_POST['from_routed_oil_pickups'] ) ){
                        if(strlen($ikg_info->driver_no) >0){ 
                            $compare_driver = $ikg_info->driver_no;
                        } else { 
                           
                            $compare_driver="";
                        }
                        getDrivers($ikg_info->driver_no);
                    } 
                    else {
                        getDrivers("");
                    }
                    
                ?>

            </td>
             <td>
            Net Weight
            </td>
            <td><input type="text" value="<?php if(isset($_POST['from_routed_oil_pickups'])){ echo $ikg_info->net_weight;} ?>" id="net_w"/></td>
        </tr>
        <tr>
            <td>IKG Transporter</td><td><input name="ikg_transporter" id="ikg_transporter" value="Imperial Western Products DBA Biotane Pumping" readonly="" type="text"/></td>
        </tr>
        
        <tr>
            <td>View Day Route</td><td>
               
                <select name="what_day" id="what_day">
                <?php
                    for($i=1;$i<6;$i++){
                        $compare ="";
                        if($day == $i){
                            $compare = "selected";
                        }
                        echo "<option $compare value='$i'>$i</option>";
                    }
                ?>
            </select>
        </tr>
        
    </table>
     <script>
     
     </script>
    </div>
    <div id="spacebottom" style="height: 10px;background:white;width:100%;"></div>
    
    
    
    <div class="spacebottom" style="height: 10px;background:white;width:100%;"></div>
    
    <div id="data_display" style="width:100%;margin:auto;height:auto;min-height:400px;">
    <table style="width: 100%;padding:0px 0px 0px 0px;height:auto;">
    
    <tr><td colspan="15" style="font-weight:bold;color:red;">*NOTE: When deleting pickups on an existing route , you MUST CLICK UPDATE FOR CHANGES TO TAKE EFFECT.</td></tr>
    <tr>
    <td style="text-align:center;cursor:pointer;" id="test">Pickups:</td>
    
    <td style="text-align:center;" id="nop">
    <?php 
        $oc = 0;
        if(isset($_POST['from_routed_oil_pickups'])){
           echo $ikg_info->stops;
        }
        else {
            $oc = count($schnums);
            echo $oc;   
             
        }
         
        
     ?></td>
     
     <td style="text-align: center;">@ Pickup</td>
     <td style="text-align:center;">
     <?php 
     
     if(isset($_POST['from_routed_oil_pickups'])){
         $total_at_pickup = 0;                           
         foreach ($newlist_scheds as $ekc ){
            if($ekc != NULL){
                $sched_ro2 = new Scheduled_Routes($ekc);
                $aaccoouunntt2 = new Account(); 
                $first = explode(" ",$aaccoouunntt2->date_of_last_pickup($sched_ro2->account_number));
$total_at_pickup += date_different($first[0],$sched_ro2->scheduled_start_date) * $aaccoouunntt2->singleField($sched_ro2->account_number,"ticks_per_day");   
            }
        } 
        echo number_format($total_at_pickup,2);
     }
                           
     ?>
     
     </td>
    <td style="text-align:center;" colspan="1">Estimated Total Gallons:</td>
    
    <td style="text-align:center;" colspan="3" id="estimated">
    <?php
    $etg = 0;
   
    if(isset($_POST['from_routed_oil_pickups'])){        
        $etg = $ikg_info->expected;
        $db->query("UPDATE iwp_list_of_routes SET expected = $ikg_info->expected WHERE route_id= $_POST[manifest]");
    }else {        
         $ajx = new Account();
        foreach($actns as $jux){
            $etg = $etg + $ajx->onsite($jux);     
        }   
    }  
    echo number_format($etg,2);
    ?>
    </td>
    <td>
     - Collected
    </td>
    <td style="text-align: center;" id="collected">
    <?php       
        if(isset($_POST['from_routed_oil_pickups'])){
           echo $ikg_info->collected;
        }
    ?>
    </td>
     <td>
     Route Lbs/Mileage
    </td>
    <td>
    <?php
         if(isset($_POST['from_routed_oil_pickups'])){
           echo $ikg_info->r_total_lb_per_mile;
         }
    ?>
    </td>
    <td>Route Mileage</td>
    <td>
    <?php
        if(isset($_POST['from_routed_oil_pickups'])){
            echo $ikg_info->net_route_miles;
        }
    ?>
    
    </td>
    <td>Route Time</td>
    <td>
    <?php
    
   if(isset($_POST['from_routed_oil_pickups'])){
        echo $ikg_info->route_elapsed;
    }
    
    ?>
    </td>
    </tr>
    </table>
    
    <table style="width:100%;margin:auto;font-size:12px;border-collapse:collapse;table-layout:fixed;"  id="sortable">
    <thead>
    <tr>
        <td style="width:30px;">&nbsp;</td>
        <td style="padding: 0px 0px 0px 0px;width:20px;">
            <div class="cell" style="border-top-left-radius:5px;border-left: 1px solid black;border-top:1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">
                #
            </div>
        </td>
        
        
        <td  style="padding: 0px 0px 0px 0px;width:90px;">
            <div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:90px;">
                Code Red
            </div>
        </td>
        
        <td  style="padding: 0px 0px 0px 0px;width:43px;">
            <div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:43px;">
                F
            </div>
        </td>
        
        <td style="padding: 0px 0px 0px 0px;width:100px;">
            <div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:100px;">Status</div>
        </td>
        <td style="padding: 0px 0px 0px 0px;width:100px">
            <div class="cell" style="border-top: 1px solid black;padding:0px 0px 0px 0px;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:100px;">Scheduled</div>
        </td>
        <td style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Name</div></td>
        
        <td  style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">City</div></td>
        
        
        <td  style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Address</div></td>
        
        <td  style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Notes</div></td>
        
        <td style="padding: 0px 0px 0px 0px;width:100px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Est. Gals</div></td>
        <td style="padding: 0px 0px 0px 0px;width:70px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:70px;" title="Collected Gallons">Col</div></td>
        
        <td  style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Info</div></td>
        <td style="padding: 0px 0px 0px 0px;width:29px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:29px;">ZG</div></td>
        <td  style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Tote-Size</div></td>
        <td style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Days</div></td>        
               
        <td style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);" title="Estimated Gallons at scheduled Pickup">Est @ pickup</div></td>
        
        
        
    </tr>
    </thead>
    <tbody>
    <?php
    $alter = 0;
    
    $count = 1;  
    $total_caps = 0;  
    if(isset($_POST['from_routed_oil_pickups'])){
            $preVal = null;
            if(!empty($newlist_scheds)){
                $aaccoouunntt = new Account();                 
                 foreach ($newlist_scheds as $ekc ){
                    $alter++;
                    if($alter%2 == 0){
                        $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
                    }
                    else { 
                        $bg = 'transparent';
                    }
                    if($ekc != NULL){
                        $sched_ro = new Scheduled_Routes($ekc);
                        $aaccoouunntt = new Account();
                        $total_pickedup_for_this_route =total_gallons_for_route($_POST['manifest'],$ekc,$sched_ro->account_number);
                        $datee = explode(" ",$sched_ro->scheduled_start_date);
                        $dt = explode(" ",$sched_ro->scheduled_start_date);
                        $first = explode(" ",$aaccoouunntt->date_of_last_pickup($sched_ro->account_number));  
                        $est =  date_different($first[0],$sched_ro->scheduled_start_date) * $sched_ro->ticks_per_day;       
                        echo "<tr  id='row$sched_ro->schedule_id' style='cursor:pointer;background:$bg'  class='accnt_row' xlr='$sched_ro->account_number' rel='$ekc' title='$sched_ro->account_number'><td>";
                        if($sched_ro->route_status !="completed"){
                            echo "<img src='img/delete-icon.jpg' title='remove pickup $ekc' xlr='$sched_ro->account_number' rel='$ekc'  class='deletesched2' />";
                        }
                         echo "</td>
                        <td>$count</td>
                        <td>".code_red($sched_ro->code_red)."</td>
                        <td style='width:43px;'>"; 
                            if( $sched_ro->account_friendly!="No"){
                                echo "F";
                            }else{
                              echo   "IWP";
                            }
                        echo "</td><td>$sched_ro->route_status</td><td>$datee[0]</td><td>$sched_ro->account_name</td><td>$sched_ro->account_city</td><td>$sched_ro->account_address</td><td class='notes' rel='$sched_ro->account_notes'>$sched_ro->account_notes</td><td>$sched_ro->onsite</td><td>$total_pickedup_for_this_route</td><td>$sched_ro->notes<br/>$sched_ro->special_instructions</td><td style='width:29px;'>"; echo ZG_decode($sched_ro->zero_gallon_reason); echo "</td><td>$sched_ro->container_list</td><td>".date_different($dt[0],date("Y-m-d"))."</td><td>$est</td></tr>";
                        $count++;                        
                    }
                }                
            }   
    }else if(isset($_POST['from_schoipu'])  ){        //coming from scheduled oil pickups page        
        if(count($schnums)>0){           
           
            foreach($schnums as $value){
                $alter++;
                if($alter%2 == 0){
                    $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
                }
                else { 
                    $bg = 'transparent';
                }
                $schedule = new Scheduled_Routes($value);
                
                echo"<tr id='row$value' style='cursor:pointer;background:$bg;' class='accnt_row'  xlr='$schedule->account_number' title='$schedule->account_number'>";
                
                echo"<td><img src='img/delete-icon.jpg' title='remove pickup $value' xlr='$schedule->account_number' class='deletesched' rel='$value'/>&nbsp;&nbsp;</td>";
                echo "<td>$count</td>";                
                echo "<td  style='width:50px;'>$schedule->code_red</td>
                <td>"; 
                    if(strlen($schedule->account_friendly)>0){
                        echo "F";
                    }
                echo "</td><td>$schedule->route_status</td>";
                echo "<td>"; 
                    $datex = explode(" ",$schedule->scheduled_start_date);
                    echo $datex[0];
                echo "</td>";
                echo "<td>$schedule->account_name</td>";
                echo "<td>$schedule->account_city</td>";
                echo "<td>$schedule->account_address</td>";
                echo "<td class='notes' rel='$schedule->account_notes'>$schedule->account_notes</td>";
                echo "<td>$schedule->onsite</td>";
                echo "<td></td>";//collected
                echo "<td>$schedule->notes<br/>$schedule->special_instructions</td>";//info
                echo "<td style='width:29px;'>$schedule->zero_gallon_reason</td>";//%caps
                echo "<td>$schedule->container_list</td>";
                $dt = explode(" ",$schedule->scheduled_start_date);
                echo "<td>".date_different($dt[0],date("Y-m-d"))."</td>";                
               
                echo "<td></td>";
             ;
                
                echo"</tr>";
                $count++;
            }
        }
     }
    ?>
    </tbody>
    </table>
        <div style="clear: both;"></div>
    </div>
    <div class="spacebottom" style="height: 10px;background:white;width:100%;"></div>
</div>
<input type="text" value="<?php  
            if(!isset($_POST['from_routed_oil_pickups'])){
                if(isset($_POST['accounts_checked']))
                echo $_POST['accounts_checked'];
            }
            else {
                echo implode("|",$newlist_accounts)."|";
            }
            echo""; ?>" name="account_nos" id="account_nos" placeholder="accounts" readonly="" /><br />
<input type="text" value="<?php 
            if(!isset($_POST['from_routed_oil_pickups'])){
                if(isset($_POST['schecheduled_ids']))
                echo $_POST['schecheduled_ids'];
            }
            else {
                 echo implode("|",$newlist_scheds)."|";
            }
            
            ?>" name="scheduled_ids" id="scheduled_ids" placeholder="schedules" readonly=""/>
    <input type="text" name="return_stops" placeholder="return stops" id="return_stops" readonly=""/>
    <input type="text" placeholder="Added_routes" value="<?php if(isset($_POST['extra_mode'])){ echo $_POST['schecheduled_ids'];} ?>" id="newly_added_routes" name="newly_added_routes" title="Newly Added Stops" readonly=""/>
    <input type="text" placeholder="Added_accounts" value="<?php if(isset($_POST['extra_mode'])){ echo $_POST['accounts_checked']; } ?>" title="Newly Added Accounts" name="accounts_to_add" id="accounts_to_add" readonly=""/>
    
    <input type="text" value="<?php  ?>"  id="can_close" name="can_close" title="can close ?" readonly=""/>
</div>



<script>
history.pushState({ page: 1 }, "title 1", "#nbb");
window.onhashchange = function (event) {
    window.location.hash = "nbb";
};
window.onload = function(){
    $("#loading").fadeOut("fast");
}
var locked = false;

$('td.notes').text(function(i, text) {
    var t = $.trim(text);
    if (t.length > 10) {
        return $.trim(t).substring(0, 10) + "...";
    }
    return t;
}).hover(function(){
     $(this).html("<span style='font-size:10px;'>"+$(this).attr('rel')+"</span>");
},function(){
     var t = $.trim($(this).attr('rel'));
    if (t.length > 10) {
        $(this).html ($.trim(t).substring(0, 10) + "...");
    }
    
});


if ($('.js-signature').length) {
  $('.js-signature').jqSignature({
        'decor-color': '#fff',
		'color': '#000',
		'width': '800',
		'height': '320',
        'lineWidth': 1
  });
}


if ($('.js-signaturex').length) {
  $('.js-signaturex').jqSignature({
        'decor-color': '#fff',
		'color': '#000',
		'width': '800',
		'height': '320',
        'lineWidth': 1
  });
}

function close_window() {
  if (confirm("Route Created Successfully Please Navigate to routed oil pickups page")) {
    close();
  }
}
 var k =    $("#gross_weight").val() - $("#tara_weight").val() ;
            $("#net_weight,#net_w").val(k);
            var siren =  $("#cw").val() - $("#net_w").val();            
            $("#diference").val(siren);
             var percentage = siren / $("#net_w").val(); 
            $("#output").html(  siren / $("#net_w").val()   );
            if( percentage >.1 || $("#diference").val() >=500  || $("#gross_weight").val() <50  || percentage < -10){                    
                $("#output").html("<img src='img/graphics-flashing-light-245546.gif' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                locked = true;
            }
            else {
                $("#output").html("<img src='img/check_green_2s.png' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                locked = false;
            }
            
            
            
            $("input#gross_weight").change(function(){                
                k = $("#gross_weight").val() - $("#tara_weight").val() ;
                $("#net_weight,#net_w").val(k);
                var siren = $("#cw").val() - $("#net_w").val();
                
                $("#diference").val(siren);
                 var percentage = siren / $("#net_w").val(); 
                $("#output").html(  siren / $("#net_w").val()   );
                
                if(percentage >.1 || $("#diference").val() >=500  || $("#gross_weight").val() <50  || percentage < -10){                    
                    $("#output").html("<img src='img/graphics-flashing-light-245546.gif' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = true;
                }
                else {
                    $("#output").html("<img src='img/check_green_2s.png' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = false;
                }
            });
            
            $("#tara_weight").change(function(){                
                k = $("#gross_weight").val() - $("#tara_weight").val() ;
                $("#net_weight,#net_w").val(k);
                var siren = $("#cw").val() - $("#net_w").val();
                
                $("#diference").val(siren);
                 var percentage = siren / $("#net_w").val(); 
                $("#output").html(  siren / $("#net_w").val()   );
                
                if(percentage >.1 || $("#diference").val() >=500  || $("#gross_weight").val() <50  || percentage < -10){                    
                    $("#output").html("<img src='img/graphics-flashing-light-245546.gif' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = true;
                }
                else {
                    $("#output").html("<img src='img/check_green_2s.png' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = false;
                }
            })
            
            
            $("#gross_weight").change(function(){                
                k = $("#gross_weight").val() - $("#tara_weight").val() ;
                $("#net_weight,#net_w").val(k);
                var siren = $("#cw").val() - $("#net_w").val();
                
                $("#diference").val(siren);
                 var percentage = siren / $("#net_w").val(); 
                $("#output").html(  siren / $("#net_w").val()   );
                if(percentage >.1 || $("#diference").val() >=500  || $("#gross_weight").val() <50  || percentage < -10){
                    
                    $("#output").html("<img src='img/graphics-flashing-light-245546.gif' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = true;
                }
                else {
                    $("#output").html("<img src='img/check_green_2s.png' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = false;
                }
            });
 
            $("#net_w").change(function(){                   
                k = $("#gross_weight").val() - $("#tara_weight").val() ;
                $("#net_weight,#net_w").val(k);
                var siren = $("#cw").val() - $("#net_w").val();
                
                $("#diference").val(siren);
                 var percentage = siren / $("#net_w").val(); 
                $("#output").html(  siren / $("#net_w").val()   );
                
                if( percentage >.1 || $("#diference").val() >=500  || $("#gross_weight").val() <50  || percentage < -10){                    
                    $("#output").html("<img src='img/graphics-flashing-light-245546.gif' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = true;
                }
                else {
                    $("#output").html("<img src='img/check_green_2s.png' style='width:20px;height:20px;'/><br/> "+ Math.round(percentage*100) +" %"  );
                    locked = false;
                }
            });
<?php if(isset($_POST['from_routed_oil_pickups'])){ ?>

$("#what_day").change(function(){
    $(".enterDataLink").attr('href','enterData.php?route_id=<?php echo $ikg_info->route_id; ?>&day='+$(this).val());
    
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:1},function(data){
        
        $("input#timestart").val(data);
    });
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:2},function(data){
        $("input#start_mileage").val(data);
    });
    
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:3},function(data){
        $("input#firststop").val(data);
    });
    
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:4},function(data){
        $("input#first_stop_mileage").val(data);
    });    
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:5},function(data){
        $("input#laststop").val(data);
    });    
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:6},function(data){
       $("input#last_stop_mileage").val(data);
    });    
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:7},function(data){
        //alert(data);
        $("input#endtime").val(data);
    });
    $.post("day_info.php",{route_id:<?php echo $_POST['manifest'] ?>,what_day:$(this).val(),mode:8},function(data){
       $("input#end_mileage").val(data);
    }); 
 });
 $(".enterDataLink").attr('href','enterData.php?route_id=<?php echo $ikg_info->route_id; ?>&day='+$("#what_day").val());
<?php } ?> 
 
var remove_incompletes = 0;

    $(".deletesched2").click(function(){        
         $(this).closest('tr').remove();
         var account   = $("input#account_nos").val();
         var schedules = $("input#scheduled_ids").val();
         var replace_scheds = $(this).attr('rel')+"|";
         var replace_accounts = $(this).attr('xlr')+"|";
         //alert(replace_scheds);
         $("input#return_stops").val( $("input#return_stops").val()+replace_scheds );
         $("input#account_nos").val( account.replace(replace_accounts,"")  );
         $("input#scheduled_ids").val( schedules.replace(replace_scheds,"") );
         $("#nop").html( $("#nop").html() - 1);
         $.post("recalculateTotalEstGallons.php",{ total: $("#estimated").html(),accountx: $(this).attr('xlr')},function(data){
            //alert(data);
            $("#estimated").html(data);
            setTimeout('reOrder()',1000);
            remove_incompletes++;    
            
         });  
         
    });

    $(".deletesched").click(function(){
         $(this).closest('tr').remove();
         var account   = $("input#account_nos").val();
         var schedules = $("input#scheduled_ids").val();
         var replace_scheds = $(this).attr('rel')+"|";
         var replace_accounts = $(this).attr('xlr')+"|";
         $("input#account_nos").val( account.replace(replace_accounts,"")  );
         $("input#scheduled_ids").val( schedules.replace(replace_scheds,"") );
         $("#nop").html( $("#nop").html() - 1);
         $.post("recalculateTotalEstGallons.php",{ total: $("#estimated").html(),accountx: $(this).attr('xlr')},function(data){
            $("#estimated").html(data);
            setTimeout('reOrder()',1000);
            
         });  
    });

    $.post("getFacilAddress.php",{facil:$("#facility").val()},function(data){
        $("input#fac_address").val(data);
    });
   
   $("#facility").change(function(){
        $.post("getFacilAddress.php",{facil: $(this).val() },function(data){
            $("input#fac_address").val(data);
        });
         $("#facholder").html( $(this).find("option:selected").text()  );
         //alert($(this).find("option:selected").text() );        
   });
   
    $.post("getTruckInfo.php",{choose:1,id: $("#vehicle").val() },function(data){
        //alert(data);
        $("input#lic_plate").val(data);  
    });
    
   $("#trailer").change(function(){
        $.post("getTrailerInfo.php",{choose:2,id:$(this).val()},function(data){
             $("input#ikg_decal").val(data);
        });
        
        
        $.post("getTrailerInfo.php",{choose:1,id:$(this).val()},function(data){
            $("input#trailer_lp").val(data)   ; 
        });
   });
    
    /*$.post("getTruckInfo.php",{choose:2,id:$("#vehicle").val() },function(data){
        $("input#ikg_decal").val(data);
    });*/

    $("#vehicle").change(function(){
        $.post("getTruckInfo.php",{choose:1,id:$(this).val() },function(data){
            $("input#lic_plate").val(data);  
        });
        
        var books = $('#trailer');
        
        if (books.val() === '') {
            $.post("getTruckInfo.php",{choose:2,id:$(this).val() },function(data){
                $("input#ikg_decal").val(data);
            });
        }
        
       
        
        
    });

    $("input#recurring_value").hide();
    
    $("input#sched_route_start").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});    
    //$("input#completion").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
    $("input#timestart").timepicker();
    $("input#firststop").timepicker();
    $("input#laststop").timepicker();
    $("input#endtime").timepicker();
    
    
    $("#recurring").click(function(){        
        if ($(this).is(':checked')) {
            $("input#recurring_value").show();
        } else { 
            $("input#recurring_value").hide();
        }        
    });
    
    if( $("#recurring").is(":checked") ){
        $("input#recurring_value").show();
    }
    
    $("#ikg_update").click(function(){
        alert($("input#recurring_value").val());
         $("#loading").show();
         $("#loading").html("<br/><br/>Loading please be patient.  Updating Route..");
         var reordered ="";
        $(".accnt_row").each(function(){
            reordered+= $(this).attr('xlr')+"|";
        });        
        $("input#account_nos").val(reordered);    
        var recurx = 0;
        
        if( $("#recurring").is(":checked") ){
            recurx = 1;
        }
        //alert($("input#start_mileage").val());
        $.post('ikg_update.php',{
            rid:$("#rid").html(),
            ikg_manifest_route_number: $("input#ikgmanifestnumber").val(),
            tank_1: $("input#tank1").val(),
            tank_2: $("input#tank2").val(),
            time_start: $("input#timestart").val(),
            start_mileage: $("input#start_mileage").val(),
            sched_route_start: $("input#sched_route_start").val(),
            vehicle: $("#vehicle").val(),
            first_stop: $("input#firststop").val(),
            first_stop_mileage: $("input#first_stop_mileage").val(),
            completion_date : $("input#completion").val(),
            lic_plate: $("input#lic_plate").val(),
            last_stop: $("input#laststop").val(),
            last_stop_mileage :$("input#last_stop_mileage").val(),
            unique_route_no : $("input#unique_route_no").val(),
            ikg_decal : $("input#ikg_decal").val(),
            end_time : $("input#endtime").val(),
            end_mileage: $("input#end_mileage").val(),
            location: $("input#location").val(),
            ikg_collected: $("input#ikg_collected").val(),
            fuel: $("input#fuel").val(),
            inventory_code : $("input#inventory_code").val(),
            lot_no : $("input#lot_no").val(),
            gross_weight: $("input#gross_weight").val(),
            reciev_fac : $("#facility").val(),
            tara_weight: $("input#tara_weight").val(),
            fac_address: $("input#fac_address").val(),
            net_weight: $("input#net_weight").val(),
            collected_weight: $("input#cw").val(),
            difference: $("input#diference").val(),
            fac_rep: $("input#fac_rep").val(),
            drivers : $("#drivers").val(),
            ikg_transporter: $("input#ikg_transporter").val(),
            mult_day_route : $("#mult_day_route").val(),           
            number_of_picksup: $("#nop").html(),
            accounts: $("input#account_nos").val(),
            schedules: $("input#scheduled_ids").val(),
            total_estimate:$("#estimated").html(),
            incs:remove_incompletes,
            what_day:$("#what_day").val(),
            scheds_to_remove: $("input#return_stops").val(),
            scheds_to_add:$("input#newly_added_routes").val(),
            accounts_to_add:$("input#accounts_to_add").val(),
            new_variable:recurx,
            day_recur: $("input#recurring_value").val(),
            trailer:$("select#trailer").val(),
            trailer_lp:$("input#trailer_lp").val(),
            jsig: $('.js-signature').jqSignature('getDataURL'),
            jsig2: $('.js-signature').jqSignature('getDataURL')
        },function(data){
            //alert(data);
            //$("#debug").html(data);
            
            if(data ==1){
                alert("Your session has ended, please re-login to complete this route.");
                parent.window.opener.location.href =="home.php";
            }else{
                $("#loading").append(" AND refreshing route information");
                $("#loading").fadeOut("fast",function(){
                    
                    if( parent.window.opener.location.href == "https://inet.iwpusa.com/scheduling.php?task=schoipu" ){//did you come from scheduled oil pickups?
                        parent.window.opener.document.location.reload(true);
                    }
                    <?php
                        if( isset($_POST['extra_mode']) || isset($_POST['from_schoipu']) ){
                        ?>
                            close_window();
                        <?php 
                        } else {
                        ?>
                        //alert('Route Updated!');
                    <?php } ?>    
                });
                //$("#resubmit_this").submit();
            }
            
            
        });
    });
    
    $("#ikg_create").click(function(){
        //alert($("#nop").html() );
        
         var reordered ="";
        $(".accnt_row").each(function(){
            reordered =  reordered+$(this).attr('xlr')+"|";
        });             
        $("input#account_nos").val(reordered);  
         
        var recurx = 0;
        if( $("#recurring").is(":checked") ){
            recurx = 1;
        }
        if( $("#rid").text().trim() == "" ){
            $.post('ikg_insert.php',{           
                ikg_manifest_route_number: $("input#ikgmanifestnumber").val(),
                tank_1: $("input#tank1").val(),
                tank_2: $("input#tank2").val(),
                time_start: $("input#timestart").val(),
                start_mileage: $("input#start_mileage").val(),
                sched_route_start: $("input#sched_route_start").val(),
                vehicle: $("#vehicle").val(),
                first_stop: $("input#firststop").val(),
                first_stop_mileage: $("input#first_stop_mileage").val(),
                completion_date : $("input#completion").val(),
                lic_plate: $("input#lic_plate").val(),
                last_stop: $("input#laststop").val(),
                last_stop_mileage :$("input#last_stop_mileage").val(),
                unique_route_no : $("input#unique_route_no").val(),
                ikg_decal : $("input#ikg_decal").val(),
                end_time : $("input#endtime").val(),
                end_mileage: $("input#end_mileage").val(),
                location: $("input#location").val(),
                ikg_collected: $("input#ikg_collected").val(),
                fuel: $("input#fuel").val(),
                inventory_code : $("input#inventory_code").val(),
                lot_no : $("input#lot_no").val(),
                gross_weight: $("input#gross_weight").val(),
                reciev_fac : $("#facility").val(),
                tara_weight: $("input#tara_weight").val(),
                fac_address: $("input#fac_address").val(),
                net_weight: $("input#net_weight").val(),
                collected_weight: $("input#cw").val(),
                difference: $("input#diference").val(),
                fac_rep: $("input#fac_rep").val(),
                drivers : $("#drivers").val(),
                ikg_transporter: $("input#ikg_transporter").val(),
                mult_day_route : $("#mult_day_route").val(),           
                number_of_picksup: $("#nop").html(),
                accounts: $("input#account_nos").val(),
                schedules: $("input#scheduled_ids").val(),
                mode:$("input#mode").val(),
                total_estimate:$("#estimated").html(),
                new_variable:recurx,
                day_recur: $("input#recurring_value").val(),
                trailer:$("select#trailer").val(),
                trailer_lp:$("input#trailer_lp").val(),
                jsig: $('.js-signature').jqSignature('getDataURL'),
                jsig2: $('.js-signature').jqSignature('getDataURL')
            },function(data){
                
                if(data ==1){
                    alert("Your session has ended, please re-login to complete this route.");
                    parent.window.opener.location.href="home.php";
                }else{
                    $("input#form_route").val(data);
                    $("#debug").html(data);
                    //alert("Route Created!");
                    $("#statquo").html('enroute');
                    $("#rid").html(data);                 
                    $("input#unique_route_no").val(data);
                    $("#edata").html('<a href="enterData.php?route_id='+data+'&day=1" target="_blank"><img src="img/enterdata.jpg"/></a>');
                    $("#pdfexp").html('<a href="downloadreceipt.php?route_no='+data+'" target="_blank"><img src="img/pdf.jpg"/></a> ');
                    $("#print").html('<a href="print_oil_ikg.php?ikg='+data+'" target="_blank"><img src="img/print.jpg"/></a>');
                    $("#exp").html('<a href="export_route.php?ikg='+data+'" target="_blank"><img src="img/xls.jpg"/></a>');
                   
                   $("#sortable tbody tr").find("td:nth-child(4)").each(function (i) {
                         $(this).html("enroute");
                   });
                   close_window();
                }
                
               
               
               
               
            });  
        } else {
            //alert($("#rid").html()+" updating");
            
           $.post('ikg_update.php',{
                rid:$("#rid").html(),
                ikg_manifest_route_number: $("input#ikgmanifestnumber").val(),
                tank_1: $("input#tank1").val(),
                tank_2: $("input#tank2").val(),
                time_start: $("input#timestart").val(),
                start_mileage: $("input#start_mileage").val(),
                sched_route_start: $("input#sched_route_start").val(),
                vehicle: $("#vehicle").val(),
                first_stop: $("input#firststop").val(),
                first_stop_mileage: $("input#first_stop_mileage").val(),
                completion_date : $("input#completion").val(),
                lic_plate: $("input#lic_plate").val(),
                last_stop: $("input#laststop").val(),
                last_stop_mileage :$("input#last_stop_mileage").val(),
                unique_route_no : $("input#unique_route_no").val(),
                ikg_decal : $("input#ikg_decal").val(),
                end_time : $("input#endtime").val(),
                end_mileage: $("input#end_mileage").val(),
                location: $("input#location").val(),
                ikg_collected: $("input#ikg_collected").val(),
                fuel: $("input#fuel").val(),
                inventory_code : $("input#inventory_code").val(),
                lot_no : $("input#lot_no").val(),
                gross_weight: $("input#gross_weight").val(),
                reciev_fac : $("#facility").val(),
                tara_weight: $("input#tara_weight").val(),
                fac_address: $("input#fac_address").val(),
                net_weight: $("input#net_weight").val(),
                collected_weight: $("input#cw").val(),
                difference: $("input#diference").val(),
                fac_rep: $("input#fac_rep").val(),
                drivers : $("#drivers").val(),
                ikg_transporter: $("input#ikg_transporter").val(),
                mult_day_route : $("#mult_day_route").val(),           
                number_of_picksup: $("#nop").html(),
                accounts: $("input#account_nos").val(),
                schedules: $("input#scheduled_ids").val(),
                total_estimate:$("#estimated").html(),
                incs : remove_incompletes,
                what_day:$("#what_day").val(),
                scheds_to_remove: $("input#return_stops").val(),
                scheds_to_add:$("input#newly_added_routes").val(),
                accounts_to_add:$("input#accounts_to_add").val(),
                trailer:$("select#trailer").val(),
                trailer_lp:$("input#trailer_lp").val(),
                jsig: $('.js-signature').jqSignature('getDataURL'),
                jsig2: $('.js-signature').jqSignature('getDataURL') 
            },function(data){
                //alert(data);
                //$("#debug").html(data);   
                if(data ==1){
                    alert("Your session has ended, please re-login to complete this route.");
                    parent.window.opener.location.href="home.php";
                }else{
                    $("#loading").append(" AND refreshing route information");
                    //$("#resubmit_this").submit();
                     if( parent.window.opener.location.href == "https://inet.iwpusa.com/scheduling.php?task=schoipu" ){//did you come from scheduled oil pickups?
                        parent.window.opener.document.location.reload(true);
                    }
                    $("#loading").fadeOut("fast",function(){
                        //alert("Route Updated!"); 
                        $("#resubmit_this").submit();
                           
                    });
                }
            });   
        }
    });


    function reOrder(){        
        $("#sortable tbody tr").find("td:nth-child(2)").each(function (i) {
             $(this).html(i+1);
        });
        var rowCount = $('#sortable tbody tr').length;
        $("#nop").html(rowCount);
        
        
         var reordered ="";
        $(".accnt_row").each(function(){
            reordered+= $(this).attr('xlr')+"|";
        });        
        $("input#account_nos").val(reordered);
        $("#loading").fadeOut("fast");
    }
   
    
    $( "#sortable tbody" ).on( "sortbeforestop", function( event, ui ) {
        $("#loading").show();
       setTimeout('reOrder()',1000);
       
    });
   $("#refresh").click(function(){
        $("#resubmit_this").submit();
   });
   
   
   <?php if(isset($_POST['from_routed_oil_pickups'])){ ?>
   $("#recover").click(function(){
        if(confirm("Warning! this will undo optimization")){
            Shadowbox.open({
               content:"<?php  echo 'x.php?route='.$_POST['manifest'];   ?>",
               player:"iframe",
               width:"100px",
               height:"100px",
               options: { 
                    modal:   true,
                    onClose: function(){ $("#resubmit_this").submit(); }
               }
            });
        }
   });
   
   $(".fix_address").click(function(){
        Shadowbox.open({
           content:"verify_address.php?account="+$(this).attr('rel')+"",
           player:"iframe",
           width:"1200px",
           height:"500px",
           options: { 
                modal:   true,
                onClose: function(){ $("#resubmit_this").submit(); }
           } 
        });
   });
   <?php } ?>
   
    $("#null").click(function(){
        alert("Please create route before refreshing"); 
    });
    
    

</script>

<form id="resubmit_this" method="post" action="oil_routing.php">
<input type="hidden" name="manifest" id="form_route" value="<?php echo $_POST['manifest']; ?>" placeholder="route id to be submitted" readonly=""/>
<input type="hidden" name="from_routed_oil_pickups" value="1" readonly=""/>
</form>
</body>
</html>
