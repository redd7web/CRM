<?php
    include "protected/global.php";
    
    

include "source/scripts.php";
include "source/css.php";

$check_exist = $db->query("SELECT COALESCE(lot_number,0,0) as lot_number ,COALESCE(sample_bag_score,0,0) as sample_bag_score, COALESCE(lot_number2,0,0) as lot_number2,COALESCE(sample_bag_score2,0,0) as sample_bag_score2 FROM iwp_test_scale WHERE tk=$_GET[tk]");


?>

<style type="text/css">
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<table style="width: 50%;margin:auto;">
    <tr>
    <td><input placeholder='Lot #1' type='text' value='<?php  if(count($check_exist)>0){ echo $check_exist[0]['lot_number'];} ?>' class='lot_number' weight='<?php echo $_GET['tk'] ?>' style='width:100px;'/></td>
    <td><input placeholder='Lot #2' type='text' value='<?php  if(count($check_exist)>0){ echo $check_exist[0]['lot_number2'];} ?>' class='lot_number' weight='<?php echo $_GET['tk'] ?>' class='lot_number2' weight='<?php echo $_GET['tk'] ?>' style='width:100px;'/></td>
    </tr>
    <tr>
    <td><input placeholder='PPB1' type='text' value='<?php  if(count($check_exist)>0){ echo $check_exist[0]['sample_bag_score'];} ?>' class='ppb1' weight='<?php echo $_GET['tk'] ?>' style='width:100px;' readonly /></td>
    <td><input placeholder='PPB2' type='text' value='<?php  if(count($check_exist)>0){ echo $check_exist[0]['sample_bag_score2'];} ?>' class='ppb2' weight='<?php echo $_GET['tk'] ?>' style='width:100px;'  readonly /></td>
    </tr>
</table>
<script>
$(".retest").click(function(){
    window.location ="CottenTest_lab.php?key=<?php echo $_GET['tk'] ?>";
});


 $(".lot_number").change(function(){
    var weight = $(this).attr('weight');
    $.post("update_scale_info.php",{mode:"lot",value:$(this).val(),weight:weight},function(data){
        alert("Lot Number updated");
    });
    
    
    $.ajax({
        type: "POST",
        url: "retrieve_pppb.php",
        data: { lot:$(this).val(),pppb_entry:1 }
        
        }).done(function( msg ) {
            $(".ppb1").val(msg);
             $.post("update_pppb_scale.php",{sample:1,weight:weight,pppb_value:msg},function(data){
                    alert(data);
             });
    }); 
});
    
$(".lot_number2").change(function(){
    $.post("update_scale_info.php",{mode:"lot2",value:$(this).val(),weight:$(this).attr('weight')},function(data){
        alert(data);
        alert("Lot Number updated");
    });
    
    
    
    
    
    $.post("retrieve_pppb.php",{lot:$(this).val(),pppb_entry:2},function(data){
        alert(data);
        $(".ppb2").val(data);
        
    
        $.ajax({
            type: "POST",
            url: "retrieve_pppb.php",
            data: { lot:$(this).val(),pppb_entry:2 }
            
            }).done(function( msg ) {
                alert(msg);
                $(".ppb2").val(msg);
                $.post("update_pppb_scale.php",{sample:2,weight:$(this).attr('weight'),pppb_value:msg},function(data){
                    
                });
        });
        
        
    });
    
});


</script>