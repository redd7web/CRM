<?php
include "protected/global.php";
ini_set("display_errors",1);
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    
    //$url = "http://maps.google.com/maps/api/geocode/json?address={$address}&key=RYEdcTxmYN7GgIMOHCvCuHL56k4";
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false";
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    return $resp;
}

$ikg = new IKG($_GET['route']);


foreach($ikg->scheduled_routes as $stops){
    $scheduled_stop = new Scheduled_Routes($stops);
    $acnt = new Account($scheduled_stop->account_number);
    $address =trim($acnt->address).", ".trim($acnt->city).", ".trim($acnt->state)." ".trim($acnt->zip)." ".trim($acnt->country)." \r\n"; 
    echo "$acnt->name_plain  ";
    $cs = geocode($address);
    echo "<pre>";
    print_r($cs);
    echo "</pre>";
}

?>