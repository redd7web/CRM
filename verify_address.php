<!DOCTYPE html>
<html>
  <head>
    <title>GeoComplete</title>
    <meta charset="UTF-8">
    <style type="text/css">
    body {
      color: #333;
      padding:10px 10px 10px 10px;
      margin:10px 10px 10px 10px;
    }
    
    body, input, button {
      line-height: 1.4;
      font: 13px Helvetica,arial,freesans,clean,sans-serif;
    }
    
    
    a {
      color: #4183C4;
      text-decoration: none;
    }
    
    #examples a {
      text-decoration: underline;
    }
    
    #geocomplete { width: 200px}
    
    .map_canvas { 
      width: 600px; 
      height: 400px; 
      margin: 10px 20px 10px 0;
    }
    
    #multiple li { 
      cursor: pointer; 
      text-decoration: underline; 
    }
    </style>
  </head>
  <body>
    <?php
        include "protected/global.php";
        $account = new Account($_GET['account']);
    ?>
    <form>
      <input style="width: 350px;" id="geocomplete" type="text" placeholder="Type in an address" value="<?php echo trim($account->address).", ".trim($account->city).", ".trim($account->state)." ".trim($account->zip)." ".trim($account->country) ?>" rel="<?php echo $account->acount_id; ?>" />
      <input id="find" type="button" value="find" /><br />
     
    </form>
     <input type="submit" value="Update Address" id="update_address"/>
    <div id="kdl">
    
    </div>     
    
    
    <div class="map_canvas"></div>
    
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUBO94w0fjpCA0-zgoRU7CikeEnGoNA1U&libraries=places"></script>
    <script src="js/jquery-1.11.1.js"></script>

    <script src="js/jquery.geocomplete.js"></script>
     
    <script>
      $(function(){        
        $("#update_address").click(function(){
            var buffer = $("input#geocomplete").val().split(",");
            var state_zip = buffer[2].split(" ");
            $("#kdl").html(buffer[0]+"<br/>"+buffer[1]+"<br/>"+state_zip[1]+"<br/>"+state_zip[2]+"<br/>"+buffer[3]);
            $.post("update_address_account.php",{address:buffer[0], city:buffer[1], state:state_zip[1],zip: state_zip[2],country:buffer[3],account: $("input#geocomplete").attr('rel') },function(data){
                alert(data);
            });
        });
        
        var options = {
          map: ".map_canvas"
        };
        
        $("#geocomplete").geocomplete(options)
          .bind("geocode:result", function(event, result){
            $.log("Result: " + result.formatted_address);
          })
          .bind("geocode:error", function(event, status){
            $.log("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
            $.log("Multiple: " + results.length + " results found");
          });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
        
        $("#examples a").click(function(){
          $("#geocomplete").val($(this).text()).trigger("geocode");
          return false;
        });
        
      });
    </script>
  </body>
</html>

