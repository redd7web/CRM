$(document).ready(function () {
      $("#element_1").focus(function() {
           $.get("https://inet.iwpusa.com/grease/enterData.php", function(data, status){
                   alert("Data: " + data + "\nStatus: " + status);
     });
});
