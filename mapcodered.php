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
ini_set("display_errors",0);
$schedule_table = $dbprefix."_scheduled_routes";
$account_table = $dbprefix."_accounts";
$person = new Person();
function get_lat_long($address){
    $region = "US";
    $address = str_replace(" ", "+", $address);
    
    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU");
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    return $lat.','.$long;
}



if(isset($_POST['facs']) && strlen(trim($_POST['facs']))>0){
    $first = explode("|","$_POST[facs]");
    array_pop($first);
    $fac = implode(",",$first);
}else{
    if($person->facility  !=99){
        $fac =$person->facility ;
    }else {
        $fac = " 24,31,32,33,34";
    }

}




$full = $db->query("SELECT 
    $schedule_table.*,
    $account_table.status ,
    $account_table.name ,
    $account_table.account_ID,
    $account_table.address,
    $account_table.city,
    $account_table.state,
    $account_table.division,
    $account_table.zip,
    $schedule_table.code_red,
    $account_table.latitude,
    $account_table.longitude,
    $account_table.avg_gallons_per_Month/$account_table.barrel_capacity as perc
    FROM $schedule_table INNER JOIN $account_table ON $schedule_table.account_no = $account_table.account_ID WHERE 
    route_status='scheduled'  && $account_table.division IN ($fac) && $schedule_table.code_red=1");    




if(count($full)>0){
    $account = new Account();
    foreach($full as $scheduled){
        
       
       $real_prec = 100*$scheduled['perc'];
       if( strlen($scheduled['latitude'])>0 && strlen($scheduled['longitude'])>0   && ($scheduled['latitude'] !=0 && $scheduled['longitude'] !=0)  ){           
           //echo $Address."<br/>";
           $ac_name = str_replace("'","",$scheduled['name']);
           $plothese[] = array (
                0=>$scheduled['latitude'].",".$scheduled['longitude'],
                1=>'<input type="checkbox" class="sched_stop" rel="'.$scheduled['schedule_id'].'" xlr="'.$scheduled['account_ID'].'"/>&nbsp;~'.$ac_name.'~<br/>Pickup Date:'.$scheduled['scheduled_start_date'].'<br/>Oil Level: %'.number_format($real_prec,2),
                2=>$ac_name
           );
       }
       else {
            if($scheduled['address'] !="" && strlen($scheduled['address'])>0){
                $ac_name = str_replace("'","",$scheduled['name']);
                $latlong  =  get_lat_long($scheduled['address']);
                $map        =   explode(',' ,$latlong);
                $mapLat         =   $map[0];
                $mapLong    =   $map[1]; 
                $plothese[] = array (
                    0=>$mapLat.",".$mapLong,
                    1=>'<input type="checkbox" class="sched_stop" rel="'.$scheduled['schedule_id'].'" xlr="'.$scheduled['account_ID'].'"/>&nbsp;~'.$ac_name.'~<br/>Pickup Date:'.$scheduled['scheduled_start_date'].'<br/>Oil Level: %'.number_format($real_prec,2),
                    2=>$ac_name
               );
            }
       }
       
    }     
}

$last = "";

$list ="";
foreach($plothese as $plot){
    $list[] = "['$plot[1]',$plot[0]]";
}

?>
<h3>Please hover overo Map Marker to view Stop name, Click on Map Marker to view pickup date, oil level and click on checkbox to route stop.</h3>
<div id="map_wrapper">
    <div id="map_canvas" class="mapping" style="position: relative; overflow: hidden;"></div>
</div> 

<form action="oil_routing.php" method="post" target="_blank">
<table style="width: 50%;margin:auto;table-layout:fixed;">
    <thead>
        <tr>
            <td>Account Name</td>
            <td>Schedule Id</td>
            <td>Pickup Date</td>
            <td style="width: 5%;">&nbsp;</td>
        </tr>
    </thead>
    <tbody id="route_form"></tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align: right;">
                <input type="hidden" class="schecheduled_ids" name="schecheduled_ids"/>
                <input type="hidden" class="accounts_checked" name="accounts_checked"/>
                <input type="hidden"  name="from_schoipu" value="1" readonly=""/>
                <input type="submit" value="Create Route"/>
            </td>
        </tr>
    </tfoot>
</table>
</form>
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