<?php

include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
$string = "";
if(isset($_POST['filter'])){
   foreach($_POST as $name=>$value){
        switch($name){
            case "status":
                $arrField[]= "ap_form_49773.element_3 = '$value'";
            break;
            case "from":
                if(strlen(trim($value))>0){
                    $arrField[]=" DATE(ap_form_43256.date_created) >= '$value'";
                }
            break;
            case "to":
                if(strlen(trim($value))>0){
                    $arrField[]=" DATE(ap_form_43256.date_created) <= '$value'";
                }
            break;
        }
   }
   
   if(!empty($arrField)){
       $string = " AND ".implode(" AND ",$arrField);
   }
 
    echo "SELECT ap_form_43256.element_151,ap_form_49773.*,ap_form_43256.element_145,ap_form_43256.element_1 as tcl_type,ap_form_43256.id as truck_id,ap_form_43256.element_129 as pet_load_type,ap_form_43256.element_14 as inbound_load_type,ap_form_43256.element_144 as tsl_wtn_pic,ap_form_43256.element_145 FROM Inetforms.ap_form_49773 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_49773.element_76 = ap_form_43256.id  WHERE 1 $string<br/>";
   $compl = $db->query("SELECT ap_form_43256.element_151,ap_form_49773.*,ap_form_43256.element_145,ap_form_43256.element_1 as tcl_type,ap_form_43256.id as truck_id,ap_form_43256.element_129 as pet_load_type,ap_form_43256.element_14 as inbound_load_type,ap_form_43256.element_144 as tsl_wtn_pic,ap_form_43256.element_145 FROM Inetforms.ap_form_49773 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_49773.element_76 = ap_form_43256.id  WHERE 1 $string");
}else {
    $year = date("Y");
    $month = date("m");
    $compl = $db->query("SELECT ap_form_43256.element_151,ap_form_49773.*,ap_form_43256.element_145,ap_form_43256.element_1 as tcl_type,ap_form_43256.id as truck_id,ap_form_43256.element_129 as pet_load_type,ap_form_43256.element_14 as inbound_load_type,ap_form_43256.element_144 as tsl_wtn_pic,ap_form_43256.element_145 FROM Inetforms.ap_form_49773 LEFT JOIN Inetforms.ap_form_43256 ON ap_form_49773.element_76 = ap_form_43256.id  WHERE ap_form_49773.element_3 IN ('Approved','Rejected')  AND ap_form_49773.date_created >='$year-$month-01' AND ap_form_49773.date_created <='$year-$month-".date('t')."'");
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
        "order": [ 5, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>   
<div id="space_top" style="height:97px;width:100%;background:rgba(255,255,255,.4)"></div>
<form action="PaymentDogFood.php" method="POST">
<table style="width: 80%;margin:auto;margin-top:10px;">
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
    
   
    
    <th style="width: 55px;">&nbsp;</th>
    <th style="width: 55px;">&nbsp;</th>
    <th style="width: 55px;">&nbsp;</th>
    <th>Req Id</th>
    <th>Date</th>    
    <th>Seal Number</th>
    <th>Seal Image</th>
    <th>Status</th>
    <th>Original Req #</th>    
   
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
    <th>SPOT #</th>
    <th>Payment Details</th>
    <th>View Destruction Form Details</th>
    <th>View 2nd Destruction Form Details</th>
    
    <th>View COD<br />(Viewable only in chrome & IE)</th>
    <th>View second COD<br />(Viewable only in chrome & IE)</th>
    <th>Uploaded Weight Certification</th>
    <th>Uploaded Incoming Weight Certification</th>
    
    <th>View Lab</th>
    <th>Email COD</th>
    <th>Email 2nd COD</th>
    <th>Tech Notes</th>
    </tr>
    </thead>
    <tbody>
    <?php
        if(count($compl)>0){
            
            foreach($compl as $jh){
                
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>$jh[id]</td>";//req id destruction form #
                echo "<td>$jh[date_created]</td>";//date
                echo "<td>$jh[element_88]</td>";
                echo "<td>";        
                if(strlen(trim($jh['element_16']))>0 && $jh['element_16'] !=null ){
                  $seal = $db->query("SELECT element_134 FROM Inetforms.ap_form_49773 WHERE id = $jh[element_16]");
                  
                  if(count($seal)>0){
                     echo "<a href='machforms/machform/data/form_49773/files/".$seal[0]['element_134']."' target='_blank'><img src='machforms/machform/data/form_49773/files/".$seal[0]['element_134']."' style='width:30%;'/></a>";
                  }else{
                    echo "N/A";
                  }
                  
                }else{
                    echo "N/A";
                }
                        
                echo "</td>";
                echo "<td>$jh[element_3]</td>";//status
                echo "<td>$jh[truck_id]</td>";//orig req # pet food #               
                echo "<td>$jh[element_77]</td>";//weight ticket
                echo "<td>$jh[element_184]</td>";//incoming net weight
                echo "<td>$jh[element_189]</td>";
                echo "<td>$jh[element_82]</td>";// release sale
                echo "<td>$jh[element_83]</td>";//inbound
                echo "<td>$jh[element_84]</td>";//note
                echo "<td>"; 
                    switch($jh['element_4']){
                        case 4: echo "Ruben"; break;
                        case 5: echo "Ricardo"; break;
                        case 6: echo "Ivan"; break;
                        case 7: echo "Johhny"; break;
                        case 8: echo "Joe"; break;
                        case 9: echo "Daniel"; break;
                        case 10: echo "Omar"; break;
                        case 11: echo "Pablo"; break;
                        case 12: echo "Other"; break;
                    }
                
                echo "</td>";//op name
                echo "<td>$jh[element_8]</td>";//request date
                echo "<td>$jh[element_10]</td>";//requestor
                echo "<td>$jh[element_11]</td>";//area
                echo "<td>$jh[element_12]</td>";//type
                echo "<td>$jh[element_13]</td>";//tank
                echo "<td>$jh[element_14]</td>";//spot
                echo "<td><span class='p_details' style='cursor:pointer;color:blue;text-decoration:underline;' rel='$jh[id]'>View Payment Details</span></td>";
                echo "<td><span class='details' style='cursor:pointer;color:blue;text-decoration:underline;' rel='$jh[id]'>Details</span></td>
                    <td>Second Destruction form</td>"; 
                  
                        
                        
                
                echo "<td>";
                
                if(strlen(trim($jh['cert_link']))>0){
                     echo "<a href='deconstruction_certificates/$jh[cert_link]' target='_blank'><img src='img/SelloAprobaciónDorada2-206x300.png' style='width:20%;'/></a>";
                }
               echo "<td>";
               if(strlen(trim($jh['cer_link_2']))>0){
                    echo "<a href='deconstruction_certificates/$jh[cer_link_2]' target='_blank'><img src='img/SelloAprobaciónDorada2-206x300.png' style='width:20%;'/></a>";
               }
               echo "</td>";
                
                
                echo "<td>";                
                if($jh['tsl_wtn_pic'] != NULL && strlen($jh['tsl_wtn_pic'])>0){
                    $pic_split = explode("|",$jh['tsl_wtn_pic']);
                    foreach($pic_split as $sppp){
                        if(strlen(trim($sppp)) >0 ){
                            echo "<img src='img/167591651.jpg' style='width:20%;cursor:pointer;' class='wtn_pic' rel='machforms/machform/data/form_43256/files/".$sppp."' /><br/>";
                        }
                    }
                    
                }else{
                    echo "N/A";
                }
                
            echo "</td>><td>";
                if($jh['element_145'] != NULL && strlen($jh['element_145'])>0){
                    echo "<img class='wtn_pic' src='img/167591651.jpg' style='width:15%;cursor:pointer;' rel='machforms/machform/data/form_43256/files/".$jh['element_145']."'/>";
                }else{
                    echo "N/A";
                }
            echo "</td>"; 
            
            $v="sdfsfds";
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
             
            
            
            echo "<td><a href='ER.php$v' target='_blank'><img src='img/search.jpg'/></a><br/>$er_status</td>";
            echo "<td><img src='https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-email-128.png' style='cursor:pointer;width:50%:' rel='$jh[id]' class='email_cod' title='$jh[cert_link]' xlr='1'/></td>";
           echo "<td><img src='https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-email-128.png' style='cursor:pointer;width:50%:' rel='$jh[id]' class='email_cod' title='$jh[cer_link_2]' xlr='2'/></td>";
            
            
            if(strlen(trim($jh['element_151']))){
                $bol = "<a href='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/$jh[element_151]' target='_blank'><img src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/$jh[element_151]' style='width:50%;height:50%;'/></a>";
            }else{
                $bol ='N/A';
            }
            echo "<td>$bol</td>";
            echo "<td>$jh[element_644]</td>";
            echo "</tr>";
            }
        }
    ?>
    </tbody>
    </table>
    
    <iframe src="machlogin.php"></iframe>
<script>
window.onload = function(){
    setTimeout("$('#sb-player').contents().find('input#admin_username').val('INET@iwpusa.com')",500);
    setTimeout("$('#sb-player').contents().find('input#admin_password').val('Formlogin1')",500);
    setTimeout("$('#sb-player').contents().find('#submit_button').trigger('click')",500);
    setTimeout("Shadowbox.close();",500);
}

$(".cod").click(function(){
    window.open($(this).attr('rel')+"");
});

$(".email_cod").click(function(){
    window.open('email_cod.php?approve_id='+$(this).attr('rel')+"&mode="+$(this).attr('xlr')  );
})

$('.deconstruct').click(function(){
    window.open('https://inet.iwpusa.com/machforms/machform/edit_entry.php?form_id=43256&entry_id='+$(this).attr('rel')+''); 
});

$(".p_details").click(function(){
    window.open('destruciton_details_p.php?id='+$(this).attr('rel')+'');
});

$(".details").click(function(){
    window.open('destruciton_details.php?id='+$(this).attr('rel')+'');
});

$(".payment").click(function(){
    alert("This is where the payment assignment form goes.");
})

$(".approve").click(function(){
   $.post("update_status.php",{status:"approved",entry:$(this).attr('rel')},function(data){
        alert("Entry Approved!");
   }); 
});

$(".wtn_pic").click(function(){
   window.open($(this).attr('rel'));
});

$("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>