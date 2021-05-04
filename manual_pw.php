<?php
include "protected/global.php";
ini_set("display_errors",1);
$header = "From: iwpusa-password-reset@iwpusa.com\r\n";
$header .= "Reply-To: No-reply@iwpusa.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"\"\r\n\r\n";


function randomPassword($len = 8) {

    //enforce min length 8
    if($len < 8)
        $len = 8;

    //define character libraries - remove ambiguous characters like iIl|1 0oO
    $sets = array();
    $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    $sets[] = '23456789';
    $sets[]  = '~!@#';

    $password = '';
    
    //append a character from each set - gets first 4 characters
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
    }

    //use all characters to fill up to $len
    while(strlen($password) < $len) {
        //get a random set
        $randomSet = $sets[array_rand($sets)];
        
        //add a random char from the random set
        $password .= $randomSet[array_rand(str_split($randomSet))]; 
    }
    
    //shuffle the password string before returning!
    return str_shuffle($password);
}


if(isset($_GET['chpw'])){
   //echo $person->user_id."<br/>";
    $pw = randomPassword();
    $hashed =  crypt("Pass123",'$105Biotane');

    $package = array(
        "password"=>$hashed,
        "changed"=>1
    );
    
    $person = new Person($_GET['chpw']);
    
    if(strlen(trim($person->email))>0){

        //mail("$person->email","Password Reset","Hello! $person->fullname \r\nYour password for Imperial Western Products Oil Module has been changed.\r\n Your password has been reset to: $pw \r\nPlease login and change your password.",$header);
        
        if($db->where("user_id",$_GET['chpw'])->update("iwp_users",$package)){
            echo "Password Changed successfully!";
        }
    }else{
        echo "This user does not have an email set.";
    }
}

?>
