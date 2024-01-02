<?php 

date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
session_start();

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 32241;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
<div id="debug" style="width: 1000px;height:1000px;backround:red;"></div>
<script>
$("document").ready(function(){
      // top_ten[0] is the first , top_ten[9] is the tenth if there is one
    
    
   $.post("grab_form32241.php",function(data){
         
       var top_ten = data.split("<br/>");
       var entries = top_ten.length;
       
       for(i = 0;i<top_ten.length;i++){
            $("#debug").append(top_ten[i]+"<br/>");
       }
       if(entries >0){// 1 minimum
            var first = top_ten[0].split('~');//first
            var time = first[1].split(":");
            $("input#element_3_1").val(time[0]);    //time hour
            $("input#element_3_2").val(time[1]);//time minutes
            if(time[0]<12){
                $("#element_3_4").val("AM");//assuming military less than 12 is am
            }else {
                $("#element_3_4").val("PM");
            }
            
            $("input#element_5").val(first[2]);//gallons
            $("#element_7").val(first[3]);//product (select)
            $("#element_6").val(first[4]);// destination
            $("input#element_37").val(first[5])//initials
           
            switch(first[6]){
                case 0:
                break;
                case "1":                    
                    $("#element_4_1").prop("checked", true);
                break;
                case "2":
                    $("#element_4_2").prop("checked", true);
                break;
            }
            
        } 
        
        if(entries>1){//2 minimum
            var second = top_ten[1].split('~');//second
            var time_for_second = second[1].split(":");
            $("input#element_13_1").val(time_for_second[0]);//time hour second 
            $("input#element_13_2").val(time_for_second[1])// time minutes second
            if(time_for_second[0]<12){
                $("#element_13_4").val("AM");
            }else{
                $("#element_13_4").val("PM");
            }
            $("input#element_15").val(second[2]);//gallons for second
            $("#element_16").val(second[3]);//product
            $("#element_17").val(second[4]);//destination
            $("input#element_38").val(second[5]);//initials
            switch(second[6]){
                case 0:
                break;
                case "1":
                    $("#element_14_1").prop("checked", true);
                break;
                case "2":
                    $("#element_14_2").prop("checked", true);
                break;
            }
        }
        
        if(entries >2){ //3 minimum
            var third = top_ten[2].split("~");//third
            var time_for_third = third[1].split(":");
            $("input#element_19_1").val(time_for_third[0]);//time hour third
            $("input#element_19_2").val(time_for_third[1]);//time minutes third
            if(time_for_third[0]<12){
                $("#element_19_4").val("AM");
            }else{
                $("#element_19_4").val("PM");
            }
            $("input#element_21").val(third[2]);//gallons for third
            $("#element_22").val(third[3]);//products
            $("#element_23").val(third[4]);//destination
            $("input#element_39").val(third[5]);//initials
            switch(third[6]){
                case 0:
                break;
                case "1":
                    $("#element_20_1").prop("checked", true);
                break;
                case "2":
                    $("#element_20_2").prop("checked", true);
                break;
            }
        }
        
        if(entries >3){ // 4 minimum
            var fourth = top_ten[3].split("~");//fourth
            var time_for_fourth = fourth[1].split(":");
            $("input#element_25_1").val(time_for_fourth[0]);//time hour fourth
            $("input#element_25_2").val(time_for_fourth[1]);//time minutes fourth
            if(time_for_fourth[0]<12){
                $("#element_25_4").val("AM");
            }else{
                $("#element_25_4").val("PM");
            }
            $("input#element_27").val(fourth[2]);//gallons for fourth
            $("#element_28").val(fourth[3]);//products
            $("#element_29").val(fourth[4]);//destination
            $("input#element_40").val(fourth[5]);//initials
            switch(fourth[6]){
                case 0:
                break;
                case "1":
                    $("#element_26_1").prop("checked", true);
                break;
                case "2":
                    $("#element_26_1").prop("checked", true);
                break;
            }
        }
        
        if(entries >4){ // 5 minimum
            var fifth = top_ten[4].split("~");//fifth
            var time_for_fifth = fifth[1].split(":");
            $("input#element_31_1").val(time_for_fifth[0]);//time hour fifth
            $("input#element_31_2").val(time_for_fifth[1]);//time minutes fifth
            if(time_for_fifth[0]<12){
                $("#element_31_4").val("AM");
            }else{
                $("#element_31_4").val("PM");
            }
            $("input#element_33").val(fifth[2]);//gallons for fifth
            $("#element_34").val(fifth[3]);//products
            $("#element_35").val(fifth[4]);//destination
            $("input#element_41").val(fifth[5]);//initials
            switch(fifth[6]){
                case 0:
                break;
                case "1":
                    $("#element_32_1").prop("checked", true);
                break;
                case "2":
                    $("#element_32_2").prop("checked", true);
                break;
            }
        }
        if(entries >5){ // 6 minimum //***************** Change element placement********************// 
            var sixth = top_ten[5].split("~");//fifth
            var time_for_sixth = sixth[1].split(":");
            $("input#element_42_1").val(time_for_sixth[0]);//time hour sixth
            $("input#element_42_2").val(time_for_sixth[1]);//time minutes sixth
            if(time_for_sixth[0]<12){
                $("#element_42_4").val("AM");
            }else{
                $("#element_42_4").val("PM");
            }
            $("input#element_44").val(sixth[2]);//gallons for sixth
            $("#element_45").val(sixth[3]);//products
            $("#element_46").val(sixth[4]);//destination
            $("input#element_47").val(sixth[5]);//initials
            switch(sixth[6]){
                case 0:
                break;
                case "1":
                    $("#element_43_1").prop("checked", true);
                break;
                case "2":
                    $("#element_43_2").prop("checked", true);
                break;
            }
        }
        if(entries >6){ // 7 minimum

            var seventh = top_ten[6].split("~");//fifth
            var time_for_seventh = sixth[1].split(":");
            $("input#element_48_1").val(time_for_seventh[0]);//time hour sixth
            $("input#element_48_2").val(time_for_seventh[1]);//time minutes sixth
            if(time_for_seventh[0]<12){
                $("#element_48_4").val("AM");
            }else{
                $("#element_48_4").val("PM");
            }
            $("input#element_50").val(seventh[2]);//gallons for sixth
            $("#element_51").val(seventh[3]);//products
            $("#element_52").val(seventh[4]);//destination
            $("input#element_53").val(seventh[5]);//initials
            switch(seventh[6]){
                case 0:
                break;
                case "1":
                    $("#element_49_1").prop("checked", true);
                break;
                case "2":
                    $("#element_49_2").prop("checked", true);
                break;
            }
            
        }
        if(entries >7){ // 8 minimum

             var eighth = top_ten[7].split("~");//fifth
            var time_for_eighth = eighth[1].split(":");
            $("input#element_54_1").val(time_for_eighth[0]);//time hour sixth
            $("input#element_54_2").val(time_for_eighth[1]);//time minutes sixth
            if(time_for_eighth[0]<12){
                $("#element_54_4").val("AM");
            }else{
                $("#element_54_4").val("PM");
            }
            $("input#element_56").val(eighth[2]);//gallons for sixth
            $("#element_57").val(eighth[3]);//products
            $("#element_58").val(eighth[4]);//destination
            $("input#element_59").val(eighth[5]);//initials
            switch(eighth[6]){
                case 0:
                break;
                case "1":
                    $("#element_55_1").prop("checked", true);
                break;
                case "2":
                    $("#element_55_2").prop("checked", true);
                break;
            }
            
        }
        if(entries >8){ // 9 minimum

           var nineth = top_ten[8].split("~");//fifth
            var time_for_nineth = nineth[1].split(":");
            $("input#element_60_1").val(time_for_nineth[0]);//time hour sixth
            $("input#element_60_2").val(time_for_nineth[1]);//time minutes sixth
            if(time_for_nineth[0]<12){
                $("#element_60_4").val("AM");
            }else{
                $("#element_60_4").val("PM");
            }
            $("input#element_62").val(nineth[2]);//gallons for sixth
            $("#element_63").val(nineth[3]);//products
            $("#element_64").val(nineth[4]);//destination
            $("input#element_65").val(nineth[5]);//initials
            switch(nineth[6]){
                case 0:
                break;
                case "1":
                    $("#element_61_1").prop("checked", true);
                break;
                case "2":
                    $("#element_61_2").prop("checked", true);
                break;
            }
        }
        if(entries >9){ // 10 minimum

          var tenth = top_ten[9].split("~");//fifth
            var time_for_tenth = tenth[1].split(":");
            $("input#element_66_1").val(time_for_tenth[0]);//time hour sixth
            $("input#element_66_2").val(time_for_tenth[1]);//time minutes sixth
            if(time_for_tenth[0]<12){
                $("#element_66_4").val("AM");
            }else{
                $("#element_66_4").val("PM");
            }
            $("input#element_68").val(tenth[2]);//gallons for sixth
            $("#element_69").val(tenth[3]);//products
            $("#element_70").val(tenth[4]);//destination
            $("input#element_71").val(tenth[5]);//initials
            switch(tenth[6]){
                case 0:
                break;
                case "1":
                    $("#element_67_1").prop("checked", true);
                break;
                case "2":
                    $("#element_67_2").prop("checked", true);
                break;
            }
        }
   }); 
});

   

</script>
