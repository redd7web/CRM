<?php
ini_set("display_errors",1);
ini_set('memory_limit', '-1');
$string ="";

if(isset($_GET['clear'])){
    unset($_SESSION['exlude_list']);
}


function charged_amount($route_id){
    global $db;
    $data = $db->query("SELECT paid FROM iwp_data_table WHERE route_id = $route_id");
    if(count($data)>0){
        $all_picked_up=0;
        foreach($data as $calc){
            $all_picked_up += $calc['paid'];
        }
    }else {
       $all_picked_up = 0;
    }
    return $all_picked_up;
}





function start_date($route_id,$day){
    global $db;
    $sched = $db->query("SELECT scheduled_date as Date FROM iwp_ikg_manifest_info WHERE route_id = $route_id");
    if(count($sched)>0){
        return $sched[0]['Date'];
    }else {
       return "0000-00-00";
    }
}

function time_start($route_id,$day){
    $fs_stop ="00:00:00";
    global $db;
    $f_stop = $db->query("SELECT time_start FROM iwp_rout_history WHERE route_no=$route_id AND what_day = $day ORDER BY time_start ASC LIMIT 0,1");
    if(count($f_stop)>0){
        $fs_stop = $f_stop[0]['time_start'];
    }
    return $fs_stop;
}

function time_end($route_id,$day){
    $ls_stop = "00:00:00";
    global $db;
    $l_stop = $db->query("SELECT time_end FROM iwp_rout_history WHERE route_no=$route_id  AND what_day = $day ORDER BY time_end DESC LIMIT 0,1");
    if(count($l_stop)>0){
        $ls_stop = $l_stop[0]['time_end'];
    }
    return $ls_stop;
}


function start_time_from_date($route_id,$day){
    global $db;
    $start_time = "00:00:00";
     $sched = $db->query("SELECT first_stop as Time FROM iwp_rout_history WHERE route_no =$route_id AND what_day =$day");
    if(count($sched)>0){
        $start_time=  $sched[0]['Time'];
    }
    return $start_time;
}

function end_time_from_date($route_id,$day){
    global $db;
    $end_time = "00:00:00";
    $end1 = $db->query("SELECT last_stop as ETime FROM iwp_rout_history WHERE route_no = $route_id AND what_day =$day");
    if(count($end1)>0){
        $end_time= $end1[0]['ETime'];
    } 
    return $end_time;
}

function total_hours($route_id,$day){
    global $db;
    $total_day = 0;
    $day1 = $db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(last_stop, first_stop)))) AS totalhours FROM `iwp_rout_history` WHERE route_no=$route_id AND what_day =$day GROUP BY what_day");
    if(count($day1)>0){
        $total_day = $day1[0]['totalhours'];
    }
    return $total_day;
}


function first_stop_mileage($route_id,$day){
    global $db;
    $f_mileage = 0; 
    if($route_id>0 && $route_id !="" && $route_id !=" "){
        $first_stop_mileage = $db->query("SELECT first_stop_mileage FROM iwp_rout_history WHERE route_no=$route_id  AND what_day =$day");
        if(count($first_stop_mileage)>0){
            $f_mileage = $first_stop_mileage[0]['first_stop_mileage'];
        }
    }
    return $f_mileage;
}

function last_stop_mileage($route_id,$day){
    global $db;
    $l_mileage = 0;
    
    if($route_id>0&& $route_id !="" && $route_id !=" "){
        $last_stop_mileage = $db->query("SELECT last_stop_mileage FROM iwp_rout_history WHERE route_no=$route_id AND what_day =$day");
        if(count($last_stop_mileage)>0){
            $l_mileage = $last_stop_mileage[0]['last_stop_mileage'];
        }
    }
    return $l_mileage;
}


function start_mileage($route_id,$day){
    global $db;
    $start = 0;
    $s = $db->query("SELECT start_mileage FROM iwp_rout_history WHERE route_no = $route_id AND what_day =$day");
    if(count($s)>0){
       return $s[0]['start_mileage'];
    } else {
        return $start; 
    }
}

