<?php

include "protected/global.php";
ini_set("display_errors",1);
if(isset($_SESSION['id'])){
    $person = new Person();
    $accountx = new Account();
    $kt = date("Y-m-d");
    
    if(isset($_POST['rid']) && strlen(trim($_POST['rid']))>0){
        $ikg_info = new IKG($_POST['rid']);
    
        if( isset($_POST['accounts']) && strlen(trim($_POST['accounts']))>0){            
            $db->query("UPDATE iwp_ikg_manifest_info SET account_numbers='$_POST[accounts]' WHERE route_id = $_POST[rid]");
            $acnts = explode("|",$_POST['accounts']);
            array_pop($acnts);
            // ************************** UPDATE TOTAL OILONSITE VOLUME FOR ROUTE **************************//
            if(count($acnts)>0){
                $i=0;
                foreach($acnts as $up){
                    $i += $accountx->singleField($up,"avg_gallons_per_Month");
                }
                $db->query("UPDATE iwp_list_of_routes SET expected = $i WHERE route_id= $_POST[rid]");        
            }
            // ************************** UPDATE TOTAL ESTIMATE VOLUME FOR ROUTE **************************//
        }
        
        if( isset($_POST['schedules']) && strlen(trim($_POST['schedules']))>0){
            $these_schedules = explode("|",$_POST['schedules']);
            array_pop($these_schedules);    
            foreach($these_schedules as $scheds_to_update){
                $kob = 0.00;
                $t_scheds = new Scheduled_Routes($scheds_to_update);
                $ats = new Account($t_scheds->account_number);
                $kob = $ats->onsite($t_scheds->account_number);
                $db->query("UPDATE iwp_scheduled_routes SET oil_onsite =$kob,scheduled_start_date='$_POST[sched_route_start]'  WHERE schedule_id = $scheds_to_update");
            }
            $new_tot = 0;
            $update_stops = count($these_schedules);
            $exp =0;
        }
        
    
        
        if(isset($_POST['scheds_to_add']) && strlen(trim($_POST['scheds_to_add']))>0 ){
            $new_stops = explode("|",$_POST['scheds_to_add']);    
            array_pop($new_stops);
        }
        
        
        if(isset($_POST['accounts_to_add']) && strlen(trim($_POST['accounts_to_add']))>0 ){
            $new_accounts = explode("|",$_POST['accounts_to_add']);
            array_pop($new_accounts);    
        }
        
        
        //*******************UPDATE NEW STOPS WITH ENROUTE AND CORRESPONDING ROUTE ID***************//
        if(strlen(trim($_POST['scheds_to_add']))>0 && strlen(trim($_POST['accounts_to_add']))>0  ){        
            $db->query("UPDATE iwp_scheduled_routes SET route_status='enroute', route_id=$_POST[rid] WHERE schedule_id in(".implode(" , ", $new_stops).")");
           
           
            $puu = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE schedule_id IN(".implode(" , ", $new_stops).") AND deleted =0");        
            if(count($puu)>0){
                $strin = "";
                foreach($puu as $ik){
                    $strin .="$ik[account_no]|";
                }
                $ki = $db->query("UPDATE iwp_ikg_manifest_info SET account_numbers = CONCAT(account_numbers,'$strin') WHERE route_id=$_POST[rid]");
            }
            
        }
        //*******************UPDATE NEW STOPS WITH ENROUTE AND CORRESPONDING ROUTE ID***************//
        
        
        
        
         //*********************** REMOVE STOPS ******************************//
        if(isset($_POST['scheds_to_remove']) && strlen(trim($_POST['scheds_to_remove']))> 0 ){    
            $return_this = array_map('intval', explode('|', $_POST['scheds_to_remove']));
            array_pop($return_this);
            $ia = 0;
            $remove_string = "";
            foreach($return_this as $update_this_stop){
                $sched_info = new Scheduled_Routes($update_this_stop);
                 echo "Stop: ".$update_this_stop." removed <br/>";
                 $ia++;
                 
                 $db->query("UPDATE iwp_ikg_manifest_info SET account_numbers = REPLACE(account_numbers,'$sched_info->account_number|','') WHERE route_id=$_POST[rid]");
                 $db->query("UPDATE iwp_scheduled_routes SET deleted =1,route_status='deleted' WHERE schedule_id = $update_this_stop AND route_id =$_POST[rid]"); //update schedule as deleted
                 $db->query("UPDATE iwp_data_table SET deleted =1 WHERE schedule_id = $update_this_stop AND route_id =$_POST[rid]");
                 
                 
                 $addinfo = Array(
                    "route_id"=>null,
                    "scheduled_start_date"=>date("Y-m-d"),
                    "facility_origin"=>$accountx->singleField($sched_info->account_number,"division"),
                    "code_red"=>0,
                    "account_no"=>$sched_info->account_number,
                    "route_status"=>"scheduled",
                    "created_by"=>$person->user_id,
                    "date_created"=>date("Y-m-d"),
                    "deleted"=>0
                );
                $db->insert("iwp_scheduled_routes",$addinfo);
            }
        }
        //*********************** REMOVE STOPS ******************************//
        
        
        if(isset($_POST['ikg_manifest_route_number'])){
            $jix = preg_replace('/[^A-Za-z0-9\-]/','', trim($_POST['ikg_manifest_route_number']));
            $db->query("UPDATE iwp_ikg_manifest_info SET ikg_manifest_route_number ='$jix' WHERE route_id=$_POST[rid]");
            $db->query("UPDATE iwp_list_of_routes SET ikg_manifest_route_number ='$jix'    WHERE route_id=$_POST[rid]");    
        }
        
        if(isset($_POST['jsig2']) && strlen(trim($_POST['jsig2']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET driver_sig =$_POST[jsig2] WHERE route_id=$_POST[rid]");    
        }
        
        if(isset($_POST['jsig']) && strlen(trim($_POST['jsig']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET facility_sig =$_POST[jsig] WHERE route_id=$_POST[rid]");    
        }
        
        
        if(isset($_POST['trailer_lp']) && strlen(trim($_POST['trailer_lp']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET trailer_lp =$_POST[trailer_lp] WHERE route_id=$_POST[rid]");    
        }
        
        if(isset($_POST['trailer']) && strlen(trim($_POST['trailer']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET trailer =$_POST[trailer] WHERE route_id=$_POST[rid]");    
        }
        
        if(isset($_POST['start_mileage']) && strlen(trim($_POST['start_mileage']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET start_mileage =$_POST[start_mileage] WHERE route_id=$_POST[rid]");    
        }
        if(isset($_POST['sched_route_start']) && strlen(trim($_POST['sched_route_start']))>0 ){
             $db->query("UPDATE iwp_ikg_manifest_info SET scheduled_date ='$_POST[sched_route_start]' WHERE route_id=$_POST[rid]");
        }
        if(isset($_POST['location']) && strlen(trim($_POST['location']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET location ='$_POST[location]' WHERE route_id=$_POST[rid]");
        }
        if(isset($_POST['inventory_code']) && strlen(trim($_POST['inventory_code']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET inventory_code ='$_POST[inventory_code]' WHERE route_id=$_POST[rid]");
        }
        if(isset($_POST['gross_weight'])&& strlen(trim($_POST['gross_weight']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET gross_weight =$_POST[gross_weight] WHERE route_id=$_POST[rid]");    
        }
        if(isset($_POST['tara_weight']) && strlen(trim($_POST['tara_weight']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET tare_weight =$_POST[tara_weight] WHERE route_id=$_POST[rid]");
        }
        if(isset($_POST['lot_no']) && strlen(trim($_POST['lot_no']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET lot_no ='$_POST[lot_no]' WHERE route_id=$_POST[rid]");    
        }
        if(isset($_POST['reciev_fac']) && $_POST['reciev_fac'] !="ignore" ){
            $db->query("UPDATE iwp_ikg_manifest_info SET recieving_facility =$_POST[reciev_fac] WHERE route_id=$_POST[rid]");    
            $db->query("UPDATE iwp_list_of_routes SET facility =$_POST[reciev_fac] WHERE route_id=$_POST[rid]");
        }
        
        
        if(isset($_POST['fac_address']) && strlen(trim($_POST['fac_address']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET facility_address ='$_POST[fac_address]' WHERE route_id=$_POST[rid]");    
            
        }
        if(isset($_POST['fac_rep']) && strlen(trim($_POST['fac_rep']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET facility_rep ='$_POST[fac_rep]' WHERE route_id=$_POST[rid]");    
        }
        if(isset($_POST['drivers']) && $_POST['drivers'] !="-"){
            $db->query("UPDATE iwp_ikg_manifest_info SET driver =$_POST[drivers] WHERE route_id=$_POST[rid]");
            $db->query("UPDATE iwp_list_of_routes SET driver = $_POST[drivers] WHERE route_id=$_POST[rid]");    
        }
       
        
        if(isset($_POST['lic_plate']) && strlen(trim($_POST['lic_plate']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET license_plate ='$_POST[lic_plate]' WHERE route_id=$_POST[rid]");
        }
        
        
        if(isset($_POST['ikg_decal']) && strlen(trim($_POST['ikg_decal']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET ikg_decal ='$_POST[ikg_decal]' WHERE route_id=$_POST[rid]");    
        }
        if(isset($_POST['time_start']) && strlen(trim($_POST['time_start']))>0){
             $db->query("UPDATE iwp_ikg_manifest_info SET time_start ='$_POST[time_start]' WHERE route_id=$_POST[rid]");
        }
        
       
        if(isset($_POST['first_stop']) && strlen(trim($_POST['first_stop']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET first_stop ='$_POST[first_stop]' WHERE route_id=$_POST[rid]");    
        }
        if(isset($_POST['last_stop']) && strlen(trim($_POST['last_stop']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET last_stop ='$_POST[last_stop]' WHERE route_id=$_POST[rid]");
        }
        
        if(isset($_POST['end_time']) && strlen(trim($_POST['end_time']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET end_time ='$_POST[end_time]' WHERE route_id=$_POST[rid]");
        }
        
        if(isset($_POST['fuel']) && strlen(trim($_POST['fuel']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET fuel =$_POST[fuel] WHERE route_id=$_POST[rid]");
        }
        
        if(isset($_POST['first_stop_mileage']) && strlen(trim($_POST['first_stop_mileage']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET first_stop_mileage =$_POST[first_stop_mileage] WHERE route_id=$_POST[rid]");    
        }
        if(isset($_POST['last_stop_mileage']) && strlen(trim($_POST['last_stop_mileage']))>0){
            $db->query("UPDATE iwp_ikg_manifest_info SET last_top_mileage =$_POST[last_stop_mileage] WHERE route_id=$_POST[rid]");
        }
        if(isset($_POST['end_mileage'])){
            if(strlen($_POST['end_mileage'])>0 && isset($_POST['end_mileage']  )){
                $db->query("UPDATE iwp_ikg_manifest_info SET end_mileage =$_POST[end_mileage] WHERE route_id =$_POST[rid]");
            }    
        }
        
       if(isset($_POST['mult_day_route'])){
            $db->query("UPDATE iwp_ikg_manifest_info SET number_days_route = $_POST[mult_day_route] WHERE route_id =$_POST[rid]");
        }
        
       if( isset($_POST['vehicle']) && $_POST['vehicle'] !="-" ){
            $db->query("UPDATE iwp_ikg_manifest_info SET truck = $_POST[vehicle] WHERE route_id =$_POST[rid]");
       }
        
       if(isset($_POST['collected_weight']) && strlen( trim($_POST['collected_weight']) )>0){
        $db->query("UPDATE iwp_ikg_manifest_info SET collected = $_POST[collected_weight] WHERE route_id =$_POST[rid]");
       }  
        
        
        
     
        
        
        
        if(isset($_POST['difference']) && strlen(trim($_POST['difference']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET differences = $_POST[difference] WHERE route_id =$_POST[rid]");
        } 
        
       
        if(isset($_POST['new_variable'])  && strlen(trim($_POST['new_variable']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET recurring  = $_POST[new_variable] WHERE route_id = $_POST[rid]");     
        } 
        
        
        if(isset($_POST['day_recur'])  && strlen(trim($_POST['day_recur']))>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET recur_days  = $_POST[day_recur] WHERE route_id = $_POST[rid]");
        }
        
        
        //$_POST['weight_ticket_number']
        if(isset($_POST['weight_ticket_number'])  && strlen( trim($_POST['weight_ticket_number']) )>0 ){
            $db->query("UPDATE iwp_ikg_manifest_info SET weight_ticket_number  ='$_POST[weight_ticket_number]' WHERE route_id = $_POST[rid]");
            echo "UPDATE iwp_ikg_manifest_info SET weight_ticket_number  ='$_POST[weight_ticket_number]' WHERE route_id = $_POST[rid]";
        }
        
        
    //*******************  FIND UNCOMPLETED STOPS **********************************//
 
        //$ikg_info->fix_self($_POST['rid']);
        
        
        
        
        $history = array(    
            "route_no"=>(int)$_POST['rid'],
            "what_day"=>(int)$_POST['what_day'],
            "start_mileage"=>trim($_POST['start_mileage']),
            "first_stop_mileage"=>trim($_POST['first_stop_mileage']),
            "last_stop_mileage"=>$_POST['last_stop_mileage'],
            "first_stop"=>trim($_POST['first_stop']),
            "last_stop"=>trim($_POST['last_stop']),
            "driver"=>$_POST['drivers'],
            "truck_id"=>trim($_POST['vehicle']),
            "gross_weight"=>$_POST['gross_weight'],
            "tare_weight"=>$_POST['tara_weight'],
            "start_date"=>date("Y-m-d")." ".$_POST['time_start'],
            "end_mileage"=>$_POST['end_mileage'],
            "end_date"=>$_POST['completion_date']." ".date("H:i:s"),
            "last_stop_mileage"=>$_POST['last_stop_mileage'],
            "time_end"=>"$_POST[end_time]",
            "time_start"=>"$_POST[time_start]"  
        );


        /**/
        $exist_ = $db->where('route_no',$_POST['rid'])->where('what_day',$_POST['what_day'])->get($dbprefix."_rout_history");
        
        if( count($exist_) == 0 ){
            echo $db->insert($dbprefix."_rout_history",$history);
        }  else {
            echo $db->where('route_no',$_POST['rid'])->where('what_day',$_POST['what_day'])->update($dbprefix."_rout_history",$history);
        }
        
        
        
        /**/
        $track = array(
            "date"=>date("Y-m-d H:i:s"),
            "user"=> $person->user_id,
            "actionType"=>"Route Updated",
            "descript"=>"Route <form action='oil_routing.php' target='_blank' method='post' class='ikg_form'><span style='font-decoration:underline;color:blue;cursor:pointer;'>$_POST[rid]</span><input type='hidden' value='$_POST[rid]' name='manifest'/><input type='hidden' value='1' name='from_routed_oil_pickups'/></form> Updated",
             "pertains"=>6,
             "type"=>14
        );
        $db->insert("xlogs.".$dbprefix."_activity",$track);
            
    }
}else{
    echo "1";
}
    
   
   
   
     
   
    
?>