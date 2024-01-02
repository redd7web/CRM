function excluded_product_container_shrink( x  ){
    return parseFloat(x *1) + parseFloat( $("input#element_182").val() * 1 );
}

function excluded_product_weight(){   
     var total =0;
    
    if($.trim( $("input#element_333").val()   ).length > 0   && $("input#element_333").val() !="NaN" ){//Product Weight Total (Petfood 1)
        total +=parseFloat($("input#element_333").val() *1); 
    }
    
    
    if($.trim( $("input#element_349").val()   ).length > 0    && $("input#element_349").val() !="NaN" ){//Product Weight Total (Petfood 2)
        total +=parseFloat($("input#element_349").val() *1); 
    }
    
    
    if($.trim( $("input#element_365").val()   ).length > 0    && $("input#element_365").val() !="NaN" ){//Product Weight Total (Petfood 3)
        total +=parseFloat($("input#element_365").val() *1); 
    }
    
    if(  $.trim( $("input#element_381").val()  ).length > 0   && $("input#element_381").val() !="NaN" ){//Product Weight Total (Petfood 4)
        total +=parseFloat($("input#element_381").val() *1); 
    }
    
    if($.trim( $("input#element_412").val()   ).length > 0   && $("input#element_412").val() !="NaN" ){//Product Weight Total (Petfood 5)
        total +=parseFloat($("input#element_412").val() *1); 
    }
    
    
    if($.trim( $("input#element_415").val()   ).length > 0    && $("input#element_415").val() !="NaN" ){//Product Weight Total (Petfood 6)
        total +=parseFloat($("input#element_415").val() *1); 
    }
    if($.trim( $("input#element_432").val()   ).length > 0    && $("input#element_432").val() !="NaN"){//Product Weight Total (Petfood 7)
        total +=parseFloat($("input#element_432").val() *1); 
    }
    
    if($.trim( $("input#element_449").val()   ).length > 0   && $("input#element_449").val() !="NaN" ){//Product Weight Total (Petfood 8)
        total +=parseFloat($("input#element_449").val() *1); 
    }
    
    //element_449
    return total;
}


function difference_from_scale(){
    var a = 0,b = 0;
    //element_187
    if( $.trim( $("input#element_186").val() ).length >0 && $("input#element_186").val() !="NaN" ){//gross weight
        a = parseFloat($("input#element_186").val() *1);
    }
    
    if( $.trim( $("input#element_189").val() ).length >0 && $("input#element_189").val() !="NaN" ){//scale net weight
        b = parseFloat($("input#element_189").val() *1);
    }
    
    
    $("input#element_187").val(a-b);//gross weight - scale net weight
    $("input#element_188").val(  parseFloat($("input#element_187").val()/$("input#element_189").val()) );
}

function Load_Total_Shrink(){ // Number of Pallets/Skids + Total Trash per Product Container  + Total Weight Shrink per Pallets/Skids 
   $("input#element_185").val(  parseFloat($("input#element_138").val() *1)+ parseFloat(  $("input#element_141").val()*1 )+ parseFloat( $("input#element_139").val() *1 )   );
}





function load_gross_weight(){
    var temp = 0;
    if( $.trim( $("input#element_178").val() ).length >0 && $("input#element_178").val() !="NaN" ){//Total Load Weight
        temp += parseFloat($("input#element_178").val() *1);
    }
    
    if( $.trim( $("input#element_143").val() ).length >0 && $("input#element_143").val() !="NaN" ){//Total Shrink 
        temp += parseFloat($("input#element_143").val() *1);
    }
    return temp;
}

function Product_Net(){
    var temp = 0 ;
    var a = 0;
    var b = 0;
    
    if( $.trim( $("input#element_139").val() ).length >0 && $("input#element_139").val() !="NaN" ){//Total Weight Shrink per Pallets/Skids
        a = parseFloat($("input#element_139").val() *1);
    }
    
    if( $.trim( $("input#element_141").val() ).length >0 && $("input#element_141").val() !="NaN" ){//Total Trash per Product Container 
        b = parseFloat($("input#element_141").val() *1);
    }
    $("input#element_143").val(a+b);
    
    if( $.trim($("input#element_178").val() ).length>0 && $("input#element_178").val() !="NaN"  ){//Total Load Weight
        
    }
    return parseFloat($("input#element_178").val()) - (a+b);
}   

function Total_Shrink_Trailer(){
    var total =0;
    
    if($.trim( $("input#element_138").val()  ).length > 0  && $("input#element_138").val() !="NaN"  ){//Number of Pallets/Skids
        total += parseFloat($("input#element_138").val() *1);
    }
    
    if($.trim( $("input#element_139").val()  ).length > 0  && $("input#element_139").val() !="NaN"  ){//Total Weight Shrink per Pallets/Skids
        total += parseFloat($("input#element_139").val() *1);
    }
    
    if($.trim( $("input#element_141").val()  ).length > 0   && $("input#element_141").val() !="NaN" ){//Total Trash per Product Container 
        total += parseFloat($("input#element_141").val() *1);
    }
    return total;
}

