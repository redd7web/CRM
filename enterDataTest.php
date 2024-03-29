<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
<?php
include "protected/global.php";
 
include "source/scripts.php"; 
include "source/css.php";
ini_set("display_errors",0);
if(isset($_SESSION['id'])){ 
    $person = new Person();

$driver=0;

$ikg_info = new IKG($_GET['route_id']); 

$pick_data = $db->where("route_id",$_GET['route_id'])->get($dbprefix."_data_table");

$route_completed_ = $db->where('route_id',$_GET['route_id'])->get($dbprefix."_list_of_routes");
    $facilitySend = reverseTranslate($ikg_info->recieving_facility);
if(count($route_completed_) >0){
    $completed = 1;
    $driver = $ikg_info->driver;
}


//var_dump($ikg_info);
?>
<style type="text/css">

input[type="text"] {
    border: 1px solid #bbb;
    border-radius: 5px;
    height: 25px;
    width: 140px;
    margin-left:5px;
}
.list_row{
    cursor:pointer;
}

#mytable tr td{
    padding:0px 0px 0px 0px;
}
body{
    background:white;
}
</style>
<div id="loading-screen"></div>
 <div id="fullgray" style="width: 100%;height:30px;background: linear-gradient(#F0F0F0, #CFCFCF) repeat scroll 0 0 rgba(0, 0, 0, 0);border-bottom: 1px solid #808080;margin-bottom:10px;border-bottom: 3px solid rgb(62, 126, 48);">
            <div id="info_hold" style="width: 700px;margin:auto;height:30px;background:transparent;padding">
            <table style="width:1000px;"><tr><td>Route ID:</td><td id="rid"> <?php if(isset($ikg_info->route_id)){ echo "$ikg_info->route_id";}?> </td><td>Created: <?php   if(isset($ikg_info->created_date )){ echo $ikg_info->created_date; }else { echo date("Y-m-d");}   ?></td><td>By:<?php 
            if(!isset($ikg_info->created_by)){
            
            echo uNumToName($person->user_id);  }{
                echo $ikg_info->created_by;
                
            }?> </td><td>Facility: <span id="facholder"><?php echo $ikg_info->recieving_facility; ?></span> </td></tr>
            </table>
            </div>
    </div>
    
<div id="debug">

</div>    
    
<div id="wrapper" style="width:880px;margin:auto;height:auto;border:0px solid #bbb;">
    <div id="spacer" style="width: 100%;height:10px;">&nbsp;</div>
   

    <div id="accountHolder" style="width: 280px;height:480px;overflow-x:hidden;overflow-y:auto;padding:10px 10px 10px 10px;border-radius:5px 5px 5px 5px;border:3px solid rgb(242,242,242);float:left;margin-bottom:5px;">
    <table style="width: 99%;" id="sched_list">
    <?php
       $count =1;
       
       foreach($ikg_info->scheduled_routes as $value){
           $mark = '';  
           
           $schedule = new Scheduled_Routes($value);
           $get_gallons = $db->where("account_no",$schedule->account_number)->where("route_id",$schedule->route_id)->get($dbprefix."_data_table","*"); //has this account been picked up for this route?
           if(count($get_gallons) >=1){
            $mark =1 ;
           }
           echo "<tr class='list_row' xlr='$value' title='$value' account='$schedule->account_number'>
                <td id='a$value' style='width:30px;'>&nbsp;</td>
                <td>$count</td>
                <td style='text-align:left;border-bottom:1px solid rgb(242,242,242);padding:8px 8px 8px 8px;'>
                <span class='schedulex' rel='$value' xlr='$schedule->account_number'>".account_NumToName($schedule->account_number)."</span><br/><span style='font-size:12px;color:gray;'>Account id: $schedule->account_number</span>
                <input type='hidden' value='$mark' class='picked_up'  placeholder='Mark this if picked up' title='$value' id='p$value' account='$schedule->account_number' read_only/>            
                </td>
                
                <td style='text-align:right;border-bottom:1px solid rgb(242,242,242);padding:8px 8px 8px 8px;' id='pic$value'>"; 
            if($schedule->code_red== 1 && count($get_gallons) == 0 ){ 
                echo "<img src='img/graphics-flashing-light-245546.gif' style='width:30px;height:30px;' class=''/>"; 
            } 
            else if( ($schedule->code_red== 1 && count($get_gallons) >= 1) || ($schedule->code_red== 0 && count($get_gallons) >= 1) ){
                echo "<img src='img/check_green_2s.png'/>";
            }         
            else {
                echo "<img src='img/redlight.jpg' style='width:30px;height:30px;'/>";
            }
        echo "</td></tr>";
        $count++;
       }
    ?>
    </table>
    </div>

