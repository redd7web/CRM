<?php 

header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
session_start();

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 29942;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

$route_id = $_GET['route_id'];
//echo $route_id;


$schedule_id = $_GET['schedule_id'];
//echo $schedule_id;

$account_no = $_GET['account_no'];
//echo $account_no;
?>

<script>
$("#element_3").attr('value',<?php echo $_GET['route_id']; ?>);
$("#element_2").attr('value',<?php echo $_GET['schedule_id']; ?>);
$("#element_1").attr('value',<?php echo $_GET['account_no']; ?>);

$("#form_29942").attr('target','sb-player');
</script>
