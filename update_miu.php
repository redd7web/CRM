<?php

include "protected/global.php";

$account = new Account(28075);

$stand = $db->query("SELECT * FROM  test_data_table WHERE account_no = 28075");

if(count($stand)>0){
    foreach($stand as $fix){
        echo $fix['inches_to_gallons'] * $account->miu."<br/><br/>";
    }
}



?>