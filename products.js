 $("#element_99, #element_160, #element_161, #element_159, #element_189, #element_101, #element_156, #element_154, #element_153, #element_113, #element_166, #element_167, #element_168").change(function() {//product 1
        var a = parseFloat($("#element_163").val(),10);
        var b = parseFloat($("#element_151").val(),10);
        var c = parseFloat($("#element_170").val(),10);
        
        var d = parseFloat($("#element_173").val(),10);
        var e = parseFloat($("#element_176").val(),10);
        var f = parseFloat($("#element_177").val(),10);
        
        if (a>0){var g = a}else{var g = 0};
        if (b>0){var h = b}else{var h = 0};
        if (c>0){var i = c}else{var i = 0};
        
        if (d>0){var j = d}else{var j = 0};
        if (e>0){var k = e}else{var k = 0};
        if (f>0){var l = f}else{var l = 0};
        
        //var aa = a * 25;
        //var bb = b * 25;
        //var cc = c * 25;
        
        //if (b.length<=0){var d = b}  else  {var d = 0};
        //if (c.length<=0){var e = c}  else  {var e = 0};
        
        //b !== 'null' || b.length<=0   c !== 'null' || c.length<=0

        var w = g + h + i;
        var x = j + k + l;
        $("#element_141").val(w);
        $("#element_144").val(x);
        
        var y = parseFloat($("#element_139").val(),10);
        var z = parseFloat($("#element_143").val(),10);
        
        if (y>0){var yy = y}else{var yy = 0};
        if (z>0){var zz = z}else{var zz = 0};
    
    
        $("#element_143").val(w + yy);
        $("#element_178").val(zz + x);
        
        //parseFloat($("#element_141").val(),10)      parseFloat($("#element_144").val(),10)
        
        //$("#element_172").val(aa);
        //$("#element_174").val(bb);
        //$("#element_175").val(cc);
        //excluded product weight sum
        var aaa = $("#element_99").val();
        var bbb = $("#element_101").val();
        var ccc = $("#element_113").val();
        
        
        var ddd = parseFloat($("#element_173").val(),10);
        var eee = parseFloat($("#element_176").val(),10);
        var fff = parseFloat($("#element_177").val(),10);
        
        if (aaa == 4 | aaa == 5 | aaa == 6 | aaa == 7 | aaa == 8 | aaa == 9 | aaa == 11 | aaa == 21 | aaa == 30 | aaa == 33 | aaa == 38 | aaa == 48 | aaa == 56 | aaa == 57) {var ggg = ddd} else {var ggg = 0};
        
        if (bbb == 4 | bbb == 5 | bbb == 6 | bbb == 7 | bbb == 8 | bbb == 9 | bbb == 11 | bbb == 21 | bbb == 30 | bbb == 33 | bbb == 38 | bbb == 48 | bbb == 56 | bbb == 57) {var hhh = eee} else {var hhh = 0};
        
        if (ccc == 4 | ccc == 5 | ccc == 6 | ccc == 7 | ccc == 8 | ccc == 9 | ccc == 11 | ccc == 21 | ccc == 30 | ccc == 33 | ccc == 38 | ccc == 48 | ccc == 56 | ccc == 57) {var iii = fff} else {var iii = 0};
        
        $("#element_181").val(ggg + hhh + iii);
       
        //excluded trash weight sum
        var aaaa = $("#element_99").val();
        var bbbb = $("#element_101").val();
        var cccc = $("#element_113").val();
        
        
        var dddd = parseFloat($("#element_163").val(),10);
        var eeee = parseFloat($("#element_151").val(),10);
        var ffff = parseFloat($("#element_170").val(),10);
        
        if (aaaa == 4 | aaaa == 5 | aaaa == 6 | aaaa == 7 | aaaa == 8 | aaaa == 9 | aaaa == 11 | aaaa == 21 | aaaa == 30 | aaaa == 33 | aaaa == 38 | aaaa == 48 | aaaa == 56 | aaaa == 57) {var gggg = dddd} else {var gggg = 0};
        
        if (bbbb == 4 | bbbb == 5 | bbbb == 6 | bbbb == 7 | bbbb == 8 | bbbb == 9 | bbbb == 11 | bbbb == 21 | bbbb == 30 | bbbb == 33 | bbbb == 38 | bbbb == 48 | bbbb == 56 | bbbb == 57) {var hhhh = eeee} else {var hhhh = 0};
        
        if (cccc == 4 | cccc == 5 | cccc == 6 | cccc == 7 | cccc == 8 | cccc == 9 | cccc == 11 | cccc == 21 | cccc == 30 | cccc == 33 | cccc == 38 | cccc == 48 | cccc == 56 | cccc == 57) {var iiii = ffff} else {var iiii = 0};
        
        $("#element_182").val(gggg + hhhh + iiii);
        //load net
        $("#element_184").val(parseFloat($("#element_144").val(),10) - parseFloat($("#element_181").val(),10))
        //load shrink
        $("#element_185").val(parseFloat($("#element_143").val(),10) + parseFloat($("#element_181").val(),10) + parseFloat($("#element_139").val(),10));
        //load gross
        $("#element_186").val(parseFloat($("#element_184").val(),10) + parseFloat($("#element_185").val(),10));
        //difference
        $("#element_187").val(parseFloat($("#element_186").val(),10) - parseFloat($("#element_189").val(),10));
        //contingency
        $("#element_188").val(parseFloat($("#element_187").val(),10) / parseFloat($("#element_189").val(),10));
     });


 //UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 3
     $("#element_113, #element_166, #element_167, #element_168").change(function() {
        var a = $("#element_113").val();
                
        if (a==4){
             $("#element_166").val("4");
             $("#element_168").val($("#element_167").val()*$("#element_166").val());
             $("#element_170").val($("#element_168").val()*0.55);
             $("#element_177").val($("#element_168").val()*7.76);
             $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==5) {
              $("#element_166").val("4");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.55);
              $("#element_177").val($("#element_168").val()*7.76);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==6) {
              $("#element_166").val("4");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.55);
              $("#element_177").val($("#element_168").val()*8.40);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==7) {
              $("#element_166").val("4");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.48);
              $("#element_177").val($("#element_168").val()*8.40);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==8) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.09);
              $("#element_177").val($("#element_168").val()*0.718);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==9) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.10);
              $("#element_177").val($("#element_168").val()*0.937);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==10) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.10);
              $("#element_177").val($("#element_168").val()*1.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==11) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.14);
              $("#element_177").val($("#element_168").val()*1.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==12) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.10);
              $("#element_177").val($("#element_168").val()*1.12);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==13) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.08);
              $("#element_177").val($("#element_168").val()*1.12);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==14) {
              $("#element_166").val("3");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*1.1);
              $("#element_177").val($("#element_168").val()*15.52);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==15) {
              $("#element_166").val("3");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.75);
              $("#element_177").val($("#element_168").val()*15.52);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==16) {
              $("#element_166").val("");
              //$("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.48);
              $("#element_177").val($("#element_168").val()*7.81);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==17) {
              $("#element_166").val("");
              //$("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.25);
              $("#element_177").val($("#element_168").val()*7.81);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==18) {
              $("#element_166").val("");
              //$("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*3.00);
              $("#element_177").val($("#element_168").val()*30.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==19) {
              $("#element_166").val("");
              //$("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*1.00);
              $("#element_177").val($("#element_168").val()*30.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==20) {
              $("#element_166").val("");
              //$("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*2.00);
              $("#element_177").val($("#element_168").val()*30.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==21) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.15);
              $("#element_177").val($("#element_168").val()*1.87);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==22) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.10);
              $("#element_177").val($("#element_168").val()*2.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==23) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.13);
              $("#element_177").val($("#element_168").val()*2.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==24) {
              $("#element_166").val("12");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.16);
              $("#element_177").val($("#element_168").val()*2.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==25) {
              $("#element_166").val("");
              //$("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.20);
              $("#element_177").val($("#element_168").val()*2.86);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==26) {
              $("#element_166").val("8");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.16);
              $("#element_177").val($("#element_168").val()*3.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==27) {
              $("#element_166").val("8");
              $("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*0.14);
              $("#element_177").val($("#element_168").val()*3.00);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==28) {
              $("#element_166").val("");
              //$("#element_168").val($("#element_167").val()*$("#element_166").val());
              $("#element_170").val($("#element_168").val()*2.00);
              $("#element_177").val($("#element_168").val()*38.80);
              $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==29) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*30);
                  $("#element_177").val($("#element_168").val()*426.00);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==30) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.05);
                  $("#element_177").val($("#element_168").val()*0.50);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==31) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.06);
                  $("#element_177").val($("#element_168").val()*0.50);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==32) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.14);
                  $("#element_177").val($("#element_168").val()*0.50);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==33) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.08);
                  $("#element_177").val($("#element_168").val()*0.55);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==34) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.3);
                  $("#element_177").val($("#element_168").val()*3.59);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==35) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.48);
                  $("#element_177").val($("#element_168").val()*3.59);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==36) {
                  $("#element_166").val("4");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.354);
                  $("#element_177").val($("#element_168").val()*7.76);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
        }else if (a==37) {
                  $("#element_166").val("4");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.55);
                  $("#element_177").val($("#element_168").val()*7.76);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            
            
            else if (a==38) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.05);
                  $("#element_177").val($("#element_168").val()*0.718);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            
            else if (a==39) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.16);
                  $("#element_177").val($("#element_168").val()*0.00);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==40) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*2.00);
                  $("#element_177").val($("#element_168").val()*30.00);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            
            else if (a==41) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.15);
                  $("#element_177").val($("#element_168").val()*1.87);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==42) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.15);
                  $("#element_177").val($("#element_168").val()*1.87);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==43) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.25);
                  $("#element_177").val($("#element_168").val()*2.866);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==44) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.26);
                  $("#element_177").val($("#element_168").val()*0);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==45) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.2);
                  $("#element_177").val($("#element_168").val()*2.866);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==46) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.12);
                  $("#element_177").val($("#element_168").val()*1.87);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            
            else if (a==47) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.22);
                  $("#element_177").val($("#element_168").val()*1.87);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==48) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*1.4);
                  $("#element_177").val($("#element_168").val()*34);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==49) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.12);
                  $("#element_177").val($("#element_168").val()*1.00);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==50) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.08);
                  $("#element_177").val($("#element_168").val()*1.00);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==51) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.10);
                  $("#element_177").val($("#element_168").val()*1.12);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            
            else if (a==52) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.08);
                  $("#element_177").val($("#element_168").val()*1.12);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            
            else if (a==53) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.05);
                  $("#element_177").val($("#element_168").val()*1.37);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==54) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.03);
                  $("#element_177").val($("#element_168").val()*1.37);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==55) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.09);
                  $("#element_177").val($("#element_168").val()*1.37);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            else if (a==56) {
                  $("#element_166").val("4");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*1.00);
                  $("#element_177").val($("#element_168").val()*7.76);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            
            else if (a==57) {
                  $("#element_166").val("12");
                  $("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.05);
                  $("#element_177").val($("#element_168").val()*0.718);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            } 
            
            //other selection final option
            else if (a==58) {
                  $("#element_166").val("");
                  //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                  $("#element_170").val($("#element_168").val()*0.1);
                  $("#element_177").val($("#element_168").val()*1.00);
                  $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            }else {
                $("#element_170").val("");
                //$("#element_168").val($("#element_167").val()*$("#element_166").val());
                $("#element_170").val($("#element_168").val()*0);
                $("#element_177").val($("#element_168").val()*0);
                $("#element_169").val(parseFloat($("#element_170").val(),10)+parseFloat($("#element_177").val(),10));
            }
            //   $('#element_28').val($('#element_25').val() *$('#element_27').val());
           
        });

//UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 4
        $("#element_191, #element_195, #element_196, #element_197").change(function() {
            var a = $("#element_191").val();
            if (a==4){
                 $("#element_195").val("4");
                 $("#element_197").val($("#element_196").val()*$("#element_195").val());
                 $("#element_203").val($("#element_197").val()*0.55);
                 $("#element_204").val($("#element_197").val()*7.76);
                 $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
                 
            }else if (a==5) {
                  $("#element_195").val("4");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.55);
                  $("#element_204").val($("#element_197").val()*7.76);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==6) {
                  $("#element_195").val("4");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.55);
                  $("#element_204").val($("#element_197").val()*8.40);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==7) {
                  $("#element_195").val("4");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.48);
                  $("#element_204").val($("#element_197").val()*8.40);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==8) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.09);
                  $("#element_204").val($("#element_197").val()*0.718);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==9) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.10);
                  $("#element_204").val($("#element_197").val()*0.937);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==10) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.10);
                  $("#element_204").val($("#element_197").val()*1.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==11) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.14);
                  $("#element_204").val($("#element_197").val()*1.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==12) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.10);
                  $("#element_204").val($("#element_197").val()*1.12);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==13) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.08);
                  $("#element_204").val($("#element_197").val()*1.12);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==14) {
                  $("#element_195").val("3");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*1.1);
                  $("#element_204").val($("#element_197").val()*15.52);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==15) {
                  $("#element_195").val("3");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.75);
                  $("#element_204").val($("#element_197").val()*15.52);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==16) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.48);
                  $("#element_204").val($("#element_197").val()*7.81);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==17) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.25);
                  $("#element_204").val($("#element_197").val()*7.81);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==18) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*3.00);
                  $("#element_204").val($("#element_197").val()*30.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==19) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*1.00);
                  $("#element_204").val($("#element_197").val()*30.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==20) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*2.00);
                  $("#element_204").val($("#element_197").val()*30.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==21) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.15);
                  $("#element_204").val($("#element_197").val()*1.87);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==22) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.10);
                  $("#element_204").val($("#element_197").val()*2.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==23) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.13);
                  $("#element_204").val($("#element_197").val()*2.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==24) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.16);
                  $("#element_204").val($("#element_197").val()*2.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==25) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.20);
                  $("#element_204").val($("#element_197").val()*2.86);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            } 
            
            else if (a==26) {
                  $("#element_195").val("8");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.16);
                  $("#element_204").val($("#element_197").val()*3.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==27) {
                  $("#element_195").val("8");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.14);
                  $("#element_204").val($("#element_197").val()*3.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            } 
            
            else if (a==28) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*2.00);
                  $("#element_204").val($("#element_197").val()*38.80);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==29) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*30);
                  $("#element_204").val($("#element_197").val()*426.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            } 
            
            else if (a==30) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.05);
                  $("#element_204").val($("#element_197").val()*0.50);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            } 
            
            else if (a==31) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.06);
                  $("#element_204").val($("#element_197").val()*0.50);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==32) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.14);
                  $("#element_204").val($("#element_197").val()*0.50);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==33) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.08);
                  $("#element_204").val($("#element_197").val()*0.55);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==34) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.3);
                  $("#element_204").val($("#element_197").val()*3.59);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==35) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.48);
                  $("#element_204").val($("#element_197").val()*3.59);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==36) {
                  $("#element_195").val("4");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.354);
                  $("#element_204").val($("#element_197").val()*7.76);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==37) {
                  $("#element_195").val("4");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.55);
                  $("#element_204").val($("#element_197").val()*7.76);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==38) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.05);
                  $("#element_204").val($("#element_197").val()*0.718);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==39) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.16);
                  $("#element_204").val($("#element_197").val()*0.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==40) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*2.00);
                  $("#element_204").val($("#element_197").val()*30.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==41) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.15);
                  $("#element_204").val($("#element_197").val()*1.87);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==42) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.15);
                  $("#element_204").val($("#element_197").val()*1.87);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==43) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.25);
                  $("#element_204").val($("#element_197").val()*2.866);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==44) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.26);
                  $("#element_204").val($("#element_197").val()*0);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==45) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.2);
                  $("#element_204").val($("#element_197").val()*2.866);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==46) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.12);
                  $("#element_204").val($("#element_197").val()*1.87);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==47) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.22);
                  $("#element_204").val($("#element_197").val()*1.87);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==48) {
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*1.4);
                  $("#element_204").val($("#element_197").val()*34);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==49) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.12);
                  $("#element_204").val($("#element_197").val()*1.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==50) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.08);
                  $("#element_204").val($("#element_197").val()*1.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==51) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.10);
                  $("#element_204").val($("#element_197").val()*1.12);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==52) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.08);
                  $("#element_204").val($("#element_197").val()*1.12);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==53) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.05);
                  $("#element_204").val($("#element_197").val()*1.37);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==54) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.03);
                  $("#element_204").val($("#element_197").val()*1.37);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==55) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.09);
                  $("#element_204").val($("#element_197").val()*1.37);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==56) {
                  $("#element_195").val("4");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*1.00);
                  $("#element_204").val($("#element_197").val()*7.76);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==57) {
                  $("#element_195").val("12");
                  $("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.05);
                  $("#element_204").val($("#element_197").val()*0.718);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else if (a==58) {//other selection final option
                  $("#element_195").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0.1);
                  $("#element_204").val($("#element_197").val()*1.00);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }else {
                  $("#element_203").val("");
                  //$("#element_197").val($("#element_196").val()*$("#element_195").val());
                  $("#element_203").val($("#element_197").val()*0);
                  $("#element_204").val($("#element_197").val()*0);
                  $("#element_202").val(parseFloat($("#element_203").val(),10)+parseFloat($("#element_204").val(),10));
            }
        //   $('#element_28').val($('#element_25').val() *$('#element_27').val());
        
    });

 $("#element_101, #element_156, #element_154, #element_153").change(function() {//product 2
            var a = parseInt($("select#element_101").val());
            if (a==4){
                 $("#element_156").val("4");
                 $("#element_153").val($("#element_154").val()*$("#element_156").val());
                 $("#element_151").val($("#element_153").val()*0.55);
                 $("#element_176").val($("#element_153").val()*7.76);
                 $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
                 
            }else if (a==5) {
                  $("#element_156").val("4");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.55);
                  $("#element_176").val($("#element_153").val()*7.76);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==6) {
                  $("#element_156").val("4");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.55);
                  $("#element_176").val($("#element_153").val()*8.40);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==7) {
                  $("#element_156").val("4");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.48);
                  $("#element_176").val($("#element_153").val()*8.40);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==8) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.09);
                  $("#element_176").val($("#element_153").val()*0.718);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==9) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.10);
                  $("#element_176").val($("#element_153").val()*0.937);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==10) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.10);
                  $("#element_176").val($("#element_153").val()*1.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==11) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.14);
                  $("#element_176").val($("#element_153").val()*1.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==12) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.10);
                  $("#element_176").val($("#element_153").val()*1.12);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==13) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.08);
                  $("#element_176").val($("#element_153").val()*1.12);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==14) {
                  $("#element_156").val("3");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*1.1);
                  $("#element_176").val($("#element_153").val()*15.52);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==15) {
                  $("#element_156").val("3");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.75);
                  $("#element_176").val($("#element_153").val()*15.52);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==16) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.48);
                  $("#element_176").val($("#element_153").val()*7.81);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==17) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.25);
                  $("#element_176").val($("#element_153").val()*7.81);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==18) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*3.00);
                  $("#element_176").val($("#element_153").val()*30.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==19) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*1.00);
                  $("#element_176").val($("#element_153").val()*30.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==20) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*2.00);
                  $("#element_176").val($("#element_153").val()*30.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==21) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.15);
                  $("#element_176").val($("#element_153").val()*1.87);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==22) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.10);
                  $("#element_176").val($("#element_153").val()*2.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==23) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.13);
                  $("#element_176").val($("#element_153").val()*2.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==24) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.16);
                  $("#element_176").val($("#element_153").val()*2.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==25) {
                  $("#element_156").val("");
                 // $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.20);
                  $("#element_176").val($("#element_153").val()*2.86);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==26) {
                  $("#element_156").val("8");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.16);
                  $("#element_176").val($("#element_153").val()*3.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==27) {
                  $("#element_156").val("8");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.14);
                  $("#element_176").val($("#element_153").val()*3.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==28) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*2.00);
                  $("#element_176").val($("#element_153").val()*38.80);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==29) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*30);
                  $("#element_176").val($("#element_153").val()*426.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==30) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.05);
                  $("#element_176").val($("#element_153").val()*0.50);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==31) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.06);
                  $("#element_176").val($("#element_153").val()*0.50);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==32) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.14);
                  $("#element_176").val($("#element_153").val()*0.50);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==33) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.08);
                  $("#element_176").val($("#element_153").val()*0.55);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==34) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.3);
                  $("#element_176").val($("#element_153").val()*3.59);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==35) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.48);
                  $("#element_176").val($("#element_153").val()*3.59);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==36) {
                  $("#element_156").val("4");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.354);
                  $("#element_176").val($("#element_153").val()*7.76);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==37) {
                  $("#element_156").val("4");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.55);
                  $("#element_176").val($("#element_153").val()*7.76);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==38) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.05);
                  $("#element_176").val($("#element_153").val()*0.718);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==39) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.16);
                  $("#element_176").val($("#element_153").val()*0.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==40) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*2.00);
                  $("#element_176").val($("#element_153").val()*30.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==41) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.15);
                  $("#element_176").val($("#element_153").val()*1.87);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==42) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.15);
                  $("#element_176").val($("#element_153").val()*1.87);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==43) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.25);
                  $("#element_176").val($("#element_153").val()*2.866);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==44) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.26);
                  $("#element_176").val($("#element_153").val()*0);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==45) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.2);
                  $("#element_176").val($("#element_153").val()*2.866);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==46) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.12);
                  $("#element_176").val($("#element_153").val()*1.87);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==47) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.22);
                  $("#element_176").val($("#element_153").val()*1.87);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==48) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*1.4);
                  $("#element_176").val($("#element_153").val()*34);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==49) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.12);
                  $("#element_176").val($("#element_153").val()*1.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==50) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.08);
                  $("#element_176").val($("#element_153").val()*1.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==51) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.10);
                  $("#element_176").val($("#element_153").val()*1.12);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==52) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.08);
                  $("#element_176").val($("#element_153").val()*1.12);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==53) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.05);
                  $("#element_176").val($("#element_153").val()*1.37);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==54) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.03);
                  $("#element_176").val($("#element_153").val()*1.37);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==55) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.09);
                  $("#element_176").val($("#element_153").val()*1.37);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==56) {
                  $("#element_156").val("4");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*1.00);
                  $("#element_176").val($("#element_153").val()*7.76);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==57) {
                  $("#element_156").val("12");
                  $("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.05);
                  $("#element_176").val($("#element_153").val()*0.718);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else if (a==58) {
                  $("#element_156").val("");
                  //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0.1);
                  $("#element_176").val($("#element_153").val()*1.00);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }else {
                $("#element_151").val("");
                //$("#element_153").val($("#element_154").val()*$("#element_156").val());
                  $("#element_151").val($("#element_153").val()*0);
                  $("#element_176").val($("#element_153").val()*0);
                  $("#element_150").val(parseFloat($("#element_151").val(),10)+parseFloat($("#element_176").val(),10));
            }   
            //   $('#element_28').val($('#element_25').val() *$('#element_27').val());
            
    });


