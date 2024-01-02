<?php
$oil_routed_table = $dbprefix."_list_of_routes";
$string = "";
if(isset($_POST['search_now'])){
   
    foreach($_POST as $name=>$value){
        
        switch($name){
            case "status_id":
                if(isset($_POST['status_id'])){
                    $arrFields[]= " status = '$value'";
                }
            break;
            case "facility":
                if(isset($_POST['facility'])){
                    $arrFields[]= " facility = $value";
                }
                break;
            case "drivers":
                if(isset($_POST['drivers'])){
                    $arrFields[] = " driver = $value";
                }
                break;
        }
    }
    
    if(!empty($arrFields)){
         $string = implode(" AND ",$arrFields);
         $string = "SELECT * FROM $oil_routed_table WHERE 1 AND".$string." order by created_date DESC";
         echo $string."<br/>";
        $result = $db->query($string);
    } else {
        $result = $db->query("SELECT * FROM $oil_routed_table WHERE status IN('scheduled','enroute') AND $oil_routed_table.deleted=0 order by created_date DESC");    
    }
    
   
    
} else {
    $result = $db->query("SELECT * FROM $oil_routed_table WHERE status IN('scheduled','enroute') AND $oil_routed_table.deleted=0 order by created_date DESC");    
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
        <th class="cell_label">IKG Manifest Number</a></th>
        <th class="cell_label">Status</a></th>
        <th class="cell_label">Title</a></th>
        <th class="cell_label">Facility</a></th>
        <th class="cell_label">Created</a></th>
        <th class="cell_label">By </a></th>
        <th class="cell_label">Scheduled</a></th>
        <th class="cell_label">Driver</a></th>
        <th class="cell_label">Stops</a></th>
        <th class="cell_label"><span title="Number of incomplete oil pickups.">Inc.</span></a></th>
        <th class="cell_label">Expected</a></th>
        <th class="cell_label">Collected</a></th>
    </tr>
</thead>

<tbody>
<?php


if(count($result) !=0){
    foreach($result as $route){        
        echo "<tr>
                <td>$route[list_of_routes_id]</td>
                <td>".$route['status']."</span></td>
                <td style='cursor:pointer;'><form action='oil_routing.php' target='_blank' method='post' class='ikg_form'>$route[ikg_manifest_route_number]<input type='hidden' value='$route[route_id]' name='manifest'/><input type='hidden' value='1' name='from_routed_oil_pickups'/></form></td>
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
</script>