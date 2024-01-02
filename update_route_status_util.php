<?php

//from enter data page
include "protected/global.php";


$dte = date("Y-m-d");
$buffer = array(
    "status"=>"completed",
    'completed_date' =>$dte
);

$b3 = array(
    'completed_date' =>$dte
);


$db->where('route_id',$_POST['route_id'])->update($dbprefix."_list_of_utility",$buffer);
$db->where('route_id',$_POST['route_id'])->update($dbprefix."_ikg_utility",$b3);


echo "UPDATE iwp_utility SET rout_no = null,route_status='scheduled' WHERE route_status IN('scheduled','enroute') AND rout_no=$_POST[route_id]<br/>";

$po = $db->query("UPDATE iwp_utility SET rout_no = null,route_status='scheduled' WHERE route_status IN('scheduled','enroute') AND rout_no=$_POST[route_id]");



$update_accounts_stops = $db->query("SELECT utility_sched_id FROM iwp_utility WHERE rout_no=$_POST[route_id] AND route_status='completed'");//if there is an issue associated with this completed stop, complete that issue
if(count($update_accounts_stops)>0){
    foreach($update_accounts_stops as $stops){
        $util = new Util_Stop($stops['utility_sched_id']);
        if(strlen(trim($util->issue_associated))>0){
            $db->query("UPDATE iwp_issues set status='closed',completed_explaination='Service completed for Account: ".account_NumtoName_plain($stops['account_no'])." ".date("Y-m-d")." $_GET[route_id] schedule $stops[utility_sched_id]' WHERE issue_no = $util->issue_associated");
        }
    }
}
echo "debug<br/>";
?>







