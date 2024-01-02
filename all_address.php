<?php
include "protected/global.php";
ini_set("display_errors",1);
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return $resp['status'];
        }
         
    }else{
        return $resp['status'];
    }
}

$all = $db->query("SELECT Name,account_ID,address,city,state,zip FROM iwp_accounts WHERE status IN('New','Active')  LIMIT 0,1500");

if(count($all)>0){
    foreach($all as $run){
        $data_arr = geocode("$run[address],$run[city], $run[state] $run[zip]");
        if(count($data_arr)>1){
            echo "<br/>*************************<br/>";
            echo "$run[Name]<br/>";
            $formatted_address = $data_arr[2];
            echo "Proper Address:".$formatted_address."<br/>"; 
            $buffer = explode(",",$formatted_address);
               
            echo "address: ".trim($buffer[0])."<br/>";
            echo "city: ".trim($buffer[1])."<br/>";
            $city_zip = explode(" ",trim($buffer[2]));
            echo "state: ".trim($city_zip[0])."<br/>";
            echo "zip: ".trim($city_zip[1]);
            
            $db->query("UPDATE iwp_accounts SET address='$buffer[0]', city='$buffer[1]',state='$city_zip[0]',zip='$city_zip[1]' WHERE account_ID = $run[account_ID] ");
            echo "<br/>************************************<br/>";
        }else{
            echo "<br/>".$data_arr."<br/>";
        }
    }
}

?>