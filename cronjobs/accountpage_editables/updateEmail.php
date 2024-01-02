<?php
    include "../protected/global.php";
    
    $data = Array(
        "email"=>$_POST['email_name']
    );
    $db->where('account_ID',$_POST['id'])->update("iwp_accounts",$data);
    
    echo "$_POST[id] | $_POST[email_name]";    
?>

