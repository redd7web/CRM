$(document).ready(function () {
      $("#element_1").focus(function() {
           $.get("https://inet.iwpusa.com/grease/enterData.php", function(data, status){
                   alert("Data: " + data + "\nStatus: " + status);
});
     });
});

//Tech 1
  $(document).ready(function () {
      $("#element_3_1, #element_3_2, #element_3_4, #element_4_1, #element_4_2, #element_4_4").change(function() {

        if ($("#element_3_4").val()=="PM" && $("#element_4_4").val()=="AM") {
              var hour1 = parseInt($("#element_3_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_4_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_3_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_4_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_5").val(g);

            } else if ($("#element_3_4").val()=="AM" && $("#element_4_4").val()=="PM") {
              var hour1 = parseInt($("#element_3_1").val()*60, 10);
              var hour2 = parseInt($("#element_4_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_3_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_4_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_5").val(g);
            } else if ($("#element_3_4").val()=="AM" && $("#element_4_4").val()=="AM" || $("#element_3_4").val()=="PM" && $("#element_4_4").val()=="PM") {
              var hour1 = parseInt($("#element_3_1").val()*60, 10);
              var hour2 = parseInt($("#element_4_1").val()*60, 10);

              var b = parseInt($("#element_3_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_4_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_5").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_3_1, #element_3_2, #element_3_4, #element_4_1, #element_4_2, #element_4_4, #element_9").change(function() {

      $("#element_10").val($("#element_5").val()*$("#element_9").val());

     });
  });

//Tech 2
  $(document).ready(function () {
      $("#element_14_1, #element_14_2, #element_14_4, #element_15_1, #element_15_2, #element_15_4").change(function() {

        if ($("#element_14_4").val()=="PM" && $("#element_15_4").val()=="AM") {
              var hour1 = parseInt($("#element_14_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_15_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_14_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_15_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_16").val(g);

            } else if ($("#element_14_4").val()=="AM" && $("#element_15_4").val()=="PM") {
              var hour1 = parseInt($("#element_14_1").val()*60, 10);
              var hour2 = parseInt($("#element_15_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_14_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_15_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_16").val(g);
            } else if ($("#element_14_4").val()=="AM" && $("#element_15_4").val()=="AM" || $("#element_14_4").val()=="PM" && $("#element_15_4").val()=="PM") {
              var hour1 = parseInt($("#element_14_1").val()*60, 10);
              var hour2 = parseInt($("#element_15_1").val()*60, 10);

              var b = parseInt($("#element_14_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_15_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_16").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_14_1, #element_14_2, #element_14_4, #element_15_1, #element_15_2, #element_15_4, #element_18").change(function() {

      $("#element_19").val($("#element_16").val()*$("#element_18").val());

     });
  });


//Tech 3
  $(document).ready(function () {
      $("#element_22_1, #element_22_2, #element_22_4, #element_23_1, #element_23_2, #element_23_4").change(function() {

        if ($("#element_22_4").val()=="PM" && $("#element_23_4").val()=="AM") {
              var hour1 = parseInt($("#element_22_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_23_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_22_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_23_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_24").val(g);

            } else if ($("#element_22_4").val()=="AM" && $("#element_23_4").val()=="PM") {
              var hour1 = parseInt($("#element_22_1").val()*60, 10);
              var hour2 = parseInt($("#element_23_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_22_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_23_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_24").val(g);
            } else if ($("#element_22_4").val()=="AM" && $("#element_23_4").val()=="AM" || $("#element_22_4").val()=="PM" && $("#element_23_4").val()=="PM") {
              var hour1 = parseInt($("#element_22_1").val()*60, 10);
              var hour2 = parseInt($("#element_23_1").val()*60, 10);

              var b = parseInt($("#element_22_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_23_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_24").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_22_1, #element_22_2, #element_22_4, #element_23_1, #element_23_2, #element_23_4, #element_26").change(function() {

      $("#element_27").val($("#element_24").val()*$("#element_26").val());

     });
  });



//Tech 4
  $(document).ready(function () {
      $("#element_55_1, #element_55_2, #element_55_4, #element_56_1, #element_56_2, #element_56_4").change(function() {

        if ($("#element_55_4").val()=="PM" && $("#element_56_4").val()=="AM") {
              var hour1 = parseInt($("#element_55_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_56_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_55_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_56_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_57").val(g);

            } else if ($("#element_55_4").val()=="AM" && $("#element_56_4").val()=="PM") {
              var hour1 = parseInt($("#element_55_1").val()*60, 10);
              var hour2 = parseInt($("#element_56_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_55_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_56_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_57").val(g);
            } else if ($("#element_55_4").val()=="AM" && $("#element_56_4").val()=="AM" || $("#element_55_4").val()=="PM" && $("#element_56_4").val()=="PM") {
              var hour1 = parseInt($("#element_55_1").val()*60, 10);
              var hour2 = parseInt($("#element_56_1").val()*60, 10);

              var b = parseInt($("#element_55_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_56_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_57").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_55_1, #element_55_2, #element_55_4, #element_56_1, #element_56_2, #element_56_4, #element_59").change(function() {

      $("#element_60").val($("#element_57").val()*$("#element_59").val());

     });
  });




//Tech 5
  $(document).ready(function () {
      $("#element_63_1, #element_63_2, #element_63_4, #element_64_1, #element_64_2, #element_64_4").change(function() {

        if ($("#element_63_4").val()=="PM" && $("#element_64_4").val()=="AM") {
              var hour1 = parseInt($("#element_63_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_64_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_63_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_64_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_65").val(g);

            } else if ($("#element_63_4").val()=="AM" && $("#element_64_4").val()=="PM") {
              var hour1 = parseInt($("#element_63_1").val()*60, 10);
              var hour2 = parseInt($("#element_64_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_63_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_64_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_65").val(g);
            } else if ($("#element_63_4").val()=="AM" && $("#element_64_4").val()=="AM" || $("#element_63_4").val()=="PM" && $("#element_64_4").val()=="PM") {
              var hour1 = parseInt($("#element_63_1").val()*60, 10);
              var hour2 = parseInt($("#element_64_1").val()*60, 10);

              var b = parseInt($("#element_63_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_64_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_65").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_63_1, #element_63_2, #element_63_4, #element_64_1, #element_64_2, #element_64_4, #element_67").change(function() {

      $("#element_68").val($("#element_65").val()*$("#element_67").val());

     });
  });


//Tech 6
  $(document).ready(function () {
      $("#element_71_1, #element_71_2, #element_71_4, #element_72_1, #element_72_2, #element_72_4").change(function() {

        if ($("#element_71_4").val()=="PM" && $("#element_72_4").val()=="AM") {
              var hour1 = parseInt($("#element_71_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_72_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_71_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_72_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_73").val(g);

            } else if ($("#element_71_4").val()=="AM" && $("#element_72_4").val()=="PM") {
              var hour1 = parseInt($("#element_71_1").val()*60, 10);
              var hour2 = parseInt($("#element_72_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_71_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_72_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_73").val(g);
            } else if ($("#element_71_4").val()=="AM" && $("#element_72_4").val()=="AM" || $("#element_71_4").val()=="PM" && $("#element_72_4").val()=="PM") {
              var hour1 = parseInt($("#element_71_1").val()*60, 10);
              var hour2 = parseInt($("#element_72_1").val()*60, 10);

              var b = parseInt($("#element_71_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_72_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_73").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_71_1, #element_71_2, #element_71_4, #element_72_1, #element_72_2, #element_72_4, #element_75").change(function() {

      $("#element_76").val($("#element_73").val()*$("#element_75").val());

     });
  });


//Tech 7
  $(document).ready(function () {
      $("#element_79_1, #element_79_2, #element_79_4, #element_80_1, #element_80_2, #element_80_4").change(function() {

        if ($("#element_79_4").val()=="PM" && $("#element_80_4").val()=="AM") {
              var hour1 = parseInt($("#element_79_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_80_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_79_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_80_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_81").val(g);

            } else if ($("#element_79_4").val()=="AM" && $("#element_80_4").val()=="PM") {
              var hour1 = parseInt($("#element_79_1").val()*60, 10);
              var hour2 = parseInt($("#element_80_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_79_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_80_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_81").val(g);
            } else if ($("#element_79_4").val()=="AM" && $("#element_80_4").val()=="AM" || $("#element_79_4").val()=="PM" && $("#element_80_4").val()=="PM") {
              var hour1 = parseInt($("#element_79_1").val()*60, 10);
              var hour2 = parseInt($("#element_80_1").val()*60, 10);

              var b = parseInt($("#element_79_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_80_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_81").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_79_1, #element_79_2, #element_79_4, #element_80_1, #element_80_2, #element_80_4, #element_83").change(function() {

      $("#element_84").val($("#element_81").val()*$("#element_83").val());

     });
  });


//Tech 8
  $(document).ready(function () {
      $("#element_87_1, #element_87_2, #element_87_4, #element_88_1, #element_88_2, #element_88_4").change(function() {

        if ($("#element_87_4").val()=="PM" && $("#element_88_4").val()=="AM") {
              var hour1 = parseInt($("#element_87_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_88_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_87_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_88_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_89").val(g);

            } else if ($("#element_87_4").val()=="AM" && $("#element_88_4").val()=="PM") {
              var hour1 = parseInt($("#element_87_1").val()*60, 10);
              var hour2 = parseInt($("#element_88_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_87_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_88_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_89").val(g);
            } else if ($("#element_87_4").val()=="AM" && $("#element_88_4").val()=="AM" || $("#element_87_4").val()=="PM" && $("#element_88_4").val()=="PM") {
              var hour1 = parseInt($("#element_87_1").val()*60, 10);
              var hour2 = parseInt($("#element_88_1").val()*60, 10);

              var b = parseInt($("#element_87_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_88_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_89").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_87_1, #element_87_2, #element_87_4, #element_88_1, #element_88_2, #element_88_4, #element_91").change(function() {

      $("#element_92").val($("#element_89").val()*$("#element_91").val());

     });
  });


//Tech 9
  $(document).ready(function () {
      $("#element_95_1, #element_95_2, #element_95_4, #element_96_1, #element_96_2, #element_96_4").change(function() {

        if ($("#element_95_4").val()=="PM" && $("#element_96_4").val()=="AM") {
              var hour1 = parseInt($("#element_95_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_96_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_95_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_96_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_97").val(g);

            } else if ($("#element_95_4").val()=="AM" && $("#element_96_4").val()=="PM") {
              var hour1 = parseInt($("#element_95_1").val()*60, 10);
              var hour2 = parseInt($("#element_96_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_95_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_96_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_97").val(g);
            } else if ($("#element_95_4").val()=="AM" && $("#element_96_4").val()=="AM" || $("#element_95_4").val()=="PM" && $("#element_96_4").val()=="PM") {
              var hour1 = parseInt($("#element_95_1").val()*60, 10);
              var hour2 = parseInt($("#element_96_1").val()*60, 10);

              var b = parseInt($("#element_95_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_96_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_97").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_95_1, #element_95_2, #element_95_4, #element_96_1, #element_96_2, #element_96_4, #element_99").change(function() {

      $("#element_100").val($("#element_97").val()*$("#element_99").val());

     });
  });


//Tech 10
  $(document).ready(function () {
      $("#element_103_1, #element_103_2, #element_103_4, #element_104_1, #element_104_2, #element_104_4").change(function() {

        if ($("#element_103_4").val()=="PM" && $("#element_104_4").val()=="AM") {
              var hour1 = parseInt($("#element_103_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_104_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_103_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_104_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_105").val(g);

            } else if ($("#element_103_4").val()=="AM" && $("#element_104_4").val()=="PM") {
              var hour1 = parseInt($("#element_103_1").val()*60, 10);
              var hour2 = parseInt($("#element_104_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_103_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_104_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_105").val(g);
            } else if ($("#element_103_4").val()=="AM" && $("#element_104_4").val()=="AM" || $("#element_103_4").val()=="PM" && $("#element_104_4").val()=="PM") {
              var hour1 = parseInt($("#element_103_1").val()*60, 10);
              var hour2 = parseInt($("#element_104_1").val()*60, 10);

              var b = parseInt($("#element_103_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_104_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_105").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_103_1, #element_103_2, #element_103_4, #element_104_1, #element_104_2, #element_104_4, #element_107").change(function() {

      $("#element_108").val($("#element_105").val()*$("#element_107").val());

     });
  });


//Tech 11
  $(document).ready(function () {
      $("#element_111_1, #element_111_2, #element_111_4, #element_112_1, #element_112_2, #element_112_4").change(function() {

        if ($("#element_111_4").val()=="PM" && $("#element_112_4").val()=="AM") {
              var hour1 = parseInt($("#element_111_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_112_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_111_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_112_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_113").val(g);

            } else if ($("#element_111_4").val()=="AM" && $("#element_112_4").val()=="PM") {
              var hour1 = parseInt($("#element_111_1").val()*60, 10);
              var hour2 = parseInt($("#element_112_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_111_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_112_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_113").val(g);
            } else if ($("#element_111_4").val()=="AM" && $("#element_112_4").val()=="AM" || $("#element_111_4").val()=="PM" && $("#element_112_4").val()=="PM") {
              var hour1 = parseInt($("#element_111_1").val()*60, 10);
              var hour2 = parseInt($("#element_112_1").val()*60, 10);

              var b = parseInt($("#element_111_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_112_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_113").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_111_1, #element_111_2, #element_111_4, #element_112_1, #element_112_2, #element_112_4, #element_115").change(function() {

      $("#element_116").val($("#element_113").val()*$("#element_115").val());

     });
  });


//Tech 12
  $(document).ready(function () {
      $("#element_119_1, #element_119_2, #element_119_4, #element_120_1, #element_120_2, #element_120_4").change(function() {

        if ($("#element_119_4").val()=="PM" && $("#element_120_4").val()=="AM") {
              var hour1 = parseInt($("#element_119_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_120_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_119_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_120_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_121").val(g);

            } else if ($("#element_119_4").val()=="AM" && $("#element_120_4").val()=="PM") {
              var hour1 = parseInt($("#element_119_1").val()*60, 10);
              var hour2 = parseInt($("#element_120_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_119_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_120_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_121").val(g);
            } else if ($("#element_119_4").val()=="AM" && $("#element_120_4").val()=="AM" || $("#element_119_4").val()=="PM" && $("#element_120_4").val()=="PM") {
              var hour1 = parseInt($("#element_119_1").val()*60, 10);
              var hour2 = parseInt($("#element_120_1").val()*60, 10);

              var b = parseInt($("#element_119_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_120_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_121").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_119_1, #element_119_2, #element_119_4, #element_120_1, #element_120_2, #element_120_4, #element_123").change(function() {

      $("#element_124").val($("#element_121").val()*$("#element_123").val());

     });
  });


//Tech 13
  $(document).ready(function () {
      $("#element_127_1, #element_127_2, #element_127_4, #element_128_1, #element_128_2, #element_128_4").change(function() {

        if ($("#element_127_4").val()=="PM" && $("#element_128_4").val()=="AM") {
              var hour1 = parseInt($("#element_127_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_128_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_127_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_128_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_129").val(g);

            } else if ($("#element_127_4").val()=="AM" && $("#element_128_4").val()=="PM") {
              var hour1 = parseInt($("#element_127_1").val()*60, 10);
              var hour2 = parseInt($("#element_128_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_127_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_128_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_129").val(g);
            } else if ($("#element_127_4").val()=="AM" && $("#element_128_4").val()=="AM" || $("#element_127_4").val()=="PM" && $("#element_128_4").val()=="PM") {
              var hour1 = parseInt($("#element_127_1").val()*60, 10);
              var hour2 = parseInt($("#element_128_1").val()*60, 10);

              var b = parseInt($("#element_127_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_128_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_129").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_127_1, #element_127_2, #element_127_4, #element_128_1, #element_128_2, #element_128_4, #element_131").change(function() {

      $("#element_132").val($("#element_129").val()*$("#element_131").val());

     });
  });


//Tech 14
  $(document).ready(function () {
      $("#element_135_1, #element_135_2, #element_135_4, #element_136_1, #element_136_2, #element_136_4").change(function() {

        if ($("#element_135_4").val()=="PM" && $("#element_136_4").val()=="AM") {
              var hour1 = parseInt($("#element_135_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_136_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_135_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_136_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_137").val(g);

            } else if ($("#element_135_4").val()=="AM" && $("#element_136_4").val()=="PM") {
              var hour1 = parseInt($("#element_135_1").val()*60, 10);
              var hour2 = parseInt($("#element_136_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_135_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_136_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_137").val(g);
            } else if ($("#element_135_4").val()=="AM" && $("#element_136_4").val()=="AM" || $("#element_135_4").val()=="PM" && $("#element_136_4").val()=="PM") {
              var hour1 = parseInt($("#element_135_1").val()*60, 10);
              var hour2 = parseInt($("#element_136_1").val()*60, 10);

              var b = parseInt($("#element_135_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_136_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_137").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_135_1, #element_135_2, #element_135_4, #element_136_1, #element_136_2, #element_136_4, #element_139").change(function() {

      $("#element_140").val($("#element_137").val()*$("#element_139").val());

     });
  });



//Tech 15
  $(document).ready(function () {
      $("#element_143_1, #element_143_2, #element_143_4, #element_144_1, #element_144_2, #element_144_4").change(function() {

        if ($("#element_143_4").val()=="PM" && $("#element_144_4").val()=="AM") {
              var hour1 = parseInt($("#element_143_1").val()*60, 10)+(12*60);
              var hour2 = parseInt($("#element_144_1").val()*60, 10)+(24*60);

              var b = parseInt($("#element_143_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_144_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_145").val(g);

            } else if ($("#element_143_4").val()=="AM" && $("#element_144_4").val()=="PM") {
              var hour1 = parseInt($("#element_143_1").val()*60, 10);
              var hour2 = parseInt($("#element_144_1").val()*60, 10)+(12*60);

              var b = parseInt($("#element_143_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_144_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_145").val(g);
            } else if ($("#element_143_4").val()=="AM" && $("#element_144_4").val()=="AM" || $("#element_143_4").val()=="PM" && $("#element_144_4").val()=="PM") {
              var hour1 = parseInt($("#element_143_1").val()*60, 10);
              var hour2 = parseInt($("#element_144_1").val()*60, 10);

              var b = parseInt($("#element_143_2").val(), 10);
              var c = (hour1+b)/60;

              var e = parseInt($("#element_144_2").val(), 10);
              var f = (hour2+e)/60;

              var g = f-c;

              $("#element_145").val(g);
             

        //var a = parseInt($("#element_3_1").val()*60, 10);
        //var b = parseInt($("#element_3_2").val(), 10);
        //var c = (hour1+b)/60;

        //var d = parseInt($("#element_4_1").val()*60, 10);
        //var e = parseInt($("#element_4_2").val(), 10);
        //var f = (hour2+e)/60;

        //var g = f-c;

        //$("#element_5").val(g);
          }
      });
  });
   

   $(document).ready(function () {
      $("#element_143_1, #element_143_2, #element_143_4, #element_144_1, #element_144_2, #element_144_4, #element_147").change(function() {

      $("#element_148").val($("#element_145").val()*$("#element_147").val());

     });
  });


//Add 1

$(document).ready(function () {
      $("#element_33, #element_34_1, #element_34_2").change(function() {

       // if ($("#element_34_2").is(":empty")){
           // var cc = 0;
           // } else {
                
               // var cc = parseInt($("#element_34_2").val());
                 // }

      //var a = $("#element_34_1").val()*100;
      //var b = parseFloat((a*100), 10);
      //var b2 = $("#element_34_2").val();
      var c = parseInt((($("#element_34_1").val()*100)*1))+parseInt($("#element_34_2").val());
      var d = c/100;
      var e = d;
//.toPrecision(2)
      $("#element_35").val($("#element_33").val()*e);

     });
  });




//Add 2

$(document).ready(function () {
      $("#element_39, #element_40_1, #element_40_2").change(function() {

       // if ($("#element_34_2").is(":empty")){
           // var cc = 0;
           // } else {
                
               // var cc = parseInt($("#element_34_2").val());
                 // }

      //var a = $("#element_34_1").val()*100;
      //var b = parseFloat((a*100), 10);
      //var b2 = $("#element_34_2").val();
      var c = parseInt((($("#element_40_1").val()*100)*1))+parseInt($("#element_40_2").val());
      var d = c/100;
      var e = d;
//.toPrecision(2)
      $("#element_41").val($("#element_39").val()*e);

     });
  });



//Add 3

$(document).ready(function () {
      $("#element_44, #element_45_1, #element_45_2").change(function() {

       // if ($("#element_34_2").is(":empty")){
           // var cc = 0;
           // } else {
                
               // var cc = parseInt($("#element_34_2").val());
                 // }

      //var a = $("#element_34_1").val()*100;
      //var b = parseFloat((a*100), 10);
      //var b2 = $("#element_34_2").val();
      var c = parseInt((($("#element_45_1").val()*100)*1))+parseInt($("#element_45_2").val());
      var d = c/100;
      var e = d;
//.toPrecision(2)
      $("#element_46").val($("#element_44").val()*e);

     });
  });


//TOTAL PROJECT

$(document).ready(function () {
      $("#element_3_1, #element_3_2, #element_3_4, #element_4_1, #element_4_2, #element_4_4, #element_9, #element_14_1, #element_14_2, #element_14_4, #element_15_1, #element_15_2, #element_15_4, #element_18, #element_22_1, #element_22_2, #element_22_4, #element_23_1, #element_23_2, #element_23_4, #element_26, #element_55_1, #element_55_2, #element_55_4, #element_56_1, #element_56_2, #element_56_4, #element_59, #element_63_1, #element_63_2, #element_63_4, #element_64_1, #element_64_2, #element_64_4, #element_67, #element_71_1, #element_71_2, #element_71_4, #element_72_1, #element_72_2, #element_72_4, #element_75, #element_79_1, #element_79_2, #element_79_4, #element_80_1, #element_80_2, #element_80_4, #element_83, #element_87_1, #element_87_2, #element_87_4, #element_88_1, #element_88_2, #element_88_4, #element_91, #element_95_1, #element_95_2, #element_95_4, #element_96_1, #element_96_2, #element_96_4, #element_99, #element_103_1, #element_103_2, #element_103_4, #element_104_1, #element_104_2, #element_104_4, #element_107, #element_111_1, #element_111_2, #element_111_4, #element_112_1, #element_112_2, #element_112_4, #element_115, #element_119_1, #element_119_2, #element_119_4, #element_120_1, #element_120_2, #element_120_4, #element_123, #element_127_1, #element_127_2, #element_127_4, #element_128_1, #element_128_2, #element_128_4, #element_131, #element_135_1, #element_135_2, #element_135_4, #element_136_1, #element_136_2, #element_136_4, #element_139, #element_143_1, #element_143_2, #element_143_4, #element_144_1, #element_144_2, #element_144_4, #element_147, #element_33, #element_34_1, #element_34_2, #element_39, #element_40_1, #element_40_2, #element_44, #element_45_1, #element_45_2").change(function() {
  
var a = $("#element_10").val();
var b = $("#element_19").val();
var c = $("#element_27").val();
var d = $("#element_60").val();
var e = $("#element_68").val();
var f = $("#element_76").val();
var g = $("#element_84").val();
var h = $("#element_92").val();
var i = $("#element_100").val();
var j = $("#element_108").val();
var k = $("#element_116").val();
var l = $("#element_124").val();
var m = $("#element_132").val();
var n = $("#element_140").val();
var o = $("#element_148").val();
var p = $("#element_35").val();
var q = $("#element_41").val();
var r = $("#element_46").val();

if (a === ''){
   var s = "0";
} {
   var s = parseFloat($("#element_10").val());
}

if (b === ''){
   var t = 0;
} {
   var t = parseFloat($("#element_19").val());
}

if (c === ''){
   var u = 0;
} {
   var u = parseFloat($("#element_27").val());
}


if (d === ''){
   var v = 0;
} {
   var v = parseFloat($("#element_60").val());
}


if (e === ''){
   var w = 0;
} {
   var w = parseFloat($("#element_68").val());
}

if (f === ''){
   var x = 0;
} {
   var x = parseFloat($("#element_76").val());
}

if (g === ''){
   var y = 0;
} {
   var y = parseFloat($("#element_84").val());
}

if (h === ''){
   var z = 0;
} {
   var z = parseFloat($("#element_92").val());
}

if (i === ''){
   var aa = 0;
} {
   var aa = parseFloat($("#element_100").val());
}

if (j === ''){
   var bb = 0;
} {
   var bb = parseFloat($("#element_108").val());
}

if (k === ''){
   var cc = 0;
} {
   var cc = parseFloat($("#element_116").val());
}

if (l === ''){
   var dd = 0;
} {
   var dd = parseFloat($("#element_124").val());
}

if (m === ''){
   var ee = 0;
} {
   var ee = parseFloat($("#element_132").val());
}

if (n === ''){
   var ff = 0;
} {
   var ff = parseFloat($("#element_140").val());
}

if (o === ''){
   var gg = 0;
} {
   var gg = parseFloat($("#element_148").val());
}


if (p === ''){
   var hh = 0;
} {
   var hh = parseFloat($("#element_35").val());
}

if (q === ''){
   var ii = 0;
} {
   var ii = parseFloat($("#element_41").val());
}


if (r === ''){
   var jj = 0;
} {
   var jj = parseFloat($("#element_46").val());
}



//

var zz = s+t+u+v+w+x+y+z+aa+bb+cc+dd+ee+ff+gg+hh+ii+jj;
parseFloat($("#element_48").val(zz));


});
});



























         
        
