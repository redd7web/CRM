$(document).ready(function () { 
      $("#element_17").change(function() { 
var x = $('#element_17 option:selected').val(); 


var a1 = "3"; 
if (x==a1) { 
$("#element_15").val("200037"); 
$("#element_13_1").val("4020 Bandini Blvd"); 
$("#element_13_3").val("Los Angeles"); 
$("#element_13_4").val("CA"); 
$("#element_13_5").val("90023"); 
$("#element_13_6 option:selected").text("United States"); 
} { 
}
var a1 = "1"; 
if (x==a1) { 
$("#element_15").val("200113"); 
$("#element_13_1").val("P.O. Box 58725"); 
$("#element_13_3").val("Los Angeles"); 
$("#element_13_4").val("CA"); 
$("#element_13_5").val("90058"); 
$("#element_13_6 option:selected").text("United States"); 
} { 
}

var a1 = "2"; 
if (x==a1) { 
$("#element_15").val("200434"); 
$("#element_13_1").val("5100 Boyle Ave"); 
$("#element_13_3").val("Vernon"); 
$("#element_13_4").val("CA"); 
$("#element_13_5").val("90058"); 
$("#element_13_6 option:selected").text("United States"); 
} { 
}

var a1 = "5"; 
if (x==a1) { 
$("#element_15").val(""); 
$("#element_13_1").val("8600 Ave 54"); 
$("#element_13_3").val("Coachella"); 
$("#element_13_4").val("CA"); 
$("#element_13_5").val("92236"); 
$("#element_13_6 option:selected").text("United States"); 
} { 
}

var a1 = "6"; 
if (x==a1) { 
$("#element_15").val("201212"); 
$("#element_13_1").val("2510 Edward Babe Gomez Ave"); 
$("#element_13_3").val("Omaha"); 
$("#element_13_4").val("NE"); 
$("#element_13_5").val("68107"); 
$("#element_13_6 option:selected").text("United States"); 
} { 
}

var a1 = "7"; 
if (x==a1) { 
$("#element_15").val(""); 
$("#element_13_1").val("4215 Exchange Ave"); 
$("#element_13_3").val("Vernon"); 
$("#element_13_4").val("CA"); 
$("#element_13_5").val("90058"); 
$("#element_13_6 option:selected").text("United States"); 
} { 
}


var a1 = "4"; 
if (x==a1) { 
$("#element_15").val(""); 
$("#element_13_1").val(""); 
$("#element_13_3").val(""); 
$("#element_13_4").val(""); 
$("#element_13_5").val(""); 
$("#element_13_6 option:selected").text(""); 
} { 
}
  }); 
  }); 

//var a1 = "Darling International"; 
//if (x==a1) { 
//$("#element_15").val("200113"); 
//$("#element_13_1").val("P.O. Box 58725"); 
//$("#element_13_3").val("Los Angeles"); 
//$("#element_13_4").val("CA"); 
//$("#element_13_5").val("90058"); 
//$("#element_13_6 option:selected").text("United States"); 
//} { 
//}

//var a1 = "Protein Inc."; 
//if (x==a1) { 
//$("#element_15").val("200434"); 
//$("#element_13_1").val("5100 Boyle Ave"); 
//$("#element_13_3").val("Vernon"); 
//$("#element_13_4").val("CA"); 
//$("#element_13_5").val("90058"); 
//$("#element_13_6 option:selected").text("United States"); 
//} { 
//}

//var a1 = "Protein Inc."; 
//if (x==a1) { 
//$("#element_15").val(""); 
//$("#element_13_1").val(""); 
//$("#element_13_3").val(""); 
//$("#element_13_4").val("CA"); 
//$("#element_13_5").val(""); 
//$("#element_13_6 option:selected").text("United States"); 
//} { 
//}
$(document).ready(function () {
      $("#element_4, #element_36").change(function() {

     
$('#element_37').val($('#element_4').val()-$('#element_36').val());
$('#element_37').prop('readonly', true);
     });
   });

