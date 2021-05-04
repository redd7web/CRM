<?php
include "protected/global.php";

 $hashed =  crypt("Charlee17",'$105Biotane');

    $package = array(
        "password"=>$hashed,
        "changed"=>1
    );
    

    $db->where("user_id",16)->update("iwp_users",$package);

?>