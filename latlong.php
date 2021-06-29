<?php
include "protected/global.php";

function get_lat_long($address){
        
        
        return $latitude." ".$longitude;
}


$acnts = $db->get($dbprefix."_accounts LIMIT 0,10","account_ID,address,city,state,zip,name");


if(count($acnts)>0){
    foreach($acnts as $account){
        echo $account['name']."<br/>";
        
        $address =$account['address']+" "+$account['city']+" "+$account['state']+" "+$account['zip']; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
        echo "<br/>status: ".$output->status;	
        echo "<br/>latitude - ".$latitude;
        echo "<br/>longitude - ".$longitude;
        

      
        echo"<br/><br/>";
    }
}
?>