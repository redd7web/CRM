<?php

include "protected/global.php";
require 'vendor/autoloader.php';
use GuzzleHttpClient;

ini_set("display_errors",1);

if(isset($_SESSION['id'])) {
    if (isset($_POST['rid']) && strlen(trim($_POST['rid']))>0) {

        $route_id_Post = trim($_POST['rid']);

        $url = 'https://api.routific.com/v1/vrp-long';
        $client = new \GuzzleHttp\Client([
            'base_uri' => $url,
        ]);

        //Get Account numbers for route
        $request = $db->query("SELECT account_numbers, route_id, recieving_facility, facility_address,truck FROM iwp_ikg_manifest_info WHERE route_id = $route_id_Post;");

        if (count($request) > 0) {

            //Replace | with commas
            $account_ids_commas = str_replace("|", ",", $request[0]['account_numbers']);

            //Remove last comma so I can query with the account ids
            //Returns string
            $account_ids_commas = substr($account_ids_commas, 0, -1);

            $account_info_request = $db->query("SELECT account_ID,
                                                    city,
                                                    state,
                                                    address,
                                                    country,
                                                    zip,
                                                    name
                                                     FROM iwp_accounts WHERE account_ID IN ($account_ids_commas)");

            $count = 0;
            $visits = array();
            foreach ($account_info_request as $account_info) {

                $count = $count + 1;

                $order = "order_";

                $variable_name = $order . $count;
                //Format address
                $account_address_format = str_replace(".", "", $account_info['address']) . ", " . $account_info['city'] . ", " . $account_info['state'] . " " . $account_info['zip'];

                $$variable_name = array(
                    "location" => array(
                        //Cannot pass account number only through
                        "name" => $account_info['account_ID'] . "~" . $account_info['name'],
                        "address" => $account_address_format
                    )
                );

                $visits[$variable_name] = $$variable_name;

            }

            //print_r($visits);
//echo "<br><br>";
//        $vehicle1 = array(
//            "start_location" => array(
//                "id" => "depot",
//                "name" => $request[0]['truck'],
//                "address" => $request[0]['facility_address']
////                    "lat" => 49.2553636,
////                    "lng" => -123.0873365
//            ));


            $vehicle1 = array(
                "start_location" => array(
                    "id" => "depot",
                    "name" => "Truck 1",
                    "address" => $request[0]['facility_address']
                ));

            $vehicles = array(
                "vehicle_1" => $vehicle1
            );

            $payload = array(
                "visits" => $visits,
                "fleet" => $vehicles
            );

            $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1ZjA3YWZmNDVjOGZmYTAwMTg1MGI1NmUiLCJpYXQiOjE1OTQ2NzU2ODd9.4x-aE_aDD_l2Dvx-IsqIbwfnNTpihahokYht691e3_Q';

            $response = $client->post('https://api.routific.com/v1/vrp-long', [
                'json' => $payload,
                'headers' => [
                    "Content-type" => "application/json",
                    "Authorization" => "bearer " . $token
                ]
            ]);

            $job_id = $response->getBody();

            $job_id_json_decode = json_decode($job_id, true);

            $optimized_solution = "https://api.routific.com/jobs/" . $job_id_json_decode['job_id'];

            //Establish new connection to the job url
            //Routific makes the job id, then you need to pass the job id as a get variable to get the order
            $url = 'https://api.routific.com/jobs/';

            $clientNew = new \GuzzleHttp\Client([
                'base_uri' => $url,
            ]);


            //Wait for optimizer to finish
            //TO DO make a better way to handle waiting for the waiting, concerned if optmizer will take more than 5 seconds
            sleep(35);
            $responseOptimized = $clientNew->get("$optimized_solution");

            $responseOptimizedBody = json_decode($responseOptimized->getBody(), 'JSON_OBJECT_AS_ARRAY');

            if (!isset($responseOptimizedBody['output'])) {
                $subject = "Optmized Route Took Too Long: " . $request[0]['route_id'];
                mail("bthomas@iwpusa.com", $subject,"Route Took Too long to optmize, no order sent back" );
                echo "Optimized Solution Took Too Long";
            } else {
                $output = $responseOptimizedBody['output'];

                $solutionOutput = $output['solution'];
                $solution_array = array();

                $truck_check = 0;
                $account_numbers = "";

                foreach ($solutionOutput as $value) {
                    foreach ($value as $solution) {
                        if ($truck_check < 1) {
                            $truck_check++;
                        } else {
                            $split_name = explode("~", $solution['location_name']);
                            array_push($solution_array, $split_name[0]);
                            $account_numbers .= $split_name[0] . "|";
                        }

                    }

                }


                $subject = "Route: " . $request[0]['route_id'] . " Optimized Solution";

                $message = "Original Account Number Order: " . $request[0]['account_numbers'];
                $message .= "<br>Optmized Account Order: " . $account_numbers;

                mail("bthomas@iwpusa.com", $subject, $message);
//                echo "Original Account Number Order: " . $request[0]['account_numbers'];
//                echo "<br>";
//                echo "Optmized Account Order: " . $account_numbers;
//                echo "<br> SQL to update<br>";
                $route_id = $request[0]['route_id'];

                echo "Route Has Been Optmized";


                $sql = "UPDATE iwp_ikg_manifest_info SET account_numbers = '$account_numbers' WHERE route_id = $route_id";
                //echo $sql;

                $db->query($sql);


            }
        }
    }
} else {
    echo "<a href='https://inet.iwpusa.com/home.php'>Click Here To Log Back In</a>";
}
