<?php
include "../protected/global.php";
    $data = Array(
        "$_POST[field]"=>$_POST['value']
    );
    
    //var_dump($data);
    
    
    $db->where('account_ID',$_POST['id'])->update("iwp_accounts",$data);
    
    echo "$_POST[id] | $_POST[value] $_POST[field]";    

?>