<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
$pallet_total = "";
$cod_trash ="";
$cod_weight_shrink = "";
$extr_cases= 0;
$extr_units =0;
$extr_pallets=0;
$product_weight_extruded=0;
$extr_gay_cases=0;
$extr_gay_units =0;
$qty_of_units_gay_pallets =0;
$qty_of_single_serve_pallets = 0;
$qty_of_extruded = 0;
$product_weight_gay = 0;
$bulk_cases = 0;
$bulk_units = 0;
$qty_of_bulk = 0;
$extr_gay = 0;
$bagged_under = 0;
$bagged_under_pallet= 0;
$bagged_under_cases = 0;
$bagged_under_units=0;
$qty_of_under_pallets = 0;
$product_weight_total_bagged_under=0;
$bagged_1to5_cases=0;
$bagged_1to5_units=0;
$qty_of_bagged1to5=0;
$product_weight_total_1to5=0;
$oneto5 = 0;
$single_serve = 0;
$over5 = 0;
$bagged_over_cases = 0;
$extr_pallets_ppt=0;
$extr_gay_ppt = 0;
$bagged_under_ppt = 0;
$bagged_1_to_5_ppt = 0;
$bagged_1to5_units = 0;
$bagged_over_units = 0;
$product_weight_total_over5 =0;
$bagged_over_5_ppt = 0;
$single_cases=0;
$product_weight_total_single = 0;
$bagged_over_5_ppt = 0;
$single_ppt = 0;
$total_pallet_weight = 0;
$extr_cost = 0;
$gay_cost = 0;
$bagged_under_cost = 0;
$bagged_1_to_5_cost = 0;
$bagged_over_five_cost = 0;
$total_other_cost = 0;
$single_serve_total_cost = 0;
$extr_product_num = "";
$gay_product_num = "";
$single_product_num ="";
$under_product_num = "";
$one_to_five_product_num ="";
$over_five_product_num = "";
$single_units ="";
$qty_of_units_pallets ="";
if(isset($_GET['compl'])){
    
    $cod_info = $db->query("SELECT ap_form_49773.*,ap_form_43256.element_145 as inco_wtn,ap_form_43256.element_144 as tsl_wtn_pic,ap_form_43256.element_151 as bol, ap_form_49773.element_138 as cod_pallet_total,ap_form_49773.element_141 as cod_trash_total,ap_form_49773.element_189 as cod_weight_shrink FROM Inetforms.ap_form_49773 LEFT JOIN  Inetforms.ap_form_43256 ON ap_form_43256.id = ap_form_49773.element_76 WHERE ap_form_49773.id = $_GET[compl]");
    $soy_price = $db->query("SELECT * FROM iwp_soybean ORDER BY date DESC LIMIT 0,1");
    if(count($cod_info)>0){
      if(strlen(trim($cod_info[0]['element_311']))>0){//light load
        $total_other_cost += $cod_info[0]['element_311'];
      }  
      
      if(strlen(trim($cod_info[0]['element_313']))>0){//addtl freight
        $total_other_cost += $cod_info[0]['element_312'];
      }
      
      if(strlen(trim($cod_info[0]['element_313']))>0){//foreign substance
        $total_other_cost += $cod_info[0]['element_312'];
      }
      
      if(strlen(trim($cod_info[0]['element_651']))>0){//foreign substance deduction
        $total_other_cost += $cod_info[0]['element_651'];
      }
      
      if(strlen(trim($cod_info[0]['element_314']))>0){//water
        $total_other_cost += $cod_info[0]['element_314'];
      }
      
      if(strlen(trim($cod_info[0]['element_652']))>0){//moisture deduction
        $total_other_cost += $cod_info[0]['element_652'];
      }
      
      if(strlen(trim($cod_info[0]['element_317']))>0){//ppt adjustment
        $total_other_cost += $cod_info[0]['element_317'];
      }
      
      if(strlen(trim($cod_info[0]['element_318']))>0){//additional flat fee
        $total_other_cost += $cod_info[0]['element_318'];
      }
      
      if(strlen(trim($cod_info[0]['element_316']))>0){//load calculated price per ton
        $total_other_cost += $cod_info[0]['element_316'];
      }
      
      if(strlen(trim($cod_info[0]['element_654']))>0){//adjusted freight
        $total_other_cost += $cod_info[0]['element_654'];
      }
      
      if(strlen(trim($cod_info[0]['element_654']))>0){//mixed load product cost
        $total_other_cost += $cod_info[0]['element_654'];
      }
      
      
      $total_pallet_weight = $cod_info[0]['element_346'] + $cod_info[0]['element_614']+$cod_info[0]['element_615'] +$cod_info[0]['element_619'] + $cod_info[0]['element_618'] + $cod_info[0]['element_362'] + $cod_info[0]['element_623'] + $cod_info[0]['element_622'] + $cod_info[0]['element_378']+ $cod_info[0]['element_627']+ $cod_info[0]['element_626'] + $cod_info[0]['element_395'] + $cod_info[0]['element_631'] + $cod_info[0]['element_630'] + $cod_info[0]['element_409']+ $cod_info[0]['element_635']+ $cod_info[0]['element_634'] + $cod_info[0]['element_429'] + $cod_info[0]['element_639'] + $cod_info[0]['element_638'] + $cod_info[0]['element_446'] +$cod_info[0]['element_643'] + $cod_info[0]['element_642'];  
      $pallet_total =  $cod_info[0]['cod_pallet_total'];
      $cod_trash =  $cod_info[0]['cod_trash_total'];
      $cod_weight_shrink =  $cod_info[0]['cod_weight_shrink'];
        
        if(isset($cod_info[0]['element_321']) && $cod_info[0]['element_321'] !=0){
            switch($cod_info[0]['element_321']){//product 1  
                case 66://Extruded Pallet
                    $extr_pallets = 0;
                    $extr_product_num = 1;
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                    $extr_cases = $cod_info[0]['element_458'];
                    $extr_units = $cod_info[0]['element_325'];
                    $qty_of_units_pallets = $extr_cases*$extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = ((($product_weight_extruded * $extr_pallets_ppt))/2000)  ;
                    
                    if(isset($cod_info[0]['element_323_1']) && $cod_info[0]['element_323_1'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_2']) && $cod_info[0]['element_323_2'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_3']) && $cod_info[0]['element_323_3'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_4']) && $cod_info[0]['element_323_4'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_5']) && $cod_info[0]['element_323_5'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_6']) && $cod_info[0]['element_323_6'] !=0   ){
                        $extr_pallets++;    
                    }
                break;
                case 67://Extruded Gaylord
                    $extr_gay = 0;
                    $gay_product_num = 1;
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_gay_ppt = ($over*5) -45;
                    }
                    $extr_gay_cases = $cod_info[0]['element_458'];
                    $extr_gay_units=$cod_info[0]['element_325'];
                    $qty_of_units_gay_pallets = $extr_gay_cases*$extr_gay_units;
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = ((($product_weight_gay * $extr_gay_ppt) )/2000) ;
                    
                    if(isset($cod_info[0]['element_340_1']) && $cod_info[0]['element_340_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_340_2']) && $cod_info[0]['element_340_2'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_3']) && $cod_info[0]['element_340_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_4']) && $cod_info[0]['element_340_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_5']) && $cod_info[0]['element_340_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_6']) && $cod_info[0]['element_340_6'] !=0   ){
                        $extr_gay++;    
                    }
                    
                break;
                case 68://Bulk   
                    $bulk = 0;
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }                 
                    $bulk_cases = $cod_info[0]['element_458'];
                    $bulk_units=$cod_info[0]['element_325'];
                    $qty_of_bulk = $bulk_cases*$bulk_units;
                    if(isset($cod_info[0]['element_323_1']) && $cod_info[0]['element_323_1'] !=0   ){
                        $bulk++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_323_2']) && $cod_info[0]['element_323_2'] !=0   ){
                        $bulk++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_3']) && $cod_info[0]['element_323_3'] !=0   ){
                        $bulk++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_4']) && $cod_info[0]['element_323_4'] !=0   ){
                        $bulk++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_5']) && $cod_info[0]['element_323_5'] !=0   ){
                        $bulk++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_6']) && $cod_info[0]['element_323_6'] !=0   ){
                        $bulk++;    
                    }
                    
                break;
                case 69://Single Serve
                    $single_serve = 0;
                    $single_product_num = 1;
                    $single_cases=$cod_info[0]['element_458'];
                    $single_units=$cod_info[0]['element_325'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  $qty_of_single_serve_pallets;
                    $single_serve_total_cost = $total_other_cost;
                    
                    
                    if(isset($cod_info[0]['element_323_1']) && $cod_info[0]['element_323_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_323_2']) && $cod_info[0]['element_323_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_3']) && $cod_info[0]['element_323_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_4']) && $cod_info[0]['element_323_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_5']) && $cod_info[0]['element_323_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_6']) && $cod_info[0]['element_323_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $bagged_under = 0;
                    $under_product_num =1;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_458'];
                    $bagged_under_units=$cod_info[0]['element_325'];
                    $qty_of_under_pallets =$bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = ((($product_weight_total_bagged_under * $bagged_under_ppt) )/2000) ;
                    
                    if(isset($cod_info[0]['element_323_1']) && $cod_info[0]['element_323_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_323_2']) && $cod_info[0]['element_323_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_3']) && $cod_info[0]['element_323_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_4']) && $cod_info[0]['element_323_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_5']) && $cod_info[0]['element_323_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_6']) && $cod_info[0]['element_323_6'] !=0   ){
                        $bagged_under++;    
                    }
                break;
                case 71://Bagged  1lb to 5lb
                    $oneto5 = 0;
                    $one_to_five_product_num = 1;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    $bagged_1to5_cases=$cod_info[0]['element_458'];
                    $bagged_1to5_units=$cod_info[0]['element_325'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases*$bagged_1to5_units;
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = ((($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000) ;
                    
                    if(isset($cod_info[0]['element_323_1']) && $cod_info[0]['element_323_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_323_2']) && $cod_info[0]['element_323_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_3']) && $cod_info[0]['element_323_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_4']) && $cod_info[0]['element_323_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_5']) && $cod_info[0]['element_323_5'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_6']) && $cod_info[0]['element_323_6'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over5 = 0;
                    $over_five_product_num = 1;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else{
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_458'];
                    $bagged_over_units=$cod_info[0]['element_325'];
                    $qty_of_bagged_over =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = ( ( ($product_weight_total_over5 * $bagged_over_5_ppt) )/2000) ;  
                    
                    if(isset($cod_info[0]['element_323_1']) && $cod_info[0]['element_323_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_323_2']) && $cod_info[0]['element_323_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_3']) && $cod_info[0]['element_323_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_4']) && $cod_info[0]['element_323_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_5']) && $cod_info[0]['element_323_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_323_6']) && $cod_info[0]['element_323_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
        }
        
        
        
        
         if(isset($cod_info[0]['element_338']) && $cod_info[0]['element_338'] !=0){
            switch($cod_info[0]['element_338']){//product 2 
                case 66://Extruded Pallet
                    $extr_pallets = 0;
                    $extr_product_num = 2;
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                    $extr_cases = $cod_info[0]['element_342'];
                    $extr_units=$cod_info[0]['element_457'];
                    $qty_of_units_pallets = $extr_cases*$extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = ((($product_weight_extruded * $extr_pallets_ppt) )/2000);
                    
                    
                    
                    if(isset($cod_info[0]['element_340_1']) && $cod_info[0]['element_340_1'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_340_2']) && $cod_info[0]['element_340_2'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_3']) && $cod_info[0]['element_340_3'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_4']) && $cod_info[0]['element_340_4'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_5']) && $cod_info[0]['element_340_5'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_6']) && $cod_info[0]['element_340_6'] !=0   ){
                        $extr_pallets++;    
                    }
                break;
                case 67://Extruded Gaylord
                    $extr_gay = 0;
                    $gay_product_num = 2;                    
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)/10);
                        $extr_gay_ppt = ($over*5)-45;
                    }
                    $extr_gay_cases =$cod_info[0]['element_342'];
                    $extr_gay_units=$cod_info[0]['element_457'];
                    $qty_of_units_gay_pallets=$extr_gay_cases *$extr_gay_units;
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = ((($product_weight_gay * $extr_gay_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_340_1']) && $cod_info[0]['element_340_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_340_2']) && $cod_info[0]['element_340_2'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_3']) && $cod_info[0]['element_340_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_4']) && $cod_info[0]['element_340_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_5']) && $cod_info[0]['element_340_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_6']) && $cod_info[0]['element_340_6'] !=0   ){
                        $extr_gay++;    
                    }
                break;
                case 68://Bulk
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }
                    $bulk_cases=$cod_info[0]['element_342'];
                    $bulk_units=$cod_info[0]['element_457'];
                    $qty_of_bulk =$bulk_cases*$bulk_units;
                break;
                case 69://Single Serve
                    $single_serve = 0;
                    $single_product_num = 2;
                    $single_cases=$cod_info[0]['element_342'];
                    $single_units=$cod_info[0]['element_457'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  ($qty_of_single_serve_pallets*.01);
                    $single_serve_total_cost = $total_other_cost;
                    
                    
                    
                    if(isset($cod_info[0]['element_340_1']) && $cod_info[0]['element_340_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_340_2']) && $cod_info[0]['element_340_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_3']) && $cod_info[0]['element_340_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_4']) && $cod_info[0]['element_340_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_5']) && $cod_info[0]['element_340_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_6']) && $cod_info[0]['element_340_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $bagged_under = 0;
                    $under_product_num = 2;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_342'];
                    $bagged_under_units=$cod_info[0]['element_457'];
                    $qty_of_under_pallets = $bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = ((($product_weight_total_bagged_under * $bagged_under_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_340_1']) && $cod_info[0]['element_340_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_340_2']) && $cod_info[0]['element_340_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_3']) && $cod_info[0]['element_340_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_4']) && $cod_info[0]['element_340_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_5']) && $cod_info[0]['element_340_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_6']) && $cod_info[0]['element_340_6'] !=0   ){
                        $bagged_under++;    
                    }
                    
                break;
                case 71://Bagged  1lb to 5lb
                    $oneto5 = 0;
                    $one_to_five_product_num = 2;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    $bagged_1to5_cases=$cod_info[0]['element_342'];
                    $bagged_1to5_units=$cod_info[0]['element_457'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases * $bagged_1to5_units;
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = ((($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_340_1']) && $cod_info[0]['element_340_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_340_2']) && $cod_info[0]['element_340_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_3']) && $cod_info[0]['element_340_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_4']) && $cod_info[0]['element_340_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_5']) && $cod_info[0]['element_340_5'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_6']) && $cod_info[0]['element_340_6'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over5 = 0;
                    $over_five_product_num = 2;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_342'];
                    $bagged_over_units=$cod_info[0]['element_457'];
                    $qty_of_bagged_over  =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = ((($product_weight_total_over5 * $bagged_over_5_ppt) )/2000);  
                    
                    
                    if(isset($cod_info[0]['element_340_1']) && $cod_info[0]['element_340_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_340_2']) && $cod_info[0]['element_340_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_3']) && $cod_info[0]['element_340_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_4']) && $cod_info[0]['element_340_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_5']) && $cod_info[0]['element_340_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_340_6']) && $cod_info[0]['element_340_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
         }
        
        if(isset($cod_info[0]['element_354']) && $cod_info[0]['element_354'] !=0){
            switch($cod_info[0]['element_354']){//product 3 
                case 66://Extruded Pallet     
                    $extr_pallets = 0;
                    $extr_product_num = 3;          
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                
                    $extr_cases = $cod_info[0]['element_358'];
                    $extr_units=$cod_info[0]['element_456'];
                    $qty_of_extruded=$extr_cases * $extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = ((($product_weight_extruded * $extr_pallets_ppt) )/2000);
                    if(isset($cod_info[0]['element_356_1']) && $cod_info[0]['element_356_1'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_356_2']) && $cod_info[0]['element_356_2'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_3']) && $cod_info[0]['element_356_3'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_4']) && $cod_info[0]['element_356_4'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_5']) && $cod_info[0]['element_356_5'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_6']) && $cod_info[0]['element_356_6'] !=0   ){
                        $extr_pallets++;    
                    }
                break;
                case 67://Extruded Gaylord
                    $extr_gay = 0;
                    $gay_product_num = 3;
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)/10);
                        $extr_gay_ppt = ($over*5)-45;
                    }
                    $extr_gay_cases =$cod_info[0]['element_358'];
                    $extr_gay_units=$cod_info[0]['element_456'];
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = ((($product_weight_gay * $extr_gay_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_356_1']) && $cod_info[0]['element_356_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_356_2']) && $cod_info[0]['element_356_2'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_3']) && $cod_info[0]['element_356_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_4']) && $cod_info[0]['element_356_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_5']) && $cod_info[0]['element_356_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_6']) && $cod_info[0]['element_356_6'] !=0   ){
                        $extr_gay++;    
                    }
                break;
                case 68://Bulk
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }
                    $bulk_cases=$cod_info[0]['element_358'];
                    $bulk_units=$cod_info[0]['element_456'];
                    $qty_of_bulk =$bulk_cases*$bulk_units;
                break;
                case 69://Single Serve
                    $single_serve = 0;
                    $single_product_num = 3;
                    $single_cases=$cod_info[0]['element_358'];
                    $single_units=$cod_info[0]['element_456'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  ($qty_of_single_serve_pallets*.01);
                    $single_serve_total_cost = $total_other_cost;
                    if(isset($cod_info[0]['element_356_1']) && $cod_info[0]['element_356_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_356_2']) && $cod_info[0]['element_356_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_3']) && $cod_info[0]['element_356_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_4']) && $cod_info[0]['element_356_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_5']) && $cod_info[0]['element_356_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_6']) && $cod_info[0]['element_356_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $bagged_under = 0;
                    $under_product_num = 3;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_358'];
                    $bagged_under_units=$cod_info[0]['element_456'];
                    $qty_of_under_pallets =$bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = (($product_weight_total_bagged_under * $bagged_under_ppt)/2000) ;
                     if(isset($cod_info[0]['element_356_1']) && $cod_info[0]['element_356_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_356_2']) && $cod_info[0]['element_356_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_3']) && $cod_info[0]['element_356_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_4']) && $cod_info[0]['element_356_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_5']) && $cod_info[0]['element_356_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_6']) && $cod_info[0]['element_356_6'] !=0   ){
                        $bagged_under++;    
                    }
                break;
                case 71://Bagged  1lb to 5lb
                    $oneto5 = 0;
                    $one_to_five_product_num = 3;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    $bagged_1to5_cases=$cod_info[0]['element_358'];
                    $bagged_1to5_units=$cod_info[0]['element_456'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases*$bagged_1to5_units;
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = ((($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000);

                    if(isset($cod_info[0]['element_356_1']) && $cod_info[0]['element_356_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_356_2']) && $cod_info[0]['element_356_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_3']) && $cod_info[0]['element_356_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_4']) && $cod_info[0]['element_356_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_5']) && $cod_info[0]['element_356_5'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_6']) && $cod_info[0]['element_356_6'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over5 = 0;
                    $over_five_product_num = 3;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_358'];
                    $bagged_over_units=$cod_info[0]['element_456'];
                    $qty_of_bagged_over =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = ((($product_weight_total_over5 * $bagged_over_5_ppt) )/2000);  

                    if(isset($cod_info[0]['element_356_1']) && $cod_info[0]['element_356_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_356_2']) && $cod_info[0]['element_356_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_3']) && $cod_info[0]['element_356_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_4']) && $cod_info[0]['element_356_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_5']) && $cod_info[0]['element_356_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_356_6']) && $cod_info[0]['element_356_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
        }
        
        
        if(isset($cod_info[0]['element_370']) && $cod_info[0]['element_370'] !=0){
            switch($cod_info[0]['element_370']){//product 4 
                case 66://Extruded Pallet
                    $extr_pallets = 0;
                    $extr_product_num = 4;
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                    $extr_cases = $cod_info[0]['element_374'];
                    $extr_units=$cod_info[0]['element_455'];
                    $qty_of_units_pallets = $extr_cases*$extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = ((($product_weight_extruded * $extr_pallets_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_372_1']) && $cod_info[0]['element_372_1'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_372_2']) && $cod_info[0]['element_372_2'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_3']) && $cod_info[0]['element_372_3'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_4']) && $cod_info[0]['element_372_4'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_5']) && $cod_info[0]['element_372_5'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_6']) && $cod_info[0]['element_372_6'] !=0   ){
                        $extr_pallets++;    
                    }
                break;
                case 67://Extruded Gaylord
                    $extr_gay = 0;
                    $extr_product_num = 4;
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)/10);
                        $extr_gay_ppt = ($over*5)-45;
                    }
                    $extr_gay_cases =$cod_info[0]['element_374'];
                    $extr_gay_units=$cod_info[0]['element_455'];
                    $qty_of_units_gay_pallets =$extr_gay_cases *$extr_gay_units;
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = ((($product_weight_gay * $extr_gay_ppt) )/2000);
                    if(isset($cod_info[0]['element_372_1']) && $cod_info[0]['element_372_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_372_2']) && $cod_info[0]['element_372_2'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_3']) && $cod_info[0]['element_372_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_4']) && $cod_info[0]['element_372_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_5']) && $cod_info[0]['element_372_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_6']) && $cod_info[0]['element_372_6'] !=0   ){
                        $extr_gay++;    
                    }
                break;
                case 68://Bulk
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }
                    $bulk_cases=$cod_info[0]['element_374'];
                    $bulk_units=$cod_info[0]['element_455'];
                    $qty_of_bulk =$bulk_cases*$bulk_units;
                break;
                case 69://Single Serve
                    $single_serve = 0;
                    $single_product_num = 4;
                    $single_cases=$cod_info[0]['element_374'];
                    $single_units=$cod_info[0]['element_455'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  ($qty_of_single_serve_pallets*.01);
                    $single_serve_total_cost = $total_other_cost;
                    if(isset($cod_info[0]['element_372_1']) && $cod_info[0]['element_372_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_372_2']) && $cod_info[0]['element_372_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_3']) && $cod_info[0]['element_372_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_4']) && $cod_info[0]['element_372_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_5']) && $cod_info[0]['element_372_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_6']) && $cod_info[0]['element_372_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $bagged_under = 0;
                    $under_product_num =4;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_374'];
                    $bagged_under_units=$cod_info[0]['element_455'];
                    $qty_of_under_pallets =$bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = ((($product_weight_total_bagged_under * $bagged_under_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_372_1']) && $cod_info[0]['element_372_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_372_2']) && $cod_info[0]['element_372_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_3']) && $cod_info[0]['element_372_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_4']) && $cod_info[0]['element_372_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_5']) && $cod_info[0]['element_372_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_6']) && $cod_info[0]['element_372_6'] !=0   ){
                        $bagged_under++;    
                    }
                break;
                case 71://Bagged  1lb to 5lb
                    $oneto5 = 0;
                    $one_to_five_product_num = 4;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    
                    $bagged_1to5_cases=$cod_info[0]['element_374'];
                    $bagged_1to5_units=$cod_info[0]['element_455'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases*$bagged_1to5_units;
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = ((($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000);
                    if(isset($cod_info[0]['element_372_1']) && $cod_info[0]['element_372_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_372_2']) && $cod_info[0]['element_372_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_3']) && $cod_info[0]['element_372_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_4']) && $cod_info[0]['element_372_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_5']) && $cod_info[0]['element_372_5'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_6']) && $cod_info[0]['element_372_6'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over5 = 0;
                    $over_five_product_num = 4;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else{
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_374'];
                    $bagged_over_units=$cod_info[0]['element_455'];
                    $qty_of_bagged_over =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = ((($product_weight_total_over5 * $bagged_over_5_ppt) )/2000);
                    if(isset($cod_info[0]['element_372_1']) && $cod_info[0]['element_372_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_372_2']) && $cod_info[0]['element_372_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_3']) && $cod_info[0]['element_372_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_4']) && $cod_info[0]['element_372_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_5']) && $cod_info[0]['element_372_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_372_6']) && $cod_info[0]['element_372_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
        }
        
        
        if(isset($cod_info[0]['element_386']) && $cod_info[0]['element_386'] !=0){
            switch($cod_info[0]['element_386']){//product 5 
                case 66://Extruded Pallet
                    $extr_pallets = 0;
                    $extr_product_num = 4;
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                
                    $extr_cases = $cod_info[0]['element_390'];
                    $extr_units = $cod_info[0]['element_454'];
                    $qty_of_units_pallets = $extr_cases*$extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = ((($product_weight_extruded * $extr_pallets_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_388_1']) && $cod_info[0]['element_388_1'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_388_2']) && $cod_info[0]['element_388_2'] !=0   ){
                        $extr_pallets++; 
                    }
                    
                    if(isset($cod_info[0]['element_388_3']) && $cod_info[0]['element_388_3'] !=0   ){
                        $extr_pallets++;   
                    }
                    
                    if(isset($cod_info[0]['element_388_4']) && $cod_info[0]['element_388_4'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_5']) && $cod_info[0]['element_388_5'] !=0   ){
                        $extr_pallets++;   
                    }
                    
                    if(isset($cod_info[0]['element_388_6']) && $cod_info[0]['element_388_6'] !=0   ){
                        $extr_pallets++; 
                    }
                break;
                case 67://Extruded Gaylord
                    $gay_product_num = 5;
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)/10);
                        $extr_gay_ppt = ($over*5)-45;
                    }
                    $extr_gay_cases =$cod_info[0]['element_390'];
                    $extr_gay_units=$cod_info[0]['element_454'];
                    $qty_of_units_gay_pallets =$extr_gay_cases *$extr_gay_units;
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = ((($product_weight_gay * $extr_gay_ppt) )/2000);
                    
                    if(isset($cod_info[0]['element_388_1']) && $cod_info[0]['element_388_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_388_2']) && $cod_info[0]['element_388_2'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_3']) && $cod_info[0]['element_388_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_4']) && $cod_info[0]['element_388_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_5']) && $cod_info[0]['element_388_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_6']) && $cod_info[0]['element_388_6'] !=0   ){
                        $extr_gay++;    
                    }
                break;
                case 68://Bulk
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }
                    $bulk_cases=$cod_info[0]['element_390'];
                    $bulk_units=$cod_info[0]['element_454'];
                    $qty_of_bulk =$bulk_cases*$bulk_units;
                break;
                case 69://Single Serve
                    $single_product_num = 5;
                    $single_cases=$cod_info[0]['element_390'];
                    $single_units=$cod_info[0]['element_454'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  ($qty_of_single_serve_pallets*.01);
                    $single_serve_total_cost = $total_other_cost;
                    
                    if(isset($cod_info[0]['element_388_1']) && $cod_info[0]['element_388_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_388_2']) && $cod_info[0]['element_388_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_3']) && $cod_info[0]['element_388_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_4']) && $cod_info[0]['element_388_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_5']) && $cod_info[0]['element_388_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_6']) && $cod_info[0]['element_388_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $bagged_under = 0;
                    $under_product_num = 5;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_390'];
                    $bagged_under_units=$cod_info[0]['element_454'];
                    $qty_of_under_pallets =$bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = ((($product_weight_total_bagged_under * $bagged_under_ppt) )/2000);
                    
                    if(isset($cod_info[0]['element_388_1']) && $cod_info[0]['element_388_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_388_2']) && $cod_info[0]['element_388_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_3']) && $cod_info[0]['element_388_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_4']) && $cod_info[0]['element_388_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_5']) && $cod_info[0]['element_388_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_6']) && $cod_info[0]['element_388_6'] !=0   ){
                        $bagged_under++;    
                    }
                break;
                case 71://Bagged  1lb to 5lb
                    $one_to_five_product_num = 5;
                     if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    $bagged_1to5_cases=$cod_info[0]['element_390'];
                    $bagged_1to5_units=$cod_info[0]['element_454'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases*$bagged_1to5_units;
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = ((($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000);
                    if(isset($cod_info[0]['element_388_1']) && $cod_info[0]['element_388_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_388_2']) && $cod_info[0]['element_388_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_3']) && $cod_info[0]['element_388_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_4']) && $cod_info[0]['element_388_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_5']) && $cod_info[0]['element_388_5'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_6']) && $cod_info[0]['element_388_6'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over_five_product_num = 5;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_390'];
                    $bagged_over_units=$cod_info[0]['element_454'];
                    $qty_of_bagged_over =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = ((($product_weight_total_over5 * $bagged_over_5_ppt) )/2000); 
                    
                    
                    if(isset($cod_info[0]['element_388_1']) && $cod_info[0]['element_388_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_388_2']) && $cod_info[0]['element_388_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_3']) && $cod_info[0]['element_388_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_4']) && $cod_info[0]['element_388_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_5']) && $cod_info[0]['element_388_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_388_6']) && $cod_info[0]['element_388_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
        }
        
        if(isset($cod_info[0]['element_400']) && $cod_info[0]['element_400'] !=0){
            switch($cod_info[0]['element_400']){//product 6 
                case 66://Extruded Pallet
                    $extr_units = 0;
                    $extr_product_num = 6;
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                    $extr_cases = $cod_info[0]['element_404'];
                    $extr_units = $cod_info[0]['element_453'];
                    $qty_of_units_pallets = $extr_cases*$extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = ((($product_weight_extruded * $extr_pallets_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_402_1']) && $cod_info[0]['element_402_1'] !=0   ){
                        $extr_units++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_402_2']) && $cod_info[0]['element_402_2'] !=0   ){
                        $extr_units++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_3']) && $cod_info[0]['element_402_3'] !=0   ){
                        $extr_units++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $extr_units++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_5']) && $cod_info[0]['element_402_5'] !=0   ){
                        $extr_units++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_6']) && $cod_info[0]['element_402_6'] !=0   ){
                        $extr_units++;    
                    }
                break;
                case 67://Extruded Gaylord
                    $gay_product_num = 6;
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)/10);
                        $extr_gay_ppt = ($over*5)-45;
                    }
                    $extr_gay_cases =$cod_info[0]['element_404'];
                    $extr_gay_units=$cod_info[0]['element_453'];
                    $qty_of_units_gay_pallets =$extr_gay_cases *$extr_gay_units;                    
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = ((($product_weight_gay * $extr_gay_ppt) )/2000);
                    
                    if(isset($cod_info[0]['element_402_1']) && $cod_info[0]['element_402_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_402_2']) && $cod_info[0]['element_402_21'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_3']) && $cod_info[0]['element_402_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_5']) && $cod_info[0]['element_402_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_6']) && $cod_info[0]['element_402_6'] !=0   ){
                        $extr_gay++;    
                    }
                break;
                case 68://Bulk
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }
                    $bulk_cases=$cod_info[0]['element_404'];
                    $bulk_units=$cod_info[0]['element_453'];
                    $qty_of_bulk =$bulk_cases*$bulk_units;
                    
                break;
                case 69://Single Serve
                    $single_product_num = 6;
                    $single_cases=$cod_info[0]['element_404'];
                    $single_units=$cod_info[0]['element_453'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  ($qty_of_single_serve_pallets*.01);
                    $single_serve_total_cost = $total_other_cost;
                    if(isset($cod_info[0]['element_402_1']) && $cod_info[0]['element_402_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_402_2']) && $cod_info[0]['element_402_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_3']) && $cod_info[0]['element_402_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_5']) && $cod_info[0]['element_402_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_6']) && $cod_info[0]['element_402_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $under_product_num =6;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_404'];
                    $bagged_under_units=$cod_info[0]['element_453'];
                    $qty_of_under_pallets =$bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = ((($product_weight_total_bagged_under * $bagged_under_ppt) )/2000);
                     
                     if(isset($cod_info[0]['element_402_1']) && $cod_info[0]['element_402_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_402_2']) && $cod_info[0]['element_402_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_3']) && $cod_info[0]['element_402_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_5']) && $cod_info[0]['element_402_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_6']) && $cod_info[0]['element_402_6'] !=0   ){
                        $bagged_under++;    
                    }
                break;
                case 71://Bagged  1lb to 5lb
                    $one_to_five_product_num = 6;
                     if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    $bagged_1to5_cases=$cod_info[0]['element_404'];
                    $bagged_1to5_units=$cod_info[0]['element_453'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases*$bagged_1to5_units;
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = ((($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000);
                     if(isset($cod_info[0]['element_402_1']) && $cod_info[0]['element_402_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_402_2']) && $cod_info[0]['element_402_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_3']) && $cod_info[0]['element_402_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over_five_product_num = 6;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else{
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_404'];
                    $bagged_over_units=$cod_info[0]['element_453'];
                    $qty_of_bagged_over =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = ((($product_weight_total_over5 * $bagged_over_5_ppt) )/2000);  
                    if(isset($cod_info[0]['element_402_1']) && $cod_info[0]['element_402_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_402_2']) && $cod_info[0]['element_402_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_3']) && $cod_info[0]['element_402_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_4']) && $cod_info[0]['element_402_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_5']) && $cod_info[0]['element_402_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_402_6']) && $cod_info[0]['element_402_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
        }
        
        if(isset($cod_info[0]['element_420']) && $cod_info[0]['element_420'] !=0){
            switch($cod_info[0]['element_420']){//product 7 
                case 66://Extruded Pallet
                    $extr_product_num = 7;
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                    $extr_cases = $cod_info[0]['element_424'];
                    $extr_units = $cod_info[0]['element_425'];
                    $qty_of_units_pallets = $extr_cases*$extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = ((($product_weight_extruded * $extr_pallets_ppt) )/2000);
                    
                    
                    if(isset($cod_info[0]['element_422_1']) && $cod_info[0]['element_422_1'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_422_2']) && $cod_info[0]['element_422_2'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_3']) && $cod_info[0]['element_422_3'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_4']) && $cod_info[0]['element_422_4'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_5']) && $cod_info[0]['element_422_5'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_6']) && $cod_info[0]['element_422_6'] !=0   ){
                        $extr_pallets++;    
                    }
                break;
                case 67://Extruded Gaylord
                    $gay_product_num = 7;
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)/10);
                        $extr_gay_ppt = ($over*5)-45;
                    }
                    $extr_gay_cases =$cod_info[0]['element_424'];
                    $extr_gay_units=$cod_info[0]['element_425'];
                    $qty_of_units_gay_pallets =$extr_gay_cases *$extr_gay_units;
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = (($product_weight_gay * $extr_gay_ppt) )/2000;
                    
                    
                    
                    if(isset($cod_info[0]['element_422_1']) && $cod_info[0]['element_422_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_422_2']) && $cod_info[0]['element_422_2'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_3']) && $cod_info[0]['element_422_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_4']) && $cod_info[0]['element_422_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_5']) && $cod_info[0]['element_422_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_6']) && $cod_info[0]['element_422_6'] !=0   ){
                        $extr_gay++;    
                    }
                break;
                case 68://Bulk
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }
                    $bulk_cases=$cod_info[0]['element_424'];
                    $bulk_units=$cod_info[0]['element_425'];
                    $qty_of_bulk =$bulk_cases*$bulk_units;
                break;
                case 69://Single Serve
                    $single_product_num = 7;
                    $single_cases=$cod_info[0]['element_424'];
                    $single_units=$cod_info[0]['element_425'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  ($qty_of_single_serve_pallets*.01);
                    $single_serve_total_cost = $total_other_cost;
                    
                    
                    
                    if(isset($cod_info[0]['element_422_1']) && $cod_info[0]['element_422_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_422_2']) && $cod_info[0]['element_422_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_3']) && $cod_info[0]['element_422_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_4']) && $cod_info[0]['element_422_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_5']) && $cod_info[0]['element_422_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_6']) && $cod_info[0]['element_422_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $under_product_num = 7;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_424'];
                    $bagged_under_units=$cod_info[0]['element_425'];
                    $qty_of_under_pallets =$bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = (($product_weight_total_bagged_under * $bagged_under_ppt) )/2000;
                    
                    
                    
                    if(isset($cod_info[0]['element_422_1']) && $cod_info[0]['element_422_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_422_2']) && $cod_info[0]['element_422_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_3']) && $cod_info[0]['element_422_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_4']) && $cod_info[0]['element_422_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_5']) && $cod_info[0]['element_422_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_6']) && $cod_info[0]['element_422_6'] !=0   ){
                        $bagged_under++;    
                    }
                break;
                case 71://Bagged  1lb to 5lb
                    $over_five_product_num = 7;
                     if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    $bagged_1to5_cases=$cod_info[0]['element_424'];
                    $bagged_1to5_units=$cod_info[0]['element_425'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases*$bagged_1to5_units;
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = (($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000;
                    
                    
                    if(isset($cod_info[0]['element_422_1']) && $cod_info[0]['element_422_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_422_2']) && $cod_info[0]['element_422_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_3']) && $cod_info[0]['element_422_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_4']) && $cod_info[0]['element_422_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_5']) && $cod_info[0]['element_422_5'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_6']) && $cod_info[0]['element_422_6'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over_five_product_num = 7;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_424'];
                    $bagged_over_units=$cod_info[0]['element_425'];
                    $qty_of_bagged_over =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = (($product_weight_total_over5 * $bagged_over_5_ppt) )/2000; 
                    
                    
                    if(isset($cod_info[0]['element_422_1']) && $cod_info[0]['element_422_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_422_2']) && $cod_info[0]['element_422_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_3']) && $cod_info[0]['element_422_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_4']) && $cod_info[0]['element_422_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_5']) && $cod_info[0]['element_422_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_422_6']) && $cod_info[0]['element_422_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
        }
        
        if(isset($cod_info[0]['element_437']) && $cod_info[0]['element_437'] !=0){
            $extr_pallets = 0;
            switch($cod_info[0]['element_437']){//product 8 
                case 66://Extruded Pallet
                    $extr_product_num = 8;
                    if($soy_price[0]['percentage']<=159){
                        $extr_pallets_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $extr_pallets_ppt = ($over*5) -45;
                    }
                    $extr_cases = $cod_info[0]['element_441'];
                    $extr_units = $cod_info[0]['element_442'];
                    $qty_of_units_pallets = $extr_cases*$extr_units;
                    $product_weight_extruded = $qty_of_units_pallets;
                    $extr_cost = (($product_weight_extruded * $extr_pallets_ppt) )/2000;
                    
                    if(isset($cod_info[0]['element_439_1']) && $cod_info[0]['element_439_1'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_2']) && $cod_info[0]['element_439_2'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_3']) && $cod_info[0]['element_439_3'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_4']) && $cod_info[0]['element_439_4'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_5']) && $cod_info[0]['element_439_5'] !=0   ){
                        $extr_pallets++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_6']) && $cod_info[0]['element_439_6'] !=0   ){
                        $extr_pallets++;    
                    }
                break;
                case 67://Extruded Gaylord
                    $gay_product_num = 8;
                    if($soy_price[0]['percentage']<=159){
                        $extr_gay_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)/10);
                        $extr_gay_ppt = ($over*5)-45;
                    }

                    $extr_gay_cases =$cod_info[0]['element_441'];
                    $extr_gay_units=$cod_info[0]['element_442'];
                    $qty_of_units_gay_pallets =$extr_gay_cases *$extr_gay_units;
                    $product_weight_gay = $qty_of_units_gay_pallets;
                    $gay_cost = (($product_weight_gay * $extr_gay_ppt) )/2000;
                    
                    if(isset($cod_info[0]['element_439_1']) && $cod_info[0]['element_439_1'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_439_2']) && $cod_info[0]['element_439_2'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_3']) && $cod_info[0]['element_439_3'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_4']) && $cod_info[0]['element_439_4'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_5']) && $cod_info[0]['element_439_5'] !=0   ){
                        $extr_gay++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_6']) && $cod_info[0]['element_439_6'] !=0   ){
                        $extr_gay++;    
                    }
                break;
                case 68://Bulk
                    if($soy_price[0]['percentage']<=159){
                        $bulk_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160) /10);
                        $bulk_ppt = ($over*5) -25;
                    }
                    $bulk_cases=$cod_info[0]['element_441'];
                    $bulk_units=$cod_info[0]['element_442'];
                    $qty_of_bulk =$bulk_cases*$bulk_units;
                    
                break;
                case 69://Single Serve
                    $single_product_num = 8;
                    $single_cases=$cod_info[0]['element_441'];
                    $single_units=$cod_info[0]['element_442'];
                    $qty_of_single_serve_pallets =$single_cases*$single_units;
                    $product_weight_total_single =  ($qty_of_single_serve_pallets*.01);
                    $single_serve_total_cost = $total_other_cost;
                    if(isset($cod_info[0]['element_439_1']) && $cod_info[0]['element_439_1'] !=0   ){
                        $single_serve++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_439_2']) && $cod_info[0]['element_439_2'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_3']) && $cod_info[0]['element_439_3'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_4']) && $cod_info[0]['element_439_4'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_5']) && $cod_info[0]['element_439_5'] !=0   ){
                        $single_serve++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_6']) && $cod_info[0]['element_439_6'] !=0   ){
                        $single_serve++;    
                    }
                break;
                case 70://Bagged Under 1lb
                    $under_product_num = 8;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_under_ppt = -25;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)   /10);
                        $bagged_under_ppt = ($over*5) -25;                        
                    }
                    $bagged_under_cases=$cod_info[0]['element_441'];
                    $bagged_under_units=$cod_info[0]['element_442'];
                    $qty_of_under_pallets =$bagged_under_cases*$bagged_under_units;
                    $product_weight_total_bagged_under =  ($qty_of_under_pallets *1);
                    $bagged_under_cost = (($product_weight_total_bagged_under * $bagged_under_ppt) )/2000;
                    
                    
                     if(isset($cod_info[0]['element_439_1']) && $cod_info[0]['element_439_1'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_439_2']) && $cod_info[0]['element_439_2'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_3']) && $cod_info[0]['element_439_3'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_4']) && $cod_info[0]['element_439_4'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_5']) && $cod_info[0]['element_439_5'] !=0   ){
                        $bagged_under++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_6']) && $cod_info[0]['element_439_6'] !=0   ){
                        $bagged_under++;    
                    }
                break;
                case 71://Bagged  1lb to 5lb
                    $one_to_five_product_num = 8;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_1_to_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_1_to_5_ppt = ($over*5) -45;
                    }
                    $bagged_1to5_cases=$cod_info[0]['element_441'];
                    $bagged_1to5_units=$cod_info[0]['element_442'];
                    $qty_of_bagged1to5 = $bagged_1to5_cases*$bagged_1to5_units;                    
                    $product_weight_total_1to5 =  ($qty_of_bagged1to5*5);
                    $bagged_1_to_5_cost = (($product_weight_total_1to5 *$bagged_1_to_5_ppt) )/2000;
                    if(isset($cod_info[0]['element_439_1']) && $cod_info[0]['element_439_1'] !=0   ){
                        $oneto5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_439_2']) && $cod_info[0]['element_439_2'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_3']) && $cod_info[0]['element_439_3'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_4']) && $cod_info[0]['element_439_4'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_5']) && $cod_info[0]['element_439_5'] !=0   ){
                        $oneto5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_6']) && $cod_info[0]['element_439_6'] !=0   ){
                        $oneto5++;    
                    }
                break;
                case 72://bagged over 5 lb
                    $over_five_product_num = 8;
                    if($soy_price[0]['percentage']<=159){
                        $bagged_over_5_ppt = -45;
                    }else {
                        $over = round(  ($soy_price[0]['percentage'] - 160)  /10);
                        $bagged_over_5_ppt = ($over*5) -45;
                    }
                    $bagged_over_cases=$cod_info[0]['element_441'];
                    $bagged_over_units=$cod_info[0]['element_442'];
                    $qty_of_bagged_over =$bagged_over_cases*$bagged_over_units;
                    $product_weight_total_over5 = ($qty_of_bagged_over *25);
                    $bagged_over_five_cost = (($product_weight_total_over5 * $bagged_over_5_ppt) )/2000; 
                    if(isset($cod_info[0]['element_439_1']) && $cod_info[0]['element_439_1'] !=0   ){
                        $over5++;    
                    }
                    
                    //element_323_2
                    if(isset($cod_info[0]['element_439_2']) && $cod_info[0]['element_439_2'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_3']) && $cod_info[0]['element_439_3'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_4']) && $cod_info[0]['element_439_4'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_5']) && $cod_info[0]['element_439_5'] !=0   ){
                        $over5++;    
                    }
                    
                    if(isset($cod_info[0]['element_439_6']) && $cod_info[0]['element_439_6'] !=0   ){
                        $over5++;    
                    }
                break;
            }
        }
    }

}

