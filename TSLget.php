<?php
//echo $_GET['Req_ID'];

ini_set("display_errors",1);
include "protected/global.php";


    $test = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE ap_form_43256.id =$_GET[Req_ID]");



if(count($test)>0){
    echo "<pre>";
    //var_dump($test);
    echo "</pre>";
    
    switch($test[0]['element_114']){//requestor
        case "1":
            $requestor = "Johnny";
            break;
        case "2":
            $requestor = "Mario";
            break;
        case "3":
            $requestor = "Other";
            break;
       // case "7":
       //     $requestor = "Arturo";
       //    break;
       // case "8":
       //     $requestor = "Baltazar S";
       //     break;
       // case "9":
       //     $requestor = "Bernie";
       //     break;
       // case "10":
       //     $requestor = "Carlos N";
       //     break;
       // case "11":
       //     $requestor = "Danny Chiang";
       //     break;
       // case "12":
       //     $requestor = "Erasmo R";
       //     break;
       // case "13":
       //     $requestor = "Estevan";
       //     break;
       // case "14":
       //     $requestor = "Hector";
       //     break;
       //     case "15":
       //     $requestor = "Jose Rivera";
       //     break;
       //     case "16":
       //     $requestor = "Juan Herndandez";
       //     break;
       //     case "17":
       //     $requestor = "Lee Munoz";
       //     break;
       //     case "18":
       //     $requestor = "Luis Garcia";
       //     break;
       //     case "19":
       //     $requestor = "Mario";
       //     break;
       //     case "20":
       //     $requestor = "Miguel";
       //     break;
       //     case "21":
       //     $requestor = "Octavio Z";
       //     break;
       //     case "22":
       //     $requestor = "Pablo";
       //     break;
       //     case "23":
       //     $requestor = "Piri";
       //     break;
       //     case "24":
       //     $requestor = "Ramon H";
       //     break;            
       //     case "26":
       //     $requestor = "Other";
       //     break;
      //  
    }
    
    switch($test[0]['element_1']){
        case "1":
            $area = $test[0]['element_16'];
            $type =$test[0]['element_14'];
            $tank ="";
            $snumber ="";
            $wtn=$test[0]['element_19'];
            $inbwtn=$test[0]['element_116'];
            $release=$test[0]['element_24'];
            $note=$test[0]['element_25'];
        break;
        case "2":
            $area = $test[0]['element_40'];
            $number ="";
            $type =$test[0]['element_38'];
            $tank = $test[0]['element_48'];
            $snumber="";
            $wtn=$test[0]['element_43'];
            $inbwtn=$test[0]['element_124'];
            $release="";
            $note=$test[0]['element_49'];
        break;
        case "3":
            $area= $test[0]['element_26'];
            $number ="";
            $type =$test[0]['element_28'];
            $tank ="";
            $snumber=$test[0]['element_36'];
            $wtn=$test[0]['element_31'];
            $inbwtn=$test[0]['element_120'];
            $release="";
            $note=$test[0]['element_37'];
        break;
        case "4":
            $area = $test[0]['element_64'];
            $number ="";
            $type = $test[0]['element_62'];
            $tank ="";
            $snumber=$test[0]['element_73'];
            $wtn= $test[0]['element_67'];
            $inbwtn="";
            $release=$test[0]['element_72'];
            $note=$test[0]['element_74'];
        break;
        case "5":
            $area = $test[0]['element_77'];
            $number ="";
            $type =$test[0]['element_75'];
            $tank = "";
            $snumber=$test[0]['element_86'];
            $wtn=$test[0]['element_80'];
            $inbwtn="";
            $release=$test[0]['element_85'];
            $note=$test[0]['element_111'];
        break;
        case "6":
            $area = $test[0]['element_90'];
            $number ="";
            $type =$test[0]['element_88'];
            $tank = "";
            $snumber="";
            $wtn=$test[0]['element_93'];
            $inbwtn="";
            $release="";
            $note=$test[0]['element_87'];
        break;
        case "7":
            $area = $test[0]['element_102'];
            $number ="";
            $type =$test[0]['element_100'];
            $tank = $test[0]['element_112'];
            $snumber="";
            $wtn=$test[0]['element_105'];
            $inbwtn="";
            $release=$test[0]['element_110'];
            $note=$test[0]['element_113'];
        break;
        case "8":
            $area = $test[0]['element_50'];
            $number ="";
            $type ="Reclaimed Water";
            $tank = $test[0]['element_60'];
            $snumber="";
            $wtn=$test[0]['element_55'];
            $inbwtn="";
            $release="";
            $note=$test[0]['element_61'];
        break;
        case 9:
            $area = $test[0]['element_131'];
            $number ="";
            $type =$test[0]['element_23'];
            $tank = "";
            $snumber=$test[0]['element_24'];
            $wtn="";
            $inbwtn="";
            $release="";
            $note="";
        break;
    }
    
    
    
    $package = array(
        "element_76"=>$_GET['Req_ID'],
        "date_created"=>$test[0]['date_created'],
        "ip_address"=>$test[0]['ip_address'],       
        "status"=>$test[0]['status'],
        "element_3"=>$test[0]['element_4'],
        "element_8"=>$test[0]['element_2'],
        "element_9"=>$test[0]['element_3'],
        "element_10"=>$requestor,
        "element_13"=>$tank,
        "element_11"=>$area,
        "element_12"=>$type,
        "element_14"=>$snumber,
        "element_82"=>$release,
        "element_83"=>$inbwtn,
        "element_84"=>$note,
        "element_77"=>$wtn,
        "source"=>"from_tcl",
        "element_81"=>4
        
    );
}

switch($test[0]['element_1']){
    case 9:
    $pet_package = array (       
        "truck_id"=>$_GET['Req_ID'],
        "date"=>$test[0]['date_created'],
        "test_status"=>$test[0]['element_4'],
        "created_by"=>$test[0]['element_114'],
        "created_by_other_first"=>$test[0]['element_5_1'],
        "created_by_other_last"=>$test[0]['element_5_2'],
        "sub_categ"=>$test[0]['element_1'],
        "commodity"=>$test[0]['element_129'],
        "ship_from"=>$test[0]['element_131'],
        "net_weight"=>$test[0]['element_133'],
        "weight_ticket"=>$test[0]['element_134'],
        "carrier"=>$test[0]['element_135'],
        "driver"=>$test[0]['element_137'],
        "pickup"=>$test[0]['element_142'],
        "trailer"=>$test[0]['element_140'],
        "notes"=>$test[0]['element_141']
    );
    print_r($pet_package);
    $db->insert("Inetforms.pet_food",$pet_package);
    break;
    default:
     $db->insert("Inetforms.ap_form_44342",$package);
    break;
}



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
<a href='https://inet.iwpusa.com/TSL.php'>Click here</a>
</br>
to start a new entry
</br>
</br>
</br>
<a href='https://inet.iwpusa.com/CompletedIO.php'>Click here to View COMPLETED Loads Dashboard</a>
</br>
<a href='https://inet.iwpusa.com/PendingTests.php'>Click here to View PENDING Lab Tests</a>";


?>
