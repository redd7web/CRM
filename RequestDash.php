<html>
<head>
<?php
include "protected/global.php";
ini_set("display_errors",0);

function priority($pr,$id){
    $i ="";
    
    
    
    
    $i .= "<select class='priority' rel='$id'>";
    $i .="<option>--</option>";
    $i .= "<option value='1'"; if($pr==1){ $i .= " selected "; }   $i .= ">High</option>";
    $i .= "<option value='2'"; if($pr==2){ $i .= " selected "; }  $i .= ">Medium</option>";
    $i .= "<option value='3'"; if($pr==3){ $i .= " selected "; }  $i .= ">Low</option>";
    $i .= "<option value='4'"; if($pr==4){ $i .= " selected "; }  $i .= ">Hold</option>";
    $i .= "</select> ";
    
   
    
    return $i;
   
}

if(isset($_POST['search'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "assigned_to":
                $name = explode(" ","$value");
                $arrField[] ="( element_9_1 like '%$name[0]%' AND element_9_2 like '%$name[1]%')";
            break;
            case "division":
               if(strlen(trim($value))>0){
                 $arrField[] = "element_4 = $value";
               }
            break;
            case "assigned":
                $arrField[] = "element_21_4 = $value";               
            break;
            case "rejected":
                $arrField[] = "element_21_2 = $value";               
            break;
            case "completed":
                $arrField[] = "element_21_1 = $value";               
            break;
            case "hold":
                $arrField[] = "element_21_5 = $value";
            break;
            case "prior":
                if(strlen(trim($value))>0){
                    $arrField[] = "element_5 = $value";
                }
            break;
        }
    }
    
    if(!empty($arrField)){
        $string = " AND ".implode(" AND ",$arrField);
    }
    
    echo "SELECT * FROM Inetforms.ap_form_60352 WHERE 1 $string<br/>";
    $req = $db->query("SELECT * FROM Inetforms.ap_form_60352 WHERE 1 $string");
}else{
    $req = $db->query("SELECT * FROM Inetforms.ap_form_60352 WHERE element_21_1 = 0 ORDER BY element_5 ASC");
}
?>
<style type="text/css">
  body{
    font-size:12px;
    background:url(img/bodystrip.jpg) repeat-x left top;
    padding:10px 10px 10px 10px;
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
    border:1px solid #bbb;  
    padding:0px 0px 0px 0px;  
    text-align:center;
    font-size:12px;
    vertical-align:middle;
    
}
th{
    font-size:13px;
    white-space: nowrap;
    border:1px solid #bbb;
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
<?php
include "source/scripts.php";
include "source/css.php";
?>
<script>

$(document).ready(function(){
   $('.myTable').dataTable({
        "order": [ 3, 'asc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script> 
<?php



function division_decode($div){
    switch($div){
        case 1:
            return 1;
        break;
        
        case 2:
            return  2;
        break;
        case 3:
            return  4;
        break;
        case 15:
            return  7;
        break;
        case 14:
            return "B";
        break;
        
        case 13:
            return "C"; 
        break;
        case 12:
            return  "D";
        break;
        
        case 11:
            return  "E";
        break;
        case 10:
            return "F";  
        break;
        case 16:
            return  "G";
        break;
        case 17:
            return  "H";
        break;
        case 18:
            return "I";  
        break;
        case 19:
            return "J";  
        break;
        case 20:
            return "K";  
        break;
        case 21:
            return "L";
        break;
        case 22:
            return "M";
        break;
        case 23:
            return "N";
        break;
        case 24:
            return "O"; 
        break;
        case 25:
            return  "P";
        break;
        case 26:
            return  "Q";
        break;
        case 27:
            return  "R";
        break;
        case 28:
            return "S";  
        break;
        case 29:
            return "T";  
        break;
        case 30:
            return "U";  
        break;
        case 31:
            return "V";  
        break;
        case 32:
            return "W";  
        break;
        
        case 33:
            return "Z/0";  
        break;
    }
}

?>
</head>
<body>

<form action="RequestDash.php" method="POST">
<table style="width: 300px;margin: auto;margin-top:20px;">
    <tr><td style="text-align: right;vertical-align:top;">Assigned To: </td>
    
    <td style="text-align: left;vertical-align:top;">
        <ul>
            <li><input type="radio" name="assigned_to" value="Allen Burkett" <?php if($_POST['assigned_to'] == "Allen Burkett"){ echo " checked ";  } ?> />&nbsp;Allen Burkett</li>
            <li><input type="radio" name="assigned_to" value="Brandon Thomas"  <?php if($_POST['assigned_to'] == "Brandon Thomas"){ echo " checked ";  } ?> />&nbsp;Brandon Thomas</li>
            <li><input type="radio" name="assigned_to" value="Chris Nutting"  <?php if($_POST['assigned_to'] == "Chris Nutting"){ echo " checked ";  } ?> />&nbsp;Chris Nutting</li>
            <li><input type="radio" name="assigned_to" value="Red Dizon"  <?php if($_POST['assigned_to'] == "Red Dizon"){ echo " checked ";  } ?> />&nbsp;Redd Dizon</li>
            <li><input type="radio" name="assigned_to" value="Amanda Johnson"  <?php if($_POST['assigned_to'] == "Amanda Johnson"){ echo " checked ";  } ?> />&nbsp;Amanda Johnson</li>
            <li><input type="radio" name="assigned_to" value="Jared Trawick"  <?php if($_POST['assigned_to'] == "Jared Trawick"){ echo " checked ";  } ?> />&nbsp;Jared Trawick</li>
        </ul>
    </td></tr>
    
    <tr><td  style="text-align: right;vertical-align:top;">Division</td><td  style="text-align: left;vertical-align:top;"><select id="division" name="division"> 
			<option value=""></option>
            <option value="1" <?php if($_POST['division'] == 1){ echo "selected";  } ?> >1</option>
            <option value="2" <?php if($_POST['division'] == 2){ echo "selected";  } ?> >2</option>
            <option value="3" <?php if($_POST['division'] == 3){ echo "selected";  } ?> >4</option>
            <option value="15" <?php if($_POST['division'] == 15){ echo "selected";  } ?> >7</option>
            <option value="14" <?php if($_POST['division'] == 14){ echo "selected";  } ?> >B</option>
            <option value="13" <?php if($_POST['division'] == 13){ echo "selected";  } ?> >C</option>
            <option value="12" <?php if($_POST['division'] == 12){ echo "selected";  } ?> >D</option>
            <option value="11" <?php if($_POST['division'] == 11){ echo "selected";  } ?> >E</option>
            <option value="10" <?php if($_POST['division'] == 10){ echo "selected";  } ?> >F</option>
            <option value="16" <?php if($_POST['division'] == 16){ echo "selected";  } ?> >G</option>
            <option value="17" <?php if($_POST['division'] == 17){ echo "selected";  } ?> >H</option>
            <option value="18" <?php if($_POST['division'] == 18){ echo "selected";  } ?> >I</option>
            <option value="19" <?php if($_POST['division'] == 19){ echo "selected";  } ?> >J</option>
            <option value="20" <?php if($_POST['division'] == 20){ echo "selected";  } ?> >K</option>
            <option value="21" <?php if($_POST['division'] == 21){ echo "selected";  } ?> >L</option>
            <option value="22" <?php if($_POST['division'] == 22){ echo "selected";  } ?> >M</option>
            <option value="23" <?php if($_POST['division'] == 23){ echo "selected";  } ?> >N</option>
            <option value="24" <?php if($_POST['division'] == 24){ echo "selected";  } ?> >O</option>
            <option value="25" <?php if($_POST['division'] == 25){ echo "selected";  } ?> >P</option>
            <option value="26" <?php if($_POST['division'] == 26){ echo "selected";  } ?> >Q</option>
            <option value="27" <?php if($_POST['division'] == 27){ echo "selected";  } ?> >R</option>
            <option value="28" <?php if($_POST['division'] == 28){ echo "selected";  } ?> >S</option>
            <option value="29" <?php if($_POST['division'] == 29){ echo "selected";  } ?> >T</option>
            <option value="30" <?php if($_POST['division'] == 30){ echo "selected";  } ?> >U</option>
            <option value="31" <?php if($_POST['division'] == 31){ echo "selected";  } ?> >V</option>
            <option value="32" <?php if($_POST['division'] == 32){ echo "selected";  } ?> >W</option>
            <option value="33" <?php if($_POST['division'] == 33){ echo "selected";  } ?> >Z/0</option>

		</select></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Status</td><td  style="text-align: left;vertical-align:top;">
            <ul>
                <li><input name="assigned" type="checkbox" value="1"  <?php if($_POST['assigned'] == 1){ echo " checked ";  } ?>  />&nbsp;Assigned</li>
                <li><input name="rejected" type="checkbox" value="2"  <?php if($_POST['rejected'] == 1){ echo " checked ";  } ?> />&nbsp;Rejected</li>
                <li><input name="completed" type="checkbox" value="3" <?php if($_POST['completed'] == 1){ echo " checked ";  } ?>  />&nbsp;Completed</li>
                <li><input name="hold" type="checkbox" value="4" <?php if($_POST['completed'] == 1){ echo " checked ";  } ?>  />&nbsp;Hold</li>
            </ul>
        </td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Priority</td><td  style="text-align: left;vertical-align:top;"><ul><li>&nbsp;<input type="radio" name="prior" value="1" />&nbsp;High</li><li>&nbsp;<input type="radio" name="prior" value="2" />&nbsp;Medium</li><li>&nbsp;<input type="radio" name="prior" value="3"/>&nbsp;Low</li></ul></td></tr>
        <tr><td style="text-align: right;vertical-align:top;">Timeline</td><td  style="text-align: center;vertical-align:top;">
                <input placeholder="FROM" value="<?php echo $_POST['from']; ?>" id="from" name="from" style="border-radius: 10px 10px 10px 10px;border: 1px solid green;padding: 5px 5px 5px 5px;width: 180pt;height: 30px;font-size: 12px;display: inline-block" />
                <br />
                <input placeholder="TO" type="text" id="to" name="to" value="<?php echo $_POST['to']; ?>" /></td></tr>
        <tr><td colspan="2" style="text-align:right;"><span style="text-decoration:underline;cursor:pointer;color:blue;" id="request">+ New Request</span>&nbsp;&nbsp;<a href="RequestDash.php">Default View</a>&nbsp;&nbsp;<input type="reset" />&nbsp;&nbsp;<input type="submit"  value="Filter" name="search" id="searchx"/></td></tr>
</table>
</form>
<table class="myTable" style="width: 90%;margin:auto;margin-top:20px;">
<thead>
<th>Project</th>
<th>Project Description</th>
<th>Division</th>
<th>Priority</th>
<th>Requested By</th>
<th>Assigned To</th>
<th>Assigned</th>
<th>Rejected</th>
<th>Completed</th>
<th>Timeline</th>
</thead>
<tbody>
<?php

if(count($req)>0){
    foreach($req as $q){
        echo "<tr>
            <td>
            <div id='full' style='width:300px;height:50px;'>
                <div id='full_left' style='width:25px;height:50px;float:left;'>  
                    <img src='img/check_green_2s.png' style='width:25px;height:25px;cursor:pointer;' class='completed' rel='$q[id]' title='Mark as Completed'/><br/><br/>
                    <img src='img/red_cancel.png' style='width:20px;height:20px;cursor:pointer;' class='rejected' rel='$q[id]' title='Mark as Rejected'>
                </div>
                <div id='full_right' style='width:265px;height:50px;float:left;padding:5px 5px 5px 5px;text-align:left;text-align:center;'>
                   High  $q[element_6]</div>
            </div></td>
            <td><img src='img/edit-icon.jpg' style='cursor:pointer;' class='update_task' rel='$q[id]' title='Update Task'>&nbsp;$q[element_7]</td>
            <td>".division_decode($q['element_4'])."</td>
            <td  "; 
                if($q['element_5'] == 1){
                    $color = "red";
                }else if($q['element_5']== 2){
                    $color="yellow";
                }else if($q['element_5']==3){
                    $color="green";
                }else{
                    $color = "white";
                }
            echo "  style='background:$color;' ><span style='display:none;'>$q[element_5]</span>".priority("$q[element_5]",$q['id'])."</td>
            <td>$q[element_2_1] $q[element_2_2] </td>
            <td><input type='text' value='$q[element_9_1] $q[element_9_2]' class='update_assigned'/></td>
            <td>"; 
                if($q['element_21_4'] == 1 ){
                    echo "<img src='machforms/machform/images/icons/62_blue_16.png'/>";
                }
            
            echo "</td>
            <td>"; 
                if($q['element_21_2'] == 1 ){
                    echo "<img src='machforms/machform/images/icons/62_blue_16.png'/>";
                }
            
            echo "</td>
            <td>"; 
                if($q['element_21_1'] == 1 ){
                    echo "<img src='machforms/machform/images/icons/62_blue_16.png'/>";
                }
            echo "</td>
            <td><img src='img/edit-icon.jpg' style='cursor:pointer;' class='update_timeline' rel='$q[id]' title='Update Timeline'>&nbsp;$q[element_10]</td>
            
        </tr>";
    }
}


?>
</tbody>
</table>
<script>


/*
window.onbeforeunload = function() {
  
  return "Field is empty are you sure you want to leave?"; //here also can be string, that will be shown to the user
}*/



$("#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});

$("#request").click(function(){
    Shadowbox.open({
       content:"ITProjectRequest.php",
        player:"iframe",
        width:"1000px",
        height:"600px",
        options: { 
            modal:   true,
            onClose: function(){ $("#searchx").trigger("click"); }
        } 
    });    
});





$(".update_timeline").click(function(){
   Shadowbox.open({
        content:"update_projects.php?mode=1&id="+$(this).attr("rel")+"",
        player:"iframe",
        width:"400px",
        height:"300px",
        options: { 
            modal:   true,
            onClose: function(){ $("#searchx").trigger("click"); }
        }
   }); 
});


$(".update_task").click(function(){
   Shadowbox.open({
        content:"update_projects.php?mode=2&id="+$(this).attr("rel")+"",
        player:"iframe",
        width:"400px",
        height:"300px",
        options: { 
            modal:   true,
            onClose: function(){ $("#searchx").trigger("click"); }
        }
        
   }); 
});

$(".completed").click(function(){
   Shadowbox.open({
        content:"update_projects.php?mode=3&id="+$(this).attr("rel")+"",
        player:"iframe",
        width:"400px",
        height:"300px",
        options: { 
            modal:   true,
            onClose: function(){ $("#searchx").trigger("click"); }
        }
        
   }); 
});

$(".rejected").click(function(){
   Shadowbox.open({
        content:"update_projects.php?mode=4&id="+$(this).attr("rel")+"",
        player:"iframe",
        width:"400px",
        height:"300px",
        options: { 
            modal:   true,
            onClose: function(){ $("#searchx").trigger("click"); }
        }
        
   }); 
});


$(".priority").change(function(){
    $.get("update_projects.php",{mode:5,id:$(this).attr('rel'),value:$(this).val()},function(data){
        alert("Priority changed!");
        $("#searchx").trigger("click");
    });
});


$(".assign_to").change(function(){
    $.post("update_projects.php",{id:$(this).attr('rel'),value:$(this).val()},function(data){
        alert("Priority changed!");
        $("#searchx").trigger("click");
    });
});
</script>
</body>
</html>