?>

<style type="text/css">
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px 10px;
}

input[type='text']{
    width:150px;
}
</style>
<script>
    Shadowbox.init({
        showOverlay:true,
        modal:false, 
        loadingImage:"shadow/loading.gif",
        displayNav: true,
        slideshowDelay: 2,        
        overlayOpacity: '0.9',
        overlayColor:"#FFFFFF",
        gallery: "gall" ,
            
    });
</script>
<table>
    <tr>
        <td colspan="2">
            <table>
                <tr><td colspan="2" style="text-align: left;"> Other Costs Breakdown:</td></tr>
                <?php
                    echo "<tr><td style='text-align:left;'>Light Load</td><td style='text-align:right;'>".$cod_info[0]['element_311']."</td></tr>"; 
                    echo "<tr><td style='text-align:left;'>Additional Freight</td><td style='text-align:right;'>".$cod_info[0]['element_312']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Foreign Substance</td><td style='text-align:right;'>".$cod_info[0]['element_312']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Foreign Substance Deduction </td><td style='text-align:right;'>".$cod_info[0]['element_651']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Water %</td><td style='text-align:right;'>".$cod_info[0]['element_314']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Moisture Deduction</td><td style='text-align:right;'>".$cod_info[0]['element_652']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>PPT Adjustment</td><td style='text-align:right;'>".$cod_info[0]['element_317']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Additional Flat Fee</td><td style='text-align:right;'>".$cod_info[0]['element_318']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Load Calculated Price Per Ton</td><td style='text-align:right;'>".$cod_info[0]['element_316']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Adjusted Freight</td><td style='text-align:right;'>".$cod_info[0]['element_654']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Mixed Load Product Cost</td><td style='text-align:right;'>".$cod_info[0]['element_654']."</td></tr>";
                    echo "<tr><td style='text-align:left;'>Total </td><td style='text-align:right;'>$total_other_cost</td></tr>";
              
                ?>        
            </table>
        
        </td>
        
        <td>Truck Net:&nbsp;<input type="text" placeholder="Truck Net" value="<?php echo $cod_weight_shrink; ?>"  readonly="" id="truck_net" /></td>
        <td>Pallet Total:&nbsp;<input type="text" placeholder="Pallet Total" value="<?php echo $pallet_total; ?>"  readonly="" id="pallet_total" /></td>
        <td>Trash/Moisture:&nbsp;<input type="text" placeholder="Trash/Moisture"  value="<?php echo $cod_trash; ?>"  readonly="" id="trash_moisture" /></td>
        <td>Total Pallet Weight<br /><input type="text" placeholder="Total Pallet Weight" value="<?php echo $total_pallet_weight; ?>" id="tpw"/></td>
        <td>Product Net&nbsp;<input type="text" placeholder="Product Net"   readonly="" id="product_net" /></td>
        <td>Contingincy:&nbsp;<input type="text" placeholder="Contingincy"  readonly="" id="contingincy"/></td>
    </tr>
    <tr>
        <td></td>
        <td># of Pallets</td>
        <td>Units Per Case</td>
        <td>Qty of Cases</td>
        <td>QTY Units of Product</td>
        <td>Est Weight(Lbs)</td>
        <td>Allocation</td>
        <td>PPT</td>
        <td>Cost</td>
    </tr>
    <tr id="pallet_row" class="item" rel="<?php echo $_GET['compl'] ?>"  xlr="Extruded Pallets"  >
        <td class="type">Extruded Pallets</td>
        <td><input type="text" class="pallets" value="<?php echo $extr_pallets;  ?>" readonly=""/></td>
        <td><input type="text" class="cases"  value="<?php echo $extr_cases;  ?>"  readonly="" /></td>
        <td><input type="text" class="units" readonly="" value="<?php echo $extr_units; ?>"/></td>
        <td><input type="text" class="units_of_product" readonly=""  value="<?php echo $qty_of_units_pallets;  ?>" /></td>
        <td><input type="text" class="weight" id="extr_tons"  readonly="" value="<?php echo $product_weight_extruded; ?>" /></td>
        <td><input type="text" class="allocation" id="extr_allocation" value="<?php echo $product_weight_extruded; ?>"/></td>
        <td><input type="text" class="ppt" value="<?php echo $extr_pallets_ppt; ?>" id="extr_ppt" original="<?php echo $extr_pallets_ppt; ?>"  /></td>
        <td><input type="text" class="cost" id="extra_cost" value="<?php echo number_format($extr_cost,4); ?>" original="<?php echo number_format($extr_cost,4,".",""); ?>"/></td>
        <td><input type="text" placeholder="product #" class="product_num" value="<?php echo $extr_product_num;  ?>"/></td>
    </tr>
    <tr id="gaylord_row" class="item" rel="<?php echo $_GET['compl'] ?>" xlr="Extruded Gaylord"  >
        <td class="type">Extruded Gaylord</td>
        <td><input type="text" class="pallets" value="<?php echo $extr_gay;  ?>"  readonly=""/></td>
        <td><input type="text" class="cases"  value="<?php echo $extr_gay_cases;  ?>"  readonly=""/></td>
        <td><input type="text" class="units"readonly="" value="<?php echo $extr_gay_units; ?>"/></td>
        <td><input type="text" class="units_of_product" readonly=""  value="<?php echo $qty_of_units_gay_pallets;  ?>"  /></td>
        <td><input type="text" class="weight" id="gay_tons" value="<?php echo $product_weight_gay; ?>"  readonly=""/></td>
        <td><input type="text" class="allocation" value="<?php echo $product_weight_gay; ?>"    id="gay_allocation"/></td>
        <td><input type="text" class="ppt"  value="<?php echo $extr_gay_ppt; ?>" id="gay_ppt" original="<?php echo $extr_pallets_ppt; ?>" /></td>
        <td><input type="text" class="cost" id="gay_cost"  value="<?php echo number_format($gay_cost,4,".",""); ?>" original="<?php echo number_format($gay_cost,4,".",""); ?>"/></td>
        <td><input type="text" placeholder="product #" class="product_num" value="<?php echo $gay_product_num;  ?>"/></td>
    </tr>
    <tr id="under_row" class="item" rel="<?php echo $_GET['compl'] ?>"  xlr="Bagged Under 1lbs" >
        <td class="type">Bagged Under 1lbs</td>
        <td><input type="text" class="pallets" value="<?php echo $bagged_under;  ?>" readonly=""/></td>
        <td><input type="text" class="cases"  value="<?php echo $bagged_under_cases;  ?>" readonly=""/></td>
        <td><input type="text" class="units" readonly="" value="<?php echo $bagged_under_units;  ?>"/></td>
        <td><input type="text" class="units_of_product" readonly="" value="<?php echo $qty_of_under_pallets;  ?>"  /></td>
        <td><input type="text" class="weight" value="<?php echo $product_weight_total_bagged_under; ?>"  readonly="" id="under_weight"/></td>
        <td><input type="text" class="allocation" value="<?php echo $product_weight_total_bagged_under; ?>"   id="under_allocation"/></td>
        <td><input type="text" class="ppt" value="<?php echo $bagged_under_ppt; ?>"  id="under_ppt" original="<?php echo $extr_pallets_ppt; ?>" /></td>
        <td><input type="text" class="cost" id="under_cost"  value="<?php echo number_format($bagged_under_cost,4,".",""); ?>" original="<?php echo number_format($bagged_under_cost,4,".",""); ?>" /></td>        
        <td><input type="text" placeholder="product #" class="product_num" value="<?php echo $under_product_num;  ?>"/></td>
    </tr>
    <tr id="bagged_one_to_five_row" class="item" rel="<?php echo $_GET['compl'] ?>" xlr="Bagged 1-5 lbs"  >
        <td class="type">Bagged 1-5 lbs</td>
         <td><input type="text" class="pallets" value="<?php echo $oneto5;  ?>"  readonly=""/></td>
        <td><input type="text" class="cases"  value="<?php echo $bagged_1to5_cases;  ?>"  readonly=""/></td>
        <td><input type="text" class="units"   readonly="" value="<?php echo $bagged_1to5_units;  ?>"/></td>
        <td><input type="text" class="units_of_product" readonly="" value="<?php echo $qty_of_bagged1to5;  ?>"/></td>
        <td><input type="text" class="weight"  value="<?php echo $product_weight_total_1to5;  ?>"  id="onetofive_ton" readonly=""/></td>
        <td><input type="text" class="allocation"   value="<?php echo $product_weight_total_1to5;  ?>"   id="bagged1to5_allocation"/></td>
        <td><input type="text" class="ppt" value="<?php echo $bagged_1_to_5_ppt; ?>"  id="one_to_five_ppt" original="<?php echo $bagged_1_to_5_ppt; ?>" /></td>
        <td><input type="text" class="cost" id="one_to_five_cost" value="<?php echo number_format($bagged_1_to_5_cost,4,".","") ?>" original="<?php echo number_format($bagged_1_to_5_cost,4,".",""); ?>"/></td>
        <td><input type="text" placeholder="product #" class="product_num" value="<?php echo $one_to_five_product_num;  ?>"/></td>
    </tr>
    <tr id="over_five_row" class="item" rel="<?php echo $_GET['compl'] ?>" xlr="Bagged over 5lbs"  >
        <td>Bagged over 5lbs</td>
         <td><input type="text" class="pallets" value="<?php echo $over5;  ?>"  readonly=""/></td>
        <td><input type="text"  class="cases"  readonly="" value="<?php echo $bagged_over_units;  ?>"/></td>
        <td><input type="text"  class="units" value="<?php echo $bagged_over_cases;  ?>"  readonly=""/></td>
        <td><input type="text" class="units_of_product" readonly="" value="<?php echo $qty_of_bagged_over;  ?>"  /></td>
        <td><input type="text" class="weight"   value="<?php echo $product_weight_total_over5;  ?>"  readonly=""/></td>
        <td><input type="text" class="allocation"    value="<?php echo $product_weight_total_over5;  ?>"   id="bagged_over5_allocation"/></td>
        <td><input type="text" class="ppt" value="<?php echo $bagged_over_5_ppt; ?>" id="over_five_ppt" original="<?php echo $bagged_over_5_ppt; ?>"  /></td>
        <td><input type="text" class="cost" id="bagged_over_5_Cost"  value="<?php echo number_format($bagged_over_five_cost,4,".",""); ?>" original="<?php echo number_format($bagged_over_five_cost,4,".",""); ?>"/></td>
        <td><input type="text" placeholder="product #" class="product_num" value="<?php echo $over_five_product_num;  ?>"/></td>
    </tr>
    <tr id="single_serve" class="item" rel="<?php echo $_GET['compl'] ?>" xlr="Single Serve"  >
        <td class="type">Single Serve</td>
         <td><input type="text" class="pallets" value="<?php echo $single_serve;  ?>"  readonly=""/></td>
        <td><input type="text" class="cases"  value="<?php echo $single_cases;  ?>"  readonly=""/></td>
        <td><input type="text" class="units" readonly="" value="<?php echo $single_units;  ?>"/></td>
        <td><input type="text" class="units_of_product" readonly="" value="<?php echo $qty_of_single_serve_pallets;  ?>"  /></td>
        <td><input type="text" class="weight"   value="<?php echo $product_weight_total_single;  ?>"  readonly=""/></td>
        
        <td><input type="text" class="allocation" id="single_allocation" value="<?php echo $product_weight_total_single;  ?>"  /></td>
        <td><input type="text" class="ppt" value="<?php echo $single_ppt; ?>"  id="single_ppt" original="<?php echo $single_ppt; ?>"  /></td>
        <td><input type="text" class="cost"  value="<?php echo $single_ppt; ?>"  id="single_cost" value="<?php echo number_format($single_serve_total_cost,4,".",""); ?>" original="<?php echo number_format($single_serve_total_cost,4,".",""); ?>" /></td>
        <td><input type="text" placeholder="product #" class="product_num" value="<?php echo $single_product_num;  ?>"/></td>
    </tr>
    <tr>
        <td>Totals:</td>
        <td><input type="text" id="pallets_total" readonly="" /></td>
        <td><input type="text" id="cases_total" readonly=""/></td>
        <td><input type="text" id="units_total" readonly=""/></td>
        <td><input type="text" class="total_units_of_product" readonly=""/></td>
        <td><input type="text" id="weight_total" readonly=""/></td>
        <td><input type="text" id="allocation_total" readonly=""/></td>
        <td>&nbsp;</td>
        <td><input type="text" id="cost_total" readonly=""/></td>
    </tr>
    <tr>
        <td><input type="button" value="Quick View BOL" id="bol" rel="bol" xlr="<?php echo $cod_info[0]['bol']; ?>"/></td>
        <td><input type="button" value="Quick View WT" id="vwt" rel="vwt" xlr="<?php echo $cod_info[0]['tsl_wtn_pic']; ?>"/></td>
        <td><input type="button" value="Quick View Incoming WT" id="inco" rel="inco" xlr="<?php echo $cod_info[0]['inco_wtn'] ?>" /></td>
        <td><input type="button" value="Quick View Seal" <?php
         if(strlen(trim($cod_info[0]['element_134']))>0  && $cod_info[0]['element_134'] !=null  ){
            echo " xlr='machforms/machform/data/form_49773/files/".$cod_info[0]['element_134']."'";
            echo '  id="seal" rel="seal"';  
         }
        
          ?> /></td>
    </tr>
    
    <tr><td colspan="10" style="text-align: right;"><input type="button" value="Save Load" id="save_mixed"/> </td></tr>
