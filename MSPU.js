    


$(document).ready(function () { 
    
    
    $("#element_10").change(function(){
        if( $.trim($("#element_46").val()) !='' && $.trim($(this).val())!='' && $.trim($("#element_1_1").val()) !='' && $.trim($("#element_1_2").val()) !='' && $.trim($("#element_1_3").val()) !='' ){
            $.post("get_running_total.php",{driver_id:$(this).val(),delivery_number:$("#element_46").val(),month:$("input#element_1_1").val(),day:$("input#element_1_2").val(),year:$("input#element_1_3").val()},function(data){
                $("input#element_96").val(data);
            });
        }
    });
    
    $("#element_46").change(function(){
        if( $.trim($("#element_10").val()) !='' && $.trim($(this).val()) !='' && $.trim($("#element_1_1").val()) !='' && $.trim($("#element_1_2").val()) !='' && $.trim($("#element_1_3").val()) !='' ){
            $.post("get_running_total.php",{driver_id:$(this).val(),delivery_number:$("#element_46").val(),month:$("input#element_1_1").val(),day:$("input#element_1_2").val(),year:$("input#element_1_3").val()},function(data){
                $("input#element_96").val(data); 
            });
        }
    });
    
    $("input#element_1_1").change(function(){
        if( $.trim($("#element_46").val()) !='' &&  $.trim($("#element_10").val()) !=''  && $.trim($(this).val()) !='' && $.trim($("#element_1_2").val()) !='' && $.trim($("#element_1_3").val()) !='' ){ 
            $.post("get_running_total.php",{driver_id:$(this).val(),delivery_number:$("#element_46").val(),month:$("input#element_1_1").val(),day:$("input#element_1_2").val(),year:$("input#element_1_3").val()},function(data){
                $("input#element_96").val(data); 
            });
        }
    });
    
    $("input#element_1_2").change(function(){
        if( $.trim($("#element_46").val()) !='' &&  $.trim($("#element_10").val()) !=''  && $.trim($(this).val()) !='' && $.trim($("#element_1_1").val()) !='' && $.trim($("#element_1_3").val()) !=''  ){ 
            $.post("get_running_total.php",{driver_id:$(this).val(),delivery_number:$("#element_46").val(),month:$("input#element_1_1").val(),day:$("input#element_1_2").val(),year:$("input#element_1_3").val()},function(data){
                $("input#element_96").val(data); 
            });
        };
    });
    
    $("input#element_1_3").change(function(){
        if( $.trim($("#element_46").val()) !='' &&  $.trim($("#element_10").val()) !=''  && $.trim($(this).val()) !='' && $.trim($("#element_1_2").val()) !='' && $.trim($("#element_1_1").val()) !='' ){ 
            $.post("get_running_total.php",{driver_id:$(this).val(),delivery_number:$("#element_46").val(),month:$("input#element_1_1").val(),day:$("input#element_1_2").val(),year:$("input#element_1_3").val()},function(data){
                $("input#element_96").val(data); 
            });
        }
    });
    
      $("#element_3").change(function() { 
            var x = $('#element_3 option:selected').text();

  var a1 = "Breeders Choice";
  if (x==a1) {
      $("#element_4").val("201295");
      $("#element_5_1").val("16321 Arrow HWY");
      $("#element_5_3").val("Baldwin Park");
      $("#element_5_4").val("CA");
      $("#element_5_5").val("91706");
      $("#element_5_6 option:selected").text("United States");
  } {
  }



var a1 = "Central Garden & Pet";
if (x==a1) {
  $("#element_4").val("201288");
  $("#element_5_1").val("16321 E. Arrow Highway");
  $("#element_5_3").val("Irwindale");
  $("#element_5_4").val("CA");
  $("#element_5_5").val("90631");
  $("#element_5_6 option:selected").text("United States");
} {
}



var a1 = "A-1 Meats"; 
if (x==a1) { 
$("#element_4").val("201291"); 
$("#element_5_1").val("3219 Dufree Ave"); 
$("#element_5_3").val("El Monte"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91732"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}





var a1 = "California Poultry"; 
if (x==a1) { 
$("#element_4").val("200067"); 
$("#element_5_1").val("2932 Garvey Ave"); 
$("#element_5_3").val("Rosemead"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91770"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}




var a1 = "Huxtables"; 
if (x==a1) { 
$("#element_4").val("200225"); 
$("#element_5_1").val("2100 E 49th St"); 
$("#element_5_3").val("Los Angeles"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90058"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "Stearling Pacific"; 
if (x==a1) { 
$("#element_4").val("200482"); 
$("#element_5_1").val("6114 Scott WY."); 
$("#element_5_3").val("Commerce"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90040"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}

var a1 = "Vazquez Foods"; 
if (x==a1) { 
$("#element_4").val("200546"); 
$("#element_5_1").val("2809 E 44th St"); 
$("#element_5_2").val("STE 1"); 
$("#element_5_3").val("Los Angeles"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90058"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("miguela@vazquezfood.com"); 
} { 
}


var a1 = "Everest Meats"; 
if (x==a1) { 
$("#element_4").val("200645"); 
$("#element_5_1").val("1617 E 25th St"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Los Angeles"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90011"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("vbassil@everestmeats.com"); 
} { 
}

var a1 = "King Meat Service"; 
if (x==a1) { 
$("#element_4").val("201253"); 
$("#element_5_1").val("4215 Exchange Ave"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Vernon"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90058"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("AliyaZ@KingInternationalInc.com"); 
} { 
}



var a1 = "TL Foods"; 
if (x==a1) { 
$("#element_4").val("200839"); 
$("#element_5_1").val("507 Coral Ridge Pl."); 
$("#element_5_2").val(""); 
$("#element_5_3").val("La Puente"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91746"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("TLfoods99@yahoo.com");
} { 
}

var a1 = "H & M Poultry"; 
if (x==a1) { 
$("#element_4").val("200655"); 
$("#element_5_1").val("29000 E 44th St"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Vernon"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90058"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("ccpmeat@gmail.com"); 
} { 
}

var a1 = "JT Foods"; 
if (x==a1) { 
$("#element_4").val("200665"); 
$("#element_5_1").val("219 South 3rd Ave"); 
$("#element_5_2").val("unit #4"); 
$("#element_5_3").val("La Puente"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91746"); 
$("#element_5_6 option:selected").text("United States"); 
$("#element_18").val("jtfoods1@yahoo.com");
} { 
}


var a1 = "Del Angel Meats"; 
if (x==a1) { 
$("#element_4").val("200702"); 
$("#element_5_1").val("2508 N Lee Ave"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("South El Monte"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91733"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("DelAngelMeats@gmail.com"); 
} { 
}


var a1 = "Valley Star of Rice Field"; 
if (x==a1) { 
$("#element_4").val("200778"); 
$("#element_5_1").val("14500 E Valley Blvd"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("City of Industry"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91746"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "T & T Foods"; 
if (x==a1) { 
$("#element_4").val("200753"); 
$("#element_5_1").val("3080 E 50th St"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Vernon"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90058"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("masfood@earthlink.net"); 
} { 
}

var a1 = "The 29ers"; 
if (x==a1) { 
$("#element_4").val("200757"); 
$("#element_5_1").val("1784 E Vernon"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Los Angeles"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90058"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("The29ers@bcglobal.com"); 
} { 
}


var a1 = "Great River Foods"; 
if (x==a1) { 
$("#element_4").val("200203"); 
$("#element_5_1").val("19355 E San Jose Ave"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("City of Industry"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91748"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}



var a1 = "Gerrards Market"; 
if (x==a1) { 
$("#element_4").val("200191"); 
$("#element_5_1").val("700 W Cypress"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Redlands"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92373"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "Envolve foods"; 
if (x==a1) { 
$("#element_4").val("200156"); 
$("#element_5_1").val("155 Klud Circle"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Corona"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92880"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}

var a1 = "Adesa International"; 
if (x==a1) { 
$("#element_4").val("200008"); 
$("#element_5_1").val("1440 S Vineyard Ave"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Ontario"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91761"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}



var a1 = "Hot Pollo"; 
if (x==a1) { 
$("#element_4").val("201261"); 
$("#element_5_1").val("1301 S Sunkist Street"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Anaheim"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92806"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "Stater Bros (Big Bear)"; 
if (x==a1) { 
$("#element_4").val("200936"); 
$("#element_5_1").val("92171 Big Bear Blvd"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Big Bear Lake"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92315"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "Valley Star"; 
if (x==a1) { 
$("#element_4").val("200778"); 
$("#element_5_1").val("14500 E. Valley Blvd"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("City of Industry"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91746"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "The Exclusive Poultry, INC"; 
if (x==a1) { 
$("#element_4").val("201246"); 
$("#element_5_1").val("219 South 3rd Ave Unit #4"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("La Puente"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91746"); 
$("#element_5_6 option:selected").text("United States"); 
$("#element_18").val("TheExclusivePoultryINC@gmail.com"); 
} { 
}


var a1 = "Stater Bros (Lake Arrowhead)"; 
if (x==a1) { 
$("#element_4").val("200937"); 
$("#element_5_1").val("28100 State Hwy 189"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Lake Arrowhead"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92352"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}

var a1 = "Star Foods"; 
if (x==a1) { 
$("#element_4").val("200481"); 
$("#element_5_1").val("1433 Miller Dr"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Colton"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92324"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}



var a1 = "Noblesse Global"; 
if (x==a1) { 
$("#element_4").val(""); 
$("#element_5_1").val("3516 E. Olympic Blvd."); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Los Angeles"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("90023"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "RMG"; 
if (x==a1) { 
$("#element_4").val("200531"); 
$("#element_5_1").val("170 N Turner"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Ontario"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91761"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "Pixi Market"; 
if (x==a1) { 
$("#element_4").val("200422"); 
$("#element_5_1").val("17683 San Bernandino"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Fontana"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92335"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}


var a1 = "El Romeo Market"; 
if (x==a1) { 
$("#element_4").val("200147"); 
$("#element_5_1").val("15482 San Bernandino"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Fontana"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92335"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}

var a1 = "Rice Field Corp"; 
if (x==a1) { 
$("#element_4").val("200730"); 
$("#element_5_1").val("14500 E Valley Blvd"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("City of Industry"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("91746"); 
$("#element_5_6 option:selected").text("United States");
$("#element_18").val("wilsontan@ricefieldcorporation.com"); 
} { 
}

var a1 = "CalPremium Treats"; 
if (x==a1) { 
$("#element_4").val("200068"); 
$("#element_5_1").val("20343 Harvill Ave"); 
$("#element_5_2").val(""); 
$("#element_5_3").val("Perris"); 
$("#element_5_4").val("CA"); 
$("#element_5_5").val("92570"); 
$("#element_5_6 option:selected").text("United States"); 
} { 
}



        }); 
  }); 



$(document).ready(function () {
      $("#element_7, #element_19, #element_20, #element_21, #element_22, #element_23,#element_24, #element_25, #element_26, #element_27, #element_28, #element_29, #element_30, #element_31, #element_32, #element_36, #element_37, #element_38, #element_39, #element_40, #element_41, #element_42, #element_43, #element_44, #element_45").change(function() {
      

var a = $('#element_7').val();
var b = $('#element_19').val();
var c = $('#element_20').val();
var d = $('#element_21').val();
var e = $('#element_22').val();
var f = $('#element_23').val();
var g = $('#element_24').val();
var h = $('#element_25').val();
var i = $('#element_26').val();

var s = $('#element_27').val();
var t = $('#element_28').val();
var u = $('#element_29').val();
var v = $('#element_30').val();
var w = $('#element_31').val();
var x = $('#element_32').val();
var y = $('#element_36').val();
var z = $('#element_37').val();
var aa = $('#element_38').val();
var ab = $('#element_39').val();
var ac = $('#element_40').val();


var j = "0";
var k = "0";
var l = "0";
var m = "0";
var n = "0";
var o = "0";
var p = "0";
var q = "0";
var r = "0";

var ad = "0";
var ae = "0";
var af = "0";
var ag = "0";
var ah = "0";
var ai = "0";
var aj = "0";
var ak = "0";
var al = "0";
var am = "0";
var an = "0";
var ao = "0";
var ap = "0";
var aq = "0";
var ar = "0";
var as = "0";

var ba = $('#element_41').val();
var bb = $('#element_42').val();
var bc = $('#element_43').val();
var bd = $('#element_44').val();
var be = $('#element_45').val();

var ca = "0";
var cb = "0";
var cc = "0";
var cd = "0";
var ce = "0";



if (a === '') {
j = "0";
}
else {
j = parseFloat($('#element_7').val());
}

if (b === '') {
k = "0";
}
else {
k = parseFloat($('#element_19').val());
}

if (c === '') {
l = "0";
}
else {
l = parseFloat($('#element_20').val());
}

if (d === '') {
m = "0";
}
else {
m = parseFloat($('#element_21').val());
}

if (e === '') {
n = "0";
}
else {
n = parseFloat($('#element_22').val());
}

if (f === '') {
o = "0";
}
else {
o = parseFloat($('#element_23').val());
}

if (g === '') {
p = "0";
}
else {
p = parseFloat($('#element_24').val());
}

if (h === '') {
q = "0";
}
else {
q = parseFloat($('#element_25').val());
}

if (i === '') {
r = "0";
}
else {
r = parseFloat($('#element_26').val());
}

if (s === '') {
ad = "0";
}
else {
ad = parseFloat($('#element_27').val());
}

if (t === '') {
ae = "0";
}
else {
ae = parseFloat($('#element_28').val());
}

if (u === '') {
af = "0";
}
else {
af = parseFloat($('#element_29').val());
}

if (v === '') {
ag = "0";
}
else {
ag = parseFloat($('#element_30').val());
}

if (w === '') {
ah = "0";
}
else {
ah = parseFloat($('#element_31').val());
}

if (x === '') {
ai = "0";
}
else {
ai = parseFloat($('#element_32').val());
}

if (y === '') {
aj = "0";
}
else {
aj = parseFloat($('#element_36').val());
}

if (z === '') {
ak = "0";
}
else {
ak = parseFloat($('#element_37').val());
}

if (aa === '') {
al = "0";
}
else {
al = parseFloat($('#element_38').val());
}

if (ab === '') {
am = "0";
}
else {
am = parseFloat($('#element_39').val());
}

if (ac === '') {
an = "0";
}
else {
an = parseFloat($('#element_40').val());
}

if (ba === '') {
ca = "0";
}
else {
ca = parseFloat($('#element_41').val());
}

if (bb === '') {
cb = "0";
}
else {
cb = parseFloat($('#element_42').val());
}


if (bc === '') {
cc = "0";
}
else {
cc = parseFloat($('#element_43').val());
}

if (bd === '') {
cd = "0";
}
else {
cd = parseFloat($('#element_44').val());
}

if (be === '') {
ce = "0";
}
else {
ce = parseFloat($('#element_45').val());
}



var total = parseFloat(j) + parseFloat(k) + parseFloat(l) + parseFloat(m) + parseFloat(n) + parseFloat(o) + parseFloat(p) + parseFloat(q) + parseFloat(r) + parseFloat(ad) + parseFloat(ae) + parseFloat(af) + parseFloat(ag) + parseFloat(ah) + parseFloat(ai) + parseFloat(aj) + parseFloat(ak) + parseFloat(al) + parseFloat(am) + parseFloat(an) + parseFloat(ca)  + parseFloat(cb) + parseFloat(cc) + parseFloat(cd) + parseFloat(ce)
var rounded = total;
   
     
$('#element_17').val(rounded);
$('#element_17').prop('readonly', true);
     });
   });





$(document).ready(function () {
      $("#element_52, #element_53, #element_54, #element_55, #element_56, #element_57,#element_58, #element_59, #element_60, #element_61, #element_63, #element_64, #element_65, #element_66, #element_67, #element_68, #element_69, #element_70, #element_71, #element_72").change(function() {
      

var a = $('#element_52').val();
var b = $('#element_53').val();
var c = $('#element_54').val();
var d = $('#element_55').val();
var e = $('#element_56').val();
var f = $('#element_57').val();
var g = $('#element_58').val();
var h = $('#element_59').val();
var i = $('#element_60').val();

var s = $('#element_61').val();
var t = $('#element_63').val();
var u = $('#element_64').val();
var v = $('#element_65').val();
var w = $('#element_66').val();
var x = $('#element_67').val();
var y = $('#element_68').val();
var z = $('#element_69').val();
var aa = $('#element_70').val();
var ab = $('#element_71').val();
var ac = $('#element_72').val();

var ao = $('#element_72').val();
var ap = $('#element_72').val();
var aq = $('#element_72').val();
var ar = $('#element_72').val();
var as = $('#element_72').val();

var at = "0";
var au = "0";
var av = "0";
var aw = "0";
var ax = "0";



var j = "0";
var k = "0";
var l = "0";
var m = "0";
var n = "0";
var o = "0";
var p = "0";
var q = "0";
var r = "0";

var ad = "0";
var ae = "0";
var af = "0";
var ag = "0";
var ah = "0";
var ai = "0";
var aj = "0";
var ak = "0";
var al = "0";
var am = "0";
var an = "0";




if (a === '') {
j = "0";
}
else {
j = parseFloat($('#element_52').val());
}

if (b === '') {
k = "0";
}
else {
k = parseFloat($('#element_53').val());
}

if (c === '') {
l = "0";
}
else {
l = parseFloat($('#element_54').val());
}

if (d === '') {
m = "0";
}
else {
m = parseFloat($('#element_55').val());
}

if (e === '') {
n = "0";
}
else {
n = parseFloat($('#element_56').val());
}

if (f === '') {
o = "0";
}
else {
o = parseFloat($('#element_57').val());
}

if (g === '') {
p = "0";
}
else {
p = parseFloat($('#element_58').val());
}

if (h === '') {
q = "0";
}
else {
q = parseFloat($('#element_59').val());
}

if (i === '') {
r = "0";
}
else {
r = parseFloat($('#element_60').val());
}

if (s === '') {
ad = "0";
}
else {
ad = parseFloat($('#element_61').val());
}

if (t === '') {
ae = "0";
}
else {
ae = parseFloat($('#element_63').val());
}

if (u === '') {
af = "0";
}
else {
af = parseFloat($('#element_64').val());
}

if (v === '') {
ag = "0";
}
else {
ag = parseFloat($('#element_65').val());
}

if (w === '') {
ah = "0";
}
else {
ah = parseFloat($('#element_66').val());
}

if (x === '') {
ai = "0";
}
else {
ai = parseFloat($('#element_67').val());
}

if (y === '') {
aj = "0";
}
else {
aj = parseFloat($('#element_68').val());
}

if (z === '') {
ak = "0";
}
else {
ak = parseFloat($('#element_69').val());
}

if (aa === '') {
al = "0";
}
else {
al = parseFloat($('#element_70').val());
}

if (ab === '') {
am = "0";
}
else {
am = parseFloat($('#element_71').val());
}

if (ac === '') {
an = "0";
}
else {
an = parseFloat($('#element_72').val());
}

//if (ao === '') {
//at = "0";
//}
//else {
//at = parseFloat($('#element_41').val());
//}

//if (az === '') {
//ay = "0";
//}
//else {
//ay = parseFloat($('#element_42').val());
//}


//if (af === '') {
//aq = "0";
//}
//else {
//aq = parseFloat($('#element_43').val());
//}

//if (ag === '') {
//ar = "0";
//}
//else {
//ar = parseFloat($('#element_44').val());
//}

//if (ah === '') {
//as = "0";
//}
//else {
//as = parseFloat($('#element_45').val());
//}



var total = parseFloat(j) + parseFloat(k) + parseFloat(l) + parseFloat(m) + parseFloat(n) + parseFloat(o) + parseFloat(p) + parseFloat(q) + parseFloat(r) + parseFloat(ad) + parseFloat(ae) + parseFloat(af) + parseFloat(ag) + parseFloat(ah) + parseFloat(ai) + parseFloat(aj) + parseFloat(ak) + parseFloat(al) + parseFloat(am) + parseFloat(an)
// + parseFloat(ao)  + parseFloat(ap) + parseFloat(aq) + parseFloat(ar) + parseFloat(as)
var rounded = total;
   
  $('#element_73').val(rounded);   
//$('#element_73').val(parseFloat($('#element_52').val())+parseFloat($('#element_53').val()));
$('#element_73').prop('readonly', true);


     });
   });























































