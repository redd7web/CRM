<?php
include "protected/global.php";
function get_lat_long($address){
    $region = "US";
    $address = str_replace(" ", "+", $address);
    
    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    return $lat.','.$long;
}
$fix = $db->query("SELECT name,address,city,state,zip FROM iwp_accounts WHERE longitude = 0 AND latitude = 0 AND address IS NOT NULL AND city IS NOT NULL and state IS NOT NULL AND zip IS NOT NULL AND address !=''");

if(count($fix)>0){
    foreach($fix as $kl){
           $coords = get_lat_long("$kl[address]");
            $map   =   explode(',' ,$coords);
            $mapLat     =   $map[0];
            $mapLong    =   $map[1];
           echo "$kl[name] Latitude: $mapLat Longitude: $mapLong<br/><br/>";
           
    }
}

?>