</table>
<script>
//element_652 - moisture



function add_allocation(first,second){
    var buff = 0;
    buff = ((first*second)/2000);
    return buff;
}

function sum_it_all(clas){
   var kl =0;
   $(clas).each(function(){
        kl += parseFloat( $(this).val() *1); 
   });
  return kl.toFixed(4);    
}




$(document).ready(function(){
    var product_net = $("input#truck_net").val() - (  ($("input#pallet_total").val() *1 )+ ( $("input#trash_moisture").val() * 1  )  + (  $("input#tpw").val() *1  )     ); 
    $("input#product_net").val( product_net.toFixed(2)  );
    $("input#pallets_total").val( sum_it_all(".pallets") );
    $("input#cases_total").val( sum_it_all($(".cases")));
    $("input#units_total").val( sum_it_all($(".units")));
    $("input#weight_total").val( sum_it_all($(".weight")));
    $("input#allocation_total").val( sum_it_all($(".allocation")));
    $("input#ppt_total").val( sum_it_all($(".ppt")));
    $("input#cost_total").val( sum_it_all($(".cost"))  );    
    $(".total_units_of_product").val( sum_it_all($(".units_of_product")) );
    
$("input#extr_allocation").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){            
        $("input#extra_cost").val( add_allocation( $(this).val(),$("input#extra_ppt").val() )  );
    }else{//When allocation is removed, restore cost back to default (other costs included)
        $("input#extra_cost").val( $("input#extra_cost").attr("original") );
    } 
    $("input#cost_total").val(sum_it_all($(".cost")) );
    
});

