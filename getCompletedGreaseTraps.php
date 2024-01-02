<?php
    ini_set("display_errors",0);
    $co="";
    $string ="";
    $list_of_grease = $dbprefix."_list_of_grease";
    $ikg_grease_table = $dbprefix."_ikg_grease";
    
    if(  $person->isCoWest()   ){
        $rddtn = " AND facility IN( 15,24,30,31,32,33) ";
    } else if($person->isFriendly()){
        $rddtn = " AND $list_of_grease.route_id IN ( SELECT iwp_grease_traps.grease_route_no FROM iwp_grease_traps LEFT JOIN iwp_accounts ON iwp_grease_traps.account_no  = iwp_accounts.account_ID WHERE 1  AND iwp_accounts.friendly like '%$person->first_name%'  ) ";
    }
    
    if(isset($_POST['search_now'])){
        foreach($_POST as $name=>$value){
                switch($name){
                    case "facility":
                       if($value !="ignore"){
                            if ( $value == 99){
                                $arrFields[] = " $ikg_grease_table.recieving_facility IN(24,31,30,32,33)";
                            }else{
                                $arrFields[] = " $ikg_grease_table.recieving_facility = $value";
                            }
                        }  
                    break;
                     case "drivers":
            
                    if($value !="-"){
                       $arrFields[] = "$ikg_grease_table.driver = $value"; 
                    }
                    break;
                     case "rtitle":
                        if(strlen($_POST['rtitle']) && isset($_POST['rtitle'])){
                            $value = str_replace(' ','-',$value);
                            $arrFields[] = " $ikg_grease_table.ikg_manifest_route_number like '%$value%'";
                        }
                        break;
                    case "rid":
                        if(isset($_POST['rid']) && strlen($_POST['rid'])>0){
                            $arrFields[] = " $ikg_grease_table.route_id = $value";
                        }
                        break;
                    case "to":
                        if(strlen($value)>0){
                            if($_POST['report_type'] == 2){
                                $arrFields[] = " $ikg_grease_table.completed_date <='$value'";
                            }    else {
                                $arrFields[] = "$ikg_grease_table.scheduled_date <= '$value'";
                            }
                        }
                        
                    break;
                    
                    case "from":
                        if(strlen($value)>0){
                            if($_POST['report_type'] == 2){
                                $arrFields[] = " $ikg_grease_table.completed_date >='$value'";
                            } else {
                              $arrFields[] = "$ikg_grease_table.scheduled_date >= '$value'"; 
                            }
                        }
                    break;
                    
                    case "min":
                        if(isset($_POST['min']) && strlen($value)>0){
                            $end[] = " DATEDIFF($ikg_grease_table.scheduled_date,$ikg_grease_table.completed_date) >= $value";
                        }
                    break;
                    case "max":
                        if(isset($_POST['max']) && strlen($value)>0){
                            $end[] = " DATEDIFF($ikg_grease_table.scheduled_date,$ikg_grease_table.completed_date) <= $value";
                        }
                    break;           
            }
        }
        
        if(!empty($arrFields)){
            $criteria =  " AND ".implode (" AND ",$arrFields);
        }
        
        if(!empty($end)){
            $have = " having ".implode (" AND ",$end);
        }
        
        
        
        switch($_POST['my_group']){
            case "-": 
                $string = "SELECT $list_of_grease.*,$ikg_grease_table.* FROM $list_of_grease INNER JOIN $ikg_grease_table ON $list_of_grease.route_id = $ikg_grease_table.route_id WHERE $list_of_grease.status='completed' ".$criteria.$have;
                
            break;
            case "recieving_facility":
                $string ="SELECT DISTINCT($ikg_grease_table.recieving_facility),$ikg_grease_table.*,DATEDIFF($ikg_grease_table.scheduled_date,$ikg_grease_table.completed_date) as diff, $list_of_grease.status,$list_of_grease.inc,$list_of_grease.stops,$list_of_grease.expected,$list_of_grease.created_date,$list_of_grease.created_by FROM $ikg_grease_table INNER JOIN $list_of_grease ON $ikg_grease_table.route_id = $list_of_grease.route_id WHERE status='completed' $criteria $rddtn GROUP BY recieving_facility ".$have;
            break;
            case "driver":
                $string ="SELECT DISTINCT($ikg_grease_table.driver),$ikg_grease_table.*,DATEDIFF($ikg_grease_table.scheduled_date,$ikg_grease_table.completed_date) as diff , $list_of_grease.status,$list_of_grease.inc,$list_of_grease.stops,$list_of_grease.expected,$list_of_grease.created_date,$list_of_grease.created_by FROM $ikg_grease_table INNER JOIN $list_of_grease ON $ikg_grease_table.route_id = $list_of_grease.route_id WHERE status='completed' $criteria $rddtn group by $ikg_grease_table.driver ".$have;
            break;
            case "created_by":
                $string ="SELECT DISTINCT($ikg_grease_table.created_by), $ikg_grease_table.*,DATEDIFF($ikg_grease_table.scheduled_date,$ikg_grease_table.completed_date) as diff, $list_of_grease.status,$list_of_grease.inc,$list_of_grease.stops,$list_of_grease.expected,$list_of_grease.created_date,$list_of_grease.created_by FROM $ikg_grease_table INNER JOIN $list_of_grease ON $ikg_grease_table.route_id = $list_of_grease.route_id WHERE status='completed' $criteria group by $list_of_grease.created_by ".$have;
            break;
            default:
                $string = "SELECT $ikg_grease_table.*,DATEDIFF($ikg_grease_table.scheduled_date,$ikg_grease_table.completed_date) as diff , $list_of_grease.status,$list_of_grease.inc,$list_of_grease.stops,$list_of_grease.expected,$list_of_grease.created_date,$list_of_grease.created_by FROM $ikg_grease_table INNER JOIN $list_of_grease ON $ikg_grease_table.route_id = $list_of_grease.route_id WHERE status ='completed' $criteria $rddtn  order by $list_of_grease.created_date DESC";
            break;
        }
        
        
        
        //echo $string;      
        $check = $db->query($string);
    }
    else {
        $string ="SELECT $list_of_grease.*,$ikg_grease_table.* FROM $list_of_grease INNER JOIN $ikg_grease_table ON $list_of_grease.route_id = $ikg_grease_table.route_id WHERE $list_of_grease.status='completed' $rddtn";
        //echo $string;
        $check = $db->query($string);
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
        "lengthMenu": [ [ 50,10, 25,100,150, -1], [50,10, 25, 100,150, "All"] ]
   }); 
});
</script>

