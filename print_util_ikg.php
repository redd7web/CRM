<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
$accounts_container = $dbprefix."_containers";
$containerslist = $dbprefix."_list_of_containers";
ini_set('display_errors',1); 
 error_reporting(E_ALL);
$ikg_util = $db->where('route_id',$_GET['route_no'])->get($dbprefix."_ikg_util");  
$fnak = date('Y-m-d_H-i-s');
$path = "IKG_UTIL_RECEIPT".$fnak.".pdf";
?>
<style type="text/css">
body{
    margin-top:5%;
    height:990px;
}

@page{
    size: 8.5in 14in;
    margin: 0.5in;
} 


input[type=text]{
    border-top:0px;
    border-left:0px;
    border-right:0px;
    border-bottom:1px solid black;
}

table#meat td{
    border: 1px solid #ccc;
    border-collapse: separate;
    padding:0px 0px 0px 0px;
}

#fields{
    transform:rotate(90deg);
}
</style>
<title><?php echo "IKG_UTIL_RECEIPT".$fnak; ?></title>

<div id="fields" style="width: 100%;height:auto;margin:auto;">
    <table style="width: 100%;font-size:10px;" id="meatikg">
        <tr><td colspan="3" style="text-align: left;font-size:34px;fontweight:bold;">IKG MANIFEST</td><td colspan="2" style="text-align: center;font-size:24px;font-weight:bold;"><?php echo $path; ?></td><td colspan="3" style="text-align: right;"><img src="img/blogo.jpg"/></td></tr>
        <tr>
            <td>IKG Ttitle</td>
            <td><input type="text" id="ikgmanifestnumber" value="<?php 
                if(isset($ikg_util[0]['ikg_manifest_route_number'])) {  
                     echo $ikg_util[0]['ikg_manifest_route_number'];
                } else{
                    echo "bio-".date("YmdHis");  
} ?>" name="ikgmanifestnumber"/></td>
            <td>Tank 1<br />Tank 2</td>
            <td><input id="tank1" value="<?php if(isset($ikg_util[0]['tank1'])){ echo $ikg_util[0]['tank1'];} ?>" name="tank1" type="text"/><br /><input id="tank2" name="tank2" value="<?php if(isset($ikg_util[0]['tank2'])){ echo $ikg_util[0]['tank2'];} ?>" type="text"/></td>
            <td>Time Start</td>
            <td><input value="<?php if(isset($ikg_util[0]['time_start'])){ echo $ikg_util[0]['time_start'];} ?>" id="timestart" name="timestart" type="text"/></td>
            <td>Start Mileage</td>
            <td><input value="<?php if(isset($ikg_util[0]['start_mileage'])){ echo $ikg_util[0]['start_mileage'];} ?>" id="start_mileage" name="start_mileage" type="text"/></td>
        </tr>
        
        <tr>
            <td>Scheduled Date</td>
            <td><input value="<?php if(isset($ikg_util[0]['scheduled_date'])){ echo $ikg_util[0]['scheduled_date'];} ?>" type="text" id="sched_route_start" name="sched_route_start"/></td>
            <td>Truck</td>
            <td><select name="vehicle" id="vehicle">
            <?php
                $compare= "";
                if(isset($ikg_util[0]['truck'])){ $compare = $ikg_util[0]['truck'];}            
                $vehicle = $db->get($dbprefix."_truck_id");
                if(count($vehicle) >0){
                    foreach($vehicle as $truck){
                        
                       echo "<option "; 
                        if($compare == $truck['truck_id']){
                            echo "selected";
                        }
                       echo " value='$truck[truck_id]'>$truck[name]</option>";
                    }
                }
            ?>
            </select></td>
            <td>First Stop</td>
            <td><input value="<?php if(isset($ikg_util[0]['first_stop'])){ echo $ikg_util[0]['first_stop'];} ?>" id="firststop" name="firststop" type="text"/></td>
            <td>First Stop Mileage</td>
            <td><input value="<?php if(isset($ikg_util[0]['first_stop_mileage'])){ echo $ikg_util[0]['first_stop_mileage'];} ?>" type="text" id="first_stop_mileage" name="first_stop_mileage"/></td>
        </tr>
        
        <tr>
            <td>Completion Date</td>
            <td><input value="<?php if(isset($ikg_util[0]['completed_date'])){ echo $ikg_util[0]['completed_date'];} ?>" id="completion" type="text"/></td>
            <td>License Plate</td>
            <td><input value="<?php if(isset($ikg_util[0]['license_plate'])){ echo $ikg_util[0]['license_plate'];} ?>" type="text" name="lic_plate" id="lic_plate"/></td>
            <td>Last Stop</td>
            <td><input value="<?php if(isset($ikg_util[0]['last_stop'])){ echo $ikg_util[0]['last_stop'];} ?>" id="laststop" name="laststop" type="text"/></td>
            <td>Last Stop Mileage</td>
            <td><input value="<?php if(isset($ikg_util[0]last_stop_mileage)){ echo $ikg_util[0]last_stop_mileage;} ?>" id="last_stop_mileage" name="last_top_mileage"  type="text"/></td>
        </tr>
        
        <tr>
            <td>IKG Route Number</td>
            <td><input value="<?php if(isset($ikg_util[0]route_id)){ echo $ikg_util[0]route_id;} ?>" id="unique_route_no"  type="text" readonly="" /></td>
            <td>IKG Decal</td>
            <td><input value="<?php if(isset($ikg_util[0]ikg_decal)){ echo $ikg_util[0]ikg_decal;} ?>" id="ikg_decal" name="ikg_decal" type="text"/></td>
            <td>End Time</td>
            <td><input value="<?php if(isset($ikg_util[0]end_time)){ echo $ikg_util[0]end_time;} ?>"  type="text" name="end_time" id="endtime"/></td>
             <td>End Mileage</td> 
             <td><input value="<?php if(isset($ikg_util[0]end_mileage)){ echo $ikg_util[0]end_mileage;} ?>" id="end_mileage" name="end_mileage" type="text"/></td>
        </tr>
        
        <tr>
            <td>Location</td>
            <td><input value="<?php if(isset($ikg_util[0]location)){ echo $ikg_util[0]location;} ?>"  id="location" name="location" type="text"/></td>
            <td>IKG Collected</td>
            <td><input  name="ikg_collected" value="Yellow grease" id="ikg_collected" readonly="" type="text"/></td>
            <td>Fuel</td>
            <td><input value="<?php if(isset($ikg_util[0]fuel)){ echo $ikg_util[0]fuel;} ?>" name="fuel" id="fuel" type="text"/></td>
        </tr>
        
        
        <tr>
            <td>INVENTORY CODE</td><td><input value="<?php if(isset($ikg_util[0]['inventory_code'])){ echo $ikg_util[0]['inventory_code'];} ?>" name="inventory_code" id="inventory_code" type="text"/></td></td>
        </tr>
        
        
        <tr>
            <td>Lot #</td>            
            <td><input value="<?php if(isset($ikg_util[0]['lot_no'])){ echo $ikg_util[0]['lot_no'];} ?>" id="lot_no" name="lot_no" type="text"/></td><td>Gross Weight</td>
            
            <td><input value="<?php if(isset($ikg_util[0]ikg_gross_weight)){ echo $ikg_util[0]ikg_gross_weight;} ?>" id="gross_weight" name="gross_weight" type="text"/></td>
            <td>
            Net Weight
            </td>
            <td><input type="text" id="net_w"/></td>
            <td id="output" rowspan="3" style="text-align: center;font-size:20px;">
            
            </td>
        </tr>
        
        
        <tr>
            <td>Receiving Facility</td><td><?php getFacilityList("",$ikg_util[0]recieving_facility_no); ?></a></td>
        <td>Tare Weight</td>
        <td><input value="<?php if(strlen($ikg_util[0]tare_weight)>0){ echo $ikg_util[0]tare_weight;} ?>" type="text" name="tara_weight" id="tara_weight"/></td>
        <td>Collected Weight (lbs)</td>
        <td> <input type="text"  readonly="true"  id="cw" value=""/>  </td>
        
           </tr>
            
            <tr>
            <td>Facility Address</td>
            <td><input value="<?php if(strlen($ikg_util[0]facility_address)>0){ echo $ikg_util[0]facility_address;} ?>" name="fac_address" id="fac_address" type="text"/></td>
            <td>Net Weight</td>
            <td><input value="<?php if(strlen($ikg_util[0]net_weight)>0){ echo $ikg_util[0]net_weight;} ?>"  name="net_weight" id="net_weight" type="text" readonly="true"/></td>
            <td>Differencee </td>
            <td><input type="text" id="diference" readonly="true" /> </td>
        </tr>
        
        <tr>
            <td>Facility Rep</td>
            <td><input value="<?php if(strlen($ikg_util[0]facility_rep)>0){ echo $ikg_util[0]facility_rep;} ?>" id="fac_rep" name="fac_rep" type="text"/></td>
            <td rowspan="4" colspan="6">
            <br /><br />
            Facility Rep ________________________________________________________________________<br /><br />
             Driver _____________________________________________________________________________
            
            </td>
        </tr>
        
        <tr>
            <td>Driver</td><td>
            <select name="drivers" id="drivers">
                <?php
                    if(strlen($ikg_util[0]driver) >0){ $compare_driver = $ikg_util[0]driver;} else { $compare_driver="";}
                    $bv = $dbprefix."_users";
                    $ju = $db->query("SELECT first,last,user_id FROM $bv WHERE roles like '%service driver%' order by last");
                    if(count($ju)>0){
                        foreach($ju as $role){
                            echo "<option "; 
                            if($compare_driver == $role['user_id']){
                                echo "selected";
                            }
                            echo " value='$role[user_id]'>$role[first] $role[last]</option>";
                        }
                    }
                ?>
