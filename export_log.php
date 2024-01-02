<?php
include "protected/global.php";
ini_set("display_errors",0);

function start_date($route_id,$day){
    global $db;
    $sched = $db->query("SELECT DATE(start_date) as Date FROM iwp_rout_history WHERE route_no = $route_id AND what_day =$day");
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
 $dataString="";
if(isset($_POST['exp_log'])){
     $x = $db->query("SELECT 
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
                    TIME(iwp_ikg_manifest_info.first_stop) as Time FROM iwp_list_of_routes  LEFT JOIN iwp_ikg_manifest_info  ON iwp_ikg_manifest_info.route_id = iwp_list_of_routes.route_id WHERE iwp_list_of_routes.status IN ('completed') AND iwp_ikg_manifest_info.route_id >0 AND iwp_ikg_manifest_info.route_id IS NOT NULL $_POST[params]
");
    if(count($x)>0){
        switch($_POST['format']){
            case "csv":
            /**/header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-type: text/csv");
            $fileName = "drivers_log".date("Ymdhis").".csv";
            header("Content-Disposition: attachment; filename={$fileName}");
            header("Expires: 0");
            header("Content-Transfer-Encoding: binary");
            header("Pragma: public");
            foreach($x as $log){
                if($log['driver'] !=0){
                    $ik = new Person($log['driver']);        
                   $driver = $ik->fullname;
                } else {
                    $driver = "N/A";
                }
                $zero = $db->query("SELECT distinct(schedule_id) FROM iwp_data_table WHERE route_id = $log[route_id] AND inches_to_gallons = 0");
                
                $skipped = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason IN(12,14,16)");
                
                $emergency = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason =99");
                
                $no_oil = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason = 10");
                
                //************************* DAY 1***************************************************************//      
                $total_hours =  time_end($log['route_id'],1) - time_start($log['route_id'],1);
            
            
            
                $sum_total_hours1 +=$total_hours;
                
                
                if($total_hours>8){
                    $reg_hours = 8;
                } else {
                    $reg_hours = $total_hours;
                }
                
                $sum_reg_hours1 += $reg_hours;
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
                $fs_stop = start_time_from_date($log['route_id'],1);
                $ls_stop = end_time_from_date($log['route_id'],1);
                $total_day_1 = end_time_from_date($log['route_id'],1) - start_time_from_date($log['route_id'],1);//total pickup hours
                $sum_pu_hours1 +=$total_day_1;
                $total_mileage = end_mileage($log['route_id'],1) - start_mileage($log['route_id'],1);
                
                
                $sum_total_mileage1 +=$total_mileage;
                $total_pu_mileage = last_stop_mileage($log['route_id'],1) - first_stop_mileage($log['route_id'],1);
                $sum_pu_mileage1 +=$total_pu_mileage;
                //*************************Day 1********************************************************//
            
            
            
                //***************************************Day 2******************************************//
                
                $total_hours2 =  time_end($log['route_id'],2) - time_start($log['route_id'],2);
                
                $sum_total_hours2 +=$total_hours2;
                
                if($total_hours2>8){
                    $reg_hours2 = 8;
                } else {
                    $reg_hours2 = $total_hours2;
                }
                
                
                
                $sum_reg_hours2 +=$reg_hours;
                
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
                
                $total_day_2 = end_time_from_date($log['route_id'],2) - start_time_from_date($log['route_id'],2);
                
                $sum_total_hours2 +=$total_day_2;
                
                
                
                $total_mileage2 = end_mileage($log['route_id'],2) - start_mileage($log['route_id'],2);
                
                $sum_total_mileage2 +=$total_mileage2;
                $total_pu_mileage2 = last_stop_mileage($log['route_id'],2) - first_stop_mileage($log['route_id'],2);
                $sum_pu_mileage2 += $total_pu_mileage2;
            
            //***************************************Day 2******************************************//
            
                $all_hours = $total_hours+$total_hours2;
                $sum_hours_all +=$all_hours;
                
                $all_reg = $reg_hours + $reg_hours2;
                $sum_reg_all +=$all_reg;
                
                $all_ot = $ot+$ot2;
                $sum_ot_all +=$all_ot;
                
                $all_dt = $dt+$dt2;
                $sum_dt_all +=$all_dt;
                
                $total_pu_hours = total_hours($log['route_id'],1) + total_hours($log['route_id'],2);
                $sum_pu_hours_all += $total_pu_hours;
                
                
                
                
                $all_mileage = $total_mileage+$total_mileage2;
                $sum_all_milaege +=$all_mileage;
                
                $all_pu_mileage = $total_pu_mileage+$total_pu_mileage2;
                $sum_pu_mileage_all +=$all_pu_mileage;
                 
                $skip = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason !=0");
                $avg_lb_stop = lb_per_stop($log['net_weight'],$log['stops']);
                $avg_fuel = fuel_gal($all_mileage);            
                //$fuel_per_money = avg_fuel_money($log['net_weight'],$log['stops']); 
                $avg_miles_stop = avg_miles_per_stop($total_pu_mileage,$log['stops']);            
                $sum_avg_miles +=$avg_miles_stop;
            
            
                $lb_per_stop = lb_per_stop($log['net_weight'],$log['stops']);
                $sum_lb_per_stop +=$lb_per_stop;
                $avg_hours_stops = avg_hours_stop($log['time_start'],$total_pu_hours,$log['stops']);
                $sum_avg_hours_stops +=$avg_hours_stops;
                
                $variable_operating = variable_operating($log['time_start'],$log['net_weight'],$all_reg,$all_ot,$all_dt,$total_mileage+$total_mileage2,$log['fuel_per_gallon'],$log['other_expense_value']);
                
                
                $over_head =   fixed_overhead($log['time_start'],  $log['gross_weight'] - $log['net_weight'],count($x) );
            
            
            
                
                $dataString .= "$driver,".start_date($log['route_id'],1).",".time_start($log['route_id'],1).",".time_end($log['route_id'],1).",$total_hours,$reg_hours,$ot,$dt,".start_time_from_date($log['route_id'],1).",".end_time_from_date($log['route_id'],1).",$total_day_1,".start_mileage($log['route_id'],1).",".end_mileage($log['route_id'],1).",$total_mileage,".first_stop_mileage($log['route_id'],1).",".last_stop_mileage($log['route_id'],1).",$total_pu_mileage,$driver,".start_date($log['route_id'],2).",".time_start($log['route_id'],2).",".time_end($log['route_id'],2).",$total_hours2,$reg_hours2,$ot2,$dt2,".start_time_from_date($log['route_id'],2).",".end_time_from_date($log['route_id'],2).",$total_day_2,".start_mileage($log['route_id'],2).",".end_mileage($log['route_id'],2).",$total_mileage2,".first_stop_mileage($log['route_id'],2).",".last_stop_mileage($log['route_id'],2).",$total_pu_mileage2,$all_hours,$all_reg,$all_ot,$all_dt,$total_pu_hours,$all_mileage,$all_pu_mileage,$avg_fuel,$log[fuel_per_gallon],".number_format($avg_fuel*$log['fuel_per_gallon'],2).",$log[inventory_code],$log[ikg_manifest_route_number],".vehicle_name($log['truck']).",$log[gross_weight],$log[tare_weight],$log[net_weight],$log[tank1] $log[tank2],$log[stops],".count($zero).",".count($emergency).",".count($no_oil).",$log[other_expense_value]' $log[other_expense_desc],$lb_per_stop,$avg_miles_stop,".number_format($avg_hours_stops,2).",".number_format($variable_operating,4).",".number_format($over_head,4).",".number_format($variable_operating  + $over_head,4)."\r\n";
                
                
            }
           
            //echo $dataString;
            
            
            $fh = @fopen( "php://output", 'w' );
            fwrite($fh, $dataString);
            fclose($fh);/**/
            break;
            case "xls":
                $file = "drivers_log".date("YmdHm").".xls";
                include "protected/xlsfunctions.php";
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");           
                header("Content-Disposition: attachment;filename=$file");
                header("Content-Transfer-Encoding: binary "); 
                $xlsRow = 0;
                $xlsCol = 0;
                xlsBOF();
                xlsWriteLabel($xlsRow,0,"Driver");
                xlsWriteLabel($xlsRow,2,"Date");
                xlsWriteLabel($xlsRow,4,"Start Time"); 
                xlsWriteLabel($xlsRow,6,"End Time");
                xlsWriteLabel($xlsRow,8,"Total Hrs");
                xlsWriteLabel($xlsRow,10,"Reg Hrs");
                xlsWriteLabel($xlsRow,12,"O.T. Hours");
                xlsWriteLabel($xlsRow,14,"D.T. Hours");
                xlsWriteLabel($xlsRow,16,"First Stop"); 
                xlsWriteLabel($xlsRow,18,"Last Stop");
                xlsWriteLabel($xlsRow,20,"Total P/U Hrs");
                xlsWriteLabel($xlsRow,22,"Start Mileage");
                xlsWriteLabel($xlsRow,24,"End Mileage");
                xlsWriteLabel($xlsRow,26,"Total Mileage");
                xlsWriteLabel($xlsRow,28,"1st Stop Mileage");
                xlsWriteLabel($xlsRow,30,"Last Stop Mileage");
                xlsWriteLabel($xlsRow,32,"Total P/U Mileage");
                
                xlsWriteLabel($xlsRow,34," ");
                
                xlsWriteLabel($xlsRow,36,"Driver");
                xlsWriteLabel($xlsRow,38,"Date");
                xlsWriteLabel($xlsRow,40,"Start Time"); 
                xlsWriteLabel($xlsRow,42,"End Time");
                xlsWriteLabel($xlsRow,44,"Total Hrs");
                xlsWriteLabel($xlsRow,46,"Reg Hrs");
                xlsWriteLabel($xlsRow,48,"O.T. Hours");
                xlsWriteLabel($xlsRow,50,"D.T. Hours");
                xlsWriteLabel($xlsRow,52,"First Stop"); 
                xlsWriteLabel($xlsRow,54,"Last Stop");
                 xlsWriteLabel($xlsRow,56,"Total P/U Hrs");
                xlsWriteLabel($xlsRow,58,"Start Mileage");
                xlsWriteLabel($xlsRow,60,"End Mileage");
                xlsWriteLabel($xlsRow,62,"Total Mileage");
                xlsWriteLabel($xlsRow,66,"1st Stop Mileage");
                xlsWriteLabel($xlsRow,68,"Last Stop Mileage");
                xlsWriteLabel($xlsRow,70,"Total P/U Mileage");
                
                xlsWriteLabel($xlsRow,72," ");
                
                xlsWriteLabel($xlsRow,74,"Total Hrs");
                xlsWriteLabel($xlsRow,76,"Reg Hrs");
                xlsWriteLabel($xlsRow,78,"O.T. Hours"); 
                xlsWriteLabel($xlsRow,80,"D.T. Hours");
                xlsWriteLabel($xlsRow,82,"Total P/U Hrs");
                xlsWriteLabel($xlsRow,84,"Total Mileage");
                xlsWriteLabel($xlsRow,86,"Total P/U Mileage");
                xlsWriteLabel($xlsRow,88," ");
                
                xlsWriteLabel($xlsRow,90,"Fuel Gal");
                xlsWriteLabel($xlsRow,92,"Fuel $/ Gal");
                xlsWriteLabel($xlsRow,96,"Fuel Cost"); 
                xlsWriteLabel($xlsRow,98,"Invent Loc.");
                xlsWriteLabel($xlsRow,100,"Route");
                xlsWriteLabel($xlsRow,102,"Truck");
                
                xlsWriteLabel($xlsRow,104,"Gross Weight");
                xlsWriteLabel($xlsRow,108,"Light Weight");
                xlsWriteLabel($xlsRow,110,"Net Weight"); 
                xlsWriteLabel($xlsRow,112,"Tanker");
                xlsWriteLabel($xlsRow,114,"Total Stops");
                xlsWriteLabel($xlsRow,116,"Zero Yield Stops");
                xlsWriteLabel($xlsRow,118,"E Stops");
                xlsWriteLabel($xlsRow,120,"No Oil");
                xlsWriteLabel($xlsRow,122,"Other Expenses");
                xlsWriteLabel($xlsRow,124,"Avg Lbs/Stops");
                xlsWriteLabel($xlsRow,126,"Avg Miles/Stops");
                
                
                xlsWriteLabel($xlsRow,128,"Avg Min/Stops");
                xlsWriteLabel($xlsRow,130,"Variable Operating Costs/lb.");
                xlsWriteLabel($xlsRow,132,"Fixed Overhead");
                xlsWriteLabel($xlsRow,134,"Total Cost Per Lbs");
                foreach($x as $log){
                    $count++;
                    $xlsRow++;
                    if($log['driver'] !=0){
                        $ik = new Person($log['driver']);        
                        $driver = $ik->fullname;
                    } else {
                        $driver = "N/A";
                    }
                    $zero = $db->query("SELECT distinct(schedule_id) FROM iwp_data_table WHERE route_id = $log[route_id] AND inches_to_gallons = 0");
                    
                    $skipped = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason IN(12,14,16)");
                    
                    $emergency = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason =99");
                    
                    $no_oil = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason = 10");
                    
                    //************************* DAY 1***************************************************************//      
                    $total_hours =  time_end($log['route_id'],1) - time_start($log['route_id'],1);
                    
                    
                    
                    $sum_total_hours1 +=$total_hours;
                    
                    
                    if($total_hours>8){
                        $reg_hours = 8;
                    } else {
                        $reg_hours = $total_hours;
                    }
                    
                    $sum_reg_hours1 += $reg_hours;
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
                    $fs_stop = start_time_from_date($log['route_id'],1);
                    $ls_stop = end_time_from_date($log['route_id'],1);
                    $total_day_1 = end_time_from_date($log['route_id'],1) - start_time_from_date($log['route_id'],1);//total pickup hours
                    $sum_pu_hours1 +=$total_day_1;
                    $total_mileage = end_mileage($log['route_id'],1) - start_mileage($log['route_id'],1);
                    
                    
                    $sum_total_mileage1 +=$total_mileage;
                    $total_pu_mileage = last_stop_mileage($log['route_id'],1) - first_stop_mileage($log['route_id'],1);
                    $sum_pu_mileage1 +=$total_pu_mileage;
                    //*************************Day 1********************************************************//
                    
                    
                    
                    //***************************************Day 2******************************************//
                    
                    $total_hours2 =  time_end($log['route_id'],2) - time_start($log['route_id'],2);
                    
                    $sum_total_hours2 +=$total_hours2;
                    
                    if($total_hours2>8){
                        $reg_hours2 = 8;
                    } else {
                        $reg_hours2 = $total_hours2;
                    }
                    
                    
                    
                    $sum_reg_hours2 +=$reg_hours;
                    
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
                    
                    $total_day_2 = end_time_from_date($log['route_id'],2) - start_time_from_date($log['route_id'],2);
                    
                    $sum_total_hours2 +=$total_day_2;
                    
                    
                    
                    $total_mileage2 = end_mileage($log['route_id'],2) - start_mileage($log['route_id'],2);
                    
                    $sum_total_mileage2 +=$total_mileage2;
                    $total_pu_mileage2 = last_stop_mileage($log['route_id'],2) - first_stop_mileage($log['route_id'],2);
                    $sum_pu_mileage2 += $total_pu_mileage2;
                    
                    //***************************************Day 2******************************************//
                    
                    $all_hours = $total_hours+$total_hours2;
                    $sum_hours_all +=$all_hours;
                    
                    $all_reg = $reg_hours + $reg_hours2;
                    $sum_reg_all +=$all_reg;
                    
                    $all_ot = $ot+$ot2;
                    $sum_ot_all +=$all_ot;
                    
                    $all_dt = $dt+$dt2;
                    $sum_dt_all +=$all_dt;
                    $total_pu_hours = total_hours($log['route_id'],1) + total_hours($log['route_id'],2);
                    $sum_pu_hours_all += $total_pu_hours;
                    $all_mileage = $total_mileage+$total_mileage2;
                    $sum_all_milaege +=$all_mileage;
                    $all_pu_mileage = $total_pu_mileage+$total_pu_mileage2;
                    $sum_pu_mileage_all +=$all_pu_mileage;
                    $skip = $db->query("SELECT DISTINCT(schedule_id) FROM iwp_data_table WHERE route_id=$log[route_id] AND zero_gallon_reason !=0");
                    $avg_lb_stop = lb_per_stop($log['net_weight'],$log['stops']);
                    $avg_fuel = fuel_gal($all_mileage);            
                    //$fuel_per_money = avg_fuel_money($log['net_weight'],$log['stops']); 
                    $avg_miles_stop = avg_miles_per_stop($total_pu_mileage,$log['stops']);            
                    $sum_avg_miles +=$avg_miles_stop;
                    $lb_per_stop = lb_per_stop($log['net_weight'],$log['stops']);
                    $sum_lb_per_stop +=$lb_per_stop;
                    $avg_hours_stops = avg_hours_stop($log['time_start'],$total_pu_hours,$log['stops']);
                    $sum_avg_hours_stops +=$avg_hours_stops;
                    $variable_operating = variable_operating($log['time_start'],$log['net_weight'],$all_reg,$all_ot,$all_dt,$total_mileage+$total_mileage2,$log['fuel_per_gallon'],$log['other_expense_value']);
                    $over_head =   fixed_overhead($log['time_start'],  $log['gross_weight'] - $log['net_weight'],count($x) );
                    xlsWriteLabel($xlsRow,0,"$driver");
                    xlsWriteLabel($xlsRow,2,start_date($log['route_id'],1));
                    xlsWriteLabel($xlsRow,4,time_start($log['route_id'],1)); 
                    xlsWriteLabel($xlsRow,6,time_end($log['route_id'],1));
                    xlsWriteLabel($xlsRow,8,$total_hours);
                    xlsWriteLabel($xlsRow,10,$reg_hours);
                    xlsWriteLabel($xlsRow,12,$ot);
                    xlsWriteLabel($xlsRow,14,$dt);
                    xlsWriteLabel($xlsRow,16,start_time_from_date($log['route_id'],1)); 
                    xlsWriteLabel($xlsRow,18,end_time_from_date($log['route_id'],1));
                    xlsWriteLabel($xlsRow,20,$total_day_1);
                    xlsWriteLabel($xlsRow,22,start_mileage($log['route_id'],1));
                    xlsWriteLabel($xlsRow,24,end_mileage($log['route_id'],1));
                    xlsWriteLabel($xlsRow,26,$total_mileage);
                    xlsWriteLabel($xlsRow,28,first_stop_mileage($log['route_id'],1));
                    xlsWriteLabel($xlsRow,30,last_stop_mileage($log['route_id'],1));
                    xlsWriteLabel($xlsRow,32,$total_pu_mileage);
                    xlsWriteLabel($xlsRow,34," ");
                    xlsWriteLabel($xlsRow,36,"$driver");
                    xlsWriteLabel($xlsRow,38,start_date($log['route_id'],2));
                    xlsWriteLabel($xlsRow,40,time_start($log['route_id'],2)); 
                    xlsWriteLabel($xlsRow,42,time_end($log['route_id'],2));
                    xlsWriteLabel($xlsRow,44,$total_hours2);
                    xlsWriteLabel($xlsRow,46,$reg_hours2);
                    xlsWriteLabel($xlsRow,48,$ot2);
                    xlsWriteLabel($xlsRow,50,$dt2);
                    xlsWriteLabel($xlsRow,52,start_time_from_date($log['route_id'],2)); 
                    xlsWriteLabel($xlsRow,54,end_time_from_date($log['route_id'],2));
                    xlsWriteLabel($xlsRow,56,$total_day_2);
                    xlsWriteLabel($xlsRow,58,start_mileage($log['route_id'],2));
                    xlsWriteLabel($xlsRow,60,end_mileage($log['route_id'],2));
                    xlsWriteLabel($xlsRow,62,$total_mileage2);
                    xlsWriteLabel($xlsRow,66,first_stop_mileage($log['route_id'],2));
                    xlsWriteLabel($xlsRow,68,last_stop_mileage($log['route_id'],2));
                    xlsWriteLabel($xlsRow,70,$total_pu_mileage2);
                    
                    xlsWriteLabel($xlsRow,72," ");
                
                    xlsWriteLabel($xlsRow,74,$all_hours);
                    xlsWriteLabel($xlsRow,76,$all_reg);
                    xlsWriteLabel($xlsRow,78,$all_ot); 
                    xlsWriteLabel($xlsRow,80,$all_dt);
                    xlsWriteLabel($xlsRow,82,$total_pu_hours);
                    xlsWriteLabel($xlsRow,84,$all_mileage);
                    xlsWriteLabel($xlsRow,86,$all_pu_mileage);
                    xlsWriteLabel($xlsRow,88," ");
                
                    xlsWriteLabel($xlsRow,90,$avg_fuel);
                    xlsWriteLabel($xlsRow,92,$log['fuel_per_gallon']);
                    xlsWriteLabel($xlsRow,96,number_format($avg_fuel*$log['fuel_per_gallon'],2));
                    $sum_fuel +=number_format($avg_fuel*$log['fuel_per_gallon'],2);  
                    xlsWriteLabel($xlsRow,98,$log['inventory_code']);
                    xlsWriteLabel($xlsRow,100,$log['ikg_manifest_route_number']);
                    xlsWriteLabel($xlsRow,102,vehicle_name($log['truck']));
                    
                    xlsWriteLabel($xlsRow,104,$log['gross_weight']);
                    xlsWriteLabel($xlsRow,108,$log['tare_weight']);
                    xlsWriteLabel($xlsRow,110,$log['net_weight']); 
                    xlsWriteLabel($xlsRow,112,"$log[tank1]\r\n$log[tank2]");
                    xlsWriteLabel($xlsRow,114,"$log[stops]");
                    $sum_stops +=$log['stops'];
                    xlsWriteLabel($xlsRow,116,count($zero));
                    $sum_zero += count($zero);
                    xlsWriteLabel($xlsRow,118,count($emergency));
                    $sum_emergency +=count($emergency);
                    xlsWriteLabel($xlsRow,120,count($no_oil));
                    $sum_no_oil +=count($no_oil);
                    xlsWriteLabel($xlsRow,122,"$log[other_expense_value]\r\n$log[other_expense_desc]");
                    $sum_expense += $log['other_expense_value'];
                    xlsWriteLabel($xlsRow,124,"$lb_per_stop");
                    xlsWriteLabel($xlsRow,126,"$avg_miles_stop");
                    xlsWriteLabel($xlsRow,128,number_format($avg_hours_stops,2));
                    xlsWriteLabel($xlsRow,130,number_format($variable_operating,4));
                    $sum_var_op +=number_format($variable_operating,4);
                    xlsWriteLabel($xlsRow,132,number_format($over_head,4));
                    $sum_over_head +=$over_head;
                    xlsWriteLabel($xlsRow,134,number_format($variable_operating  + $over_head,4));
                    $sum_total_cost +=number_format($variable_operating  + $over_head,4);
                }
                $xlsRow +=2;
                xlsWriteLabel($xlsRow,8,$sum_total_hours1);
                xlsWriteLabel($xlsRow,10,$sum_reg_hours1);
                xlsWriteLabel($xlsRow,12,$sum_ot1);
                xlsWriteLabel($xlsRow,14,$sum_dt_hours1);
                xlsWriteLabel($xlsRow,20,$sum_pu_hours1);
                xlsWriteLabel($xlsRow,26,$sum_total_mileage1);
                xlsWriteLabel($xlsRow,32,$sum_pu_mileage1);
                
                xlsWriteLabel($xlsRow,44,$sum_total_hours2);
                xlsWriteLabel($xlsRow,46,$sum_reg_hours2);
                xlsWriteLabel($xlsRow,48,$sum_ot_hours2);
                xlsWriteLabel($xlsRow,50,$sum_dt_hours2);
                xlsWriteLabel($xlsRow,56,$sum_total_hours2);
                xlsWriteLabel($xlsRow,62,$sum_total_mileage2);
                xlsWriteLabel($xlsRow,70,$sum_pu_mileage_all);
                
                xlsWriteLabel($xlsRow,74,$sum_hours_all);
                xlsWriteLabel($xlsRow,76,$sum_reg_all);
                xlsWriteLabel($xlsRow,78,$sum_ot_all); 
                xlsWriteLabel($xlsRow,80,$sum_dt_all);
                xlsWriteLabel($xlsRow,82,$sum_pu_hours_all);
                xlsWriteLabel($xlsRow,84,$sum_all_milaege);
                xlsWriteLabel($xlsRow,86,$sum_pu_mileage_all);
                xlsWriteLabel($xlsRow,90,$sum_fuel);
                xlsWriteLabel($xlsRow,100,count($x));
                xlsWriteLabel($xlsRow,110,$sum_net_weight); 
                xlsWriteLabel($xlsRow,114,$sum_stops);
                xlsWriteLabel($xlsRow,116,$sum_zero);
                xlsWriteLabel($xlsRow,118,$sum_emergency);
                xlsWriteLabel($xlsRow,120,$sum_no_oil);
                xlsWriteLabel($xlsRow,122,$sum_expense);
                xlsWriteLabel($xlsRow,124,$sum_lb_per_stop);
                xlsWriteLabel($xlsRow,126,$sum_avg_miles);
                xlsWriteLabel($xlsRow,128,number_format($sum_avg_hours_stops,4));
                xlsWriteLabel($xlsRow,130,number_format($sum_var_op/count($x),4 ));
                xlsWriteLabel($xlsRow,132,number_format($sum_over_head/count($x),4));
                xlsWriteLabel($xlsRow,134,number_format($sum_total_cost/count($x)));
                xlsEOF();
            
            break;
        }
    }
}


?>