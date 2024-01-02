<?php
include "protected/global.php";
ini_set("display_errors",1);
$combined = array(
"element_2",
"element_2_1",
"element_2_2",
"element_2_3",
"element_3_1",
"element_3_2",
"element_3_3",
"element_3_4",
"element_2_datepick",
"submit_form"
);

if(isset($_POST['submit_form'])){
    $full_date = $_POST['element_2_3']."-".$_POST['element_2_1']."-".$_POST['element_2_2'];
    echo "UPDATE Inetforms.ap_form_43256 SET ap_form_43256.element_2 = '$full_date' WHERE id = $_GET[entry_id]<br/>";
    $db->query("UPDATE Inetforms.ap_form_43256 SET ap_form_43256.element_2 = '$full_date' WHERE id = $_GET[entry_id]");
    $full_time = $_POST['element_3_1'].":".$_POST['element_3_2'].":00";
    $db->query("UPDATE Inetforms.ap_form_43256 SET ap_form_43256.element_3 = '$full_time' WHERE id = $_GET[entry_id]");
    foreach($_POST as $name=>$value){
        if(strlen(trim($value))>0){
            if(!in_array($name,$combined)){        
               switch($name){
                    case "element_14":case "element_16": case "element_18": case "element_20": case "element_22": case "element_26": case "element_28": case "element_30": case "element_32": case "element_34": case "element_38": case "element_40": case "element_42": case "element_43": case "element_44": case "element_46": case "element_50": case "element_52": case "element_54": case "element_56": case "element_58": case "element_62": case "element_64": case "element_66": case "element_68": case "element_70": case "element_75": case "element_77": case "element_79": case "element_81": case "element_83": case "element_90": case "element_92": case "element_94": case "element_96": case "element_100": case "element_102": case "element_104": case "element_106": case "element_108": case "element_117": case "element_118": case "element_119": case "element_121": case "element_122": case "element_123": case "element_125": case "element_126": case "element_127": case "element_129": case "element_131": case "element_133": case "element_135": case "element_137": case "element_142": case "element_146":
                        $db->query("UPDATE Inetforms.ap_form_43256 SET ap_form_43256.$name =".trim($value)." WHERE id = $_GET[entry_id]");
                        echo "UPDATE Inetforms.ap_form_43256 SET $name =".trim($value)." WHERE id = $_GET[entry_id]<br/></br>";
                    break;
                    default:
                        $db->query("UPDATE Inetforms.ap_form_43256 SET ap_form_43256.$name ='".trim($value)."' WHERE id = $_GET[entry_id]");
                        echo "UPDATE Inetforms.ap_form_43256 SET $name ='".trim($value)."' WHERE id = $_GET[entry_id]<br/></br>";
                    break;
               }
            }
        }
    }
    
    
    
    if(isset($_GET['petfood_id'])){//are you updating from Completed/Payment ?
        $shipper="";
        switch($_POST['element_16']){
            case 7: $shipper =" Transportation"; break;
            case 26: $shipper =" Bimbo"; break;
            case 21: $shipper =" Brennta"; break;
            case 28: $shipper =" Connection Chemical"; break;
            case 23: $shipper =" Giralds"; break;
            case 17: $shipper =" IWP/AZ"; break;
            case 14: $shipper =" IWP/Mira Loma"; break;
            case 15: $shipper =" IWP/Selma"; break;
            case 27: $shipper =" Kinder Morgan"; break;
            case 11: $shipper =" LVO"; break;
            case 22: $shipper =" Nexeo"; break;
            case 8: $shipper =" North Star Recycling"; break;
            case 10: $shipper =" Sara Lee"; break;
            case 20: $shipper =" Schaffner"; break;
            case 18: $shipper =" Sparkletts"; break;
            case 16: $shipper =" TARR"; break;
            case 25: $shipper =" VDFC Victorville"; break;
            case 24: $shipper =" Ventura Foods Co"; break;
            case 19: $shipper =" Verhoeven"; break;
            case 12: $shipper =" Victorville DC<"; break;
            case 9: $shipper =" Other"; break;
        }
        $petfood_update = array(//update corresponding petfood table
            "element_77"=>$_POST['element_19'],
            "element_11"=>$shipper,
            "element_82"=>$_POST['element_24'],
            "element_84"=>$_POST['element_25'],
            "element_144"=>$_POST['element_18'],
            "element_84"=>$_POST['element_25'],
            "element_83"=>$_POST['element_116']
        );
        
        $db->where("id",$_GET['entry_id'])->update("Inetforms.ap_form_49773",$petfood_update);
    }else{//does this entryform pending have a completed dogfood entry already?
        
    }
    
   
    
    
    switch($_POST['element_114']){//requestor
        case "1":
            $requestor = "Johnny";
            break;
        case "2":
            $requestor = "Mario";
            break;
        case "3":
            $requestor = "Other";
            break;
    }
    
  
    
    switch($_POST['element_1']){
        case "1"://inbound
            $area = $_POST['element_16'];//element_11
            $type =$_POST['element_14'];//element_12
            $tank ="";//element_13
            $snumber ="";
            $wtn=$_POST['element_19'];
            $inbwtn=$_POST['element_116'];
            $release=$_POST['element_24'];
            $note = $_POST['element_25'];
            
        break;
        case 9:
            $area = $_POST['element_131'];
            $number ="";
            
            
            $type =$_POST['element_129'];
            $tank = "";
            $snumber=$_POST['element_142'];
            $wtn=$_POST['element_134'];
            $inbwtn="";
            $release=$_POST['element_147'];
            $note= $_POST['element_141'];
            $link = "PendingDogFood.php";
        break;
    }
    
    
     $check = $db->query("SELECT id FROM Inetforms.ap_form_49773 WHERE ap_form_49773.element_76 = $_GET[entry_id]");//Update destruction form if it exists
    
    if(count($check)>0){
        $destruction_update = array(
            "element_77"=>$wtn,//weight ticket
            "element_82"=>$release,//release
            "element_189"=>$_POST['element_133'],//net weight
            "element_88"=>$_POST['element_150'],//seal
            "element_136"=>$type//Commodity
        );
        $db->where("ap_form_49773.element_76","$_GET[entry_id]")->update("Inetforms.ap_form_49773",$destruction_update);
    }
    
    
  
    $package = array(//update corresponding ER table entry
        "element_3"=>$_POST['element_4'],
        "element_13"=>$tank,
        "element_11"=>$area,
        "element_12"=>$type,
        "element_14"=>$snumber,
        "element_82"=>$release,
        "element_83"=>$inbwtn,
        "element_84"=>$note,
        "element_77"=>$wtn,
        "source"=>"from_tcl",
        "element_81"=>4,
        "tsl_type"=>$_POST['element_1']
        
    );
    $db->where("id",$_GET['entry_id'])->update("Inetforms.ap_form_44342",$package);
}

