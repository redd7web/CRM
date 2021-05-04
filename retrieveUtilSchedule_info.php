<?php
include "protected/global.php";

    $utility_table = $dbprefix."_utility";
    $data_table = $dbprefix."_utility_data_table";
    $resukt = $db->where("deleted",0)->where("utility_sched_id",$_GET['sched_id'])->get($utility_table,"*");
    if(count($resukt)>0){
        $accnt = new Account();
        $get_gallons = $db->where("deleted",0)->where("account_no",$resukt[0]['account_no'])->where("route_id",$resukt[0]['utility_sched_id'])->get($data_table,"*");// get oil pickup data from data table
         switch($_GET['mode']){
            case "address":
                //echo $resukt[0]['account_no'];
                echo $accnt->singleField($resukt[0]['account_no'],"name")."<br/>".$accnt->singleField($resukt[0]['account_no'],"address")."<br/>".$accnt->singleField($resukt[0]['account_no'],"city").", ".$accnt->singleField($resukt[0]['account_no'],"state")." ".$accnt->singleField($resukt[0]['account_no'],"zip");    
            break;
            case "containment":
                //echo $_GET['mode']."<br/>";
                $serv = $db->where("deleted",0)->where("utility_sched_id",$_GET['sched_id'])->get($dbprefix."_utility");
                if(count($serv)>0){
                    
                    echo service_call_decode($serv[0]['type_of_service'])."<br/>";
                    if($serv[0]['type_of_service'] == 100){
                     echo containerNumToName($serv[0]['container_label'])." for ".containerNumToName($serv[0]['container_being_swapped_label']);   
                    }
                    
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
            case "day":
                echo $get_gallons[0]['day'];
            break;
        }    
    }








     



?>