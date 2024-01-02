<?php
include "protected/global.php";

$encrypted = crypt("Pass123",'$105Biotane');
    
    $array = array(
        "first"=>"Doug",
        "last"=>"Swartz",
        "middle"=>"",
        "email"=>"DSwartz@iwpusa.com",
        "address"=>"123 Fakestreet",
        "city"=>"",
        "state"=>"",
        "zip"=>"",
        "areacode"=>0,
        "phone"=>0,
        "carrier"=>"",
        "roles"=>"admin~",
        "title"=>"",
        "facility"=>23,
        "user_id"=>"",
        "staff_id"=>"",
        "account_created"=> date("Y-m-d H:i:s"),
        "last_login"=>"",
        "duty"=>"",
        "login_name"=>"DSwartz",
        "password"=>$encrypted,
        "facility_restriction"=>"",
        "division_restriction"=>"",
        "driver_hourly_pay"=>"",
        "notes"=>""
    );
   
    
    if($db->insert("iwp_users",$array)) { 
        echo "User inserted successfully.";
    }

?>