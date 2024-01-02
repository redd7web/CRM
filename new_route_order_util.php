
<?php
include "protected/global.php";
ini_set("display_errors",1);
//echo "*************** $_POST[orders]********************";

$list = explode("\n",$_POST['orders']);

array_pop($list);
array_pop($list);


$list = array_slice($list,1);
echo "<pre>";
print_r($list);
echo "</pre>";
$ij = "";
$vis ="";
foreach($list as $addy){
    $first = explode("|",$addy);
    $add_city = explode(",",$first[1]);
    $second_parse = explode(" ",$add_city[0]);
    echo "account: $first[0] account name".account_NumToName($first[0])." address :$add_city[0]<br/>"; 
   
    
    $bx = $db->query("SELECT Name FROM iwp_accounts WHERE account_ID=$first[0]");
    $ij .=$first[0]."|";
    $vis .= $bx[0]['Name'].", ";
    
    
    
    
}


$db->query("UPDATE iwp_ikg_utility SET account_numbers='$ij' WHERE route_id = $_POST[route_id]");

echo "<br/>new number string : $ij \r\n";
echo "<br/>visual: $vis\r\n New Order Saved!";

?>
