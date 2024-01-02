<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"  xmlns="http://www.w3.org/1999/xhtml" prefix="" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="ie ie8"  xmlns="http://www.w3.org/1999/xhtml" prefix="" lang="en-US"><![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" prefix="" lang="en-US"><!--<![endif]--><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="google-site-verification" content="FleWlL9ZQv_V7LDE9KGvz6jnWJ9MMojX61a5Bv6P_HY" />

<meta name="viewport" content="width=device-width" />
<style type="text/css">
.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{
    font-weight:400
}
@media print {  
    .gm-style .gmnoprint, .gmnoprint {    display:none  }
}@media screen {  
    .gm-style .gmnoscreen, .gmnoscreen {   
        display:none  }
}
.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{
    font-size:10px
}
.gm-style {
    font: 400 11px Roboto, Arial, sans-serif;text-decoration: none;
 }
 .gm-style img { 
    max-width: none;
 }
 #map_wrapper {
    height: 400px;
}
body{
    margin:10px 10px 10px 10px;
    padding:10px 10px 10px 10px;
}
#map_canvas {
    width: 100%;
    height: 100%;
}
</style>


<meta name="viewport" content="width=device-width"/>
      
 
<!-- END Metadata added by the Add-Meta-Tags WordPress plugin -->


<body class="playground-template-default single single-playground postid-44">
<?php
include "protected/global.php";
ini_set("display_errors",1);
$schedule_table = $dbprefix."_scheduled_routes";
$account_table = $dbprefix."_accounts";
$person = new Person();


//Should grab the lat/long of the address
function get_lat_long($address){
    $region = "US";
    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU");
    $json = json_decode($json);

    if(isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'})){
        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        return $lat.','.$long;
    } else {
        echo "Account " . $address . "Not Showing Up<br>";
    }


}

