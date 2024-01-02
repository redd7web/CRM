<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
include "scaleFunctions.php";
ini_set("display_errors",0);
$manage = array (1,3);
$calc_check = array(82,86,20);
$billers = array(1,2);


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
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <?php
        include "source/scripts.php";
        include "source/css.php";
    ?>
    <script>
    $(document).ready(function(){
       $('.myTable').dataTable({
            "order": [ 6, 'desc' ],
            "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
       }); 
    });
    
    $( function() {
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
                case 3:
                ?>
                    active:2
                <?php
                break;
            }    
        }
        ?>
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

#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
}

td,th{
    background:transparent;
    text-align:center;
    width:1%;
    font-size:12px;
    vertical-align:middle;
    display:table-cell;
    padding:0px 2px; /* just some padding, if needed*/
    white-space: pre; /* this will avoid line breaks*/
    border:1px solid black;
    
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
<title>Completed IO Scale</title>
</head>

<body>

<?php
if(isset($_POST['scale_login'])){
    //role, first name,last name, username
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '$_POST[scale_name]' AND element_2 = '$_POST[scale_password]'");
    if(count($lookup)>0){
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }
    
    
}



if(!isset($_SESSION['billing'])){
    

?>
<form action="IOScale.php" method="POST" style="margin-bottom: 50px;">
<table>
<tr><td>Username</td><td style="text-align: left;"><input type="text" name="scale_name" placeholder="Username"/></td></tr>
<tr><td>Password</td><td style="text-align: left;"><input type="password" name="scale_password"/></td></tr>
<tr><td colspan="2" colspan="2" style="text-align: right;"><input type="submit" value="Login" name="scale_login"/></td></tr>
</table>
</form>
<?php
}else {
    echo "<h2>Welcome, $_SESSION[username]&nbsp; <a href='IOScale.php?task=logout'><img src='img/logout.jpg' title='Logout'/></a></h2><br/>
    ";
    if( $_SESSION['billing']  == 1 || $_SESSION['billing'] == 5){
        echo "<a href='manual_ticket.php' rel='shadowbox;width=450;'>Manual Scale Ticket Input</a>";
    }
    
}

?>

<h1 style="margin-top: 50px;">IWP SCALE MAIN</h1>
<div id="tabs" style="width: auto;display:inline-block;">
  <ul>
    <li><a href="#fragment-1">OutBound</a></li>
    <li><a href="#fragment-2">Inbound</a></li>
    <li><a href="#fragment-3">All</a></li>
  </ul>
  <?php
  /// OUTBOUND
    
        if(isset($_POST['outbound_submit'])){
            foreach($_POST as $name=>$value){
                switch($name){
                    case "trailer_1":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.TrailerID1  like '%".trim($value)."%'";
                        }
                    break;
                    case "trailer_2":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.TrailerID2  like '%".trim($value)."%'";
                        }
                    break;
                     case "truck_lice":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.truckid  like '%".trim($value)."%'";
                        }
                    break;
                    case "release_number":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.UF1Data like  '%$value%'";
                        }
                    break;
                     case "hauler":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.HaulerKey =$value";
                        }
                    break;
                    case "product":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.ProductKey = $value";
                        }
                    break;
                    case "vendor":
                       if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.VendorKey = $value";
                       }
                    break;
                    case "customer":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.CustomerKey = $value";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.TruckKey = $value";
                        }
                    break;
                    case "wc":
                        if(strlen(trim($value))>0){
                            $ob[]= " tk  =$value";
                        }
                    break;
                    case "outbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $ob[] = " iwp_test_scale.WeighIn >='".trim($value)."'";
                            }else{
                                $ob[] = " iwp_test_scale.WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "outbound_to":
                        if(strlen(trim($value))>0 ){
                             if($_POST['date_type']==1){
                                $ob[] = "iwp_test_scale.WeighIn <='".trim($value)."'";
                             }else{
                                $ob[] = "iwp_test_scale.WeighOut <='".trim($value)."'";
                             }
                             
                        }
                    break;
                }
            }
            if(!empty($ob)){
                $string = " AND ".implode(" AND ", $ob);
            }
            
            $query = "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' $string GROUP BY WeighIn";
            $outbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' $string GROUP BY WeighIn");
        }else{
            $query = "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' GROUP BY WeighIn";
            $outbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' GROUP BY WeighIn");// AND ProductKey IN(29,82,90)
        }
  
  ?>
  <div id="fragment-1"><h1>OutBound</h1>
  <form action="IOScale.php?tab=1" method="POST">
    <table style="width: 400px;">
    <!---<tr><td colspan="2">Username</td><td colspan="2"><input  value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['username']; } ?> "  type="text" name="username" id="username"/></td></tr>---!>
    
    <tr><td colspan="2" style="text-align: right;">Trailer ID 1</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['trailer_1']; } ?> "  type="text" name="trailer_1" id="trailer_1"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Trailer ID 2</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['trailer_2']; } ?> "  type="text" name="trailer_2" id="trailer_2"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Truck ID / License</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['truck_lice']; } ?> "  type="text" name="truck_lice" id="truck_lice"/></td></tr>
    <!---<tr><td colspan="2">Gross</td><td colspan="2"><input value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['gross_from']; } ?> "  placeholder="FROM" type="text" name="gross_from" id="gross_from"/><br />To<br /><input value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['gross_to']; } ?> "  placeholder="TO" type="text" name="gross_to" id="gross_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Tare</td><td colspan="2"><input value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['tare_from']; } ?> "  placeholder="FROM"  type="text" name="tare_from" id="tare_from"/><br />To<br /><input placeholder="TO" value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['tare_to']; } ?> "   type="text" name="tare_to" id="tare_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Net</td><td colspan="2"><input placeholder="FROM"  type="text" name="net_from" id="net_from"/><br />To<br /><input  placeholder="TO" type="text" name="net_to" id="net_to"/></td></tr>---!>
        <tr><td colspan="2" style="text-align: right;">Weight Certification</td><td colspan="2" style="text-align: left;"><input value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
        <tr><td colspan="2" style="text-align: right;">Release Number</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['outbound_submit'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
        <tr><td colspan="2" style="text-align: right;">Hauler</td><td colspan="2" style="text-align: left;"><select name="hauler" id="hauler"><option value="">---</option>
    <?php
    
        $hau = $db->query("SELECT HaulerKey,Name FROM iwp_truck_haulers");
        if(count($hau)>0){
            foreach($hau as $item){
                echo "<option value='$item[HaulerKey]'>$item[Name]</option>";
            }
        }
    ?>
    </select></td></tr>
        <tr><td colspan="2" style="text-align: right;">Product</td><td colspan="2" style="text-align: left;"><select name="product" id="product"><option value="">---</option><?php 
                
                $product_restrict = $db->query("SELECT Name,ProductKey FROM iwo_products ORDER BY Name ASC");
                
                if(count($product_restrict)>0){
                    foreach($product_restrict as $jk){
                        echo "<option value='$jk[ProductKey]'   "; 
                            if(isset($_POST['inbound_submit'])){
                                if($_POST['product'] == $jk['ProductKey']){
                                    echo " selected ";
                                }else {
                                    echo "";
                                }
                            }
                        echo "    >".$jk['Name']."</option>";
                    }  
                }
        ?></select></td></tr>
        
        <tr><td colspan="2" style="text-align: right;">Vendor</td><td colspan="2" style="text-align: left;"><select name="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors  ORDER BY Name ASC");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['outbound_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Customer</td><td colspan="2" style="text-align: left;"><select name="customer" id="buyer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers ORDER BY Name ASC");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['outbound_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Driver</td><td colspan="2" style="text-align: left;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck  ORDER BY Name ASC");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['outbound_submit'])){
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
     <tr><td><input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['lab_submit'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['lab_submit'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="outbound_submit" value="Search"/></td></tr>
     </table>
     </form>
     <form action="exportscale.php" method="POST" target="_blank">
     <table style="width: 400px;">
        <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td></tr>
        <tr><td colspan="2"><input type="hidden" value="<?php echo $query; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
     </table>
     </form>
    <?php
    
    
        
        
    
    ?>
    
    <table class="myTable"> 
        <thead>
            <tr>
                <!---<th>Shipping Number</th>--!>
                <td>&nbsp;</td>
                <th>Weight Cert No.</th>
                <th style="text-align: center;">Division</th>
                <th style="text-align: center;">Backhaul</th>
                <th style="text-align: center;">Miles</th>
                <th style="text-align: center;">Extra Miles</th>
                <th style="text-align: center;">Total Miles</th>
                <th>Additional Notes</th>
                <th>Lot #</th>
                <th>Seal #</th>
                <th>Hauler</th>
                <th>Driver</th>
                
                
                <th>TruckID / License</th>
                <th>Buyer/Seller</th>                
                <th>Release No</th>
                <th>Notes</th>
                <th>Product</th>
                <th>Weigh In</th>
                <th>Weigh Out</th>
                <th>Gross</th>
                <th>Tare</th>
                <th>Net</th>
                <th>User Name</th>
                <th style="text-align: center;">Trailer ID 1</th>
                <th style="text-align: center;">Trailer ID 2</th>
                <th>Units</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($outbound)>0){
                    foreach($outbound as $k){
                        echo "<tr>";
                       
                        echo "<td><img src='https://d30y9cdsu7xlg0.cloudfront.net/png/3927-200.png' class='image_upload' style='cursor:pointer;float:left;height:50px;height:50px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/></td>";    
                        echo "<td>$k[tk]</td>";
                         echo "<td>$k[division]&nbsp;".division($k['division'],$k['tk'])."</td>";
                        echo "<td><input type='checkbox' "; 
                                if($k['backhaul'] == 1){
                                    echo " checked ";
                                }else{
                                    
                                }
                        echo " class='backhaul' weight='$k[tk]'/></td>";
                        echo "<td>".c_miles($k['CustomerKey'])."</td>";
                        echo "<td><input  value='$k[extra_miles]'  type='text' class='em' placeholder='Extra Miles' rel='".c_miles($k['CustomerKey'])."'";  
                            if($_SESSION['billing'] == 5  || $_SESSION['billing'] == 1){
                                
                            }else{
                                echo " readonly ";
                            }
                         echo" style='width:100px;' weight='$k[tk]' /></td>";
                         echo "<td><input value='$k[total_miles]'  type='text' class='tm' placeholder='Total Miles' style='width:100px;' readonly /></td>";
                         echo "<td><textarea class='additional_notes' placeholder='Additional Notes' weight='$k[tk]'>$k[additional_notes]</textarea></td>";
                        echo "<td><input placeholder='Lot #' type='text' value='$k[lot_number]' class='lot_number' weight='$k[tk]' style='width:100px;'/></td>";
                         echo "<td><input placeholder='Seal #' type='text' value='$k[lot_number]' class='seal_number' weight='$k[tk]' style='width:100px;'/></td>";
                         echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                         echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                        
                        echo "<td>".CustomerKey($k['CustomerKey'])."</td>";
                         echo "<td>$k[UF1Data]</td>";
                         echo "<td>$k[UF3Data]</td>";
                        echo "<td>".productKey($k['ProductKey'])."</td>";
                        echo "<td>$k[WeighIn]</td>";
                        echo "<td>"; 
                            if(strlen(trim($k['WeighOut']))<=0){
                                echo "N/A";
                            }else{
                                echo "$k[WeighOut]";
                            }
                        echo "</td>";
                        echo "<td>$k[Gross]</td>";
                        echo "<td>$k[Tare]</td>";
                        echo "<td>$k[Net]</td>";
                        echo "<td>$k[UserName]</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                        echo "<td>$k[UF2Data]</td>";
                         
                        echo "</tr>";
                    }
                }
            
            ?>
        </tbody>
    </table>
    
  </div>
  <div id="fragment-2"><h1>InBound</h1>
    <form action="IOScale.php?tab=2" method="POST">
    <?php
    
        /// INBOUND
    
        if(isset($_POST['inbound_submit'])){
                foreach($_POST as $name=>$value){
                    switch($name){
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
                     case "truck_lice":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_scale_truck.truckid  like '%".trim($value)."%'";
                        }
                    break;
                    case "release_number":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_test_scale.UF1Data like  '%$value%'";
                        }
                    break;
                     case "hauler":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_scale_truck.HaulerKey =$value";
                        }
                    break;
                    case "product":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_test_scale.ProductKey = $value";
                        }
                    break;
                    case "vendor":
                       if(strlen(trim($value))>0){
                            $ib[]= " iwp_test_scale.VendorKey = $value";
                       }
                    break;
                    case "customer":
                        if(strlen(trim($value))>0){
                            $ib[]= " iwp_test_scale.CustomerKey = $value";
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
                    case "outbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $ib[] = " iwp_test_scale.WeighIn >='".trim($value)."'";
                            }else{
                                $ib[] = " iwp_test_scale.WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "outbound_to":
                        if(strlen(trim($value))>0 ){
                             if($_POST['date_type']==1){
                                $ib[] = "iwp_test_scale.WeighIn <='".trim($value)."'";
                             }else{
                                $ib[] = "iwp_test_scale.WeighOut <='".trim($value)."'";
                             }
                             
                        }
                    break;
                    }
                }
                
                if(!empty($ib)){
                    $string = " AND ".implode(" AND ",$ib);
                }
                $q2 = "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey  WHERE ShipMode LIKE '%R%' $string GROUP BY WeighIn";
                $inbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey  WHERE ShipMode LIKE '%R%' $string  GROUP BY WeighIn");// AND ProductKey IN(29,82,90)    
        }else{
            $q2 = "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey  WHERE ShipMode LIKE '%R%' GROUP BY WeighIn";
            $inbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey  WHERE ShipMode LIKE '%R%' GROUP BY WeighIn ");// AND ProductKey IN(29,82,90)    
        }
        
    
    ?>
    <table style="width: 400px;">
    <!---<tr><td colspan="2">Username</td><td colspan="2"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['username']; } ?> "  type="text" name="username" id="username"/></td></tr>---!>
    
    <tr><td colspan="2" style="text-align: right;">Trailer ID 1</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['trailer_1']; } ?> "  type="text" name="trailer_1" id="trailer_1"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Trailer ID 2</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['trailer_2']; } ?> "  type="text" name="trailer_2" id="trailer_2"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Truck ID / License</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['truck_lice']; } ?> "  type="text" name="truck_lice" id="truck_lice"/></td></tr>
    <!---<tr><td colspan="2">Gross</td><td colspan="2"><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['gross_from']; } ?> "  placeholder="FROM" type="text" name="gross_from" id="gross_from"/><br />To<br /><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['gross_to']; } ?> "  placeholder="TO" type="text" name="gross_to" id="gross_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Tare</td><td colspan="2"><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['tare_from']; } ?> "  placeholder="FROM"  type="text" name="tare_from" id="tare_from"/><br />To<br /><input placeholder="TO" value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['tare_to']; } ?> "   type="text" name="tare_to" id="tare_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Net</td><td colspan="2"><input placeholder="FROM"  type="text" name="net_from" id="net_from"/><br />To<br /><input  placeholder="TO" type="text" name="net_to" id="net_to"/></td></tr>---!>
        <tr><td colspan="2" style="text-align: right;">Weight Certification</td><td colspan="2" style="text-align: left;"><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
        <tr><td colspan="2" style="text-align: right;">Release Number</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
        <!--<tr><td colspan="2">Hauler</td><td colspan="2"><select name="hauler" id="hauler"><option value="">---</option> 
    <?php
    
        $hau = $db->query("SELECT HaulerKey,Name FROM iwp_truck_haulers");
        if(count($hau)>0){
            foreach($hau as $item){
                echo "<option value='$item[HaulerKey]'>$item[Name]</option>";
            }
        }
    ?><!---
    </select></td></tr>---!> 
        <tr><td colspan="2" style="text-align: right;">Product</td><td colspan="2" style="text-align: left;"><select name="product" id="product"><option value="">---</option><?php 
                $product_restrict = $db->query("SELECT Name,ProductKey FROM iwo_products ORDER BY Name ASC");
                
                if(count($product_restrict)>0){
                    foreach($product_restrict as $jk){
                        echo "<option value='$jk[ProductKey]'   "; 
                            if(isset($_POST['inbound_submit'])){
                                if($_POST['product'] == $jk['ProductKey']){
                                    echo " selected ";
                                }else {
                                    echo "";
                                }
                            }
                        echo "    >".$jk['Name']."</option>";
                    }  
                }
                
                
        ?></select></td></tr>
        
        <tr><td colspan="2" style="text-align: right;">Vendor</td><td colspan="2" style="text-align: left;"><select name="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors  ORDER BY Name ASC");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['inbound_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Customer</td><td colspan="2" style="text-align: left;"><select name="customer" id="buyer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers  ORDER BY Name ASC");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['inbound_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Driver</td><td colspan="2" style="text-align: left;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck  ORDER BY Name ASC");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['inbound_submit'])){
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
     <tr><td><input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['inbound_submit'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="inbound_submit" value="Search"/></td></tr>
     </table>
     </form>
     <form action="exportscale.php" method="POST" target="_blank">
     <table style="width: 400px;">
        <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td></tr>
        <tr><td colspan="2"><input type="hidden" value="<?php echo $q2; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
     </table>
     </form>
    
    
    <table class="myTable"> 
        <thead>
            
            <tr>
                <!---<th>Shipping Number</th>---!>
                <th>Weight Cert No.</th>
                <th>Division</th>
                <th style="text-align: center;">Backhaul</th>
                <th style="text-align: center;">Miles</th>
                <th style="text-align: center;">Extra Miles</th>
                <th style="text-align: center;">Total Miles</th>
                
                <th>Additional Notes</th>
                <th>Lot #</th>
                <th>Seal #</th>
                <th>Hauler</th>
                <th>Driver</th>
                
                
                <th>TruckID / License</th>
                <th>Buyer/Seller</th>                
                <th>Release No</th>
                <th>Notes</th>
                <th>Product</th>
                <th>Weigh In</th>
                <th>Weigh Out</th>
                <th>Gross</th>
                <th>Tare</th>
                <th>Net</th>
                <th>User Name</th>
                <th style="text-align: center;">Trailer ID 1</th>
                <th style="text-align: center;">Trailer ID 2</th>
                <th>Units</th>
                
              
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($inbound)>0){
                    foreach($inbound as $k){
                        echo "<tr>";
                        echo "<td><img src='https://d30y9cdsu7xlg0.cloudfront.net/png/3927-200.png' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/>&nbsp;$k[tk]</td>";
                         echo "<td>".division($k['division'],$k['tk'])."</td>";
                        echo "<td><input "; 
                                if($k['backhaul'] == 1){
                                    echo " checked ";
                                }else{
                                    
                                }
                        echo " type='checkbox' class='backhaul' weight='$k[tk]'/></td>";
                        echo "<td>".v_miles($k['VendorKey'])."</td>";
                        echo "<td><input value='$k[extra_miles]' type='text' class='em' placeholder='Extra Miles' rel='".v_miles($k['VendorKey'])."'";  
                            if($_SESSION['billing'] == 5 || $_SESSION['billing'] == 1){
                                
                            }else{
                                echo " readonly ";
                            }
                        echo" style='width:100px;' weight='$k[tk]' /></td>";
                        echo "<td><input  value='$k[total_miles]'  type='text' class='tm' placeholder='Total Miles' style='width:100px;' readonly /></td>";
                        echo "<td><textarea class='additional_notes' placeholder='Additional Notes' weight='$k[tk]'>$k[additional_notes]</textarea></td>";
                        echo "<td><input placeholder='Lot #' type='text' value='$k[lot_number]' class='lot_number' weight='$k[tk]' style='width:100px;'/></td>";
                         echo "<td><input placeholder='Seal #' type='text' value='$k[lot_number]' class='seal_number' weight='$k[tk]' style='width:100px;'/></td>";
                        echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                         echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                        
                        echo "<td>".CustomerKey($k['CustomerKey'])."</td>";
                         echo "<td>$k[UF1Data]</td>";
                         echo "<td>$k[UF3Data]</td>";
                        echo "<td>".productKey($k['ProductKey'])."</td>";
                        echo "<td>$k[WeighIn]</td>";
                        echo "<td>"; 
                            if(strlen(trim($k['WeighOut']))<=0){
                                echo "N/A";
                            }else{
                                echo "$k[WeighOut]";
                            }
                        echo "</td>";
                        echo "<td>$k[Gross]</td>";
                        echo "<td>$k[Tare]</td>";
                        echo "<td>$k[Net]</td>";
                        echo "<td>$k[UserName]</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                        echo "<td>$k[UF2Data]</td>";
                        
                        echo "</tr>";
                    }
                }
            
            ?>
        </tbody>
    </table>
  
  </div>
  <div id="fragment-3">
    <?php
    
        if(isset($_POST['all_search'])){
            foreach($_POST as $name=>$value){
                    switch($name){
                         case "trailer_1":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_scale_truck.TrailerID1  like '%".trim($value)."%'";
                        }
                    break;
                    case "trailer_2":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_scale_truck.TrailerID2  like '%".trim($value)."%'";
                        }
                    break;
                     case "truck_lice":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_scale_truck.truckid  like '%".trim($value)."%'";
                        }
                    break;
                    case "release_number":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_test_scale.UF1Data like  '%$value%'";
                        }
                    break;
                     case "hauler":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_scale_truck.HaulerKey =$value";
                        }
                    break;
                    case "product":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_test_scale.ProductKey = $value";
                        }
                    break;
                    case "vendor":
                       if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_test_scale.VendorKey = $value";
                       }
                    break;
                    case "customer":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_test_scale.CustomerKey = $value";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " iwp_test_scale.TruckKey = $value";
                        }
                    break;
                    case "wc":
                        if(strlen(trim($value))>0){
                            $allsearch[]= " tk  =$value";
                        }
                    break;
                    case "outbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $allsearch[] = " iwp_test_scale.WeighIn >='".trim($value)."'";
                            }else{
                                $allsearch[] = " iwp_test_scale.WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "outbound_to":
                        if(strlen(trim($value))>0 ){
                             if($_POST['date_type']==1){
                                $allsearch[] = "iwp_test_scale.WeighIn <='".trim($value)."'";
                             }else{
                                $allsearch[] = "iwp_test_scale.WeighOut <='".trim($value)."'";
                             }
                             
                        }
                    break;
                    }
                }
            if(!empty($allsearch)){
                $string = " AND ".implode(" AND ", $allsearch);
            }
            $allx = "SELECT * FROM iwp_test_scale WHERE 1 $string ORDER BY WeighIn DESC";
            $all = $db->query($allx);
        }else{
            $allx = "SELECT * FROM iwp_test_scale ORDER BY WeighIn DESC";
            $all = $db->query($allx);
        }
        
        
    ?>
    
    <form action="IOScale.php?tab=3" method="POST">
    <table style="width: 400px;">
    <!---<tr><td colspan="2">Username</td><td colspan="2"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['username']; } ?> "  type="text" name="username" id="username"/></td></tr>---!>
    
    <tr><td colspan="2" style="text-align: right;">Trailer ID 1</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['trailer_1']; } ?> "  type="text" name="trailer_1" id="trailer_1"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Trailer ID 2</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['trailer_2']; } ?> "  type="text" name="trailer_2" id="trailer_2"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Truck ID / License</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['truck_lice']; } ?> "  type="text" name="truck_lice" id="truck_lice"/></td></tr>
    <!---<tr><td colspan="2">Gross</td><td colspan="2"><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['gross_from']; } ?> "  placeholder="FROM" type="text" name="gross_from" id="gross_from"/><br />To<br /><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['gross_to']; } ?> "  placeholder="TO" type="text" name="gross_to" id="gross_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Tare</td><td colspan="2"><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['tare_from']; } ?> "  placeholder="FROM"  type="text" name="tare_from" id="tare_from"/><br />To<br /><input placeholder="TO" value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['tare_to']; } ?> "   type="text" name="tare_to" id="tare_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Net</td><td colspan="2"><input placeholder="FROM"  type="text" name="net_from" id="net_from"/><br />To<br /><input  placeholder="TO" type="text" name="net_to" id="net_to"/></td></tr>---!>
        <tr><td colspan="2" style="text-align: right;">Weight Certification</td><td colspan="2" style="text-align: left;"><input value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
        <tr><td colspan="2" style="text-align: right;">Release Number</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
        <!--<tr><td colspan="2">Hauler</td><td colspan="2"><select name="hauler" id="hauler"><option value="">---</option> 
    <?php
    
        $hau = $db->query("SELECT HaulerKey,Name FROM iwp_truck_haulers");
        if(count($hau)>0){
            foreach($hau as $item){
                echo "<option value='$item[HaulerKey]'>$item[Name]</option>";
            }
        }
    ?><!---
    </select></td></tr>---!> 
        <tr><td colspan="2" style="text-align: right;">Product</td><td colspan="2" style="text-align: left;"><select name="product" id="product"><option value="">---</option><?php 
                $product_restrict = $db->query("SELECT Name,ProductKey FROM iwo_products ORDER BY Name ASC");
                
                if(count($product_restrict)>0){
                    foreach($product_restrict as $jk){
                        echo "<option value='$jk[ProductKey]'   "; 
                            if(isset($_POST['inbound_submit'])){
                                if($_POST['product'] == $jk['ProductKey']){
                                    echo " selected ";
                                }else {
                                    echo "";
                                }
                            }
                        echo "    >".$jk['Name']."</option>";
                    }  
                }
                
                
        ?></select></td></tr>
        
        <tr><td colspan="2" style="text-align: right;">Vendor</td><td colspan="2" style="text-align: left;"><select name="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors  ORDER BY Name ASC");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['inbound_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Customer</td><td colspan="2" style="text-align: left;"><select name="customer" id="buyer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers  ORDER BY Name ASC");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['inbound_submit'])){
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
        <tr><td colspan="2" style="text-align: right;">Driver</td><td colspan="2" style="text-align: left;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT Name,TruckKey  FROM iwp_scale_truck  ORDER BY Name ASC");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['inbound_submit'])){
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
     <tr><td><input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['inbound_submit'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="all_search" value="Search"/></td></tr>
     </table>
     </form>
    <form action="exportscale.php" method="POST" target="_blank">
     <table style="width: 400px;">
        <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td></tr>
        <tr><td colspan="2"><input type="hidden" value="<?php echo $allx; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
     </table>
     </form>
    <table class="myTable"> 
        <thead>
            
            <tr>
                <!---<th>Shipping Number</th>---!>
                <th>Weight Cert No.</th>
                <th>Division</th>
                <th style="text-align: center;">Backhaul</th>
                <th style="text-align: center;">Miles</th>
                <th style="text-align: center;">Extra Miles</th>
                <th style="text-align: center;">Total Miles</th>
                <th>Additional Notes</th>
                <th>Lot #</th>
                <th>Seal #</th>
                <th>Hauler</th>
                <th>Driver</th>
                
                
                <th>TruckID / License</th>
                <th>Buyer/Seller</th>                
                <th>Release No</th>
                <th>Notes</th>
                <th>Product</th>
                <th>Weigh In</th>
                <th>Weigh Out</th>
                <th>Gross</th>
                <th>Tare</th>
                <th>Net</th>
                <th>User Name</th>
                <th style="text-align: center;">Trailer ID 1</th>
                <th style="text-align: center;">Trailer ID 2</th>
                <th>Units</th>
                
              
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($all)>0){
                    foreach($all as $k){
                        echo "<tr>";
                        echo "<td><img src='https://d30y9cdsu7xlg0.cloudfront.net/png/3927-200.png' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/>&nbsp;$k[tk]</td>";
                         echo "<td>".division($k['division'],$k['tk'])."</td>";
                        echo "<td><input "; 
                                if($k['backhaul'] == 1){
                                    echo " checked ";
                                }else{
                                    
                                }
                        echo " type='checkbox' class='backhaul' weight='$k[tk]'/></td>";
                        echo "<td>".v_miles($k['VendorKey'])."</td>";
                        echo "<td><input value='$k[extra_miles]' type='text' class='em' placeholder='Extra Miles' rel='".v_miles($k['VendorKey'])."'";  
                            if($_SESSION['billing'] == 5 || $_SESSION['billing'] == 1){
                                
                            }else{
                                echo " readonly ";
                            }
                        echo" style='width:100px;' weight='$k[tk]' /></td>";
                        echo "<td><input  value='$k[total_miles]'  type='text' class='tm' placeholder='Total Miles' style='width:100px;' readonly /></td>";
                        echo "<td><textarea class='additional_notes' placeholder='Additional Notes' weight='$k[tk]'>$k[additional_notes]</textarea></td>";
                        echo "<td><input placeholder='Lot #' type='text' value='$k[lot_number]' class='lot_number' weight='$k[tk]' style='width:100px;'/></td>";
                         echo "<td><input placeholder='Seal #' type='text' value='$k[lot_number]' class='seal_number' weight='$k[tk]' style='width:100px;'/></td>";
                        echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                         echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                        
                        echo "<td>".CustomerKey($k['CustomerKey'])."</td>";
                         echo "<td>$k[UF1Data]</td>";
                         echo "<td>$k[UF3Data]</td>";
                        echo "<td>".productKey($k['ProductKey'])."</td>";
                        echo "<td>$k[WeighIn]</td>";
                        echo "<td>"; 
                            if(strlen(trim($k['WeighOut']))<=0){
                                echo "N/A";
                            }else{
                                echo "$k[WeighOut]";
                            }
                        echo "</td>";
                        echo "<td>$k[Gross]</td>";
                        echo "<td>$k[Tare]</td>";
                        echo "<td>$k[Net]</td>";
                        echo "<td>$k[UserName]</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
                        echo "<td>$k[UF2Data]</td>";
                        
                        echo "</tr>";
                    }
                }
            
            ?>
        </tbody>
    </table>
  
  </div>
</div>


</body>
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


    if($_SESSION['billing']==5 || $_SESSION['billing'] == 1){
        ?>
         $(".em").change(function(){
             
             var o = $(this).closest("tr").find(".backhaul");
            
            if( o.is(":checked") ){
                var bh = 1;
                var first = $(this).val()*1;
                var second =  ($(this).attr('rel')/2) ;
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }else{
                var bh =0;
                var first = $(this).val()*1;
                var second = $(this).attr('rel')*1;
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }
            $.post("update_miles.php",{weight:$(this).attr("weight"),extra_miles:first,backhaul:bh,total_miles: $(this).closest("tr").find(".tm").val()  },function(data){
                
            });
            
         });
         
         $(".backhaul").click(function(){
            if( $(this).is(":checked") ){
                var bh = 1;
                var first = $(this).closest("tr").find(".em").val()*1;
                var second =  ( $(this).closest("tr").find(".em").attr('rel')/2);
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }else{
                var bh =0;
                var first = $(this).closest("tr").find(".em").val() *1;
                var second = $(this).closest("tr").find(".em").attr('rel')*1;
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }
            
            $.post("update_miles.php",{weight:$(this).attr("weight"),extra_miles:first,backhaul:bh,total_miles:$(this).closest("tr").find(".tm").val()},function(data){
                
            });
         });
         
        
         
        <?php
    }

?>

$(".seal_number").change(function(){
    $.post("update_scale_info.php",{mode:"seal",value:$(this).val(),weight:$(this).attr('weight')},function(data){
        alert("Seal Number updated");
        window.location.reload();
    });
});


$(".lot_number").change(function(){
    $.post("update_scale_info.php",{mode:"lot",value:$(this).val(),weight:$(this).attr('weight')},function(data){
        alert("Lot Number updated");
        window.location.reload();
    });
});

$(".additional_notes").change(function(){
    $.post("update_scale_info.php",{mode:"addt",value:$(this).val(),weight:$(this).attr('weight')},function(data){
        alert("Additional updated");
        window.location.reload();
    });
});



 $(".division").change(function(){
     $.post("division_update.php",{ value:$(this).val(),weight:$(this).attr('weight') },function(data){
         alert("Division Updated!");
         window.location.reload();
     });
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
</html>