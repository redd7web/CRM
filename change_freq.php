<?php
include "protected/global.php";
ini_set("display_errors",0);
if(isset($_POST['change_freq'])){
    $pack = array(
        "pickup_frequency"=>$_POST['freq']
    );
    $db->where("account_ID",$_POST['account_no'])->update("iwp_accounts",$pack);
}
$account = new Account($_GET['account_no']);
?>
<style>

body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<h1><?php echo $account->name_plain ?></h1>
<form action="change_freq.php?account_no=<?php echo $account->acount_id; ?>" method="post">
<input type="text" value="<?php echo $account->pick_up_freq; ?>" name="freq"/>&nbsp;
<input type="hidden" value="<?php echo $account->acount_id; ?>" name="account_no"/>
<input type="submit" name="change_freq" />
</form>