<div id="enterData" style="padding: 10px 10px 10px 10px;width:600px;min-height:480px;float:left;margin-bottom:5px;height:auto;">
<table style="width: 100%;"><tr><td><span id="back" style="cursor: pointer;text-decoration:underline;">&laquo; Back</span></td><td style="text-align: center;" id="coll"><?php echo $ikg_info->collected ?></td><td><span id="next" style="cursor: pointer;text-decoration:underline;">Next &raquo;</span></td></tr></table>
<table style="width: 100%;">
<tr><td colspan="2" >
    <div id="head" style="width: 430px;height:200px;border-radius:5px 5px 5px 5px;border-color:3px;margin:auto;border:3px solid rgb(242,242,242);overflow-x:auto;">
        <div id="headLeft" style="width: 180px;padding:10px 10px 10px 10px;height:180px;text-align:center;float:left;">
            <p id="account_Name_address">Loading Info....</p>
        </div>    
        <div id="headRight" style="width: 180px;padding:10px 10px 10px 10px;height:180px;text-align:center;float:left;">
        <p style="text-align: left;">
            <span style="font-weight: bold;font-size: 13px;font-family:tahoma;"> Containment(s) On Site</span><br />
            <span id="containInfo" >
            Loading info...
            </span>
        </p>
        
        </div>
        
    </div>

</td></tr>
</table>

<table style="width: 600px;"  id="barrel_section">
<tr><td> Loading Barrel Info....</td></tr>
</table>



<table style="width: 600px">
<tr><td colspan="2">

<iframe id="container_upload_photo" style="width: 100%;height:300px;"></iframe>
</td></tr>

<?php

echo "<tr><td style='text-align:right;'>Issues active related to this stop</td><td colspan='2'>";
                    $iss = $db->query("SELECT iwp_issues.*,iwp_driver_report.description,iwp_driver_report.code FROM iwp_issues LEFT JOIN iwp_driver_report ON iwp_issues.issue = iwp_driver_report.value WHERE iwp_issues.account_no = $schedule->account_number  AND iwp_issues.issue_status = 'active'");
                    if(count($iss)>0){
                        echo "<select name='related_issues' id='related_issues'>";
                        echo "<option value='0'>--SELECT--</option>";
                        foreach($iss as $ues){
                            
                            echo "<option title='$ues[description]' value='$ues[id]'>$ues[code]</option>";
                        }
echo "</select>";
echo "</td></tr>";
}
          
?>
<tr><td style='text-align:right;'>Pick Up Day</td><td style='text-align:left;'><select id='day_stop'>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                            <option value='5'>5</option>
                        </select></td></tr>
<tr><td  style='text-align:right'>Mileage</td><td  style='text-align:left'><input value='' id='mileage' name='mileage' placeholder='Mileage' type='text'/></td></tr>
<tr><td style="text-align: right;vertical-align:top;">Driver Report 1(Key)</td><td style="text-align: left;vertical-align:top;">


              <?php zero_gallons_reasons(); ?>          </td></tr>


<tr><td style="text-align: right;vertical-align:top;">Driver Report 2(Key)</td><td style="text-align: left;vertical-align:top;">


              <?php zero_gallons_reasons("","zero_2"); ?>          </td></tr>

<tr><td style="text-align: right;vertical-align:top;">Driver Report 3(Key)</td><td style="text-align: left;vertical-align:top;">


              <?php zero_gallons_reasons("","zero_3"); ?>          </td></tr>


<tr><td style="text-align: right;vertical-align:top;">Driver Report 4(Key)</td><td style="text-align: left;vertical-align:top;">


              <?php zero_gallons_reasons("","zero_4"); ?>          </td></tr>
              
              <tr><td style="text-align: right;vertical-align:top;">Driver Report 5(Key)</td><td style="text-align: left;vertical-align:top;">


              <?php zero_gallons_reasons("","zero_5"); ?>          </td></tr>

