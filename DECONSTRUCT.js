function calc_total(){
    //PRICING CALCS
    var temp=0;
   
   
    if( $.trim( $("input#element_653").val() ).length>0  && $("input#element_653").val() !="NaN" ){            
        temp += parseFloat( $("input#element_653").val() *1 );
    }
    
    if( $.trim( $("input#element_650").val() ).length>0  && $("input#element_650").val() !="NaN"   ){            
        temp += parseFloat( $("input#element_650").val( ) *1 );
    }
    
    if( $.trim($("input#element_188").val()).length>0  && $("input#element_188").val() !="NaN"  ){            
        temp += parseFloat( $("input#element_188").val( ) *1 );
    }
    
    if( $.trim($("input#element_187").val()).length>0  && $("input#element_187").val() !="NaN" ){
        temp += parseFloat($("input#element_187").val() *1);
    }
    
    if( $.trim($("input#element_189").val()).length>0  && $("input#element_189").val() !="NaN" ){
        temp += parseFloat($("input#element_189").val() *1);
    }
    
    if( $.trim($("input#element_186").val()).length>0  && $("input#element_186").val() !="NaN" ){
        temp += parseFloat($("input#element_186").val() *1);
    }
    
    if( $.trim($("input#element_185").val()).length>0  && $("input#element_185").val() !="NaN"  ){
        temp += parseFloat( $("input#element_185").val() *1);
    }
    
    if( $.trim($("input#element_184").val()).length>0  && $("input#element_184").val() !="NaN"    ){
        temp += parseFloat($("input#element_184").val() *1);
    }
    
    if( $.trim($("input#element_181").val()).length>0  && $("input#element_181").val() !="NaN"     ){
        temp += parseFloat($("input#element_181").val() *1);
    }
    
    if( $.trim($("input#element_655").val()).length>0 && $("input#element_655").val() !="NaN"       ){
        temp +=  parseFloat( $("input#element_655").val() *1 ) ;
    }
    
    if( $.trim($("input#element_316").val()).length>0 && $("input#element_316").val() !="NaN"       ){
        temp += parseFloat($("input#element_316").val() *1);
    } 
    
    if( $.trim($("input#element_318").val()).length>0 && $("input#element_318").val() !="NaN"      ){
        temp += parseFloat($("input#element_318").val() *1);
    }
    
    if( $.trim($("input#element_317").val()).length>0 && $("input#element_317").val() !="NaN"      ){
        temp += parseFloat($("input#element_317").val() *1);
    }
   
    if( $.trim($("input#element_652").val()).length>0 && $("input#element_652").val() !="NaN"     ){ 
        temp +=  parseFloat($("input#element_652").val() *1);
    }
    
    if( $.trim($("input#element_314").val()).length>0 && $("input#element_314").val() !="NaN"    ){ 
        temp += parseFloat($("input#element_314").val()*1);
    }
    
    if( $.trim($("input#element_651").val()).length>0 && $("input#element_651").val() !="NaN"   ){ 
        temp += parseFloat($("input#element_651").val()*1);
    }
    
    if( $.trim($("input#element_313").val()).length>0 && $("input#element_313").val() !="NaN"  ){ 
        temp += parseFloat($("input#element_313").val()*1);
    }
    
    if( $.trim($("input#element_312").val()).length>0 && $("input#element_312").val() !="NaN" ){ 
        temp += parseFloat($("input#element_312").val() *1);
    }
    
    if( $.trim($("input#element_311").val()).length>0 && $("input#element_311").val() !="NaN" ){ 
        temp += parseFloat($("input#element_311").val() *1);
    }
    return temp;
}

    
    
function fox(){
    var b = 0;
    var a =  $("#element_179").val();
    if (a < 0.151){
       b = 0;
    } else if (a > 0.15 && a < 0.181) {
       b = 7.50;
    } else if (a > 0.18 && a < 0.201) {
       b = 15.00;
    } else if (a > 0.20 && a < 0.331) {
       b = 20.00;
    } else if (a > 0.33) {
       b = 30.00;
    }
    return b;
}

function discount_applied(){
    var d = 0;
    //DISCOUNT APPLIED
    var c = parseFloat($("#element_184").val(), 10);  //Load Net Product Weight   
    if (c < 36000) {
        d = 10;
    } 
    return d; 
}


function substance_percentage(){
    var e =0;
    var f = 0;
    var g = 0;
    //SUBSTANCE PERCENTAGE AND HANDLING CHARGE
    e = $("input#element_185").val();//Load Total Shrink (Including Pallets and Excluded Product Weights)
    f = $("input#element_186").val();//Load Gross Weight Total (Calculated) 
  
    if($("input#element_186").val()>0 && $("input#element_186").val() != "NaN" && $.trim( $("input#element_186").val() ).length >0 && $("input#element_185").val() != "NaN" && $.trim( $("input#element_185").val() ).length >0     ){
        g = e / f;  
    }else{
        g = 0;
    }
    return parseFloat(g);
}

