
<?php
$schedule_table = $dbprefix."_scheduled_routes";
$account_table = $dbprefix."_accounts";
$addtn ='';
ini_set("display_errors",0);
//*******************limit seearches depending on permissions*******************//


if( isset($_POST['search_now'])  ){ //********************  POSTED SEARCH  ********************************
 
   foreach($_POST as $name=>$value){
            switch($name){  
                case "status":
                    if($value !='--Please choose a status'){
                        $arrFields[] = " $account_table.status like '%$value%' ";
                    }
                break;
                
                case "only_issues":
                    if(strlen(trim($value))>0){
                        $arrFields[] = " issue_associated IS NOT NULL ";
                    }
                break;   
                case "friendly":
                    if(strlen($value)>0 && $value !='null'){
                        $arrFields[] = "iwp_accounts.friendly = '$value'";
                    }
                break;
                case "sched_date_from":
                    if(strlen($value)>0){
                        $arrFields[] = "scheduled_start_date >= '$value'";
                    }
                break;
                case "sched_date_to":
                    if(strlen($value)>0){
                        $arrFields[] = "scheduled_start_date <= '$value'";
                    }
                break;
                case "eos_from":
                    if(strlen($value)>0 ){
                        $arrFields[] = " avg_gallons_per_Month >= $value ";
                    }
                break;
                case "eos_to":
                    if(strlen($value)>0){
                        $arrFields[] = " avg_gallons_per_Month <= $value ";
                    }
                break;
                case "cap_from":
                    if(strlen($value)>0){
                        $arrFields[] = " iwp_accounts.barrel_capacity >= $value ";
                    }
                break;
                case "cap_to":
                    if(strlen($value)>0){
                        $arrFields[] = " iwp_accounts.barrel_capacity <= $value ";
                    }
                break;
                case "gal_pu_from":
                    if(strlen($value)>0){
                        $arrFields[] = " iwp_accounts.amount_of_last_pickup >= $value ";
                    }
                break;
                 case "gal_pu_to":
                    if(strlen($value)>0){
                        $arrFields[] = " iwp_accounts.amount_of_last_pickup <= $value ";
                    }
                break;
                
                case "id":
                    if(strlen($value)>0){
                        $arrFields[] = " schedule_id=".$value;
                    }
                    break;
                case "name":
                    if(strlen($value)>0){
                        $arrFields[] = " name like '%".$value."%'";
                    }
                    break;
                case "address":
                    if(strlen($value)>0){
                        $arrFields[] = " address='".$value."'";
                    }
                    break;
                case "city":
                    if(strlen($value)>0){
                        $value = str_replace(" ","%",$value);
                        $arrFields[] = " city like '%".$value."%'";
                    }
                    break;
                case "state":
                    if(strlen($value)>0){
                        $arrFields[] = " state = '".$value."'";
                    }
                    break;   
                case "zip":
                    if(strlen($value)>0){
                        $arrFields[] = " zip = $value";
                    }
                    break;               
                case "from":
                    if(strlen($value)>0 && isset($value)){
                        $arrFields[] = " iwp_scheduled_routes.scheduled_start_date >= '$value'";   
                    }
                    break;
                case "to":
                    if(strlen($value)>0 && isset($value)){
                        $arrFields[] = " iwp_scheduled_routes.scheduled_start_date <= '$value'";
                    }
                    break; 
               
                if(isset($value)){                   
                    $facField[]= $value;$addtn ='';} 
                break;
                case "fac2":
                    if(isset($value)){                    
                        $facField[]= $value;$addtn ='';}
                    break;
                case "fac3":
                if(isset($value)){               
                    $facField[]= $value; $addtn ='';}
                    break;
                case "fac4":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
                case "fac5":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
                case "fac6":
                if(isset($value)){                
                    $facField[]= $value;
                    $facField[]= 25;$addtn ='';
                    }
                    break;
                case "fac7":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
                case "fac9":
                    if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
                case "fac8":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
                case "fac10":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
                    
               case "fac11":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
               case "fac12":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;
                    
                case "fac13":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                    break;              
                case "fac14":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac15":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac34":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac35":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac36":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac37":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac38":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac39":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac40":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac41":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac42":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac43":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac44":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac45":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac46":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac47":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac48":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac49":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
                case "fac50":
                if(isset($value)){                
                    $facField[]= $value;$addtn ='';}
                break;
            }
        }
         
        $criteria1 = "";
        $criteria2 = ""; 
         
        if(!empty($arrFields)){
             $criteria1 = " AND ( ". implode (" AND ",$arrFields)." )";             
        }
        
        if(!empty($facField)) {
            $criteria2 = " AND division IN ( ".implode (" , ", $facField)." )";
        }
         
        $ask = "SELECT $schedule_table.scheduled_start_date, 
                            $schedule_table.route_status,
                            $schedule_table.code_red, 
                            $schedule_table.schedule_id,
                            $schedule_table.account_no,
                            $schedule_table.issue_associated,
                            datediff( $schedule_table.scheduled_start_date, NOW( ) ) AS diff,
                            $account_table.status,
                            $account_table.account_ID,
                            $account_table.city,
                            $account_table.address,
                            $account_table.state,
                            $account_table.division,
                            $account_table.zip,
                            $account_table.estimated_volume,
                            $account_table.avg_gallons_per_Month,
                            $account_table.ticks_per_day,
                            $account_table.ticks_per_day * 30*7.56 as egpm,
                            $account_table.pickup_frequency,
                            $account_table.date_of_last_pickup as date_of_pickup,
                            $account_table.amount_of_last_pickup as inches_to_gallons
                             FROM $schedule_table 
                             LEFT JOIN $account_table ON $schedule_table.account_no = $account_table.account_ID 
                              WHERE $schedule_table.deleted=0 AND route_status IN ('scheduled') ";  
        echo $ask;
        $full =  $db->query($ask);
        //var_dump($full);
} else if( isset($_POST['show_creds']) ){
    $ask = "SELECT $schedule_table.scheduled_start_date, 
                    $schedule_table.route_status,
                    $schedule_table.code_red, 
                    $schedule_table.schedule_id,
                    $schedule_table.account_no,
                    $schedule_table.issue_associated,
                    datediff( $schedule_table.scheduled_start_date, NOW( ) ) AS diff,
                    $account_table.status,
                    $account_table.account_ID,
                    $account_table.city,
                    $account_table.address,
                    $account_table.state,
                    $account_table.division,
                    $account_table.zip,
                    $account_table.estimated_volume,
                    $account_table.avg_gallons_per_Month,
                    $account_table.ticks_per_day,
                    $account_table.ticks_per_day * 30*7.56 as egpm,
                    $account_table.pickup_frequency,
                    $account_table.date_of_last_pickup as date_of_pickup,
                    $account_table.amount_of_last_pickup as inches_to_gallons
                     FROM $schedule_table 
                     LEFT JOIN $account_table ON $schedule_table.account_no = $account_table.account_ID 
                      WHERE $schedule_table.deleted=0 AND code_red =1 AND route_status='scheduled' $addtn  "   ;
        echo $ask;
        $full = $db->query($ask);
}else { // ******************** DEFAULT ********************************
        /**/$ask = "SELECT 
                        $schedule_table.scheduled_start_date,
                        $schedule_table.route_status,
                        $schedule_table.code_red,
                        $schedule_table.schedule_id,        
                        $schedule_table.account_no,
                        datediff( $schedule_table.scheduled_start_date, NOW( ) ) AS diff,                
                        $account_table.status,
                        $account_table.account_ID,
                            $account_table.address,
                            $account_table.city,
                            $account_table.state,
                            $account_table.division,
                            $account_table.zip,
                            $account_table.estimated_volume,
                            $account_table.avg_gallons_per_Month,
                            $account_table.ticks_per_day,
                            $account_table.ticks_per_day * 30*7.56 as egpm,
                            $account_table.pickup_frequency
                             FROM $schedule_table LEFT JOIN $account_table ON $schedule_table.account_no = $account_table.account_ID WHERE  $schedule_table.deleted=0 AND route_status='scheduled'";
        echo $ask;
        $full = $db->query($ask);        
        
}
 //**********************************************************************
 //var_dump($full);
 
  
