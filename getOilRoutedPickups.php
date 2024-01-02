<?php
ini_set("display_errors",1);



$oil_routed_table = $dbprefix."_list_of_routes";
$string = "";
$rddtn ='';
if($person->isFriendly()){
    $rddtn = " AND route_id IN ( SELECT iwp_scheduled_routes.route_id FROM iwp_scheduled_routes LEFT JOIN iwp_accounts ON iwp_scheduled_routes.account_no  = iwp_accounts.account_ID WHERE  1  AND iwp_accounts.friendly like '%$person->first_name%' ) ";
}else if( $person->isCoWest() ){
    $rddtn = "AND facility=15";
}


if(isset($_POST['search_now'])){
   
    foreach($_POST as $name=>$value){
        
        switch($name){
             case "rtitle":
                if(strlen($_POST['rtitle']) && isset($_POST['rtitle'])){
                    $value = trim($value);
                    $arrFields[] = " ikg_manifest_route_number like '%$value%'";
                }
                break;
            case "rid":
                if(isset($_POST['rid']) AND strlen($_POST['rid'])>0){
                    $arrFields[] = " route_id = $value";
                }
                break;
            case "status_id":
                if(isset($_POST['status_id']) && $value !="all"){
                    $arrFields[]= " status = '$value'";
                }
            break;
            case "facility":
                if($_POST['facility'] !='ignore'){
                    $arrFields[]= " facility = $value";
                }
                break;
            case "drivers":
                if($_POST['drivers'] !="-"){
                    $arrFields[] = " driver = $value";
                }
                break;
        }
    }
    
    if(!empty($arrFields)){
         $string = " AND ".implode(" AND ",$arrFields);
         
         
    } 
   $query = "SELECT * FROM $oil_routed_table WHERE  $oil_routed_table.deleted =0 ".$string." $rddtn order by created_date DESC";
   echo $query."<br/>";
   $result = $db->query($query);
    
} else {
    echo "SELECT * FROM $oil_routed_table  WHERE $oil_routed_table.deleted =0 AND $oil_routed_table.status IN ('enroute','scheduled') $rddtn order by created_date  DESC ";  
   $result = $db->query("SELECT * FROM $oil_routed_table  WHERE $oil_routed_table.deleted =0 AND $oil_routed_table.status IN ('enroute','scheduled') $rddtn order by created_date  DESC ");
}



?>
<style type="text/css">
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
    overflow-x:auto;
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



input[type=checkbox]{
    width:10px;
}
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "order": [ 5, 'DESC' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>
<table style="width: 100%;margin:auto;"  id="myTable" >
<thead>
     <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
         <th>&nbsp;</th>
        <th class="cell_label" style="width: 50px;">IKG Manifest Number</th>
        <th class="cell_label">Status</th>
        <th class="cell_label" style="width:75px">Title</th>
        <th class="cell_label">Facility</th>
        <th class="cell_label">Created</th>
        <th class="cell_label">By </th>
        <th class="cell_label">Scheduled</th>
        <th class="cell_label">Driver</th>
        <th class="cell_label">Stops</th>
        <th class="cell_label"><span title="Number of incomplete oil pickups.">Inc.</span></th>
        <th class="cell_label">Expected</th>
        <th class="cell_label">Collected</th>
       
    </tr>
</thead>

<tbody>
<?php


if(count($result) >0){
    foreach($result as $route){        
        echo "<tr>";
                echo "<td>"; 
                    if($person->isAdmin() || $person->isFacilityManager() ){
                        echo "<img src='img/delete-icon.jpg' style='cursor:pointer;' rel='$route[route_id]' class='delroute'/>";
                    }
                echo "</td>";
            echo "
                <td>";  
                    echo $route['route_id'];
                 echo"</td>
                <td>".$route['status']."</span></td>
                <td style='cursor:pointer;'><form action='oil_routing.php' target='_blank' method='post' class='ikg_form'>$route[ikg_manifest_route_number]
                <input type='hidden' value='$route[route_id]' name='manifest'/>
                <input type='hidden' value='1' name='from_routed_oil_pickups'/></form></td>
                <td>".numberToFacility($route['facility']) ."</td>
                <td>$route[created_date]</td>
                <td>".uNumToName($route['created_by'])."</td>
                <td>$route[scheduled]</td>
                <td>".uNumToName($route['driver'])."</td>
                <td>$route[stops]</td>
                <td>$route[inc]</td>
                <td>".round($route['expected'],2)."</td>
                <td>".round($route['collected'],2)."</td>
            </tr>";
    }
}


?>

</tbody>
</table>
<script>
$(".ikg_form").click(function(){
    $(this).submit();
});

$(".delroute").click(function(){
    if(confirm("Are you sure you wish to delete this route?")){
        $.post("delete_route.php",{route_id:$(this).attr('rel')},function(data){
             alert("route deleted");
        }); 
    } 
});
</script>