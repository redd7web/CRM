<?php
include "../protected/global.php";
ini_set("display_errors",0);
function plain($account_no){
    global $db;
    $ret = $db->query("SELECT name FROM iwp_accounts WHERE account_ID = $account_no");
    return $ret[0]['name'];
}

function name_plain($user_id){
    global $db;
    $ret = $db->query("SELECT first,last FROM iwp_users WHERE user_id = $user_id");
    return $ret[0]['first']." ".$ret[0]['last'];
}


$picknpay = $db->query($_POST['param']);
$dataString="";
if(isset($_POST['export_now'])){
    switch($_POST['format']){
        case "csv":
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-type: text/csv");
            $fileName = "grease_trap_export".date("Ymdhis").".csv";
            header("Content-Disposition: attachment; filename={$fileName}");
            header("Expires: 0");
            header("Content-Transfer-Encoding: binary");
            header("Pragma: public");
          
            if(count($picknpay)>0){                
                foreach($picknpay as $pick){
                    switch($_POST['my_group']){
                        case "account_rep":
                        $dataString .=name_plain($pick['account_rep']).",";
                        break;
                        case "division":
                            $dataString .=numberToFacility($pick['division']).",";
                        break;
                        case "original_sales_person":
                            $dataString .=name_plain($pick['original_sales_person']).",";
                        break;
                        default:
                    }
                    $dataString .="$pick[account_no],";
                    $dataString .=plain($pick['account_no']).",";           
                    $dataString .="$pick[address],";
                    $dataString .="$pick[city],";
                    $dataString .="$pick[state],";
                    $dataString .="$pick[ppg],";
                    $dataString .=number_format($pick['paid'],2).",";
                    switch($_POST['my_group']){
                        case "account_ID": case "division": case "account_rep":case "original_sales_person":
                            $dataString .="$pick[num],";
                        break;
                        default:
                          
                    }
                    $dataString .="$pick[grease_volume],";
                    $dataString .=round("$pick[inches_to_gallons]",2).",";
                    switch($_POST['my_group']){
                         case "account_ID": case "division": case "account_rep":case "original_sales_person":
                            $dataString .=number_format($summary['avg'],2).",";
                         break;
                         default:
                        $ui = $db->query("SELECT AVG(inches_to_gallons) as avx FROM iwp_grease_data_table WHERE account_no = $pick[account_no]");
                        if(count($ui)>0){
                            $dataString .=$ui[0]['avx'].",";
                        } else {
                            $dataString .="0,";
                        }
                         break;
                    }
                    $dataString .="$pick[date_of_pickup],";
                    $dataString .=numberToFacility("$pick[division]")."\r\n";
                }
                $fh = @fopen( "php://output", 'w' );
                fwrite($fh, $dataString);
                fclose($fh);
            }
        break;
        case "xls":
            $file = "grease_trap_export".date("YmdHm").".xls";
            include "../protected/xlsfunctions.php";
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");           
            header("Content-Disposition: attachment;filename=$file");
            header("Content-Transfer-Encoding: binary "); 
            $xlsRow = 0;
            $xlsCol = 0;
              xlsBOF();
            switch($_POST['my_group']){
                case "account_rep":
                    xlsWriteLabel($xlsRow,0,"Account Rep:");
                break;
                case "division":
                    xlsWriteLabel($xlsRow,0,"Facility:");
                break;
                case "original_sales_person":
                    xlsWriteLabel($xlsRow,0,"Original Sales Person:");
                break;
                default:
                    xlsWriteLabel($xlsRow,0," ");
                break;
             }
             xlsWriteLabel($xlsRow,2,"Act ID");
             xlsWriteLabel($xlsRow,4,"Acct Name");
             xlsWriteLabel($xlsRow,6,"City");
             xlsWriteLabel($xlsRow,8,"State");
             xlsWriteLabel($xlsRow,10,"Paid");
             switch($_POST['my_group']){
                case "account_ID": case "division": case "account_rep":case "original_sales_person":
                    xlsWriteLabel($xlsRow,12,"Pickups");
                    break;
                default:
                    xlsWriteLabel($xlsRow,12," ");
                    break;
             }
               xlsWriteLabel($xlsRow,14,"Size");
               xlsWriteLabel($xlsRow,16,"Gallons");
               xlsWriteLabel($xlsRow,18,"GPP");
               xlsWriteLabel($xlsRow,20,"Date of pickup");
               xlsWriteLabel($xlsRow,22,"Facility");
            
           
             if(count($picknpay)>0){
                foreach($picknpay as $pickups) {
                    $count++;
                    $xlsRow++;
                     switch($_POST['my_group']){// grouped ?
                        case "account_rep":
                             xlsWriteLabel($xlsRow,0,$pickups['account_rep']);
                        break;
                        case "division":
                            xlsWriteLabel($xlsRow,0,numberToFacility($pickups['division']));
                        break;
                        case "original_sales_person":
                            xlsWriteLabel($xlsRow,0,name_plain($pickups['original_sales_person']));                            
                        break;
                        default:
                            xlsWriteLabel($xlsRow,0," ");
                        break;
                     } 
                     xlsWriteLabel($xlsRow,2,"$pickups[account_no]");
                     xlsWriteLabel($xlsRow,4,plain($pickups['account_no']));
                     xlsWriteLabel($xlsRow,6,"$pickups[city]");
                     xlsWriteLabel($xlsRow,8,"$pickups[state]");
                     xlsWriteLabel($xlsRow,10,number_format("$pickups[paid]",2));
                     switch($_POST['my_group']){
                        case "account_ID": case "division": case "account_rep":case "original_sales_person":
                            xlsWriteLabel($xlsRow,12,"$pickups[num]");
                        break;
                        default:
                            xlsWriteLabel($xlsRow,12,"");
                        break;
                     }
                     xlsWriteLabel($xlsRow,14,"$pickups[grease_volume]");
                     xlsWriteLabel($xlsRow,16,round("$pickups[inches_to_gallons]",2) );
                     
                     switch($_POST['my_group']){
                         case "account_ID": case "division": case "account_rep":case "original_sales_person":
                             xlsWriteLabel($xlsRow,18,number_format($pickups['avg'],2));
                         break;
                         default:
                            $ui = $db->query("SELECT AVG(inches_to_gallons) as avx FROM iwp_grease_data_table WHERE account_no = $pickups[account_no]");
                            if(count($ui)>0){
                                 xlsWriteLabel($xlsRow,18,$ui[0]['avx']);
                            } else {
                                xlsWriteLabel($xlsRow,18,0);
                            }
                         break;
                    }
                    xlsWriteLabel($xlsRow,20,"$pickups[date_of_pickup]" );
                    xlsWriteLabel($xlsRow,22,numberToFacility("$pickups[division]") );
                }
             }else {
                $xlsRow++; 
                xlsWriteLabel($xlsRow,0,"Empty");
             }   
            xlsEOF();
            break;
    }    
}

?>