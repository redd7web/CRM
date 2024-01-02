<?php
include "/var/www/html/protected/global.php";
$containerslist = $dbprefix."_list_of_containers";
$accounts_container = $dbprefix."_containers";
//chmod(basename($_SERVER['PHP_SELF']),777);
$account = new Account();

$all = $db->where("route_status","scheduled")->get($dbprefix."_scheduled_routes","account_no,scheduled_start_date,schedule_id");



if(count($all)>0){
    foreach($all as $single){
        $ask = "SELECT $containerslist.* , $accounts_container.* FROM `$containerslist` INNER JOIN $accounts_container ON $containerslist.container_id = $accounts_container.container_no WHERE $accounts_container.account_no =".$single['account_no'];
        $oil_onsite = $account->singleField($single['account_no'],"avg_gallons_per_Month");
        
        $ask_barrel = $db->query($ask);
        echo "account $single[account_no]<br/>";
        if(count($ask_barrel)>0){
            $sum = 0;
            foreach($ask_barrel as $container){                
                $sum = $sum + $container['amount_holds'];                
                echo $container['container_label']." ".$container['amount_holds']." oil on site". $account->singleField(($single['account_no']),"avg_gallons_per_Month")." scheduled start date: $single[scheduled_start_date]<br/>";
            }
            
            
            if($sum >=0){
                $percent =  ($oil_onsite/$sum) *100;
                echo "percent full : ". round($percent,2);
                $now = date("Y-m-d H:i:s");
                if($percent >=75 || $single['scheduled_start_date'] < "$now"){
                    echo "<br/>Account is code red status";
                    /**/$package = array(
                        "code_red"=>1
                    );
                    echo "update status: ".$db->where("schedule_id",$single['schedule_id'])->where("account_no",$single['account_no'])->update($dbprefix."_scheduled_routes",$package);
                }
            } else {
                echo "No assigned Barrels onsite";
            }
            
        }
        echo "<br/><br/>";
        
    }    
}


?>