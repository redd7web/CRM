<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<?php 
ini_set("display_errors",1);
 
include "protected/global.php";

if(isset($_GET['from_io'])){
     $hy = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_77 = '$_GET[wtn]'");
     print_r($hy);
}

date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
session_start();

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 44917;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
