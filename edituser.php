<?php
    include "protected/global.php";
    ini_set("display_errors",1);
    $person = new Person();
    
    $array = array(
        "first"=>$_POST['fname'],
        "last"=>$_POST['lname'],
        "middle"=>$_POST['mname'],
        "email"=>$_POST['email'],
        "address"=>$_POST['address'],
        "city"=>$_POST['city'],
        "state"=>$_POST['state'],
        "zip"=>$_POST['zipcode'],
        "areacode"=>$_POST['areacode'],
        "phone"=>$_POST["phone"],
        "carrier"=>"verizon",
        "roles"=>$_POST['roles'],
        "title"=>$_POST['title'],
        "facility"=>$_POST['facility'], 
        "duty"=>$_POST['duty'],        
        "facility_restriction"=>$_POST['facility_restrict'],
        "division_restriction"=>"",
        "driver_hourly_pay"=>"",
        "notes"=>""
    );
    
    
    
    
   if($person->isAdmin()){
     if(strlen(trim($_POST['password']))>0){
        $hashed =  crypt("$_POST[password]",'$105Biotane');
        $arrayn = array ( "password"=>$hashed  ); 
        $array += $arrayn;
     }
     print_r($array);
   } 
 
    
    if($db->where("user_id","$_POST[id]")->update("iwp_users",$array)) {
        $track = array(
            "date"=>date("Y-m-d H:i:s"),
            "user"=>$person->user_id,
            "actionType"=>"User Upated",
            "descript"=>"User ".uNumToName($_POST['id'])." Updated",
             "pertains"=>4,
            "type"=>11
        );
        $db->insert($dbprefix."_activity",$track);
        //echo "User $_POST[fname] updated";
    }
    
?>