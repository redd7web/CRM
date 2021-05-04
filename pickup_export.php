<?php
include "protected/global.php";
    
    
    ini_set("display_errors",1);
   
    $file = "Arizona-oil-summary-".date("YmdHms").".xls";
    /**/include "protected/xlsfunctions.php";
    
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");           
    header("Content-Disposition: attachment;filename=$file");
    header("Content-Transfer-Encoding: binary "); 
    $xlsRow = 0;
    $xlsCol = 0;
    xlsBOF();
    xlsWriteLabel($xlsRow,0,"Account Name:");
    xlsWriteLabel($xlsRow,2,"Address:");
    xlsWriteLabel($xlsRow,4,"City:");
    xlsWriteLabel($xlsRow,6,"State:"); 
    xlsWriteLabel($xlsRow,8,"Zip");
    xlsWriteLabel($xlsRow,10,"Avg Gallons Per Month");
    xlsWriteLabel($xlsRow,12,"Raw Total Gallons:");
    xlsWriteLabel($xlsRow,14,"Adj Total Gallons:");
    xlsWriteLabel($xlsRow,16,"Contract Start");   
    xlsWriteLabel($xlsRow,18,"Contract End");
    xlsWriteLabel($xlsRow,20,"First Pickup");
    xlsWriteLabel($xlsRow,22,"Last Pickup:");
    xlsWriteLabel($xlsRow,24,"Division:");
    $hg = $db->query("SELECT account_ID,address,Name,city,state,zip,estimated_volume,state_date,expires,division FROM iwp_accounts WHERE division =8");
   
    if(count($hg)>0){
    foreach($hg as $k){
            $xlsRow++;
            
            $pickups = $db->query("SELECT SUM(inches_to_gallons) as allx FROM iwp_data_table WHERE account_no = $k[account_ID]");
            if(count($pickups)>0){
                $allx = $pickups[0]['allx'];
                $adj = $allx - ($allx *.25);
            }else {
                $allx = 0.00;
                $adj= 0.00;
            }
            $jhx = $db->query("SELECT date_of_pickup
FROM iwp_data_table
WHERE account_no =$k[account_ID]
ORDER BY date_of_pickup DESC
LIMIT 0 , 1");
            if(count($jhx)>0){
                $last = $jhx[0]['date_of_pickup'];
            }else{
                $last = "";
            }
            $jhi = $$db->query("SELECT date_of_pickup
FROM iwp_data_table
WHERE account_no =$k[account_ID]
ORDER BY date_of_pickup ASC
LIMIT 0 , 1");
            if(count($jhi)>0){
                $first = $jhi[0]['date_of_pickup'];
            }else{
                $first = "";
            }
            
    /**/    xlsWriteLabel($xlsRow,0,  $k['Name']);
            xlsWriteLabel($xlsRow,2,  $k['address']);
            xlsWriteLabel($xlsRow,4,  $k['city'] );
            xlsWriteLabel($xlsRow,6,  $k['state']  );
            xlsWriteLabel($xlsRow,8,  $k['zip']  );
            xlsWriteLabel($xlsRow,10, $k['estimated_volume'] );
            xlsWriteLabel($xlsRow,12, $allx );            
            xlsWriteLabel($xlsRow,14, number_format(  $adj  ,2) );
            xlsWriteLabel($xlsRow,16, $k['state_date'] );
            xlsWriteLabel($xlsRow,18, $k['expires'] );
            xlsWriteLabel($xlsRow,20, $first );
            xlsWriteLabel($xlsRow,22, $last);
            xlsWriteLabel($xlsRow,24, numberToFacility($k['division']) );
            //echo $jhx[0]['date_of_pickup']." ".$jhi[0]['date_of_pickup']." ".$pickups[0]['allx']." ".$jiji;
        }
     }
    xlsEOF(); 





?>