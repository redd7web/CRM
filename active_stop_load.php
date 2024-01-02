
<?php
    include "protected/global.php";
    ini_set("display_errors",0);
    $alter = 0;
    $count = 1;  
    $total_caps = 0;  
    if(isset($_POST['from_routed_oil_pickups'])){
            $preVal = null;
            if(!empty($_POST['schedule_list'])){
                $aaccoouunntt = new Account();                 
                 foreach ($_POST['schedule_list'] as $ekc ){
                    $alter++;
                    if($alter%2 == 0){
                        $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
                    }
                    else { 
                        $bg = 'transparent';
                    }
                    if($ekc != NULL){
                        $sched_ro = new Scheduled_Routes($ekc);
                        $aaccoouunntt = new Account();
                        $total_pickedup_for_this_route =total_gallons_for_route($_POST['manifest'],$ekc,$sched_ro->account_number);
                        $total_caps = $aaccoouunntt->barrel_cap($sched_ro->account_number);
                         if( $sched_ro->account_friendly!="No"){
                            $f = "F";
                         }else{
                            $f =   "IWP";
                         }
                        
                        if($sched_ro->route_status !="completed"){
                            $delete_icon = "<img src='img/delete-icon.jpg' title='remove pickup $ekc' xlr='$sched_ro->account_number' rel='$ekc'  class='deletesched2' />";
                         }else{
                            $delete_icon ="";
                        }
                        $datee = explode(" ",$sched_ro->scheduled_start_date);
                        
                        
                        echo "<tr id='row$sched_ro->schedule_id' style='cursor:pointer;background:$bg'  class='accnt_row' xlr='$sched_ro->account_number' rel='$ekc' title='$sched_ro->account_number'><td>$delete_icon</td><td>$count</td><td>".code_red($sched_ro->code_red)."</td>
                            <td style='width:43px;'>$f</td>
                            <td>$sched_ro->route_status</td><td>$datee[0]</td><td>$sched_ro->account_name</td><td>$sched_ro->account_city</td><td>$sched_ro->account_address</td>";
                            echo "<td class='notes' rel='$sched_ro->account_notes'>$sched_ro->account_notes</td><td>$sched_ro->onsite</td>
                            <td>$total_pickedup_for_this_route</td>
                            <td>$sched_ro->notes<br/>$sched_ro->special_instructions</td>
                            <td style='width:29px;'>".ZG_decode($sched_ro->zero_gallon_reason)."</td>
                            <td>"; 
                               $containers = $db->query("SELECT COUNT( container_no ) AS bar_num, container_no FROM iwp_containers WHERE account_no =$sched_ro->account_number AND deleted = 0 AND delivery_date !='0000-00-00' GROUP BY container_no");
                                if(count($containers)>0){
                                    foreach($containers as $conts){
                                        echo " $conts[bar_num] ) ".containerNumToName($conts['container_no'])."<br/>";
                                    }
                                }
                            echo"</td>";
                            $dt = explode(" ",$sched_ro->created_date);
                            echo "<td>".date_different($dt[0],date("Y-m-d"))."</td>";
                            $first = explode(" ",$aaccoouunntt->date_of_last_pickup($sched_ro->account_number));                            
                            echo "<td>";//net mileage
                                    echo date_different($first[0],$sched_ro->scheduled_start_date) * $sched_ro->ticks_per_day;
                            echo "</td>
                        </tr>";
                        $count++;                        
                    }
                }                
            }   
    }else if(isset($_POST['from_schoipu'])  ){        //coming from scheduled oil pickups page        
        if(count($schnums)>0){           
            $account = new Account();
            foreach($schnums as $value){
                $alter++;
                if($alter%2 == 0){
                    $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
                }
                else { 
                    $bg = 'transparent';
                }
                $schedule = new Scheduled_Routes($value);
                  if(strlen($schedule->account_friendly)>0){
                        $friend = "F";
                }else{
                    $friend ="";
                }
                $datex = explode(" ",$schedule->scheduled_start_date);
                echo"<tr id='row$value' style='cursor:pointer;background:$bg;' class='accnt_row'  xlr='$schedule->account_number' title='$schedule->account_number'>
                <td><img src='img/delete-icon.jpg' title='remove pickup $value' xlr='$schedule->account_number' class='deletesched' rel='$value'/>&nbsp;&nbsp;</td><td>$count</td><td  style='width:50px;'>$schedule->code_red</td><td>$friend</td><td>$schedule->route_status</td>";
                echo "<td>$datex[0]</td><td>$schedule->account_name</td>";
                echo "<td>". $account->singleField($schedule->account_number,"city") ."</td>";
                echo "<td>". $account->singleField($schedule->account_number,"address") ."</td>";
                echo "<td class='notes' rel='".$account->singleField($schedule->account_number,"notes")."'>". $account->singleField($schedule->account_number,"notes") ."</td>";
                echo "<td>";
                $yis =$account->onsite($schedule->account_number); 
                       echo number_format($yis,2);
                echo "</td>";
                echo "<td></td>";//collected
                echo "<td>$schedule->notes<br/>$schedule->special_instructions</td>";//info
                echo "<td style='width:29px;'>$schedule->zero_gallon_reason</td>";//%caps
                echo "<td>"; 
                    $containers = $db->query("SELECT COUNT( container_no ) AS bar_num, container_no FROM iwp_containers WHERE account_no =$schedule->account_number GROUP BY container_no");
                    if(count($containers)>0){
                        foreach($containers as $conts){
                            echo " $conts[bar_num] ) ".containerNumToName($conts['container_no'])."<br/>";
                        }
                    }
                echo"</td>";
                $dt = explode(" ",$schedule->created_date);
                echo "<td>".date_different($dt[0],date("Y-m-d"))."</td>";                
               
                echo "<td></td>";
                
                echo"</tr>";
                $count++;
            }
        }
     }
    ?>
