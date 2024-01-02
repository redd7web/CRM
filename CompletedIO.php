<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
$year = date("Y");
$month = date("m");

$datex = date("Y-m-d");
$weeks_2_ago = $days_ago = date('Y-m-d', strtotime('-14 days', strtotime($datex)));
?>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
        $( "#tabs" ).tabs({
        <?php 
            if(isset($_POST['inbound_submit'])){
                ?>
                active:0
                <?php
            }else if(isset($_POST['outbound_mx'])){
                ?>
                active:1
                <?php
            }else if(isset($_POST['outbound_bio'])){
                ?>
                active:2
                <?php
            }else if(isset($_POST['outbound_mx_grease'])){
                ?>
                active:3
                <?php
            }else if(isset($_POST['in_wcs'])){
                ?>
                active: 4
                <?php
            }else if(isset($_POST['inbound'])){
                ?>
                active: 5
                <?php
            }else if(isset($_POST['in_grease'])){
                ?>
                active: 6
                <?php
            }else if(isset($_POST['r_grease'])){
                ?>
                active: 7
                <?php
            }else if(isset($_POST['pet_food'])){
                ?>
                active: 8
                <?php
            }else{
                ?>
                active:0
                <?php
            }
        ?>
        });
    });
  </script>
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
<div id="tabs" style="width: auto;display:inline-block;">
  <ul>
    <li><a href="#fragment-1">OutBound</a></li>
    <li><a href="#fragment-2">OutBound MX</a></li>
    <li><a href="#fragment-3">OutBound BIO</a></li>
    <li><a href="#fragment-4">OutBound MX Grease</a></li>
    <li><a href="#fragment-5">IN WCS</a></li>
    <li><a href="#fragment-6">Inbound</a></li>
    <li><a href="#fragment-7">IN-Grease</a></li>
    <li><a href="#fragment-8">R-Water</a></li>
    <li><a href="#fragment-9">Pet Food</a></li>
  </ul>
  <div id="fragment-1">
    <?php
        if(isset($_POST['inbound_submit'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "outbound_from":
                        if(strlen($value)>0 && $value !=' '){
                            $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                        }
                    break;
                    case "outbound_to":
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
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =4 $string");
        }else{
            $outbound = "SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number  FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE  ap_form_43256.element_1 = 4 AND DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago' ";
            echo $outbound;
            $outbound = $db->query($outbound);//your_date >= 
        }
    
    ?>
    <h1>Outbound</h1>
    <form action="CompletedIO.php" method="POST">
    <table class="myTable"> 
        <thead>
            <tr><td><input class="from" type="text" name="outbound_from" value="<?php if(isset($_POST['inbound_submit'])){ echo $_POST['outbound_from']; }  ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_to" value="<?php if(isset($_POST['inbound_submit'])){  echo $_POST['outbound_to']; } ?>"  placeholder="TO"/></td><td><input type="submit" name="inbound_submit" value="Search"/></td></tr>
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
                <th>Sale</th>
                <th>Lot #</th>
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
                            default:
                            $creator = "N/A";
                            break;
                        }
                        switch($ob['element_62']){
                            case "1":
                            $comm = "Ammoniated Ground Pima";
                            break;                            
                            case "2":
                            $comm = "Bakery";
                            break;
                            case "4":
                            $comm = "Fat Lint";
                            break;
                             case "5":
                            $comm = "Ground Pima";
                            break;
                             case "7":
                            $comm = "TR/CS";
                            break;
                            case "8":
                                $comm = 'WCS';
                            break;
                             case "3":
                            $comm = "Other";
                            break;
                            
                        }
                        switch($ob['element_64']){
                           
                            case 1:
                            $shipto = "B+E";
                            break;
                            case 10:
                            $shipto = "Chino Valley";
                            break;
                            case 13:
                            $shipto = "Dutch";
                            break;
                            case 8 :
                            $shipto = "Frank Konyn";
                            break;
                            case 7 :
                            $shipto ="Hinkley";
                            break;
                            case 5:
                            $shipto = "IWP (ML)";
                            break;
                            case 9:
                            $shipto = "IWP (SELMA)";
                            break;
                            case 12:
                            $shipto = "Marie Minaberry";
                            break;
                            case 14:
                            $shipto = "Perez Beltran";
                            break;
                            case 6:
                            $shipto = "West Star North";
                            break;
                            case "4":
                            $shipto ="Schaffner";
                            break;
                            default:
                            $shipto = "Other";
                            break;
                        }
                        switch($ob['element_68']){
                            case 1:
                            $carrier = "Bob";
                            break;
                            case 12:
                            $carrier = "C Rocha";
                            break;
                            case 11:
                            $carrier = "Game Trucking";
                            break;
                            $carrier = "Darrell Green";
                            break;
                            case 5:
                            $carrier = "Murillo Transport";
                            break;
                            case 2:
                            $carrier = "other";
                            break;
                            default:
                            $carrier = "";
                            break;
                        }
                        switch($ob['element_70']){
                            case 1:
                                $driver ="Caesar";
                            break;
                            case 9:
                                $driver = "Chris";
                            break;
                            case 6 :
                                $driver ="Jaime";
                            break;
                            case 4:
                                $driver = "Jesus";
                            break;
                            case 7:
                                $driver ="Jose";
                            break;
                            case 10:
                                $driver ="Juan Jr";
                            break;
                            case 11:
                                $driver ="Julian";
                            break;
                            case 5:
                                $driver = "Lazaro";
                            break;
                            case 8:
                                $driver = "Manuel";
                            break;
                            case 2:
                                $driver = "Other";
                            break;
                        }
                        echo "<tr>
                            <td>$creator</td>
                            <td>$ob[date_created]</td>
                            <td>$ob[element_4]</td>
                            <td>$comm</td>
                            <td>$shipto</td>
                            <td>$ob[element_66]</td>
                            <td>$ob[element_67]</td>
                            <td>$carrier</td>
                            <td>$driver</td>
                            <td>$ob[element_72]</td>
                            <td>$ob[element_73]</td>
                            <td>$ob[element_74]</td><td>"; 
                            
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
                            <td><a href='BOL.php?from_io=1&wtn=$ob[element_67]' rel='shadowbox'><img src='img/table_edit.png'/></a></td>

                            <td><a href='inbound_edit.php?entry_id=$ob[id]'  target='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td><td>";
                        if(strlen($ob['cert_link'])>0 && $ob['cert_link'] !=null){
                            echo "<span class='cod' rel='deconstruction_certificates/$ob[cert_link]'  style='cursor:pointer;'><img src='img/certificate-outline-filled.png'/></span>";
                        }
                        echo "</a></td>"; 
                            
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
                        <td><span style='cursor:pointer;text-decoration:underline;color:blue;' rel='machforms/machform/data/form_46859/files/$ob[element_134]' class='seal'>$ob[element_88]</span></td>
                        <td>$ob[voided_pic]</td>
<td>$ob[voided_number]</td>";
                    if(strlen(trim($ob['element_151']))){
                            if (strpos($ob['element_151'], '|') !== FALSE){
                                $multiple_bols = explode("|",$ob['element_151']);                                
                                $bol = "<span rel='$ob[id]' style='cursor:pointer;font-size:30px;text-decoratiom:underline;color:blue;' class='multiple_bol'>(".count($multiple_bols).")</span>";
                            }else{
                                $bol = "<a href='machforms/machform/data/form_43256/files/$ob[element_151]' target='_blank'>Click to view image</a>";
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
    </table>
    </form>
  </div>
  <div id="fragment-2">
     <form action="CompletedIO.php" method="post">
    <table class="myTable">
         <thead>
             <tr><td><input class="from" type="text" name="outbound_mx_from" value="<?php if(isset($_POST['outbound_mx'])){ echo $_POST['outbound_mx_from'];  } ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_mx_to" value="<?php if(isset($_POST['outbound_mx'])){ echo $_POST['outbound_mx_to']; }  ?>"  placeholder="TO"/></td><td><input type="submit" name="outbound_mx"  value="Search"/></td></tr>
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
                <th>Release</th>
                <th>Lot #</th>
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
            
            if(isset($_POST['outbound_mx'])){
                unset($ib);
                foreach($_POST as $name=>$value){
                    switch($name){
                        case "outbound_mx_from":
                            if(strlen($value)>0 && $value !=' '){
                                $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                            }
                        break;
                        case "outbound_mx_to":
                            if(strlen($value)>0 && $value !=' '){
                                 $ib[] = " DATE(ap_form_43256.date_created) <='$value'";
                            }
                        break;
                    }
                }
                
                if(!empty($ib)>0){
                    $string = " AND ".implode(" AND ", $ib);
                }
               
                $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 = 5 $string");
            }else{
                $outboundx = "SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 = 5 AND DATE_FORMAT( ap_form_44342.date_created, '%Y-%m-%d' ) >='$weeks_2_ago'";
                echo $outboundx;
                $outbound = $db->query($outboundx);
            }
        
        
        if(count($outbound)>0){
                foreach($outbound as $ob){
                    switch($ob['element_114']){
                        case 1:
                        $creator = "Johnny";
                        break;
                        case 2:
                        $creator = "Mario";
                        break;
                        case 3:
                        $creator = "Other";
                        break;
                    }
                    switch($ob['element_75']){
                        case 1:
                        $comm = "Bakery";
                        break;                            
                        case 2:
                        $comm = "P&G Oil";
                        break;
                        case 3:
                        $comm = "Other";
                        break;
                        case 7:
                        $comm = "Glycerin";
                        break;
                        case 4:
                        $comm = "Brown Grease";
                        break;
                    }
                    switch($ob['element_77']){
                        case 1:
                        $shipto = "Isidro Valdez/Gandera Mexicali";
                        break;
                        case 6:
                        $shipto ="Productos Y Subproductos";
                        break;
                        case 4 :
                        $shipto ="Schaffner";
                        break;
                        case 5 :
                        $shipto = "West Star North";
                        break;
                        case 2:
                        $shipto = "Other";
                        break;
                    }
                    switch($ob['element_81']){
                        case 1:
                        $carrier = "IWP";
                        break;
                        case 2:
                        $carrier = "Darrell Green";
                        break;
                        case 3:
                        $carrier = "Cruz";
                        break;
                        case 5:
                        $carrier = "other";
                        break;
                    }
                    switch($ob['element_83']){
                        case 1:
                            $driver ="Angel";
                        break;
                        case 6 :
                            $driver = "Caesar";
                        break;
                        case 7 :
                            $driver = "Luis";
                        break;
                        case 8:
                            $driver = "Rueben";
                        break;
                        case 4:
                            $driver = "Jesus";
                        break;
                        case 5:
                            $driver = "Sergio";
                        break;
                        case 2:
                            $driver = "Other";
                        break;
                    }
                    echo "<tr>
                        <td>$creator</td>
                        <td>$ob[date_created]</td>
                        <td>$ob[element_4]</td>
                        <td>$comm</td>
                        <td>$shipto</td>
                        <td>$ob[element_79]</td>
                        <td>$ob[element_80]</td>
                        <td>$carrier</td>
                        <td>$driver</td>
                        <td>$ob[element_85]</td>
                        <td>$ob[element_86]</td>
                        <td>$ob[element_111]</td><td>"; 
                        
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
                        <td><a href='BOL.php?from_io=1&wtn=$ob[element_80]' rel='shadowbox'><img src='img/table_edit.png'/></a></td>

                        <td><a href='inbound_edit.php?entry_id=$ob[id]' rel='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td><td>";
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
                    <td><span style='cursor:pointer;text-decoration:underline;color:blue;' rel='machforms/machform/data/form_46859/files/$ob[element_134]' class='seal'>$ob[element_88]</span></td>
                        <td>$ob[voided_pic]</td>
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
  </div>
  <div id="fragment-3">
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
                $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =6 AND DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago' ");
            }
       
        
    ?>
    <form action="CompletedIO.php" method="post">
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
  </div>
  <div id="fragment-4">
    <?php
        if(isset($_POST['outbound_mx_grease'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "outbound_mx_grease_from":
                        if(strlen($value)>0 && $value !=' '){
                            $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                        }
                    break;
                    case "outbound_mx_grease_to":
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
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =7 $string");
        }else{
            $outbound = $db->query("SELECT ap_form_43256.element_150, ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =7 AND DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago'");
        }
        
    ?>
    <form action="CompletedIO.php" method="post">
    <table class="myTable">
         <thead>
             <tr><td><input class="from" type="text" name="outbound_mx_grease_from" value="<?php if(isset($_POST['outbound_mx_grease'])){   echo $_POST['outbound_mx_grease_from']; } ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="outbound_mx_grease_to" value="<?php if(isset($_POST['outbound_mx_grease'])) { echo $_POST['outbound_mx_grease_to'];  } ?>"  placeholder="TO"/></td><td><input type="submit" name="outbound_mx_grease"  value="Search"/></td></tr>
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
                <th>Tank #</th>
                <th>Release Number</th>
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
                        case 1:
                        $creator = "Johnny";
                        break;
                        case 2:
                        $creator = "Mario";
                        break;
                        case 3:
                        $creator = "Other";
                        break;
                    }
                    switch($ob['element_100']){
                        case 1: $comm = "CO WEST YELLOW GREASE"; break;
                        case 4 : $comm = "YELLOW GREASE"; break;
                        case 3 : $comm = "Other"; break;
                    }
                    switch($ob['element_102']){
                        case 1 :  $shipto ="Butterspur"; break;
                        case 6 :  $shipto ="Foster"; break;
                        case 5 :  $shipto ="Mesquite"; break;
                        case 2 :  $shipto ="Other"; break; 
                    }
                    switch($ob['element_106']){
                        case 1: $carrier ="Desert Soul"; break; 
                        case 7: $carrier ="IWP"; break; 
                        case 6: $carrier ="JL Trucking"; break; 
                        case 2: $carrier ="Other"; break; 
                    }
                    switch($ob['element_108']){
                        case "1":
                            $driver ="Caesar";
                        break;
                        case "4":
                            $driver = "Jesus";
                        break;
                        case "2":
                            $driver = "Other";
                        break;
                    }
                    echo "<tr>
                        <td>$creator</td>
                        <td>$ob[date_created]</td>
                        <td>$ob[element_4]</td>
                        <td>$comm</td>
                        <td>$shipto</td>
                        <td>$ob[element_104]</td>
                        <td>$ob[element_105]</td>
                        <td>$carrier</td>
                        <td>$driver</td>         
                        <td>$ob[element_112]</td>
                        <td>$ob[element_110]</td>
                        <td>$ob[element_113]</td>"; 
                            
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
                        echo "<td><img src='img/search.jpg' class='er_tcl' rel='$v' style='cursor:pointer;' title='$v'/><br/>$er_status </td>
                        <td><a href='BOL.php?from_io=1&wtn=$ob[element_105]' rel='shadowbox'><img src='img/table_edit.png'/></a></td>

                        <td><a href='inbound_edit.php?entry_id=$ob[id]'  target='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td>"; 
                        
                        echo "<td>";
                        if(strlen($ob['cert_link'])>0 && $ob['cert_link'] !=null){
                            echo "<span class='cod' rel='deconstruction_certificates/$ob[cert_link]'  style='cursor:pointer;'><img src='img/certificate-outline-filled.png'/></span>";
                        }else{
                            echo "N/A";
                        }
                        echo "</td>";
                            
                        if($ob['element_144'] !=null && strlen(trim($ob['element_144']))>0){
                            $wtc = "<img src='img/weight_cert.png'  class = 'wtc' style='cursor:pointer;width:50px;height:50px;' rel='machforms/machform/data/form_43256/files/".$ob['element_144']."'/>";
                        }else{
                            $wtc ="N/A";
                        }
                        
                        if($ob['element_145'] !=null && strlen(trim($ob['element_145']))>0){
                            $inc_wtc  = "<img src='img/weight_cert.png' class = 'wtc' style='cursor:pointer;width:50px;height:50px;' rel='machforms/machform/data/form_43256/files/".$ob['element_145']."' />";
                        }else{
                            $inc_wtc  = "N/A";
                        }
                        
                        echo " <td>
                                <div id='bol_top' style='width:50px;height:50px;'>$wtc</div>
                                    <div id='bol_bottom'>
                                        <div id='bol_bottom_left' style='float:left;width:50%;'><img rel='$ob[id]' class='wtc_delete' src='img/delete-icon.jpg' style='cursor:pointer;'/></div>
                                        <div id='bol_bottom_left' style='float:left;width:50%;'><img rel='$ob[id]' class='wtc_edit'   src='img/edit-icon.jpg' style='cursor:pointer;'/></div>
                                </div>
                        </td>
                        <td>$inc_wtc</td>"; 
                        if(strlen(trim($ob['element_134']))>0){
                            $seal = "<span style='cursor:pointer;text-decoration:underline;color:blue;' rel='machforms/machform/data/form_46859/files/$ob[element_134]' class='seal'>$ob[element_150]</span>";
                        }else{
                            $seal = "$ob[element_150]";
                        }
                        echo "
                        <td>$seal</td><td>$ob[voided_pic]</td>
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
  </div>
  <div id="fragment-5">
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
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 = ap_form_43256.id   WHERE ap_form_43256.element_1 = 3 AND DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago'");
        }
        
    ?>
    <form action="CompletedIO.php" method="post">
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
                    }
                    switch($ob['element_32']){
                        case "1":
                        $carrier = "Mallet";
                        break;
                        case "2":
                        $carrier = "other";
                        break;
                    }
                    switch($ob['element_34']){
                        case "1":
                            $driver ="Bob";
                        break;
                        case "2":
                            $driver = "Other";
                        break;
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
  </div>
  <div id="fragment-6">
    <?php        
        if(isset($_POST['inbound'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "inbound_from":
                        if(strlen($value)>0 && $value !=' '){
                            $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                        }
                    break;
                    case "inbound_to":
                        if(strlen($value)>0 && $value !=' '){
                             $ib[] = "DATE( ap_form_43256.date_created) <='$value'";
                        }
                    break;
                }
            }
            
            if(!empty($ib)>0){
                $string = " AND ".implode(" AND ", $ib);
            }
            //echo "SELECT * FROM Inetforms.ap_form_43256 WHERE element_1 = 4 $string";
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =1 $string");
        }else{
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =1  AND  DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago'");
        }
    
    ?>
    <form action="CompletedIO.php" method="POST">
    <table class="myTable"> 
        <thead>
            <tr><td><input class="from" type="text" name="inbound_from" value="<?php if(isset($_POST['inbound'])){ echo $_POST['inbound_from'];  }   ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="inbound_to" value="<?php if(isset($_POST['inbound'])){ echo $_POST['inbound_to']; }  ?>"  placeholder="TO"/></td><td><input type="submit" name="inbound"  value="Search"/></td></tr>
            <tr>
                <td>View Lab Results</td>
                 <th>Date</th>
                <td>View BOL</td>
                <td>Edit Entry</td>
                <th>Created By</th>
               
                <th>Status</th>                
                <th>Commodity</th>
                <th>Ship To:</th>
                <th>Net Weight</th>
                <th>Weight Ticket</th>
                <th>Carrier</th>
                <th>Driver</th>
                <th>Release</th>
                <th>Notes</th>
                <th>Incoming Weight Cert </th>
                <th>Incoming Gross</th>
                <th>Incoming Tare </th>
                <th>Incoming Net </th>
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
                    }
                   
                    
                    
                   
                    echo "<tr>"; 
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
                        echo "<td><img src='img/search.jpg' class='er_tcl' rel='$v' style='cursor:pointer;' title='$v'/><br/>$er_status </td>
                        <td>$ob[date_created]</td>
                        <td><a href='BOL.php?from_io=1&wtn=$ob[element_19]'  rel='shadowbox'><img src='img/table_edit.png'/></a></td>

                        <td><a href='inbound_edit.php?entry_id=$ob[id]'  target='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td>"; 
                        echo"<td>$creator</td>
                        
                        <td>$ob[element_4]</td>
                        <td>"; 
                             switch($ob['element_14']){
                                case 6:
                                echo "Almond Ground Shell";
                                break;
                                case 13:
                                echo  "Almond Meal";
                                break;                            
                                case 18:
                                echo "Bakery";
                                break;
                                case 25:
                                echo "Candy";
                                break;
                                case 10:
                                echo "Chocolate";
                                break;
                                case 24:
                                echo "Clear Diesel";
                                break;
                                case 7:
                                echo "Dehy Bakery";
                                break;
                                case 21:
                                echo "Dressing";
                                break;
                                case 11:
                                echo "Food Waste";
                                break;
                                case 17:
                                echo "Fat Lint";
                                break;
                                case 12:
                                echo "Lint";
                                break;
                                case 8:
                                echo "Mayo";
                                break;
                                case 14:
                                echo "Methanol";
                                break;
                                case 23:
                                echo "Peanut Butter";
                                break;
                                case 20:
                                echo "Sodium Hydroxide";
                                break;
                                case 22:
                                echo "Sulferic Acid";
                                break;
                                case 15:
                                echo "Water";
                                break;
                                case 16:
                                echo "WCS";
                                break;
                                case 9:
                                echo "Other";
                                break;
                            }
                            echo "</td>
                        <td>"; 
                            switch($ob['element_16']){
                               case 7:
                                echo "Agape Transportation";
                                break;
                                 case 26:
                                echo "Bimbo";
                                break;
                                 case 21:
                                echo "Brenntag";
                                break;
                                 case 28:
                                echo "Connection Chemical";
                                break;
                                 case 23:
                                echo "Giralds";
                                break;
                                 case 17:
                                echo "IWP/AZ";
                                break;
                                 case 14:
                                echo "IWP/Mira Loma";
                                break;
                                 case 15:
                                echo "IWP/Selma";
                                break;
                                 case 27:
                                echo "Kinder Morgan";
                                break;
                                 case 11:
                                echo "LVO";
                                break;
                                case 22:
                                echo "Nexeo";
                                break;
                                case 8:
                                echo "North Star Recycling";
                                break;
                                case 10:
                                echo "Sara Lee";
                                break;
                                case 20:
                                echo "Schaffner";
                                break;
                                case 18:
                                echo "Sparkletts";
                                break;
                                case 16:
                                echo "TARR";
                                break;
                                case 25:
                                echo "VDFC Victorville";
                                break;
                                case 24:
                                echo "Ventura Foods Co";
                                break;
                                case 19:
                                echo "Verhoeven";
                                break;
                                case 12:
                                break;
                                case 9:
                                echo "Other";
                                break;
                            }
                        echo "</td>
                        <td>$ob[element_18]</td>
                        <td>$ob[element_19]</td>
                        <td>" ;
                            switch($ob['element_20']){                               
                                case 4:
                                echo  "Agape Transportation";
                                break;
                                case 27:
                                echo "Angus Transportation";
                                break;
                                case 9:
                                echo "other";
                                break;
                                case 22:
                                echo "Brenntag";
                                break;
                                case 13:
                                echo "C Rocha";
                                break;
                                case 15:
                                echo "Cruz";
                                break;
                                case 12:
                                echo "Desert Soul";
                                break;
                                case 19:
                                echo "DTI";
                                break;
                                case 5:
                                echo "GMT";
                                break;
                                case 11:
                                echo "Hernandez";
                                break;
                                case 10:
                                echo "IWP";
                                break;
                                case 21:
                                echo "JL Trucking";
                                break;
                                case 16:
                                echo "Mallet";
                                break;
                                case 17:
                                echo "Narvaez";
                                break;
                                case 18:
                                echo "Nexeo";
                                break;
                                case 8:
                                echo "Orbit";
                                break;
                                case 26:
                                echo "Pride Intermodal";
                                break;
                                case 24:
                                echo "Road Runner";
                                break;
                                case 25:
                                echo "Ryan";
                                break;
                                case 14:
                                echo "Sparkletts";
                                break;
                                case 23:
                                echo "System Transport";
                                break;
                                case 20:
                                echo "Universal Trucking";
                                break;
                               
                            }
                        echo "</td>
                        <td>";
                             switch($ob['element_22']){
                                case 4:
                                   echo "Aaron";
                                break;
                                case 13:
                                    echo "Alejandro";
                                break;
                                case 15:
                                    echo "Casey";
                                break;
                                case 25:
                                    echo "Chris";
                                break;
                                case 28:
                                    echo "Darryl";
                                break;
                                case 10:
                                    echo "David";
                                break;
                                case 30:
                                    echo "Enrique";
                                break;
                                case 22:
                                    echo "Fernando";

                                case 31:
                                    echo "Giovanny";                                
                                break;                                                                
                                case 21:
                                    echo "Harry";                                
                                break;
                                case 32:
                                    echo "Hans";
                                break;
                                case 26:
                                    echo "Jason";
                                break;
                                case 33:
                                    echo "Jeremy";
                                break;
                                case 17:
                                    echo "Jesus";
                                break;
                                case 6:
                                    echo "Jose";
                                break;
                                case 16:
                                    echo "Juan Jr";
                                break;
                                case 27:
                                    echo "Ismael";
                                break;
                                case 18:
                                    echo "Lazaro";
                                break;
                                case 20:
                                    echo "Martin C";
                                break;
                                case 7:
                                    echo "Martin E";
                                break;
                                case 11:
                                    echo "Milton";
                                break;
                                case 8:
                                    echo "Pedro";
                                break;
                                case 19:
                                    echo "Pepe";
                                break;
                                case 29:
                                    echo "Reynaldo";
                                break;
                                case 23:
                                    echo "Rogine";
                                break;
                                case 24:
                                    echo "Salvador";
                                break;
                                case 14:
                                    echo "Shawn";
                                break;
                                case 9:
                                    echo "Other";
                                break;
                            }
                        echo "</td>         
                        <td>$ob[element_24]</td>
                        <td>$ob[element_25]</td>
                        <td>$ob[element_116]</td>
                        <td>$ob[element_117]</td>
                        <td>$ob[element_118]</td>
                        <td>$ob[element_119]</td>"; 
                        echo "<td>";
                        if(strlen($ob['cert_link'])>0 && $ob['cert_link'] !=null){
                            echo "<span class='cod' rel='deconstruction_certificates/$ob[cert_link]'  style='cursor:pointer;'><img src='img/certificate-outline-filled.png'/></span>";
                        }else{
                            echo "N/A";
                        }
                        echo "</td>";
                            
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
                        <td>$inc_wtc</td>"; 
                        if(strlen(trim($ob['element_88']))>0){
                            $sealx = "<span style='cursor:pointer;text-decoration:underline;color:blue;' rel='machforms/machform/data/form_46859/files/$ob[element_134]' class='seal'>$ob[element_88]</span>";
                        }else{
                            $sealx = "N/A";
                        }
                        echo "<td>$sealx</td><td>$ob[voided_pic]</td>
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
  </div>
  <div id="fragment-7">
    <?php     
        if(isset($_POST['in_grease'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "in_grease_from":
                        if(strlen($value)>0 && $value !=' '){
                            $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                        }
                    break;
                    case "in_grease_to":
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
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =2 $string");
        }else{
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =2 AND DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago'");
        }
    
    ?>
    <form action="CompletedIO.php" method="POST">
    <table class="myTable"> 
        <thead>
            <tr><td><input class="from" type="text" name="in_grease_from" value="<?php if(isset($_POST['in_grease'])){ echo $_POST['in_grease_from'];  } ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="in_grease_to" value="<?php if(isset($_POST['in_grease'])){ echo $_POST['in_grease_to'];   } ?>"  placeholder="TO"/></td><td><input type="submit" name="in_grease"  value="Search"/></td></tr>
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
                <th>Tanker</th>
                <th>Notes</th>
                <th>Time In</th>
                <th>Time Out</th>
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
                        }
                        switch($ob['element_38']){
                            case "1":
                            $comm = "Brown Grease";
                            break;                            
                            case "4":
                            $comm = "UCO";
                            break;
                            case "2":
                            $comm = "Other";
                            break;
                            
                        }
                        switch($ob['element_40']){
                            case 18: $shipto = "4-DIV (AZ)"; break;
                            case 22: $shipto = "A-1(AZ)"; break;
                            case 30: $shipto = "AZ Grease Services"; break;
                            case 26: $shipto = "BA Glenn (AZ)"; break;
                            case 20: $shipto = "Crown"; break;
                            case 27: $shipto = "Crown (drums)"; break;
                            case 29: $shipto = "GT"; break;
                            case 23: $shipto = "JN Grease"; break;
                            case 28: $shipto = "L-DIV"; break;
                            case 17: $shipto ="LSW(SoCal)"; break;
                            case 33: $shipto ="Pipe Maintenance"; break;
                            case 1:  $shipto ="RE"; break;
                            case 15: $shipto ="ReNu(NV)"; break;
                            case 25: $shipto ="RH"; break;
                            case 12: $shipto ="RTI(LA)"; break;
                            case 31: $shipto ="S&K (AZ)"; break;
                            case 32: $shipto ="Safeway"; break;
                            case 19: $shipto ="SMC"; break;
                            case 21: $shipto ="U-DIV"; break;
                            case 24: $shipto ="U-DIV (ML)"; break;
                            case 34: $shipto ="US Oil"; break;
                            case 11: $shipto ="Other"; break;
                        }
                        switch($ob['element_44']){
                            case "5":
                            $carrier = "Desert Soul";
                            break;
                            case "8":
                            $carrier = "IWP";
                            break;
                            case "9":
                            $carrier = "JL Trucking";
                            break;
                            case "10":
                            $carrier = "Plowman";
                            break;
                            case 6: $carrier = "RE"; break;
                            case 7: $carrier = "Other"; break;
                        }
                        switch($ob['element_46']){
                            case 4: $driver ="Aaron"; break;
                            case 12: $driver ="Freddy"; break;
                            case 17: $driver ="Jaime"; break;
                            case 15: $driver ="Jeremy"; break;
                            case 14: $driver ="Jesus"; break;
                            case 5: $driver ="Jose"; break;
                            case 19: $driver ="Juan R"; break;
                            case 6: $driver ="Miguel"; break;
                            case 8: $driver ="Mike"; break;
                            case 13: $driver ="Rene"; break;
                            case 9: $driver ="Roberto"; break;
                            case 18: $driver ="Russel"; break;
                            case 16: $driver ="Salvador"; break;
                            case 11: $driver ="Other"; break;
                        }
                    echo "<tr>                    
                        <td>$creator</td>
                        <td>$ob[date_created]</td>
                        <td>$ob[element_4]</td>
                        <td>$comm</td>
                        <td>$shipto</td>
                        <td>$ob[element_42]</td>
                        <td>$ob[element_43]</td>
                        <td>$carrier</td>
                        <td>$driver</td>       
                        <td>$ob[element_48]</td>
                        <td>$ob[element_49]</td>
                        <td>$ob[element_98]</td>
                        <td>$ob[element_99]</td>
                        <td>$ob[element_124]</td>
                        <td>$ob[element_127]</td>
                        <td>$ob[element_125]</td>
                        <td>$ob[element_126]</td><td>"; 
                        $er = $db->query("SELECT ap_form_44342.* FROM Inetforms.`ap_form_44342` WHERE ap_form_44342.element_76 = $ob[id] AND ap_form_44342.element_3 IN ('Completed','Pending','Pending Retest') ORDER BY ap_form_44342.element_3 ASC  LIMIT 0,1");
                        
                        if(count($er)>0){
                            $v="?truck=".$ob['id'];
                        }else{
                            $v="?tsl_truck=".$ob['id'];
                        }
                        
                        echo "<img src='img/search.jpg' class='er_tcl' rel='$v' style='cursor:pointer;' title='$v'/><br/>$er_status </td>
                        <td><a href='BOL.php?from_io=1&wtn=$ob[element_43]'  rel='shadowbox'><img src='img/table_edit.png'/></a></td>

                        <td><a href='inbound_edit.php?entry_id=$ob[id]'  target='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td>
                        
                        <td>";
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
  </div>
  <div id="fragment-8">
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
            $outbound = $db->query("SELECT ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_151,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 =8 AND DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago'");
        }
    
    ?>
    <form action="CompletedIO.php" method="POST">
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
                        switch($ob['element_50']){
                            case 1: $origin = "Boiler (cw)"; break;
                            case 2: $origin = "G-DIV (WW)"; break;
                            case 3: $origin = "Other"; break;
                            case 4: $origin = "B-DIV (WW)"; break;
                            case 5: $origin = "Spent Earth"; break;
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
  </div>
   <div id="fragment-9">
    <?php
       
        if(isset($_POST['pet_food'])){
            unset($ib);
            foreach($_POST as $name=>$value){
                switch($name){
                    case "pet_food_from":
                        if(strlen(trim($value))>0){
                            $ib[] = " DATE(ap_form_43256.date_created) >='$value'";
                        }
                    break;
                    case "pet_food_to":
                        if(strlen(trim($value))>0){
                             $ib[] = " DATE(ap_form_43256.date_created) <='$value'";
                        }
                    break;
                }
            }
            
            if(!empty($ib)>0){
                $string = " AND ".implode(" AND ", $ib);
            }
            //echo "SELECT * FROM Inetforms.ap_form_43256 WHERE element_1 = 4 $string";
            $outbound = $db->query("SELECT ap_form_43256.element_150,ap_form_43256.element_141,ap_form_43256.element_151,ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134 FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 = 9 $string");
        }else{
            $outbound = $db->query("SELECT ap_form_43256.element_150,ap_form_43256.element_141,ap_form_43256.element_151,ap_form_44342.id as er_id,ap_form_44342.element_76,ap_form_49773.id as destruct_id, ap_form_43256.id as truck_id,ap_form_44342.element_3,ap_form_44342.id, ap_form_44342.element_3 as status,Inetforms.ap_form_43256.*,ap_form_43256.element_134 as tsl_wtn,Inetforms.ap_form_49773.cert_link,ap_form_49773.id as deconstruct_id,ap_form_49773.element_3 as deconstruct_status,ap_form_49773.element_88,ap_form_49773.element_134, ap_form_43256.element_154_1 as check_voided,ap_form_43256.element_155 as voided_pic, ap_form_43256.element_156 as voided_number FROM Inetforms.ap_form_43256 LEFT JOIN Inetforms.ap_form_49773 ON Inetforms.ap_form_49773.element_76 = Inetforms.ap_form_43256.id LEFT JOIN Inetforms.ap_form_44342 ON ap_form_44342.element_76 =  ap_form_43256.id   WHERE ap_form_43256.element_1 = 9  AND DATE_FORMAT( ap_form_43256.date_created, '%Y-%m-%d' ) >='$weeks_2_ago' ");
        }
    
    ?>
    <form action="CompletedIO.php" method="POST">
    <table class="myTable"> 
        <thead>
            <tr><td><input class="from" type="text" name="pet_food_from" value="<?php if(isset($_POST['pet_food'])){ echo $_POST['pet_food_from'];  }   ?>" placeholder="FROM"/></td><td>TO</td><td><input class="to" type="text" name="pet_food_to" value="<?php if(isset($_POST['pet_food'])){ echo $_POST['pet_food_to']; }  ?>"  placeholder="TO"/></td><td><input type="submit" name="pet_food"  value="Search"/></td></tr>
            <tr>
                <th>Created By</th>
                <th>Date</th>
                <th>Status</th>                
                <th>Commodity</th>
                <th>Ship From:</th>
                <th>Net Weight</th>
                <th>Weight Ticket</th>
                <th>Carrier</th>
                <th>Driver</th>
                <th>Pickup</th>
                <th>Trailer</th>
                <th>Notes</th>
                <!--<th>Time In</th>
                <th>Time Out</th>
                <th>Incoming Weight Cert </th>
                <th>Incoming Gross</th>
                <th>Incoming Tare </th>
                <th>Incoming Net </th>-->
                <td>View Lab Results</td>
                <td>View BOL</td>
                <td>Edit Entry</td>
                <td>Certificate of Destruction</td>
                <td>Weight Cert File</td>
                <td>Incoming Weight Cert File</td>
                <td>Seal</td>
                <th>BOL</th>
                <td>Voided Weight Ticket</td>
                <td>Voided Weight Ticket Number</td>
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
                        }
                        switch($ob['element_129']){
                            case "1":
                            $comm = "By-Product Ext Boxed";
                            break;
                            case "4":
                            $comm = "Corrugated";
                            break;
                            case "5":
                            $comm = "PP Bags";
                            break;
                            case "6":
                            $comm = "Compost";
                            break;
                            case "7":
                            $comm = "Waste to Energy";
                            break;
                            case "3":
                            $comm = "Other";
                            break;
                            
                        }
                        switch($ob['element_131']){
                            case "1":
                            $shipto = "Sparks, NV";
                            break;
                           
                            case "2":
                            $shipto = "Other";
                            break;
                        }
                        switch($ob['element_135']){
                            case "1":
                            $carrier = "IWP";
                            break;
                            case "7":
                            $carrier = "Darrell Green";
                            break;
                            case "6":
                            $carrier = "Cruz";
                            break;
                            case "2":
                            $carrier = "other";
                            break;
                        }
                        switch($ob['element_137']){
                            case "1":
                                $driver ="Caesar";
                            break;
                            case "4":
                                $driver = "Jesus";
                            break;
                            case "2":
                                $driver = "Other";
                            break;
                        }
                        switch($ob['element_142']){
                            case "1":
                                $pickup ="30 Yd Comp W2E";
                            break;
                            case "4":
                                $pickup = "30 Yd Open Top W2E";
                            break;
                            case "5":
                                $pickup = "Corn Cleanout";
                            break;
                            case "2":
                                $pickup = "Recycling Bale Trailer";
                            break;
                            case "3":
                                $pickup = "Third Option";
                            break;
                            default:
                            $pickup ="N/A";
                            break;
                        }
                    echo "<tr>                    
                        <td>$creator</td>
                        <td>$ob[date_created]</td>
                        <td>$ob[element_4]</td>
                        <td>$comm</td>
                        <td>$shipto</td>
                        <td>$ob[element_133]</td>
                        <td>$ob[tsl_wtn]</td>
                        <td>$carrier</td>
                        <td>$driver</td>       
                        <td>$pickup</td>
                        <td>$ob[element_140]</td>
                        <td>$ob[element_141]</td>
                        
                        <td>"; 
                        
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
                                $er_status = $er[0]['element_3'];
                            }else{
                                $v = "?tsl_truck=".$ob['truck_id'];
                                $er_status = "Pending";
                            }
                        }else{
                            $v="?tsl_truck=".$ob['truck_id'];
                            $er_status = "Pending";
                        }
                        echo "<img src='img/search.jpg' class='er_tcl' rel='$v' style='cursor:pointer;' title='$v'/><br/>$er_status</td>
                        <td><a href='BOL.php?from_io=1&wtn=$ob[element_43]' target='_blank'><img src='img/table_edit.png'/></a></td>

                        <td><a href='inbound_edit.php?entry_id=$ob[id]'  target='_blank'><img src='img/edit-icon.jpg' title='Edit Sample' style='width:20px;height:20px;'/></a></td>
                        <td>";
                        if(strlen($ob['cert_link'])>0 && $ob['cert_link'] !=null){
                            echo "<span class='cod' rel='deconstruction_certificates/$ob[cert_link]'  style='cursor:pointer;'><img src='img/certificate-outline-filled.png'/></span>";
                        }
                        echo "</a></td>
                        "; 
                            
                        if($ob['element_144'] !=null && strlen(trim($ob['element_144']))>0){                             
                            $wtc = "<img src='img/weight_cert.png' class = 'wtc' style='cursor:pointer;width:70px;height:70px;' rel='machforms/machform/data/form_43256/files/".$ob['element_144']."' />";
                        }else{
                            $wtc ="N/A";
                        }
                        
                        if($ob['element_145'] !=null && strlen(trim($ob['element_145']))>0){
                            $inc_wtc  = "<img src='img/weight_cert.png' class = 'wtc' style='cursor:pointer;width:70px;height:70px;' rel='machforms/machform/data/form_43256/files/".$ob['element_145']."'   />";
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
                        <td>$inc_wtc</td>"; 
                        if(strlen(trim($ob['element_134']))>0){
                            $seal = "<span style='cursor:pointer;text-decoration:underline;color:blue;' rel='machforms/machform/data/form_46859/files/$ob[element_134]' class='seal'>$ob[element_150]</span>";
                        }else{
                            $seal = "$ob[element_150]";
                        }
                        echo "
                        <td>$seal</td>";
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
                        echo "<td>
                            <div id='bol_top' style='width:50px;height:50px;'>$bol</div>
                            <div id='bol_bottom'>
                                <div id='bol_bottom_left' style='float:left;width:50%;'><img rel='$ob[id]' class='bol_delete' src='img/delete-icon.jpg' style='cursor:pointer;'/></div>
                                <div id='bol_bottom_left' style='float:left;width:50%;'><img rel='$ob[id]' class='bol_edit'   src='img/edit-icon.jpg' style='cursor:pointer;'/></div>
                            </div>
                            </td><td>$ob[voided_pic]</td>
<td>$ob[voided_number]</td>"; 
                        echo "
                    </tr>";
                }//jump here
            }
        ?>
        </tbody>
    </table></form>
  </div>
  
</div>
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
