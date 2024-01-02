<?php


include "protected/global.php";
include "scaleFunctions.php";
include "source/css.php";
include "source/scripts.php";


if (isset($_POST['all_search'])) {

    foreach ($_POST as $name => $value) {
        switch ($name) {
            case "trailer_1":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_scale_truck.TrailerID1  like '%" . trim($value) . "%'";
                }
                break;
            case "trailer_2":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_scale_truck.TrailerID2  like '%" . trim($value) . "%'";
                }
                break;
            case "truck_lice":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_scale_truck.truckid  like '%" . trim($value) . "%'";
                }
                break;
            case "release_number":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_test_scale.UF1Data like  '%$value%'";
                }
                break;
            case "hauler":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_scale_truck.HaulerKey =$value";
                }
                break;
            case "product":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_test_scale.ProductKey = $value";
                }
                break;
            case "vendor":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_test_scale.VendorKey = $value";
                }
                break;
            case "customer":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_test_scale.CustomerKey = $value";
                }
                break;
            case "driver":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " iwp_test_scale.TruckKey = $value";
                }
                break;
            case "wc":
                if (strlen(trim($value)) > 0) {
                    $allsearch[] = " tk  =$value";
                }
                break;
            case "outbound_from":
                if (strlen(trim($value)) > 0) {
                    if ($_POST['date_type'] == 1) {
                        $allsearch[] = " iwp_test_scale.WeighIn >='" . trim($value) . "'";
                    } else {
                        $allsearch[] = " iwp_test_scale.WeighOut >='" . trim($value) . "'";
                    }

                }
                break;
            case "outbound_to":
                if (strlen(trim($value)) > 0) {
                    if ($_POST['date_type'] == 1) {
                        $allsearch[] = "iwp_test_scale.WeighIn <='" . trim($value) . "'";
                    } else {
                        $allsearch[] = "iwp_test_scale.WeighOut <='" . trim($value) . "'";
                    }

                }
                break;
        }
    }
    if (!empty($allsearch)) {
        $string = " AND " . implode(" AND ", $allsearch);
    }
    $allx = "SELECT * FROM iwp_test_scale WHERE 1 $string ORDER BY WeighIn DESC";
    $all = $db->query($allx);
} else {
    $allx = "SELECT * FROM iwp_test_scale WHERE WeighIn >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) ORDER BY WeighIn DESC";
    $all = $db->query($allx);
}


?>








<table class="table table-striped table-bordered">
    <thead>
        <th scope="col">File Upload</th>
        <th scope="col">Weight Cert</th>
        <th scope="col">Origin WC</th>
        <th scope="col">Division</th>
        <th scope="col">Backhaul</th>
        <th scope="col">Miles</th>
        <th scope="col">Extra Miles</th>
        <th scope="col">Total Miles</th>
        <th scope="col">Additional Notes</th>
        <th scope="col">Lot Entry</th>
        <th scope="col">Seal #</th>
        <th scope="col">Hauler</th>
        <th scope="col">Void</th>
        <th scope="col">Driver</th>
        <th scope="col">TruckID / License</th>
        <th scope="col">Buyer/Seller</th>
        <th scope="col">Release No</th>
        <th scope="col">Notes</th>
        <th scope="col">Product</th>
        <th scope="col">Weigh In</th>
        <th scope="col">Weigh Out</th>
        <th scope="col">Gross</th>
        <th scope="col">Tare</th>
        <th scope="col">Net</th>
        <th scope="col">User Name</th>
        <th scope="col">Trailer ID 1</th>
        <th scope="col">Trailer ID 2</th>
        <th scope="col">Units</th>
    </thead>

    <tbody>
    <?php
    if(count($all)>0){
        foreach($all as $k){
            if(  $k['VendorKey'] != 0  ){
                $ven_custom = Vendors($k['VendorKey']);
                $j = v_miles($k['VendorKey']);
            }else if( $k['CustomerKey'] != 0   ){
                $ven_custom = CustomerKey($k['CustomerKey']);
                $j = c_miles($k['CustomerKey']);
            }else{
                $j = "N/A";
                $j = 0;
            }
            echo "<tr class='heading' ".void_check($k['Void'],$k['manual_entry'])." >";
            echo "<td><img src='img/3927-200.png' class='image_upload' style='cursor:pointer;float:left;height:25px;height:25px;' rel='$k[TransactionKey]' weignin='$k[WeighIn]'/></td>";
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
            echo "<td>$j</td>";
            echo "<td><input value='$k[extra_miles]' type='text' class='em' placeholder='Extra Miles' rel='$j'";
            if($_SESSION['billing'] == 5 || $_SESSION['billing'] == 1){

            }else{
                echo " readonly ";
            }
            echo" style='width:100px;' weight='$k[tk]' /></td>";
            echo "<td><input  value='$k[total_miles]'  type='text' class='tm' placeholder='Total Miles' style='width:100px;' readonly /></td>";
            echo "<td><textarea class='additional_notes' placeholder='Additional Notes' weight='$k[tk]'>$k[additional_notes]</textarea></td>";


            if(  $k['VendorKey'] == 1632    ){
                echo "<td><a href='ppb_lot.php?tk=$k[tk]&modern=modern' rel='shadowbox;width=400;height=120;'><img src='img/lab_icon.jpg' style='width:20%;height:20%;'/></a></td>";
            }else{
                echo "<td><a href='ppb_lot.php?tk=$k[tk]&origin=$k[origin_weight_cert]' rel='shadowbox;width=400;height=120;'><img src='img/lab_icon.jpg' style='width:20%;height:20%;'/></a></td>";
            }






            echo "<td><input placeholder='Seal #' type='text' value='$k[lot_number]' class='seal_number' weight='$k[tk]' style='width:100px;'/></td>";
            echo "<td>".haulerDecode($k['TruckKey'])."</td>";
            echo "<td>$k[Void]</td>";
            echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
            echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";

            echo "<td>$ven_custom</td>";
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
                echo "<span style='display:none;'>$k[WeighOut]</span> $newDateOut";
            }
            echo "</td>";
            echo "<td>" . number_format($k['Gross']) . "</td>";
            echo "<td>" . number_format($k['Tare']) . "</td>";
            echo "<td>" . number_format($k['Net']) . "</td>";
            $names = explode(" ", $k['UserName']);
            $acronym = str_split($names[0])[0] . ". " . end($names);

            echo "<td>" . $acronym . "</td>";
            echo "<td>".truckDecode($k['TruckKey'],"id1")."</td>";
            echo "<td>".truckDecode($k['TruckKey'],"id2")."</td>";
            echo "<td>$k[UF2Data]</td>";
            echo "</tr>";
        }
    }

    ?>
    </tbody>

</table>