<?php
include "protected/global.php";

unset($_SESSION['division']);

$hash = crypt(trim('qwertyuiop'),'$ap_form_64550');
$lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1,element_10_1,element_10_2,element_10_3,element_10_4,element_10_5,element_10_6,element_10_7,element_10_8,element_10_9,element_10_10,element_10_11,element_10_12,element_10_13,element_10_14,element_10_15,element_10_16,element_10_17,element_10_18,element_10_19,element_10_20,element_10_21,element_10_22,element_10_23,element_10_24,element_10_25,element_10_26,element_10_27,element_10_28,element_10_29,element_10_30,element_10_32 FROM Inetforms.ap_form_64550 WHERE element_1 = 'RDizon' AND password = '$hash'");

echo "<pre>";
print_r($lookup);
echo "</pre>";


if( $lookup[0]['element_10_1'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_1'];
}
    
if(strlen(trim($lookup[0]['element_10_2']))>0 && $lookup[0]['element_10_2'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_2'];
}
   
if(strlen(trim($lookup[0]['element_10_3']))>0 && $lookup[0]['element_10_3'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_3'];
}
    
if(strlen(trim($lookup[0]['element_10_4']))>0 && $lookup[0]['element_10_4'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_4'];
}
if(strlen(trim($lookup[0]['element_10_5']))>0 && $lookup[0]['element_10_5'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_5'];
}
    
if(strlen(trim($lookup[0]['element_10_6']))>0 && $lookup[0]['element_10_6'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_6'];
}
if(strlen(trim($lookup[0]['element_10_7']))>0 && $lookup[0]['element_10_7'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_7'];
}
    
if(strlen(trim($lookup[0]['element_10_8']))>0 && $lookup[0]['element_10_8'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_8'];
}
if(strlen(trim($lookup[0]['element_10_9']))>0 && $lookup[0]['element_10_9'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_9'];
}
    
if(strlen(trim($lookup[0]['element_10_10']))>0 && $lookup[0]['element_10_10'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_10'];
}
if(strlen(trim($lookup[0]['element_10_11']))>0 && $lookup[0]['element_10_11'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_11'];
}
    
if(strlen(trim($lookup[0]['element_10_12']))>0 && $lookup[0]['element_10_12'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_12'];
}
if(strlen(trim($lookup[0]['element_10_13']))>0 && $lookup[0]['element_10_13'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_13'];
}
    
if(strlen(trim($lookup[0]['element_10_14']))>0 && $lookup[0]['element_10_14'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_14'];
}
if(strlen(trim($lookup[0]['element_10_15']))>0 && $lookup[0]['element_10_15'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_15'];
}
    
if(strlen(trim($lookup[0]['element_10_16']))>0 && $lookup[0]['element_10_16'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_16'];
}
if(strlen(trim($lookup[0]['element_10_17']))>0 && $lookup[0]['element_10_17'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_17'];
}
    
if(strlen(trim($lookup[0]['element_10_18']))>0 && $lookup[0]['element_10_18'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_18'];
}
if(strlen(trim($lookup[0]['element_10_19']))>0 && $lookup[0]['element_10_19'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_19'];
}
    
if(strlen(trim($lookup[0]['element_10_20']))>0 && $lookup[0]['element_10_20'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_20'];
}
if(strlen(trim($lookup[0]['element_10_21']))>0 && $lookup[0]['element_10_21'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_21'];
}
    
if(strlen(trim($lookup[0]['element_10_22']))>0 && $lookup[0]['element_10_22'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_22'];
}
if(strlen(trim($lookup[0]['element_10_23']))>0 && $lookup[0]['element_10_23'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_23'];
}
    
if(strlen(trim($lookup[0]['element_10_24']))>0 && $lookup[0]['element_10_24'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_24'];
}
if(strlen(trim($lookup[0]['element_10_25']))>0 && $lookup[0]['element_10_25'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_25'];
}
    
if(strlen(trim($lookup[0]['element_10_26']))>0 && $lookup[0]['element_10_26'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_26'];
}
if(strlen(trim($lookup[0]['element_10_27']))>0 && $lookup[0]['element_10_27'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_27'];
}
    
if(strlen(trim($lookup[0]['element_10_28']))>0 && $lookup[0]['element_10_28'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_28'];
}   
       
if(strlen(trim($lookup[0]['element_10_29']))>0 && $lookup[0]['element_10_29'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_29'];
}   

if(strlen(trim($lookup[0]['element_10_30']))>0 && $lookup[0]['element_10_30'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_30'];
}   

if(strlen(trim($lookup[0]['element_10_32']))>0 && $lookup[0]['element_10_32'] !=0){
    $_SESSION['division'][]= $lookup[0]['element_10_32'];
}       
print_r($_SESSION['division']);
?>