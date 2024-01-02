<div id="google_translate_element"></div>

<script type="text/javascript">
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



$mf_param['form_id'] = 49773;
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
                Inetforms.ap_form_43256.element_150 as seal_number,
                Inetforms.ap_form_43256.element_147 as tcl_release,
                Inetforms.ap_form_43256.element_23,
                Inetforms.ap_form_43256.element_17,
                Inetforms.ap_form_43256.element_21,
                Inetforms.ap_form_43256.element_15 as inbound_com_other,
                Inetforms.ap_form_43256.element_130,
                Inetforms.ap_form_43256.date_created FROM Inetforms.ap_form_44342 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_44342.element_76 = ap_form_43256.id  WHERE ap_form_44342.id = $_GET[entry_id]");  
}else if(isset($_GET['completed_id'])){
        
    $cert = $db->query("SELECT Inetforms.ap_form_43256.element_131 as ship_form,Inetforms.ap_form_49773.*,Inetforms.ap_form_43256.element_1 as tsl_type,Inetforms.ap_form_43256.element_136,Inetforms.ap_form_49773.element_136 as ltype, Inetforms.ap_form_49773.element_138 as p1, Inetforms.ap_form_49773.element_139 as p1_2, Inetforms.ap_form_49773.element_100 as p1_3, ap_form_49773.element_116 as qty_skids_3,Inetforms.ap_form_43256.element_119 as netscale_inbound,Inetforms.ap_form_43256.element_133 as netscale_petfood,Inetforms.ap_form_49773.element_9 FROM Inetforms.ap_form_49773 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_49773.element_76 = ap_form_43256.id  WHERE ap_form_49773.id = $_GET[completed_id] AND ap_form_49773.element_3 IN ('Completed','Pending') ORDER BY ap_form_49773.element_3 ASC");    
    echo $_GET['completed_id']."<br/>";
    echo "FROM COMPLETED<br/>";
    echo "completed dog food id 49773: ".$_GET['completed_id']."<br/>";
    print_r($cert);
} else if(isset($_GET['approved'])){
    $cert = $db->query("SELECT Inetforms.ap_form_43256.element_131 as ship_form,Inetforms.ap_form_49773.*,Inetforms.ap_form_43256.element_1 as tsl_type,Inetforms.ap_form_43256.element_136,Inetforms.ap_form_49773.element_136 as ltype, Inetforms.ap_form_49773.element_138 as p1, Inetforms.ap_form_49773.element_139 as p1_2, Inetforms.ap_form_49773.element_100 as p1_3, ap_form_49773.element_116 as qty_skids_3,Inetforms.ap_form_43256.element_119 as netscale_inbound,Inetforms.ap_form_43256.element_133 as netscale_petfood,Inetforms.ap_form_49773.element_9 FROM Inetforms.ap_form_49773 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_49773.element_76 = ap_form_43256.id  WHERE ap_form_49773.id = $_GET[approved] AND ap_form_49773.element_3 IN ('Approved') ORDER BY ap_form_49773.element_3 ASC");    
    echo $_GET['approved']."<br/>";
    echo "FROM APPROVED<br/>";
    echo "approved dog food id 49773: ".$_GET['approved']."<br/>";
    //print_r($cert);
}

?>
    
  <script>
  
  
  
  $("#li_655").on("click","#mixed_load",function(){
        window.open('mixed_load_page.php?compl=<?php echo $_GET['completed_id']; ?>');
    });
<?php


