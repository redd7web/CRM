<?php

include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
//inbound 


if(isset($_POST['filter'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "from":
                if(strlen(trim($value) ) >0 ){
                    $arrField[]= "ap_form_44342.date_created >= '$value'";    
                }
            break;
            case "to":
                if(strlen(trim($value) ) >0 ){
                    $arrField[]= "ap_form_44342.date_created <= '$value'";    
                }
            break;
        }
    }
    $string ="";
    if(!empty($arrField)){
        $string = " AND ".implode(" AND ", $arrField);
    }
   
    $ask = "SELECT ap_form_43256.element_23,ap_form_43256.element_17,ap_form_43256.element_21,ap_form_43256.element_15 as inbound_com_other,ap_form_43256.element_130,ap_form_43256.element_19,ap_form_43256.element_147,ap_form_43256.element_151,ap_form_43256.date_created as tsl_date, ap_form_43256.element_150 as seal_number,Inetforms.ap_form_44342.*,ap_form_44342.element_12 as com_type,ap_form_43256.element_19 as wtn,ap_form_43256.id as truck_scale_log_id,ap_form_43256.element_129 as shipped_from,ap_form_43256.element_116,ap_form_43256.element_131,ap_form_43256.element_132,ap_form_43256.element_133,ap_form_43256.element_140,ap_form_43256.element_141,ap_form_43256.element_135,ap_form_43256.element_137,ap_form_43256.element_142,ap_form_43256.element_134,ap_form_43256.element_145, ap_form_43256.element_22 as inbound_driver,ap_form_43256.element_16 as inbound_ship_from,ap_form_43256.element_20 as inbound_carrier,ap_form_43256.element_24,ap_form_43256.element_25,ap_form_43256.element_114 as requestor,ap_form_43256.element_119,ap_form_43256.element_18 as inb_net,ap_form_43256.element_144 as tsl_wtn_pic FROM Inetforms.ap_form_44342 INNER JOIN Inetforms.ap_form_43256 ON ap_form_44342.element_76 = ap_form_43256.id  WHERE (ap_form_43256.element_4 IN('Pending','Rejected') 
 
AND 
 
( ap_form_43256.element_1 =1  OR

ap_form_43256.element_1 IN ( 8, 25, 10, 21 ) )  $string ) OR
( ap_form_43256.element_1 = 9 $string )  ";
    echo $ask;
    $pend = $db->query($ask);
}else{
    $year = date("Y");
    $month = date("m");
    $pend = $db->query("SELECT ap_form_43256.element_23,ap_form_43256.element_17,ap_form_43256.element_21,ap_form_43256.element_15 as inbound_com_other,ap_form_43256.element_130,ap_form_43256.element_19,ap_form_43256.element_147,ap_form_43256.element_151,ap_form_43256.date_created as tsl_date, ap_form_43256.element_150 as seal_number,Inetforms.ap_form_44342.*,ap_form_44342.element_12 as com_type,ap_form_43256.element_19 as wtn,ap_form_43256.id as truck_scale_log_id,ap_form_43256.element_129 as shipped_from,ap_form_43256.element_116,ap_form_43256.element_131,ap_form_43256.element_132,ap_form_43256.element_133,ap_form_43256.element_140,ap_form_43256.element_141,ap_form_43256.element_135,ap_form_43256.element_137,ap_form_43256.element_142,ap_form_43256.element_134,ap_form_43256.element_145, ap_form_43256.element_22 as inbound_driver,ap_form_43256.element_16 as inbound_ship_from,ap_form_43256.element_20 as inbound_carrier,ap_form_43256.element_24,ap_form_43256.element_25,ap_form_43256.element_114 as requestor,ap_form_43256.element_119,ap_form_43256.element_18 as inb_net,ap_form_43256.element_144 as tsl_wtn_pic FROM Inetforms.ap_form_44342 INNER JOIN Inetforms.ap_form_43256 ON ap_form_44342.element_76 = ap_form_43256.id  WHERE ap_form_44342.element_3 IN('Pending','Rejected') AND (  ( ap_form_44342.tsl_type =1 AND ap_form_44342.element_12 IN ( 8, 25, 10, 21 ) )  OR  ap_form_44342.tsl_type = 9  ) AND ap_form_43256.date_created >='$year-$month-01' AND ap_form_43256.date_created <='$year-$month-".date('t')."'");    
}




