<?php 

date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
session_start();

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 32347;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
<div id="debug" style="width: 1000px;height:1000px;backround:red;"></div>
<script>
$("document").ready(function(){
      // top_ten[0] is the first , top_ten[9] is the tenth if there is one
      $.post("grab_form32347.php",function(data){
         var top_ten = data.split("<br/>");
         var entries = top_ten.length;
         for(i = 0;i<top_ten.length;i++){
            $("#debug").append(top_ten[i]+"<br/>");
         }
         if(entries >0){//1 entry
            var first = top_ten[0].split('~');//first
                var time = first[0].split(":");
                $("input#element_3_1").val(time[0]);    //time hour
                $("input#element_3_2").val(time[1]);//time minutes
            switch(first[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_4_1").prop("checked", true);
                break;
                case "2":
                    $("#element_4_2").prop("checked", true);
                break;
            }
            $("input#element_5").val(first[2]);
            $("select#element_7").val(first[3]);
            $("select#element_6").val(first[4]);
            $("input#element_81").val(first[5]);
            $("input#element_88").val(first[6]);
            $("input#element_110").val(first[7]);
            $("input#element_37").val(first[8]);
            $("input#element_84").val(first[9]);
         }
         
         
         if(entries >1){//2 entry
            var second = top_ten[1].split('~');//second
                var time2 = second[0].split(":");
                $("input#element_13_1").val(time2[0]);    //time hour
                $("input#element_13_2").val(time2[1]);//time minutes
            switch(second[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_14_1").prop("checked", true);
                break;
                case "2":
                    $("#element_14_2").prop("checked", true);
                break;
            }
            $("input#element_15").val(second[2]);
            $("select#element_16").val(second[3]);
            $("select#element_17").val(second[4]);
            $("input#element_87").val(second[5]);
            $("input#element_82").val(second[6]);
            $("input#element_89").val(second[7]);
            $("input#element_38").val(second[8]);
            $("input#element_90").val(second[9]);
         }
         
         
         if(entries>2){//3 entry
            var third = top_ten[2].split('~');//third
                var time3 = third[0].split(":");
                $("input#element_19_1").val(time3[0]);    //time hour
                $("input#element_19_2").val(time3[1]);//time minutes
            switch(third[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_20_1").prop("checked", true);
                break;
                case "2":
                    $("#element_20_2").prop("checked", true);
                break;
            }
            $("input#element_21").val(third[2]);
            $("select#element_22").val(third[3]);
            $("select#element_23").val(third[4]);
            $("input#element_99").val(third[5]);
            $("input#element_100").val(third[6]);
            $("input#element_83").val(third[7]);
            $("input#element_39").val(third[8]);
            $("input#element_101").val(third[9]);
         }
         
         if(entries>3){//4 entry
            var fourth = top_ten[3].split('~');//fourth
                var time4 = fourth[0].split(":");
                $("input#element_25_1").val(time4[0]);    //time hour
                $("input#element_25_2").val(time4[1]);//time minutes
            switch(fourth[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_26_1").prop("checked", true);
                break;
                case "2":
                    $("#element_26_2").prop("checked", true);
                break;
            }
            $("input#element_27").val(fourth[2]);
            $("select#element_28").val(fourth[3]);
            $("select#element_29").val(fourth[4]);
            $("input#element_102").val(fourth[5]);
            $("input#element_103").val(fourth[6]);
            $("input#element_104").val(fourth[7]);
            $("input#element_40").val(fourth[8]);
            $("input#element_105").val(fourth[9]);
         }
         
         if(entries>4){//5 entry
            var five = top_ten[4].split('~');//fifth
                var time5 = five[0].split(":");
                $("input#element_31_1").val(time5[0]);    //time hour
                $("input#element_31_2").val(time5[1]);//time minutes
            switch(five[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_32_1").prop("checked", true);
                break;
                case "2":
                    $("#element_32_2").prop("checked", true);
                break;
            }
            $("input#element_33").val(five[2]);
            $("select#element_28").val(five[3]);
            $("select#element_35").val(five[4]);
            $("input#element_106").val(five[5]);
            $("input#element_107").val(five[6]);
            $("input#element_108").val(five[7]);
            $("input#element_41").val(five[8]);
            $("input#element_109").val(five[9]);
         }
         
         if(entries>5){//6 entry
            var six = top_ten[4].split('~');//sixth
                var time6 = six[0].split(":");
                $("input#element_42_1").val(time6[0]);    //time hour
                $("input#element_42_2").val(time6[1]);//time minutes
            switch(six[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_43_1").prop("checked", true);
                break;
                case "2":
                    $("#element_43_2").prop("checked", true);
                break;
            }
            $("input#element_44").val(six[2]);
            $("select#element_45").val(six[3]);
            $("select#element_46").val(six[4]);
            $("input#element_111").val(six[5]);
            $("input#element_112").val(six[6]);
            $("input#element_113").val(six[7]);
            $("input#element_47").val(six[8]);
            $("input#element_114").val(six[9]);
         }
         
         if(entries>6){//7 entry
            var seven = top_ten[4].split('~');//seventh
                var time7 = seven[0].split(":");
                $("input#element_48_1").val(time7[0]);    //time hour
                $("input#element_48_2").val(time7[1]);//time minutes
            switch(seven[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_49_1").prop("checked", true);
                break;
                case "2":
                    $("#element_49_2").prop("checked", true);
                break;
            }
            $("input#element_50").val(seven[2]);
            $("select#element_51").val(seven[3]);
            $("select#element_52").val(seven[4]);
            $("input#element_115").val(seven[5]);
            $("input#element_116").val(seven[6]);
            $("input#element_117").val(seven[7]);
            $("input#element_53").val(seven[8]);
            $("input#element_118").val(seven[9]);
         }
         
         if(entries>7){//8 entry
            var eight = top_ten[4].split('~');//eigth
                var time8 = eight[0].split(":");
                $("input#element_54_1").val(time8[0]);    //time hour
                $("input#element_54_2").val(time8[1]);//time minutes
            switch(eight[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_55_1").prop("checked", true);
                break;
                case "2":
                    $("#element_55_2").prop("checked", true);
                break;
            }
            $("input#element_56").val(eight[2]);
            $("select#element_57").val(eight[3]);
            $("select#element_58").val(eight[4]);
            $("input#element_119").val(eight[5]);
            $("input#element_121").val(eight[6]);
            $("input#element_120").val(eight[7]);
            $("input#element_59").val(eight[8]);
            $("input#element_122").val(eight[9]);
         }
         
         if(entries>8){//9 entry
            var nine = top_ten[4].split('~');//ninth
                var time9 = nine[0].split(":");
                $("input#element_60_1").val(time9[0]);    //time hour
                $("input#element_60_2").val(time9[1]);//time minutes
            switch(nine[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_61_1").prop("checked", true);
                break;
                case "2":
                    $("#element_61_2").prop("checked", true);
                break;
            }
            $("input#element_62").val(nine[2]);
            $("select#element_63").val(nine[3]);
            $("select#element_64").val(nine[4]);
            $("input#element_123").val(nine[5]);
            $("input#element_124").val(nine[6]);
            $("input#element_125").val(nine[7]);
            $("input#element_65").val(nine[8]);
            $("input#element_126").val(nine[9]);
         }
         
         if(entries>9){//10 entry
            var ten = top_ten[4].split('~');//tenth
                var time10 = ten[0].split(":");
                $("input#element_66_1").val(time10[0]);    //time hour
                $("input#element_66_2").val(time10[1]);//time minutes
            switch(ten[1]){
                case 0:
                break;
                case "1":                    
                    $("#element_67_1").prop("checked", true);
                break;
                case "2":
                    $("#element_67_2").prop("checked", true);
                break;
            }
            $("input#element_68").val(ten[2]);
            $("select#element_69").val(ten[3]);
            $("select#element_70").val(ten[4]);
            $("input#element_127").val(ten[5]);
            $("input#element_128").val(ten[6]);
            $("input#element_129").val(ten[7]);
            $("input#element_71").val(ten[8]);
            $("input#element_130").val(ten[9]);
         }
      });
});
</script>