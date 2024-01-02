<?php
include "protected/global.php";
include "scaleFunctions.php";
if($_SESSION['username'] == "RDizon"){
    ini_set("display_errors",0);
}
$manage = array (1,2,8);
$calc_check = array(82,86,20);
$billers = array(1,2,8);

$product_restrict = array(4,9,10,11,12,13,16,17,18,19,23,24,26,27,28,32,36,37,38,40,42,43,44,45,46,47,48,53,56,57,58,59,60,61,64,65,66,68,70,71,72,73,74,75,77,78,79,81,83,22,55,67,76,87,90);


if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    
    session_destroy();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
include "source/scripts.php";
include "source/css.php";
?>
<link rel="stylesheet" href="css/jquery.datetimepicker.css"/>
<link rel="stylesheet" href="css_excel/excel-2007.css"/>
<style type="text/css">
  body{
    font-size:12px;
    padding:10px 10px 10px 10px;
    margin: 10px 10px 10px 10px;
  }
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
    overflow-x:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}

#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
     vertical-align:middle;
}

td,th{
    background:transparent;
    text-align:center;
    width:1%;
    font-size:12px;
    border:1px solid black;
    
}

th{
    vertical-align:top;
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
    display:table-row
}

tr.odd{
    background:transparent;
    display:table-row
}
.setThisRoute{ 
    z-index:9999;
}



input[type=checkbox]{
    width:10px;
}

</style>

