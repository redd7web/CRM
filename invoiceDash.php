<?php
include "protected/global.php";

include "source/scripts.php";
include "source/css.php";

ini_set("display_errors",1);
ini_set('memory_limit','250M');
/*



*/


?>

<style type="text/css">
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
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>

<table id="myTable">
<tr><td>File: </td><td><form action="invoiceDash.php" method="POST" enctype="multipart/form-data"><input type="file" name="file" id="file"/>&nbsp;<input type="submit" name="subm" id="subm"/></form><br />(If a picture, right click on it, select -> This frame -> Print Frame)</td></tr>
<tr><td>Entry ID</td><td>Invoice #</td><td>Date</td><td>Customer</td><td>Other Customer Name</td><td>Carrier/Transporter</td><td>Net</td><td>Weight Certificate</td><td>Tank #</td><td>Product</td><td>Tanker Washout</td><td>Percentage MIU is Water</td><td>Percentage MIU is Interface</td><td>Percentage MIU is Solids</td><td>Conductivity</td></tr>
<?php
    
    if(isset($_POST['subm'])){
        move_uploaded_file($_FILES["file"]["tmp_name"], "invoice_number/".$_FILES["file"]["name"]);
        $lines =file("invoice_number/".$_FILES['file']['name']);
        $row = 1;
         
        
        foreach($lines as $data){
            if($row !=1){
            $step = explode(",",$data);            
            echo"<tr><td>$step[0]</td><td>$step[1]</td><td>$step[2]</td><td>$step[3]</td><td>$step[4]</td><td>$step[5]</td><td>$step[6]</td><td>$step[7]</td><td>$step[8]</td><td>$step[9]</td><td>$step[10]</td><td>$step[11]</td><td>$step[12]</td><td>$step[13]</td><td>$step[14]</td></tr>"; 
            echo "<tr><td colspan='14'>UPDATE Inetforms.ap_form_27963 SET ap_form_27963.element_52 = $step[1] WHERE id=$step[0]</td></tr>";
            $db->query("UPDATE Inetforms.ap_form_27963 SET ap_form_27963.element_52 = $step[1] WHERE id=$step[0]");
            }
            $row++; 
        }
        
        //echo implode (",",$quer);
    }

?>
</table>
