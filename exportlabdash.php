<?php
include "protected/global.php";
ini_set("display_errors",0);
$manage = array (1,3);
$calc_check = array(82,86,20);
$billers = array(1,2);
$product_restrict = array(4,5,7,15,20,22,25,29,30,31,34,39,41,49,50,51,54,55,63,67,69,76,80,82,84,86,87,88,89,90);
function haulerDecode($hid){
    global $db;
    if($hid !=NULL){
       $tr = $db->query("SELECT Name FROM iwp_truck_haulers WHERE HaulerKey = $hid");
        if(count($tr)>0){
            
            return $tr[0]['Name'];
        }else{
            return "N/A";
        } 
    }else{
        return "N/A";
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

if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    
    session_destroy();
}

if(isset($_POST['export_scale'])){
    $hj = $db->query("$_POST[query_string]");
    if(count($hj)>0){
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
                xlsWriteLabel($xlsRow,8,"In/Out");
                xlsWriteLabel($xlsRow,10,"Release No");
                xlsWriteLabel($xlsRow,12,"Notes");
                xlsWriteLabel($xlsRow,14,"Product");
                xlsWriteLabel($xlsRow,16,"Weigh In");
                xlsWriteLabel($xlsRow,18,"Weigh Out");
                xlsWriteLabel($xlsRow,20,"Gross"); 
                xlsWriteLabel($xlsRow,22,"Tare");
                xlsWriteLabel($xlsRow,24,"Net");
                xlsWriteLabel($xlsRow,26,"Units");
                xlsWriteLabel($xlsRow,28,"User Name");
                xlsWriteLabel($xlsRow,30,"Trailer ID 1");
                xlsWriteLabel($xlsRow,32,"Trailer ID 2");
                foreach($hj as $k){
                    $count++;
                    $xlsRow++;
                    xlsWriteLabel($xlsRow,0,$k['tk']);
                    xlsWriteLabel($xlsRow,2, truckDecode($k['TruckKey'],"name")  );
                    xlsWriteLabel($xlsRow,4, truckDecode($k['TruckKey'],"truckid") );
                    xlsWriteLabel($xlsRow,6, CustomerKey($k['CustomerKey']) );
                    switch($k['ShipMode']){
                        case "S": case '"S"':
                            xlsWriteLabel($xlsRow,8,"Outgoing");
                        break;
                        case "R": case '"R"':
                            xlsWriteLabel($xlsRow,8,"Incoming");
                        break;
                    }       
                    xlsWriteLabel($xlsRow,10,$k['UF1Data']);
                    xlsWriteLabel($xlsRow,12,$k['UF3Data']);
                    xlsWriteLabel($xlsRow,14, productKey($k['ProductKey']) );
                    xlsWriteLabel($xlsRow,16,$k['WeighIn']);
                    if(strlen(trim($k['WeighOut']))<=0){
                        xlsWriteLabel($xlsRow,18,"N/A");
                    }else{
                        xlsWriteLabel($xlsRow,18,"$k[WeighOut]");
                    }
                    xlsWriteLabel($xlsRow,20,$k['Gross']);
                    xlsWriteLabel($xlsRow,22,$k['Tare']);
                    xlsWriteLabel($xlsRow,24,$k['Net']);
                    xlsWriteLabel($xlsRow,26,$k['Units']);
                    xlsWriteLabel($xlsRow,28,$k['UserName']);
                    xlsWriteLabel($xlsRow,30,truckDecode($k['TruckKey'],"id1") );
                    xlsWriteLabel($xlsRow,32,truckDecode($k['TruckKey'],"id2") );
                }
                xlsEOF();
            break;
            case "csv":
                $html="";
                $file = "scale_export".date("YmdHm").".csv";
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Description: File Transfer");
                header("Content-type: text/csv");
                header("Content-Disposition: attachment; filename={$file}");
                header("Expires: 0");
                header("Content-Transfer-Encoding: binary");
                header("Pragma: public");
                foreach($hj as $k){
                    $html .= "$k[tk],$k[truckid],$k[name],"; 
                        if($k['CustomerKey'] == NULL){
                             $html .= Vendors($k['VendorKey']).",";
                        }else{
                             $html .= CustomerKey($k['CustomerKey']).",";
                        }
                    
                        switch($k['ShipMode']){
                            case "S": case '"S"':
                                 $html .= "Outgoing,";
                            break;
                            case "R": case '"R"':
                                  $html .= "Incoming,";
                            break;
                        }
                     $html .= "$k[UF1Data],$k[UF3Data],".productKey($k['ProductKey']).",$k[WeighIn],"; 
                        if(strlen(trim($k['WeighOut']))<=0){
                             $html .= "N/A,";
                        }else{
                             $html .= "$k[WeighOut],";
                        }
                     $html .= "$k[Gross],$k[Tare],$k[Net],$k[Units],$k[UserName],".haulerDecode($k['HaulerKey']).",".truckDecode($k['TruckKey'],"id1").",".truckDecode($k['TruckKey'],"id2")."\r";
                }
                $fh = @fopen( "php://output", 'w' );
                fwrite($fh, $html);
                fclose($fh);
            break;
            case "pdf":
                include "plugins/phpToPDF/phpToPDF.php";
                $file = "scale_export".date("YmdHm").".pdf";
                $html .= '<!DOCTYPE HTML><html><head><style type="text/css">@page{size: 8.5in 11in;margin: 0.5in;} body{ font-size:12px;padding:10px 10px 10px 10px;margin:10px 10px 10px 10px;}.tableNavigation {width:1000px;text-align:center;margin:auto;overflow-x:auto;}.tableNavigation ul {display:inline;width:1000px;}.tableNavigation ul li {display:inline;margin-right:5px;}.myTable th{width:auto;}.myTable td {padding:5px 5px 5px 5px;}td,th{background:transparent; text-align:center;width:1%;font-size:12px;vertical-align:middle;display:table-cell;padding:0px 2px; /* just some padding, if needed*/white-space: pre; /* this will avoid line breaks*/border:1px solid black;}tr.even{background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);display:table-row}tr.odd{background:transparent;display:table-row}.setThisRoute{z-index:9999;}input[type=checkbox]{width:10px;}.cc{display:table-row;}</style></head><body><table class="myTable" style="margin:auto;display:table;width:95%;"><thead><th style="text-align:center;">Weight Cert No.</th><th style="text-align:center;">Truck ID/License</th><th style="text-align:center;">Driver</th><th style="text-align:center;">Buyer/Seller</th><th style="text-align:center;">In/Out</th><th style="text-align:center;">Release No</th><th style="text-align:center;">Notes</th><th style="text-align:center;">Product</th><th style="text-align:center;width:700px;">Weigh In</th><th style="text-align:center;">Weigh Out</th><th  style="text-align:center;">Gross</th><th style="text-align:center;">Tare</th><th style="text-align:center;">Net</th><th style="text-align:center;">Units</th><th style="text-align:center;">User Name</th><th style="text-align:center;">Hauler</th><th style="text-align: center;">Trailer ID 1</th><th style="text-align: center;">Trailer ID 2</th>';
                foreach($hj as $k){
                     $html .= "<tr class='cc'>";
                     $html .= "<td>$k[tk]</td>";
                     $html .= "<td>$k[truckid]</td>";
                     $html .= "<td>$k[name]</td>";
                     $html .= "<td>"; 
                        if($k['CustomerKey'] == NULL){
                             $html .= Vendors($k['VendorKey']);
                        }else{
                             $html .= CustomerKey($k['CustomerKey']);
                        }
                     $html .= "</td>";
                     $html .= "<td>";
                        switch($k['ShipMode']){
                            case "S": case '"S"':
                                 $html .= "Outgoing";
                            break;
                            case "R": case '"R"':
                                  $html .= "Incoming";
                            break;
                        }
                     $html .= "</td>";
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
                     $html .= "<td>$k[Units]</td>";
                     $html .= "<td>$k[UserName]</td>";
                     $html .= "<td>".haulerDecode($k['HaulerKey'])."</td>";
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