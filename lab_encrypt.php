<?php
include "protected/global.php";
ini_set("display_error",1);
?>
<style>
body{
    padding:10px 10px 10px 10px;
    margin: 10px 10px 10px 10px;
}
</style>
<?php
$lab = $db->query("SELECT element_2,id FROM Inetforms.ap_form_64550 WHERE ap_form_64550.id = $_GET[Req_ID]");
$trimmed = trim($lab[0]['element_2']);
$md5 = crypt($trimmed,'$ap_form_64550');

$k = array(
    "password"=>$md5,
    "element_2"=>null
);

$db->where("id",$lab[0]['id'])->update("Inetforms.ap_form_64550",$k);

echo "User Updated";
?>

