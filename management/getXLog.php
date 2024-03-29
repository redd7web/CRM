<?php
ini_set("display_errors",1);
function pertain_decode($number){
    switch($number){
        case 2:
            return "Account";
            break;
        case 3:
            return "Issue";
            break;
        case 4:
            return "User";
            break;
        case 5:
            return "Person";
            break;
        case 6:
            return "Oil Pickup";
            break;
        case 7:
            return "Payment Index";
            break;
        case 8:
            return "Routing";
            break;
        case 9:
            return "Container Deletion";
            break;
        default :
            return "N/A";
            break;
    }
}

$activity_table = "xlogs.".$dbprefix."_activity";
$criteria = "";
if(isset($_POST['search_now'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "users":
                if(strlen($value) >0){
                    $arrFields[] = " iwp_activity.user = ". $value;
                }
            break;
            case "ttype":
                if($value >0){
                    $arrFields[] = " iwp_activity.type = ".$value;
                }
            break;
            
            case "from":
                if(strlen($value)>0){
                    $arrFields[] = " DATE(iwp_activity.date) >= '".$value."'";
                }
            break;
            case "to":
                if(strlen($value)>0){
                    $arrFields[] = " (iwp_activity.date) <= '".$value."'";
                }
            break;
            case "related_table":
                if(strlen($value)>0){
                    $arrFields[] = "iwp_activity.pertains = ".$value;
                }
            break;
            case "account_no":
                if(strlen(trim($value))>0){
                    $arrFields[] = " AND (accounts = ".$value." OR descript like %'$value'%)";
                }
            break;
        }
    }
    
    if(!empty($arrFields)){
        $criteria = " AND ".implode(" AND ",$arrFields);
    }
    $search = "SELECT * FROM iwp_activity WHERE iwp_activity.deleted =0 AND MONTH(date) = '".date("m")."' AND YEAR(date)='".date("Y")."' $criteria UNION SELECT * FROM xlogs.iwp_activity WHERE iwp_activity.deleted =0 AND MONTH(date) = '".date("m")."' AND YEAR(date)='".date("Y")."'".$criteria;
    echo $search;
    $result = $db->query($search);
} else {
    $ov = "SELECT * FROM iwp_activity WHERE iwp_activity.deleted =0 AND MONTH(date) = '".date("m")."' AND YEAR(date)='".date("Y")."' UNION SELECT * FROM xlogs.iwp_activity WHERE iwp_activity.deleted =0 AND MONTH(date) = '".date("m")."' AND YEAR(date)='".date("Y")."'";
    echo $ov;
    $result = $db->query($ov);
    
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

<td class="cell_label">ID</td>

<td class="cell_label">Date</td>

<td class="cell_label">User</td>

<td class="cell_label">Type</td>

<td class="cell_label">Description</td>

<td class="cell_label">Account</td>

<td class="cell_label">Pertaining To</td>

</tr>
</thead>
<tbody>
<?php
if(count($result)>0){
    foreach($result as $xlog){
        echo "<tr>";
            echo "<td>$xlog[transID]</td>";
            echo "<td>$xlog[date]</td>";
            echo "<td>".uNumToName($xlog['user'])."</td>";
            echo "<td>$xlog[actionType]</td>";
            echo "<td>$xlog[descript]</td>";
            echo "<td>"; 
            if($xlog['account'] !=NULL){
              echo  account_NumtoName($xlog['account']);
            }
            echo"</td>";            
            echo "<td>".pertain_decode($xlog['pertains'])."</td>";
        echo "</tr>";
    }    
}
?>
</tbody>
</table>
<script>
$(".ikg_form").click(function(){
    $(this).submit();
});
</script>