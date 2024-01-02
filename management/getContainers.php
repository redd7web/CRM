<?php
    ini_set("display_errors",1);
    if(isset($_POST['search_now'])){
         foreach($_POST as $name=>$value){
            switch($name){
                case "container_size":
                    if(strlen($value)>0){
                       $arrFields[] = " container_no = $value";
                    }
                    break;
                    
                case "facility":
                    if($value !="ignore" ){
                       $arrFields[] = " iwp_accounts.division = $value ";
                    }
                break;
                case "delivered":
                    if(strlen($value)>0 || $value !=''){
                        $arrFields[] = " delivery_date= '$value'";   
                    }
                break;
                
                case "accounts":
                     if(strlen($value)>0){
                       $arrFields[] = " account_no = $value ";
                    }
                    break;
                case "service_type":
                    if(strlen($value)>0 && $value !="--"){
                       $arrFields[] = " type_of_service like '%$value%' ";
                    }
                    break;
                
                
                    
            }
        }
        
        if(!empty($arrFields)){
            $criteria = " AND ".implode(" AND ",$arrFields);
        }
        echo "SELECT iwp_utility.*,iwp_accounts.division FROM iwp_utility INNER JOIN iwp_accounts ON iwp_utility.account_no = iwp_accounts.account_ID $criteria";
        $x = $db->query("SELECT iwp_containers.*,iwp_accounts.division FROM iwp_containers INNER JOIN iwp_accounts ON iwp_containers.account_no = iwp_accounts.account_ID $criteria");
    } else {
        $x = $db->query("SELECT iwp_containers.*,iwp_accounts.division FROM iwp_containers INNER JOIN iwp_accounts ON iwp_containers.account_no = iwp_accounts.account_ID");    
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
<tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size: contain;">


<th class="cell_label">loc ID</th>

<th class="cell_label">Location</th>




<th class="cell_label">Delivered</th>

<th class="cell_label">Label</th>


<th class="cell_label">Capacity</th>


<th class="cell_label">Facility</th>


</tr>
</thead>

<tbody>
<?php
if(count($x)>0){
    foreach($x as $list){
        echo "<tr>
            <td>$list[account_no]</td>
            <td>".account_NumToName($list['account_no'])."</td>
            <td>$list[delivery_date]</td>
            <td>".containerNumToName($list['container_no'])."</td>
            <td>". container_amountHolds($list['container_no']) ."</td>
            <td>".numberToFacility($list['division'])."</td>
            
        </tr>";
    }
}
?>

</tbody>
</table>