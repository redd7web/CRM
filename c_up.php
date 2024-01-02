<?php
ini_set("display_errors",1);
include "protected/global.php";
//Geocode facility
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Account-Creation@iwpusa.com'."\r\n".'Reply-To: No-reply@iwpusa.com'."\r\n" .'X-Mailer: PHP/' . phpversion();

if(isset($_POST['usercreate'])){
    $person = new Person();
    if(isset($_POST['account_sharing_host'])){
        $host = $_POST['account_sharing_host'];
    }else {
        $host = "host";    
    }
    
    
    if(strlen($_POST['floorvalue'])>0){
        $floor = $_POST['floorvalue'];
    } else {
        $floor = $_POST['floor_type'];
    }
    
    
    
    $data= Array(
        "status"=>$stat,
        "name"=>$_POST['accountname'],
        "class"=>99,
        "city"=>$_POST['city'],
        "state"=>$_POST['state'],
        "created"=>date("Y-m-d"),
        "expires"=>$_POST['end_date'],
        "address"=>$_POST['address'],
        "zip"=>$_POST['zipcode'],
        "billing_address"=>$_POST['billing_address'],
        "billing_state"=>$_POST['billing_state'],
        "billing_city"=>$_POST['billing_city'],
        "billing_zip"=>$_POST['billing_zip'],
        "billing_email"=>$_POST['billing_email'],
        "area_code"=>$_POST['areacode'],
        "phone"=>$_POST['phone'],
        "contact_name"=>$_POST['c_first_name']." ".$_POST['c_last_name'],
        "contact_title"=>$_POST['title'],
        "pickup_frequency"=>30,
        "payee_name"=>$_POST['payee'],
        "email_address"=>$_POST['email'],
        "original_sales_person"=>$_POST['sales_rep'],
        "account_rep"=>$_POST['sales_rep'],
        "state_date"=>$_POST['start_date'],
        "payment_method"=>$_POST['payment_type'],
        "guest_host"=>$_POST['sharing_type'],
        "url"=>$_POST['website'],
        "floor"=> $floor,
        "ppg_jacobsen_percentage"=>$_POST['changer_input'],
        "miu"=>number_format($_POST['miu']/100,2),
        "latitude"=>$mapLat,
        "longitude"=>$mapLong,
        "division"=>$_POST['facility'],
        "is_oil"=>$_POST['type1'],
        "is_trap"=>$_POST['type2'],
        "new_bos"=>$_POST['new_bos'],
        "comp_name"=>$_POST['comp_name'],
        "onsite_comp"=>$_POST['on_site'],
        "country"=>"USA",
        "accound_host_sharing"=>$_POST['accound_host_sharing'],
        "manager_bypass"=>$_POST['manager_bypass'],
        "status"=>"New",
        "origination"=>$_POST['origin']    
    );

    var_dump($data);
    $db->insert("iwp_accounts",$data);
    $id = $db->getInsertId();
    
    if (!is_dir("$id/contract/")) { // does a file folder exist for this account?
        mkdir("$id/contract/", 0777, true);
    }
    foreach ($_FILES['file']['name'] as $f => $name) {//upload the file(s) selected if multiple     
        $temp = explode(".",$_FILES["file"]["name"][$f]);
        $mod = uniqid();
        $newfilename = "contract$id$mod.".end($temp); 
        //echo $newfilename."<br/>";
        move_uploaded_file($_FILES["file"]["tmp_name"][$f], "$id/contract/".$newfilename);
    }    
    $db->query("UPDATE iwp_accounts SET contract ='$id/contract/$newfilename' WHERE account_ID =$id");
    
    
    //echo "<table>";
    
  
 //echo "<br/>account id:".$id."<br/>";
}


?>