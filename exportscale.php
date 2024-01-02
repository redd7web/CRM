<?php
include "protected/global.php";

ini_set("display_errors",0);
/**   FILE HEADERS   **/
function sn($tk,$wix){
    global $db;
    $wi = explode(" ",$wix);
    $s = $db->query("SELECT element_16 FROM Inetforms.ap_form_64000 WHERE element_2 = $tk AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
    
    if(count($s)>0){
        return $s[0]['element_16'];
    }else{
        return "";
    }
    
}

function truckDecode($truck,$mode){
    global $db;
    
    switch($mode){
        case "name":
        $field = "Name";
        break;
        
        case "truckid":
        $field = "TruckID";
        break;
        case "id1":
        $field = "TrailerID1";
        break;
        case "id2":
        $field = "TrailerID2";
        break;
    }
    $tr = $db->query("SELECT $field FROM iwp_scale_truck WHERE TruckKey = $truck");
    if(count($tr)>0){
        return $tr[0]["$field"];
    }else{
        return "N/A";
    }
}

function productKey($productKey){
    global $db;
    $trans = $db->query("SELECT Name FROM iwo_products WHERE ProductKey = $productKey");
    
    if(count($trans)>0){
        return $trans[0]['Name'];
    }else{
        return "N/A";
    }
}



function CustomerKey($customerKey){
    $customer = "N/A";
    global $db;
    $cust = $db->where("CustomerKey",$customerKey)->get("iwp_customers","Name");
    if(count($cust)>0){
        $customer = $cust[0]['Name'];
    }
    return $customer;
}


function Vendors($vKey){
    $customer = "N/A";
    global $db;
    $cust = $db->where("VendorKey",$vKey)->get("iwp_vendors","Name");
    if(count($cust)>0){
        $customer = $cust[0]['Name'];
    }
    return $customer;
}

function c_miles($customer){
    global $db;
    $j = $db->query("SELECT miles FROM iwp_customers WHERE CustomerKey  = $customer");
    if(count($j)>0){
        return $j[0]['miles'];
    }else{
        return 0;
    }
}

function v_miles($vendor){
    global $db;
    $j = $db->query("SELECT miles FROM iwp_vendors WHERE VendorKey  = $vendor");
    if(count($j)>0){
        return $j[0]['miles'];
    }else{
        return 0;
    }
}


function haulerDecode($truck){
    global $db;
    if($truck !=NULL){
        $tr = $db->query("SELECT HaulerKey FROM iwp_scale_truck WHERE TruckKey = $truck");
        if(count($tr)>0){
            $hk = $db->query("SELECT Name FROM iwp_truck_haulers WHERE HaulerKey =".$tr[0]['HaulerKey']);
            if(count($hk)>0){
                return $hk[0]['Name'];
            }else{
                return "N/A";
            }

        }else{
            return "N/A";
        }
    }else{
        return "N/A";
    }

}


if(isset($_POST['export_scale'])){
    
    $kl = $db->query("$_POST[query_string]");
    
   
    
    if(count($kl)>0){
        switch($_POST['export_format']){
            case "xls":
                 $file = "scale_export".date("YmdHm").".xls";
                include "protected/xlsfunctions.php";
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");           
                header("Content-Disposition: attachment;filename=$file$xls");
                header("Content-Transfer-Encoding: binary ");
                $xlsRow = 0;
                $xlsCol = 0;
                xlsBOF();
                xlsWriteLabel($xlsRow,0,"Weight Cert No.");
                xlsWriteLabel($xlsRow,2,"Driver");
                xlsWriteLabel($xlsRow,4,"TruckID / License"); 
                xlsWriteLabel($xlsRow,6,"Buyer/Seller");
                xlsWriteLabel($xlsRow,8,"Release No");
                xlsWriteLabel($xlsRow,10,"Notes");
                xlsWriteLabel($xlsRow,12,"Product");
                xlsWriteLabel($xlsRow,14,"Weigh In");
                xlsWriteLabel($xlsRow,16,"Weigh Out");
                xlsWriteLabel($xlsRow,18,"Gross"); 
                xlsWriteLabel($xlsRow,20,"Tare");
                xlsWriteLabel($xlsRow,22,"Net");
                xlsWriteLabel($xlsRow,24,"Units");
                xlsWriteLabel($xlsRow,26,"User Name");
                xlsWriteLabel($xlsRow,28,"Trailer ID 1");
                xlsWriteLabel($xlsRow,30,"Trailer ID 2");
                xlsWriteLabel($xlsRow,30,"Shipmode");
                foreach($kl as $k){
                    $count++;
                    $xlsRow++;
                    xlsWriteLabel($xlsRow,0,$k['tk']);
                    xlsWriteLabel($xlsRow,2, truckDecode($k['TruckKey'],"name")  );
                    xlsWriteLabel($xlsRow,4, truckDecode($k['TruckKey'],"truckid") );
                    xlsWriteLabel($xlsRow,6, CustomerKey($k['CustomerKey']) );
                    xlsWriteLabel($xlsRow,8,$k['UF1Data']);
                    xlsWriteLabel($xlsRow,10,$k['UF3Data']);
                    xlsWriteLabel($xlsRow,12, productKey($k['ProductKey']) );
                    xlsWriteLabel($xlsRow,14,$k['WeighIn']);
                    if(strlen(trim($k['WeighOut']))<=0){
                        xlsWriteLabel($xlsRow,16,"N/A");
                    }else{
                        xlsWriteLabel($xlsRow,16,"$k[WeighOut]");
                    }
                    xlsWriteLabel($xlsRow,18,$k['Gross']);
                    xlsWriteLabel($xlsRow,20,$k['Tare']);
                    xlsWriteLabel($xlsRow,22,$k['Net']);
                    xlsWriteLabel($xlsRow,24,$k['Units']);
                    xlsWriteLabel($xlsRow,26,$k['UserName']);
                    xlsWriteLabel($xlsRow,28, truckDecode($k['TruckKey'],"id1") );
                    xlsWriteLabel($xlsRow,30, truckDecode($k['TruckKey'],"id2") );
                    xlsWriteLabel($xlsRow,30, $k['ShipMode'] );
                    
                }
                xlsEOF();
            break;
            case "csv":
                $file = "scale_export".date("YmdHm").".csv";
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Description: File Transfer");
                header("Content-type: text/csv");
                header("Content-Disposition: attachment; filename={$file}");
                header("Expires: 0");
                header("Content-Transfer-Encoding: binary");
                header("Pragma: public");

                $dataString = "Weight Cert, Scale Approved, Entered Into Newbos, Origin Weight Cert, Division, Backhaul, Miles, Extra Miles, Total Miles, Additional Notes, Lot Number 1, Lot Number 2, Seal #, Hauler, Void, Driver, TrickID/License, Buyer/Seller, Release No, Notes, Product, Weigh in, Weigh Out, Gross, Tare, Net, User Name, Trailer ID 1, Trailer ID 2, Units,Ship Mode \n";


                foreach($kl as $k){
                    $dataString .="$k[tk],$k[scale_approved],$k[new_bos_number],$k[origin_weight_cert],$k[division],$k[backhaul],";


                    if($k['VendorKey'] != 0){
                        $ven_custom = Vendors($k['VendorKey']);
                        $j = v_miles($k['VendorKey']);
                    }else if( $k['CustomerKey'] != 0   ){
                        $ven_custom = CustomerKey($k['CustomerKey']);
                        $j = c_miles($k['CustomerKey']);
                    }else{
                        $j = "N/A";
                        $j = 0;
                    }

                    $dataString .= $j . ",$k[extra_miles], $k[total_miles],$k[additional_notes],$k[lot_number],$k[lot_number2],$k[seal_number],";

                    $dataString .= haulerDecode($k['TruckKey']) . ",";

                    $dataString .= "$k[Void],";

                    $dataString .= truckDecode($k['TruckKey'],"name").",".truckDecode($k['TruckKey'],"truckid").",$ven_custom,$k[UF1Data],$k[UF3Data]," .productKey($k['ProductKey']) . ",$k[WeighIn],";


                    //This might go some where
                    //.CustomerKey($k['CustomerKey']).

                    if(strlen(trim($k['WeighOut']))<=0){
                                $dataString .= "N/A,";
                            }else{
                                $dataString .= "$k[WeighOut],";
                            }


                    $dataString .= "$k[Gross],$k[Tare],$k[Net],$k[UserName],".truckDecode($k['TruckKey'],"id1").",".truckDecode($k['TruckKey'],"id2").",$k[units],$k[ShipMode]\n";
                }
                $fh = @fopen( "php://output", 'w' );
                fwrite($fh, $dataString);
                fclose($fh);
            break;


            case "pdf":
                 include "plugins/phpToPDF/phpToPDF.php";
                 $file = "scale_export".date("YmdHm").".pdf";
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
                        
                        
                        body{
                            font-size:12px;
                            padding:10px 10px 10px 10px;
                            margin:10px 10px 10px 10px;
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
                        
                        #myTable th{
                            padding:5px 5px 5px 5px;
                        }
                        #myTable td {
                             padding:5px 5px 5px 5px;  
                        }
                        
                        td,th{
                            background:transparent;
                            text-align:center;
                            width:1%;
                            font-size:12px;
                            vertical-align:middle;
                            display:table-cell;
                            padding:0px 2px; /* just some padding, if needed*/
                            white-space: pre; /* this will avoid line breaks*/
                            border:1px solid black;
                            
                        }
                        
                        tr.even{
                            background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
                            display:table-row
                        }
                        
                        tr.odd{
                            background:transparent;
                            display:table-row
                        }
                        .setThisRoute{ 
                            z-index:9999;
                        }
                        
                        
                        
                        input[type=checkbox]{
                            width:10px;
                        }
                        </style>
                        </head>
                        <body>
                       <body><table class="myTable"> 
                        <thead>
                            <tr>
                                <th>Weight Cert No.</th>
                                <th>Driver</th>
                                <th>TruckID / License</th>
                                <th>Buyer/Seller</th>                
                                <th>Release No</th>
                                <th>Product</th>
                                <th>Weigh In</th>
                                <th>Weigh Out</th>
                                <th>Gross</th>
                                <th>Tare</th>
                                <th>Net</th>
                                <th>User Name</th>
                                <th style="text-align: center;">Trailer ID 1</th>
                                <th style="text-align: center;">Trailer ID 2</th>
                            </tr>
                        </thead> <tbody>';
                 foreach($kl as $k){
                        $html .= "<tr>";
                        $html .= "<td><img src='https://d30y9cdsu7xlg0.cloudfront.net/png/3927-200.png' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/>&nbsp;$k[tk]</td>";
                        $html .= "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                        $html .= "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                        
                        $html .= "<td>".CustomerKey($k['CustomerKey'])."</td>";
                        $html .= "<td>$k[UF1Data]</td>";
                        $html .="<td>$k[UF3Data]</td>";
                        $html .= "<td>".productKey($k['ProductKey'])."</td>";
                        $html .= "<td>$k[WeighIn]</td>";
                        $html .= "<td>"; 
                            if(strlen(trim($k['WeighOut']))<=0){
                                $html .= "N/A";
                            }else{
                                $html .= "$k[WeighOut]";
                            }
                        $html .= "</td>";
                        $html .= "<td>$k[Gross]</td>";
                        $html .= "<td>$k[Tare]</td>";
                        $html .= "<td>$k[Net]</td>";
                        $html .= "<td>$k[UserName]</td>";
                        $html .= "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                        $html .= "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                        $html .= "</tr>";
                 }
                 $html .='</tbody></table></body></html>';
                $pdf_options = array(
                  "source_type" => 'html',
                  "source" => $html,
                  "action" => 'save',
                  "save_directory" => '',
                  "page_orientation" => 'landscape',
                  "file_name" => $file,
                  "page_size" => 'legal'
                );
                phptopdf($pdf_options);
                header("Content-disposition: attachment; filename=".$file);
                header("Content-type: application/pdf");
                readfile($file);
            break;
        }
    }
    
}



?>