<?php
include "protected/global.php";
ini_set("display_errors",1);
if(isset($_POST['new_bol'])){
    $bol_del = $db->query("SELECT element_144 FROM Inetforms.ap_form_43256 WHERE id= $_GET[id]");
    if(strlen(trim($bol_del[0]['element_144']))>0){
        unlink("/machforms/machform/data/form_43256/files/".$bol_del[0]['element_144']);    
    }
    
    $mod = uniqid();
    $newfilename = "element_144_$mod.".end($temp);
    echo $newfilename."<br/>";
    move_uploaded_file($_FILES["file"]["tmp_name"], "machforms/machform/data/form_43256/files/".$newfilename);
    
    
   
    $db->query("UPDATE Inetforms.ap_form_43256 SET element_144 = '$newfilename' WHERE id=$_GET[id]");
}


if(isset($_GET['id'])){
    $bol = $db->query("SELECT element_144 FROM Inetforms.ap_form_43256 WHERE id= $_GET[id]");
}




?>
<style type="text/css">
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}

</style>
<table style="margin: auto;width:450px;">
    <tr><td style="text-align: center;">Notice: Uploading a new BOL will replace the current.</td></tr>
    <tr><td style="text-align: center;"><?php 
        if (strpos($bol[0]['element_144'], '|') !== FALSE){
            $multiple_bols = explode("|",$bol[0]['element_144']);
            foreach($multiple_bols as $indiv){
                echo "<img src='machforms/machform/data/form_43256/files/".$indiv."' style='width:80%;'/><br/><br/>";
            }
        }else
        {
            echo "<img src='machforms/machform/data/form_43256/files/".$bol[0]['element_144']."'  style='width:80%;'/>";
        }
     ?></td></tr>
    <tr><td><form action="bol_edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
        New BOL:&nbsp;<input type="file" name="file" /><br />
        <input type="submit" style="text-align: right;" name="new_bol"/>
    </form></td></tr>
</table>