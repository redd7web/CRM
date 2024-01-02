<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php
    include "protected/global.php";
    include "scaleFunctions.php";
    include "source/css.php";
    include "source/scripts.php";
    
?>
<script>
    $(document).ready(function(){
       $('.myTable').dataTable({
            "order": [ 19, 'desc' ],
            "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
       }); 
       
       $('.dataTables_filter').addClass('pull-left');
       
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
    vertical-align:top;
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

.accordion{
    height:60px;
}

input[type=checkbox]{
    width:10px;
}

</style>
<link rel="stylesheet" href="css_excel/excel-2007.css"/>
    <?php
        /// INBOUND
        if( isset($_POST['all_search']) ){
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
                    case "inbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $ib[] = " iwp_test_scale.WeighIn >='".trim($value)."'";
                            }else{
                                $ib[] = " iwp_test_scale.WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "inbound_to":
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
            $inbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey  WHERE ShipMode LIKE '%R%' AND WeighIn >= CURDATE() - INTERVAL  6 DAY 
      AND WeighIn  < CURDATE() + INTERVAL  1 DAY  GROUP BY WeighIn ");// AND ProductKey IN(29,82,90)    
        }
        
    
    ?>
    <form action="inbound_io.php" method="post">
    <table style="width: 400px;">
    <!---<tr><td colspan="2">Username</td><td colspan="2"><input  value="<?php if(isset($_POST['all_search'])){ echo $_POST['username']; } ?> "  type="text" name="username" id="username"/></td></tr>---!>
    <tr><td><a href="all_io.php">All</a></td><td><a href="outbound_io.php">Outbound</a></td></tr>
    <tr><td colspan="2" style="text-align: right;">Trailer ID 1</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['all_search'])){ echo $_POST['trailer_1']; } ?> "  type="text" name="trailer_1" id="trailer_1"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Trailer ID 2</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['all_search'])){ echo $_POST['trailer_2']; } ?> "  type="text" name="trailer_2" id="trailer_2"/></td></tr>
    <tr><td colspan="2" style="text-align: right;">Truck ID / License</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['all_search'])){ echo $_POST['truck_lice']; } ?> "  type="text" name="truck_lice" id="truck_lice"/></td></tr>
    <!---<tr><td colspan="2">Gross</td><td colspan="2"><input value="<?php if(isset($_POST['all_search'])){ echo $_POST['gross_from']; } ?> "  placeholder="FROM" type="text" name="gross_from" id="gross_from"/><br />To<br /><input value="<?php if(isset($_POST['all_search'])){ echo $_POST['gross_to']; } ?> "  placeholder="TO" type="text" name="gross_to" id="gross_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Tare</td><td colspan="2"><input value="<?php if(isset($_POST['all_search'])){ echo $_POST['tare_from']; } ?> "  placeholder="FROM"  type="text" name="tare_from" id="tare_from"/><br />To<br /><input placeholder="TO" value="<?php if(isset($_POST['all_search'])){ echo $_POST['tare_to']; } ?> "   type="text" name="tare_to" id="tare_to"/></td></tr>---!>
    <!---<tr><td colspan="2">Net</td><td colspan="2"><input placeholder="FROM"  type="text" name="net_from" id="net_from"/><br />To<br /><input  placeholder="TO" type="text" name="net_to" id="net_to"/></td></tr>---!>
        <tr><td colspan="2" style="text-align: right;">Weight Certification</td><td colspan="2" style="text-align: left;"><input value="<?php if(isset($_POST['all_search'])){ echo $_POST['wc']; } ?>" type="text" name="wc"    id="wc"/></td></tr>
        <tr><td colspan="2" style="text-align: right;">Release Number</td><td colspan="2" style="text-align: left;"><input  value="<?php if(isset($_POST['all_search'])){ echo $_POST['release_number']; } ?>"   type="text" name="release_number"  id="release_number"/></td></tr>
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
                            if(isset($_POST['all_search'])){
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
                        if(isset($_POST['all_search'])){
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
                        if(isset($_POST['all_search'])){
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
                        if(isset($_POST['all_search'])){
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
     <tr><td><input class="from" type="text" id="inbound_from" name="inbound_from" value="<?php if(isset($_POST['all_search'])){ echo $_POST['inbound_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input id="inbound_to" class="to" type="text" name="inbound_to" value="<?php if(isset($_POST['all_search'])){  echo $_POST['inbound_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="all_search" value="Search" id="all_search"/></td></tr>
     </table>
     </form>
     <form action="exportscale.php" method="POST" target="_blank">
     <table style="width: 400px;">
        <tr><td>Export Format</td><td><select name="export_format"><option value="">---</option><option value="xls">XLS</option><option value="csv">CSV</option><option value="pdf">PDF</option></select></td></tr>
        <tr><td colspan="2"><input type="hidden" value="<?php echo $q2; ?>" name="query_string"/><input type="submit" value="Export Format" name="export_scale"/></td></tr>
     </table>
     </form>
    
    
    <table  class="myTable ExcelTable2007"> 
        <thead>
            
            <tr>
                <!---<th>Shipping Number</th>---!>
                <td>&nbsp;</td>
                <th style="background: #bbbbbb;">Weight Cert</th>
                <th style="background: #bbbbbb;">Orign Weight Cert</th>
                <th style="background: #bbbbbb;">Division</th>
                <th style="text-align: center;background: #bbbbbb;">Backhaul</th>
                <th style="text-align: center;background: #bbbbbb;">Miles</th>
                <th style="text-align: center;background: #bbbbbb;">Extra Miles</th>
                <th style="text-align: center;background: #bbbbbb;">Total Miles</th>
                <th style="background: #bbbbbb;">Additional Notes</th>
                <th style="background: #bbbbbb;">Lot Entry</th>
                <th style="background: #bbbbbb;">Seal #</th>
                <th style="background: #bbbbbb;">Hauler</th>
                <th style="text-align: center;background: #bbbbbb;">Void</th>
                <th style="background: #bbbbbb;">Driver</th>
                <th style="background: #bbbbbb;">TruckID / License</th>
                <th style="background: #bbbbbb;">Buyer/Seller</th>                
                <th style="background: #bbbbbb;">Release No</th>
                <th style="background: #bbbbbb;">Notes</th>
                <th style="background: #bbbbbb;">Product</th>
                <th style="background: #bbbbbb;">Weigh In</th>
                <th style="background: #bbbbbb;">Weigh Out</th>
                <th style="background: #bbbbbb;">Gross</th>
                <th style="background: #bbbbbb;">Tare</th>
                <th style="background: #bbbbbb;">Net</th>
                <th style="background: #bbbbbb;">User Name</th>
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 1</th>
                <th style="text-align: center;background: #bbbbbb;">Trailer ID 2</th>
                <th style="background: #bbbbbb;">Units</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($inbound)>0){
                    foreach($inbound as $k){
                        echo "<tr   class='heading' ".void_check($k['Void'],$k['manual_entry'])."  >";
                        echo "<td><img src='https://d30y9cdsu7xlg0.cloudfront.net/png/3927-200.png' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/>&nbsp;</td>";
                        echo "<td>$k[TransactionKey]</td>";
                       echo "<td><input type='text' class='origin_weight_cert' rel='$k[tk]'  style='width:175px;' placeholder='Origin Weight Cert'/>
                            <div class=\"accordion\">
                              <h3>Second Origin Weight Cert</h3>
                              <div style='width:176px;padding:0px 0px 0px 0px;height:60px;'>
                                <input type='text' class='second_origin_weight_cert' rel='$k[tk]' style='width:175px;float:left;'  placeholder='Second Origin Weight Cert' />
                              </div>
                            </div>
                        </td>";
                         echo "<td><span style='display:none;'>$k[division]</span> ".division($k['division'],$k['tk'])."</td>";
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
                        echo "<td><a href='ppb_lot.php?tk=$k[tk]' rel='shadowbox;width=400;height=120;'><img src='img/lab_icon.jpg' style='width:20%;height:20%;'/></a></td>";
                         echo "<td><input placeholder='Seal #' type='text' value='$k[lot_number]' class='seal_number' weight='$k[tk]' style='width:100px;'/></td>";
                        echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                        echo "<td>$k[Void]</td>";
                        echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                         echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                        
                        echo "<td>";
                             echo Vendors($k['VendorKey']);
                        echo "</td>";
                         echo "<td>$k[UF1Data]</td>";
                         echo "<td>$k[UF3Data]</td>";
                        echo "<td>".productKey($k['ProductKey'])."</td>";
                        $newDateIn = date("m/d/Y H:i:s", strtotime("$k[WeighIn]"));
                        echo "<td><span style='display:none;'>$k[WeighIn]</span> $newDateIn</td>";
                        echo "<td>"; 
                            if(strlen(trim($k['WeighOut']))<=0){
                                echo "N/A";
                            }else{
                                $newDateOut = date("m/d/Y H:i:s", strtotime("$k[WeighOut]"));
                                echo "<span style='display:none;'>$k[WeighOut]</span> $newDateOut";;
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
    
<script>
 
$(".from").datetimepicker({ dateFormat: 'yy-mm-dd' ,timeFormat: "HH:mm:ss"});
$(".to").datetimepicker({ dateFormat: 'yy-mm-dd' ,  timeFormat: "HH:mm:ss"});

        <?php
        if(isset($_SESSION['billing'])){
            ?>
            $(".sn").change(function(){
                $.post("update_shipping.php",{truckkey: $(this).attr('rel'),weighin:$(this).attr('weignin'),sn:$(this).val()},function(data){
                    //alert("Shipping Number Updated! " + data);
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
                //alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }else{
                var bh =0;
                var first = $(this).val()*1;
                var second = $(this).attr('rel')*1;
                //alert(  first+second   );
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
                //alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }else{
                var bh =0;
                var first = $(this).closest("tr").find(".em").val() *1;
                var second = $(this).closest("tr").find(".em").attr('rel')*1;
                //alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }
            
            $.post("update_miles.php",{weight:$(this).attr("weight"),extra_miles:first,backhaul:bh,total_miles:$(this).closest("tr").find(".tm").val()},function(data){
                
            });
         });
         $(".seal_number").change(function(){
            $.post("update_scale_info.php",{mode:"seal",value:$(this).val(),weight:$(this).attr('weight')},function(data){
                //alert("Seal Number updated");
            });
         });
        
        
        $(".lot_number").change(function(){
            $.post("update_scale_info.php",{mode:"lot",value:$(this).val(),weight:$(this).attr('weight')},function(data){
                //("Lot Number updated");
            });
        });
        
        $(".additional_notes").change(function(){
            $.post("update_scale_info.php",{mode:"addt",value:$(this).val(),weight:$(this).attr('weight')},function(data){
                //alert("Additional updated");
            });
        });
        
        
        
         $(".division").change(function(){
             $.post("division_update.php",{ value:$(this).val(),weight:$(this).attr('weight') },function(data){
                 //alert("Division Updated!");
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
        
        $(".origin_weight_cert").change(function(){
             $.post("update_origin_cert.php",{tk:$(this).attr("rel"),value:$(this).val()},function(data){
                //alert("origin  weight cert updated! "+data)
             });
        });
         
        
        <?php
    }
?>


</script>