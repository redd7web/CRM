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
     
            if(isset($_POST['outbound_bio'])){
                foreach($_POST as $name=>$value){
                    switch($name){
                        case "outbound_bio_from":
                            if(strlen($value)>0 && $value !=' '){
                                $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                            }
                        break;
                        case "outbound_bio_to":
                            if(strlen($value)>0 && $value !=' '){
                                 $ib[] = " DATE(ap_form_43256.date_created) <='$value'";
                            }
                        break;
                    }
                }
                
                if(!empty($ib)>0){
                    $string = " AND ".implode(" AND ", $ib);
                }
                //echo "SELECT * FROM Inetforms.ap_form_43256 WHERE element_1 = 6 $string";
                $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =6 $string");
            }else{
                $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =6 AND ap_form_43256.date_created >= ADDDATE(NOW(), -14) AND ap_form_43256.date_created < NOW() ");
            }
       
        
    ?>
    <form action="outboundio.php" method="post">
    <table class="myTable">
         <thead>
             <tr><td><input class="from" type="text" name="outbound_bio_from" value="<?php if(isset($_POST['outbound_bio'])){ echo $_POST['outbound_bio_from']; } ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_bio_to" value="<?php  if(isset($_POST['outbound_bio'])){  echo $_POST['outbound_bio_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="outbound_bio"  value="Search"/></td></tr>
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
                switch($ob['element_88']){
                    case 1: $comm ="B20"; break;
                    case 15: $comm = "B80 CLEAR"; break;
                    case 12: $comm = "B 99.9"; break;
                    case 20: $comm = "B 99.9"; CLEAR; break;
                    case 11: $comm = "B 99.9 RED"; break;
                    case 5: $comm = "B100"; break;
                    case 8: $comm = "Candy"; break;
                    case 13: $comm = "Cardboard"; break;
                    case 2: $comm = "Esters"; break;
                    case 4: $comm = "E44"; break;
                    case 7: $comm = "E46"; break;
                    case 6: $comm = "FFA's"; break;
                    case 23: $comm = "FIN Glycerin"; break;
                    case 17: $comm = "Glycerin"; break;
                    case 18: $comm = "Glycerin /w Methanol"; break;
                    case 21: $comm = "Low Acid UCO"; break;
                    case 14: $comm = "Lubricants"; break;
                    case 22: $comm = "Mayo Solids"; break;
                    case 9:  $comm = "Pallets"; break;
                    case 16: $comm = "Recovery Oil"; break;
                    case 19: $comm = "Scrap Metal"; break;
                    case 10: $comm = "Solids"; break;
                    case 3:  $comm = "Other"; break;
                    default: $comm = ""; break;
                    
                }
                switch($ob['element_90']){
                    case 1:   $shipto = "16 Solid Plant"; break;
                    case 46:  $shipto = "Apple Recycling  "; break;
                    case 4:   $shipto = "B-DIV to L-DIV  "; break;
                    case 52:  $shipto = "B-DIV to BBC Tank  "; break;
                    case 26:  $shipto = "BBC Tank  "; break;
                    case 32:  $shipto = "Biosphere  "; break;
                    case 38:  $shipto = "Bill Kurr  ";break;
                    case 23:  $shipto = "BFWMR  "; break;
                    case 5:   $shipto = "Boral (Lathrop)  "; break;
                    case 49:  $shipto = "Boral Rialto  "; break;
                    case 15:  $shipto = "Boral (PHX  "; break;
                    case 47:  $shipto = "City of Camarillo  "; break;
                    case 11:  $shipto = "CoWest  "; break;
                    case 6:   $shipto = "Cheveron  "; break;
                    case 13:  $shipto = "Eagle (Stockton)  "; break;
                    case 51:  $shipto = "Everlast Industries  "; break;
                    case 9:   $shipto = "Flyers  "; break;
                    case 24:  $shipto = "Forterra Pipe & Precast  "; break;
                    case 34:  $shipto = "G-DIV to B-DIV  "; break;
                    case 17:  $shipto = "Half Tank 17 to Lint  "; break;
                    case 18:  $shipto = "Half Tank 19 to Lint  "; break;
                    case 42:  $shipto = "Half Tank I to Lint  "; break;
                    case 41:  $shipto = "Half Tank J to Lint"; break;
                    case 40:  $shipto = "Half Tank K to Lint  ";break;
                    case 39:  $shipto = "Half Tank L to Lint  "; break;
                    case 30:  $shipto = "Half Tank M to Lint  "; break;
                    case 29:  $shipto = "Half Tank N to Lint  "; break;
                    case 28:  $shipto = "Half Tank O to Lint  "; break;
                    case 22:  $shipto = "IWP (ML)  "; break;
                    case 50:  $shipto = "Kettle #2 to Half Tank N  "; break;
                    case 48:  $shipto = "L-DIV to G-DIV  "; break;
                    case 25:  $shipto = "Lint to Half Tank A  "; break;
                    case 21:  $shipto = "McNeece  "; break;
                    case 8:   $shipto = "Musket  "; break;
                    case 12:  $shipto = "North Central  "; break;
                    case 33:  $shipto = "Oil Services  "; break;
                    case 27:  $shipto = "Pete's Road Service  "; break;
                    case 7:   $shipto = "PBF Holding  "; break;
                    case 16:  $shipto = "Ramirez Pallets  "; break;
                    case 37:  $shipto = "Rio Valley Pipe  "; break;
                    case 14:  $shipto = "Rocky Mountain  "; break;
                    case 31:  $shipto = "SA Recycling  "; break;
                    case 20:  $shipto = "Sellers Petroleum  "; break;
                    case 45:  $shipto = "Tank J to Lint  "; break;
                    case 44:  $shipto = "Tank K to Lint  "; break;
                    case 43:  $shipto = "Tank L to Lint  "; break;
                    case 35:  $shipto = "Tank 18 to Lint  "; break;
                    case 19:  $shipto = "Tank 20 to Lint  "; break;
                    case 36:  $shipto = "Tech lenexa  "; break;
                    case 10:  $shipto = "Tesoro  "; break;
                    case 2:   $shipto = "Other  "; break;
                    default: $shipto = ""; break;
                }
                switch($ob['element_94']){
                    case 1:  $carrier="American Oil Transportation" ; break;
                    case 14: $carrier="CJ Logistics" ; break;
                    case 4:  $carrier="Desert Soul" ; break;
                    case 9:  $carrier="Flyers" ; break;
                    case 8:  $carrier="Gemini" ; break;
                    case 17: $carrier="Greenland" ; break;
                    case 6:  $carrier="IWP" ; break;
                    case 15: $carrier="Jarrow Shipping" ; break;
                    case 19: $carrier= "Krisda INC" ; break;
                    case 13: $carrier="McNeece" ; break;
                    case 7:  $carrier="Mike Roche" ; break;
                    case 16: $carrier= "Pete's Tire Service" ; break;
                    case 11: $carrier="Ramirez Pallets" ; break;
                    case 12: $carrier="Sellers Petroleum" ; break;
                    case 10: $carrier="T-Haul" ; break;
                    case 18: $carrier="Trancasa" ; break;
                    case 2:  $carrier="Other" ; break;
                    default: $carrier = ""; break;
                }
                switch($ob['element_96']){
                    case 1: $driver ="Angel"; break;
                    case 28:$driver ="Anthony"; break;
                    case 29:$driver ="Bob"; break;
                    case 27:$driver ="Beto"; break;
                    case 22:$driver ="David"; break;
                    case 11:$driver ="Dillon"; break;
                    case 20:$driver ="Efren"; break;
                    case 18:$driver ="Francisco";  break;
                    case 24:$driver ="Gino"; break;
                    case 26:$driver ="Greg"; break;
                    case 21:$driver ="Horatio"; break;
                    case 14:$driver ="Jairo"; break;
                    case 7:$driver  ="Jeff"; break;
                    case 23:$driver ="Jesse"; break;
                    case 16:$driver ="Jim"; break;
                    case 17:$driver ="Jerry"; break;
                    case 4:$driver  ="Jesus"; break;
                    case 6:$driver  ="Johnny"; break;
                    case 8:$driver  ="Joshua"; break;
                    case 25:$driver ="Martin C"; break;
                    case 5:$driver  ="Miguel"; break;
                    case 9:$driver  ="Mike"; break;
                    case 15:$driver ="Murphey"; break;
                    case 32:$driver ="Norberto"; break;
                    case 31:$driver ="Reynaldo"; break;
                    case 19:$driver ="Robert"; break;
                    case 13:$driver ="Salvador"; break;
                    case 10:$driver ="Tom"; break;
                    case 30:$driver ="Trace"; break;
                    case 33:$driver ="Vladimyr"; break;
                    case 2:$driver  ="Other"; break;
                    default: $driver = ""; break;
                }
                echo "<tr>
                    <td>$creator</td>
                    <td>$ob[date_created]</td>
                    <td>$ob[element_4]</td>
                    <td>$comm</td>
                    <td>$shipto</td>
                    <td>$ob[element_92]</td>
                    <td>$ob[element_93]</td>
                    <td>$carrier</td>
                    <td>$driver</td>         
                    <td>$ob[element_87]</td><td>"; 
                            
                    if(strlen(trim($ob['er_id']))>0 && $ob['er_id'] !=null){
                            $er = $db->query("SELECT *
FROM Inetforms.`ap_form_44342` WHERE ap_form_44342.id !=$ob[er_id] AND ap_form_44342.element_76 = $ob[truck_id] AND ap_form_44342.element_3 IN ('Completed','Pending','Pending Retest') ORDER BY ap_form_44342.element_3 ASC  LIMIT 0,1");
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
                        echo "<img src='img/search.jpg' class='er_tcl' rel='$v' style='cursor:pointer;' title='$v'/><br/>$er_status </td>
                    <td><a href='BOL.php?from_io=1&wtn=$ob[element_93]' rel='shadowbox'><img src='img/table_edit.png'/></a></td>

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
                    echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
    </form>
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