$(document).ready(function () { 
      $("#element_16").change(function() { 

var x = $('#element_16').val(); 
var a1 = 111;
var a2 = 222;
var a3 = 333; 
var a4 = 444;
var a5 = 555;
//$('#element_17').prop('readonly', true); 

if (x==a1) { 
$('#element_17').val("Arturo");
} 
else if (x==a2) { 
$('#element_17').val("Hector");
}
else if (x==a3) { 
$('#element_17').val("Jorge");
} 
else if (x==a4) { 
$('#element_17').val("Ceasar");
}  
else if (x==a5) { 
$('#element_17').val("Victor");
} else {
$('#element_17').val("Invalid ID");
}
  }); 
  }); 
