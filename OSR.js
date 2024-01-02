 $(document).ready(function () {
      $("#element_37_1, #element_37_2,#element_37_3, #element_37_4,#element_37_5,#element_37_6, #element_37_7, #element_37_8, #element_37_9, #element_37_10, #element_37_11, #element_37_12, #element_37_13, #element_37_14, #element_37_15, #element_37_16, #element_37_17, #element_37_18, #element_37_19, #element_37_20, #element_37_21,#element_37_22, #element_37_23, #element_37_24, #element_37_25, #element_37_26, #element_37_27, #element_37_28, #element_37_29, #element_37_30, #element_37_31, #element_37_32, #element_37_33").change(function() {
         $("#submit_primary").click();

     });
   });


 $(document).ready(function () {
      $("#element_39_1, #element_39_2,#element_39_3, #element_39_4,#element_39_5,#element_39_6,#element_39_7,#element_39_0").change(function() {
         $("#submit_primary").click();

     });
   });

$(document).ready(function () {
$("#submit_secondary").click(function() {



//session_regenerate_id();

$.get("startover.php", function(data){
//alert("session regenerated!");
location.reload();
});



 });
   });

$(document).ready(function () {
    $("#submit_primary").click(function() {
       // window.print();   
        $("table  tr td:nth_child(2)").each(function () {
            var receipt = $(this).html(); 
            alert(receipt);
        });
    
    });
});

$(document).ready(function () {
    $("#review_submit").click(function() {
        window.print();   
       // $("table  tr td:nth_child(2)").each(function () {
           // var receipt = $(this).html(); 
            //alert(receipt);
        //});
    
    });
});