function Total_Weight_Shrink_per_Pallets_Skids(){
    var temp = 0;
    if( $.trim( $("input#element_330").val()  ).length >0 && $("input#element_330").val() !="NaN" ){//Total Pallet Weight (Petfood 1)
        temp += parseFloat($("input#element_330").val() *1);//product 1
    }
  
    if( $.trim( $("input#element_614").val()  ).length >0 && $("input#element_614").val() !="NaN" ){//Total Red/Blue Chep Pallet Weight (Petfood 1)
        temp += parseFloat($("input#element_614").val() *1);//product 1
    }
 
    if( $.trim( $("input#element_615").val()  ).length >0 && $("input#element_615").val() !="NaN" ){//Total Brown Chep Pallet Weight (Petfood 1)
        temp += parseFloat($("input#element_615").val() *1);//product 1
    }
 
    if( $.trim( $("input#element_346").val()  ).length >0 && $("input#element_346").val() !="NaN" ){//Total Pallet Weight (Petfood 2)
        temp += parseFloat($("input#element_346").val() *1);//product2
    }
  
    if( $.trim( $("input#element_619").val()  ).length >0 && $("input#element_619").val() !="NaN" ){//Total Red/Blue Chep Pallet Weight (Petfood 2)
        temp += parseFloat($("input#element_619").val() *1);//product 2
    }
 
    if( $.trim( $("input#element_618").val()  ).length >0 && $("input#element_618").val() !="NaN" ){//Total Brown Chep Pallet Weight (Petfood 2)
        temp += parseFloat($("input#element_618").val() *1);//product 2
    }
    
    
    if( $.trim( $("input#element_362").val()  ).length >0 && $("input#element_362").val() !="NaN" ){//Total Pallet Weight (Petfood 3)
        temp += parseFloat($("input#element_362").val() *1);//product 3
    }
  
    if( $.trim( $("input#element_623").val()  ).length >0 && $("input#element_623").val() !="NaN" ){//Total Red/Blue Chep Pallet Weight (Petfood 3)
        temp += parseFloat($("input#element_623").val() *1);//product 3
    }
 
    if( $.trim( $("input#element_622").val()  ).length >0 && $("input#element_622").val() !="NaN" ){//Total Brown Chep Pallet Weight (Petfood 3)
        temp += parseFloat($("input#element_622").val() *1);//product 3
    }
    
    
    if( $.trim( $("input#element_378").val()  ).length >0 && $("input#element_378").val() !="NaN" ){//Total Pallet Weight (Petfood 4)
        temp += parseFloat($("input#element_378").val() *1);//product 4
    }
  
    if( $.trim( $("input#element_627").val()  ).length >0 && $("input#element_627").val() !="NaN" ){//Total Red/Blue Chep Pallet Weight (Petfood 4) 
        temp += parseFloat($("input#element_627").val() *1);//product 4
    }
 
    if( $.trim( $("input#element_626").val()  ).length >0 && $("input#element_626").val() !="NaN" ){//Total Brown Chep Pallet Weight (Petfood 4)
        temp += parseFloat($("input#element_626").val() *1);//product 4
    }
    
    
    if( $.trim( $("input#element_395").val()  ).length >0 && $("input#element_395").val() !="NaN" ){//Total Pallet Weight (Petfood 5)
        temp += parseFloat($("input#element_395").val() *1);//product 5
    }
  
    if( $.trim( $("input#element_631").val()  ).length >0 && $("input#element_631").val() !="NaN" ){//Total Red/Blue Chep Pallet  Weight (Petfood 5)
        temp += parseFloat($("input#element_631").val() *1);//product 5
    }
 
    if( $.trim( $("input#element_630").val()  ).length >0 && $("input#element_630").val() !="NaN" ){//Total Brown Chep Pallet Weight (Petfood 5)
        temp += parseFloat($("input#element_630").val() *1);//product 5
    }
    
    if( $.trim( $("input#element_409").val()  ).length >0 && $("input#element_409").val() !="NaN" ){//Total Pallet Weight (Petfood 6) 
        temp += parseFloat($("input#element_409").val() *1);//product 6
    }
  
    if( $.trim( $("input#element_635").val()  ).length >0 && $("input#element_635").val() !="NaN" ){//Total Red/Blue Chep Pallet Weight (Petfood 6)
        temp += parseFloat($("input#element_635").val() *1);//product 6
    }
 
    if( $.trim( $("input#element_634").val()  ).length >0 && $("input#element_634").val() !="NaN" ){//Total Brown Chep Pallet Weight (Petfood 6)
        temp += parseFloat($("input#element_634").val() *1);//product 6
    }
    
    
    if( $.trim( $("input#element_429").val()  ).length >0 && $("input#element_429").val() !="NaN" ){//Total Pallet Weight (Petfood 7)
        temp += parseFloat($("input#element_429").val() *1);//product 7
    }
  
    if( $.trim( $("input#element_639").val()  ).length >0 && $("input#element_639").val() !="NaN" ){//Total Red/Blue Chep Pallet Weight (Petfood 7)
        temp += parseFloat($("input#element_639").val() *1);//product 7
    }
 
    if( $.trim( $("input#element_638").val()  ).length >0 && $("input#element_638").val() !="NaN" ){//Total Brown Chep Pallet Weight (Petfood 7)
        temp += parseFloat($("input#element_638").val() *1);//product 7
    }
    
    if( $.trim( $("input#element_446").val()  ).length >0 && $("input#element_446").val() !="NaN" ){//Total Pallet Weight (Petfood 8)
        temp += parseFloat($("input#element_446").val() *1);//product 8
    }
  
    if( $.trim( $("input#element_643").val()  ).length >0 && $("input#element_643").val() !="NaN" ){//Total Red/Blue Chep Pallet Weight (Petfood 8)
        temp += parseFloat($("input#element_643").val() *1);//product 8
    }
 
    if( $.trim( $("input#element_642").val()  ).length >0 && $("input#element_642").val() !="NaN" ){//Total  Brown Chep Pallet Weight (Petfood 8)
        temp += parseFloat($("input#element_642").val() *1);//product 8
    }
    
    $("input#element_139").val(temp);
}


function Total_Load_Weight(){
    var total =0;
    
    if($.trim( $("input#element_333").val()   ).length > 0   && $("input#element_333").val() !="NaN" ){//Product Weight Total (Petfood 1)
        total +=parseFloat($("input#element_333").val() *1); 
    }
    
    
    if($.trim( $("input#element_349").val()   ).length > 0    && $("input#element_349").val() !="NaN" ){//Product Weight Total (Petfood 2)
        total +=parseFloat($("input#element_349").val() *1); 
    }
    
    
    if($.trim( $("input#element_365").val()   ).length > 0    && $("input#element_365").val() !="NaN" ){//Product Weight Total (Petfood 3)
        total +=parseFloat($("input#element_365").val() *1); 
    }
    
    if(  $.trim( $("input#element_381").val()  ).length > 0   && $("input#element_381").val() !="NaN" ){//Product Weight Total (Petfood 4)
        total +=parseFloat($("input#element_381").val() *1); 
    }
    
    if($.trim( $("input#element_412").val()   ).length > 0   && $("input#element_412").val() !="NaN" ){//Product Weight Total (Petfood 5)
        total +=parseFloat($("input#element_412").val() *1); 
    }
    
    
    if($.trim( $("input#element_415").val()   ).length > 0    && $("input#element_415").val() !="NaN" ){//Product Weight Total (Petfood 6)
        total +=parseFloat($("input#element_415").val() *1); 
    }
    if($.trim( $("input#element_432").val()   ).length > 0    && $("input#element_432").val() !="NaN"){//Product Weight Total (Petfood 7)
        total +=parseFloat($("input#element_432").val() *1); 
    }
    
    if($.trim( $("input#element_449").val()   ).length > 0   && $("input#element_449").val() !="NaN" ){//Product Weight Total (Petfood 8)
        total +=parseFloat($("input#element_449").val() *1); 
    }
    //element_449
    return total;
} 

