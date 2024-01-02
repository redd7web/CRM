 
 <?php
    
include "protected/global.php";
include "scaleFunctions.php";
if($_SESSION['username'] == "RDizon" || $_SESSION['username'] == "spyro"){
    ini_set("display_errors",0);
}
//Manager
$permit = array (1,3,8);

if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['division']);
    session_destroy();
}

include "source/scripts.php";
include "source/css.php";
    ?>
    
  <script>
    $(document).ready(function(){
       $('.myTable').dataTable({
            "order": [ 7, 'desc' ],
            "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
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

#myTable th{
}
#myTable td {
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
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}



input[type=checkbox]{
    width:10px;
}

</style>
<link rel="stylesheet" href="css_excel/excel-2007.css"/>
<h1>Outbound MX Grease</h1>
    <?php
        if(isset($_POST['obmxgr'])){ // Outbound MX Grease
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                     case "outbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $obmxg[] = " WeighIn >='".trim($value)."'";
                            }else if($_POST['date_type']==2){
                                $obmxg[] = " WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "outbound_to":
                        if(strlen(trim($value))>0 ){
                             if($_POST['date_type']==1){
                                $obmxg[] = "WeighIn <='".trim($value)."'";
                             }else if($_POST['date_type']==2){
                                $obmxg[] = "WeighOut <='".trim($value)."'";
                             }
                             
                        }
                    break;
                    case "username":
                        if(strlen(trim($value))>0 ){
                            $obmxg[] =" UserName like '%".trim($value)."%' ";
                        }
                    break;
                    case "gross_from":
                        if(strlen(trim($value))>0 ){
                            $obmxg[] =" Gross >= $value ";
                        }
                    break;
                    case "gross_to":
                        if(strlen(trim($value))>0 ){
                            $obmxg[] =" Gross <= $value ";
                        }
                    break;
                    
                    case "tare_from":
                        if(strlen(trim($value))>0 ){
                            $obmxg[] =" Tare >= $value ";
                        }
                    break;
                    case "tare_to":
                        if(strlen(trim($value))>0 ){
                            $obmxg[] =" Tare <= $value ";
                        }
                    break;
                    
                    case "net_from":
                        if(strlen(trim($value))>0 ){
                            $obmxg[] =" Net >= $value ";
                        }
                    break;
                    case "net_to":
                        if(strlen(trim($value))>0 ){
                            $obmxg[] =" Net <= $value ";
                        }
                    break;
                    case "product":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_test_scale.ProductKey = $value";
                        }else{
                            $obmxg[] = "iwp_test_scale.ProductKey IN (20,40,47)";
                        }
                    break;
                    case "release_number":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_test_scale.UF1Data like  '%$value%'";
                        }
                    break;
                    
                    case "vendor":
                       if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_test_scale.VendorKey = $value";
                       }
                    break;
                    case "customer":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_test_scale.CustomerKey = $value ";
                        }else{
                            $obmxg[] = " iwp_test_scale.CustomerKey IN(477,496,518,475,519,479)  ";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_scale_truck.Name like '%$value%'";
                        }
                    break;
                    case "wc":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_test_scale.tk  =$value";
                        }
                    break;
                    case "trailer_1":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_scale_truck.TrailerID1  like '%".trim($value)."%'";
                        }
                    break;
                    case "trailer_2":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_scale_truck.TrailerID2  like '%".trim($value)."%'";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_scale_truck.Name like '%$value%'";
                        }
                    break;
                    case "truck_lice":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_scale_truck.TruckID  like '%".trim($value)."%'";
                        }
                    break;
                    case "hauler":
                        if(strlen(trim($value))>0){
                            $obmxg[]= " iwp_scale_truck.HaulerKey =$value";
                        }
                    break;
                    case "outbound_from":
                        if(strlen($value)>0 && $value !=' '){
                            $obmxg[] = " iwp_scale_truck.DATE(WeighIn) >='$value'";
                        }
                    break;
                    case "outbound_to":
                        if(strlen($value)>0 && $value !=' '){
                             $obmxg[] = " iwp_scale_truck.DATE(WeighIn) <='$value'";
                        }
                    break;
                }
            }
            
            if(!empty($obmxg)>0){
                $string = " AND ".implode(" AND ", $obmxg);
            }
            $mxgrease_string = "SELECT * FROM iwp_test_scale  LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey =  iwp_test_scale.TruckKey   WHERE ShipMode LIKE '%S%'  OR manual_entry = 2  $string GROUP BY tk";
            echo $mxgrease_string."<br/>";
            $outboundmxgrease= $db->query($mxgrease_string);
        }else{
            $mxgrease_string = "SELECT * FROM iwp_test_scale WHERE ShipMode LIKE '%S%' AND ProductKey IN (20,40,47) AND CustomerKey IN(477,496,518,475,519,479)  AND  WeighIn BETWEEN CURRENT_TIMESTAMP - INTERVAL '7' DAY AND CURRENT_TIMESTAMP    OR manual_entry = 2 ";
            echo $mxgrease_string."<br/>";
            $outboundmxgrease = $db->query($mxgrease_string);//AND CustomerKey IN (477,496,518,475,519,479)
        }
    
    ?>
    <form action="CompletedIOscale.php?tab=7" method="POST"> 
    <table style="width: 400px;">
    <tr><td style="text-align: right;">IWP Weight Certification</td><td style="text-align: left;"><input value="<?php if(isset($_POST['obmxgr'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
    
    <tr><td  style="text-align: right;">Truck ID / License</td><td  style="text-align: left;"><input  value="<?php if(isset($_POST['obmxgr'])){ echo $_POST['truck_lice']; } ?> "  type="text" name="truck_lice" id="truck_lice"/></td></tr>
    <tr><td style="text-align: right;">Product</td><td style="text-align: left;">
            <select name="product" id="product"><option value="">---</option><?php
                $product_restrict_gmx = $db->query("SELECT Name,ProductKey FROM iwo_products WHERE ProductKey IN(20,40,47) ORDER BY Name ASC");
                if(count($product_restrict_gmx)>0){
                    foreach($product_restrict_gmx as $jk){
                        echo "<option value='$jk[ProductKey]'"; 
                            if(isset($_POST['obmxgr'])){
                                if($_POST['product'] == $jk['ProductKey']){
                                    echo " selected ";
                                }else {
                                    echo "";
                                }
                            }
                        echo " >$jk[Name]</option>";
                    }
                } 
                
        ?></select></td></tr>
    
      <tr><td >Hauler</td><td><select name="hauler" id="hauler"><option value="">---</option>
    <?php
    
        $hau = $db->query("SELECT HaulerKey,Name FROM iwp_truck_haulers");
        if(count($hau)>0){
            foreach($hau as $item){
                echo "<option value='$item[HaulerKey]'>$item[Name]</option>";
            }
        }
    ?>
        </select></td></tr>
        <tr><td style="text-align: right;">Release Number</td><td style="text-align: left;"><input  value="<?php if(isset($_POST['obmxgr'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
     
        
        <tr><td style="text-align: right;">Vendor</td><td  style="text-align: left;"><select name="vendor"><option value="">---</option><?php 
            $nb = $db->query("SELECT VendorKey,Name FROM iwp_vendors");
            if(count($nb)>0){
                foreach($nb as $m){
                    echo "<option   "; 
                        if(isset($_POST['obmxgr'])){
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
        <tr><td style="text-align: right;">Customer</td><td style="text-align: left;"><select name="customer" id="buyer"><option value="">---</option><?php 
            $ic = $db->query(" SELECT Name,CustomerKey FROM iwp_customers WHERE CustomerKey IN (477,496,518,475,519,479) ");
            if(count($ic)>0){
                foreach($ic as $m){
                    echo "<option   "; 
                        if(isset($_POST['obmxgr'])){
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
        <tr><td style="text-align: right;">Driver</td><td style="text-align: left;"><select name="driver" id="driver"><option value="">---</option><?php 
            $bn = $db->query("SELECT DISTINCT(Name),TruckKey  FROM iwp_scale_truck GROUP BY Name order by Name ASC ");
            if(count($bn)>0){
                foreach ($bn as $i){
                   echo "<option   "; 
                        if(isset($_POST['outbound_submit'])){
                            if($_POST['driver'] == $i['Name']){
                                echo " selected ";
                            }else {
                                echo "";
                            }
                        }
                    echo "    value='$i[Name]'>$i[Name]</option>"; 
                }
            }
        ?></select></td></tr>
    
    <tr><td><input type="radio" name="date_type"  <?php if(isset($_POST['obmxgr'])){ if($_POST['date_type']==1){ echo " checked "; }   }  ?>    value="1"/>&nbsp;Incoming<br /><input type="radio" name="date_type" <?php if(isset($_POST['obmxgr'])){ if($_POST['date_type']==2){ echo " checked "; }   }  ?> value="2"/>&nbsp;Outgoing</td><td>
    
        <input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['obmxgr'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/>
        <br />To<br />
        <input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['obmxgr'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: right;" ><input type="submit" name="obmxgr" value="Search"/></td></tr>
    </table>
    </form>
    
    
    <table id="myTable" class="myTable ExcelTable2007"> 
        <thead>
            <tr>
                <th style="background: #bbbbbb;">IWP W.C</th>
                <th style="background: #bbbbbb;">Driver</th>
                <th style="background: #bbbbbb;">Buyer/Seller</th>                
                <th style="background: #bbbbbb;">Release No</th>
                <th style="background: #bbbbbb;">Notes</th>
                <th style="background: #bbbbbb;">Product</th>
                <th style="background: #bbbbbb;">Weigh In</th>
                <th style="background: #bbbbbb;">Weigh Out</th>
                <th style="background: #bbbbbb;">Gross</th>
                <th style="background: #bbbbbb;">Tare</th>
                <th style="background: #bbbbbb;">Net</th>
                <th style="background: #bbbbbb;">U/N</th>
                <th style="background: #bbbbbb;">Hauler</th>
                <th style="background: #bbbbbb;">License</th>
                <th style="text-align: center;background: #bbbbbb;">Total Miles</th>
                <th style="background: #bbbbbb;">Void</th>
                <th>Origin Weight Cert 1/2</th>
            </tr>
        </thead>
        <tbody>
  
    <?php
            if(count($outboundmxgrease)>0){
                    foreach($outboundmxgrease as $k){
                        echo "<tr  class='heading' ".void_check($k['Void'],$k['manual_entry'])." >";
                        echo "<td>" . number_format($k[tk]) . "</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                        echo "<td>".CustomerKey($k['CustomerKey'])."</td>";
                        $j = c_miles($k['CustomerKey']);
                        echo "<td>$k[UF1Data]</td>";
                        echo "<td>$k[UF3Data]</td>";
                        echo "<td>".productKey($k['ProductKey'])."</td>";
                        $newDateIn = date("m/d/Y H:i", strtotime("$k[WeighIn]"));
                        echo "<td><span style='display:none;'>$k[WeighIn]</span> $newDateIn</td>";
                        echo "<td>"; 
                            if(strlen(trim($k['WeighOut']))<=0){
                                echo "N/A";
                            }else{
                                $newDateOut = date("m/d/Y H:i", strtotime("$k[WeighOut]"));
                                echo "<span style='display:none;'>$k[WeighOut]</span> $newDateOut";
                            }
                        echo "</td>";
                        echo "<td>" . number_format($k[Gross]) . "</td>";
                        echo "<td>" . number_format($k[Tare]) . "</td>";
                        echo "<td>" . number_format($k[Net]) . "</td>";
						$names = explode(" ", $k[UserName]);
						$acronym = str_split($names[0])[0] . ". " . end($names);
						
						echo "<td>" . $acronym . "</td>";
                        echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                         echo "<td>"; 
                            if(strlen(trim($j))>0){
                               if(strlen(trim($k['total_miles']))>0){
                                     echo "<input  value='$k[total_miles]'  type='text' class='tm' placeholder='Total Miles' style='width:100px;' readonly />";
                               }else{
                                    echo round($j);
                               }
                            }
                         echo "</td>";
                        echo "<td>$k[Void]</td>";
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