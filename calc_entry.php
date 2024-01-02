<?php
include "protected/global.php";

if($_SESSION['username'] == "RDizon"){
    
    ini_set("display_errors",1);
}

include "source/scripts.php";

if(isset($_GET['mode'])){
    $read_only = "readonly";
}else{
    $read_only ="";
}


if(isset($_POST['sc'])){
    $calc_pack = array(
        "TransActionKey"=>$_GET['entry'],
        "weight"=>$_POST['weight'],
        "water_vol"=>$_POST['water_vol'],
        "solid_vol"=>$_POST['solid_vol'],
        "miu_vol"=>$_POST['miu_vol'],
        "oil_vol"=>$_POST['oil_vol'],
        "water_mass"=>$_POST['water_mass'],
        "solid_mass"=>$_POST['solid_mass'],
        "miu_mass"=>$_POST['miu_mass'],
        "oil_mass"=>$_POST['oil_mass'],
        "adjusted_mass"=>$_POST['adj']
    );
    
    $check_exists = $db->where("TransActionKey",$_GET['entry'])->get("iwp_vol_to_mass","TransActionKey");
    if(count($check_exists)>0){
        $db->where("TransActionKey",$_GET['entry'])->update("iwp_vol_to_mass",$calc_pack);
    }else{
        $db->insert("iwp_vol_to_mass",$calc_pack);
    }
 }

 $datax = $db->where("TransActionKey",$_GET['entry'])->get("iwp_vol_to_mass");
?>
<style>
body{
    margin:10px 10px 10px 10px;
    padding:10px 10px 10px 10px;
}




</style>
<link rel="stylesheet" href="css_excel/excel-2007.css"/>

<form action="calc_entry.php?entry=<?php echo $_GET['entry']; ?>" method="POST">
<table style="width: 90%x;margin:auto;" class="ExcelTable2007">
<thead>
<tr>
    <th class="heading" style="background: #bbbbbb;">Weight</th>
    <th style="background: #bbbbbb;">Water Vol</th>
    <th style="background: #bbbbbb;">Solid Vol</th>
    <th style="background: #bbbbbb;">MIU Vol</th>
    <th style="background: #bbbbbb;">Oil Vol</th>
   
</tr>
</thead>
<tr>
    <td class="heading"><input type='text'   id="weight" name="weight" value="<?php $u = $db->query("SELECT Net FROM iwp_test_scale WHERE TransactionKey = $_GET[entry]");  if(count($u)>0){ echo $u[0]['Net']; }else{ echo "0"; }  ?>"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="water_vol" placeholder="Water Volume" value="<?php  if(count($datax)>0){
       echo $datax[0]['water_vol'];
    }else{
        echo "0";
    } ?>" name="water_vol"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="solid_vol" placeholder="Solid Volume" value="<?php  if(count($datax)>0){
       echo $datax[0]['solid_vol'];
    }else{
        echo "0";
    } ?>" name="solid_vol"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="miu_vol" placeholder="MIU Volume" value="<?php  if(count($datax)>0){
       echo $datax[0]['miu_vol'];
    }else{
        echo "0";
    } ?>" name="miu_vol"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="oil_vol" placeholder="OIL Volume" value="<?php  if(count($datax)>0){
       echo $datax[0]['oil_vol'];
    }else{
        echo "0";
    } ?>" name="oil_vol"/></td>
    </tr>
    
   
    
    <tr>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="water_mass" placeholder="Water Mass" value="<?php  if(count($datax)>0){
       echo $datax[0]['water_mass'];
    }else{
        echo "0";
    } ?>" name="water_mass"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="solid_mass" placeholder="Solid Mass" value="<?php  if(count($datax)>0){
       echo $datax[0]['water_mass'];
    }else{
        echo "0";
    } ?>" name="solid_mass"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="miu_mass" placeholder="MIU Mass" value="<?php  if(count($datax)>0){
       echo $datax[0]['miu_mass'];
    }else{
        echo "0";
    } ?>" name="miu_mass"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="oil_mass" placeholder="OIL Mass" value="<?php  if(count($datax)>0){
       echo $datax[0]['oil_mass'];
    }else{
        echo "0";
    } ?>" name="oil_mass"/></td>
    <td class="heading"><input <?php echo " $read_only "; ?> type='text'   id="adj"  placeholder="Adjusted Weight"  value="<?php  if(count($datax)>0){
       echo $datax[0]['adjusted_mass'];
    }else{
        echo "0";
    } ?>" name="adj"/></td>
</tr>
</table>
<div id="sub_hold" style="width: 100%;height:50px;text-align:center;position:fixed;top:0px;left:0px;margin:5px 5px 5px 5px;"><input id="sc" type="submit" name="sc" value="Save Calulations"/></div>
</form>
<script>



$("#water_vol,#solid_vol").change(function(){
    var wv =  $("#water_vol").val() *1;
    var sv = $("#solid_vol").val() *1;
    var oil_level = (100 -wv - sv) * 1 ;
    $("#oil_vol").val(oil_level);
    
    var miu_vol = 100 -oil_level; 
    alert(miu_vol);
    $("#miu_vol").val(miu_vol);   
    
     
    var water_mass =(( wv *9.163))/(((wv+ sv)*9.163)+(oil_level*7.56))*100;
    $("#water_mass").val(water_mass);
    
    var solid_mass = (((sv )*9.163))/(((wv+sv)*9.163)+(oil_level*7.56))*100
    $("#solid_mass").val(solid_mass);
    
    
    var oil_mass =100-(water_mass *1)  -  (  solid_mass * 1);
    $("#oil_mass").val(oil_mass);
    
    
    var miu_mass =100-oil_mass;
    $("#miu_mass").val(miu_mass);
    var adj_weight =(  ( $("#weight").val() *1 ) *oil_mass )/100;
    $("#adj").val(adj_weight);
});



</script>