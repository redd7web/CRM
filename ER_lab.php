<?php
ini_set("display_errors",0);
    date_default_timezone_set(@date_default_timezone_get());
    
    include "protected/global.php";
    $mode ="";
    
    if(isset($_GET['key'])){
        $nj = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2 FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE TransactionKey= $_GET[key]");
        $date_time = explode(" ",$nj[0]['WeighIn']);
        $date = explode("-",$date_time[0]);
        $time = explode(":",$date_time[1]);
        print_r($nj);
    }
    
?>
<script type="text/javascript" src="js/jquery-1.11.1.js: echo "></script>

<?php 

header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 44342;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
echo "<script>";
echo "</script>";
display_machform($mf_param);

?>
<script>
<?php
if(isset($_GET['key'])){
    switch($nj[0]['ProductKey']){
        case 20: case 22: case 29: case 55:  case 67: case 76: case 82:  case 84: case 86: case 90: //miu FFA pre selected
        ?>
            $("#element_6_14").prop("checked",true);
            $("#element_6_13").prop("checked",true);
        <?php
        break;
    }
   ?>
       $("input#element_2_2").val('<?php echo $time[1] ?>');
       $("input#element_2_1").val('<?php echo $time[0] ?>');
       $("input#element_1_3").val('<?php echo $date[0];  ?>'); 
       $("input#element_1_2").val('<?php echo $date[2];  ?>'); 
       $("input#element_1_1").val('<?php echo $date[1];  ?>'); 
       $("input#element_83").val('<?php echo $nj[0]['tk'] ?>');
       $("input#element_82").val('<?php echo $nj[0]['UF1Data']; ?>'); 
       $("input#element_76").val('<?php echo $nj[0]['TruckKey']; ?>');
       $("input#element_77").val('<?php echo $nj[0]['tk']; ?>');
       $("input#element_1_1").val(<?php echo "$date[1]"; ?>); 
       $("input#element_1_2") .val(<?php echo "$date[2]"; ?>);
       $("input#element_1_3") .val(<?php echo "$date[3]"; ?>);           
    <?php
}
   ?>

</script>