function sub_2(g){//if substance_percentage() is greater than .45  then ADDTL freight/handling/disposal fee per ton is 70
    var h = 0;
    if (g >= 0.45) {
        h = 70;
    } 
    return h;
}


function addition_fees(){   
    var r = 0;
    //ADDITONAL PPT AND FEES
   
    var q = $("#element_318").val();
    if (q>0) { r = q};
    return r;
}

function additional_fee2(){//ADDITONAL PPT AND FEES
    var j = 0;
    var i = $("#element_317").val();
    if (i>0) { j = i};
    return j;
}

function total_cost(){
    var z = 0;
    var k = 0;
    var x = 0;
    var l = 0;
    var m = 0;
    var o = 0;
    var p = 0;
    var y = 0;
   
    if( $.trim( $("input#element_310").val() ).length >0 &&  $("input#element_310").val() !="NaN" ){
        o+= parseFloat($("input#element_310").val(), 10);
    }
    
    if( $.trim( $("input#element_312").val() ).length >0 &&  $("input#element_312").val() !="NaN" ){
        o+= parseFloat($("input#element_312").val(), 10);
    }
    
    
    if( $.trim( $("input#element_311").val() ).length >0 &&  $("input#element_311").val() !="NaN" ){
        x = parseFloat($("input#element_311").val(), 10);
    }
    
    
    
    if( $.trim( $("input#element_317").val() ).length >0 &&  $("input#element_317").val() !="NaN" ){
        m = parseFloat($("#element_317").val(), 10);
    }
    
    
    
    
    p = o + m;
    
    y = x + l + m;
    if (x>0){ z = y}else{ z = p};
    return z;
}


 $(document).ready(function () {
        
    if( $.trim( $("input#element_187").val() ).length >0 &&  $("input#element_187").val() !="NaN" ){
        $("input#element_188").val( $("input#element_189").val()/$("input#element_187").val()  );
    }else{
        $("input#element_188").val(0);
    }
     
    //TOTAL LOAD CALCS
    $("input#element_310").val( fox() );    
    $("input#element_311").val(  discount_applied() );
    $("input#element_312").val( sub_2( substance_percentage() )  ); 
    $("input#element_313").val( substance_percentage() ); //Foreign Substance %        
    $("input#element_317").val( additional_fee2() ); 
    $("input#element_318").val( addition_fees() );       
    $("input#element_143").val( Total_Shrink_Trailer() );
    $("input#element_178").val( Total_Load_Weight() ); 
    $("input#element_316").val( total_cost() ); 
    $("input#element_130").val( calc_total()  );
    //# of pallets/skids + total trash + total shrink
    $("input#element_185").val(  parseFloat($("input#element_138").val() *1)+ parseFloat(  $("input#element_141").val()*1 )+ parseFloat( $("input#element_139").val() *1 )   );
    $("input#element_130").val( calc_total()  );
    
    
    $("#element_155_1, #element_155_2").change(function() {           
        //TOTAL LOAD CALCS
        $("input#element_310").val( fox() );    
        $("input#element_311").val(  discount_applied() );
        $("input#element_312").val( sub_2( substance_percentage() )  ); 
        $("input#element_313").val( substance_percentage() ); //Foreign Substance %        
        $("input#element_317").val( additional_fee2() ); 
        $("input#element_318").val( addition_fees() );       
        $("input#element_143").val( Total_Shrink_Trailer() );
        $("input#element_178").val( Total_Load_Weight() ); 
        $("input#element_316").val( total_cost() );
        $("input#element_130").val( calc_total()  );
    });
                
    $("input#element_653").change(function(){
       $("input#element_130").val( calc_total() ); 
    });            
                    
 
    $("input#element_318,element_184").change(function(){
            var w = 0;
            var t = 0;
            var u = 0;
            var t = 0;
            var s = 0;
            var z = 0;
            var z = 0;
            var k = 0;
            var x = 0;
            var l = 0;
            var m = 0;
            var o = 0;
            var p = 0;
            var y = 0;
            k = parseFloat($("#element_310").val(), 10);
            x = parseFloat($("#element_311").val(), 10);
            l = parseFloat($("#element_312").val(), 10);
            m = parseFloat($("#element_317").val(), 10);
            o = k + l;
            p = o + m;
            y = x + l + m;
            if (x>0){ z = y}else{ z = p};
            
            
            if( $.trim($("#element_318").val())>0 ){//Additional flat fee/adjustment
                w = parseFloat($("#element_318").val(), 10);
            }else{
                w = 0;
            }   
              
            if( $.trim($("#element_184").val()) >0 ){//Load Net Product Weight
                s = parseFloat($("#element_184").val(), 10);  
            }else{
                s = 0;
            }
            t = s/2000;
            u = t * z;
            v = u + w;
            
            $("#element_130").val(v);
    }); 
        
        
    $("#element_90, #element_105, #element_117").change(function() {
        //PALLET WEIGHT SUMS AND CALCS
          
        $("input#element_130").val( calc_total() ); 
    });
    
    $("input#element_188,input#element_187,input#element_189,input#element_186,input#element_185,input#element_184,input#element_182,input#element_181,input#element_655,input#element_654,input#element_316,input#element_318,input#element_317,input#element_652,input#element_314,input#element_314,input#element_651,input#element_313,input#element_312,input#element_311,input#element_650").change(function(){
        $("input#element_130").val( calc_total() );
    });
    $("input#element_328,input#element_329,input#element_613,input#element_612,input#element_331,input#element_332,input#element_344,input#element_345,input#element_617,input#element_616,input#element_347,input#element_348,input#element_361,input#element_620,input#element_363,input#element_364,input#element_393,input#element_394,input#element_629,input#element_628,input#element_410,input#element_411,input#element_407,input#element_408,input#element_633,input#element_632,input#element_413,input#element_414,input#element_427,input#element_428,input#element_637,input#element_636,input#element_430,input#element_431,input#element_444,input#element_445,input#element_641,input#element_640,input#element_447,input#element_448").change(function(){
        $("input#element_130").val( calc_total() ); 
    });
    
    
    $("#li_655").append('<input type="button" value="Mixed Load Breakdown" id="mixed_load"/>');    
    $('#element_138').prop('readonly', true);
    $('#element_139').prop('readonly', true);
    $('#element_172').prop('readonly', true);
    $('#element_174').prop('readonly', true);
    $('#element_175').prop('readonly', true);
    $('#element_203').prop('readonly', true);
    $('#element_163').prop('readonly', true);
    $('#element_151').prop('readonly', true);
    $('#element_141').prop('readonly', true);
    $('#element_144').prop('readonly', true);
    $('#element_143').prop('readonly', true);
    $('#element_178').prop('readonly', true);
    $('#element_188').prop('readonly', true);
    $('#element_186').prop('readonly', true);
    $('#element_185').prop('readonly', true);
    $('#element_184').prop('readonly', true);
    $('#element_182').prop('readonly', true);
    $('#element_181').prop('readonly', true);                
    $('#element_170').prop('readonly', true);
    $('#element_310').prop('readonly', true);
    $('#element_313').prop('readonly', true);
    $('#element_312').prop('readonly', true);
    $('#element_316').prop('readonly', true);
    $('#element_187').prop('readonly', true);
    $('#element_311').prop('readonly', true); 
    $('#element_130').prop('readonly', true);        
    $('#element_219').prop('readonly', true);
    $('#element_299').prop('readonly', true);
    $('#element_283').prop('readonly', true);
    $('#element_267').prop('readonly', true);
    $('#element_251').prop('readonly', true);
    $('#element_235').prop('readonly', true)
    
    petfood1();
    petfood2();
    petfood3();
    petfood4();
    petfood5();
    petfood6();
    petfood7();
    petfood8();
    var cf;
    $.get("updated_values.php",function(data){
        $("input#element_179").val( parseFloat(data).toFixed(2) );
    });
    $.get("update_soybean.php",function(data){
        $("input#element_646").val( parseFloat(data).toFixed(2) );
    });
    
    $.ajax({
          method: "GET",
          url: "update_fuel_charge.php"
    }).done(function( msg ) {           
        $("input#element_647").val( parseFloat(msg).toFixed(2) );              
        var stat = parseFloat(msg).toFixed(2);   
        
        if(stat>2.90){
            var x = stat - 2.90;
            var y = x/.04;
            var f =y*.05;
            $("input#element_645").val(  f.toFixed(2) );
            
            cf = parseFloat( parseFloat($("input#element_648").val()*1  )  ) +  ( f*$("input#element_648").val() ) ;
            alert(cf);
            $("input#element_654").val(cf)    //calc freight
        }
            
        switch( $("input#element_12").val() ){
            case "Extruded Pallet": case "Extruded Gaylord":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-45");
                }else{
                    var over_ = Math.round($("input#element_646").val() - 160)/10;
                    $("input#element_310").val( (over_ * 5) +  (45 * -1) );
                }
            break;
            case "BULK":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-25");
                }else{
                    var over_ = Math.round($("input#element_646").val() - 160)/10;
                    $("input#element_310").val( (over_ * 5) +  (25 * -1) );
                }
            break;
            case "Bagged Under 1 lb": case "Bagged 1 lb to 5 lb":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-25");
                }else{
                    var over_ = Math.round($("input#element_646").val() - 160)/10;
                    $("input#element_310").val( (over_ * 5) +  (25 * -1) );
                }
            break;
            case "Single Serve Pallet":
                $("input#element_310").val("0");
            break;
            case "Bagged Over 5 lb":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-45");
                }else {
                    var over_ = Math.round($("input#element_646").val() - 160)/10;                    
                    $("input#element_310").val( (over_ * 5) +  (45 * -1) );
                }
            break;
        }            
    });
        //price per ton reduction
    $("input#element_647").change(function(){
        var stat = parseFloat( $(this).val() ).toFixed(2);   
        if(stat>2.90){
            var x = stat - 2.90;
            var y = x/.04;
            var f =y*.05;
            $("input#element_645").val(  f.toFixed(2) );
            cf = parseFloat( $("input#element_648").val() *1 ) +  parseFloat( $("input#element_645").val()*$("input#element_648").val() ) ;
            $("input#element_654").val(cf)    //calc freight
        }
            
        switch( $("input#element_12").val() ){
            case "Extruded Pallet": case "Extruded Gaylord":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-45");
                }else {
                     var over_ = Math.round($("input#element_646").val() - 160)/10;
                     alert(  (over_ * 5) +  (45 * -1) );
                     $("input#element_310").val( (over_ * 5) +  (45 * -1) );
                }
            break;
            case "BULK":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-25");
                }else{
                    var over_ = Math.round($("input#element_646").val() - 160)/10;
                    alert(  (over_ * 5) +  (45 * -1) );
                    $("input#element_310").val( (over_ * 5) +  (45 * -1) );
                }
            break;
            case "Bagged Under 1 lb": 
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-25");
                }else{
                    var over_ = Math.round($("input#element_646").val() - 310)/10;
                    alert(  (over_ * 5) +  (25 * -1) );
                    $("input#element_310").val( (over_ * 5) +  (25 * -1) );
                }
            break;
            case "Bagged 1 lb to 5 lb":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-45");
                }else{
                    var over_ = Math.round($("input#element_646").val() - 160)/10;
                    alert(  (over_ * 5) +  (45 * -1) );
                    $("input#element_310").val( (over_ * 5) +  (45 * -1) );
                }
                break;
            case "Single Serve Pallet":
                $("input#element_310").val("0");
            break;
            case "Bagged Over 5 lb":
                if( $("input#element_646").val()<=159 ){//soybean
                    $("input#element_310").val("-45");
                }else {
                    var over_ = Math.round($("input#element_646").val() - 310)/10;
                    alert(  (over_ * 5) +  (45 * -1) );
                    $("input#element_310").val( (over_ * 5) +  (45 * -1) );
                }
            break;
        }      
        $("input#element_130").val(calc_total());
    });
    
    
    $("#li_179").append("&nbsp;&nbsp;&nbsp<input type='button' id='update_jake' value='Update Jacobsen'/>");
    $("#li_179").on("click","#update_jake",function(){
        $.post("update_prices.php",{value:$("input#element_179").val(),table:"jake"},function(data){
             alert("Jacobsen Inserted! "+data);
        });
    });
    
    $("#li_646").append("&nbsp;&nbsp;&nbsp<input type='button' id='update_soybean' value='Update Soybean'/>")
    $("#li_646").on("click","#update_soybean",function(){
        $.post("update_prices.php",{value:$("input#element_646").val(),table:"soybean"},function(data){
             alert("Soybean price Updated!");
        });
    });
    
    
    $("#li_647").append("&nbsp;&nbsp;&nbsp<input type='button' id='update_price' value='Update Fuel Price'/>");
    $("#li_647").on("click","#update_surchage",function(){
        $.post("update_prices.php",{value:$("input#element_647").val(),table:"fuel_price"},function(data){
             alert("Fuel price Updated!");
        });
    });
    
    $("input#element_652").change(function(){
        var percent =0;
        var difference =0;
        var adj = 0;
        if(  $(this).val()>=1 ){//if they accidently enter a whole number turn it into a percentage
            percent = $(this).val()/100
            $(this).val( parseFloat(percent).toPrecision(2) );
        }else{
            percent = $(this).val();
        }
        
        if( percent >.40  &&  percent <.60 ){// if greater than 40% moist deduction is $1.00 for every 1% 
            difference = percent - .40;
            alert(difference);
            $("input#element_317").val( parseFloat(difference.toPrecision(2) *100) ); 
        }else{
            $("input#element_317").val("30");
        }
        
        switch($("input#element_12").val()){//trash deduction aka Foreign Substance Deduction
            case "Extruded Pallet": case "Extruded Gaylord":case "BULK":
                difference = percent - .40;
                $("input#element_651").val( parseFloat(difference.toPrecision(2) *100) ); 
            break;
        }
        
        $("input#element_130").val(calc_total());
    });    
    
   
                    
        
    
    
    
    
     
});





//UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 2