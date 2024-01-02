<?php 

date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
session_start();

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 33088;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
<div id="debug"></div>
<script>
$("document").ready(function(){
   $.post("grab_form33088.php",function(data){
        var top_ten = data.split("<br/>");
         var entries = top_ten.length;
         for(i = 0;i<top_ten.length;i++){
            $("#debug").append(top_ten[i]+"<br/>");
         }
         
         if(entries>0){//1 minimum
            var first = top_ten[0].split('~');//first
            var time = first[0].split(":");
            $("input#element_3_1").val(time[0]);    //time hour
            $("input#element_3_2").val(time[1]);//time minutes
            $("input#element_5").val(first[1]);
            $("select#element_7").val(first[2]);
            $("select#element_80").val(first[3]);
            $("select#element_6").val(first[4]);
            $("#element_37").val(first[5]);
         }
         
         if(entries>1){//2 minimum
            var second = top_ten[1].split("~")//second
            var time2 = second[0].split(":");
            $("input#element_13_1").val(time2[0]);    //time hour
            $("input#element_13_2").val(time2[1]);//time minutes
            $("input#element_15").val(second[1]);
            $("select#element_16").val(second[2]);
            $("select#element_82").val(second[3]);
            $("select#element_17").val(second[4]);
            $("#element_38").val(second[5]);
         }
         
         if(entries>2){//3 minimum
            var third = top_ten[2].split("~")//third
            var time3 = third[0].split(":");
            $("input#element_19_1").val(time3[0]);    //time hour
            $("input#element_19_2").val(time3[1]);//time minutes
            $("input#element_21").val(third[1]);
            $("select#element_22").val(third[2]);
            $("select#element_84").val(third[3]);
            $("select#element_23").val(third[4]);
            $("#element_39").val(third[5]);
         }
         
         if(entries>3){//4 minimum
            var fourth = top_ten[3].split("~")//fourth
            var time4 = fourth[0].split(":");
            $("input#element_25_1").val(time4[0]);    //time hour
            $("input#element_25_2").val(time4[1]);//time minutes
            $("input#element_27").val(fourth[1]);
            $("select#element_28").val(fourth[2]);
            $("select#element_86").val(fourth[3]);
            $("select#element_29").val(fourth[4]);
            $("#element_40").val(fourth[5]);
         }
         
         if(entries>4){//5 minimum
            var fifth = top_ten[4].split("~")//fifth
            var time5 = fifth[0].split(":");
            $("input#element_31_1").val(time5[0]);    //time hour
            $("input#element_31_2").val(time5[1]);//time minutes
            $("input#element_33").val(fifth[1]);
            $("select#element_34").val(fifth[2]);
            $("select#element_88").val(fifth[3]);
            $("select#element_35").val(fifth[4]);
            $("#element_41").val(fifth[5]);
         }
         
         if(entries>5){//6 minimum
            var sixth = top_ten[5].split("~")//sixth
            var time6 = sixth[0].split(":");
            $("input#element_42_1").val(time6[0]);    //time hour
            $("input#element_42_2").val(time6[1]);//time minutes
            $("input#element_44").val(sixth[1]);
            $("select#element_45").val(sixth[2]);
            $("select#element_90").val(sixth[3]);
            $("select#element_46").val(sixth[4]);
            $("#element_47").val(sixth[5]);
         }
         
         if(entries>6){//7 minimum
            var seventh = top_ten[6].split("~")//seventh
            var time7 = seventh[0].split(":");
            $("input#element_48_1").val(time7[0]);    //time hour
            $("input#element_48_2").val(time7[1]);//time minutes
            $("input#element_50").val(seventh[1]);
            $("select#element_51").val(seventh[2]);
            $("select#element_92").val(seventh[3]);
            $("select#element_52").val(seventh[4]);
            $("#element_53").val(seventh[5]);
         }
         
         if(entries>7){//8 minimum
            var eight = top_ten[7].split("~")//eight
            var time8 = eight[0].split(":");
            $("input#element_54_1").val(time8[0]);    //time hour
            $("input#element_54_2").val(time8[1]);//time minutes
            $("input#element_56").val(eight[1]);
            $("select#element_57").val(eight[2]);
            $("select#element_94").val(eight[3]);
            $("select#element_58").val(eight[4]);
            $("#element_59").val(eight[5]);
         }
         
         if(entries>8){//9 minimum
            var ninth = top_ten[8].split("~")//ninth
            var time9 = ninth[0].split(":");
            $("input#element_66_1").val(time9[0]);    //time hour
            $("element_66_2").val(time9[1]);//time minutes
            $("input#element_68").val(ninth[1]);
            $("input#element_69").val(ninth[2]);
            $("select#element_98").val(ninth[3]);
            $("select#element_70").val(ninth[4]);
            $("#element_71").val(ninth[5]);
         }
         
         if(entries>8){//10
            var tenth = top_ten[8].split("~")//tenth
            var time10 = tenth[0].split(":");
            $("input#element_73_1").val(time10[0]);    //time hour
            $("input#element_73_2").val(time10[1]);//time minutes
            $("input#element_75").val(tenth[1]);
            $("select#element_76").val(tenth[2]);
            $("select#element_99").val(tenth[3]);
            $("select#element_77").val(tenth[4]);
            $("#element_78").val(tenth[5]);
         }
   }); 
});
</script>