$(document).ready(function () {
      $("#element_22, #element_38").change(function() {

     
$('#element_39').val($('#element_22').val()-$('#element_38').val());
$('#element_39').prop('readonly', true);
     });
   });

$(document).ready(function () {
      $("#element_25, #element_40").change(function() {

     
$('#element_41').val($('#element_22').val()-$('#element_38').val());
$('#element_41').prop('readonly', true);
     });
   });


//Calculate Net for Chicken Skin
$(document).ready(function(){
	$('#element_67, #element_68').change(function(){
	
	var netSkin = $('#element_67').val() - $('#element_68').val();
	$('#element_69').val(netSkin);
	
	});
});


//Total Gross Weight Calculations
$(document).ready(function () {
      $("#element_4, #element_22, #element_25, #element_67").change(function() {

var a = $('#element_4').val()
var b = $('#element_22').val()
var c = $('#element_25').val()
var skinGross = $('element_67').val();

var j = "0";
var k = "0";
var l = "0";
var m = "0";

if (skinGross === ''){
	m = "0";
} else {
	m = parseFloat($('#element_67').val());
}


if (a === '') {
j = "0";
}
else {
j = parseFloat($('#element_4').val());
}

if (b === '') {
k = "0";
}
else {
k = parseFloat($('#element_22').val());
}

if (c === '') {
l = "0";
}
else {
l = parseFloat($('#element_25').val());
}

var total = parseFloat(j) + parseFloat(k) + parseFloat(l) + parseFloat(m);

var rounded = total
   
     
$('#element_35').val(rounded);
$('#element_35').prop('readonly', true);
     });
   });
   
 //Deleted Te seciont over here 
 

//This function calcuates the total number of Totes 
//Added the Chicken skin 8-8-19
$(document).ready(function () {
      $("#element_3, #element_21, #element_26, #element_66").change(function() {

var a = $('#element_3').val();
var b = $('#element_21').val();
var c = $('#element_26').val();
var skinTotes = $('#element_66').val();

var j = "0";
var k = "0";
var l = "0";
var  m = "0";

if (skinTotes === ''){
	m = "0";
} else {
	m = parseFloat($('#element_66').val());
}



if (a === '') {
j = "0";
}
else {
j = parseFloat($('#element_3').val());
}

if (b === '') {
k = "0";
}
else {
k = parseFloat($('#element_21').val());
}

if (c === '') {
l = "0";
}
else {
l = parseFloat($('#element_26').val());
}

var total = parseFloat(j) + parseFloat(k) + parseFloat(l) + parseFloat(m);

var rounded = total;
   
     
$('#element_34').val(rounded);
$('#element_34').prop('readonly', true);
     });
   });




//element_4 is the gross weight of the chicken bone
//_22 is gross weight of delivered meat
//_25 is gross weight of other
//_36 - Tare weight of chx bone
//_38 Gross of meat
//_40 Gross of other

//This function calculates the net total anytime the gross or tares are chagned. 
$(document).ready(function () {
      $("#element_4, #element_22, #element_25, #element_36, #element_38, #element_40, #element_67, #element_68").change(function() {


//The following Variables grab the values for the net weight deliverd. 
//_37 = Chicken bone net
//_39 = Meat Net
//_41 = Other Net
var a = $('#element_37').val();
var b = $('#element_39').val();
var c = $('#element_41').val();
var skinNet = $('#element_69').val();

var j = "0";
var k = "0";
var l = "0";
var m = "0";

if (skinNet === ''){
	m = "0";
} else {
	m = parseFloat($('#element_69').val());
}


if (a === '') {
j = "0";
}
else {
j = parseFloat($('#element_37').val());
}

if (b === '') {
k = "0";
}
else {
k = parseFloat($('#element_39').val());
}

if (c === '') {
l = "0";
}
else {
l = parseFloat($('#element_41').val());
}

var total = parseFloat(j) + parseFloat(k) + parseFloat(l) + parseFloat(m);

var rounded = total
   
 //Calcuates total Net for this delivery 
$('#element_42').val(rounded);
$('#element_42').prop('readonly', true);
     });
   });

