<?php

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
    
    
    
    foreach ($data as $name=>$value){
        echo $name.",";
    }



?>