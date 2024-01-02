
<?php
include "protected/global.php";
include "protected/Organics.class.php";
include "protected/Organics_Scheduled.class.php";
include "protected/x_organics.php";
ini_set("display_errors",0);
//echo "*************** $_POST[orders]********************";

// function to geocode address, it will return false if unable to geocode address
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



$list = explode("\n",$_POST['orders']);
array_pop($list);
array_shift($list);
array_pop($list);
$account = new Account_organics();

$ij = "";
$vis ="";
$ccnt = 1;

echo "<pre>";
print_r($list);
echo "</pre>";

foreach($list as $addy){
   if( !in_array(trim($addy),$facils)  && !in_array(trim($addy),$coords) && !preg_match("/^\s*-?\d{1,3}\.\d+,\s*\d{1,3}\.\d+\s*$/",$addy)  ){        
        echo $ccnt.") ".$account->singleField($addy,"Name")."| $addy <br/>";
        //$bx = $db->query("SELECT Name FROM iwp_accounts WHERE account_ID=$addy");
        $ij .=trim($addy)."|";
        $ccnt++;
   } 
}
$db->query("UPDATE organics.organics_ikg_manifest_info SET account_numbers='$ij' WHERE route_id = $_POST[route_id]");
echo "<br/><br/>new number string : $ij \r\n";
//echo "<br/>visual: $vis\r\n New Order Saved!";/**/

?>
