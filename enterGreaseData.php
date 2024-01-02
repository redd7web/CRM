<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
       

<?php
//ini_set("display_errors",1);
include "protected/global.php";
include "source/scripts.php"; 
include "source/css.php";
if(isset($_SESSION['id'])){ 
    $person = new Person();
    $grease_route = new Grease_IKG($_GET['route_id']);
    //var_dump($util_route);
?>
<title>Enter Utility Service Data</title>
<style type="text/css">

input[type="text"] {
    border: 1px solid #bbb;
    border-radius: 5px;
    height: 25px;
    width: 140px;
    margin-left:5px;
}
</style>
<div id="loading-screen"></div>
<div id="wrapper" style="height: auto;">
    <div id="fullgray" style="width: 100%;height:30px;background: linear-gradient(#F0F0F0, #CFCFCF) repeat scroll 0 0 rgba(0, 0, 0, 0);border-bottom: 1px solid #808080;margin-bottom:10px;">
        <div id="info_hold" style="width: 700px;margin:auto;height:30px;background:transparent;padding">
            <table style="width:700px;"><tr><td>Route ID:</td><td id="rid"> <?php  echo $_GET['route_id'];?> </td><td>Created: <?php   if(isset($grease_route->created_date )){ echo $grease_route->created_date; }else { echo date("Y-m-d");}   ?></td><td>By:<?php 
            if(!isset($grease_route->created_by)){
            
            echo uNumToName($person->user_id);  }{
                echo $grease_route->created_by;                
            }?> </td><td>Facility: <span id="facholder"><?php echo $grease_route->recieving_facility; ?></span> </td></tr></table>
            </div>
        
    </div>
    <div id="accountHolder" style="width: 380px;height:480px;overflow-x:hidden;overflow-y:auto;padding:10px 10px 10px 10px;margin-left:30px;border-radius:5px 5px 5px 5px;border:3px solid rgb(242,242,242);float:left;margin-bottom:5px;">
<table style="width: 99%;" id="sched_list">
    <?php
    
    if(count($grease_route->scheduled_routes)>0){
        $count = 1;
        foreach($grease_route->scheduled_routes as $grease_scheds){
           if($grease_scheds != null){
                 $grease_stop = new Grease_Stop($grease_scheds);
            $mark = '';
            //echo "SELECT * FROM iwp_grease_data_table WHERE route_id=$grease_scheds[grease_route_no] AND account_no = $grease_scheds[account_no] AND schedule_id = $grease_scheds[grease_no]<br/>";
            $get_gallons = $db->query("SELECT * FROM iwp_grease_data_table WHERE route_id=$grease_stop->grease_route_no AND account_no = $grease_stop->account_number AND schedule_id = $grease_stop->grease_no"); //has this account been picked up for this route?
            if(count($get_gallons) >=1){
                $mark =1 ;
            }
            echo "<tr class='list_row' xlr='$grease_stop->grease_no' title='$grease_stop->grease_no' account='$grease_scheds[account_no]'>
                <td id='a$grease_stop->grease_no' style='width:50px;'>&nbsp;</td>
                <td>$count</td>
                <td style='text-align:left;border-bottom:1px solid rgb(242,242,242);padding:8px 8px 8px 8px;'>
                <span class='schedulex' rel='$grease_stop->grease_no' xlr='$grease_stop->account_number'>".account_NumToName($grease_stop->account_number)."</span><br/><span style='font-size:12px;color:gray;'>Account id: $grease_stop->account_number</span>
                <input type='text' value='$mark' class='picked_up' placeholder='Mark this if picked up' title='$grease_stop->grease_no' id='p$grease_stop->grease_no' xlr='$grease_stop->account_number'/>            
                </td>
                
                <td style='text-align:right;border-bottom:1px solid rgb(242,242,242);padding:8px 8px 8px 8px;' id='pic$grease_stop->grease_no'>"; 
            
            if( $mark == 1  ){
                echo "<img src='img/check_green_2s.png'/>";
            } else if( $grease_scheds['fire'] == 1  ){ 
                echo "<img src='img/graphics-flashing-light-245546.gif' style='width:30px;height:30px;' class=''/>"; 
            } 
            else  {
                echo "<img src='img/redlight.jpg'/>";
            }         
        echo "</td></tr>";
        $count++;
           }
        }  
    }
     
    ?>
    </table>
    </div>
    
        <div id="enterData" style="padding: 10px 10px 10px 10px;width:480px;min-height:480px;float:left;margin-left:10px;margin-bottom:5px;height:auto;">
    <table style="width: 100%;"><tr><td><span id="back" style="cursor: pointer;text-decoration:underline;">&laquo; Back</span></td><td><span id="next" style="cursor: pointer;text-decoration:underline;">Next &raquo;</span></td></tr></table>
    <table style="width: 100%;">
    <tr><td colspan="2" >
        <div id="head" style="width: 400px;height:200px;border-radius:5px 5px 5px 5px;border-color:3px;margin:auto;border:3px solid rgb(242,242,242);">
            <div id="headLeft" style="width: 180px;padding:10px 10px 10px 10px;height:180px;text-align:center;float:left;">
                <p id="account_Name_address">Loading Info....</p>
            </div>    
            <div id="headRight" style="width: 180px;padding:10px 10px 10px 10px;height:180px;text-align:center;float:left;">
            <p style="text-align: center;">
                <span style="font-weight: bold;font-size: 13px;font-family:tahoma;text-align:center;"> Service</span><br />
                <span id="containInfo" >
                Loading info...
                </span>
            </p>
            </div>
        </div>
    </td></tr>
    </table>
    
    
    
    <table style="width: 100%;">
    <tr><td style="text-align: right;">Grease Picked Up</td><td style="text-align: left;"><input type="text" id="grease_picked_up"/>/<span id="total_amount"></span></td></tr>
    <tr><td style="text-align: right;vertical-align:top;">Reason for Zero Gallons</td><td style="text-align: left;vertical-align:top;">
    
    
    <?php zero_gallons_reasons(); ?></td></tr>
    
    <tr><td style="text-align: right;vertical-align:top;">Field Notes</td><td style="text-align: left;vertical-align:top;"><textarea id="field_notes" name="field_notes" style="width: 100%;height:80px;"></textarea></td></tr>
    
    <tr><td style="text-align: right;vertical-align:top;">Driver</td><td style="text-align: left;vertical-align:top;"><?php echo getDrivers($grease_route->driver_no);  ?></td></tr>
    <tr><td style="text-align: right;vertical-align:top;">Date of Pickup</td><td style="text-align: left;vertical-align:top;"><input type="text" id="dop" name="dop" value="<?php echo date("Y-m-d"); ?>"/></td></tr>'
    <tr><td style="text-align: right;vertical-align:top;"><input type="submit" value="Service Complete" id="pickup_complete"/></td><td style="text-align: center;vertical-align:top;"><img num="" account=""  src="img/chat.jpg" class="mail2" style="cursor: pointer;width:50px;height:50px;"/></td></tr>
    
    </table>
    
    </div>
    
    <table style="width: 100%;float:left;">
<tr><td style="text-align: center;border:2px solid black"><input type="submit"  <?php 

if($person->isFacilityManager() || $person->isAdmin() || $person->isCoWest()){
    echo 'id="route_complete" value="Manager Close Route"';
} else if($person->isDriver() || $person->isCoWestDriver()){
    echo 'id="driver_route_complete" value="Driver Complete"';
}else {
        echo 'value="Only Drivers or Managers can close routes" disabled';
    }  
?> /> </td><td style="text-align: center;vertical-align:middle;">If all data is entered for this route, close it out.</td></tr>
</table>
<input type="hidden" id="update_this_account" name="update_this_account" readonly=""/>
    <div id="debug" style="min-height: 300px;height:auto;width:100%;"></div>
    <div style="clear: both;"></div>  
</div>



<script>

window.onload = function(){
    $("#loading-screen").fadeOut("fast");
}

function close_window() {
  if (confirm("Route Closed.  Uncompleted Stops went back to scheduled stops pool.")) {
    close();
  }
}

$(".mail2").click(function(){
    var y = $(this).attr('account');   
    Shadowbox.open({
        content: 'message.php?account='+y,
        player:"iframe",
        width:500,
        height:500,
        loadingImage:"shadow/loading.gif", 
        title: "Messaging / Issues",
        options: {    
            overlayColor:"#ffffff",
            overlayOpacity: ".9"            
        }
    });
});

function Traverse(number){
    $("#field_notes").val("");
    $("#reason_for_skip_id").val(0);
    $("#barrel_section").html("");
    $("input#grease_picked_up").val("");
    $("#sched_list tr td:first-child").removeClass("right_arrow");
    $("#account_Name_address,#containInfo").html("Loading info...");
    $("input#inchescollected,input#gpicalc,input#inchesleftover,input#inchtogallonleftover").val("");
    $(".outof").html('');
    $.get("getPickedUpGrease.php",{sched_id:number,route:<?php echo $_GET['route_id']; ?>},function(data){
        $("input#grease_picked_up").val(data);
    });
    
    $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"address"},function(data){
          $("#account_Name_address").html(data);
          $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"containment"},function(data){
                $("#containInfo").html(data);
                $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"amount"},function(data){
                    $(".outof").html(data);
                    $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"num"},function(data){
                        $(".mail2").attr('account',data);
                        $("input#update_this_account").val(data)
                         selector = "#a"+number+"";
                            $(selector).addClass("right_arrow");
                            $("#loading-screen").fadeOut("slow");
                            $(".mail2").addAttr('num',number);                           
                    });
                });                    
          });          
    }); 
        
    $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"volume"},function(data){ 
        $("#total_amount").html(data); 
    });
          
    $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"field"},function(data){ 
        $("#field_notes").val(data); 
    }); 
    
    
    $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"picked_up"},function(data){ 
        $("input#grease_picked_up").val(data); 
    });
           
    $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"zero_reason"},function(data){ 
        if(data !=0){
            $("#reason_for_skip_id").val(data);
        } 
    });      
}

