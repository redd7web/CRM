#!/usr/bin/php5 -q
<?php
ini_set("display_errors",0);


$k = 1;
switch($k){
    case 1:
        include "/var/www/html/protected/global.php";
        $file = "/home/iwp2/Desktop/WheyUpdateAR.csv";
    break;
    default:
        include "../protected/global.php";
        $file = "../WheyUpdateAR.csv";
    break;
}

if(file_exists($file)){
    $lines =file($file);
   
    
    foreach($lines as $data){
        $break = explode(",",$data);   
        
        $br = (int)str_replace("\"","",$break[5]);
        
        
        echo "<br/>------------------------<br/>";
        if(strlen(trim($break[5]))>0 && $break[7] !=0 && $break[6] !=0){
            echo "<pre>";
            print_r($break);
            echo "</pre>"; 
           
            $pack = array(
                "element_92"=>$break[6],
                "element_93"=>$break[7]
            );
            echo "fixed:".$br."<br/>";
          
            $db->where("id",$br)->update("Inetforms.ap_form_11670",$pack);
            $test[]=$br;
            echo "UPDATE Inetforms.ap_form_11670 SET element_92 = $break[6], element_93 = $break[7] WHERE id =$br<br/><br/>";
        }
        echo "<br/>------------------------<br/>";
    }
    
    echo "SELECT element_92,element_93 FROM Inetforms.ap_form_11670 WHERE id IN(".implode(",",$test).")";
}else{
    echo "File does not exist";
}

unset($db);

?>
