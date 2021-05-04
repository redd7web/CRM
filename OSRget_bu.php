<?php
//echo $_GET['Req_ID'];

//ini_set("display_errors",1);
include "protected/global.php";

$test = $db->query("SELECT * FROM Inetforms.ap_form_42682 WHERE ap_form_42682.id =$_GET[Req_ID]");

if(count($test)>0){
    echo "<pre>";
    //var_dump($test);
    echo "</pre>";
    
    switch($test[0]['element_2']){//requestor
        case "4":
            $requestor = "Alfredo";
            break;
        case "5":
            $requestor = "Anagel";
            break;
        case "6":
            $requestor = "Angel M";
            break;
        case "7":
            $requestor = "Arturo";
            break;
        case "8":
            $requestor = "Baltazar S";
            break;
        case "9":
            $requestor = "Bernie";
            break;
        case "10":
            $requestor = "Carlos N";
            break;
        case "11":
            $requestor = "Danny Chiang";
            break;
        case "12":
            $requestor = "Erasmo R";
            break;
        case "13":
            $requestor = "Estevan";
            break;
        case "14":
            $requestor = "Hector";
            break;
            case "15":
            $requestor = "Jose Rivera";
            break;
            case "16":
            $requestor = "Juan Herndandez";
            break;
            case "17":
            $requestor = "Lee Munoz";
            break;
            case "18":
            $requestor = "Luis Garcia";
            break;
            case "19":
            $requestor = "Mario";
            break;
            case "20":
            $requestor = "Miguel";
            break;
            case "21":
            $requestor = "Octavio Z";
            break;
            case "22":
            $requestor = "Pablo";
            break;
            case "23":
            $requestor = "Piri";
            break;
            case "24":
            $requestor = "Ramon H";
            break;            
            case "26":
            $requestor = "Other";
            break;
        
    }
    
    switch($test[0]['element_1']){
        case "1":
            $area = "reactor";
            $type =$test[0]['element_5'];
            $tank =$test[0]['element_6'];
            $snumber =$test[0]['element_7'];
            $number="";
        break;
        case "2":
            $area = "glycerin";
            $number ="";
            $type =$test[0]['element_9'];
            $tank = $test[0]['element_10'];
            $snumber=$test[0]['element_11'];
        break;
        case "3":
            $area= "water codenser";
            $number ="";
            $type =$test[0]['element_13'];
            $tank = "";
            $snumber=$test[0]['element_14'];
        break;
        case "4":
            $area = "distillation";
            $number ="";
            $type =$test[0]['element_16'];
            $tank = $test[0]['element_17'];
            $snumber=$test[0]['element_18'];
        break;
        case "5":
            $area = "wash tanks";
            $number ="";
            $type ="";
            $tank = $test[0]['element_20'];
            $snumber=$test[0]['element_21'];
        break;
        case "6":
            $area = "G-DIV";
            $number ="";
            $type ="";
            $tank = "";
            $snumber="";
        break;
        default:
            $area = $test[0]['element_1_other'];
            $number ="";
            $type =$test[0]['element_23'];
            $tank = "";
            $snumber=$test[0]['element_24'];
        break;
    }
    
    
    
    $package = array(
        "element_16"=>$_GET['Req_ID'],
        "date_created"=>$test[0]['date_created'],
        "ip_address"=>$test[0]['ip_address'],       
        "status"=>$test[0]['status'],
        "element_3"=>$test[0]['element_27'],
        "element_8"=>$test[0]['element_25'],
        "element_9"=>$test[0]['element_26'],
        "element_10"=>$requestor,
        "element_13"=>$tank,
        "element_11"=>$area,
        "element_12"=>$type,
        "element_14"=>$snumber
        
    );
}


$db->insert("Inetforms.ap_form_44342",$package);

echo "
</br>
</br>
</br>
Success! Your submission has been saved!
</br>
For your records ( <em style='color:red;font-size:1em;line-height:1'>$_GET[Req_ID]</em>)
</br>
</br>
</br>
</br>
Please  
</br>
<a href='https://inet.iwpusa.com/OSR.php'>Click here</a>
</br>
to start a new entry
</br>
</br>
</br>
<a href='https://inet.iwpusa.com/CompletedTests.php'>Click here to View COMPLETED Lab Tests</a>
</br>
<a href='https://inet.iwpusa.com/PendingTests.php'>Click here to View PENDING Lab Tests</a>";

?>
