<?php
include "protected/global.php";
ini_set("display_errors",1);
$person = new Person();
$driver = new Person($_POST['drivers']);

$check = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE route_id = $_POST[rid]");
$vehicle = $db->query("SELECT name  FROM assets.truck WHERE truck.module = 'bakery' AND enabled = 1 AND truck_id = $_POST[vehicle]");

$veh ="";
$requestor="";
$tank="";
$snumber="";
$inbwtn="";
echo "<pre>";
print_r($_POST);
echo "</pre>";
$wtnroute = "";
$wtnroutex = $db->query("SELECT * FROM bakery.bakery_single_data_table WHERE route_id = $_POST[rid]");

if(count($veh)>0){
    $veh = $vehicle[0]['name'];
}

if(count($wtnroutex)>0){
    $wtnroute = $wtnroutex[0]['weight_ticket_number'];
}

switch($_POST['reciev_fac']){
    case 9://petfood
        $element_1 = 9;
        $into_tcl = array(
            "date_created"=>date("Y-m-d H:i:s"),//date created
            "element_2"=>date("Y-m-d"),
            "element_3"=>date("H:i:s"),
            "element_4"=>"Pending",
            "element_138"=>$driver->first_name." ".$driver->last_name,
            "element_135"=>7,
            "element_131"=>2,
            "element_132"=>"MLMA",
            "element_133"=>$_POST['net_weight'],//netweight
            "element_1"=>$element_1,//sub category
            "element_134"=>$_POST['wtn'],//weight ticket
            "element_22"=>9,// driver other
            "element_23"=>$_POST['drivers'],//driver  other name
            "element_147"=>$_POST['release_number'],//release number
            "element_150"=>$_POST['seal'],
            "route_id"=>$_POST['rid'],
            "element_141"=>"Sub Hauler/Vehicle: ".$_POST['sub_haul']." ".$veh,//Notes
            "element_134"=>$wtnroute,
            "element_137"=>2,
            "element_114"=>3,
            "element_5_1"=>$person->first_name,
            "element_5_2"=>$person->last_name
        );
    break;
    case 7:case 10://mayo //candy
        $element_1 = 1;
        $into_tcl = array(
            "date_created"=>date("Y-m-d H:i:s"),//date created
            "element_18"=>$_POST['net_weight'],
            "element_19"=>$_POST['wtn'],
            "element_22"=>9,
            "element_23"=>$_POST['drivers'],
            "element_24"=>$_POST['release_number'],//release number
            "route_id"=>$_POST['rid'],
            "element_25"=>"Sub Hauler: ".$_POST['sub_haul']//Notes
                  
        );
    break;
}



if(count($check)>0){//update
    $db->where("route_id",$_POST['rid'])->update("Inetforms.ap_form_43256",$into_tcl);
}else{//insert
   $db->insert("Inetforms.ap_form_43256",$into_tcl);
    $tcl_id = $db->getInsertId();    
    $test = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE id = $tcl_id");    
    $release = $_POST['release_number'];
    $er_information = array(
        "date_created"=>date("Y-m-d H:i:s"),
        "element_76"=>$tcl_id,
        "status"=>$test[0]['status'],
        "element_3"=>"Pending",
        "element_8"=>$test[0]['element_2'],
        "element_9"=>$test[0]['element_3'],
        "element_10"=>$requestor,
        "element_13"=>$tank,
        "element_11"=>$test[0]['element_131'],
        "element_12"=>$test[0]['element_129'],
        "element_14"=>$snumber,
        "element_82"=>$release,
        "element_83"=>$inbwtn,
        "element_84"=>$test[0]['element_141'],
        "element_77"=>$test[0]['element_134'],
        "source"=>"from_tcl",
        "element_81"=>4,
        "tsl_type"=>$test[0]['element_1']
    ); 
    $db->insert("Inetforms.ap_form_44342",$er_information);
}


?>