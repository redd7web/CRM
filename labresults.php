 
 <?php
 include "protected/global.php";
 include "source/css.php";
 ini_set("display_error",1);
 $x = $db->query("SELECT element_17,element_20,element_30,element_31,element_32,element_33,element_35,element_36,element_37,element_38,element_43,element_51,element_52,element_53,element_54,element_56,element_57,element_58,element_59,element_64,element_66,element_67,element_68,element_70,element_71,element_74,element_78,element_79,element_88,element_91,element_42 FROM Inetforms.ap_form_44342 WHERE id=$_GET[entry_id]");
 ?>
 <style type="text/css">
 body{
    padding:10px 10PX 10PX 10PX;
    margin:5px 5px 5px 5px;
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

td ,th{
    background:transparent;
    border:2px solid #000000;  
    padding:10px 10px 10px 10px;
    margin:3px 3px 3px 3px;
    white-space: nowrap;
    text-align: center;
    width:auto;
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}
img{
    max-width:100%;
    max-height:100%;
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}
#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
}
table{
     border-spacing: 0;
    border-collapse: collapse;
}
input[type=checkbox]{
    width:10px;
}
</style>
 <table style="width: 100%;">
 
   
    <?php
    
   if(count($x)>0){
    ?>
    <thead>
     <tr><td colspan="18" style="text-align: left;background:#cccccc;font-size:18px;font-weight:bold;">Required Lab Tests</td></tr>
      
     <tr>
        <?php 
            $alt = 0;
            if($x[0]['element_17'] !=NULL && strlen($x[0]['element_17']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>Glycerin</th>";
            }
        
            if($x[0]['element_31'] !=NULL && strlen($x[0]['element_31']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>OD</th>";
            }
         
            if($x[0]['element_35'] !=NULL && strlen($x[0]['element_35']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>Acid</th>";
            }
            
            if($x[0]['element_74'] !=NULL && strlen($x[0]['element_74']) >0){
               $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>FFA</th>";
            }
            if($x[0]['element_70'] !=NULL && strlen($x[0]['element_70']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>FFA Sample State</th>";
            }
            
            
            if($x[0]['element_38'] !=NULL && strlen($x[0]['element_38']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>Oil</th>";
            }
           
            if($x[0]['element_88'] !=NULL && strlen($x[0]['element_88']) >0){
               $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>KF Moisture</th>";
            }
            
            if($x[0]['element_36'] !=NULL && strlen($x[0]['element_36']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>Soap</th>";
            }        
        
            if($x[0]['element_20'] !=NULL && strlen($x[0]['element_20']) >0){
              $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>GC Glycerin</th>";
            }        
        
            if($x[0]['element_32'] !=NULL && strlen($x[0]['element_32']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>Conductivity</th>";
            }
            
            
            if($x[0]['element_68'] !=NULL && strlen($x[0]['element_68']) >0){
               $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>MIU</th>";
            }
            
            if($x[0]['element_30'] !=NULL && strlen($x[0]['element_30']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>PH</th>";
            }
            
            if($x[0]['element_33'] !=NULL && strlen($x[0]['element_33']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>Methanol</th>";
            }
            
            if($x[0]['element_37'] !=NULL && strlen($x[0]['element_37']) >0){
                $alt++;
                if($alt%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<th style='background:$bg;'>ESTERS/FFAs</th>";
            }            
        ?>  
        
     </tr>
     </thead>  
      <tbody> 
    <?php
    $bb = 0;
        foreach($x as $ent){
            
             echo " <tr>";
               if($ent['element_17'] !=NULL && strlen($ent['element_17'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_17]</td><!---glycerin---!>";
               }
               
               if($ent['element_31'] !=NULL && strlen($ent['element_31'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_31]</td><!---COD---!>  ";
               }
               
               if($ent['element_35'] !=NULL && strlen($ent['element_35'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_35]</td><!---Acid---!>";
               }
               
                if($ent['element_74'] !=NULL && strlen($ent['element_74'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_74]</td><!---FFA---!>";
               }
                if($ent['element_70'] !=NULL && strlen($ent['element_70'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'><!---FFA SS---!>";                 
                switch($ent['element_70']){
                    case 1:
                        echo "As-is";
                    break;
                    case 2:
                        echo "With Acid";
                    break;
                }
                echo "</td>";
               }
               
               if($ent['element_38'] !=NULL && strlen($ent['element_38'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_38]</td><!---oil---!>";
               }
               
               if($ent['element_88'] !=NULL && strlen($ent['element_88'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_88]</td><!---KF Moisture ---!>";
               }
               
               if($ent['element_36'] !=NULL && strlen($ent['element_36'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_36]</td><!---Soap---!>";
               }
               
               if($ent['element_20'] !=NULL && strlen($ent['element_20'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_20]</td><!---TG---!>";
               }
               
               if($ent['element_32'] !=NULL && strlen($ent['element_32'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_32]</td><!---Conductivity---!>";
               
              
               if($ent['element_68'] !=NULL && strlen($ent['element_68'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_68]</td><!---MIU---!>";
               }
               
               
               if($ent['element_30'] !=NULL && strlen($ent['element_30'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_30]</td><!---PH---!>";
               }
               
               if($ent['element_33'] !=NULL && strlen($ent['element_33'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_33]</td><!---Methanol---!>";
               }
               
               if($ent['element_37'] !=NULL && strlen($ent['element_37'])>0){
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_37]</td><!---ESTERS---!>";
               }
               
              
               
             
               }
              
               
             echo"</tr>";
        }
   }
    ?></tbody>
    </table>
    
    <table>
   <table style="width: 100%; margin-top:10px;">
 <thead>
 <tr><td colspan="23" style="background:#bbbbbb;text-align:left;font-size:18px;font-weight:bold;">Proximate Analysis Tests</td></tr>
 
    
    
    
    
    
    
    

 </thead>
 <tbody><tr>
 <?php
    
    
   if(count($x)>0){
        
        if($x[0]['element_43'] !=NULL && strlen($x[0]['element_43'])>0) {
            $bc++;
                if($bc%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>Moisture</th>";
        }
        
         if($x[0]['element_42'] !=NULL && strlen($x[0]['element_42'])>0) {
            $bc++;
                if($bc%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>FAT</th>";
        }
        
         if($x[0]['element_54'] !=NULL && strlen($x[0]['element_54'])>0) {
            $bc++;
                if($bc%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>ASH</th> ";
        }
        
         if($x[0]['element_71'] !=NULL && strlen($x[0]['element_71'])>0) {
            $bc++;
                if($bc%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>ASH Sample State</th> ";
        }
        
         if($x[0]['element_59'] !=NULL && strlen($x[0]['element_59'])>0) {
            $bc++;
                if($bc%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>Protein</th>";
        }
        
         if($x[0]['element_64'] !=NULL && strlen($x[0]['element_64'])>0) {
            $bc++;
                if($bc%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>Crude Fiber</th>";
        }
        
         if($x[0]['element_91'] !=NULL && strlen($x[0]['element_91'])>0) {
            $bc++;
                if($bc%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>Salmonella</th>";
        }
        echo '</tr>';
         echo " <tr>"; 
        foreach($x as $ent){
            
            if($ent['element_43'] !=NULL && strlen($ent['element_43'])>0) {
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_43]</td><!---moisture---!>  ";
            }
            
            if($ent['element_42'] !=NULL && strlen($ent['element_42'])>0) {
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_42]</td><!---FAT---!>";
            }
            
            if($ent['element_54'] !=NULL && strlen($ent['element_54'])>0) {
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_54]</td><!---ASH---!>";
            }
            
            if($ent['element_71'] !=NULL && strlen($ent['element_71'])>0) {
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'><!---ASH SS---!>"; 
                    switch($ent['element_71']){
                        case 1:
                            echo "As-is";
                        break;
                        case 2:
                            echo "Predried";
                        break;
                    }
            }
            if($ent['element_59'] !=NULL && strlen($ent['element_59'])>0) {
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_59]</td><!---Protein---!>";
            }
            
            if($ent['element_64'] !=NULL && strlen($ent['element_64'])>0) {
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_64]</td><!---Crude Fiber---!>";
            }
            
            if($ent['element_91'] !=NULL && strlen($ent['element_91'])>0) {
                $bb++;
                if($bb%2 == 0){
                    $bg = "rgb(230,245,226)";
                }else{
                    $bg = "#ffffff";
                }
                echo "<td style='background:$bg;'>$ent[element_91]</td><!---Salmonella---!>";
            }
            echo "</tr>";
        }
   }
    ?>
 </tbody>
 
    </table>