function end_mileage($route_id,$day){
    global $db;
    $end = 0;
    $e = $db->query("SELECT end_mileage FROM iwp_rout_history WHERE route_no = $route_id AND what_day =$day");
    if(count($e)>0){
        return $e[0]['end_mileage'];
    } else {
        return $end; 
    }
}

function lb_per_stop($net_weight,$stops){
    if($net_weight == 0 || $net_weight == null || $net_weight==" " || $net_weight =="" || $net_weight <= 0 || $stops <= 0){
       return $avg_lb_stop = 0.00;    
    } else {
       $avg_lb_stop =  number_format($net_weight/$stops,2);
       return $avg_lb_stop;
    }
    
    
    return $avg_lb_stop;
}



function fuel_gal($miles){
    return number_format($miles/7,2);
}

function avg_fuel_money($total_mile,$stops){
    $modifier = 7.56;
    if($total_mile == 0 || $total_mile == null || $total_mile==" " || $total_mile ==""  || $total_mile <= 0 || $stops <= 0){
       return $avg_fuel = 0.00;    
    } else {
        $avg_fuel =  number_format( ( $total_mile/$modifier )/$stops ,2);
        return $avg_fuel;
    }
}

function avg_miles_per_stop($total_pu_mileage,$stops){
    if($total_pu_mileage <=0 || $stops <= 0){
       return $avg_miles_stop = 0;
    }else{
       return $avg_miles_stop = number_format($total_pu_mileage/$stops,2);
    }
    return $avg_miles_stop;
}
function avg_hours_stop($time_start,$total_pu_hours,$stops){
    if($time_start == "00:00" || $time_start == null || $time_start==" " || $time_start =="" || $time_start <= 0 || $stops <= 0){
       return $avg_hours_stops = 0.00;
    }else {
       return $avg_hours_stops = ($total_pu_hours/$stops) * 60;
    }
}

function variable_operating($time_start,$net_weight,$reg_hours,$ot,$dt,$total_mileage,$fuel_per_money,$other_expenses){
    if($net_weight == "0" || $net_weight == null || $net_weight==" " || $net_weight =="" || $net_weight ==0 || $net_weight <=0){
        $variable_operating = 0.00;        
    }else{
        $variable_operating = (((5+((($reg_hours*16)+($ot*24)+($dt*32))*1.24)+($total_mileage*0.22)+(($total_mileage/5.5)*$fuel_per_money))+$other_expenses)/$net_weight);
    }
    return $variable_operating;
}

function fixed_overhead($c6,$az,$seven){
     $operating_cost = 0.00;     
     global $db;
     $fiov = $db->query("SELECT value FROM overhead_value WHERE id=1");
     if(count($fiov)>0){
        $fourty_five_hundred = $fiov[0]['value'];
     }else {
        $fourty_five_hundred = 0;
     }
    if($c6 == "00:00" || $c6 == null || $c6==" " || $c6 =="" || $c6 ==0 ||$az ==0){
        return $operating_cost = 0.00;
    }else{
        $operating_cost =  number_format(( $fourty_five_hundred / $seven )/$az,2);
        return $operating_cost;  
    }
}




