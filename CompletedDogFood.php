<?php

include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);

if(isset($_POST['filter'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "from":
                if(strlen(trim($value) ) >0 ){
                    $arrField[]= "DATE(ap_form_49773.date_created) >= '$value'";    
                }
            break;
            case "to":
                if(strlen(trim($value) ) >0 ){
                    $arrField[]= "DATE(ap_form_49773.date_created) <= '$value'";    
                }
            break;
        }
    }
    $string ="";
    if(!empty($arrField)){
        $string = " AND ".implode(" AND ", $arrField);    
    }
    
        
    $compl = $db->query("SELECT ap_form_43256.element_151,ap_form_49773.*,ap_form_43256.element_144 as tsl_wtn_pic,ap_form_43256.element_145,ap_form_43256.element_1 as tcl_type,ap_form_43256.id as truck_id,ap_form_43256.element_129 as pet_load_type,ap_form_43256.element_14 as inbound_load_type FROM Inetforms.ap_form_49773 INNER JOIN Inetforms.ap_form_43256 ON ap_form_49773.element_76 = ap_form_43256.id  WHERE ap_form_49773.element_3 IN ('Completed','Rejected') $string");
}else{
    $year = date("Y");
    $month = date("m");
    $compl = $db->query("SELECT ap_form_43256.element_151,ap_form_49773.*,ap_form_43256.element_144 as tsl_wtn_pic,ap_form_43256.element_145,ap_form_43256.element_1 as tcl_type,ap_form_43256.id as truck_id,ap_form_43256.element_129 as pet_load_type,ap_form_43256.element_14 as inbound_load_type FROM Inetforms.ap_form_49773 INNER JOIN Inetforms.ap_form_43256 ON ap_form_49773.element_76 = ap_form_43256.id  WHERE ap_form_49773.element_3 IN ('Completed','Rejected') AND DATE(ap_form_49773.date_created) >='$year-$month-01' AND DATE(ap_form_49773.date_created) <='$year-$month-".date('t')."'");
    
}



?>
<style type="text/css">
body{
    background:url(img/bodystrip.jpg) repeat-x left 7px;
}
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

