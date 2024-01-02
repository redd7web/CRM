<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
?>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <style type="text/css">
  body{
    font-size:12px;
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
li{
    display: inline;
    float:left;
    margin-left:10px;
}
</style>
<?php
        if(isset($_POST['in_wcs'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "in_wcs_from":
                        if(strlen($value)>0 && $value !=' '){
                            $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                        }
                    break;
                    case "in_wcs_to":
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
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =3 $string");
        }else{
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 = ap_form_43256.id   WHERE ap_form_43256.element_1 = 3 AND ap_form_43256.date_created >= ADDDATE(NOW(), -14) AND ap_form_43256.date_created < NOW()");
        }
        
    ?>
    <form action="inwcs.php" method="post">
    <table class="myTable">
         <thead>
             <tr><td><input class="from" type="text" name="in_wcs_from" value="<?php if(isset($_POST['in_wcs'])){ echo $_POST['in_wcs_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="in_wcs_to" value="<?php if(isset($_POST['in_wcs'])) { echo $_POST['in_wcs_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="in_wcs"  value="Search"/></td></tr>
            <tr>
                <th>Created By</th>
                <th>Date</th>
                <th>Status</th>                
                <th>Commodity</th>
                <th>Ship To:</th>
                <th>Net Weight</th>
                <th>Weight Ticket</th>
                <th>Carrier</th>
                <th>Driver</th>
                <th>Pile</th>
                <th>Notes</th>
                <th>Incoming Weight Cert </th>
                <th>Incoming Gross</th>
                <th>Incoming Tare </th>
                <th>Incoming Net </th>
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
                    switch($ob['element_26']){
                        case "1":
                        $comm = "WCS";
                        break;                            
                        case "2":
                        $comm = "Other";
                        break;
                       default: $comm = ""; break;
                        
                    }
                    switch($ob['element_28']){
                        case "1":
                        $shipto = "Modern";
                        break;
                        case "2":
                        $shipto ="Other";
                        break;
                        case "3":
                        $shipto = "Third Option";
                        break;
                        default: $shipto = ""; break;
                    }
                    switch($ob['element_32']){
                        case "1":
                        $carrier = "Mallet";
                        break;
                        case "2":
                        $carrier = "other";
                        break;
                        default: $carrier = ""; break;
                    }
                    switch($ob['element_34']){
                        case "1":
                            $driver ="Bob";
                        break;
                        case "2":
                            $driver = "Other";
                        break;
                        default: $driver = ""; break;
                    }
                    echo "<tr>
                        <td>$creator</td>
                        <td>$ob[date_created]</td>
                        <td>$ob[element_4]</td>
                        <td>$comm</td>
                        <td>$shipto</td>
                        <td>$ob[element_30]</td>
                        <td>$ob[element_31]></td>
                        <td>$carrier</td>
                        <td>$driver</td>         
                        <td>$ob[element_36]</td>
                        <td>$ob[element_37]</td>
                        <td>$ob[element_120]</td>
                        <td>$ob[element_121]</td>
                        <td>$ob[element_122]</td>
                        <td>$ob[element_123]</td>";
                        
                        
                        
                        if(strlen(trim($ob['er_id']))>0 && $ob['er_id'] !=null){
                            $er = $db->query("SELECT * FROM Inetforms.`ap_form_44342` WHERE ap_form_44342.id !=$ob[er_id] AND ap_form_44342.element_76 = $ob[truck_id] AND ap_form_44342.element_3 IN ('Completed','Pending','Pending Retest') ORDER BY ap_form_44342.element_3 ASC  LIMIT 0,1");
                            if(count($er)>0){
                                switch($er[0]['element_3']){
                                    case "Completed":
                                        $v = "?truck=".$er[0]['element_76'];
                                    break;
                                    default:
                                        $v="?tsl_truck=".$ob['truck_id'];
                                    break;
                                }
                                $er_status =$er[0]['element_3'];
                            }else{
                                $v = "?tsl_truck=".$ob['truck_id'];
                                $er_status = "Pending";
                            }
                        }else{
                            $v="?tsl_truck=".$ob['truck_id'];
                            $er_status = "Pending";
                        }
                        echo "<td><img src='img/search.jpg' class='er_tcl' rel='$v' style='cursor:pointer;' title='$v'/><br/>$er_status </td>
                        <td><a href='BOL.php?from_io=1&wtn=$ob[element_31]' rel='shadowbox'><img src='img/table_edit.png'/></a></td>
                        <td><a href='inbound_edit.php?entry_id=$ob[id]'  target='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td><td>";
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
                    echo "
                    </tr>";
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