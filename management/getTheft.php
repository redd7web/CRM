<?php
$data_table = $dbprefix."_data_table";

if(isset($_POST['search_now'])){
    echo "POST!<br/>";
    foreach($_POST as $name=>$value){
        switch($name){
            case "friendly":
                if($value !="null"){
                    $arrFields[] = "iwp_accounts.friendly = '$value'";
                }
            break;
            case "from":
                if(strlen($value)>0 && isset($value)){
                    $arrFields[] = " iwp_data_table.date_of_pickup >= '$value'";   
                }
                break;
            case "to":
                if(strlen($value)>0 && isset($value)){
                    $arrFields[] = " iwp_data_table.date_of_pickup >= '$value'";
                }
                break; 
        }
    }
    $criteria="";
    
    if(!empty($arrFields)){
        $criteria = " AND ".implode(" AND ",$arrFields);
    }
    
    $ask = "SELECT distinct account_no,pickup_frequency,barrel_capacity,division,city,state,Name,ticks_per_day * pickup_frequency as expected,	fieldreport,notes FROM $data_table LEFT JOIN iwp_accounts ON $data_table.account_no = iwp_accounts.account_ID WHERE deleted =0 AND inches_to_gallons = 0 AND  zero_gallon_reason in (52,54) ".$criteria;
    echo $ask;
    $result = $db->query($ask);
} else {
    $ask = "SELECT distinct account_no,pickup_frequency,barrel_capacity,division,city,state,Name,ticks_per_day * pickup_frequency as expected,	fieldreport,notes FROM $data_table LEFT JOIN iwp_accounts ON $data_table.account_no = iwp_accounts.account_ID  WHERE deleted =0 AND inches_to_gallons=0 AND zero_gallon_reason in (52,54)";
    //echo $ask;
    $result =$db->query($ask);
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
<table style="width: 100%;margin:auto;" id="myTable" >
<thead>



<tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
<th class="cell_label">ID</th>

<th class="cell_label">Name</th>


<th class="cell_label">Facility</th>




<th class="cell_label">City</th>



<th class="cell_label">State</th>

<th class="cell_label"><span title="Oil Theft Flag is set">Flag</span></th>


<th class="cell_label"><span title="A note references Oil Theft">Note</span></th>


<th class="cell_label"><span title="A pickup comment references Oil Theft">Pickup Comment</span></th>

<th class="cell_label"><span title="Several Oil Pickups of 0 gallons">0 Gallons</span></th>



<th class="cell_label"><span title="Total containment on site in gallons">Capacity</span></th>

<th class="cell_label"><span title="Service frequency in days">Freq</span></th>

<th class="cell_label"><span title="Avg Gallons Per Month">GPM</span></th>

<th class="cell_label"><span title="Average Gallons Per Pickup">AGPP</span></th>


</tr>
</thead>

<tbody>
<?php

if(count($result)>0){
    $account = new Account();
    
    foreach($result as $thefts){
        echo"<tr>";
        echo "<td>$thefts[account_no]</td>";
        echo "<td>$thefts[Name]</td>";
        echo "<td>".numberToFacility($thefts['division'])."</td>";
        echo "<td>$thefts[city]</td>";
        echo "<td>$thefts[state]</td>";
        echo "<td>&nbsp;</td>";//flag
        echo "<td>$thetfs[notes]</td>";//note
        echo "<td>$thefts[field_report]</td>";//pickup comments
        echo "<td>". $account->countZeroPickups($thefts['account_no'])."</td>";//0 gallons
        echo "<td>$thefts[barrel_capacity]</td>";
        echo "<td>$thefts[pickup_frequency]</td>";
        echo "<td>".number_format($thefts['expected'],2)."</td>";
        echo "<td>". number_format($account->gpp($thefts['account_no']),2)."</td>";
        echo"</tr>";
    }
    
}
?>
</tbody>
</table>


