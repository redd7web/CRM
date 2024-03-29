<?php
$alter =0;
$criteria ="";
$have ="";
$data_table = $dbprefix."_data_table";
$data_table2 = $dbprefix."_data_table2";
$route_table = $dbprefix."_ikg_manifest_info";
$route_table2 = $dbprefix."_ikg_manifest_info2";
$route_list = $dbprefix."_list_of_routes";
$route_list2 = $dbprefix."_list_of_routes2";
$union = "";
ini_set("display_errors",0);

$rddtn ='';


//db query
$addtin="";
if($person->isFacilityManager()){
    if($person->facility == 99){
        $addtin = " AND recieving_facility IN (24,31,25,32,33,30,23)";
    } else {
        if($person->user_id == 20){
                $addtin =" AND recieving_facility IN (24,31,25,32,33,30)";
        }else {
            $addtin =" AND recieving_facility = $person->facility";
        }
    }
} else if($person->isFriendly()){
    $rddtn = " AND iwp_ikg_manifest_info.route_id IN ( SELECT iwp_scheduled_routes.route_id FROM iwp_scheduled_routes LEFT JOIN iwp_accounts ON iwp_scheduled_routes.account_no  = iwp_accounts.account_ID WHERE $route_list.deleted =0 AND iwp_accounts.friendly like '%$person->first_name%'  ) ";
} else if(  $person->isCoWest()   ){
    $rddtn = " AND recieving_facility =15";
}


if(isset($_POST['search_now'])  ){
    foreach($_POST as $name=>$value){
        switch($name){
            case "year":
                $union = "UNION ALL SELECT iwp_ikg_manifest_info2.*,DATEDIFF(iwp_ikg_manifest_info2.scheduled_date,iwp_ikg_manifest_info2.completed_date) as diff , iwp_list_of_routes2.status,iwp_list_of_routes2.inc,iwp_list_of_routes2.stops,iwp_list_of_routes2.expected,iwp_list_of_routes2.created_date,iwp_list_of_routes2.created_by FROM iwp_ikg_manifest_info2 LEFT JOIN iwp_list_of_routes2 ON iwp_ikg_manifest_info2.route_id =  iwp_list_of_routes2.route_id WHERE $route_list.deleted =0 ";
            break;
            case "facility":
                if($value !="ignore"){
                    if ( $value == 99){
                        $arrFields[] = " recieving_facility IN(24,31,30,32,33)";
                    }else{
                        $arrFields[] = " recieving_facility = $value";
                    }
                }  
                break;

            case "all_arizona_zones":
                $arrFields[] = " recieving_facility IN(35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50)";
                break;
            case "drivers":            
                if($value !="-"){
                   $arrFields[] = "driver = $value"; 
                }
                break;
             case "rtitle":
                if(strlen($_POST['rtitle']) && isset($_POST['rtitle'])){
                    $value = str_replace(' ','-',$value);
                    $arrFields[] = "ikg_manifest_route_number like '%$value%'";
                }
                break;
            case "rid":
                if(isset($_POST['rid']) && strlen($_POST['rid'])>0){
                    $arrFields[] = " $route_table.route_id = $value";
                }
                break;
            case "to":
                if(strlen($value)>0){
                    if($_POST['report_type'] == 2){
                        $arrFields[] = "completed_date <='$value'";
                    }    else {
                        $arrFields[] = "scheduled_date <= '$value'";
                    }
                }
                
            break;
            
            case "from":
                if(strlen($value)>0){
                    if($_POST['report_type'] == 2){
                        $arrFields[] = " completed_date >='$value'";
                    } else {
                        $arrFields[] = "scheduled_date >= '$value'"; 
                    }
                }
            break;
            
            case "min":
                if(isset($_POST['min']) && strlen($value)>0){
                    $end[] = " DATEDIFF(scheduled_date,completed_date) >= $value";
                }
            break;
            case "max":
                if(isset($_POST['max']) && strlen($value)>0){
                    $end[] = " DATEDIFF(scheduled_date,completed_date) <= $value";
                }
            break;
        }
    }
    
    if(!empty($arrFields)){
        $criteria = " AND ".implode(" AND ",$arrFields);
    }
    
    if(!empty($end)){
        $have = " having ".implode (" AND ",$end);
    }
    
    switch($_POST['my_group']){
        case "-": 
            $string ="SELECT $route_table.*,DATEDIFF($route_table.scheduled_date,$route_table.completed_date) as diff , $route_list.status,$route_list.inc,$route_list.stops,$route_list.expected,$route_list.created_date,$route_list.created_by FROM $route_table LEFT JOIN $route_list ON $route_table.route_id = $route_list.route_id $union WHERE $route_list.deleted =0 AND status='completed' $criteria $rddtn ".$have; 
           
            
        break;
        case "recieving_facility":
            $string ="SELECT DISTINCT($route_table.recieving_facility),$route_table.*,DATEDIFF($route_table.scheduled_date,$route_table.completed_date) as diff, $route_list.status,$route_list.inc,$route_list.stops,$route_list.expected,$route_list.created_date,$route_list.created_by FROM $route_table LEFT JOIN $route_list ON $route_table.route_id = $route_list.route_id $union WHERE $route_list.deleted =0 AND status='completed' $criteria $rddtn GROUP BY recieving_facility ".$have;
          
        break;
        case "driver":
            $string ="SELECT DISTINCT($route_table.driver),$route_table.*,DATEDIFF($route_table.scheduled_date,$route_table.completed_date) as diff , $route_list.status,$route_list.inc,$route_list.stops,$route_list.expected,$route_list.created_date,$route_list.created_by FROM $route_table LEFT JOIN $route_list ON $route_table.route_id = $route_list.route_id $union WHERE $route_list.deleted =0 AND status='completed' $criteria $rddtn group by $route_table.driver ".$have;
           
        break;
        case "created_by":
            $string ="SELECT DISTINCT($route_table.created_by), $route_table.*,DATEDIFF($route_table.scheduled_date,$route_table.completed_date) as diff, $route_list.status,$route_list.inc,$route_list.stops,$route_list.expected,$route_list.created_date,$route_list.created_by FROM $route_table LEFT JOIN $route_list ON $route_table.route_id = $route_list.route_id $union WHERE $route_list.deleted =0 AND status='completed' $criteria group by created_by ".$have;
        break;
        default:
            $string = "SELECT $route_table.*,DATEDIFF($route_table.scheduled_date,$route_table.completed_date) as diff , $route_list.status,$route_list.inc,$route_list.stops,$route_list.expected,$route_list.created_date,$route_list.created_by FROM $route_table LEFT JOIN $route_list ON $route_table.route_id = $route_list.route_id $union WHERE $route_list.deleted =0 AND status ='completed' $criteria $rddtn  order by created_date DESC";
          
        break;
    }
     echo $string;
     
     
     $result = $db->query($string);
    
} else {
   
    echo "SELECT $route_table.*,DATEDIFF($route_table.scheduled_date,$route_table.completed_date) as diff , $route_list.status,$route_list.inc,$route_list.stops,$route_list.expected,$route_list.created_date,$route_list.created_by FROM $route_table LEFT JOIN $route_list ON $route_table.route_id = $route_list.route_id  WHERE $route_list.deleted =0 AND status ='completed'   $rddtn order by $route_list.created_date DESC";
    //$result = $db->query("SELECT $route_table.*,DATEDIFF($route_table.scheduled_date,$route_table.completed_date) as diff , $route_list.status,$route_list.inc,$route_list.stops,$route_list.expected,$route_list.created_date,$route_list.created_by FROM $route_table LEFT JOIN $route_list ON $route_table.route_id = $route_list.route_id  WHERE $route_list.deleted =0 AND status ='completed'   $rddtn order by $route_list.created_date DESC");
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
        "order": [ 4, 'DESC' ],
        "lengthMenu": [ [50,10, 25, 100,150, -1], [50,10, 25,100,150, "All"] ]
   }); 
});
</script>
<table style="width: 100%;margin:auto;"  id="myTable" >
<thead>
     <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
         <th>&nbsp;</th>
        <th class="cell_label">IKG Manifest Number</a></th>
        <th class="cell_label">Status</a></th>
        <th class="cell_label">Title</a></th>
        <th class="cell_label">Facility</a></th>
        <th class="cell_label">Created</a></th>
        <th class="cell_label">By </a></th>
        <th class="cell_label">Scheduled</a></th>
        <th class="cell_label">Completed</a></th>
        <th class="cell_label">Wait Days</a></th>
        <th class="cell_label">Driver</a></th>
        <th class="cell_label">Stops</a></th>
        <th class="cell_label"><span title="Number of incomplete oil pickups.">Inc.</span></a></th>
        <th class="cell_label">Expected</a></th>
        <th class="cell_label">Collected</a></th>
        <th class="cell_label">Gross Weight</th>
    </tr>
