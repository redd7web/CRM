<?php
    include "../protected/global.php";
    
    $data = Array(
        "index_percentage"=>$_POST['index_percentage']
    );
    $db->where('account_ID',$_POST['id'])->update("iwp_accounts",$data);
    
    echo "$_POST[id] | $_POST[index_percentage]";    
?>

