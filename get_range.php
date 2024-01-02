<?php
ini_set("display_errors",0);
include "protected/global.php";
$criteria = "";
$account = new Account($_POST['account_no']);

foreach($_POST as $name=>$value){
    switch($name){
        case "from":
            if(strlen($value)>0){
                $arrFields[]=" date_of_pickup >='$value'";
            }
            break;
        case "to":
            if( strlen($value)>0 ){
                $arrFields[]= " date_of_pickup <='$value'";
            }
            break;
    }
    
    if(!empty($arrFields)){
        $criteria = " AND ".implode(" AND ", $arrFields);
    }
}


 $gv = $db->query("SELECT * FROM iwp_data_table WHERE account_no=$_POST[account_no] $criteria ORDER BY date_of_pickup DESC");
 if(count($gv)>0){
    $occurred_once[]="";
                    foreach($gv as $lo){
                        echo "<tr>";
                        echo "<td>$lo[date_of_pickup]</td>";
                        echo "<td>"; 
                            switch($account->payment_method){
                            case "Jacobson": case "Index":
                                echo number_format($account->index_percentage *$ko[0]['percentage'] * 7.56,2);
                            break;
                            default:
                            case "Per Gallon": 
                                echo $account->ppg_jacobsen_percentage;
                            break;
                            case "Normal":
                                echo $account->price_per_gallon;
                            break;
                           case "O.T.P. Per Gallon":
                            $ppgx = number_format($lo['inches_to_gallons']*.25 * $account->price_per_gallon,2);
                            $occurred_oncex[]="";
                            if(!in_array($account->acount_id,$occurred_oncex)){
                                $occurred_oncex[]=$account->acount_id;
                                echo $ppgx + $account->ppg_jacobsen_percentage; 
                            } else {
                                $one_timex = "";
                                echo $ppgx;
                            }
                            break;
                        }
                            
                        echo "</td>";
                        echo "<td>".number_format($lo['inches_to_gallons']*.25,2)."</td>";
                        echo "<td>"; 
                        switch($account->payment_method){
                            case "Jacobson": case "Index":
                                echo number_format($account->index_percentage *$ko[0]['percentage'] * 7.56,2);
                            break;
                            default:
                            case "Per Gallon": 
                                echo $account->ppg_jacobsen_percentage;
                            break;
                            case "Normal":
                                echo $account->price_per_gallon;
                            break;
                           case "O.T.P. Per Gallon":
                            $ppgx = number_format($account->price_per_gallon,2);
                            $occurred_oncex[]="";
                            if(!in_array($account->acount_id,$occurred_oncex)){
                                $occurred_oncex[]=$account->acount_id;
                                echo $ppgx + $account->ppg_jacobsen_percentage; 
                            } else {
                                $one_timex = "";
                                echo $ppgx;
                            }
                            break;
                        }
                    
                     echo"</td>";
                        echo "<td>$account->status</td>";
                        echo "</tr>";
                    }
 }
?>