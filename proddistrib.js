$(document).ready(function () {
      $("#element_38, #element_39").change(function() {
var result = parseInt($('#element_38').val(), 10) - parseInt($('#element_39').val(), 10);
var rounded = result.toFixed(2);
           $('#element_40').val(rounded);
$('#element_40').prop('readonly', true);
     });
   });
