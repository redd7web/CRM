<?php
    include "../protected/global.php";
    
    $data = Array(
        "payee_name"=>$_POST['address_name']
    );
    $db->where('account_ID',$_POST['id'])->update("iwp_accounts",$data);
    
    echo "$_POST[id] | $_POST[address_name]";    
?>

