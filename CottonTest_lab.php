<?php
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: No-reply@iwpusa.com'."\r\n".'Reply-To: No-reply@iwpusa.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
include "scaleFunctions.php";
    date_default_timezone_set(@date_default_timezone_get());
    
    include "protected/global.php";
        if($_SESSION['username'] == "RDizon"){
        ini_set("display_errors",1);
    }
    
    $mode ="";
    
    if(isset($_GET['key'])){
        $nj = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2 FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE TransactionKey= $_GET[key]");
        
        $date_time = explode(" ",$nj[0]['WeighIn']);
        $date = explode("-",$date_time[0]);
        $time = explode(":",$date_time[1]);
        print_r($nj);
        
        
     
        $check_retest = $db->query("SELECT * FROM Inetforms.ap_form_43646 WHERE element_27 = ".$nj[0]['tk']."  ORDER BY date_created DESC ");
        if(count($check_retest)>1){
            $t1 = $check_retest[0]['element_10']  - $check_retest[1]['element_10'];
            
            if( abs($t1)>=  3000 ){
                mail("bthomas@iwpusa.com,cnutting@iwpusa.com,edizon@iwpusa.com","-----COTTON SEED DISCREPENCY REPORT ALERT-----"," This load has a discrepncy with the lot sample of 3000 or more.",$header);
            }
        }
    }
    

date_default_timezone_set(@date_default_timezone_get());
header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 

require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 43646;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);

?>
<script>

<?php
    if(isset($_GET['key'])){
        
       ?>
           $("input#element_1_1").val('<?php echo "$date[1]"; ?>'); 
           $("input#element_1_2") .val('<?php echo "$date[2]"; ?>');
           $("input#element_1_3") .val('<?php echo "$date[0]"; ?>');  
           $("input#element_2_1").val('<?php echo "$time[0]"; ?>');        
           $("input#element_2_2").val('<?php echo "$time[1]"; ?>');
           
           
        <?php
        if($time[0]<12){
            ?>
            $("#element_2_4").val('<?php echo "AM" ?>');
            <?php
        }else{
            ?>
            $("#element_2_4").val('<?php echo "PM" ?>');
            <?php
        }
    }
   ?>
            $("#element_16").val(<?php 
            
                if($nj[0]['CustomerKey'] == NULL){
                    $test = Vendors($nj[0]['VendorKey']);
                }else{
                    $test = CustomerKey($nj[0]['CustomerKey']);
                }
                switch($nj[0]['VendorKey']){
                    case 1630 :
                        $pro = 5;
                    break;
                    case 1632:
                        $pro = 1;
                    break;
                    case 616:
                        $pro = 2;
                    break;
                    default:
                        $pro = 3;
                    break;
                    
                }
            echo $pro;  ?>);
            $("input#element_7").val('<?php echo $check_retest[0]['element_7']; ?>');
            $("input#element_8").val('<?php echo $nj[0]['name']; ?>');
            $("input#element_9").val('<?php echo productKey($nj[0]['ProductKey']); ?>');
            $("input#element_13").val('<?php echo $nj[0]['UF3Data']; ?>');
            $("input#element_15").val('<?php echo $nj[0]['tk']; ?>');
            $("#element_25").val('<?php 
                switch($nj[0]['ProductKey']){
                    case 84://cotton seed
                        echo 1;
                    break;
                    case 87://whole pima
                        echo 3;
                    break;
                    case 80://treated
                        echo 2;
                    break;
                    default:
                        echo 4;
                    break;
                }
            
            ?>');
            $("input#element_27").val('<?php echo $_GET['id']; ?>');
            $("input#element_10").val('<?php echo $t1; ?>');
            $("input#element_28").val('<?php echo $t2; ?>');
            $("input#element_29").val('<?php echo $t3; ?>');
            $("input#element_24").val('<?php echo $nj[0]['tk']; ?>');
</script>