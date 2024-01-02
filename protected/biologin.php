<?php
    
    ini_set("display_errors",1);
    // header
    //$header = "From: iwppassreset@iwpusa.com\r\n";
    //$header .= "Reply-To: No-reply@iwpusa.com\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    date_default_timezone_set ( "America/Los_Angeles" );
   
    
    function randomKey($length) {
        $key = "";
        $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));
    
        for($i=0; $i < $length; $i++) {
            $key .= $pool[mt_rand(0, count($pool) - 1)];
        }
        return $key;
    }
    
    //print_r($_POST);
    
    
    if(isset($_POST['biosub'])){
        if(isset($_POST['is_cowest_user'])){
            $error  = "Invalid username/password or not approved, please <a href='../index.php?from_cowest=1'>Click here to try again</a>.";
        } else{
            $error  = "Invalid username/password or not approved, please <a href='../home.php'>Click here to try again</a>.";    
        }
        
        include "global.php";
        $user= $_POST['biouser'];
        $password = $_POST['biopw'];
         
        
       
        
        
        $md5 = crypt($password,'$105Biotane');
       
       
        $k = $db->where("approved",1)->where("login_name",trim($user))->where("password","$md5")->get("iwp_users","user_id");      
        //echo "kjsdfhskjhsjfsk";
    
   
          
        if(count($k)>0){ 
            
            $_SESSION['id']= $k[0]['user_id'];
            $_SESSION['page_counter'] = 0;
            $_SESSION['history'] = array();
            $data = array( 
                "last_login"=>date("Y-m-d H:i:s"),
                "reset_count"=>0
            );
            $db->where('user_id',$_SESSION['id'])->update($dbprefix."_users",$data);
            //print_r($_SESSION);
            
            //$path = str_replace("protected/biologin.php","","$_SERVER[REQUEST_URI]");
            /*
            $track = array ( 
                "date" => date("Y-m-d H:i:s"),
                "user"=>$_SESSION['id'],
                "actionType"=>"Log In",
                "descript"=>"Log In",
                "type"=>10
            );
            $db->insert("xlogs.".$dbprefix."_activity",$track);*/
            header("Location:../index.php");
        }else { 
            $check_reset = $db->query("SELECT reset_count FROM iwp_users WHERE login_name ='$_POST[biouser]'");
            if($check_reset[0]['reset_count'] != 3){
                $db->query("UPDATE iwp_users SET reset_count = reset_count +1 WHERE login_name ='$_POST[biouser]'");
            }else{
                $db->query("UPDATE iwp_users SET reset_count = 0 WHERE login_name ='$_POST[biouser]'");
                
                $email = $db->query("SELECT email FROM iwp_users WHERE login_name ='$_POST[biouser]'");
                
                if(strlen(trim($email[0]['email']))>0){//if user does not have an email set, email allen, me to create an email for user  and manually generate a password
                    do {
                      $new_pw = randomKey(13);
                      $md5 = crypt($new_pw,'$105Biotane');
                      $newcheck = $db->query("SELECT password FROM iwp_users WHERE password = '$md5'");
                      if ( count($newcheck) >0) {
                        $int_exists = true;
                      } else {
                        $int_exists = false;
                      }
                    } while($int_exists); // make sure randomized password does not exist then update it.
                    $db->query("UPDATE iwp_users SET password='$md5',date_reset='".date("Y-m-d H:i:s")."' WHERE login_name ='$user'");
                    //mail($email[0]['email'],"Password Reset","Your password has been reset due to too many attempts<br/>Please use this new password to login and set a new one: $new_pw",$header);   
                    $error = "<br/> Three attempts, password reset and emailed.";
                }else{
                    do {
                      $new_pw = randomKey(13);
                      $md5 = crypt($new_pw,'$105Biotane');
                      $newcheck = $db->query("SELECT password FROM iwp_users WHERE password = '$md5'");
                      if ( count($newcheck) >0) {
                        $int_exists = true;
                      } else {
                        $int_exists = false;
                      }
                    } while($int_exists); // make sure randomized password does not exist then update it.
                   $db->query("UPDATE iwp_users SET password='$md5' WHERE login_name ='$user'");
                   //mail("ITprojects@iwpusa.com","No Email found for user:$user Oil Pumping Module","Password reset to $new_pw",$header);
                }
            }
            echo $error;
        }
    }else { 
        echo $error;
    }


?>

