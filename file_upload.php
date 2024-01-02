<?php

include "protected/global.php";
?>



<?php
$iu = $db->query("SELECT element_144,element_145 FROM Inetforms.ap_form_43256 WHERE id = $_GET[dogfoodid]");

if(strlen($iu[0]['element_144'])>0){
    echo "<iframe src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$iu[0]['element_144']."' onload=\"resizeIframe(this)\"></iframe><br/>";
    echo "<a href='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$iu[0]['element_144']."' target='_blank'>".$iu[0]['element_144']."</a><br/>";
}
//delement_144_88ed79807547ca6be48961b4c5a30f99-26-destroycompleted.jpg

/*
if(strlen($iu[0]['element_145'])>0){
     echo "<iframe src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$iu[0]['element_145']."' onload=\"resizeIframe(this)\"></iframe><br/>";
    echo "<a href='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$iu[0]['element_144']."'  target='_blank'>".$iu[0]['element_145']."</a><br/>";
}*/

?>
<script type="text/javascript">
  function resizeIframe(iframe) {
    iframe.height = iframe.contentWindow.document.body.scrollHeight + "px";
  }
</script> 