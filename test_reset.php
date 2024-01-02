<?php
include "protected/global.php";

$data_table = $dbprefix."_data_table";
echo $_GET['route_id']."<br/>";
$date = date("Y-m-d H:i:s");

$skip_reasons = array(
    10,
    12    
);

$req = $db->query("SELECT * FROM `iwp_data_table` WHERE route_id =$_GET[route_id] GROUP BY schedule_id");
$count =0;
$tot = 0;
$avg =0;
$nums ="";


if(count($req)>0){
    foreach($req as $stops){        
        echo "schedule id: ".$stops['schedule_id']." date of pickup: ".$stops['date_of_pickup']." account number: ".$stops['account_no']."<br/>";
        //echo "<pre>";
        $ant = new Account($stops['account_no']);
        
        
        $nums .=$stops['account_no']."|";
        $tot +=$stops['sum'];
        $avg +=$stops['avg_exp'];
        $count++;
        
        
        if( !in_array($stops['zero_gallon_reason'],$skip_reasons) || $stops['inches_to_gallons'] == 0.00 || $stops['inches_to_gallons'] == null ){
            echo "UPDATE iwp_accounts SET avg_gallons_per_Month=0 WHERE account_ID = $stops[account_no]<br/>";
            //$db->query("UPDATE iwp_accounts SET avg_gallons_per_Month=0 WHERE account_ID = $stops[account_no]");//reset account oil guage back to 0    
        }else{
           echo "$stops[zero_gallon_reason] NO RESET<br/>";  
        }
        
        
    } 
}
?>