<?php
include "../protected/global.php";

$data_table = $dbprefix."_data_table";
$targets = $db->query("SELECT DISTINCT account_no FROM $data_table");
$account = new Account();
foreach($targets as $accounts){
    
    
    echo "<br/><br/>completed pickups for : $accounts[account_no]<br/>";
    $rou = $db->where("account_no",$accounts['account_no'])->orderby('date_of_pickup','DESC')->get($dbprefix.'_data_table',"date_of_pickup");
    
    $newsched_date =addDayswithdate($rou[0]['date_of_pickup'],$account->singleField($accounts['account_no'],"pickup_frequency")  );
    $dc =date("Y-m-d");
    $newschedule = array(
        'scheduled_start_date'=>$newsched_date
        ,'account_no'=>$accounts['account_no']
        ,"date_created"=>$dc     
        ,"code_red"=>0
        ,"route_status"=>"Scheduled"
    );
    var_dump($newschedule);
    $check = $db->
        where("scheduled_start_date",$newsched_date)->
        where("account_no",$accounts['account_no'])->
        where('date_created',$dc)->
        where('route_status',"Scheduled")->
        get($dbprefix."_scheduled_routes","schedule_id");
    
    if(count($check)== 0){
        $db->insert($dbprefix."_scheduled_routes",$newschedule);
        echo "<br/>inserted";
    }
    echo "<br/><br/>";
        

}


?>