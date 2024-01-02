<?php
ini_set("display_errors",1);
if(isset($_POST['publish'])){
    if(strlen(trim($_POST['update']))){
        $patch = array(
            "patch_description"=>$_POST['info']
        );
        $db->where("entry","$_POST[update]")->update("iwp_patch_notes",$patch);
    }else{
        $dte = date("Y-m-d H:i:s");
        $patch = array(
            "date_implemented"=>$dte,
            "version"=>$_POST['version'],
            "patch_description"=>$_POST['info'],
            "module"=>$_POST['module']
        );
        $db->insert("iwp_patch_notes",$patch);
    }
}


if($person->isAdmin()){
    
    
    if(isset($_GET['edit'])){
        $iop = $db->where("entry","$_GET[edit]")->get("iwp_patch_notes");
        if(count($iop)>0){
            $version = $iop[0]['version'];
            $info = $iop[0]['patch_description'];
            $entry = $_GET['edit'];
            $module = $iop[0]['module'];
        }
    }else{
        $version ="";
        $info ="";
        $entry ="";
        $module ="";
    }
    
?>
<link rel="stylesheet" href="../plugins/nicedit/niceEdit.css" />
<script type="text/javascript" src="../plugins/nicedit/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<form action="management.php?task=patch" method="POST">
<table style="width:1000px;margin:auto;">
    <tr>
        <td><input type="text" placeholder="Version Number" name="version" value="<?php if(strlen(trim($version))>0){ echo "$version"; } ?>"/></td><td>Module: <select name="module"><option>---</option><option <?php if($module == "oil"){ echo " selected "; } ?>  value="oil">Yellow Grease</option><option  <?php if($module == "bakery"){ echo " selected "; } ?>    value="bakery">Bakery</option><option  <?php if($module == "gt"){ echo " selected "; } ?>    value="gt">Grease Trap</option><option  <?php if($module == "org"){ echo " selected "; } ?>    value="org">Organics</option></select></td></tr>
    <tr><td colspan="2"><textarea name="info" placeholder="Please describe ALL the changes in this rollou for this particular module here." style="height: 300px;"><?php if(strlen(trim($info))>0){ echo "$info"; } ?></textarea></td></tr>
    <tr><td colspan="2" style="text-align: right;"><input type="submit" value="Publish" name="publish"/></td></tr>
</table>
<input type="text" name="update" value="<?php echo $entry; ?>"/>
</form>

<h1>Edit previous Patch Notes</h1>

<?php
 $l = $db->query("SELECT * FROM iwp_patch_notes");
  ?>
  <table style="width: 1000px;margin:auto;">
    <tr>
        <td style="vertical-align: top;background:blue;color:white;font-weight:bold;">Date</td>
        <td style="vertical-align: top;background:blue;color:white;font-weight:bold;">Patch Version</td>
        <td style="vertical-align: top;background:blue;color:white;font-weight:bold;">Description</td>
        <td style="vertical-align: top;background:blue;color:white;font-weight:bold;">Module</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    <?php
        if(count($l)>0){
            foreach($l as $m){
                echo "<tr>
                        <td style='vertical-align:top;'>".trim($m['date_implemented'])."</td>
                        <td style='vertical-align:top;'>$m[version]</td>
                        <td style='vertical-align:top;'>$m[patch_description]</td>
                        <td style='vertical-align:top;'>$m[module]</td>
                        <td style='vertical-align:top;'><img src='img/delete-icon.jpg' rel='$m[entry]' class='patch_delete' style='cursor:pointer;'/></td>
                        <td style='vertical-align:top;'><a href='management.php?task=patch&edit=$m[entry]'><img src='img/edit-icon.jpg' rel='$m[entry]' class='patch_edit'/></a></td>
                    </tr>";
            }
        }
    ?>
  </table>
  <script>
  $(".patch_delete").click(function(){
        if( confirm("Are you sure you want to delete these patch note(s)") ){
            $.post("delete_patch_note.php",{ entry_id: $(this).attr('rel') },function(data){
                alert(" Patch Note deleted " + data);    
                $(this).closest('tr').remove();
            });
        }
  });
  </script>
  <?php 
}else{
    echo "Please login with Admin credentials to update patch notes";
}
?>