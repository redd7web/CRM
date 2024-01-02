<?php
include "protected/global.php";
require_once 'dompdf/autoload.inc.php';
ini_set("display_errors",0);
ini_set("memory_limit",-1);
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$route = $db->where("route_id",$_GET['route_no'])->get($dbprefix."_ikg_manifest_info");
$accounts_container = $dbprefix."_containers";
$containerslist = $dbprefix."_list_of_containers";
//ini_set('display_errors',1); 
 //error_reporting(E_ALL);
$ikg_info = new IKG($_GET['route_no']);
  
$ikg = $ikg_info->ikg_manifest_route_number;
$driver = $ikg_info->driver_no; 
$facil = numberToFacility($ikg_info->recieving_facility);



$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>IKG MANIFEST RECIEPT</title>
<style type="text/css">

@page { margin: .1cm .1cm .1cm .1cm; }

input[type="text"]{
    border:0px solid #bbb;
    
}
body {
  font-family:Tahoma;
}

img {
  border:0;
}


#logo {
  float:left;
  margin:0;
}


td{
   
    padding-left:10px;
}
</style>
</head><body>';


if( count($ikg_info->scheduled_routes)>0){
    $acc = new Account();
    $buffer = array_unique($ikg_info->scheduled_routes);
    foreach($buffer as $sched_num){
        $schedules = new Scheduled_Routes($sched_num);
        $rep = $acc->singleField($schedules->account_number,"contact_name");
        $address = $acc->singleField($schedules->account_number,"address");
        $exploded = explode(" ",$schedules->scheduled_start_date);
        $city = $acc->singleField($schedules->account_number,"city");
        $state = $acc->singleField($schedules->account_number,"state");
        
        $get = $db->query("SELECT DISTINCT (container_no), count( * ) AS num_of_barrel, account_no FROM iwp_containers WHERE account_no =$schedules->account_number GROUP BY account_no");
            if(count($get)>0){
                $ty = $db->query("SELECT SUM(inches_to_gallons) as s FROM iwp_data_table WHERE account_no=$schedules->account_number AND route_id= $ikg_info->route_id AND schedule_id= $schedules->schedule_id");
                if(count($ty)>0){
                    if( $ty[0]['s'] == 0){
                        $sum = 0;
                     } else {
                        $sum = $ty[0]['s'];
                     }
                }else{
                    $sum = 0;
                }
                 
                $num_of_barrel = $get[0]['num_of_barrel'].")";
                $container_line = containerNumToName($get[0]['container_no'])." GPI ".round(gpi($get[0]['container_no']),2);
            }else{
                $num_of_barrel = 0;
                $sum = 0;
            }
        
        $html .='
            <table style="width:95%;margin-left:3%;border:1px solid black;font-size:16px;">
                <tr>
                    <td style="text-align:right;">Call today for grease trap service 877.424.6826</td>
                    <td><img src="https://inet.iwpusa.com/img/blogo.jpg"/></td>
                    <td style="text-align:right;">Call today for grease trap service 877.424.6826</td>
                    <td><img src="https://inet.iwpusa.com/img/blogo.jpg"/></td>
                </tr>
            </table>
            <table style="width:95%;height:85%;margin-left:3%;border:1px solid black;font-size:16px;">
                <tr>
                    <td style="text-align:right;">Date</div></td>
                    <td>'.$ikg_info->scheduled_date.' </td>
                    <td style="text-align:right;">Date</div></td>
                    <td>'.$ikg_info->scheduled_date.' </td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Manifest</td>
                    <td>'.$ikg_info->route_id.'</td>
                    <td style="text-align:right;">Manifest</td>
                    <td>'.$ikg_info->route_id.'</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Driver\'s Name</td>
                    <td>'.uNumToName($driver).'</td>
                    <td style="text-align:right;">Driver\'s Name</td>
                    <td>'.uNumToName($driver).'</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Driver\'s Signature</td>
                    <td>_____________________________</td>
                    <td style="text-align:right;">Driver\'s Signature</td>
                    <td>_____________________________</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Recieving Facility</td>
                    <td>'. $facil .' : '.$facils[$route[0]['recieving_facility']].'</td>
                    <td style="text-align:right;">Recieving Facility</td>
                    <td>'. $facil .' : '.$facils[$route[0]['recieving_facility']].'</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Restaurant Name</td>
                    <td>'.account_NumToName($schedules->account_number).'</td>
                    <td style="text-align:right;">Restaurant Name</td>
                    <td>'.account_NumToName($schedules->account_number).'</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Restaurant Rep</td>
                    <td>'.$rep.'</td>
                    <td style="text-align:right;">Restaurant Rep</td>
                    <td>'.$rep.'</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Restaurant Rep Signature</td>
                    <td>_____________________________</td>
                    <td style="text-align:right;">Restaurant Rep Signature</td>
                    <td>_____________________________</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">Time</td>
                    <td><input type="checkbox"/> Generator not available for Signature</td>
                    <td style="text-align:right;">Time</td>
                    <td><input type="checkbox"/> Generator not available for Signature</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td colspan="2" style="text-align:center;">Address: '.$address.' '. $city.', '.$state.'</td>
                    <td colspan="2" style="text-align:center;">Address: '.$address.' '. $city.', '.$state.'</td>
                </tr>
                <tr><td colspan="4" style="height:5px;">&nbsp;</td></tr>
                <tr>
                    <td style="text-align:right;">'.$num_of_barrel.'</td>
                    <td>'.$container_line.'</td>
                    <td style="text-align:right;">'.$num_of_barrel.'</td>
                    <td>'.$container_line.'</td>
                </tr>
            </table>';        
            
          
          $route_copy .=$html;
    }  
}
$html .= '</body></html>';
/*
echo $html;
*/

$new_string = "IKG_RECIEIPT-$ikg_info->ikg_manifest_route_number".date("Ymd_his");
$new_string = str_replace(" ","-",$new_string);
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->set_option('isHtml5ParserEnabled', TRUE);
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream("$new_string");

?>
