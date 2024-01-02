
<?php
include "protected/global.php";
ini_set("display_errors",1);
ini_set('memory_limit', '-1');
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
include "source/scripts.php";
include "source/css.php";

$result = $db->query("SELECT ap_form_27963.element_50_1,ap_form_27963.id,ap_form_27963.element_41,ap_form_27963.element_40,ap_form_27963.element_42,ap_form_27963.element_1,ap_form_27963.element_40,ap_form_27963.element_44,ap_form_27963.element_45 FROM Inetforms.ap_form_27963 ORDER BY ap_form_27963.element_1,ap_form_27963.element_2 DESC");
?>
<style type="text/css">
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "order": [2, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>
</head>

<body>
    <table id="myTable" style="width: 1200px;">
    <thead>
        <tr>
            <td>Reviewed</td>
            <td>Uploaded a File</td>
            <td>Date</td>
            <td>Net</td>
            <td>Weight Certificate</td>
            <td>Truck Name</td>
            <td>Trailer Name</td>
        </tr>
    </thead>
    <tbody>
        <?php
            if(count($result)>0){
                foreach($result as $items){
                    
                    if(strlen(trim($items['element_42']))>0 && $items['element_42'] !=NULL){
                        $file = explode("-",$items['element_42']);
                        $pdf = "<a href='machforms/machform/data/form_27963/files/$items[element_42]'>$file[2]</a>";
                    }else {
                        $pdf = "";
                    }
                    $date = date("M d, Y", strtotime("$items[element_1]"));
                    
                    if($items['element_50_1'] == 1){
                        $checked = " checked ";
                    } else {
                        $checked = "";
                    }
                    echo "<tr>"; 
                            
                            echo "<td><input $checked type='checkbox' class='reviewed' rel='$items[id]'/>&nbsp;&nbsp;<a href='CWtest.php?id=$items[id]' rel='shadowbox'>Review</a></td>
                            
                            <td>$pdf</td>
                    
                            <td>$date</td>
                            
                            <td>$items[element_40]</td>
                             <td>$items[element_41]</td>
                            
                            <td>$items[element_44]</td>
                            <td>$items[element_45]</td>
                    </tr>";
                } 
            }
        ?>
    </tbody>
    </table>
<script>
$(".reviewed").click(function(){
    if( $(this).is(":checked") ){
        $.post("reviewed.php",{value:1,entry:$(this).attr('rel')},function(){
            alert("Updated!");
        });
    }else{
        $.post("reviewed.php",{value:0,entry:$(this).attr('rel')},function(){
            alert("Unclicked!");
        });
    }
});
</script>
</body>
</html>