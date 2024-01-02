<?php
ini_set("display_errors",0);
class IKG {
    public $ikg_manifest_route_number;
    public $scheduled_date;
    public $completed_date;
    public $pick_upID;
    public $route_id;
    public $account_numbers = Array();
    public $acount_numbers_full_string;
    public $inventory_code;
    public $lot_no;
    public $recieving_facility;
    public $recieving_facility_no;
    public $facility_address;
    public $facility_rep;
    public $driver;
    public $driver_no;
    public $ikg_transporter;
    public $number_days_route;
    public $tank1;
    public $tank2;
    public $truck;
    public $license_plate;
    public $ikg_decal;
    public $ikg_collected;
    public $location;
    public $ikg_gross_weight;
    public $tare_weight;
    public $net_weight;
    public $time_start;
    public $start_mileage;
    public $first_stop;
    public $first_stop_mileage;
    public $last_stop;
    public $last_stop_mileage;
    public $end_time;
    public $end_mileage;
    public $fuel;
    public $vehicle;
    //***** FROM LIST OF ROUTES DB ******//
    public $list_of_routes_id;
    public $route_status;
    public $created_date;
    public $created_by;
    public $stops;
    public $expected;
    public $collected;
    public $difference_weight;
    public $collected_Weight;
    //************* SCHEDULED ROUTES ASSOCIATED WITH THIS ROUTE **///
    public $scheduled_routes = array();
    public $scheduled_route_notes;
    public $can_close;
    public $r_total_lb_per_mile;
    public $lb_per_mile;
    public $total_mileage;
    public $total_net;
    public $time_elapsed;
    public $net_route_miles;
    public $route_elapsed;
    public $unique_friendly = array();
    public $driver_completed_date;
    public $recur;
    public $recur_days;
    public $deleted;
    public $completed_stops;
    public $enroute_stops;
    public $estimated;
    public $at_pickup;
    public $driver_sig;
    public $facility_sig;
    public $weight_ticket_number;
    function __construct($route_id = NULL){
            global $dbprefix;
            global $db;
           
            $b = $db->query("SELECT route_id FROM iwp_ikg_manifest_info WHERE route_id = $route_id");
            if(count($b) == 0){//does this route exist on lists and manifest_info ?
                $k = "";
                $info = $db->query("SELECT ikg_manifest_route_number,scheduled,route_id,facility,driver FROM iwp_list_of_routes WHERE route_id = $route_id");                
                $scheds = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE route_id = $route_id AND deleted =0");
                if(count($scheds)>0){
                    foreach($scheds as $s){
                        $k .="$s[account_no]|";
                    }
                }
                
                if(strlen(trim($k))== 0){
                    $k = null;
                }
                
                $create_manifest_side = array(
                    "ikg_manifest_route_number"=>$info[0]['ikg_manifest_route_number'],
                    "scheduled_date"=>$info[0]['scheduled'],
                    "route_id"=>$info[0]['route_id'],
                    "recieving_facility"=>$info[0]['facility'],
                    "facility_address"=>$facils[$info[0]['facility']],
                    "driver"=>$info[0]['driver'],
                    "ikg_transporter"=>"IWP",
                    "deleted"=>0,
                    "account_numbers"=>$k
                );
                $db->insert("iwp_ikg_manifest_info",$create_manifest_side);
            }
            
            
            $data_table = $dbprefix."_data_table";
            $buff = array();
            if (  strlen(trim($route_id)) >0  ){
             $ikg_table = $dbprefix."_ikg_manifest_info";
             $from_oilrouted = $db->query("SELECT route_id,account_numbers,scheduled_date,ikg_manifest_route_number,completed_date,route_id,inventory_code,lot_no,recieving_facility,facility_address,facility_rep,driver,ikg_transporter,number_days_route,tank1,tank2,truck,license_plate,ikg_decal,location,gross_weight,tare_weight,time_start,start_mileage,first_stop,first_stop_mileage,last_stop,last_top_mileage,end_time,end_mileage,fuel,differences,can_close,collected,driver_completed_date,recurring,recur_days,weight_ticket_number FROM $ikg_table WHERE $ikg_table.deleted =0 AND route_id=$route_id");
             //UPDATE FIRST STOP/ MILEAGE INFO 
             $fs = $db->query("SELECT DISTINCT(schedule_id),mileage,date_of_pickup FROM iwp_data_table WHERE  iwp_data_table.deleted =0 AND route_id= $route_id ORDER BY date_of_pickup DESC");
             $ls = $db->query("SELECT DISTINCT(schedule_id),mileage,date_of_pickup FROM iwp_data_table WHERE  iwp_data_table.deleted =0 AND route_id= $route_id ORDER BY date_of_pickup ASC");
              //UPDATE FIRST STOP/ MILEAGE INFO 
             if(count($from_oilrouted) >0){
               if(strlen(trim($from_oilrouted[0]['account_numbers']))==0){
                  $db->query("UPDATE $ikg_table SET account_numbers = NULL WHERE route_id =$route_id");
               }else{
                    //$this->pick_upID = $value['entry_number'];
                   $this->acount_numbers_full_string = $from_oilrouted[0]['account_numbers'];
                   //********* SPLITS account numbers into member array
                   $this->account_numbers =  explode("|",$from_oilrouted[0]['account_numbers']);
                   array_pop($this->account_numbers);
                   //*********                         ***********//
               }
               
               foreach($from_oilrouted as $value){
                   $this->scheduled_date = $value['scheduled_date'];
                   $this->ikg_manifest_route_number = $value['ikg_manifest_route_number'];
                   $this->completed_date = $value['completed_date'];
                   $this->route_id = $value['route_id'];
                   $this->inventory_code = $value['inventory_code'];
                   $this->lot_no = $value['lot_no'];
                   $this->recieving_facility = numberToFacility($value['recieving_facility']);
                   $this->recieving_facility_no = $value['recieving_facility'];
                   $this->facility_address = $value['facility_address'];
                   $this->facility_rep = $value['facility_rep'];
                   $this->driver = $value['driver'];
                   $this->ikg_transporter = $value['ikg_transporter'];
                   $this->number_days_route = $value['number_days_route'];
                   $this->tank1 = $value['tank1'];
                   $this->tank2 = $value['tank2'];
                   $this->truck = $value['truck'];
                   $this->license_plate = $value['license_plate'];
                   $this->ikg_decal = $value['ikg_decal'];
                   $this->location = $value['location'];                   
                   $this->ikg_gross_weight = $value['gross_weight'];
                   $this->tare_weight = $value['tare_weight'];
                   $this->net_weight = $value['gross_weight'] - $value['tare_weight'];
                   $this->time_start = $value['time_start'];
                   $this->start_mileage = $value['start_mileage'];
                   $this->first_stop = $value['first_stop'];
                   $this->first_stop_mileage = $value['first_stop_mileage'];
                   $this->last_stop = $value['last_stop'];
                   $this->last_stop_mileage = $value['last_top_mileage'];
                   $this->end_time = $value['end_time'];
                   $this->end_mileage = $value['end_mileage'];
                   $this->fuel = $value['fuel'];     
                   $this->driver_no = $value['driver'];     
                   $this->difference_weight = $value['differences'] ;
                   $this->can_close = $value['can_close'];
                   $this->collected_Weight = $value['collected'];
                   $this->driver_completed_date = $value['driver_completed_date'];
                   $this->recur = $value['recurring'];
                   $this->recur_days = $value['recur_days'];
                   $this->deleted = $value['deleted'];
                   $this->weight_ticket_number = $value['weight_ticket_number'];
                  
               }
               $comp = $db->query("SELECT COALESCE(COUNT(schedule_id),NULL,0) as lk,COALESCE(SUM(oil_onsite),NULL,0) as onsite FROM iwp_scheduled_routes WHERE route_id = $route_id AND deleted = 0 AND route_status='enroute'");
               $db->query("UPDATE iwp_list_of_routes SET inc = ".$comp[0]['lk'].",expected =".$comp[0]['onsite']."  WHERE route_id = $route_id"); 
                   
               if(count($fs)>1){// more than one stop
                    $last = count($fs) - 1;
                    $packa = array(
                        "last_top_mileage"=>$fs[0]['mileage'],
                        "last_stop"=>$fs[0]['date_of_pickup'],
                        "first_stop"=>$fs[$last]['date_of_pickup'],
                        "first_stop_mileage"=>$fs[$last]['mileage']
                    );
                    $db->where("deleted",0)->where("route_id",$route_id)->update("$ikg_table",$packa);
                    $this->net_route_miles = 0;
                    $uyc = $db->query("SELECT DISTINCT (schedule_id), mileage, route_id, date_of_pickup FROM `iwp_data_table` WHERE iwp_data_table.deleted =0 AND route_id =$route_id  ORDER BY date_of_pickup DESC LIMIT 0,1");
                    $cyu = $db->query("SELECT DISTINCT (schedule_id), mileage, route_id, date_of_pickup FROM `iwp_data_table` WHERE  iwp_data_table.deleted =0 AND route_id =$route_id  ORDER BY date_of_pickup ASC LIMIT 0,1");
                    $this->net_route_miles = $uyc[0]['mileage'] - $cyu[0]['mileage'];
                    if(count($fs)>0){//calculate running route miles
                        $checkTime = strtotime($this->last_stop);
                        $loginTime = strtotime($this->first_stop);
                        $diff = $checkTime - $loginTime;
                        $this->route_elapsed =  abs(number_format($diff/3600,2))." Hours";
                    }     
                    $this->total_mileage = $this->end_mileage - $this->start_mileage;
                }else if(count($fs) == 1){// if there is currently only 1 stop in the route then the first is the last
                    $packa = array(
                        "first_stop_mileage"=>$fs[0]['mileage'],
                        "last_top_mileage"=>$fs[0]['mileage'],
                        "first_stop"=>$fs[0]['date_of_pickup'],
                        "last_stop"=>$fs[0]['date_of_pickup']
                    );
                    $db->where("route_id",$route_id)->update("$ikg_table",$packa);
                    $checkTime = strtotime($this->first_stop);
                    $loginTime = strtotime($this->scheduled_date." ".$this->time_start);
                    $diff = $checkTime - $loginTime;
                    $this->route_elapsed =  abs(number_format($diff/3600,2))." Hours";
                    $this->total_mileage = $this->first_stop_mileage - $this->start_mileage;
              } 
                
                //********************collected gallons for this  route ******///
                
                $buf4 = $db->query("SELECT SUM(inches_to_gallons) as tote FROM $data_table WHERE $data_table.deleted =0 AND route_id=$this->route_id");
                if(count($buf4)>0){
                     $this->collected_Weight  = round($buf4[0]['tote'] *7.56,2);
                     $this->collected = number_format($buf4[0]['tote'],2);
                } else {
                    $this->collected = 0;
                    $this->collected_Weight = 0;
                }
                     
                
                if($this->total_mileage>0){
                    $this->lb_per_mile = $this->collected_Weight/ $this->total_mileage   ;
                }
                
                 //***********************************************************//
                 if($this->net_route_miles !=0){ 
                    $this->r_total_lb_per_mile =  number_format($this->collected_Weight / $this->net_route_miles,2);       
                 } else {
                    $this->r_total_lb_per_mile = 0;
                 }
                 
                
                //***************** LIST OF ROUTES DB INFO ************************//
                
                $upo = $db->where("deleted",0)->where('route_id',$route_id)->get($dbprefix.'_list_of_routes');
                if(count($upo)>0){
                    foreach ($upo as $value2){
                        $this->list_of_routes_id = $value2['list_of_routes_id'];
                        $this->route_status = $value2['status'];
                        $this->created_date = $value2['created_date'];
                        $this->created_by = uNumToName($value2['created_by']);
                        $this->stops = $value2['stops'];
                        $this->expected = $value2['expected'];
                    }
                 }
                
                //************** SCHEDULED ROUTES / NOTES DB **********************//
                
                if(strlen(trim($this->acount_numbers_full_string)) >0  && $this->acount_numbers_full_string !="|"  ){
                    foreach($this->account_numbers as $act){
                        if(  strlen(trim($act))>0){
                            $yuc = $db->query("SELECT friendly FROM iwp_accounts WHERE account_ID = $act");
                            if( !in_array($yuc[0]['friendly'],$buff)  ){
                                 $buff[]= $yuc[0]['friendly'];
                            }   
                            
                            
                           $ik = $db->where('route_id',$this->route_id)->where("deleted",0)->where('account_no',$act)->get($dbprefix."_scheduled_routes","schedule_id");
                           if(count($ik)>0){
                                foreach($ik as $lll){
                                    $this->scheduled_routes[] = $lll['schedule_id'];    
                                }
                           }
                        }
                    }
                    $this->unique_friendly = array_unique($buff);
                }
                
             }
        }
        
        
        if(strlen($this->time_start)>0 && strlen($this->end_time)>0){
            $checkTime = strtotime($this->time_start);
            $loginTime = strtotime($this->end_time);
            $diff = $checkTime - $loginTime;
            $this->time_elapsed = abs(round($diff/3600,2));
        }
        
        
     
        
        
        
        foreach ($this->scheduled_routes as $ekc ){
                if($ekc != NULL){
                    $sched_ro2 = new Scheduled_Routes($ekc);
                    $first = explode(" ",$sched_ro2->account_last_pickup);
                    $this->at_pickup += date_different($first[0],$sched_ro2->scheduled_start_date) * $sched_ro2->ticks_per_day;   
                }
        } 
        
    }
    
    
    
    
}



?>