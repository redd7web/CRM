<?php
include "protected/global.php";
include "source/css.php";
include "source/scripts.php";
ini_set("display_errors",1);

if($_SESSION['billing']==1 || $_SESSION['billing']==5){
    $mach_form_cus_ven= "";
    
    if(isset($_POST['scaleup'])){
        switch($_POST['shipmode']){
            case "S":
                $customerkey = $_POST['customers'];
                $vendorkey = null;
                $mach_form_cus_ven = $_POST['customers'];
            break;
            case "R":
                $customerkey = null;
                $vendorkey = $_POST['vendors'];
                $mach_form_cus_ven = $_POST['vendors'];
            break;
        }
        
        $transkey = preg_replace("/[^0-9]/", "", $_POST['weight_ticket']);
        $suitcase = array(
            "TransactionKey"=>$transkey,
            "TruckKey"=>$_POST['truck'],
            "CustomerKey"=>$_POST['customers'],
            "ProductKey"=>$_POST['product'], 
            "WeighIn"=>$_POST['weigh_in'],
            "WeighOut"=>$_POST['weight_out'],
            "Gross"=>$_POST['gross'],
            "Tare"=>$_POST['tare'],
            "Net"=>$_POST['net'],
            "Units"=>$_POST['units'],
            "Void"=>"False",
            "ShipMode"=>$_POST['shipmode'],
            "UserName"=>$_POST['user_name'],
            "UF1Data"=>$_POST['release_no'],
            "UF3Data"=>$_POST['notes'],
            "VendorKey"=>$_POST['vendors'],
            "tk"=>$_POST['weight_ticket'],
            "additiona_notes"=>$_POST['additional_notes'],
            "lot_number"=>$_POST['lot'],
            "seal_number"=>$_POST['seal_number'],
            "manual_entry"=>1
        );
        
        print_r($suitcase);
        if( $db->insert("iwp_test_scale",$suitcase) ){
            $idx = $db->getInsertId();
            if( !empty($_FILES['files']['tmp_name'])){
                for($i=0; $i < count($_FILES['files']['tmp_name']);$i++){
                    $tmpFilePath = $_FILES['files']['tmp_name'][$i];
                      //Make sure we have a file path
                      if ($tmpFilePath != ""){
                        //Setup our new file path
                        if(!file_exists("scale_ticket_uploads/$_POST[weight_ticket]/")){
                            mkdir("scale_ticket_uploads/$_POST[weight_ticket]/",0777);
                        }
                        $nf = str_replace(" ","-",$_FILES['files']['name'][$i]);
                        $nf =  preg_replace('/[^a-zA-Z0-9_.]/', '', $nf);
                        $newFilePath = "scale_ticket_uploads/$_POST[weight_ticket]/" .$nf ;
                        /**/
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $pack = array(
                                "scale_entry"=>$_POST['weight_ticket'],
                                "image_path"=>$newFilePath
                            );
                            $db->insert("scale_ticket_images",$pack); 
                        }
                        echo "$newFilePath<br/>";
                    } 
                }
            }
            
            $weigh_in = explode(" ",$_POST['weigh_in']);
            $weigh_out = explode(" ",$_POST['weight_out']);
            $mfs = array(
                "date_created"=>date("Y-m-d H:i:s"),
                "element_1"=>$_POST['weight_ticket'],
                "element_2"=>$_POST['truck'],
                "element_3"=>$mach_form_cus_ven,
                "element_4"=>$_POST['release_no'],
                "element_5"=>$_POST['product'],
                "element_7"=>$weigh_in[0],
                "element_6"=>$weigh_in[1],
                "element_8"=>$weigh_out[0],
                "element_9"=>$weigh_out[1],
                "element_10"=>$_POST['gross'],
                "element_11"=>$_POST['tare'],
                "element_12"=>$_POST['net'],
                "element_13"=>$_POST['shipmode'],
                "element_14"=>$_POST['user_name'],
                "element_15"=>"False"
            );
            $db->insert("Inetforms.ap_form_64000",$mfs);
            
            echo "<span style='font-size:40px;color:green;width:auto;margin:auto;'>Ticket entered successfuly!</span>";
        }else{
            echo "Unable to insert key";
        }
    }
?>

<style>
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
span{
    margin-left:5px;
}
</style>

<form action="manual_ticket.php" enctype="multipart/form-data" style="width: 350px;margin:auto;" method="POST">
<span style="float: left;"><label for="shipmode">ShipMode</label><select id="shipmode" name="shipmode"><option>---</option><option value="S">Outbound</option><option value="R">Inbound</option></select></span>

<span style="float: left;"><label for="weight_ticket">Weight Ticket</label><input style="width:150px;" type="text" id="weight_ticket" name="weight_ticket" placeholder=""/></span>
<span style="float: left;"><label for="weight_ticket">Backhaul</label><input style="width:150px;" type="text" id="backhaul" name="backhaul" placeholder=""/></span>
<span style="float: left;"><label for="weight_ticket">Miles</label><input style="width:150px;" type="text" id="miles" name="miles" placeholder=""/></span>
<span style="float: left;"><label for="weight_ticket">Additional Notes</label><textarea style="width:150px;" id="additional_notes" name="additional_notes" placeholder="Additional Notes"></textarea></span>
<span style="float: left;"><label for="weight_ticket">Lot #</label><input style="width:150px;" type="text" id="lot" name="lot" placeholder="Lot #"/></span>
<span style="float: left;"><label for="weight_ticket">Seal #</label><input style="width:150px;" type="text" id="seal_number" name="seal_number" placeholder="Seal Number"/></span>
<span style="float: left;"><label for="weight_ticket">Hauler</label><input style="width:150px;" type="text" id="hauler" name="hauler" placeholder="Hauler"/></span>
<span style="float: left;"><label for="weight_ticket">Driver</label><input style="width:150px;" type="text" id="Driver" name="driver" placeholder="Driver"/></span>
<span style="float: left;"><label for="weight_ticket">TruckID/License</label><input style="width:150px;" type="text" id="truck_license" name="truck_license" placeholder=""/></span>

