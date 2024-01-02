<?php
ini_set("display_errors",1);
include "protected/global.php";
ini_set("display_errors",1);
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

    if(isset($_POST['manager_bypass'])){
        $managerBool = 1;
    } else{
        $managerBool = 0;
    }

    $data = Array(
        //"status"=>$stat,
        "name"=>$_POST['accountname'],
        "class"=>$_POST['sales_rep'],
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
        "manager_bypass"=>$managerBool,
        "status"=>"New",
        "origination"=>$_POST['origin']    
    );
    //print_r($data);
    $db->insert("iwp_accounts",$data);
   $id = $db->getInsertId();
    //echo $id . "<br>";

    //print_r($_POST);
    //echo "After Insert<br>";
//    if(!empty($_FILES['file']['name'])){
//        //echo "Are you finding the files?";
//        if (!is_dir("$id/contract/")) { // does a file folder exist for this account?
//            mkdir("$id/contract/", 0777, true);
//        }
//        foreach ($_FILES['file']['name'] as $f => $name) {//upload the file(s) selected if multiple
//            $temp = explode(".",$_FILES["file"]["name"][$f]);
//            $mod = uniqid();
//            $newfilename = "contract$id$mod.".end($temp);
//            //echo $newfilename."<br/>";
//            move_uploaded_file($_FILES["file"]["tmp_name"][$f], "$id/contract/".$newfilename);
//        }
//        $db->query("UPDATE iwp_accounts SET contract ='$id/contract/$newfilename' WHERE account_ID =$id");
//
//    }

    if(isset($_POST['competitor_onsite_removal'])){

        echo"Before insert";

        if (isset($_POST['comeptitor_removal_name'])) {
            $competitor_name_decode_request = $db->query("SELECT name from iwp_competitors WHERE competitor_id = $_POST[comeptitor_removal_name]");
            $competitor_name_decode = $competitor_name_decode_request[0]['name'];
        } else {
            $competitor_name_decode = "N/A";
        }


        switch($_POST['facility']){
            case 5:case 10:case 11:case 12:case 13: //Selma
            $facilityIssueManager = 48;
            $managerEmail = "mpires@iwpusa.com";
            break;
            case 8:case 34:case 35:case 36:case 37:case 38:case 39:case 40:case 41:case 42:case 43:case 44:case 45:case 46:case 47:case 48:case 49:case 50: //Arizona
            $facilityIssueManager = 21;
            $managerEmail = "rparsons@iwpusa.com";
            break;
            default:
                $facilityIssueManager = 34;
                $managerEmail = "aparsons@iwpusa.com";
                break;
        }


        $issue = array(
            "account_no"=>$id,
            "date_created"=>date("Y-m-d"),
            "message"=>"Account ". account_NumtoName($id) . " created with competitor container on site by " . uNumToName($person->user_id) . "Competitor Name: " . $competitor_name_decode,
            "reported_by"=>$person->user_id,
            "issue"=>32,
            "issue_status"=>"new",
            "assigned_to"=>2030
        );

        //print_r($issue);

        $db->insert("iwp_issues", $issue);

        $competitor_container_message = "<p>Account $id has been created with a competitor container removal request.</p>
                                        <p>Competitor Company:$competitor_name_decode </p>
                                         <p>Account created by "  .uNumToName_plain($person->user_id) . "</p>
        ";
        $competitor_container_message_subject = "Account $id Competitor Container Removal Request";
        echo $competitor_container_message;



        mail("bthomas@iwpusa.com","$competitor_container_message_subject","$competitor_container_message",$headers);


    }




    
    
    //echo "<table>";
    //Any accounts made by sales Rep of All Pro will not have the utility scheduled.
if($_POST['sales_rep'] == 2065){
    echo "No utility scheduled";
} else {
    foreach ($_POST as $name => $value) { // search for container information
        $search = 'container';
        if (preg_match("/{$search}/i", $name)) {
            if (strlen(trim($value)) > 0) {
                //echo "<td>$name</td><td>$value</td></tr>";
                $j = str_replace("container", "", $name);
                for ($i = 0; $i < $value; $i++) {

                    //************insert container information without delivery date************//
                    $container_label = $db->query("SELECT container_label FROM iwp_list_of_containers WHERE container_id = $j");
                    if(count($container_label > 0)) {
                        $label = $container_label[0]['container_label'];
                    } else {
                        $label = "";
                    }
                    $ix = array(
                        "account_no" => $id,
                        "container_no" => $j,
                        "request_date" => date("Y-m-d"),
                        "container" => $label,
                        "assigned_by" => $person->user_id
                    );

                    //$db->insert("iwp_containers", $ix);
                    //echo "INSERT INTO iwp_containers VALUES($j,$id,".date("Y-m-d").")<br/>";   
                    //************insert container information without delivery date************//

                    //insert utility stop 5 days later //
                    $util = array(
                        "created_by" => $person->user_id,
                        "account_no" => $id,
                        "type_of_service" => 3,
                        "date_of_service" => addDayswithdate(date("Y-m-d"), 5),
                        "container_size" => container_amountHolds($j),
                        "container_label" => $j,
                        "route_status" => "scheduled"
                    );
                    //$db->insert("iwp_utility", $util);
                }

            }
        }
    }
}
     
    if(isset($_POST['manager_bypass'])){
        //mail("disen@iwpusa.com,AKramer@iwpusa.com","Account created without contract $_POST[accountname]","Account $_POST[accountname] created by ".uNumToName($person->user_id),$headers);
         
        $issue = array(
            "account_no"=>$id,
            "date_created"=>date("Y-m-d"),
            "message"=>"Account ".account_NumToName($id)." created without a contract uploaded by ".uNumToName($person->user_id),
            "assigned_to"=>2059,
            "reported_by"=>$person->user_id,
            "issue"=>92,
            "issue_status"=>'active'
        );
        //$db->insert("iwp_issues",$issue);
    }
    
    //header("Location:viewAccount.php?id=$id");



}

 



    

?>