$("input#extr_ppt").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){   
        $("input#extra_cost").val(  add_allocation( $(this).val(),$("input#extr_allocation").val() )   );
    }else{
        $("input#extra_cost").val(  $("input#extra_cost").attr("origin") );
         
    }
    $("input#cost_total").val(sum_it_all($(".cost")) );
});


$("input#gay_allocation").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){            
        $("input#gay_cost").val( add_allocation( $(this).val(),$("input#extr_ppt").val() )  );
    }else{
        $("input#gay_cost").val( $("input#gay_cost").attr("original") );
    } 
    $("input#cost_total").val(sum_it_all($(".cost")) );
});

$("input#gay_ppt").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){
       $("input#extra_cost").val(  add_allocation( $(this).val(),$("input#gay_allocation").val()  ) ); 
    }else{
        $("input#gay_ppt").val( $("input#gay_ppt").attr("original") );   
    }
    $("input#cost_total").val(sum_it_all($(".cost")) );
});


$("input#under_allocation").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){            
        $("input#under_cost").val( add_allocation( $(this).val(),$("input#under_ppt").val() )  );
    }else{
        $("input#under_cost").val( $("input#under_cost").attr("original") );
    } 
    $("input#cost_total").val(sum_it_all($(".cost")) );
});

$("input#under_ppt").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){ 
        $("input#under_cost").val(  add_allocation( $(this).val(),$("input#under_allocation").val() )  ); 
    }else{
        $("input#under_ppt").val( $("input#under_ppt").attr("original") );
    }
    $("input#cost_total").val(sum_it_all($(".cost")) );
});


