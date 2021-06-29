<?php
include "protected/global.php";
include "scaleFunctions.php";
ini_set("display_errors",1);
$permit = array (1,3,8);


if(isset($_POST['change_pw'])){
    if($_POST['first_pw'] == $_POST['confirm_pw']){
        $md5 = crypt(trim($_POST['first_pw']),'$ap_form_64550');

        $k = array(
            "password"=>$md5,
            "element_2"=>null
        );
        
        $db->where("id",$_POST['id'])->update("Inetforms.ap_form_64550",$k);
    }else{
        echo "Passwords Do Not Match.";
    }
}

if(isset($_POST['scale_login'])){
    
    $hash = crypt(trim($_POST['scale_password']),'$ap_form_64550');
    if($_SESSION['username'] =="RDizon"){
        echo "$hash $_POST[scale_name] ";
        echo "SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'";
    }
    
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1,element_10_1,element_10_2,element_10_3,element_10_4,element_10_5,element_10_6,element_10_7,element_10_8,element_10_9,element_10_10,element_10_11,element_10_12,element_10_13,element_10_14,element_10_15,element_10_16,element_10_17,element_10_18,element_10_19,element_10_20,element_10_21,element_10_22,element_10_23,element_10_24,element_10_25,element_10_26,element_10_27,element_10_28,element_10_29,element_10_30,element_10_32,element_11_1,element_11_2,element_11_3,element_11_4,element_11_5,element_11_6,element_11_7,element_11_8,element_11_12,element_11_13,element_11_14,element_11_15,element_11_16,element_11_17,element_11_18,element_11_19,element_11_20,element_11_21,element_11_22,element_11_23,element_11_24,element_11_25,element_11_26,element_11_28 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'");
    if(count($lookup)>0 && in_array($lookup[0]['element_9'],$permit) ){
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }
}

if($_SESSION['username'] == "RDizon" || $_SESSION['username'] == "spyro"){
    ini_set("display_errors",1);
}
//Manager


if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['division']);
    unset($_SESSION['manual_approve']);
    session_destroy();
}


$bh = $db->get("Inetforms.ap_form_64550","*");





?>
<!DOCTYPE HTML>
<html>
<head>
<title>Manager Dash</title>
<?php 

include "source/scripts.php";
include "source/css.php";
?>
  
<style type="text/css">
  body{
    font-size:12px;
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
  }
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
    overflow-x:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}



td,th{
    background:transparent;
    text-align:center;
    width:1%;
    font-size:12px;
    border:1px solid black;
}

th{
    vertical-align:top;
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}
input[type=checkbox]{
    width:10px;
}

</style>
<link rel="stylesheet" href="css_excel/excel-2007.css"/>
</head>
<body>
<?php

print_r($_SESSION);

if(!isset($_SESSION['billing'])  && $_SESSION['billing'] != 1   ){ 
    echo $_SESSION['username'];
    if($_SESSION['username'] =="RDizon" || $_SESSION['username']=="spyro"){
         print_r($_SESSION['division']);
    }    
    ?>
    <form action="lab_users.php" method="POST" style="margin-bottom: 50px;">
    <table style="width:200px;position:fixed;top:5px;right:5px;border-radius:10px 10px 10px 10px;border:2px solid green;padding:5px 5px 5px 5px;">
    <tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;" type="text" name="scale_name" placeholder="Username"/></td></tr>
    <tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;box-shadow:inset 0 0 5px green;padding:5px 5px 5px 5px;"  type="password" name="scale_password" placeholder="Password"/></td></tr>
    <tr><td colspan="2" style="text-align: right;border:0px solid #bbbbbb;"><input style="width: 100px;height:30px;background:url(img/login_clean.png) no-repeat center center;background-size:100% 100%;border:0px solid #bbbbbb;margin-top:4px;padding:5px 5px 5px 5px;" type="submit" value="" name="scale_login"/></td></tr>
    </table>
    </form>
    <?php
}else{
     echo "<h2>Welcome, $_SESSION[username]&nbsp; <a href='CompletedIOscale.php?task=logout'><img src='img/logout.jpg' title='Logout'/></a></h2>";
    if(count($bh)>0){
        echo "<table>";
        echo "<thead>";
        echo "<tr><td>First Name</td><td>Last Name</td><td>Username</td><td>Password</td><td>Role</td></tr>";
        echo "</thead>";
        foreach($bh as $pv){
            echo "<tr>";
                echo "<td>$pv[element_5]</td>";
                echo "<td>$pv[element_6]</td>";
                echo "<td>$pv[element_1]</td>";
                echo "<td><form action='lab_users.php'><input type='password' placeholder='New Password' class='first_pw' name='first_pw' value=''/><br/><input type='password' placeholder='Confirm Password' class='confirm_pw' name='confirm_pw' value=''/><br/><input type='hidden' name='id' value='$pv[id]'/><input type='submit' name='change_pw' value='Update Password' class='update' /></form></td>";
                echo "<td>"; 
                    switch($pv['element_9']){
                        case 1:
                        echo "Admin";
                        break;
                        case 2:
                            echo "Billing";
                        break;
                        case 3:
                            echo "Lab Manager";
                        break;
                        case 4:
                            echo "Lab Tech";
                        break;
                        case 5:
                            echo "Scale User";
                        break;
                        case 8:
                            echo "Viewing Access";
                        break;
                    }
                echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
}
?>
<script>
$(".first_pw").change(function(){
    var vv = $(this).value();
    var v = $(this).closest("tr").find("input[name=confirm_pw]").val();    
    if( vv == v ){
        $(this).closest("tr").find(".update").prop("disabled",false);
    }else{
        $(this).closest("tr").find(".update").prop("disabled",false);
    }
});

</script>
</body>
</html>