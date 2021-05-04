<?php
include "protected/global.php";
ini_set("display_errors",1);

if(isset($_POST['scale_up'])){

    
        for($i=0; $i < count($_FILES['files']['tmp_name']);$i++){
    
            $tmpFilePath = $_FILES['files']['tmp_name'][$i];

              //Make sure we have a file path
              if ($tmpFilePath != ""){
                //Setup our new file path
                if(!file_exists("scale_ticket_uploads/". $_GET['entry'] ."/")){
                    mkdir("scale_ticket_uploads/". $_GET['entry'] ."/",0777);
                }
                
                $nf = str_replace(" ","-",$_FILES['files']['name'][$i]);
                $nf =  preg_replace('/[^a-zA-Z0-9_.]/', '', $nf);
                
                $newFilePath = "scale_ticket_uploads/". $_GET['entry'] ."/" .$nf ;
            
                /**/
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $pack = array(
                        "scale_entry"=>$_GET['entry'],
                        "image_path"=>$newFilePath
                    );
                    $db->insert("scale_ticket_images",$pack); 
            
                }
                echo "$newFilePath<br/>";
            } 
        }
}



?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <link rel="stylesheet" type="text/css" href="machform/machforms/data/form_64000/css/view.css" media="all" />
    <link rel="stylesheet" type="text/css" href="machform/machforms/view.mobile.css" media="all" />
    <?php
        include "source/scripts.php";
        include "source/css.php";
    ?>
	<title>Untitled 1</title>
    <style>
    body{
        padding:10px 10px 10px 10px;
        margin: 10px 10px 10px 10px;
    }
    </style>
</head>

<body>
<div id="form_container" class="">
	
		
		
					<div class="form_description">
			<h2>Scale Coachella Edit</h2>
			<p></p>
		</div>						
			<ul >
			
			
			
		<!--			<li id="li_1"  >
		<label class="description" for="element_16">Shipping Number </label>
		<div>
			<input id="element_16" name="element_16" class="element text medium"   type="text"   value=""  /> 
			
		</div> 
		</li>	--!>
        
        <?php
        
            if(!isset($_GET['mode'])){
        ?>
        
        <li id="li_2">
        <label class="description" for="scale_image">Upload Image here</label>
        </li>
        <li>
        <div>
            <form action="scaleEdit.php?entry=<?php echo $_GET['entry']; ?>" method="POST" enctype="multipart/form-data">
			<input id="file" name="files[]" class="element text medium"   type="file"   value="Choose images." multiple accept="image/*" />
            <input type="submit"  value="Upload Image(s)" name="scale_up" id="scale_up"/> 
			</form>
		</div>    
        </li>
        <?php 
            }
        ?>
			</ul>
		
	
	</div>

    <table style="width: 900px;margin:auto;">
        <?php 
            $pics = $db->query("SELECT * FROM scale_ticket_images WHERE scale_entry =$_GET[entry]");
            if(count($pics)>0){
                foreach($pics as $img){
                    echo "<tr>"; 
                        if(!isset($_GET['mode'])){
                            echo "<td><img src='img/delete-icon.jpg' class='delete-image' rel='$img[id]' style='width:150px;height:80px;cursor:pointer;'/></td>";
                        }
                    
                    echo "<td style='text-align:left;'><a href='$img[image_path]' target='_blank'><img src='$img[image_path]' style='width:25%;'/></a></td></tr>";
                }
            }
        ?>
    </table>
</body>
<script>
<?php
if(isset($_SESSION['billing'])){
    ?>
    $(".sn").change(function(){
        $.post("update_shipping.php",{truckkey: $(this).attr('rel'),weighin:$(this).attr('weignin'),sn:$(this).val()},function(data){
            alert("Shipping Number Updated! " + data);
        });
    });
    
    <?php
}

?>

$(".delete-image").click(function(){
    if(confirm("Are you sure you want to delete this image?")){
        $.post("delete_uploaded_picture.php",{id:$(this).attr('rel')},function(data){
             alert("Picture Deleted");
             window.location.reload();
        }); 
    }
});
</script>
</html>