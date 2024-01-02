<?php
include "protected/global.php";
ini_set("display_errors",1);
function randomKey($length) {
    $key = "";
    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

    for($i=0; $i < $length; $i++) {
        $key .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $key;
}
    
$md5 = "dfssddssd";

do {
  $new_pw = randomKey(13);
  $md5 = crypt($new_pw,'$105Biotane');
  $newcheck = $db->query("SELECT password FROM iwp_users WHERE password = '$md5'");
  if ( count($newcheck) >= 1) {
    $int_exists = true;
  } else {
    $int_exists = false;
  }
} while($int_exists);
                    
echo "md5: $md5";


?>