var schedules_to_traverse = new Array();
var schedule_ids = new Array();

var current_schedule = 0;
$( ".schedulex" ).each(function( index ) {
    schedules_to_traverse.push( $(this).attr('rel')  );
    schedule_ids.push( $(this).attr('rel') );
});

var schedule_max = schedules_to_traverse.length;

$.get("retrieveGreaseSchedule_info.php",{sched_id:schedules_to_traverse[0],mode:"address"},function(data){
    
    $("#field_notes").val("");
    $("#reason_for_skip_id").val(0);
    
    selector = "#a"+schedules_to_traverse[0]+"";
    $("input#grease_picked_up").val("");
    $.get("getPickedUpGrease.php",{sched_id:schedules_to_traverse[0],route:<?php echo $_GET['route_id']; ?>},function(data){
        $("input#grease_picked_up").val(data);
    });
    
    $(selector).addClass("right_arrow");
      $("#account_Name_address").html(data);
      $.get("retrieveGreaseSchedule_info.php",{sched_id:schedules_to_traverse[0],mode:"containment"},function(data){
            $("#containInfo").html(data);
            $.get("retrieveGreaseSchedule_info.php",{sched_id:schedules_to_traverse[0],mode:"amount"},function(data){
                $(".outof").html(data);
                $.get("retrieveGreaseSchedule_info.php",{sched_id:schedules_to_traverse[0],mode:"num"},function(data){
                    $(".mail2").attr('account',data);
                   $("input#update_this_account").val(data);
                   $(".mail2").attr('num',schedules_to_traverse[0]);
                   $("#loading-screen").fadeOut("slow");
                   
                });
            });            
      });
      $.get("retrieveGreaseSchedule_info.php",{sched_id:schedules_to_traverse[0],mode:"volume"},function(data){ 
        $("#total_amount").html(data); 
      });
      
      $.get("retrieveGreaseSchedule_info.php",{sched_id:schedules_to_traverse[0],mode:"field"},function(data){ 
            $("#field_notes").val(data); 
      }); 
      
      $.get("retrieveGreaseSchedule_info.php",{sched_id:schedules_to_traverse[0],mode:"picked_up"},function(data){ 
            $("input#grease_picked_up").val(data); 
      });
      
      $.get("retrieveGreaseSchedule_info.php",{sched_id:number,mode:"zero_reason"},function(data){
            if(data !=0){
                $("#reason_for_skip_id").val(data);
            } 
      });
      
});