if(isset($_POST['search_now'])){    
    foreach($_POST as $name=>$value){
        switch($name){
            case "facility":
                if($value !="ignore"){
                    if ( $value == 99){
                        $arrField[] = " iwp_ikg_manifest_info.recieving_facility IN(24,31,30,32,33)";
                    }else{
                        $arrField[] = " iwp_ikg_manifest_info.recieving_facility = $value";
                    }
                }
            break;
            case "drivers":
                if($value !="-"){
                    $arrField[] = "iwp_ikg_manifest_info.driver = $value";
                }
            break;
            case "to":
                if(strlen($value)>0 && $value !="" && $value !=" "){
                    $arrField[] = "DATE(iwp_ikg_manifest_info.scheduled_date) <='$value'";
                }
            break;
            case "from":
                if(strlen($value)>0 && $value !="" && $value !=" "){
                    $arrField[] = "DATE(iwp_ikg_manifest_info.scheduled_date) >='$value'";
                }
            break;
        }
    }
    
    if(!empty($arrField)){
        $string = "AND ".implode(" AND ",$arrField);
    }
    $exl ="";
    if(isset($_POST['rid'])){
        $_SESSION['exlude_list'][] = $_POST['rid'];
        $_SESSION['exlude_list'] = array_unique($_SESSION['exlude_list']);
        if(!empty($_SESSION['exlude_list'])){
            $string .= $exl = " AND iwp_ikg_manifest_info.route_id NOT IN (".implode(",",$_SESSION['exlude_list']).")";
        }    
    }
    
    
    
    
   /* 
    echo "SELECT 
                    iwp_list_of_routes.stops,
                    iwp_ikg_manifest_info.ikg_manifest_route_number,
                    iwp_ikg_manifest_info.net_weight,
                    iwp_ikg_manifest_info.tare_weight,
                    iwp_ikg_manifest_info.tank1,
                    iwp_ikg_manifest_info.tank2,
                    iwp_ikg_manifest_info.gross_weight,
                    iwp_ikg_manifest_info.end_mileage,
                    iwp_ikg_manifest_info.start_mileage,
                    iwp_ikg_manifest_info.fuel,
                    iwp_ikg_manifest_info.route_id,
                    iwp_ikg_manifest_info.end_time,
                    iwp_ikg_manifest_info.time_start,
                    iwp_ikg_manifest_info.driver,
                    iwp_ikg_manifest_info.inventory_code,
                    iwp_ikg_manifest_info.truck,
                    iwp_ikg_manifest_info.fuel_per_gallon,
                    iwp_ikg_manifest_info.other_expense_desc,
                    iwp_ikg_manifest_info.other_expense_value,
                    TIME(iwp_ikg_manifest_info.first_stop) as Time FROM iwp_list_of_routes  LEFT JOIN iwp_ikg_manifest_info  ON iwp_ikg_manifest_info.route_id = iwp_list_of_routes.route_id WHERE iwp_list_of_routes.status IN ('completed') AND iwp_ikg_manifest_info.route_id >0 AND iwp_ikg_manifest_info.route_id IS NOT NULL $string";*/
                    $driver_query = "SELECT 
                    iwp_list_of_routes.stops,
                    iwp_ikg_manifest_info.*,HOUR(   TIMEDIFF( iwp_ikg_manifest_info.last_stop, iwp_ikg_manifest_info.first_stop )   )
           as `total_pu_hours`, HOUR(   TIMEDIFF( iwp_ikg_manifest_info.end_time, iwp_ikg_manifest_info.time_start )   ) as total_hours, (iwp_ikg_manifest_info.gross_weight - iwp_ikg_manifest_info.tare_weight) as net_weight  FROM iwp_list_of_routes  LEFT JOIN iwp_ikg_manifest_info  ON iwp_ikg_manifest_info.route_id = iwp_list_of_routes.route_id WHERE iwp_list_of_routes.deleted =0 AND iwp_list_of_routes.status IN ('completed') AND iwp_ikg_manifest_info.route_id >0 AND iwp_ikg_manifest_info.route_id IS NOT NULL $string
";
    echo $driver_query;
    $x = $db->query($driver_query);
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
        "lengthMenu": [ [500], [500] ]
   }); 
});
</script> 
 <form action="management.php?task=driverslog" method="post">
<table style="width:800px;margin:auto;border: 1px solid #bbb;margin-top:10px;">
<tr><td style="vertical-align: top;">Driver</td><td  style="vertical-align: top;"><?php if(isset($_POST['search_now'])){ 
    getDrivers($_POST['drivers']);
} else {
    getDrivers("");
} ?></td><td  style="vertical-align: top;">Scheduled Start Date</td><td  style="vertical-align: top;"><input type="text" value="<?php if(isset($_POST['search_now'])){
    echo $_POST['from'];
    
} ?>" placeholder="From"  name="from" id="from"/><br /><input type="text" placeholder="To" value="<?php 
        if(isset($_POST['search_now'])){
            echo $_POST['to'];
        }
 ?>" name="to" id="to"/></td></tr>
