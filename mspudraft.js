

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
var ad = $('#element_41').val();
var ae = $('#element_42').val();
var af = $('#element_43').val();
var ag = $('#element_44').val();
var ah = $('#element_45').val();

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

if (ad === '') {
ao = "0";
}
else {
ao = parseFloat($('#element_41').val());
}



var total = parseFloat(j) + parseFloat(k) + parseFloat(l) + parseFloat(m) + parseFloat(n) + parseFloat(o) + parseFloat(p) + parseFloat(q) + parseFloat(r) + parseFloat(ad) + parseFloat(ae) + parseFloat(af) + parseFloat(ag) + parseFloat(ah) + parseFloat(ai) + parseFloat(aj) + parseFloat(ak) + parseFloat(al) + parseFloat(am) + parseFloat(an)

var rounded = total;
   
     
$('#element_17').val(rounded);
$('#element_17').prop('readonly', true);
     });
   });

var a = $('#element_4').val();
var b = $('#element_22').val();
var c = $('#element_25').val();

if (a === '') {
a = "0";
}
else {
a = parseFloat($('#element_4').val());
}
if (b === '') {
b = "0";
}
else {
b = parseFloat($('#element_22').val());
}
if (c === '') {
a = "0";
}
else {
c = parseFloat($('#element_25').val());
}
var total = parseFloat(a) + parseFloat(b) + parseFloat(c);     







$(document).ready(function () {
      $("#element_25, #element_4, #element_22").change(function() {

var a = $('#element_4').val();
var b = $('#element_22').val();
var c = $('#element_25').val();

if (a === '') {
a = "0";
}
else {
a = parseInt($('#element_4').val(), 10);
}
if (b === '') {
b = "0";
}
else {
b = parseInt($('#element_22').val(), 10);
}
if (c === '') {
a = "0";
}
else {
c = parseInt($('#element_25').val(),10);
}
var total = (parseFloat(a) + parseFloat(b) + parseFloat(c));     

//parseFloat(a) + parseFloat(b) + parseFloat(c)
$('#element_35').val(total);
$('#element_35').prop('readonly', true);
     });
   });
//parseFloat($("#element_4").val())+parseFloat($("#element_22").val())+parseFloat($("#element_25").val())


