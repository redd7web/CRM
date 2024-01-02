<?php
error_reporting(E_WARNING | E_PARSE | E_NOTICE);
class Account{
    public $acount_id;
    public $id;
    public $status;
    public $class;
    public $name;
    public $name_plain;
    public $city;
    public $state;
    public $created;
    public $expires;
    public $locations;
    public $address;
    public $zip;
    public $billing_address;
    public $billing_state;
    public $billing_city;
    public $billing_zip;
    public $new_bos;
    public $area_code;
    public $phone;
    public $contact_name;
    public $contact_title;
    public $email_address;
    public $division;
    public $original_sales;
    public $re_assigned;
    public $account_rep;
    public $state_date;
    public $previous_provider;     
    public $pickup_provider;
    public $pick_up_time;
    public $pick_up_freq;
    public $starting_oil_bakery;
    public $first_removal;
    public $second_removal;
    public $good_cleaning_practice_poster;
    public $account_fact_sheet;
    public $legal_docs;
    public $ach;
    public $payment_method;
    public $yards_to_lbs;
    public $lattitude;
    public $longittude;
    public $contract;
    public $guest_host;
    public $customer_id;
    public $url;
    public $full_address;
    public $notes;
    public $payee_name;
    public $ppg_jacobsen_percentage;
    public $index_percentage;
    public $miu;
    public $account_cap;
    public $siren;
    public $total_barrel_capacity;
    public $number_of_barrels;
    public $total_gallons;
    public $number_of_pickups;
    public $avg_gallon;
    public $estimated_monthly;
    public $percent_full;
    public $barrel_info = Array(
        "container_id"=>"",
        "container_label"=>"",
        "amount_holds"=>"",
        "gpi"=>""
    );
    public $ticks_per_day;
    public $expected_gallons;    
    public $is_scheduled;
    public $is_completed;
    public $price_per_gallon;
    
