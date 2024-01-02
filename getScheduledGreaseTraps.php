<?php
$grease_table = $dbprefix."_grease_traps";
$account_table = $dbprefix."_accounts";
$addtn ='';
if($person->isFriendly()){
    $addtn = " AND $account_table.friendly like '%$person->first_name%'";
} else if($person->isCoWest()){
    $addtn = " AND $account_table.division IN( 15,24,30,31,32,33)";
}


if( isset($_POST['search_now'])  ){ //********************  POSTED SEARCH  ********************************
    foreach($_POST as $name=>$value){
            switch($name){
                case "tod":
                    if(strlen($value)>0){
                        if($value == "am"){
                            $arrFields[] = "( TIME(date)  < '12:00:00' || TIME(date) > '00:00:00' )";    
                        } else if($value == "pm"){
                            $arrFields[] = " ( TIME(date) >= '12:00:00' || TIME(date) <= '23:59:59' )";
                        }
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
                        $arrFields[] = " state_date >= '$_POST[from]'";   
                    }
                    break;
                case "to":
                    if(strlen($value)>0 && isset($value)){
                        $arrFields[] = " expires <= '$_POST[to]'";
                    }
                    break; 
                case "fac1":
                if(isset($name)){                   
                    $facField[]=" division =".$value;} 
                    break;
                case "fac2":
                    if(isset($name)){                    
                        $facField[]=" division =".$value;}
                    break;
                case "fac3":
                if(isset($name)){               
                    $facField[]=" division =".$value; }
                    break;
                case "fac4":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                case "fac5":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                case "fac6":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                case "fac7":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                case "fac8":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                case "fac9":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                 case "fac10":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                    
               case "fac11":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
               case "fac12":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;
                    
                case "fac13":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                    break;   
                case "fac14":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                break;  
                case "fac15":
                if(isset($name)){                
                    $facField[]=" division =".$value;}
                break;             
            }
        }
       $criteria1 ="";
       $criteria2 = "";  
         
        if(!empty($arrFields)){
             $criteria1 = " AND ( ". implode (" AND ",$arrFields)." )";             
        }
        
        if(!empty($facField)) {
            $criteria2 = " AND ( ".implode (" OR ", $facField)."  )";
        }
         
        $ask = " SELECT $grease_table.*, 
                    $account_table.name ,
                    $account_table.account_ID,
                    $account_table.city,
                    $account_table.state,
                    $account_table.division,
                    $account_table.zip,
                    $account_table.estimated_volume,
                    $account_table.avg_gallons_per_Month,
                    $account_table.grease_volume 
                        FROM $grease_table INNER JOIN $account_table ON $grease_table.account_no = $account_table.account_ID WHERE $grease_table.deleted =0 AND $grease_table.route_status IN('scheduled') ".$criteria1." ".$criteria2;  
         
        echo "ssearch: ".$ask.$addtn;
        $check =  $db->query($ask);


} else if( isset($_POST['scrs']) ){
    $check = $db->query("SELECT * FROM $grease_table WHERE  route_status IN('scheduled')&& fire =1 $addtn");
} else {
    
    //echo "SELECT $grease_table.*,$account_table.division FROM $grease_table LEFT JOIN $account_table ON $account_table.account_id = $grease_table.account_no WHERE (route_status = 'scheduled' || route_status ='new') && grease_route_no IS NULL $addtn";
    $check = $db->query("SELECT $grease_table.*,$account_table.division,$account_table.grease_volume FROM $grease_table LEFT JOIN $account_table ON $account_table.account_id = $grease_table.account_no WHERE $grease_table.deleted =0 AND route_status IN('scheduled')  $addtn");
    
    
}

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



input[type=checkbox]{
    width:10px;
}
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>
<table style="width: 100%;margin:auto;"  id="myTable" >

<thead>
    <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">

<?php 
            if($person->isAdmin()){
                echo '<th class="cell_label">&nbsp;</a></th>';
            }
        ?>
    <td class="cell_label">&nbsp;</td>
    
    
    <td class="cell_label">Status</a></td>
    
    <td class="cell_label">Created</span></a></td>
    <td class="cell_label">ID</span></a></td>
    <td class="cell_label"> Trap Volume</a></td>
    
    
    
    
    <td class="cell_label">Note</td>
    
    <td class="cell_label">Scheduled</a></td>
    
    
    <td class="cell_label">Name</a></td>
    <td class="cell_label">Address</td>
    <td class="cell_label">City</a></td>
    
    
    <td class="cell_label">State</a></td>
    
    <td class="cell_label">Zip</a></td>
    
    <td class="cell_label">Facility</a></td>
    
    
    </tr>
</thead>

<tbody>

<?php

if(count($check)> 0){
    $acnt = new Account();
    foreach($check as $grease){
        echo "<tr>";
        echo "<td><input type='checkbox' class='setThisRoute' style='cursor:pointer;width:50px;height:50px;z-index:9999;'   xlr='".$grease['account_no']."' rel='".$grease['grease_no']."' /></td>";

if($person->isAdmin()){
                          echo '<td><img class="del_route" src="img/delete-icon.jpg" style="cursor:pointer;" rel="'.$grease['grease_no'].'" /></td>';
                              }
        echo "<td>$grease[route_status]</td>";
        echo "<td>$grease[date]</td>";
        echo "<td>"; 
        
        echo "$grease[grease_no]";  
        
         echo "</td>";
        echo "<td>$grease[grease_volume]</td>";
        echo "<td>".$acnt->singleField($grease['account_no'],"notes")."</td>";
        echo "<td>$grease[service_date]</td>";
        echo "<td>".$acnt->formatted_Name($grease['account_no'])."</td>";
        echo "<td>". $acnt->singleField($grease['account_no'],"address") ."</td>";
        echo "<td>". $acnt->singleField($grease['account_no'],"city") ."</td>";
        echo "<td>". $acnt->singleField($grease['account_no'],"state") ."</td>";
        echo "<td>". $acnt->singleField($grease['account_no'],"zip") ."</td>";
        echo "<td>".numberToFacility($acnt->singleField($grease['account_no'],"division"))."</td>";
        echo "</tr>";
    }
}

?>
</tbody>
</table>
<div id="debug"></div>
<script>

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
    $(".new").prop('checked', false);
});

$(".new").click(function(){
    $(".existing").prop('checked', false);
});



$("#schedule_us").click(function(e){
    if($(".existing").is(":checked")){
        $("form#add_to_form").submit();  
    }
    
    
    if( $(".new").is(":checked") ){
         $("form#schedgreasetoikg").submit();
    }
    
    e.preventDefault();
});



$("#reset").click(function(){   
   window.location='scheduling.php?task=sgt'; 

});






$(".del_route").click(function(){
   if( confirm("Are you sure you wish to delete this stop?") ){
        $.post("delete_stop_grease.php",{schedule:$(this).attr('rel'),table:"iwp_grease_traps",field:"grease_no"  },function(data){
            alert("stop deleted!" + data);
            location.reload();
        })

} 


});


function numberColumnJq(){
    $("#myTable tr td:nth-child(4)").each(function () {        
        var sched_id = $(this).html();
        var row =$(this).closest("tr");
        $.ajax({
            type: "POST",
            url: "remove_grease_unavail.php",
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

//setInterval("numberColumnJq();",5000);

$(".delgrease").click(function(data){
    $.get("adminDelGrease.php",{grease_no: $(this).attr('rel') },function(data){
        alert("Grease Stop deleted");
        location.reload();
    });
});

</script>
