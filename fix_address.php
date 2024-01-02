<head>
<style>
a {
      color: #4183C4;
      text-decoration: none;
    }
    
    #examples a {
      text-decoration: underline;
    }

 #multiple li { 
  cursor: pointer; 
  text-decoration: underline; 
}
</style>

</head>
<?php
include "protected/global.php";
$acc = $db->query("SELECT Name,address,city,state,zip,account_ID FROM iwp_accounts WHERE latitude !=0 OR longitude !=0");
?>


<table style="float: left;width:100%;"><tr><td colspan="5"><button id="fix_add">Fix addresses</button></td><td><input id="find" type="button" value="find" /></td><td><input type="submit" value="Update Address" id="update_address"/></td></tr></table>
<table style="float: left;margin-right:10px;">

<?php
if(count($acc)>0){
    foreach($acc as $a){
       
        
        echo '<tr class="address_fix" rel="'.$a['account_ID'].'">
            <td class="address_entry" style="height:10px;"><input class="geocomplete" type="text" value="'.$a['address'].','.$a['city'].','.$a['state'].','.$a['zip'].'"/></td>
            <td class="correct"></td></tr>';
    }
}

?>


</table>

<table style="float: left;margni-right:5px;" id="kdl">

</table>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsbyszd_ZoIXzMHfuGxyZVi7G5-pCTGAU&libraries=places"></script>
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery.geocomplete.js"></script>
<script>
$(function(){        
        $("#update_address").click(function(){
            $.each(".geocomplete",function(){
                  var buffer = $(this).val().split(",");
                  var state_zip = buffer[2].split(" ");
                  $("#kdl").html(buffer[0]+"<br/>"+buffer[1]+"<br/>"+state_zip[1]+"<br/>"+state_zip[2]+"<br/>"+buffer[3]);
                    $.post("update_address_account.php",{address:buffer[0], city:buffer[1], state:state_zip[1],zip: state_zip[2],country:buffer[3],account: $("input#geocomplete").attr('rel') },function(data){
                        alert(data);
                    });
            });
            
          
        });
        
        
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
            
            $.each(".geocomplete",function(){
                $(this).trigger("geocode");
            })
            
          
        });
        
        $("#fix_add").click(function(){
            $.each(".geocomplete",function(){
                 $(this).val($(this).text()).trigger("geocode");
            });
        });
        
       
      });
</script>