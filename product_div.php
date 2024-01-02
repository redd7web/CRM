<?php
include "protected/global.php";
ini_set("display_errors",1);
$prod_div_array = $db->query("SELECT DISTINCT (
ProductKey
), division
FROM iwp_test_scale WHERE ProductKey NOT IN (SELECT ProductKey FROM iwp_prod_to_div)
GROUP BY ProductKey");


if(count($prod_div_array)>0){
    foreach($prod_div_array as $items){
        $package = array(
            "ProductKey"=>$items['ProductKey'],
            "division"=>$items['division']
        );      
        $db->insert("iwp_prod_to_div",$package);
        echo "<pre>";
        var_dump($package);
        echo "</pre>";
    }
}



?>