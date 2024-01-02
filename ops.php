<style>
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<?php
    $links = array(
        "<a href='https://inet.iwpusa.com/machforms/machform' target='_blank'>Forms Admin Portal</a>"=>"Forms Admin Portal",
        "<a href='https://inet.iwpusa.com/AZsilage.php' target='_blank'>Arizona Silage</a>"=>"Arizona Silage",
        "<a href='https://inet.iwpusa.com/Vsilage.php' target='_blank'>Selma Silage</a>"=>"Selma Silage",
        "<a href='https://inet.iwpusa.com/NMsilage.php' target='_blank'>NewMex/WestTX/KS Silage</a>"=>"NewMex/WestTX/KS Silage",
        "<a href='https://inet.iwpusa.com/NMloadreport.php' target='_blank'>NewMex/WestTX/KS Load Report</a>"=>"NewMex/WestTX/KS Load Report",
        "<a href='https://inet.iwpusa.com/SoCalloadreport.php' target='_blank'>Southern CA Load Report</a>"=>"Southern CA Load Report",
        "<a href='https://inet.iwpusa.com/IWPphonereimbursement.php' target='_blank'>Phone Reimbursement Form</a>"=>"Phone Reimbursement Form",
        "<a href='https://inet.iwpusa.com/DigesterLog.php' target='_blank'>Digester Log</a>"=>"Digester Log",
        "<a href='https://inet.iwpusa.com/expense.php' target='_blank'>Expense Receipts</a>"=>"Expense Receipts",
        "<a href='https://inet.iwpusa.com/NewBuyerRequest.php' target='_blank'>New Buyer Request Form</a>"=>"New Buyer Request Form",
        "<a href='https://inet.iwpusa.com/StatusChangeForm.php' target='_blank'>Payroll Status Change</a>"=>"Payroll Status Change",
        "<a href='https://inet.iwpusa.com/CorpTravRequest.php' target='_blank'>Corporate Travel Request</a>"=>"Corporate Travel Request",
        "<a href='https://inet.iwpusa.com/WorkOrder.php' target='_blank'>Work Order</a>"=>"Work Order",
        "<a href='https://inet.iwpusa.com/CWtest.php' target='_blank'>CW Product Information Report</a>"=>"CW Product Information Report",
		"<a href='https://inet.iwpusa.com/Glendale.php' target='_blank'>Glendale Product Information Report</a>"=>"Glendale Product Information Report",
		"<a href='https://inet.iwpusa.com/GlendaleOperator.php' target='_blank'>Glendale Operator Report</a>"=>"Glendale Product Information Report",
        "<a href='https://inet.iwpusa.com/deposit.php' target='_blank'>MISC Check Deposits</a>"=>"MISC Check Deposits"
        
    );

?>

<ul style="width: 95%;">
    <?php
        arsort($links,SORT_NATURAL);
        $x = array_reverse($links);
        foreach($x as $key=>$value){
            echo "<li>$key</li>";
        }
    ?>
    

   <!-- <li style="margin-top: 5px;"><a href="https://inet.iwpusa.com/BioFuels.php" target="_blank">Biotane Fuels - Daily Iventory</a></li>

    <li style="margin-top: 5px;"><a href="https://inet.iwpusa.com/BD1.php" target="_blank">Biotane Fuels - Stage 1</a></li>

    <li style="margin-top: 5px;"><a href="https://inet.iwpusa.com/BD2.php" target="_blank">Biotane Fuels - Stage 2</a></li>

    <li style="margin-top: 5px;"><a href="https://inet.iwpusa.com/BD3.php" target="_blank">Biotane Fuels - Stage 3</a></li>

    <li style="margin-top: 5px;"><a href="https://inet.iwpusa.com/BDwash.php" target="_blank">Biotane Fuels - Wash Tanks</a></li>

    <li style="margin-top: 5px;"><a href="https://inet.iwpusa.com/BD.php" target="_blank">Biotane Fuels - Transfer Summary</a></li>-->


    </ul>