<script>
$(document).ready(function(){
   $('.myTable').dataTable({
        "order": [ 6, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});


$( function() {
         $( ".accordion" ).accordion({
            collapsible: true,
            active: false
        });
        $( "#tabs" ).tabs({
        <?php 
        if(isset($_GET['tab'])){
            switch($_GET['tab']){
                case 1:
                    ?>
                    active:0
                    <?php
                break;
                case 2:
                     ?>
                    active:1
                    <?php
                break;
            }    
        }
        ?>
        });
    });

</script>
<title>Billing Dashboard</title>
</head>
<body>
<?php
if(isset($_POST['scale_login'])){
    
    //role, first name,last name, username
    $hash = crypt(trim($_POST['scale_password']),'$ap_form_64550');
    if($_SESSION['username'] =="RDizon"){
        echo "$hash $_POST[scale_name] ";
        echo "SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'";
    }
    
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1,element_10_1,element_10_2,element_10_3,element_10_4,element_10_5,element_10_6,element_10_7,element_10_8,element_10_9,element_10_10,element_10_11,element_10_12,element_10_13,element_10_14,element_10_15,element_10_16,element_10_17,element_10_18,element_10_19,element_10_20,element_10_21,element_10_22,element_10_23,element_10_24,element_10_25,element_10_26,element_10_27,element_10_28,element_10_29,element_10_30,element_10_32 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'");
    if($_SESSION['username'] =="RDizon"){
        print_r($lookup);
    }
    if( count($lookup)>0 && in_array($lookup[0]['element_9'],$manage  )){
        
        $_SESSION['division'] = explode("|",$lookup[0]['element_10_1']."|".$lookup[0]['element_10_2']."|".$lookup[0]['element_10_3']."|".$lookup[0]['element_10_4']."|".$lookup[0]['element_10_5']."|".$lookup[0]['element_10_6']."|".$lookup[0]['element_10_7']."|".$lookup[0]['element_10_8']."|".$lookup[0]['element_10_9']."|".$lookup[0]['element_10_10']."|".$lookup[0]['element_10_11']."|".$lookup[0]['element_10_12']."|".$lookup[0]['element_10_13']."|".$lookup[0]['element_10_14']."|".$lookup[0]['element_10_15']."|".$lookup[0]['element_10_16']."|".$lookup[0]['element_10_17']."|".$lookup[0]['element_10_18']."|".$lookup[0]['element_10_19']."|".$lookup[0]['element_10_20']."|".$lookup[0]['element_10_21']."|".$lookup[0]['element_10_22']."|".$lookup[0]['element_10_23']."|".$lookup[0]['element_10_24']."|".$lookup[0]['element_10_25']."|".$lookup[0]['element_10_26']."|".$lookup[0]['element_10_27']."|".$lookup[0]['element_10_28']."|".$lookup[0]['element_10_29']."|".$lookup[0]['element_10_30']."|".$lookup[0]['element_10_32']);
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }else{
        $error = "Sorry, only Admins and Billing Users may view this Dashboard.";
    }
    
    
}
if(!isset($_SESSION['billing'])){ ?>
<form action="billingdash.php" method="POST">
<table style="width:200px;position:fixed;top:5px;right:5px;border-radius:10px 10px 10px 10px;border:2px solid green;padding:5px 5px 5px 5px;">
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;" type="text" name="scale_name" placeholder="Username"/></td></tr>
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;box-shadow:inset 0 0 5px green;padding:5px 5px 5px 5px;"  type="password" name="scale_password" placeholder="Password"/></td></tr>
<tr><td colspan="2" style="text-align: right;border:0px solid #bbbbbb;"><input style="width: 100px;height:30px;background:url(img/login_clean.png) no-repeat center center;background-size:100% 100%;border:0px solid #bbbbbb;margin-top:4px;padding:5px 5px 5px 5px;" type="submit" value="" name="scale_login"/></td></tr>
<tr><td colspan="2"><?php echo $error;?></td></tr>
</table>
</form>
<?php
}else {
    echo "<h2>Welcome, $_SESSION[username]&nbsp; <a href='billingdash.php?task=logout'><img src='img/logout.jpg' title='Logout'/></a></h2>"; ?>
    
    
<h1 style="margin-top: 50px;">IWP SCALE Billing</h1>
<div id="tabs" style="width: auto;display:inline-block;">
  <ul>
    <li><a href="#fragment-1">To be Billed</a></li>
    
    <li><a href="#fragment-3">Grease Tab  Calculations</a></li>
    <li><a href="#fragment-2">Billed</a></li>
  </ul>
  <div id="fragment-1">
  <?php
    if(isset($_POST['outbound_search'])){
    
         foreach($_POST as $name=>$value){
            switch($name){
                case "product":
                    if(strlen(trim($value))>0){
                        $outboundField[]= " ProductKey = $value";
                    }
                break;
                case "release_number":
                    if(strlen(trim($value))>0){
                        $outboundField[]= " UF1Data like  '%$value%'";
                    }
                break;
                
                case "vendor":
                   if(strlen(trim($value))>0){
                     $outboundField[]= " VendorKey = $value";
                   }
                break;
                case "buyer":
                    if(strlen(trim($value))>0){
                        $outboundField[]= " CustomerKey = $value";
                    }
                break;
                case "driver":
                    if(strlen(trim($value))>0){
                        $outboundField[]= " TruckKey = $value";
                    }
                break;
                case "wc":
                    if(strlen(trim($value))>0){
                        $outboundField[]= "  tk  =$value";
                    }
                break;
                case "outbound_from":
                    if(strlen(trim($value))>0){
                        if($_POST['date_type'] ==1){
                            $outboundField[] = " WeighIn >='$value'";
                        }else if( $_POST['date_type'] ==2 ){
                            $outboundField[] = " WeighIn >='$value'";
                        }
                    }
                    
                break;
                case "outbound_to":
                    if(strlen(trim($value))>0){
                        if($_POST['date_type'] ==1){
                            $outboundField[] = " WeighOut <='$value'";
                        }else if( $_POST['date_type'] ==2 ){
                            $outboundField[] = " WeighOut <='$value'";
                        }
                    }
                break;
            }
         }
         
         if(!empty($outboundField)){
            $string = " AND ".implode(" AND ", $outboundField);
         }
         $query = "SELECT iwp_test_scale.*,element_16 FROM iwp_test_scale LEFT JOIN Inetforms.ap_form_64000 ON iwp_test_scale.TruckKey = ap_form_64000.element_2 AND ap_form_64000.element_7 =  DATE(iwp_test_scale.WeighIn) AND  ap_form_64000.element_6 = TIME(iwp_test_scale.WeighIn)   WHERE WeighOut IS NOT NULL AND manage_approve = 1  AND ap_form_64000.element_16 IS NULL $string";
         $outbound = $db->query($query);
        
    }else{
            $query = "SELECT iwp_test_scale.*,element_16 FROM iwp_test_scale LEFT JOIN Inetforms.ap_form_64000 ON iwp_test_scale.TruckKey = ap_form_64000.element_2 AND ap_form_64000.element_7 =  DATE(iwp_test_scale.WeighIn) AND  ap_form_64000.element_6 = TIME(iwp_test_scale.WeighIn) WHERE ProductKey IN(".implode(",",$product_restrict).") AND WeighOut IS NOT NULL AND manage_approve = 1 AND ap_form_64000.element_16 IS NULL ";
       $outbound = $db->query($query); 
    }
  
  ?>
  
        <form action="billingdash.php?tab=1" method="POST">
        <table style="width: 800px;">
        <tr><td >Product</td><td style="text-align: left;"><select name="product" id="product">
            <option value="">---</option>
        <?php 
                foreach($product_restrict as $jk){
                    echo "<option value='$jk' "; 
                        if(isset($_POST['outbound_search'])){
                            if($_POST['product'] == $jk){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo ">".productKey($jk)."</option>";
                }
        ?></select></td></tr>
        <tr><td style="text-align: right;">Release Number</td><td style="text-align: left;"><input value="<?php if(isset($_POST['outbound_search'])){ echo $_POST['release_number']; }  ?>"  type="text" name="release_number"  id="release_number"/></td></tr>
        <tr><td style="text-align: right;">Vendor</td><td  style="text-align: left;"><select name="vendor" id="vendor">
        <option value="">---</option>
        <?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors  ORDER BY Name ASC");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option  "; 
                        if(isset($_POST['outbound_search'])){
                            if($_POST['vendor'] == $m['VendorKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo " value='$m[VendorKey]'>$m[Name]</option>";    
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;">Customer</td><td style="text-align: left;"><select name="customer" id="customer">
            <option value="">---</option>
        <?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers  ORDER BY Name ASC");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['outbound_search'])){
                            if($_POST['customer'] == $m['CustomerKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "  value='$m[CustomerKey]'>$m[Name]</option>";
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;">Driver</td><td style="text-align: left;"><select name="driver" id="driver">
        <option value="">---</option>
        <?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck ORDER BY Name ASC");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option "; 
                        if(isset($_POST['outbound_search'])){
                            if($_POST['driver'] == $i['TruckKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "   value='$i[TruckKey]'>$i[Name]</option>"; 
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;">Weight Certification</td><td style="text-align: left;"><input type="text" name="wc" value="<?php if(isset($_POST['outbound_search'])){
                            echo $_POST['wc'];
                        } ?> " id="wc"/></td></tr>
        <tr>
            <td style="text-align: right;vertical-align:top;"><input type="radio" <?php if(isset($_POST['outbound_search'])){
                            if( $_POST['date_type']==1 ) { echo " checked "; }
                        } ?> value="1"  name="date_type"/>&nbsp;Weigh In<br/></b><input type="radio" <?php if(isset($_POST['outbound_search'])){
                            if( $_POST['date_type']==2 ) { echo " checked "; }
                        } ?>  value="2" name="date_type"/>&nbsp;Weigh Out<br /></td>
            <td  style="text-align: left;vertical-align:top;"><input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['outbound_search'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/><br />TO<br /><input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['outbound_search'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td>
        </tr>
        
        
        <tr></tr>
        <tr><td style="text-align: right;" colspan="4"><input type="submit" name="outbound_search" value="Search"/></td></tr>
        </table>
        </form>
         <form action="exportbilling.php?tab=1" method="POST" target="_blank">
         <table style="width: 400px;">
            <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td><td><input type="hidden" value="<?php echo $query; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
         </table>
         </form>
      <table class="myTable ExcelTable2007"> 
            <thead>
                <tr>
                    <?php
                        if($_SESSION['billing'] == 1 || $_SESSION['billing']==2){
                            echo "<th  style=\"background: #bbbbbb;\">&nbsp;</th>";
                        }
                    
                    ?>
                    <th style="background: #bbbbbb;">Shipping #</th>
                    <th style="background: #bbbbbb;">Product</th>
                    <th style="background: #bbbbbb;">Division</th>
                    <th style="background: #bbbbbb;">Weight Cert</th>
                    <th style="background: #bbbbbb;">Weigh In</th>
                    <th style="background: #bbbbbb;">Weigh Out</th>
                    <th style="background: #bbbbbb;">Gross[lbs]</th>
                    <th style="background: #bbbbbb;">Tare[lbs]</th>
                    <th style="background: #bbbbbb;">Net[lbs]</th> 
                    <th style="background: #bbbbbb;">Hauler</th>
                    <th style="background: #bbbbbb;">Void</th>
                    <th style="background: #bbbbbb;">Buyer/Seller</th> 
                    <th style="background: #bbbbbb;">Notes</th>
                    <th style="background: #bbbbbb;">Driver</th>
                    <th style="background: #bbbbbb;">Release No</th>
                    <th style="background: #bbbbbb;">User Name</th>
                    <th style="background: #bbbbbb;">Truck ID/License</th>
                    <th style="text-align: center;background: #bbbbbb;">Trailer ID 1</th>
                    <th style="text-align: center;background: #bbbbbb;">Trailer ID 2</th>
                   <th>Origin Weight Cert 1/2</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    if(count($outbound)>0){
                        foreach($outbound as $k){
                            if(  $k['VendorKey'] != 0  ){
                                $ven_custom = Vendors($k['VendorKey']);
                            }else if( $k['CustomerKey'] != 0   ){
                                $ven_custom = CustomerKey($k['CustomerKey']);
                            }
                            echo "<tr class='heading' ".void_check($k['Void'],$k['manual_entry'])."   >";
                            
                            if($_SESSION['billing'] == 1 || $_SESSION['billing']==2){
                                echo "<td><img src='img/https://d30y9cdsu7xlg0.cloudfront.net/png/' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/></td>";
                            }
                            echo "<td><span style='display:none;'>$k[element_16]</span>&nbsp;<input type='text' class='sn' ";   
                            if( !in_array($_SESSION['billing'],$billers)   ) {
                                echo " readonly ";
                            }
                            echo " value='$k[element_16]' rel='$k[TruckKey]' weignin='$k[WeighIn]' style='float:left;width:100px;' /></td>";
                            echo "<td>".productKey($k['ProductKey'])."</td>";
                            echo "<th>$k[division]</th>";
                            echo "<td>$k[tk]</td>";
                            $newDateIn = date("m/d/Y H:i:s", strtotime("$k[WeighIn]"));
                            echo "<td><span style='display:none;'>$k[WeighIn]</span> $newDateIn</td>";
                            echo "<td>"; 
                                if(strlen(trim($k['WeighOut']))<=0){
                                    echo "N/A";
                                }else{
                                    $newDateOut = date("m/d/Y H:i:s", strtotime("$k[WeighOut]"));
                                    echo "<span style='display:none;'>$k[WeighOut]</span> $newDateOut";
                                }
                            echo "</td>";
                            echo "<td>" . number_format($k['Gross']) . "</td>";
                            echo "<td>" . number_format($k['Tare']) . "</td>";
                            echo "<td>" . number_format($k['Net']) . "</td>";
                            echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                            echo "<td>$k[Void]</td>";
                            echo "<td>$ven_custom</td>";
                            echo "<td>$k[UF3Data]</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                            echo "<td>$k[UF1Data]</td>";
                            
        					$names = explode(" ", $k['UserName']);
        					$acronym = str_split($names[0])[0] . ". " . end($names);
        					
        					echo "<td>" . $acronym . "</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                            echo "<td>$k[origin_weight_cert]"; 
                            if(strlen(trim($k['origin_weight_cert2']))>0){
                                echo "<div class=\"accordion\">
                                      <h3>Second Origin Weight Cert</h3>
                                      <div style='width:176px;padding:0px 0px 0px 0px;height:60px;'>
                                            $k[origin_weight_cert2]
                                      </div>
                                    </div>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
            
            ?>
            </tbody>
    </table>
  </div>
  
  
  <div id="fragment-2">
  <?php
  
    if(isset($_POST['billed_search'])){
        foreach($_POST as $name=>$value){
            switch($name){
                case "shipping":
                    if(strlen(trim($value))>0){
                        $billedField[] = " element_16 like '%$value%'";
                    }
                break;
                case "product":
                    if(strlen(trim($value))>0){
                        $billedField[]= " ProductKey = $value";
                    }
                break;
                case "release_number":
                    if(strlen(trim($value))>0){
                        $billedField[]= " UF1Data like  '%$value%'";
                    }
                break;
                
                case "vendor":
                   if(strlen(trim($value))>0){
                     $billedField[]= " VendorKey = $value";
                   }
                break;
                case "customer":
                    if(strlen(trim($value))>0){
                        $billedField[]= " CustomerKey = $value";
                    }
                break;
                case "driver":
                    if(strlen(trim($value))>0){
                        $billedField[]= " TruckKey = $value";
                    }
                break;
                case "wc":
                    if(strlen(trim($value))>0){
                        $billedField[]= "  tk  =$value";
                    }
                break;
                case "billed_from":
                    if(strlen(trim($value))>0){
                        if($_POST['date_type'] ==1){
                            $billedField[] = " WeighIn >='$value'";
                        }else if( $_POST['date_type'] ==2 ){
                            $billedField[] = " WeighIn >='$value'";
                        }
                    }
                    
                break;
                case "billed_to":
                    if(strlen(trim($value))>0){
                        if($_POST['date_type'] ==1){
                            $billedField[] = " WeighOut <='$value'";
                        }else if( $_POST['date_type'] ==2 ){
                            $billedField[] = " WeighOut <='$value'";
                        }
                    }
                break;
            }
         }
         
         if(!empty($billedField)){
            $string =  " AND ".implode(" AND ", $billedField);
         }
         $q2 = "SELECT iwp_test_scale.*,element_16 FROM iwp_test_scale LEFT JOIN Inetforms.ap_form_64000 ON iwp_test_scale.TruckKey = ap_form_64000.element_2 AND ap_form_64000.element_7 =  DATE(iwp_test_scale.WeighIn) AND  ap_form_64000.element_6 = TIME(iwp_test_scale.WeighIn)  WHERE element_16 IS NOT NULL $string";
         $billed =  $db->query($q2);
         
    }else{
        $q2 = "SELECT iwp_test_scale.*,element_16 FROM iwp_test_scale LEFT JOIN Inetforms.ap_form_64000 ON iwp_test_scale.TruckKey = ap_form_64000.element_2 AND ap_form_64000.element_7 =  DATE(iwp_test_scale.WeighIn) AND  ap_form_64000.element_6 = TIME(iwp_test_scale.WeighIn)  WHERE element_16 IS NOT NULL AND ProductKey IN(".implode(",",$product_restrict).")";
        echo $q2;
        $billed =  $db->query($q2);
    }
  ?>
    <form action="billingdash.php?tab=2" method="POST">
        <table style="width: 800px;">
        <tr><td style="text-align: right;vertical-align:top;">Shipping Number</td><td style="text-align: left;vertical-align:top;"><input type="text" name="shipping" id="shipping" value="<?php if(isset($_POST['billed_search'])){ echo $_POST['shipping']; }  ?>"  /></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Product</td><td style="text-align: left;vertical-align:top;"><select name="product" id="product"><option value="">---</option><?php 
                foreach($product_restrict as $jk){
                    echo "<option   "; 
                        if(isset($_POST['billed_search'])){
                            if($_POST['product'] ==$jk){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "   value='$jk'>".productKey($jk)."</option>";
                }
        ?></select></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Release Number</td><td style="text-align: left;vertical-align:top;"><input type="text" name="release_number"  id="release_number" value="<?php if(isset($_POST['billed_search'])){ echo $_POST['release_number']; }  ?>" /></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Vendor</td><td style="text-align: left;vertical-align:top;"><select name="vendor" id="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors ORDER BY Name ASC");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['billed_search'])){
                            if($_POST['vendor'] == $m['VendorKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "  value='$m[VendorKey]'>$m[Name]</option>";    
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Customer</td><td style="text-align: left;vertical-align:top;"><select name="customer" id="customer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers ORDER BY Name ASC");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['billed_search'])){
                            if($_POST['vendor'] == $m['CustomerKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "   value='$m[CustomerKey]'>$m[Name]</option>";
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Driver</td><td style="text-align: left;vertical-align:top;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck ORDER BY Name ASC");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['billed_search'])){
                            if($_POST['driver'] == $i['TruckKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "   value='$i[TruckKey]'>$i[Name]</option>"; 
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Weight Certification</td><td style="text-align: left;vertical-align:top;"><input type="text" name="wc"  id="wc"  value="<?php if(isset($_POST['billed_search'])){ echo $_POST['wc']; }  ?>" /></td></tr>
        <tr>
            <td  style="text-align: right;vertical-align:top;"><input  <?php if(isset($_POST['billed_search'])){  if($_POST['date_type']==1){ echo "checked"; } }  ?>  type="radio" value="1"  name="date_type"/>&nbsp;Weigh In<br/></b><input  <?php if(isset($_POST['billed_search'])){  if($_POST['date_type']==2){ echo "checked"; } }  ?>   type="radio" value="2" name="date_type"/>&nbsp;Weigh Out<br /></td>
            <td style="text-align: left;vertical-align:top;"><input class="from" type="text" name="billed_from" value="<?php if(isset($_POST['billed_search'])){ echo $_POST['billed_from']; }  ?>" placeholder="FROM"/><br />TO<br /><input class="to" type="text" name="billed_to" value="<?php if(isset($_POST['billed_search'])){  echo $_POST['billed_to']; } ?>"  placeholder="TO"/></td>
        </tr>
        
        
        <tr></tr>
        <tr><td style="text-align: right;" colspan="4"><input type="submit" name="billed_search" value="Search"/></td></tr>
        </table>
        </form>
        <form action="exportbilling.php?tab=2" method="POST" target="_blank">
         <table style="width: 400px;">
            <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td><td><input type="hidden" value="<?php echo $q2; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
         </table>
        </form>
    <table class="myTable"> 
        <thead>
            
            <tr>
                <?php
                    if($_SESSION['billing'] == 1 || $_SESSION['billing']==2){
                        echo "<th style=\"background: #bbbbbb;\">&nbsp;</th>";
                    }
                
                ?>
                    <th style="background: #bbbbbb;">Shipping #</th>
                    <th style="background: #bbbbbb;">Product</th>
                    <th style="background: #bbbbbb;">Division</th>
                    <th style="background: #bbbbbb;">Weight Cert</th>
                    <th style="background: #bbbbbb;">Weigh In</th>
                    <th style="background: #bbbbbb;">Weigh Out</th>
                    <th style="background: #bbbbbb;">Gross[lbs]</th>
                    <th style="background: #bbbbbb;">Tare[lbs]</th>
                    <th style="background: #bbbbbb;">Net[lbs]</th> 
                    <th style="background: #bbbbbb;">Hauler</th>
                    <th style="background: #bbbbbb;">Buyer/Seller</th> 
                    <th style="background: #bbbbbb;">Notes</th>
                    <th style="background: #bbbbbb;">Driver</th>
                    <th style="background: #bbbbbb;">Release No</th>
                    <th style="background: #bbbbbb;">User Name</th>
                    <th style="background: #bbbbbb;">Truck ID/License</th>
                    <th style="text-align: center;background: #bbbbbb;">Trailer ID 1</th>
                    <th style="text-align: center;background: #bbbbbb;">Trailer ID 2</th>
                    <th>Origin Weight Cert 1/2</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
                if(count($billed)>0){
                    foreach($billed as $k){
                        echo "<tr class='heading' ".void_check($k['Void'],$k['manual_entry'])." >";
                            if($_SESSION['billing'] == 1 || $_SESSION['billing']==2){
                                echo "<td><img src='img/https://d30y9cdsu7xlg0.cloudfront.net/png/' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/></td>";
                            }
                            echo "<td>$k[element_16]</td>";
                            echo "<td>".productKey($k['ProductKey'])."</td>";
                            echo "<td>$k[division]</td>";
                            echo "<td>$k[tk]</td>";
                            $newDateIn = date("m/d/Y H:i:s", strtotime("$k[WeighIn]"));
                            echo "<td><span style='display:none;'>$k[WeighIn]</span> $newDateIn</td>";
                            echo "<td>"; 
                                if(strlen(trim($k['WeighOut']))<=0){
                                    echo "N/A";
                                }else{
                                    $newDateOut = date("m/d/Y H:i:s", strtotime("$k[WeighOut]"));
                                    echo "<span style='display:none;'>$k[WeighOut]</span> $newDateOut";
                                }
                            echo "</td>";
                            echo "<td>" . number_format($k['Gross']) . "</td>";
                            echo "<td>" . number_format($k['Tare']) . "</td>";
                            echo "<td>" . number_format($k['Net']) . "</td>";
                             echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                             echo "<td>".CustomerKey($k['CustomerKey'])."</td>";
                             echo "<td>$k[UF3Data]</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                            echo "<td>$k[UF1Data]</td>";
                            
        					$names = explode(" ", $k['UserName']);
        					$acronym = str_split($names[0])[0] . ". " . end($names);
        					
        					echo "<td>" . $acronym . "</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                            echo "<td>$k[origin_weight_cert]"; 
                                if(strlen(trim($k['origin_weight_cert2']))>0){
                                    echo "<div class=\"accordion\">
                              <h3>Second Origin Weight Cert</h3>
                              <div style='width:176px;padding:0px 0px 0px 0px;height:60px;'>
                                    $k[origin_weight_cert2]
                              </div>
                            </div>";
                                }
                            echo "</td>";
                            echo "</tr>";
                    }
                }
        
        ?>
        </tbody>
</table>
  </div>
 
 
 
 
 <div id="fragment-3">
    <?php
    if(isset($_POST['grease_search'])){
        foreach($_POST as $name=>$value){
            switch($name){
                case "shipping":
                    if(strlen(trim($value))>0){
                        $greaseField[] = " element_16 like '%$value%'";
                    }
                break;
                case "product":
                    if(strlen(trim($value))>0){
                        $greaseField[]= " ProductKey = $value";
                    }
                break;
                case "release_number":
                    if(strlen(trim($value))>0){
                        $greaseField[]= " UF1Data like  '%$value%'";
                    }
                break;
                
                case "vendor":
                   if(strlen(trim($value))>0){
                     $greaseField[]= " VendorKey = $value";
                   }
                break;
                case "customer":
                    if(strlen(trim($value))>0){
                        $greaseField[]= " CustomerKey = $value";
                    }
                break;
                case "driver":
                    if(strlen(trim($value))>0){
                        $greaseField[]= " TruckKey = $value";
                    }
                break;
                case "wc":
                    if(strlen(trim($value))>0){
                        $greaseField[]= " tk  =$value";
                    }
                break;
                case "grease_from":
                    if(strlen(trim($value))>0){
                        if($_POST['date_type'] ==1){
                            $greaseField[] = " WeighIn >='$value'";
                        }else if( $_POST['date_type'] ==2 ){
                            $greaseField[] = " WeighIn >='$value'";
                        }
                    }
                    
                break;
                case "grease_to":
                    if(strlen(trim($value))>0){
                        if($_POST['date_type'] ==1){
                            $greaseField[] = "  WeighOut <='$value'";
                        }else if( $_POST['date_type'] ==2 ){
                            $greaseField[] = "  WeighOut <='$value'";
                        }
                    }
                break;
            }
         }
         
         if(!empty($greaseField)){
            $string = " AND ".implode(" AND ", $greaseField);
         }
         $query3 = "SELECT iwp_test_scale.*,element_16 FROM iwp_test_scale LEFT JOIN Inetforms.ap_form_64000 ON iwp_test_scale.TruckKey = ap_form_64000.element_2 AND ap_form_64000.element_7 =  DATE(iwp_test_scale.WeighIn) AND  ap_form_64000.element_6 = TIME(iwp_test_scale.WeighIn)   WHERE ProductKey IN(82,86,20) AND manage_approve =1 AND Net IS NOT NULL  $string ";
         $grease = $db->query($query3);
    }else{
        $query3 ="SELECT iwp_test_scale.*,element_16 FROM iwp_test_scale LEFT JOIN Inetforms.ap_form_64000 ON iwp_test_scale.TruckKey = ap_form_64000.element_2 AND ap_form_64000.element_7 =  DATE(iwp_test_scale.WeighIn) AND  ap_form_64000.element_6 = TIME(iwp_test_scale.WeighIn)   WHERE ProductKey IN(82,86,20) AND manage_approve =1 AND Net IS NOT NULL ";
        $grease = $db->query($query3);    
    }
    ?>
    <form action="billingdash.php?tab=3" method="POST">
        <table style="width: 800px;">
        <tr><td style="text-align: right;vertical-align:top;">Shipping Number</td><td style="text-align: left;vertical-align:top;"><input  value="<?php if(isset($_POST['grease_search'])){ echo $_POST['shipping']; } ?> "  type="text" name="shipping" id="shipping"/></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Weight Certification</td><td style="text-align: left;vertical-align:top;"><input value="<?php if(isset($_POST['grease_search'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Release Number</td><td style="text-align: left;vertical-align:top;"><input  value="<?php if(isset($_POST['grease_search'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Product</td><td style="text-align: left;vertical-align:top;"><select name="product" id="product"><option value="">---</option><?php 
                foreach($product_restrict as $jk){
                    echo "<option value='$jk'   "; 
                        if(isset($_POST['grease_search'])){
                            if($_POST['product'] == $jk){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "    >".productKey($jk)."</option>";
                }
        ?></select></td></tr>
        
        <tr><td style="text-align: right;vertical-align:top;">Vendor</td><td style="text-align: left;vertical-align:top;"><select name="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['grease_search'])){
                            if($_POST['vendor'] == $m['VendorKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "    value='$m[VendorKey]'>$m[Name]</option>";    
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Customer</td><td style="text-align: left;vertical-align:top;"><select name="customer" id="buyer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['grease_search'])){
                            if($_POST['customer'] == $m['CustomerKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "    value='$m[CustomerKey]'>$m[Name]</option>";
                }
            }
        ?></select></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Driver</td><td style="text-align: left;vertical-align:top;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['grease_search'])){
                            if($_POST['driver'] == $i['TruckKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo " value='$i[TruckKey]'>$i[Name]</option>"; 
                }
            }
        ?></select></td></tr>
        
        <tr>
            <td  style="text-align: right;vertical-align:top;"><input <?php if(isset($_POST['grease_search'])){ if($_POST['date_type']==1){ echo " checked ";}   }  ?> type="radio" value="1"  name="date_type"/>&nbsp;Weigh In<br/></b><input <?php if(isset($_POST['grease_search'])){ if($_POST['date_type']==2){ echo " checked ";}   }  ?>  type="radio" value="2" name="date_type"/>&nbsp;Weigh Out<br /></td>
            <td style="text-align: left;vertical-align:top;"><input class="from" type="text" name="grease_from" value="<?php if(isset($_POST['grease_search'])){ echo $_POST['grease_from']; }  ?>" placeholder="FROM"/><br />TO<br /><input class="to" type="text" name="grease_to" value="<?php if(isset($_POST['grease_search'])){  echo $_POST['grease_to']; } ?>"  placeholder="TO"/></td>
        </tr>
        
        
        <tr></tr>
        <tr><td style="text-align: right;" colspan="4"><input type="submit" name="grease_search" value="Search"/></td></tr>
        </table>
        </form>
        <form action="exportbilling.php?tab=3" method="POST" target="_blank">
         <table style="width: 400px;">
            <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td><td><input type="hidden" value="<?php echo $query3; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
         </table>
         </form>
    <table  class="myTable ExcelTable2007"> 
        <thead>
           
            <tr>
                <?php
                    if($_SESSION['billing'] == 1 || $_SESSION['billing']==2){
                        echo "<th>&nbsp;</th>";
                    }
                
                ?>
                <th style="background: #bbbbbb;">&nbsp;</th>
                <th style="background: #bbbbbb;">Shipping #</th>
                <th style="background: #bbbbbb;" >Product</th>
                <th style="background: #bbbbbb;">Division</th>
                <th style="background: #bbbbbb;">Weight Cert</th>
                <th style="background: #bbbbbb;">Weigh In</th>
                <th style="background: #bbbbbb;">Weigh Out</th>
                <th style="background: #bbbbbb;">Gross[lbs]</th>
                <th style="background: #bbbbbb;">Tare[lbs]</th>
                <th style="background: #bbbbbb;">Net[lbs]</th> 
                <th style="background: #bbbbbb;">Hauler</th>
                <th style="background: #bbbbbb;">Buyer/Seller</th> 
                <th style="background: #bbbbbb;">Notes</th>
                <th style="background: #bbbbbb;">Driver</th>
                <th style="background: #bbbbbb;">Release No</th>
                <th style="background: #bbbbbb;">User Name</th>
                <th style="background: #bbbbbb;">Truck ID/License</th>
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 1</th>
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 2</th>
                <th>Origin Weight Cert 1/2</th>
            </tr>
        </thead>
        <tbody>
        <?php
                if(count($grease)>0){
                    foreach($grease as $k){
                        echo "<tr class='heading' ".void_check($k['Void'],$k['manual_entry'])." >";
                            if($_SESSION['billing'] == 1 || $_SESSION['billing']==2){
                                echo "<td><img src='img/https://d30y9cdsu7xlg0.cloudfront.net/png/' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/></td>";
                            }
                            echo "<td>";
                          if( in_array( $k['ProductKey'],$calc_check)){
                                echo "<span style='cursor:pointer;color:blue;' class='calc_this' rel='$k[TransactionKey]'>UCO/Yellow/Grease Calculations</span>";
                            }else{
                                echo "&nbsp;";
                            }
                            echo "</td>";
                            echo "<td><span style='display:none;'>$k[element_16]</span>&nbsp;<input type='text' class='sn' ";   
                            if( !in_array($_SESSION['billing'],$billers)   ) {
                                echo " readonly ";
                            }
                            echo " value='$k[element_16]' rel='$k[TruckKey]' weignin='$k[WeighIn]' style='float:left;width:100px;' /></td>";
                            echo "<td>".productKey($k['ProductKey'])."</td>";
                            echo "<th>$k[division]</th>";
                            echo "<td>$k[tk]</td>";
                            $newDateIn = date("m/d/Y H:i:s", strtotime("$k[WeighIn]"));
                            echo "<td><span style='display:none;'>$k[WeighIn]</span> $newDateIn</td>";
                            echo "<td>"; 
                                if(strlen(trim($k['WeighOut']))<=0){
                                    echo "N/A";
                                }else{
                                    $newDateOut = date("m/d/Y H:i:s", strtotime("$k[WeighOut]"));
                                    echo "<span style='display:none;'>$k[WeighOut]</span> $newDateOut";
                                }
                            echo "</td>";
                             echo "<td>" . number_format($k['Gross']) . "</td>";
                            echo "<td>" . number_format($k['Tare']) . "</td>";
                            echo "<td>" . number_format($k['Net']) . "</td>";
                             echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                             echo "<td>".CustomerKey($k['CustomerKey'])."</td>";
                             echo "<td>$k[UF3Data]</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                            echo "<td>$k[UF1Data]</td>";
                            
        					$names = explode(" ", $k['UserName']);
        					$acronym = str_split($names[0])[0] . ". " . end($names);
        					
        					echo "<td>" . $acronym . "</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                            echo "<td>$k[origin_weight_cert]"; 
                                if(strlen(trim($k['origin_weight_cert2']))>0){
                                    echo "<div class=\"accordion\">
                              <h3>Second Origin Weight Cert</h3>
                              <div style='width:176px;padding:0px 0px 0px 0px;height:60px;'>
                                    $k[origin_weight_cert2]
                              </div>
                            </div>";
                                }
                            echo "</td>";
                            echo "</tr>";
                    }
                }
        
        ?>
        </tbody>
</table>
  </div>
  
</div>

<script>
$(".from").datetimepicker({ dateFormat: 'yy-mm-dd' ,timeFormat: "HH:mm:ss"});
$(".to").datetimepicker({ dateFormat: 'yy-mm-dd' ,  timeFormat: "HH:mm:ss"});
<?php
if(isset($_SESSION['billing'])){
    
    ?>
    
    
    
    $(".sn").change(function(){
        $.post("update_shipping.php",{truckkey: $(this).attr('rel'),weighin:$(this).attr('weignin'),sn:$(this).val()},function(data){
            alert("Shipping Number Updated! " + data);
        });
    });
    <?php
}

?>

$(".image_upload").click(function(){
    Shadowbox.open({
        content:"scaleEdit.php?entry="+$(this).attr("rel")+"&mode=view_only",
        player:"iframe",
        width:"500",
        height:"500"    
    });
});

$(".calc_this").click(function(){
   Shadowbox.open({
        content:"calc_entry.php?entry="+$(this).attr('rel')+"&mode=view_only",    
        player:"iframe",
        width:"1000",
        height:"600"
   }); 
});
</script>
    
    <?php }
?>

</body>        
</html>