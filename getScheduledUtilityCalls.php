<?php
ini_set("display_errors",1);
$account_table = $dbprefix."_accounts";
$utility_table = $dbprefix."_utility";
$addtn ='';
//if($person->isFriendly()){
//    $addtn = " AND $account_table.friendly like '%$person->first_name%'";
//} else if($person->isCoWest()){
//    $addtn = "AND $account_table.division = 15";
//}else{
//    $addtn =" AND $account_table.division = $person->facility";
//}




if(isset($_POST['search_now'])){
     foreach($_POST as $name=>$value){
            switch($name){    
                case "only_issues":
                    if(strlen(trim($value))>0){
                        $arrFields[]= " issue_associated IS NOT NULL";
                    }
                break;
                case "timesearch":
                    if(strlen(trim($value)) >0){
                        $arrFields[] = " date_of_service like '%".$value."%'";
                    }
                    break;
                case "id":
                    if( strlen(trim($value))>0){
                        $arrFields[] = " utility_sched_id=".$value;
                    }
                    break;
                case "name":
                    if( strlen(trim($value))>0){
                        $arrFields[] = " name like '%".$value."%'";
                    }
                    break;
                case "address":
                    if(strlen(trim($value)) >0){
                        $arrFields[] = " address='".$value."'";
                    }
                    break;
                case "city":
                    if( strlen(trim($value))>0){
                        $value = str_replace(" ","%",$value);
                        $arrFields[] = " city like '%".$value."%'";
                    }
                    break;
                case "state":
                    if( strlen(trim($value))>0){
                        $arrFields[] = " state = '".$value."'";
                    }
                    break;   
                case "zip":
                    if( strlen(trim($value))>0){
                        $arrFields[] = " zip = $value";
                    }
                    break;               
                
                case "fac1":
                if(isset($name)){                   
                    $facField[]=$value;} 
                break;
                case "fac2":
                    if(isset($name)){                    
                        $facField[]=$value;}
                    break;
                case "fac3":
                if(isset($name)){               
                    $facField[]=$value; }
                    break;
                case "fac4":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                case "fac5":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                case "fac6":
                if(isset($name)){                
                    $facField[]=$value;
                    $facField[]="25";
                    }
                    break;
                case "fac7":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                case "fac8":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                case "fac9":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                 case "fac10":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                    
               case "fac11":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                    
                    
               case "fac12":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;
                    
                case "fac13":
                if(isset($name)){                
                    $facField[]=$value;}
                    break;    
                case "fac14":
                if(isset($name)){                
                    $facField[]=$value;}
                break;
                case "fac15":
                if(isset($name)){                
                    $facField[]=$value;}
                break;


                case "fac34":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac35":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac36":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac37":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac38":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac39":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac40":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac41":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac42":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac43":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac44":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac45":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac46":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac47":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac48":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac49":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;
                case "fac50":
                    if(isset($value)){
                        $facField[]= $value;}
                    break;




            }
        }
         
        $criteria1 = "";
        $criteria2 = "";
         
        if(!empty($arrFields)){
             $criteria1 = " AND ( ". implode (" AND ",$arrFields)." )";             
        }
        
        if(!empty($facField)) {
            $criteria2 = " AND division IN( ".implode (" , ", $facField)." )";
        }
        
        $search_string = "SELECT  iwp_issues.issue, $utility_table.*, $account_table.division, $account_table.name ,$account_table.city, $account_table.state, $account_table.zip,$account_table.account_ID,$account_table.state_date,$account_table.expires,$account_table.address FROM $utility_table INNER JOIN $account_table  ON $utility_table.account_no = $account_table.account_ID  LEFT JOIN iwp.iwp_issues ON iwp_issues.issue_no = $utility_table.issue_associated WHERE $utility_table.deleted =0 AND route_status IN('scheduled','new') $addtn". $criteria1." ".$criteria2 ;
         echo $search_string;
         $check  = $db->query($search_string);
        
} else if( isset($_POST['scrs']) ){
    $search_string = "SELECT iwp_issues.issue, $utility_table.*, $account_table.division, $account_table.name,$account_table.city, $account_table.state, $account_table.zip,$account_table.address FROM $utility_table INNER JOIN $account_table  ON $utility_table.account_no = $account_table.account_ID LEFT JOIN iwp.iwp_issues ON iwp_issues.issue_no = $utility_table.issue_associated  WHERE $utility_table.deleted =0 AND  route_status IN('scheduled','new') AND $utility_table.code_red =1 $addtn" ;
    $check  = $db->query($search_string);
} else  {
    $search_string = "SELECT  iwp_issues.issue, $utility_table.*, $account_table.division, $account_table.name,$account_table.city, $account_table.state, $account_table.zip,$account_table.address FROM $utility_table INNER JOIN $account_table  ON $utility_table.account_no = $account_table.account_ID LEFT JOIN iwp.iwp_issues ON iwp_issues.issue_no = $utility_table.issue_associated WHERE $utility_table.deleted =0 AND  route_status IN('scheduled','new') $addtn" ;
    echo $search_string;
    $check  = $db->query($search_string);
}


?>


<style type="text/css">
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
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
    padding:0px 0px 0px 0px;  
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
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>