</thead>
<tbody>
<?php


if(count($result) !=0){
    foreach($result as $route){ 
        $alter++;
            
            if($alter%2 == 0){
                $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
            }
            else { 
                $bg = 'trnsparent';
            }
        
        echo "<tr  style='background:$bg'>";
                echo "<td>"; 
                    if($person->isFacilityManager()){
                        echo "<img src='img/delete-icon.jpg' style='cursor:pointer;' rel='$route[route_id]' class='delroute'/>";
                    }
                echo "</td>";
                echo "
                <td>$route[route_id]</td>
                <td style='color:green;'>".$route['status']."</span></td>
                <td style='cursor:pointer;'><form action='oil_routing.php' target='_blank' method='post' class='ikg_form'>$route[ikg_manifest_route_number]<input type='hidden' value='$route[route_id]' name='manifest'/><input type='hidden' value='1' name='from_routed_oil_pickups'/></form></td>
                <td>".numberToFacility($route['recieving_facility']) ."</td>
                <td>$route[created_date]</td>
                <td>".uNumToName($route['created_by'])."</td>
                <td>$route[scheduled_date]</td>
                <td>$route[completed_date]</td>
                <td>$route[diff]</td>
                <td>".uNumToName($route['driver'])."</td>
                <td> $route[stops]</td>
                <td>$route[inc]</td>
                <td>".round($route['expected'],2)."</td>
                <td>".round($route['collected'],2)."</td>
                <td>"; 
                $yu = $db->query("SELECT COALESCE( SUM( iwp_data_table.inches_to_gallons ) , 0 ) + COALESCE( iwp_ikg_manifest_info.gross_weight, 0 ) AS run_total, ikg_manifest_route_number
FROM iwp_ikg_manifest_info
LEFT JOIN iwp_data_table ON iwp_ikg_manifest_info.route_id = iwp_data_table.route_id
WHERE iwp_ikg_manifest_info.route_id = $route[route_id] ");
                if($yu[0]['run_total'] != null){
                    echo $yu[0]['run_total'];
                }else {
                    echo 0;
                }
                echo "</td></tr>";
            
    }
}
?>

</tbody>
</table>

<script>

$(".delroute").click(function(){
    if(confirm("Are you sure you wish to delete this route?")){
        $.post("delete_route.php",{route_id:$(this).attr('rel')},function(data){
             alert("route deleted");
        }); 
    } 
});

$(".ikg_form").click(function(){
    $(this).submit();
});
</script>