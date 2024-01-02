<style type="text/css">
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<?php
include "protected/global.php";
$ikg = new IKG($_GET['route_id']);





$pickups = $db->query("SELECT DISTINCT iwp_data_table.account_no,iwp_accounts.friendly,iwp_accounts.name,iwp_data_table.sum FROM iwp_data_table LEFT JOIN iwp_accounts ON iwp_data_table.account_no = iwp_accounts.account_ID WHERE route_id=$_GET[route_id] AND (iwp_accounts.friendly IS NULL OR iwp_accounts.friendly like '%null%')");




/*
echo "<pre>";
print_r($ikg->unique_friendly);
echo"</pre>";
*/

?>
<table style="float: left;margin-right:50px;border-collapse:collapse;margin-bottom:50px;">
<tr><td colspan="3" style="text-align: center;">IWP Accounts</td></tr>
<tr><td colspan="3"><?php echo "Number of stops for IWP picked up: ".count($pickups); ?></td></tr>
<tr><td style="width: 30px;;">Account Number</td><td>Account Name</td><td>Gallons</td></tr>
<?php
if(count($pickups)>0){
    foreach($pickups as $stops){
        $total_gals +=$stops['sum'];
        echo "<tr><td>$stops[account_no]</td><td>$stops[name]</td><td style='text-align:right;'>$stops[sum]</td></tr>";
    }
}
?>
<tr><td colspan="2"  style="border-top: 1px solid black;">Total</td><td  style='text-align:right;border-top: 1px solid black;'><?php echo number_format($total_gals,2); ?></td></tr>
</table>


<?php

$distinct_friendlies = $db->query("SELECT DISTINCT iwp_accounts.friendly,iwp_scheduled_routes.route_id,iwp_scheduled_routes.account_no FROM iwp_scheduled_routes LEFT JOIN iwp_accounts ON iwp_accounts.account_ID = iwp_scheduled_routes.account_no WHERE iwp_scheduled_routes.route_id = $_GET[route_id] AND iwp_accounts.friendly IS NOT NULL AND iwp_accounts.friendly !='null' GROUP BY iwp_accounts.friendly");

if(count($distinct_friendlies)>0){
    foreach($distinct_friendlies as $distinct){
            //echo "SELECT DISTINCT iwp_data_table.account_no,iwp_accounts.friendly,iwp_accounts.name,iwp_data_table.sum FROM iwp_data_table LEFT JOIN iwp_accounts ON iwp_data_table.account_no = iwp_accounts.account_ID WHERE route_id=$_GET[route_id] AND friendly IS NOT NULL AND iwp_accounts.friendly ='$distinct[friendly]' GROUP BY iwp_data_table.account_no<br/>";
            $pickupss = $db->query("SELECT DISTINCT iwp_data_table.account_no,iwp_accounts.friendly,iwp_accounts.name,iwp_data_table.sum FROM iwp_data_table LEFT JOIN iwp_accounts ON iwp_data_table.account_no = iwp_accounts.account_ID WHERE route_id=$_GET[route_id] AND friendly IS NOT NULL AND iwp_accounts.friendly ='$distinct[friendly]' GROUP BY iwp_data_table.account_no");

?>


<?php
if(count($pickupss)>0){
    $total_galsx= 0;
    ?>
    <table style="float: left;border-collapse:collapse;margin-right:50px;margin-bottom:50px;">
    <tr><td colspan="3" style="text-align: center;"><?php echo $distinct['friendly']; ?></td></tr>
    <tr><td colspan="3"><?php echo "Number of stops for Friendly picked up: ".count($pickupss); ?></td></tr>
    <tr><td  style="width: 30px;;">Account Number</td><td>Account Name</td><td>Gallons</td></tr>
    <?php
    foreach($pickupss as $stopsx){
        $total_galsx +=$stopsx['sum'];
        echo "<tr><td>$stopsx[account_no]</td><td>$stopsx[name]</td><td style='text-align:right;'>$stopsx[sum]</td></tr>";
    }
    ?>
    <tr><td colspan="2" style="border-top: 1px solid black;">Total</td><td  style='text-align:right;border-top: 1px solid black;'><?php echo number_format($total_galsx,2); ?></td></tr>
</table>
    <?php
}
?>

        
        <?php
    }
}



