<?php
include "protected/global.php";

$load = $db->query("SELECT * FROM Inetforms.mixed_Load WHERE cod_id = $_POST[cod_id]");

if(count($load)>0){
    foreach($load as $res){
        $arrs[]="$res[com_type]|$res[pallets]|$res[cases]|$res[units]|$res[est_weight]|$res[allocation]|$res[ppt]|$res[cost]";
    }
}
echo json_encode($arrs);
?>