$("input#bagged1to5_allocation").change(function(){    
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){
        $("input#one_to_five_cost").val( add_allocation( $(this).val(), $("input#one_to_five_ppt").val()  )  );
    }else{
        $("input#one_to_five_cost").val( $("input#one_to_five_cost").attr("original") );
    }
    
    $("input#cost_total").val(sum_it_all($(".cost")) );
});

$("input#one_to_five_ppt").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){ 
        $("input#one_to_five_cost").val( add_allocation( $(this).val(), $("input#bagged1to5_allocation").val()  )  );
    }else{
        $("input#one_to_five_cost").val( $("input#one_to_five_cost").attr("original") );
    }   
    $("input#cost_total").val(sum_it_all($(".cost")) );
});


$("input#one_to_five_ppt").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){
        $("input#one_to_five_cost").val( add_allocation( $(this).val(), $("input#bagged1to5_allocation").val()  )  );
    }else{
        
    }
});


$("input#bagged_over5_allocation").change(function(){ 
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){
        $("input#bagged_over_5_Cost").val( add_allocation( $(this).val(), $("input#over_five_ppt").val()  )  );
    }else{
        $("input#bagged_over_5_Cost").val( $("input#bagged_over_5_Cost").attr("original") );
    }
    
    $("input#cost_total").val(sum_it_all( $(".cost") ) );
});


