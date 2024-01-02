<?php

ini_set("display_errors",1);

/**/
$utility_route_list_table = $dbprefix."_list_of_utility";
$utility_table = $dbprefix."_utility";
$rddtn ='';


if(isset($_POST['search_now'])){
     foreach($_POST as $name=>$value){
            switch($name){  
                 case "rtitle":
                if(strlen($_POST['rtitle']) && isset($_POST['rtitle'])){
                    $value = str_replace(' ','%',$value);
                    $arrFields[] = " ikg_manifest_route_number like '%$value%'";
                }
                break;
            case "rid":
                if(isset($_POST['rid']) AND strlen($_POST['rid'])>0){
                    $arrFields[] = " route_id = $value";
                }
                break;
                case "status_id":
                    if(strlen($value)>0){
                        $arrFields[] = " status = '".$value."'";
                    }
                break;
                case "drivers":
                    if($_POST['drivers'] !="-"){
                    $driver[] = "driver = ".$value;
                   } 
                break;
            }
        }
         
         $criteria1 ="";
        if(!empty($arrFields)){
             $criteria1 = " AND ". implode (" || ",$arrFields)." AND  status='enroute'";             
        }
        
        
        $crit2 = "";
        if(!empty($driver)){
            $crit2 = " AND ".implode( " AND ",$driver)." ";
        }
        
        $search_string = "SELECT  * FROM $utility_route_list_table WHERE $utility_route_list_table.deleted =0 AND $rddtn". $criteria1.$crit2;
        echo $search_string;
        $check  = $db->query($search_string);
        
} else {
    $search_string = "SELECT * FROM $utility_route_list_table WHERE $utility_route_list_table.deleted =0 AND status='enroute' $rddtn" ;
    echo $search_string;
    $check  = $db->query($search_string);
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
    border:1px solid #bbb;  
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
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ],
        "order": [ 10, 'ASC' ]
   }); 
});
</script>
<table style="width: 100%;margin:auto;"  id="myTable">
<thead>
<tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
<td>&nbsp;</td>
<td class="cell_label">ID</td>

<td class="cell_label">Status</td>

<td class="cell_label">Title</td>

<td class="cell_label">Created</td>

<td class="cell_label">Scheduled</td>

<td class="cell_label">Completed</td>

<td class="cell_label">Driver</td>

<td class="cell_label">Facility</td>

<td class="cell_label">Services</td>
<td class="cell_label">Stops</td>

<td class="cell_label"><span title="Number of incomplete service calls.">Inc.</span></td>

</tr>

</thead>
<tbody>
<?php
/**/
if(count($check) > 0){
    foreach($check as $utils){
        $schedule_service_types = $db->query("SELECT DISTINCT (type_of_service), count( * ) AS num_of_services, rout_no
FROM iwp_utility WHERE rout_no =$utils[route_id] GROUP BY type_of_service");
        
        echo "<tr>";
                echo "<td>"; 
                    if($person->isFacilityManager() || $person->isAdmin()){
                        echo "<img src='img/delete-icon.jpg' style='cursor:pointer;' rel='$utils[route_id]' class='delroute'/>";
                    }
                echo "<td>"; 
        echo "$utils[route_id]" ;
        echo "</td>";
        echo "<td>$utils[status]</td>";
        echo "<td style='cursor:pointer;'><form action='ikg_routing.php' target='_blank' method='post' class='ikg_form'>$utils[ikg_manifest_route_number]<input type='hidden' value='$utils[route_id]' name='util_number'/><input type='hidden' value='1' name='from_routed_util_list'/></form></td>";
        echo "<td>$utils[created_date]</td>";
        echo "<td>$utils[scheduled]</td>";
        echo "<td>$utils[completed_date]</td>";
        echo "<td>"; 
            if($utils['driver']!=0){
                echo uNumToName($utils['driver']);
            }else{
                echo "No Driver Set";
            }
        
        echo "</td>";
        echo "<td>$utils[facility]</td>";
        echo "<td>"; 
        if(count($schedule_service_types) > 0 ) { 
            foreach($schedule_service_types as $types){
                echo   " - $types[num_of_services] ".service_call_decode($types['type_of_service'])."</br>";
            }
        }
        echo "</td>";
        echo "<td>$utils[stops]</td>";
        echo "<td>$utils[inc]</td>";
        echo "<tr>";
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
    if( confirm("Are you sure you wish to delete this Utility Route?") ){
        $.get("adminDelUtilRoute.php",{util_route_no: $(this).attr('rel')},function(data){
            alert("route Deleted");
            location.reload(); 
        });
    }
});
</script>