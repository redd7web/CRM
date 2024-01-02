<?php
ini_set("display_errors",0);
$data_table = $dbprefix."_grease_data_table";
$account_table = $dbprefix."_accounts";
$criteria = "";

if(isset($_POST['search_now'])){
   foreach($_POST as $name=>$value){
        switch($name){
             case "from":
                if(strlen($value)>0){
                    $arrFields[] = " date_of_pickup >= '".$_POST['from']."'";
                }
                break;
            case "to":
                if(strlen($value)>0){
                    $arrFields[] = " date_of_pickup  <= '".$_POST['to']."'";
                }
                break;
            case "account_rep":
                if(strlen($value)>0){
                    $arrFields[]= " account_rep = $value";
                    //$names = " account_rep = $value";
                } 
                break; 
            case "salesrep":
                if(strlen($value)>0){
                    $arrFields[]= " original_sales_person = $value";
                    //$names .= " original_sales_person = $value";
                }
                break;
            case "friendly":
                if($value !="null"){
                    $arrFields[] = "friendly like '%$value%'";   
                }
                break;
            case "facility":
                if($value !="ignore"){
                    $arrFields[] = "iwp_accounts.division = $value";
                }else  if ( $value == 99){
                    $arrFields[] = "iwp_accounts.division in (24,30,31,32,33)";
                } 
            break;
        }
   } 
   
   
   
   if(!empty($arrFields)){
        $criteria = " AND ".implode (" AND ",$arrFields);
   }
   
   if($_POST['my_group'] !="-"){
     switch($_POST['my_group']){
        case "account_rep":
            $format = "SELECT 
                            iwp_users.user_id, 
                            iwp_grease_data_table.account_no, 
                            COUNT( * ) AS count, 
                            SUM( iwp_grease_data_table.inches_to_gallons ) AS inches_to_gallons, 
                            AVG( iwp_grease_data_table.inches_to_gallons ) AS avg, 
                            iwp_accounts.account_ID, 
                            iwp_accounts.address, 
                            iwp_accounts.city, 
                            iwp_accounts.state, 
                            iwp_accounts.previous_provider, 
                            iwp_accounts.division,
                            iwp_accounts.original_sales_person,
                            iwp_accounts.account_rep, 
                            iwp_accounts.grease_ppg, 
                            iwp_accounts.grease_volume, 
                            COUNT(account_no) as num, 
                            SUM( iwp_grease_data_table.inches_to_gallons ) * iwp_accounts.grease_ppg as paid  FROM iwp_grease_data_table INNER JOIN iwp_accounts ON iwp_grease_data_table.account_no = iwp_accounts.account_ID INNER JOIN iwp_users ON iwp_accounts.account_rep = iwp_users.user_id WHERE iwp_grease_data_table.deleted =0  $criteria GROUP BY iwp_accounts.account_rep";
            //echo $format;    
        break;
        case "division":
            $format =  "SELECT 
                            DISTINCT iwp_accounts.division, 
                            iwp_grease_data_table.account_no, COUNT( * ) AS count, 
                            SUM( iwp_grease_data_table.inches_to_gallons ) AS inches_to_gallons, 
                            AVG( iwp_grease_data_table.inches_to_gallons ) AS avg,
                            iwp_grease_data_table.account_no, 
                            iwp_grease_data_table.inches_to_gallons, 
                            iwp_grease_data_table.date_of_pickup, 
                            iwp_accounts.account_ID, 
                            iwp_accounts.address, 
                            iwp_accounts.city, 
                            iwp_accounts.state,
                            iwp_accounts.original_sales_person,
                            iwp_accounts.account_rep,
                            iwp_accounts.grease_ppg, 
                            iwp_accounts.grease_volume, 
                            COUNT(account_no) as num, 
                            SUM( iwp_grease_data_table.inches_to_gallons ) * iwp_accounts.grease_ppg as paid  FROM iwp_grease_data_table INNER JOIN iwp_accounts ON iwp_grease_data_table.account_no = iwp_accounts.account_ID INNER JOIN iwp_users ON iwp_accounts.account_rep = iwp_users.user_id  WHERE iwp_grease_data_table.deleted =0 $criteria  GROUP BY iwp_accounts.division";
        break;
        case "original_sales_person":
            $format =  "SELECT
                        DISTINCT iwp_accounts.original_sales_person, 
                        iwp_grease_data_table.account_no, 
                        COUNT( * ) AS count, 
                        SUM( iwp_grease_data_table.inches_to_gallons ) AS inches_to_gallons, 
                        SUM( iwp_grease_data_table.inches_to_gallons ) * iwp_accounts.grease_ppg as paid,
                        AVG( iwp_grease_data_table.inches_to_gallons ) AS avg,
                        iwp_grease_data_table.account_no, 
                         iwp_grease_data_table.inches_to_gallons, 
                         iwp_grease_data_table.date_of_pickup, 
                        iwp_accounts.account_ID, 
                        iwp_accounts.address, 
                        iwp_accounts.city, 
                        iwp_accounts.state, 
                        iwp_accounts.division,                       
                        iwp_accounts.account_rep,
                        iwp_accounts.grease_ppg, 
                        iwp_accounts.grease_volume, 
                        COUNT(account_no) as num
                        FROM iwp_grease_data_table INNER JOIN iwp_accounts ON iwp_grease_data_table.account_no = iwp_accounts.account_ID INNER JOIN iwp_users ON iwp_accounts.account_rep = iwp_users.user_id  WHERE iwp_grease_data_table.deleted =0 $criteria  GROUP BY iwp_accounts.original_sales_person";
        break;
        case "account_ID":
            $format =  "SELECT 
                        DISTINCT iwp_grease_data_table.account_no, 
                        SUM(iwp_grease_data_table.inches_to_gallons) as inches_to_gallons, 
                        SUM(iwp_grease_data_table.inches_to_gallons) * iwp_accounts.grease_ppg as paid,
                        AVG(iwp_grease_data_table.inches_to_gallons) as avg,
                        iwp_grease_data_table.account_no, 
                        iwp_grease_data_table.inches_to_gallons, 
                        iwp_grease_data_table.date_of_pickup,
                        iwp_accounts.account_ID, 
                        iwp_accounts.address, 
                        iwp_accounts.city, 
                        iwp_accounts.state, 
                        iwp_accounts.previous_provider, 
                        iwp_accounts.division,
                        iwp_accounts.grease_ppg, 
                        iwp_accounts.grease_volume,
                        COUNT(account_no) as num 
                         FROM iwp_grease_data_table LEFT JOIN iwp_accounts ON iwp_grease_data_table.account_no = iwp_accounts.account_ID WHERE iwp_grease_data_table.deleted =0 $criteria GROUP BY iwp_grease_data_table.account_no";
        break;
        
     }
   } else {
        $format = "SELECT 
                iwp_grease_data_table.account_no, 
                iwp_grease_data_table.inches_to_gallons, 
                iwp_grease_data_table.date_of_pickup,
                iwp_grease_data_table.ppg,
                iwp_accounts.account_ID, 
                iwp_accounts.address, 
                iwp_accounts.city, 
                iwp_accounts.state,
                iwp_accounts.division,
                iwp_accounts.grease_ppg, 
                iwp_accounts.grease_volume,
                iwp_grease_data_table.inches_to_gallons * iwp_accounts.grease_ppg as paid FROM iwp_grease_data_table LEFT JOIN iwp_accounts ON iwp_grease_data_table.account_no = iwp_accounts.account_ID WHERE iwp_grease_data_table.deleted =0 $criteria";
   }
   
   echo $format."<br>";
   
   $request = $db->query($format);
    
}else {    
    $format = "SELECT 
                iwp_grease_data_table.account_no, 
                iwp_grease_data_table.inches_to_gallons, 
                iwp_grease_data_table.date_of_pickup,
                iwp_grease_data_table.ppg,
                iwp_accounts.account_ID, 
                iwp_accounts.address, 
                iwp_accounts.city, 
                iwp_accounts.state,
                iwp_accounts.division,
                iwp_accounts.grease_ppg, 
                iwp_accounts.grease_volume,
                iwp_grease_data_table.inches_to_gallons * iwp_accounts.grease_ppg as paid FROM iwp_grease_data_table LEFT JOIN iwp_accounts ON iwp_grease_data_table.account_no = iwp_accounts.account_ID WHERE iwp_grease_data_table.deleted =0";
    //echo $format;
    $request = $db->query($format);
}