?>

   
<style type="text/css">
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
    overflow-x:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}

td{
    background:transparent;
    border:0px solid #bbb;  
    padding:5px 5px 5px 5px;  
    outline:1px solid #bbb;
}



tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}



input[type=checkbox]{
    width:10px;
}

.slide-out-div {
    padding: 2px 2px 2px 2px;
    width: 250px;
    background: #ccc;
    border: 1px solid #29216d;
}  

input[type=radio]{
    width:20px;
}
</style>
   
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "order": [ 3, 'asc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>       
<script src="js/tabslideout.js"></script>
<table style="width: 100%;margin:auto;"  id="myTable" class="ExcelTable2007">
    <thead>
        <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
        <th class="cell sorting" ><input type="submit" value="Del All" style="width: 50px;" id="del_selected_scheds"/></th>
        <th class="cell sorting"  >C\R</th>
        <th class="cell sorting"  >Status</th>
        <th  class="cell sorting" ><span title="Route Id">ID</span></th>        
        <th  class="cell sorting" >Scheduled</th>        
        <th  class="cell sorting"  >Name</th>
        <th  class="cell sorting"  >Address</th>
        <th  class="cell sorting"  >City</th>        
        <th  class="cell sorting"  >State</th>        
        <th  class="cell sorting"  >Zip</th>        
        <th  class="cell sorting"  >Facility Drop off</th>
        <th  class="cell sorting"  ><span title="Oil Pickup Frequency in days">Freq</span></th>        
        <th  class="cell sorting"  ><span title="Days Since Pickup Went Past Overdue">Past</span></th>        
        <th  class="cell sorting"  ><span title="Days Since Last Oil Pickup">Days</span></th>        
        <th  class="cell sorting"  >Last</th>        
        <th  class="cell sorting"  ><span title="Estimated Percentage of Capacity Used (Gallons Estimated)">%&nbsp;Full</span></th>        
        <th  class="cell sorting"  ><span title="Estimated Oil On Site">EOS</span></th>        
        <th  class="cell sorting"  ><span title="On Site Capacity in Gallons">Cap</span></th>        
        <th  class="cell sorting"  ><span title="Estimated Lbs Per Month">OIL @ last pickup</span></th>
        <th  class="cell sorting"  ><span title="Estimated Oil at Pickup">Oil @ pickup</span></th>
        <th  class="cell sorting"  >Issue Related</th>
        </tr>
    
    </thead>

<tbody>
    <?php

if( count($full)>0 ){
    $account = new Account();
    foreach($full as $scheduled){        
        echo "<tr id='p$scheduled[schedule_id]' class='kl heading'>
                <td style='vertical-align:middle;'>
                    <img src='img/delete-icon.jpg' class='delschedule' rel='$scheduled[schedule_id]' style='cursor:pointer;'/><br/>
                    <input type='checkbox' style='cursor:pointer;width:10px;height:50px;z-index:9999;' xlr='".$scheduled['account_no']."' rel='".$scheduled['schedule_id']."' class='setThisRoute'  title='schedule id:$scheduled[schedule_id] | account id:".$scheduled['account_no']." '/><br/>
                    <img src='img/355980.png' style='cursor:pointer;width:24%;height:24%;z-index:9999;margin-bottom:5px;' class='show_loc' rel='$scheduled[account_no]' title='Preview Account Location'/>
                </td>
                <td>".code_red($scheduled['code_red'])."</td>
                <td>".statusColors($scheduled['account_no'],$scheduled['route_status'])."</td>";
                $tod = explode (" ",$scheduled['scheduled_start_date']);
                echo "<td>$scheduled[schedule_id]</td>
                <td>$tod[0] <img src='img/edit-icon.jpg' rel='$scheduled[schedule_id]' style='cursor:pointer;' class='change_date'/></td>
                <td>".account_NumtoName($scheduled['account_no'])."</td>
                <td>$scheduled[address]</td>
                <td>$scheduled[city]</td>
                <td>$scheduled[state]</td>
                <td>$scheduled[zip]</td>
                <td>".oilFacList("",$scheduled['division'],$scheduled['account_no'])."</td>
                <td><span class='change_freq' style='cursor:pointer;text-decoration:underline;color:blue;font-weight:bold;' rel='$scheduled[account_no]'>$scheduled[pickup_frequency]</span></td>"; 
                echo"<td>$scheduled[diff]</td>";
                echo "<td>".date_different( $scheduled['date_of_pickup'] ,date("Y-m-d")). "</td>";
                echo "<td>$scheduled[date_of_pickup]</td>";//last pickup
                
                echo "<td>";                    
                    $cap = $account->barrel_cap($scheduled['account_no']);// does this account have any barrels assigned to it?          
                    if($cap != 0){
                        $lko = round( ($scheduled['avg_gallons_per_Month']/  $cap   ) *100   ,2);
                        
                        echo  $lko;//Estimated Percentage of Capacity Used (Gallons Estimated)
                    } else {
                        echo 0;
                    }
                echo "</td>";
                echo "<td>$scheduled[avg_gallons_per_Month]</td>";//Estimated Oil On Site
                echo "<td>$cap</td>";//On Site Capacity in Gallons
                echo "<td><span title='$scheduled[date_of_pickup]'>$scheduled[inches_to_gallons]</span></td>";//Estimated Gallons Per Month
                $hol = explode(" ", $scheduled['date_of_pickup']  );
                $number =date_different($hol[0],$scheduled['scheduled_start_date']);
                echo "<td>".number_format($number * $scheduled['ticks_per_day'],2 ) ."</td>";
                
                echo "<td>";
                        if( strlen( trim($scheduled['issue_associated'] ) )  >0  ){
                            echo "<img src='img/purp.png' style='width:25px;height:25px;'/>";
                        }else{
                            echo "<img src='img/assign.png' style='width:25px;height:25px;cursor:pointer;' class='assign' rel='$scheduled[account_no]' xlr='$scheduled[schedule_id]' />";
                        }
                echo "</td>";
            echo "</tr>";
    }
}
?>
</tbody>



</table>

<div id="debug"></div>
<div class="slide-out-div">
    <a class="handle" style="cursor:pointer;" title="Quick Route">Route Now</a>
    <br />
    <form method="post" action="oil_routing.php" name="schedtoikg" class="schedtoikg" target="_blank">                        
    <input type="radio" class="new" />&nbsp;Create New Route
    
    <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"  readonly=""/>
    <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers"  readonly=""/>
    <input type="hidden"  name="from_schoipu" value="1" readonly=""/>
    </form><br />
    <form method="post" class="add_to_form" action="oil_routing.php" method="post" target="_blank" name="add_to_form">
    <input type="hidden" name="from_routed_oil_pickups" id="from_routed_oil_pickups" title="from_routed_oil_pickups" value="1"/><input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers" readonly=""/>
    <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" readonly=""/>
    <input type="hidden" name="extra_mode" value="1"/>&nbsp;
    <input type="radio" name="route"  class="existing"  id="route" value="exist" style="float: left;"/>
    <span style="float: left;">Add to Existing Route</span><br /><br />
    <select name="manifest" class="manifest"  style="float: left;">
    <?php  
      $route_list_table = $dbprefix."_list_of_routes";
        $scrts = $db->query("SELECT route_id,ikg_manifest_route_number,driver FROM $route_list_table WHERE status IN('new','enroute','scheduled') AND deleted =0");
        
        if(count($scrts)>0){
            foreach($scrts as $add_existing){
                echo "<option value='$add_existing[route_id]'>$add_existing[route_id] $add_existing[ikg_manifest_route_number] (".uNumtoName($add_existing['driver']).")</option>";
            }
        }
    ?></select><br /><br /><input style="color: black;width:60px;float:right;" type="submit" value="submit" name="schedule_us" class="schedule_us" />
    </form>
</div>

<script>
$(".manifest").change(function(data){
    var _value=$(this).val();
    
    $(".manifest").val( _value);    
});

$('.assign').click(function(){
    Shadowbox.open({
        player:"iframe",
        content:"assign_issue.php?account_no="+$(this).attr('rel')+"&schedule_id="+$(this).attr('xlr')+"",
        width:"800px",
        height:"600px",
        options: { 
            modal:   true
        }
    });   
});


$('.slide-out-div').tabSlideOut({
    tabHandle: '.handle',                     //class of the element that will become your tab
    pathToTabImage: 'img/img/contact_tab.gif', //path to the image for the tab //Optionally can be set using css
    imageHeight: '122px',                     //height of tab image           //Optionally can be set using css
    imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
    tabLocation: 'left',                      //side of screen where tab lives, top, right, bottom, or left
    speed: 300,                               //speed of animation
    action: 'click',                          //options: 'click' or 'hover', action to trigger animation
    topPos: '550px',                          //position from the top/ use if tabLocation is left or right
    leftPos: '10px',                          //position from left/ use if tabLocation is bottom or top
    fixedPosition: true                      //options: true makes it stick(fixed position) on scroll
});


function  count_col(){
    $("#myTable tr td:nth-child(1)").each(function (i) {
          
    });
}

$("#all_pro").click(function(){
    if( $(this).is(":checked") )  {  
        
    }else{
        
    }
});

$(".show_loc").click(function(){
   Shadowbox.open({
        player:"iframe",
        content:"preview_loc.php?account_no="+$(this).attr('rel')+"",
        width:"800px",
        height:"600px",
        options: { 
            modal:   true
        }
   }); 
});




$(".change_freq").click(function(){
    Shadowbox.open({
        player:"iframe",
        content:"change_freq.php?account_no="+$(this).attr('rel')+"",
        width:"250px",
        height:"250px",
        options: { 
            modal:   true
        }   
   });  
});


function numberColumnJq(){
    $("#myTable tr td:nth-child(4)").each(function () {        
        var sched_id = $(this).html();
        var row =$(this).closest("tr");
        $.ajax({
            type: "POST",
            url: "remove_unavail.php",
            data: { sched:sched_id }
            }).done(function( msg ) {
                 if(msg == "unavai"){// check if route has been routed, if it has been, dynamically remove it from the visible list
                    $(row).remove();
                    $("#debug").append("routed and removed - "+ sched_id+"<br/>");
                }
        });
    });
}

setInterval("numberColumnJq();",5000);

$(".paginate_button").click(function(){//when clicking on a pagination check dynamically if routes were routed
    numberColumnJq();
});

$("#del_selected_scheds").click(function(){
    if(confirm("Are you sure you wish to delete these stops?")){
         $.post("del_selected_scheds.php",{selected_scheds:$(".schecheduled_ids").val()},function(data){
            alert(data);
            window.location.reload();
         });
    }
});


$("table").on("click",".setThisRoute",function(){
   if($(this).is(":checked")  ){
        $(".schecheduled_ids").val( $(".schecheduled_ids").val() + $(this).attr('rel')+"|"  );
        $(".accounts_checked").val( $(".accounts_checked").val() + $(this).attr('xlr')+"|" );
    }else {        
        var replace =$(this).attr('rel')+"|";
        var newVal =  $(".schecheduled_ids").val().replace(replace,"");
        $(".schecheduled_ids").val(newVal);
        var replace1 = $(this).attr('xlr')+"|";
        var newVal2 =  $(".accounts_checked").val().replace(replace1,"");
        $(".accounts_checked").val(newVal2);
    }
});



$(".existing").click(function(){
    $(".existing").prop('checked',true);
    $(".new").prop('checked', false);
});

$(".new").click(function(){
    $(".new").prop('checked',true);
    $(".existing").prop('checked', false);
});

$("#map_code_red").click(function(){
   window.open('mapcodered.php');
});



$(".schedule_us").click(function(e){
    if($(".existing").is(":checked")){
        $(".add_to_form").submit();  
    }
    
    
    if( $(".new").is(":checked") ){
         $(".schedtoikg").submit();
    }
    
    e.preventDefault();
});

function reload(){
    if(confirm("Reload Page for changes to take effect?")){
     window.location.reload();
   }
}

$(".change_date").click(function(){
   Shadowbox.open({
        player:"iframe",
        content:"changeScheduled_date.php?schedule_id="+$(this).attr('rel')+"",
        width:"400px",
        height:"100px",
        options: { 
            modal:   true,
            onClose: reload
        }   
   }); 
});

$("#reset").click(function(){   
   window.location='scheduling.php?task=schoipu'; 
});

$(".delschedule").click(function(){
   if(confirm("Are you sure you want to delete this stop?")){
    $.get("adminDeleteSched.php",{sched_id: $(this).attr('rel') },function(){
        location.reload();
    }); 
   }
});

$(".cfac").change(function(){
    $.post("change_fac.php",{account_no:$(this).attr('rel'),facility:$(this).val()},function(data){
        alert("Facility Changed!"); 
    });
});

$(".fac").click(function(data){
    var u = $(this).val();
    if( $(this).is(":checked") )  {
        $("input#facsx").val( $("input#facsx").val() + $(this).val()+"|"  );
    }else{
        var replace =u+"|";
        var newVal =  $("input#facsx").val().replace(replace,"");
        $("input#facsx").val(newVal);
    }
});

$("#alluc").click(function(data){
    if( $(this).is(":checked") )  {         
         $("input#facsx").val("24|31|32|33|34|");
    }else{
         $("input#facsx").val("");
    }
});

$("#all").click(function(){
   if ( $(this).is(":checked") ){
        $(".fac").prop("checked",true);
        $("input#facsx").val("24|31|32|33|34|23|8|5|12|13|10|11|14|15|22|");
   } else{
        $(".fac").prop("checked",false);
        $("input#facsx").val("");
   }
});


$("#allariz").click(function(){
    if( $(this).is(":checked") ){
        $(".ariz").prop('checked',true); 
    }else{
        $(".ariz").prop('checked',false); 
    }
});

</script>