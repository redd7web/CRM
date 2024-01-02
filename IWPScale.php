<?php
include "protected/global.php";
include "scaleFunctions.php";

?>

<head>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="plugins/shadow/shadowbox.js"></script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>




</head>


<?php

//Old query, searching for last week of data
//Need to test, data has not been added back yet.

//$outbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' AND WeighIn >= CURDATE() - INTERVAL  6 DAY
//      AND WeighIn  < CURDATE() + INTERVAL  1 DAY GROUP BY WeighIn");


$request = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' AND WeighIn > '2020-04-22'");


//Columns being pulled
//TransactionKey

?>



<div class="container-fluid">
    <h2>IWP Coachella Scale</h2>
    <table id="all_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th data-type="number" sortable>IWP WC </th>
                <th>Origin WC</th>
                <th>Division</th>
                <th>Backhaul</th>
                <th>Miles</th>
                <th>Extra Miles</th>
                <th>Total Miles</th>
                <th>Additional Notes</th>
                <th>Lot Entry</th>
                <th >Seal #</th>
                <th ">Hauler</th>
                <th >Void</th>
                <th >Driver</th>
                <th >TruckID / License</th>
                <th >Buyer/Seller</th>
                <th >Release No</th>
                <th >Notes</th>
                <th >Product</th>
                <th >Weigh In</th>
                <th >Weigh Out</th>
                <th >Gross</th>
                <th >Tare</th>
                <th >Net</th>
                <th >User Name</th>
                <th ">Trailer ID 1</th>
                <th >Trailer ID 2</th>
                <th >Units</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($request) > 0){
            foreach($request as $value){

                if(  $value['VendorKey'] != 0  ){
                    $ven_custom = Vendors($value['VendorKey']);
                    $miles = v_miles($value['VendorKey']);
                }else if( $value['CustomerKey'] != 0   ){
                    $ven_custom = CustomerKey($value['CustomerKey']);
                    $miles = c_miles($value['CustomerKey']);
                }else{
                    $miles = "N/A";
                    $miles = 0;
                }
                
                
                echo "<tr>";
                echo "<td>$value[TransactionKey]</td>";
                //TO DO add section to allow uploads of origin WC information
                echo "<td>$value[origin_weight_cert]</td>";
                echo "<td>$value[division]</td>";

                echo "<td><input type='checkbox'  ";
                if($value['backhaul'] == 1){
                    echo "checked";
                } else {

                }
                echo " class='backhaul' rel='$value[TransactionKey]' ></td>";
                echo "<td>$miles</td>";
                echo "<td><input type='text' class='extra_miles' value='$value[extra_miles]' style='width:50%;'></td>";
                echo "<td>$value[total_miles]</td>";
                echo "<td>$value[additiona_notes]</td>";
                if(  $value['VendorKey'] == 1632    ){
                    echo "<td><a href='ppb_lot.php?tk=$value[tk]&modern=modern' rel='shadowbox;width=400;height=120;'><img src='img/lab_icon.jpg' style='width:20%;height:20%;'/></a></td>";
                }else{
                    echo "<td><a href='ppb_lot.php?tk=$value[tk]&origin=$value[origin_weight_cert]' rel='shadowbox;width=400;height=120;'><img src='img/lab_icon.jpg' style='width:20%;height:20%;'/></a></td>";
                }

                echo "<td><input placeholder='Seal #' type='text' value='$value[lot_number]' class='seal_number' weight='$value[tk]' style='width:100px;'/></td>";
                echo "<td>".haulerDecode($value['TruckKey'])."</td>";
                echo "<td>$value[Void]</td>";
                echo "<td>".truckDecode($value['TruckKey'],"name")."</td>";
                echo "<td>".truckDecode($value['TruckKey'],"truckid")."</td>";

                echo "<td>$ven_custom</td>";
                echo "<td>$value[UF1Data]</td>";
                echo "<td>$value[UF3Data]</td>";
                echo "<td>".productKey($value['ProductKey'])."</td>";
                $newDateIn = date("m/d/Y H:i:s", strtotime("$value[WeighIn]"));
                echo "<td><span style='display:none;'>$value[WeighIn]</span> $newDateIn</td>";
                echo "<td>";
                if(strlen(trim($value['WeighOut']))<=0){
                    echo "N/A";
                }else{
                    $newDateOut = date("m/d/Y H:i:s", strtotime("$value[WeighOut]"));
                    echo "<span style='display:none;'>$value[WeighOut]</span> $newDateOut";
                }
                echo "</td>";
                echo "<td>" . number_format($value['Gross']) . "</td>";
                echo "<td>" . number_format($value['Tare']) . "</td>";
                echo "<td>" . number_format($value['Net']) . "</td>";
                $names = explode(" ", $value['UserName']);
                $acronym = str_split($names[0])[0] . ". " . end($names);

                echo "<td>" . $acronym . "</td>";
                echo "<td>".truckDecode($value['TruckKey'],"id1")."</td>";
                echo "<td>".truckDecode($value['TruckKey'],"id2")."</td>";
                echo "<td>$value[UF2Data]</td>";
                
                
                //End of Row
                //*************************************************
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>


</div>
<script>
    $(document).ready( function () {
        $('#all_table').DataTable();
    } );

</script>
