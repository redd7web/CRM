<?php
include "protected/global.php";
ini_set("display_errors",1);
$person = new Person();

//print_r($person);
if(isset($_POST['chpw'])){
   //echo $person->user_id."<br/>";
   $pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
   if(  preg_match($pattern,$_POST['kh']) && preg_match($pattern,$_POST['confirm'])   ){
        if($_POST['kh'] == $_POST['confirm']){
            $hashed =  crypt("$_POST[kh]",'$105Biotane');
            $package = array(
                "password"=>$hashed,
                "changed"=>0
            );
            //print_r($package);
            if($db->where("user_id",$person->user_id)->update("iwp_users",$package)){
                echo "<span style='color:green;'>Password Changed successfully!</span><br/>";
            }
       }else{
         echo "Passwords do not match.";
       }
   }else{
        echo "Password must contain an upper,lower,number, a special character and must be a minumum of 8 characters.";
   }
   
   
    
}

include "source/css.php";
include "source/scripts.php";

?>
<style>
body{
    margin:10px 10px 10px 10px;
    padding:10px 10px 10px 10px;
}
</style>
<div style="width: 300px;height:100px;margin:auto;margin-top:10px;">
<form action="updatepw.php" method="post" id="form">
<p style="text-align: center;">Password must contain an upper,lower,number, a special character and must be a minumum of 8 characters.</p>
New Password:&nbsp;<input type="password" name="kh"  placeholder="enter new password here" id="one" value=""/><br />
Confirm Password:&nbsp;<input type="password" name="confirm" placeholder="Confirm Password" id="two" value=""/>
<input type="submit" name="chpw" value="Change Now" />
</form>
</div>
<script>



var $submitBtn = $("#form input[type='submit']");
 var $passwordBox = $("#one");
var $confirmBox = $("#two");
var $errorMsg =  $('<span id="error_msg"  style="color:red;">Passwords do not match.</span>');
var $confirmMsg = $('<span id="confirm_messsage" style="color:green;">Passwords Match!</span>');
 $submitBtn.removeAttr("disabled");
 
function checkMatchingPasswords(){
    if($confirmBox.val() != "" && $passwordBox.val != ""){
        if( $confirmBox.val() != $passwordBox.val() ){
            $submitBtn.attr("disabled", "disabled");
            $errorMsg.insertAfter($confirmBox);
        }else{
            $confirmMsg.insertAfter($confirmBox);
        }
    }
}

function resetPasswordError(){
    $submitBtn.removeAttr("disabled");
    var $errorCont = $("#error_msg");
    if($errorCont.length > 0){
        $errorCont.remove();
    }  
}


$("#one,#two").on("keydown",function(e){
    if(e.keyCode == 13 || e.keyCode == 9) {
        checkMatchingPasswords();
    }
}).on("blur", function(){                    
    // also check when the element looses focus (clicks somewhere else)
    checkMatchingPasswords();
})
.on("focus", function(){
    // reset the error message when they go to make a change
    resetPasswordError();
});
</script>