<span style="float: left;"><label for="weight_ticket">Release No.</label><input style="width:150px;" type="text" id="release_no" name="release_no" placeholder=""/></span>
<span style="float: left;"><label for="weight_ticket">Notes</label><textarea style="width:150px;" id="notes" name="notes" placeholder="Notes"></textarea></span>

<span style="float: left;"><label for="weight_ticket">Weigh In</label><input style="width:150px;" type="text" id="weigh_in" name="weigh_in" placeholder="Weigh In"/></span>
<span style="float: left;"><label for="weight_ticket">Weigh Out</label><input style="width:150px;" type="text" id="weight_out" name="weight_out" placeholder="Weigh Out"/></span>
<span style="float: left;"><label for="weight_ticket">Gross</label><input style="width:150px;" type="text" id="gross" name="gross" placeholder="Gross"/></span>
<span style="float: left;"><label for="weight_ticket">Tare</label><input style="width:150px;" type="text" id="tare" name="tare" placeholder="Tare"/></span>
<span style="float: left;"><label for="weight_ticket">Net</label><input style="width:150px;" type="text" id="net" name="net" placeholder="Net"/></span>
<span style="float: left;"><label for="weight_ticket">User Name</label><input style="width:150px;" type="text" id="user_name" name="user_name" placeholder="User Name"/></span>
<span style="float: left;"><label for="weight_ticket">Trailer ID 1</label><input style="width:150px;" type="text" id="trailer_1" name="trailer_1" placeholder="Notes"/></span>
<span style="float: left;"><label for="weight_ticket">Trailer ID 2</label><input style="width:150px;" type="text" id="trailer_2" name="traier_2" placeholder="Trailer 2"/></span>
<span style="float: left;"><label for="weight_ticket">Units</label><input style="width:150px;" type="text" id="weight_ticket" name="units" placeholder="Units"/></span><br />
<span style="float: left;"><label for="weight_ticket">Division</label>

        <select class='division' name="division">
        <option>---</option>
        <option  value='2'>2</option>
        <option  value ='4'>4</option>
        <option value='7'>7</option>
        <option value='B'>B</option>
        <option value='C'>C</option>
        <option  value='D'>D</option>
        <option value='E'>E</option>
        <option value='F'>F</option>
        <option value='G'>G</option>
        <option value='H'>H</option>
        <option value='I'>I</option>
        <option value='J'>J</option>
        <option value='K'>K</option>
        <option value='L'>L</option>
        <option value='M'>M</option>
        <option value='N'>N</option>
        <option value='O'>O</option>
        <option value='P'>P</option>
        <option value='Q'>Q</option>
        <option value='R'>R</option>
        <option value='RP'>RP</option>
        <option value='RW'>RW</option>
        <option value='S'>S</option>
        <option value='T'>T</option>
        <option value='UC'>UC</option>
        <option value='UD'>UD</option>
        <option value='US'>US</option>
        <option value='V'>V</option>
        <option value='W'>W</option>
        <option value='WT'>WT</option>
        </select></span>
        <span style="float: left;"><label for="customers">Buyer (Customer)</label><select id="customers" name="customers"><option value="">---</option><?php
            $oc = $db->query("SELECT DISTINCT(Name) as Name, CustomerKey FROM iwp_customers");
            if(count($oc)>0){
                foreach($oc as $l){
                    echo "<option value='$l[CustomerKey]'>$l[Name]</option>";
                }
            }
         ?></select></span>
        <span style="float: left;"><label for="vendors">Seller(Vendor)</label><select id="vendors" name="vendors"><option value="">---</option><?php
            $oc = $db->query("SELECT DISTINCT(Name) as Name, VendorKey FROM iwp_vendors");
            if(count($oc)>0){
                foreach($oc as $l){
                    echo "<option value='$l[VendorKey]'>$l[Name]</option>";
                }
            }
         ?></select></span>
        <span style="float: left;"><label for="products">Product</label><select id="product" name="product">
        <option value="">---</option><?php
            $oc = $db->query("SELECT DISTINCT(Name) as Name, ProductKey FROM iwo_products");
            if(count($oc)>0){
                foreach($oc as $l){
                    echo "<option value='$l[ProductKey]'>$l[Name]</option>";
                }
            }
         ?></select>
        </select> </span>
        
        <span style="float: left;"><label for="truck">Truck</label><select id="truck" name="truck">
        <option value="">---</option><?php
            $oc = $db->query("SELECT DISTINCT(Name) as Name, TruckKey FROM iwp_scale_truck");
            if(count($oc)>0){
                foreach($oc as $l){
                    echo "<option value='$l[TruckKey]'>$l[Name]</option>";
                }
            }
         ?></select>
        </select> </span>
        
        
        <span style="float:left;"><label for="image_upoad">Upload Pictures</label><input type="file" name="files[]" id="files" multiple /></span><br />
        <input type="reset" style="float: right;"/>&nbsp;<input type="submit" style="float: right;" name="scaleup" value="Submit Ticket"/>
</form> 
<script>
$("#weigh_in,#weight_out").datetimepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});    
</script>
<?php 
    
}
?>