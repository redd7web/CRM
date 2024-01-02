<?php
include "protected/global.php";
ini_set("display_errors",1);
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: master-lock-notification@iwpusa.com'."\r\n".'Reply-To: No-reply@iwpusa.com'."\r\n" .'X-Mailer: PHP/' . phpversion();

$kreq = $db->query("SELECT element_22 FROM Inetforms.ap_form_60352 WHERE id=$_GET[id]");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <?php 
        include "source/scripts.php";
        include "source/css.php";
    ?>
    <style>
    body{
        padding:10px 10px 10px 10px;
    }
    </style>
	<title>Untitled 1</title>
</head>

<body>

<?php
    switch($_GET['mode']){
        case 5:
            $db->query("UPDATE Inetforms.ap_form_60352 SET element_21_5 = $_GET[value] WHERE id= $_GET[id]");
        break;
        case 4://rejected
            $db->query("UPDATE Inetforms.ap_form_60352 SET element_21_2 = 1 WHERE id = $_GET[id]");
            echo "Task Updated to rejected";
            mail($kreq[0]['element_22'],"IT Projects UPDATE - Task Updated","Task updated to rejected",$headers);
        break;  
        case 3://completed
            $db->query("UPDATE Inetforms.ap_form_60352 SET element_21_1 = 1 WHERE id = $_GET[id]");
            mail($kreq[0]['element_22'],"IT Projects UPDATE - Task Updated","Task updated to completed",$headers);            
            echo "Task Updated to Completed";
        break; 
        case 2://Task
            
            if(isset($_POST['update_task'])){
                $db->query("UPDATE Inetforms.ap_form_60352 SET element_7 ='$_POST[task]' WHERE id=$_GET[id]");
                mail($kreq[0]['element_22'],"IT Projects UPDATE - Task Updated","Task updated to $_POST[task]",$headers);
            }
            
            $k = $db->query("SELECT element_7 FROM Inetforms.ap_form_60352 WHERE id=$_GET[id]");
            ?>
            
            
            <form action="update_projects.php?mode=2&id=<?php echo $_GET['id']; ?>" method="POST">
            <textarea style="width: 370px;height:240px;margin:auto;" name="task">
                <?php
                    echo $k[0]['element_7'];
                ?>
            </textarea><br />
            <input type="submit" name="update_task" style="float: right;" value="Update Task"/>
            </form>
            <?php
               
        break;  
        case 1:
        
             if(isset($_POST['update_timeline'])){
                $db->query("UPDATE Inetforms.ap_form_60352 SET element_10='$_POST[timeline]' WHERE id=$_GET[id]");
                mail($kreq[0]['element_22'],"IT Projects UPDATE - Timeline Updated","Timeline updated to $_POST[timeline]",$headers);
             }
             $k = $db->query("SELECT element_10 FROM Inetforms.ap_form_60352 WHERE id=$_GET[id]");
        ?>
            <form method="POST" action="update_projects.php?mode=1&id=<?php echo $_GET['id']; ?>">
            <input type="text" id="timeline" name="timeline" value="<?php echo $k[0]['element_10']; ?>"/>
            <input type="submit" name="update_timeline" style="float: right;" value="Update Timeline"/>
            </form>
        <?php
        break;
    }


?>

<script>
$("#timeline").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>
</body>
</html>