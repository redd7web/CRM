<?php
include "protected/global.php";
session_start();


// function to geocode address, it will return false if unable to geocode address

function clean($string) {
   $string = str_replace(' ', ' ', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/',' ', $string); // Removes special chars.
}


if(isset($_GET['type'])){
    switch($_GET['type']){
        case "oil":
        $ikg = new IKG($_GET['route']);
        break;
        case "util":
        $ikg = new Container_Route($_GET['route']);
        break;
        case "organics":
        ini_set("display_errors",0);
        include "protected/Organics.class.php";
        include "protected/Organics_Scheduled.class.php";
        include "protected/x_organics.php";
        $ikg = new Organics_Route($_GET['route']);
        break;
    }
    
    
    function get_lat_long($address){
        $region = "US";
        $address = urlencode($address);
        $address = str_replace(" ", "+", $address);
        
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU");
        $json = json_decode($json);
    

        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        return $lat.','.$long;
    }
    
    
    
    
    
    $latlong    =   get_lat_long("$ikg->address"); // create a function with the name "get_lat_long" given as below
    $map        =   explode(',' ,$latlong);
    array_pop($map);
    $mapLat         =   $map[0];
    $mapLong    =   $map[1]; 
    //print_r($gt);
    
    $addrTable=array();
    $nameTable=array();
    $num = 0;
    while (isset($_GET['loc' . $num])) {
      $loc = $_GET['loc' . $num];
      if ($loc == "") {
        break;
      }
      $addrTable[] = $loc;
      $num++;
    }
    for ($numName = 0; $numName < $num; $numName++) {
      $nameTable[$numName] = '';
      if (isset($_GET['name' . $numName])) {
        $nameTable[$numName] = $_GET['name' . $numName];
      }
    }
    $lat;
    $lng;
    if (isset($_GET['center'])) {
      $loc = $_GET['center'];
      if (eregi("\(\s*\-?([0-9]+|[0-9]*\.[0-9]+),\s*\-?([0-9]+|[0-9]*\.[0-9]+)\)",
    	    $loc)) {
        $latLngArr = split("[\s,\)\(]+",$loc);
        $lat = $mapLat;
        $lng = $mapLong;
      }
    } 

}
$zoom = 8;
if (isset($_GET['zoom'])) {
  $zoom = $_GET['zoom'];
}
$mode = 0;
if (isset($_GET['mode'])) {
  $mode = $_GET['mode'];
}
$walk = 0;
if (isset($_GET['walk'])) {
  $walk = $_GET['walk'];
}
$bike = 0;
if (isset($_GET['bike'])) {
  $bike = $_GET['bike'];
}
$avoid = 0;
if (isset($_GET['avoid'])) {
  $avoid = $_GET['avoid'];
}
$avoidTolls = 0;
if (isset($_GET['avoidTolls'])) {
  $avoidTolls = $_GET['avoidTolls'];
}
$hidePoll1 = true;
if (isset($_COOKIE['poll1Hidden'])) {
  $hidePoll1 = true;
}
$hidePoll2 = false;
if (isset($_COOKIE['poll2Hidden'])) {
  $hidePoll2 = true;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" itemscope itemtype="http://schema.org/Product">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>


<meta name="google-site-verification" content="FleWlL9ZQv_V7LDE9KGvz6jnWJ9MMojX61a5Bv6P_HY" />

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title>Multiple Destination Route Planner for Google Maps</title>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU&callback=initMap"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="plugins/shadow/shadowbox.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/BpTspSolver.js"></script>
<script type="text/javascript" src="js/directions-export.js"></script>
<script type="text/javascript" src="js/tsp.js"></script>
<link type="text/css" rel="stylesheet" href="plugins/shadow/shadowbox.css" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/print.css" type="text/css" media="print"/>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

<script type="text/javascript">
  jQuery.noConflict();
  Shadowbox.init({
        showOverlay:true,
        modal:false, 
        loadingImage:"shadow/loading.gif",
        displayNav: true,
        slideshowDelay: 2,        
        overlayOpacity: '0.9',
        overlayColor:"#FFFFFF",
        gallery: "gall" ,
            
    });
  function onBodyLoad() {
    google.load("maps", "3", {callback: init, other_params:"key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU&libraries=places"});
    
  }
  function init() {
  <?php
    if (isset($lat) && isset($lng)) {
      echo "\tloadAtStart(" . $mapLat . ", " . $mapLong . ", " . $zoom . ");\n";
    } else {
      echo "\tif (google.loader.ClientLocation != null) {\n";
      echo "\t\tlatLng = new google.maps.LatLng(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude);\n";
      echo "\t\tloadAtStart(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude, " . $zoom . ");\n";
      echo "\t} else {\n";
//$lat = "37.4419";
//$lng = "-122.1419";
      echo "\t\tloadAtStart(37.4419, -122.1419, " . $zoom . ");\n";
      echo "\t}\n";
    }
  for ($i = 1; $i < count($addrTable); $i++) {
    echo "\taddAddressAndLabel('"
        . $addrTable[$i] . "', '" . $nameTable[$i] . "');\n";
  }
  if (count($addrTable) > 0) {
    $walkStr = ($walk == 0) ? "false" : "true";
    $bikeStr = ($bike == 0) ? "false" : "true";
    $avoidStr = ($avoid == 0) ? "false" : "true";
    $avoidTollsStr = ($avoidTolls == 0) ? "false" : "true";
    echo "\tdirections(" . $mode . ", " . $walkStr . ", ". $bikeStr . ", " . $avoidStr . ", " . $avoidTollsStr . ");\n";
  }
  ?>
}



function toggle(divId) {
  var divObj = document.getElementById(divId);
  if (divObj.innerHTML == "") {
    divObj.innerHTML = document.getElementById(divId + "_hidden").innerHTML;
    document.getElementById(divId + "_hidden").innerHTML = "";

  } else {
    document.getElementById(divId + "_hidden").innerHTML = divObj.innerHTML;
    divObj.innerHTML = "";

  }
}
function setPollHidden() {
  jQuery('.poll').hide();
  jQuery.cookie('poll2Hidden', 'true', { path: '/', expires: 365 });
}


jQuery(function() {
  jQuery( "#accordion" ).accordion({
    collapsible: true,
	autoHeight: false,
	clearStyle: true
  });
  jQuery("input:button").button();
  jQuery("#dialogProgress" ).dialog({
    height: 140,
	modal: true,
	autoOpen: false
  });
  jQuery("#progressBar").progressbar({ value: 0 });
  jQuery("#dialogTomTom" ).dialog({
    height: 480,
	width: 640,
	modal: true,
	autoOpen: false
  });
  jQuery("#dialogGarmin" ).dialog({
    height: 480,
	width: 640,
	modal: true,
	autoOpen: false
  });
  jQuery('.myMap').height(jQuery(window).height() - 100);
  
  
});
(function() {
  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
  po.src = 'https://apis.google.com/js/plusone.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
<script type="text/javascript">
/* <![CDATA[ */
    (function() {
        var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'https://api.flattr.com/js/0.6/load.js?mode=auto';
        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */
</script>
<style type="text/css">
.pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }

</style>


</head>

<body onLoad="onBodyLoad()">
<div id="cover" style="position: fixed;z-index:9999;background:rgba(255,255,255,.5);text-align:center;font-size:40px;top:0px;left:0px;width:100%;height:100%;">Working Please wait</div>
<?php if(isset($_SESSION['id']) || isset($_SESSION['org_id'])){
    ?>
    <div id="fb-root"></div>


<h2>Imperial Western Products - Route Optimizer  <?php if(isset($_GET['type'])){ echo ": ".$ikg->ikg_manifest_route_number; } ?></h2>


<table class='mainTable'>
<tr>
  <td class='left' style='vertical-align: top'>
  <div id="leftPanel">
  <div id="accordion" style='width: 300pt'>
  <h3><a href="#" class='accHeader'>Destinations</a></h3>
  <div>
    <form name="address" onSubmit="clickedAddAddress(); return false;">
    Add Location by Address: 
    <table><tr><td><input name="addressStr" type="text"></td>
    <td><input type="button" value="Add!" onClick="clickedAddAddress()"></tr>
    </table>
    </form> or <a href="#" onClick="toggle('bulkLoader'); document.listOfLocations.inputList.focus(); document.listOfLocations.inputList.select(); return false;">
    Bulk add by address or (lat, lng)</a>.
    <div id="bulkLoader"></div>
  </div>

  <h3><a href="#" class='accHeader'>Route Options</a></h3>
  <div>
    <form name="travelOpts">
    <input id="walking" type="checkbox"/> Walking<br>
    <input id="bicycling" type="checkbox"/> Bicycling<br>
    <input id="avoidHighways" type="checkbox"/> Avoid highways<br>
    <input id="avoidTolls" type="checkbox"/> Avoid toll roads
    </form>
  </div>

  <h3><a href="#" class='accHeader'>Export</a></h3>
  <div>
    <div id="exportGoogle"></div>
    <div id="exportDataButton"></div>
    <div id="exportData"></div>
    <div id="exportLabelButton"></div>
    <div id="exportLabelData"></div>
    
    <div id="exportAddrButton"></div>
    <div id="exportAddrData"></div>
    <div id="exportOrderButton"></div>
    <div id="exportOrderData"></div>
    <div id="garmin"></div>
    <div id="tomtom"></div>
    <div id="durations" class="pathdata"></div>
    <div id="durationsData"></div>
    
    
  </div>

  <h3><a href="#" class='accHeader'>Edit Route</a></h3>
  <div>
    <div id="routeDrag"></div>
    <div id="reverseRoute"></div>
  </div>

  <h3><a href="#" class='accHeader'>Help</a></h3>
  <div>
  <p>To add locations, simply left-click the map or enter an address
  either in the single address field, or in the bulk loader. </p>
  <p>The first location you add is considered to be the start 
  of your journey. If you click 'Calculate Fastest Roundtrip', it will
  also be the end of your trip. If you click 'Calculate Fastest A-Z Trip',
  the last location (the one with the highest number), will be the final
  destination.</p>
  <p>To remove or edit a location, click its marker.</p>
  <p>If more than 15 locations are specified, you are not guaranteed
  to get the optimal solution, but the solution is likely to be close
  to the best possible.</p>
  <p>You can re-arrange
  stops after the route is computed. To do this, open the 'Edit Route'
  section and drag or delete locations.</p>
  </div>

  <!--<h3><a href="#" class='accHeader'>About</a></h3>
  <div>
  <p><span class="red">Version 4</span>&nbsp;<a href="http://gebweb.net/blogpost/2012/01/25/optimap-version-4-is-here/">Read about the new
  version, and post comments, bugs and suggestions</a>.
  <p>How it works: <a href="http://gebweb.net/blogpost/2007/07/05/behind-the-scenes-of-optimap/">Behind the Scenes of OptiMap</a></p>
  <p>Use on your website: <a href="http://gebweb.net/blogpost/2007/08/26/optimize-your-trips/">Optimize Your Trips</a></p>
  <p>
   The solver <a href="http://code.google.com/p/google-maps-tsp-solver/">
   source code</a> is available under the MIT license. If you are
   interested in
   knowing about updates to this code, please subscribe to
   <a href="http://groups.google.com/group/google-maps-tsp-solver">
   this mailing list</a>.</p>
  <p>
   You can specify a default starting position and zoom level,
   by adding http GET parameters center and zoom. E.g
   <a href="http://gebweb.net/optimap/index.php?center=(60,10)&amp;zoom=6">http://gebweb.net/optimap/index.php?center=(60,10)&amp;zoom=6</a>.</p>
  <p>Up to 100 locations are accepted.</p>
  </div>-->
  
  </div>

  <input id="button1" class="calcButton" type="button" value="Calculate Fastest Roundtrip" onClick="directions(0, document.forms['travelOpts'].walking.checked, document.forms['travelOpts'].bicycling.checked, document.forms['travelOpts'].avoidHighways.checked, document.forms['travelOpts'].avoidTolls.checked)">
  <input id="button2" class="calcButton" type="button" value="Calculate Fastest A-Z Trip" onClick="directions(1, document.forms['travelOpts'].walking.checked, document.forms['travelOpts'].bicycling.checked, document.forms['travelOpts'].avoidHighways.checked, document.forms['travelOpts'].avoidTolls.checked)">
  <input id='button3' class="calcButton" type='button' value='Start Over Again' onClick='startOver()'>
  <input type="submit" value="Save Route Order" id="save_order" style="background: #f6f6f6 url('images/ui-bg_glass_100_f6f6f6_1x400.png') repeat-x scroll 50% 50%;border: 1px solid #cccccc;color: #0000a0; font-weight: bold; width: 200pt;padding: 0.4em 1em;cursor:pointer;" />
  <input type="submit" value="Print" id="print" style="background: #f6f6f6 url('images/ui-bg_glass_100_f6f6f6_1x400.png') repeat-x scroll 50% 50%;border: 1px solid #cccccc;color: #0000a0; font-weight: bold; width: 200pt;padding: 0.4em 1em;cursor:pointer;" />
 

</div>


  

  </td>
  <td class='right' style='vertical-align: top'>
  <div id="map" class="myMap"></div>
  <div id="path" class="pathdata"></div>
  <div id="my_textual_div"></div>
  </td>
</tr>
</table>

<!-- Hidden stuff -->
<div id="bulkLoader_hidden" style="visibility: hidden;">
  <form name="listOfLocations" onSubmit="clickedAddList(); return false;" id="mapped">
  <textarea name="inputList" rows="10" cols="70" placeholder=""><?php
    if(isset($_GET['type'])){
        echo trim($ikg->facility_address)."\r\n";
        foreach($ikg->scheduled_routes as $stops){
            if ( !preg_match('/\s/',$stops) ){
                switch($_GET['type']){
                    case "oil":
                    $scheduled_stop = new Scheduled_Routes($stops); 
                    $acnt = new Account($scheduled_stop->account_number);
                    echo  trim(trim($acnt->acount_id).":".trim(htmlentities(  clean($acnt->address) )).", ".trim($acnt->city).", ".trim($acnt->state)." ".trim($acnt->zip)." ".trim($acnt->country))."\r\n";  
                    break;
                    case "util":
                    $scheduled_stop = new Util_Stop($stops);
                    $acnt = new Account($scheduled_stop->account_number);
                    echo  trim(trim($acnt->acount_id).":".trim(htmlentities(  clean($acnt->address) )).", ".trim($acnt->city).", ".trim($acnt->state)." ".trim($acnt->zip)." ".trim($acnt->country))."\r\n";  
                    break;
                    case "organics":
                    
                    $scheduled_stop = new Organic_stop($stops);
                    $acnt = new Account_organics($scheduled_stop->account_number);
                    echo  trim(trim($acnt->acount_id).":".trim(htmlentities(  clean($acnt->address) )).", ".trim($acnt->city).", ".trim($acnt->state)." ".trim($acnt->zip)." ".trim($acnt->country))."\r\n";
                    break;
                }
                    
            }
            
        }
    }
  ?>
  </textarea><br/>
  <input type="button" id="auto" value="Add list of locations" onClick="clickedAddList()" />
</form></div>
<div id="exportData_hidden" style="visibility: hidden;"></div>
<div id="exportLabelData_hidden" style="visibility: hidden;"></div>
<div id="exportAddrData_hidden" style="visibility: hidden;"></div>
<div id="exportOrderData_hidden" style="visibility: hidden;"></div>
<div id="durationsData_hidden" style="visibility: hidden;"></div>

<div id="dialogProgress" title="Calculating route...">
<div id="progressBar"></div>
</div>

<div id="dialogTomTom" title="Export to TomTom">
<iframe name='tomTomIFrame' style='width: 580px; height: 400px'></iframe> 
</div>

<div id="dialogGarmin" title="Export to Garmin">
<iframe name='garminIFrame' style='width: 580px; height: 400px'></iframe>
</div>
<div id="test" style="height: auto;width:500px;">

</div>


<script>
     /*function init() {
        var input = document.getElementsByClassName('locationTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);
    }

    google.maps.event.addDomListener(window, 'load', init);*/
   
    var reordered = "";    
    jQuery("document").ready(function(){
       setTimeout('jQuery("#auto").trigger("click")',5000);        
    });
    
    jQuery("#save_order").click(function(){
        reordered ="";
        jQuery("#cover").show();
        jQuery(".centered-directions").each(function(i){
             if (i > 0){
                if(jQuery(this).text().length>0 && jQuery(this).text() !=" " && jQuery(this).text() !="" ){
                    var ixxx = jQuery(this).text().split(":");
                    reordered +=ixxx[0]+"\n";
                }
             }
            
         });
         
         
        if(reordered.length >0){
            //alert( jQuery("#outputAddrList").val() );
            <?php 
                switch($_GET['type']){
                    case "oil":
                    ?>
                    jQuery.post("new_route_order.php",{orders:reordered,route_id:<?php echo $_GET['route']; ?>},function(data){
                        
                            if(data !="Optimization not saved.  Please check the address of one or more stops in your route"){
                                jQuery("#test").html(data);
                                 //alert("New Oil Route Order Saved!" +data);
                                jQuery("#cover").hide();
                                //jQuery("#debug").html(data);
                                var form = window.opener.document.getElementById("resubmit_this"); 
                                form.submit();    
                            }else{
                                alert(data);
                            }
                        
                             
                    });
                    
                    <?php
                    break;
                    case "util":
                    ?>
                    jQuery.post("new_route_order_util.php",{orders:reordered,route_id:<?php echo $_GET['route']; ?>},function(data){
                        alert("New Utility Route Order Saved!");
                        jQuery("#cover").hide();
                        //jQuery("#debug").html(data);  
                        var form = window.opener.document.getElementById("resubmit_this"); 
                        form.submit(); 
                    });
                    <?php
                    break;
                    case "organics":
                    ?>
                    jQuery.post("new_route_order_organics.php",{orders:reordered,route_id:<?php echo $_GET['route']; ?>},function(data){
                        alert("New Utility Route Order Saved!");
                        jQuery("#cover").hide();
                        //jQuery("#debug").html(data);  
                        var form = window.opener.document.getElementById("resubmit_this"); 
                        form.submit(); 
                    });
                    <?php
                    break;
                }
            ?>
        }else{
            alert("Please round/fastest trip first!");
        }
         
    });
    jQuery("#print").click(function(){
        window.print();
    });
    </script>
    <div id="debug"></div>
    <?php
}else {
    ?>
    Your session has expired, please re-login <a href="home.php">here</a>.
    <?php
} ?>
</body>
<script>

 jQuery("#cover").hide();
</script>
</html>

