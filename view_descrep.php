
<style>
body{
    padding:10px 10px 10px 10px;
}
img{
    width:250px;
    height:250px;
}
input[type=text]{
    width:500px;
}
</style>
<?php


include "protected/global.php";
include "source/scripts.php";
ini_set("display_errors",1);
ini_set('memory_limit', '2048M');
if(isset($_GET['id'])){
    $log_report = $db->query("SELECT * FROM Inetforms.ap_form_17457 WHERE id=$_GET[id]");
    
if(count($log_report)>0){
    if(strlen(trim($log_report[0]['element_10']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_10']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_145_1'>Click here to complete this Discrepency.</a><br/>
        
        <input type='text'name='element_11' id='element_11'  placeholder='Corrective Action' class='corrective'   form_id='$_GET[id]' rel='element_145_1' form_id='$_GET[id]' value='".$log_report[0]['element_11']."' />
        
        <br/><br/>";
    }
    
    if($log_report[0]['element_16_1'] == 1 && strlen(trim($log_report[0]['element_146']))>0 ){
       $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_146']."'/><br/><br/>";
      
    }
    
    if(strlen(trim($log_report[0]['element_27']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_27']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_147_1'>Click here to complete this Discrepency.</a><br/><input type='text' name='element_28' id='element_28' placeholder='Corrective Action' class='corrective'   rel='element_147_1' form_id='$_GET[id]'  value='".$log_report[0]['element_28']."' /><br/><br/>";
        
      
        
        
    }//
    
    if($log_report[0]['element_31_1'] == 1 && strlen(trim($log_report[0]['element_148']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_148']."'/><br/><br/>";
       
    }//
    
    if(strlen(trim($log_report[0]['element_41']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_41']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_147_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_42' id='element_42'  placeholder='Corrective Action' class='corrective'  rel='element_147_1'    form_id='$_GET[id]'  value='".$log_report[0]['element_42']."' /><br/><br/>";
    }
    
    if($log_report[0]['element_45_1'] == 1 && strlen(trim($log_report[0]['element_150']))>0){
        $message .="<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_150']."'/><br/><br/>";
        
    }
    
    if(strlen(trim($log_report[0]['element_55']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_55']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_149_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_56' id='element_56'  placeholder='Corrective Action' class='corrective'  rel='element_149_1'    form_id='$_GET[id]' value='".$log_report[0]['element_56']."'/><br/><br/>";
    }
    
    if($log_report[0]['element_60_1'] == 1 && strlen(trim($log_report[0]['element_152']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_152']."'/><br/><br/>";
        
    }
    
    if(strlen(trim($log_report[0]['element_69']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_69']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_151_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_70' id='element_70'  placeholder='Corrective Action' class='corrective'   rel='element_151_1'  form_id='$_GET[id]' value='".$log_report[0]['element_70']."'/><br/><br/>";
    }
    
    if($log_report[0]['element_73_1'] == 1 && strlen(trim($log_report[0]['element_55']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['154']."'/><br/><br/>";
        
    }
    
    if(strlen(trim($log_report[0]['element_83']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_83']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_153_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_84' id='element_84'  placeholder='Corrective Action' class='corrective'   rel='element_153_1'   form_id='$_GET[id]' value='".$log_report[0]['element_84']."'/><br/><br/>";
    }
    
    if($log_report[0]['element_87_1'] == 1 && strlen(trim($log_report[0]['element_156']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_156']."'/><br/><br/>";
        
    }
    
    if(strlen(trim($log_report[0]['element_97']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_97']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_155_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_98' id='element_98'  placeholder='Corrective Action' class='corrective'  rel='element_155_1'   form_id='$_GET[id]' value='".$log_report[0]['element_98']."'/><br/><br/>";
    }//
    
    
    if($log_report[0]['element_101_1'] == 1 && strlen(trim($log_report[0]['element_158']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_158']."'/><br/><br/>";
        
    }//
    
    if(strlen(trim($log_report[0]['element_111']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_111']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_157_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_112' id='element_112'  placeholder='Corrective Action' class='corrective'  rel='element_157_1'   ' form_id='$_GET[id]' value='".$log_report[0]['element_112']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_115_1'] == 1 && strlen(trim($log_report[0]['element_160']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_160']."'/><br/><br/>";
       
    }//
    
    if(strlen(trim($log_report[0]['element_125']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_125']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_159_1'>Click here to complete this Discrepency.</a><br/><input type='text'name='element_126' id='element_126'  placeholder='Corrective Action' class='corrective'  rel='element_159_1'   form_id='$_GET[id]' value='".$log_report[0]['element_126']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_129_1'] == 1  && strlen(trim($log_report[0]['element_162']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_162']."'/><br/><br/>";
        
    }//
    
    if(strlen(trim($log_report[0]['element_139']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_139']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_161_1'>Click here to complete this Discrepency.</a><br/><br/>";
    }//
    
    if($log_report[0]['element_187_1'] == 1 &&  strlen(trim($log_report[0]['element_190']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_190']."'/><br/><br/>";
    }//
    
    if(strlen(trim($log_report[0]['element_182']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_182']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_163_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_183' id='element_183'  placeholder='Corrective Action' class='corrective'  rel='element_163_1'   form_id='$_GET[id]' value='".$log_report[0]['element_183']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_204_1'] == 1 &&  strlen(trim($log_report[0]['element_164']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_164']."'/><br/><br/>";
        
    }// 
    
    if(strlen(trim($log_report[0]['element_200']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_200']."'/><br/><br/>";         $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_186_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_201' id='element_201'  placeholder='Corrective Action' class='corrective'  rel='element_186_1'   form_id='$_GET[id]' value='".$log_report[0]['element_201']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_188_1']==1 &&  strlen(trim($log_report[0]['element_206']))>0){
       $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_206']."'/><br/><br/>";
      
    }//
    
    if(strlen(trim($log_report[0]['element_217']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_217']."'/><br/><br/>";         $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_222_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_218' id='element_218'  placeholder='Corrective Action' class='corrective'   rel='element_222_1'  form_id='$_GET[id]' value='".$log_report[0]['element_218']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_221_1']==1  &&  strlen(trim($log_report[0]['element_223']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_223']."'/><br/><br/>";
        
    }//
    
    
    if(strlen(trim($log_report[0]['element_233']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_233']."'/><br/><br/>";         $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_238_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_330' id='element_330'  placeholder='Corrective Action' class='corrective'   rel='element_238_1'  form_id='$_GET[id]' value='".$log_report[0]['element_330']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_237_1']==1  &&  strlen(trim($log_report[0]['element_239']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_239']."'/><br/><br/>";
        
    }//
    
    if(strlen(trim($log_report[0]['element_249']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_249']."'/><br/><br/>";         $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_254_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_262' id='element_262'  placeholder='Corrective Action' class='corrective'   rel='element_254_1'  form_id='$_GET[id]' value='".$log_report[0]['element_262']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_253_1']==1  &&  strlen(trim($log_report[0]['element_255']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_255']."'/><br/><br/>";
        
    }//
    
    if(strlen(trim($log_report[0]['element_332']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_332']."'/><br/><br/>";         $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_258_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_250' id='element_250'  placeholder='Corrective Action' class='corrective'  rel='element_258_1'   form_id='$_GET[id]' value='".$log_report[0]['element_250']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_259_1']==1  &&  strlen(trim($log_report[0]['element_257']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_257']."'/><br/><br/>";
        
    }//
    
    if(strlen(trim($log_report[0]['element_333']))>0){
        $message .= "<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_333']."'/><br/><br/>";         $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_273_1'>Click here to complete this Discrepency.</a><br/>
        <input type='text'name='element_277' id='element_277'  placeholder='Corrective Action' class='corrective'   rel='element_273_1'  form_id='$_GET[id]' value='".$log_report[0]['element_277']."'/><br/><br/>";
    }//
    
    if($log_report[0]['element_274_1']==1  &&  strlen(trim($log_report[0]['element_272']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_272']."'/><br/><br/>";
        
    }//
    

    
    if($log_report[0]['element_291_1']==1  &&  strlen(trim($log_report[0]['element_287']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_287']."'/><br/>
        <input type='text'name='element_294' id='element_294'  placeholder='Corrective Action' class='corrective'   rel='element_294_1'  form_id='$_GET[id]' value='".$log_report[0]['element_294']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_290_1'>Click here to complete this Discrepency.</a><br/><br/>";
    }//
    
    
    
    if($log_report[0]['element_305_1']==1  &&  strlen(trim($log_report[0]['element_303']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_303']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_304_1'>Click here to complete this Discrepency.</a><br/><br/>";
    }//
    
   
    if(strlen(trim($log_report[0]['element_317']))>0){
        $message .= "<br/><br/>Another Discrepancy.&nbsp;&nbsp;<img src='machforms/machform/data/form_17457/files/".$log_report[0]['element_317']."'/><br/>
        <input type='text'name='element_308' id='element_308'  placeholder='Corrective Action' class='corrective'  rel='element_308_1'   form_id='$_GET[id]' value='".$log_report[0]['element_308']."'/><br/><br/>";
        $message .="<a href='complete_discrepency.php?form_id=$_GET[id]&discep=element_318_1'>Click here to complete this Discrepency.</a><br/><br/>";
    }//
    echo $message;
}    
    
    
}


?>

<script>
$(".corrective").change(function(){
    $.post("complete_discrepency.php",{ reason_field:$(this).attr('id'), reason: $(this).val(),form_id:$(this).attr('form_id'),check_box: $(this).attr("rel")},function(data){
        alert(data+" "+"Corrective issue added!");
    });
});
</script>