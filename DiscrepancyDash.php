<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",0);
$s = "";
if(isset($_POST['filer'])){
    
     foreach($_POST as $name=>$value){
        switch($name){
            case "from":
                if(strlen(trim($value))>0){
                     $arrField[] = "date_created >= '$value' ";
                }
            break;
            case "to":
                if(strlen(trim($value))>0){
                     $arrField[] = "date_created <= '$value' ";
                }
            break;
            case "division":
                if(strlen(trim($value))>0){
                    $arrField[] = " element_4 = $value ";
                }
            break;
            case "area":
                if(strlen(trim($value))>0){
                    $arrField[] = " element_3 = '$value' ";
                }
            break;
            case "location":
                if(strlen(trim($value))>0){
                    $arrField[] = "element_5 = '$value' ";
                }
            break;
            case "toi":
                if(strlen(trim($value))>0){
                    $arrField[] = "element_6 = $value ";
                }
            break;
            case "points":
                if(strlen(trim($value))>0){
                    $arrField[] = " element_8 = $value";
                }
            break;
            case "completed":
                if(strlen(trim($value))>0){
                    $arrField[] = " element_145_1 = 1";
                }
            break;
            case "by":
                if(strlen(trim($value))>0){
                    $if_two = explode(" ",$value);
                    if(count($if_two)>0){
                        if( strlen(trim($if_two[0])) >0 ){
                            $arrField[] = "(element_14_1 like '%$if_two[0]%' OR element_14_2 like '%$if_two[0]%')";    
                        }
                        
                        if( strlen(trim($if_two[1])) >0 ){
                            $arrField[] = "(element_14_1 like '%$if_two[1]%' OR element_14_2 like '%$if_two[1]%')";    
                        }
                    }else{
                         if( strlen(trim($if_two[0])>0) ){
                            $arrField[] = "(element_14_1 like '%$if_two[0]%' OR element_14_2 like '%$if_two[0]%')";   
                         }
                    }
                }
            break;
        }
        
        if(!empty($arrField)){
            $s = " AND ".implode(" AND ",$arrField);
        }
     }
    
     $jg = $db->query("SELECT id,date_created,date_updated,element_3,element_4,element_5,element_6,element_7,element_8,element_9,element_16_1,element_14_1,element_14_2,element_145_1,element_10 FROM Inetforms.ap_form_17457 WHERE 1 $s");
     echo "SELECT id,date_created,date_updated,element_3,element_4,element_5,element_6,element_7,element_8,element_9,element_16_1,element_14_1,element_14_2,element_145_1 FROM Inetforms.ap_form_17457 WHERE 1 $s";
}else{
    $jg = $db->query("SELECT id,date_created,date_updated,element_3,element_4,element_5,element_6,element_7,element_8,element_9,element_16_1,element_14_1,element_14_2,element_145_1,element_10 FROM Inetforms.ap_form_17457 WHERE date_created >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ");
    
}



?>

<style type="text/css">
body{
    padding:10px 10px 10px 10px;
}
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
    border:1px solid #bbb;  
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
input[type=text]{
    text-align:center;
}
</style>
<script>
$(document).ready(function(){
   $('#myTable').dataTable({
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ],
        "order": [ 10, 'ASC' ]
   }); 
});
</script>

