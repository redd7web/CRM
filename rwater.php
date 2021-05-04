<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
$year = date("Y");
$month = date("m");
?>
 
   <style type="text/css">
  body{
    font-size:12px;
    background:url(img/bodystrip.jpg) repeat-x left top;
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

#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
}

td{
    background:transparent;
    border:0px solid #bbb;  
    padding:0px 0px 0px 0px;  
    text-align:center;
    font-size:12px;
    vertical-align:middle;
    
}
th{
    font-size:13px;
    white-space: nowrap;
    
    width:auto;
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
   $('.myTable').dataTable({
        "order": [ 1, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script> 
<?php
      
        if(isset($_POST['r_grease'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "r_grease_from":
                        if(strlen($value)>0 && $value !=' '){
                            $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                        }
                    break;
                    case "r_grease_to":
                        if(strlen($value)>0 && $value !=' '){
                             $ib[] = " DATE(ap_form_43256.date_created) <='$value'";
                        }
                    break;
                }
            }
            
            if(!empty($ib)>0){
                $string = " AND ".implode(" AND ", $ib);
            }
            //echo "SELECT * FROM Inetforms.ap_form_43256 WHERE element_1 = 4 $string";
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 = 8 $string");
        }else{
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =8 AND ap_form_43256.date_created >= ADDDATE(NOW(), -14) AND ap_form_43256.date_created < NOW()");
        }
    
    ?>
    <form action="rwater.php" method="POST">
    <table class="myTable"> 
        <thead>
            <tr><td><input class="from" type="text" name="r_grease_from" value="<?php if(isset($_POST['r_grease'])){  echo $_POST['r_grease_from'];  }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="r_grease_to" value="<?php if(isset($_POST['r_grease'])){  echo $_POST['r_grease_to'];  }  ?>"  placeholder="TO"/></td><td><input type="submit" name="r_grease"  value="Search"/></td></tr>
            <tr>
                <th>Created By</th>
                <th>Date</th>
                <th>Status</th>    
                <th>Origin</th>
                <th>Destination</th>
                <th>Net Weight</th>
                <th>Weight Ticket</th>
                <th>Carrier</th>
                <th>Driver</th>
                <th>Tank</th>
                <th>Notes</th>
                <td>View Lab Results</td>
                <td>View BOL</td> 
                <td>Edit Entry</td>      
                <td>Certificate of Destruction</td>
                <td>Weight Cert File</td>
                <td>Incoming Weight Cert File</td>
                <td>Seal</td>
                <td>Voided Weight Ticket</td>
                <td>Voided Weight Ticket Number</td>
                <td>BOL</td>
            </tr>
        </thead>
        <tbody>
        <?php 
            if(count($outbound)>0){
                foreach($outbound as $ob){
                        switch($ob['element_114']){
                            case "1":
                            $creator = "Johnny";
                            break;
                            case "2":
                            $creator = "Mario";
                            break;
                            case "3":
                            $creator = "Other";
                            break;
                            default: $creator = ""; break;
                        }
                        switch($ob['element_50']){
                            case 1: $origin = "Boiler (cw)"; break;
                            case 2: $origin = "G-DIV (WW)"; break;
                            case 3: $origin = "Other"; break;
                            case 4: $origin = "B-DIV (WW)"; break;
                            case 5: $origin = "Spent Earth"; break;
                            default: $origin = "N/A";break;
                                
                        }
                        
                        switch($ob['element_52']){
                            case 1: $destination = "Bretts Ranch"; break;
                            case 7: $destination = "Desert Valley Date"; break;
                            case 6: $destination = "Evaporator"; break;
                            case 5: $destination = "Gold Coast"; break;
                            case 10: $destination = "Rancho de Pancho"; break;
                            case 4: $destination = "Rockers Ranch"; break;
                            case 8: $destination = "South Processing"; break;
                            case 9: $destination = "South Yuma County Landfill"; break;
                            case 2: $destination = "Other"; break;
                            default: $destination = "N/A";break;
                        }
                        switch($ob['element_56']){
                            case 1:
                            $carrier = "IWP";
                            break;
                            case 2:
                            $carrier = "West Coast";
                            break;                            
                            case 3:
                            $carrier = "Other";
                            break;
                            default: $carrier = "N/A";break;
                        }
                        switch($ob['element_58']){
                            case 1:
                                $driver ="David";
                            break;
                            case 4:
                                $driver = "Salvador";
                            break;
                            case 2:
                                $driver = "Other";
                            break;
                             case 5:
                                $driver = "Martin E";
                            break;
                             case 6:
                                $driver = "Martin C";
                            break;
                             case 7:
                                $driver = "Ken";
                            break;
                            default: $driver = "N/A";break;
                        }
                    echo "<tr>                    
                        <td>$creator</td>
                        <td>$ob[date_created]</td>
                        <td>$ob[element_4]</td>
                        <td>$origin</td>
                        <td>$destination</td>
                        <td>$ob[element_54]</td>
                        <td>$ob[element_55]</td>
                        <td>$carrier</td>
                        <td>$driver</td>
                        <td>$ob[element_60]</td>
                        <td>$ob[element_61]</td>"; 
                            
                        echo "          
                        <td><a href='ER.php?truck=$ob[id]' rel='shadowbox'><img src='img/search.jpg'/></a></td>
                        <td><a href='BOL.php?from_io=1&wtn=$ob[element_55]'  rel='shadowbox'><img src='img/table_edit.png'/></a></td>    

                        <td><a href='inbound_edit.php?entry_id=$ob[id]' target='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td> <td>";
                        if(strlen($ob['cert_link'])>0 && $ob['cert_link'] !=null){
                            echo "<span class='cod' rel='deconstruction_certificates/$ob[cert_link]'  style='cursor:pointer;'><img src='img/certificate-outline-filled.png'/></span>";
                        }
                        echo "</a></td>
                        "; 
                            
                        if($ob['element_144'] !=null && strlen(trim($ob['element_144']))>0){                             
                            $wtc = "<img src='img/weight_cert.png' class = 'wtc' style='cursor:pointer;width:50px;height:50px;' rel='machforms/machform/data/form_43256/files/".$ob['element_144']."'/>";
                        }else{
                            $wtc ="N/A";
                        }
                        
                        if($ob['element_145'] !=null && strlen(trim($ob['element_145']))>0){
                            $inc_wtc  = "<img src='img/weight_cert.png' class = 'wtc' style='cursor:pointer;width:50px;height:50px;' rel='machforms/machform/data/form_43256/files/".$ob['element_145']."'/>";
                        }else{
                            $inc_wtc  = "N/A";
                        }
                        
                        echo "
                        <td>
                        <div id='bol_top' style='width:50px;height:50px;'>$wtc</div>
                            <div id='bol_bottom'>
                                <div id='bol_bottom_left' style='float:left;width:50%;'><img rel='$ob[id]' class='wtc_delete' src='img/delete-icon.jpg' style='cursor:pointer;'/></div>
                                <div id='bol_bottom_left' style='float:left;width:50%;'><img rel='$ob[id]' class='wtc_edit'   src='img/edit-icon.jpg' style='cursor:pointer;'/></div>
                            </div>
                        </td>
                        <td>$inc_wtc</td>
                        <td><span style='cursor:pointer;text-decoration:underline;color:blue;' rel='machforms/machform/data/form_46859/files/$ob[element_134]' class='seal'>$ob[element_88]</span></td><td>$ob[voided_pic]</td>
<td>$ob[voided_number]</td>";
                    if(strlen(trim($ob['element_151']))){
                            if (strpos($ob['element_151'], '|') !== FALSE){
                                $multiple_bols = explode("|",$ob['element_151']);                                
                                $bol = "<span rel='$ob[id]' style='cursor:pointer;font-size:30px;text-decoratiom:underline;color:blue;' class='multiple_bol'>(".count($multiple_bols).")</span>";
                            }else{
                                $bol = "<a href='machforms/machform/data/form_43256/files/$ob[element_151]' target='_blank'>Click to View Image</a>";
                            }
                            
                            
                        }else{
                            $bol ='N/A';
                        }
                        
                    echo "<td>$bol</td>";
                    echo "</tr>";
                }
            }
        ?>
        </tbody>
    </table></form>
<script>
$(".from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$(".to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});

$(".cod").click(function(){
    window.open($(this).attr('rel')+"");
});

$('.er_tcl').click(function(){
    alert($(this).attr('rel'));
    window.open('ER.php'+$(this).attr('rel')+'');
});

$(".wtc").click(function(){
  window.open($(this).attr('rel'));
});

$(".seal").click(function(){
   window.open($(this).attr('rel'));
});


$(".bol_delete").click(function(){
   if(confirm("Are you sure you want to delete this BOL?")){
     $.post("delete_bol.php",{id:$(this).attr('rel')},function(data){
        
     });
   } 
});

$(".bol_edit").click(function(){
    Shadowbox.open({
        content:"bol_edit.php?id="+$(this).attr('rel')+"",
        player:"iframe",
        width:"1200",
        height:"1200"     
    });
});

$(".multiple_bol").click(function(){
   Shadowbox.open({
        content: "view_multiple_bol.php?id="+$(this).attr('rel'),
        player:"iframe",
        width:"1200",
        height:"1200" 
   }); 
});

$(".wtc_delete").click(function(){
    $.post("delete_wtc.php",function(data){
        
    });   
});

$(".wtc_edit").click(function(){
    Shadowbox.open({
        content:"wtc_edit.php?id="+$(this).attr('rel'),
        player:"iframe",
        width:"1200",
        height:"1200" 
    });  
});

</script>    