td ,th{
    background:transparent;
    
    padding:10px 10px 10px 10px;
    margin:3px 3px 3px 3px;
    white-space: nowrap;
    text-align: center;
    width:auto;
}
tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}
img{
    max-width:100%;
    max-height:100%;
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}
#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
}
table{
    border-spacing: 15px;
    border-collapse: separate;
}
input[type=checkbox]{
    width:10px;
}
</style>
<script>
Shadowbox.init();
$(document).ready(function(){    
   $('#myTable').dataTable({
        "order": [ 4, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>   
<div id="space_top" style="height:97px;width:100%;background:rgba(255,255,255,.4)"></div>
<form action="CompletedDogFood.php" method="POST">
<table style="width: 90%;margin:auto;margin-top:10px;table-layout:fixed;">
<tr><td style="text-align: left;"><img src="bakery/img/blogo.jpg" style="position:relative;"/></td><td></td><td></td><td></td><td></td></tr>
<tr><td style="text-align: left;"><div id="space_top" style="height:97px;width:100%;background:rgba(255,255,255,.4)"></div></td><td><input type="text" name="from" placeholder="FROM date created" id="from" style=" border-radius: 10px;" value="<?php
        if(isset($_POST['filter'])){
            echo $_POST['from'];
        }
     ?>"/></td><td style="text-align: center;">TO</td><td><input type="text" name="to" placeholder="TO date created" id="to" value="<?php
        if(isset($_POST['filter'])){
            echo $_POST['to'];
        }
     ?>"/></td><td>Status&nbsp;<select name="status"><option>--</option><option value="completed"  <?php
        if(isset($_POST['filter'])){
           if($_POST['status']=="completed"){ echo " selected ";}
        }
     ?>>Completed</option><option value="rejected"  <?php
        if(isset($_POST['filter'])){
           if($_POST['status']=="rejected"){ echo " selected ";}
        }
     ?>>Rejected</option></select></td><td><input type="submit" value="Filter" name="filter"/></td></tr>
</table>
</form>


<table style="margin:auto;"  id="myTable">
    <thead>
    
    <tr>
    
   
    
    <th style="width: 55px;">DELETE</th>
    <th style="width: 55px;">Pending Final Approval</th>
    <th style="width: 100px;">Edit TCL</th>
    <th>Req Id</th>
    <th>Date</th>  
    <th>Seal Number</th>  
    <th>Status</th>
    <th>TCL TYPE</th> 
    <th>Load Type</th>
    <th>Truck Request #</th>
    <th>Weight Ticket</th>
    <th>Incoming Net Weight</th>
    <th>Net Weight</th>
    <th>Release/Sale #</th>
    <th>Inbound WC</th>
    <th>Note</th>
    <th>Operator Name</th>
    <th>Request Date</th>
    <th>Requestor</th>
    <th>Area</th>
    <th>Type</th>
    <th>Tank</th>
    <th>Details</th>
    <th>SPOT #</th>
    <th style="width: 100px;">Tech Notes</th>
    
    <th>View Weight Certificate</th>
    <th>Incoming Weight Certificate</th>
    <th>C.O.D. Link</th>
    <th>2nd C.O.D. Link</th>
    <th>View Lab</th>
    <th style="width: 100px;">Bol/Support</th>
    
    </tr>
    </thead>
    <tbody>
    <?php
        if(count($compl)>0){
            foreach($compl as $jh){
                
                switch($jh['element_4']){
                    case 4: $op = "Ruben"; break;
                    case 5: $op = "Ricardo"; break;
                    case 6: $op = "Ivan"; break;
                    case 7: $op = "Johhny"; break;
                    case 8: $op = "Joe"; break;
                    case 9: $op = "Daniel"; break;
                    case 10: $op = "Omar"; break;
                    case 11: $op = "Pablo"; break;
                    case 12: $op = "Other"; break;
                    default: $op = "N/A"; break;
                }
                
                echo "<tr>";
                echo "<td><img src='img/delete-icon.jpg' rel='$jh[id]' xlr='$jh[element_76]' class='del_cod' style='cursor:pointer;'/></td>";
                echo "<td style='width:100px;'><img src='images/deconstruct.png' title='Pending Approval' style='cursor:pointer;width:15%;' rel='$jh[id]' class='approve_completed_destruction'/></td>";
                echo "<td style='width:100px;'><img src='img/edit-icon.jpg' title='EDIT TCL entry' style='cursor:pointer;' rel='$jh[element_76]' class='tcl_edit' xlr='$jh[id]'/></td>";
                echo "<td>$jh[id]</td>";//req id destruction cert #
                echo "<td>$jh[date_created]</td>";//date
                echo "<td>"; 
                if(strlen($jh['element_134'])>0){//seal number                 
                    echo "<span style='cursor:pointer;text-decoration:underline;color:blue;' class='seal' rel='https://inet.iwpusa.com/machforms/machform/data/form_49773/files/$jh[element_134]'>";
                }
                echo "$jh[element_88]"; 
                if(strlen($jh['element_134'])>0){
                    echo "</span>";
                }
                echo "</td>";
                echo "<td>$jh[element_3]</td>";//status
                
                
                echo "<td>";
                switch($jh['tcl_type']){
                    case 9:echo "Pet Food";break;
                    case 1:echo "Inbound";break;
                    break;
                }
                echo "<td>"; 
                switch($jh['tcl_type']){
                    case 9:
                        switch($jh['pet_load_type']){
                            case 1: echo "ByProduct Ext Boxed"; break;
                            case 4: echo "Corrugated"; break;
                            case 5: echo "PP Bags"; break;
                            case 6: echo "Compost"; break;
                            case 7: echo "Waste to Energy"; break;
                            case 3: echo "Other"; break;
                        }
                    break;
                    case 1:
                        switch($jh['inbound_load_type']){
                            case 6:  echo "Almond Ground Shell"; break;
                            case 13: echo "Almond Meal"; break;                    
                            case 25: echo "Candy"; break;
                            case 10: echo "Chocolate"; break;                   
                            case 21: echo "Dressing"; break;                  
                            case 8:  echo "North Star Mayo"; break;
                        }
                    break;
                }
                
                echo "</td>";
                echo "<td>$jh[truck_id]</td>";//truck request (truck scale log #))
                echo "<td>$jh[element_77]</td>";//weight ticket
                echo "<td>$jh[element_184]</td>";//incoming net weight
                echo "<td>$jh[element_189]</td>";
                echo "<td>$jh[element_82]</td>";// release sale
                echo "<td>$jh[element_83]</td>";//inbound
                echo "<td>$jh[element_84]</td>";//note
                
                
                echo "<td>$op</td>";//op name
                echo "<td>$jh[element_8]</td>";//request date
                echo "<td>$jh[element_10]</td>";//requestor
                echo "<td>$jh[element_11]</td>";//area
                echo "<td>$jh[element_12]</td>";//type
                echo "<td>$jh[element_13]</td>";//tank
                echo "<td><span class='details' style='cursor:pointer;color:blue;text-decoration:underline;' rel='$jh[id]'>Details</span></td>";
                echo "<td>$jh[element_14]</td>";//spot
                echo "<td class='notes' rel ='$jh[element_644]' style='text-overflow: ellipsis; overflow: hidden;width:100px;'>$jh[element_644]</td>";
                
                
                echo "<td>";                
                    if($jh['tsl_wtn_pic'] != NULL && strlen($jh['tsl_wtn_pic'])>0){                       
                        echo "<img src='img/23117-200.png' style='width:20%;cursor:pointer;text-decoration:underline;' class='tsl_wtn_pic' rel='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$jh['tsl_wtn_pic']."'/>";
                    }else{
                        echo "N/A";
                    }
                
                echo "</td>
                <td>"; 
                    if($jh['element_145'] != NULL && strlen($jh['element_145'])>0){
                        echo "<img src='img/23117-200.png' style='width:20%;cursor:pointer;text-decoration:underline;' class='tsl_wtn_pic'  rel='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/".$jh['element_145']."'/>";
                    }else{
                        echo "N/A";
                    }
                echo "</td>"; 
              
            if($jh['element_76'] !=NULL  && strlen(trim($jh['element_76']))>0){
                $dp = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_76 = $jh[element_76]");
                if(count($dp)>0){
                    switch($dp[0]['element_3']){
                        case "Completed":
                            $v = "?truck=".$er[0]['element_76'];
                        break;
                        default:
                            $v = "?tsl_truck=".$jh['truck_id'];
                        break;
                    }
                    $er_status = $dp[0]['element_3'];
                }else{
                    $er_status = "Pending";
                    $v = "?tsl_truck=".$jh['truck_id'];
                }
            }else{
                $er_status = "Pending";
                $v = "?tsl_truck=".$jh['truck_id'];
            }
                if(strlen(trim($jh['cert_link']))>0){
                    $cod = "<span class='cod' rel='deconstruction_certificates/$jh[cert_link]'  style='cursor:pointer;'><img src='img/certificate-outline-filled.png'/></span>";
                }else{
                    $cod = "N/A";
                }
                
                if(strlen(trim($jh['cer_link_2']))>0){
                    $cod2=  "<a href='deconstruction_certificates/$jh[cer_link_2]' target='_blank'><img src='img/SelloAprobaciónDorada2-206x300.png' style='width:20%;'/></a>";
                }else{
                    $cod2= "N/A";
                }
                
                echo "<td>$cod</td>";
                 echo "<td>$cod2</td>";
                echo "<td><a href='ER.php$v' target='_blank'><img src='img/search.jpg'/></a><br/>$er_status</td>";
                
                if(strlen(trim($jh['element_151']))){
                    $bol = "<a href='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/$jh[element_151]' target='_blank'><img src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/$jh[element_151]' style='width:50%;height:50%;'/></a>";
                }else{
                    $bol ='N/A';
                }
                echo "<td>$bol</td>";
                
                echo "</tr>";
            }
        }
    ?>
    </tbody>
    </table>
    <iframe style="display: none;" src="machlogin.php" id="machlogin"></iframe>
<script>
window.onload = function(){
    $('#machlogin').contents().find('input#admin_username').val('INET@iwpusa.com');
    $('#machlogin').contents().find('input#admin_password').val('Formlogin1');
    $('#machlogin').contents().find('#submit_button').trigger('click');
}

$('td.notes').text(function(i, text) {
    var t = $.trim(text);
    if (t.length > 10) {
        return $.trim(t).substring(0, 10) + "...";
    }
    return t;
}).hover(function(){
     $(this).html("<span style='font-size:10px;'>"+$(this).attr('rel')+"</span>");
},function(){
     var t = $.trim($(this).attr('rel'));
    if (t.length > 10) {
        $(this).html ($.trim(t).substring(0, 10) + "...");
    }
    
});

$(".cod").click(function(){
    window.open($(this).attr('rel')+"");
});

$(".del_cod").click(function(){
    if(confirm("Are you sure you want to delete this Certificate?")){
        $.post("delete_cod.php",{entry:$(this).attr('rel'),tsl_entry:$(this).attr('xlr')},function(data){
            alert("Certificate deleted");
        });
    }
});

$(".tsl_wtn_pic").click(function(){
   window.open($(this).attr('rel'));
});

$(".seal").click(function(){
    window.open($(this).attr('rel'));
});

$('.deconstruct').click(function(){
    window.open('https://inet.iwpusa.com/machforms/machform/edit_entry.php?form_id=43256&entry_id='+$(this).attr('rel')+'');
});

$(".certificate").click(function(){
    window.open('DECONSTRUCT.php?cert_number='+$(this).attr('rel')+'');
});

$('.tcl_edit').click(function(){
    window.open('inbound_edit.php?entry_id='+$(this).attr('rel')+'&petfood_id='+$(this).attr('xlr'));
});

$('.approve_completed_destruction').click(function(){
    window.open('DECONSTRUCT.php?completed_id='+$(this).attr('rel'));
});

$(".details").click(function(){
    window.open('destruciton_details.php?id='+$(this).attr('rel')+'');
});

$("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>