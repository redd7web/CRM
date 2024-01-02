<?php
    include "protected/global.php";
    include "protected/xlsfunctions.php";
    $ikg = new IKG($_GET['ikg']);
    $dte = date("Y-m-d");
// 	header("Pragma: public");
//    header("Expires: 0");
//    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//    header("Content-Type: application/force-download");
//    header("Content-Type: application/octet-stream");
//    header("Content-Type: application/download");
//    header("Content-Disposition: attachment;filename=$ikg->ikg_manifest_route_number-$date.xls");
//    header("Content-Transfer-Encoding: binary ");
//    $xlsRow = 0;
//	$xlsCol = 0;
//    xlsBOF();
//    xlsWriteLabel($xlsRow,0,"Address:");
//    xlsWriteLabel($xlsRow,2,"City:");
//    xlsWriteLabel($xlsRow,4,"State:");
//    xlsWriteLabel($xlsRow,6,"Zip:");
//    xlsWriteLabel($xlsRow,8,"Company:");
//
//    foreach($ikg->account_numbers as $nums){
//        $acnt = new Account($nums);
//        $xlsRow++;
//        xlsWriteLabel($xlsRow,0,$acnt->address);
//        xlsWriteLabel($xlsRow,2,$acnt->city);
//        xlsWriteLabel($xlsRow,4,$acnt->state);
//        xlsWriteLabel($xlsRow,6,$acnt->zip);
//        xlsWriteLabel($xlsRow,8,$acnt->name_plain);
//    }
//
//    xlsEOF();




            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-type: text/csv");
            $fileName = "route_export" . $ikg->ikg_manifest_route_number . " " .date("Ymdhis").".csv";
            header("Content-Disposition: attachment; filename={$fileName}");
            header("Expires: 0");
            header("Content-Transfer-Encoding: binary");
            header("Pragma: public");

            $dataString = "name, Address, From, To, Duration, Load, Phone, Email, Types, Priority, Notes, Notes 2\r\n";

        foreach($ikg->account_numbers as $nums) {
            $acnt = new Account($nums);

            $address = $acnt->address . ", " . $acnt->city . ", " . $acnt->state . ", " . $acnt->zip;

            $dataString .= $acnt->acount_id .  ", ";
            $dataString .= "\"" . $address . "\"";
            $dataString .= "\r\n";
        };

            $fh = @fopen("php://output", 'w');
            fwrite($fh, $dataString);
            fclose($fh);






//
//include "protected/global.php";
//include "protected/xlsfunctions.php";
//$ikg = new IKG($_GET['ikg']);
//$dte = date("Y-m-d");
//header("Pragma: public");
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Content-Type: application/force-download");
//header("Content-Type: application/octet-stream");
//header("Content-Type: application/download");
//$file_name = $ikg->ikg_manifest_route_number . ".xls";
//header("Content-Disposition: attachment;filename=" . $file_name );
//header("Content-Transfer-Encoding: binary ");
//$xlsRow = 0;
//$xlsCol = 0;
//xlsBOF();
//xlsWriteLabel($xlsRow,0,"name");
//xlsWriteLabel($xlsRow,1,"Address");
//xlsWriteLabel($xlsRow,2,"From");
//xlsWriteLabel($xlsRow,3,"To");
//xlsWriteLabel($xlsRow,4,"Duration");
//xlsWriteLabel($xlsRow,5,"Load");
//xlsWriteLabel($xlsRow,6,"Phone");
//xlsWriteLabel($xlsRow,7,"Email");
//xlsWriteLabel($xlsRow,8,"Types");
//xlsWriteLabel($xlsRow,9,"Priority");
//xlsWriteLabel($xlsRow,10,"Notes");
//xlsWriteLabel($xlsRow,11,"Notes 2");
//
//foreach($ikg->account_numbers as $nums){
//    $acnt = new Account($nums);
//
//    $address = $acnt->address . ", " . $acnt->city . ", " . $acnt->state . ", " . $acnt->zip;
//
//    $xlsRow++;
//    xlsWriteLabel($xlsRow,0,$acnt->acount_id);
//    xlsWriteLabel($xlsRow,1,$address);
//
//
//}
//
//xlsEOF();




?>