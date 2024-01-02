<?php 
include "protected/global.php";
ini_set("display_errors",1);
if(isset($_GET['tank']) && strlen(trim($_GET['tank']))>0 ){
    $kl = $db->query("SELECT * FROM Inetforms.ap_form_47591 WHERE ap_form_47591.me = $_GET[tank] ");
}
date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
session_start();

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 43939;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
<script>
<?php 
    if(isset($_GET['tank']) && strlen(trim($_GET['tank']))>0 ){
        ?>
        $("#element_31").val("<?php echo $kl[0]['me'];   ?>");
        <?php
    }
?>


</script>