<?php
include "protected/global.php";



if(isset($_POST['sub'])){
    foreach($_POST as $name=>$value){
        switch($name){
           case "in_out_search":
                if(strlen(trim($value))>0){
                    $arrField[] = "changes = '$value'";
                }
           break; 
           case "gallons_search":
                if(strlen(trim($value))>0){
                    $arrField[] = " gallons >= $value ";
                }
           break;
           
           case "gallons_to":
                if(strlen(trim($value))>0){
                    $arrField[] = " gallons <= $value ";
                }
           break;
           case "from":
                if(strlen(trim($value))>0){
                    $arrField[] = " date >='$value' ";
                }
           break;
           case "to":
                if(strlen(trim($value))>0){
                    $arrField[] = " date <='$value' ";
                }
           break;
           case "section_search":
                if(strlen(trim($value))>0){
                    $arrField[] = " section <='$value' ";
                }
           break;
        }
    }
    
    if(!empty($arrField)){
        $string = " AND ".implode(" AND ", $arrField);
    }
    $k = "SELECT * FROM b_division WHERE 1 $string";
    echo $k;    
    $b_div = $db->query($k);  
    
}else{
  $b_div = $db->query("SELECT * FROM b_division");  
}





?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <?php 
        include "source/css.php";
        include "source/scripts.php";
    ?>
     <style type="text/css">
        body{
            margin:10px 10px 10px 10px;
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
            padding:5px 5px 5px 5px;
            vertical-align:top;
            text-align:center;  
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
	<title>B - Division Inventory</title>
</head>

<body>



<table style="width: 600px;margin:auto;margin-bottom:10px;">

<tr>
    <td style="text-align: right;vertical-align:top;">In/Out: </td><td style="text-align: left;vertical-align:top;"><select id="in_out" name="in_out"><option>---</option><option value="In">In</option><option value="Out">Out</option></select></td>
    </tr>
    
    <tr>
    <td style="text-align: right;vertical-align:top;">Gallons: </td>
    <td  style="text-align: left;vertical-align:top;"><input placeholder="Gallons" id="gallons" name="gallons" /></td>
    </tr>
    
    <tr>
    <td style="text-align: right;vertical-align:top;">Daily Inventory Description</td>
    <td style="text-align: left;vertical-align:top;"><textarea name="daily_inventory" id="daily_inventory" placeholder="Daily Inventory" style="width: 99%;height:150px;"></textarea></td>
    </tr>
    
    <tr><td style="text-align: right;vertical-align:top;">Section:<br /> (Start typing to choose from a list of existing sections or enter a brand new one) </td>
    <td style="text-align: left;vertical-align:top;"><input type="text" id="section" name="section" placeholder="Enter a section" />
   
    </td>
    </tr>
    
    <tr>
    <td style="text-align: right;vertical-align:top;">Date: </td>
    <td style="text-align: left;vertical-align:top;"><input id="date" name="date" placeholder="Date" /></td></tr>
    <tr><td colspan="5" style="text-align: right;verticla-align:middle;"><input type="submit" value="Insert Inventory Report"  /></td></tr>
</table>

<form action="b-inventory.php" method="POST">
<table style="width: 700px;margin-bottom:5px;margin-top:5px;margin:auto;">
    <tr><td  style="text-align: right;vertical-align:top;width:50%;">Changes</td><td style="text-align: left;vertical-align:top;"><input  <?php if($_POST['in_out_search']=="In"){ echo " checked ='checked'"; } ?>   value="In" type="radio" name="in_out_search"/>&nbsp;In<br /><input   <?php if($_POST['in_out_search']=="Out"){ echo " checked ='checked'"; } ?>  value="Out" type="radio" name="in_out_search" />&nbsp;Out</td></tr>
    <tr><td  style="text-align: right;vertical-align:top;">Gallons</td><td style="text-align: center;vertical-align:top;"><input type="text" name="gallons_search" id="gallons_search"  value='<?php echo $_POST['gallons_search']; ?>' /><br />To<br /><input value='<?php echo $_POST['gallons_to']; ?>' type="text" name="gallons_to" id="gallons_to"/></td></tr>
    <tr><td style="text-align: right;vertical-align:top;">Section</td><td style="text-align: left;vertical-align:top;"><input type="text" name="section_search" id="section_search" value='<?php echo $_POST['section_search']; ?>'  /></td></tr>
    <tr><td style="text-align: right;vertical-align:top;">Date Range</td><td style="text-align: center;vertical-align:top;"><input value='<?php echo $_POST['from']; ?>' type="text" name="from" id="from" style="width: 200px;"/><br />To<br /><input value='<?php echo $_POST['to']; ?>' name="to" id="to"  style="width: 200px;"/></td></tr>
    <tr><td colspan="2" style="text-align: right;vertical-align:top;"><input type="submit" value="Search" id="sub" name="sub"/></td></tr>
</table>
</form>
<table id="myTable" style="width: 99%;margin:auto;">
    <thead>
        <tr><td>Id</td><td>Changes</td><td>Gallons</td><td>Daily Inventory</td><td>Section</td><td>Date</td></tr>
    </thead>
    <tbody>
    <?php
        if(count($b_div)>0){
            foreach($b_div as $kc){
                echo "<tr>";
                echo "<td>$kc[id]</td>";
                echo "<td>$kc[changes]</td>";
                echo "<td>$kc[gallons]</td>";
                echo "<td>$kc[daily_inventory]</td>";
                echo "<td>$kc[section]</td>";
                echo "<td>$kc[date]</td>";
                echo "</tr>";
            }
        }
    ?>
    </tbody>
</table>

<script>
$("input#date,#to,#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});

<?php 
$p =  $db->get("b_division_sections");

if(count($p)>0){
    foreach($p as $s){
        $sec[]='\''.$s['section_name'].'\''; 
    }
echo "var sections = [".implode(",",$sec)."];  "; echo "\r\n"; 

?>
$("input#section,input#section_search").autocomplete({    
     minLength: 3, 
     source: function(req, responseFn) {
          var matches = new Array();
          var needle = req.term.toLowerCase();            
          var len = sections.length;
          for(i = 0; i < len; ++i){
              var haystack = sections[i].toLowerCase();
              if(haystack.indexOf(needle) === 0 || haystack.indexOf(" " + needle) != -1)
              {
                  matches.push(sections[i]);
              }
          }
          responseFn(matches);
    },
    select: function(event, ui) {
        
    }
});


<?php
   
}

?>


</script>
</body>
</html>