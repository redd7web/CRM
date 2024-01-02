<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
$accounts_container = $dbprefix."_containers";
$containerslist = $dbprefix."_list_of_containers";
//ini_set('display_errors',1); 
 error_reporting(E_ALL);
$ikg_info = new IKG($_GET['ikg']);  
"IKG_RECEIPT".date('Y-m-d_H-i-s').".pdf";


$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>IKG MANIFEST RECIEPT</title>
<style type="text/css">
<!--
@page{
    size: 8.5in 11in;
    margin: 0.5in;
} 

table#meatikg{
    border: 0px solid #bbb;
}
input[type="text"]{
    border:0px solid #bbb;
    
}

.myTable{
    size: 8.5in 14in;
    transform:rotate(90deg);
}
body {
  font-family:Tahoma;
}

img {
  border:0;
}

#page {
  width:800px;
  margin:0 auto;
  padding:15px;

}

#logo {
  float:left;
  margin:0;
}

#address {
  height:181px;
  margin-left:250px; 
}

table {
  width:100%;
}



tr.odd {
  background:#e1ffe1;
}
-->
</style>
</head>
<body>
';



$html .='<div id="fields" style="width: 100%;height:auto;margin:auto;">
    <table style="width: 100%;font-size:10px;border:0px solid transparent;" id="meatikg">
        <tr><td colspan="3" style="text-align: left;font-size:34px;fontweight:bold;">IKG MANIFEST</td><td colspan="2" style="text-align: center;font-size:24px;font-weight:bold;">'.$ikg_info->ikg_manifest_route_number.'</td><td colspan="3" style="text-align: right;"><img src="http://www.datastormdesigns.com/biotane/img/blogo.jpg"/></td></tr>
        <tr>
            <td>IKG Ttitle</td>
            <td><input type="text" id="ikgmanifestnumber" value="';
       $html .=$ikg_info->ikg_manifest_route_number;
       $html .='" name="ikgmanifestnumber"/></td>
            <td>Tank 1<br />Tank 2</td>
            <td><input id="tank1" value="';
        $html .=$ikg_info->tank1;
        $html .='" name="tank1" type="text"/><br /><input id="tank2" name="tank2" value="';
        $html .=$ikg_info->tank2;
        $html .='" type="text"/></td>
            <td>Time Start</td>
            <td><input value="';
        $html .=$ikg_info->time_start;
        $html .='" id="timestart" name="timestart" type="text"/></td>
            <td>Start Mileage</td>
            <td><input value="';
        $html .= $ikg_info->start_milage;        
        $html .='" id="start_mileage" name="start_mileage" type="text"/></td></tr>
        
        <tr>
            <td>Scheduled Date</td>
            <td><input value="';
        $html .=$ikg_info->scheduled_date;
        $html .= '" type="text" id="sched_route_start" name="sched_route_start"/></td>
            <td>Truck</td>
            <td><select name="vehicle" id="vehicle">';
         
                $compare= "";
                if(isset($ikg_info->truck)){ $compare = $ikg_info->truck;}            
                $vehicle = $db->get($dbprefix."_truck_id");
                if(count($vehicle) >0){
                    foreach($vehicle as $truck){
                        
                       $html .="<option "; 
                        if($compare == $truck['truck_id']){
                            $html .= "selected";
                        }
                        $html .=" value='$truck[truck_id]'>$truck[name]</option>";
                    }
                }
                
        $html .='</select></td>
            <td>First Stop</td>
            <td><input value="';
        $html .=$ikg_info->first_stop;
        $html .='" id="firststop" name="firststop" type="text"/></td>
            <td>First Stop Mileage</td>
            <td><input value="';
        $html .=$ikg_info->first_stop_mileage;
        $html .='" type="text" id="first_stop_mileage" name="first_stop_mileage"/></td>
        </tr>
        
        <tr>
            <td>Completion Date</td>
            <td><input value="';
        $html .=$ikg_info->completed_date;
        $html .='" id="completion" type="text"/></td>
            <td>License Plate</td>
            <td><input value="';
        $html .=$ikg_info->license_plate;
        $html .='" type="text" name="lic_plate" id="lic_plate"/></td>
            <td>Last Stop</td>
            <td><input value="';
        $html .=$ikg_info->last_stop;
        $html .= '" id="laststop" name="laststop" type="text"/></td>
            <td>Last Stop Mileage</td>
            <td><input value="';
        $html .=$ikg_info->last_stop_mileage;
        $html .='" id="last_stop_mileage" name="last_top_mileage"  type="text"/></td>
        </tr>
        
        <tr>
            <td>IKG Route Number</td>
            <td><input value="';
        $html .=$ikg_info->route_id;
        $html .='" id="unique_route_no"  type="text" readonly="" /></td>
            <td>IKG Decal</td>
            <td><input value="';
        $html .=$ikg_info->ikg_decal;
        $html .='" id="ikg_decal" name="ikg_decal" type="text"/></td>
            <td>End Time</td>
            <td><input value="';
        $html .=$ikg_info->end_time;
        $html .='" type="text" name="end_time" id="endtime"/></td>
             <td>End Mileage</td> 
             <td><input value="';
        $html .=$ikg_info->end_mileage;
        $html .='" id="end_mileage" name="end_mileage" type="text"/></td>
        </tr>
        
        <tr>
            <td>Location</td>
            <td><input value="';
        $html .=$ikg_info->location;
        $html .='" id="location" name="location" type="text"/></td>
            <td>IKG Collected</td>
            <td><input  name="ikg_collected" value="Yellow grease" id="ikg_collected" readonly="" type="text"/></td>
            <td>Fuel</td>
            <td><input value="';
        $html .=$ikg_info->fuel;
        $html .='" name="fuel" id="fuel" type="text"/></td>
        </tr>
        
        
        <tr>
            <td>INVENTORY CODE</td><td><input value="';
        $html .=$ikg_info->inventory_code;
        $html .= '" name="inventory_code" id="inventory_code" type="text"/></td></td>
        </tr>
        <tr>
            <td>Lot #</td>            
            <td><input value="';
        $html .=$ikg_info->lot_no;
        $html .='" id="lot_no" name="lot_no" type="text"/></td><td>Gross Weight</td>
            <td><input value="';
        $html .=$ikg_info->ikg_gross_weight;
        $html .='" id="gross_weight" name="gross_weight" type="text"/></td>
            <td>
            Net Weight
            </td>
            <td><input type="text" id="net_w"/></td>
            <td id="output" rowspan="3" style="text-align: center;font-size:20px;">
            
            </td>
        </tr>
        
        
        <tr>
            <td>Receiving Facility</td><td>';
        $html .= numberToFacility($ikg_info->recieving_facility_no);
        $html .='</td>
        <td>Tare Weight</td>
        <td><input value="';
        $html .=$ikg_info->tare_weight;
        $html .='" type="text" name="tara_weight" id="tara_weight"/></td>
        <td>Collected Weight (lbs)</td>
        <td> <input type="text"  readonly="true"  id="cw" value=""/>  </td>
        
           </tr>
            
            <tr>
            <td>Facility Address</td>
            <td><input value="';
        $html .=$ikg_info->facility_address;
        $html .='" name="fac_address" id="fac_address" type="text"/></td>
            <td>Net Weight</td>
            <td><input value="';
        $html .=$ikg_info->net_weight;
        $html .='" name="net_weight" id="net_weight" type="text" readonly="true"/></td>
            <td>Differencee </td>
            <td><input type="text" id="diference" readonly="true" /> </td>
        </tr>
        
        <tr>
            <td>Facility Rep</td>
            <td><input value="';
        $html .=$ikg_info->facility_rep;
        $html .='" id="fac_rep" name="fac_rep" type="text"/></td>
            <td rowspan="4" colspan="6">
            <br /><br />
            Facility Rep ________________________________________________________________________<br /><br />
             Driver _____________________________________________________________________________
            
            </td>
        </tr>
        
        <tr>
            <td>Driver</td><td>
            <select name="drivers" id="drivers">';
            
                    if(strlen($ikg_info->driver) >0){ $compare_driver = $ikg_info->driver;} else { $compare_driver="";}
                    $bv = $dbprefix."_users";
                    $ju = $db->query("SELECT first,last,user_id FROM $bv WHERE roles like '%service driver%' order by last");
                    if(count($ju)>0){
                        foreach($ju as $role){
                            $html .="<option "; 
                            if($compare_driver == $role['user_id']){
                                $html .= "selected";
                            }
                            $html .=" value='$role[user_id]'>$role[first] $role[last]</option>";
                        }
                    }
    $html .='</select>
            </td>
        </tr>
        <tr>
            <td>IKG Transporter</td><td><input name="ikg_transporter" id="ikg_transporter" value="Biotane Pumping" readonly="" type="text"/></td>
        </tr>
        
        <tr>
            <td>View Day Route</td><td><select name="mult_day_route" id="mult_day_route"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
        </tr>
        
    </table>
    
    
    
    <table style="width:100%;border:0px solid black;" id="chart">
    <thead>
    <tr>
        
        <td style="padding: 0px 0px 0px 0px;width:30px;border:1px solid black;">
            
                 #
            
        </td>
        
        <td style="padding: 0px 0px 0px 0px;width:300px;border:1px solid black;">Name</td>
     
         <td  style="padding: 0px 0px 0px 0px;width:600px;width:5%;border:1px solid black;">Account</td>
     
        <td  style="padding: 0px 0px 0px 0px;width:300px;border:1px solid black;">Address</td>
        
       
        
        
        <td style="padding: 0px 0px 0px 0px;width:150px;border:1px solid black;">City</td>
        
        
        <td style="padding: 0px 0px 0px 0px;border:1px solid black;width:50px;">Zip</td>
        
        
        <td style="padding: 0px 0px 0px 0px;width:50px;width:200px;border:1px solid black;">
            
                 Tote Size
            
        </td>
        
        
        
        
        <td style="padding: 0px 0px 0px 0px;width:50px;border:1px solid black;">
            
              Inches
            
        </td>
        
        <td style="padding: 0px 0px 0px 0px;width:50px;border:1px solid black;">
            
                 Gals
            
        </td>
        
        <td style="padding: 0px 0px 0px 0px;width:200px;border:1px solid black;">
            
                Notes
            
        </td>
        
        
      
    </tr>
    </thead>
    <tbody id="meat">
    <tr>
