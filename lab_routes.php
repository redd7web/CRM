<?php
ini_set("display_errors",1);
include "bakery/protected/global.php";
include "source/scripts.php";
include "source/css.php";
$person = new Person();



$oil_routed_table = "bakery.bakery_ikg_single_info";





if(isset($_POST['search_now'])){
   
    foreach($_POST as $name=>$value){
        
        switch($name){
             case "rtitle":
                if(strlen($_POST['rtitle']) && isset($_POST['rtitle'])){
                    $value = str_replace(' ','-',$value);
                    $arrFields[] = " ikg_manifest_route_number like '%$value%'";
                }
                break;
            case "rid":
                if(isset($_POST['rid']) && strlen($_POST['rid'])>0){
                    $arrFields[] = " route_id = $value";
                }
                break;
            
            break;
            case "facility":
                if($_POST['facility'] !='ignore'){
                    $arrFields[]= " recieving_facility = $value ";
                }else{
                    $arrFields[]=" recieving_facility IN(7,9,10) ";
                }
                break;
            case "drivers":
                if($_POST['drivers'] !="-"){
                    $arrFields[] = " driver = $value";
                }
                break;
            case "from":
                if(strlen($_POST['from'])>0){
                    if($_POST['report_type'] == 1){
                        $arrFields[] = "scheduled_start_date >= '$value'";
                    }else{
                        $arrFields[] = "completed_date >= '$value'";
                    }
                }
                break;
            case "to":
                if(strlen($_POST['to'])>0){
                    if($_POST['report_type'] == 1){
                        $arrFields[] = "scheduled_start_date <= '$value'";
                    }else{
                        $arrFields[] = "completed_date <= '$value'";
                    }
                }
                break;
        }
    }
    
    if(!empty($arrFields)){
         $string = implode(" AND ",$arrFields);
         
         
    } 
   $query = "SELECT * FROM $oil_routed_table WHERE status IN ('enroute','scheduled') AND $addtin $string  order by created_date DESC";
   echo $query."<br/>";
   $result = $db->query($query);
    
} else {
    echo "SELECT * FROM $oil_routed_table WHERE status IN ('enroute','scheduled') AND recieving_facility IN(7,9,10) $addtin order by created_date  DESC ";  
   $result = $db->query("SELECT * FROM $oil_routed_table WHERE status IN ('enroute','scheduled') AND recieving_facility IN(7,9,10) $addtin order by created_date  DESC ");
}



?>
<style type="text/css">
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
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
    border:1px solid green;  
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
<form action="lab_routes.php" method="post">
                    <table  style="width:50%;margin:auto;margin-top:20px;margin-bottom:20px;border:1px solid green;"><tbody>
                    <tr><td colspan="2" style="float: right;"><?php if(isset($_SESSION['bak_id'])  ){  echo '<a href="bakery/logout.php">Log Out of Candy/Petfood</a>';} ?><br />Please log out when finished.</td></tr>
                    <tr>
                    <td style="width: 280px;">Route title</td><td><input type="text" value="<?php if(isset($_POST['rtitle'])){ echo $_POST['rtitle']; } else {echo "";} ?>" placeholder="route title" id="rtitle" name="rtitle"/></td></tr>
                    
                    <tr>
                     <td  style="width: 280px;">Route id</td><td><input type="text" name="rid" placeholder="Route Id" value="<?php if(isset($_POST['rid'])){ echo $_POST['rid']; } else {echo "";} ?>"/></td></tr>
                     
                     <tr>
                     <td style="vertical-align: top;" ><input type="radio" name="report_type"  <?php 
        if(isset($_POST['search_now'])){  
            if(isset($_POST['report_type']) == 1) { 
                    echo "checked='checked'";
            } 
        }else {
                if($_POST['report_type'] !=2){
                    echo 'checked="checked"';  
                }
        }  ?>  value="1"/> Date Reported<br /><input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  if(isset($_POST['report_type']) == 2) { echo "checked='checked'";}   } ?>  value="2"/> Date Serviced&nbsp;</td> <td style="vertical-align: top;" class="field_label"><input type="text" value="<?php if(isset($_POST['from'])){ echo $_POST['from'];  } ?>" id="from" name="from" /><br /><input value="<?php if(isset($_POST['to'])){ echo $_POST['to'];  } ?>" type="text" id="to" name="to" /></td></tr>
        
        <tr><td>Facility</td><td>
            <select name="facility">
                <option value="ignore">All</option>
                <option value="7">R-Division (Candy/Bakery W Division)</option>
                <option value="9">RP-Division(Pet Food W Division)</option>
                <option value="10">G-Division(Mayo W Division)</option>
            </select></td></tr>
                  

<tr>
<td style="padding-left:10px;width:240px;" class="field_label">Driver</td><td>
<?php echo getDrivers(); ?></td>
</tr><tr>
<td colspan="2"  style="text-align:right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>"  style="margin-left: 10px;">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" style="margin-left: 10px;"/></td></tr></tbody></table>
                    </form>

<h1>Candy/Pet Food/Mayo Routes</h1>


<table style="width: 100%;margin:auto;"  id="myTable" >
<thead>
     <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
      <?php 
            if($person->isAdmin()){
                echo '<th class="cell_label">&nbsp;</a></th>';
            }
        ?>
        <th class="cell_label">Route Id</a></th>
        <th class="cell_label">Status</a></th>
        <th class="cell_label">Title</a></th>
        <th class="cell_label">Facility</a></th>
        <th class="cell_label">Created</a></th>
        <th class="cell_label">By </a></th>
        <th class="cell_label">Scheduled</a></th>
        <th class="cell_label">Driver</a></th>
        <th class="cell_label">Sub Hauler</th>
        <th class="cell_label">Stops</a></th>
        <th class="cell_label"><span title="Number of incomplete oil pickups.">Inc.</span></a></th>
        <th class="cell_label">Expected</a></th>
        <th class="cell_label">Collected</a></th>
    </tr>
