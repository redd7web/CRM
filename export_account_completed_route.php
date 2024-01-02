<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
ini_set("display_errors",1);
$arrField = array();
$string ="";
$ks ="";
if(isset($_POST['export_now'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "from":
                if(strlen(trim($value))>0){
                    $arrField[]=" iwp_data_table.date_of_pickup >='$value' ";
                    $ks =" from $value ";
                }
            break;
            case "to":
                if(strlen(trim($value))>0){
                    $arrField[]=" iwp_data_table.date_of_pickup <='$value' ";
                    $ks .=" to $value ";
                }
            break;
        }
    }
    
    if(!empty($arrField)){
        $string = " AND ".implode(" AND ",$arrField);
        //echo $string."<br/>";
    }
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
          border:0px solid #bbb;
        }
        
        td {
        padding:5px;
        border: 0px solid #bbb;
        }
        
        tr.odd {
          background:#e1ffe1;
        }
        -->
        </style>
        </head>
        <body>
        ';
    
  
    
    
    $data_table = $dbprefix."_data_table";
    //echo "SELECT * FROM $data_table WHERE account_no=$_POST[account_no] $string<br/>";
    $askthree = $db->query("SELECT   (iwp_data_table.sum - (iwp_data_table.sum * iwp_accounts.miu) ) as adj,iwp_data_table.sum,iwp_data_table.date_of_pickup,iwp_accounts.miu,iwp_accounts.address,iwp_accounts.city,iwp_accounts.state,iwp_accounts.Name,iwp_ikg_manifest_info.ikg_manifest_route_number,iwp_data_table.route_id FROM `iwp_data_table` LEFT JOIN iwp_accounts ON iwp_accounts.account_ID = iwp_data_table.account_no LEFT JOIN iwp_ikg_manifest_info ON iwp_data_table.route_id = iwp_ikg_manifest_info.route_id  WHERE account_no=$_POST[account_no] $string GROUP BY schedule_id ORDER BY date_of_pickup DESC");
    
    
    
    
    $html .= "<table>
        <tr><td colspan='5' style='text-align:center;font-weight:bold;'>Biotane Pumping <br/>".date("F d, Y") ."</td></tr>
        <tr><td colspan='3'>".$askthree[0]['Name']."<br/>".$askthree[0]['address']."<br/>".$askthree[0]['city'].", ".$askthree[0]['state']."</td></tr>
        <tr><td colspan='4'>Dear Valued Customer:,<br/>This report shows used oil collections from your location(s) for the dates shown. Thank you for your business.  <br/></td></tr>
        
    
    <tr><td colspan='5' style='text-align:center;'>Used/Waste Cooking Oil Collections $ks in Gallons</td></tr>
    <tr><td>#</td><td>Date</td><td>Est Oil Recycled</td><td>ID / Address City State</td><td>Route id</td><td>Route Title</td></tr>
    ";        
    if(count($askthree)>0){
        $alter=0;
        $tot_adj= 0;
        foreach($askthree as $gvo){
            
			
			
            $tot_adj = $tot_adj + $gvo['adj'];            
            $alter++;
            if($alter%2 == 0){
                $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
            }
            else { 
                $bg = 'transparent';
            }
            $html .= "
                <tr style='background:$bg'>
                    <td>$alter</td>
                    <td>$gvo[date_of_pickup]</td>
                    <td style='text-align:right;'>".round($gvo['adj'])."</td>
                    <td>".$gvo['address']." ".$gvo['city']." ".$gvo['state']."</td>
                    <td>$gvo[route_id]</td>
                    <td>$gvo[ikg_manifest_route_number]</td>                    
                </tr>";
        }
        $html .= "<tr><td>&nbsp;</td><td>Total: </td><td style='text-align:right;'>".round($tot_adj)."</td></tr>
        <tr><td colspan='4' style='text-align:center;'>Excludes water and contaminants " . $gvo['miu'] * 100 . "% shrinkage. Volumes shown cannot be used to derive payments to or by client</td></tr>
        ";
    }    
    
    $html .="</table></body></html>";

    $fnak = date('Y-m-d');
    $name_without_spaces = str_replace(' ','-',$askthree[0]['Name']);
    $_POST['account_no'];
    //$name_without_amp = str_replace("&","and",$name_without_spaces);
    $filename = $fnak.'-'.$_POST['account_no'].'_routes.pdf';
    
    phptopdf_html($html,'', $filename);
   
    header("Content-disposition: attachment; filename=".$filename);
    header("Content-type: application/pdf");
    readfile("$filename");/**/      
 
}



?>