$("#element_99, #element_159, #element_160, #element_161").change(function() {//UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 1
            var a = parseInt($("#element_99").val());
            switch(a){
                case 4:
                    $("#element_159").val("4");
                     $("#element_161").val($("#element_160").val()*$("#element_159").val());
                     $("#element_163").val($("#element_161").val()*0.55);
                     $("#element_173").val($("#element_161").val()*7.76);
                     $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 5:
                    $("#element_159").val("4");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.55);
                    $("#element_173").val($("#element_161").val()*7.76);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 6:
                    $("#element_159").val("4");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.55);
                    $("#element_173").val($("#element_161").val()*8.40);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 7:
                    $("#element_159").val("4");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.48);
                    $("#element_173").val($("#element_161").val()*8.40);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 8:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.09);
                    $("#element_173").val($("#element_161").val()*0.718);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 9:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.10);
                    $("#element_173").val($("#element_161").val()*0.937);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 10:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.10);
                    $("#element_173").val($("#element_161").val()*1.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 11:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.14);
                    $("#element_173").val($("#element_161").val()*1.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 12:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.10);
                    $("#element_173").val($("#element_161").val()*1.12);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 13:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.08);
                    $("#element_173").val($("#element_161").val()*1.12);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 14:
                    $("#element_159").val("3");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*1.1);
                    $("#element_173").val($("#element_161").val()*15.52);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 15:
                    $("#element_159").val("3");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.75);
                    $("#element_173").val($("#element_161").val()*15.52);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 16:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.48);
                    $("#element_173").val($("#element_161").val()*7.81);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 17:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.25);
                    $("#element_173").val($("#element_161").val()*7.81);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 18:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*3.00);
                    $("#element_173").val($("#element_161").val()*30.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 19:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*1.00);
                    $("#element_173").val($("#element_161").val()*30.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 20:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*2.00);
                    $("#element_173").val($("#element_161").val()*30.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 21:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.15);
                    $("#element_173").val($("#element_161").val()*1.87);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                case 22:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.10);
                    $("#element_173").val($("#element_161").val()*2.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 23:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.13);
                    $("#element_173").val($("#element_161").val()*2.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 24:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.16);
                    $("#element_173").val($("#element_161").val()*2.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 25:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.20);
                    $("#element_173").val($("#element_161").val()*2.86);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 26:
                    $("#element_159").val("8");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.16);
                    $("#element_173").val($("#element_161").val()*3.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 27:
                    $("#element_159").val("8");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.14);
                    $("#element_173").val($("#element_161").val()*3.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 28:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*2.00);
                    $("#element_173").val($("#element_161").val()*38.80);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 29:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*30);
                    $("#element_173").val($("#element_161").val()*426.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 30:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.05);
                    $("#element_173").val($("#element_161").val()*0.50);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 31:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.06);
                    $("#element_173").val($("#element_161").val()*0.50);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 32:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.14);
                    $("#element_173").val($("#element_161").val()*0.50);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 33:
                  $("#element_159").val("");
                  //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                  $("#element_163").val($("#element_161").val()*0.08);
                  $("#element_173").val($("#element_161").val()*0.55);
                  $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 34:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.3);
                    $("#element_173").val($("#element_161").val()*3.59);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 35:
                  $("#element_159").val("");
                  //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                  $("#element_163").val($("#element_161").val()*0.48);
                  $("#element_173").val($("#element_161").val()*3.59);
                  $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 36:
                    $("#element_159").val("4");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.354);
                    $("#element_173").val($("#element_161").val()*7.76);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 37:
                    $("#element_159").val("4");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.55);
                    $("#element_173").val($("#element_161").val()*7.76);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 38:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.05);
                    $("#element_173").val($("#element_161").val()*0.718);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 39:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.16);
                    $("#element_173").val($("#element_161").val()*0.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 40:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*2.00);
                    $("#element_173").val($("#element_161").val()*30.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 41:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.15);
                    $("#element_173").val($("#element_161").val()*1.87);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 42:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.15);
                    $("#element_173").val($("#element_161").val()*1.87);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 43:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.25);
                    $("#element_173").val($("#element_161").val()*2.866);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 44:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.26);
                    $("#element_173").val($("#element_161").val()*0);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 45:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.2);
                    $("#element_173").val($("#element_161").val()*2.866);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 46:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.12);
                    $("#element_173").val($("#element_161").val()*1.87);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 47:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.22);
                    $("#element_173").val($("#element_161").val()*1.87);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 48:
                    $("#element_159").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*1.4);
                    $("#element_173").val($("#element_161").val()*34);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 49:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.12);
                    $("#element_173").val($("#element_161").val()*1.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 50:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.08);
                    $("#element_173").val($("#element_161").val()*1.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 51:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.10);
                    $("#element_173").val($("#element_161").val()*1.12);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 52:   
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.08);
                    $("#element_173").val($("#element_161").val()*1.12);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 53:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.05);
                    $("#element_173").val($("#element_161").val()*1.37);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 54:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.03);
                    $("#element_173").val($("#element_161").val()*1.37);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 55:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.09);
                    $("#element_173").val($("#element_161").val()*1.37);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 56:
                    $("#element_159").val("4");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*1.00);
                    $("#element_173").val($("#element_161").val()*7.76);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 57:
                    $("#element_159").val("12");
                    $("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.05);
                    $("#element_173").val($("#element_161").val()*0.718);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                 case 58:
                    $("#element_159").val("");
                  //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0.1);
                    $("#element_173").val($("#element_161").val()*1.00);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
                default:
                    $("#element_163").val("");
                    //$("#element_161").val($("#element_160").val()*$("#element_159").val());
                    $("#element_163").val($("#element_161").val()*0);
                    $("#element_173").val($("#element_161").val()*0);
                    $("#element_162").val(parseFloat($("#element_163").val(),10)+parseFloat($("#element_173").val(),10));
                break;
            }
            // $('#element_28').val($('#element_25').val() *$('#element_27').val());
    });

 //UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 9
        $("#element_271, #element_275, #element_276, #element_277").change(function() {
            var a = $("#element_271").val();                
            if (a==4){
                  $("#element_275").val("4");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.55);
                  $("#element_284").val($("#element_277").val()*7.76);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==5) {
                  $("#element_275").val("4");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.55);
                  $("#element_284").val($("#element_277").val()*7.76);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==6) {
                  $("#element_275").val("4");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.55);
                  $("#element_284").val($("#element_277").val()*8.40);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==7) {
                  $("#element_275").val("4");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.48);
                  $("#element_284").val($("#element_277").val()*8.40);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==8) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.09);
                  $("#element_284").val($("#element_277").val()*0.718);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==9) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.10);
                  $("#element_284").val($("#element_277").val()*0.937);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==10) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.10);
                  $("#element_284").val($("#element_277").val()*1.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==11) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.14);
                  $("#element_284").val($("#element_277").val()*1.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==12) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.10);
                  $("#element_284").val($("#element_277").val()*1.12);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==13) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.08);
                  $("#element_284").val($("#element_277").val()*1.12);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==14) {
                  $("#element_275").val("3");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*1.1);
                  $("#element_284").val($("#element_277").val()*15.52);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==15) {
                  $("#element_275").val("3");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.75);
                  $("#element_284").val($("#element_277").val()*15.52);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==16) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.48);
                  $("#element_284").val($("#element_277").val()*7.81);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==17) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.25);
                  $("#element_284").val($("#element_277").val()*7.81);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==18) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*3.00);
                  $("#element_284").val($("#element_277").val()*30.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==19) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*1.00);
                  $("#element_284").val($("#element_277").val()*30.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==20) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*2.00);
                  $("#element_284").val($("#element_277").val()*30.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==21) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.15);
                  $("#element_284").val($("#element_277").val()*1.87);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==22) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.10);
                  $("#element_284").val($("#element_277").val()*2.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==23) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.13);
                  $("#element_284").val($("#element_277").val()*2.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==24) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.16);
                  $("#element_284").val($("#element_277").val()*2.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==25) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.20);
                  $("#element_284").val($("#element_277").val()*2.86);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==26) {
                  $("#element_275").val("8");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.16);
                  $("#element_284").val($("#element_277").val()*3.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==27) {
                  $("#element_275").val("8");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.14);
                  $("#element_284").val($("#element_277").val()*3.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==28) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*2.00);
                  $("#element_284").val($("#element_277").val()*38.80);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==29) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*30);
                  $("#element_284").val($("#element_277").val()*426.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==30) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.05);
                  $("#element_284").val($("#element_277").val()*0.50);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==31) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.06);
                  $("#element_284").val($("#element_277").val()*0.50);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==32) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.14);
                  $("#element_284").val($("#element_277").val()*0.50);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==33) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.08);
                  $("#element_284").val($("#element_277").val()*0.55);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==34) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.3);
                  $("#element_284").val($("#element_277").val()*3.59);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==35) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.48);
                  $("#element_284").val($("#element_277").val()*3.59);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==36) {
                  $("#element_275").val("4");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.354);
                  $("#element_284").val($("#element_277").val()*7.76);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==37) {
                  $("#element_275").val("4");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.55);
                  $("#element_284").val($("#element_277").val()*7.76);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==38) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.05);
                  $("#element_284").val($("#element_277").val()*0.718);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==39) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.16);
                  $("#element_284").val($("#element_277").val()*0.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==40) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*2.00);
                  $("#element_284").val($("#element_277").val()*30.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==41) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.15);
                  $("#element_284").val($("#element_277").val()*1.87);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==42) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.15);
                  $("#element_284").val($("#element_277").val()*1.87);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==43) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.25);
                  $("#element_284").val($("#element_277").val()*2.866);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==44) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.26);
                  $("#element_284").val($("#element_277").val()*0);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==45) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.2);
                  $("#element_284").val($("#element_277").val()*2.866);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==46) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.12);
                  $("#element_284").val($("#element_277").val()*1.87);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==47) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.22);
                  $("#element_284").val($("#element_277").val()*1.87);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==48) {
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*1.4);
                  $("#element_284").val($("#element_277").val()*34);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==49) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.12);
                  $("#element_284").val($("#element_277").val()*1.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==50) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.08);
                  $("#element_284").val($("#element_277").val()*1.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==51) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.10);
                  $("#element_284").val($("#element_277").val()*1.12);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==52) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.08);
                  $("#element_284").val($("#element_277").val()*1.12);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==53) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.05);
                  $("#element_284").val($("#element_277").val()*1.37);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==54) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.03);
                  $("#element_284").val($("#element_277").val()*1.37);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==55) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.09);
                  $("#element_284").val($("#element_277").val()*1.37);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==56) {
                  $("#element_275").val("4");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*1.00);
                  $("#element_284").val($("#element_277").val()*7.76);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==57) {
                  $("#element_275").val("12");
                  $("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.05);
                  $("#element_284").val($("#element_277").val()*0.718);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else if (a==58) {//other selection final option
                  $("#element_275").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0.1);
                  $("#element_284").val($("#element_277").val()*1.00);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }else {                
                  $("#element_283").val("");
                  //$("#element_277").val($("#element_276").val()*$("#element_275").val());
                  $("#element_283").val($("#element_277").val()*0);
                  $("#element_284").val($("#element_277").val()*0);
                  $("#element_282").val(parseFloat($("#element_283").val(),10)+parseFloat($("#element_284").val(),10));
            }
        //   $('#element_28').val($('#element_25').val() *$('#element_27').val());
    });

//UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 8
    $("#element_255, #element_259, #element_260, #element_261").change(function() {    
        var a = parseInt($("#element_255").val());
        if (a==4){
             $("#element_259").val("4");
             $("#element_261").val($("#element_260").val()*$("#element_259").val());
             $("#element_267").val($("#element_261").val()*0.55);
             $("#element_268").val($("#element_261").val()*7.76);
             $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
             
        }else if (a==5) {
              $("#element_259").val("4");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.55);
              $("#element_268").val($("#element_261").val()*7.76);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==6) {
              $("#element_259").val("4");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.55);
              $("#element_268").val($("#element_261").val()*8.40);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==7) {
              $("#element_259").val("4");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.48);
              $("#element_268").val($("#element_261").val()*8.40);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==8) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.09);
              $("#element_268").val($("#element_261").val()*0.718);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==9) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.10);
              $("#element_268").val($("#element_261").val()*0.937);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==10) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.10);
              $("#element_268").val($("#element_261").val()*1.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==11) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.14);
              $("#element_268").val($("#element_261").val()*1.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==12) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.10);
              $("#element_268").val($("#element_261").val()*1.12);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==13) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.08);
              $("#element_268").val($("#element_261").val()*1.12);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==14) {
              $("#element_259").val("3");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*1.1);
              $("#element_268").val($("#element_261").val()*15.52);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==15) {
              $("#element_259").val("3");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.75);
              $("#element_268").val($("#element_261").val()*15.52);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==16) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.48);
              $("#element_268").val($("#element_261").val()*7.81);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==17) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.25);
              $("#element_268").val($("#element_261").val()*7.81);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==18) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*3.00);
              $("#element_268").val($("#element_261").val()*30.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==19) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*1.00);
              $("#element_268").val($("#element_261").val()*30.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==20) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*2.00);
              $("#element_268").val($("#element_261").val()*30.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==21) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.15);
              $("#element_268").val($("#element_261").val()*1.87);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==22) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.10);
              $("#element_268").val($("#element_261").val()*2.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==23) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.13);
              $("#element_268").val($("#element_261").val()*2.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==24) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.16);
              $("#element_268").val($("#element_261").val()*2.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==25) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.20);
              $("#element_268").val($("#element_261").val()*2.86);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==26) {
              $("#element_259").val("8");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.16);
              $("#element_268").val($("#element_261").val()*3.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==27) {
              $("#element_259").val("8");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.14);
              $("#element_268").val($("#element_261").val()*3.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==28) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*2.00);
              $("#element_268").val($("#element_261").val()*38.80);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==29) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*30);
              $("#element_268").val($("#element_261").val()*426.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==30) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.05);
              $("#element_268").val($("#element_261").val()*0.50);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==31) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.06);
              $("#element_268").val($("#element_261").val()*0.50);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==32) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.14);
              $("#element_268").val($("#element_261").val()*0.50);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==33) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.08);
              $("#element_268").val($("#element_261").val()*0.55);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==34) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.3);
              $("#element_268").val($("#element_261").val()*3.59);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==35) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.48);
              $("#element_268").val($("#element_261").val()*3.59);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==36) {
              $("#element_259").val("4");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.354);
              $("#element_268").val($("#element_261").val()*7.76);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==37) {
              $("#element_259").val("4");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.55);
              $("#element_268").val($("#element_261").val()*7.76);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==38) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.05);
              $("#element_268").val($("#element_261").val()*0.718);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==39) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.16);
              $("#element_268").val($("#element_261").val()*0.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==40) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*2.00);
              $("#element_268").val($("#element_261").val()*30.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==41) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.15);
              $("#element_268").val($("#element_261").val()*1.87);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==42) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.15);
              $("#element_268").val($("#element_261").val()*1.87);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==43) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.25);
              $("#element_268").val($("#element_261").val()*2.866);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==44) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.26);
              $("#element_268").val($("#element_261").val()*0);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==45) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.2);
              $("#element_268").val($("#element_261").val()*2.866);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==46) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.12);
              $("#element_268").val($("#element_261").val()*1.87);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==47) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.22);
              $("#element_268").val($("#element_261").val()*1.87);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==48) {
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*1.4);
              $("#element_268").val($("#element_261").val()*34);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==49) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.12);
              $("#element_268").val($("#element_261").val()*1.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==50) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.08);
              $("#element_268").val($("#element_261").val()*1.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==51) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.10);
              $("#element_268").val($("#element_261").val()*1.12);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==52) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.08);
              $("#element_268").val($("#element_261").val()*1.12);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==53) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.05);
              $("#element_268").val($("#element_261").val()*1.37);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==54) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.03);
              $("#element_268").val($("#element_261").val()*1.37);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==55) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.09);
              $("#element_268").val($("#element_261").val()*1.37);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==56) {
              $("#element_259").val("4");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*1.00);
              $("#element_268").val($("#element_261").val()*7.76);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==57) {
              $("#element_259").val("12");
              $("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.05);
              $("#element_268").val($("#element_261").val()*0.718);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }else if (a==58) {//other selection final option
              $("#element_259").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0.1);
              $("#element_268").val($("#element_261").val()*1.00);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        } else {    
              $("#element_267").val("");
              //$("#element_261").val($("#element_260").val()*$("#element_259").val());
              $("#element_267").val($("#element_261").val()*0);
              $("#element_268").val($("#element_261").val()*0);
              $("#element_266").val(parseFloat($("#element_267").val(),10)+parseFloat($("#element_268").val(),10));
        }
        //   $('#element_28').val($('#element_25').val() *$('#element_27').val());
    });

//UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 6
    $("#element_223, #element_227, #element_228, #element_229").change(function() {
        var a = $("#element_223").val();
        if (a==4){
             $("#element_227").val("4");
             $("#element_229").val($("#element_228").val()*$("#element_227").val());
             $("#element_235").val($("#element_229").val()*0.55);
             $("#element_236").val($("#element_229").val()*7.76);
             $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
             
        }else if (a==5) {
              $("#element_227").val("4");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.55);
              $("#element_236").val($("#element_229").val()*7.76);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==6) {
              $("#element_227").val("4");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.55);
              $("#element_236").val($("#element_229").val()*8.40);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==7) {
              $("#element_227").val("4");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.48);
              $("#element_236").val($("#element_229").val()*8.40);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==8) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.09);
              $("#element_236").val($("#element_229").val()*0.718);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==9) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.10);
              $("#element_236").val($("#element_229").val()*0.937);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==10) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.10);
              $("#element_236").val($("#element_229").val()*1.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==11) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.14);
              $("#element_236").val($("#element_229").val()*1.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==12) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.10);
              $("#element_236").val($("#element_229").val()*1.12);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==13) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.08);
              $("#element_236").val($("#element_229").val()*1.12);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==14) {
              $("#element_227").val("3");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*1.1);
              $("#element_236").val($("#element_229").val()*15.52);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==15) {
              $("#element_227").val("3");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.75);
              $("#element_236").val($("#element_229").val()*15.52);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==16) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.48);
              $("#element_236").val($("#element_229").val()*7.81);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==17) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.25);
              $("#element_236").val($("#element_229").val()*7.81);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==18) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*3.00);
              $("#element_236").val($("#element_229").val()*30.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==19) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*1.00);
              $("#element_236").val($("#element_229").val()*30.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==20) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*2.00);
              $("#element_236").val($("#element_229").val()*30.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==21) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.15);
              $("#element_236").val($("#element_229").val()*1.87);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==22) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.10);
              $("#element_236").val($("#element_229").val()*2.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==23) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.13);
              $("#element_236").val($("#element_229").val()*2.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==24) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.16);
              $("#element_236").val($("#element_229").val()*2.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==25) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.20);
              $("#element_236").val($("#element_229").val()*2.86);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==26) {
              $("#element_227").val("8");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.16);
              $("#element_236").val($("#element_229").val()*3.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==27) {
              $("#element_227").val("8");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.14);
              $("#element_236").val($("#element_229").val()*3.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==28) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*2.00);
              $("#element_236").val($("#element_229").val()*38.80);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==29) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*30);
              $("#element_236").val($("#element_229").val()*426.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==30) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.05);
              $("#element_236").val($("#element_229").val()*0.50);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==31) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.06);
              $("#element_236").val($("#element_229").val()*0.50);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==32) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.14);
              $("#element_236").val($("#element_229").val()*0.50);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==33) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.08);
              $("#element_236").val($("#element_229").val()*0.55);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==34) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.3);
              $("#element_236").val($("#element_229").val()*3.59);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==35) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.48);
              $("#element_236").val($("#element_229").val()*3.59);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==36) {
              $("#element_227").val("4");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.354);
              $("#element_236").val($("#element_229").val()*7.76);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==37) {
              $("#element_227").val("4");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.55);
              $("#element_236").val($("#element_229").val()*7.76);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==38) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.05);
              $("#element_236").val($("#element_229").val()*0.718);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==39) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.16);
              $("#element_236").val($("#element_229").val()*0.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==40) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*2.00);
              $("#element_236").val($("#element_229").val()*30.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==41) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.15);
              $("#element_236").val($("#element_229").val()*1.87);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==42) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.15);
              $("#element_236").val($("#element_229").val()*1.87);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==43) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.25);
              $("#element_236").val($("#element_229").val()*2.866);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==44) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.26);
              $("#element_236").val($("#element_229").val()*0);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==45) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.2);
              $("#element_236").val($("#element_229").val()*2.866);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==46) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.12);
              $("#element_236").val($("#element_229").val()*1.87);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==47) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.22);
              $("#element_236").val($("#element_229").val()*1.87);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==48) {
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*1.4);
              $("#element_236").val($("#element_229").val()*34);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==49) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.12);
              $("#element_236").val($("#element_229").val()*1.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==50) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.08);
              $("#element_236").val($("#element_229").val()*1.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==51) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.10);
              $("#element_236").val($("#element_229").val()*1.12);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==52) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.08);
              $("#element_236").val($("#element_229").val()*1.12);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==53) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.05);
              $("#element_236").val($("#element_229").val()*1.37);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==54) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.03);
              $("#element_236").val($("#element_229").val()*1.37);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==55) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.09);
              $("#element_236").val($("#element_229").val()*1.37);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==56) {
              $("#element_227").val("4");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*1.00);
              $("#element_236").val($("#element_229").val()*7.76);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==57) {
              $("#element_227").val("12");
              $("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.05);
              $("#element_236").val($("#element_229").val()*0.718);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else if (a==58) {//other selection final option
              $("#element_227").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0.1);
              $("#element_236").val($("#element_229").val()*1.00);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }else {
              $("#element_235").val("");
              //$("#element_229").val($("#element_228").val()*$("#element_227").val());
              $("#element_235").val($("#element_229").val()*0);
              $("#element_236").val($("#element_229").val()*0);
              $("#element_234").val(parseFloat($("#element_235").val(),10)+parseFloat($("#element_236").val(),10));
        }                           //   $('#element_28').val($('#element_25').val() *$('#element_27').val());
    });

//UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 5
   $("#element_207, #element_211, #element_212, #element_213").change(function() {    
        var a = $("#element_207").val();            
        if (a==4){
             $("#element_211").val("4");
             $("#element_213").val($("#element_212").val()*$("#element_211").val());
             $("#element_219").val($("#element_213").val()*0.55);
             $("#element_220").val($("#element_213").val()*7.76);
             $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
        }else if (a==5) {
             $("#element_211").val("4");
             $("#element_213").val($("#element_212").val()*$("#element_211").val());
             $("#element_219").val($("#element_213").val()*0.55);
             $("#element_220").val($("#element_213").val()*7.76);
             $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
        } 
            
            else if (a==6) {
                  $("#element_211").val("4");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.55);
                  $("#element_220").val($("#element_213").val()*8.40);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==7) {
                  $("#element_211").val("4");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.48);
                  $("#element_220").val($("#element_213").val()*8.40);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==8) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.09);
                  $("#element_220").val($("#element_213").val()*0.718);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==9) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.10);
                  $("#element_220").val($("#element_213").val()*0.937);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==10) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.10);
                  $("#element_220").val($("#element_213").val()*1.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==11) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.14);
                  $("#element_220").val($("#element_213").val()*1.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==12) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.10);
                  $("#element_220").val($("#element_213").val()*1.12);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==13) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.08);
                  $("#element_220").val($("#element_213").val()*1.12);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==14) {
                  $("#element_211").val("3");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*1.1);
                  $("#element_220").val($("#element_213").val()*15.52);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==15) {
                  $("#element_211").val("3");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.75);
                  $("#element_220").val($("#element_213").val()*15.52);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==16) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.48);
                  $("#element_220").val($("#element_213").val()*7.81);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==17) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.25);
                  $("#element_220").val($("#element_213").val()*7.81);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==18) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*3.00);
                  $("#element_220").val($("#element_213").val()*30.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==19) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*1.00);
                  $("#element_220").val($("#element_213").val()*30.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==20) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*2.00);
                  $("#element_220").val($("#element_213").val()*30.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==21) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.15);
                  $("#element_220").val($("#element_213").val()*1.87);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==22) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.10);
                  $("#element_220").val($("#element_213").val()*2.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==23) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.13);
                  $("#element_220").val($("#element_213").val()*2.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==24) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.16);
                  $("#element_220").val($("#element_213").val()*2.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==25) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.20);
                  $("#element_220").val($("#element_213").val()*2.86);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==26) {
                  $("#element_211").val("8");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.16);
                  $("#element_220").val($("#element_213").val()*3.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==27) {
                  $("#element_211").val("8");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.14);
                  $("#element_220").val($("#element_213").val()*3.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==28) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*2.00);
                  $("#element_220").val($("#element_213").val()*38.80);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==29) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*30);
                  $("#element_220").val($("#element_213").val()*426.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==30) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.05);
                  $("#element_220").val($("#element_213").val()*0.50);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==31) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.06);
                  $("#element_220").val($("#element_213").val()*0.50);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==32) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.14);
                  $("#element_220").val($("#element_213").val()*0.50);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==33) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.08);
                  $("#element_220").val($("#element_213").val()*0.55);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==34) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.3);
                  $("#element_220").val($("#element_213").val()*3.59);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==35) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.48);
                  $("#element_220").val($("#element_213").val()*3.59);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==36) {
                  $("#element_211").val("4");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.354);
                  $("#element_220").val($("#element_213").val()*7.76);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==37) {
                  $("#element_211").val("4");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.55);
                  $("#element_220").val($("#element_213").val()*7.76);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            
            else if (a==38) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.05);
                  $("#element_220").val($("#element_213").val()*0.718);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==39) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.16);
                  $("#element_220").val($("#element_213").val()*0.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==40) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*2.00);
                  $("#element_220").val($("#element_213").val()*30.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==41) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.15);
                  $("#element_220").val($("#element_213").val()*1.87);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==42) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.15);
                  $("#element_220").val($("#element_213").val()*1.87);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==43) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.25);
                  $("#element_220").val($("#element_213").val()*2.866);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==44) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.26);
                  $("#element_220").val($("#element_213").val()*0);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==45) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.2);
                  $("#element_220").val($("#element_213").val()*2.866);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==46) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.12);
                  $("#element_220").val($("#element_213").val()*1.87);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==47) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.22);
                  $("#element_220").val($("#element_213").val()*1.87);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==48) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*1.4);
                  $("#element_220").val($("#element_213").val()*34);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==49) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.12);
                  $("#element_220").val($("#element_213").val()*1.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==50) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.08);
                  $("#element_220").val($("#element_213").val()*1.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==51) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.10);
                  $("#element_220").val($("#element_213").val()*1.12);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==52) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.08);
                  $("#element_220").val($("#element_213").val()*1.12);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==53) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.05);
                  $("#element_220").val($("#element_213").val()*1.37);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==54) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.03);
                  $("#element_220").val($("#element_213").val()*1.37);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==55) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.09);
                  $("#element_220").val($("#element_213").val()*1.37);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            else if (a==56) {
                  $("#element_211").val("4");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*1.00);
                  $("#element_220").val($("#element_213").val()*7.76);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            
            else if (a==57) {
                  $("#element_211").val("12");
                  $("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.05);
                  $("#element_220").val($("#element_213").val()*0.718);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            } 
            
            //other selection final option
            else if (a==58) {
                  $("#element_211").val("");
                  //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                  $("#element_219").val($("#element_213").val()*0.1);
                  $("#element_220").val($("#element_213").val()*1.00);
                  $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            }else {
                $("#element_219").val("");
                 //$("#element_213").val($("#element_212").val()*$("#element_211").val());
                $("#element_219").val($("#element_213").val()*0);
                $("#element_220").val($("#element_213").val()*0);
                $("#element_218").val(parseFloat($("#element_219").val(),10)+parseFloat($("#element_220").val(),10));
            }
            //$('#element_28').val($('#element_25').val() *$('#element_27').val());
    });

