<?php
    include "../protected/global.php";
    $data = Array(
        "contact_name"=>$_POST['contact']
    );
    $db->where('account_ID',$_POST['id'])->update("iwp_accounts",$data);
    
    echo "$_POST[id] | $_POST[account_name]";    

?>