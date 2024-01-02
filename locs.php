<?php
include "protected/global.php";

$file = "biotane20141204/locations.txt";// Your Temp Uploaded file
if(($handle = fopen($file,"r"))!==FALSE){
    /*Skip the first row*/
    fgetcsv($handle, 0,chr(9));
    while(($data = fgetcsv($handle,0,chr(9)))!==FALSE){
        //echo $data[22]."<br/>";
        
        if(strlen($data[22])>0 && $data[22] !=""){
            $container = explode("|",$data[22]);
            echo "<br/>*******<br/>";
            foreach($container as $barrels){      
                
                preg_match('#\((.*?)\)#', $data[22], $match);
                
                $output = explode( ")", $barrels );
                
                
                $x = trim($output[1]);
                if($x == "100 Gal Tote"){
                    $x = "Tote-100";
                } else if ($x == "Barrel - 55 Gal"){
                    $x = "Barrel-55";
                } else if ($x == "285 Gal - 9.86 gals per inch"){
                    $x ="285 Gal";
                }
                echo "SELECT container_id FROM iwp_list_of_containers WHERE container_label like '%$x%'<br/>";
                $barrrel_look = $db->query("SELECT container_id FROM iwp_list_of_containers WHERE container_label like '%$x%'");
                
                
                
                for($i = 0;$i<$match[1];$i++){
                    echo "Label: ".$x." id: ".$barrrel_look[0]['container_id']." account"." $data[2]"."<br/>"; 
                    $container_pack = array(
                        "container_no"=>$barrrel_look[0]['container_id'],
                        "account_no"=>$data[0],
                        "container"=>$x
                    );
                    //var_dump($container_pack);
                    $db->insert("iwp_containers",$container_pack);
                }
                
                
                               
            }
            echo "<br/>******<br/>";
        }
        
    }
    
    
}


?>