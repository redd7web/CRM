<?php 
function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}

include "protected/global.php"; $page = "customers"; 

if(isset($_SESSION['id'])){  
    date_default_timezone_set("America/Los_Angeles");
    $account = new Account($_GET['id']);
    $person = new Person();
    $value = $db->where("account_no",$account->acount_id)->get("iwp_containers");     
   //echo $account->payment_method;
    //echo "<br/>".$account->acount_id;
  // var_dump($account);
}
function get_index(){
    global $db;
    $xo =  $db->query("SELECT date,percentage FROM iwp_jacobsen ORDER BY DATE DESC LIMIT 0,1 ");
    
    if(count($xo)>0){
        return $xo;
    } else {
        return 0;
    }
}

$ko =get_index();
?>
<html>
<head>
<?php 
include "source/scripts.php";
include "source/css.php";

 $rolesArray = $person->roles;
 if(in_array("facility manager", $rolesArray)){
     $userManager = 1;
 } else {
     $userManager = 0;
 }


?>


<script type="text/javascript">
    Shadowbox.init();
</script>
 <style>
    #table_labels td{ 
        text-align:right;
        vertical-align:top;
    }
    
    table#bottominfo td{
        padding:0px 0px 0px 0px;
        font-size:14px; 
        
    }
    .editable_field{
        border-spacing: 0px;
        border-collapse: collapse;
        border-left:3px solid #bbb;
        font-size:12px;
    }
    
    .close {
        cursor:pointer;
    }
    
    select{
        float:right;
    }
    </style>
