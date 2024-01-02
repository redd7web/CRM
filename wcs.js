$(document).ready(function () { 
      $("#element_16").change(function() { 
var x = $('#element_16 option:selected').text(); 


var a1 = "Modern Gin"; 
if (x==a1) { 
$("#element_18").val("rosiemgc@aol.com"); 
$("#element_19").val("johncmgc@aol.com"); 
$("#element_20").val("mallet33@frontier.com"); 
$("#element_17").val("307");

}else if (x != "Modern Gin") { 
$("#element_18").val(""); 
$("#element_19").val(""); 
$("#element_17").val("");
$("#element_20").val("");
}





        }); 
  }); 


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
