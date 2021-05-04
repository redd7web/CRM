<style type="text/css">
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<?php
include "source/css.php";
include "source/scripts.php";
include "protected/global.php";
function display_info($id,$element_1,$element_2,$element_3,$element_4,$me){
     
     $display .='<tr>'; 
     
     $display .='<td>'.$id.'</td>';
     $display .='<td><select rel="'.$id.'" class="company" style="text-align:left;" xlr="element_1">
        <option ';  if($element_1 == 4){ $display .=' selected '; }  $display .= ' value="4">Tesoro Colton</option>
        <option ';  if($element_1 == 5){ $display .=' selected '; }  $display .= ' value="5">PBF Colton</option>
        <option ';  if($element_1 == 6){ $display .=' selected '; }  $display .= ' value="6">Co-West</option>
        <option ';  if($element_1 == 7){ $display .=' selected '; }  $display .= ' value="7">PBF Mission Valley</option>
        <option ';  if($element_1 == 8){ $display .=' selected '; }  $display .= ' value="8">IWP Buckeye</option>
        <option ';  if($element_1 == 9){ $display .=' selected '; }  $display .= ' value="9">Flyers</option>
        <option ';  if($element_1 == 10){ $display .=' selected '; }  $display .= ' value="10">Oil Services Clarkdale</option>
        <option ';  if($element_1 == 11){ $display .=' selected '; }  $display .= ' value="11">Chevron Mission Valley</option>
        <option ';  if($element_1 == 12){ $display .=' selected '; }  $display .= ' value="12">New Leaf</option>
        <option ';  if($element_1 == 13){ $display .=' selected '; }  $display .= ' value="13">Everlast</option>
        <option ';  if($element_1 == 14){ $display .=' selected '; }  $display .= ' value="14">Mira loma</option>
        <option ';  if($element_1 == 16){ $display .=' selected '; }  $display .= ' value="16">North Central</option>
        <option ';  if($element_1 == 21){ $display .=' selected '; }  $display .= ' value="21">Petro Diamond</option>
        <option ';  if($element_1 == 20){ $display .=' selected '; }  $display .= ' value="20">McNeese</option>
        <option ';  if($element_1 == 19){ $display .=' selected '; }  $display .= ' value="19">IWP Bswmr</option>
        <option ';  if($element_1 == 18){ $display .=' selected '; }  $display .= ' value="18">Disneyland</option>
        <option ';  if($element_1 == 17){ $display .=' selected '; }  $display .= ' value="17">Auburn Ontario</option>
        <option ';  if($element_1 == 15){ $display .=' selected '; }  $display .= ' value="15">Other</option>
     </select></td>';
     
   
     $display .='<td><select class="mei" rel="'.$id.'" xlr="me">
            <option>Please choose a tank</option>
            <option ';  if($me == 1){ $display .=' selected '; }  $display .= ' >1</option>
            <option ';  if($me == 2){ $display .=' selected '; }  $display .= ' >2</option>
            <option ';  if($me == 3){ $display .=' selected '; }  $display .= ' >3</option>
            <option ';  if($me == 4){ $display .=' selected '; }  $display .= ' >4</option>
            <option ';  if($me == 5){ $display .=' selected '; }  $display .= ' >5</option>
            <option ';  if($me == 6){ $display .=' selected '; }  $display .= ' >6</option>
            <option ';  if($me == 7){ $display .=' selected '; }  $display .= ' >7</option>
            <option ';  if($me == 8){ $display .=' selected '; }  $display .= ' >8</option>
            <option ';  if($me == 9){ $display .=' selected '; }  $display .= ' >9</option>
            <option ';  if($me == 10){ $display .=' selected '; }  $display .= ' >10</option>
            <option ';  if($me == 11){ $display .=' selected '; }  $display .= ' >11</option>
            <option ';  if($me == 12){ $display .=' selected '; }  $display .= ' >12</option>
            <option ';  if($me == 13){ $display .=' selected '; }  $display .= ' >13</option>
            <option ';  if($me == 14){ $display .=' selected '; }  $display .= ' >14</option>
            <option ';  if($me == 15){ $display .=' selected '; }  $display .= ' >15</option>
            <option ';  if($me == 16){ $display .=' selected '; }  $display .= ' >16</option>
            <option ';  if($me == 17){ $display .=' selected '; }  $display .= ' >17</option>
            <option ';  if($me == 18){ $display .=' selected '; }  $display .= ' >18</option>
            <option ';  if($me == 19){ $display .=' selected '; }  $display .= ' >19</option>
            <option ';  if($me == 20){ $display .=' selected '; }  $display .= ' >20</option>
            <option ';  if($me == 21){ $display .=' selected '; }  $display .= ' >21</option>
            <option ';  if($me == 22){ $display .=' selected '; }  $display .= ' >22</option>
            </select></td>';
     $display .="<td>$element_2</td>";
     $display .='<td><select class="product" rel="'.$id.'" xlr="element_3"><option '; if($element_3 == 4){ $display .=' selected ';  }  $display .= '  value="4">B100</option>
                <option '; if($element_3 == 5){ $display .=' selected ';  }  $display .= '  value="5">B99.9</option>
                <option '; if($element_3 == 6){ $display .=' selected ';  }  $display .= '  value="6">B80</option>
                <option '; if($element_3 == 7){ $display .=' selected ';  }  $display .= '  value="7">B20</option>
                <option '; if($element_3 == 8){ $display .=' selected ';  }  $display .= '  value="8">GNAC</option>
                <option '; if($element_3 == 9){ $display .=' selected ';  }  $display .= '  value="9">FFA</option>
                <option '; if($element_3 == 10){ $display .=' selected ';  }  $display .= '  value="10">GNAC/Methanol</option></select></td>';
    $display .='<td><select class="hauler" rel="'.$id.'" xlr="element_4"><option '; if($element_4 == 4){ $display .=' selected ';  }  $display .= '  value="4">MRI</option>
                <option '; if($element_4 == 5){ $display .=' selected ';  }  $display .= ' value="5">FOB</option>
                <option '; if($element_4 == 6){ $display .=' selected ';  }  $display .= ' value="6">IWP</option>
                <option '; if($element_4 == 7){ $display .=' selected ';  }  $display .= ' value="7">Desert Soul</option></select></td>';
                
                if($me == NULL){
                    $class= "class='no_tank'";
                }else{
                    $class = "class='tank_er' rel='$me'";
                }
    $display .="<td><img src='img/table_edit.png' style='cursor:pointer;' $class /></td><td><img src='https://ui.betonline.ag/m/img/content/common/bolnew/images/bol-icon.png' style='width:30%;height:30%;cursor:pointer;' class='bol'/></td></tr>";
     return $display;
}