</head>
<body>
    <div id="leftbox" style="width:400px ;float:left;min-height:900px;height:auto;">
            <div id="mainInfo" style="width: 357px;height:250px;float:left;padding-right:10px;text-align:right;padding-top:10px;margin-top:10px;">
   
              <table style="width: 100%;min-height:300px;height:auto;padding:0px 0px 0px 0px;padding-left:5px;padding-top:5px;border-collapse:collapse;font-size:12px;" id="table_labels">
                <tr>
                    <td style="padding-right: 5px;">Account Name</td>
                    <td style="border-top: 3px solid #bbb;border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;vertical-align: top;padding-left:5px;" id="account_name_value"  title="Edit Account Name" class="editable_field" rel="aname">
                       <span id="acname"> <?php echo $account->name; ?><br /></span>
                      <input type="" placeholder="enter new name here" class="field" rel="name" xlr="<?php echo $account->acount_id; ?>"/>
                    </td></tr>
                <tr>
            <td style="padding-right: 5px;"> Street Address</td>
            <td style="border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;vertical-align: top;padding-left:5px;" id="street_address_value"   title="Edit Street Address"     class="editable_field" >  
            <input type="text" value="<?php echo $account->address; ?>" style="border: 0px;width:100%;padding:0px 0px 0px 0px;" class="field" rel="address"/>&nbsp;</td></tr>
        <tr>
                <tr>
                    <td style="padding-right: 5px;">Full Address</td>
                    <td style="border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;vertical-align: top;padding-left:5px;" id="address_value"   title="Edit Address"     class="editable_field" >  <input type="text" value="<?php echo $account->full_address; ?>" style="border: 0px;width:100%;padding:0px 0px 0px 0px;" class="field" rel="full_address"/>&nbsp;</td></tr>
                <tr>
                    <td style="padding-right: 5px;">Payee Name</td>
                    <td style="border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;vertical-align: top;padding-left:5px;" id="payee_value"  title="Edit Payee" class="editable_field" ><input type="text" value="<?php echo $account->payee_name; ?>" style="border: 0px;width:100%;" class="field" rel="payee_name"/>&nbsp;</td></tr>
                
                <tr>
                    <td style="padding-right: 5px;">Contact</td>
                    <td style="border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;vertical-align: top;padding-left:5px;" id="contact_value"  title="Edit Contact"  class="editable_field"> <input type="text" value="<?php echo $account->contact_name; ?>" style="border: 0px;width:100%;" class="field"  rel="contact_name"/>&nbsp;</td></tr>
                
                <tr>
                    <td style="padding-right: 5px;">Area Code</td>
                    <td style="border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;
                    vertical-align: top;padding-left:5px;" id="area_code_value" title="Edit Area Code"  class="editable_field field"><input type="text" value="<?php echo $account->area_code; ?>" style="border: 0px;width:100%;" class="field"  rel="area_code"/>&nbsp;</td>
                </tr>
                <tr>


                <tr>
                    <td style="padding-right: 5px;">Phone</td>
                    <td style="border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;
                    vertical-align: top;padding-left:5px;" id="phone_value" title="Edit Area Code"  class="editable_field field"><input type="text" value="<?php echo $account->phone; ?>" style="border: 0px;width:100%;" class="field"  rel="phone"/>&nbsp;</td>
                </tr>
               
                 <tr>
                    <td style="padding-right: 5px;">Email</td>
                    <td style="border-right: 3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;
                    vertical-align: top;padding-left:5px;" id="email_value" title="Edit Email"  class="editable_field field"><input type="text" value="<?php echo $account->email_address; ?>" style="border: 0px;width:100%;" class="field"  rel="email_address"/>&nbsp;</td>
                </tr>
                <tr>
                    <td style="padding-right: 5px;">Website</td>
                    <td style="border-right: 3px solid #bbb;border-bottom:3px solid #bbb;padding:0px 0px 0px 0px; text-align:left;vertical-align: top;padding:0px 0px 0px 0px;padding-left:5px;" id="web_value" title="Edit Web Url"   class="editable_field field" >http://<input type="text" value="<?php echo $account->url; ?>" placeholder="www.domain.com"  style="border: 0px;width:80%;" class="field" rel="url"/>&nbsp;</td>
                </tr>
              </table>
              
                
            </div>
              <!-- <div id="debug"></div>--!>
            <table style="margin-left:39px;width:320px;border-top:0px solid #bbb;" id="lastinfo">
                <tr><td>Competitor Onsite? </td><td><input class="fieldx" <?php if($account->competitor_onsite=1){ echo " checked "; }  ?>   name="onsite_comp" id="onsite_comp" rel="onsite_comp" type="checkbox" value="1"/></td></tr>
                <tr><td>Competitor Name</td><td>
                
                <select class="field" id="comp_name" name="comp_name" rel="comp_name" style="float: left;margin-left:5px;width:150px;" >
                     <option <?php if($account->competitor_name="Advantage Bio"){ echo " selected "; }  ?>  value="Advantage Bio">Advantage Bio</option> 
                     <option <?php if($account->competitor_name="Affordable Grease Pumping"){ echo " selected "; }  ?>   value="Affordable Grease Pumping">Affordable Grease Pumping</option>
                     <option <?php if($account->competitor_name="BioDriven"){ echo " selected "; }  ?>   value="BioDriven">BioDriven</option> 
                     <option <?php if($account->competitor_name="Buster Bio"){ echo " selected "; }  ?>   value="Buster Bio">Buster Bio</option> 
                     <option <?php if($account->competitor_name="Baker Comm."){ echo " selected "; }  ?>   value="Baker Comm.">Baker Comm.</option> 
                     <option <?php if($account->competitor_name="Darling Int."){ echo " selected "; }  ?>   value="Darling Int.">Darling Int.</option>
                     <option <?php if($account->competitor_name="New Leaf"){ echo " selected "; }  ?>   value="New Leaf">New Leaf</option>              
                     <option <?php if($account->competitor_name="Promethian"){ echo " selected "; }  ?>   value="Promethian">Promethian</option> 
                     <option <?php if($account->competitor_name="HT Grease"){ echo " selected "; }  ?>   value="HT Grease">HT Grease</option> 
                     <option <?php if($account->competitor_name="Co-West"){ echo " selected "; }  ?>   value="Co-West">Co-West</option>  
                     <option <?php if($account->competitor_name="Industrial Bio"){ echo " selected "; }  ?>   value="Industrial Bio">Industrial Bio</option>	
                     <option <?php if($account->competitor_name="JK Collections"){ echo " selected "; }  ?>   value="JK Collections">JK Collections</option> 
                     <option <?php if($account->competitor_name="AWJ"){ echo " selected "; }  ?>   value="AWJ">AWJ</option> 
                     <option <?php if($account->competitor_name="Triple A"){ echo " selected "; }  ?>   value="Triple A">Triple A</option> 
                     <option <?php if($account->competitor_name="So-Cal Pumping"){ echo " selected "; }  ?>   value="So-Cal Pumping">So-Cal Pumping</option>	
                     <option <?php if($account->competitor_name="Harbor"){ echo " selected "; }  ?>   value="Harbor">Harbor</option>
                     <option <?php if($account->competitor_name="GCI"){ echo " selected "; }  ?>   value="GCI">GCI</option>
                     <option <?php if($account->competitor_name="North County"){ echo " selected "; }  ?>   value="North County">North County</option>	
                   	 <option <?php if($account->competitor_name="OC Bio"){ echo " selected "; }  ?>   value="OC Bio">OC Bio</option>
                     <option <?php if($account->competitor_name="Eco-Fry"){ echo " selected "; }  ?>   value="Eco-Fry">Eco-Fry</option>
                     <option <?php if($account->competitor_name="Grand Natural"){ echo " selected "; }  ?>   value="Grand Natural">Grand Natural</option>
                     <option <?php if($account->competitor_name="Grease Masters"){ echo " selected "; }  ?>   value="Grease Masters">Grease Masters	</option>	
                     <option <?php if($account->competitor_name="LA Grease Solutions"){ echo " selected "; }  ?>   value="LA Grease Solutions">LA Grease Solutions</option>
                     <option <?php if($account->competitor_name="CGC"){ echo " selected "; }  ?>   value="CGC">CGC</option>	
                     <option <?php if($account->competitor_name="Coastal By-Products"){ echo " selected "; }  ?>   value="Coastal By-Products">Coastal By-Products</option>
                     <option <?php if($account->competitor_name="SMC"){ echo " selected "; }  ?>    value="SMC">SMC</option>
                     <option <?php if($account->competitor_name="HP Comm."){ echo " selected "; }  ?>   value="HP Comm.">HP Comm.</option>
                     <option <?php if($account->competitor_name="All Pro"){ echo " selected "; }  ?>   value="All Pro">All Pro</option>
                     <option <?php if($account->competitor_name="Belcito AJAX Pumping"){ echo " selected "; }  ?>   value="Belcito AJAX Pumping">Belcito AJAX Pumping</option>
                     <option <?php if($account->competitor_name="Green Dining Network"){ echo " selected "; }  ?>   value="Green Dining Network">Green Dining Network</option>

            </select></td></tr>
                <tr><td colspan="2" style="height: 100px;">&nbsp;</td></tr>
                <tr><td colspan="2" style="height: 100px;"></td></tr>
                <tr><td>Click below to verify address</td><td>&nbsp;</td></tr>
                <tr><td><span class="validate" title="Click to validate this address (copy and paste returned information into proper fields)" style="cursor: pointer;text-decoration:underline;color:blue;">Physical Street <br /> Address</span></td><td><input  value="<?php echo $account->address ?>"  type="text" id="address" name="address" class="editable_field field" rel="address" /></td></tr>
                <tr><td>Physical City</td><td><input value="<?php echo $account->city; ?>" type="text" id="city" name="city" class="editable_field field" rel="city"  /></td></tr>
                <tr><td>Physical State</td><td><input  value="<?php echo $account->state; ?>"  type="text" id="state" name="state" class="editable_field field" rel="state"  /></td></tr>
                <tr><td>Physical Zip <br /> Code</td><td><input  value="<?php echo $account->zip; ?>"  type="text" id="zip" name="zip" class="editable_field field" rel="zip"  /></td></tr>
                <tr><td>Billing Street Address</td><td><input  value="<?php echo $account->billing_address; ?>"   type="text" id="billing_address" name="billing_address" class="editable_field field" rel="billing_address"  /></td></tr>
                <tr><td>Billing City</td><td><input   value="<?php echo $account->city; ?>"  type="text" id="billing_city" name="billing_city" class="editable_field field" rel="billing_city"  /></td></tr>
                <tr><td>Billing State</td><td><input   value="<?php echo $account->billing_state; ?>"  type="text" id="billing_state" name="billing_state" class="editable_field field" rel="billing_state" /></td></tr>
                <tr><td>Billing Zip</td><td><input   value="<?php echo $account->billing_zip; ?>"  type="text"  name="billing_zip" class="editable_field field"  rel="billing_zip" /></td></tr>
                <tr><td>Billing Email</td><td><input   value="<?php echo $account->billing_email; ?>"  type="text"  name="billing_email" class="editable_field field"  rel="billing_email" /></td></tr>
                <tr><td>New Boss #</td><td><input type="text" id="new_bos" name="new_bos" class="editable_field field" rel="new_bos"  value="<?php echo $account->new_bos; ?>" /></td></tr>
                <tr><td>Account Type</td><td>
                    <input <?php if($account->is_oil==1){ echo "checked";} ?> type="checkbox" name="is_oil" id="is_oil" class="fieldx"  rel="is_oil" value="1"/> Oil&nbsp;&nbsp;
                    <input <?php if($account->is_trap==1){ echo "checked";} ?> type="checkbox" name="is_trap" id="is_trap" class="fieldx"  rel="is_trap" value="1"/> Trap
                    </td>
                </tr>
                <tr><td style="text-align: right;">Account Status</td><td> <?php //echo $account->status; ?>
                
                <select id="status" name="status" class="field" rel="status"  style="margin-left:20px;width:100px;">
                    <option>--Please choose a status</option>
                    <option <?php if(strtolower($account->status) == "active"){echo "selected";} ?>  value="Active">Active( Ready to be serviced )</option>
                    <option <?php if(strtolower($account->status) == "archive"){echo "selected";} ?> value="Archive">Archived</option>
                    <option <?php if(strtolower($account->status) == "ending"){echo "selected";} ?>  value="Ending">Ending (Final pumping)</option>
                    <option <?php if( strtolower($account->status) == "new"){echo "selected";} ?>  value="New">New (Needs New Account)</option>
                    <option <?php if(strtolower($account->status)== "on hold"){echo "selected";} ?> value="On Hold">On Call (On Call)</option>
                </select>

                </td></tr>
                
                
                
                <tr><td style="text-align: right;vertical-align:top;"><img src="img/settings.png" id="settings" title="Change Payment Type" style="width: 20px;height:20px;cursor:pointer;"/>
                
                    <div id="dialog" style="width:250px;height:auto;position:absolute;background:rgba(255,255,255,.7);border:1px solid green;">
        
        
        <table style="width: 100%;">
            
            <tr><td><select style="width: 100%;" id="ptype">
            <option>--</option>
            <option value="No Pay"  id="np">No Pay</option>
            <option value="Jacobson" id="index">Index (Jacobson)</option>
            <option value="Per Gallon" id="pg">Per Gallon</option>
            <option value="O.T.P. Per Gallon" id="otppg">One Time Payment Per Gallon</option>
            <option value="O.T.P." id="otp">One Time Payment</option>
        </select>
        </td><td style='text-align:right;'><span title='close' class='close'>X</span></td></tr>
        </table>
        
        <table style="width: 100%;height:60px;" id="payment_options">
        
        <tr><td></td></tr>  
        
        </table>
        <table style="width: 100%;"><tr><td style='text-align:right;'><input type="submit" value="Change Now" id="changepayment"/></td></tr></table>
    </div>
    
     <?php  payment_label($account); ?> </td><td rel="jakepercent" class="editable_field" style="border-left: 0px solid transparent;text-align:left;vertical-align:top;">
                
                <?php 
                   
                    if($account->payment_method == "Jacobson" || $account->payment_method=="Index" ){
                        ?>
                        <input type="text" value="<?php echo round($account->index_percentage,2);?>" rel="index_percentage" class="field"/>
                        <?php
                    }
                    else if($account->payment_method == "Per Gallon" || $account->payment_method == "Normal") {
                        ?>
                        <input type="text" value="<?php echo round( $account->ppg_jacobsen_percentage,2);?>" rel="ppg_jacobsen_percentage" class="field"/>
                        <?php
                    } else if($account->payment_method == "One Time Payment Per Gallon" || $account->payment_method == "O.T.P. Per Gallon"){
                      ?>
                      <input type="text" value="<?php echo round( $account->ppg_jacobsen_percentage,2);?>" rel="ppg_jacobsen_percentage" class="field"/>
                      <input type="text" value="<?php echo round( $account->price_per_gallon,2);?>" rel="price_per_gallon" class="field"/>
                      <?php  
                    } else if ($account->payment_method == "O.T.P." || $account->payment_method == "One Time Payment") {
                        ?>
                        <input type="text" value="<?php echo $account->ppg_jacobsen_percentage; ?>" class="field" rel="ppg_jacobsen_percentage"/>
                        <?php
                    }
                    
                ?>
                </td></tr>
                
                <tr><td style="text-align: right;">M.I.U. %</td><td style="text-align: left;vertical-align:top;">
                    <input type="text" class="field" rel="miu" value="<?php echo ($account->miu * 100); ?>"/>
                </td></tr>
                
                <tr><td style="text-align: right;">Origination</td><td><?php echo origin($account->origin); ?></td></tr>
                <tr><td colspan="2" style="height: 20px;"></td></tr>
                <tr><td  style="text-align: right;">Pickup Frequency</td><td><input class="field" rel="pickup_frequency"  type="text" value="<?php echo $account->pick_up_freq; ?>"/></td></tr>
                <tr><td style="text-align: right;">Account Rep</td><td>
                
                    <?php 
                     echo "&nbsp;".uNumToName($account->account_rep)."<br/>";  
                     getSalesRep($account->account_rep);
                    ?>
                    </td></tr>
                <tr><td style="text-align: right;">Original Sale By</td><td><?php echo "&nbsp;".uNumToName($account->original_sales)."<br/>";                 
                    getOrigRep($account->original_sales);
                ?>
                
                </td></tr>

                <tr><td>Friendly</td><td><?php getFriendLists($account->friendly); ?></td></tr>
                <tr><td style="text-align: right;">Referred By</td><td></td></tr>
                <tr><td colspan="2" style="height: 10px;"></td></tr>
                <tr><td style="text-align: right;">Contract Period</td><td style="vertical-align: top; text-align:left;"><?php 
                
                
                if($account->expires != "0000-00-00")  { 
                  echo date_different(date("Y-m-d"),$account->expires);
                } else {
                    echo "Expiration date not set";
                }
                
                ?></td></tr>
                
                <tr><td style="text-align: right;font-size:12px;">Contract Signed On</td><td style="vertical-align: top;text-align:left;">
                
                <input type="text" id="csigned" name="csigned" class="field" rel="state_date" value="<?php echo $account->state_date; ?>"/>
                </td></tr>
                <tr><td style="text-align: right;font-size:12px;"   >Contract Expires On</td><td style="vertical-align: top;text-align:left;">
                <input type="text" id="expires" name="expires" class="field" rel="expires" value="<?php echo $account->expires; ?>"/>
                </td></tr>
                
                 <tr><td style="text-align: right;font-size:12px;"   >Created On</td><td style="vertical-align: top;text-align:left;">
                <input type="text"  readonly=""  rel="created" value="<?php echo $account->created; ?>"/>
                </td></tr>
                
                <tr><td style="text-align: right;">Price $</td><td style="vertical-align: top;text-align:left;">
                <?php
                   
                   echo  $account->payment_method;
                ?>
                
                </td></tr>
               
                <tr><td style="text-align: right;">Total Capacity</td><td>
                <?php                 
                   echo $account->total_barrel_capacity;
                ?> 
                    
                 </td></tr>
                <tr><td style="text-align: right;">Containers</td><td>
                  <?php echo $account->number_of_barrels; ?>
                </td></tr>
                <tr><td style="text-align: right;">GPM</td> <td>
                            <?php 
                echo round($account->ticks_per_day*30,2);
                ?>
                </td></tr>
                <tr><td style="text-align: right;">Total Gallons</td><td>
                <?php 
                    
                echo $account->total_gallons;
                ?>
                </td></tr>
                <tr><td>Total Pickups (Lifetime)</td><td><?php echo $account->number_of_pickups; ?></td></tr>
                <tr><td>Average Gallons (Lifetime)</td><td><?php
                echo number_format($account->total_gallons / $account->number_of_pickups,2);
                
                 ?></td></tr>
                                
            </table>            
           
           </div>
           <div id="rightbox" style="width: 500px;min-height:900px;height:auto;float:left;background:transparent;">
                <div id="notesbox" style="width: 480px;border:2px solid gray;height:250px;margin-left:5px;margin-top:10px;">    
                <!---
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div> 
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div>
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div>
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div>      
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div>
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div>
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div>
                    <div class="squarebox" style="border-radius: 10px;background:#bbbbbb;width:50px;height:50px;float:left;margin-left:9px;margin-top:5px;"></div>
                    ---!>
                    
                    <div id="subinfo" style="width: 98px;padding-right:10px;text-align:right;float:left;margin-top:5px;font-size:9px;">
                        <a href="upload_file.php?account=<?php echo $account->acount_id; ?>&mode=1" rel="shadowbox;width=500;height=200;" title="Contract">Contract -</a><br/><br />
                        <span id="poster"  style="cursor: pointer;color:blue;text-decoration:underline;">Good Cleaning Practice Poster -</span> <br /><br />
                        <span id="removal" style="cursor: pointer;color:blue;text-decoration:underline;">Removal Notices - </span><br /><br />
                        <span id="photos"  style="cursor: pointer;color:blue;text-decoration:underline;">Photos - </span><br /><br />
                        <span id="cancel_r" style="cursor: pointer;color:blue;text-decoration:underline;">Cancel Request - </span><br /><br />
                    </div>  
                    <div id="notesection" style="width: 362px;height:180px;border:1px solid green;border-radius: 5px;float:left;margin-top:5px;">
                     <?php 
                     if(file_exists("$account->acount_id/contract")){//has the sub folder already been created?
                        if ($handle = opendir("$account->acount_id/contract/")) {
                            if(!is_dir_empty("$account->acount_id/contract/")){// is the folder empty?
                                while (false !== ($entry = readdir($handle))) {            
                                    if ($entry != "." && $entry != "..") {        
                                        echo "&nbsp;&nbsp;<a href='$account->acount_id/contract/$entry' target='_blank'>$entry</a>"; 
                                    }
                                }        
                            }
                            closedir($handle);
                        }    
                    }
                    
                    echo "<br/><br/>";  
                    if(file_exists("$account->acount_id/poster")){
                          if ($handle = opendir("$account->acount_id/poster/")) {
                            if(!is_dir_empty("$account->acount_id/poster/")){
                                while (false !== ($entry = readdir($handle))) {            
                                    if ($entry != "." && $entry != "..") {        
                                        echo "<a href='$account->acount_id/poster/$entry' target='_blank'>Good Cleaing Practice Poster</a>";  
                                    }
                                }        
                            }
                            closedir($handle);
                        }    
                    }
                    echo "<br/><br/>";
                    if(file_exists("$account->acount_id/notices/")  && !is_dir_empty("$account->acount_id/notices/") ){
                        $dir = "$account->acount_id/notices";
                        $dh  = opendir($dir);
                        if(!is_dir_empty($dir)){
                            while (false !== ($filename = readdir($dh))) {
                                
                                if($filename !="."&& $filename !=".."){
                                    $files[] = $filename;
                                }
                            }
                            $count =1;
                            foreach($files as $file){
                                echo "
                                <a href='$account->acount_id/notices/$file' target='_blank'>View Notice $count</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
                                $count++;
                            }
                        }
                    }
                    
                    
                    if(file_exists("$account->acount_id/photos/") && !is_dir_empty("$account->acount_id/photos/")){
                        $dir = "$account->acount_id/photos";
                        $dh  = opendir($dir);
                        
                        if(!is_dir_empty($dir)){    
                            while (false !== ($filename = readdir($dh))) {
                                
                                if($filename !="."&& $filename !=".."){
                                    $files[] = $filename;
                                }
                            }
                            $count =1;
                            foreach($files as $file){
                                echo "
                                <a href='$account->acount_id/photos/$file' target='_blank'>Photo $count</a> &nbsp;&nbsp;|&nbsp;&nbsp;";
                                $count++;
                            }
                        }
                    }
                    
                    if(file_exists("$account->acount_id/cancel/")){
                            if ($handle = opendir("$account->acount_id/cancel/")) {
                                
                            if(!is_dir_empty("$account->acount_id/cancel")){    
                            while (false !== ($entry = readdir($handle))) {            
                                if ($entry != "." && $entry != "..") {        
                                      echo "<a href='$account->acount_id/cancel/$entry' target='_blank'>Cancellation Notice</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
                                }
                            }
                            }        
                            closedir($handle);
                        }
                             
                        
                    }
                    
                    
                    ?>
                     
                    </div>        
                </div>
                
    <div id="bottomSection" style="width: 480px;height:622px;border:1px solid #bbb;margin-left:5px;margin-top:10px;">
        <div id="pickup_title" style="width: 480px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;color: darkgreen;text-align:center;font-size:20px;">
                completed pickups (all locations)
        </div>
        <div id="statbox" style="width: 100%;overflow:auto;height:210px;">
            <table style="width:100%;">
            <tr style="border-bottom:2px solid black;">
                <td style="background: #E2E5DE;">Date</td>
                <td style="background: #E2E5DE;">Raw Gal</td>
                <td style="background: #E2E5DE;">Adj Gal</td>
                
                <td  style="background:#E2E5DE;">PPG</td>
                <td  style="background:#E2E5DE;">Value</td>
                <td style="background: #E2E5DE;">Loc ID</td>
                <td style="background: #E2E5DE;">Route</td>
            </tr>
            <?php
                $admin_payments = $db->query("SELECT * FROM iwp_data_table  WHERE deleted =0 AND  account_no = $account->acount_id order by date_of_pickup DESC");
                
                if(count($admin_payments)>0){
                    foreach($admin_payments as $payments){
                        echo "<tr><td>$payments[date_of_pickup]</td>
                                  <td>$payments[inches_to_gallons]</td>
                                  <td>"; $rc = $payments['inches_to_gallons'] - ( $payments['inches_to_gallons'] * $payments['temp_miu'] );
                        echo "$rc</td>
                                  <td>$payments[ppg]</td>
                                  <td>$payments[paid]</td>
                                  <td>$payments[account_no]</td>
                                  <td>$payments[route_id]</td>
                            </tr>";
                    }
                }
            ?>                        
            </table>
        </div>
        <div id="noted" style="width: 100%;height:20px;">
        &nbsp; <span style="color: red;font-weight:bold;font-size:14px;">*</span> Prices reflect price per gallon at time of pickup
        </div>
        <div id="lastSection" style="width: 480px;height:270px;background:transparent;margin-top:20px;">
            <div id="leftlastx" style="float:left;width:150px;min-height:250px;padding:10px 10px 10px 10px;background:transparent;height:auto;">
            <style>
            table#overview td {
                text-align:left;
            }
            </style>
                <table style="width: 175px;height:100px;border:0px solid #bbb;table-layout: fixed;font-size:12px;" id="overview">
                    <tr><td style="text-align: center;" colspan="2"><span style="color: green;font-size:13px;font-weight:bold;">Collection Overview</span></td></tr>
                    <tr><td style="height: 9px;vertical-align:top;">Total Pickups:</td><td>
                    <?php echo $account->number_of_pickups; ?></td></tr>

                    <tr><td style="height: 9px;vertical-align:top">Gallons Retrieved:</td><td style="text-align: left;vertical-align:top;"><?php echo round($total_g_collected,2); ?></td></tr>
                    <tr><td style="height: 9px;vertical-align:top">Gallons Adjusted</td><td style="text-align: left;vertical-align:top;"><?php echo round($total_g_adjusted,2); ?></td></tr>
                    <tr><td style="height: 9px;vertical-align:top:">Value:</td><td style="text-align: left;vertical-align:top;"><?php
                    if($account->payment_method == "One Time Payment"){
                        echo "$account->ppg_jacobsen_percentage";
                    }else {
                        echo $total_value;   
                    }
                      ?></td></tr>
                    
                    <tr><td style="height: 9px;vertical-align:top:">Total Paid:</td><td style="text-align: left;vertical-align:top;">&nbsp;</td></tr>
                    <tr><td style="height: 9px;vertical-align:top:">Total Paid for Oil:</td><td style="text-align: left;vertical-align:top;">
                    <?php
                    if($account->payment_method == "O.T.P. Per Gallon" || $account->payment_method == "One Time Payment Per Gallon" || $account->payment_method == "O.T.P. PG"){
                           echo "$ ".$account->ppg_jacobsen_percentage;//integrate w/ crystal reports payouts
                    }
                    ?>
                    </td></tr>
                    <tr><td style="height: 9px;vertical-align:top:">Total Paid for Other:</td><td style="text-align: left;vertical-align:top;">&nbsp;</td></tr>
                    <tr><td>Guest/Host</td><td>
                    <select name="sharing_type" id="sharing_type" style="float: left;margin-left:5px;" class="field" rel="guest_host">
                        <option value="host">Host</option>
                        <option value="guest">Guest</option>
                    </select></td></tr>
                    
                    <tr><td>Guest/Hosting Account</td><td><input type="text" value="Account Number"/></td></tr>
                    
                </table>
            </div>
            
            <div id="rightlast" style="float:left;width:290px;min-height:250px;padding:10px 10px 10px 10px;background:transparent;height:auto;">
                <style type="text/css">
                    table#payment {
                        border-collapse:collapse;
                    }
                </style>
                <div id="paymentbox" style="width: 284px;margin-left:10px;border:1px solid green;border-radius:5px;height:250px;overflow-x:hidden;overflow-y:auto;">
                <table style="width: 100%;font-size:13px;font-size:12px;" id="payment">
                
                <thead>
                <tr style="background: #E2E5DE;border-bottom:1px solid black;">
                    <td>Date</td>
                    <td>Payment</td>
                    <td>Gallons<br/>(adj)</td>
                    <td>PPG</td>
                    <td>Status</td>
                </tr>
                </thead>
                <tbody id="meat">
                <?php
                $gv = $db->where("deleted",0)->where("account_no",$account->acount_id)->orderby('date_of_pickup','desc')->get($dbprefix."_data_table","*");
                if(count($gv)>0){
                    $occurred_once[]="";
                    foreach($gv as $lo){
                        echo "<tr>";
                            echo "<td>$lo[date_of_pickup]</td>";
                            echo "<td>"; 
                                switch($account->payment_method){
                                    case "Jacobson": case "Index":
                                        echo number_format($account->index_percentage *$ko[0]['percentage'] * 7.56,2);
                                    break;
                                    default:
                                    case "Per Gallon": 
                                        echo $account->ppg_jacobsen_percentage;
                                    break;
                                    case "Normal":
                                        echo $account->price_per_gallon;
                                    break;
                                    case "O.T.P. Per Gallon":
                                        $ppgx = number_format($lo['inches_to_gallons']*.25 * $account->price_per_gallon,2);
                                        $occurred_oncex[]="";
                                        if(!in_array($account->acount_id,$occurred_oncex)){
                                            $occurred_oncex[]=$account->acount_id;
                                            echo $ppgx + $account->ppg_jacobsen_percentage; 
                                        } else {
                                            $one_timex = "";
                                            echo $ppgx;
                                        }
                                    break;
                                }
                            echo "</td>";
                            echo "<td>".number_format($lo['inches_to_gallons']*.25,2)."</td>";
                            echo "<td>"; 
                                switch($account->payment_method){
                                    case "Jacobson": case "Index":
                                        echo number_format($account->index_percentage *$ko[0]['percentage'] * 7.56,2);
                                    break;
                                    default:
                                    case "Per Gallon": 
                                        echo $account->ppg_jacobsen_percentage;
                                    break;
                                    case "Normal":
                                        echo $account->price_per_gallon;
                                    break;
                                        case "O.T.P. Per Gallon":
                                        $ppgx = number_format($account->price_per_gallon,2);
                                        $occurred_oncex[]="";
                                        if(!in_array($account->acount_id,$occurred_oncex)){
                                            $occurred_oncex[]=$account->acount_id;
                                            echo $ppgx + $account->ppg_jacobsen_percentage; 
                                        } else {
                                            $one_timex = "";
                                            echo $ppgx;
                                        }
                                    break;
                                }
                            echo"</td>";
                            echo "<td>$account->status</td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
                </table>
                
                <div style="clear: both;"></div>
                </div>
                
            </div>
            <div id="ranged" style="width: 100%;height:150px;background:transparent;float:left;">
                <table style="width: 100%;">
                <tr><td><input style="border-radius:10px;text-align:center;width:205px " type="text" id="from" name="fromt" placeholder="FROM"/></td><td><input style="width:205px ;text-align:center;" type="text" id="to" name="to" placeholder="TO"/></td></tr>
                    <tr><td colspan="2" style="text-align: right;"><input type="submit" value="Get Summary for Range Date" id="range" style="height: 30px;width:210px;color:black;letter-spacing:1px;font-size:10px;"/></td></tr>
                </table>
                <script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true,yearRange: "1:c+10"});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true,yearRange: "1:c+10"});
                    $("#range").click(function(){
                        $.post("get_range.php",{from:$("input#from").val(),to:$("input#to").val(),account_no:<?php echo $account->acount_id; ?>},function(data){
                            alert(data);
                          $("#paymentbox tbody").html(data); 
                        });
                    });
                </script>
                </div>
        </div>
    </div>
     <div style="clear: both;"></div>
