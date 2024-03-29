<?php
include "../protected/global.php";

function get_index(){
    global $db;
    $xo =  $db->query("SELECT date,percentage FROM iwp_jacobsen ORDER BY DATE DESC LIMIT 0,1 ");
    
    if(count($xo)>0){
        return $xo;
    } else {
        return 0;
    }
}

function pickups($account_no){
    global $db;
    global $dbprefix;
    $infox = "0000-00-00|0000-00-00";
    $data_table = $dbprefix."_data_table";
    
    $info = $db->query("SELECT date_of_pickup FROM $data_table WHERE deleted =0 AND account_no = $account_no ORDER BY date_of_pickup DESC");
    if(count($info)>0){
        //latest|first
        $infox = $info[0]['date_of_pickup']."|".$info[count($info)-1]['date_of_pickup'];
    }
    
    return $infox;
}


$picknpay = $db->query($_POST['param']);


/**/

$occurred_once = array();
if(isset($_POST['export'])){
    $ko =get_index();
    switch($_POST['format']){
        case "csv":
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-type: text/csv");
            $fileName = "picknpay".date("Ymdhis").".csv";
            header("Content-Disposition: attachment; filename={$fileName}");
            header("Expires: 0");
            header("Content-Transfer-Encoding: binary");
            header("Pragma: public");
            if(count($picknpay)>0){    
                foreach($picknpay as $pick){
                    $dates  = explode("|", pickups($pick['account_ID']));
                    $dataString .="$pick[account_ID],$pick[status],Biotane,$pick[name],$pick[contact_name],".round($pick['price_per_gallon'],2).",".round($pick['gals'],2).",".round($pick['adj'],2).",";  
                    
                  switch($pick['payment_method']){
                        case "Jacobson":case "Index":
                        $dataString .=  number_format($pick['index_percentage'] *$ko[0]['percentage'] * $pick['adj'],2);
                        break;
                        default:
                        case "Per Gallon":
                        
                        $dataString .= number_format($pick['ppg_jacobsen_percentage']* $pick['adj'],2);
                        case "Normal":
                            $dataString .= number_format($pick['price_per_gallon']* $pick['adj'],2);
                        break;
                       
                        case "O.T.P. Per Gallon":
                            $ppg = number_format($pick['price_per_gallon'] *$pick['adj'],2);
                               
                            if(!in_array($pick['account_ID'],$occurred_once)){
                                $occurred_once[]=$pick['account_ID']; 
                                 $one_time = $pick['ppg_jacobsen_percentage'];
                                $dataString .= $ppg + $pick['ppg_jacobsen_percentage']; 
                            } else {
                                $one_time = "";
                                $dataString .= $ppg;
                            }
                            
                           
                        break;
                    }
                     $dataString.=","; 
            $vu = $db->query("SELECT count(account_no) as cx FROM iwp_data_table WHERE account_no = $pick[account_no]");
            if(count($vu)>0){
                 $dataString .= $vu[0]['cx'];    
            } else {
                 $dataString .= 0;
            }
            
             $dataString .= ",$dates[1],$dates[0],$pick[address],$pick[city],$pick[state],$pick[payment_method],";  
                       switch($pick['payment_method']){
                            case "Jacobson":  case"Index":
                                $dataString.= $pick['index_percentage'].",";
                                break;
                            case "Per Gallon":
                                $dataString.= $pick['ppg_jacobsen_percentage'].",";
                                break;
                            case "Normal":
                                $dataString.= $pick['price_per_gallon'].",";
                                break;
                            case "O.T.P. Per Gallon":
                                $dataString.= $one_time."<br/>".$pick['price_per_gallon'].",";
                                break;
                        }
                     
                     $dataString.= numberToFacility($pick['division']).","; 
                      switch($pick['payment_method']){
                            case "Jacobson":  case"Index":
                                $dataString.= $pick['index_percentage'];
                                break;
                            case "Per Gallon":
                                $dataString.= $pick['ppg_jacobsen_percentage'];
                                break;
                            case "Normal":
                                $dataString.= $pick['price_per_gallon'];
                                break;
                            case "O.T.P. Per Gallon":
                                $dataString.= $one_time."<br/>".$pick['price_per_gallon'];
                                break;
                        }
                     
                     $dataString .=",".$ko[0]['date']."\r\n";
                }
            }
            $fh = @fopen( "php://output", 'w' );
            fwrite($fh, $dataString);
            fclose($fh);
            break;
        case "xls":
            $file = "picknpay".date("YmdHm").".xls";
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
            xlsWriteLabel($xlsRow,0,"ID:");
            xlsWriteLabel($xlsRow,2,"Status:");
            xlsWriteLabel($xlsRow,4,"Payor:"); 
            xlsWriteLabel($xlsRow,6,"Name");
            xlsWriteLabel($xlsRow,8,"Payable");
            xlsWriteLabel($xlsRow,10,"PPG:");
            xlsWriteLabel($xlsRow,12,"Raw Gallons:");
            xlsWriteLabel($xlsRow,14,"Adj Gallons:");            
            
            xlsWriteLabel($xlsRow,16,"Paid");
            xlsWriteLabel($xlsRow,18,"First Pickup");
            xlsWriteLabel($xlsRow,20,"Last Pickup:");
            xlsWriteLabel($xlsRow,22,"Payment Address:");
            xlsWriteLabel($xlsRow,24,"Jacobsen:");
            
            if(count($picknpay)>0){
                foreach($picknpay as $pickups) {
                    $count++;
                    $xlsRow++;
                    $dates = getDates($pickups['account_ID']);
                    
                    xlsWriteLabel($xlsRow,0,$pickups['account_ID']);
                    xlsWriteLabel($xlsRow,2,$pickups['status']);
                    xlsWriteLabel($xlsRow,4,"Biotane");
                    xlsWriteLabel($xlsRow,6,$pickups['name']);
                    xlsWriteLabel($xlsRow,8,$pickups['contact_name']);                    
                    xlsWriteLabel($xlsRow,10,$pickups['price_per_gallon']);
                    xlsWriteLabel($xlsRow,12,round($pickups['gals'],2) );
                    xlsWriteLabel($xlsRow,14,round($pick['adj'],2));
                    xlsWriteLabel($xlsCol,16,round($pick['paid'],2) );
                    xlsWriteLabel($xlsRow,18,$dates[0]['first']);
                    xlsWriteLabel($xlsRow,20,$dates[0]['last']);
                    xlsWriteLabel($xlsRow,22,$pickups['address']);                    
                    xlsWriteLabel($xlsRow,24,$pickups['ppg_jacobsen_percentage']);
                }
            }
            else {
                $xlsRow++; 
                xlsWriteLabel($xlsRow,0,"Empty");
            }                 
            xlsEOF();
            
            break;
        
    }    
}
?>