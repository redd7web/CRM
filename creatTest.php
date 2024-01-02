<?php
include "protected/global.php";
 
 $user ="RDizon";
 $password="123hjkumm";
 $md5= crypt("$user"."$password","bio");
 $data = Array ( 
    "first"=>"Redd",
    "last"=>"Dizon",
    "middle"=>"Rainier",
    "email"=>"redd7web@gmail.com",
    "address"=>"123 Fakestreet",
    "city"=>"Some City",
    "state"=>"CA",
    "areacode"=>"714",
    "phone"=>"7288470",
    "carrier"=>"tmobile",
    "roles"=>"admin",
    "title"=>"Tester",
    "facility"=>"",
    "staff_id"=>"",
    "account_created"=>date("Y-m-d H:i:s"),
    "last_login"=>"",
    "duty"=>"Tester",
    "login_name"=>"$user",
    "password"=>$md5,
    "facility_restriction"=>"",
    "division_restriction"=>"",
    "driver_hourly_pay"=>"",
    "notes"=>""
 );
 $db->insert($dbprefix."_users",$data); 
    

?>