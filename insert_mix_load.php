<?php

include "protected/global.php";
ini_set("display_errors",1);


if(strlen(trim($_POST['cost']))>0 && isset($_POST['cost'])){
    $cost = $_POST['cost'];
}else{
    $cost = 0;
}

if(strlen(trim($_POST['allocation']))>0 && isset($_POST['allocation'])){
    $allo = $_POST['allocation'];
}else{
    $allo = 0;
}

if(strlen(trim($_POST['ppt']))>0 && isset($_POST['ppt'])){
    $ppt = $_POST['ppt'];
}else{
    $ppt = 0;
}

if(strlen(trim($_POST['product_num']))>0 && isset($_POST['product_num'])){
    switch($_POST['product_num']){//update different fields based on product number
        case 1://
            //element_336 - product ext cost
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_336 = $cost,ap_form_49773.element_656 = $ppt, ap_form_49773.element_333=$allo WHERE ap_form_49773.id=$_POST[cod_id]");
            //element_656 - ppt
        break;
        case 2:
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_352 = $cost,ap_form_49773.element_657 = $ppt, ap_form_49773.element_349=$allo WHERE ap_form_49773.id=$_POST[cod_id]");
        break;
        case 3:
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_368 = $cost,ap_form_49773.element_658 = $ppt, ap_form_49773.element_365=$allo WHERE ap_form_49773.id=$_POST[cod_id]");
        break;
        case 4:
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_384 = $cost,ap_form_49773.element_659 = $ppt, ap_form_49773.element_381=$allo WHERE ap_form_49773.id=$_POST[cod_id]");
        break;
        case 5:
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_398 = $cost,ap_form_49773.element_660 = $ppt, ap_form_49773.element_412=$allo WHERE ap_form_49773.id=$_POST[cod_id]");
        break;
        case 6:
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_663 = $cost,ap_form_49773.element_418 = $ppt, ap_form_49773.element_415=$allo WHERE ap_form_49773.id=$_POST[cod_id]");
        break;
        case 7:
            
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_435 = $cost,ap_form_49773.element_661 = $ppt, ap_form_49773.element_432=$allo WHERE ap_form_49773.id=$_POST[cod_id]");
        break;
        case 8:
            echo "8 UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_452 = $cost,ap_form_49773.element_662 = $ppt, ap_form_49773.element_449=$allo WHERE ap_form_49773.id=$_POST[cod_id]<br/>";
            $db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_452 = $cost,ap_form_49773.element_662 = $ppt WHERE ap_form_49773.id=$_POST[cod_id]");
        break;
    }    
}

$db->query("UPDATE Inetforms.ap_form_49773 SET ap_form_49773.element_655 = $_POST[total_cost]");

$iu = array(
    "cod_id"=>$_POST['cod_id'],
    "pallets"=>$_POST['pallet'],
    "cases"=>$_POST['cases'],
    "est_weight"=>$_POST['weight'],
    "allocation"=>$allo,
    "ppt"=>$ppt,
    "cost"=>$cost,
    "com_type"=>$_POST['commodity'],
    "units"=>$_POST['units'],
    "product"=>$_POST['product_num'],
    "total_cost"=>$_POST['total_cost']
);

echo "<pre>";
print_r($iu);
echo "</pre>";

$check = $db->query("SELECT * FROM Inetforms.mixed_Load WHERE cod_id = $_POST[cod_id] AND com_type ='$_POST[commodity]'");
if(count($check)>0){
    $db->where("com_type",$_POST['commodity'])->where("cod_id",$_POST['cod_id'])->update("Inetforms.mixed_Load",$iu);
}else{
    $db->insert("Inetforms.mixed_Load",$iu);
}



?>