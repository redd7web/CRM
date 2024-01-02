<?php
    include "protected/global.php";
    ini_set("display_errors",1);
    $header = "From: inet-user-creation@iwpusa.com\r\n";
    $header .= "Reply-To: No-reply@iwpusa.com\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $encrypted = crypt("$_POST[password]",'$105Biotane');
    
    $array = array(
        "first"=>"$_POST[first_name]",
        "last"=>"$_POST[last_name]",
        "middle"=>"$_POST[middle_name]",
        "email"=>"$_POST[email]",
        "address"=>"$_POST[address]",
        "city"=>"$_POST[city]",
        "state"=>"$_POST[state]",
        "zip"=>"$_POST[zip]",
        "areacode"=>$_POST['areacode'],
        "phone"=>$_POST['phone'],
        "carrier"=>"",
        "roles"=>"admin~",
        "title"=>"",
        "facility"=>23,
        "user_id"=>"",
        "staff_id"=>"",
        "account_created"=> date("Y-m-d H:i:s"),
        "last_login"=>"",
        "duty"=>"",
        "login_name"=>"JSepulveda",
        "password"=>$encrypted,
        "facility_restriction"=>"",
        "division_restriction"=>"",
        "driver_hourly_pay"=>"",
        "notes"=>""
    );
   
    
    if($db->insert("iwp_users",$array)) { 
        mail("ABurkett@iwpusa.com,ttrawick@iwpusa.com,jtrawick@iwpusa.com,AParsons@iwpusa.com,edizon@iwpusa.com","New User added in Oil","New User added $_POST[first_name] $_POST[last_name] \r\n Please review pending user in Oil - > Management - > Users",$header);
        echo "User inserted successfully.";
    }
?>