?>
<style type="text/css">
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}

td{
    background:transparent;
    border:0px solid #bbb;  
    padding:0px 0px 0px 0px;  
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script> 

<table style="width: 30%;margin:auto;">
<?php 
if(isset($_POST['search_now'])){
    ?>
    <tr><td><form target="_blank" method="post" action="management/export_grease.php">Export</td><td><select name="format"><option value="csv">CSV</option><option value="xls">XLS</option></select><input type="hidden"  name="param" value="<?php echo $format ?>" readonly=""/></td><td><input type="submit" name="export_now"/><input type="hidden" name="my_group" value="<?php echo $_POST['my_group']; ?>" readonly=""/></form></td></tr>
    <?php
}else{
    ?>
    
<tr><td colspan="3" style="text-align: center;color:red;">Please search your criteria first, choose an export format then click export.</td></tr>
    <?php
}
?>

</table>
        
<table  style="width: 100%;margin:auto;margin-top:10px;margin-bottom:10px;"><tr><td style="height: 10px;">
<?php 

$allxx = "SELECT SUM(iwp_grease_data_table.inches_to_gallons) as bigbucket, COUNT(iwp_grease_data_table.inches_to_gallons) as num ,iwp_accounts.account_rep,iwp_accounts.account_ID FROM $data_table INNER JOIN iwp_accounts ON iwp_grease_data_table.account_no = iwp_accounts.account_ID WHERE iwp_grease_data_table.deleted =0 " .$criteria;
//echo "<br/>".$allxx."<br/>";

$all = $db->query($allxx);
?>
</td></tr><tr><td style="text-align: center;">
<?php


if(count($all)>0){
    foreach($all as $answer){
        echo "<span style='font-weight:bold;font-size:24px;'>Total Gallons :".round($answer['bigbucket'],2)."</span><br/><br/>";
        echo "<span style='font-weight:bold;font-size:24px;'>Total Pickups :".$answer['num']."</span>";
    }
}

  
    

?>
</td></tr></table>        
        
<table style="width: 100%;margin:auto;" id="myTable" >
<thead>
<tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
<?php
if(isset($_POST['search_now'])){
    if($_POST['my_group'] !="-" && isset($_POST['my_group']) ){
         switch($_POST['my_group']){
            case "account_rep":
                echo "<th class='cell_label'>Account Rep</th>";
            break;
            case "division":
                echo "<th class='cell_label'>Facility</th>";
            break;
            case "original_sales_person":
                echo "<th class='cell_label'>Original Sales Person</th>";
            break;
         }
   } 
}

?>

<th class="cell_label">Act ID</th>

<th class="cell_label">Acct Name</th>


<th class="cell_label">Loc Address</th>

<th class="cell_label">City</th>

<th class="cell_label">State</th>
<th class="cell_label">PPG</th>
<th class="cell_label">Paid</th>
<?php
     switch($_POST['my_group']){
        case "account_ID": case "division": case "account_rep":case "original_sales_person":
            echo "<th class='cell_label'>Pickups</th>";
            break;
     }   

?>



<th class="cell_label">Size</th>
<th class="cell_label">Gallons</th>

<th class="cell_label"><span title="Average Gallons per Pickup">GPP</span></th>
<th class="cell_label">Date of pickup</th>
<th class="cell_label">Facility</th>
    
</tr>
</thead>
<tbody>
<?php 
if(count($request)>0){
    foreach($request as $summary){
        
        echo"<tr>";
            if(isset($_POST['search_now'])){
                 switch($_POST['my_group']){
                    case "account_rep":
                        echo "<th class='cell_label'>".uNumToName($summary['account_rep'])."</th>";
                    break;
                    case "division":
                        echo "<th class='cell_label'>".numberToFacility($summary['division'])."</th>";
                    break;
                    case "original_sales_person":
                        echo "<th class='cell_label'>".uNumToName($summary['original_sales_person'])."</th>";
                    break;
                 }
            }

            
            
                echo "<td>$summary[account_no]</td>";
                echo "<td>".account_NumToName($summary['account_no'])."</td>";           
                echo "<td>$summary[address]</td>";
                echo "<td>$summary[city]</td>";
                echo "<td>$summary[state]</td>";
                echo "<td>$summary[ppg]</td>";
                echo "<td>".number_format($summary['paid'],2)."</td>";
           
                switch($_POST['my_group']){
                    case "account_ID": case "division": case "account_rep":case "original_sales_person":
                        echo "<td>$summary[num]</td>";
                    break;
                }
            
            echo "<td>$summary[grease_volume]</td>";
            echo "<td>".round("$summary[inches_to_gallons]",2)."</td>";
            echo "<td>"; 
                switch($_POST['my_group']){
                     case "account_ID": case "division": case "account_rep":case "original_sales_person":
                        echo number_format($summary['avg'],2);
                     break;
                     default:
                    $ui = $db->query("SELECT AVG(inches_to_gallons) as avx FROM iwp_grease_data_table WHERE account_no = $summary[account_no]");
                    if(count($ui)>0){
                        echo number_format($ui[0]['avx'],2);
                    } else {
                        echo 0;
                    }
                     break;
                }
                
            echo "</td>";
            echo "<td>$summary[date_of_pickup]</td>";
            echo "<td>".numberToFacility("$summary[division]")."</td>";
           
            
           
        echo "</tr>";
    }
}    

?>
</tbody>
</table>
<table style="width: 30%;margin:auto;">
<?php 
if(isset($_POST['search_now'])){
    ?>
    <tr><td><form target="_blank" method="post" action="management/export_grease.php">Export</td><td><select name="format"><option value="csv">CSV</option><option value="xls">XLS</option></select><input type="hidden"  name="param" value="<?php echo $format ?>" readonly=""/></td><td><input type="submit" name="export_now"/><input type="hidden" name="my_group" value="<?php echo $_POST['my_group']; ?>" readonly=""/></form></td></tr>
    <?php
}else{
    ?>
    
<tr><td colspan="3" style="text-align: center;color:red;">Please search your criteria first, choose an export format then click export.</td></tr>
    <?php
}
?>

</table>