$test = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE ap_form_43256.id =$_GET[entry_id]");

$element_2 = explode("-",$test[0]['element_2']);
$element_3= explode(":",$test[0]['element_3']);

if($element_3[0]>12){
    $pm = 1;
}else{
    $pm = 0;
}
echo "</pre>";
?>
<link rel="stylesheet" type="text/css" href="https://inet.iwpusa.com/machforms/machform/./data/form_43256/css/view.css" media="all" />
<link rel="stylesheet" type="text/css" href="https://inet.iwpusa.com/machforms/machform/view.mobile.css" media="all" />
<link rel="stylesheet" type="text/css" href="https://inet.iwpusa.com/machforms/machform/./data/themes/theme_41.css" media="all" />
<link type="text/css" href="https://inet.iwpusa.com/machforms/machform/js/datepick/smoothness.datepick.css" rel="stylesheet" />
<body id="main_body" class=" no_guidelines">
	
	<div id="form_container" class="">
	
		<h1><a>Truck Scale Log</a></h1>
		<form id="form_43256" class="appnitro top_label" enctype="multipart/form-data" method="post" action="inbound_edit.php?entry_id=<?php echo $_GET['entry_id']; if(isset($_GET['petfood_id'])){ echo "&petfood_id=$_GET[petfood_id]";  }  ?>">
        <input type="hidden" name="element_1" id="element_1" value="<?php echo $test[0]['element_1']; ?>"/>
					<div class="form_description">
			<h2>Truck Scale Log</h2>
			<p>Please Use Sub Category for Grouping</p>
		</div>						
			<ul >
			
			
			
					<li id="li_2"  class="date_field column_3">
		<span class="description">Date </span>
		<span class="date_mm">
			<input id="element_2_1" name="element_2_1"  class="element text" size="2" maxlength="2"  type="text" value="<?php echo $element_2[1] ?>" /> /
			<label for="element_2_1">MM</label>
		</span>
		<span class="date_dd">
			<input id="element_2_2" name="element_2_2"  class="element text" size="2" maxlength="2" type="text" value="<?php echo $element_2[2] ?>" /> /
			<label for="element_2_2">DD</label>
		</span>
		<span class="date_yyyy">
	 		<input id="element_2_3" name="element_2_3"  class="element text" size="4" maxlength="4" type="text" value="<?php echo $element_2[0] ?>" />
			<label for="element_2_3">YYYY</label>
		</span>
	
		<span id="calendar_2">
		    <input type="hidden" value="" name="element_2_datepick" id="element_2_datepick">
			<div style="display: none"><img id="cal_img_2" class="datepicker" src="https://inet.iwpusa.com/machforms/machform/images/calendar.gif" alt="Pick a date." /></div>	
		</span>
		<script type="text/javascript">
			
			$('#element_2_datepick').datepick({ 
	    		onSelect: select_date,
	    		showTrigger: '#cal_img_2'
	    		
	    		
	    		
	    		
			});
			$('#element_2_datepick').datepick('setDate', $.datepick.newDate(2017, 8, 29));
