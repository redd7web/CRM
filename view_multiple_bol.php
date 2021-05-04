<?php
include "protected/global.php";

$ki = $db->query("SELECT element_151 FROM Inetforms.ap_form_43256 WHERE id=$_GET[id]");



?>
<table style="width:1000px;float:left;">
<?php
    if(count($ki)>0){
       $multiple_bols = explode("|",$ki[0]['element_151']);
        foreach($multiple_bols as $indiv){
            echo "<tr><td style='text-align:left'><img src='machforms/machform/data/form_43256/files/".$indiv."' style='width:60%;'/></td></tr>";
        } 
    }
?>
</table>