if(isset($_GET['id'])){
    $yu = $db->query("SELECT * FROM Inetforms.ap_form_47591 WHERE id= $_GET[id]");
}else{
    $yu = $db->query("SELECT * FROM Inetforms.ap_form_47591 WHERE DAY(ap_form_47591.element_6)='$_GET[day]' AND MONTH(ap_form_47591.element_6)='$_GET[month]' AND YEAR(ap_form_47591.element_6)='$_GET[year]' ");
}

echo "<table>";
echo "<tr><td>id</td><td>Company</td><td>ME</td><td>Gallons </td><td>Product </td><td>Hauler </td><td>Lot Sample</td><td>BOL</td></tr>";
if(count($yu)>0){
    foreach($yu as $bhn){
        echo display_info($bhn['id'],$bhn['element_1'],$bhn['element_2'],$bhn['element_3'],$bhn['element_4'],$bhn['me']);
    }
}
echo "</table>";
  

?>
<script>
$(".company, .mei").change(function(){
    $.post("update_bio_sched.php",{id:$(this).attr('rel'),field:$(this).attr('xlr'),value:$(this).val()},function(data){
         alert(data);
    });
});

$(".bol").click(function(){
   window.open("BOL.php"); 
});

$(".no_tank").click(function(){
    alert("The Tank has been Set");
})

$(".tank_er").click(function(){
    window.open('LotSample.php?tank='+$(this).attr('rel'));
});

</script>