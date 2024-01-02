<?php

include "protected/global.php";
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
        default :
            return "N/A";
            break;
    }
}

 $result = $db->query("SELECT *
FROM xlogs.iwp_activity
WHERE account =$_GET[account]
AND deleted =0 UNION SELECT * FROM iwp_activity WHERE account= $_GET[account] AND deleted=0 ORDER BY date DESC");
 //echo $_GET['account']."<br/>";
 
 
 
 
?>
<script src="js/jquery-1.11.1.js" type="text/javascript" ></script>
<style type="text/css">
body{
    padding-top:5px;
    padding-left:5px;
    padding-right:5px;
}
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
    text-align:center;
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
<table style="width: 100%;margin:auto;" id="myTable" >

<thead>
<tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">

<td class="cell_label">ID</td>

<td class="cell_label">Date</td>

<td class="cell_label">User</td>

<td class="cell_label">Type</td>

<td class="cell_label">Description</td>



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