$("input#single_allocation").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){
        $("input#single_cost").val( add_allocation( $(this).val(), $("input#single_ppt").val()  )  );
    }else{
        $("input#single_cost").val( $("input#single_cost").attr("original") );
    }
    $("input#cost_total").val( sum_it_all($(".cost") ) )  ;
});

$("input#single_ppt").change(function(){
    if( $.trim($(this).val()).length >0 && $(this).val() != 0 ){
        $("input#single_cost").val( add_allocation( $(this).val(), $("input#single_allocation").val()  )  );
    }else{
        $("input#single_cost").val( $("input#single_cost").attr("original") );
    }
    $("input#cost_total").val( sum_it_all($(".cost") ) )  ;
});    
    
    $("#seal").click(function(){
        Shadowbox.open({
           player:"img",
           content:$(this).attr("xlr")+"" 
        }); 
    });
    
    $("#bol").click(function(){
        Shadowbox.open({
            player:"img",
            content:"machforms/machform/data/form_43256/files/"+$(this).attr("xlr")+""
        });
        
    });
    
    $("#vwt").click(function(){
        Shadowbox.open({
            player:"img",
            content: "machforms/machform/data/form_43256/files/"+$(this).attr("xlr")+""
        });
    });
    
    $("#inco").click(function(){
        Shadowbox.open({
           player:"img",
           content: "machforms/machform/data/form_43256/files/"+$(this).attr("xlr")+"" 
        });
    });
    
    $.post("reload_mix_load.php",{cod_id:<?php echo $_GET['compl']; ?>},function(data){
        if(data.length>0){
            data = $.parseJSON(data);
            $.each(data, function(i, item) {//0 - com type , 1 - pallets , 2 - cases, 3- units
                var step1 = item.split("|");
                alert(step1[6]);
                var $row = $('tr[xlr="' + step1[0] + '"]');
                $row.find(".pallets").val(""+step1[1]+"");
                $row.find(".cases").val(""+step1[2]+"");
                $row.find(".units").val(""+step1[3]+"");
                $row.find(".weight").val(""+step1[4]+"");
                $row.find(".allocation").val(""+step1[5]+"");
                $row.find(".ppt").val(""+step1[6]+"");
                $row.find(".cost").val(""+step1[7]+"");
               
            });
            window.opener.reload();
            $("input#pallets_total").val( sum_it_all(".pallets") );
            $("input#cases_total").val( sum_it_all($(".cases")));
            $("input#units_total").val( sum_it_all($(".units")));
            $("input#weight_total").val( sum_it_all($(".weight")));
            $("input#allocation_total").val( sum_it_all($(".allocation")));
            $("input#ppt_total").val( sum_it_all($(".ppt")));
            $("input#cost_total").val( sum_it_all($(".cost")));
            
        }
        
        $.post("insert_mixed_load_total.php",{total:$("input#cost_total").val()},function(data){
            
        });
    });
    
    
    $("#save_mixed").click(function(){
        $("tr.item").each(function() {
            $.post("insert_mix_load.php",{
                pallet:$(this).find("input.pallets").val(), 
                cases:$(this).find("input.cases").val(),
                units:$(this).find("input.units").val(),
                weight:$(this).find("input.weight").val(),
                allocation:$(this).find("input.allocation").val(),
                ppt:$(this).find("input.ppt").val(),
                cost:$(this).find("input.cost").val(),
                commodity: $.trim($(this).find(".type").html()),
                cod_id: $(this).attr('rel'),
                product_num: $(this).find("input.product_num").val(),
                total_cost: $("input#cost_total").val()
            },function(data){
                alert(data);
                opener.location.reload();
                window.close();
            });
        });
        
    });
    
    
    
    
    
    $(".pallets").change(function(){
        $("input#pallets_total").val( sum_it_all(".pallets") );
    });
    
    
    $(".cases").change(function(){  
        $("input#cases_total").val(sum_it_all($(".cases")));
    });
    
    $(".units").change(function(){
        $("input#units_total").val(sum_it_all($(".units")));
    });
    
    $(".weight").change(function(){
        $("input#weight_total").val(sum_it_all($(".weight")));
    });
    
    $(".allocation").change(function(){
        $("input#allocation_total").val(sum_it_all($(".allocation")));
    });
    
    $(".ppt").change(function(){
        $("input#ppt_total").val(sum_it_all($(".ppt")));
    });
    
    $(".cost").change(function(){
        $("input#cost_total").val(sum_it_all($(".cost")));
    });
    if( (parseFloat($("input#truck_net").val()*1)) ==  parseFloat($("input#weight_total").val() *1 )  ){
        $("input#contingincy").val("Contingent");
    }else{
       $("input#contingincy").val("Not Contingent"); 
    }
});


</script>