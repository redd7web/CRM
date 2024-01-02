<?php
include "protected/global.php";
ini_set("display_errors",1);
$ty = $db->query("SELECT * FROM iwp_accounts WHERE is_trap = 0 AND (account_ID IN ( SELECT account_no FROM iwp_grease_traps ) OR account_ID IN ( SELECT account_no FROM iwp_grease_data_table) )");


if(count($ty)>0){
    foreach($ty as $extra){
        echo $extra['Name']." ".$extra['account_ID']."<br/><br/>";
    }
}

?>