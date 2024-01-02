<?php
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
        "lengthMenu": [ [15, 25, 50,100,150, -1], [15, 25, 50,100,150, "All"] ]
   }); 
});
</script>

<table style="width:100%;">

<tr>
    <td>File: </td>
    <td><form action="NMloadreportdash.php" method="POST" enctype="multipart/form-data"><input type="file" name="file" id="file"/>&nbsp;<input type="submit" name="subm" id="subm"/></form><br />(If a picture, right click on it, select -> This frame -> Print Frame)</td>
</tr>
    
<tr>
    <td colspan="4" style="text-align: right;"><button id="print_all">Print all invoices Shown</button></td>
</tr>

<tr>
    <td colspan="4" style="text-align: right;"><button id="print_all_ocr">Print all invoices OCR</button></td>
</tr>
</table>
<table id="myTable">
<thead>
<tr><td>Entry ID</td><td>Shipment</td><td>Updated?</td><td>Origin WC</td><td>Destination WC</td></tr>
</thead>
<?php
    function check_exist($driver_idx,$update_field){
        global $db;
        $ret ="";
        $exists ="";
        $pics="";
        $pics_destination="";
        $result = $db->query("SELECT ap_form_11670.element_13,ap_form_11670.id,ap_form_11670.element_15 FROM Inetforms.ap_form_11670 WHERE id =$driver_idx");
        
        if(count($result)>0){
            $exists ="Yes";
            if(strlen(trim($result[0]['element_15']))>0){
                $info = explode(".",$result[0]['element_15']);
                switch($info[1]){
                    case "jpg":case "png":case "gif":case "jpeg":
                        $pics .= "<img src='machforms/machform/data/form_11670/files/".$result[0]['element_15']."' style='width:400px;height:500px;'/><br/><a href='print_pick.php?pic=".$result[0]['element_15']."&invoice=$update_field' target='_blank'>Click here to print</a>";
                    break;
                
                    case "pdf":
                        $pics .= "<iframe src='machforms/machform/data/form_11670/files/".$result[0]['element_15']."' style='width:400px;height:500px;'></iframe>";
                    break;
                
                    case "": // Handle file extension for files ending in '.'
                    case NULL: // Handle no file extension
                    break;
                }
            }


            if(strlen(trim($result[0]['element_13']))>0){
                $info = explode(".",$result[0]['element_13']);
                switch($info[1]){
                    case "jpg":case "png":case "gif":case "jpeg":
                        $pics_destination .= "<img src='machforms/machform/data/form_11670/files/".$result[0]['element_13']."' style='width:400px;height:500px;'/><br/><a href='print_pick.php?pic=".$result[0]['element_13']."&invoice=$update_field' target='_blank'>Click here to print</a>";
                    break;

                    case "pdf":
                        $pics_destination .= "<iframe src='machforms/machform/data/form_11670/files/".$result[0]['element_13']."' style='width:400px;height:500px;'></iframe>";
                        break;

                    case "": // Handle file extension for files ending in '.'
                    case NULL: // Handle no file extension
                        break;
                }
            }



            $db->query("UPDATE Inetforms.ap_form_11670 SET element_57 ='$update_field' WHERE id=$driver_idx");
        }

        $ret .= "    <td style='vertical-align:top;'>$exists</td>
                    <td style='vertical-align:top;'>$pics<input type='hidden' class='print_these' value='".$result[0]['id']."'/></td>
                    <td>$pics_destination<input type='hidden'  value='".$result[0]['id']."'/></td>";
        return $ret;
    }
    
    
    
    if(isset($_POST['subm'])){
        move_uploaded_file($_FILES["file"]["tmp_name"], "whey_read/".$_FILES["file"]["name"]);
        $lines =file("whey_read/".$_FILES['file']['name']);
        foreach($lines as $data){
            $linez = explode(',',$data);
            $driver_id = str_replace("\""," ",$linez[0]);
            $quer[]= $driver_id;
            echo "<tr><td style='vertical-align:top;'>$driver_id</td><td style='vertical-align:top;'>$linez[1]</td>".check_exist($driver_id,$linez[1])."</tr>";
        }
        //echo implode (",",$quer);
    }

?>
</table>
<script>
$("#print_all").click(function(){
   var values = "";
   $('.print_these').each(function(){
        var buff = $(this).val();
        if(  $.trim(buff).length >0 ){
            values +=$(this).val()+"|";    
        }
        
   });
   window.open('print_all_invoices.php?ids='+values+'');
   values ="";
   
});


$("#print_all_ocr").click(function(){
   var values = "";
   $('.print_these').each(function(){
        var buff = $(this).val();
        if(  $.trim(buff).length >0 ){
            values +=$(this).val()+"|";    
        }
        
   });

    // $.post("print_all_invoices_ocr_post.php",{entry_ids:values},function(data){
    //     alert("Information Sent! " + data);
    //     //window.location.reload();
    // });


   window.open('print_all_invoices_ocr.php?ids='+values+'');
   values ="";
   
});


</script>