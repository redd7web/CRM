$(document).ready(function () { 
      $("#element_25").change(function() { 
var x = $('#element_25 option:selected').text(); 


var a1 = "WCS"; 
if (x==a1) { 
$("#element_9").val("WCS"); 
} { 
}

var a1 = "TRCS"; 
if (x==a1) { 
$("#element_9").val("TRCS"); 
} { 
}

var a1 = "PIMA CS"; 
if (x==a1) { 
$("#element_9").val("PIMA CS"); 
} { 
}

var a1 = "OTHER"; 
if (x==a1) { 
$("#element_9").val(""); 
} { 
}


        }); 
  }); 