<form action="DiscrepancyDash.php" method="POST">
<table style="width: 50%;margin:auto;margin-bottom:10px;border:0px solid #ffffff;"><tr><td style="text-align: center;"><input value="<?php echo $_POST['from']; ?>"  type="text" id="from" name="from" placeholder="FROM"/></td><td  style="text-align: center;"><input type="text" id="to" name="to" placeholder="TO" value="<?php echo $_POST['to']; ?>" /></td></tr>
<tr><td>Division</td><td><select id="division" name="division"><option value="">Please Choose an option</option><?php 
    $unique = $db->query("SELECT DISTINCT(element_4) as division FROM Inetforms.ap_form_17457 WHERE element_4 IS NOT NULL AND element_4 !=''");
    if(count($unique)>0){
        foreach($unique as $l){
            switch($l['division']){
                        case 34:$temp = "2 - Containers"; break;
                        case 35: $temp =  "4 - Grease Procurement"; break;
                        case 36: $temp =  "7 - Bakery"; break;
                        case 37: $temp =  "B - Biodiesel Plant Processing"; break;
                        case 38: $temp =  "C - Buckeye Plant"; break;
                        case 39: $temp =  "E - Mechanics"; break;
                        case 40: $temp =  "F - Cottonseed Trucking"; break;
                        case 41: $temp =  "G - Yellow Grease Process"; break;
                        case 42: $temp =  "H - Corporate Office"; break;
                        case 43: $temp =  "I - Silage"; break;
                        case 44: $temp =  "J - ByProducts Corona"; break;
                        case 45: $temp =  "K - ByProducts Corona Trucking"; break;
                        case 46: $temp =  "L - Soap"; break;
                        case 47: $temp =  "M - Corona Bakery Process"; break;
                        case 48: $temp =  "N - Whey, Molases, Silage"; break;
                        case 49: $temp =  "O - NM Trucking"; break;
                        case 50: $temp =  "P - Plant Processing"; break;
                        case 51: $temp =  "Q - Plant Repair"; break;
                        case 52: $temp =  "R - Recycle, Grease, Bakery"; break;
                        case 53: $temp =  "T - Buckeye Trucking"; break;
                        case 54: $temp =  "UC - Grease Procurement"; break;
                        case 55: $temp =  "US - CV Grease Procurement"; break;
                        case 56: $temp =  "V - Plant"; break;
                        case 57: $temp =  "W - ByProduct AZ"; break;
                        case 58: $temp =  "LAB"; break;
                        case 59: $temp =  "Co West"; break;

                    }
                    
            if($_POST['division'] == $l['division']){
                $selected = " selected ";
            }else {
                $selected = "";
            }
            echo "<option value='$l[division]' $selected >$temp</option>";
        }
    }
?></select></td></tr>
<tr><td>Area</td><td><select name="area" id="area"><option value="">Please Choose an option</option><?php 
    $area = $db->query("SELECT DISTINCT(element_3) as area FROM Inetforms.ap_form_17457 WHERE element_3 IS  NOT NULL");
    if(count($area)>0){
        foreach($area as $k){
            if($_POST['area'] == $k['area']){
                $xselected = " selected ";
            }else {
                $xselected = "";
            }
            echo "<option value='$k[area]' $xselected >$k[area]</option>";
        }
    }
?></select></td></tr>
<tr><td>Location</td><td><select id="location" name="location"><option value="">Please Choose an option</option><?php 
    $location = $db->query("SELECT DISTINCT(element_5) as location FROM Inetforms.ap_form_17457 WHERE element_5 IS  NOT NULL");
    if(count($location)>0){
        foreach($location as $p){
            if($_POST['location'] == $p['location']){
                $yselected = " selected ";
            }else {
                $yselected = "";
            }
            
            echo "<option value='$p[location]' $yselected >$p[location]</option>";
        }
    }
?></select></td></tr>
<tr><td>Type of Inspection</td><td><select name="toi" id="toi"><option value="">SELECT TYPE OF INSPECTION</option><option  <?php if($_POST['toi'] == 1){ echo " selected "; }  ?>  value ="1">Safety</option><option <?php if($_POST['toi'] == 2){ echo " selected "; }  ?>  value ="2">Housekeeping</option><option <?php if($_POST['toi'] == 4){ echo " selected "; }  ?>  value ="4">Other</option></select></td></tr>
<tr><td>Points</td><td><input type="text" name="points" id="points" value="<?php echo $_POST['points']; ?>" /></td></tr>
<tr><td>Completed Inspections</td><td><input <?php if($_POST['completed'] == 1){ echo " checked "; }  ?>   type="checkbox" value="1" name="completed" id="completed"/></td></tr>
<tr><td>By</td><td><input type="text" id="by" name="by" value="<?php echo $_POST['by']; ?>"/></td></tr>
<tr><td colspan="2" style="text-align: right;"><input type="submit" value="Filter" name="filer" id="filter"/></td></tr>
</table>
</form>
<table style="width: 100%;margin:auto;"  id="myTable">
<thead>
<tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
<td class="cell_label">By</td>
<td class="cell_label">Date Created</td>

<td class="cell_label">Incident Description</td>

<td class="cell_label">Area</td>

<td class="cell_label">Division</td>

<td class="cell_label">Location</td>

<td class="cell_label">Type of Inspection</td>

<td class="cell_label">Points</td>

<td class="cell_label">More Descrepancies?</td>

<td class="cell_label">Has Completed ?</td>
<td class="cell_label">Image</td>