if(isset($_GET['entry_id']) && isset($_GET['truck_id']) ){//entering destruction form for the first time. (from 44342) PendingDogFood 
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
  
    $("input#element_653").val("<?php echo $pet[0]['element_653'] ?>");
    $("input#element_88").val("<?php echo $pet[0]['seal_number'] ?>");
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
    $("input#element_1_1").val("<?php echo $date[1]; ?>");// month
    $("input#element_1_2").val("<?php echo $date[2]; ?>");// day
    $("input#element_1_3").val("<?php echo $date[0]; ?>");// year    
    $("input#element_2_1").val("<?php echo $t; ?>");//hour
    $("input#element_2_2").val("<?php echo $time[1]; ?>");//minutes
    $("#element_2_4").val("<?php if($pmam == 1){ echo "PM";  }else{ echo "AM"; } ?>");   
    $("input#element_10").val("<?php switch($pet[0]['requestor']){ case 1: echo "Johnny ";break; case 2: echo "Mario ";break; case 3: echo "Other "; break; case 4: echo "Donovon"; break; } ?>")
    $("input#element_82").val("<?php echo $pet[0]['tcl_release']; ?>");
    $("input#element_83").val("<?php echo $pet[0]['element_116'] ?>");
    $("input#element_85").val("<?php echo $_GET['entry_id']; ?>");
    $("input#element_76").val("<?php echo $_GET['truck_id'] ?>");
    $("input#element_77").val("<?php echo $pet[0]['wtn']; ?>");
    $("select#element_136").val("<?php
            switch($pet[0]['tsl_type']){
                case 1:
                    switch($pet[0]['element_12']){
                        case 8:
                            echo 1;
                        break;
                        case 25: case 10:
                            echo 2;
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
                    case 1:echo "Sparks, NV";break;
                    case 9:echo "Redlands, CA";break;
                    case 8:echo "Bernardino, CA"; break;
                    case 7:echo "Victorville, CA"; break;
                    case 2:echo $dogfood['element_132'];break;//other
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
                    case 1:
                            echo "Extruded Pallet";
                    break;
                    case 3:
                        echo "Other /".$dogfood['element_130'];;
                    break;
                    case 4:
                        echo "Extruded Gaylord";
                    break;
                    case 5:
                        echo "BULK";
                    break;
                    case 6:
                        echo "Bagged Under 1 lb";
                    break;
                    case 7:
                        echo "Bagged 1 lb to 5 lb";
                    break;
                    case 9:
                        echo "Single Serve Pallet";
                    break;
                    case 8:
                        echo "Bagged Over 5 lb";
                    break;
                }
            break;
            case 1:
                switch($pet[0]['element_12']){
                    case 6:  echo "Almond Ground Shell"; break;
                    case 13: echo "Almond Meal"; break;                    
                    case 25: echo "Candy"; break;
                    case 10: echo "Chocolate"; break;                   
                    case 21: echo "Dressing"; break;                  
                    case 8:  echo "North Star Mayo"; break;
                    case 18:  echo "Bakery"; break;
                    case 24:  echo "Clear Diesel"; break;
                    case 7:  echo "Dehy Bakery"; break;
                    case 11:  echo "Food Waste"; break;
                    case 17:  echo "Fat Lint"; break;
                    case 12:  echo "Lint"; break;                   
                    case 14:  echo "Methanol"; break;
                    case 3:  echo "peanut Butter"; break;
                    case 20:  echo "Sodium Hydroxide"; break;
                    case 22:  echo "Sulferic Acid"; break;
                    case 15:  echo "Water"; break;
                    case 16:  echo "WCS"; break;
                    case 9:  echo "Other"; break;
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
    $("input#element_14").val("<?php echo $pet[0]['trailer_num']; ?>");//SPOT/LOT 
       
    $("input#element_95").val("<?php echo $pet[0]['id']; ?>");//lAB REFERENCE
    
  
    <?php 
}else if ( isset($_GET['completed_id']) || isset($_GET['approved']) ){//reload completed destruction form
    
    switch($cert[0]['ship_form']){//base freight
        case 1:$ship_form = "Sparks, NV";
            ?>
            $("input#element_648").val("1280");
            <?php
        break;
        case 9:$ship_form = "Redlands, CA";
            ?>
            $("input#element_648").val("530");
            <?php
        break;
        case 8:$ship_form = "Bernardino, CA";
            switch($cert[0]['element_11']){
                case "BULK":
                    ?>
                    $("input#element_648").val("383");
                    <?php
                break;
                default:
                    ?>
                    $("input#element_648").val("505");
                    <?php
                break;
            } 
        break;
        case 7:$ship_form = "Victorville, CA"; 
            switch($cert[0]['element_11']){
                case "BULK":
                    ?>
                    $("input#element_648").val("532");
                    <?php
                break;
                default:
                    ?>
                    $("input#element_648").val("640");
                    <?php
                break;
            }
        break;
    }
    
    
    switch($cert[0]['']){
        
    }    
    ?>
      
    <?php
    $element_1 = explode("-",$cert[0]['element_1']);
    $element_8 = explode("-",$cert[0]['element_8']);
    $element_9 = explode(":",$cert[0]['element_9']);
    if($element_9[0]>12){
        $t = $element_9[0] - 12;
    }else{
        $t = $element_9[0];
    }
    
    
    //*VENTURA *//
    
     // ventura 1
        ?>
        $("select#element_460").val("<?php echo $cert[0]['element_460']; ?>");
        $("input#element_461").val("<?php echo $cert[0]['element_461']; ?>");
        <?php
         if($cert[0]['element_462_1']==1){//skids
            ?>
            $("#element_462_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_462_2']==1){//pallets
            ?>
            $("#element_462_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_462_3']==1){//bulk element_462_4
            ?>
            $("#element_462_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_462_4']==1){//bulk element_462_4
            ?>
            $("#element_462_4").prop('checked',true);
            <?php
         }
        ?> 
        //
        
        $("#element_155_1").click(function(){
            $.get("silent_mixed_load_calc.php",{compl:<?php echo $cert[0]['id']; ?>},function(data){
                $("input#element_655").val(data);
            });
        });
        $("input#element_336").val("<?php echo $cert[0]['element_336']; ?>");
        $("input#element_656").val("<?php echo $cert[0]['element_656']; ?>");
        $("input#element_352").val("<?php echo $cert[0]['element_352']; ?>");
        $("input#element_657").val("<?php echo $cert[0]['element_657']; ?>");
        $("input#element_368").val("<?php echo $cert[0]['element_368']; ?>");
        $("input#element_658").val("<?php echo $cert[0]['element_658']; ?>");
        $("input#element_384").val("<?php echo $cert[0]['element_384']; ?>");
        $("input#element_659").val("<?php echo $cert[0]['element_659']; ?>");
        $("input#element_398").val("<?php echo $cert[0]['element_398']; ?>");
        $("input#element_660").val("<?php echo $cert[0]['element_660']; ?>");
        $("input#element_663").val("<?php echo $cert[0]['element_663']; ?>");
        $("input#element_662").val(<?php echo $cert[0]['element_662']; ?>);
        $("input#element_661").val(<?php echo $cert[0]['element_661']; ?>);
        $("input#element_463").val("<?php echo $cert[0]['element_463']; ?>");
        $("input#element_464").val("<?php echo $cert[0]['element_464']; ?>");
        $("input#element_465").val("<?php echo $cert[0]['element_465']; ?>");
        $("input#element_466").val("<?php echo $cert[0]['element_466']; ?>");
        $("input#element_467").val("<?php echo $cert[0]['element_467']; ?>");
        $("input#element_468").val("<?php echo $cert[0]['element_468']; ?>");
        $("input#element_469").val("<?php echo $cert[0]['element_469']; ?>");
        $("input#element_470").val("<?php echo $cert[0]['element_470']; ?>");
        $("input#element_471").val("<?php echo $cert[0]['element_471']; ?>");
        $("input#element_472").val("<?php echo $cert[0]['element_472']; ?>");
        $("input#element_473").val("<?php echo $cert[0]['element_473']; ?>");
        $("input#element_474").val("<?php echo $cert[0]['element_474']; ?>");
        $("input#element_475").val("<?php echo $cert[0]['element_475']; ?>");
        
        
        $("select#element_477").val("<?php echo $cert[0]['element_477']; ?>");
        $("input#element_478").val("<?php echo $cert[0]['element_478']; ?>");
        $("input#element_314").val("<?php echo $cert[0]['element_314']; ?>");
        <?php
        // ventura 2
        if($cert[0]['element_479_1']==1){//skids
            ?>
            $("#element_479_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_479_2']==1){//pallets
            ?>
            $("#element_479_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_479_3']==1){//bulk 
            ?>
            $("#element_479_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_479_4']==1){//bulk 
            ?>
            $("#element_479_4").prop('checked',true);
            <?php
         }
        ?>
        
        
        $("input#element_480").val("<?php echo $cert[0]['element_480']; ?>");
        $("input#element_481").val("<?php echo $cert[0]['element_481']; ?>");
        $("input#element_482").val("<?php echo $cert[0]['element_482']; ?>");
        $("input#element_483").val("<?php echo $cert[0]['element_483']; ?>");
        $("input#element_484").val("<?php echo $cert[0]['element_484']; ?>");
        $("input#element_485").val("<?php echo $cert[0]['element_485']; ?>");
        $("input#element_486").val("<?php echo $cert[0]['element_486']; ?>");
        $("input#element_487").val("<?php echo $cert[0]['element_487']; ?>");
        $("input#element_488").val("<?php echo $cert[0]['element_488']; ?>");
        $("input#element_489").val("<?php echo $cert[0]['element_489']; ?>");
        $("input#element_491").val("<?php echo $cert[0]['element_491']; ?>");
        $("input#element_490").val("<?php echo $cert[0]['element_490']; ?>");
        $("input#element_492").val("<?php echo $cert[0]['element_492']; ?>");
        
        
        $("select#element_494").val("<?php echo $cert[0]['element_494']; ?>");
        $("input#element_495").val("<?php echo $cert[0]['element_495']; ?>");
        <?php
        //  ventura 3
        if($cert[0]['element_496_1']==1){//skids
            ?>
            $("#element_496_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_496_2']==1){//pallets
            ?>
            $("#element_496_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_496_3']==1){//bulk 
            ?>
            $("#element_496_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_496_4']==1){//bulk 
            ?>
            $("#element_496_4").prop('checked',true);
            <?php
         }
        ?>
        $("input#element_497").val("<?php echo $cert[0]['element_497']; ?>");
        $("input#element_498").val("<?php echo $cert[0]['element_498']; ?>");
        $("input#element_499").val("<?php echo $cert[0]['element_499']; ?>");
        $("input#element_500").val("<?php echo $cert[0]['element_500']; ?>");
        $("input#element_506").val("<?php echo $cert[0]['element_506']; ?>");
        $("input#element_507").val("<?php echo $cert[0]['element_507']; ?>");
        $("input#element_508").val("<?php echo $cert[0]['element_508']; ?>");
        $("input#element_509").val("<?php echo $cert[0]['element_509']; ?>");
        $("input#element_501").val("<?php echo $cert[0]['element_501']; ?>");
        $("input#element_502").val("<?php echo $cert[0]['element_502']; ?>");
        $("input#element_503").val("<?php echo $cert[0]['element_503']; ?>");
        $("input#element_504").val("<?php echo $cert[0]['element_504']; ?>");
        $("input#element_505").val("<?php echo $cert[0]['element_505']; ?>");
        
        <?php
        //  ventura 4
        if($cert[0]['element_513_1']==1){//skids
            ?>
            $("#element_513_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_513_2']==1){//pallets
            ?>
            $("#element_513_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_513_3']==1){//bulk 
            ?>
            $("#element_513_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_513_4']==1){//bulk 
            ?>
            $("#element_513_4").prop('checked',true);
            <?php
         }
        ?>
        $("select#element_511").val("<?php echo $cert[0]['element_511']; ?>");
        $("input#element_512").val("<?php echo $cert[0]['element_512']; ?>");
        $("input#element_514").val("<?php echo $cert[0]['element_514']; ?>");
        $("input#element_515").val("<?php echo $cert[0]['element_515']; ?>");
        $("input#element_516").val("<?php echo $cert[0]['element_516']; ?>");
        $("input#element_517").val("<?php echo $cert[0]['element_517']; ?>");
        $("input#element_518").val("<?php echo $cert[0]['element_518']; ?>");
        $("input#element_519").val("<?php echo $cert[0]['element_519']; ?>");
        $("input#element_520").val("<?php echo $cert[0]['element_520']; ?>");
        $("input#element_521").val("<?php echo $cert[0]['element_521']; ?>");
        $("input#element_522").val("<?php echo $cert[0]['element_522']; ?>");
        $("input#element_523").val("<?php echo $cert[0]['element_523']; ?>");
        $("input#element_524").val("<?php echo $cert[0]['element_524']; ?>");
        $("input#element_525").val("<?php echo $cert[0]['element_525']; ?>");
        $("input#element_526").val("<?php echo $cert[0]['element_526']; ?>");
        
         <?php
        //  ventura 5
        if($cert[0]['element_530_1']==1){//skids
            ?>
            $("#element_530_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_530_2']==1){//pallets
            ?>
            $("#element_530_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_530_3']==1){//bulk 
            ?>
            $("#element_530_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_530_4']==1){//bulk 
            ?>
            $("#element_530_4").prop('checked',true);
            <?php
         }
        ?>
        $("select#element_528").val("<?php echo $cert[0]['element_528']; ?>");
        $("input#element_529").val("<?php echo $cert[0]['element_529']; ?>");
        $("input#element_531").val("<?php echo $cert[0]['element_531']; ?>");
        $("input#element_532").val("<?php echo $cert[0]['element_532']; ?>");
        $("input#element_533").val("<?php echo $cert[0]['element_533']; ?>");
        $("input#element_534").val("<?php echo $cert[0]['element_534']; ?>");
        $("input#element_535").val("<?php echo $cert[0]['element_535']; ?>");
        $("input#element_536").val("<?php echo $cert[0]['element_536']; ?>");
        $("input#element_537").val("<?php echo $cert[0]['element_537']; ?>");
        $("input#element_538").val("<?php echo $cert[0]['element_538']; ?>");
        $("input#element_539").val("<?php echo $cert[0]['element_539']; ?>");
        $("input#element_540").val("<?php echo $cert[0]['element_540']; ?>");
        $("input#element_541").val("<?php echo $cert[0]['element_541']; ?>");
        $("input#element_542").val("<?php echo $cert[0]['element_542']; ?>");
        $("input#element_543").val("<?php echo $cert[0]['element_543']; ?>");
        
        <?php
        //  ventura 6
        if($cert[0]['element_547_1']==1){//skids
            ?>
            $("#element_547_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_547_2']==1){//pallets
            ?>
            $("#element_547_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_547_3']==1){//bulk 
            ?>
            $("#element_547_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_547_4']==1){//bulk 
            ?>
            $("#element_547_4").prop('checked',true);
            <?php
         }
        ?>
        $("select#element_494").val("<?php echo $cert[0]['element_545']; ?>");
        $("input#element_546").val("<?php echo $cert[0]['element_546'];  ?>");
        $("input#element_548").val("<?php echo $cert[0]['element_548'];  ?>");
        $("input#element_549").val("<?php echo $cert[0]['element_549'];  ?>");
        $("input#element_550").val("<?php echo $cert[0]['element_550'];  ?>");
        $("input#element_551").val("<?php echo $cert[0]['element_551'];  ?>");
        $("input#element_552").val("<?php echo $cert[0]['element_552'];  ?>");
        $("input#element_553").val("<?php echo $cert[0]['element_553'];  ?>");
        $("input#element_554").val("<?php echo $cert[0]['element_554'];  ?>");
        $("input#element_555").val("<?php echo $cert[0]['element_555'];  ?>");
        $("input#element_556").val("<?php echo $cert[0]['element_556'];  ?>");
        $("input#element_557").val("<?php echo $cert[0]['element_557'];  ?>");
        $("input#element_558").val("<?php echo $cert[0]['element_558'];  ?>");
        $("input#element_559").val("<?php echo $cert[0]['element_559'];  ?>");
        $("input#element_560").val("<?php echo $cert[0]['element_560'];  ?>");
        
        
        
        $("select#element_562").val("<?php echo $cert[0]['element_562']; ?>");
        <?php
        //  ventura 7
        if($cert[0]['element_564_1']==1){//skids
            ?>
            $("#element_564_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_564_2']==1){//pallets
            ?>
            $("#element_564_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_564_3']==1){//bulk 
            ?>
            $("#element_564_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_564_4']==1){//bulk 
            ?>
            $("#element_564_4").prop('checked',true);
            <?php
         }
        ?>
        
        $("input#element_563").val("<?php echo $cert[0]['element_563']; ?>");
        $("input#element_565").val("<?php echo $cert[0]['element_548']; ?>");
        $("input#element_566").val("<?php echo $cert[0]['element_566']; ?>");
        $("input#element_567").val("<?php echo $cert[0]['element_567']; ?>");
        $("input#element_568").val("<?php echo $cert[0]['element_568']; ?>");
        $("input#element_569").val("<?php echo $cert[0]['element_569']; ?>");
        $("input#element_570").val("<?php echo $cert[0]['element_570']; ?>");
        $("input#element_571").val("<?php echo $cert[0]['element_571']; ?>");
        $("input#element_572").val("<?php echo $cert[0]['element_572']; ?>");
        $("input#element_573").val("<?php echo $cert[0]['element_573']; ?>");
        $("input#element_574").val("<?php echo $cert[0]['element_574']; ?>");
        $("input#element_575").val("<?php echo $cert[0]['element_575']; ?>");
        $("input#element_576").val("<?php echo $cert[0]['element_576']; ?>");
        $("input#element_577").val("<?php echo $cert[0]['element_577']; ?>");
        
        
        
        
        
         $("select#element_579").val("<?php echo $cert[0]['element_579']; ?>");
         $("input#element_580").val("<?php echo $cert[0]['element_580']; ?>");
        <?php
        //  ventura 8
        if($cert[0]['element_581_1']==1){//skids
            ?>
            $("#element_581_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_581_2']==1){//pallets
            ?>
            $("#element_581_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_581_3']==1){//bulk 
            ?>
            $("#element_581_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_581_4']==1){//bulk 
            ?>
            $("#element_581_4").prop('checked',true);
            <?php
         }
        ?>
       
        
        $("input#element_582").val("<?php echo $cert[0]['element_582']; ?>");
        $("input#element_583").val("<?php echo $cert[0]['element_583']; ?>");
        $("input#element_584").val("<?php echo $cert[0]['element_584']; ?>");
        $("input#element_585").val("<?php echo $cert[0]['element_585']; ?>");
        $("input#element_586").val("<?php echo $cert[0]['element_586']; ?>");
        $("input#element_587").val("<?php echo $cert[0]['element_587']; ?>");
        $("input#element_588").val("<?php echo $cert[0]['element_588']; ?>");
        $("input#element_589").val("<?php echo $cert[0]['element_589']; ?>");
        $("input#element_590").val("<?php echo $cert[0]['element_590']; ?>");
        $("input#element_591").val("<?php echo $cert[0]['element_591']; ?>");
        $("input#element_592").val("<?php echo $cert[0]['element_592']; ?>");
        $("input#element_593").val("<?php echo $cert[0]['element_593']; ?>");
        $("input#element_594").val("<?php echo $cert[0]['element_594']; ?>");
        
       
       
        $("select#element_596").val("<?php echo $cert[0]['element_596']; ?>");
        $("input#element_597").val("<?php echo $cert[0]['element_597']; ?>");
        <?php
        //  ventura 9
        if($cert[0]['element_598_1']==1){//skids
            ?>
            $("#element_598_1").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_598_2']==1){//pallets
            ?>
            $("#element_598_2").prop('checked',true);
            <?php
         }
         
         if($cert[0]['element_598_3']==1){//bulk 
            ?>
            $("#element_598_3").prop('checked',true);
            <?php
         }
         if($cert[0]['element_598_4']==1){//bulk 
            ?>
            $("#element_598_4").prop('checked',true);
            <?php
         }
        ?>
        
        
        $("input#element_599").val("<?php echo $cert[0]['element_599']; ?>");
        $("input#element_600").val("<?php echo $cert[0]['element_600']; ?>");
        $("input#element_601").val("<?php echo $cert[0]['element_601']; ?>");
        $("input#element_602").val("<?php echo $cert[0]['element_602']; ?>");
        $("input#element_603").val("<?php echo $cert[0]['element_603']; ?>");
        $("input#element_604").val("<?php echo $cert[0]['element_604']; ?>");
        $("input#element_605").val("<?php echo $cert[0]['element_605']; ?>");
        $("input#element_606").val("<?php echo $cert[0]['element_606']; ?>");
        $("input#element_608").val("<?php echo $cert[0]['element_608']; ?>");
        $("input#element_609").val("<?php echo $cert[0]['element_609']; ?>");
        $("input#element_610").val("<?php echo $cert[0]['element_610']; ?>");
        $("input#element_611").val("<?php echo $cert[0]['element_611']; ?>");
        $("input#element_607").val("<?php echo $cert[0]['element_607']; ?>");
        <?php
    
    
    //*VENTURA*//
    
    
    
    //*********PETFOOD*****************//
    //Petfood 1
            ?>
                    
            $("select#element_321").val("<?php echo $cert[0]['element_321']; ?>");
            $("input#element_322").val("<?php echo $cert[0]['element_322']; ?>");
            <?php
            
            //element_323_1
            
            if($cert[0]['element_323_1']==1){//skids
                ?>
                $("#element_323_1").prop('checked',true);
                <?php
             }
            
            
            if($cert[0]['element_598_1']==1){//skids
                ?>
                $("#element_598_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_323_2']==1){//pallets
                ?>
                $("#element_323_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_323_3']==1){//bulk 
                ?>
                $("#element_323_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_323_4']==1){//bulk 
                ?>
                $("#element_323_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_323_5'] == 1){//red/blue
                ?>
                $("#element_323_5").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_323_6'] == 1){ //brown
                ?>
                $("#element_323_6").prop('checked',true);
                <?php
             }
             
             
            ?>
            
            $("input#element_612").val("<?php echo $cert[0]['element_612']; ?>");
            $("input#element_613").val("<?php echo $cert[0]['element_613']; ?>");
            $("input#element_614").val("<?php echo $cert[0]['element_614']; ?>");
            $("input#element_615").val("<?php echo $cert[0]['element_615']; ?>");
            
            $("input#element_324").val("<?php echo $cert[0]['element_324']; ?>");
            $("input#element_325").val("<?php echo $cert[0]['element_325']; ?>");
            $("input#element_458").val("<?php echo $cert[0]['element_458']; ?>");
            $("input#element_327").val("<?php echo $cert[0]['element_327']; ?>");
            $("input#element_328").val("<?php echo $cert[0]['element_328']; ?>");
            $("input#element_329").val("<?php echo $cert[0]['element_329']; ?>");
            $("input#element_330").val("<?php echo $cert[0]['element_330']; ?>");
            $("input#element_331").val("<?php echo $cert[0]['element_331']; ?>");
            $("input#element_332").val("<?php echo $cert[0]['element_332']; ?>");
            $("input#element_333").val("<?php echo $cert[0]['element_333']; ?>");
            $("input#element_334").val("<?php echo $cert[0]['element_334']; ?>");
            $("input#element_335").val("<?php echo $cert[0]['element_335']; ?>");
            $("input#element_336").val("<?php echo $cert[0]['element_336']; ?>");
            
            
            //  petfood 2
            $("select#element_338").val("<?php echo $cert[0]['element_338']; ?>");
            $("input#element_339").val("<?php echo $cert[0]['element_339']; ?>");
            <?php
            if($cert[0]['element_340_1']==1){//skids
                ?>
                $("#element_340_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_340_2']==1){//pallets
                ?>
                $("#element_340_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_340_3']==1){//bulk 
                ?>
                $("#element_340_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_340_4']==1){//bulk 
                ?>
                $("#element_340_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_340_5'] == 1){// red /blue
                ?>
                $("#element_340_5").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_340_6'] == 1){// brown
                ?>
                $("#element_340_6").prop('checked',true);
                <?php
             }
             
            ?>
            $("input#element_617").val("<?php echo $cert[0]['element_617']; ?>");
            $("input#element_619").val("<?php echo $cert[0]['element_619']; ?>");
            $("input#element_616").val("<?php echo $cert[0]['element_616']; ?>");
            $("input#element_618").val("<?php echo $cert[0]['element_618']; ?>");
            
            
            
            $("input#element_341").val("<?php echo $cert[0]['element_341']; ?>");
            $("input#element_342").val("<?php echo $cert[0]['element_342']; ?>");
            $("input#element_457").val("<?php echo $cert[0]['element_457']; ?>");
            $("input#element_343").val("<?php echo $cert[0]['element_343']; ?>");
            $("input#element_344").val("<?php echo $cert[0]['element_344']; ?>");
            $("input#element_345").val("<?php echo $cert[0]['element_345']; ?>");
            $("input#element_346").val("<?php echo $cert[0]['element_346']; ?>");
            $("input#element_347").val("<?php echo $cert[0]['element_347']; ?>");
            $("input#element_348").val("<?php echo $cert[0]['element_348']; ?>");
            $("input#element_349").val("<?php echo $cert[0]['element_349']; ?>");
            $("input#element_350").val("<?php echo $cert[0]['element_350']; ?>");
            $("input#element_351").val("<?php echo $cert[0]['element_351']; ?>");
            $("input#element_352").val("<?php echo $cert[0]['element_352']; ?>");
            
            //  petfood 3
            $("select#element_354").val("<?php echo $cert[0]['element_354']; ?>");
            $("input#element_355").val("<?php echo $cert[0]['element_355']; ?>");
            <?php
            if($cert[0]['element_356_1']==1){//skids
                ?>
                $("#element_356_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_356_2']==1){//pallets
                ?>
                $("#element_356_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_356_3']==1){//bulk 
                ?>
                $("#element_356_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_356_4']==1){//other 
                ?>
                $("#element_356_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_356_5']==1){//bulk 
                ?>
                $("#element_356_5").prop('checked',true);
                <?php
             }
             if($cert[0]['element_356_6']==1){//bulk 
                ?>
                $("#element_356_6").prop('checked',true);
                <?php
             }
             
             
            ?>
            $("input#element_621").val("<?php echo $cert[0]['element_621']; ?>");
            $("input#element_623").val("<?php echo $cert[0]['element_623']; ?>");
            $("input#element_620").val("<?php echo $cert[0]['element_620']; ?>");
            $("input#element_622").val("<?php echo $cert[0]['element_622']; ?>");
            
            
            $("input#element_357").val("<?php echo $cert[0]['element_357']; ?>");
            $("input#element_358").val("<?php echo $cert[0]['element_358']; ?>");
            $("input#element_456").val("<?php echo $cert[0]['element_456']; ?>");
            $("input#element_359").val("<?php echo $cert[0]['element_359']; ?>");
            $("input#element_360").val("<?php echo $cert[0]['element_360']; ?>");
            $("input#element_361").val("<?php echo $cert[0]['element_361']; ?>");
            $("input#element_362").val("<?php echo $cert[0]['element_362']; ?>");
            $("input#element_363").val("<?php echo $cert[0]['element_363']; ?>");
            $("input#element_364").val("<?php echo $cert[0]['element_364']; ?>");
            $("input#element_365").val("<?php echo $cert[0]['element_365']; ?>");
            $("input#element_366").val("<?php echo $cert[0]['element_366']; ?>");
            $("input#element_367").val("<?php echo $cert[0]['element_367']; ?>");
            $("input#element_368").val("<?php echo $cert[0]['element_368']; ?>");
            
            //  petfood 4
            $("select#element_370").val("<?php echo $cert[0]['element_370']; ?>");
            $("input#element_371").val("<?php echo $cert[0]['element_371']; ?>");
            <?php
            if($cert[0]['element_372_1']==1){//skids
                ?>
                $("#element_372_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_372_2']==1){//pallets
                ?>
                $("#element_372_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_372_3']==1){//bulk 
                ?>
                $("#element_372_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_372_4']==1){//bulk 
                ?>
                $("#element_372_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_372_5']==1){//bulk 
                ?>
                $("#element_372_5").prop('checked',true);
                <?php
             }
             if($cert[0]['element_372_6']==1){//bulk 
                ?>
                $("#element_372_6").prop('checked',true);
                <?php
             }
             
            ?>
            $("input#element_625").val("<?php echo $cert[0]['element_625']; ?>");
            $("input#element_627").val("<?php echo $cert[0]['element_627']; ?>");
            $("input#element_624").val("<?php echo $cert[0]['element_624']; ?>");
            $("input#element_626").val("<?php echo $cert[0]['element_626']; ?>");
            
            
            $("input#element_373").val("<?php echo $cert[0]['element_373']; ?>");
            $("input#element_374").val("<?php echo $cert[0]['element_374']; ?>");
            $("input#element_455").val("<?php echo $cert[0]['element_455']; ?>");
            $("input#element_375").val("<?php echo $cert[0]['element_375']; ?>");
            $("input#element_376").val("<?php echo $cert[0]['element_376']; ?>");
            $("input#element_377").val("<?php echo $cert[0]['element_377']; ?>");
            $("input#element_378").val("<?php echo $cert[0]['element_378']; ?>");
            $("input#element_379").val("<?php echo $cert[0]['element_379']; ?>");
            $("input#element_380").val("<?php echo $cert[0]['element_380']; ?>");
            $("input#element_381").val("<?php echo $cert[0]['element_381']; ?>");
            $("input#element_382").val("<?php echo $cert[0]['element_382']; ?>");
            $("input#element_383").val("<?php echo $cert[0]['element_383']; ?>");
            $("input#element_384").val("<?php echo $cert[0]['element_384']; ?>");
            
            //  petfood 5
            $("select#element_386").val("<?php echo $cert[0]['element_386']; ?>");
            $("input#element_387").val("<?php echo $cert[0]['element_387']; ?>");
            <?php
            if($cert[0]['element_388_1']==1){//skids
                ?>
                $("#element_388_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_388_2']==1){//pallets
                ?>
                $("#element_388_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_388_3']==1){//bulk 
                ?>
                $("#element_388_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_388_4']==1){//bulk 
                ?>
                $("#element_388_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_388_5']==1){//bulk 
                ?>
                $("#element_388_5").prop('checked',true);
                <?php
             }
             if($cert[0]['element_388_6']==1){//bulk 
                ?>
                $("#element_388_6").prop('checked',true);
                <?php
             }
            ?>
            $("input#element_629").val("<?php echo $cert[0]['element_629']; ?>");
            $("input#element_631").val("<?php echo $cert[0]['element_631']; ?>");
            $("input#element_628").val("<?php echo $cert[0]['element_628']; ?>");
            $("input#element_630").val("<?php echo $cert[0]['element_630']; ?>");
            
            
            $("input#element_389").val("<?php echo $cert[0]['element_389']; ?>");
            $("input#element_390").val("<?php echo $cert[0]['element_390']; ?>");
            $("input#element_454").val("<?php echo $cert[0]['element_454']; ?>");
            $("input#element_391").val("<?php echo $cert[0]['element_391']; ?>");
            $("input#element_393").val("<?php echo $cert[0]['element_393']; ?>");
            $("input#element_394").val("<?php echo $cert[0]['element_394']; ?>");
            $("input#element_395").val("<?php echo $cert[0]['element_395']; ?>");
            $("input#element_410").val("<?php echo $cert[0]['element_410']; ?>");
            $("input#element_411").val("<?php echo $cert[0]['element_411']; ?>");
            $("input#element_412").val("<?php echo $cert[0]['element_412']; ?>");
            $("input#element_396").val("<?php echo $cert[0]['element_396']; ?>");
            $("input#element_397").val("<?php echo $cert[0]['element_397']; ?>");
            $("input#element_398").val("<?php echo $cert[0]['element_398']; ?>");
            
            //  petfood 6
            $("select#element_400").val("<?php echo $cert[0]['element_400']; ?>");
            $("input#element_401").val("<?php echo $cert[0]['element_401']; ?>");
            $("input#element_633").val("<?php echo $cert[0]['element_633']; ?>");
            $("input#element_635").val("<?php echo $cert[0]['element_635']; ?>");
            $("input#element_632").val("<?php echo $cert[0]['element_632']; ?>");
            $("input#element_634").val("<?php echo $cert[0]['element_634']; ?>");
            <?php
            if($cert[0]['element_402_1']==1){//skids
                ?>
                $("#element_402_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_402_2']==1){//pallets
                ?>
                $("#element_402_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_402_3']==1){//bulk 
                ?>
                $("#element_402_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_402_4']==1){//bulk 
                ?>
                $("#element_402_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_402_5']==1){//bulk 
                ?>
                $("#element_402_5").prop('checked',true);
                <?php
             }
             if($cert[0]['element_402_6']==1){//bulk 
                ?>
                $("#element_402_6").prop('checked',true);
                <?php
             }
             
            ?>
            
            $("input#element_629").val("<?php echo $cert[0]['element_629']; ?>");
            $("input#element_631").val("<?php echo $cert[0]['element_631']; ?>");
            $("input#element_628").val("<?php echo $cert[0]['element_628']; ?>");
            $("input#element_630").val("<?php echo $cert[0]['element_630']; ?>");            
            $("input#element_403").val("<?php echo $cert[0]['element_403']; ?>");
            $("input#element_404").val("<?php echo $cert[0]['element_404']; ?>");
            $("input#element_453").val("<?php echo $cert[0]['element_453']; ?>");
            $("input#element_405").val("<?php echo $cert[0]['element_405']; ?>");
            $("input#element_407").val("<?php echo $cert[0]['element_407']; ?>");
            $("input#element_408").val("<?php echo $cert[0]['element_408']; ?>");
            $("input#element_409").val("<?php echo $cert[0]['element_409']; ?>");
            $("input#element_413").val("<?php echo $cert[0]['element_413']; ?>");
            $("input#element_414").val("<?php echo $cert[0]['element_414']; ?>");
            $("input#element_415").val("<?php echo $cert[0]['element_415']; ?>");
            $("input#element_416").val("<?php echo $cert[0]['element_416']; ?>");
            $("input#element_417").val("<?php echo $cert[0]['element_417']; ?>");
            $("input#element_418").val("<?php echo $cert[0]['element_418']; ?>");
            
            //  petfood 7
            $("select#element_420").val("<?php echo $cert[0]['element_420']; ?>");
            $("input#element_421").val("<?php echo $cert[0]['element_421']; ?>");
            <?php
            if($cert[0]['element_422_1']==1){//skids
                ?>
                $("#element_422_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_422_2']==1){//pallets
                ?>
                $("#element_422_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_422_3']==1){//bulk 
                ?>
                $("#element_422_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_422_4']==1){//bulk 
                ?>
                $("#element_422_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_422_5']==1){//bulk 
                ?>
                $("#element_422_5").prop('checked',true);
                <?php
             }
             if($cert[0]['element_422_6']==1){//bulk 
                ?>
                $("#element_422_6").prop('checked',true);
                <?php
             }
             
            ?>
            $("input#element_636").val("<?php echo $cert[0]['element_636']; ?>");
            $("input#element_637").val("<?php echo $cert[0]['element_637']; ?>");
            $("input#element_639").val("<?php echo $cert[0]['element_639']; ?>");
            $("input#element_638").val("<?php echo $cert[0]['element_638']; ?>");
            
            
            $("input#element_423").val("<?php echo $cert[0]['element_423']; ?>");
            $("input#element_424").val("<?php echo $cert[0]['element_424']; ?>");
            $("input#element_425").val("<?php echo $cert[0]['element_425']; ?>");
            $("input#element_426").val("<?php echo $cert[0]['element_426']; ?>");
            $("input#element_427").val("<?php echo $cert[0]['element_427']; ?>");
            $("input#element_428").val("<?php echo $cert[0]['element_428']; ?>");
            $("input#element_429").val("<?php echo $cert[0]['element_429']; ?>");
            $("input#element_430").val("<?php echo $cert[0]['element_430']; ?>");
            $("input#element_431").val("<?php echo $cert[0]['element_431']; ?>");
            $("input#element_432").val("<?php echo $cert[0]['element_432']; ?>");
            $("input#element_433").val("<?php echo $cert[0]['element_433']; ?>");
            $("input#element_434").val("<?php echo $cert[0]['element_434']; ?>");
            $("input#element_435").val("<?php echo $cert[0]['element_435']; ?>");
            
            //  petfood 8
            $("select#element_437").val("<?php echo $cert[0]['element_437']; ?>");
            $("input#element_438").val("<?php echo $cert[0]['element_438']; ?>");
            <?php
            if($cert[0]['element_439_1']==1){//skids
                ?>
                $("#element_439_1").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_439_2']==1){//pallets
                ?>
                $("#element_439_2").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_439_3']==1){//bulk 
                ?>
                $("#element_439_3").prop('checked',true);
                <?php
             }
             if($cert[0]['element_439_4']==1){//bulk 
                ?>
                $("#element_439_4").prop('checked',true);
                <?php
             }
             
             if($cert[0]['element_439_5']==1){//bulk 
                ?>
                $("#element_439_5").prop('checked',true);
                <?php
             }
             if($cert[0]['element_439_6']==1){//bulk 
                ?>
                $("#element_439_6").prop('checked',true);
                <?php
             }
             
            ?>
            $("input#element_641").val("<?php echo $cert[0]['element_641']; ?>");
            $("input#element_643").val("<?php echo $cert[0]['element_643']; ?>");
            $("input#element_640").val("<?php echo $cert[0]['element_640']; ?>");
            $("input#element_642").val("<?php echo $cert[0]['element_642']; ?>");
            
            
            $("input#element_440").val("<?php echo $cert[0]['element_440']; ?>");
            $("input#element_441").val("<?php echo $cert[0]['element_441']; ?>");
            $("input#element_442").val("<?php echo $cert[0]['element_442']; ?>");
            $("input#element_443").val("<?php echo $cert[0]['element_443']; ?>");
            $("input#element_444").val("<?php echo $cert[0]['element_444']; ?>");
            $("input#element_445").val("<?php echo $cert[0]['element_445']; ?>");
            $("input#element_446").val("<?php echo $cert[0]['element_446']; ?>");
            $("input#element_447").val("<?php echo $cert[0]['element_447']; ?>");
            $("input#element_448").val("<?php echo $cert[0]['element_448']; ?>");
            $("input#element_449").val("<?php echo $cert[0]['element_449']; ?>");
            $("input#element_450").val("<?php echo $cert[0]['element_450']; ?>");
            $("input#element_451").val("<?php echo $cert[0]['element_451']; ?>");
            $("input#element_452").val("<?php echo $cert[0]['element_452']; ?>");
            <?php
    
    
    //*********PETFOOD *****************//
    
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
    $("input#element_3").val("<?php echo $cert[0]['element_3']; ?>");
    $("input#element_16").val("<?php echo $_GET['completed_id']; ?>");        
    $("input#element_5_1").val("<?php echo $cert[0]['element_5_1']; ?>");
    $("input#element_5_2").val("");
    $("input#element_8_1").val("<?php echo $element_8[1]; ?>");
    $("input#element_8_2").val("<?php echo $element_8[2]; ?>");
    $("input#element_8_3").val("<?php echo $element_8[0]; ?>");
    $("input#element_9_1").val("<?php echo $t; ?>");
    $("input#element_9_2").val("<?php echo $element_9[1] ?>");
   
    $("#element_136").val("<?php switch($cert[0]['ltype']){ case 2: echo "1"; break; case 1: echo "2"; break; default: echo "3"; break; } ?>");//type of load
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
        //$("input#element_178").val("<?php echo $cert[0]['element_178']; ?>");//Total Load Weight 
        //$("input#element_143").val("<?php echo $cert[0]['element_143']; ?>");//Total Shrink 
        $("input#element_144").val("<?php echo $cert[0]['element_144']; ?>");//Product Net 
        $("#element_191").val("<?php echo $cert[0]['element_191']; ?>");
        $("input#element_195").val("<?php echo $cert[0]['element_195'] ?>");
        $("input#element_196").val("<?php echo $cert[0]['element_196']; ?>");
        $("input#element_197").val("<?php echo $cert[0]['element_197']; ?>");
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
        $("input#element_189").val("<?php echo $cert[0]['element_189'] ?>");//Scale Net Weight 
        $("input#element_655").val("<?php echo $cert[0]['element_655']; ?>");
        <?php
}
?>
</script>
<script type="text/javascript" src="petfood.js"></script>