<table style="width: 100%;margin:auto;" id="myTable">
    <thead>
        
        <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
    
        <td class="cell_label">ID</td>
        <td class="cell_label">Status</td>
        <td class="cell_label">Title</td>
        <td class="cell_label">Created</td>
        <td class="cell_label">Scheduled</td>
        <td class="cell_label">Completed</td>
        <td class="cell_label">Driver</td>
        <td class="cell_label">Facility</td>
        <td class="cell_label">Services</td>
        <td class="cell_label"><span title="Number of incomplete service calls.">Inc.</span></td>
        
        </tr>
    </thead>
    <tbody>
    <?php
    if(count($check)>0){
        foreach($check as $grease){
            echo "<tr>";
            echo "<td>$grease[list_of_routes_id]</td>";
            echo "<td>$grease[status]</td>";
            echo "<td><form target='_blank' class='ikg_grease' method='post' action='grease_ikg.php' style='cursor:pointer;'><span style='cursor:pointer;text-decoration:underline;color:green;'>$grease[ikg_manifest_route_number]</span><input type='hidden' name='from_routed_grease_list' value='1' /><input type='hidden' value='$grease[route_id]' name='util_routes'/></form></td>";
            echo "<td>$grease[created_date]</td>";
            echo "<td>$grease[scheduled_date]</td>";
            echo "<td>$grease[completed_date]</td>";
            echo "<td>".uNumToName($grease['driver'])."</td>";
            echo "<td>".numberToFacility($grease['facility'])."</td>";
            echo "<td>$grease[ikg_collected]</td>";
            echo "<td>$grease[inc]</td>";
            echo "</tr>";
        }
    }
    
    ?>
    </tbody>
</table>
<script>
$(".ikg_grease").click(function(){
    $(this).submit();
});
$(".greaseroute").click(function(){
   $.get("adminDelGreaseRoute.php",{route_id: $(this).attr('rel')},function(data){
        alert("route Deleted!");
        location.reload();
   }); 
});
</script>