//UNIT PRODUCT SHRINK AND WEIGHT CALCS PROD 10
    $("#element_287, #element_291, #element_292, #element_293").change(function() {
            var a = $("#element_287").val();
            if (a==4){
                 $("#element_291").val("4");
                 $("#element_293").val($("#element_292").val()*$("#element_291").val());
                 $("#element_299").val($("#element_293").val()*0.55);
                 $("#element_300").val($("#element_293").val()*7.76);
                 $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
                 
            }else if (a==5) {
                $("#element_291").val("4");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.55);
                $("#element_300").val($("#element_293").val()*7.76);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==6) {
                $("#element_291").val("4");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.55);
                $("#element_300").val($("#element_293").val()*8.40);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==7) {
                $("#element_291").val("4");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.48);
                $("#element_300").val($("#element_293").val()*8.40);
                 $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==8) {
                $("#element_291").val("12");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.09);
                $("#element_300").val($("#element_293").val()*0.718);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==9) {
                $("#element_291").val("12");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.10);
                $("#element_300").val($("#element_293").val()*0.937);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==10) {
                $("#element_291").val("12");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.10);
                $("#element_300").val($("#element_293").val()*1.00);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==11) {
                $("#element_291").val("12");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.14);
                $("#element_300").val($("#element_293").val()*1.00);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==12) {
                $("#element_291").val("12");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.10);
                $("#element_300").val($("#element_293").val()*1.12);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==13) {
                $("#element_291").val("12");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.08);
                $("#element_300").val($("#element_293").val()*1.12);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==14) {
                $("#element_291").val("3");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*1.1);
                $("#element_300").val($("#element_293").val()*15.52);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==15) {
                $("#element_291").val("3");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.75);
                $("#element_300").val($("#element_293").val()*15.52);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==16) {
                $("#element_291").val("");
                //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.48);
                $("#element_300").val($("#element_293").val()*7.81);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==17) {
                $("#element_291").val("");
                //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.25);
                $("#element_300").val($("#element_293").val()*7.81);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==18) {
                $("#element_291").val("");
                //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*3.00);
                $("#element_300").val($("#element_293").val()*30.00);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==19) {
                $("#element_291").val("");
                //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*1.00);
                $("#element_300").val($("#element_293").val()*30.00);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==20) {
                $("#element_291").val("");
                //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*2.00);
                $("#element_300").val($("#element_293").val()*30.00);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==21) {
                $("#element_291").val("12");
                $("#element_293").val($("#element_292").val()*$("#element_291").val());
                $("#element_299").val($("#element_293").val()*0.15);
                $("#element_300").val($("#element_293").val()*1.87);
                $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==22) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.10);
                  $("#element_300").val($("#element_293").val()*2.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==23) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.13);
                  $("#element_300").val($("#element_293").val()*2.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==24) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.16);
                  $("#element_300").val($("#element_293").val()*2.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==25) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.20);
                  $("#element_300").val($("#element_293").val()*2.86);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==26) {
                  $("#element_291").val("8");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.16);
                  $("#element_300").val($("#element_293").val()*3.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==27) {
                  $("#element_291").val("8");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.14);
                  $("#element_300").val($("#element_293").val()*3.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==28) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*2.00);
                  $("#element_300").val($("#element_293").val()*38.80);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==29) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*30);
                  $("#element_300").val($("#element_293").val()*426.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==30) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.05);
                  $("#element_300").val($("#element_293").val()*0.50);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==31) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.06);
                  $("#element_300").val($("#element_293").val()*0.50);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==32) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.14);
                  $("#element_300").val($("#element_293").val()*0.50);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==33) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.08);
                  $("#element_300").val($("#element_293").val()*0.55);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==34) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.3);
                  $("#element_300").val($("#element_293").val()*3.59);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==35) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.48);
                  $("#element_300").val($("#element_293").val()*3.59);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==36) {
                  $("#element_291").val("4");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.354);
                  $("#element_300").val($("#element_293").val()*7.76);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==37) {
                  $("#element_291").val("4");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.55);
                  $("#element_300").val($("#element_293").val()*7.76);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==38) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.05);
                  $("#element_300").val($("#element_293").val()*0.718);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==39) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.16);
                  $("#element_300").val($("#element_293").val()*0.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==40) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*2.00);
                  $("#element_300").val($("#element_293").val()*30.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==41) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.15);
                  $("#element_300").val($("#element_293").val()*1.87);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==42) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.15);
                  $("#element_300").val($("#element_293").val()*1.87);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==43) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.25);
                  $("#element_300").val($("#element_293").val()*2.866);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==44) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.26);
                  $("#element_300").val($("#element_293").val()*0);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==45) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.2);
                  $("#element_300").val($("#element_293").val()*2.866);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==46) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.12);
                  $("#element_300").val($("#element_293").val()*1.87);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==47) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.22);
                  $("#element_300").val($("#element_293").val()*1.87);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==48) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*1.4);
                  $("#element_300").val($("#element_293").val()*34);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==49) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.12);
                  $("#element_300").val($("#element_293").val()*1.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==50) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.08);
                  $("#element_300").val($("#element_293").val()*1.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==51) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.10);
                  $("#element_300").val($("#element_293").val()*1.12);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==52) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.08);
                  $("#element_300").val($("#element_293").val()*1.12);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==53) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.05);
                  $("#element_300").val($("#element_293").val()*1.37);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==54) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.03);
                  $("#element_300").val($("#element_293").val()*1.37);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==55) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.09);
                  $("#element_300").val($("#element_293").val()*1.37);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==56) {
                  $("#element_291").val("4");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*1.00);
                  $("#element_300").val($("#element_293").val()*7.76);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==57) {
                  $("#element_291").val("12");
                  $("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.05);
                  $("#element_300").val($("#element_293").val()*0.718);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else if (a==58) {
                  $("#element_291").val("");
                  //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0.1);
                  $("#element_300").val($("#element_293").val()*1.00);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }else{
                 $("#element_299").val("");
            //$("#element_293").val($("#element_292").val()*$("#element_291").val());
                  $("#element_299").val($("#element_293").val()*0);
                  $("#element_300").val($("#element_293").val()*0);
                  $("#element_298").val(parseFloat($("#element_299").val(),10)+parseFloat($("#element_300").val(),10));
            }
            //$('#element_28').val($('#element_25').val() *$('#element_27').val());
        });