function total_skids(){
     var total =0;
     //element_329
     
     if(  $.trim( $("input#element_328").val() ).length >0    && $("input#element_328").val() !="NaN" ){//qty skids 1
        total +=parseFloat($("input#element_328").val() *1);
     }
     
     if(  $.trim( $("input#element_329").val() ).length >0    && $("input#element_329").val() !="NaN" ){// qty pallets 1
        total +=parseFloat($("input#element_329").val() *1);
     }
     
     if(  $.trim( $("input#element_613").val() ).length >0    && $("input#element_613").val() !="NaN" ){//QTY Red/Blue Chep Pallet  1
        total +=parseFloat($("input#element_613").val() *1);
     }
     
     if( $.trim( $("input#element_612").val()).length>0   && $("input#element_612").val() !="NaN" ){//QTY Brown Chep Pallet 1
        total +=parseFloat($("input#element_612").val() *1);
     }
     
      if(  $.trim( $("input#element_331").val() ).length >0   && $("input#element_331").val() !="NaN" ){//bulk 1
        total +=parseFloat($("input#element_331").val() *1);
     }
     
     if( $.trim( $("input#element_332").val()).length>0    && $("input#element_332").val() !="NaN" ){//QTY Other (Petfood 1) 
        total +=parseFloat($("input#element_332").val() *1);
     }
  
     if(  $.trim( $("input#element_344").val() ).length >0   && $("input#element_344").val() !="NaN" ){//qty skids 2
        total +=parseFloat($("input#element_344").val() *1);
     }
     
     if(  $.trim( $("input#element_345").val() ).length >0   && $("input#element_345").val() !="NaN" ){//qty pallets 2
        total +=parseFloat($("input#element_345").val() *1);
     }
     
     if( $.trim( $("input#element_617").val()).length>0   && $("input#element_617").val() !="NaN" ){//red blue 2
        total +=parseFloat($("input#element_617").val() *1);
     }
     
      if( $.trim( $("input#element_616").val() ).length>0   && $("input#element_616").val() !="NaN" ){//brown 2
        total +=parseFloat($("input#element_616").val() *1);
     }
     
     if( $.trim( $("input#element_347").val()).length>0   && $("input#element_347").val() !="NaN"){//bulk 2
        total +=parseFloat($("input#element_347").val() *1);
     }
    
     
     if( $.trim( $("input#element_348").val()).length>0   && $("input#element_348").val() !="NaN" ){//QTY Other 2 
        total += parseFloat($("input#element_348").val() *1);
     }
     
     
     //element_360
     
     //************** PET FOOD SKIDS 3****************************//
     if( $.trim( $("input#element_360").val()).length>0   && $("input#element_360").val() !="NaN" ){//QTY skids 3 
        total += parseFloat($("input#element_360").val() *1);
     }
     
     //element_361
     if( $.trim( $("input#element_361").val()).length>0   && $("input#element_361").val() !="NaN" ){//QTY pallets 3
        total += parseFloat($("input#element_361").val() *1);
     }
     
     
    if( $.trim($("input#element_621").val()).length>0   && $("input#element_621").val() !="NaN" ){//red blue 3
        total += parseFloat($("input#element_621").val() *1)
    }
    
    if( $.trim($("input#element_620").val()).length>0   && $("input#element_620").val() !="NaN" ){// brown 3
        total +=parseFloat($("input#element_620").val() *1);
    }
     
    //element_363
    if( $.trim( $("input#element_363").val()).length>0   && $("input#element_363").val() !="NaN" ){// Bulk 3
        total +=parseFloat($("input#element_363").val() *1);
    }
     
    if( $.trim( $("input#element_364").val()).length>0   && $("input#element_364").val() !="NaN" ){//Other 3
        total +=parseFloat($("input#element_364").val() *1);
    }
    //************** PET FOOD SKIDS 3****************************//
     
    //************** PET FOOD SKIDS 4****************************//
    if( $.trim( $("input#element_376").val()).length>0   && $("input#element_376").val() !="NaN" ){//skids 4
        total +=parseFloat($("input#element_376").val() *1);
    }
     
    if( $.trim( $("input#element_377").val()).length>0   && $("input#element_377").val() !="NaN" ){//pallets 4
        total +=parseFloat($("input#element_377").val() *1);
    }
     
    if( $.trim( $("input#element_625").val()).length>0   && $("input#element_625").val() !="NaN" ){//red/blue 4
        total +=parseFloat($("input#element_625").val() *1);
    }
    if( $.trim( $("input#element_624").val()).length>0   && $("input#element_624").val() !="NaN" ){//brown 4
        total +=parseFloat($("input#element_624").val() *1);
    }
     //element_379
    if( $.trim( $("input#element_379").val()).length>0   && $("input#element_379").val() !="NaN" ){//bulk 4
        total +=parseFloat($("input#element_379").val() *1);
    }
    
    if( $.trim( $("input#element_380").val()).length>0   && $("input#element_380").val() !="NaN" ){//other 4 
        total +=parseFloat($("input#element_380").val() *1);
    }
    //************** PET FOOD SKIDS 4****************************//
     
    //************** PET FOOD SKIDS 5****************************//
    if( $.trim( $("input#element_393").val()).length>0   && $("input#element_393").val() !="NaN" ){//skids 5 
        total +=parseFloat($("input#element_393").val() *1);
    }
    //element_394
     
    if( $.trim( $("input#element_394").val()).length>0   && $("input#element_394").val() !="NaN" ){//pallets 5 
        total +=parseFloat($("input#element_394").val() *1);
    }
     
    if( $.trim( $("input#element_629").val()).length>0   && $("input#element_629").val() !="NaN" ){//red blue 5
        total +=parseFloat($("input#element_629").val() *1);
    }
     
    if( $.trim( $("input#element_628").val()).length>0   && $("input#element_628").val() !="NaN" ){ //brown 5
        total +=parseFloat($("input#element_628").val() *1);
    }
    //element_410
    if( $.trim( $("input#element_410").val()).length>0   && $("input#element_410").val() !="NaN" ){ //bulk 5
        total +=parseFloat($("input#element_410").val() *1);
    }
     
    if( $.trim( $("input#element_411").val()).length>0   && $("input#element_411").val() !="NaN" ){//other 5
        total +=parseFloat($("input#element_411").val() *1);
    }
    //************** PET FOOD SKIDS 5****************************//
     
     
    //************** PET FOOD SKIDS 6****************************//
    if( $.trim( $("input#element_407").val()).length>0   && $("input#element_407").val() !="NaN" ){//skids 6 
        total +=parseFloat($("input#element_407").val() *1);
    }
     //element_394
     
    if( $.trim( $("input#element_408").val()).length>0   && $("input#element_408").val() !="NaN" ){//pallets 6 
        total +=parseFloat($("input#element_408").val() *1);
    }
     
     
    if( $.trim( $("input#element_633").val()).length>0   && $("input#element_633").val() !="NaN" ){// red blue 6
        total +=parseFloat($("input#element_633").val() *1);
    }
    
    if( $.trim( $("input#element_632").val()).length>0   && $("input#element_632").val() !="NaN" ){//brown 6 
        total +=parseFloat($("input#element_632").val() *1);
    }
    
    if( $.trim( $("input#element_413").val()).length>0   && $("input#element_413").val() !="NaN" ){//bulk 6
        total +=parseFloat($("input#element_413").val() *1);
    }
     
    if( $.trim( $("input#element_414").val()).length>0   && $("input#element_414").val() !="NaN" ){//other 6
        total +=parseFloat($("input#element_414").val() *1);
    }
    //************** PET FOOD SKIDS 6****************************//
     
     
     //************** PET FOOD SKIDS 7****************************//
     if( $.trim( $("input#element_427").val()).length>0   && $("input#element_427").val() !="NaN" ){//skids 7 
        total +=parseFloat($("input#element_427").val() *1);
     }
     //element_394
     
     if( $.trim( $("input#element_428").val()).length>0   && $("input#element_428").val() !="NaN" ){//pallets 7 
        total +=parseFloat($("input#element_428").val() *1);
     }
     
     
     if( $.trim( $("input#element_637").val()).length>0   && $("input#element_637").val() !="NaN" ){ //red blue 7
        total +=parseFloat($("input#element_637").val() *1);
     }
     
     if( $.trim( $("input#element_636").val()).length>0   && $("input#element_636").val() !="NaN" ){//brown 7
        total +=parseFloat($("input#element_636").val() *1);
     }
     
     if( $.trim( $("input#element_430").val()).length>0   && $("input#element_430").val() !="NaN" ){//bulk 7
        total +=parseFloat($("input#element_430").val() *1);
     }
     
     
    if( $.trim( $("input#element_431").val() ).length>0   && $("input#element_431").val() !="NaN" ){// other 7
        total +=parseFloat($("input#element_431").val() *1);
    }
     //************** PET FOOD SKIDS 7****************************//
     
     
     
    //************** PET FOOD SKIDS 8****************************//
    if( $.trim( $("input#element_444").val()).length>0    && $("input#element_444").val() !="NaN" ){//skids 8 
        total +=parseFloat($("input#element_444").val() *1);
    }
    //element_394
     
    if( $.trim( $("input#element_445").val()).length>0   && $("input#element_445").val() !="NaN" ){//pallets 8 
        total +=parseFloat($("input#element_445").val() *1);
    }
     
    if( $.trim( $("input#element_641").val()).length>0   && $("input#element_641").val() !="NaN" ){// red blue 8
        total += parseFloat($("input#element_641").val() *1);
    }
      
    if( $.trim( $("input#element_640").val()).length>0   && $("input#element_640").val() !="NaN" ){ // brown 8
        total +=parseFloat($("input#element_640").val() *1);
    }
     
    if( $.trim( $("input#element_447").val()).length>0   && $("input#element_447").val() !="NaN" ){//bulk 8
        total +=parseFloat($("input#element_447").val() *1);
    }
     
    if( $.trim( $("input#element_448").val()).length>0   && $("input#element_448").val() !="NaN" ){//other 8
        total +=parseFloat($("input#element_448").val() *1);
    }
    //************** PET FOOD SKIDS 8****************************//
    return total;
}
    
    
function total_product_weight_shrink(){    
    var total =0;
    
    if( $.trim( $("input#element_451").val() ).length>0  &&  $("input#element_451").val() !="NaN"  ){
        total +=parseFloat($("input#element_451").val() *1)// petfood 8 Net Product Weight
    }
    if( $.trim( $("input#element_434").val() ).length>0  &&  $("input#element_434").val() !="NaN"  ){
        total +=parseFloat($("input#element_434").val() *1)// petfood 7 Net Product Weight
    }
    if( $.trim( $("input#element_417").val() ).length>0  &&  $("input#element_417").val() !="NaN"  ){
        total +=parseFloat($("input#element_417").val() *1)// petfood 6 Net Product Weight
    }
    if( $.trim( $("input#element_397").val() ).length>0 &&  $("input#element_397").val() !="NaN" ){
        total +=parseFloat($("input#element_397").val() *1)// petfood 5 Net Product Weight
    }
    if( $.trim( $("input#element_383").val() ).length>0  &&  $("input#element_383").val() !="NaN"  ){
        total +=parseFloat($("input#element_383").val() *1)// petfood 4 Net Product Weight
    }
    if( $.trim( $("input#element_367").val() ).length>0  &&  $("input#element_367").val() !="NaN"  ){
        total +=parseFloat($("input#element_367").val() *1)// petfood 3 Net Product Weight
    }
    if( $.trim( $("input#element_351").val() ).length>0  &&  $("input#element_351").val() !="NaN"  ){
        total +=parseFloat($("input#element_351").val() *1)// Petfood 2 Net Product Weight
    }
    if( $.trim( $("input#element_335").val() ).length>0  &&  $("input#element_335").val() !="NaN"  ){
        total +=parseFloat($("input#element_335").val() *1)// Petfood 1 Net Product Weight
    }
   return  total;
}
    
    
    