<table  style="width: 100%;margin:auto;" id="myTable" >
<thead>
<tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
   
    <td class="cell_label" style="width: 20px;"><input type='submit' value="Del All" id="del_selected_scheds"/></td>
    <td class="cell_label">&nbsp;</td>
    <td class="cell_label">Code Red</td>
    <td class="cell_label">Status</td>
    <td class="cell_label">ID</td>
    <td class="cell_label"><span title="Time Of Day">T.O.D</span></td>
    <td class="cell_label">Type</td>
    <td class="cell_label">Issue Code</td>
    <td class="cell_label">Class</td>
    <td class="cell_label">Num</td>
    <td class="cell_label">Address</td>
    <td class="cell_label">City</td>
    <td class="cell_label">State</td>
    <td class="cell_label">Note</td>
    <td class="cell_label">Scheduled</td>
    <td class="cell_label">Name</td>
    <td class="cell_label">Facility</td>
    <td class="cell_label">Issue</td>
</tr>
</thead>
<tbody>
<?php
if(count($check)>0){
    $acnt_info = new Account();
    foreach($check as $utility){
        $newtod = explode(" ",$utility['date_of_service']);
        echo "<tr>
            <td><img src='img/delete-icon.jpg' rel='".$utility['utility_sched_id']."' class='delutil' style='cursor:pointer'/></td>
            <td style='text-align:left;'>
                <input type='checkbox' class='setThisRoute' xlr='".$utility['account_no']."' rel='".$utility['utility_sched_id']."' title='account | ".$utility['account_no']." - sched_id | ".$utility['utility_sched_id']."  '/></td>
            <td>".code_red($utility['code_red'])."</td>
            <td>$utility[route_status]</td>
            <td>"; 
           echo "$utility[utility_sched_id]"; 
             echo "</td>
            <td>$newtod[1] </td>
            <td>";
                service_call_decode($utility['type_of_service']);
            echo "</td>
            <td>";
                ZG_Decode($utility['issue']);
            echo"</td>
            <td>$utility[container_size]</td>
            <td>".containerNumToName("$utility[container_label]")."</td>
            <td>$utility[address]</td>
            <td>$utility[city]</td>
            <td>$utility[state]</td>
            <td>$utility[dispatcher_note]</td>
            <td><img src='img/edit-icon.jpg' class='change_date' rel='$utility[utility_sched_id]' style='cursor:pointer;'/> $newtod[0]</td> 
            <td><img class='change_service' rel='$utility[utility_sched_id]' account='$utility[account_no]'  style='cursor:pointer;' src='img/edit-icon.jpg'/></a>&nbsp;".account_NumtoName($utility['account_no'])."</td>
            <td>".numberToFacility($utility['division'])."</td>
            ";
            echo "<td>";
                if(strlen(trim($utility['issue_associated']))>0){
                    echo "<img src='img/purp.png' style='width:25px;height:25px;'/>";    
                }
            echo "</td>
        </tr>";
    }
}
?>
</tbody>
</table>
<script>
function reload(){
   if(confirm("Reload Page for changes to take effect?")){
     window.location.reload();
   }
}


$(".change_service").click(function(){
       Shadowbox.open({
         player:"iframe",
        content:"edit_util_stop.php?schedule_id="+$(this).attr("rel")+"&account="+$(this).attr('account')+"",
        width:"650px",
        height:"500px",
        options: { 
            modal:   false,
            onClose: reload
        }   
   });
});


$("#del_selected_scheds").click(function(){
    alert($(".schecheduled_ids").val());
    if(confirm("Are you sure you wish to delete these stops?")){
         $.post("del_selected_scheds_util.php",{selected_scheds:$(".schecheduled_ids").val()},function(data){
            alert(data);
            window.location.reload();
         });
    }
 });

$(".change_date").click(function(){
    Shadowbox.open({
         player:"iframe",
        content:"change_util_date.php?util_id="+$(this).attr('rel')+"",
        width:"300px",
        height:"300px",
        options: { 
            modal:   false,
            onClose: reload
        }   
   }); 
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

$("#all").click(function(){
    if( $(this).is(":checked") ){
        $(".fac").prop("checked",true);
    }else{
        $(".fac").prop("checked",false);
    }
});


$("#alluc").click(function(){
    if( $(this).is(":checked") ){
        $(".uc").prop("checked",true);
    }else{
        $(".uc").prop("checked",false);
    }
});

$(".existing").click(function(){
    $(".new").prop('checked', false);
});

$(".new").click(function(){
    $(".existing").prop('checked', false);
});


/*
$("#schedule_us").click(function(e){
    if($(".existing").is(":checked")){
        $("form#add_to_form").submit();  
    }
    
    
    if( $(".new").is(":checked") ){
         alert("check new");
         $("form#newutil").submit();
    }
    
    
});*/

$("#todsearch").timepicker();

$("#reset").click(function(){   
   window.location='scheduling.php?task=suc'; 
});

function numberColumnJq(){
    $("#myTable tr td:nth-child(4)").each(function () {        
        var sched_id = $(this).html();
        var row =$(this).closest("tr");
        $.ajax({
            type: "POST",
            url: "remove_util_unavail.php",
            data: { sched:sched_id }
            })
            .done(function( msg ) {
                 if(msg == "unavai"){// check if route has been routed, if it has been, dynamically remove it from the visible list
                    $(row).remove();
                    $("#debug").append("routed and removed - "+ sched_id+"<br/>");
                }
        });
    });
}

setInterval("numberColumnJq();",5000);

$(".delutil").click(function(){    
    if(confirm("Are you sure you want to delete this stop?")){
        $.get("adminDelUtil.php",{ util_id: $(this).attr('rel') },function(data){
            alert("Stop deleted");
            location.reload();
        });
    }
});

</script>
