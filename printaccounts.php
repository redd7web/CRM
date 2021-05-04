<?php
include "protected/global.php";
ini_set("display_errors",0);
$account_table = $dbprefix."_accounts";    

if(isset($_POST['export'])){
    $act = new Account();
    $result = $db->query($_POST['criteria']);
    if(count($result)>0){    
        switch($_POST['format']){
            case "csv":
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Description: File Transfer");
                header("Content-type: text/csv");
                $fileName = "account_export".date("Ymdhis").".csv";
                header("Content-Disposition: attachment; filename={$fileName}");
                header("Expires: 0");
                header("Content-Transfer-Encoding: binary");
                header("Pragma: public");
                if(count($result)>0){
                  $start =1;        
                  $dataString = "Account Number,Status,Payment Method,Account Name,City,State,Created,Expires,Locations,Address,Zip,Facility,Pay Amount ";
                  
                  if($_POST['percent_full'] == 1){
                        $dataString .=",Percent Full";
                  }

                  if($_POST['full_contact_export'] == 1){
                        $dataString .=",Contact Name, Billing Email, Email";
                  }

                  $dataString .= "\r\n";

                  foreach($result as $account){
                    
                    //$start++;
                     $dataString .= "$account[account_ID],$account[status], $account[payment_method],$account[name],$account[city],$account[state],$account[created],$account[expires],$account[locations],$account[address],$account[zip],".numberToFacility($account['division']."");
                     if( strlen(trim($_POST['get_sales_rep'])) >0 ){
                        $dataString .= ",".uNumToName_plain($account['original_sales_person']);
                     }    
                
                    if(isset($_POST['get_ppg'])){
                        switch($account['payment_method']){
                            case "Jacobson": case "Index":
                               $dataString .=",$account[index_percentage]";
                            break;
                            case "Per Gallon": case "Normal":
                                $dataString .= ",$account[ppg_jacobsen_percentage]";
                            break;
                            case "O.T.P. Per Gallon":
                                $dataString .=",$account[ppg_jacobsen_percentage] / $account[price_per_gallon]";
                            break;
                            case "One Time Payment":
                                $dataString .=",$account[ppg_jacobsen_percentage]";
                            break;
                            case "No Pay": default:
                                $dataString .=",0";
                            break;
                        }
                    }
                    
                    if($_POST['percent_full'] == 1){
                        $perc_full = ($act->onsite($account['account_ID'])/$act->barrel_cap($account['account_ID']))*100;
                        $dataString .= ",".number_format($perc_full,2, '.', '');
                    }

                    if($_POST['full_contact_export'] == 1){

                        $dataString .= ",$account[contact_name],$account[billing_email], $account[email_address]";

                    }

                    $dataString .="\r\n";
                    
                  }
                }
                $fh = @fopen( "php://output", 'w' );
                fwrite($fh, $dataString);
                fclose($fh);
            break;
            case "xls":
                include "protected/xlsfunctions.php";
                 $file = "account_exports".date("YmdHm").".xls";
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");           
                header("Content-Disposition: attachment;filename=$file");
                header("Content-Transfer-Encoding: binary ");
                $count =0; 
                $xlsRow = 0;
                $xlsCol = 0;
                xlsBOF();
                xlsWriteLabel($xlsRow,0,"#:");
                xlsWriteLabel($xlsRow,2,"ID:");
                xlsWriteLabel($xlsRow,4,"status:"); 
                xlsWriteLabel($xlsRow,6,"Payment Type");
                xlsWriteLabel($xlsRow,8,"Name");
                xlsWriteLabel($xlsRow,10,"City:");
                xlsWriteLabel($xlsRow,12,"State:");
                xlsWriteLabel($xlsRow,14,"Created");  
                xlsWriteLabel($xlsRow,16,"Expires");
                xlsWriteLabel($xlsRow,20,"Address:");
                xlsWriteLabel($xlsRow,22,"Zip:");
                xlsWriteLabel($xlsRow,24,"Division:");
                if(isset($_POST['get_sales_rep'])){
                    xlsWriteLabel($xlsRow,26,"Sales Rep");
                }                 
                if(isset($_POST['get_ppg'])){
                    xlsWriteLabel($xlsRow,28,"Payment Value");
                }
                if(isset($_POST['percent_full'])){
                    xlsWriteLabel($xlsRow,30,"Percent Full");
                }
                
                if($_POST['full_contact_export'] == 1){

                    xlsWriteLabel($xlsRow,32,"Contact Name");
                    xlsWriteLabel($xlsRow,34,"Billing Email");
                    xlsWriteLabel($xlsRow,36,"Email Address");


                }


                foreach($result as $account){
                    $count++;
                    $xlsRow++;
                    xlsWriteLabel($xlsRow,0,$count);
                    xlsWriteLabel($xlsRow,2,$account['account_ID']);
                    xlsWriteLabel($xlsRow,4,$account['status']);
                    xlsWriteLabel($xlsRow,6,$account['payment_method']);
                    xlsWriteLabel($xlsRow,8,$account['name']);                    
                    xlsWriteLabel($xlsRow,10,$account['city']);
                    xlsWriteLabel($xlsRow,12,$account['state']);
                    xlsWriteLabel($xlsRow,14,$account['created']);
                    xlsWriteLabel($xlsRow,16,$account['expires']);
                    xlsWriteLabel($xlsRow,20,$account['address']);
                    xlsWriteLabel($xlsRow,22,$account['zip']);
                    xlsWriteLabel($xlsRow,24,$account['division']);
                    if(  strlen(trim($_POST['get_sales_rep'])) >0 ){
                        xlsWriteLabel($xlsRow,26,uNumToName_plain($account['original_sales_person']) );
                     }    
                
                    if(isset($_POST['get_ppg'])){
                        switch($account['payment_method']){
                            case "Jacobson": case "Index":
                                xlsWriteLabel($xlsRow,28,"$account[index_percentage]" );
                            break;
                            case "Per Gallon": case "Normal":
                                xlsWriteLabel($xlsRow,28,"$account[ppg_jacobsen_percentage]" );
                            break;
                            case "O.T.P. Per Gallon":
                                xlsWriteLabel($xlsRow,28,"$account[ppg_jacobsen_percentage] / $account[price_per_gallon]" );
                            break;
                            case "One Time Payment":
                                xlsWriteLabel($xlsRow,28,"$account[ppg_jacobsen_percentage]" );
                            break;
                            case "No Pay": default:
                                xlsWriteLabel($xlsRow,28,0);
                            break;
                        }
                    }
                    
                    if(isset($_POST['percent_full'])){
                        $perc_full = ($act->onsite($account['account_ID'])/$act->barrel_cap($account['account_ID']))*100;
                        xlsWriteLabel($xlsRow,30, number_format($perc_full,2, '.', '') );
                    }

                    if($_POST['full_contact_export']){

                        xlsWriteLabel($xlsRow,32,$account['contact_name']);
                        xlsWriteLabel($xlsRow,34,$account['billing_email']);
                        xlsWriteLabel($xlsRow,36,$account['email_address']);


                    }

                }                
                xlsEOF();
        }
    }
}

?>