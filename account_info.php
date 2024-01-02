<?php

include "protected/global.php";
 $i = 0;
$file = "biotane20141204/accounts.txt";// Your Temp Uploaded file
if(($handle = fopen($file,"r"))!==FALSE){
    /*Skip the first row*/
        fgetcsv($handle, 0,chr(9));
        while(($data = fgetcsv($handle,0,chr(9)))!==FALSE){
              
              $parse = explode(" ",$data[27]);            
              $address = htmlspecialchars($data[10]);
              $address = str_replace(" ","%",$address);
              $namex = htmlentities($data[1]);
              
              
              $ac_name = str_replace("'","\'",$namex);
              $ac_name = str_replace(" ","%",$ac_name);
              
              
               if(strlen($data[27])>0){
                   $check = $db->query("SELECT user_id FROM iwp_users WHERE first like '%$parse[0]%' AND last like '%$parse[1]%'");
                   if(count($check)>0){                        
                        $number = $check[0]['user_id'];
                        
                   } else {
                        $number = 102;
                   }
               } else {
                    $number = 102;
               }
               //echo "updated with ".$number."<br/>";
               
               if(strlen($data[1])>0){
                   echo "UPDATE iwp_accounts set account_rep = $number WHERE name like '%$ac_name%';<br/>";            
                   $db->query("UPDATE iwp_accounts set account_rep = $number WHERE name like '%$ac_name%'");
               }
        }
}

?>