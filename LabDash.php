<?php
include "protected/global.php";
include "scaleFunctions.php";

if(isset($_SESSION['username'])){
    if($_SESSION['username'] == "RDizon"){
        ini_set("display_errors",0);
    }
}


$manage = array (1,3);
$machforms = array(1,3,4,8);
$calc_check = array(82,86,20);
$billers = array(1,2);
$product_restrict = array(20,22,29,55,67,76,80,82,84,86,87,90);

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
  
  <script>
    $(document).ready(function(){
       $('.myTable').dataTable({
            "order": [ 14, 'desc' ],
            "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ],
            "iDisplayLength": 100
       }); 
    });
    $( function() {
         $( ".accordion" ).accordion({
            collapsible: true,
            active: false
        });
    });
  </script>
<style type="text/css">
  body{
    font-size:12px;
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
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





td,th{
    background:transparent;
    text-align:center;
    width:1%;
    font-size:12px;
    border:1px solid black;
}

.myTable th{
    width:auto;
}

td{
    vertical-align:middle;
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
.cc{
    display:table-row;
}
</style>
<link rel="stylesheet" href="css_excel/excel-2007.css"/>
<title>Lab Dashboard</title>
</head>
<body>
<?php
if(isset($_POST['scale_login'])){
    $hash = crypt(trim($_POST['scale_password']),'$ap_form_64550');
    
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] =="RDizon"){
            echo "$hash $_POST[scale_name] ";
            echo "SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'";
          
        }
    }
    
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1,element_10_1,element_10_2,element_10_3,element_10_4,element_10_5,element_10_6,element_10_7,element_10_8,element_10_9,element_10_10,element_10_11,element_10_12,element_10_13,element_10_14,element_10_15,element_10_16,element_10_17,element_10_18,element_10_19,element_10_20,element_10_21,element_10_22,element_10_23,element_10_24,element_10_25,element_10_26,element_10_27,element_10_28,element_10_29,element_10_30,element_10_32 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'");
    
   
    
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] =="RDizon"){
          echo "<pre>";
          print_r($lookup);
          echo "</pre>";
        }
    }
    
    
    if(count($lookup)>0 && in_array($lookup[0]['element_9'],$machforms  ) ){
        $_SESSION['division'] = explode("|",$lookup[0]['element_10_1']."|".$lookup[0]['element_10_2']."|".$lookup[0]['element_10_3']."|".$lookup[0]['element_10_4']."|".$lookup[0]['element_10_5']."|".$lookup[0]['element_10_6']."|".$lookup[0]['element_10_7']."|".$lookup[0]['element_10_8']."|".$lookup[0]['element_10_9']."|".$lookup[0]['element_10_10']."|".$lookup[0]['element_10_11']."|".$lookup[0]['element_10_12']."|".$lookup[0]['element_10_13']."|".$lookup[0]['element_10_14']."|".$lookup[0]['element_10_15']."|".$lookup[0]['element_10_16']."|".$lookup[0]['element_10_17']."|".$lookup[0]['element_10_18']."|".$lookup[0]['element_10_19']."|".$lookup[0]['element_10_20']."|".$lookup[0]['element_10_21']."|".$lookup[0]['element_10_22']."|".$lookup[0]['element_10_23']."|".$lookup[0]['element_10_24']."|".$lookup[0]['element_10_25']."|".$lookup[0]['element_10_26']."|".$lookup[0]['element_10_27']."|".$lookup[0]['element_10_28']."|".$lookup[0]['element_10_29']."|".$lookup[0]['element_10_30']."|".$lookup[0]['element_10_32']);
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
    
        
        
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }else{
        $error = "Only Lab Users and Admins are allowed to view this dashboard.";
    }
    
    
}



