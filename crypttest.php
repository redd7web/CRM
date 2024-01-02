<?php
include "protected/global.php";


$update = $db->get("iwp_users","login_name,password,user_id");

if(count($update)>0){
    foreach($update as $newcred){
        echo "$newcred[login_name] ".crypt("$newcred[login_name]$newcred[password]",'$2a$07$biotane$')." vs.<br/>";
        $first = str_split("$newcred[password]");
        echo "first three pw:". $first[0].$first[1].$first[2]."<br/>";
        echo "old way: ".crypt("$newcred[login_name]$first[0]$first[1]$first[2]",'$2a$07$biotane$');
        echo "<br/><br/>";        
    }
}







?>