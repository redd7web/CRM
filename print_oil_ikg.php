<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
$accounts_container = $dbprefix."_containers";
$containerslist = $dbprefix."_list_of_containers";
ini_set('display_errors',0); 
$header = '<tr><td style="padding: 0px 0px 0px 0px;width:9px;height:100px">#</td><td style="padding: 0px 0px 0px 0px;">Name</td><td  style="padding: 0px 0px 0px 0px;">Address</td><td  style="padding: 0px 0px 0px 0px;">City</td><td  style="padding: 0px 0px 0px 0px;">Zip</td><td style="padding: 0px 0px 0px 0px;width:70px;">Col</td><td  style="padding: 0px 0px 0px 0px;">Info</td><td style="padding: 0px 0px 0px 0px;width:29px;">ZG</td><td  style="padding: 0px 0px 0px 0px;">Tote-Size</td><td  style="padding: 0px 0px 0px 0px;">Account Notes</td></tr>';
 //error_reporting(E_ALL);
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
    size: 8.5in 14in;
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

tbody#meat td{
    text-align:center;
    padding:0px 0px 0px 0px;
}

thead#meathead td{
    text-align:center;

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
    <table style="width: 100%;font-size:16.3px;border:0px solid transparent;" id="meatikg">
        <tr><td colspan="3" style="text-align: left;font-size:34px;fontweight:bold;">IKG MANIFEST</td><td colspan="2" style="text-align: center;font-size:24px;font-weight:bold;">'.$ikg_info->ikg_manifest_route_number.'</td><td colspan="3" style="text-align: right;"><img src="https://inet.iwpusa.com/img/blogo.jpg"/></td></tr>
        <tr>
            <td>IKG Ttitle</td>
            <td>';
       $html .=$ikg_info->ikg_manifest_route_number;
       $html .='</td>
            <td>Tank 1<br />Tank 2</td>
            <td>';
        $html .=$ikg_info->tank1;
        $html .='<br />';
        $html .=$ikg_info->tank2;
        $html .='</td>
            <td>Time Start</td>
            <td>';
        $html .=$ikg_info->time_start;
        $html .='</td>
            <td>Start Mileage</td>
            <td>';
        $html .= $ikg_info->start_mileage;        
        $html .='</td></tr>
        
        <tr>
            <td>Scheduled Date</td>
            <td>';
        $html .=$ikg_info->scheduled_date;
        $vehicle = new Vehicle($ikg_info->truck);
        $html .= '</td>
            <td>Truck</td>
            <td>';
         $html .= $vehicle->name;       
        $html .='</td>
            <td>First Stop</td>
            <td>';
        $html .=$ikg_info->first_stop;
        $html .='</td>
            <td>First Stop Mileage</td>
            <td>';
        $html .=$ikg_info->first_stop_mileage;
        $html .='</td>
        </tr>
        
        <tr>
            <td>Completion Date</td>
            <td>';
        $html .=$ikg_info->completed_date;
        $html .='</td>
            <td>License Plate</td>
            <td>';
        $html .=$ikg_info->license_plate;
        $html .='</td>
            <td>Last Stop</td>
            <td>';
        $html .=$ikg_info->last_stop;
        $html .= '</td>
            <td>Last Stop Mileage</td>
            <td>';
        $html .=$ikg_info->last_stop_mileage;
        $html .='</td>
        </tr>
        
        <tr>
            <td>IKG Route Number</td>
            <td>';
        $html .=$ikg_info->route_id;
        $html .='</td>
            <td>IKG Decal</td>
            <td>';
        $html .=$ikg_info->ikg_decal;
        $html .='</td>
            <td>End Time</td>
            <td>';
        $html .=$ikg_info->end_time;
        $html .='</td>
             <td>End Mileage</td> 
             <td>';
        $html .=$ikg_info->end_mileage;
        $html .='</td>
        </tr>';
        
        $route_history = $db->query("SELECT * FROM iwp_rout_history WHERE route_no = $ikg_info->route_id AND what_day >1");        
        if(count($route_history)>0){
            foreach($route_history as $history){
                $html .="
                     <tr>
                         <td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td>Day $history[what_day] ) Time Start</td>
                        <td>$history[time_start]</td>
                        <td>Day $history[what_day] ) Start Mileage</td><td>$history[start_mileage]</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td>Day $history[what_day] ) First Stop</td>
                        <td>$history[first_stop]</td>             
                        <td>Day $history[what_day] ) First Stop Mileage</td>
                        <td>$history[first_stop_mileage]</td>
                    
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td>Day $history[what_day] ) Last Stop</td>
                        <td>$history[last_stop]</td>
                        <td>Day $history[what_day] ) Last Stop Mileage</td><td>$history[last_stop_mileage]</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td>Day $history[what_day] ) End Time</td>
                        <td>$history[time_end]</td>
                        <td>Day $history[what_day] ) End Mileage</td><td>$history[end_mileage]</td>
                    </tr>
                ";    
            }
        }
        
        $html .='<tr>
            <td>Location</td>
            <td>';
        $html .=$ikg_info->location;
        $html .='</td>
            <td>IKG Collected</td>
            <td>Cooking Oil</td>
            <td>Total Time Elapsed</td><td>'.$ikg_info->time_elapsed.'</td>
            <td>Total Mileage</td><td>'.$ikg_info->total_mileage.'</td>
        </tr>
        
        
        <tr>
            <td>INVENTORY CODE</td><td>'.$ikg_info->inventory_code.'</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>Fuel</td><td>'.$ikg_info->fuel.'</td>
            <td>Total Lbs/Mile</td><td>'.$ikg_info->lb_per_mile.'</td>
        </tr>
        <tr>
            <td>Lot #</td>            
            <td>';
        $html .=$ikg_info->lot_no;
        $html .='</td><td>Gross Weight</td>
            <td>';
        $html .=$ikg_info->ikg_gross_weight;
        $html .='</td>
          <td>Weight Cert #</td>
        <td>'.$ikg_info->weight_ticket_number.'</td> 
            <td></td>
            <td id="output" rowspan="3" style="text-align: center;font-size:20px;">
            
            </td>
        </tr>
        
        
        <tr>
            <td>Receiving Facility</td><td>';
        $html .= numberToFacility($ikg_info->recieving_facility_no);
        $html .='</td>
        <td>Tare Weight</td>
        <td>';
        $html .=$ikg_info->tare_weight;
        $html .='</td>
        <td>Collected Weight (lbs)</td>
        <td>'.$ikg_info->collected_Weight.'</td>
 
     
           </tr>
            
            <tr>
            <td>Facility Address</td>
            <td>';
        $html .=$ikg_info->facility_address;
        $html .='</td>
            <td>Net Weight</td>
            <td>';
        $html .=$ikg_info->net_weight;
        $html .='</td>
            <td>Difference </td>
            <td>'.$ikg_info->difference_weight.'</td>
        </tr>
        
        <tr>
           <td>Print Rep</td>
            <td>___________________</td>
            <td rowspan="4" colspan="6">
            <br /><br />
            Facility Rep ________________________________________________________________________<br /><br />
             Driver _____________________________________________________________________________
            
            </td>
        </tr>
        
        <tr>
            <td>Driver</td><td>
            ';
            
    $html .= uNumToName($ikg_info->driver_no); 
    $html .='</td></tr><tr><td>IKG Transporter</td><td>Biotane Pumping</td></tr><tr><td>View Day Route</td><td><select name="mult_day_route" id="mult_day_route"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></tr></table><table style="width:100%;margin:auto;height:125px;font-size:14px;table-layout:fixed;" id="chart"><thead id="meathead"><tr><td style="padding: 0px 0px 0px 0px;width:9px;">#</td><td style="padding: 0px 0px 0px 0px;">Name</td><td  style="padding: 0px 0px 0px 0px;">Address</td><td  style="padding: 0px 0px 0px 0px;">City</td><td  style="padding: 0px 0px 0px 0px;">Zip</td><td style="padding: 0px 0px 0px 0px;width:70px;">Col</td><td  style="padding: 0px 0px 0px 0px;">Info</td><td style="padding: 0px 0px 0px 0px;width:29px;">ZG</td><td  style="padding: 0px 0px 0px 0px;">Tote-Size</td><td  style="padding: 0px 0px 0px 0px;">Account Notes</td></tr></thead><tbody id="meat">';
    
    //var_dump($ikg_info->account_numbers); 
    //var_dump($ikg_info->scheduled_routes);
       
    $aaccoouunntt = new Account();
    $count =1;
        $array = array_unique($ikg_info->scheduled_routes);
         foreach ($array as $ekc ){  
            $inches = "";
            $sched_ro = new Scheduled_Routes($ekc);
            $total_pickedup_for_this_route =total_gallons_for_route($_GET['ikg'],$ekc,$sched_ro->account_number);
            $html .= "<tr><td style='height:50px;border:1px solid black;padding: 0px 0px 0px 0px;'>$count</td>";
                $html .= "<td style='border:1px solid black;padding: 0px 0px 0px 0px;'>".trim($sched_ro->account_name)."</td>";
                $html .= "<td style='border:1px solid black;padding: 0px 0px 0px 0px;'>".trim($aaccoouunntt->singleField($sched_ro->account_number,"address"))."</td>";
                $html .= "<td style='border:1px solid black;padding: 0px 0px 0px 0px;'>".trim($aaccoouunntt->singleField($sched_ro->account_number,"city"))."</td>";  
                $html .= "<td style='border:1px solid black;padding: 0px 0px 0px 0px;'>".trim($aaccoouunntt->singleField($sched_ro->account_number,"zip"))."</td>";
                $html .= "<td  style='border:1px solid black;padding: 0px 0px 0px 0px;'>$total_pickedup_for_this_route</td>";
                $html .= "<td style='border:1px solid black;padding: 0px 0px 0px 0px;'>$sched_ro->notes<br/>$sched_ro->special_instructions</td></td>";
                $html .= "<td style='border:1px solid black;padding: 0px 0px 0px 0px;'>".ZG_decode($sched_ro->zero_gallon_reason)."</td>";
                $html .="<td style='border:1px solid black;padding: 0px 0px 0px 0px;'>"; 
                $containers = $db->query("SELECT COUNT( container_no ) AS bar_num, container_no FROM iwp_containers
WHERE account_no =$sched_ro->account_number GROUP BY container_no");
                if(count($containers)>0){
                    foreach($containers as $conts){
                        $html .= "$conts[bar_num] ) ".containerNumToName($conts['container_no'])."<br/>";
                    }
                }
                $html .="</td>";
                $html .="<td style='border:1px solid black;padding:0px 0px 0px 0px;'>".trim($aaccoouunntt->singleField($sched_ro->account_number,"notes"))."</td></tr>";
            $count++;
        }
    $html .='</tbody></table></div>';
    //echo $html;    
    
    $fnak = date('Y-m-d_H-i-s');


$new_string = str_replace(" ","_",$ikg_info->ikg_manifest_route_number);
$new_string = str_replace("'","",$new_string);
$pdf_options = array(
  "source_type" => 'html',
  "source" => trim($html),
  "action" => 'save',
  "save_directory" => '',
  "page_orientation" => 'landscape',
  "file_name" => $new_string.'.pdf',
  "page_size" => 'legal',
  "encoding" => 'ISO-8859-1'
);

phptopdf($pdf_options);


$track = array(
    "date"=>date("Y-m-d H:i:s"),
    "user"=>$person->user_id,
    "actionType"=>"Manifest Printed",
    "descript"=>"Manifest Printed for route ".$_GET['ikg'],
    "pertains"=>6
);
$db->insert("xlogs.".$dbprefix."_activity",$track);    



/**/$path = $new_string.".pdf";
$filename = $new_string.".pdf";
header("Content-disposition: attachment; filename=".$filename);
header("Content-type: application/pdf");
readfile($filename);

    
?>
    
    
   