?>
<style type="text/css">
body{
    background:url(img/bodystrip.jpg) repeat-x left 7px;
}
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
    overflow-x:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}

td ,th{
    background:transparent;
    
    padding:10px 10px 10px 10px;
    margin:3px 3px 3px 3px;
    white-space: nowrap;
    text-align: center;
    width:auto;
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}
img{
    max-width:100%;
    max-height:100%;
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}
#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
}
table{
    border-spacing: 15px;
    border-collapse: separate;
}
input[type=checkbox]{
    width:10px;
}
</style>
   
<script>
Shadowbox.init();
$(document).ready(function(){    
   $('#myTable').dataTable({
        "order": [ 0, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>   
<div id="space_top" style="height:97px;width:100%;background:rgba(255,255,255,.4)"></div>
<form action="PendingDogFood.php" method="POST">
<table style="width: 80%;margin:auto;"><tr><td style="text-align: left;"><img src="bakery/img/blogo.jpg" style="position:relative;"/></td><td></td><td><input placeholder="From" type="text" id="from" name="from" value="<?php if(isset($_POST['filter'])){ echo $_POST['from'];  } ?>"/></td><td><input placeholder="To" type="text" id="to" name="to"  value="<?php if(isset ($_POST['filter'])  ){ echo $_POST['to']; } ?>" /></td><td><input type="submit" value="Filter" name="filter"/></td></tr>
<tr><td></td></tr>
</table>
</form>
<table style="width: 100%;margin:auto;"  id="myTable"  style="width: 80%;margin:auto;margni-top:10px;">
    <thead>
  
    <tr>
    <td>Date</td>
        <th>Seal Number</th>
    <td>Delete Entry</td>
    <td>Edit TSL</td>
    <td>Deconstruction Form</td>
    <td>TSL Type</td>
    <th>Status</th>
    <th>Truck Request</th>
    <th>Weight Ticket</th>    
    <th>Net Weight</th>
    <th>Incoming Net Weight</th>
    <th>Incoming Weight Certification</th>
    <th>Ship From</th>
    <th>Commodity</th>
    <th>Carrier</th>
    <th>Driver</th>
    <th>Pickup</th>
    <th>Release Number</th>
    <th>Trailer</th>
    <th>Notes</th>
    <th>Weight Certificate</th>
    <th>View INCOMING Certificate</th>
    <th>View Lab</th>

    <th>Bol/Support</th>

    </tr>
    </thead>
    <tbody>
    <?php
    if(count($pend)){
        foreach($pend as $dogfood){
            $comom ="";
            $origination= "";
            $driver = "";
            $carrier="";
            $pickup= "";
            $ship_form="";
            $trailer="";
            $note = "";
            $net=0;
            $weight_ticket="";
            $release =$dogfood['element_134'];
           switch($dogfood['tsl_type']){            
                case 1: 
                    $net = $dogfood['inb_net'];
                    $note = $dogfood['element_25'];
                    $pickup = $dogfood['element_24'];                
                    $origination = "Inbound";
                    $release = $dogfood['element_24'];
                    $weight_ticket = $dogfood['element_19'];
                    switch($dogfood['com_type']){
                        case 6:  $comom = "Almond Ground Shell"; break;
                        case 13: $comom = "Almond Meal"; break;
                        case 18: $comom = "Bakery"; break;
                        case 25: $comom = "Candy"; break;
                        case 10: $comom = "Chocolate"; break;
                        case 24: $comom = "Clear Diesel"; break;
                        case 7:  $comom = "Dehy Bakery"; break;
                        case 21: $comom = "Dressing"; break;
                        case 11: $comom = "Food Waste"; break;
                        case 17: $comom = "Fat Lint"; break;
                        case 12: $comom = "Lint"; break;
                        case 8:  $comom = "North Star Mayo"; break;
                        case 14: $comom = "Methanol"; break;
                        case 23: $comom = "peanut Butter"; break;
                        case 20: $comom = "Sodium Hydroxide"; break;
                        case 22: $comom = "Sulferic Acid"; break;
                        case 15: $comom = "Water"; break;
                        case 16: $comom = "WCS"; break;
                        case 9:  $comom = "Other / ".$dogfood['inbound_com_other']; break;
                    }
                
                    switch($dogfood['inbound_driver']){
                        case 4:  $driver ="Aaron";break;
                        case 13: $driver ="Alejandro";break;
                        case 15: $driver ="Casey";break;
                        case 12: $driver ="Chris";break;
                        case 25: $driver ="Darryl";break;
                        case 28: $driver ="David";break;
                        case 10: $driver ="Enrique";break;
                        case 30: $driver ="Fernando";break;
                        case 22: $driver ="Gerald";break;
                        case 31: $driver ="Giovanny";break;
                        case 32: $driver ="Hans";break;
                        case 21: $driver ="Harry";break;
                        case 5:  $driver ="Jaime";break;
                        case 26: $driver ="Jason";break;
                        case 33: $driver ="Jeremy";break;
                        case 17: $driver ="Jesus";break;
                        case 6:  $driver ="Jose";break;
                        case 16: $driver ="Juan Jr";break;
                        case 27: $driver ="Ismael";break;
                        case 18: $driver ="Lazaro";break;
                        case 20: $driver ="Martin C";break;
                        case 7:  $driver ="Martin E";break;
                        case 11: $driver ="Milton";break;
                        case 8:  $driver ="Pedro";break;
                        case 19: $driver ="Pepe";break;
                        case 29: $driver ="Reynaldo";break;
                        case 23: $driver ="Rogine";break;
                        case 24: $driver ="Salvador";break;
                        case 14: $driver ="Shawn";break;
                        case 9:  $driver ="Other /".$dogfood['element_23'];break;
                    }
                    
                    switch($dogfood['inbound_ship_from']){
                        case 7:  $ship_form ="gape Transportation";break;
                        case 26:  $ship_form ="Bimbo";break;
                        case 21:  $ship_form ="Brenntag";break;
                        case 28:  $ship_form ="Connection Chemical";break;
                        case 23:  $ship_form ="Giralds";break;
                        case 17:  $ship_form ="IWP/AZ";break;
                        case 14:  $ship_form ="IWP/Mira Loma";break;
                        case 15:  $ship_form ="IWP/Selma";break;
                        case 27:  $ship_form ="Kinder Morgan";break;
                        case 11:  $ship_form ="LVO";break;
                        case 22:  $ship_form ="Nexeo";break;
                        case 8:   $ship_form ="North Star Recycling";break;
                        case 10:  $ship_form ="Sara Lee";break;
                        case 20:  $ship_form ="Schaffner";break;
                        case 18:  $ship_form ="Sparkletts";break;
                        case 16:  $ship_form ="TARR";break;
                        case 25:  $ship_form ="VDFC Victorville";break;
                        case 24:  $ship_form ="Ventura Foods Co";break;
                        case 19:  $ship_form ="Verhoeven";break;
                        case 12:  $ship_form ="Victorville DC";break;
                        case 9:  $ship_form ="Other / ".$dogfood['element_17'];break;
                    }
                    
                    switch($dogfood['inbound_carrier']){
                        case 4:  $carrier ="Agape Transportation";break;
                        case 27:  $carrier ="Angus Transportation";break;
                        case 22:  $carrier ="Brenntag";break;
                        case 13:  $carrier ="C Rocha";break;
                        case 15:  $carrier ="Cruz";break;
                        case 12:  $carrier ="Desert Soul";break;
                        case 19:  $carrier ="DTI";break;
                        case 5:  $carrier ="GMT";break;
                        case 11:  $carrier ="Hernandez";break;
                        case 10:  $carrier ="IWP";break;
                        case 21:  $carrier ="JL Trucking";break;
                        case 16:  $carrier ="Mallet";break;
                        case 17:  $carrier ="Narvaez";break;
                        case 18:  $carrier ="Nexeo";break;
                        case 8:  $carrier ="Orbit";break;
                        case 26:  $carrier ="Pride Intermodal";break;
                        case 24:  $carrier ="Road Runner";break;
                        case 25:  $carrier ="Ryan";break;
                        case 14:  $carrier ="Sparkletts";break;
                        case 23:  $carrier ="System Transport";break;
                        case 20:  $carrier ="Universal Trucking";break;
                        case 9:  $carrier ="Other / ".$dogfood['element_21'];break;
                    }
                    break;
                case 9: 
                     $net = $dogfood['element_133'];
                     $origination = "Pet Food";
                     $note = $dogfood['element_141'];
                     $pickup="";
                     $release = $dogfood['element_147'];
                     $weight_ticket = $dogfood['element_134'];
                     
                     switch($dogfood['com_type']){
                        case 1:
                            $comom = "Extruded Pallet";
                        break;
                        case 3:
                            $comom = "Other /".$dogfood['element_130'];;
                        break;
                        case 4:
                            $comom = "Extruded Gaylord";
                        break;
                        case 5:
                            $comom = "BULK";
                        break;
                        case 6:
                            $comom = "Bagged Under 1 lb";
                        break;
                        case 7:
                            $comom = "Bagged 1 lb to 5 lb";
                        break;
                        case 9:
                            $comom = "Single Serve Pallet";
                        break;
                        case 8:
                            $comom ="Bagged Over 5 lb";
                        break;
                        

                    
                    }
                    switch($dogfood['element_137']){
                        case 1:
                            $driver = "Caesar";
                        break;
                        case 2:
                            $driver = "Other";
                        break;
                        case 4:
                            $driver = "Jesus";
                        break;
                    }
                    switch($dogfood['element_135']){
                        case 1:
                            $carrier ="Desert Soul";
                        break;
                        case 2:
                            $carrier ="Other";
                        break;
                        case 6:
                            $carrier ="JL Trucking";
                        break;
                        case 7:
                            $carrier ="IWP";
                        break;
                    }
                    switch($dogfood['element_142']){
                        case 1:  $pickup ="30 Yd Comp W2E";break;
                        case 4:  $pickup ="30 Yd Open Top W2E";break;
                        case 5:  $pickup ="Corn Cleanout";break;
                        case 2:  $pickup ="Recycling Bale Trailor";break;
                        case 3:  $pickup ="Third option";break;
                    }
                    switch($dogfood['element_131']){
                        case 1:$ship_form = "Sparks, NV";break;
                        case 9:$ship_form = "Redlands, CA";break;
                        case 8:$ship_form = "Bernardino, CA"; break;
                        case 7:$ship_form = "Victorville, CA"; break;
                        case 2:$ship_form = $dogfood['element_132'];break;//other
                    }
                break;
           }
            
    
            echo "<tr>";
            echo "<td>$dogfood[tsl_date]</td>";
            echo "<td>$dogfood[seal_number]</td>";
            echo "<td><img src='img/red_cancel.png' rel='$dogfood[id]' title='Reject Sample' class='reject' style='cursor:pointer;'/></td>";//blank 1
            echo "<td><img src='img/table_edit.png' rel='$dogfood[truck_scale_log_id]' origination='$dogfood[tsl_type]'   title='Edit Truck Scale Entry' xlr='$dogfood[tsl_type]' class='edit_truck_scale' style='cursor:pointer;'/></td>";//blank 2
            
            
            echo "<td><img src='images/deconstruct.png' rel='$dogfood[id]' xlr='$dogfood[truck_scale_log_id]' title='Decontruct Sample' class='deconstruct' style='width:35px;height:20px;cursor:pointer;' /></td>";//blank 3
            echo "<td>$origination</td>";
            echo "<td>$dogfood[element_3]</td>";//status
            echo "<td>$dogfood[truck_scale_log_id]</td>";//truck request
            echo "<td>"; 
            if(strlen($dogfood['element_145'])>0){
                echo "<span style='cursor:pointer;text-decoration:underline;' rel='$dogfood[truck_scale_log_id]' class='wtn'>";
            }
                echo "$weight_ticket"; //weight ticket
            
            if(strlen($dogfood['element_145'])>0){
                echo "</span>";
            }
            echo "</td>";
            echo "<td>$net</td>";
            echo "<td>$dogfood[element_119]</td>";
            echo "<td>$dogfood[element_116]</td>";
            echo "<td>$ship_form</td>";
            echo "<td>$comom</td>";
            echo "<td>$carrier</td>";
            echo "<td>$driver</td>";
            echo "<td>$pickup</td>";
            echo "<td>$release</td>";
            echo "<td>$dogfood[element_140]</td>";
            echo "<td>$note</td>";//notes
            echo "<td>";                
                if($dogfood['tsl_wtn_pic'] != NULL && strlen($dogfood['tsl_wtn_pic'])>0){
                    echo "<img src='img/23117-200.png' style='width:20%;cursor:pointer;' class='wtn_pic' rel='machforms/machform/data/form_43256/files/".$dogfood['tsl_wtn_pic']."' />";
                }else{
                    echo "N/A";
                }
                
            echo "</td><td>";
                if($dogfood['element_145'] != NULL && strlen($dogfood['element_145'])>0){
                    echo "<img class='wtn_pic' src='img/23117-200.png' style='width:20%;cursor:pointer;' rel='machforms/machform/data/form_43256/files/".$dogfood['element_145']."'/>";
                }else{
                    echo "N/A";
                }
            echo "</td>";
            
             //$v="sdfsfds";
            if($dogfood['truck_scale_log_id'] !=NULL  && strlen(trim($dogfood['truck_scale_log_id']))>0){
                $dp = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_76 = $dogfood[truck_scale_log_id] AND ap_form_44342.id != $dogfood[id]");
                if(count($dp)>0){
                    switch($dp[0]['element_3']){
                        case "Completed":
                            $v = "?truck=".$dogfood['truck_scale_log_id'];
                        break;
                        default:
                            $v = "?tsl_truck=".$dogfood['truck_scale_log_id']."&er_id=$dogfood[id]";;
                        break;
                    }
                    $er_status = $dp[0]['element_3'];
                }else{
                    $er_status = "Pending";
                    $v = "?tsl_truck=".$dogfood['truck_scale_log_id']."&er_id=$dogfood[id]";
                }
            }else{
                $er_status = "Pending";
                $v = "?tsl_truck=".$dogfood['truck_scale_log_id']."&er_id=$dogfood[id]";
            }
            echo "<td><a href='ER.php$v' target='_blank'><img src='img/search.jpg'/></a><br/>$er_status</td>";
            
            
            if(strlen(trim($dogfood['element_151']))){
                $bol = "<a href='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/$dogfood[element_151]' target='_blank'><img src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/$dogfood[element_151]' style='width:50%;height:50%;'/></a>";
            }else{
                $bol ='N/A';
            }
            echo "<td>$bol</td>";
            echo "</tr>";
        }
    }
    
    ?>
    </tbody>
</table>

<iframe id="login_edit" src="" style="width: 1px;height:1px;"></iframe>
<script>
window.onload = function(){
    $("#login_edit").attr('src',"machlogin.php");
}
$(".reject").click(function(){    
    if(confirm("Are you sure you wish to delete this sample?")){
        $.post("rejectsampledf.php",{id:$(this).attr('rel'),status:"rejected"},function(data){
             alert(data);
             window.location.reload();
        });
    }
    
});


$('.wtn_pic').click(function(){
   window.open($(this).attr("rel")); 
});

$('.deconstruct').click(function(){
   window.open('DECONSTRUCT.php?entry_id='+$(this).attr('rel')+'&truck_id='+$(this).attr('xlr')+'');
})


$(".edit_truck_scale").click(function(){
    var table;
    switch( $(this).attr('xlr')  ){
        case "1":table ="43256";break;
        case "9":table ="43256";break;
    }
   window.open('inbound_edit.php?entry_id='+$(this).attr('rel')+'&origination='+$(this).attr('origination'));
});

$(".wtn").click(function(){
    window.open("file_upload.php?dogfoodid="+$(this).attr('rel')+"");
});


$("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>