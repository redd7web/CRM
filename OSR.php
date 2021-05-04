<?php 
//<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
//<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
 session_start();
date_default_timezone_set(@date_default_timezone_get());
ini_set("display_errors",1);
include "protected/global.php";
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"");



header("Cache-Control: no-cache, must-revalidate");




if(isset($_GET['entry_id'])){
    $x = $db->query("SELECT * FROM Inetforms.ap_form_42682 WHERE id=$_GET[entry_id]");
}

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 42682;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
<script>
<?php
if(isset($_GET['entry_id'])){
    ?>
     $("select#element_2").val("<?php echo $x[0]['element_2']; ?>")
    <?php
    if($x[0]['element_1'] == 1){
        ?>
        $("#element_1_1").prop("checked",true);    
        <?php
    }
    if($x[0]['element_1'] == 2){
        ?>
        $("#element_1_2").prop("checked",true);    
        <?php
    }
    
    
    if($x[0]['element_1'] == 5){
        ?>
        $("#element_1_5").prop("checked",true);    
        <?php
    }
    
    if($x[0]['element_1'] == 6){
        ?>
        $("#element_1_6").prop("checked",true);    
        <?php
    }
    
    if($x[0]['element_1'] == 7){
        ?>
        $("#element_1_7").prop("checked",true);    
        <?php
    }
    
    if($x[0]['element_1'] == "" || $x[0]['element_1'] == " " ){
        ?>
        $("#element_1_0").prop("checked",true);    
        $("input#element_1_other").val("<?php $x[0]['element_1_other']; ?>")
        <?php
    }

}
?>

$("select#element_5").val("<?php echo $x[0]['element_5'] ?>");
$("select#element_6").val("<?php echo $x[0]['element_6']; ?>");
$("select#element_7").val("<?php echo $x[0]['element_7']; ?>");
$("select#element_9").val("<?php echo $x[0]['element_9'] ?>");
$("select#element_10").val("<?php echo $x[0]['element_10'] ?>");
$("select#element_11").val("<?php echo $x[0]['element_11'] ?>");
$("select#element_13").val("<?php echo $x[0]['element_13'] ?>");
$("select#element_14").val("<?php echo $x[0]['element_14'] ?>");
$("select#element_16").val("<?php echo $x[0]['element_16'] ?>");
$("select#element_17").val("<?php echo $x[0]['element_17'] ?>");
$("select#element_18").val("<?php echo $x[0]['element_18'] ?>");
$("select#element_20").val("<?php echo $x[0]['element_20'] ?>");
$("select#element_21").val("<?php echo $x[0]['element_21'] ?>");
$("select#element_23").val("<?php echo $x[0]['element_23'] ?>");
$("select#element_24").val("<?php echo $x[0]['element_24'] ?>");
</script>