';
    
    //var_dump($ikg_info->account_numbers); 
    //var_dump($ikg_info->scheduled_routes);
       
    $aaccoouunntt = new Account();
    $count =1;
         foreach ($ikg_info->scheduled_routes as $ekc ){  
            $inches = "";
            $sched_ro = new Scheduled_Routes($ekc);
            $request_inches = $db->where('route_id',$_GET['ikg'])->where('schedule_id',$sched_ro->schedule_id)->where('account_no',$sched_ro->account_number)->get($dbprefix.'_data_table','inches_to_gallons,inches_entered');
            
            $html .= "<tr>";
                $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:20%'>$count</td>";
                $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:40%;'>$sched_ro->account_name</td>";
                
                $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:7%;'>".$sched_ro->account_number."</td>";
                $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:10%'>".$aaccoouunntt->singleField($sched_ro->account_number,"address")."</td>";
                $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:10%'>".$aaccoouunntt->singleField($sched_ro->account_number,"city")."</td>";  
                $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:5%'>".$aaccoouunntt->singleField($sched_ro->account_number,"zip")."</td>";   
               
                $html .= "<td  style='border:1px solid black;padding:0px 0px 0px 0px;'>";  
                    $get = $db->query("SELECT $containerslist.* , $accounts_container.* FROM `$containerslist` INNER JOIN $accounts_container ON $containerslist.container_id = $accounts_container.container_no WHERE $accounts_container.account_no =".$sched_ro->account_number);
                    if(count($get)>0){
                         foreach($get as $info){
                            $html .= $info['container_label']."</br>";
                         }    
                    }
                $html .="</td>";
                $html .= "<td  style='border:1px solid black;padding:0px 0px 0px 0px;width:10%'> "; 
                
                if(count($request_inches)>0){
                    foreach($request_inches as $entered){
                        $html .= $entered['inches_entered']."<br/>";
                    }

                    
                }
                else {
                    $html .= "&nbsp;";
                }
                $html .="</td>";
                $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:15%'>";
                    if(count($request_inches)>0){
                       foreach($request_inches as $inches){
                         $html .= round($inches['inches_to_gallons'],2)."<br/>";
                       }
                    }
                    else {
                        $html .= "&nbsp;";
                    }
                $html .= "</td>";
                
                 $html .= "<td style='border:1px solid black;padding:0px 0px 0px 0px;width:5%;'>&nbsp;</td>";    
            $html .= "</tr>";
            $count++;
        }
        
    
    
    $html .='</tbody>
    </table></div>';
    
    
    $fnak = date('Y-m-d_H-i-s');

$new_string = str_replace(" ","_",$ikg_info->ikg_manifest_route_number);
$new_string = str_replace("'","",$new_string);
$pdf_options = array(
  "source_type" => 'html',
  "source" => $html,
  "action" => 'save',
  "save_directory" => '',
  "page_orientation" => 'landscape',
  "file_name" => $new_string.'.pdf',
  "page_size" => 'legal'
);

phptopdf($pdf_options);

$path = $new_string.".pdf";
$filename = $new_string.".pdf";
header("Content-disposition: attachment; filename=".$filename);
header("Content-type: application/pdf");
readfile($filename);

    
    ?>
    
    
   