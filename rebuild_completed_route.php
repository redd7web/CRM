<?php
include "protected/global.php";
error_reporting(-1);
function subDayswithdate($date,$days){    
    $mod_date = strtotime($date."- $days days");
    return date("Y-m-d",$mod_date);
}







$rev = $db->query("SELECT * FROM iwp_data_table WHERE route_id =41346");
$ikg_info = new IKG(41346);


echo "<table style='width:100%;margin:auto;'>";
echo "<tr>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>Stop</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>C/R</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>status</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>scheduled</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>Name</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>address</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>Estimated</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>Collected</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>Info</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>% Caps</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>Tote Size</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>Days</td>
            <td style='text-align:center;vertical-align:top;border:1px solid black;'>GPM</td>
            ";

if(count($rev)>0){
    
    $count =1;
    foreach($rev as $stops){
        $acc = new Account($stops['account_no']);
        $sched = new Scheduled_Routes($stops['schedule_id']);
        
        $prev_sched_date =subDayswithdate($sched->scheduled_start_date,$acc->pick_up_freq);
        
        echo $acc->name."**************<br/>";
        echo "<pre>";
        $update_sched = array(
            "scheduled_start_date"=>$prev_sched_date,
            "route_id"=>41273
        );
        var_dump($update_sched);
        echo "</pre>";
        $account_nums .= $acc->acount_id."|"; 
        $db->where("schedule_id",$sched->schedule_id)->update("iwp_scheduled_routes",$update_sched);
        
        echo "<pre>";
        $new_sched = array(
            "route_id"=>NULL,
            "scheduled_start_date"=>$sched->scheduled_start_date,
            "facility_origin"=>$acc->division,
            "route_status"=>"scheduled",
            "created_by"=>99,
            "account_no"=>$acc->acount_id,
            "code_red"=>0,
            "date_created"=>"2015-01-26"
        );
        var_dump($new_sched);
        echo "</pre>";
        $db->insert("iwp_scheduled_routes",$new_sched);
        echo "<br/>***************************<br/>";
        
        
        $x = round($x*100,2);
        echo "
            <tr title='$sched->schedule_id'>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>$count </td> 
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>".code_red(0)."</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>completed</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>".$prev_sched_date."</td> 
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>$acc->name</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>$acc->address</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>$acc->estimated_monthly</td> 
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>$stops[inches_to_gallons]</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>$stops[fieldreport]</td> 
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>$x</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>";  
              foreach($acc->barrel_info as $barrels){
                echo $barrels['container_label']."<br/>";
              }
              echo "</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'>";
              echo date_different( subDayswithdate($sched->scheduled_start_date,$acc->pick_up_freq), $ikg_info->completed_date );
              "</td>
              <td style='text-align:center;vertical-align:top;border:1px solid black;'></td>
            </tr>";
        $count++;
        
    }
}

echo "</table>";

echo $account_nums;
$arr = array(
    "account_numbers"=>$account_nums
);

$db->where("route_id",41273)->update("iwp_ikg_manifest_info",$arr);/**/
?>