if(isset($_GET['route_id']) ||  isset($_POST['route_id'])){

    include "source/header.php";
    include "source/css.php";
    $route_id_Get = trim($_GET['route_id']);
    $request = $db->query("SELECT account_numbers, route_id, recieving_facility, facility_address,truck FROM iwp_ikg_manifest_info WHERE route_id = $route_id_Get;");

    if(isset($_GET['reorder'])){


        //Replace | with commas
        $account_ids_commas = str_replace("|", ",", $request[0]['account_numbers']);

        //Remove last comma so I can query with the account ids
        //Returns string
        $account_ids_commas = substr($account_ids_commas, 0, -1);

        $account_order = explode(",",$account_ids_commas);

        $accounts_reverse = array_reverse($account_order);

        $account_reorder_final = "";
        foreach($accounts_reverse as $reversed){
            $account_reorder_final .= $reversed . "|";

        }

       // echo $request[0]['account_numbers'];
       // echo"<br>";

        //echo $account_reorder_final;

        //echo "<br>";

        $update_sql = "UPDATE iwp_ikg_manifest_info SET account_numbers = '" . $account_reorder_final . "' WHERE route_id = " . $_GET['route_id'];

        //echo $update_sql;

        $db->query("$update_sql");

       // $reorder_final = $db->query("SELECT account_numbers from iwp_ikg_manifest_info WHERE route_id = $_GET[route_id]");

    }



    echo "<h3>Route Optimizer 2020</h3>";

    //Re order a route A-Z
    echo "<form action='maproutificstops.php' method='get' >";
    echo "<input  type='hidden' name='route_id' value='" . $_GET['route_id'] . "'>";
    echo "<input  type='hidden' name='reorder' value=1>";
    echo "<input  type='hidden' name='task' value='maproute'>";
    echo '<input type="submit" value="Reverse Route"/>';
    echo "</form>";
    echo "<form action='map_routific_stops.php' method='post' target='_blank'>";



    $iterator = 1;
    if(count($request) > 0 ){




        if(isset($_GET['reorder'])){


            //Replace | with commas
            $account_ids_commas = str_replace("|", ",", $request[0]['account_numbers']);

            //Remove last comma so I can query with the account ids
            //Returns string
            $account_ids_commas = substr($account_ids_commas, 0, -1);

            $account_order = explode(",",$account_ids_commas);

            //echo $account_order . "<br>";

            //echo array_reverse($account_order);




        }


        echo "<table><tr>";

        echo "<td>Starting Facility</td>";

        echo "<td>";
                    if(isset($_POST['starting_facility'])){
                        getFacilityList("starting_facility",$_POST['starting_facility']);
                        $starting_facility = trim($facils[$_POST['starting_facility']]);
                        $starting_facility = str_replace(",","",$starting_facility);
                        $starting_facility = str_replace(" ","+",$starting_facility);
                    } else {
                        getFacilityList("starting_facility",$request[0]['recieving_facility']);
                        $starting_facility = trim($request[0]['facility_address']);
                        $starting_facility = str_replace(",","",$starting_facility);
                        $starting_facility = str_replace(" ","+",$starting_facility);
                    }
        echo "</td>";
        echo "</tr>";

        echo "<tr><td>Ending Facility</td><td>";

        if(isset($_POST['ending_facility'])){
            getFacilityList("starting_facility",$_POST['ending_facility']);
            $ending_facility = trim($facils[$_POST['ending_facility']]);
            $ending_facility = str_replace(",","",$ending_facility);
            $ending_facility = str_replace(" ","+",$ending_facility);
        } else {
            getFacilityList("starting_facility",$request[0]['recieving_facility']);
            $ending_facility = trim($request[0]['facility_address']);
            $ending_facility = str_replace(",","",$ending_facility);
            $ending_facility = str_replace(" ","+",$ending_facility);
        }


        echo "</td></tr></table>";
        $starting_facility_testing = trim($facils[$request[0]['recieving_facility']]);



        $address_being_used_final = urlencode($starting_facility);
        //$ac_name = str_replace("'","",$account_info_request[0]['name']);
        $latlong  =  get_lat_long($address_being_used_final);
        $map        =   explode(',' ,$latlong);
        $mapLat         =   $map[0];
        $mapLong    =   $map[1];
        $plothese[] = array (
            0=>$mapLat.",".$mapLong,
            1=>'<input type="checkbox" class="" rel="" xlr=""/>&nbsp;~'.$iterator.'~' . "starting",
            2=>"starting"
        );




        //Replace | with commas
        $account_ids_commas = str_replace("|", ",", $request[0]['account_numbers']);

        //Remove last comma so I can query with the account ids
        //Returns string
        $account_ids_commas = substr($account_ids_commas, 0, -1);

        $account_order = explode(",",$account_ids_commas);
        $account_info_request = $db->query("SELECT account_ID,
                                                    city,
                                                    state,
                                                    address,
                                                    country,
                                                    zip,
                                                    name,
                                                    latitude,
                                                    longitude
                                                     FROM iwp_accounts WHERE account_ID IN ($account_ids_commas)");

        echo "Count of stops" . count($account_info_request);

        foreach($account_order as $account_info){

            $account_info = trim($account_info);

            $account_info_request = $db->query("SELECT account_ID,
                                                    city,
                                                    state,
                                                    address,
                                                    country,
                                                    zip,
                                                    name,
                                                    latitude,
                                                    longitude
                                                     FROM iwp_accounts WHERE account_ID = '$account_info';");

            $iterator++;
            $address_stripped = str_replace(" ","+",$account_info_request[0]['address']);
            $address_stripped_final = str_replace(".", "",$address_stripped);

            $address_being_used =  $address_stripped_final . "+" . trim($account_info_request[0]['city']) . "+" . $account_info_request[0]['state'];
            //echo "https://maps.google.com/maps/api/geocode/json?address=" . $address_being_used. "&sensor=false&region=US&key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU";


            if( strlen($account_info_request[0]['latitude'])>0 && strlen($account_info_request[0]['longitude'])>0   && ($account_info_request[0]['latitude'] !=0 && $account_info_request[0]['longitude'] !=0)  ){
                //echo $Address."<br/>";
                $ac_name = str_replace("'","",$account_info_request[0]['name']);
                $plothese[] = array (
                    0=>$account_info_request[0]['latitude'].",".$account_info_request[0]['longitude'],
                    1=>'<input type="checkbox" class="" rel="" xlr=""/>~' . $iterator . "~" . $ac_name,
                    2=>$ac_name
                );
            } else {
                //echo $address_being_used;
                $address_being_used_final = urlencode($address_being_used);
                $ac_name = str_replace("'","",$account_info_request[0]['name']);
                $latlong  =  get_lat_long($address_being_used_final);
                $map        =   explode(',' ,$latlong);
                $mapLat         =   $map[0];
                $mapLong    =   $map[1];
                $plothese[] = array (
                    0=>$mapLat.",".$mapLong,
                    1=>'<input type="checkbox" class="" rel="" xlr=""/>&nbsp;~'.$iterator.'~' . $ac_name,
                    2=>$ac_name
                );

            }




        }



//        foreach($account_info_request as $account_info){
//            $iterator++;
//            $address_stripped = str_replace(" ","+",$account_info['address']);
//            $address_stripped_final = str_replace(".", "",$address_stripped);
//
//            $address_being_used =  $address_stripped_final . "+" . trim($account_info['city']) . "+" . $account_info['state'];
//            //echo "https://maps.google.com/maps/api/geocode/json?address=" . $address_being_used. "&sensor=false&region=US&key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU";
//
//
//            if( strlen($account_info['latitude'])>0 && strlen($account_info['longitude'])>0   && ($account_info['latitude'] !=0 && $account_info['longitude'] !=0)  ){
//                //echo $Address."<br/>";
//                $ac_name = str_replace("'","",$account_info['name']);
//                $plothese[] = array (
//                    0=>$account_info['latitude'].",".$account_info['longitude'],
//                    1=>'<input type="checkbox" class="" rel="" xlr=""/>~' . $iterator . "~" . $ac_name,
//                    2=>$ac_name
//                );
//            } else {
//                //echo $address_being_used;
//                $address_being_used_final = urlencode($address_being_used);
//                $ac_name = str_replace("'","",$account_info['name']);
//                $latlong  =  get_lat_long($address_being_used_final);
//                $map        =   explode(',' ,$latlong);
//                $mapLat         =   $map[0];
//                $mapLong    =   $map[1];
//                $plothese[] = array (
//                    0=>$mapLat.",".$mapLong,
//                    1=>'<input type="checkbox" class="" rel="" xlr=""/>&nbsp;~'.$iterator.'~' . $ac_name,
//                    2=>$ac_name
//                );
//
//            }
//
//
//
//
//        }

        echo "Final Iterator" . $iterator;

    }



}



$last = "";

$list ="";
foreach($plothese as $plot){
    $list[] = "['$plot[1]',$plot[0]]";
}

?>
<div id="menu-">

</div>

<div id="map_wrapper">
    <div id="map_canvas" class="mapping" style="position: relative; overflow: hidden;"></div>
</div> 

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>



<script type="text/javascript">jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "//maps.googleapis.com/maps/api/js?sensor=false&callback=initialize&key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    // Multiple Markers
    var markers = [
       <?php 
        echo implode(",", $list);
       ?>
    ];
                        
    // Info Window Content
    var infoWindowContent = [
        <?php 
        echo implode(",", $list);
       ?>
    ];
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
       var name = markers[i][0].split("~");
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: name[1],  
            label:name[1],
            animation: google.maps.Animation.DROP,         
            icon: {                
                origin: new google.maps.Point(33, -111)
            }
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(8);
        google.maps.event.removeListener(boundsListener);
    });
    
}

