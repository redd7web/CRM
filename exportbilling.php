<?php
include "protected/global.php";
include "scaleFunctions.php";
ini_set("display_errors",0);
$manage = array (1,3);
$calc_check = array(82,86,20);
$billers = array(1,2);
$product_restrict = array(4,5,7,15,20,22,25,29,30,31,34,39,41,49,50,51,54,55,63,67,69,76,80,82,84,86,87,88,89,90);


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
                $file = "scale_export_billing".date("YmdHm").".xls";
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
                xlsWriteLabel($xlsRow,0,"Shipping No.");
                xlsWriteLabel($xlsRow,2,"Product");
                xlsWriteLabel($xlsRow,4,"Weight Cert No.");
                xlsWriteLabel($xlsRow,6,"Weigh In");
                xlsWriteLabel($xlsRow,8,"Weigh Out");
                xlsWriteLabel($xlsRow,10,"Gross[lbs]");
                xlsWriteLabel($xlsRow,12,"Tare[lbs]");
                xlsWriteLabel($xlsRow,14,"Net[lbs]");
                xlsWriteLabel($xlsRow,16,"Hauler");
                xlsWriteLabel($xlsRow,18,"Buyer/Seller"); 
                xlsWriteLabel($xlsRow,20,"Notes");
                xlsWriteLabel($xlsRow,22,"Driver");
                xlsWriteLabel($xlsRow,24,"Release No");
                xlsWriteLabel($xlsRow,26,"User Name");
                xlsWriteLabel($xlsRow,28,"TruckID / License");
                xlsWriteLabel($xlsRow,30,"Trailer ID 1");
                xlsWriteLabel($xlsRow,32,"Trailer ID 2");
               
                foreach($hj as $k){
                    $count++;
                    $xlsRow++;
                    xlsWriteLabel($xlsRow,0, sn($k['TruckKey'],$k['WeighIn'])   );
                    xlsWriteLabel($xlsRow,2, productKey($k['ProductKey']) );
                    xlsWriteLabel($xlsRow,4, $k['tk']  );
                    xlsWriteLabel($xlsRow,6,$k['WeighIn']);
                    if(strlen(trim($k['WeighOut']))<=0){
                        xlsWriteLabel($xlsRow,8,"N/A");
                    }else{
                        xlsWriteLabel($xlsRow,8,"$k[WeighOut]");
                    }
                    xlsWriteLabel($xlsRow,10,$k['Gross']);
                    xlsWriteLabel($xlsRow,12,$k['Tare']);
                    xlsWriteLabel($xlsRow,14,$k['Net']);
                    xlsWriteLabel($xlsRow,16, haulerDecode($k['TruckKey']) );
                    xlsWriteLabel($xlsRow,18, CustomerKey($k['CustomerKey']) );
                    xlsWriteLabel($xlsRow,20,$k['UF3Data']);
                    xlsWriteLabel($xlsRow,22, truckDecode($k['TruckKey'],"name") );
                    xlsWriteLabel($xlsRow,24,$k['UF1Data']);
                    xlsWriteLabel($xlsRow,26,$k['UserName']);
                    xlsWriteLabel($xlsRow,28, truckDecode($k['TruckKey'],"truckid") );
                    xlsWriteLabel($xlsRow,30,truckDecode($k['TruckKey'],"id1") );
                    xlsWriteLabel($xlsRow,32,truckDecode($k['TruckKey'],"id2") );
                }
                xlsEOF();
            break;
            case "csv":
                $html="";
                $file = "scale_export_billing".date("YmdHm").".csv";
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Description: File Transfer");
                header("Content-type: text/csv");
                header("Content-Disposition: attachment; filename={$file}");
                header("Expires: 0");
                header("Content-Transfer-Encoding: binary");
                header("Pragma: public");
                foreach($hj as $k){
                     $html .= sn($k['TruckKey'],$k['WeighIn']).",". productKey($k['ProductKey']).", $k[tk],$k[WeighIn],";
                     if(strlen(trim($k['WeighOut']))<=0){
                        $html .=  xlsWriteLabel($xlsRow,8,"N/A").",";
                     }else{
                        $html .=  xlsWriteLabel($xlsRow,8,"$k[WeighOut]").",";
                     }
                     $html .="$k[Gross],$k[Tare],$k[Net],".haulerDecode($k['TruckKey']).",".CustomerKey($k['CustomerKey']).",$k[UF3Data],".truckDecode($k['TruckKey'],"name").",$k[UF1Data],$k[UserName],".truckDecode($k['TruckKey'],"truckid").",".truckDecode($k['TruckKey'],"id1").",".truckDecode($k['TruckKey'],"id2")."\r";
                     
                }
                $fh = @fopen( "php://output", 'w' );
                fwrite($fh, $html);
                fclose($fh);
            break;
            case "pdf":
                include "plugins/phpToPDF/phpToPDF.php";
                $file = "scale_export_billing".date("YmdHm").".pdf";
                $html .= '<!DOCTYPE HTML><html><head><style type="text/css">@page{size: 8.5in 11in;margin: 0.5in;} body{ font-size:12px;padding:10px 10px 10px 10px;margin:10px 10px 10px 10px;}.tableNavigation {width:1000px;text-align:center;margin:auto;overflow-x:auto;}.tableNavigation ul {display:inline;width:1000px;}.tableNavigation ul li {display:inline;margin-right:5px;}.myTable th{width:auto;}.myTable td {padding:5px 5px 5px 5px;}td,th{background:transparent; text-align:center;width:1%;font-size:12px;vertical-align:middle;display:table-cell;padding:0px 2px; /* just some padding, if needed*/white-space: pre; /* this will avoid line breaks*/border:1px solid black;}tr.even{background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);display:table-row}tr.odd{background:transparent;display:table-row}.setThisRoute{z-index:9999;}input[type=checkbox]{width:10px;}.cc{display:table-row;}</style></head><body><table class="myTable" style="margin:auto;display:table;width:95%;"><thead><th>Shipping #</th><th>Product</th><th>Weight Cert No.</th><th>Weigh In</th><th>Weigh Out</th><th>Gross[lbs]</th><th>Tare[lbs]</th><th>Net[lbs]</th><th>Hauler</th><th>Buyer/Seller</th><th>Notes</th><th>Driver</th><th>Release No</th><th>User Name</th><th>Truck ID/License</th><th style="text-align: center;">Trailer ID 1</th><th style="text-align: center;">Trailer ID 2</th>';
                foreach($hj as $k){
                    $html .= "<tr class='cc'>";
                    $html .= "<td> &nbsp;<input type='text' class='sn' ";   
                    if( !in_array($_SESSION['billing'],$billers)   ) {
                        $html .= " readonly ";
                    }
                    $html .= " value='".sn($k['TruckKey'],$k['WeighIn'])."' rel='$k[TruckKey]' weignin='$k[WeighIn]' style='float:left;width:100px;' /></td>";
                    $html .= "<td>".productKey($k['ProductKey'])."</td>";
                    $html .= "<td>$k[tk]</td>";
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
                    $html .= "<td>".haulerDecode($k['TruckKey'])."</td>";
                    $html .= "<td>".CustomerKey($k['CustomerKey'])."</td>";
                    $html .= "<td>$k[UF3Data]</td>";
                    $html .= "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                    $html .= "<td>$k[UF1Data]</td>";
                    $html .= "<td>$k[UserName]</td>";
                    $html .= "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
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
                  "page_size" => 'portrait'
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