<tr><td style="text-align: right;vertical-align:top;">Field Notes</td><td style="text-align: left;vertical-align:top;"><textarea id="field_notes" name="field_notes" style="width: 100%;height:80px;"></textarea></td></tr>

<tr><td style="text-align: right;vertical-align:top;">Driver</td><td style="text-align: left;vertical-align:top;"><?php
  
            //echo "empty driver info<br/>";
         getDrivers($driver); 
   

  ?></td></tr>
<tr><td style="text-align: right;vertical-align:top;">Date of Pickup</td><td style="text-align: left;vertical-align:top;"><input type="text" id="dop" name="dop" readonly=""/></td></tr>'
<tr><td style="text-align: right;vertical-align:top;"><input xlkr=""  type="submit" value="Pickup Complete" id="pickup_complete"/></td><td style="text-align: center;vertical-align:top;"><img num="" account="" src="img/chat.jpg" class="mail2" style="cursor: pointer;width:50px;height:50px;"/></td></tr>




</table>

</div>


<table style="width: 100%;float:left;">
<tr><td style="text-align: center;border:1px solid white;width:430px;">
    <input type="submit"  <?php  
    if($person->isAdmin() || $person->isFacilityManager()  || $person->isCoWest()){
        echo 'id="route_complete" value="Manager Close Route"';
        if($ikg_info->can_close == 0){ echo " disabled ";  }
    }else if($person->isDriver() || $person->isCoWestDriver()){
        echo 'id="route_complete_driver" value="Driver Close Route"';
    }else {
        echo 'value="Only Drivers or Managers can close routes" disabled';
    }  
    
     ?> /> 
    
    </td><td style="text-align: center;vertical-align:middle;">If all data is entered for this route, close it out.</td></tr>
</table>
<input type="hidden" id="update_this_account" name="update_this_account" />
<div style="clear: both;"></div>

</div>

<div id="debug"></div>
<script>


$("#container_upload_photo").hide();


$("#reason_for_skip_id,#zero_2,#zero_3,#zero_4,#zero_5").change(function(){
    if($(this).val()==32 || $(this).val() == 16  ){
        $("#container_upload_photo").show();
    }else {
        $(".reason_for_skip_id").each(function(){
            if( $(this).val() !=32 && $(this).val() !=16){//check if other select dropdowns do not have 1f or 1b selected, if not keep it hidden, if they are selected on any other drop downs keep it shown
                $("#container_upload_photo").hide();
            } 
        });
    }
});

function loadlink(){
    $( "#coll" ).load( "collected.php?ikg=<?php echo $_GET['route_id']; ?>", function() {
  
    });
}

function close_window() {
  if (confirm("Close Window?")) {
    close();
  }
}
loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 5000);

$("#barrel_section").on('change','.addtional_inch',function(){    
    var row = $(this).closest('tr');
    var itg = $(this).val() * $(this).attr('formula');
    row.find(".aditional_galls").val(  itg.toFixed(2) );
    
});

$("#barrel_section").on('change','.inchesleftover',function(){
    var row= $(this).closest('tr');
    var ilo = $(this).val() * $(this).attr('formula');
    row.find(".galslefover").val( ilo.toFixed(2) );
    
});

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