<tr><td  style="vertical-align: top;">Recieving Facility</td><td  style="vertical-align: top;"><?php if(isset($_POST['search_now'])){  
    getFacilityList("",$_POST['facility']);
    
}else {
    getFacilityList("","");
} ?></td></tr>
<tr><td colspan="2"><a href="management.php?task=driverslog&clear=1">Default Data View</a></td><td colspan="2" style="text-align: right;"><input type="submit" name="search_now" value="Search Now"/></form></td></tr>
<form action="export_log.php" method="post" target="_blank">
<tr><td>Export: </td><td><select name="format"><option value="csv">CSV</option><option value="xls">XLS</option></select><input type="hidden" value="<?php echo $string; ?>" readonly="" id="params" name="params"/><input type="submit" value="Export Now" name="exp_log" id="exp_log"/></td></tr>
</form>
</table>



<table id="myTable" style="width: 2500px;background:white;">
    <thead>
    <tr>
        <td colspan="17" style="background: yellow;text-align:center;vertical-align:center;"> Day 1</td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td colspan="17" style="background: yellow;text-align:center;vertical-align:center;"> Day 2</td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td colspan="7" style="background: white;text-align:center;vertical-align:center;">&nbsp;</td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>     
        <td colspan="29" style="background: gray;text-align:center;vertical-align:center;">&nbsp;</td>   
    </tr>
    <tr>
        <td class="cell_label" >Driver</td>
        <td class="cell_label" >Date</td>
        <td class="cell_label" >Start Time</td>
        <td class="cell_label" >End Time</td>
        <td class="cell_label" >Total Hrs</td>
        <td class="cell_label" >Reg Hrs</td>
        <td class="cell_label" >O.T. Hours</td>
        <td class="cell_label" >D.T. Hours</td>
        <td class="cell_label" >First Stop</td>
        <td class="cell_label" >Last Stop</td>
        <td class="cell_label" >Total P/U Hrs</td>       
        <td class="cell_label" >Start Mileage</td>
        <td class="cell_label" >End Mileage</td>
        <td class="cell_label" >Total Mileage</td>
        <td class="cell_label" >1st Stop Mileage</td>
        <td class="cell_label" >Last Stop Mileage</td>
        <td class="cell_label" >Total P/U Mileage</td>
        <td class="cell_label"  style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        
        <td class="cell_label" >Driver</td>
        <td class="cell_label" >Date</td>
        <td class="cell_label" >Start Time</td>
        <td class="cell_label" >End Time</td>
        <td class="cell_label" >Total Hrs</td>
        <td class="cell_label" >Reg Hrs</td>
        <td class="cell_label" >O.T. Hours</td>
        <td class="cell_label" >D.T. Hours</td>
        <td class="cell_label" >First Stop</td>
        <td class="cell_label" >Last Stop</td>
        <td class="cell_label" >Total P/U Hrs</td>       
        <td class="cell_label" >Start Mileage</td>
        <td class="cell_label" >End Mileage</td>
        <td class="cell_label" >Total Mileage</td>
        <td class="cell_label" >1st Stop Mileage</td>
        <td class="cell_label" >Last Stop Mileage</td>
        <td class="cell_label" >Total P/U Mileage</td>
        <td class="cell_label"  style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td class="cell_label" >Total Hrs</td>
        <td class="cell_label" >Reg Hrs</td>
        <td class="cell_label" >O.T. Hours</td>
        <td class="cell_label" >D.T. Hours</td>
        <td class="cell_label" >Total P/U Hrs</td>
        <td class="cell_label" >Total Mileage</td>
        <td class="cell_label" >Total P/U Mileage</td>
        <td class="cell_label"  style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td class="cell_label" >Fuel Gal</td>
        <td class="cell_label" >Fuel $/ Gal</td>
        <td class="cell_label" >Fuel Cost</td> 
        <td class="cell_label" >Invent Loc.</td>
        <td class="cell_label" >Route</td>
        <td class="cell_label" >Truck</td>
        <td class="cell_label" >Gross Weight</td>
        <td class="cell_label" >Light Weight</td>
        <td class="cell_label" >Net Weight</td>
        <td class="cell_label" >Tanker</td>
        <td class="cell_label" >Total Stops</td>
        <td class="cell_label" >Zero Yield Stops</td>
        <td class="cell_label" >E Stops</td>
        <td class="cell_label" >No Oil</td>
        <td class="cell_label" >Other Expenses</td>
        <td class="cell_label" >Avg Lbs/Stops</td>        
        <td class="cell_label" >Avg Miles/Stops</td>
        <td class="cell_label" >Avg Min/Stops</td>
        <td class="cell_label" >Variable Operating Costs/lb.</td>
        <td class="cell_label" >Fixed Overhead<br /><input style="width: 50px;" type="text" id="overhead" name="overhead" value="<?php 
            $fiov = $db->query("SELECT value FROM overhead_value WHERE id=1");
            if(count($fiov)>0){
                echo $fiov[0]['value'];
            }else {
                echo 0;
            }
        ?>"/></td>
        <td class="cell_label" >Total Cost Per Lbs</td>
        <td class="cell_label" >Total Cost</td>
        <td class="cell_label" >Billed Per Gallon</td>
        <td class="cell_label" >Paid Amount</td>
        <td class="cell_label">TOTAL BILLED AMOUNT</td>
         <td class="cell_label" >Net Income</td>
        <td class="cell_label" >Net Income(Fully Recieved)</td>
        <td  class="cell_label">Income % of Billed</td>
        <td class="cell_label">Route Notes</td>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($x)>0){
        $sum_total_hours1 = 0;
        $sum_reg_hours1 = 0;
        $sum_dt_hours1 = 0;
        $sum_ot1 = 0;
        $sum_pu_hours1 = 0;
        $sum_total_mileage1 = 0;
        $sum_pu_mileage1 = 0;
        $sum_total_hours2= 0;
        $sum_reg_hours2 = 0;
        $sum_dt_hours2 = 0;
        $sum_ot_hours2 = 0;
        $sum_total_mileage2 = 0;
        $sum_pu_mileage2 = 0;
        $sum_hours_all = 0;
        $sum_reg_all = 0;
        $sum_ot_all = 0;
        $sum_dt_all = 0;
        $sum_pu_hours_all = 0;
        $sum_all_milaege = 0;
        $sum_pu_mileage_all = 0;
        $sum_avg_miles = 0;
        $sum_lb_per_stop = 0;
        $sum_avg_hours_stops = 0;
        $sum_fuel = 0;
        $sum_net_weight = 0;
        $sum_stops = 0;
        $sum_zero = 0;
        $sum_emergency = 0;
        $sum_no_oil = 0;
        $sum_expense = 0;
        $sum_var_op = 0;
        $sum_over_head = 0;
        $sum_total_cost = 0;
        foreach($x as $logx){
            
            if($logx['driver'] !=0){
               $driver = uNumToName($logx['driver']);
            } else {
                $driver = "N/A";
            }
            $zero = $db->query("SELECT distinct(schedule_id) FROM iwp_data_table WHERE route_id = $logx[route_id] AND inches_to_gallons = 0");
            
            $skipped = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$logx[route_id] AND zero_gallon_reason IN(12,14,16)");
            
            $emergency = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$logx[route_id] AND zero_gallon_reason =99");
            
            $no_oil = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$logx[route_id] AND zero_gallon_reason = 10");
            
            //************************* DAY 1***************************************************************//      
            $total_hours =  $logx['end_time'] - $logx['time_start'];
            
            
            
            
            
            
            if($total_hours>8){
                $reg_hours = 8;
            } else {
                $reg_hours = $total_hours;
            }
            
            
            if($total_hours >12){
                $dt = $total_hours - 12;
            } else {
                $dt = 0;
            }
            $sum_dt_hours1 +=$dt;
            
            if($total_hours>8){
                $ot = $total_hours - 8 - $dt;
            }else{
                $ot = 0;
            }
            
            $sum_ot1 +=$ot;
            $fs_stop = $logx['first_stop'];
            $ls_stop = $logx['last_stop'];
            $total_day_1 = $ls_stop - $fs_stop;//total pickup hours
            $sum_pu_hours1 +=$total_day_1;
            $total_mileage = $logx['end_mileage'] - $logx['start_mileage'];
            
            
            $sum_total_mileage1 +=$total_mileage;
            $total_pu_mileage = $logx['last_top_mileage'] - $logx['first_stop_mileage'];
            $sum_pu_mileage1 +=$total_pu_mileage;
            //*************************Day 1********************************************************//
            
            
            
            //***************************************Day 2******************************************//
            
            $total_hours2 =  time_end($logx['route_id'],2) - time_start($logx['route_id'],2);
            
            $sum_total_hours2 +=$total_hours2;
            
            if($total_hours2>8){
                $reg_hours2 = 8;
            } else {
                $reg_hours2 = $total_hours2;
            }
            
            
            
            
            
            if($total_hours2 >12){
                $dt2 = $total_hours2 - 12;
            } else {
                $dt2 = 0;
            }
            
            $sum_dt_hours2 +=$dt2;
            
            if($total_hours2>8){
                $ot2 = $total_hours2 - 8 - $dt2;
            }else{
                $ot2 = 0;
            }
            
            $sum_ot_hours2 +=$ot2;
            
            $total_day_2 = end_time_from_date($logx['route_id'],2) - start_time_from_date($logx['route_id'],2);
            
           
            
            
            
            $total_mileage2 = end_mileage($logx['route_id'],2) - start_mileage($logx['route_id'],2);
            
           
            
            //***************************************Day 2******************************************//
            
            $all_hours = $total_hours+$total_hours2;
            $sum_hours_all +=$all_hours;
            
            $all_reg = $reg_hours + $reg_hours2;
            $sum_reg_all +=$all_reg;
            
            $all_ot = $ot+$ot2;
            $sum_ot_all +=$all_ot;
            
            $all_dt = $dt+$dt2;
            $sum_dt_all +=$all_dt;
            
            $total_pu_hours = total_hours($logx['route_id'],1) + total_hours($logx['route_id'],2);
            $sum_pu_hours_all += $total_pu_hours;
            
            
            
            
            $all_mileage = $total_mileage+$total_mileage2;
            $sum_all_milaege +=$all_mileage;
            
            $all_pu_mileage = $total_pu_mileage+$total_pu_mileage2;
            $sum_pu_mileage_all +=$all_pu_mileage;
             
            $skip = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$logx[route_id] AND zero_gallon_reason !=0");
            $avg_lb_stop = lb_per_stop($logx['net_weight'],$logx['stops']);
            $avg_fuel = fuel_gal($all_mileage);            
            //$fuel_per_money = avg_fuel_money($logx['net_weight'],$logx['stops']); 
            $avg_miles_stop = avg_miles_per_stop($total_pu_mileage,$logx['stops']);            
            $sum_avg_miles +=$avg_miles_stop;
            
            
            $lb_per_stop = lb_per_stop($logx['net_weight'],$logx['stops']);
            $sum_lb_per_stop +=$lb_per_stop;
            $avg_hours_stops = avg_hours_stop($logx['time_start'],$total_pu_hours,$logx['stops']);
            $sum_avg_hours_stops +=$avg_hours_stops;
            
            $variable_operating = variable_operating($logx['time_start'],$logx['net_weight'],$all_reg,$all_ot,$all_dt,$total_mileage+$total_mileage2,$logx['fuel_per_gallon'],$logx['other_expense_value']);
            
            
            $over_head =   fixed_overhead($logx['time_start'],  $logx['gross_weight'] - $logx['net_weight'],count($x) );
            
            
            
                
        echo "<tr>
        <td>$driver</td>
        <td>$logx[scheduled_date]</td>
        <td>$logx[time_start]</td>
        <td>$logx[end_time]</td>
        <td>$logx[total_hours]</td>
        <td>$reg_hours</td>
        <td>$ot</td>
        <td>$dt</td>
        <td>$logx[first_stop]</td>
        <td>$logx[last_stop]</td>
        <td>$logx[total_pu_hours]</td>
        <td>$logx[start_mileage]</td>
        <td>$logx[end_mileage]</td>
        <td>$total_mileage</td>
        <td>$logx[first_stop_mileage]</td>
        <td>$logx[last_top_mileage]</td>
        <td>$total_pu_mileage</td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td>$driver</td>
        <td>".start_date($logx['route_id'],2)."</td>
        <td>".time_start($logx['route_id'],2)."</td>
        <td>".time_end($logx['route_id'],2)."</td>
        <td>$total_hours2</td>
        <td>$reg_hours2</td>
        <td>$ot2</td>
        <td>$dt2</td>
        <td>".start_time_from_date($logx['route_id'],2)."</td>
        <td>".end_time_from_date($logx['route_id'],2)."</td>
        <td>$total_day_2</td>        
        <td>".start_mileage($logx['route_id'],2)."</td>
        <td>".end_mileage($logx['route_id'],2)."</td>
        <td>$total_mileage2</td>
         <td>".first_stop_mileage($logx['route_id'],2)."</td>
        <td>".last_stop_mileage($logx['route_id'],2)."</td>
        <td>$total_pu_mileage2</td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td>$all_hours</td>
        <td>$all_reg</td>
        <td>$all_ot</td>
        <td>$all_dt</td>
        <td>$total_pu_hours</td>
        <td>$all_mileage</td>
        <td>$total_pu_mileage</td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
         <td>$avg_fuel</td>
        <td><input type='text' class='fpm' value='$logx[fuel_per_gallon]' rel='$logx[route_id]' style='width:40px;'/></td>
        <td>".number_format($avg_fuel*$logx['fuel_per_gallon'],2)."</td>";
        $sum_fuel +=number_format($avg_fuel*$logx['fuel_per_gallon'],2); 
        echo "<td>$logx[inventory_code]</td>
        <td><form method='post' target='_blank' action='oil_routing.php' class='form'><span style='cursor:pointer;text-decoration:underline;'>$logx[ikg_manifest_route_number]</span><input type='hidden' name='manifest' value='$logx[route_id]'/>
        <input type='hidden' name='from_routed_oil_pickups' value='1'/>
        </form><br/>
        
        <form action='management.php?task=driverslog' method='post'>
        <input type='hidden' name='rid' value='$logx[route_id]'/>
        <input type='hidden' id='driver' name='drivers' value='$_POST[drivers]'/>
        <input type='hidden' id='to' name='to' value='$_POST[to]'/>
        <input type='hidden' id='from' name='from' value='$_POST[from]'/>
        <input type='hidden' id'fac' name='facility' value='$_POST[facility]'/>
        <input type='submit' value='Exclude Route' name='search_now'/>
        </form></td>
        <td>"; 
            if(strlen(trim($logx['truck']))>0){
                echo vehicle_name($logx['truck']);
            }else{
                echo "Truck Not Set";
            }
        
        echo "</td>
        <td>$logx[gross_weight]</td>
        <td>$logx[tare_weight]</td>
        <td>$logx[net_weight]</td>";
        $sum_net_weight +=$logx['net_weight'];
        
        echo "<td>$logx[tank1]<br/>$logx[tank2]</td>
        <td>$logx[stops]</td>";
        $sum_stops +=$logx['stops'];
        echo "<td>".count($zero)."</td>"; 
        $sum_zero += count($zero);
        echo "<td>".count($emergency)."
        </td>"; 
        $sum_emergency +=count($emergency);
        echo "<td>".count($no_oil)."</td>"; 
        $sum_no_oil +=count($no_oil);
        echo "<td><input style='width:50px;' type='text' placeholder='Other Expense Price' class='other_expense_value' rel='$logx[route_id]' value='$logx[other_expense_value]' /><br/>
        <textarea style='width:150px;' class='expense_desc' placeholder='Expense Description'  rel='$logx[route_id]'>$logx[other_expense_desc]</textarea></td>";
        $sum_expense += $logx['other_expense_value'];
        echo "
        <td>$lb_per_stop</td>        
        <td>$avg_miles_stop</td>
        <td>".number_format($avg_hours_stops,2)."</td>
        <td>".number_format($variable_operating,4)."</td>";
        $sum_var_op +=number_format($variable_operating,4);
        echo "<td>".number_format($over_head,4)."</td>";
        $sum_over_head +=$over_head;
        echo "<td>"; 
        echo number_format($variable_operating  + $over_head,4);
        echo"</td>";
        
        echo "<td>"; //Total Cost
                
           
        echo "Total Cost</td>
        <td>"; //billed/gallon
          
        
        echo "Billed Gallons (replace net_weight ?)</td>
        <td>"; //paid amount
           
        echo "Paid Amount requires Paytrace</td>
        <td>".//total billed amount 
            number_format(charged_amount($logx['route_id']),2)."</td> 
            <td>requires Paytrace</td>
        <td>"; //Net Income
           
        echo "Net Income requires Paytrace</td>";
        echo "<td>";
        echo "requires Paytrace</td>";
        echo "<td>$logx[route_notes]</td>"; 
        echo "</tr>";
        $sum_total_cost +=number_format($variable_operating  + $over_head,4);
        }
    }
    ?>
    </tbody>
    <tr><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_total_hours1; ?></td>
        <td><?php echo $sum_reg_hours1; ?></td>
        <td><?php echo $sum_ot1; ?></td>
        <td><?php echo $sum_dt_hours1; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_pu_hours1; ?></td>       
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_total_mileage1; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_pu_mileage1; ?></td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
         <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_total_hours2; ?></td>
        <td><?php echo $sum_reg_hours2; ?></td>
        <td><?php echo $sum_ot_hours2; ?></td>
        <td><?php echo $sum_dt_hours2; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>       
        <td><?php echo $sum_total_hours2; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_total_mileage2; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_pu_mileage2; ?></td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td><?php echo $sum_hours_all; ?></td>
        <td><?php echo $sum_reg_all; ?></td>
        <td><?php echo $sum_ot_all; ?></td>
        <td><?php echo $sum_dt_all;  ?></td>
        <td><?php echo $sum_pu_hours_all; ?></td>
        <td><?php echo $sum_all_milaege; ?></td>
        <td><?php echo $sum_pu_mileage_all; ?></td>
        <td style='background:black;padding:0px 0px 0px 0px;'>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_fuel; ?></td>
        <td>&nbsp;</td>
        <td><?php echo count($x); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $sum_net_weight; ?></td>
        <td>&nbsp;</td>
        <td><?php echo $sum_stops; ?></td>
        <td><?php echo $sum_zero; ?></td>
        <td><?php echo $sum_emergency; ?></td>
        <td><?php echo $sum_no_oil; ?></td>
        <td><?php echo $sum_expense; ?></td>
        <td><?php echo $sum_lb_per_stop; ?></td>
        <td><?php echo $sum_avg_miles; ?></td>
        <td><?php echo number_format($sum_avg_hours_stops,4); ?></td>
        <td><?php echo number_format($sum_var_op/count($x),4 ); ?></td>
        <td><?php echo number_format($sum_over_head/count($x),4); ?></td>
        <td><?php echo number_format($sum_total_cost/count($x),4); ?></td>
        </tr>
</table>
<script>
$(".fpm").change(function(){
    $.post("update_fpm.php",{route_id:$(this).attr('rel'), new_fpm:$(this).val() },function(data){
        alert(data);
    }) 
});

$(".other_expense_value").change(function(){
    $.post("update_expense.php",{mode:1,oev:$(this).val(),route_id:$(this).attr('rel')},function(data){
        alert("Expense Price updated! "+data);
    });
});

$(".expense_desc").change(function(){
    $.post("update_expense.php",{mode:2,oed:$(this).val(),route_id:$(this).attr('rel')},function(data){
        alert("Expense Description updated! "+data);
    });
});

$("#overhead").change(function(){
    $.post('change_overhead.php',{ value:$(this).val() },function(data){
       alert("Over Head Variable changed!"); 
    });
})

$(".form").click(function(){
   $(this).submit(); 
});
</script>