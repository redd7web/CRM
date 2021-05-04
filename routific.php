<?php
    //include "protected/global.php";
    ini_set("display_errors",1);
    require 'vendor/autoloader.php';
    $url = 'https://api.routific.com/v1/';
use GuzzleHttpClient;
$client = new \GuzzleHttp\Client()([
        'base_uri' => $url,
    ]);

// Step 2: Prepare visits
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
$visits = array(
  "order_1" => $order1,
  "order_2" => $order2,
  "order_3" => $order3
);

// Step 3: Prepare vehicles
$vehicle1 = array(
  "start_location" => array(
    "id" => "depot",
    "name" => "800 Kingsway",
    "lat" => 49.2553636,
    "lng" => -123.0873365
));

$vehicle2 = array(
  "start_location" => array(
    "id" => "depot",
    "name" => "800 Kingsway",
    "lat" => 49.2553636,
    "lng" => -123.0873365
));

$vehicles = array(
  "vehicle_1" => $vehicle1,
  "vehicle_2" => $vehicle2,
);

// Step 4: Prepare data payload
$payload = array(
  "visits" => $visits,
  "fleet" => $vehicles
);

// Step 5: Send request
// This is your demo token
$token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmM0ZTlhZmFjNThkMzFjYTUzYTQ3MzMiLCJpYXQiOjE1NDQxNDAxMjh9.9yXAkCqcVRvdApKzhkMSd2lD0IuroGarDkleHNL6cQI';

$response = $client->post('vrp', [
  'json' => $payload,
  'headers' => [
    "Content-type" => "application/json",
    "Authorization" => "bearer " . $token
  ]
]);
echo "working?: ".$response->getBody();
    
    
?>