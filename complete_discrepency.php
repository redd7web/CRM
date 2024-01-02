<?php
include "protected/global.php";
ini_set("display_errors",1);
$reason = '';
$update_reason='';
if(isset($_POST['reason_field'])){
    if(strlen(trim($_POST['reason']))>0){
        $reason = $_POST['reason'];
    }
    $update_reason = ",ap_form_17457.$_POST[reason_field] = '$reason'";
}



$db->query("UPDATE Inetforms.ap_form_17457 SET ap_form_17457.$_POST[check_box] =1 $update_reason WHERE id = $_POST[form_id] ");
echo "UPDATE Inetforms.ap_form_17457 SET ap_form_17457.$_POST[check_box] =1 $update_reason WHERE id = $_POST[form_id];<br/>";
echo "DISCREPANCY COMPLETED!";




?>