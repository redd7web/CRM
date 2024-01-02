<?php 

header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
session_start();
include "protected/Database.class.php";
$cfg['connection'] = array( 
        "host"=>"localhost",
        "username"=>"root",
        "password"=>"password1",
        "database"=>"iwp"
    );
$db = new Database();
require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 78357;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
display_machform($mf_param);


if(isset($_GET['id'])){
    
    $result = $db->query("SELECT ap_form_27963.element_50_1,COALESCE(ap_form_27963.element_51,NULL,'') as element_51 FROM Inetforms.ap_form_27963 where id = $_GET[id]");
    if(count($result) >0){
        
    ?>            
         
         <?php
         
         if($result[0]['element_50_1'] == 1){
         ?>
         <script>
          alert('<?php echo $_GET['id'] ?>');
        $("#element_50_1").prop('checked',true);
        $("#element_50").val('<?php echo $result[0]['element_51'] ?>')
        </script>
         <?php 
         }
         ?>
            
        <?php
    }
}
?>

<script>
$("#element_50_1").attr('rel','<?php echo $_GET['id']; ?>')
$("#element_50_1").click(function(){
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
