<?php
include "protected/global.php";
$date = date("Y-m-d");
$person = new Person();

if(isset($_POST['g_label']) && strlen($_POST['g_label'])>0){
    $db->query("UPDATE iwp_accounts SET label = '$_POST[g_label]' WHERE account_ID= $_POST[account]");
}
$grease_table = $dbprefix."_grease_traps";
$kl = new Account($_POST['account']);
     
        $jet_data = array(
           "account_no"=>$_POST['account']
           ,"date"=>$date
           ,"notes"=>$_POST['trap_description']           
           ,"price_per_gallon"=>$kl->grease_ppg
           ,"created_by"=>$person->user_id
           ,"frequency"=>$kl->grease_freq
           ,"volume"=>$kl->grease_volume
           ,"service"=>$kl->service_type     
           ,"time_of_service"=>$_POST['time_of_service_note']
           ,"addt_price"=>$_POST['price_additional']
           ,"addt_info"=>trim($_POST['price_additional_info'])          
           ,"service_date"=>$_POST['dos']
           ,"route_status"=>"scheduled"
           ,"active"=>$kl->trap_active
           ,"grease_name"=>$_POST['g_label']
        );
        
        //var_dump($jet_data);
        
        
        $result = $db->query("SELECT * FROM $grease_table WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute') ");
       
        if(count($result) == 0){
            if($db->insert($dbprefix."_grease_traps",$jet_data)){
                $id =$db->getInsertId();
                echo $id;    
            }else {
                /*echo "<pre>";
                var_dump($jet_data);
                echo "</pre>";*/
            }
        }
        else {
           
           if(isset($_POST['account']) AND  strlen($_POST['account']) !=0){
                $db->query("UPDATE $grease_table SET date='$date' WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute') ");                 
           
           }
           
           
           if(isset($_POST['trap_description']) AND  strlen($_POST['trap_description']) !=0 ){
                 $db->query("UPDATE $grease_table SET notes = '$_POST[trap_description]' WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute') ");      
           }
                                          
           
           if(isset($_POST['g_label']) AND strlen($_POST['g_label'])){
                 $db->query("UPDATE $grease_table SET grease_name = '$_POST[g_label]' WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute') ");  
                 
                 
                 
           }
          
                                                          
           
           
           if(isset($_POST['frequency'])  &&  strlen(  trim($_POST['frequency']) ) !=0){
                $db->query("UPDATE $grease_table SET frequency = $_POST[frequency] WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')  ");
           }
                                                     
           
         
                                                             
           
           
           if(isset($_POST['service'])  &&  strlen(  trim($_POST['service'])  ) !=0){
                  $db->query("UPDATE $grease_table SET service='$_POST[service]' WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')"); 
           }
           if(isset($_POST['trap_label'])  &&  strlen( trim($_POST['trap_label'])  ) !=0){
            $db->query("UPDATE $grease_table SET grease_name = '$_POST[trap_label]' WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')"); 
           }                                                
                                                
            
            
           if(isset($_POST['time_of_service_note']) AND  strlen( trim($_POST['time_of_service_note'])  ) !=0){
            $db->query("UPDATE $grease_table SET time_of_service = '$_POST[time_of_service_note]' WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')"); 
           }                                      
                                                 
           
           
           if(  isset($_POST['dos'])  &&  strlen( trim($_POST['dos']) ) !=0 ){
            $db->query("UPDATE $grease_table SET service_date ='$_POST[dos]' WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')"); 
           } 
           
            
           if(  isset($_POST['price_per_gallon']) AND  strlen(  trim($_POST['price_per_gallon']) ) !=0){
                //echo  "ppg: ".$_POST['price_per_gallon']."<br/>";
                 $db->query("UPDATE $grease_table SET price_per_gallon = $_POST[price_per_gallon] WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')  "); 
           }
           
           
           if(isset($_POST['volume'] )  &&  strlen(trim($_POST['volume'])) !=0){
             $db->query("UPDATE $grease_table SET volume = $_POST[volume] WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')  ");
           }
           
           
           //echo "<br/> addtional price : ".$_POST['price_additional_info']."<br/>";
           if( isset($_POST['price_additional_info'])  &&  strlen(trim($_POST['price_additional_info'])) !=0){
            $db->query("UPDATE $grease_table SET addt_price = $_POST[price_additional_info] WHERE account_no= $_POST[account] AND (route_status='scheduled' AND route_status='enroute')"); 
           }
            echo $result[0]['grease_no'];                                         
        }
        
        
        
        
$track = array(
    "date"=>date("Y-m-d H:i:s"),
    "user"=>$person->user_id,
    "actionType"=>"Grease Trap Manually scheduled",
    "descript"=>"Grease Trap schedule $id manually created",
    "account"=>$_POST['account'],
     "pertains"=>2,
    "type"=>7
);
$db->insert($dbprefix."_activity",$track);
        
     /* 
*/
?>



