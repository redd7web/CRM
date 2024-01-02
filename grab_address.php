<?php
include "protected/global.php";



$uc = $db->query("SELECT account_ID,Name,address,city,state,zip FROM iwp_accounts WHERE status IN('New','Active')");

if(count($uc)>0){
    foreach($uc as $cu){
        echo "<tr rel='$cu[account_ID]'><td>$cu[Name]</td><td>$cu[address], $cu[city], $cu[state] $cu[zip]</td><td class='verify'></td></tr/>";
    }
}


?>