function total_shrink_trash(){ 
    var total =0;
    
    if( $.trim(  $("input#element_334").val()).length >0  &&  $("input#element_334").val() !="NaN"  ){
        total +=parseFloat( $("input#element_334").val() *1 )
    }
    
    if( $.trim(  $("input#element_350").val()).length >0   &&  $("input#element_350").val() !="NaN"   ){
        total +=parseFloat($("input#element_350").val() *1)
    }
    if( $.trim(  $("input#element_366").val()).length >0   &&  $("input#element_366").val() !="NaN"   ){
        total +=parseFloat($("input#element_366").val() *1)
    }
    if( $.trim(  $("input#element_382").val()).length >0   &&  $("input#element_382").val() !="NaN"   ){
        total +=parseFloat($("input#element_382").val() *1)
    }
    
    if( $.trim(  $("input#element_396").val()).length >0   &&  $("input#element_396").val() !="NaN"   ){
        total +=parseFloat( $("input#element_396").val() *1)
    }
    
    if( $.trim(  $("input#element_416").val()).length >0   &&  $("input#element_416").val() !="NaN"   ){
        total +=parseFloat($("input#element_416").val() *1)
    }
    if( $.trim(  $("input#element_433").val()).length >0   &&  $("input#element_433").val() !="NaN"   ){
        total +=parseFloat( $("input#element_433").val() *1)
    }
    if( $.trim(  $("input#element_450").val() ).length >0   &&  $("input#element_450").val() !="NaN"   ){
        total +=parseFloat( $("input#element_450").val() *1)
    }
    
    return total ;
}





