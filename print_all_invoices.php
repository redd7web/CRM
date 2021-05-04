<?php
include "plugins/phpToPDF/phpToPDF.php";
include 'PDFMerger.php';
include "protected/global.php";
ini_set("display_errors",1);
$buffer = explode("|",$_GET['ids']);
array_pop($buffer);



$get_requested_jpg = $db->query("SELECT ap_form_11670.element_15 FROM Inetforms.ap_form_11670 WHERE id IN(".implode(",",$buffer).") AND element_15 LIKE '%.jpg%' ");
//echo "SELECT ap_form_11670.element_15 FROM Inetforms.ap_form_11670 WHERE id IN(".implode(",",$buffer).") ";
$html ="";
if(count($get_requested_jpg)>0){
    foreach($get_requested_jpg as $pics_first){
        $html .="<img src='https://inet.iwpusa.com/machforms/machform/data/form_11670/files/$pics_first[element_15]' style='width:400px;height:500px;'/>";
        $html .='<div id="break" style="page-break-after:always;width:100%;">.</div>';    
    }
}

//echo $html;

$new_string = "NewMexicoReportLoad".date("ymdHis");
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
//*************************** MERGE EXISTING PDF's with newly created ******************************************//

$get_requested_pdf = $db->query("SELECT ap_form_11670.element_15 FROM Inetforms.ap_form_11670 WHERE id IN(".implode(",",$buffer).") AND element_15 LIKE '%.pdf%' ");

if(count($get_requested_pdf) > 0){
    $pdf = new PDFMerger;    
    foreach($get_requested_pdf as $pdfs){
        $pdf->addPDF("machforms/machform/data/form_11670/files/$pics_first[element_15]","all");
    }
    $pdf->merge('file', $new_string.'.pdf');
}

//*************************** MERGE EXISTING PDF's with newly created ******************************************//

	
/**/$path = $new_string.".pdf";
$filename = $new_string.".pdf";
header("Content-disposition: attachment; filename=".$filename);
header("Content-type: application/pdf");
readfile($filename);
?>