function Traverse(number,route){
    //alert(number+" "+route);
    $("#reason_for_skip_id,#zero_2,#zero_3,#zero_4,#zero_5").val(0);
    $("#field_notes").val("");
    $("#sched_list tr td:first-child").removeClass("right_arrow");
    $("#pickup_complete").attr('xlkr','p'+number);
    selector = "#a"+number+"";
    $(selector).addClass("right_arrow");
    $("#barrel_section").html("<tr><td> Loading Barrel Info....</td></tr>");
    $("#account_Name_address,#containInfo").html("Loading info...");
    $("input#inchescollected,input#gpicalc,input#inchesleftover,input#inchtogallonleftover").val("");
    $("#container_upload_photo").attr("src","container_removal_photo_upload.php?schedule="+number+"&route="+route+"");
        $(".outof").html('');
        $.get("retrieveSchedule_info.php",{sched_id:number,mode:"address"},function(data){
              $("#account_Name_address").html(data);
              $.get("retrieveSchedule_info.php",{sched_id:number,mode:"containment"},function(data){
                    //alert(data);
                    $("#containInfo").html(data);
                    $.get("retrieveSchedule_info.php",{sched_id:number,mode:"amount"},function(data){
                        //alert(data);
                        $(".outof").html(data);
                        $.get("retrieveSchedule_info.php",{sched_id:number,mode:"num"},function(data){
                            //alert(data);
                            $("input#update_this_account").val(data)
                            $(".mail2").attr('account',data);
                                $(".mail2").attr('num',number);                           
                        });
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"inches_entered"},function(data){
                            //alert(data);
                            $("input#inchescollected").val(data);
                         });
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"inches_to_gallons"},function(data){
                            //alert(data);
                            $("input#gpicalc").val(data);
                         });
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"leftover"},function(data){
                            //alert(data);
                            $("input#inchesleftover").val(data);
                         });
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"leftovergallons"},function(data){
                            //alert(data);
                            $("input#inchtogallonleftover").val(data);
                         });
                         
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"field"},function(data){
                            //alert(data);
                            $("#field_notes").val(data);
                         });
                         
                        
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"barrel_num"},function(data){
                             //alert(data);
                         });
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"mileage"},function(data){
                             //alert(data);
                             $("input#mileage").val(data);
                         });
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"dop"},function(data){
                             //alert(data);
                             $("input#dop").val(data);
                         });
                         
                        
                         
                         
                          $.get("retrieveSchedule_info.php",{sched_id:number,mode:"zero_reason"},function(data){
                             if(data !=0){
                                $("#reason_for_skip_id").val(data);
                            }
                         });
                         
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"zero2"},function(data){
                             //alert(data);
                             $("input#zero_2").val(data);
                         });
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"zero3"},function(data){
                             //alert(data);
                             $("input#zero_3").val(data);
                         });
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"zero4"},function(data){
                             //alert(data);
                             $("input#zero_4").val(data);
                         });
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"zero5"},function(data){
                             //alert(data);
                             $("input#zero_5").val(data);
                         });
                         
                         $.get("retrieveSchedule_info.php",{sched_id:number,mode:"day"},function(data){
                             //alert(data);
                             $("#day_stop").val(data);
                         });
                         $.get("addtextfield.php",{sched_id:number,route_id:route},function(data){
                            //alert(data);
                            $("#barrel_section").html(data);     
                            $("#loading-screen").fadeOut("slow");                
                         });
                    });                    
              });          
        });        
}


var schedules_to_traverse = new Array();
var schedule_ids = new Array();

var current_schedule = 0;



$( ".schedulex" ).each(function( index ) {
    schedules_to_traverse.push( $(this).attr('rel')  );
    schedule_ids.push( $(this).attr('rel') );
});



$("#route_complete").click(function(){    
    <?php 
        if(  strlen(trim($ikg_info->time_start))>0 && 
                $ikg_info->time_start !="00:00"  && 
                strlen(trim($ikg_info->end_time))>0 && 
                $ikg_info->end_time !="00:00" &&
                strlen(trim($ikg_info->start_mileage))>0&&
                strlen(trim($ikg_info->first_stop))>0 &&
                strlen(trim($ikg_info->last_stop))>0 &&
                strlen(trim($ikg_info->first_stop_mileage))>0 &&
                strlen(trim($ikg_info->last_stop_mileage))>0&&
                strlen(trim($ikg_info->end_mileage))>0
           ){
            ?>
   if(confirm("Are you sure you want to close this route?  Is all the information correct?")){
     $.get("complete_oil_route.php",{route_id:<?php echo $_GET['route_id']; ?>},function(data){  //set ikg and route list complete
        //alert("Route Closed!");
        alert('Uncompleted pickups went back home');
        $("#debug").html(data);
        <?php 
        if($ikg_info->recur == 1){
            ?>
            /*Shadowbox.open({
                player:"iframe",
                content: 'recurring.php?prev_route=<?php echo $_GET['route_id']; ?>',
                width: 500,
                height:350,
                options: { 
                    modal:   true,
                    onClose: function(){  close_window(); }
                }
            });*/            
            <?php
        }else {
        ?>
       
        <?php } ?>
         close_window();//window.close();
    });
   }
   <?php
   }else{
    ?>
         alert("Please Enter a start AND end time.  Then refresh this page");
    <?php
   }
   ?>
});