    function __construct($id = NULL){
        global $dbprefix;
        $db = new Database();
        if($id == NULL){            
            
        }
        else if($id != NULL){ 
            $retrive = $db->where("account_ID",$id)->get("iwp_accounts");
            if($retrive >0){
            $this->acount_id = $retrive[0]['account_ID'];
            $this->id = $retrive[0]['id'];
            $this->status = $retrive[0]['status'];
            $this->class  = $retrive[0]['class'];
            $this->name  = account_NumtoName($retrive[0]['account_ID']);
            $this->name_plain = $retrive[0]['name'];
            $this->address  = $retrive[0]['address'];
            $this->city = $retrive[0]['city'];
            $this->state = $retrive[0]['state'];
            $this->zip  = $retrive[0]['zip'];
            $this->created  = $retrive[0]['created'];
            $this->expires  = $retrive[0]['expires'];
            $this->locations  = $retrive[0]['locations'];            
            $this->billing_address  = $retrive[0]['billing_address'];            
            $this->billing_city  = $retrive[0]['city'];            
            $this->billing_state = $retrive[0]['billing_state'];            
            $this->billing_zip  = $retrive[0]['zip'];            
            $this->new_bos  = $retrive[0]['new_bos'];
            $this->area_code  = $retrive[0]['area_code'];            
            $this->phone = $retrive[0]['phone'];
            $this->contact_name = $retrive[0]['contact_name'];
            $this->email_address = $retrive[0]['email_address'];
            $this->division  = $retrive[0]['division'];
            $this->original_sales =  $retrive[0]['original_sales_person'];
            $this->re_assigned  = $retrive[0]['re_assigned_sales_person'];
            $this->account_rep = $retrive[0]['account_rep'];
            $this->state_date = $retrive[0]['state_date'];
            $this->previous_provider  = $retrive[0]['previous_provider'];
            $this->pick_up_freq  = $retrive[0]['pickup_frequency'];
            $this->starting_oil_bakery =  $retrive[0]['starting_oil_bakery'];
            $this->first_removal = $retrive[0]['first_removal'];
            $this->second_removal = $retrive[0] ['second_removal'];
            $this->good_cleaning_practice_poster  = $retrive[0]['good_cleaning_practice_poster'];
            $this->account_fact_sheet  = $retrive[0]['account_fact_sheet'];
            $this->legal_docs  = $retrive[0]['legal_docs'];
            $this->ach  = $retrive[0]['ach'];
            $this->payment_method  = $retrive[0]['payment_method'];
            $this->yards_to_lbs  = $retrive[0]['yards_to_lbs'];
            $this->lattitude  = $retrive[0]['latitude'];
            $this->longittude  = $retrive[0]['longitude'];
            $this->contract  = $retrive[0]['contract'];
            $this->guest_host  = $retrive[0]['guest_host'];
            $this->customer_id  = $retrive[0]['customer_id'];
            $this->url = $retrive[0]['url'];
            $this->notes = $retrive[0]['notes'];
            $this->full_address = $this->city." ,".$this->state." ".$this->zip;
            $this->payee_name = $retrive[0]['payee_name'];
            $this->previous_provider = $retrive[0]['previous_provider'];
            $this->expires =  $retrive[0]['expires'];
            $this->ppg_jacobsen_percentage = $retrive[0]['ppg_jacobsen_percentage'];
            $this->miu = $retrive[0]['miu'];
            $this->total_barrel_capacity = 0;            
            $data_table = $dbprefix."_data_table";            
            $nop = $db->where("account_no",$this->acount_id)->get($data_table);            
            $this->number_of_pickups = count($nop); 
            $this->avg_gallon =$retrive[0]['avg_gallons_per_Month'];//default estimate/pickup frequency - after 4  gallons picked up / 4 or greater completed pickups
            $this->estimated_monthly = $retrive[0]['estimated_volume'];
            $this->ticks_per_day = $retrive[0]['ticks_per_day'];
            $this->index_percentage = $retrive[0]['index_percentage'];
            $this->price_per_gallon = $retrive[0]['price_per_gallon'];
            
            $poi = $db->where('account_no',$this->acount_id)->get($dbprefix."_scheduled_routes","*");
            
            if(count($poi) >0){
                $this->is_scheduled = 1;
            }
            else {
                $this->is_scheduled = 0;
            }
            
            $poi2 = $db->where('account_no',$this->acount_id)->where('route_status','completed')->get($dbprefix."_scheduled_routes");
            
            if(count($poi2)>0){
                $this->is_completed = 1;
            }else {
                $this->is_completed = 0;
            }
            
            //**********************            CONTAINER INFO ************************//
            
                        
            
            $nbv = $db->where('account_no',$this->acount_id)->get($dbprefix.'_data_table','inches_to_gallons');
            if(count($nbv)>0){
                foreach($nbv as $kbv){
                    $this->total_gallons = $this->total_gallons + $kbv['inches_to_gallons'];
                }
            }
            
            
            
            $bc = $db->where("account_no",$this->acount_id)->get($dbprefix.'_data_table');
            if( count($bc)>=4 ){
                $buffer=0;
                foreach($bc as $halue){
                    $buffer =  $halue['inches_to_gallons']+$buffer;
                }
                $this->expected_gallons = $buffer/count($bc);    
            }else {
                $this->expected_gallons = 0;
            }
            
            
            
            $jh = $db->where("account_no",$this->acount_id)->get($dbprefix."_containers","container_no");
            $this->number_of_barrels = count($jh);                        
            
            if($this->number_of_barrels>0){                
                foreach($jh as $calue ){
                    $tq = $db->where("container_id",$calue['container_no'])->get($dbprefix."_list_of_containers","*");
                    $this->barrel_info[] = array(
                        "container_id"=>$calue['container_no'],
                        "container_label"=>$tq[0]['container_label'],
                        "amount_holds"=>$tq[0]['amount_holds'],
                        "gpi"=>$tq[0]['gpi']
                    );
                    $this->total_barrel_capacity = $tq[0]['amount_holds']+$this->total_barrel_capacity; 
                }
            }
            
            if($this->avg_gallon >0 && ($this->total_barrel_capacity>0)){
                $this->percent_full =  round($this->avg_gallon/$this->total_barrel_capacity,2);
            }   
            else {
                $this->percent_full = 0;
            } 
                    
            //*************************************************************************//
            
          
            if(  $this->percent_full  >=.75  ){
                $this->siren= '<img src="img/graphics-flashing-light-245546.gif"  />';
            }
            else {
                $this->siren ='<img src="img/redlight.jpg" />';
            }
                
        }
            
        }
        
        
        
    }
    
   function num_of_barrel($id){
    global $dbprefix;
    global $db;
    $jh = $db->where("account_no",$id)->get($dbprefix."_account_barrelinfo","number_of_barrels");
    return $jh[0]['number_of_barrels'];
  } 
  
