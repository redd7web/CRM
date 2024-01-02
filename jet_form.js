$(document).ready(function () {
      $("#element_6_1, #element_6_2, #element_6_3, #element_7_1, #element_7_2, #element_7_3").change(function() {
      

var a = parseFloat($('#element_6_1').val());
var b = parseFloat($('#element_6_2').val())/60;
var c = parseFloat($('#element_7_1').val());
var d = parseFloat($('#element_7_2').val())/60;


var one = a+b;
var two = c+d;


$('#element_8').val(two-one);
 });
   });


$(document).ready(function () {
      $("#element_19_1, #element_19_2, #element_19_3, #element_20_1, #element_20_2, #element_20_3").change(function() {
      

var a = parseFloat($('#element_19_1').val());
var b = parseFloat($('#element_19_2').val())/60;
var c = parseFloat($('#element_20_1').val());
var d = parseFloat($('#element_20_2').val())/60;


var one = a+b;
var two = c+d;


$('#element_21').val(two-one);
 });
   });


$(document).ready(function () {
      $("#element_24_1, #element_24_2, #element_24_3, #element_23_1, #element_23_2, #element_23_3").change(function() {
      

var a = parseFloat($('#element_24_1').val());
var b = parseFloat($('#element_24_2').val())/60;
var c = parseFloat($('#element_23_1').val());
var d = parseFloat($('#element_23_2').val())/60;


var one = a+b;
var two = c+d;


$('#element_25').val(two-one);
 });
   });



$(document).ready(function () {
      $("#element_6_1, #element_6_2, #element_6_3, #element_7_1, #element_7_2, #element_7_3, #element_19_1, #element_19_2, #element_19_3, #element_20_1, #element_20_2, #element_20_3, #element_24_1, #element_24_2, #element_24_3, #element_23_1, #element_23_2, #element_23_3, #element_30_1, #element_31").change(function() {



var a = $('#element_8').val();
var b = $('#element_21').val();
var c = $('#element_25').val();


var j = "0";
var k = "0";
var l = "0";

if (a === '') {
j = "0";
}
else {
j = parseFloat($('#element_8').val());
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
l = parseFloat($('#element_25').val());
}

var total = parseFloat(j) + parseFloat(k) + parseFloat(l);


var rounded = total;

$('#element_10').val(rounded);
$('#element_10').prop('readonly', true);

var hours = $('#element_10').val();

var hourly = hours*125;

var price = 0;

var flat = $('#element_30_1').val();

var fee = $('#element_31').val();

if (flat>0) {
price = fee;
} else if (hourly>275) {
price = hourly;
} else {
price = 275;
}


$('#element_12').val(price);
     });
   });