</script>
		 
		</li>		<li id="li_3"  class="time_field column_3">
		<span class="description">Time </span>
		<span>
			<input id="element_3_1" name="element_3_1"  class="element text " size="2" type="text" maxlength="2" value="<?php echo $element_3[0]; ?>" /> : 
			<label for="element_3_1">HH</label>
		</span>
		<span>
			<input id="element_3_2" name="element_3_2"  class="element text " size="2" type="text" maxlength="2"  value="<?php echo $element_3[1]; ?>"/>  
			<label for="element_3_2">MM</label>
		</span>
		
				<span>
			<select class="element select" style="width:5em"  id="element_3_4" name="element_3_4">
				<option value="AM"  <?php if($pm ==0){ echo " selected='selected'";} ?>   >AM</option>
				<option value="PM"  <?php if($pm ==1){ echo " selected='selected'";} ?>   >PM</option>
			</select>
			<label for="element_3_4">AM/PM</label>
			
		</span> 
		</li>		<li id="li_4"  class="column_3">
		<label class="description" for="element_4">Test Status </label>
		<div>
			<input id="element_4" name="element_4"    class="element text medium" type="text" value="<?php echo $test[0]['element_4']; ?>"   />
			 
		</div> 
		</li>		<li id="li_114"   class="dropdown column_2 new_row">
		<label class="description" for="element_114">Created By </label>
		<div>
		<select class="element select medium" id="element_114" name="element_114"> 
			<option value="" selected="selected"></option>
