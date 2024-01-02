<?php
    include "../protected/global.php";
    $data = Array(
        "expires"=>$_POST['expira']
    );
    $db->where('account_ID',$_POST['id'])->update("iwp_accounts",$data);
    
    echo "$_POST[id] | $_POST[expira]";    

?>