$("#next").click(function(){
    $("#loading-screen").show();    
    //alert(current_schedule)
    if( current_schedule != schedule_max-1 ){        
        var selector = "#a"+schedules_to_traverse[current_schedule];
        $(selector).removeClass("right_arrow");
        current_schedule++; 
       Traverse(schedules_to_traverse[current_schedule]);
    }
    else { 
        alert('At the end of the list, cannot go forward');
        $("#loading-screen").fadeOut("fast");
    }
    
});


$("#back").click(function(){    
    $("#loading-screen").show();
     //alert(current_schedule)
     if(current_schedule != 0){
        var selector = "#a"+schedules_to_traverse[current_schedule];
        $(selector).removeClass("right_arrow");
        current_schedule--;
        Traverse(schedules_to_traverse[current_schedule]);
     }
     else {
        alert('At the top of the list, cannot go back');
        $("#loading-screen").fadeOut("fast");
     }    
});

$("#pickup_complete").click(function(){    
    $("#loading-screen").show();    
    $.post("save_grease_info.php",{ 
            route_id:<?php echo "$_GET[route_id]"; ?>,
            schedule_number: schedules_to_traverse[current_schedule],            
            account_no: $("input#update_this_account").val(),
            zero_gallon_reason: $("#reason_for_skip_id").val(),
            field_note:$("#field_notes").val(),
            driver: $("#drivers").val(),
            dop:$("input#dop").val(),
            picked_up: $("input#grease_picked_up").val(),
            skip:$("#reason_for_skip_id").val()             
        },function(data){
            //alert(data)
            //$("#debug").html("<?php echo "$_GET[route_id]"; ?> "+schedules_to_traverse[current_schedule]+" "+$("input#update_this_account").val()+" "+$("input#grease_picked_up").val());
            /**/$.post('decrement_grease.php',{route:<?php echo $_GET['route_id']; ?>},function(data){})
            $("#debug").html(data);
            //confirm pickup was complete
            $("p#"+schedules_to_traverse[current_schedule]).val(1);
            $("#pic"+schedules_to_traverse[current_schedule]).html("<img src='img/check_green_2s.png'/>");
            //confirm pickup was complete
            alert("Data Saved!");
            if( current_schedule != schedule_max-1 ){ 
                var selector = "#a"+schedules_to_traverse[current_schedule];
                $(selector).removeClass("right_arrow");
                current_schedule++;
                Traverse(schedules_to_traverse[current_schedule]);
            }
            else {
                $("#loading-screen").fadeOut("slow");
                alert("At end of list");
            }
   });
});

$("#route_complete").click(function(){
   if(confirm("Are you sure you want to close this route?  Is all the information correct?")){
    $.post("update_route_status_grease.php",{route_id:<?php echo $_GET['route_id']; ?>,status:"completed"  },function(data){
        close_window();
    });
   }
});

$("#driver_route_complete").click(function(){
    $.post("update_route_status_grease_driver.php",{route_id:<?php echo $_GET['route_id']; ?>},function(data){
        close_window();
    });
});

$(".list_row").click(function(){
    current_schedule = jQuery.inArray( $(this).attr('xlr') , schedules_to_traverse);
    Traverse( schedules_to_traverse[current_schedule] );
});
$(".list_row").hover(function(){
   $(this).css('background','rgba(220,220,220,.2)');
},function(){
    $(this).css('background','#ffffff');
});

$("input#dop").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});

</script>
<?php }else{
    echo "Please log in to enter grease data. <a href='home.php'>Click here to re-login.</a>";
} ?>