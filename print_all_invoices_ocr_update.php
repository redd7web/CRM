<?php
include "plugins/phpToPDF/phpToPDF.php";
include 'PDFMerger.php';
include "protected/global.php";
ini_set("display_errors",1);
$buffer = explode("|",$_GET['ids']);
array_pop($buffer);


$id_array = "(";
foreach($buffer as $entry_id){
    $id_array .= $entry_id . ",";

}

$id_correct_array = rtrim($id_array, ",");
$id_correct_array .= ")";

echo $id_correct_array;

//print_all_invoices_ocr_update.php?ids=57697|57721|57743|57761|57766|

$zip = new ZipArchive();

$filename = 'NMLoadReportPDF/NMLoadReport-' . date('y-m-d-H-i-s') . '.zip';

//Grab the Destination WC JPGs
    $get_requested_jpg = $db->query("SELECT ap_form_11670.element_15,
                                        ap_form_11670.element_13,
                                        ap_form_11670.element_4 as destination_newbos,
                                        ap_form_11670.element_62 as destination_wc,
                                        ap_form_11670.element_57 as shipment,
                                        ap_form_11670.element_76 as origin_newbos,
                                        ap_form_11670.element_38 as origin_wc
                                        FROM Inetforms.ap_form_11670 WHERE (id IN $id_correct_array AND element_15 LIKE '%.jpg%') OR (id IN $id_correct_array OR element_13 LIKE '%.jpg%' )");


    //Above



    //Below is gucci


    if(count($get_requested_jpg) > 0) {
        foreach ($get_requested_jpg as $pics_first) {

            $new_string = "WheyimportDestinationWC__" . trim($pics_first['destination_newbos']) . "_" . trim($pics_first['destination_wc']) . "_" . trim($pics_first['shipment']) . ".jpg";

            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_15'];

            //$copiedFile = $pics_first['element_15'];


//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//                //  echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }

            $filepath = "NMLoadReportPDF/" . $new_string;

            if ($zip->open($filename, ZipArchive::CREATE) === TRUE) {
                $zip->addFromString($new_string, file_get_contents($source_url));
                //$zip->addFile($filepath);
                //   echo "File Added For: " . $filepath;
                $zip->close();
            } else {
                //  echo "Not Created";
            }

//            if(file_exists($filepath)){
//                //  echo "File Exists " . $filepath;
//                unlink($filepath);
//            } else {
//                 echo "No File";
//            }


            //Origin
            $new_string = "WheyimportOriginWC_" . trim($pics_first['origin_newbos']) . "_" . trim($pics_first['origin_wc']) . "_" . trim($pics_first['shipment']) . ".jpg";

            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_13'];

//            $copiedFile = $pics_first['element_13'];
//
//
//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//                //echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }

            $filepath = "NMLoadReportPDF/" . $new_string;

            if ($zip->open($filename, ZipArchive::CREATE) === TRUE) {
                $zip->addFromString($new_string, file_get_contents($source_url));
                //$zip->addFile($filepath);
                echo "File Added For: " . $filepath;
                $zip->close();


            }
        }

    }
//Destination WC / PDFs
    $get_request_pdf = $db->query("SELECT ap_form_11670.element_15,
                                        ap_form_11670.element_4 as destination_newbos,
                                        ap_form_11670.element_62 as destination_wc,
                                        ap_form_11670.element_57 as shipment
                                        FROM Inetforms.ap_form_11670 WHERE id IN $id_correct_array AND element_15 LIKE '%.pdf%' ");

    if(count($get_request_pdf) > 0){
        foreach($get_request_pdf as $pics_first){

            //Grab each PDF and set the name of the PDF

            $new_string = "WheyimportDestinationWC_".trim($pics_first['destination_newbos'])."_". trim($pics_first['destination_wc']) . "_" . trim($pics_first['shipment']) . ".pdf";

            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_15'];

            $copiedFile = $pics_first['element_15'];



//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//                //echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }

            $filepath = "NMLoadReportPDF/" . $new_string ;

            if ( $zip->open($filename, ZipArchive::CREATE) === TRUE) {
                $zip->addFromString($new_string,  file_get_contents($source_url));
                //$zip->addFile($filepath);
              //  echo "File Added For: " . $filepath;
                $zip->close();
            } else {
               // echo "Not Created";
            }

//            if(file_exists($filepath)){
//                echo "File Exists" . $filepath;
//                unlink($filepath);
//            } else {
//                echo "No File";
//            }


        }

    }


//Adding others here

//Origin WC PDFs

    $get_request_pdf = $db->query("SELECT ap_form_11670.element_13,
                                        ap_form_11670.element_76 as origin_newbos,
                                        ap_form_11670.element_38 as origin_wc,
                                        ap_form_11670.element_57 as shipment
                                        FROM Inetforms.ap_form_11670 WHERE id IN $id_correct_array AND element_15 LIKE '%.pdf%' ");

    if(count($get_request_pdf) > 0){
        foreach($get_request_pdf as $pics_first){

            //Grab each PDF and set the name of the PDF

            $new_string = "WheyimportOriginWC_".trim($pics_first['origin_newbos'])."_". trim($pics_first['origin_wc']) . "_" . trim($pics_first['shipment']) . ".pdf";

            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_13'];

     //       $copiedFile = $pics_first['element_13'];

//
//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//                //echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }

            $filepath = "NMLoadReportPDF/" . $new_string ;

            if ( $zip->open($filename, ZipArchive::CREATE) === TRUE) {
                $zip->addFromString($new_string,  file_get_contents($source_url));
                //$zip->addFile($filepath);
                //echo "File Added For: " . $filepath;
                $zip->close();
            } else {
                //echo "Not Created";
            }

//            if(file_exists($filepath)){
//               // echo "File Exists" . $filepath;
//                unlink($filepath);
//            } else {
//                //echo "No File";
//            }


        }
    }



////Origin WC JPGs
//foreach($buffer as $entry_id){
//    $get_requested_jpg = $db->query("SELECT ap_form_11670.element_13,
//                                        ap_form_11670.element_76 as origin_newbos,
//                                        ap_form_11670.element_38 as origin_wc,
//                                        ap_form_11670.element_57 as shipment
//                                        FROM Inetforms.ap_form_11670 WHERE id IN $id_correct_array AND element_13 LIKE '%.jpg%' ");
//
//    if(count($get_requested_jpg) > 0){
//        foreach($get_requested_jpg as $pics_first){
//
//            $new_string = "WheyimportOriginWC_".trim($pics_first['origin_newbos'])."_". trim($pics_first['origin_wc']) . "_" . trim($pics_first['shipment']) . ".jpg";
//
//            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_13'];
//
////            $copiedFile = $pics_first['element_13'];
////
////
////            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
////                //echo "failed to copy $source_url...\n";
////            } else {
////                //echo "Copied File";
////            }
//
//            $filepath = "NMLoadReportPDF/" . $new_string ;
//
//            if ( $zip->open($filename, ZipArchive::CREATE) === TRUE) {
//                $zip->addFromString($new_string,  file_get_contents($source_url));
//                //$zip->addFile($filepath);
//                echo "File Added For: " . $filepath;
//                $zip->close();
//            } else {
//                //echo "Not Created";
//            }
//
////            if(file_exists($filepath)){
////                //echo "File Exists" . $filepath;
////                unlink($filepath);
////            } else {
////                //echo "No File";
////            }
//
//        }
//    }
//}
//
//

//


//$$$$$$$$$ BELOW IS OLD, changing how the query works!

//
////Destination WC JPGs
//foreach($buffer as $entry_id){
//    $get_requested_jpg = $db->query("SELECT ap_form_11670.element_15,
//                                        ap_form_11670.element_4 as destination_newbos,
//                                        ap_form_11670.element_62 as destination_wc,
//                                        ap_form_11670.element_57 as shipment
//                                        FROM Inetforms.ap_form_11670 WHERE id = $entry_id AND element_15 LIKE '%.jpg%' ");
//
//    if(count($get_requested_jpg) > 0){
//        foreach($get_requested_jpg as $pics_first){
//
//            $new_string = "WheyimportDestinationWC__".trim($pics_first['destination_newbos'])."_". trim($pics_first['destination_wc']) . "_" . trim($pics_first['shipment']) . ".jpg";
//
//            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_15'];
//
//            $copiedFile = $pics_first['element_15'];
//
//
//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//              //  echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }
//
//            $filepath = "NMLoadReportPDF/" . $new_string ;
//
//            if ( $zip->open($filename, ZipArchive::CREATE) === TRUE) {
//                $zip->addFile($filepath);
//             //   echo "File Added For: " . $filepath;
//                $zip->close();
//            } else {
//              //  echo "Not Created";
//            }
//
//            if(file_exists($filepath)){
//              //  echo "File Exists " . $filepath;
//                unlink($filepath);
//            } else {
//               // echo "No File";
//            }
//
//
//        }
//    }
//}
//
////Destination WC / PDFs
//foreach($buffer as $entry_id){
//    $get_request_pdf = $db->query("SELECT ap_form_11670.element_15,
//                                        ap_form_11670.element_4 as destination_newbos,
//                                        ap_form_11670.element_62 as destination_wc,
//                                        ap_form_11670.element_57 as shipment
//                                        FROM Inetforms.ap_form_11670 WHERE id = $entry_id AND element_15 LIKE '%.pdf%' ");
//
//    if(count($get_request_pdf) > 0){
//        foreach($get_request_pdf as $pics_first){
//
//            //Grab each PDF and set the name of the PDF
//
//            $new_string = "WheyimportDestinationWC_".trim($pics_first['destination_newbos'])."_". trim($pics_first['destination_wc']) . "_" . trim($pics_first['shipment']) . ".pdf";
//
//            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_15'];
//
//            $copiedFile = $pics_first['element_15'];
//
//            ;
//
//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//                //echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }
//
//            $filepath = "NMLoadReportPDF/" . $new_string ;
//
//            if ( $zip->open($filename, ZipArchive::CREATE) === TRUE) {
//                $zip->addFile($filepath);
//              //  echo "File Added For: " . $filepath;
//                $zip->close();
//            } else {
//               // echo "Not Created";
//            }
//
//            if(file_exists($filepath)){
//               // echo "File Exists" . $filepath;
//                unlink($filepath);
//            } else {
//               // echo "No File";
//            }
//
//
//        }
//
//    }
//
//
//}
//
////Origin WC PDFs
//foreach($buffer as $entry_id){
//    $get_request_pdf = $db->query("SELECT ap_form_11670.element_13,
//                                        ap_form_11670.element_76 as origin_newbos,
//                                        ap_form_11670.element_38 as origin_wc,
//                                        ap_form_11670.element_57 as shipment
//                                        FROM Inetforms.ap_form_11670 WHERE id = $entry_id AND element_15 LIKE '%.pdf%' ");
//
//    if(count($get_request_pdf) > 0){
//        foreach($get_request_pdf as $pics_first){
//
//            //Grab each PDF and set the name of the PDF
//
//            $new_string = "WheyimportOriginWC_".trim($pics_first['origin_newbos'])."_". trim($pics_first['origin_wc']) . "_" . trim($pics_first['shipment']) . ".pdf";
//
//            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_13'];
//
//            $copiedFile = $pics_first['element_13'];
//
//
//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//                //echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }
//
//            $filepath = "NMLoadReportPDF/" . $new_string ;
//
//            if ( $zip->open($filename, ZipArchive::CREATE) === TRUE) {
//                $zip->addFile($filepath);
//                //echo "File Added For: " . $filepath;
//                $zip->close();
//            } else {
//                //echo "Not Created";
//            }
//
//            if(file_exists($filepath)){
//               // echo "File Exists" . $filepath;
//                unlink($filepath);
//            } else {
//                //echo "No File";
//            }
//
//
//        }
//    }
//
//}
//
////Origin WC JPGs
//foreach($buffer as $entry_id){
//    $get_requested_jpg = $db->query("SELECT ap_form_11670.element_13,
//                                        ap_form_11670.element_76 as origin_newbos,
//                                        ap_form_11670.element_38 as origin_wc,
//                                        ap_form_11670.element_57 as shipment
//                                        FROM Inetforms.ap_form_11670 WHERE id = $entry_id AND element_13 LIKE '%.jpg%' ");
//
//    if(count($get_requested_jpg) > 0){
//        foreach($get_requested_jpg as $pics_first){
//
//            $new_string = "WheyimportOriginWC_".trim($pics_first['origin_newbos'])."_". trim($pics_first['origin_wc']) . "_" . trim($pics_first['shipment']) . ".jpg";
//
//            $source_url = 'https://inet.iwpusa.com/machforms/machform/data/form_11670/files/' . $pics_first['element_13'];
//
//            $copiedFile = $pics_first['element_13'];
//
//
//            if (!copy($source_url, "NMLoadReportPDF/$new_string")) {
//                //echo "failed to copy $source_url...\n";
//            } else {
//                //echo "Copied File";
//            }
//
//            $filepath = "NMLoadReportPDF/" . $new_string ;
//
//            if ( $zip->open($filename, ZipArchive::CREATE) === TRUE) {
//                $zip->addFile($filepath);
//                echo "File Added For: " . $filepath;
//                $zip->close();
//            } else {
//                //echo "Not Created";
//            }
//
//            if(file_exists($filepath)){
//                //echo "File Exists" . $filepath;
//                unlink($filepath);
//            } else {
//                //echo "No File";
//            }
//
//        }
//    }
//}


if (file_exists($filename)){


        header('Content-Description: File Transfer');
        header("Content-Type: application/zip");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        ob_clean();

    //Downloads the zip file
    //readfile($filename);

    //Deletes the zip file
    unlink($filename);
}

//$new_string = "WheyimportOriginWC_".date("ymdHis");
//$pdf_options = array(
//  "source_type" => 'html',
//  "source" => trim($html),
//  "action" => 'save',
//  "save_directory" => 'NMLoadReportPDF',
//  "page_orientation" => 'landscape',
//  "file_name" => $new_string.'.pdf',
//  "page_size" => 'A5',
//  "encoding" => 'ISO-8859-1'
//);
//phptopdf($pdf_options);
//*************************** MERGE EXISTING PDF's with newly created ******************************************//

//$get_requested_pdf = $db->query("SELECT ap_form_11670.element_15 FROM Inetforms.ap_form_11670 WHERE id IN(".implode(",",$buffer).") AND element_15 LIKE '%.pdf%' ");

//if(count($get_requested_pdf) > 0){
//    $pdf = new PDFMerger;
//    foreach($get_requested_pdf as $pdfs){
//        $pdf->addPDF("machforms/machform/data/form_11670/files/$pics_first[element_15]","all");
//    }
//    $pdf->merge('file', $new_string.'.pdf');
//}

//*************************** MERGE EXISTING PDF's with newly created ******************************************//

	
///**/$path = $new_string.".pdf";
//$filename = $new_string.".pdf";
//header("Content-disposition: attachment; filename=".$filename);
//header("Content-type: application/pdf");
//readfile($filename);
?>