$("#route_complete_driver").click(function(){
    
    <?php 
        if( 
                strlen(trim($ikg_info->time_start))>0 && 
               
                strlen(trim($ikg_info->end_time))>0 && 
               
                strlen(trim($ikg_info->start_mileage))>0&&
                strlen(trim($ikg_info->first_stop))>0 &&
                strlen(trim($ikg_info->last_stop))>0 &&
                strlen(trim($ikg_info->first_stop_mileage))>0 &&
                strlen(trim($ikg_info->last_stop_mileage))>0&&
                strlen(trim($ikg_info->end_mileage))>0
                ){
            ?>
             $.get("complete_oil_route_driver.php",{route_id:<?php echo $_GET['route_id']; ?>},function(data){  //set ikg and route list complete
                //alert("Route Closed!");
                alert('Uncompleted pickups went back home '+data);
                $("#debug").html(data);
                close_window();
            });
            <?php
        }else{
            ?>
                alert("Please Enter a start AND end time.  Then refresh this page");
            <?php
        }
    ?>
    
  
    //window.close();
});



var schedule_max = schedules_to_traverse.length;

//alert(schedule_max);


//set the arrow to the first account on the list
var selector = "#a"+schedules_to_traverse[current_schedule]+"";
$(selector).addClass("right_arrow");



//***                                    first account information                                           ***//
Traverse(schedules_to_traverse[0],<?php echo $_GET['route_id']; ?>);


//****************************                                                                       *************//

//***************************   Schedule traversing     *********************************//
$("#next").click(function(){
    $("#loading-screen").show();    
    //alert(current_schedule)
    if( current_schedule != schedule_max-1 ){        
        var selector = "#a"+schedules_to_traverse[current_schedule];
        $(selector).removeClass("right_arrow");
        current_schedule++; 
       Traverse(schedules_to_traverse[current_schedule],<?php echo $_GET['route_id']; ?>);
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
        Traverse(schedules_to_traverse[current_schedule],<?php echo $_GET['route_id']; ?>);
     }
     else {
        alert('At the top of the list, cannot go back');
        $("#loading-screen").fadeOut("fast");
     }    
});
//***************************   Schedule traversing     *********************************//



$("input#inchescollected").change(function(){
    $("#loading-screen").show();
    var i =  $(this).val();
    if(i.length>0 || !IsNaN(i)){        
        $.get("retrieveSchedule_info.php",{sched_id:schedules_to_traverse[current_schedule],mode:"gpi_number"},function(data){             
            $("input#gpicalc").val( Math.round(i*data)  );
            $("#loading-screen").fadeOut("fast");

        });
    }
    else {
        alert('Please Enter a Valid number');
    }
});

$("input#inchesleftover").change(function(){
    $("#loading-screen").show();
    var i = $(this).val();
    if(i.length>0  || !IsNaN(i)){
     $.get("retrieveSchedule_info.php",{sched_id:schedules_to_traverse[current_schedule],mode:"gpi_number"},function(data){
            $("input#inchtogallonleftover").val( Math.round(i*data)  );
            $("#loading-screen").fadeOut("fast");
        });
    } 
    else {
        alert('Please Enter a Valid number');
    }
});