</thead>

<tbody>
<?php


if(count($result) >0){
    foreach($result as $route){        
        echo "<tr>";
                if($person->isAdmin()){//		
                    echo '<td><img  class="del_route"  src="img/delete-icon.jpg" style="cursor:pointer;"/></td>';
                }
                echo "
                <td>".'<img facility="'.$route['recieving_facility'].'" net_weight="'.$route['net_weight'].'" title="'.$route['ikg_manifest_route_number'].'" rel="'.$route['route_id'].'"  table="bakery_ikg_single_info" tank_1="'.$route['tank_1'].'"  tank_2="'.$route['tank_2'].'" sched_route_start="'.$route['scheduled_date'].'" vehicle="'.$route['truck'].'" completion_date="'.$route['completed_date'].'" lic_plate="'.$route['license_plate'].'"  ikg_decal="'.$route['ikg_decal'].'" location="'.$route['location'].'" ikg_collected="'.$route['ikg_collected'].'" fuel="'.$route['fuel'].'"  inventory_code="'.$route['inventory_code'].'" lot_no="'.$route['lot_no'].'" gross_weight="'.$route['gross_weight'].'" tara_weight="'.$route['tare_weight'].'" fac_address="'.$route['facility_address'].'" fac_rep="'.$route['facility_rep'].'" ikg_transporter="'.$route['ikg_transporter'].'" number_of_picksup="'.$route['stops'].'" total_estimate="'.$route['expected'].'" fc="'.$route['freight_cost'].'" bol="'.$route['bol_number'].'" time_start="'.$route['time_start'].'" end_time="'.$route['end_time'].'" truck_cap="'.$route['truck_cap'].'" release_number="'.$route['release_number'].'" flat_month="'.$route['per_month_rate'].'" seal="'.$route['seal_number'].'" petfoodcheck="'.$route['gross_weight'].'" sub_driver ="'.$route['sub_driverx'].'" sub_haul="'.$route['sub_hauler'].'" weight_ticket_number="'.$route['weight_ticket_number'].'"  drivers="'.$route['driver'].'"  class="tcl" src="https://image.flaticon.com/icons/png/512/28/28822.png" style="width:25px;height:25px;cursor:pointer;" route_id="$route[route_id]">  '."&nbsp;&nbsp;$route[route_id]</td>
                <td>".$route['status']."</span></td>
                <td style='cursor:pointer;'><form action='bakery/grease_ikg.php' target='_blank' method='post' class='ikg_form'>$route[ikg_manifest_route_number]
                <input type='hidden' value='$route[route_id]' name='manifest'/>
                <input type='hidden' value='1' name='from_routed_oil_pickups'/>
                <input type='hidden' value='1' name ='bypass' />
                </form></td>
                
                <td>".numberToFacility($route['recieving_facility']) ."</td>
                <td>$route[created_date]</td>
                <td>".uNumToName($route['created_by'])."</td>
                <td>$route[scheduled_date]</td>
                <td>"; 
                    if($route['driver'] !=0){
                        echo uNumToName($route['driver']);
                    } else {
                        echo $route['sub_driverx'];
                    }
                echo "</td>
                <td>";  
                    if($route['is_sub'] == 1){
                        echo "Yes";
                    } else {
                        echo "No";
                    }
                echo "</td>
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

$(".tcl").click(function(){
    $.post("insert_petfood_to_tcl.php",{  
        reciev_fac : $(this).attr('facility'),
        rid:$(this).attr('rel'),
        drivers : $(this).attr("drivers"),
        tank_1: $(this).attr('tank_1'),
        tank_2:  $(this).attr('tank_2'),
        sched_route_start: $(this).attr('sched_route_start'),
        vehicle:$(this).attr('vehicle'),        
        completion_date : $(this).attr('completion_date'),
        lic_plate: $(this).attr('lic_plate'),        
        unique_route_no : $(this).attr('title'),
        ikg_decal : $(this).attr('ikg_decal'),        
        location: $(this).attr('location'),
        ikg_collected: $(this).attr('ikg_collected') ,
        fuel: $(this).attr('fuel'),
        inventory_code : $(this).attr('inventory_code'),
        lot_no : $(this).attr('lot_no'),
        gross_weight: $(this).attr('gross_weight'),
        tara_weight: $(this).attr('tara_weight'),
        fac_address: $(this).attr('fac_address'),
        net_weight: $(this).attr('net_weight'),
        fac_rep: $(this).attr('fac_rep'),
        ikg_transporter:$(this).attr('ikg_transporter'),        
        total_estimate:$(this).attr('total_estimate'),
        sub_driver: $(this).attr('sub_driver'),
        sub_haul: $(this).attr('sub_haul'),
        fc: $(this).attr('fc'),
        bol:$(this).attr('bol'),
        truck_cap:$(this).attr('truck_cap'),
        flat_month:$(this).attr('flat_month'),
        release_number:$(this).attr('release_number'),
        seal:$(this).attr('seal'),
        wtn:$(this).attr('weight_ticket_number')
        },
        function(data){
            alert(data);
        });
});

$(".del_route").click(function(){
   if(confirm("Are you sure you want to delete this route?")){
     $.post("del_route.php",{route_id:$(this).attr('rel'), table:$(this).attr('table')  },function(data){
        location.reload();   
     });
   } 
});

$(".ikg_form").click(function(){
    $(this).submit();
});
</script>