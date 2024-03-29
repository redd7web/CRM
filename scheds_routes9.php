<?php
include "protected/global.php";
$i = 0;
$file = "biotane20141204/pickups.txt";// Your Temp Uploaded file
if(($handle = fopen($file,"r"))!==FALSE){
    /*Skip the first row*/
    fgetcsv($handle, 0,chr(9));
    while( ($data = fgetcsv($handle,0,chr(9)))!==FALSE   ){
       
      //DATA PREPARATION
      $rep_id = 0;
      if(strlen($data[11])> 0 && $data[11] !=NULL){
          $last_first = explode(" ",$data[11]);
          $spec1 = $db->query("SELECT user_id FROM iwp_users WHERE last LIKE '%".$last_first[1]."%'");
          if(count($spec1)>0){
            $rep_id = $spec1[0]['user_id'];
          }  
      }
        
        
      $num = 0;
      if(strlen($data[10]) >0 && $data[10] !=NULL){
          $first_last = explode(" ",$data[10]);
          $query = "SELECT user_id FROM iwp_users WHERE last LIKE '%".$first_last[1]."%";
          //echo $query;
          $spec = $db->query("SELECT user_id FROM iwp_users WHERE last LIKE '%".$first_last[1]."%'");
          if(count($spec)>0){
            $num = $spec[0]['user_id'];
          }
          
      }
      
      if(strlen($data[4])>0){
        $fire = 1;
      } else {
        $fire = 0;
      }
      
       
      if(strlen($data[3])>0 && $data[3] !=''){
        $title = htmlspecialchars($data[3]);
      } else {
        $title ="Unknown";
      }
      //***********************************************
      
       $kj = $db->where("ikg_manifest_route_number",$title)->get("iwp_ikg_manifest_info");
       
       
       if(count($kj)>0){
            $ikg_append = array(
                "account_numbers"=>$kj[0]['account_numbers'].$data[1]."|"
            );
           $db->where("route_id",$kj[0]['route_id'])->update("iwp_ikg_manifest_info",$ikg_append);
           $db->query("UPDATE iwp_list_of_routes set stops = stops+1 WHERE route_id = ".$kj[0]['route_id']);// update the amount of stops
       } else {
            //create route manifest
            if(strlen($data[2])>0 || $data[2] != NULL){
                $ikg = array(
                    "ikg_manifest_route_number"=>$title,
                    "route_id"=>$data[2],
                    "recieving_facility"=>reverseTranslate($data[12]),
                    "facility_address"=>$facils[reverseTranslate($data[12])],
                    "driver"=>$num,
                    "collected"=>"Yellow Grease",
                    "account_numbers"=>$data[1]
               );
               $db->insert("iwp_ikg_manifest_info",$ikg);
               $rid = $data[2]; 
           } else {            
                //auto generate id if not listed
                $ikg = array(
                    "ikg_manifest_route_number"=>$title,
                    "recieving_facility"=>reverseTranslate($data[12]),
                    "facility_address"=>$facils[reverseTranslate($data[12])],
                    "driver"=>$num,
                    "collected"=>"Yellow Grease",
                    "account_numbers"=>$data[1]
                );
               $db->insert("iwp_ikg_manifest_info",$ikg);
               $rid = getInsertId();
           }
           //************************
           
           
           $list_of_routes = array(
                "ikg_manifest_route_number"=>$title,
                "facility"=>reverseTranslate($data[12]),
                "driver"=>$num,
                "route_id"=>$rid,
                "created_by"=>$rep_id,
                "stops"=>1,
                "status"=>"completed"
           );
           
           $db->insert("iwp_list_of_routes",$list_of_routes);
           
       }
       
       //create schedule && data table entry
       $sched_package = array(
            "schedule_id"=>$data[0],
            "route_id"=>$rid,
            "scheduled_start_date"=>$data[6],
            "facility_origin"=>reverseTranslate($data[12]),
            "created_by"=>$rep_id,
            "driver"=>$num,
            "account_no"=>$data[1],
            "code_red"=>$fire,
            "date_created"=>$data[6],
            "route_status"=>"completed"
       );       
       $db->insert("iwp_scheduled_routes",$sched_package);
       //*****************************************
       
       $data_table = array(
            "route_id"=>$data[2],
            "schedule_id"=>$data[0],
            "inches_to_gallons"=>$data[7],
            "account_no"=>$data[1]."|",
            "driver"=>$num,
            "fieldreport"=>$data[8],
            "date_of_pickup"=>$data[6]
       );
       $db->insert("iwp_data_table",$data_table);
    }
}




?>