</div>
 <div style="clear: both;"></div>
    
   <br />

   
  <script>



    
     $("body").on('focus','#expires',function(){
         $(this).datepicker({dateFormat:"yy-mm-dd"});
    });
    
    $("body").on('focus','#csigned',function(){
         $(this).datepicker();
    });
     
    $("body").on('focus','#created',function(){
         $(this).datepicker();
    }); 
     
    $("#friendly").change(function(){
        $.post('updateFriendly.php',{friend:$("#friendly").val(),account:<?php echo $account->acount_id; ?>},function(data){
           alert("Friendly updated"); 
        });
    });
  
    
    $("#cancel_r").click(function(){
        Shadowbox.open({
            content: 'upload_file.php?account=<?php echo $account->acount_id; ?>&mode=5',
            player:"iframe",
            width:500,
            height:200,
            loadingImage:"shadow/loading.gif",
            title:"Cancellation Request",
            options: {
                overLayColor:"#ffffff",
                overlayOpacity:".9"
            }
       }); 
        
    });         
                
   $("#photos").click(function(){
        Shadowbox.open({
            content: 'upload_file.php?account=<?php echo $account->acount_id; ?>&mode=4',
            player:"iframe",
            width:500,
            height:200,
            loadingImage:"shadow/loading.gif",
            title:"Photos",
            options: {
                overLayColor:"#ffffff",
                overlayOpacity:".9"
            }
       });
   });
                
                
    $("#removal").click(function(){
       Shadowbox.open({
            content: 'upload_file.php?account=<?php echo $account->acount_id; ?>&mode=3"',
            player:"iframe",
            width:500,
            height:200,
            loadingImage:"shadow/loading.gif",
            title:"Removal Notices",
            options: {
                overLayColor:"#ffffff",
                overlayOpacity:".9"
            }
       }); 
    });
    
    $("#poster").click(function(){
        Shadowbox.open({
            content: 'upload_file.php?account=<?php echo $account->acount_id; ?>&mode=2',
            player:"iframe",
            width:500,
            height:200,
            loadingImage:"shadow/loading.gif", 
            title: "Good Cleaning Practice Poster",
            options: {    
                overlayColor:"#ffffff",
                overlayOpacity: ".9"
            }
        });
    });






  
    $("#index").click(function(){
        $("#payment_options").html("<tr><td><input type='text' placeholder='Jac. %' id='indexval' style='width:100%' maxlength='2' id='jake'/></td></tr>");
    });
    
    $("#pg").click(function(){
        $("#payment_options").html("<tr><td><input type='text' placeholder='price per gallon' id='ppgval'  maxlength='2' style='width:100%'/></td></tr>");
    });
    
    $("#otppg").click(function(){
        $("#payment_options").html("<tr><td><input type='text'  placeholder='One Time Payment Amount' id='otpconsist' style='width:100%'/></td></tr><tr><td><input type='text'  id='otppgval' maxlength='2' placeholder='price per gallon' style='width:100%'/></td></tr>");
    });
    
    $("#otp").click(function(){
        $("#payment_options").html("<tr><td><input type='text' placeholder='One Time Payment Amount' id='otpval' style='width:100%'/></td></tr>");
    });
    
    $("#np").click(function(){
        $("#payment_options").html(''); 
    });
    
    $("#changepayment").click(function(){
        
        switch(  $("#ptype").children(":selected").attr("id") ){
            case "np":                  
                    $.post("changepayment_nopay.php",{ account: <?php echo $account->acount_id; ?>,payment_type: "No Pay"    },function(data){
                     alert("Payment changed to No Pay!");
                      $.get("viewAccount-admin.php",{id: <?php echo $account->acount_id; ?> },function(data){
                        $("#info-box").css("background","none");
                        $("#info-box").html(data);
                      });  
                  });
                break;
            case "index":
                      //alert("index!");
                      var value =$("#indexval").val();
                      value = value/100;
                      alert( $("#ptype").val() );
                      $.post("changepayment_index.php",{ account: <?php echo $account->acount_id; ?>,payment_type: $("#ptype").val(),index_percent: value    },function(data){
                            alert("Payment changed to Index!");
                            $.get("viewAccount-admin.php",{id: <?php echo $account->acount_id; ?> },function(data){
                                $("#info-box").css("background","none");
                                $("#info-box").html(data);
                            }); 
                      });
                break;
            case "pg":
                  value = $("#ppgval").val()/100;
                  $.post("changepayment_ppg.php",{ account: <?php echo $account->acount_id; ?>,payment_type: "Per Gallon",ppgval: value    },function(data){
                        alert("Payment changed to Per Gallon!");
                        $.get("viewAccount-admin.php",{id: <?php echo $account->acount_id; ?> },function(data){
                            $("#info-box").css("background","none");
                            $("#info-box").html(data);
                        }); 
                  });
                break;
            case "otp":                  
                  $.post("changepayment_otp.php",{ account: <?php echo $account->acount_id; ?>,payment_type: "One Time Payment",otp: $("#otpval").val()    },function(data){
                       alert("Payment changed to One Time Payment!");
                       $.get("viewAccount-admin.php",{id: <?php echo $account->acount_id; ?> },function(data){
                        $("#info-box").css("background","none");
                        $("#info-box").html(data);
                      }); 
                  }); //14331 Euclid St.  
                break;
            case "otppg":
                value = $("#otppgval").val() /100;
            
                $.post("changepayment_otp_ppg.php",{ account: <?php echo $account->acount_id; ?>,payment_type: $("#ptype").val(),otp: $("#otpconsist").val() ,optpg: value  },function(data){
                        alert("Payment changed to One Time Payment Per Gallon!");
                        $.get("viewAccount-admin.php",{id: <?php echo $account->acount_id; ?> },function(data){
                            $("#info-box").css("background","none");
                            $("#info-box").html(data);
                        }); 
                  });
                break;
         }
        
       
    });
    
    
    $(".field").change(function(){      
        var isname = $(this).attr('rel');
        //alert(isname);
        // var status_value = $(this).val();
        // alert (status_value);

        if (isname == 'status'){
            var status_value = $(this).val();
            if (status_value == 'Archive'){
                var manager_status = <?php echo $userManager?>;
                if(manager_status == 1){
                Shadowbox.open({
                    content: 'accountArchiveTest.php?account_id=<?php echo $account->acount_id ?>',
                    player:"iframe",
                    width:500,
                    height:600,
                    loadingImage:"shadow/loading.gif",
                    title: "Archiving Account",
                    options: {
                        overlayColor:"#ffffff",
                        overlayOpacity: ".9"
                    }
                });
                } else {
                    alert("Only Managers can archive accounts!\n Account Not Archived \n Reach out to IT if you should be able to archive accounts");
                }
            } else {
                $.post("accountpage_editables/changefield.php",{id:<?php echo $account->acount_id; ?>,field: $(this).attr('rel'), value: $(this).val() },function(data){
                    alert("Information changed! "+data);
                    if(isname = "name"){
                        var anumber = $(this).attr('xlr');
                        $("#acname").html("<a href='viewAccount.php?id="+anumber+">"+$(this).val()+"</a>");
                    }
                });
            }
        } else {
            $.post("accountpage_editables/changefield.php", {
                id:<?php echo $account->acount_id; ?>,
                field: $(this).attr('rel'),
                value: $(this).val()
            }, function (data) {
                alert("Information changed! " + data);
                if (isname = "name") {
                    var anumber = $(this).attr('xlr');
                    $("#acname").html("<a href='viewAccount.php?id=" + anumber + ">" + $(this).val() + "</a>");
                }
            });
        }
    });
    
    
     $("#dialog").hide();

    
    $('#settings').click(function(){
          $(this).next('#dialog').show();
          $(this).next('.tooltip').position({at: 'bottom center', of: $(this), my: 'top'});
    });
    
    
    
    $(".close").click(function(){
       $("#dialog").hide(); 
    });
    
    
    
    
    
   $(".ikg_form").click(function(){
        $(this).submit();
    });

    
    $('.fieldx').click(function(){
        if (this.checked) {           
           $.post("change_state.php",{id:<?php echo $account->acount_id; ?>,field:$(this).attr('rel'),state:1},function(){
             alert("turned on");
           });
        } else {
           $.post("change_state.php",{id:<?php echo $account->acount_id; ?>,field:$(this).attr('rel'),state:0},function(){
             alert("turned on"); 
           });
        }
    }); 
    
    
    $(".validate").click(function(){        
       Shadowbox.open({
            content:"verify_address.php?account=<?php echo $account->acount_id; ?>",
            player:"iframe",
            width:"800",
            height:"600" 
       });        
        
    });

   
    </script>
</body>    
    </html>
