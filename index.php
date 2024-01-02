<?php 
include "protected/global.php"; 
ini_set("display_errors",0);
$person = new Person();
function randomKey($length) {
    $key = "";
    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

    for($i=0; $i < $length; $i++) {
        $key .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $key;
}

$page = "home";
$header = "From: password-reset@iwpusa.com\r\n";
$header .= "Reply-To: No-reply@iwpusa.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
        
if(isset($_SESSION['id'])){$person = new Person();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="ReDDaWG" />
    <meta charset="UTF-8" />
   <?php include "source/css.php"; ?>
   <?php include "source/scripts.php"; ?>
   
	<title>Oil Customer Management System</title>
</head>
<body>
<?php include "source/header.php"; ?>
<div id="wrapper" style="margin-bottom: 20px">





    
    
<?php
if(  isset($_SESSION['id'])  ){
    ?>
    <div id="form_space" style="width: 1000px;height:600px;background:transparent;margin:auto;border:0px inset #cccccc;"></div>
    <?php
    
    /*
echo "<h1 style='margin-left:5px;'>Patch Notes: </h1><br/><span style='margin-left:5px;'>Click on the version number to read more or 'View All' to view all.</span> <br/><br/>";
    echo "<div id='patch_notes' style='width:90%;margin:auto;border:2px green solid;padding:5px 5px 5px 5px;margin-bottom:10px;'>";
    if(isset($_GET['entry'])){//viewing a specific entry
        if($_GET['entry'] != 'all'){
            $i = $db->where("entry","$_GET[entry]")->get("iwp_patch_notes","patch_description,version,date_implemented");
            if(count($i)>0){
                
                echo "<div class='release_item' style='border:1px dashed green;min-width:40%;width:auto;min-height:100px;height:auto;padding:5px 5px 5px 5px;margin: 5px 5px 5px 5px;'>";
                echo "<h2 style='width:100%;font-size:25px;'> - ".$i[0]['version']."</h2>";
                echo "<h3>".$i[0]['date_implemented']."</h3>";
                echo $i[0]['patch_description'];
                echo "</div>";
            }
        }else if($_GET['entry'] == 'all'){ // viewing all release notes
            $q = $db->where("module","oil")->get("iwp_patch_notes","patch_description,version,date_implemented");
            if(count($q)>0){
                foreach($q as $patch_tems){
                    echo "<div class='release_item' style='border:1px dashed green;min-width:40%;width:auto;min-height:100px;height:auto;padding:5px 5px 5px 5px;margin: 5px 5px 5px 5px;'>";
                    echo "<h2 style='width:100%;font-size:25px;'> - ".$patch_tems['version']."</h2>";
                    echo "<h3>".$patch_tems['date_implemented']."</h3>";
                    echo $patch_tems['patch_description'];
                    echo "</div>";
                }
            }
        }
    }
    
    $nbx = $db->where("module","oil")->get("iwp_patch_notes","date_implemented,version,entry");
    if(count($nbx)>0){
        echo "<ul>";
        echo "<li><a href='home.php?entry=all'>View All</a></li>";
        foreach($nbx as $n){
            echo "<li>$n[date_implemented] <a href='home.php?entry=$n[entry]'>Version: $n[version]</a></li>";
        }
        echo "</ul>";
    }
    
    echo "</div>";
*/
    
}


?>

</div>
<?php include "source/footer.php"; ?>
</body>
</html>