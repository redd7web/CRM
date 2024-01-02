
<?php

include "protected/global.php";
ini_set("dislay_errors",0);
$accounts_container = $dbprefix."_containers";
$containerslist = $dbprefix."_list_of_containers";


$sched = $db->where("deleted",0)->where("route_id",$_GET['route_id'])->where("schedule_id","$_GET[sched_id]")->get($dbprefix."_scheduled_routes","account_no,route_status");//schedule info

$editable = $db->where("deleted",0)->where('route_id',$_GET['route_id'])->get("iwp_list_of_routes","status");


if($editable[0]['route_status'] == "completed"){
    $read_only = "readonly=''";
}


$oil_data = $db->query("SELECT * FROM iwp_data_table WHERE schedule_id=$_GET[sched_id] AND route_id=$_GET[route_id] AND account_no =".$sched[0]['account_no']." AND deleted =0");

$get = $db->query("SELECT $containerslist.* , $accounts_container.* FROM `$containerslist` INNER JOIN $accounts_container ON $containerslist.container_id = $accounts_container.container_no WHERE $accounts_container.account_no =".$sched[0]['account_no']." AND $accounts_container.deleted = 0"); //

foreach($get as $buffer){
    $cont_has[] = $buffer['container_label'];
}

$data_count = count($oil_data);
$container_count = count($get);

echo "<tbody>";
//echo "<tr><td>data count:$data_count container_count:$container_count</td></tr>";
if($data_count>0){// if stop has been picked up load data from oil table 
    foreach($oil_data as $info){
            $gpi_ask  = $db->query("SELECT gpi FROM iwp_list_of_containers WHERE container_label = '$info[container_label]'");
            if(count($gpi_ask)>0){
                $gpi = $gpi_ask[0]['gpi'];
            }
            $picked[] = $info['container_label'];
            echo  "<tr><td style='text-align:right'><input style='width:50px;' type='hidden' value='$info[entry_number]' class='entry' />Inches Collected </td><td  style='text-align:left'><input $read_only type='text' style='width: 50px;' value='$info[inches_entered]' placeholder='0.0' class='addtional_inch' formula='".$gpi."' total_cap='$info[expected_gallons]'/><input type='text' value='$info[inches_to_gallons]' style='width: 50px;' placeholder='0.0' class='aditional_galls' readonly=''/>/$info[expected_gallons]<span style='font-size: 9px;color:#bbbbbb;'> Expected</span></td><td>Inches Leftover</td><td style='float:left;'>
                <input class='inchesleftover' $read_only  formula='".$gpi."' placeholder='0.0'  value='' type='text' style='width: 50px;'/> 
                <input type='text' class='galslefover' placeholder='0.0' readonly=''  value='' style='width:50px;'/>/$info[expected_gallons]<span style='font-size: 10px;' class='extraGalsExpect'>Gallons Leftover</span></td>
                <td><input type='hidden' class='label' value='$info[container_label]'/></td>
                </tr>";
    }
     
     if($container_count > $data_count){// if only one container was picked up of multiple, load the rest 
        $start =$container_count - $data_count;
        for($i= $start;$i<$container_count; $i++ ){
            $rest = $db->where("container_label",$cont_has[$i])->get("iwp_list_of_containers");
            echo  "<tr>
                <td style='text-align:right'><input style='width:50px;' type='hidden' value='' class='entry' />Inches Collected </td> 
                <td  style='text-align:left'> 
                    <input type='text' style='width: 50px;' value='' placeholder='0.0' class='addtional_inch' formula='".$rest[0]['gpi']."' total_cap='".$rest[0]['amount_holds']."'/> 
                    <input type='text' value='' style='width: 50px;' placeholder='0.0' class='aditional_galls' readonly=''/>/".$rest[0]['amount_holds']."<span style='font-size: 9px;color:#bbbbbb;'> Expected</span>
                    
                    </td>
                <td>Inches Leftover</td>
                <td style='float:left;'>
                <input class='inchesleftover'  formula='".$rest[0]['gpi']."' placeholder='0.0'  value='' type='text' style='width: 50px;'/> 
                <input type='text' class='galslefover' placeholder='0.0' readonly=''  value='' style='width:50px;'/>/".$rest[0]['amount_holds']."<span style='font-size: 10px;' class='extraGalsExpect'>Gallons Leftover</span></td>
                <td><input type='hidden' class='label' value='".$cont_has[$i]."'/></td>
                </tr>";
        }        
    }
    
    
} else { // if stop has not been picked up pull containers from container table without oil data
    if($container_count>0){
        foreach($get as $info){
            echo  "<tr>
                <td style='text-align:right'><input style='width:50px;' type='text' value='0' class='entry' readonly/>Inches Collected </td> 
                <td  style='text-align:left'> 
                    <input type='text' style='width: 50px;' value='' placeholder='0.0' class='addtional_inch' formula='".$info['gpi']."' total_cap='".$info['amount_holds']."'/> 
                    <input type='text' value='0' style='width: 50px;' placeholder='0.0' class='aditional_galls' readonly=''/>  / ".$info['amount_holds']."<span style='font-size: 9px;color:#bbbbbb;'> Expected</span>
                    
                    </td>
                <td>Inches Leftover</td>
                <td style='float:left;'><input class='inchesleftover'  formula='".$info['gpi']."'  placeholder='0.0'  value='' type='text' style='width: 50px;'/> <input type='text' class='galslefover' placeholder='0.0' readonly=''  value='' style='width:50px;'/> / <span class='clabel_leftover'>".$info['container_label']. "<//span>  <span style='font-size: 10px;' class='extraGalsExpect'>Gallons Leftover</span></td>
                <td><input type='hidden' class='label' value='$info[container_label]'/></td>
                </tr>";
        }
    }
}

echo "</tbody>";
 ?>
