<?php
    include "../protected/global.php";
    ini_set("display_errors",1);
    
    $array = array(
        "name"=>$_POST['name'],
        "comp_email"=>$_POST['email'],
        "address"=>$_POST['address'],
        "city"=>$_POST['city'],
        "state"=>$_POST['state'],
        "zip_code"=>$_POST['zipcode'],
        "active"=>1

    );


    var_dump($array);
//    if($db->insert("iwp_competitors",$array)){
//        echo "Competitor $_POST[name] has updated!";
//    }
    
?>