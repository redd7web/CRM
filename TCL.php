<?php 
ini_set("display_errors",1);
date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
include "protected/global.php";
session_start();
if(isset($_GET['entry_id'])){
    $tcl = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE ap_form_43256.id = $_GET[entry_id]");
}


require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 43256;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
<script>
<?php

if(isset($_GET['entry_id'])){
    if(count($tcl)>0){
        $date = explode("-",$tcl[0]['element_2']);// 0 year 1 month 2 day
        $time = explode(":",$tcl[0]['element_3']);
        
        $timein = explode(":",$tcl[0]['element_98']);
        $timeout = explode(":",$tcl[0]['element_99']);
        ?>
        $("input#element_2_1").val("<?php echo $date[1] ?>");
        $("input#element_2_2").val("<?php echo $date[2] ?>");
        $("input#element_2_3").val("<?php echo $date[0] ?>");
        
        $("input#element_3_1").val("<?php echo $time[0] ?>");
        $("input#element_3_2").val("<?php echo $time[1] ?>");
        $("input#element_3_3").val("<?php echo $time[2] ?>");
        
        $("select#element_114").val("<?php echo $tcl[0]['element_114'] ?>");
        $("select#element_1").val("<?php echo $tcl[0]['element_1'] ?>");
        $("select#element_14").val("<?php echo $tcl[0]['element_14'] ?>");
        
        $("select#element_16").val("<?php echo $tcl[0]['element_16']; ?>");
        $("input#element_18").val("<?php echo $tcl[0]['element_18'] ?>");
        $("input#element_19").val("<?php echo $tcl[0]['element_19']; ?>");
        
        $("select#element_20").val("<?php echo $tcl[0]['element_20']; ?>");
        $("select#element_22").val("<?php echo $tcl[0]['element_20']; ?>");
        $("input#element_24").val("<?php echo $tcl[0]['element_24'] ?>");
        $("input#element_25").val("<?php echo $tcl[0]['element_25'] ?>");
        $("input#element_116").val("<?php echo $tcl[0]['element_116'] ?>");
        $("input#element_117").val("<?php echo $tcl[0]['element_117'] ?>");
        $("input#element_118").val("<?php echo $tcl[0]['element_118'] ?>");
        $("input#element_119").val("<?php echo $tcl[0]['element_119'] ?>");
        $("input#element_38").val("<?php echo $tcl[0]['element_38'] ?>");
        $("input#element_40").val("<?php echo $tcl[0]['element_40'] ?>");
        $("input#element_42").val("<?php echo $tcl[0]['element_42']; ?>")
        $("select#element_44").val("<?php echo $tcl[0]['element_44'] ?>");
        $("select#element_46").val("<?php echo $tcl[0]['element_46'] ?>");
        $("input#element_48").val("<?php echo $tcl[0]['element_48'] ?>");
        $("input#element_49").val("<?php echo $tcl[0]['element_49'] ?>");
        $("input#element_98_1").val("<?php echo  $timein[0] ?>");
        $("input#element_98_2").val("<?php echo $timein[1]; ?>");
        
        $("input#element_99_1").val("<?php echo $timeout[0]; ?>");
        $("input#element_99_2").val("<?php echo $timeout[1]; ?>");
        
        $("input#element_124").val("<?php echo $tcl[0]['element_124'] ?>");
        $("input#element_127").val("<?php echo $tcl[0]['element_127'] ?>");
        $("input#element_125").val("<?php echo $tcl[0]['element_125'] ?>");
        $("input#element_126").val("<?php echo $tcl[0]['element_126'] ?>");
        
        $("input#element_26").val("<?php echo $tcl[0]['element_26'] ?>");
        $("select#element_28").val("<?php echo $tcl[0]['element_28'] ?>");
        $("input#element_30").val("<?php echo $tcl[0]['element_30'] ?>");
        $("input#element_31").val("<?php echo $tcl[0]['element_31'] ?>");
        $("select#element_32").val("<?php echo $tcl[0]['element_32'] ?>");
        $("select#element_34").val("<?php echo $tcl[0]['element_34'] ?>");
        $("input#element_36").val("<?php echo $tcl[0]['element_36'] ?>");
        $("input#element_37").val("<?php echo $tcl[0]['element_37'] ?>");
        $("input#element_120").val("<?php echo $tcl[0]['element_120'] ?>");
        $("input#element_121").val("<?php echo $tcl[0]['element_121']; ?>");
        $("input#element_122").val("<?php echo $tcl[0]['element_122'] ?>");
        $("input#element_123").val("<?php echo $tcl[0]['element_123'] ?>");
        $("select#element_62").val("<?php echo $tcl[0]['element_62'] ?>");
        $("select#element_64").val("<?php echo $tcl[0]['element_64'] ?>");
        $("input#element_66").val("<?php echo $tcl[0]['element_66'] ?>");
        $("input#element_67").val("<?php echo $tcl[0]['element_67'] ?>");
        $("select#element_68").val("<?php echo $tcl[0]['element_68'] ?>");
        $("select#element_70").val("<?php echo $tcl[0]['element_70'] ?>");
        $("input#element_72").val("<?php echo $tcl[0]['element_72'] ?>");
        $("input#element_73").val("<?php echo $tcl[0]['element_73'] ?>");
        $("input#element_74").val("<?php echo $tcl[0]['element_74'] ?>");
        $("select#element_75").val("<?php echo $tcl[0]['element_75'] ?>");
        $("select#element_77").val("<?php echo $tcl[0]['element_77'] ?>");
        $("select#element_79").val("<?php echo $tcl[0]['element_79'] ?>");
        $("select#element_80").val("<?php echo $tcl[0]['element_80'] ?>");
        $("select#element_81").val("<?php echo $tcl[0]['element_81'] ?>");
        $("select#element_83").val("<?php echo $tcl[0]['element_83'] ?>");
        $("input#element_85").val("<?php echo $tcl[0]['element_85'] ?>");
        $("input#element_86").val("<?php echo $tcl[0]['element_86'] ?>");
        $("input#element_111").val("<?php echo $tcl[0]['element_111'] ?>");
        $("select#element_88").val("<?php echo $tcl[0]['element_88'] ?>");
        $("select#element_90").val("<?php echo $tcl[0]['element_90'] ?>");
        $("input#element_92").val("<?php echo $tcl[0]['element_92'] ?>");
        $("input#element_93").val("<?php echo $tcl[0]['element_93'] ?>");
        $("select#element_94").val("<?php echo $tcl[0]['element_94'] ?>");
        $("select#element_96").val("<?php echo $tcl[0]['element_96'] ?>");
        $("input#element_87").val("<?php echo $tcl[0]['element_87'] ?>");
        $("select#element_100").val("<?php echo $tcl[0]['element_100'] ?>");
        $("select#element_102").val("<?php echo $tcl[0]['element_102'] ?>");
        $("input#element_104").val("<?php echo $tcl[0]['element_104'] ?>");
        $("input#element_105").val("<?php echo $tcl[0]['element_105'] ?>");
        
        $("select#element_106").val("<?php echo $tcl[0]['element_106'] ?>");
        $("select#element_108").val("<?php echo $tcl[0]['element_108'] ?>");
        $("input#element_110").val("<?php echo $tcl[0]['element_110'] ?>");
        $("input#element_112").val("<?php echo $tcl[0]['element_112'] ?>");
        $("input#element_113").val("<?php echo $tcl[0]['element_113'] ?>");
        $("select#element_50").val("<?php echo $tcl[0]['element_50'] ?>");
        $("select#element_52").val("<?php echo $tcl[0]['element_52'] ?>");
        
        $("input#element_54").val("<?php echo $tcl[0]['element_54'] ?>");
        $("input#element_55").val("<?php echo $tcl[0]['element_55'] ?>");
        $("select#element_56").val("<?php echo $tcl[0]['element_56'] ?>");
        $("select#element_58").val("<?php echo $tcl[0]['element_58'] ?>");
        $("input#element_60").val("<?php echo $tcl[0]['element_60'] ?>");
        $("input#element_61").val("<?php echo $tcl[0]['element_61'] ?>");
        
        $("select#element_129").val("<?php echo $tcl[0]['element_129'] ?>");
        $("select#element_131").val("<?php echo $tcl[0]['element_131'] ?>")
        $("input#element_133").val("<?php echo $tcl[0]['element_133'] ?>")
        $("input#element_134").val("<?php echo $tcl[0]['element_134'] ?>")
        $("select#element_135").val("<?php echo $tcl[0]['element_135'] ?>")
        $("select#element_137").val("<?php echo $tcl[0]['element_137'] ?>")
        $("select#element_142").val("<?php echo $tcl[0]['element_142'] ?>")
        $("input#element_140").val("<?php echo $tcl[0]['element_140'] ?>")
        $("input#element_141").val("<?php echo $tcl[0]['element_141'] ?>");
        $("input#element_147").val("<?php echo $tcl[0]['element_147']; ?>");
        <?php
    }
}


?>

</script>