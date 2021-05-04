<?php
include "protected/global.php";

$grease_table = $dbprefix."_grease_traps";


$data_table = $dbprefix."_grease_data_table";

$resukt = $db->where("grease_no",$_GET['sched_id'])->get($grease_table,"*");
$accnt = new Account();

$get_gallons = $db->where("account_no",$resukt[0]['account_no'])->where("route_id",$resukt[0]['grease_route_no'])->get($data_table,"*");// get oil pickup data from data table



switch($_GET['mode']){
    case "address":
        //echo $resukt[0]['account_no'];
        echo $accnt->singleField($resukt[0]['account_no'],"name")."<br/>".$accnt->singleField($resukt[0]['account_no'],"address")."<br/>".$accnt->singleField($resukt[0]['account_no'],"city").", ".$accnt->singleField($resukt[0]['account_no'],"state")." ".$accnt->singleField($resukt[0]['account_no'],"zip");    
    break;
    case "containment":
        //echo $_GET['mode']."<br/>";
        $serv = $db->where("grease_no",$_GET['sched_id'])->get($dbprefix."_grease_traps","service,volume");
        if(count($serv)>0){
            echo $serv[0]['service']."<br/>Volume: ".$serv[0]['volume'];
        }
         
    break;
    
    case "gpi_number":
        echo $bhgty[0]['gpi'];
    break;
    case "num":
        echo $accnt->singleField($resukt[0]['account_no'],"account_ID");        
    break;
    case "acountname":
        echo $accnt->name;
    break;    
    case "field":
        echo $get_gallons[0]['fieldreport'];
        break;
    case "volume":
        echo $resukt[0]['volume'];
        break;
    case "picked_up":
        echo $get_gallons[0]['inches_to_gallons'];
        break;
    case "zero_reason":
        if($get_gallons[0]['zero_gallon_reason'] >0){
            echo $get_gallons[0]['zero_gallon_reason'];
        }
        break;
}      



?>