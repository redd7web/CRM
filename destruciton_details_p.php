<style>
body{
    background:url(machforms/machform/images/form_resources/moulin.png) repeat left top;
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
.appnitro {
    font-family: "Lucida Grande",Tahoma,Arial,Verdana,sans-serif;
    font-size: small;
    margin:auto;
    margin-top:20px;
}
#main_body h1 a {
    background-image: url("https://inet.iwpusa.com/machforms/machform/data/themes/images/img_57709767059ebb6db91410dc896f7dba-IWP black.jpg");
    height: 100px;
    background-repeat: no-repeat;
    display: block;
}
#main_body h1 {
    text-indent: -8000px;
}
#form_container {
    text-align: left;
}
td{
    padding:15px 15px 15px 15px;
    margin:5px 5px 5px 5px;
    vertical-align:top;
    text-align:left;
}
</style>
<?php
include "protected/global.php";
ini_set("display_errors",1);
$nb = $db->query("SELECT * FROM Inetforms.ap_form_49773 WHERE ap_form_49773.id =$_GET[id]");
/*
echo "<pre>";
echo print_r($nb);
echo "</pre>";*/
?>
<body id="main_body">

<div id="form_container">
<h1>
<a>BAKERY DESTRUCTION Payment DETAIL</a>
</h1>

<table class="appnitro" style="width: 1000px;border-collapse:collapse;font-size:20px;border-radius:10px;background:url(https://inet.iwpusa.com/machforms/machform/images/form_resources/escheresque.png) repeat left top;">
<?php 
    if( $nb[0]['element_146_1'] ==1 ){
    ?>
    <tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
    
    <tr><td colspan="4"><h1  style="color: black;text-indent:0px;width:100%;">Approval Information</h1></td></tr>
    <tr><td>Fuel Surchage</td><td><?php echo $nb[0]['element_645'] ?></td><td>Soybean</td><td><?php echo $nb[0]['element_646']; ?></td></tr>
    
    <tr><td>Base PPT </td><td><?php echo $nb[0]['element_310'] ?></td><td>Light Load DIscount (If in effect) </td><td><?php echo $nb[0]['element_311'] ?></td></tr>
    <tr><td >Water % </td><td ><?php echo $nb[0]['element_314'] ?></td><td>Foreign Substance % </td><td><?php echo $nb[0]['element_313']; ?></td></tr>
    <tr><td colspan="2">ADDTL freight/handling/disposal fee per ton (70) </td><td colspan="2"><?php echo $nb[0]['element_312'] ?></td></tr>
    <tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
    <tr><td colspan="4"><h1  style="color: black;text-indent:0px;width:100%;">Final Price</h1></td></tr>
    <tr><td>PPT Adjustment</td><td><?php echo $nb[0]['element_317']; ?></td><td>Additional flat fee/adjustment </td><td><?php echo $nb[0]['element_318'] ?></td></tr>
    <tr><td colspan="2">Load Calculated Price per Ton </td><td colspan="2"><?php echo $nb[0]['element_316']; ?></td></tr>
    <tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
    <tr><td colspan="4"><h1   style="color: black;text-indent:0px;width:100%;">Contractual Weight Breakdown</h1></td></tr>
<tr><td>Load Net Product Weight </td><td><?php echo $nb[0]['element_184'] ?></td><td>Load Total Shrink (Including Pallets and Excluded Product Weights) </td><td><?php echo $nb[0]['element_185'] ?></td></tr>
<tr><td>Load Gross Weight Total (Calculated) </td><td><?php echo $nb[0]['element_186'] ?></td><td>Scale Net Weight </td><td><?php echo $nb[0]['element_189'] ?></td></tr>

<tr><td>Difference From Scale </td><td><?php echo $nb[0]['element_187'] ?></td><td>Contingency  </td><td><?php echo $nb[0]['element_188'] ?></td></tr>
    <tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Excluded Product Detail</h1><br />Sum totals for product outside of contractual obligations</td></tr>
    
    <?php  
        echo "<tr>";
        if( strlen(trim($nb[0]['element_181']))>0 ){
            echo "<td>Excluded Product Weight </td><td>".$nb[0]['element_181']."</td>";   
        }
        echo "</tr>";
    }
?>

  
  <tr><td>Base Freight</td><td><?php echo $nb[0]['element_648'] ?></td><td>Fuel Adjustment</td><td><?php echo $nb[0]['element_653'] ?></td></tr>  
  <tr><td>Short Notice Discount</td><td><?php echo $nb[0]['element_650'] ?></td><td>Moisture Deduction </td><td><?php echo $nb[0]['element_652'] ?></td></tr>
  
  <tr><td>Adjusted Freight </td><td><?php echo $nb[0]['element_654'] ?></td><td>Mixed Load Product Cost </td><td><?php echo $nb[0]['element_655'] ?></td></tr>
</table>
</div>
</body>