</select>
            </td>
        </tr>
        <tr>
            <td>IKG Transporter</td><td><input name="ikg_transporter" id="ikg_transporter" value="Biotane Pumping" readonly="" type="text"/></td>
        </tr>
        
        <tr>
            <td>View Day Route</td><td><select name="mult_day_route" id="mult_day_route"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
        </tr>
        
    </table>
    
    
    
    <table style="width: 100%;">
    <thead>
    <tr>
        
        <td style="padding: 0px 0px 0px 0px;width:50px;">
            <div class="cell" style="border-left: 1px solid black;border-top:1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">
                 #
            </div>
        </td>
        
        <td style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Name</div></td>
     
         <td  style="padding: 0px 0px 0px 0px;width:200px;width:5%;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">Account ID</div></td>
     
        <td  style="padding: 0px 0px 0px 0px;width:200px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:200px;">Address</div></td>
        
       
        
        
        <td style="padding: 0px 0px 0px 0px;width:150px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">City</div></td>
        
        
        <td style="padding: 0px 0px 0px 0px;"><div class="cell" style="border-top: 1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0)">Zip</div></td>
        
        
        <td style="padding: 0px 0px 0px 0px;width:50px;width:200px;">
            <div class="cell" style="border-left: 1px solid black;border-top:1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:200px;">
                 Tote Size
            </div>
        </td>
        
        
        
        
        <td style="padding: 0px 0px 0px 0px;width:50px;">
            <div class="cell" style="border-left: 1px solid black;border-top:1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">
                 Tote Inches
            </div>
        </td>
        
        <td style="padding: 0px 0px 0px 0px;width:50px;">
            <div class="cell" style="border-left: 1px solid black;border-top:1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">
                 Gals
            </div>
        </td>
        
        <td style="padding: 0px 0px 0px 0px;width:50px;width:200px;">
            <div class="cell" style="border-left: 1px solid black;border-top:1px solid black;background:  -moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);width:200px;">
                Notes
            </div>
        </td>
        
        
      
    </tr>
    </thead>
    <tbody id="meat">
    <tr>
    <?php 
    if(!empty($ikg_util[0]scheduled_routes)){
        $aaccoouunntt = new Account();
        $count =1;
         foreach ($ikg_util[0]scheduled_routes as $ekc ){  
            $inches = "";
            $sched_ro = new Scheduled_Routes($ekc['schedule_id']);
            $request_inches = $db->where('route_id',$_GET['ikg'])->where('schedule_id',$sched_ro->schedule_id)->where('account_no',$sched_ro->account_number)->get($dbprefix.'_data_table','inches_to_gallons,inches_entered');
            
            echo "<tr>";
                echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:5%'>$count</td>";
                echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:35%;'>".$aaccoouunntt->formatted_Name($sched_ro->account_number)."</td>";
                
                echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:7%;'>".$ekc['account_no']."</td>";
                echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:10%'>".$aaccoouunntt->singleField($sched_ro->account_number,"address")."</td>";
                echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:10%'>".$aaccoouunntt->singleField($sched_ro->account_number,"city")."</td>";  
                echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:5%'>".$aaccoouunntt->singleField($sched_ro->account_number,"zip")."</td>";   
               
                echo "<td  style='border:1px solid black;padding:0px 0px 0px 0px;width:10%'>";  
                    $get = $db->query("SELECT $containerslist.* , $accounts_container.* FROM `$containerslist` INNER JOIN $accounts_container ON $containerslist.container_id = $accounts_container.container_no WHERE $accounts_container.account_no =".$sched_ro->account_number);
                    if(count($get)>0){
                         foreach($get as $info){
                            echo $info['container_label']."</br>";
                         }    
                    }
                echo"</td>";
                echo "<td  style='border:1px solid black;padding:0px 0px 0px 0px;width:10%'> "; 
                
                if(count($request_inches)>0){
                    foreach($request_inches as $entered){
                        echo $entered['inches_entered']."<br/>";
                    }

                    
                }
                else {
                    echo "&nbsp;";
                }
                echo"</td>";
                echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:15%'>";
                    if(count($request_inches)>0){
                       foreach($request_inches as $inches){
                         echo $inches['inches_to_gallons']."<br/>";
                       }
                    }
                    else {
                        echo "&nbsp;";
                    }
                echo "</td>";
                
                 echo "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:5%;'>&nbsp;</td>";    
            echo "</tr>";
            $count++;
        }
        
    }
    
    
    ?>
    </tbody>
    </table>
   <script>
   window.onload = function(){
    window.print();
   }
   </script> 
    </div>