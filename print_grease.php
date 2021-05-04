<?php

include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
 

$account_table = $dbprefix."_accounts";
$ikg_grease_table = $dbprefix."_ikg_grease";
$grease_list = $dbprefix."_list_of_grease";

$grease_ikg = new Grease_IKG($_GET['route_no']);


$html ='
<style type="text/css">
body{
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    height:990px;
    font-family:Tahoma;
    
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

table#meatikg td{
    border: 0px solid #ccc;
    border-collapse: separate;
    padding:0px 0px 0px 0px;
    font-size:14px;
}


</style>
';
$html .="
<div class='content-wrapper' style='min-height:450px;height: auto;'>
    
    <div id='fields' style='width: 100%;min-height:300px;height:auto;'>
    <table style='width: 100%;font-size:10px;' id='meatikg'>
    <tr><td colspan='5' style='text-align:center;font-weight:bold;font-size:16px;'>$grease_ikg->ikg_manifest_route_number</td>
    <td colspan='5' style='text-align:right;'>"; 
    if($grease_ikg->recieving_facility_no ==15 || $grease_ikg->recieving_facility_no ==24 ||$grease_ikg->recieving_facility_no ==30 || $grease_ikg->recieving_facility_no ==31 || $grease_ikg->recieving_facility_no ==32 || $grease_ikg->recieving_facility_no ==33 ){
        $html .="<img src='https://inet.iwpusa.com/img/cw3.jpeg'/>";
    }else{
        $html .="<img src='https://inet.iwpusa.com/img/biologo.jpg'/>";
    }
    
    $html .="</td></tr>
        <tr>
            <td>IKG Title</td>
            <td>$grease_ikg->ikg_manifest_route_number</td>
            <td>Tank 1<br />Tank 2</td>
            <td>$grease_ikg->tank1<br />$grease_ikg->tank2</td>
            <td>Time Start</td>
            <td>$grease_ikg->time_start</td>
            <td>Start Mileage</td>
            <td>$grease_ikg->start_mileage</td>
        </tr>
        
        <tr>
            <td>Scheduled Date</td>
            <td>$grease_ikg->scheduled_date</td>
            <td>Truck</td>
            <td>
            ";
            $truck = new Vehicle($grease_ikg->vehicle);
            $html .= $truck->name;
            
            $html .="</td>
            <td>First Stop</td>
            <td>$grease_ikg->first_stop</td>
            <td>First Stop Mileage</td>
            <td>$grease_ikg->first_stop_mileage</td>
        </tr>
        
        <tr>
            <td>Completion Date</td>
            <td>$grease_ikg->completed_date</td>
            <td>License Plate</td>
            <td>$truck->lp_no</td>
            <td>Last Stop</td>
            <td>$grease_ikg->last_stop</td>
            <td>Last Stop Mileage</td>
            <td>$grease_ikg->last_stop_mileage</td>
        </tr>
        
        <tr>
            <td>IKG Route Number</td>
            <td>$grease_ikg->route_id</td>
            <td>IKG Decal</td>
            <td>$truck->ikg_decal</td>
            <td>End Time</td>
            <td>$grease_ikg->end_time</td>
             <td>End Mileage</td> 
             <td>$grease_ikg->end_mileage</td>
        </tr>
        ";
        
        $route_history = $db->query("SELECT * FROM iwp_rout_history_grease WHERE route_no = $grease_ikg->route_id  AND what_day >1");        
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
        
        $html .="<tr>
            <td>Location</td><td>$grease_ikg->location</td>
            <td>IKG Collected</td><td>Grease Trap</td>
            <td>Total Elapsed Time</td><td>"; 
            $checkTime = strtotime($grease_ikg->end_time);
                $loginTime = strtotime($grease_ikg->time_start);
                $diff = $checkTime - $loginTime;
                $html .= abs(round($diff/3600,2))." Hours";
            $html .="</td>
            <td>Total Mileage</td><td>".number_format($grease_ikg->end_mileage - $grease_ikg->start_mileage,2)."</td>
        </tr>
        
        
        <tr>
            <td>INVENTORY CODE</td><td>$grease_ikg->inventory_code</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>Fuel</td><td>$grease_ikg->fuel</td>
            <td>Total Lbs/Mile</td><td>$grease_ikg->lbs_per_mile</td>
        </tr>
        
        
        <tr>
            <td>Lot #</td>            
            <td>$grease_ikg->lot_no</td>
            <td>Gross Weight</td><td>$grease_ikg->ikg_gross_weight'</td>
            
        </tr>
        
        
        <tr>
            <td>Receiving Facility</td><td>".numberToFacility($grease_ikg->recieving_facility_no)."</td>
        <td>Tare Weight</td>
        <td>$grease_ikg->tare_weight</td></tr><tr>
            <td>Facility Address</td>
            <td> ".$facils[$grease_ikg->recieving_facility_no]." </td>
            <td>Net Weight</td>
            <td>$grease_ikg->net_weight</td></tr>
      
        <tr>
            <td>Facility Rep</td>
            <td></td>
            <td rowspan='4' colspan='6'>
            <br /><br />
            Print Facility Rep ________________________________________________________________________<br /><br />
             Driver _____________________________________________________________________________
            
            </td>
        </tr>
        
        <tr>
            <td>Driver</td><td>".uNumToName($grease_ikg->driver_no)."</td>
        </tr>
        <tr>
            <td>IKG Transporter</td><td>$grease_ikg->ikg_transporter</td>
        </tr>
    </table>
    <div id='data_display' style='width:100%;margin:auto;height:auto;min-height:400px;'>
    <table style='width: 100%;padding:0px 0px 0px 0px;height:auto;'>
    <tr>
    <td style='text-align:center;cursor:pointer;' id='test'>Pickups:</td>
    
    <td style='text-align:center;' id='nop'>".count($grease_ikg->scheduled_routes)."</td>
    <td style='text-align:center;' colspan='1'>&nbsp;</td>
    
    <td style='text-align:center;' colspan='3' id='estimated'>
    
    </td>
    <td>
     &nbsp;
    </td>
    <td style='text-align: center;' id='collected'>
    
    </td>
    </tr>
    </table>
    
    <table style='width:100%;margin:auto;' id='sortable'>
    <thead>
    <tr>
        <td style='padding: 0px 0px 0px 0px;width:50px;height:75px;'>
            <div class='cell'>
                Stop #
            </div>
        </td>
        <td style='padding: 0px 0px 0px 0px;width:100px;height:75px;'>
            <div class='cell' style='width:100px;'>Status</div>
        </td>
        <td style='padding: 0px 0px 0px 0px;width:100px;height:75px;'>
            <div class='cell' style='width:100px;'>Scheduled</div>
        </td>
        <td style='padding: 0px 0px 0px 0px;height:75px;'>Name</td>
        <td style='padding: 0px 0px 0px 0px;height:75px;'>City</td>
        <td  style='padding: 0px 0px 0px 0px;height:75px;'>Address</td>
        <td  style='padding: 0px 0px 0px 0px;height:75px;'>Zip</td>
        <td  style='padding: 0px 0px 0px 0px;height:75px;'>Info</td>        
        <td  style='padding: 0px 0px 0px 0px;height:75px;'>Grease Trap Size</td>
        <td  style='padding: 0px 0px 0px 0px;height:75px;'>Account Notes</td>
       <td  style='padding: 0px 0px 0px 0px;height:75px;'>Grease Picked Up</td>
    </tr>
    </thead>
    <tbody>"; ?>
    <?php
    $count = 1;  
    $total_caps = 0;
    $acnt_info = new Account();  
     
    
    
        if( count($grease_ikg->scheduled_routes) >0 ){
            foreach( $grease_ikg->scheduled_routes as $ekc  ){
                $g_stop = new Grease_Stop($ekc);
               $html .= "<tr class='accnt_row' xlr='$ekc'>";
                $html .= "<td style='border:1px solid black;height:75px;'>$count</td>";
                $html .= "<td style='border:1px solid black;height:75px;'>$g_stop->route_status</td>";
                $html .= "<td style='border:1px solid black;height:75px;'>$g_stop->service_date</td>";
                $html .= "<td style='border:1px solid black;height:75px;'>".account_NumToName($g_stop->account_number)."</td>";
                 $html .= "<td style='border:1px solid black;height:75px;'>".$acnt_info->singleField($g_stop->account_number,"city")."</td>";
                $html .= "<td style='border:1px solid black;height:75px;'>".$acnt_info->singleField($g_stop->account_number,"address")."</td>";
                
                 $html .= "<td style='border:1px solid black;height:75px;'>".$acnt_info->singleField($g_stop->account_number,"zip")."</td>";
                $html .= "<td style='border:1px solid black;height:75px;'>";   
                if(strlen($g_stop->notes)>0){
                    $html .= $g_stop->notes;
                } else {
                    $html .="&nbsp;";
                }
                
                $html .="</td>";
                $html .= "<td style='border:1px solid black;height:75px;'>".$acnt_info->singleField($g_stop->account_number,"grease_volume")."</td>";
                $html .="<td style='border:1px solid black;height:75px;'>".$acnt_info->singleField($g_stop->account_number,"notes")."</td>";
                $html .="<td style='border:1px solid black;height:75px;'>";
                $gh = $db->query("SELECT SUM(inches_to_gallons) as io FROM iwp_grease_data_table WHERE schedule_id=$g_stop->grease_no AND account_no = $g_stop->account_number AND route_id=$g_stop->grease_route_no");
                if(count($gh)>0){
                    foreach($gh as $bv){
                       $html .= $bv['io'];
                    }
                }
                $html .="</td>";
                $html .= "</tr>";
                $count++;
            }
        }   
  $html .="</tbody>
    </table>
        <div style='clear: both;'></div>
    </div>
    </div>
</div>";


//echo $html;


$new_string = "IKG_GREASE_MANIFEST-$grease_ikg->ikg_manifest_route_number".date("Ymd_his");
$new_string = str_replace(" ","-",$new_string);
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

$track = array(
    "date"=>date("Y-m-d H:i:s"),
    "user"=>$person->user_id,
    "actionType"=>"Manifest Printed",
    "descript"=>"Manifest Printed for grease route ".$_GET['route_no'],
    "pertains"=>6
);
$db->insert($dbprefix."_activity",$track);    


$path = $new_string.".pdf";
$filename = $new_string.".pdf";
header("Content-disposition: attachment; filename=".$filename);
header("Content-type: application/pdf");
readfile($filename);/**/
?>