if(!isset($_SESSION['billing'])){
    

?>



<form action="LabDash.php" method="POST">
<table style="width:200px;position:fixed;top:5px;right:5px;border-radius:10px 10px 10px 10px;border:2px solid green;padding:5px 5px 5px 5px;">
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;" type="text" name="scale_name" placeholder="Username"/></td></tr>
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;box-shadow:inset 0 0 5px green;padding:5px 5px 5px 5px;"  type="password" name="scale_password" placeholder="Password"/></td></tr>
<tr><td colspan="2" style="text-align: right;border:0px solid #bbbbbb;"><input style="width: 100px;height:30px;background:url(img/login_clean.png) no-repeat center center;background-size:100% 100%;border:0px solid #bbbbbb;margin-top:4px;padding:5px 5px 5px 5px;" type="submit" value="" name="scale_login"/></td></tr>
<tr><td><?php echo $error; ?></td></tr>
</table>
</form>
<p style="margin:auto;">Please login to view Scale Data.</p>
<?php
}else {
    echo "<h2>Welcome, $_SESSION[username]&nbsp; <a href='LabDash.php?task=logout'><img src='img/logout.jpg' title='Logout'/></a></h2>";
    if( $_SESSION['billing']  == 1){
        echo "<a href='manual_ticket.php' rel='shadowbox;width=450;'>Manual Scale Ticket Input</a>";
    }
    ?>
    <h1 style="margin-top: 50px;">IWP SCALE Lab</h1>
<div id="tabs" style="width: auto;display:inline-block;">
  <ul>
    <li><a href="#fragment-1">Products</a></li>
    <li><a href="#fragment-2">Approved</a></li>
  </ul>
  <div id="fragment-1">
    <?php
    
    /// OUTBOUND
        if(isset($_POST['lab_submit'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "outbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $ib[] = " WeighIn >='".trim($value)."'";
                            }else{
                                $ib[] = " WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "outbound_to":
                        if(strlen(trim($value))>0 ){
                             if($_POST['date_type']==1){
                                $ib[] = "WeighIn <='".trim($value)."'";
                             }else{
                                $ib[] = "WeighOut <='".trim($value)."'";
                             }
                             
                        }
                    break;
                    case "username":
                        if(strlen(trim($value))>0 ){
                            $ib[] =" UserName like '%".trim($value)."%' ";
                        }
                    break;
                    case "gross_from":
                        if(strlen(trim($value))>0 ){
                            $ib[] =" Gross >= $value ";
                        }
                    break;
                    case "gross_to":
                        if(strlen(trim($value))>0 ){
                            $ib[] =" Gross <= $value ";
                        }
                    break;
                    
                    case "tare_from":
                        if(strlen(trim($value))>0 ){
                            $ib[] =" Tare >= $value ";
                        }
                    break;
                    case "tare_to":
                        if(strlen(trim($value))>0 ){
                            $ib[] =" Tare <= $value ";
                        }
                    break;
                    
                    case "net_from":
                        if(strlen(trim($value))>0 ){
                            $ib[] =" Net >= $value ";
                        }
                    break;
                    case "net_to":
                        if(strlen(trim($value))>0 ){
                            $ib[] =" Net <= $value ";
                        }
                    break;
                    case "product":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_test_scale.ProductKey = $value";
                        }
                    break;
                    case "release_number":
                        if(strlen(trim($value))>0){
                            $ib[]= " UF1Data like  '%$value%'";
                        }
                    break;
                    
                    case "vendor":
                       if(strlen(trim($value))>0){
                            $ib[]= " VendorKey = $value";
                       }
                    break;
                    case "customer":
                        if(strlen(trim($value))>0){
                            $ib[]= " CustomerKey = $value";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_test_scale.TruckKey = $value";
                        }
                    break;
                    case "wc":
                        if(strlen(trim($value))>0){
                            $ib[]= " tk  =$value";
                        }
                    break;
                    case "trailer_1":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_scale_truck.TrailerID1  like '%".trim($value)."%'";
                        }
                    break;
                    case "trailer_2":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_scale_truck.TrailerID2  like '%".trim($value)."%'";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_scale_truck.name  = $value";
                        }
                    break;
                    case "truck_lice":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_scale_truck.truckid  like '%".trim($value)."%'";
                        }
                    break;
                    case "hauler":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_scale_truck.HaulerKey =$value";
                        }
                    break;
                }
            }
            
            if(!empty($ib)>0){
                $string = " AND ".implode(" AND ", $ib);
            }
            $query =  "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2, Inetforms.ap_form_43646.* FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey LEFT JOIN Inetforms.ap_form_43646 ON ap_form_43646.element_24 = iwp_test_scale.tk WHERE ShipMode ='R' AND iwp_test_scale.ProductKey IN(".implode(",",$product_restrict).")  $string group by WeighIn";
            $outbound = $db->query($query);
           
        }else{
            $query ="SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey, Inetforms.ap_form_43646.*  FROM iwp_test_scale INNER JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey LEFT JOIN Inetforms.ap_form_43646 ON ap_form_43646.element_24 = iwp_test_scale.tk WHERE ShipMode ='R' AND  iwp_test_scale.ProductKey IN(".implode(",",$product_restrict).") group by WeighIn";
            echo $query;
            $outbound = $db->query($query);// AND ProductKey IN(29,82,90)
            
        }
    
    ?>
    <form action="LabDash.php?tab=1" method="POST">
    <table style="width: 400px;">
    <!---<tr><td colspan="2">Username</td><td colspan="2"><input  value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['username']; } ?> "  type="text" name="username" id="username"/></td></tr>---!>
    
    <tr><td colspan="2" style="text-align: right;">Trailer ID 1</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['trailer_1']; } ?> "  type="text" name="trailer_1" id="trailer_1"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Trailer ID 2</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['trailer_2']; } ?> "  type="text" name="trailer_2" id="trailer_2"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Truck ID / License</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['truck_lice']; } ?> "  type="text" name="truck_lice" id="truck_lice"/></td></tr>
    <!---<tr><td colspan="2">Gross</td><td colspan="2"><input value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['gross_from']; } ?> "  placeholder="FROM" type="text" name="gross_from" id="gross_from"/><br />To<br /><input value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['gross_to']; } ?> "  placeholder="TO" type="text" name="gross_to" id="gross_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Tare</td><td colspan="2"><input value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['tare_from']; } ?> "  placeholder="FROM"  type="text" name="tare_from" id="tare_from"/><br />To<br /><input placeholder="TO" value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['tare_to']; } ?> "   type="text" name="tare_to" id="tare_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Net</td><td colspan="2"><input placeholder="FROM"  type="text" name="net_from" id="net_from"/><br />To<br /><input  placeholder="TO" type="text" name="net_to" id="net_to"/></td></tr>---!>
        <tr><td colspan="2" style="text-align: right;">Weight Certification</td><td colspan="2"  style="text-align: left;"><input value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
        <tr><td colspan="2" style="text-align: right;">Release Number</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
        <!--<tr><td colspan="2">Hauler</td><td colspan="2"><select name="hauler" id="hauler"><option value="">---</option>
    <?php
    
        $hau = $db->query("SELECT HaulerKey,Name FROM iwp_truck_haulers");
        if(count($hau)>0){
            foreach($hau as $item){
                echo "<option value='$item[HaulerKey]'>$item[Name]</option>";
            }
        }
    ?>
    <!--</select></td></tr>--!>
        <tr><td colspan="2" style="text-align: right;">Product</td><td colspan="2"  style="text-align: left;"><select name="product" id="product"><option value="">---</option><?php
                       
                if(count($product_restrict)>0){
                    foreach($product_restrict as $jk){
                        echo "<option value='$jk'"; 
                            if(isset($_POST['lab_submit'])){
                                if($_POST['product'] == $jk){
                                    echo " selected ";
                                }else {
                                    echo "";
                                }
                            }
                        echo " >".productKey($jk)."</option>";
                    }
                } 
                
        ?></select></td></tr>
        
        <tr><td colspan="2" style="text-align: right;">Vendor</td><td colspan="2"  style="text-align: left;"><select name="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['lab_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Customer</td><td colspan="2"  style="text-align: left;"><select name="customer" id="buyer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['lab_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Driver</td><td colspan="2"  style="text-align: left;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['lab_submit'])){
                            if($_POST['driver'] == $i['TruckKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "    value='$i[TruckKey]'>$i[Name]</option>"; 
                }
            }
        ?></select></td></tr>
    <tr><td colspan="4"><input type="radio" name="date_type"  value="1"/>&nbsp;Incoming&nbsp;&nbsp;<input type="radio" name="date_type" value="2"/>&nbsp;Outgoing</td></tr>
     <tr><td><input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['lab_submit'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="lab_submit" value="Search"/></td></tr>
     </table>
     </form>
     <form action="exportlabdash.php" method="POST" target="_blank">
     <table style="width: 400px;">
        <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td><td><input type="hidden" value="<?php echo $query; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
     </table>
     </form>
    <table  class="myTable ExcelTable2007" style="margin:auto;display:table;width:95%; "> 
        <thead>
            <tr>
                <td>&nbsp;</td>
                <?php
                    if( in_array($_SESSION['billing'],$manage )   ){
                        echo "<th style='text-align:center;background: #bbbbbb;'>Manager Approval</th>";
                        echo "<th style='text-align:center;background: #bbbbbb;'>Calculations</td>";
                    }
                
                    if($_SESSION['billing'] == 4 || $_SESSION['billing'] == 1 || $_SESSION['billing'] == 3){
                        echo "<th style='width:110px;background: #bbbbbb;'>Tech Approval</th>";
                    } 
                ?>
                
               
                <th style="text-align:center;background: #bbbbbb;">Lab Link</th>
                <th style="text-align:center;background: #bbbbbb;">Weight Cert</th>
                 <th style="text-align:center;background: #bbbbbb;">Truck ID/License</th>
                 
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 1</th>
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 2</th>
                <th style="text-align:center;background: #bbbbbb;">Buyer/Seller</th>        
                <th style="text-align:center;background: #bbbbbb;">Release No</th>
                <th style="background: #bbbbbb;">Notes</th>
                <th style="text-align:center;background: #bbbbbb;">Lot #</th>
                <th style="text-align:center;background: #bbbbbb;">Product</th>
                <th style="text-align:center;background: #bbbbbb;width:700px;">Weigh In</th>
                <th style="text-align:center;background: #bbbbbb;">Weigh Out</th>
                <th  style="text-align:center;background: #bbbbbb;">Gross</th>
                <th style="text-align:center;background: #bbbbbb;">Tare</th>
                <th style="text-align:center;background: #bbbbbb;">Net</th>
                <th style="text-align:center;background: #bbbbbb;">User Name</th>
                <th style="text-align:center;background: #bbbbbb;">Driver</th>
                <th style="text-align:center;background: #bbbbbb;">Hauler</th>
                <th style="text-align: center;background: #bbbbbb;">Void</th>
                <th style="text-align: center;background: #bbbbbb;">Lot #</th>
                <th style="text-align: center;background: #bbbbbb;">Alfatoxin 1</th>
                <th style="text-align: center;background: #bbbbbb;">Alfatoxin 2</th>
                <th style="text-align: center;background: #bbbbbb;">Alfatoxin 3</th>
                <th>Origin Weight Cert 1/2</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($outbound)>0){
                    foreach($outbound as $k){
                         $arr = [];
                        $samples = $db->query("SELECT element_10 FROM Inetforms.ap_form_43646 WHERE element_27 = $k[tk] order by date_created ASC LIMIT 0,3");
                        if(count($samples)>0){
                            foreach($samples as $alfa){
                                $arr[] = $alfa['element_10'];
                            }
                        }
                        echo "<tr class='cc heading' ".void_check($k['Void'],$k['manual_entry'])."  >";
                        echo "<td><img src='img/3927-200.png' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[tk]' weignin='$k[WeighIn]'/></td>";
                         if( in_array($_SESSION['billing'],$manage )   ){
                            echo "<td><input type='checkbox' value='1' class='ma' rel='$k[tk]' "; if($k['manage_approve'] == 1){ echo " checked ";  } else { echo ""; }  echo " /></td>";echo "<td>"; if( in_array( $k['ProductKey'],$calc_check)){
                                echo "<span style='cursor:pointer;color:blue;' class='calc_this' rel='$k[tk]'>UCO/Yellow/Grease Calculations</span>";
                            }else{
                                echo "&nbsp;";
                            }
                            echo "</td>";
                         }
                        if($_SESSION['billing'] == 4 || $_SESSION['billing'] == 1  || $_SESSION['billing'] == 3){
                            echo "<td><input type='checkbox' value='1' class='ta' rel='$k[tk]'   "; if($k['tech_approve'] == 1){ echo " checked ";  } else { echo ""; }  echo "/></td>";
                        }
                        echo "<td>";
                            if( in_array($_SESSION['billing'],$machforms )   ){
                                switch($k['ProductKey']){
                                    case 80:  case 84:  case 87:  case 50: 
                                        echo "<a href='CottonTest_lab.php?key=$k[TransactionKey]&id=$k[tk]' target='_blank'>Cotten Seed Testing</a>";
                                    break;
                                    default:
                                         echo "<a href='ER_lab.php?key=$k[TransactionKey]&id=$k[tk]' target='_blank'>Lab Testing</a>";
                                    break;
                                }
                            }else{
                                echo "Login to edit";
                            }
                        echo "</td>";
                        echo "<td>$k[tk]</td>";
                         echo "<td>$k[truckid]</td>";
                        
                        echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                        echo "<td>"; 
                            if($k['CustomerKey'] == NULL){
                                echo Vendors($k['VendorKey']);
                            }else{
                                echo CustomerKey($k['CustomerKey']);
                            }
                        echo "</td>";
                        
                         echo "<td>$k[UF1Data]</td>";
                         echo "<td>$k[UF3Data]</td>";
                         
                        echo "<td>$k[lot_number]</td>";
                        echo "<td>".productKey($k['ProductKey'])."</td>";
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
                        	$names = explode(" ", $k['UserName']);
    					$acronym = str_split($names[0])[0] . ". " . end($names);
    					
    					echo "<td>" . $acronym . "</td>";
                        echo "<td>$k[name]</td>";
                        echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                        echo "<td>$k[Void]</td>";
                        echo '<td style="text-align: center;"><input style="width:90px;"  value="'.$k['lot_number'].'" type="text" rel="lot_number" class="change"/></td>
                            <td style="text-align: center;"><input style="width:90px;" value="'.$arr[0].'" type="text" rel="alfa_1"  readonly/></td>
                            <td style="text-align: center;"><input style="width:90px;"  value="'.$arr[1].'" type="text" rel="alfa_2" readonly/></td>
                            <td style="text-align: center;"><input style="width:90px;"  value="'.$arr[2].'" type="text" rel="alfa_3" readonly/></td>';
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
        if(isset($_POST['approve_search'])){
            foreach($_POST as $name=>$value){
                switch($name){
                    case "outbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $appr[] = " WeighIn >='".trim($value)."'";
                            }else{
                                $appr[] = " WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "outbound_to":
                        if(strlen(trim($value))>0 ){
                             if($_POST['date_type']==1){
                                $appr[] = "WeighIn <='".trim($value)."'";
                             }else{
                                $appr[] = "WeighOut <='".trim($value)."'";
                             }
                             
                        }
                    break;
                    case "username":
                        if(strlen(trim($value))>0 ){
                            $appr[] =" UserName like '%".trim($value)."%' ";
                        }
                    break;
                    case "gross_from":
                        if(strlen(trim($value))>0 ){
                            $appr[] =" Gross >= $value ";
                        }
                    break;
                    case "gross_to":
                        if(strlen(trim($value))>0 ){
                            $appr[] =" Gross <= $value ";
                        }
                    break;
                    
                    case "tare_from":
                        if(strlen(trim($value))>0 ){
                            $appr[] =" Tare >= $value ";
                        }
                    break;
                    case "tare_to":
                        if(strlen(trim($value))>0 ){
                            $appr[] =" Tare <= $value ";
                        }
                    break;
                    
                    case "net_from":
                        if(strlen(trim($value))>0 ){
                            $appr[] =" Net >= $value ";
                        }
                    break;
                    case "net_to":
                        if(strlen(trim($value))>0 ){
                            $appr[] =" Net <= $value ";
                        }
                    break;
                    case "product":
                        if(strlen(trim($value))>0){
                            $appr[]= " iwp_test_scale.ProductKey = $value";
                        }
                    break;
                    case "release_number":
                        if(strlen(trim($value))>0){
                            $appr[]= " UF1Data like  '%$value%'";
                        }
                    break;
                    
                    case "vendor":
                       if(strlen(trim($value))>0){
                            $appr[]= " VendorKey = $value";
                       }
                    break;
                    case "customer":
                        if(strlen(trim($value))>0){
                            $appr[]= " CustomerKey = $value";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $appr[]= " iwp_test_scale.TruckKey = $value";
                        }
                    break;
                    case "wc":
                        if(strlen(trim($value))>0){
                            $appr[]= " tk  =$value";
                        }
                    break;
                    case "trailer_1":
                        if(strlen(trim($value))>0){
                            $appr[]= " iwp_scale_truck.TrailerID1  like '%".trim($value)."%'";
                        }
                    break;
                    case "trailer_2":
                        if(strlen(trim($value))>0){
                            $appr[]= " iwp_scale_truck.TrailerID2  like '%".trim($value)."%'";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $appr[]= " iwp_scale_truck.name  = $value";
                        }
                    break;
                    case "truck_lice":
                        if(strlen(trim($value))>0){
                            $appr[]= " iwp_scale_truck.truckid  like '%".trim($value)."%'";
                        }
                    break;
                    case "hauler":
                        if(strlen(trim($value))>0){
                            $appr[]= " iwp_scale_truck.HaulerKey =$value";
                        }
                    break;
                }
            }
            
            if(!empty($appr)>0){
                $string = " AND ".implode(" AND ", $appr);
            }
            
            
            
            $queryx ="SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,ap_form_43646.* FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey LEFT JOIN Inetforms.ap_form_43646 ON ap_form_43646.element_24 = iwp_test_scale.tk WHERE ShipMode ='R' AND  iwp_test_scale.ProductKey IN(".implode(",",$product_restrict).") AND manage_approve =1 $string group by WeighIn";
            $outboundapprove = $db->query($queryx);// AND ProductKey IN(29,82,90) 
        }else{
            $queryx ="SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,ap_form_43646.* FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey LEFT JOIN Inetforms.ap_form_43646 ON ap_form_43646.element_24 = iwp_test_scale.tk WHERE ShipMode ='R' AND  iwp_test_scale.ProductKey IN(".implode(",",$product_restrict).") AND manage_approve =1 group by WeighIn";
            $outboundapprove = $db->query($queryx);// AND ProductKey IN(29,82,90) 
        }
        
    ?>
    <form action="LabDash.php?tab=2" method="POST">
    <table style="width: 400px;">
    <!---<tr><td colspan="2">Username</td><td colspan="2"><input  value="<?php if(isset($_POST['approve_search'])){ echo $_POST['username']; } ?> "  type="text" name="username" id="username"/></td></tr>---!>
    
    <tr><td colspan="2" style="text-align: right;">Trailer ID 1</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['approve_search'])){ echo $_POST['trailer_1']; } ?> "  type="text" name="trailer_1" id="trailer_1"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Trailer ID 2</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['approve_search'])){ echo $_POST['trailer_2']; } ?> "  type="text" name="trailer_2" id="trailer_2"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Truck ID / License</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['approve_search'])){ echo $_POST['truck_lice']; } ?> "  type="text" name="truck_lice" id="truck_lice"/></td></tr>
    <!---<tr><td colspan="2">Gross</td><td colspan="2"><input value="<?php if(isset($_POST['approve_search'])){ echo $_POST['gross_from']; } ?> "  placeholder="FROM" type="text" name="gross_from" id="gross_from"/><br />To<br /><input value="<?php if(isset($_POST['approve_search'])){ echo $_POST['gross_to']; } ?> "  placeholder="TO" type="text" name="gross_to" id="gross_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Tare</td><td colspan="2"><input value="<?php if(isset($_POST['approve_search'])){ echo $_POST['tare_from']; } ?> "  placeholder="FROM"  type="text" name="tare_from" id="tare_from"/><br />To<br /><input placeholder="TO" value="<?php if(isset($_POST['approve_search'])){ echo $_POST['tare_to']; } ?> "   type="text" name="tare_to" id="tare_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Net</td><td colspan="2"><input placeholder="FROM"  type="text" name="net_from" id="net_from"/><br />To<br /><input  placeholder="TO" type="text" name="net_to" id="net_to"/></td></tr>---!>
        <tr><td colspan="2" style="text-align: right;">Weight Certification</td><td colspan="2"  style="text-align: left;"><input value="<?php if(isset($_POST['approve_search'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
        <tr><td colspan="2" style="text-align: right;">Release Number</td><td colspan="2"  style="text-align: left;"><input  value="<?php if(isset($_POST['approve_search'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
        <!--<tr><td colspan="2">Hauler</td><td colspan="2"><select name="hauler" id="hauler"><option value="">---</option>
    <?php
    
        $hau = $db->query("SELECT HaulerKey,Name FROM iwp_truck_haulers");
        if(count($hau)>0){
            foreach($hau as $item){
                echo "<option value='$item[HaulerKey]'>$item[Name]</option>";
            }
        }
    ?>
    <!--</select></td></tr>--!>
        <tr><td colspan="2" style="text-align: right;">Product</td><td colspan="2"  style="text-align: left;"><select name="product" id="product"><option value="">---</option><?php
                       
                if(count($product_restrict)>0){
                    foreach($product_restrict as $jk){
                        echo "<option value='$jk'"; 
                            if(isset($_POST['approve_search'])){
                                if($_POST['product'] == $jk){
                                    echo " selected ";
                                }else {
                                    echo "";
                                }
                            }
                        echo " >".productKey($jk)."</option>";
                    }
                } 
                
        ?></select></td></tr>
        
        <tr><td colspan="2" style="text-align: right;">Vendor</td><td colspan="2"  style="text-align: left;"><select name="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['approve_search'])){
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
        <tr><td colspan="2" style="text-align: right;">Customer</td><td colspan="2"  style="text-align: left;"><select name="customer" id="buyer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['approve_search'])){
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
        <tr><td colspan="2" style="text-align: right;">Driver</td><td colspan="2"  style="text-align: left;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['approve_search'])){
                            if($_POST['driver'] == $i['TruckKey']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "    value='$i[TruckKey]'>$i[Name]</option>"; 
                }
            }
        ?></select></td></tr>
    <tr><td colspan="4"><input type="radio" name="date_type"  value="1"/>&nbsp;Incoming&nbsp;&nbsp;<input type="radio" name="date_type" value="2"/>&nbsp;Outgoing</td></tr>
     <tr><td><input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['approve_search'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['approve_search'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="approve_search" value="Search"/></td></tr>
     </table>
     </form>
     <form action="exportlabdash.php" method="POST" target="_blank">
     <table style="width: 400px;">
        <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td><td><input type="hidden" value="<?php echo $queryx; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
     </table>
     </form>
    
    <table class="myTable" style="margin:auto;display:table;width:95%; "> 
        <thead>
            <tr>
                <?php
                    if( in_array($_SESSION['billing'],$manage )   ){
                        echo "<th style='text-align:center;background: #bbbbbb;'>Manager Approval</th>";
                        echo "<th style='text-align:center;background: #bbbbbb;'>Calculations</td>";
                    }
                
                    if($_SESSION['billing'] == 4 || $_SESSION['billing'] == 1 || $_SESSION['billing'] == 3){
                        echo "<th style='width:110px;background: #bbbbbb;'>Tech Approval</th>";
                    } 
                ?>
                
               
                <th style="text-align:center;background: #bbbbbb;">Lab Link</th>
                <th style="text-align:center;background: #bbbbbb;">Weight Cert</th>
                <th style="text-align:center;background: #bbbbbb;">Truck ID/License</th>
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 1</th>
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 2</th>
                <th style="text-align:center;background: #bbbbbb;">Buyer/Seller</th>       
                <th style="text-align:center;background: #bbbbbb;">Release No</th>
                <th style="background: #bbbbbb;">Notes</th>
                <th style="text-align:center;background: #bbbbbb;">Lot #</th>
                <th style="text-align:center;background: #bbbbbb;">Product</th>
                <th style="text-align:center;width:700px;background: #bbbbbb;">Weigh In</th>
                <th style="text-align:center;background: #bbbbbb;">Weigh Out</th>
                <th  style="text-align:center;background: #bbbbbb;">Gross</th>
                <th style="text-align:center;background: #bbbbbb;">Tare</th>
                <th style="text-align:center;background: #bbbbbb;">Net</th>
                <th style="text-align:center;background: #bbbbbb;">User Name</th>
                <th style="text-align:center;background: #bbbbbb;">Driver</th>
                <th style="text-align:center;background: #bbbbbb;">Hauler</th>
                <th style="background: #bbbbbb;">Void</th>
                <th style="text-align: center;background: #bbbbbb;">Lot #</th>
                <th style="text-align: center;background: #bbbbbb;">Alfatoxin 1</th>
                <th style="text-align: center;background: #bbbbbb;">Alfatoxin 2</th>
                <th style="text-align: center;background: #bbbbbb;">Alfatoxin 3</th>
                <th>Origin Weight Cert 1/2</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($outboundapprove)>0){
                    foreach($outboundapprove as $k){
                        echo "<tr class='cc heading' ".void_check($k['Void'],$k['manual_entry'])." >";
                         if( in_array($_SESSION['billing'],$manage )   ){
                            echo "<td><input type='checkbox' value='1' class='ma' rel='$k[TransactionKey]' "; if($k['manage_approve'] == 1){ echo " checked ";  } else { echo ""; }  echo " /></td>";
                            echo "<td>"; if( in_array( $k['ProductKey'],$calc_check)){
                                echo "<span style='cursor:pointer;color:blue;' class='calc_this' rel='$k[TransactionKey]'>UCO/Yellow/Grease Calculations</span>";
                            }else{
                                echo "&nbsp;";
                            }
                            echo "&nbsp;</td>";
                         }
                        if($_SESSION['billing'] == 4 || $_SESSION['billing'] == 1  || $_SESSION['billing'] == 3){
                            echo "<td><input type='checkbox' value='1' class='ta' rel='$k[TransactionKey]'   "; if($k['tech_approve'] == 1){ echo " checked ";  } else { echo ""; }  echo "/></td>";
                        }
                        echo "<td>";
                            switch($k['ProductKey']){
                                case 80:  case 84:  case 87:  case 50: 
                                    echo "<a href='CottonTest.php' target='_blank'>Cotten Seed Testing</a>";
                                break;
                                default:
                                     echo "<a href='ER.php' target='_blank'>Lab Testing</a>";
                                break;
                            }
                        echo "</td>";
                        echo "<td>$k[tk]</td>";
                         echo "<td>$k[truckid]</td>";
                       
                        echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                        echo "<td>"; 
                            if($k['CustomerKey'] == NULL){
                                echo Vendors($k['VendorKey']);
                            }else{
                                echo CustomerKey($k['CustomerKey']);
                            }
                       echo "</td>";
                       echo "<td>$k[UF1Data]</td>";
                       echo "<td>$k[UF3Data]</td>";
                       echo "<td>$k[lot_number]</td>";
                       echo "<td>".productKey($k['ProductKey'])."</td>";
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
                        
    
    					$names = explode(" ", $k['UserName']);
    					$acronym = str_split($names[0])[0] . ". " . end($names);
    					
    					echo "<td>" . $acronym . "</td>";
                        echo "<td>$k[name]</td>";
                        echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                        echo "<td>$k[Void]</td>";
                        echo '<td style="text-align: center;"><input style="width:90px;"  value="'.$k['pile_number'].'" type="text" rel="pile_number" class="change"/></td>
                            <td style="text-align: center;"><input style="width:90px;" value="'.$arr[0].'" type="text" rel="alfa_1"  readonly/></td>
                            <td style="text-align: center;"><input style="width:90px;"  value="'.$arr[1].'" type="text" rel="alfa_2" readonly/></td>
                            <td style="text-align: center;"><input style="width:90px;"  value="'.$arr[2].'" type="text" rel="alfa_3" readonly/></td>';
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
$(".ma").click(function(){
    if($(this).is(":checked")){
        $.post("lab_approve.php",{value:1,mode:"ma", id:$(this).attr('rel')},function(data){
           alert("Entry Manager Approved! " + data);  
        });
    }else{
        $.post("lab_approve.php",{value:0,mode:"ma",id:$(this).attr('rel')},function(data){
            alert("Entry Tech Disapproved! " + data);
        });
    }
});


$(".calc_this").click(function(){
   Shadowbox.open({
        content:"calc_entry.php?entry="+$(this).attr('rel'),    
        player:"iframe",
        width:"1000",
        height:"600"
   }); 
});


$(".ta").click(function(){
    if($(this).is(":checked")){
        $.post("lab_approve.php",{value:1,mode:"ta",id:$(this).attr('rel')},function(data){
            alert("Entry Tech Approved! " + data);
        });
    }else{
        $.post("lab_approve.php",{value:0,mode:"ta",id:$(this).attr('rel')},function(data){
            alert("Entry Tech Disapproved! " + data);
        });
    }
});

$(".image_upload").click(function(){
    Shadowbox.open({
        content:"scaleEdit.php?entry="+$(this).attr("rel")+"",
        player:"iframe",
        width:"500",
        height:"500"    
    });
});
</script>
    <?php
}

?>

</body>
</html>