<?php


include "protected/global.php";

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

echo $bagged_1_to_5_cost + $bagged_under_cost + $gay_cost + $extr_cost+ $bagged_over_five_cost;

?>