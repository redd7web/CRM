<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<?php
date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
include "protected/global.php";
ini_set("display_errors",1);
require("/var/www/html/machforms/machform/machform.php");



$mf_param['form_id'] = 49574;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);
if(isset($_GET['entry_id']) && isset($_GET['truck_id'])){
    echo "FROM PENDING<br/>";
    $pet = $db->query("SELECT 
                Inetforms.ap_form_44342.*,
                Inetforms.ap_form_43256.element_140 as trailer_num,
                Inetforms.ap_form_44342.element_12 as com_type,
                Inetforms.ap_form_44342.element_77 as wtn,
                Inetforms.ap_form_43256.id as truck_scale_log_id,
                Inetforms.ap_form_43256.element_129 as shipped_from,
                Inetforms.ap_form_43256.element_131,
                Inetforms.ap_form_43256.element_132,
                Inetforms.ap_form_43256.element_133,
                Inetforms.ap_form_43256.element_140,
                Inetforms.ap_form_43256.element_141,
                Inetforms.ap_form_43256.element_135,
                Inetforms.ap_form_43256.element_137,
                Inetforms.ap_form_43256.element_142,
                Inetforms.ap_form_43256.element_134,
                Inetforms.ap_form_43256.element_145, 
                Inetforms.ap_form_43256.element_22 as inbound_driver,
                Inetforms.ap_form_43256.element_16 as inbound_ship_from,
                Inetforms.ap_form_43256.element_20 as inbound_carrier,
                Inetforms.ap_form_43256.element_24,
                Inetforms.ap_form_43256.element_25,
                Inetforms.ap_form_43256.element_116, 
                Inetforms.ap_form_43256.element_119 as netscale_inbound,
                Inetforms.ap_form_43256.element_133 as netscale_petfood,
                Inetforms.ap_form_43256.element_114 as requestor,
                Inetforms.ap_form_43256.date_created FROM Inetforms.ap_form_44342 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_44342.element_76 = ap_form_43256.id  WHERE ap_form_44342.id = $_GET[entry_id]");  
}else if(isset($_GET['completed_id'])){
        
    $cert = $db->query("SELECT Inetforms.ap_form_46859.*,Inetforms.ap_form_43256.element_1 as tsl_type,Inetforms.ap_form_43256.element_136,Inetforms.ap_form_46859.element_136 as ltype, Inetforms.ap_form_46859.element_138 as p1, Inetforms.ap_form_46859.element_139 as p1_2, Inetforms.ap_form_46859.element_100 as p1_3, ap_form_46859.element_116 as qty_skids_3,Inetforms.ap_form_43256.element_119 as netscale_inbound,Inetforms.ap_form_43256.element_133 as netscale_petfood,Inetforms.ap_form_46859.element_9 FROM Inetforms.ap_form_46859 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_46859.element_76 = ap_form_43256.id  WHERE ap_form_46859.id = $_GET[completed_id] AND ap_form_46859.element_3 IN ('Completed','Pending') ORDER BY ap_form_46859.element_3 ASC");    
    echo $_GET['completed_id']."<br/>";
    echo "FROM COMPLETED<br/>";
    echo "completed dog food id 46859: ".$_GET['completed_id']."<br/>";
    print_r($cert);
} else if(isset($_GET['approved'])){
    $cert = $db->query("SELECT Inetforms.ap_form_46859.*,Inetforms.ap_form_43256.element_1 as tsl_type,Inetforms.ap_form_43256.element_136,Inetforms.ap_form_46859.element_136 as ltype, Inetforms.ap_form_46859.element_138 as p1, Inetforms.ap_form_46859.element_139 as p1_2, Inetforms.ap_form_46859.element_100 as p1_3, ap_form_46859.element_116 as qty_skids_3,Inetforms.ap_form_43256.element_119 as netscale_inbound,Inetforms.ap_form_43256.element_133 as netscale_petfood,Inetforms.ap_form_46859.element_9 FROM Inetforms.ap_form_46859 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_46859.element_76 = ap_form_43256.id  WHERE ap_form_46859.id = $_GET[approved] AND ap_form_46859.element_3 IN ('Approved') ORDER BY ap_form_46859.element_3 ASC");    
    echo $_GET['approved']."<br/>";
    echo "FROM APPROVED<br/>";
    echo "approved dog food id 46859: ".$_GET['approved']."<br/>";
    print_r($cert);
}

?>
  <script>
<?php


if(isset($_GET['entry_id']) && isset($_GET['truck_id']) ){//entering destruction form for the first time. (from 44342) 
    
    $hju = explode(" ",$pet[0]['date_created']);
    
    $date = explode("-",$hju[0]);
    $time = explode (":",$hju[1]);

    if($time[0]>12){
        $t = $time[0]- 12;
        $pmam = 1;
    }else {
        $t = $time[0];
    }
    if($time[0]==12){
        $pmam =1;
    }
    
    ?>
  
    
    $("input#element_189").val("<?php 
        switch($pet[0]['tsl_type']){
            case 1:
                echo $pet[0]['netscale_inbound'];
            break;
            case 9:
                echo $pet[0]['netscale_petfood'];
            break;
        }
    ?>");
    $("input#element_1_1").val("<?php echo $date[1]; ?>")// month
    $("input#element_1_2").val("<?php echo $date[2]; ?>")// day
    $("input#element_1_3").val("<?php echo $date[0]; ?>")// year    
    $("input#element_2_1").val("<?php echo $t; ?>");//hour
    $("input#element_2_2").val("<?php echo $time[1]; ?>");//minutes
    $("#element_2_4").val("<?php if($pmam == 1){ echo "PM";  }else{ echo "AM"; } ?>");   
    $("input#element_10").val("<?php switch($pet[0]['requestor']){ case 1: echo "Johnny ";break; case 2: echo "Mario ";break; case 3: echo "Other "; break; case 4: echo "Donovon"; break; } ?>")
    $("input#element_82").val("<?php echo $pet[0]['element_24']; ?>");
    $("input#element_83").val("<?php echo $pet[0]['element_116'] ?>");
    $("input#element_85").val("<?php echo $_GET['entry_id']; ?>");
    $("input#element_76").val("<?php echo $_GET['truck_id'] ?>");
    $("input#element_77").val("<?php echo $pet[0]['wtn']; ?>");
    $("#element_136").val("<?php
            switch($pet[0]['tsl_type']){
                case 1:
                    switch($pet[0]['element_12']){
                        case 8:
                            echo 2;
                        break;
                        case 25: case 10:
                            echo 1;
                        break;
                    }
                break;
                case 9:
                    echo 3;
                break;
            }
     ?>");//type of load
    $("input#element_84").val("<?php  switch($pet[0]['tsl_type']){
                case 9:echo $pet[0]['element_141'];break;
                case 1:echo $pet[0]['element_25'];break;
        } ?>");
    $("input#element_11").val("<?php 
        switch($pet[0]['tsl_type']){
            case 9:
                switch(($pet[0]['element_11'])){
                    case 1: echo "Sparks, NV"; break;
                    case 2: echo "Other"; break;
                }
            break;
            case 1:
                switch($pet[0]['element_11']){
                    case 7: echo "Agape Transportation"; break;
                    case 26: echo "Bimbo"; break;
                    case 21: echo "Brenntag"; break;
                    case 28: echo "Connection Chemical"; break;
                    case 23: echo "Giralds"; break;
                    case 17: echo "IWP/AZ"; break;
                    case 14: echo "IWP/Mira Loma"; break;
                    case 15: echo "IWP/Selma"; break;
                    case 27: echo "Kinder Morgan"; break;
                    case 11: echo "LVO"; break;
                    case 22: echo "exeo"; break;
                    case 8: echo  "North Star Recycling"; break;
                    case 10: echo "Sara Lee"; break;
                    case 20: echo "Schaffner"; break;
                    case 18: echo "Sparkletts"; break;
                    case 16: echo "TARR"; break;
                    case 25: echo "VDFC Victorville"; break;
                    case 24: echo "Ventura Foods Co"; break;
                    case 19: echo "Verhoeven"; break;
                    case 12: echo "Victorville DC"; break;
                    case 9: echo "Other"; break;
                }
            break;
            
        }
    ?>")// AREA
    $("input#element_12").val("<?php 
        switch($pet[0]['tsl_type']){
            case 9:
                switch(($pet[0]['element_12'])){
                    case 1: echo "ByProduct Ext Boxed"; break;
                    case 4: echo "Corrugated"; break;
                    case 5: echo "PP Bags"; break;
                    case 6: echo "Compost"; break;
                    case 7: echo "Waste to Energy"; break;
                    case 3: echo "Other"; break;
                }
            break;
            case 1:
                switch($pet[0]['element_12']){
                    case 6:  echo "Almond Ground Shell"; break;
                    case 13: echo "Almond Meal"; break;                    
                    case 25: echo "Candy"; break;
                    case 10: echo "Chocolate"; break;                   
                    case 21: echo "Dressing"; break;                  
                    case 8:  echo "Ventura Mayo"; break;
                }
            break;
        }
    ?>")//TYPE
    $("input#element_13").val("<?php 
        switch($pet[0]['tsl_type']){
            case 9:
                switch($pet[0]['element_142']){
                    case 1:  echo "30 Yd Comp W2E";break;
                    case 4:  echo "30 Yd Open Top W2E";break;
                    case 5:  echo "Corn Cleanout";break;
                    case 2:  echo "Recycling Bale Trailor";break;
                    case 3:  echo "Third option";break;
                }
            break;
            case 1:
                switch($pet[0]['']){
                    
                }
            break;
        }
    ?>")//TANK
    $("input#element_14").val("<?php echo $pet[0]['trailer_num']; ?>")//SPOT/LOT 
       
    $("input#element_95").val("<?php echo $pet[0]['id']; ?>");//lAB REFERENCE
    
  
    <?php 
}else if ( isset($_GET['completed_id']) || isset($_GET['approved']) ){//reload completed destruction form
    $element_1 = explode("-",$cert[0]['element_1']);
    $element_8 = explode("-",$cert[0]['element_8']);
    $element_9 = explode(":",$cert[0]['element_9']);
    if($element_9[0]>12){
        $t = $element_9[0] - 12;
    }else{
        $t = $element_9[0];
    }
    ?>
    $("input#element_189").val("<?php 
        switch($cert[0]['tsl_type']){
            case 1:
                echo $cert[0]['netscale_inbound'];
            break;
            case 9:
                echo $cert[0]['netscale_petfood'];
            break;
        }
    ?>");   
    $("input#element_117").val("<?php echo $cert[0]['element_117']; ?>");
    $("input#element_118").val("<?php echo $cert[0]['element_118'] ?>");
    $("input#element_119").val("<?php echo $cert[0]['element_119'] ?>");
    $("input#element_98").val("<?php echo $cert[0]['element_98']; ?>");
    $("input#element_159").val("<?php echo $cert[0]['element_159']; ?>");
    $("input#element_1_1").val("<?php echo $element_1[1]; ?>");
    $("input#element_1_2").val("<?php echo $element_1[2]; ?>");
    $("input#element_1_3").val("<?php echo $element_1[0]; ?>");
    $("input#element_3").val("<?php echo $cert[0]['element_3']; ?>");
    $("select#element_4").val("<?php echo $cert[0]['element_4'] ?>");
    $("input#element_2").val("<?php echo $cert[0]['element_2']; ?>");
    $("input#element_1").val("<?php echo $cert[0]['element_1']; ?>");
    $("input#element_3").val("<?php echo $cert[0]['element_3']; ?>")
    $("input#element_16").val("<?php echo $_GET['completed_id']; ?>");        
    $("input#element_5_1").val("<?php echo $cert[0]['element_5_1']; ?>");
    $("input#element_5_2").val("");
    $("input#element_8_1").val("<?php echo $element_8[1]; ?>");
    $("input#element_8_2").val("<?php echo $element_8[2]; ?>");
    $("input#element_8_3").val("<?php echo $element_8[0]; ?>");
    $("input#element_9_1").val("<?php echo $t; ?>");
    $("input#element_9_2").val("<?php echo $element_9[1] ?>");
   
    $("#element_136").val("<?php echo $cert[0]['ltype'];  ?>");//type of load
    <?php 
    if($cert[0]['element_9_4']>=12){
        ?>
        $("select#element_9_4").val("PM");
        <?php
    }else{
        ?>
        $("select#element_9_4").val("AM");
        <?php
    }
    ?>
    $("input#element_10").val("<?php echo $cert[0]['element_10']; ?>");
    $("input#element_11").val("<?php echo $cert[0]['element_11']; ?>");
    $("input#element_12").val("<?php echo $cert[0]['element_12']; ?>");
    $("input#element_13").val("<?php echo $cert[0]['element_13']; ?>");
    $("input#element_14").val("<?php echo $cert[0]['element_14']; ?>");
    $("input#element_76").val("<?php echo $cert[0]['element_76']; ?>");
    $("input#element_77").val("<?php echo $cert[0]['element_77']; ?>");
    $("input#element_80_1").val("");
    $("input#element_80_2").val("");
    $("input#element_80_3").val("");
    $("input#element_82").val("<?php echo $cert[0]['element_82']; ?>");
    $("input#element_83").val("<?php echo $cert[0]['element_83']; ?>");
    $("input#element_84").val("<?php echo $cert[0]['element_84']; ?>");
    $("input#element_85").val("<?php echo $cert[0]['element_85']; ?>");
    $("input#SOURCE").val("");
    <?php if($cert[0]['element_87_1']== 1){ ?>
    $("input#element_87_1").prop("checked",true);
    <?php } 
    
     if($cert[0]['element_87_2']== 1){ ?>
    $("input#element_87_2").prop("checked",true);
    <?php } 
    if($cert[0]['element_87_3']== 1){ ?>
    $("input#element_87_3").prop("checked",true);
    <?php } 
     if($cert[0]['element_87_0']== 1){ ?>
    $("input#element_87_0").prop("checked",true);
    $("input#element_87_other").val("<?php echo $cert[0]['element_87_other'] ?>");
    <?php } ?>
    
    $("input#element_87_other").val("");
    $("input#element_88").val("<?php echo $cert[0]['element_88']; ?>");//Seal Number
    $("input#element_89").val("<?php echo $cert[0]['element_89']; ?>");
    $("input#element_90").val("<?php echo $cert[0]['element_90']; ?>");
    $("input#element_91").val("<?php echo $cert[0]['element_91']; ?>");
    $("input#element_92").val("<?php echo $cert[0]['element_92']; ?>");
    $("input#element_93").val("<?php echo $cert[0]['element_93']; ?>");
    $("input#element_95").val("<?php echo $cert[0]['element_95']; ?>");
    $("input#element_94").val("<?php echo $cert[0]['element_94']; ?>");      
    <?php 
    switch($cert[0]['element_81']){
        case 1:
        ?>
        $("#element_81_1").prop("checked",true);
        <?php
        break;
        case 2:
         ?>
        $("#element_81_2").prop("checked",true);
        <?php
        break;
        case 3:
         ?>
        $("#element_81_3").prop("checked",true);
        <?php
        break;
    }
    
    switch($cert[0]['element_96']){
        case 1:
        ?>
        $("#element_96_1").prop("checked",true);
        <?php
        break;
        case 2:
        ?>
        $("#element_96_2").prop("checked",true);
        <?php
        break;
        case 3:
        ?>
        $("#element_96_3").prop("checked",true);
        <?php
        break;
    }
    switch($cert[0]['element_97']){
        case 1:
        ?>
        $("#element_97_1").prop("checked",true);
        <?php
        break;
        case 2:
        ?>
        $("#element_97_2").prop("checked",true);
        <?php
        break;
        case 3:
        ?>
        $("#element_97_3").prop("checked",true);
        <?php
        break;
    }
?>
        
        $("input#element_100").val("<?php echo $cert[0]['p1_3']; ?>");// QTY  OF PRODUCTS
        $("input#element_138").val("<?php echo $cert[0]['p1']; ?>");//PALLETS
        $("input#element_139").val("<?php echo $cert[0]['p1_2']; ?>");//Total Weight Shrink per Pallets/Skids 
        $("input#element_141").val("<?php echo $cert[0]['element_141']; ?>");//Total Trash per Product Container  
        $("input#element_116").val("<?php echo $cert[0]['qty_skids_3']; ?>");
        
        
        $("#element_99").val("<?php echo $cert[0]['element_99']; ?>");//Pruduct (1)
        
        <?php 
        
            if($cert[0]['element_157_1'] == 1){
                ?>
                $("#element_157_1").prop("checked",true);//Skids
                <?php
            } 
            
            if($cert[0]['element_157_2'] == 1){
                ?>
                $("#element_157_2").prop("checked",true);//Pallets
                <?php
            } 
             
            if($cert[0]['element_157_3'] == 1){
                ?>
                $("#element_157_3").prop("checked",true);//Bulk
                <?php
            } 
            
            if($cert[0]['element_157_4'] == 1){
                ?>
                $("#element_157_4").prop("checked",true);//Other
                <?php
            }
        ?>
        $("input#element_159").val("<?php echo $cert[0]['element_159']; ?>");//Units per Case (1) 
        $("input#element_160").val("<?php echo $cert[0]['element_160']; ?>");;//QTY of Cases (1) 
        $("input#element_161").val("<?php echo $cert[0]['element_161']; ?>");//Product Weight Total (1)
        $("input#element_162").val("<?php echo $cert[0]['element_162']; ?>");//QTY Units of Product(1) 
        $("input#element_163").val("<?php echo $cert[0]['element_163']; ?>");//Applied Product Shrink (1)  
        $("input#element_173").val("<?php echo $cert[0]['element_173']; ?>");//Net Product Weight (1) 
        
        
         
        $("#element_101").val("<?php echo $cert[0]['element_101']; ?>");//Pruduct (2)
        
        <?php         
            if($cert[0]['element_102_1'] == 1){
                ?>
                $("#element_102_1").prop("checked",true);//Skids
                <?php
            } 
            
            if($cert[0]['element_102_2'] == 1){
                ?>
                $("#element_102_2").prop("checked",true);//Pallets
                <?php
            } 
             
            if($cert[0]['element_102_3'] == 1){
                ?>
                $("#element_102_3").prop("checked",true);//Bulk
                <?php
            } 
            
            if($cert[0]['element_102_4'] == 1){
                ?>
                $("#element_102_4").prop("checked",true);//Other
                <?php
            }
        ?>
        $("input#element_156").val("<?php echo $cert[0]['element_156']; ?>");//Units per Case (2) 
        $("input#element_154").val("<?php echo $cert[0]['element_154']; ?>");//QTY of Cases (2) 
        $("input#element_153").val("<?php echo $cert[0]['element_153']; ?>");//Product Weight Total (1)
        $("input#element_150").val("<?php echo $cert[0]['element_150']; ?>");//QTY Units of Product(1) 
        $("input#element_151").val("<?php echo $cert[0]['element_151']; ?>");//Applied Product Shrink (1)
        $("input#element_176").val("<?php echo $cert[0]['element_176']; ?>");//Net Product Weight (1)
        
        
        
        $("#element_113").val("<?php echo $cert[0]['element_113']; ?>");//Pruduct (3) 
         <?php         
            if($cert[0]['element_114_1'] == 1){
                ?>
                $("#element_114_1").prop("checked",true);//Skids
                <?php
            } 
            
            if($cert[0]['element_114_2'] == 1){
                ?>
                $("#element_114_2").prop("checked",true);//Pallets
                <?php
            } 
             
            if($cert[0]['element_114_3'] == 1){
                ?>
                $("#element_114_3").prop("checked",true);//Bulk
                <?php
            } 
            
            if($cert[0]['element_114_4'] == 1){
                ?>
                $("#element_114_4").prop("checked",true);//Other
                <?php
            }
        ?>
        $("input#element_166").val("<?php echo $cert[0]['element_166']; ?>");//Units per Case (3)
        $("input#element_167").val("<?php echo $cert[0]['element_167']; ?>");//QTY of Cases (3) 
        $("input#element_168").val("<?php echo $cert[0]['element_168']; ?>");//QTY Units of Product (3) 
        $("input#element_169").val("<?php echo $cert[0]['element_169']; ?>");//Product Weight Total (3)
        $("input#element_170").val("<?php echo $cert[0]['element_170']; ?>");//Applied Product Shrink (3) 
        $("input#element_177").val("<?php echo $cert[0]['element_177']; ?>");//Net Product Weight (3)
        $("input#element_175").val("<?php echo $cert[0]['element_175']; ?>");
        $("input#element_178").val("<?php echo $cert[0]['element_178']; ?>");//Total Load Weight 
        $("input#element_143").val("<?php echo $cert[0]['element_143']; ?>");//Total Shrink 
        $("input#element_144").val("<?php echo $cert[0]['element_144']; ?>");//Product Net 
        $("#element_191").val("<?php echo $cert[0]['element_191']; ?>");
        $("input#element_195").val("<?php echo $cert[0]['element_195'] ?>");
        $("input#element_196").val(<?php echo $cert[0]['element_196']; ?>);
        $("input#element_197").val(<?php echo $cert[0]['element_197']; ?>);
        $("input#element_198").val("<?php echo $cert[0]['element_197']; ?>");
        $("input#element_199").val("<?php echo $cert[0]['element_199']; ?>");
        $("input#element_199").val("<?php echo $cert[0]['element_199']; ?>");
        $("input#element_199").val("<?php echo $cert[0]['element_200']; ?>");//
        $("input#element_202").val("<?php echo $cert[0]['element_202']; ?>");//
        $("input#element_203").val("<?php echo $cert[0]['element_203']; ?>");//
        $("input#element_204").val("<?php echo $cert[0]['element_204']; ?>");//
        $("input#element_220").val("<?php echo $cert[0]['element_220']; ?>");
        $("#element_207").val("<?php echo $cert[0]['element_207']; ?>");//
        $("input#element_210").val("<?php echo $cert[0]['element_210']; ?>");//
        $("input#element_211").val("<?php echo $cert[0]['element_211']; ?>");//
        $("input#element_212").val("<?php echo $cert[0]['element_212']; ?>");// 
        $("input#element_213").val("<?php echo $cert[0]['element_213']; ?>");//
        $("input#element_214").val("<?php echo $cert[0]['element_214']; ?>");//
        $("input#element_216").val("<?php echo $cert[0]['element_216']; ?>");//
        $("input#element_217").val("<?php echo $cert[0]['element_217']; ?>");//
        $("input#element_219").val("<?php echo $cert[0]['element_219']; ?>");//element_220
        $("#element_223").val("<?php echo $cert[0]['element_223']; ?>");//
        $("input#element_226").val("<?php echo $cert[0]['element_226']; ?>");
        $("input#element_227").val("<?php echo $cert[0]['element_227']; ?>");
        $("input#element_228").val("<?php echo $cert[0]['element_228']; ?>");
        $("input#element_229").val("<?php echo $cert[0]['element_229']; ?>");
        $("input#element_230").val("<?php echo $cert[0]['element_230']; ?>");
        $("input#element_231").val("<?php echo $cert[0]['element_231']; ?>");
        $("input#element_232").val("<?php echo $cert[0]['element_232']; ?>");
        $("input#element_233").val("<?php echo $cert[0]['element_233']; ?>");
        $("input#element_234").val("<?php echo $cert[0]['element_234']; ?>");
        $("input#element_235").val("<?php echo $cert[0]['element_235']; ?>");
        $("input#element_236").val("<?php echo $cert[0]['element_236']; ?>");
        
        $("#element_239").val("<?php echo $cert[0]['element_239']; ?>");        
        $("input#element_242").val("<?php echo $cert[0]['element_242'] ?>");
        $("input#element_243").val("<?php echo $cert[0]['element_243'] ?>");
        $("input#element_244").val("<?php echo $cert[0]['element_244'] ?>");
        $("input#element_245").val("<?php echo $cert[0]['element_245'] ?>");
        $("input#element_247").val("<?php echo $cert[0]['element_247'] ?>");
        $("input#element_248").val("<?php echo $cert[0]['element_248'] ?>");
        $("input#element_249").val("<?php echo $cert[0]['element_249'] ?>");
        $("input#element_250").val("<?php echo $cert[0]['element_250'] ?>");
        $("input#element_251").val("<?php echo $cert[0]['element_251'] ?>");
        $("input#element_252").val("<?php echo $cert[0]['element_252'] ?>");
        
        $("#element_255").val("<?php echo $cert[0]['element_255']; ?>");
        $("input#element_258").val("<?php echo $cert[0]['element_258'] ?>");
        $("input#element_259").val("<?php echo $cert[0]['element_259'] ?>");
        $("input#element_260").val("<?php echo $cert[0]['element_260'] ?>");
        $("input#element_261").val("<?php echo $cert[0]['element_261'] ?>");
        $("input#element_262").val("<?php echo $cert[0]['element_262'] ?>");
        $("input#element_263").val("<?php echo $cert[0]['element_263'] ?>");
        $("input#element_264").val("<?php echo $cert[0]['element_264'] ?>");
        $("input#element_265").val("<?php echo $cert[0]['element_265'] ?>");
        $("input#element_266").val("<?php echo $cert[0]['element_266'] ?>");
        $("input#element_267").val("<?php echo $cert[0]['element_267'] ?>");
        $("input#element_268").val("<?php echo $cert[0]['element_268']; ?>");
        
        
        $("#element_271").val("<?php echo $cert[0]['element_271']; ?>");
        $("input#element_274").val("<?php echo $cert[0]['element_274'] ?>");
        $("input#element_275").val("<?php echo $cert[0]['element_275'] ?>");
        $("input#element_276").val("<?php echo $cert[0]['element_276'] ?>");
        $("input#element_277").val("<?php echo $cert[0]['element_277'] ?>");
        $("input#element_278").val("<?php echo $cert[0]['element_278'] ?>");
        $("input#element_279").val("<?php echo $cert[0]['element_279'] ?>");
        $("input#element_279").val("<?php echo $cert[0]['element_279'] ?>");
        $("input#element_281").val("<?php echo $cert[0]['element_281'] ?>");
        $("input#element_282").val("<?php echo $cert[0]['element_282'] ?>");
        $("input#element_283").val("<?php echo $cert[0]['element_283'] ?>");
        $("input#element_284").val("<?php echo $cert[0]['element_284']; ?>");
        
        
        $("#element_287").val("<?php echo $cert[0]['element_287']; ?>");
        $("input#element_290").val("<?php echo $cert[0]['element_290'] ?>");
        $("input#element_291").val("<?php echo $cert[0]['element_291'] ?>");
        $("input#element_292").val("<?php echo $cert[0]['element_292'] ?>");
        $("input#element_293").val("<?php echo $cert[0]['element_293'] ?>");
        $("input#element_294").val("<?php echo $cert[0]['element_294'] ?>");
        $("input#element_295").val("<?php echo $cert[0]['element_295'] ?>");
        $("input#element_296").val("<?php echo $cert[0]['element_296'] ?>");
        $("input#element_297").val("<?php echo $cert[0]['element_297'] ?>");
        $("input#element_298").val("<?php echo $cert[0]['element_298'] ?>");
        $("input#element_299").val("<?php echo $cert[0]['element_299'] ?>");
        $("input#element_300").val("<?php echo $cert[0]['element_300']; ?>");
        <?php
        
         if($cert[0]['element_289_1']==1){
            ?>
            $("#element_27element_289_13_1").prop("checked",true);
            <?php
        }
        
        
        if($cert[0]['element_289_2']==1){
              ?>
            $("#element_289_2").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_289_3']==1){
              ?>
            $("#element_289_3").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_289_4']==1){
              ?>
            $("#element_289_4").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_273_4']==1){
            ?>
            $("#element_273_4").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_273_2']==1){
              ?>
            $("#element_273_2").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_273_3']==1){
              ?>
            $("#element_273_3").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_273_4']==1){
              ?>
            $("#element_273_4").prop("checked",true);
            <?php
        }
        
        
        if($cert[0]['element_257_1']==1){
            ?>
            $("#element_257_1").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_257_2']==1){
              ?>
            $("#element_257_2").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_257_3']==1){
              ?>
            $("#element_257_3").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_257_4']==1){
              ?>
            $("#element_257_4").prop("checked",true);
            <?php
        }
        
        
        if($cert[0]['element_241_1']==1){
            ?>
            $("#element_241_1").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_241_2']==1){
              ?>
            $("#element_241_2").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_241_3']==1){
              ?>
            $("#element_241_3").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_241_4']==1){
              ?>
            $("#element_241_4").prop("checked",true);
            <?php
        }
        
        
        if($cert[0]['element_225_1']==1){
            ?>
            $("#element_225_1").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_225_2']==1){
              ?>
            $("#element_225_2").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_225_3']==1){
              ?>
            $("#element_225_3").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_225_4']==1){
              ?>
            $("#element_225_4").prop("checked",true);
            <?php
        }
        
        
        if($cert[0]['element_209_1']==1){
            ?>
            $("#element_209_1").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_209_2']==1){
              ?>
            $("#element_209_2").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_209_3']==1){
              ?>
            $("#element_209_3").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_209_4']==1){
              ?>
            $("#element_209_4").prop("checked",true);
            <?php
        }
        
        if($cert[0]['element_81'] == 4){
            ?>
            $("#element_81_1").prop("checked",true);
            <?php
        } 
        
        if($cert[0]['element_81'] == 2){
            ?>
            $("#element_81_2").prop("checked",true);
            <?php
        } 
        if($cert[0]['element_81'] == 2){
            ?>
            $("#element_81_3").prop("checked",true);
            <?php
        } 
        
         if($cert[0]['element_81'] == 3){
            ?>
            $("#element_81_4").prop("checked",true);
            <?php
        }
        ?>
        $("input#element_181").val("<?php echo $cert[0]['element_181']; ?>");//Excluded Product Weight         
        $("input#element_182").val("<?php echo $cert[0]['element_182']; ?>");//Excluded Product Container/Shrink 
        $("input#element_184").val("<?php echo $cert[0]['element_184']; ?>");//Load Net Product Weight
        $("input#element_185").val("<?php echo $cert[0]['element_185']; ?>");//Load Total Shrink (Including Pallets and Excluded Product Weights) 
        $("input#element_186").val("<?php echo $cert[0]['element_186']; ?>");//Load Gross Weight Total (Calculated) 
        $("input#element_187").val("<?php echo $cert[0]['element_187']; ?>");//Difference From Scale 
        $("input#element_188").val("<?php echo $cert[0]['element_188']; ?>");//Contingency 
        $("input#element_189").val("<?php echo $cert[0]['element_189'] ?>")//Scale Net Weight 
        <?php
}
?>
</script>
