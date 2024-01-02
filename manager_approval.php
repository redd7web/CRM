<?php
    
include "protected/global.php";
include "scaleFunctions.php";
if($_SESSION['username'] == "RDizon" || $_SESSION['username'] == "spyro"){
    ini_set("display_errors",1);
}
//Manager
$permit = array (1,3,8);

include "source/scripts.php";
include "source/css.php";
    ?>
    
  <script>
    $(document).ready(function(){
       $('#myTable').dataTable({
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
<h1>Manager Approvals</h1>
  <?php
    //Inbound Manager Approvals
    
    if( !empty($_SESSION['division'])){
        $ko = "SELECT iwp_test_scale.ProductKey,iwp_test_scale.CustomerKey,iwp_test_scale.VendorKey,iwp_test_scale.JobKey, iwp_test_scale.* FROM iwp_test_scale  LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey =  iwp_test_scale.TruckKey WHERE division IN (".implode(",", $_SESSION['division']).") AND ShipMode ='R'  AND manage_approve =0 AND manual_entry = 0 AND  WeighIn BETWEEN CURRENT_TIMESTAMP - INTERVAL '7' DAY AND CURRENT_TIMESTAMP  GROUP BY tk";
        echo $ko.'<br/>';
        $inbound_approvex = $db->query($ko); 
    }else{
        echo "No Division(s) Assigned<br/>";
    }
    
  ?>
  

  
  <table id="myTable" class="ExcelTable2007"> 
        <thead>
            <tr>
                <th style="background: #bbbbbb;">Approval</th>
                <th style="background: #bbbbbb;">IWP Weight Cert</th>
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
                <th style="background: #bbbbbb;">User Name</th>
                <th style="background: #bbbbbb;">Hauler</th>
                <th style="background: #bbbbbb;">Truck ID/License</th>
                <th style="text-align: center;background: #bbbbbb;">Total Miles</th>
                <th style="background: #bbbbbb;">Void</th>
                <th>Origin Weight Cert 1/2</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if( !empty($_SESSION['division'])){
                if(count($inbound_approvex)>0){
                        foreach($inbound_approvex as $k){
                            $newDateIn = date("m/d/Y H:i:s", strtotime("$k[WeighIn]"));
                            echo "<tr class='heading' ".void_check($k['Void'],$k['manual_entry'])."  >";
                            echo "<td><input type='checkbox' value='1' class='ma' rel='$k[tk]' "; if($k['manage_approve'] == 1){ echo " checked ";  } else { echo ""; }  echo " /></td>";//approval Column
                            echo "<td>$k[tk]</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"name")."</td>";
                            echo "<td>";
                            switch($k['ProductKey']){
                                case 4: case 5: case 7: case 22: case 24: case 25: case 27: case 28: case 30: case 31: case 32: case 34: case 41: case 42: case 43: case 44: case 50: case 51: case 54: case 57: case 58: case 59: case 60: case 62: case 63: case 65: case 67: case 68: case 71: case 72: case 75: case 79: case 83: case 89: case 20: case 29: case 82: case 90://inbound loads
                                    $j = v_miles($k['VendorKey']);
                                    echo Vendors($k['VendorKey']);
                                 break;
                                 case 87: case 84:
                                    if( strlen(trim($k['VendorKey']))>0 || $k['VendorKey'] != NULL ){
                                        echo Vendors($k['VendorKey']);
                                        $j = v_miles($k['VendorKey']);
                                    }else if( strlen(trim($k['CustomerKey']))>0  || $k['CustomerKey'] != NULL  ){
                                        echo CustomerKey($k['CustomerKey']);
                                        $j = c_miles($k['CustomerKey']);
                                    }else{
                                        echo "N/A";
                                    }
                                break;
                                default:
                                 echo Vendors($k['VendorKey']);
                                  $j = v_miles($k['VendorKey']);
                                  break;
                            }
                            echo "</td>";
                           
                            echo "<td>$k[UF1Data]</td>";
                            echo "<td>$k[UF3Data]</td>";
                            echo "<td>".productKey($k['ProductKey'])." $k[ProductKey]</td>";
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
                            echo "<td>".haulerDecode($k['TruckKey'])."</td>";
                            echo "<td>".truckDecode($k['TruckKey'],"truckid")."</td>";
                            echo "<td>"; 
                                if(strlen(trim($j))>0){
                                   if(strlen(trim($k['total_miles']))>0){
                                         echo "<input  value='$k[total_miles]'  type='text' class='tm' placeholder='Total Miles' style='width:100px;' readonly />";
                                   }else{
                                        echo $j;
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
            }else{
                
            }
        ?>
        </tbody>
    </table>
    <script>
  
    
    
    $(".ma").click(function(){
        if($(this).is(":checked")){
            $.post("manager_approve_normal.php",{tk:$(this).attr('rel')},function(data){
                alert("Load approved! "+data);
            });
        }
        
    });
    </script>