<td class="cell_label">&nbsp;</td>

</tr>

</thead>
<tbody>
<?php
    if(count($jg)>0){
        foreach($jg as $ocx){
            echo "<tr>
                <td>$ocx[element_14_1] $ocx[element_14_2]</td>
                <td style='text-align:left;vertical-align:top;'>$ocx[date_created]</td>
                <td  class='notes' style='text-align:center;vertical-align:top;width:250px;' rel='$ocx[element_9]'>$ocx[element_9]</td>
                <td>$ocx[element_3]</td>
                <td>"; 
                    switch($ocx['element_4']){
                        case 34: echo "2 - Containers"; break;
                        case 35: echo "4 - Grease Procurement"; break;
                        case 36: echo "7 - Bakery"; break;
                        case 37: echo "B - Biodiesel Plant Processing"; break;
                        case 38: echo "C - Buckeye Plant"; break;
                        case 39: echo "E - Mechanics"; break;
                        case 40: echo "F - Cottonseed Trucking"; break;
                        case 41: echo "G - Yellow Grease Process"; break;
                        case 42: echo "H - Corporate Office"; break;
                        case 43: echo "I - Silage"; break;
                        case 44: echo "J - ByProducts Corona"; break;
                        case 45: echo "K - ByProducts Corona Trucking"; break;
                        case 46: echo "L - Soap"; break;
                        case 47: echo "M - Corona Bakery Process"; break;
                        case 48: echo "N - Whey, Molases, Silage"; break;
                        case 49: echo "O - NM Trucking"; break;
                        case 50: echo "P - Plant Processing"; break;
                        case 51: echo "Q - Plant Repair"; break;
                        case 52: echo "R - Recycle, Grease, Bakery"; break;
                        case 53: echo "T - Buckeye Trucking"; break;
                        case 54: echo "UC - Grease Procurement"; break;
                        case 55: echo "US - CV Grease Procurement"; break;
                        case 56: echo "V - Plant"; break;
                        case 57: echo "W - ByProduct AZ"; break;
                        case 58: echo "LAB"; break;
                        case 59: echo "Co West"; break;

                    }
                echo "</td>
                <td>$ocx[element_5]</td>
                <td>"; 
                    switch($ocx['element_6']){
                        case 1:
                            echo "Safety";
                        break;
                        case 2:
                            echo "Housekeeping";
                        break;
                        case 4:
                            echo "Other";
                        break;    
                    }
                echo"</td>
                <td>$ocx[element_8]</td>
                <td>"; 
                    if( $ocx['element_16_1'] ==1){
                        echo "<img src='img/95-200.png' style='width:12px;height:12px;cursor:pointer;' class='more_info' rel='$ocx[id]' />";
                    }else{
                        if( $ocx['element_145_1'] ==1){
                            $comp = " checked ";
                        }else{
                            $comp =  "";
                        }
                        echo "<img src='img/red_cancel.png'/><br/>Click here to complete this Discrepency<br/>
                        
                        <input type='checkbox' $comp class='one_complete' value='1' rel='element_16_1'/>";
                    }
                echo "</td>
                <td>"; 
                    if($ocx['element_145_1'] == 1 ){
                        echo "<img src='img/check_green_2s.png'/>";    
                    }else{
                        echo "<img src='img/red_cancel.png'/>";
                    }
                echo "</td>
                <td>"; 
                    if(strlen(trim($ocx['element_10']))>0){
                        echo "<a href='machforms/machform/data/form_17457/files/$ocx[element_10]' rel='shadowbox'><img src='machforms/machform/data/form_17457/files/$ocx[element_10]' style='width:100px;height:100px;'/></a><br/>Click to Zoom";
                    }
                echo "</td>
                <td></td>
            </tr>";
        }
    }
        
    
    ?>
</tbody>
</table>
<script>
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
$("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true}); 
$("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});

 $(".more_info").click(function(){
    Shadowbox.open({
       content:"view_descrep.php?id="+$(this).attr('rel')+"",
       player:"iframe",
       width:"1000px",
       height:"500px",
       options: { 
            modal:   true,
            onClose: function(){ $("#resubmit_this").submit(); }
       }
    });
 });


$(".one_complete").click(function(data){
    $.post("complete_discrepency.php",{discep: $(this).attr('rel') ,form_id:"ap_form_17457"},function(data){
        alert("Discrepency Completed!");    
    });
});

</script>