<option value="1" <?php if($test[0]['element_114']==1){ echo " selected ='selected'"; }  ?> >Johnny</option>
<option value="2" <?php if($test[0]['element_114']==2){ echo " selected ='selected'"; }  ?> >Mario</option>
<option value="4" <?php if($test[0]['element_114']==4){ echo " selected ='selected'"; }  ?> >Donovan</option>
<option value="3" <?php if($test[0]['element_114']==3){ echo " selected ='selected'"; }  ?> >Other</option>

		</select>
		</div> 
		</li>		<li id="li_5"  class="simple_name column_2">
		<span class="description">Created By </span>
		<span class="simple_name_1">
			<input id="element_5_1" name="element_5_1"  type="text" class="element text" maxlength="255" size="8" value="" />
			<label for="element_5_1">First</label>
		</span>
		<span class="simple_name_2">
			<input id="element_5_2" name="element_5_2"  type="text" class="element text" maxlength="255" size="14" value="" />
			<label for="element_5_2">Last</label>
		</span> 
		</li>	<li id="li_150"  class="column_3">
		<label class="description" for="element_150">Seal Number </label>
		<div>
			<input id="element_150" name="element_150"    class="element text medium" type="text" value="<?php echo $test[0]['element_150']; ?>"   />
			 
		</div> 
		</li>	
        <li></li>
        	<li id="li_115"  class="section_break">
			<h3></h3>
			<p></p>
		</li>			
        
        <?php
        
        switch($test[0]['element_1']){
            case 1:
            ?>
                <li id="li_6"  class="section_break">
            			<h3>Inbound</h3>
            			<p></p>
            		</li>		<li id="li_14"   class="dropdown column_6 new_row">
            		<label class="description" for="element_14">Commodity </label>
            		<div>
            		<select class="element select medium" id="element_14" name="element_14"> 
            			<option value="" selected="selected"></option>
            <option value="6"  <?php if($test[0]['element_14']==1){ echo " selected ='selected'"; }  ?> >Almond Ground Shell</option>
            <option value="13" <?php if($test[0]['element_14']==13){ echo " selected ='selected'"; }  ?> >Almond Meal</option>
            <option value="18"   <?php if($test[0]['element_14']==18){ echo " selected ='selected'"; }  ?>  >Bakery</option>
            <option value="25"   <?php if($test[0]['element_14']==25){ echo " selected ='selected'"; }  ?>  >Candy</option>
            <option value="10"   <?php if($test[0]['element_14']==10){ echo " selected ='selected'"; }  ?>  >Chocolate</option>
            <option value="24"   <?php if($test[0]['element_14']==24){ echo " selected ='selected'"; }  ?>  >Clear Diesel</option>
            <option value="7"   <?php if($test[0]['element_14']==7){ echo " selected ='selected'"; }  ?>  >Dehy Bakery</option>
            <option value="21"   <?php if($test[0]['element_14']==21){ echo " selected ='selected'"; }  ?>  >Dressing</option>
            <option value="11"   <?php if($test[0]['element_14']==11){ echo " selected ='selected'"; }  ?>  >Food Waste</option>
            <option value="17"   <?php if($test[0]['element_14']==17){ echo " selected ='selected'"; }  ?>  >Fat Lint</option>
            <option value="12"   <?php if($test[0]['element_14']==12){ echo " selected ='selected'"; }  ?>  >Lint</option>
            <option value="8"    <?php if($test[0]['element_14']==8){ echo " selected ='selected'"; }  ?> >North Star Mayo</option>
            <option value="14"   <?php if($test[0]['element_14']==14){ echo " selected ='selected'"; }  ?>  >Methanol</option>
            <option value="23"   <?php if($test[0]['element_14']==23){ echo " selected ='selected'"; }  ?>  >peanut Butter</option>
            <option value="20"   <?php if($test[0]['element_14']==20){ echo " selected ='selected'"; }  ?>  >Sodium Hydroxide</option>
            <option value="22"   <?php if($test[0]['element_14']==22){ echo " selected ='selected'"; }  ?>  >Sulferic Acid</option>
            <option value="15"  <?php if($test[0]['element_14']==15){ echo " selected ='selected'"; }  ?>   >Water</option>
            <option value="16"   <?php if($test[0]['element_14']==16){ echo " selected ='selected'"; }  ?>  >WCS</option>
            <option value="9"   <?php if($test[0]['element_14']==9){ echo " selected ='selected'"; }  ?>  >Other</option>
            
            		</select>
            		</div> 
            		</li>		<li id="li_15"  class="column_6">
            		<label class="description" for="element_15">Commodity Other </label>
            		<div>
            			<input id="element_15" name="element_15" value="<?php echo $test[0]['element_15']; ?>"   class="element text medium" type="text" value=""   />
            			 
            		</div> 
            		</li>		<li id="li_16"   class="dropdown column_6">
            		<label class="description" for="element_16">Shipper </label>
            		<div>
            		<select class="element select medium" id="element_16" name="element_16"> 
            			<option value="" selected="selected"></option>
            <option value="7" <?php if($test[0]['element_16']==7){ echo " selected ='selected'"; }  ?>  >Agape Transportation</option>
            <option value="26" <?php if($test[0]['element_16']==26){ echo " selected ='selected'"; }  ?>    >Bimbo</option>
            <option value="21" <?php if($test[0]['element_16']==21){ echo " selected ='selected'"; }  ?>   >Brenntag</option>
            <option value="28" <?php if($test[0]['element_16']==28){ echo " selected ='selected'"; }  ?>   >Connection Chemical</option>
            <option value="23" <?php if($test[0]['element_16']==23){ echo " selected ='selected'"; }  ?>   >Giralds</option>
            <option value="17" <?php if($test[0]['element_16']==17){ echo " selected ='selected'"; }  ?>   >IWP/AZ</option>
            <option value="14" <?php if($test[0]['element_16']==14){ echo " selected ='selected'"; }  ?>   >IWP/Mira Loma</option>
            <option value="15" <?php if($test[0]['element_16']==15){ echo " selected ='selected'"; }  ?>   >IWP/Selma</option>
            <option value="27" <?php if($test[0]['element_16']==27){ echo " selected ='selected'"; }  ?>   >Kinder Morgan</option>
            <option value="11" <?php if($test[0]['element_16']==11){ echo " selected ='selected'"; }  ?>   >LVO</option>
            <option value="22" <?php if($test[0]['element_16']==22){ echo " selected ='selected'"; }  ?>   >Nexeo</option>
            <option value="8"  <?php if($test[0]['element_16']==8){ echo " selected ='selected'"; }  ?>  >North Star Recycling</option>
            <option value="10" <?php if($test[0]['element_16']==10){ echo " selected ='selected'"; }  ?>   >Sara Lee</option>
            <option value="20" <?php if($test[0]['element_16']==20){ echo " selected ='selected'"; }  ?>   >Schaffner</option>
            <option value="18" <?php if($test[0]['element_16']==18){ echo " selected ='selected'"; }  ?>   >Sparkletts</option>
            <option value="16" <?php if($test[0]['element_16']==16){ echo " selected ='selected'"; }  ?>   >TARR</option>
            <option value="25" <?php if($test[0]['element_16']==25){ echo " selected ='selected'"; }  ?>   >VDFC Victorville</option>
            <option value="24" <?php if($test[0]['element_16']==24){ echo " selected ='selected'"; }  ?>   >Ventura Foods Co</option>
            <option value="19" <?php if($test[0]['element_16']==19){ echo " selected ='selected'"; }  ?>   >Verhoeven</option>
            <option value="12" <?php if($test[0]['element_16']==12){ echo " selected ='selected'"; }  ?>   >Victorville DC</option>
            <option value="9"  <?php if($test[0]['element_16']==9){ echo " selected ='selected'"; }  ?>   >Other</option>
            
            		</select>
            		</div> 
            		</li>		<li id="li_17"  class="column_6">
            		<label class="description" for="element_17">Shipper Other </label>
            		<div>
            			<input id="element_17" name="element_17"    class="element text medium" type="text" value="<?php echo $test[0]['element_17']; ?> "   />
            			 
            		</div> 
            		</li>		<li id="li_18"  class="column_6">
            		<label class="description" for="element_18">Net Weight </label>
            		<div>
            			<input id="element_18" name="element_18" class="element text medium"   type="text"   value="<?php echo $test[0]['element_18']; ?> "  /> 
            			
            		</div> 
            		</li>		<li id="li_19"  class="column_6">
            		<label class="description" for="element_19">Weight Ticket # </label>
            		<div>
            			<input id="element_19" name="element_19"    class="element text medium" type="text" value="<?php echo $test[0]['element_19']; ?> "   />
            			 
            		</div> 
            		</li>		<li id="li_20"   class="dropdown column_6 new_row">
            		<label class="description" for="element_20">Carrier </label>
            		<div>
            		<select class="element select medium" id="element_20" name="element_20"> 
            			<option value="" selected="selected"></option>
            <option value="4" <?php if($test[0]['element_20']==4){ echo " selected ='selected'"; }  ?> >Agape Transportation</option>
            <option value="27" <?php if($test[0]['element_20']==27){ echo " selected ='selected'"; }  ?>   >Angus Transportation</option>
            <option value="22" <?php if($test[0]['element_20']==22){ echo " selected ='selected'"; }  ?>   >Brenntag</option>
            <option value="13" <?php if($test[0]['element_20']==13){ echo " selected ='selected'"; }  ?>   >C Rocha</option>
            <option value="15" <?php if($test[0]['element_20']==15){ echo " selected ='selected'"; }  ?>   >Cruz</option>
            <option value="12" <?php if($test[0]['element_20']==12){ echo " selected ='selected'"; }  ?>   >Desert Soul</option>
            <option value="19" <?php if($test[0]['element_20']==19){ echo " selected ='selected'"; }  ?>   >DTI</option>
            <option value="5" <?php if($test[0]['element_20']==5){ echo " selected ='selected'"; }  ?>   >GMT</option>
            <option value="11" <?php if($test[0]['element_20']==11){ echo " selected ='selected'"; }  ?>   >Hernandez</option>
            <option value="10" <?php if($test[0]['element_20']==10){ echo " selected ='selected'"; }  ?>   >IWP</option>
            <option value="21" <?php if($test[0]['element_20']==21){ echo " selected ='selected'"; }  ?>   >JL Trucking</option>
            <option value="16" <?php if($test[0]['element_20']==16){ echo " selected ='selected'"; }  ?>   >Mallet</option>
            <option value="17" <?php if($test[0]['element_20']==17){ echo " selected ='selected'"; }  ?>   >Narvaez</option>
            <option value="18" <?php if($test[0]['element_20']==18){ echo " selected ='selected'"; }  ?>   >Nexeo</option>
            <option value="8" <?php if($test[0]['element_20']==8){ echo " selected ='selected'"; }  ?>   >Orbit</option>
            <option value="26" <?php if($test[0]['element_20']==26){ echo " selected ='selected'"; }  ?>   >Pride Intermodal</option>
            <option value="24" <?php if($test[0]['element_20']==24){ echo " selected ='selected'"; }  ?>   >Road Runner</option>
            <option value="25" <?php if($test[0]['element_20']==25){ echo " selected ='selected'"; }  ?>   >Ryan</option>
            <option value="14" <?php if($test[0]['element_20']==14){ echo " selected ='selected'"; }  ?>   >Sparkletts</option>
            <option value="23" <?php if($test[0]['element_20']==23){ echo " selected ='selected'"; }  ?>   >System Transport</option>
            <option value="20" <?php if($test[0]['element_20']==20){ echo " selected ='selected'"; }  ?>   >Universal Trucking</option>
            <option value="9" <?php if($test[0]['element_20']==9){ echo " selected ='selected'"; }  ?>   >Other</option>
            
            		</select>
            		</div> 
            		</li>		<li id="li_21"  class="column_6">
            		<label class="description" for="element_21">Carrier Other </label>
            		<div>
            			<input id="element_21" name="element_21"    class="element text medium" type="text" value="<?php echo $test[0]['element_21']; ?> "   />
            			 
            		</div> 
            		</li>		<li id="li_22"   class="dropdown column_6">
            		<label class="description" for="element_22">Driver </label>
            		<div>
            		<select class="element select medium" id="element_22" name="element_22"> 
            			<option value="" selected="selected"></option>
            <option value="4" <?php if($test[0]['element_22']==4){ echo " selected ='selected'"; }  ?>    >Aaron</option>
            <option value="13" <?php if($test[0]['element_22']==13){ echo " selected ='selected'"; }  ?>    >Alejandro</option>
            <option value="15" <?php if($test[0]['element_22']==15){ echo " selected ='selected'"; }  ?>    >Casey</option>
            <option value="12" <?php if($test[0]['element_22']==12){ echo " selected ='selected'"; }  ?>    >Chris</option>
            <option value="25" <?php if($test[0]['element_22']==25){ echo " selected ='selected'"; }  ?>    >Darryl</option>
            <option value="28" <?php if($test[0]['element_22']==28){ echo " selected ='selected'"; }  ?>    >David</option>
            <option value="10" <?php if($test[0]['element_22']==10){ echo " selected ='selected'"; }  ?>    >Enrique</option>
            <option value="30" <?php if($test[0]['element_22']==30){ echo " selected ='selected'"; }  ?>    >Fernando</option>
            <option value="22" <?php if($test[0]['element_22']==22){ echo " selected ='selected'"; }  ?>    >Gerald</option>
            <option value="31" <?php if($test[0]['element_22']==31){ echo " selected ='selected'"; }  ?>    >Giovanny</option>
            <option value="32" <?php if($test[0]['element_22']==32){ echo " selected ='selected'"; }  ?>    >Hans</option>
            <option value="21" <?php if($test[0]['element_22']==21){ echo " selected ='selected'"; }  ?>    >Harry</option>
            <option value="5"  <?php if($test[0]['element_22']==5){ echo " selected ='selected'"; }  ?>    >Jaime</option>
            <option value="26" <?php if($test[0]['element_22']==26){ echo " selected ='selected'"; }  ?>    >Jason</option>
            <option value="33" <?php if($test[0]['element_22']==33){ echo " selected ='selected'"; }  ?>    >Jeremy</option>
            <option value="17" <?php if($test[0]['element_22']==17){ echo " selected ='selected'"; }  ?>    >Jesus</option>
            <option value="6" <?php if($test[0]['element_22']==6){ echo " selected ='selected'"; }  ?>    >Jose</option>
            <option value="16" <?php if($test[0]['element_22']==16){ echo " selected ='selected'"; }  ?>    >Juan Jr</option>
            <option value="27" <?php if($test[0]['element_22']==27){ echo " selected ='selected'"; }  ?>    >Ismael</option>
            <option value="18" <?php if($test[0]['element_22']==18){ echo " selected ='selected'"; }  ?>    >Lazaro</option>
            <option value="20" <?php if($test[0]['element_22']==20){ echo " selected ='selected'"; }  ?>    >Martin C</option>
            <option value="7" <?php if($test[0]['element_22']==7){ echo " selected ='selected'"; }  ?>    >Martin E</option>
            <option value="11" <?php if($test[0]['element_22']==11){ echo " selected ='selected'"; }  ?>    >Milton</option>
            <option value="8" <?php if($test[0]['element_22']==8){ echo " selected ='selected'"; }  ?>    >Pedro</option>
            <option value="19" <?php if($test[0]['element_22']==19){ echo " selected ='selected'"; }  ?>    >Pepe</option>
            <option value="29" <?php if($test[0]['element_22']==29){ echo " selected ='selected'"; }  ?>    >Reynaldo</option>
            <option value="23" <?php if($test[0]['element_22']==23){ echo " selected ='selected'"; }  ?>    >Rogine</option>
            <option value="24" <?php if($test[0]['element_22']==24){ echo " selected ='selected'"; }  ?>    >Salvador</option>
            <option value="14"<?php if($test[0]['element_22']==14){ echo " selected ='selected'"; }  ?>     >Shawn</option>
            <option value="9" <?php if($test[0]['element_22']==9){ echo " selected ='selected'"; }  ?>    >Other</option>
            
            		</select>
            		</div> 
            		</li>		<li id="li_23"  class="column_6">
            		<label class="description" for="element_23">Driver Other </label>
            		<div>
            			<input id="element_23" name="element_23"    class="element text medium" type="text" value="<?php echo $test[0]['element_23']; ?> "   />
            			 
            		</div> 
            		</li>		<li id="li_24"  class="column_6">
            		<label class="description" for="element_24">Release Number </label>
            		<div>
            			<input id="element_24" name="element_24"    class="element text medium" type="text" value="<?php echo $test[0]['element_24']; ?> "   />
            			 
            		</div> 
            		</li>		<li id="li_25"  class="column_6">
            		<label class="description" for="element_25">Note </label>
            		<div>
            			<input id="element_25" name="element_25"    class="element text medium" type="text" value="<?php echo $test[0]['element_25']; ?> "   />
            			 
            		</div> 
            		</li>		<li id="li_116"  class="column_4 new_row">
            		<label class="description" for="element_116">Incoming Weight Cert </label>
            		<div>
            			<input id="element_116" name="element_116"    class="element text medium" type="text" value="<?php echo $test[0]['element_116']; ?> "   />
            			 
            		</div> 
            		</li>		<li id="li_117"  class="column_4">
            		<label class="description" for="element_117">Incoming Gross </label>
            		<div>
            			<input id="element_117" name="element_117" class="element text medium"   type="text"   value="<?php echo $test[0]['element_117']; ?> "  /> 
            			
            		</div> 
            		</li>		<li id="li_118"  class="column_4">
            		<label class="description" for="element_118">Incoming Tare </label>
            		<div>
            			<input id="element_118" name="element_118" class="element text medium"   type="text"   value="<?php echo $test[0]['element_119']; ?> "  /> 
            			
            		</div> 
            		</li>		<li id="li_119"  class="column_4">
            		<label class="description" for="element_119">Incoming Net </label>
            		<div>
            			<input id="element_119" name="element_119" class="element text medium"   type="text"   value="<?php echo $test[0]['element_119']; ?> "  /> 
            			
            		</div> 
            		</li>
            <?php
            break;
            case 4:
                ?>
                <h3>Outbound</h3>
			<p></p>
		</li>		<li id="li_62" class="dropdown column_6 new_row" style="display: block;">
		<label class="description" for="element_62">Commodity </label>
		<div>
		<select class="element select medium" id="element_62" name="element_62"> 
			<option value="" selected="selected"></option>
<option value="1">Ammoniated Ground Pima</option>
<option value="2">Bakery</option>
<option value="4">Fat Lint</option>
<option value="5">Ground Pima</option>
<option value="7">TR/CS</option>
<option value="8">WCS</option>
<option value="3">Other</option>

		</select>
		</div> 
		</li>		<li id="li_63" class="column_6" style="display: none;">
		<label class="description" for="element_63">Commodity Other </label>
		<div>
			<input id="element_63" name="element_63" class="element text medium" value="" type="text">
			 
		</div> 
		</li>		<li id="li_64" class="dropdown column_6" style="display: block;">
		<label class="description" for="element_64">Ship to: </label>
		<div>
		<select class="element select medium" id="element_64" name="element_64"> 
			<option value="" selected="selected"></option>
<option value="1">B+E</option>
<option value="10">Chino Valley</option>
<option value="13">Dutch</option>
<option value="8">Frank Konyn</option>
<option value="7">Hinkley</option>
<option value="5">IWP (ML)</option>
<option value="9">IWP (Selma)</option>
<option value="12">Marie Minaberry</option>
<option value="14">Perez Beltran</option>
<option value="4">Schaffner</option>
<option value="11">Verhoeven</option>
<option value="6">West Star North</option>
<option value="2">Other</option>

		</select>
		</div> 
		</li>		<li id="li_65" class="column_6" style="display: none;">
		<label class="description" for="element_65">Ship to: Other </label>
		<div>
			<input id="element_65" name="element_65" class="element text medium" value="" type="text">
			 
		</div> 
		</li>		<li id="li_66" class="column_6" style="display: block;">
		<label class="description" for="element_66">Net Weight </label>
		<div>
			<input id="element_66" name="element_66" class="element text medium" value="" type="text"> 
			
		</div> 
		</li>		<li id="li_67" class="column_6" style="display: block;">
		<label class="description" for="element_67">Weight Ticket # </label>
		<div>
			<input id="element_67" name="element_67" class="element text medium" value="" type="text">
			 
		</div> 
		</li>		<li id="li_68" class="dropdown column_6 new_row" style="display: block;">
		<label class="description" for="element_68">Carrier </label>
		<div>
		<select class="element select medium" id="element_68" name="element_68"> 
			<option value="" selected="selected"></option>
<option value="1">Bob</option>
<option value="12">C Rocha</option>
<option value="9">Cruz</option>
<option value="6">Desert Soul</option>
<option value="4">Darrell Green</option>
<option value="11">Game Trucking</option>
<option value="7">IWP</option>
<option value="10">Mallet</option>
<option value="5">Murillo Transport</option>
<option value="13">Perez Beltran</option>
<option value="8">Narvaez</option>
<option value="2">Other</option>

		</select>
		</div> 
		</li>		<li id="li_69" class="column_6" style="display: none;">
		<label class="description" for="element_69">Carrier Other </label>
		<div>
			<input id="element_69" name="element_69" class="element text medium" value="" type="text">
			 
		</div> 
		</li>		<li id="li_70" class="dropdown column_6" style="display: block;">
		<label class="description" for="element_70">Driver </label>
		<div>
		<select class="element select medium" id="element_70" name="element_70"> 
			<option value="" selected="selected"></option>
<option value="1">Caesar</option>
<option value="9">Chris</option>
<option value="6">Jaime</option>
<option value="4">Jesus</option>
<option value="7">Jose</option>
<option value="10">Juan Jr</option>
<option value="11">Julian</option>
<option value="5">Lazaro</option>
<option value="8">Manuel</option>
<option value="2">Other</option>

		</select>
		</div> 
		</li>		<li id="li_71" class="column_6" style="display: none;">
		<label class="description" for="element_71">Driver Other </label>
		<div>
			<input id="element_71" name="element_71" class="element text medium" value="" type="text">
			 
		</div> 
		</li>		<li id="li_72" class="column_6" style="display: block;">
		<label class="description" for="element_72">Sale Number </label>
		<div>
			<input id="element_72" name="element_72" class="element text medium" value="" type="text">
			 
		</div> 
		</li>		<li id="li_73" class="column_6" style="display: block;">
		<label class="description" for="element_73">Lot # </label>
		<div>
			<input id="element_73" name="element_73" class="element text medium" value="" type="text">
			 
		</div> 
		</li>		<li id="li_74" style="display: block;">
		<label class="description" for="element_74">Note </label>
		<div>
			<input id="element_74" name="element_74" class="element text medium" value="" type="text">
			 
		</div> 
		</li>	
                <?php
            break;
            case 9:
            ?>
                <li id="li_128"  class="section_break">
        			<h3>Pet Food</h3>
        			<p></p>
        		</li>		<li id="li_129"   class="dropdown column_6 new_row">
        		<label class="description" for="element_129">Commodity </label>
        		<div>
        		<select class="element select medium" id="element_129" name="element_129"> 
        			<option value="" selected="selected"></option>
        <option value="1" <?php if($test[0]['element_129'] ==1){ echo "selected ='selected'";} ?>   >ByProduct Ext Boxed</option>
        <option value="4" <?php if($test[0]['element_129'] ==4){ echo "selected ='selected'";} ?>     >Corrugated</option>
        <option value="5" <?php if($test[0]['element_129'] ==5){ echo "selected ='selected'";} ?>     >PP Bags</option>
        <option value="6" <?php if($test[0]['element_129'] ==6){ echo "selected ='selected'";} ?>     >Compost</option>
        <option value="7" <?php if($test[0]['element_129'] ==7){ echo "selected ='selected'";} ?>     >Waste to Energy</option>
        <option value="3" <?php if($test[0]['element_129'] ==3){ echo "selected ='selected'";} ?>     >Other</option>
        
        		</select>
        		</div> 
        		</li>		<li id="li_130"  class="column_6">
        		<label class="description" for="element_130">Commodity Other </label>
        		<div>
        			<input id="element_130" name="element_130"    class="element text medium" type="text" value="<?php echo $test[0]['element_130']; ?> "   />
        			 
        		</div> 
        		</li>		<li id="li_131"   class="dropdown column_6">
        		<label class="description" for="element_131">Ship From: </label>
        		<div>
        		<select class="element select medium" id="element_131" name="element_131"> 
        			<option value="" selected="selected"></option>
        <option value="1" <?php if($test[0]['element_131'] ==1){ echo "selected ='selected'";} ?>     >Sparks, NV</option>
        <option value="2"  <?php if($test[0]['element_131'] ==2){ echo "selected ='selected'";} ?>    >Other</option>
        
        		</select>
        		</div> 
        		</li>		<li id="li_132"  class="column_6">
        		<label class="description" for="element_132">Ship From: Other </label>
        		<div>
        			<input id="element_132" name="element_132"    class="element text medium" type="text" value="<?php echo $test[0]['element_132']; ?> "   />
        			 
        		</div> 
        		</li>		<li id="li_133"  class="column_6">
        		<label class="description" for="element_133">Net Weight </label>
        		<div>
        			<input id="element_133" name="element_133" class="element text medium"   type="text"   value="<?php echo $test[0]['element_133']; ?> "  /> 
        			
        		</div> 
        		</li>		<li id="li_134"  class="column_6">
        		<label class="description" for="element_134">Weight Ticket # </label>
        		<div>
        			<input id="element_134" name="element_134"    class="element text medium" type="text" value="<?php echo $test[0]['element_134']; ?> "   />
        			 
        		</div> 
        		</li>		<li id="li_135"   class="dropdown column_6 new_row">
        		<label class="description" for="element_135">Carrier </label>
        		<div>
        		<select class="element select medium" id="element_135" name="element_135"> 
        			<option value="" selected="selected"></option>
                    <option value="1" <?php if($test[0]['element_135'] ==1){ echo "selected ='selected'";} ?>     >Desert Soul</option>
                    <option value="7" <?php if($test[0]['element_135'] ==7){ echo "selected ='selected'";} ?>     >IWP</option>
                    <option value="6" <?php if($test[0]['element_135'] ==6){ echo "selected ='selected'";} ?>     >JL Trucking</option>
                    <option value="2" <?php if($test[0]['element_135'] ==2){ echo "selected ='selected'";} ?>     >Other</option>
        
        		</select>
        		</div> 
        		</li>		<li id="li_107"  class="column_6">
        		<label class="description" for="element_107">Carrier Other </label>
        		<div>
        			<input id="element_107" name="element_107"    class="element text medium" type="text" value="<?php echo $test[0]['element_107']; ?> "   />
        			 
        		</div> 
        		</li>		<li id="li_137"   class="dropdown column_6">
        		<label class="description" for="element_137">Driver </label>
        		<div>
        		<select class="element select medium" id="element_137" name="element_137"> 
        			<option value="" selected="selected"></option>
        <option value="1" <?php if($test[0]['element_137'] ==1){ echo "selected ='selected'";} ?>       >Caesar</option>
        <option value="4" <?php if($test[0]['element_137'] ==4){ echo "selected ='selected'";} ?>       >Jesus</option>
        <option value="2" <?php if($test[0]['element_137'] ==2){ echo "selected ='selected'";} ?>       >Other</option>
        
        		</select>
        		</div> 
        		</li>		<li id="li_138"  class="column_6">
        		<label class="description" for="element_138">Driver Other </label>
        		<div>
        			<input id="element_138" name="element_138"    class="element text medium" type="text" value="<?php echo $test[0]['element_138']; ?> "   />
        			 
        		</div> 
        		</li>		<li id="li_142"   class="dropdown column_6">
        		<label class="description" for="element_142">Pickup </label>
        		<div>
        		<select class="element select medium" id="element_142" name="element_142"> 
        			<option value="" selected="selected"></option>
        <option value="1" <?php if($test[0]['element_142'] ==1){ echo "selected ='selected'";} ?>       >30 Yd Comp W2E</option>
        <option value="4" <?php if($test[0]['element_142'] ==4){ echo "selected ='selected'";} ?>       >30 Yd Open Top W2E</option>
        <option value="5" <?php if($test[0]['element_142'] ==5){ echo "selected ='selected'";} ?>       >Corn Cleanout</option>
        <option value="2" <?php if($test[0]['element_142'] ==2){ echo "selected ='selected'";} ?>       >Recycling Bale Trailor</option>
        <option value="3" <?php if($test[0]['element_142'] ==3){ echo "selected ='selected'";} ?>       >Third option</option>
        
        		</select>
        		</div> 
        		</li>		<li id="li_140"  class="column_6">
        		<label class="description" for="element_140">Trailor # </label>
        		<div>
        			<input id="element_140"   name="element_140"    class="element text medium" type="text" value="<?php echo $test[0]['element_140']; ?> "   />
        			 
        		</div> 
        		</li>		<li id="li_141"  >
        		<label class="description" for="element_141">Note </label>
        		<div>
        			<input id="element_141" name="element_141"    class="element text medium" type="text" value="<?php echo $test[0]['element_141']; ?> "   />
        			 
        		</div> 
        		</li>
                <li id="li_147"  style="display: block;">
                <label class="description" for="element_147">Release Number </label>
                <div>
                <input id="element_147" class="element text medium" name="element_147" value="<?php echo $test[0]['element_147']; ?>" type="text" />
                </div>
                </li>
            <?php
            break;
        }
        ?>
        						
			
			
					<li id="li_buttons" class="buttons">
			    
				<input id="submit_form" class="button_text" type="submit" name="submit_form" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			
		</div>
	</div>
	
	</body>
</html>