$("#pickup_complete").click(function(){
    //$("#loading-screen").show();
    var text_id = $(this).attr('xlkr');
    var total_gal =0;    
    var total_barrel =0;
    var inches_entered = 0 ;
    var inches_to_gallons = 0;
    var inches_left_over = 0;;
    var gallons_left_over = 0;     
    var gal_expected = 0;
    var entry = 0;
   
    /**/
    $("#barrel_section > tbody  > tr").each(function(){
       //flush variables
        total_gal = (total_gal +  (  parseInt($(this).find('.aditional_galls').val()) *1)  );
        //total_barrel = (total_barrel +  ( parseInt(gal_expected) *1)  ); 
    });
    $("#barrel_section > tbody  > tr").each(function(){//loop through each barrel for account
        //flush variables
        inches_entered = $(this).find('.addtional_inch').val();
        inches_to_gallons = $(this).find('.aditional_galls').val(); 
        inches_left_over = $(this).find('.inchesleftover').val();
        gallons_left_over = $(this).find('.galslefover').val();
        gal_expected = $(this).find('.addtional_inch').attr('total_cap');
        entry = $(this).find('.entry').val();
        label = $(this).find('.label').val();
        
        $.post("save_data_info.php",{
            route_id:<?php echo "$_GET[route_id]"; ?>,
            schedule_number: schedules_to_traverse[current_schedule],
            inches_entered: inches_entered,
            picked_up:inches_to_gallons,
            inches_left:inches_left_over,
            inches_to_gallons_leftover: 0,
            gallons_expected:gal_expected,
            label:label,
            account_no: $("input#update_this_account").val(),
            zero_gallon_reason: $("#reason_for_skip_id").val(),
            zero_gallon_reason2: $("#zero_2").val(),
            zero_gallon_reason3: $("#zero_3").val(),
            zero_gallon_reason4: $("#zero_4").val(),
            zero_gallon_reason5: $("#zero_5").val(),
            field_note:$("#field_notes").val(),
            driver: $("#drivers").val(),
            dop:$("input#dop").val(),
            entry:entry,
            sum:total_gal,
            day:<?php echo $_GET['day']; ?>,
            mileage:$("input#mileage").val(),
            facility:<?php echo $facilitySend;?>
        },function(data){
                 //alert(data);
                $("#debug").append(data);
                if(current_schedule == schedule_max -1){
                    alert("At end of list");
                }
        });    
        //alert(label);
    });
    
   
    // $.post("update_pickup.php",{
    //        route_id:<?php //echo "$_GET[route_id]"; ?>//,
    //        schedule_number: schedules_to_traverse[current_schedule],
    //        account_no: $("input#update_this_account").val(),
    //        zero_gallon_reason: $("#reason_for_skip_id").val(),
    //        zero_gallon_reason2: $("#zero_2").val(),
    //        zero_gallon_reason3: $("#zero_3").val(),
    //        zero_gallon_reason4: $("#zero_4").val(),
    //        zero_gallon_reason5: $("#zero_5").val(),
    //        field_note:$("#field_notes").val(),
    //        driver: $("#drivers").val(),
    //        dop:$("input#dop").val(),
    //        day:$("#entry").val(),
    //        mileage:$("input#mileage").val(),
    //        day:$("#day_stop").val()
    //},function(data){
    //    $("#debug").append(data);
    //
    //});
    if( $("input#"+text_id).val() != 1 ){        
        //alert("schedule: "+schedules_to_traverse[current_schedule]+" route_id: <?php echo "$_GET[route_id]"; ?>"+" account_no"+ $("input#update_this_account").val());
        $.post("save_oil_history.php",{route_id:<?php echo $_GET['route_id'] ?>,what_day:<?php echo $_GET['day']; ?>,account_no:$("input#update_this_account").val()},function(data){});
        $.post("decrement_inc.php",{route_id:<?php echo $_GET['route_id'] ?>},function(data){});//when pick up is complete decrement incomplete one less than number started( which is the same amount as stops in the begginning)
    }
    
    $("#loading-screen").fadeOut("slow");    
        
    
    $("#p"+schedules_to_traverse[current_schedule]).val(1);//confirm pickup was complete
    $("#pic"+schedules_to_traverse[current_schedule]).html("<img src='img/check_green_2s.png'/>"); //confirm pickup was complete       
    //move to next account in the route if not at the end
    if( current_schedule != schedule_max-1 ){ 
        var selector = "#a"+schedules_to_traverse[current_schedule];
        $(selector).removeClass("right_arrow");
        current_schedule++;
        Traverse(schedules_to_traverse[current_schedule],<?php echo $_GET['route_id']; ?>);
    }
    /**/
   
});


$(".list_row").click(function(){
    $("#loading-screen").show();
    current_schedule = jQuery.inArray( $(this).attr('xlr') , schedules_to_traverse);
    Traverse( schedules_to_traverse[current_schedule] ,<?php echo $_GET['route_id']; ?>);
});


$(".list_row").hover(function(){
   $(this).css('background','rgba(220,220,220,.2)');
},function(){
    $(this).css('background','#ffffff');
});

$("input#dop").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>
<script src="js/general.js"></script>
<?php }else{
    echo "Please log in to enter grease data. <a href='home.php'>Click here to re-login.</a>";
} ?>