var myarray = [];

$("body").on("click",".sched_stop",function(){
   
    var si = $(this).attr('rel');
    var ai = $(this).attr('xlr');
    if(jQuery.inArray(si, myarray) !== -1) {
       alert("Stop is already to be routed");
    } else {        
         //alert("sdfsfsd");
        $.post("grab_stop_info.php",{schedule_id:si},function(data){
            myarray.push(si);
            $("tbody#route_form").append(data);
            $(".schecheduled_ids").val( $(".schecheduled_ids").val()+si+"|");
            $(".accounts_checked").val( $(".accounts_checked").val()+ai+"|");
        });
    }
});


$("body").on("click",".remove_item",function(){
    var six = $(this).attr('rel')+"|";
    var sched_id_string = $(".schecheduled_ids").val();
    var new_sched_id_string = sched_id_string.replace(six,"");
    $(".schecheduled_ids").val(new_sched_id_string);
    var aix = $(this).attr("xlr")+'|';
    var account_id_string = $(".accounts_checked").val();
    var new_account_id_string = account_id_string.replace(aix,"");
    $(".accounts_checked").val(new_account_id_string);
    $(this).closest('tr').remove();
    myarray.splice(myarray.indexOf(six),1);
});

</script>



<script src="Placing%20multiple%20markers%20on%20a%20Google%20Map%20%28Using%20API%203%29%20__files/js"></script></body></html>