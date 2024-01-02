<?php
//60352

date_default_timezone_set(@date_default_timezone_get());
ini_set("display_errors",1);
include "protected/global.php";
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"");



header("Cache-Control: no-cache, must-revalidate");

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 60352;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);


?>