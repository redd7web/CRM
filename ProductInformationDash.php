<?php
include "protected/global.php";



include "protected/global.php";

include "source/scripts.php";
include "source/css.php";

ini_set("display_errors",1);
ini_set('memory_limit','250M');
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
<tr><td>File: </td><td><form action="NMloadreportdash.php" method="POST" enctype="multipart/form-data"><input type="file" name="file" id="file"/>&nbsp;<input type="submit" name="subm" id="subm"/></form><br />(If a picture, right click on it, select -> This frame -> Print Frame)</td></tr>

<?php
if(isset($_POST['subm'])){
        move_uploaded_file($_FILES["file"]["tmp_name"], "sludge_read/".$_FILES["file"]["name"]);
        $lines =file("sludge_read/".$_FILES['file']['name']);
        foreach($lines as $data){
            $linez = explode(',',$data);
            echo "<pre>";
            print_r($linez);
            echo "</pre>";
        }
        //echo implode (",",$quer);
}

?>
</table>