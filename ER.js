//$(document).ready(function () {
//      $("#element_9, #element_10").change(function() {
//var result = parseInt($('#element_9').val(), 10) - parseInt($('#element_10').val(), 10);
//var rounded = result.toFixed(2);
//var rounded = Math.round(result * 100000) / 100000;
//           $('#element_11').val(rounded);
//$('#element_11').prop('readonly', true);
//     });
//   });






//MOISTURE
$(document).ready(function () {
      $("#element_40, #element_41, #element_42").change(function() {
//var result = $('#element_40').val() + $('#element_41').val() - $('#element_42').val() / $('#element_41').val();
//var result2 = result - $('#element_42').val();

//var result3 = result2 / $('#element_41').val();

//var rounded = result.toFixed(2);
//var rounded = result;

var one = $('#element_40').val()*1;
var two = $('#element_41').val()*1;
var three = $('#element_42').val()*1;

var first = one + two;
var second = first - three;
var third = second / two;
var fourth = third * 100;
var fifth = fourth.toFixed(3);


          // $('#element_43').val($('#element_40').val() + $('#element_41').val() - $('#element_42').val() / $('#element_41').val());

            $('#element_43').val(fifth);
$('#element_43').prop('readonly', true);
     });
   });




//FAT
$(document).ready(function () {
      $("#element_40, #element_41, #element_42, #element_45, #element_46, #element_47").change(function() {

var one = $('#element_45').val();
var two = $('#element_46').val();
var three = $('#element_47').val();
var four = $('#element_43').val();

var first = three - two;
var second = first / one;
var third = 100 - four;
var fourth = second * third;
var fifth = fourth.toFixed(3);



           $('#element_48').val(fifth);
$('#element_48').prop('readonly', true);
     });
   });




//ASH
$(document).ready(function () {
      $("#element_71, #element_71_1, #element_71_2, #element_51, #element_52, #element_53, #element_43, #element_40, #element_41, #element_42").change(function() {

var one = $('#element_71_1').val();
var two = $('#element_51').val();
var three = $('#element_52').val();
var four = $('#element_53').val();
var five = $('#element_43').val();
var six = $('#element_71_2').val();

var first = four - two;
var second = first / three;
var third = 100 - five;
var fourth = second * third;
var fifth = second * 100;
var sixth = fourth.toFixed(3);
var seventh = fifth.toFixed(3);

if ($('#element_71_1').is(':checked')) {

           $('#element_54').val(seventh);
$('#element_54').prop('readonly', true);

} else if ($('#element_71_2').is(':checked')) {

           $('#element_54').val(sixth);
$('#element_54').prop('readonly', true);

} else {
$('#element_54').val("Select State");
$('#element_54').prop('readonly', true);
}
     });
   });




//PROTEIN
$(document).ready(function () {
      $("#element_56, #element_57, #element_58").change(function() {

var one = $('#element_56').val();
var two = $('#element_57').val();
var three = $('#element_58').val();


var first = two / three;
var second = first * one;

var fifth = second.toFixed(3);



           $('#element_59').val(fifth);
$('#element_59').prop('readonly', true);
     });
   });




//CRUDE FIBER
$(document).ready(function () {
      $("#element_40, #element_41, #element_42, #element_45, #element_46, #element_47, #element_61, #element_62, #element_63").change(function() {

var one = $('#element_61').val(); //sample
var two = $('#element_62').val();  //before
var three = $('#element_63').val();  //after
var four = $('#element_43').val() / 100; //moist
var five = $('#element_48').val() / 100; //fat

var first = two - three;
var second = first - 0.014;
var third = second / one;
var fourth = 1 - four;
var fifth = fourth - five;
var sixth = third * fifth;
var seventh = sixth.toFixed(3) * 100;



           $('#element_64').val(seventh);
$('#element_64').prop('readonly', true);
     });
   });





//MIU
$(document).ready(function () {
      $("#element_66, #element_67").change(function() {


var one = $('#element_66').val()*1;
var two = $('#element_67').val()*1;



var fourth = one + two;
var fifth = (fourth).toFixed(3);


         

            $('#element_68').val(fifth);
$('#element_68').prop('readonly', true);
     });
   });



//FFA
$(document).ready(function () {
      $("#element_70, #element_70_1, #element_70_2, #element_72, #element_73").change(function() {

var one = $('#element_70_1').val();

var three = $('#element_72').val();
var four = $('#element_73').val();

var six = $('#element_70_2').val();

var first = four * 2.82;
var second = first / three;
var third = second * 2;

var sixth = second.toFixed(3);
var seventh = third.toFixed(3);

if ($('#element_70_1').is(':checked')) {

           $('#element_74').val(sixth);
$('#element_54').prop('readonly', true);

} else if ($('#element_70_2').is(':checked')) {

           $('#element_74').val(seventh);
$('#element_54').prop('readonly', true);

} else {
$('#element_74').val("Select State");
$('#element_74').prop('readonly', true);
}
     });
   });



//SOAP
$(document).ready(function () {
      $("#element_78, #element_79").change(function() {


var one = $('#element_78').val();
var two = $('#element_79').val();


var first = two * 304;
var second = first / one;

var fifth = second.toFixed(3);


         

            $('#element_36').val(fifth);
$('#element_36').prop('readonly', true);
     });
   });


//SOAP
$(document).ready(function () {
      $("#element_81, #element_81_1, #element_81_2, #element_81_3").click(function() {
var com = "Completed";
var rej = "Rejected";
var ret = "Pending Retest";

if ($('#element_81_1').is(':checked')) {

           $('#element_3').val(com);


} else if ($('#element_81_2').is(':checked')) {

           $('#element_3').val(rej);


} else if ($('#element_81_3').is(':checked')) {

           $('#element_3').val(ret);

} else {
 $('#element_3').val("Pending");

}

});
   });