function petfood1(){//*********************************Petfood 1
        var product_weight_total = 0;
         $("select#element_321").change(function(){
            var select =parseInt($(this).val());
            switch(select){
                 case 69://single serve
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *.01 );
                    $("input#element_333").val(  product_weight_total ); 
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *1 );
                   $("input#element_333").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *5 );
                   $("input#element_333").val(  product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *25 );
                    $("input#element_333").val(  product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_333").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){//shrink
                $("input#element_334").val(  parseFloat( $("input#element_333").val() *1 ) * .03  );
            }else{
                $("input#element_334").val( parseFloat( $("input#element_333").val() *1 ) * 0  );
            }
            $("input#element_335").val( $("input#element_333").val() - $("input#element_334").val( ) );//net total        
           
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val( total_shrink_trash() );
            $("input#element_178").val( Total_Load_Weight());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val( load_gross_weight());
            difference_from_scale();
        });
        
        
        $("input#element_325,input#element_458").change(function(){
            product_weight_total = 0;
            if( $.trim($("input#element_325").val()).length <=0){            
                   $("input#element_325").val(1)
            }
            
            if(  $.trim($("input#element_458").val()).length<=0 ){
                $("input#element_458").val(1);
            } 
            
            $("input#element_327").val( $("input#element_458").val() * $("input#element_325").val() );
            var select =parseInt($("select#element_321").val());
            switch(select){
                case 69://single serve
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *.01 );
                    $("input#element_333").val(  product_weight_total ); 
                    $("input#element_181").val(excluded_product_weight());
                    
                break;
                case 70:////bagged under 1
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *1 );
                   $("input#element_333").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *5 );
                   $("input#element_333").val(  product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat( parseInt($("input#element_327").val() *1   )  *25 );
                    $("input#element_333").val(  product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_333").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            
            
            
            if( $("select#element_321").val() == 70 || $("select#element_321").val() == 71 || $("select#element_321").val() == 72 ){//shrink
                $("input#element_334").val(  parseFloat( $("input#element_333").val() *1 ) * .03  );
            }else{
                $("input#element_334").val( parseFloat( $("input#element_333").val() *1 ) * 0  );
            }
            $("input#element_335").val( parseFloat( $("input#element_333").val() *1 ) - parseFloat( $("input#element_334").val() *1 )  );//net total        
            $("input#element_141").val( total_shrink_trash() );
            $("input#element_178").val( Total_Load_Weight());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val( load_gross_weight());
            difference_from_scale()
            $("input#element_184").val( total_product_weight_shrink( total_product_weight_shrink() ) );//Total Product NET Weight Total
        });
        
        $("input#element_329").change(function(){//generic pallet
            
            $("input#element_330").val( parseFloat( $(this).val()*25  )  );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink(); 
            var select1 =parseInt($("select#element_321").val());
            if( select1 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));
            }
            
        });
        
        
        $("input#element_613").change(function(){ // red/blue pallet
            
            $("input#element_614").val( parseFloat($(this).val() * 60) );  
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val( total_skids() );// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink(); 
            var select1 =parseInt($("select#element_321").val());
            if( select1 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  ));
            }
        });
        
        $("input#element_612").change(function(){//brown pallet
            
            $("input#element_615").val( parseFloat($(this).val() * 43) );    
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val( total_skids() );// total pallets/skids   
            Total_Weight_Shrink_per_Pallets_Skids(); 
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select1 =parseInt($("select#element_321").val());
            if( select1 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  ));
            }
        });
        
        $("input#element_332").change(function(){//other            
            $("input#element_138").val(  total_skids()  );// total pallets/skids
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select1 =parseInt($("select#element_321").val());
            if( select1 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            var select =parseInt($("select#element_321").val());
            if( select == 69){
                excluded_product_container_shrink( $(this).val() );
            }
            Total_Shrink_Trailer();
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Load_Total_Shrink();
        });
        
        
    }//*********************************Petfood 1
    
    function petfood2(){//*********************************Petfood 2
        var product_weight_total = 0;
        $("select#element_338").change(function(){
            var select =parseInt($(this).val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = parseFloat( $("input#element_343").val() ) *.01 
                    $("input#element_349").val( product_weight_total);
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = parseFloat( $("input#element_343").val() ) *1 
                   $("input#element_349").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat( $("input#element_343").val() ) *5
                    $("input#element_349").val(   product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat( $("input#element_343").val() ) *25
                    $("input#element_349").val(  product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_349").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){//shrink
                $("input#element_350").val(  parseFloat( $("input#element_349").val() *1 ) * .03  );
            }else{
                $("input#element_350").val( parseFloat( $("input#element_349").val() *1 ) * 0  );
            }
            $("input#element_351").val( $("input#element_349").val() - $("input#element_350").val() );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());            
            $("input#element_178").val(Total_Load_Weight());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        
        
        $("input#element_342,input#element_457").change(function(){
            product_weight_total = 0;
            if( $.trim($("input#element_342").val()).length <=0   ){
                $("input#element_342").val(1);
            }
            
            if($.trim($("input#element_457").val()).length<=0){
                $("input#element_457").val(1);
            }
            
            $("input#element_343").val($("input#element_457").val() * $("input#element_342").val() );
            var select =parseInt($("select#element_338").val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = parseFloat( $("input#element_343").val() ) *.01 
                    $("input#element_349").val( product_weight_total); 
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = parseFloat( $("input#element_343").val() ) *1 
                   $("input#element_349").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat( $("input#element_343").val() ) *5
                    $("input#element_349").val(   product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat( $("input#element_343").val() ) *25
                    $("input#element_349").val(  product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_349").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            if( $("select#element_338").val() == 70 || $("select#element_338").val() == 71 || $("select#element_338").val() == 72 ){//shrink
                $("input#element_350").val(  parseFloat( $("input#element_349").val() *1 ) * .03  );
            }else{
                $("input#element_350").val( parseFloat( $("input#element_349").val() *1 ) * 0  );
            }
            $("input#element_351").val( $("input#element_349").val() - $("input#element_350").val() );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_178").val(Total_Load_Weight());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        $("input#element_345").change(function(){//generic pallet
            $("input#element_346").val( parseFloat( $(this).val()*25  ) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select2 = parseInt($("select#element_338").val());
            if( select2 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));
            }
        });
        
        $("input#element_617").change(function(){// red/blue
            $("input#element_619").val( parseFloat($(this).val())  * 60 );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids  
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            excluded_product_container_shrink();
            var select2 = parseInt($("select#element_338").val());
            if( select2 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  ));
            }
        });
        
        $("input#element_616").change(function(){//brown        
            $("input#element_618").val( parseFloat($(this).val()) * 43 ); 
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();           
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select2 = parseInt($("select#element_338").val());
            if( select2 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  ));
            }
        });
        
        $("input#element_348").change(function(){//other
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select2 = parseInt($("select#element_338").val());
            if( select2 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            Total_Shrink_Trailer();
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Load_Total_Shrink();
        });

    }    //*********************************Petfood 2
    
    
    function petfood3(){//*********************************Petfood 3
        var product_weight_total = 0;
        $("select#element_354").change(function(){
            var select =parseInt($(this).val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = parseFloat( $("input#element_359").val()*.01 );
                    $("input#element_365").val( product_weight_total) ; 
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = parseFloat( $("input#element_359").val()*1 );
                    $("input#element_365").val(product_weight_total) ;
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat( $("input#element_359").val()*5 );
                   $("input#element_365").val(  product_weight_total  ) ;
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat( $("input#element_359").val() *25 );
                    $("input#element_365").val( product_weight_total  ) ;
                break;
                case 66: case 67:case 68:
                     $("input#element_365").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            
            
            
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){//shrink
                $("input#element_366").val(  parseFloat( $("input#element_365").val() *1 ) * .03  );
            }else{
                $("input#element_366").val( parseFloat( $("input#element_365").val() *1 ) * 0  );
            }
            
            $("input#element_367").val( $("input#element_365").val() - $("input#element_366").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_178").val(Total_Load_Weight());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        
        $("input#element_358,input#element_456").change(function(){
            product_weight_total = 0;
            if( $.trim($("input#element_358").val()).length <=0 ){
               $("input#element_358").val(1);
            }        
            if($.trim($("input#element_456").val()).length<=0 ){
                $("input#element_456").val(1);
            }        
            $("input#element_359").val( $("input#element_456").val() * $("input#element_358").val() ); 
            
            var select =parseInt($("select#element_354").val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = parseFloat(  $("input#element_359").val()*.01 );
                    $("input#element_365").val( product_weight_total) ; 
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total =  parseFloat( $("input#element_359").val()*1 ); 
                    $("input#element_365").val(product_weight_total ) ;
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat( $("input#element_359").val()*5);
                   $("input#element_365").val(  product_weight_total  ) ;
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat( $("input#element_359").val() *25 );
                    $("input#element_365").val( product_weight_total  ) ;
                break;
                case 66: case 67:case 68:
                     $("input#element_365").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            if( $("select#element_354").val() == 70 || $("select#element_354").val() == 71 || $("select#element_354").val() == 72 ){//shrink
                $("input#element_366").val(  parseFloat( $("input#element_365").val() *1 ) * .03  );
            }else{
                $("input#element_366").val( parseFloat( $("input#element_365").val() *1 ) * 0  );
            }
            
            $("input#element_367").val( $("input#element_365").val() - $("input#element_366").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_178").val(Total_Load_Weight());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        
        $("input#element_361").change(function(){//generic pallet
            $("input#element_362").val( parseFloat( $(this).val()*25  ) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids 
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            
            var select3 = parseInt($("select#element_354").val() );
            if(select3 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
               $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));
            }
            
            
        });
        
        $("input#element_621").change(function(){//red
            $("input#element_623").val( parseFloat($(this).val() * 60) ); 
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total       
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select3 = parseInt($("select#element_354").val() );
            if(select3 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  ));
            }
        });
        
        $("input#element_620").change(function(){//brown
            $("input#element_622").val( parseFloat($(this).val()) * 43 );        
            $("input#element_138").val(total_skids());// total pallets/skids
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select3 = parseInt($("select#element_354").val() );
            if(select3 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  )); 
            }
        });
        
        $("input#element_364").change(function(){//other
            $("input#element_138").val(total_skids());// total pallets/skids
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select3 = parseInt($("select#element_354").val() );
            if(select3 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Shrink_Trailer();
            var select3 = parseInt($("select#element_354").val() );
            if(select3 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        
    }//*********************************Petfood 3
    
    function petfood4(){//*********************************Petfood 4
        var product_weight_total = 0;
        $("select#element_370").change(function(){
            var select =parseInt($(this).val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = parseFloat($("input#element_375").val() *.01 ) ;
                    $("input#element_381").val(product_weight_total )   ;
                    $("input#element_181").val(excluded_product_weight());
                case 70:////bagged under 1
                    product_weight_total = parseFloat($("input#element_375").val() *.1);
                    $("input#element_381").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat($("input#element_375").val() *5);
                    $("input#element_381").val( product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat($("input#element_375").val() *25);
                    $("input#element_381").val( product_weight_total   );
                break;
                case 66: case 67:case 68:
                     $("input#element_381").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){//shrink
                $("input#element_382").val(  parseFloat( $("input#element_381").val() *1 ) * .03  );
            }else{
                $("input#element_382").val( parseFloat( $("input#element_381").val() *1 ) * 0  );
            }
            $("input#element_383").val( $("input#element_381").val() - $("input#element_382").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        
        $("input#element_374,input#element_455").change(function(){
            product_weight_total = 0;
            if( $.trim($("input#element_374").val()).length <=0  ){
               $("input#element_374").val(1);
            }
            
            if($.trim($("input#element_455").val()).length<=0){
                $("input#element_455").val(1);
            }
            $("input#element_375").val(  $("input#element_455").val() * $("input#element_374").val() ); 
            var select =parseInt($("select#element_370").val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = parseFloat($("input#element_375").val() *.01 ) ;
                    $("input#element_381").val(product_weight_total )   ;
                    $("input#element_181").val(excluded_product_weight());
                case 70:////bagged under 1
                    product_weight_total = parseFloat($("input#element_375").val() *.1);
                    $("input#element_381").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = parseFloat($("input#element_375").val() *5);
                    $("input#element_381").val( product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total = parseFloat($("input#element_375").val() *25);
                    $("input#element_381").val( product_weight_total   );
                break;
                case 66: case 67:case 68:
                     $("input#element_381").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            if( $("select#element_370").val() == 70 || $("select#element_370").val() == 71 || $("select#element_370").val() == 72 ){//shrink
                $("input#element_382").val(  parseFloat( $("input#element_381").val() *1 ) * .03  );
            }else{
                $("input#element_382").val( parseFloat( $("input#element_381").val() *1 ) * 0  );
            }
            $("input#element_383").val( $("input#element_381").val() - $("input#element_382").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        
        $("input#element_377").change(function(){//generic pallet
            $("input#element_378").val( parseFloat( $(this).val()*25  ) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select4 =parseInt($("select#element_370").val());
            if(select4 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));    
            }
        });
        $("input#element_625").change(function(){//red        
            $("input#element_627").val( parseFloat($(this).val() * 60) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select4 =parseInt($("select#element_370").val());
            if(select4 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  ));   
            }
        });
        
        $("input#element_624").change(function(){//brown        
            $("input#element_626").val( parseFloat($(this).val()) * 43 ); 
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select4 =parseInt($("select#element_370").val());
            if(select4 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  ));  
            }
        });
        
        $("input#element_380").change(function(){//other       
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select4 =parseInt($("select#element_370").val());
            if(select4 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Shrink_Trailer();
            var select4 =parseInt($("select#element_370").val());
            if(select4 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });

    }//*********************************Petfood 4
    function petfood5(){//*********************************Petfood 5
        var product_weight_total = 0;
        $("input#element_386").change(function(){
            var select =parseInt($(this).val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = .01*  parseFloat($("input#element_391").val() *1);
                    $("input#element_412").val(   product_weight_total );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = 1 * parseFloat($("input#element_391").val() *1);
                     $("input#element_412").val( product_weight_total  );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = 5 * parseFloat($("input#element_391").val() *1) ;
                    $("input#element_412").val( product_weight_total  );
                break;
                case 72://bagged over 5
                    product_weight_total = 25* parseFloat($("input#element_391").val() *1);
                     $("input#element_412").val(  product_weight_total  );
                break;
                case 66: case 67:case 68:
                     $("input#element_412").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            
           
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){//shrink
                $("input#element_396").val(  parseFloat( $("input#element_412").val() *1 ) * .03  );
            }else{
                $("input#element_396").val( parseFloat( $("input#element_412").val() *1 ) * 0  );
            }
            $("input#element_397").val( $("input#element_412").val() - $("input#element_396").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        $("input#element_390,input#element_454").change(function(){
            product_weight_total =0;
            if( $.trim($("input#element_390").val()).length <=0  ){
               $("input#element_390").val(1);
            }
            
            if( $.trim($("input#element_454").val()).length<=0){
                $("input#element_454").val(1);
            }
            $("input#element_391").val($("input#element_454").val() * $("input#element_390").val() );
            
            
            var select =parseInt($("select#element_386").val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total = .01*  parseFloat($("input#element_391").val() *1);
                    $("input#element_412").val(   product_weight_total );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = 1 * parseFloat($("input#element_391").val() *1);
                     $("input#element_412").val( product_weight_total  );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total = 5 * parseFloat($("input#element_391").val() *1) ;
                    $("input#element_412").val( product_weight_total  );
                break;
                case 72://bagged over 5
                    product_weight_total = 25* parseFloat($("input#element_391").val() *1);
                     $("input#element_412").val(  product_weight_total  );
                break;
                case 66: case 67:case 68:
                     $("input#element_412").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            
            if( $("select#element_386").val() == 70 || $("select#element_386").val() == 71 || $("select#element_386").val() == 72 ){//shrink
                $("input#element_396").val(  parseFloat( $("input#element_412").val() *1 ) * .03  );
            }else{
                $("input#element_396").val( parseFloat( $("input#element_412").val() *1 ) * 0  );
            }
            $("input#element_397").val( $("input#element_412").val() - $("input#element_396").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
         
        $("input#element_394").change(function(){//generic pallet            
            $("input#element_395").val( parseInt($(this).val() * 25) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select5 =parseInt($("select#element_386").val());
            if(select5 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));    
            }
        });
        
        $("input#element_629").change(function(){//red
            $("input#element_631").val( parseInt($(this).val() * 60) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select5 =parseInt($("select#element_386").val());
            if(select5 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  )); 
            }
        });
        
        $("input#element_628").change(function(){//brown        
            $("input#element_630").val( parseFloat($(this).val()) * 43 ); 
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select5 =parseInt($("select#element_386").val());
            if(select5 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  ));   
            }
        });
        
        $("input#element_411").change(function(){//other
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select5 =parseInt($("select#element_386").val());
            if(select5 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Shrink_Trailer();
            var select5 =parseInt($("select#element_386").val());
            if(select5 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });

    }//*********************************Petfood 5
    function petfood6(){//*********************************Petfood 6
        var product_weight_total =0;
        $("select#element_400").change(function(){
            var select =parseInt($(this).val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total =.01*  parseFloat($("input#element_405").val() *1  );
                    $("input#element_415").val(   product_weight_total   );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total =.01 *  parseFloat($("input#element_405").val() *1  ) ;
                     $("input#element_415").val(  product_weight_total  );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total =5 * parseFloat($("input#element_405").val() *1  );
                    $("input#element_415").val( product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total =25*  parseFloat($("input#element_405").val() *1  );
                     $("input#element_415").val( product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_415").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){//shrink
                $("input#element_416").val(  parseFloat( $("input#element_415").val() *1 ) * .03  );
            }else{
                $("input#element_416").val( parseFloat( $("input#element_415").val() *1 ) * 0  );
            }
            $("input#element_417").val( $("input#element_415").val() - $("input#element_416").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
       
        $("input#element_404,input#element_453").change(function(){
            product_weight_total =0;
            if( $.trim($("input#element_404").val()).length <=0 ){
                $("input#element_404").val(1);
            }
            
            if( $.trim($("input#element_453").val()).length<=0 ){
                $("input#element_453").val(1);
            }
            $("input#element_405").val($("input#element_453").val() * $("input#element_404").val() );
            
            var select =parseInt($("select#element_400").val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total =.01*  parseFloat($("input#element_405").val() *1  );
                    $("input#element_415").val(   product_weight_total   );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total =.01 *  parseFloat($("input#element_405").val() *1  ) ;
                     $("input#element_415").val(  product_weight_total  );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total =5 * parseFloat($("input#element_405").val() *1  );
                    $("input#element_415").val( product_weight_total );
                break;
                case 72://bagged over 5
                    product_weight_total =25*  parseFloat($("input#element_405").val() *1  );
                     $("input#element_415").val( product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_415").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            if( $("select#element_400").val() == 70 || $("select#element_400").val() == 71 || $("select#element_400").val() == 72 ){//shrink
                $("input#element_416").val(  parseFloat( $("input#element_415").val() *1 ) * .03  );
            }else{
                $("input#element_416").val( parseFloat( $("input#element_415").val() *1 ) * 0  );
            }
            $("input#element_417").val( $("input#element_415").val() - $("input#element_416").val( ) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
        });
        
         $("input#element_408").change(function(){//generic pallet
            $("input#element_409").val( parseFloat( $(this).val()*25  ) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select6 =parseInt($("select#element_400").val());
            if(select6 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));   
            }
        });
        
        $("input#element_633").change(function(){//red
            $("input#element_635").val( parseFloat($(this).val() * 60) );   
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total     
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select6 =parseInt($("select#element_400").val());
            if(select6 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  ));    
            }
        });
        
        $("input#element_632").change(function(){//brown
            $("input#element_634").val( parseFloat($(this).val()) * 43 ); 
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select6 =parseInt($("select#element_400").val());
            if(select6 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  ));    
            }
        });
        
        $("input#element_414").change(function(){//other
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select6 =parseInt($("select#element_400").val());
            if(select6 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Shrink_Trailer();
            Load_Total_Shrink();
            var select6 =parseInt($("select#400").val());
            if(select6 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });

    }//*********************************Petfood 6
    function petfood7(){//*********************************Petfood 7    
        var product_weight_total =0;
        $("input#element_420").change(function(){
           $("input#element_426").val($("input#element_425").val() * $("input#element_424").val() ); 
            var select =parseInt($(this).val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total =.01 * parseFloat( $("input#element_426").val() *1);
                    $("input#element_432").val(  product_weight_total );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total =1 * parseFloat( $("input#element_426").val() *1);
                     $("input#element_432").val(  product_weight_total  );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total =5 * parseFloat( $("input#element_426").val() *1);
                    $("input#element_432").val(   product_weight_total  );
                break;
                case 72://bagged over 5
                    product_weight_total = 25* parseFloat( $("input#element_426").val() *1);
                     $("input#element_432").val( product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_432").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            $("input#element_428").change(function(){//generic pallet
                $("input#element_429").val( parseFloat( $(this).val()*25  ) );
            });
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){// shrink
                $("input#element_433").val(   parseFloat( $("input#element_432").val() *1 ) * .03  );
            }else{
                 $("input#element_433").val(  parseFloat( $("input#element_432").val() *1 ) * 0  );
            }
            
            $("input#element_434").val( parseFloat($("input#element_432").val()  *1  ) - parseFloat($("input#element_433").val()   *1) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash()); 
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        $("input#element_424,input#element_425").change(function(){
            product_weight_total =0;
            if( $.trim($("input#element_424").val()).length <=0){
               $("input#element_424").val(1);
            }
            
            if( $.trim($("input#element_425").val()).length<=0 ){
                $("input#element_425").val(1);
            }
            
            $("input#element_426").val($("input#element_425").val() * $("input#element_424").val() ); 
            var select =parseInt($("select#element_420").val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total =.01 * parseFloat( $("input#element_426").val() *1);
                    $("input#element_432").val(  product_weight_total );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total =1 * parseFloat( $("input#element_426").val() *1);
                     $("input#element_432").val(  product_weight_total  );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total =5 * parseFloat( $("input#element_426").val() *1);
                    $("input#element_432").val(   product_weight_total  );
                break;
                case 72://bagged over 5
                    product_weight_total = 25* parseFloat( $("input#element_426").val() *1);
                     $("input#element_432").val( product_weight_total );
                break;
                case 66: case 67:case 68:
                     $("input#element_432").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            $("input#element_428").change(function(){//generic pallet
                $("input#element_429").val( parseFloat( $(this).val()*25  ) );
                Total_Weight_Shrink_per_Pallets_Skids();
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));
            });
            
            
            if( $("select#element_420").val() == 70 || $("select#element_420").val() == 71 || $("select#element_420").val() == 72 ){// shrink
                $("input#element_433").val(   parseFloat( $("input#element_432").val() *1 ) * .03  );
            }else{
                 $("input#element_433").val(  parseFloat( $("input#element_432").val() *1 ) * 0  );
            }
            
            $("input#element_434").val( parseFloat($("input#element_432").val()  *1  ) - parseFloat($("input#element_433").val()   *1) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash());
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        $("input#element_637").change(function(){//red
            $("input#element_639").val( parseFloat($(this).val() * 60) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select7 =parseInt($("select#element_420").val());
            if(select7 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  ));    
            }
        });
        
        $("input#element_636").change(function(){//brown        
            $("input#element_638").val( parseFloat($(this).val()) * 43 ); 
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select7 =parseInt($("select#element_420").val());
            if(select7 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  ));    
            }
        });
        
        $("input#element_431").change(function(){//other
            $("input#element_138").val(total_skids());// total pallets/skids
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            var select7 =parseInt($("select#element_420").val());
            if(select7 == 69){
               $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Shrink_Trailer();
            Load_Total_Shrink();
            var select7 =parseInt($("select#element_420").val());
            if(select7 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
    }//*********************************Petfood 7
    function petfood8(){//*********************************Petfood 8
        var product_weight_total =0;
        $("select#element_437").change(function(){
            var product_weight_total =0;
            var select =parseInt($(this).val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total =.01 * parseFloat($("input#element_443").val() *1);
                    $("input#element_449").val(  product_weight_total    );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = 1 * parseFloat($("input#element_443").val() *1) 
                     $("input#element_449").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total =5 * parseFloat($("input#element_443").val() *1) ;
                    $("input#element_449").val(  product_weight_total  ) ;
                break;
                case 72://bagged over 5
                    product_weight_total =25  *  parseFloat($("input#element_443").val() *1) ;
                     $("input#element_449").val( product_weight_total  )   ;
                break;
                case 66: case 67:case 68:
                     $("input#element_449").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            $("input#element_445").change(function(){//generic pallet
                $("input#element_446").val( parseFloat( $(this).val()*25  ));
                Total_Weight_Shrink_per_Pallets_Skids();
                
                var select8  = parseInt( $("select#element_437").val() );
                if(select8 == 69){
                    $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                    $("input#element_182").val(excluded_product_container_shrink( $(this).val() *25  ));
                }
            });
            
            
            if( $(this).val() == 70 || $(this).val() == 71 || $(this).val() == 72 ){// shrink
                $("input#element_450").val(  parseFloat( $("input#element_449").val() *1 ) * .03  );
            }else{
                $("input#element_450").val(  parseFloat( $("input#element_449").val() *1 ) * 0  );
            }
            
            $("input#element_451").val( parseFloat($("input#element_449").val()) - parseFloat($("input#element_450").val( )) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash()); 
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
        });
        
        $("input#element_441,input#element_442").change(function(){
            product_weight_total =0;
            if( $.trim($("input#element_441").val()).length <=0 ){
               $("input#element_441").val(1);
            }
            
            if( $.trim($("input#element_442").val()).length<=0 ){
                $("input#element_442").val(1);
            }
            $("input#element_443").val($("input#element_442").val() * $("input#element_441").val() ); 
            
            var select =parseInt($("select#element_437").val());
            switch(select){//Product Weight Total
                case 69://single serve
                    product_weight_total =.01 * parseFloat($("input#element_443").val() *1);
                    $("input#element_449").val(  product_weight_total    );
                    $("input#element_181").val(excluded_product_weight());
                break;
                case 70:////bagged under 1
                    product_weight_total = 1 * parseFloat($("input#element_443").val() *1) 
                     $("input#element_449").val( product_weight_total );
                break;
                case 71://bagged one 1 to 5
                    product_weight_total =5 * parseFloat($("input#element_443").val() *1) ;
                    $("input#element_449").val(  product_weight_total  ) ;
                break;
                case 72://bagged over 5
                    product_weight_total =25  *  parseFloat($("input#element_443").val() *1) ;
                     $("input#element_449").val( product_weight_total  )   ;
                break;
                case 66: case 67:case 68:
                     $("input#element_449").val( "0"  )   ;
                break;
                default:
                    alert("Please choose a product");
                break;
            }
            
            if( $("select#element_437").val() == 70 || $("select#element_437").val() == 71 || $("select#element_437").val() == 72 ){// shrink
                $("input#element_450").val(   parseFloat( $("input#element_449").val() *1 ) * .03  );
            }else{
                 $("input#element_450").val(  parseFloat( $("input#element_449").val() *1 ) * 0  );
            }
            
            $("input#element_451").val( parseFloat($("input#element_449").val()) - parseFloat($("input#element_450").val( )) );//net total
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_141").val(total_shrink_trash()); 
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            excluded_product_container_shrink();
        });
        
        $("input#element_641").change(function(){//red
            $("input#element_643").val( parseInt( $(this).val() * 60) );
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            excluded_product_container_shrink();
            var select8  = parseInt( $("select#element_437").val() );
            if(select8 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *60  ));
            }            
        });
        
        $("input#element_640").change(function(){//brown        
            $("input#element_642").val( parseInt($(this).val()) * 43 ); 
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            Total_Weight_Shrink_per_Pallets_Skids();
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            excluded_product_container_shrink();
            var select8  = parseInt( $("select#element_437").val() );
            if(select8 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
                $("input#element_182").val(excluded_product_container_shrink( $(this).val() *43  ));
            }
        });
        
        $("input#element_448").change(function(){//other        
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            $("input#element_138").val(total_skids());// total pallets/skids
            $("input#element_144").val( Product_Net() );
            $("input#element_186").val(load_gross_weight());
            difference_from_scale();
            Load_Total_Shrink();
            excluded_product_container_shrink();
            var select8  = parseInt( $("select#element_437").val() );
            if(select8 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
        
        
        $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_360,input#element_361,input#element_621,input#element_620,input#element_363,input#element_364,input#element_376,input#element_377,input#element_625,input#element_624,input#element_379,input#element_380,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
            $("input#element_184").val( total_product_weight_shrink() );//Total Product NET Weight Total
            Total_Shrink_Trailer();
            Load_Total_Shrink();
            excluded_product_container_shrink();
            var select8  = parseInt( $("select#element_437").val() );
            if(select8 == 69){
                $("input#element_182").val(excluded_product_container_shrink( $(this).val()   ));
            }
        });
    }//*********************************Petfood 8