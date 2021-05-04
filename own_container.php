<?php
include "protected/global.php";
$compare="";
$hg = $db->query("SELECT * FROM iwp_containers WHERE account_no = $_GET[account_no]");

if(count($hg)>0){
    foreach($hg as $gh){
        echo "<option $selected value='$gh[entry]'>$gh[container]</option>";
    }
}

?>