<?php
//ini_set("display_errors", 1);
class grease_table{
    public $grease_no;
    public $route_status;    
    public $code_red;
    public $date;
    public $account_no;
    public $notes;
    public $grease_trap_size;    
    public $freq;
    public $ppg;
    public $completed;
    public $service;
    public $grease_name;
    public $grease_route_no;
    public $volume;
    public $base_rate;
    public $time_of_service;
    public $addt_price;
    public $addt_info;
    public $service_date;
    public $active;
    public $formatted_account_name;
    public $schedules;
    function __construct($id = NULL){
        global $db;
        global $dbprefix;
        
        if($id !=NULL){
            $gt = $db->where("grease_no",$id)->get($dbprefix."_grease_traps");
            if(count($gt)>0){
                $this->grease_no = $gt[0]['grease_no'];
                $this->route_status = $gt[0]['route_status'];
                $this->date = $gt[0]['date'];
                $this->account_no = $gt[0]['account_no'];
                $this->notes = $gt[0]['notes'];
                $this->grease_trap_size = $gt[0]['grease_trap_size'];
                $this->freq = $gt[0]['frequency'];
                $this->ppg = $gt[0]['price_per_gallon'];
                $this->completed = $gt[0]['completed'];
                $this->service = $gt[0]['service'];
                $this->grease_name = $gt[0]['grease_name'];
                $this->grease_route_no = $gt[0]['grease_route_no'];
                $this->volume = $gt[0]['volume'];
                $this->base_rate = $gt[0]['base_rate'];
                $this->time_of_service = $gt[0]['time_of_service'];
                $this->addt_info = $gt[0]['addt_info'];
                $this->addt_price = $gt[0]['addt_price'];
                $this->service_date = $gt[0]['service_date'];
                $this->active = $gt[0]['active'];
                $this->formatted_account_name  = account_numToName($this->account_no);
                
                $kl = $db->where('grease_route_no',$this->grease_no)->get($dbprefix."_grease_traps","grease_no");
                if(count($kl)>0){
                    foreach($kl as $numbs){
                        $this->schedules[] = $numbs['grease_no'];
                    }
                }
                
                
            }
        }
    }
    
}


?>