  function barrel_cap($id){
   global $dbprefix;
   global $db;
   $account_container = $dbprefix."_containers";
   $list_of_containers = $dbprefix."_list_of_containers";
   
   $ask = $db->query("SELECT $account_container.*,$list_of_containers.* FROM  $list_of_containers INNER JOIN $account_container ON $list_of_containers.container_id = $account_container.container_no WHERE $account_container.account_no = $id");
   $total = 0;
   if(count($ask)>0){
       
        foreach($ask as $barrel_hold){
            $total = $total + $barrel_hold['amount_holds'];
        }
   }
   
   return $total;
   
   
   
  }  
    
  function singleField($id,$field){
    global $dbprefix;
    global $db;
    
    $ytru = $db->where("account_ID",$id)->get($dbprefix."_accounts","$field");
    
    if(count($ytru)>0){
        return $ytru[0][$field];
    }  else {
        return 0;
    }
  
  }  
  
  function formatted_Name($id){      
    return  account_NumtoName($id);
  }
  
  function facility_name($id){
    global $dbprefix;
    global $db;   
    $ytru = $db->where("account_ID",$id)->get($dbprefix."_accounts","division");
    
    return numberToFacility($ytru[0]['division']);  
  }
    
  function get_pickups($id){
    global $dbprefix,$db;    
    $pickups = $db->where("account_no",$id)->get($dbprefix."_data_table","account_no");
     
     return count($pickups); 
    
  } 
  
  function total_gallons($id){
    global $dbprefix,$db;  
    $total = 0; 
    $pickups = $db->where("account_no",$id)->get($dbprefix."_data_table","inches_to_gallons");
    if(count($pickups) >0){
        foreach($pickups as $kup){
               $total = $total +$kup['inches_to_gallons'];
        }
    } 
    return $total; 
  }
  function expected_gallons($id){
    global $dbprefix,$db;
    $expected =0;
    $data_table = $dbprefix."_data_table";
    $pickups = $db->query("SELECT inches_to_gallons,date_of_pickup FROM $data_table WHERE account_no=$id ORDER BY date_of_pickup LIMIT 0,4");
    if(count($pickups)>=4){
        foreach($pickups as $calc){
            $expected = $calc['inches_to_gallons'] + $expected;
        }
        $expected = round($expected/4,2);
    }else {
        $default = $db->where("account_ID",$id)->get($dbprefix."_accounts","estimated_volume");
        if(count($default)>0){
            $expected = $default[0]['estimated_volume'];
        } 
    }
    return $expected;  
  }
  
  
  function gpp($id){
    global $dbprefix,$db;
    $total = 0; 
    $gpp = 0;
    $pickups = $db->where("account_no",$id)->get($dbprefix."_data_table","inches_to_gallons");
    if(count($pickups) >0){
        foreach($pickups as $kup){
               $total = $total +$kup['inches_to_gallons'];
        }
        $gpp = round($total/count($pickups),2);
    }
    
  
    return $gpp; 
  }
   
   
 
  
  function date_of_last_pickup($id){
    global $dbprefix;
    global $db;
    $jh = $db->where("account_no",$id)->orderby("date_of_pickup","DESC")->get($dbprefix."_data_table","date_of_pickup");
    if(count($jh)>0){
        return $jh[0]['date_of_pickup'];
    } else {
        return 0;
    }
  } 
  
  function date_of_first_pickup($id){
    global $dbprefix;
    global $db;
    $jh = $db->where("account_no",$id)->orderby("date_of_pickup","ASC")->get($dbprefix."_data_table","date_of_pickup");
    if(count($jh)>0){
        return $jh[0]['date_of_pickup'];
    } else {
        return 0;
    }
  } 
  
  
  function countZeroPickups($id){
    global $dbprefix;
    global $db;
    $jh = $db->query("SELECT account_no FROM ".$dbprefix."_data_table WHERE inches_to_gallons = 0 && account_no=$id");
    
    return count($jh);
    
    
  }
  
  function AverageGallonsPerPickup($id){
    global $dbprefix;
    global $db;
    $total = 0;
    $jh = $db->where("account_no",$id)->get($dbprefix."_data_table","inches_to_gallons");    
    if(count($jh)>0){
        foreach($jh as $pickup){
            $total = $total + $pickup['inches_to_gallons'];
        }
        return $total / count($jh);
    }
    else {
        return 0;    
    }    
  }
  
}

?>