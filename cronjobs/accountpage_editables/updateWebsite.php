<?php
    include "../protected/global.php";
    
    $data = Array(
        "url"=>$_POST['website']
    );
    $db->where('account_ID',$_POST['id'])->update("iwp_accounts",$data);
    
    echo "$_POST[id] | $_POST[website]";    
?>

