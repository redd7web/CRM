<?php

include "protected/global.php";
include "source/css.php";
?>
<style type="text/css">
body{
    margin:10px 10px 10px 10px;
    padding:10px 10px 10px 10px;
}
</style>
<?php
if(isset($_SESSION['id'])){
    
    if(isset($_GET['form_id']) ) {
        require("/var/www/html/machforms/machform/machform.php");
        $mf_param['form_id'] = $_GET['form_id'];
        $mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
        $mf_param['show_border'] = true;
        display_machform($mf_param);

    }else{
        echo "<h1>Please Choose a form to view</h1>";
        ?>
        <ol style="width: 95%;">
          <li>OPS Forms  
                <ul>
                   <li><a href='inetforms.php?form_id=11481' >Arizona Silage</a></li>
                   <li><a href='inetforms.php?form_id=27963' >CW Product Information Report</a></li>
                   <li><a href='inetforms.php?form_id=21605' >Corporate Travel Request</a></li>
                   <li><a href='inetforms.php?form_id=16740' >Digester Log</a></li>
                   <li><a href='inetforms.php?form_id=18922' >Expense Receipts</a></li>
                   <li><a href='inetforms.php?form_id=46040' >MISC Check Deposits</a></li>
                   <li><a href='inetforms.php?form_id=19656' >New Buyer Request Form</a></li>
                   <li><a href='inetforms.php?form_id=11670' >NewMex/WestTX/KS Load Report</a></li>
                   <li><a href='inetforms.php?form_id=12555' >NewMex/WestTX/KS Silage</a></li>
                   <li><a href='inetforms.php?form_id=20625' >Payroll Status Change</a></li>
                   <li><a href='inetforms.php?form_id=16249' >Phone Reimbursement Form</a></li>
                   <li><a href='inetforms.php?form_id=13504' >Selma Silage</a></li>
                   <li><a href='inetforms.php?form_id=12870' >Southern CA Load Report</a></li>
                   <li><a href='inetforms.php?form_id=22463' >Work Order</a></li>
                </ul>
          </li>
           <li>Compliance
                <ul>  
                    <li><a href='inetforms.php?form_id=11481'>Counseling Report</a></li>
                    <li><a href='inetforms.php?form_id=11481'>Discrepancy Dashboard</a></li>
                    <li><a href='inetforms.php?form_id=59380'>Employee Missed Break Form</a></li>
                    <li><a href='inetforms.php?form_id=66026'>Facility Inspection</a></li>
                    <li><a href='inetforms.php?form_id=57176'>IWP Driver Ride Along</a></li>
                    <li><a href='inetforms.php?form_id=20034'>Incident Report</a></li>
                    <li><a href='inetforms.php?form_id=17457'>Inspection Discrepancy</a></li>
                    <li><a href='inetforms.php?form_id=58366'>Job Hazard Analysis</a></li>
                    <li><a href='inetforms.php?form_id=67558'>PPE Audit</a></li>
                    <li><a href='inetforms.php?form_id=56011'>Pre-Employment Fitness</a></li>
                    <li><a href='inetforms.php?form_id=57427'>Record of Road Test</a></li>
                    <li><a href='inetforms.php?form_id=35831'>Vehicle/Driver Inspection</a></li>
                </ul>
            </li>
        </ol>
        <?php
    }
    
    
}else{
    echo "Please login to view forms.";
    
    echo'<table style="margin: 0 auto;width:260px;height:100px;font-size:18px;background:#F2F2F2">
        <tr><td style="vertical-align: middle;text-align:left;border:0px solid #bbb;"><input name="biouser" type="text" placeholder="Username" style="width:250px;"/></td></tr><tr><td style="vertical-align:middle;border:0px solid #bbb;"><input name="biopw" type="password" placeholder="Password" style="float:left;width:250px; "/></td></tr>
        <tr><td style="text-align: right;border:0px solid #bbb;"><input type="submit" name="biosub" value="Submit"/></td></tr>
    </table>';
}

?>