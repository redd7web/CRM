<?php
ini_set("display_errors",1);

require 'vendor/autoloader.php';

use GuzzleHttpClient;
$url = 'https://api.routific.com/v1/vrp-long';
$client = new \GuzzleHttp\Client([
    'base_uri' => $url,
]);

$order1 = array(
    "location" => array(
        "name" => "6800 Cambie",
        "lat" => 49.227107,
        "lng" => -123.1163085
    ));
$order2 = array(
    "location" => array(
        "name" => "3780 Arbutus",
        "lat" => 49.2474624,
        "lng" => -123.1532338
    ));
$order3 = array(
    "location" => array(
        "name" => "800 Robson",
        "lat" => 49.2819229,
        "lng" => -123.1211844
    ));

$order4 = array(
    "location" => array(
        "name"=> "Routific World Headquarters",
      "address"=> "555 W Hastings Street, Vancouver, BC V6B4N6, Canada"

    )
);

$visits = array(
    "order_1" => $order1,
    "order_2" => $order2
);


$vehicle1 = array(
    "start_location" => array(
        "id" => "depot",
        "name" => "800 Kingsway",
        "lat" => 49.2553636,
        "lng" => -123.0873365
    ));
$vehicles = array(
    "vehicle_1" => $vehicle1
);

$payload = array(
    "visits" => $visits,
    "fleet" => $vehicles
);

$token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1ZjA3YWZmNDVjOGZmYTAwMTg1MGI1NmUiLCJpYXQiOjE1OTQ2NzU2ODd9.4x-aE_aDD_l2Dvx-IsqIbwfnNTpihahokYht691e3_Q';


//$response = $client->createRequest('GET', 'https://api.routific.com/v1/vrp-long', [
//    'json' => $payload,
//    'headers' => [
//        "Content-type" => "application/json",
//        "Authorization" => "bearer " . $token
//    ]
//]);

//var_dump($response);

//$response = $client->post('https://api.routific.com/v1/vrp-long', [
//    'json' => $payload,
//    'headers' => [
//        "Content-type" => "application/json",
//        "Authorization" => "bearer " . $token
//    ]
//]);

$optimized_solution = "https://api.routific.com/jobs/" . "kcl2sxbv163";

$response = $client->createRequest('GET', '$optimized_solution', [
//    'json' => $payload,
//    'headers' => [
//        "Content-type" => "application/json",
//        "Authorization" => "bearer " . $token
//    ]
]);

$response = $client->get($optimized_solution);

var_dump($response);

echo $response->getBody();




//echo var_dump($response->json());
?>