<?php
//echo $_GET['Req_ID'];

//ini_set("display_errors",0);
include "protected/global.php";

$test = $db->query("SELECT * FROM Inetforms.ap_form_47049 WHERE ap_form_47049.id =$_GET[Req_ID]");



if(count($test)>0){
   /* echo "<pre>";
    var_dump($test);
    echo "</pre>";*/
    
    switch($test[0]['element_37']){//requestor
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
            $requestor = "Abel Perez";
            break;
        case "8":
            $requestor = "Alfredo Garcia";
            break;
        case "9":
            $requestor = "Angel Cabanyog";
            break;
        case "10":
            $requestor = "Angel Fuentes";
            break;
        case "11":
            $requestor = "Angel Morales";
            break;
        case "12":
            $requestor = "Arturo Sanchez";
            break;
        case "13":
            $requestor = "Baltazar Santiago";
            break;
        case "14":
            $requestor = "Bernie Delatorre";
            break;
        case "15":
            $requestor = "Carlos Nuñez";
            break;
        case "16":
            $requestor = "Daniel Chiang";
            break;
        case "17":
            $requestor = "David Buenrostro";
            break;
        case "18":
            $requestor = "Delfino Vasquez";
            break;
        case "19":
            $requestor = "Eric Montenegro ";
            break;
        case "20":
            $requestor = "Hector Mendez";
            break;
        case "21":
            $requestor = "Juan Barrios";
            break;
        case "22":
            $requestor = "Juan Pablo Juarez";
            break;
        case "23":
            $requestor = "Lee Muñoz";
            break;
        case "24":
            $requestor = "Luis Garcia";
            break;            
        case "25":
            $requestor = "Mario Aguilar";
            break;
        case "26":
            $requestor = "Miguel Echeverria";
            break;
        case "27":
            $requestor = "Samuel Morales";
            break;
        case "31":
            $requestor = "Steven Cabrera";
            break;
        case "34":
            $requestor = "Jose Rivera";
            break;
        case "35":
            $requestor = "Lupe Venegas";
            break;
        case "36":
            $requestor = "Francisco Sanchez";
            break;
    }
    
    switch($test[0]['element_39']){
        case 1://reactor
            $area = "reactor";
            $type =$test[0]['element_42'];
            $tank =$test[0]['element_43'];
            $snumber =$test[0]['element_44'];
            $number="";
        break;
        case 2://glycerin
            $area = "glycerin";
            $number ="";
            $type =$test[0]['element_46'];
            $tank = $test[0]['element_47'];
            $snumber=$test[0]['element_48'];
        break;
        case 3://water condensor
            $area= "water codenser";
            $number ="";
            $type ="";
            $tank =$test[0]['element_50'];
            $snumber=$test[0]['element_51'];
        break;
        case 4://distillation
            $area = "distillation";
            $number ="";
            $type =$test[0]['element_53'];
            $tank = $test[0]['element_54'];
            $snumber=$test[0]['element_55'];
        break;
        case 5://wash tanks
            $area = "wash tanks";
            $number ="";
            $type =$test[0]['element_57'];
            $tank = "";
            $snumber=$test[0]['element_58'];
        break;
        case 6:// g div
            $area = "G-DIV";
            $number ="";
            $type =$test[0]['element_71'];//halftank
            $tank = $test[0]['element_60'];//tank
            $snumber=$test[0]['element_72'];//separator
        break;
        case 7:
            $area = "Day Tank";           
            $number ="";
            $type ="";
            $tank = $test[0]['element_70'];
            $snumber="";
        break;
        default :
            $area = $test[0]['element_39_other'];
            $number ="";
            $type=$test[0]['element_66'];
            $tank=$test[0]['element_68'];
            $snumber=$test[0]['element_67'];
        break;
    }
    
    
    //$test[0]['element_46']//glycerin type
    $package = array(
        "element_16"=>$_GET['Req_ID'],//operator sample request assigned id
        "date_created"=>$test[0]['date_created'],
        "ip_address"=>$test[0]['ip_address'],       
        "status"=>$test[0]['status'],
        "element_3"=>$test[0]['element_27'],//status
        "element_8"=>$test[0]['element_25'],//request date
        "element_9"=>$test[0]['element_26'],//request time
        "element_10"=>$requestor,//requestor
        "element_13"=>$tank,//tank
        "element_11"=>$area,//area
        "element_12"=>$type,//type
        "element_14"=>$snumber,//spot number
        "source"=>"from_osr",//source
        "element_81"=>4//numerical status 
        
    );
    //print_r($package);
}


/**/
if($db->insert("Inetforms.ap_form_44342",$package)){
    //echo $db->getInsertId()." pending/completed id";
    /**/echo "
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
    <a  href='https://inet.iwpusa.com/OSR2.php'   <em style='color:green;font-size:10em; > Click Here For New Entry  </em>)<</a> 
    </br>
    to start a new entry
    </br>
    </br>
    </br>
    <a href='https://inet.iwpusa.com/CompletedTests.php'>Click here to View COMPLETED Lab Tests</a>
    </br>
    <a href='https://inet.iwpusa.com/PendingTests.php'>Click here to View PENDING Lab Tests</a>";
    
    $date_time = explode(" ",date("Y-m-d H:i:s"));
    
    $db->query("UPDATE Inetforms.ap_form_47049 SET element_25 ='$date_time[0]',element_26='$date_time[1]' WHERE id= ".$test[0]['id']);
    header("Location:OSR2.php");

}

?>
<!--<meta http-equiv="refresh" content="0;URL=https://inet.iwpusa.com/OSR2.php"  />--!>


