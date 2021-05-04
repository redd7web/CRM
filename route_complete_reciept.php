<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
ini_set('display_errors',1);

$person = new Person();
$data_table = $dbprefix."_data_table";
//echo $_GET['route_id']."<br/>";
$date = date("Y-m-d");
$reciept="";

//Info from here from grabbing the old reciept info

$route = $db->where("route_id",$_GET['route_id'])->get($dbprefix."_ikg_manifest_info");
$accounts_container = $dbprefix."_containers";
$containerslist = $dbprefix."_list_of_containers";

//$ikg_info = new IKG($_GET['route_id']);

//$ikg = $ikg_info->ikg_manifest_route_number;
//$driver = $ikg_info->driver_no;
//$facil =  numberToFacility($ikg_info->recieving_facility);


// and end of it here



$data_table_request = $db->query("SELECT iwp_data_table.route_id,
                                       iwp_data_table.account_no,
                                       iwp_data_table.inches_to_gallons,
                                        iwp_data_table.schedule_id,
                                        DATE(iwp_data_table.date_of_pickup) as date,
                                        iwp_accounts.account_ID,
                                        iwp_accounts.reciept_email,
                                        iwp_accounts.contact_name,       
                                        iwp_accounts.address,
                                        iwp_accounts.city,
                                        iwp_accounts.state,
                                        iwp_accounts.friendly,
                                        iwp_ikg_manifest_info.scheduled_date,
                                        iwp_ikg_manifest_info.driver,
                                        iwp_ikg_manifest_info.recieving_facility
                                    FROM `iwp_data_table` LEFT JOIN iwp_accounts ON iwp_data_table.account_no = iwp_accounts.account_ID
                                    LEFT JOIN iwp_ikg_manifest_info ON iwp_ikg_manifest_info.route_id = iwp_data_table.route_id
                                    WHERE iwp_data_table.route_id =$_GET[route_id] AND reciept_email IS NOT NULL GROUP BY schedule_id");

if(count($data_table_request) > 0 ){
    foreach($data_table_request as $request){
        $html = "";
//
//        echo "<br>Accounts found to make reciepts: ";
//        echo $request['account_ID'];


        if($request['friendly'] == "RE COMM"){
            $logo = "<b>R.E. COMM</b>";
        } else {
            $logo = '<img src="https://inet.iwpusa.com/img/blogo.jpg"/>';
        }


        $html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>IKG MANIFEST RECIEPT</title>
<style type="text/css">

@page{
    size: 8.5in 11in;
    margin: 0.5in;
} 
html,body{
    height:100%;
margin:0px 0px 0px 0px;
}

input[type="text"]{
    border:0px solid #bbb;
    
}

table td{
 border:1px solid black;
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


</style>
</head><body>';

        $html .='<table style="width:45%;height:100%;float:left;margin-left:3%;" class="myTable">
              <tr>
                <td style="vertical-align:center;text-align:center;border:1px solid black;">
                <p>Call today for grease trap service<br/>877.424.6826</p>
                </td>
                <td style="vertical-align:center;text-align:right;border:1px solid black;">'. $logo .'<p><span style="font-size:8px">A Company of Imperial Western Products, Inc</span></p></td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Date</td><td style="vertical-align:top;text-align:left;border:1px solid black;">'.$request['scheduled_date'].' </td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Manifest</td><td style="border:1px solid black;">'.$request['route_id'].'</td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Driver\'s Name</td><td style="border:1px solid black;">'.uNumToName_plain($request['driver']).'</td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Driver\'s Signature</td><td style="border:1px solid black;"></td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Recieving Facility</td style="border:1px solid black;"><td style="border:1px solid black;">'. numberToFacility($request['recieving_facility']) .'<br/>';

        $html .= $facils[$request['recieving_facility']];
        $html .='</td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">IKG Type</td><td style="border:1px solid black;">Used Cooking Oil</td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Restaurant Name</td><td style="border:1px solid black;">'. account_NumtoName_plain($request['account_ID']). '</td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Restaurant Rep</td><td style="border:1px solid black;">'.$request['contact_name'].'</td></tr>
              <tr><td style="vertical-align:top;text-align:left;border:1px solid black;">Restaurant Rep Signature</td><td style="border:1px solid black;"></td></tr>
              <tr><td>Service Date: '. $request['date']. '</td><td style="text-align:right;vertical-align:bottom;border:1px solid black;"><input type="checkbox"/> Generator not available for Signature</td></tr>
              <tr><td colspan="2"  style="vertical-align:top;text-align:left;border:1px solid black;">Address: '.$request['address'].' '. $request['city'].', '.$request['state'].'</td></tr>
              <tr><td colspan="2"  style="vertical-align:top;text-align:left;height:100px;border:1px solid black;">Comments: </td></tr>
              <tr><td colspan="2" style="text-align:center;border:1px solid black;">';

        $get = $db->query("SELECT DISTINCT (container_no), count( * ) AS num_of_barrel, account_no FROM iwp_containers WHERE account_no =$request[account_ID] GROUP BY account_no");
        if(count($get)>0){
            $html .= "<table style='width:100%;'>";
            foreach($get as $container){
                $html .= "<tr><td>$container[num_of_barrel])</td><td>".containerNumToName($container['container_no'])." GPI ".round(gpi($container['container_no']),2)."</td></tr>";
            }
            $html .="<tr><td>Collected</td><td>";
            $ty = $db->query("SELECT SUM(inches_to_gallons) as s FROM iwp_data_table WHERE account_no=$request[account_ID] AND route_id= $request[route_id] AND schedule_id= $request[schedule_id]");

            if( $ty[0]['s'] == 0){
                $sum = "";
            } else {
                $sum = $ty[0]['s'];
            }


            $html .= $sum;
            $html .="</td>";
            $html .= "</table>";
        }
        else {
            $html .= "&nbsp;";
        }
        $html .= '</td></tr></table>';
        echo $html;


        //Create PDF for each completed service
        $new_string = "IKG_RECIEIPT-" . $request['route_id'] . "-" . $request['account_ID'] . "-".date("Ymd_his");
        $new_string = str_replace(" ","-",$new_string);
        $pdf_options = array(
            "source_type" => 'html',
            "source" => $html,
            "action" => 'save',
            "save_directory" => 'completed_route_reciepts',
            "page_orientation" => 'landscape',
            "file_name" => $new_string.'.pdf',
            "page_size" => 'letter'
        );
        phptopdf($pdf_options);

        $path = $new_string.".pdf";
        $filename = $new_string.".pdf";

        $nmessage="";
        $message = "";

        $path = "completed_route_reciepts/";
        // header
        $file = $path.$filename;
        //echo $file."<br/>";
        $content = file_get_contents( $file);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));
        $name = basename($file);
        $message = "Please see attached service receipt.\r\nThank you for your business!  ";
        // header
        $header = "From: No-reply@iwpusa.com\r\n";
        $header .= "Reply-To: No-reply@iwpusa.com\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";



        // message & attachment
        $nmessage = "Please see attached service receipt.\r\nThank you for your business!\r\n--".$uid."\r\n";
        $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $nmessage .= $message."\r\n\r\n";
        $nmessage .= "--".$uid."\r\n";
        $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
        $nmessage .= "Content-Transfer-Encoding: base64\r\n";
        $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
        $nmessage .= $content."\r\n\r\n";
        $nmessage .= "--".$uid."--";

        if(strlen($request['reciept_email']) > 0){
            mail($request['reciept_email'],"Completed Oil Service Receipt $request[date]","$nmessage",$header);
        }






    }
    
}