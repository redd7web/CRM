<style>
body{
    background:url(machforms/machform/images/form_resources/moulin.png) repeat left top;
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
.appnitro {
    font-family: "Lucida Grande",Tahoma,Arial,Verdana,sans-serif;
    font-size: small;
    margin:auto;
    margin-top:20px;
}
#main_body h1 a {
    background-image: url("https://inet.iwpusa.com/machforms/machform/data/themes/images/img_57709767059ebb6db91410dc896f7dba-IWP black.jpg");
    height: 100px;
    background-repeat: no-repeat;
    display: block;
}
#main_body h1 {
    text-indent: -8000px;
}
#form_container {
    text-align: left;
}
td{
    padding:15px 15px 15px 15px;
    margin:5px 5px 5px 5px;
    vertical-align:top;
    text-align:left;
}
</style>
<?php
include "protected/global.php";
ini_set("display_errors",1);



$nb = $db->query("SELECT * FROM Inetforms.ap_form_49773 WHERE ap_form_49773.id =$_GET[id]");
/*
echo "<pre>";
echo print_r($nb);
echo "</pre>";*/
?>
<body id="main_body">
<?php
echo "SELECT * FROM Inetforms.ap_form_49773 WHERE ap_form_49773.id =$_GET[id]";

?>
<div id="form_container">
<h1>
<a>BAKERY DESTRUCTION DETAIL</a>
</h1>
<table class="appnitro" style="width: 1000px;border-collapse:collapse;font-size:20px;border-radius:10px;background:url(https://inet.iwpusa.com/machforms/machform/images/form_resources/escheresque.png) repeat left top;">
<tr><td colspan="4" style="text-align: center;vertical-align:bottom;"><h1 style="color: black;text-indent:0px;">BAKERY DESTRUCTION DETAIL</h1></td></tr>
<tbody style="background:#bbbbbb;">
<tr><td colspan="4" style="text-align: center;"><h1 style="width: 50%;color: black;text-indent:0px;"><?php echo $nb[0]['element_3']; ?></h1></td></tr>
<tr><td style="text-align:left;"> Manager Code</td><td><?php echo $nb[0]['element_145']; ?></td><td style="text-align:left;">Truck Request Number</td><td><?php echo $nb[0]['element_76']; ?></td></tr>
<tr><td style="text-align:left;">Date Created</td><td><?php echo $nb[0]['element_1']." ".$nb[0]['element_2']; ?></td><td style="text-align:left;">Release Sale #</td><td><?php echo $nb[0]['element_82']; ?></td></tr>
<tr><td style="text-align:left;">Original Request ID </td><td><?php echo $nb[0]['element_85']; ?></td><td style="text-align:left;">Inbound WCS</td><td><?php echo $nb[0]['element_83']; ?></td></tr>
<tr><td style="text-align:left;">Request ID Number</td><td><?php echo $nb[0]['element_16']; ?></td><td style="text-align:left;">Weight Ticket Number</td><td><?php echo $nb[0]['element_77']; ?></td></tr>
<tr><td style="text-align:left;">Notes</td><td  colspan="3"><?php echo $nb[0]['element_84']; ?></td></tr>
</tbody>

<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4"><h1 style="color: black;text-indent:0px;">Sample Request Information</h1></td></tr>
<tr><td style="text-align:left;">Sample Request Date</td><td><?php echo $nb[0]['element_8']." ".$nb[0]['element_9'];; ?></td><td style="text-align:left;">Request</td><td><?php echo $nb[0]['element_10']; ?></td></tr>

<tr><td style="text-align:left;">Area</td><td><?php echo $nb[0]['element_11']; ?></td><td style="text-align:left;">Type</td><td><?php echo $nb[0]['element_12']; ?></td></tr>


<tr><td style="text-align:left;">Tank</td><td><?php echo $nb[0]['element_13']; ?></td><td style="text-align:left;">Spot/Lot Number</td><td><?php echo $nb[0]['element_14']; ?></td></tr>

<tr><td style="text-align:left;">Bakery Technician</td><td><?php 
    switch($nb[0]['element_4']){
        case 4: echo "Ruben"; break;
        case 5:echo "Ricardo"; break;
        case 6:echo "Ivan"; break;
        case 7:echo "Johhny"; break;
        case 8:echo "Joe"; break;
        case 9:echo "Daniel"; break;
        case 10:echo "Omar"; break;
        case 11:echo "Pablo"; break;
        case 12:echo "Other"; break;
    }

 ?></td><td style="text-align:left;">Lab Reference ID</td><td><?php echo $nb[0]['element_95']; ?></td></tr>

<tr><td style="text-align:left;">Type of Load</td><td><?php 
switch($nb[0]['element_136']){  
    case 1: echo "Candy"; break;
    case 2: echo "Mayo"; break;
    case 3: echo "Pet Food"; break;
    
}  ?></td><td style="text-align:left;">Seal</td><td><?php echo $nb[0]['element_88']; ?><br /><?php 
    if($nb[0]['element_3'] == "Completed"){
        if(strlen(trim($nb[0]['element_134']))>0 && $nb[0]['element_134'] !=null  ){
            echo "<img src='https://inet.iwpusa.com/machforms/machform/data/form_49773/files/".$nb[0]['element_134']."' style='width:40%;'/>";
        }
    }else if($nb[0]['element_3'] == "Approved"){
        $seal = $db->query("SELECT element_134 FROM Inetforms.ap_form_49773 WHERE id = ".$nb[0]['element_16']);
        if(count($seal)>0){
            echo "<a href='machforms/machform/data/form_49773/files/".$seal[0]['element_134']."' target='_blank'><img src='machforms/machform/data/form_49773/files/".$seal[0]['element_134']."' style='width:30%;'/></a>";
        }
    }
?></td></tr>

<?php
$bol = $db->query("SELECT ap_form_43256.element_151 FROM Inetforms.ap_form_43256 WHERE id  = ".$nb[0]['element_76']);

if(strlen(trim($bol[0]['element_151']))>0){
    echo "<tr><td>BOL</td><td><img src='https://inet.iwpusa.com/machforms/machform/data/form_43256/files/$dogfood[element_151]' style='width:50%;height:50%;'/></td></tr>";
}

?>


<?php if(strlen(trim($nb[0]['element_205']))>0){ ?>
<tr><td>Product Ext Cost (4) </td><td><?php echo $nb[0]['element_205']; ?></td></tr>
<?php 
}?>

<?php if(strlen(trim($nb[0]['element_221']))>0){ ?>
<tr><td>Product Ext Cost (5) </td><td><?php echo $nb[0]['element_221']; ?></td></tr>
<?php 
}?>


<?php if(strlen(trim($nb[0]['element_237']))>0){ ?>
<tr><td>Product Ext Cost (6) </td><td><?php echo $nb[0]['element_237']; ?></td></tr>
<?php 
}?>


<?php if(strlen(trim($nb[0]['element_253']))>0){ ?>
<tr><td>Product Ext Cost (7) </td><td><?php echo $nb[0]['element_253']; ?></td></tr>
<?php 
}?>

<?php if(strlen(trim($nb[0]['element_269']))>0){ ?>
<tr><td>Product Ext Cost (8) </td><td><?php echo $nb[0]['element_269']; ?></td></tr>
<?php 
}?>

<?php if(strlen(trim($nb[0]['element_285']))>0){ ?>
<tr><td>Product Ext Cost (9) </td><td><?php echo $nb[0]['element_285']; ?></td></tr>
<?php 
}?>
<?php if(strlen(trim($nb[0]['element_301']))>0){ ?>
<tr><td>Product Ext Cost (10) </td><td><?php echo $nb[0]['element_301']; ?></td></tr>
<?php 
}?>

<?php if(strlen(trim($nb[0]['element_100']))>0){ ?>
<tr><td style="text-align:left;" colspan="2">QTY of Products/Sizes </td><td colspan="2"><?php echo $nb[0]['element_100']; ?></td><td style="text-align:left;"></td></tr>
<?php } ?>
<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>


<?php 
    if(strlen(trim($nb[0]['element_99']))>0 && $nb[0]['element_99']!=null  && $nb[0]['element_99'] !=0){
        
    
?>
<tr><td style="text-align:left;" colspan="2">Product 1</td><td colspan="2"><?php product_translate($nb[0]['element_99']);  ?></td></tr>


<?php 
    
    if($nb[0]['element_157_1'] ==1){
        echo "<tr><td>QTY Skids </td>"; 
            if(strlen(trim($nb[0]['element_89']))>0 && $nb[0]['element_89'] !=null){
                echo "<td>".$nb[0]['element_89']."</td>";
            }
        echo "</tr>";
    }
    if($nb[0]['element_157_2'] ==1){
        echo "<tr>"; 
            if(strlen(trim($nb[0]['element_90']))>0 && $nb[0]['element_90']  ){
                echo "<td>QTY Pallets </td><td>".$nb[0]['element_90']."</td>";
            }
        
            if(strlen(trim($nb[0]['element_172']))>0 && $nb[0]['element_172']){
                echo "<td>Total Pallet Weight</td><td> ".$nb[0]['element_172']."</td>"; 
            }
        echo "</tr>";
    }
    if($nb[0]['element_157_3'] ==1){        
        echo "<tr><td>Bulk</td>";
        if(strlen(trim($nb[0]['element_91']))>0){
            echo "<td>QTY Bulk </td><td>".$nb[0]['element_91']."</td>";
        } 
        echo "</tr>";
    }
    if($nb[0]['element_157_4'] ==1){
        echo "<tr><td>Other</td>";
        if(strlen(trim($nb[0]['element_92']))>0){
            echo "<td>QTY Other</td><td>".$nb[0]['element_92']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_98']))>0){
            echo "<td>Other Type</td><td>".$nb[0]['element_98']."</td>";
        }
        echo "</tr>";
    }?>

    <?php
    
    echo"<tr>"; 
        if(strlen(trim($nb[0]['element_159']))>0){
            echo "<td>Units per Case</td><td>".$nb[0]['element_159']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_160']))>0){
            echo "<td>QTY of Cases </td><td>".$nb[0]['element_160']."</td>";
        }
    
    echo "</tr>
    
    <tr>"; 
        if(strlen(trim($nb[0]['element_161']))>0){
            echo "<td>QTY Units of Product</td><td>".$nb[0]['element_161']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_162']))>0){
            echo "<td>Product Weight Total</td><td>".$nb[0]['element_162']."</td>";
        }
    echo "</tr>
    
    
    

    <tr>"; 
    
        if(strlen(trim($nb[0]['element_163']))>0){
            echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_163']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_173']))>0){
            echo "<td>Net Product Weight</td><td>".$nb[0]['element_173']."</td>";
        }
    echo "</tr>
    
    
    <tr>"; 
        if(strlen(trim($nb[0]['element_164']))>0){
             echo "<td>Product Ext Cost (1) </td><td>".$nb[0]['element_164']."</td>"; 
        }
    echo "</tr>";
}
echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
 
 if(strlen(trim($nb[0]['element_101']))>0 && $nb[0]['element_101']!=null  && $nb[0]['element_101'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 2</td><td colspan="2">';
    product_translate($nb[0]['element_101']);
    echo '</td></tr>';
    if($nb[0]['element_102_1'] ==1){
        echo "<tr><td>QTY Skids </td><td>".$nb[0]['element_104']."</td></tr>";
    }
    if($nb[0]['element_102_2'] ==1){
        echo "<tr>"; 
        if(strlen(trim($nb[0]['element_174']) )>0){
            echo "<td>Total Pallet Weight </td><td>".$nb[0]['element_174']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_105']) )>0){
            echo "<td>QTY Pallets </td><td>".$nb[0]['element_105']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_102_3'] ==1){
        echo "<tr><td>QTY Bulk </td><td>".$nb[0]['element_106']."</td></tr>";
    }
    if($nb[0]['element_102_4'] ==1){
        echo "<tr><td>Other Type</td><td>".$nb[0]['element_103']."</td></tr>";
    } 
    echo"<tr>"; 
        if(strlen(trim($nb[0]['element_156']))>0){
            echo "<td>Units per Case</td><td>".$nb[0]['element_156']."</td>";
        }
    
        if(strlen(trim($nb[0]['element_154']))>0){
            echo "<td>QTY of Cases </td><td>".$nb[0]['element_154']."</td>";
        }
    echo "</tr>
    
    <tr>";
    if(strlen(trim($nb[0]['element_153']))>0){
        echo "<td>QTY Units of Product</td><td>".$nb[0]['element_153']."</td>";
    }
    
    if(strlen(trim($nb[0]['element_150']))>0){
        echo "<td>Product Weight Total</td><td>".$nb[0]['element_150']."</td>";
    }
    
    echo "</tr>
    
    <tr>"; 
        if(strlen(trim($nb[0]['element_151']))>0){
           echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_151']."</td>";
        }
        if(strlen(trim($nb[0]['element_151']))>0){
           echo "<td>Net Product Weight</td><td>".$nb[0]['element_176']."</td>";
        }
    echo "</tr>
    ";
 }  
 
 echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
if(strlen(trim($nb[0]['element_113']))>0 && $nb[0]['element_113']!=null  && $nb[0]['element_113'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 3</td><td colspan="2">';
    product_translate($nb[0]['element_113']);

    echo '</td></tr>';
    if($nb[0]['element_114_1'] ==1){
        echo "<tr><td>QTY Skids </td><td>".$nb[0]['element_116']."</td></tr>";
    }
    echo "<tr>";
    if($nb[0]['element_114_2'] ==1){
        if(strlen(trim($nb[0]['element_117']))>0){
            echo "<td>QTY Pallets </td><td>".$nb[0]['element_117']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_175']))>0){
            echo "<td>Total Pallet Weight ".$nb[0]['element_175']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_114_3'] ==1){
        echo "<tr><td>Bulk</td><td>QTY Bulk ".$nb[0]['element_118']."</td></tr>";
    }
    
    if($nb[0]['element_114_4'] ==1){
         echo "<tr>";
        if(strlen(trim($nb[0]['element_119']))>0){
            echo "<td>QTY Other</td><td>".$nb[0]['element_119']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_115']))>0){
            echo "<td>Other Type</td><td>".$nb[0]['element_115']."</td>";
        }
       echo "</tr>";
    } 
    
    
    echo"<tr>"; 
        if(strlen(trim($nb[0]['element_166']))>0){
            echo "<td>Units per Case</td><td>".$nb[0]['element_166']."</td>";
        }
        if(strlen(trim($nb[0]['element_167']))>0){
            echo "<td>QTY of Cases </td><td>".$nb[0]['element_167']."</td>";
        }
    echo "</tr>
    
    
    <tr>"; 
        if(strlen(trim($nb[0]['element_168']))>0){
            echo "<td>QTY Units of Product</td><td>".$nb[0]['element_168']."</td>";
        }
        if(strlen(trim($nb[0]['element_168']))>0){
            echo "<td>Product Weight Total</td><td>".$nb[0]['element_169']."</td>";
        }
    echo "</tr>
    <tr>"; 
        if(strlen(trim($nb[0]['element_170']))>0){
            echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_170']."</td>";   
        }
        
        if(strlen(trim($nb[0]['element_177']))>0){
            echo "<td>Net Product Weight</td><td>".$nb[0]['element_177']."</td>";
        }
    
    echo "</tr>
    ";
}
    echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';

if(strlen(trim($nb[0]['element_191']))>0 && $nb[0]['element_191']!=null  && $nb[0]['element_191'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 4</td><td colspan="2">';
    product_translate($nb[0]['element_191']);
    echo '</td></tr>';
    if($nb[0]['element_193_1'] ==1){
        echo "<tr><td>QTY Skids </td><td>".$nb[0]['element_198']."</td></tr>";
    }
    if($nb[0]['element_193_2'] ==1){
        echo "<tr>"; 
            if(strlen(trim($nb[0]['element_199']) )>0){
                echo "<td>QTY Pallets</td><td>".$nb[0]['element_199']."</td>"; 
            }
            
            if(strlen(trim($nb[0]['element_302']) )>0){
                echo "<td>Total Pallet Weight</td><td>".$nb[0]['element_302']."</td>";
            }
        echo "</tr>";
        
    }
    if($nb[0]['element_193_3'] ==1){
        echo "<tr><td>QTY Bulk </td><td>".$nb[0]['element_200']."</td></tr>";
    }
    if($nb[0]['element_193_4'] ==1){
        echo "<tr><td>".$nb[0]['element_201']."</td><td>Other Type</td><td>".$nb[0]['element_194']."</td></tr>";
    } 
    echo"<tr>"; 
        if(strlen(trim($nb[0]['element_195']))>0){
            echo "<td>Units per Case</td><td>".$nb[0]['element_195']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_212']))>0){
            echo "<td>QTY of Cases </td><td>".$nb[0]['element_212']."</td>";
        }
    echo "</tr>
    <tr>"; 
        if(strlen(trim($nb[0]['element_213']))>0){
            echo "<td>QTY Units of Product</td><td>".$nb[0]['element_213']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_169']))>0){
            echo "<td>Product Weight Total</td><td>".$nb[0]['element_169']."</td>";
        }
    echo "</tr>
    <tr>"; 
        if(strlen(trim($nb[0]['element_219']))>0){
            echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_219']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_220']))){
            echo "<td>Net Product Weight</td><td>".$nb[0]['element_220']."</td>";
        }
    echo "</tr>
    ";
    echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
 }   



if(strlen($nb[0]['element_207'])>0 && $nb[0]['element_207']!=null  && $nb[0]['element_207'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 5</td><td colspan="2">';
    product_translate($nb[0]['element_207']);
    echo '</td></tr>';
    if($nb[0]['element_209_1'] ==1){
        echo "<tr><td>QTY Skids </td><td>".$nb[0]['element_214']."</td></tr>";
    }
    if($nb[0]['element_209_2'] ==1){
        echo "<tr>"; 
            if(strlen(trim($nb[0]['element_215']))){
                echo "<td>QTY Pallets </td><td>".$nb[0]['element_215']."</td>";
            }
            if(strlen(trim($nb[0]['element_303']))){
                echo "<td>Total Pallet Weight</td><td> ".$nb[0]['element_303']."</td>";
            }
           
        echo "</tr>";
    }
    if($nb[0]['element_209_3'] ==1){
        echo "<tr><td>QTY Bulk ".$nb[0]['element_216']."</td></tr>";
    }
    if($nb[0]['element_209_4'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_217']) )>0){
            echo "<td>QTY Other</td><td>".$nb[0]['element_217']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_210']) )>0){
            echo "<td>Other Type</td><td>".$nb[0]['element_210']."</td>";
        }
        echo "</tr>";
    } 
    
    
    echo"<tr>"; 
        if(strlen(trim($nb[0]['element_211']) )>0){
            echo "<td>Units per Case</td><td>".$nb[0]['element_211']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_212']) )>0){
            echo "<td>QTY of Cases </td><td>".$nb[0]['element_212']."</td>";
        }
    echo "</tr>
    
    <tr>"; 
        if(strlen(trim($nb[0]['element_213']) )>0){
            echo "<td>QTY Units of Product</td><td>".$nb[0]['element_213']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_169']) )>0){
            echo "<td>Product Weight Total</td><td>".$nb[0]['element_169']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>"; 
        if(strlen(trim($nb[0]['element_219']) )>0){
            echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_219']."</td>";
        }
        if(strlen(trim($nb[0]['element_220']) )>0){
            echo "<td>Net Product Weight</td><td>".$nb[0]['element_220']."</td>";
        }
    echo "</tr>";
    echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
 }    
?>





<?php 
if(strlen(trim($nb[0]['element_223']))>0 && $nb[0]['element_223']!=null  && $nb[0]['element_223'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 6</td><td colspan="2">';
    product_translate($nb[0]['element_223']);
    echo '</td></tr>';
    if($nb[0]['element_225_1'] ==1){
        echo "<tr><td>Skids</td><td>QTY Skids ".$nb[0]['element_214']."</td></tr>";
    }
    if($nb[0]['element_225_2'] ==1){
            
        echo "<tr>"; 
            if(strlen(trim($nb[0]['element_231']) )>0){
            	echo "<td>QTY Pallets </td><td>".$nb[0]['element_231']."</td>";
            }
            
            if(strlen(trim() )>0){
            	echo "<td>Total Pallet Weight</td><td>".$nb[0]['element_304']."</td>";
            }
        echo "</tr>";
    }
    if($nb[0]['element_225_3'] ==1){
        echo "<tr><td>Bulk</td><td>QTY Bulk ".$nb[0]['element_232']."</td></tr>";
    }
    if($nb[0]['element_225_4'] ==1){
        if(strlen(trim($nb[0]['element_217']) )>0){
        	echo "<td>QTY Other</td><td>".$nb[0]['element_217']."</td>";
        }
        if(strlen(trim($nb[0]['element_210']) )>0){
        	echo "<td>Other Type</td><td>".$nb[0]['element_210']."</td>";
        }
        
        echo "<tr></tr>";
    } 
    echo"<tr>"; 
    if(strlen(trim($nb[0]['element_227']) )>0){
    	echo "<td>Units per Case</td><td>".$nb[0]['element_227']."</td>";
    }
    
    if(strlen(trim($nb[0]['element_233']) )>0){
    	echo "<td>QTY of Cases </td><td>".$nb[0]['element_233']."</td>";
    }
    echo "</tr>
    <tr>";
        if(strlen(trim($nb[0]['element_229']) )>0){
        	echo "<td>QTY Units of Product</td><td>".$nb[0]['element_229']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_234']) )>0){
        	echo "<td>Product Weight Total</td><td>".$nb[0]['element_234']."</td>";
        }
      echo "</tr>
    <tr>"; 
        if(strlen(trim($nb[0]['element_235']) )>0){
        	echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_235']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_236']) )>0){
        	echo "<td>Net Product Weight</td><td>".$nb[0]['element_236']."</td>";
        }
    echo ""; echo "</tr>
    ";
    echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
 }    
 
 
 if(strlen(trim($nb[0]['element_239']))>0 && $nb[0]['element_239']!=null  && $nb[0]['element_239'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 7</td><td colspan="2">';
    product_translate($nb[0]['element_239']);
    echo '</td></tr>';
    if($nb[0]['element_241_1'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_246']) )>0){
        	echo "<td>QTY Skids </td><td>".$nb[0]['element_246']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_241_2'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_247']) )>0){
        	echo "<td>QTY Pallets </td><td>".$nb[0]['element_247']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_305']) )>0){
        	echo "<td>Total Pallet Weight</td><td>".$nb[0]['element_305']."</td>";
        }
         echo "</tr>";
    }
    if($nb[0]['element_241_3'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_248']) )>0){
        	echo "<td>QTY Bulk </td><td>".$nb[0]['element_248']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_241_4'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_249']) )>0){
        	echo "<td>QTY Other</td><td>".$nb[0]['element_249']."</td>";
        }
        if(strlen(trim($nb[0]['element_242']) )>0){
        	echo "<td>Other Type</td><td>".$nb[0]['element_242']."</td>";
        }
        
        echo "</tr>";
    } 
    echo"<tr>";
    if(strlen(trim($nb[0]['element_243']) )>0){
    	echo "<td>Units per Case</td><td>".$nb[0]['element_243']."</td>";
    }
    
    if(strlen(trim($nb[0]['element_244']) )>0){
    	echo "<td>QTY of Cases </td><td>".$nb[0]['element_244']."</td>";
    }
   echo "</tr>
    <tr>"; 
    if(strlen(trim($nb[0]['element_245']) )>0){
    	echo "<td>QTY Units of Product</td><td>".$nb[0]['element_245']."</td>";
    }
    
    if(strlen(trim($nb[0]['element_250']) )>0){
    	echo "<td>Product Weight Total</td><td>".$nb[0]['element_250']."</td>";
    }
    
    echo "</tr>
    <tr>"; 
        if(strlen(trim($nb[0]['element_251']) )>0){
        	echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_251']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_252']) )>0){
        	echo "<td>Net Product Weight</td><td>".$nb[0]['element_252']."</td>";
        }
         echo "</tr>";
    echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
 }
 
 if(strlen(trim($nb[0]['element_255']))>0 && $nb[0]['element_255']!=null  && $nb[0]['element_255'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 8</td><td colspan="2">';
    product_translate($nb[0]['element_255']);
    echo '</td></tr>';
    if($nb[0]['element_241_1'] ==1){
        
        echo "<tr>";
        if(strlen(trim($nb[0]['element_262']) )>0){
        	echo "<td>Skids</td><td>QTY Skids ".$nb[0]['element_262']."</td>";
        }echo "</tr>";
    }
    if($nb[0]['element_241_2'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_263']) )>0){
        	echo "<td>QTY Pallets </td><td>".$nb[0]['element_263']."</td>";
        }
        if(strlen(trim($nb[0]['element_306']) )>0){
        	echo "<td>Total Pallet Weight </td><td>".$nb[0]['element_306']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_241_3'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_264']) )>0){
        	echo "<td>QTY Bulk </td><td>".$nb[0]['element_264']."</td>";
        }
        echo "</tr>";
        
    }
    if($nb[0]['element_241_4'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_265']) )>0){
        	echo "<td>QTY Other</td><td>".$nb[0]['element_265']."</td>";
        }
        if(strlen(trim($nb[0]['element_258']) )>0){
        	echo "<td>Other Type</td><td>".$nb[0]['element_258']."</td>";
        }
        echo "</tr>";
        
    } 
    echo"<tr>"; 
    if(strlen(trim($nb[0]['element_261']) )>0){
    	echo "<td>Units per Case</td><td>".$nb[0]['element_261']."</td>";
    }
    if(strlen(trim($nb[0]['element_260']) )>0){
    	echo "<td>QTY of Cases </td><td>".$nb[0]['element_260']."</td>";
    }
    echo "</tr>";
    
    echo "<tr>"; 
    if(strlen(trim($nb[0]['element_245']) )>0){
    	echo "<td>QTY Units of Product</td><td>".$nb[0]['element_245']."</td>";
    }
    
    if(strlen(trim($nb[0]['element_250']) )>0){
    	echo "<td>Product Weight Total</td><td>".$nb[0]['element_250']."</td>";
    }
    echo "</tr>";
    echo "<tr>";
        if(strlen(trim($nb[0]['element_251']) )>0){
        	echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_251']."</td>";
        }
        if(strlen(trim($nb[0]['element_252']) )>0){
        	echo "<td>Net Product Weight</td><td>".$nb[0]['element_252']."</td>";
        }
    echo "</tr>";
    
    echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
 }
 
 if(strlen(trim($nb[0]['element_271']))>0 && $nb[0]['element_271']!=null  && $nb[0]['element_271'] !=0){
    echo '<tr><td style="text-align:left;" colspan="2">Product 9</td><td colspan="2">';
    product_translate($nb[0]['element_271']);
    echo '</td></tr>';
    if($nb[0]['element_273_1'] ==1){
        
        echo "<tr>";
        if(strlen(trim($nb[0]['element_278']) )>0){
        	echo "<td>Skids</td><td>QTY Skids ".$nb[0]['element_278']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_273_2'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_263']) )>0){
        	echo "<td>QTY Pallets </td><td>".$nb[0]['element_263']."</td>";
        }
        if(strlen(trim($nb[0]['element_307']) )>0){
        	echo "<td>Total Pallet Weight </td><td>".$nb[0]['element_307']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_273_3'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_264']) )>0){
        	echo "<td>Bulk</td><td>QTY Bulk ".$nb[0]['element_264']."</td>";
        }
        echo "</tr>";
    }
    if($nb[0]['element_273_4'] ==1){
        echo "<tr>";
        if(strlen(trim($nb[0]['element_265']) )>0){
        	echo "<td>QTY Other</td><td>".$nb[0]['element_265']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_258']) )>0){
        	echo "<td>Other Type</td><td>".$nb[0]['element_258']."</td>";
        }
        echo "</tr>";
    } 
    echo"<tr>"; 
    if(strlen(trim($nb[0]['element_261']) )>0){
    	echo "<td>Units per Case</td><td>".$nb[0]['element_261']."</td>";
    }
    if(strlen(trim() )>0){
    	echo "<td>QTY of Cases </td><td>".$nb[0]['element_260']."</td>";
    }
    echo "</tr>";
    
    echo "<tr>"; 
        if(strlen(trim($nb[0]['element_245']) )>0){
        	echo "<td>QTY Units of Product</td><td>".$nb[0]['element_245']."</td>";
        }
        if(strlen(trim($nb[0]['element_250']) )>0){
        	echo "<td>Product Weight Total</td><td>".$nb[0]['element_250']."</td>";
        }
    echo "</tr>";
    echo "<tr>";
    if(strlen(trim($nb[0]['element_251']) )>0){
    	echo "<td>Applied Product Shrink</td><td>".$nb[0]['element_251']."</td>";
    }
    if(strlen(trim($nb[0]['element_252']) )>0){
    	echo "<td>Net Product Weight</td><td>".$nb[0]['element_252']."</td>";
    }
    echo "</tr>";

    
    echo '<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
';
 }
 


//petfood 1
if(strlen(trim($nb[0]['element_321']))>0 && $nb[0]['element_321'] !=0 ){//1
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 1</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_321'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_322']))>0){
            echo "<td>Product (Petfood 1) Other </td><td>".$nb[0]['element_322']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_325']))>0){
            echo "<td>Units per Case (Petfood 1) </td><td>".$nb[0]['element_325']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_458']))>0){
            echo "<td>QTY of Cases (Petfood 1) </td><td>".$nb[0]['element_458']."</td>";
        }
    echo "</tr>";
    
    
    if(strlen(trim($nb[0]['element_327']))>0  ){
        echo "<tr><td>QTY Units of Product (Petfood 1)</td><td>".$nb[0]['element_327']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_323_1']==1){            
            echo "<td>Skids</td><td>".$nb[0]['element_328']."</td>";            
        }
        if($nb[0]['element_323_3']==1){            
            if(strlen(trim($nb[0]['element_329']))>0){
                echo "<td>QTY Bulk (Petfood 1)  </td><td>".$nb[0]['element_331']."</td>";
            }
        }
    echo "</tr>";   
        
    
    if($nb[0]['element_323_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_329']))>0){
                echo "<td>QTY Pallets (Petfood 1) </td><td>".$nb[0]['element_329']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_330']))>0){
                 echo "<td>Total Pallet Weight (Petfood 1)</td><td>".$nb[0]['element_330']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_323_4']==1){
            if(strlen(trim($nb[0]['element_332']))>0){
                echo "<td>QTY Other (Petfood 1)</td><td>".$nb[0]['element_332']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";//red blue
        if($nb[0]['element_323_6'] ==1){
            if( strlen(trim($nb[0]['element_613'])  ) >0  ){
                echo "<td>".$nb[0]['element_613']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_614'])  ) >0  ){
                echo "<td>".$nb[0]['element_614']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_323_5'] ==1){
            if( strlen(trim($nb[0]['element_612'])  ) >0  ){
                echo "<td>".$nb[0]['element_612']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_615'])  ) >0  ){
                echo "<td>".$nb[0]['element_615']."</td>";
            }
        }
    echo "</tr>";
    
    
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_333']))>0  ){
            echo "<td>Product Weight Total (Petfood 1)</td><td>".$nb[0]['element_333']."</td>";
        }
        if  (strlen(trim($nb[0]['element_334']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 1) </td><td>".$nb[0]['element_334']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_335']))>0  ){
            echo "<td>Net Product Weight (Petfood 1)</td><td>".$nb[0]['element_335']."</td>";
        }
        if  (strlen(trim($nb[0]['element_336']))>0  ){
            echo "<td>Product Ext Cost (Petfood 1) </td><td>".$nb[0]['element_336']."</td>";
        }
    echo "</tr>";
    echo "<tr>";
    
    if(strlen(trim($nb[0]['element_656']))>0 && $nb[0]['element_656'] !=0){
        echo "<td>Product PPT (Petfood 1) </td><td>".$nb[0]['element_656']."</td>";
    }
    
    echo "</tr>";
}


//product ventura 1
if(strlen(trim($nb[0]['element_460']))>0 && $nb[0]['element_460'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 1</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 1) </td><td>".ventura_products($nb[0]['element_460'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_461']))>0){
            echo "<td>Product (Ventura 1) Other  </td><td>".$nb[0]['element_461']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_464']))>0){
            echo "<td>Units per Case (Ventura 1)  </td><td>".$nb[0]['element_464']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_465']))>0){
            echo "<td>QTY of Cases (Ventura 1) </td><td>".$nb[0]['element_465']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_466']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 1)</td><td>".$nb[0]['element_466']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_462_1']==1){            
            echo "<td>Skids (Ventura 1)</td><td>".$nb[0]['element_467']."</td>";            
        }
        if($nb[0]['element_462_3']==1){            
            if(strlen(trim($nb[0]['element_470']))>0){
                echo "<td>QTY Bulk (Ventura 1)  </td><td>".$nb[0]['element_470']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_462_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_468']))>0){
                echo "<td>QTY Pallets (Ventura 1) </td><td>".$nb[0]['element_468']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_469']))>0){
                 echo "<td>Total Pallet Weight (Ventura 1)</td><td>".$nb[0]['element_469']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_462_4']==1){
            if(strlen(trim($nb[0]['element_471']))>0){
                echo "<td>QTY Other (Ventura 1)</td><td>".$nb[0]['element_471']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_472']))>0  ){
            echo "<td>Product Weight Total (Ventura 1)</td><td>".$nb[0]['element_472']."</td>";
        }
        if  (strlen(trim($nb[0]['element_473']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 1) </td><td>".$nb[0]['element_473']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_474']))>0  ){
            echo "<td>Net Product Weight (Ventura 1)</td><td>".$nb[0]['element_474']."</td>";
        }
        if  (strlen(trim($nb[0]['element_475']))>0  ){
            echo "<td>Product Ext Cost (Ventura 1) </td><td>".$nb[0]['element_475']."</td>";
        }
    echo "</tr>";
}



//petfood 2
if(strlen(trim($nb[0]['element_338']))>0 && $nb[0]['element_338'] !=0){//2
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 2</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_338'])."</td>"; 
        if(strlen(trim($nb[0]['element_339']))>0){
            echo "<td>Product (Petfood 2) Other </td><td>".$nb[0]['element_339']."</td>";
        }
    echo "</tr>";
    
    
    
    echo "<tr>";
        if($nb[0]['element_340_1']==1){            
            echo "<td>Skids</td><td>".$nb[0]['element_344']."</td>";            
        }
        if($nb[0]['element_340_3']==1){            
            if(strlen(trim($nb[0]['element_329']))>0){
                echo "<td>QTY Bulk (Petfood 2)  </td><td>".$nb[0]['element_347']."</td>";
            }
        }
    echo "</tr>"; 
    
    if($nb[0]['element_340_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_345']))>0){
                echo "<td>QTY Pallets (Petfood 2) </td><td>".$nb[0]['element_345']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_346']))>0){
                 echo "<td>Total Pallet Weight (Petfood 2)</td><td>".$nb[0]['element_346']."</td>";
            }
        echo "</tr>"; 
    }
    
     echo "<tr>";
        if($nb[0]['element_340_4']==1){
            if(strlen(trim($nb[0]['element_348']))>0){
                echo "<td>QTY Other (Petfood 2)</td><td>".$nb[0]['element_348']."</td>";
            }
        }
    echo "</tr>";
    
    
    echo "<tr>";//red blue
        if($nb[0]['element_340_5'] ==1){
            if( strlen(trim($nb[0]['element_617'])  ) >0  ){
                echo "<td>".$nb[0]['element_617']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_614'])  ) >0  ){
                echo "<td>".$nb[0]['element_614']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_340_6'] ==1){
            if( strlen(trim($nb[0]['element_616'])  ) >0  ){
                echo "<td>".$nb[0]['element_616']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_618'])  ) >0  ){
                echo "<td>".$nb[0]['element_618']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_349']))>0  ){
            echo "<td>Product Weight Total (Petfood 2)</td><td>".$nb[0]['element_349']."</td>";
        }
        if  (strlen(trim($nb[0]['element_350']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 2) </td><td>".$nb[0]['element_350']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_351']))>0  ){
            echo "<td>Net Product Weight (Petfood 2)</td><td>".$nb[0]['element_351']."</td>";
        }
        if  (strlen(trim($nb[0]['element_352']))>0  ){
            echo "<td>Product Ext Cost (Petfood 2) </td><td>".$nb[0]['element_352']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_657']))>0 && $nb[0]['element_657'] !=0){
        echo "<td>Product PPT (Petfood 2) </td><td>".$nb[0]['element_657']."</td>";
    }
} 

//product ventura 2
if(strlen(trim($nb[0]['element_477']))>0  && $nb[0]['element_477'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 2</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 2) </td><td>".ventura_products($nb[0]['element_477'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_461']))>0){
            echo "<td>Product (Ventura 2) Other  </td><td>".$nb[0]['element_461']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_464']))>0){
            echo "<td>Units per Case (Ventura 2)  </td><td>".$nb[0]['element_464']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_465']))>0){
            echo "<td>QTY of Cases (Ventura 2) </td><td>".$nb[0]['element_465']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_466']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 2)</td><td>".$nb[0]['element_466']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_462_1']==1){            
            echo "<td>Skids (Ventura 2)</td><td>".$nb[0]['element_467']."</td>";            
        }
        if($nb[0]['element_462_3']==1){            
            if(strlen(trim($nb[0]['element_470']))>0){
                echo "<td>QTY Bulk (Ventura 2)  </td><td>".$nb[0]['element_470']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_462_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_468']))>0){
                echo "<td>QTY Pallets (Ventura 2) </td><td>".$nb[0]['element_468']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_469']))>0){
                 echo "<td>Total Pallet Weight (Ventura 2)</td><td>".$nb[0]['element_469']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_462_4']==1){
            if(strlen(trim($nb[0]['element_471']))>0){
                echo "<td>QTY Other (Ventura 2)</td><td>".$nb[0]['element_471']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_489']))>0  ){
            echo "<td>Product Weight Total (Ventura 2)</td><td>".$nb[0]['element_489']."</td>";
        }
        if  (strlen(trim($nb[0]['element_491']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 2) </td><td>".$nb[0]['element_491']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_490']))>0  ){
            echo "<td>Net Product Weight (Ventura 2)</td><td>".$nb[0]['element_490']."</td>";
        }
        if  (strlen(trim($nb[0]['element_492']))>0  ){
            echo "<td>Product Ext Cost (Ventura 2) </td><td>".$nb[0]['element_492']."</td>";
        }
    echo "</tr>";
}


//Petfood 3
if(strlen(trim($nb[0]['element_354']))>0 && $nb[0]['element_354'] !=0){//3
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 3</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_354'])."</td>"; 
        if(strlen(trim($nb[0]['element_355']))>0){
            echo "<td>Product (Petfood 3) Other </td><td>".$nb[0]['element_355']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if($nb[0]['element_356_1']==1){            
            echo "<td>Skids</td><td>".$nb[0]['element_360']."</td>";            
        }
        if($nb[0]['element_356_3']==1){            
            if(strlen(trim($nb[0]['element_329']))>0){
                echo "<td>QTY Bulk (Petfood 3)  </td><td>".$nb[0]['element_363']."</td>";
            }
        }
    echo "</tr>"; 
    
    
    if($nb[0]['element_340_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_345']))>0){
                echo "<td>QTY Pallets (Petfood 3) </td><td>".$nb[0]['element_345']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_346']))>0){
                 echo "<td>Total Pallet Weight (Petfood 3)</td><td>".$nb[0]['element_346']."</td>";
            }
        echo "</tr>"; 
    }
    
     echo "<tr>";
        if($nb[0]['element_356_4']==1){
            if(strlen(trim($nb[0]['element_364']))>0){
                echo "<td>QTY Other (Petfood 3)</td><td>".$nb[0]['element_364']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_365']))>0  ){
            echo "<td>Product Weight Total (Petfood 3)</td><td>".$nb[0]['element_365']."</td>";
        }
        if  (strlen(trim($nb[0]['element_366']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 3) </td><td>".$nb[0]['element_366']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_367']))>0  ){
            echo "<td>Net Product Weight (Petfood 3)</td><td>".$nb[0]['element_367']."</td>";
        }
        if  (strlen(trim($nb[0]['element_368']))>0  ){
            echo "<td>Product Ext Cost (Petfood 3) </td><td>".$nb[0]['element_368']."</td>";
        }
    echo "</tr>";
    
     if(strlen(trim($nb[0]['element_658']))>0 && $nb[0]['element_658'] !=0){
        echo "<td>Product PPT (Petfood 3) </td><td>".$nb[0]['element_658']."</td>";
    }
}


//product ventura 3
if(strlen(trim($nb[0]['element_494']))>0 && $nb[0]['element_494'] !=0 ){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 3</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 3) </td><td>".ventura_products($nb[0]['element_494'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_495']))>0){
            echo "<td>Product (Ventura 3) Other  </td><td>".$nb[0]['element_495']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_498']))>0){
            echo "<td>Units per Case (Ventura 3)  </td><td>".$nb[0]['element_498']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_499']))>0){
            echo "<td>QTY of Cases (Ventura 3) </td><td>".$nb[0]['element_499']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_500']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 3)</td><td>".$nb[0]['element_500']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_496_1']==1){            
            echo "<td>Skids (Ventura 3)</td><td>".$nb[0]['element_501']."</td>";            
        }
        if($nb[0]['element_496_3']==1){            
            if(strlen(trim($nb[0]['element_504']))>0){
                echo "<td>QTY Bulk (Ventura 3)  </td><td>".$nb[0]['element_504']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_496_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_502']))>0){
                echo "<td>QTY Pallets (Ventura 3) </td><td>".$nb[0]['element_502']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_503']))>0){
                 echo "<td>Total Pallet Weight (Ventura 3)</td><td>".$nb[0]['element_503']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_496_4']==1){
            if(strlen(trim($nb[0]['element_505']))>0){
                echo "<td>QTY Other (Ventura 3)</td><td>".$nb[0]['element_505']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";//red blue
        if($nb[0]['element_356_5'] ==1){
            if( strlen(trim($nb[0]['element_621'])  ) >0  ){
                echo "<td>".$nb[0]['element_621']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_614'])  ) >0  ){
                echo "<td>".$nb[0]['element_614']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_356_6'] ==1){
            if( strlen(trim($nb[0]['element_620'])  ) >0  ){
                echo "<td>".$nb[0]['element_620']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_622'])  ) >0  ){
                echo "<td>".$nb[0]['element_622']."</td>";
            }
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_506']))>0  ){
            echo "<td>Product Weight Total (Ventura 3)</td><td>".$nb[0]['element_506']."</td>";
        }
        if  (strlen(trim($nb[0]['element_507']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 3) </td><td>".$nb[0]['element_507']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_508']))>0  ){
            echo "<td>Net Product Weight (Ventura 3)</td><td>".$nb[0]['element_508']."</td>";
        }
        if  (strlen(trim($nb[0]['element_509']))>0  ){
            echo "<td>Product Ext Cost (Ventura 3) </td><td>".$nb[0]['element_509']."</td>";
        }
    echo "</tr>";
}



if(strlen(trim($nb[0]['element_370']))>0 && $nb[0]['element_370'] !=0){//4
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 4</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_370'])."</td>"; 
        if(strlen(trim($nb[0]['element_371']))>0){
            echo "<td>Product (Petfood 4) Other </td><td>".$nb[0]['element_371']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if($nb[0]['element_372_1']==1){
            if(strlen(trim($nb[0]['element_376']))>0){
                echo "<td>Skids</td><td>".$nb[0]['element_376']."</td>";  
            }  
        }
        if($nb[0]['element_372_3']==1){            
            if(strlen(trim($nb[0]['element_379']))>0){
                echo "<td>QTY Bulk (Petfood 4)  </td><td>".$nb[0]['element_379']."</td>";
            }
        }
    echo "</tr>"; 
    
    
    if($nb[0]['element_372_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_377']))>0){
                echo "<td>QTY Pallets (Petfood 4) </td><td>".$nb[0]['element_377']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_378']))>0){
                 echo "<td>Total Pallet Weight (Petfood 4)</td><td>".$nb[0]['element_378']."</td>";
            }
        echo "</tr>"; 
    }
    
     echo "<tr>";
        if($nb[0]['element_372_4']==1){
            if(strlen(trim($nb[0]['element_364']))>0){
                echo "<td>QTY Other (Petfood 4)</td><td>".$nb[0]['element_380']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";//red blue
        if($nb[0]['element_356_5'] ==1){
            if( strlen(trim($nb[0]['element_621'])  ) >0  ){
                echo "<td>".$nb[0]['element_621']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_614'])  ) >0  ){
                echo "<td>".$nb[0]['element_614']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_372_6'] ==1){
            if( strlen(trim($nb[0]['element_624'])  ) >0  ){
                echo "<td>".$nb[0]['element_624']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_626'])  ) >0  ){
                echo "<td>".$nb[0]['element_626']."</td>";
            }
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_365']))>0  ){
            echo "<td>Product Weight Total (Petfood 4)</td><td>".$nb[0]['element_365']."</td>";
        }
        if  (strlen(trim($nb[0]['element_366']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 4) </td><td>".$nb[0]['element_366']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_367']))>0  ){
            echo "<td>Net Product Weight (Petfood 4)</td><td>".$nb[0]['element_367']."</td>";
        }
        if  (strlen(trim($nb[0]['element_368']))>0  ){
            echo "<td>Product Ext Cost (Petfood 4) </td><td>".$nb[0]['element_368']."</td>";
        }
    echo "</tr>";
    
     if(strlen(trim($nb[0]['element_659']))>0 && $nb[0]['element_659'] !=0){
        echo "<td>Product PPT (Petfood 4) </td><td>".$nb[0]['element_659']."</td>";
    }
}

//product ventura 4
if(strlen(trim($nb[0]['element_511']))>0 && $nb[0]['element_511'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 4</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 4) </td><td>".ventura_products($nb[0]['element_511'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_512']))>0){
            echo "<td>Product (Ventura 4) Other  </td><td>".$nb[0]['element_512']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_498']))>0){
            echo "<td>Units per Case (Ventura 4)  </td><td>".$nb[0]['element_498']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_499']))>0){
            echo "<td>QTY of Cases (Ventura 4) </td><td>".$nb[0]['element_499']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_500']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 4)</td><td>".$nb[0]['element_500']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_496_1']==1){            
            echo "<td>Skids (Ventura 4)</td><td>".$nb[0]['element_501']."</td>";            
        }
        if($nb[0]['element_496_3']==1){            
            if(strlen(trim($nb[0]['element_504']))>0){
                echo "<td>QTY Bulk (Ventura 4)  </td><td>".$nb[0]['element_504']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_496_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_502']))>0){
                echo "<td>QTY Pallets (Ventura 4) </td><td>".$nb[0]['element_502']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_503']))>0){
                 echo "<td>Total Pallet Weight (Ventura 4)</td><td>".$nb[0]['element_503']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_496_4']==1){
            if(strlen(trim($nb[0]['element_505']))>0){
                echo "<td>QTY Other (Ventura 4)</td><td>".$nb[0]['element_505']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_506']))>0  ){
            echo "<td>Product Weight Total (Ventura 4)</td><td>".$nb[0]['element_506']."</td>";
        }
        if  (strlen(trim($nb[0]['element_507']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 4) </td><td>".$nb[0]['element_507']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_508']))>0  ){
            echo "<td>Net Product Weight (Ventura 4)</td><td>".$nb[0]['element_508']."</td>";
        }
        if  (strlen(trim($nb[0]['element_509']))>0  ){
            echo "<td>Product Ext Cost (Ventura 4) </td><td>".$nb[0]['element_509']."</td>";
        }
    echo "</tr>";
}



if(strlen(trim($nb[0]['element_386']))>0 && $nb[0]['element_386'] !=0){//Petfood 5
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 5</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_386'])."</td>"; 
        if(strlen(trim($nb[0]['element_387']))>0){
            echo "<td>Product (Petfood 5) Other </td><td>".$nb[0]['element_387']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_390']))>0){
            echo "<td>Units per Case (Petfood 5)  </td><td>".$nb[0]['element_390']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_454']))>0){
            echo "<td>QTY of Cases (Petfood 5) </td><td>".$nb[0]['element_454']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_391']))>0  ){
        echo "<tr><td>QTY Units of Product (Petfood 5)</td><td>".$nb[0]['element_391']."</td></tr>";
    }
    
    
    echo "<tr>";
        if($nb[0]['element_388_1']==1){
            if(strlen(trim($nb[0]['element_393']))>0){
                echo "<td>Skids</td><td>".$nb[0]['element_393']."</td>";  
            }  
        }
        if($nb[0]['element_388_3']==1){            
            if(strlen(trim($nb[0]['element_410']))>0){
                echo "<td>QTY Bulk (Petfood 5)  </td><td>".$nb[0]['element_410']."</td>";
            }
        }
    echo "</tr>"; 
    
    
    if($nb[0]['element_372_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_394']))>0){
                echo "<td>QTY Pallets (Petfood 5) </td><td>".$nb[0]['element_394']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_395']))>0){
                 echo "<td>Total Pallet Weight (Petfood 5)</td><td>".$nb[0]['element_395']."</td>";
            }
        echo "</tr>"; 
    }
    
     echo "<tr>";
        if($nb[0]['element_388_4']==1){
            if(strlen(trim($nb[0]['element_411']))>0){
                echo "<td>QTY Other (Petfood 5)</td><td>".$nb[0]['element_411']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";//red blue
        if($nb[0]['element_388_5'] ==1){
            if( strlen(trim($nb[0]['element_629'])  ) >0  ){
                echo "<td>".$nb[0]['element_629']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_614'])  ) >0  ){
                echo "<td>".$nb[0]['element_614']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_388_6'] ==1){
            if( strlen(trim($nb[0]['element_628'])  ) >0  ){
                echo "<td>".$nb[0]['element_628']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_630'])  ) >0  ){
                echo "<td>".$nb[0]['element_630']."</td>";
            }
        }
    echo "</tr>"; 
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_412']))>0  ){
            echo "<td>Product Weight Total (Petfood 5)</td><td>".$nb[0]['element_412']."</td>";
        }
        if  (strlen(trim($nb[0]['element_396']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 5) </td><td>".$nb[0]['element_396']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_397']))>0  ){
            echo "<td>Net Product Weight (Petfood 5)</td><td>".$nb[0]['element_397']."</td>";
        }
        if  (strlen(trim($nb[0]['element_398']))>0  ){
            echo "<td>Product Ext Cost (Petfood 5) </td><td>".$nb[0]['element_398']."</td>";
        }
    echo "</tr>";
    
     if(strlen(trim($nb[0]['element_660']))>0 && $nb[0]['element_660'] !=0){
        echo "<td>Product PPT (Petfood 5) </td><td>".$nb[0]['element_660']."</td>";
    }
}


//product ventura 5
if(strlen(trim($nb[0]['element_528']))>0  && $nb[0]['element_528'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 5</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 5) </td><td>".product_translate($nb[0]['element_528'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_529']))>0){
            echo "<td>Product (Ventura 5) Other  </td><td>".$nb[0]['element_529']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_532']))>0){
            echo "<td>Units per Case (Ventura 5)  </td><td>".$nb[0]['element_532']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_533']))>0){
            echo "<td>QTY of Cases (Ventura 5) </td><td>".$nb[0]['element_533']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_534']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 5)</td><td>".$nb[0]['element_534']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_530_1']==1){            
            echo "<td>Skids (Ventura 5)</td><td>".$nb[0]['element_535']."</td>";            
        }
        if($nb[0]['element_530_3']==1){            
            if(strlen(trim($nb[0]['element_538']))>0){
                echo "<td>QTY Bulk (Ventura 5)  </td><td>".$nb[0]['element_538']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_530_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_536']))>0){
                echo "<td>QTY Pallets (Ventura 5) </td><td>".$nb[0]['element_536']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_537']))>0){
                 echo "<td>Total Pallet Weight (Ventura 5)</td><td>".$nb[0]['element_537']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_530_4']==1){
            if(strlen(trim($nb[0]['element_539']))>0){
                echo "<td>QTY Other (Ventura 5)</td><td>".$nb[0]['element_539']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_540']))>0  ){
            echo "<td>Product Weight Total (Ventura 5)</td><td>".$nb[0]['element_540']."</td>";
        }
        if  (strlen(trim($nb[0]['element_541']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 5) </td><td>".$nb[0]['element_541']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_542']))>0  ){
            echo "<td>Net Product Weight (Ventura 5)</td><td>".$nb[0]['element_542']."</td>";
        }
        if  (strlen(trim($nb[0]['element_543']))>0  ){
            echo "<td>Product Ext Cost (Ventura 5) </td><td>".$nb[0]['element_543']."</td>";
        }
    echo "</tr>";
}

if(strlen(trim($nb[0]['element_400']))>0 && $nb[0]['element_400'] !=0){//Petfood 6
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 6</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_400'])."</td>"; 
        if(strlen(trim($nb[0]['element_401']))>0){
            echo "<td>Product (Petfood 6) Other </td><td>".$nb[0]['element_401']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_404']))>0){
            echo "<td>Units per Case (Petfood 6)  </td><td>".$nb[0]['element_404']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_453']))>0){
            echo "<td>QTY of Cases (Petfood 6) </td><td>".$nb[0]['element_453']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_405']))>0  ){
        echo "<tr><td>QTY Units of Product (Petfood 6)</td><td>".$nb[0]['element_405']."</td></tr>";
    }
    
    
    echo "<tr>";
        if($nb[0]['element_402_1']==1){
            if(strlen(trim($nb[0]['element_407']))>0){
                echo "<td>Skids</td><td>".$nb[0]['element_407']."</td>";  
            }  
        }
        if($nb[0]['element_402_3']==1){            
            if(strlen(trim($nb[0]['element_413']))>0){
                echo "<td>QTY Bulk (Petfood 6)  </td><td>".$nb[0]['element_413']."</td>";
            }
        }
    echo "</tr>"; 
    
    
    if($nb[0]['element_402_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_408']))>0){
                echo "<td>QTY Pallets (Petfood 6) </td><td>".$nb[0]['element_408']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_409']))>0){
                 echo "<td>Total Pallet Weight (Petfood 6)</td><td>".$nb[0]['element_409']."</td>";
            }
        echo "</tr>"; 
    }
    
     echo "<tr>";
        if($nb[0]['element_402_4']==1){
            if(strlen(trim($nb[0]['element_414']))>0){
                echo "<td>QTY Other (Petfood 6)</td><td>".$nb[0]['element_414']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";//red blue
        if($nb[0]['element_402_5'] ==1){
            if( strlen(trim($nb[0]['element_633'])  ) >0  ){
                echo "<td>".$nb[0]['element_633']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_635'])  ) >0  ){
                echo "<td>".$nb[0]['element_635']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_402_6'] ==1){
            if( strlen(trim($nb[0]['element_628'])  ) >0  ){
                echo "<td>".$nb[0]['element_628']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_630'])  ) >0  ){
                echo "<td>".$nb[0]['element_630']."</td>";
            }
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_415']))>0  ){
            echo "<td>Product Weight Total (Petfood 6)</td><td>".$nb[0]['element_415']."</td>";
        }
        if  (strlen(trim($nb[0]['element_416']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 6) </td><td>".$nb[0]['element_416']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_417']))>0  ){
            echo "<td>Net Product Weight (Petfood 6)</td><td>".$nb[0]['element_417']."</td>";
        }
        if  (strlen(trim($nb[0]['element_418']))>0  ){
            echo "<td>Product Ext Cost (Petfood 6) </td><td>".$nb[0]['element_418']."</td>";
        }
    echo "</tr>";
    
     if(strlen(trim($nb[0]['element_418']))>0 && $nb[0]['element_418'] !=0){
        echo "<td>Product PPT (Petfood 6) </td><td>".$nb[0]['element_418']."</td>";
    }
}

//product ventura 6
if(strlen(trim($nb[0]['element_545']))>0  && $nb[0]['element_545'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 6</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 6) </td><td>".ventura_products($nb[0]['element_545'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_546']))>0){
            echo "<td>Product (Ventura 6) Other  </td><td>".$nb[0]['element_546']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_549']))>0){
            echo "<td>Units per Case (Ventura 6)  </td><td>".$nb[0]['element_549']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_550']))>0){
            echo "<td>QTY of Cases (Ventura 6) </td><td>".$nb[0]['element_550']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_551']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 6)</td><td>".$nb[0]['element_551']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_547_1']==1){            
            echo "<td>Skids (Ventura 6)</td><td>".$nb[0]['element_552']."</td>";            
        }
        if($nb[0]['element_547_3']==1){            
            if(strlen(trim($nb[0]['element_555']))>0){
                echo "<td>QTY Bulk (Ventura 6)  </td><td>".$nb[0]['element_555']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_530_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_536']))>0){
                echo "<td>QTY Pallets (Ventura 6) </td><td>".$nb[0]['element_536']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_537']))>0){
                 echo "<td>Total Pallet Weight (Ventura 6)</td><td>".$nb[0]['element_537']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_530_4']==1){
            if(strlen(trim($nb[0]['element_556']))>0){
                echo "<td>QTY Other (Ventura 6)</td><td>".$nb[0]['element_556']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_557']))>0  ){
            echo "<td>Product Weight Total (Ventura 6)</td><td>".$nb[0]['element_557']."</td>";
        }
        if  (strlen(trim($nb[0]['element_558']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 6) </td><td>".$nb[0]['element_558']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_559']))>0  ){
            echo "<td>Net Product Weight (Ventura 6)</td><td>".$nb[0]['element_559']."</td>";
        }
        if  (strlen(trim($nb[0]['element_560']))>0  ){
            echo "<td>Product Ext Cost (Ventura 6) </td><td>".$nb[0]['element_560']."</td>";
        }
    echo "</tr>";
}


if(strlen(trim($nb[0]['element_420']))>0 && $nb[0]['element_420'] !=0){//Petfood 7
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 7</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_420'])."</td>"; 
        if(strlen(trim($nb[0]['element_421']))>0){
            echo "<td>Product (Petfood 7) Other </td><td>".$nb[0]['element_421']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_424']))>0){
            echo "<td>Units per Case (Petfood 7)  </td><td>".$nb[0]['element_424']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_425']))>0){
            echo "<td>QTY of Cases (Petfood 7) </td><td>".$nb[0]['element_425']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_405']))>0  ){
        echo "<tr><td>QTY Units of Product (Petfood 7)</td><td>".$nb[0]['element_405']."</td></tr>";
    }
    
    
    echo "<tr>";
        if($nb[0]['element_422_1']==1){
            if(strlen(trim($nb[0]['element_427']))>0){
                echo "<td>Skids</td><td>".$nb[0]['element_427']."</td>";  
            }  
        }
        if($nb[0]['element_422_3']==1){            
            if(strlen(trim($nb[0]['element_430']))>0){
                echo "<td>QTY Bulk (Petfood 7)  </td><td>".$nb[0]['element_430']."</td>";
            }
        }
    echo "</tr>"; 
    
    
    if($nb[0]['element_422_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_428']))>0){
                echo "<td>QTY Pallets (Petfood 7) </td><td>".$nb[0]['element_428']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_429']))>0){
                 echo "<td>Total Pallet Weight (Petfood 7)</td><td>".$nb[0]['element_429']."</td>";
            }
        echo "</tr>"; 
    }
    
     echo "<tr>";
        if($nb[0]['element_422_4']==1){
            if(strlen(trim($nb[0]['element_431']))>0){
                echo "<td>QTY Other (Petfood 7)</td><td>".$nb[0]['element_431']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";//red blue
        if($nb[0]['element_422_5'] ==1){
            if( strlen(trim($nb[0]['element_637'])  ) >0  ){
                echo "<td>".$nb[0]['element_637']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_639'])  ) >0  ){
                echo "<td>".$nb[0]['element_639']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_422_6'] ==1){
            if( strlen(trim($nb[0]['element_636'])  ) >0  ){
                echo "<td>".$nb[0]['element_636']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_638'])  ) >0  ){
                echo "<td>".$nb[0]['element_638']."</td>";
            }
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_415']))>0  ){
            echo "<td>Product Weight Total (Petfood 7)</td><td>".$nb[0]['element_415']."</td>";
        }
        if  (strlen(trim($nb[0]['element_416']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 7) </td><td>".$nb[0]['element_416']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_432']))>0  ){
            echo "<td>Net Product Weight (Petfood 7)</td><td>".$nb[0]['element_432']."</td>";
        }
        if  (strlen(trim($nb[0]['element_433']))>0  ){
            echo "<td>Product Ext Cost (Petfood 7) </td><td>".$nb[0]['element_433']."</td>";
        }
    echo "</tr>";
    
     if(strlen(trim($nb[0]['element_661']))>0 && $nb[0]['element_661'] !=0){
        echo "<td>Product PPT (Petfood 7) </td><td>".$nb[0]['element_661']."</td>";
    }
}

//product ventura 7
if(strlen(trim($nb[0]['element_562']))>0  && $nb[0]['element_562'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 7</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 7) </td><td>".ventura_products($nb[0]['element_562'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_563']))>0){
            echo "<td>Product (Ventura 7) Other  </td><td>".$nb[0]['element_563']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_566']))>0){
            echo "<td>Units per Case (Ventura 7)  </td><td>".$nb[0]['element_566']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_567']))>0){
            echo "<td>QTY of Cases (Ventura 7) </td><td>".$nb[0]['element_567']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_568']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 7)</td><td>".$nb[0]['element_568']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_564_1']==1){            
            echo "<td>Skids (Ventura 7)</td><td>".$nb[0]['element_569']."</td>";            
        }
        if($nb[0]['element_564_3']==1){            
            if(strlen(trim($nb[0]['element_572']))>0){
                echo "<td>QTY Bulk (Ventura 7)  </td><td>".$nb[0]['element_572']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_564_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_570']))>0){
                echo "<td>QTY Pallets (Ventura 7) </td><td>".$nb[0]['element_570']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_571']))>0){
                 echo "<td>Total Pallet Weight (Ventura 7)</td><td>".$nb[0]['element_571']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_564_4']==1){
            if(strlen(trim($nb[0]['element_573']))>0){
                echo "<td>QTY Other (Ventura 7)</td><td>".$nb[0]['element_573']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_574']))>0  ){
            echo "<td>Product Weight Total (Ventura 7)</td><td>".$nb[0]['element_574']."</td>";
        }
        if  (strlen(trim($nb[0]['element_575']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 7) </td><td>".$nb[0]['element_575']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_576']))>0  ){
            echo "<td>Net Product Weight (Ventura 7)</td><td>".$nb[0]['element_576']."</td>";
        }
        if  (strlen(trim($nb[0]['element_577']))>0  ){
            echo "<td>Product Ext Cost (Ventura 7) </td><td>".$nb[0]['element_577']."</td>";
        }
    echo "</tr>";
}

if(strlen(trim($nb[0]['element_437']))>0 && $nb[0]['element_437'] !=0){//Petfood 8
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Petfood 8</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product</td><td>".product_translate($nb[0]['element_437'])."</td>"; 
        if(strlen(trim($nb[0]['element_440']))>0){
            echo "<td>Product (Petfood 8) Other </td><td>".$nb[0]['element_440']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_441']))>0){
            echo "<td>Units per Case (Petfood 8)  </td><td>".$nb[0]['element_441']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_425']))>0){
            echo "<td>QTY of Cases (Petfood 8) </td><td>".$nb[0]['element_425']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_443']))>0  ){
        echo "<tr><td>QTY Units of Product (Petfood 8)</td><td>".$nb[0]['element_443']."</td></tr>";
    }
    
    
    echo "<tr>";
        if($nb[0]['element_439_1']==1){
            if(strlen(trim($nb[0]['element_444']))>0){
                echo "<td>Skids</td><td>".$nb[0]['element_444']."</td>";  
            }  
        }
        if($nb[0]['element_439_3']==1){            
            if(strlen(trim($nb[0]['element_447']))>0){
                echo "<td>QTY Bulk (Petfood 8)  </td><td>".$nb[0]['element_447']."</td>";
            }
        }
    echo "</tr>"; 
    
    
    if($nb[0]['element_439_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_445']))>0){
                echo "<td>QTY Pallets (Petfood 8) </td><td>".$nb[0]['element_445']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_446']))>0){
                 echo "<td>Total Pallet Weight (Petfood 8)</td><td>".$nb[0]['element_446']."</td>";
            }
        echo "</tr>"; 
    }
    
     echo "<tr>";
        if($nb[0]['element_439_4']==1){
            if(strlen(trim($nb[0]['element_448']))>0){
                echo "<td>QTY Other (Petfood 8)</td><td>".$nb[0]['element_448']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";//red blue
        if($nb[0]['element_439_5'] ==1){
            if( strlen(trim($nb[0]['element_641'])  ) >0  ){
                echo "<td>".$nb[0]['element_641']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_643'])  ) >0  ){
                echo "<td>".$nb[0]['element_643']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>"; // brown
        if($nb[0]['element_439_6'] ==1){
            if( strlen(trim($nb[0]['element_640'])  ) >0  ){
                echo "<td>".$nb[0]['element_640']."</td>";
            }
            
            if( strlen(trim($nb[0]['element_642'])  ) >0  ){
                echo "<td>".$nb[0]['element_642']."</td>";
            }
        }
    echo "</tr>";
    
    
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_449']))>0  ){
            echo "<td>Product Weight Total (Petfood 8)</td><td>".$nb[0]['element_449']."</td>";
        }
        if  (strlen(trim($nb[0]['element_450']))>0  ){
            echo "<td>Applied Product Shrink (Petfood 8) </td><td>".$nb[0]['element_450']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_451']))>0  ){
            echo "<td>Net Product Weight (Petfood 8)</td><td>".$nb[0]['element_451']."</td>";
        }
        if  (strlen(trim($nb[0]['element_452']))>0  ){
            echo "<td>Product Ext Cost (Petfood 8) </td><td>".$nb[0]['element_452']."</td>";
        }
    echo "</tr>";
    
     if(strlen(trim($nb[0]['element_662']))>0 && $nb[0]['element_662'] !=0){
        echo "<td>Product PPT (Petfood 8) </td><td>".$nb[0]['element_662']."</td>";
    }
}

//product ventura 8
if(strlen(trim($nb[0]['element_579']))>0   && $nb[0]['element_579'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 8</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 8) </td><td>".ventura_products($nb[0]['element_579'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_597']))>0){
            echo "<td>Product (Ventura 8) Other  </td><td>".$nb[0]['element_597']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_600']))>0){
            echo "<td>Units per Case (Ventura 8)  </td><td>".$nb[0]['element_600']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_601']))>0){
            echo "<td>QTY of Cases (Ventura 8) </td><td>".$nb[0]['element_601']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_602']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 8)</td><td>".$nb[0]['element_602']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_581_1']==1){            
            echo "<td>Skids (Ventura 8)</td><td>".$nb[0]['element_586']."</td>";            
        }
        if($nb[0]['element_581_3']==1){            
            if(strlen(trim($nb[0]['element_589']))>0){
                echo "<td>QTY Bulk (Ventura 8)  </td><td>".$nb[0]['element_589']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_581_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_587']))>0){
                echo "<td>QTY Pallets (Ventura 8) </td><td>".$nb[0]['element_587']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_588']))>0){
                 echo "<td>Total Pallet Weight (Ventura 8)</td><td>".$nb[0]['element_588']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_581_4']==1){
            if(strlen(trim($nb[0]['element_590']))>0){
                echo "<td>QTY Other (Ventura 8)</td><td>".$nb[0]['element_590']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_591']))>0  ){
            echo "<td>Product Weight Total (Ventura 8)</td><td>".$nb[0]['element_591']."</td>";
        }
        if  (strlen(trim($nb[0]['element_592']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 8) </td><td>".$nb[0]['element_592']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_593']))>0  ){
            echo "<td>Net Product Weight (Ventura 8)</td><td>".$nb[0]['element_593']."</td>";
        }
        if  (strlen(trim($nb[0]['element_594']))>0  ){
            echo "<td>Product Ext Cost (Ventura 8) </td><td>".$nb[0]['element_594']."</td>";
        }
    echo "</tr>";
}



//product ventura 9
if(strlen(trim($nb[0]['element_596']))>0  && $nb[0]['element_596'] !=0){
    echo '<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Ventura 9</h1></td></tr>';
    echo "<tr>"; 
        echo "<td>Product (Ventura 9) </td><td>".ventura_products($nb[0]['element_596'])."</td>"; 
        
        if(strlen(trim($nb[0]['element_580']))>0){
            echo "<td>Product (Ventura 9) Other  </td><td>".$nb[0]['element_580']."</td>";
        }
    echo "</tr>";
    
    
    echo "<tr>";
        if(strlen(trim($nb[0]['element_580']))>0){
            echo "<td>Units per Case (Ventura 9)  </td><td>".$nb[0]['element_580']."</td>";
        }
        
        if(strlen(trim($nb[0]['element_584']))>0){
            echo "<td>QTY of Cases (Ventura 9) </td><td>".$nb[0]['element_584']."</td>";
        }
    echo "</tr>";
    
    if(strlen(trim($nb[0]['element_585']))>0  ){
        echo "<tr><td>QTY Units of Product (Ventura 9)</td><td>".$nb[0]['element_585']."</td></tr>";
    }
    
    echo "<tr>";
        if($nb[0]['element_598_1']==1){            
            echo "<td>Skids (Ventura 9)</td><td>".$nb[0]['element_603']."</td>";            
        }
        if($nb[0]['element_598_3']==1){            
            if(strlen(trim($nb[0]['element_606']))>0){
                echo "<td>QTY Bulk (Ventura 9)  </td><td>".$nb[0]['element_606']."</td>";
            }
        }
    echo "</tr>";
    
    if($nb[0]['element_598_2']==1){
        echo "<tr>";
            if(strlen(trim($nb[0]['element_604']))>0){
                echo "<td>QTY Pallets (Ventura 9) </td><td>".$nb[0]['element_604']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_605']))>0){
                 echo "<td>Total Pallet Weight (Ventura 9)</td><td>".$nb[0]['element_605']."</td>";
            }
        echo "</tr>"; 
    }
    
    echo "<tr>";
        if($nb[0]['element_598_4']==1){
            if(strlen(trim($nb[0]['element_607']))>0){
                echo "<td>QTY Other (Ventura 9)</td><td>".$nb[0]['element_607']."</td>";
            }
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_608']))>0  ){
            echo "<td>Product Weight Total (Ventura 9)</td><td>".$nb[0]['element_608']."</td>";
        }
        if  (strlen(trim($nb[0]['element_609']))>0  ){
            echo "<td>Applied Product Shrink (Ventura 9) </td><td>".$nb[0]['element_609']."</td>";
        }
    echo "</tr>";
    
    echo "<tr>";
        if  (strlen(trim($nb[0]['element_610']))>0  ){
            echo "<td>Net Product Weight (Ventura 9)</td><td>".$nb[0]['element_610']."</td>";
        }
        if  (strlen(trim($nb[0]['element_611']))>0  ){
            echo "<td>Product Ext Cost (Ventura 9) </td><td>".$nb[0]['element_611']."</td>";
        }
    echo "</tr>";
}
?>
<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Pallet/Skids</h1></td></tr>

<tr>
     <?php if(strlen(trim($nb[0]['element_138']))>0){ ?>
    <td style="text-align:left;vertical-align:top;">Number of Total Pallets/Skids</td>
    <td style="text-align:left;vertical-align:top;"><?php echo $nb[0]['element_138']; ?></td>
    <?php } ?>
    
    <?php if(strlen(trim($nb[0]['element_139']))>0){ ?>
    <td  style="text-align:left;vertical-align:top;">
        Total Weight Shrink per Pallets/Skids 
    </td>
    <td style="text-align:left;vertical-align:top;"><?php echo $nb[0]['element_139']; ?></td>
    <?php } ?>
    
</tr>



<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
<tr><td colspan="4"><h1 style="color: black;text-indent:0px;width:100%;">Product Shrink</h1></td></tr>


<?php if(strlen(trim($nb[0]['element_141']))>0){ ?>
<tr><td  colspan="2">Total Trash per Product Container </td><td  colspan="2"><?php echo $nb[0]['element_141']; ?></td></tr>
<?php } ?>

<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>



<tr><td colspan="4"><h1  style="color: black;text-indent:0px;width:100%;">Total Weights for Trailer</h1></td></tr>


        <tr>
            <?php if(strlen(trim($nb[0]['element_178']))>0){ ?>
            <td>Total Load Weight</td>
            <td><?php echo $nb[0]['element_178']; ?></td>
            <?php } ?> 
            
            <?php if(strlen(trim($nb[0]['element_143']))>0){ ?>
            <td>Total Shrink </td>
            <td><?php echo $nb[0]['element_143']; ?></td>
            <?php } ?>
        </tr>
        
            
            
<?php if(strlen(trim($nb[0]['element_144']))>0){ ?>            
<tr><td colspan="2">Product Net </td><td><?php echo $nb[0]['element_144']; ?></td></tr>
<?php } ?>

<tr><td colspan="4"><h1  style="color: black;text-indent:0px;width:100%;margin-bottom:-50px;">Excluded Product Detail</h1><br /><h3>(Sum totals for product outside of contractual obligations)</h3></td></tr>


<tr>
    <?php if(strlen(trim($nb[0]['element_181']))>0){ ?>
    <td>Excluded Product Weight </td>
    <td><?php echo $nb[0]['element_181'] ?></td>
    <?php } ?>
    
    <?php if(strlen(trim($nb[0]['element_182']))>0){ ?>
    <td>Excluded Product Container/Shrink </td>
    <td><?php echo $nb[0]['element_182'] ?></td>
    <?php } ?>
</tr>
<tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
<tr><td colspan="4"><h1   style="color: black;text-indent:0px;width:100%;">Contractual Weight Breakdown</h1></td></tr>


<tr>
    <?php if(strlen(trim($nb[0]['element_184']))>0){ ?>
    <td>Load Net Product Weight </td>
    <td><?php echo $nb[0]['element_184'] ?></td>
    <?php } ?>
    
    <?php if(strlen(trim($nb[0]['element_185']))>0){ ?>
    <td>Load Total Shrink (Including Pallets and Excluded Product Weights) </td>
    <td><?php echo $nb[0]['element_185'] ?></td>
    <?php } ?>
</tr>


<tr>
    <?php if(strlen(trim($nb[0]['element_186']))>0){ ?>
    <td>Load Gross Weight Total (Calculated) </td>
    <td><?php echo $nb[0]['element_186'] ?></td>
    <?php } ?>
    
    <?php if(strlen(trim($nb[0]['element_189']))>0){ ?>
    <td>Scale Net Weight </td>
    <td><?php echo $nb[0]['element_189'] ?></td>
    <?php } ?>
</tr>


    
    
  

<tr>
    <?php if(strlen(trim($nb[0]['element_187']))>0){ ?>
    <td>Difference From Scale </td>
    <td><?php echo $nb[0]['element_187'] ?></td>  
    <?php } ?>
    
    <?php 
if(strlen(trim($nb[0]['element_188']))>0){
    ?>
    <td>Contingency  </td><td><?php echo $nb[0]['element_188'] ?></td><?php } ?></tr>
<?php 
if(strlen(trim($nb[0]['element_130']))>0){
    ?>
    <tr><td>Extra Cost for Trailer</td><td><?php echo $nb[0]['element_130']; ?></td></tr>
    <?php
}

?>

<?php 
    if( $nb[0]['element_146_1'] ==1 ){
    ?>
    <tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
    
    <tr><td colspan="4"><h1  style="color: black;text-indent:0px;width:100%;">Approval Information</h1></td></tr>
    
    
    <tr>
        <?php if(strlen(trim($nb[0]['element_310']))>0){ ?>
        <td>Calc Jac PPT </td>
        <td><?php echo $nb[0]['element_310'] ?></td>
        <?php } ?>
        <?php if(strlen(trim($nb[0]['element_311']))>0){ ?>
        <td>Light Load DIscount (If in effect) </td>
        <td><?php echo $nb[0]['element_311'] ?></td>
        <?php } ?>
    </tr>
    
    
    <tr>
        <?php if(strlen(trim($nb[0]['element_314']))>0){ ?>
        <td>Water % </td>
        <td ><?php echo $nb[0]['element_314'] ?></td>
        <?php } ?>
        <?php if(strlen(trim($nb[0]['element_313']))>0){ ?>
        <td>Foreign Substance % </td>
        <td><?php echo $nb[0]['element_313']; ?></td>
        <?php } ?>
    </tr>
    
    <?php 
    if(strlen(trim($nb[0]['element_312']))>0){
    ?>
    <tr><td colspan="2">ADDTL freight/handling/disposal fee per ton (70) </td><td colspan="2"><?php echo $nb[0]['element_312'] ?></td></tr>
    <?php 
    }
    ?>
    
    <tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
    <tr><td colspan="4"><h1  style="color: black;text-indent:0px;width:100%;">Final Price</h1></td></tr>
    
    
    <tr>
        <?php 
        if(strlen(trim($nb[0]['element_317']))>0){
        ?>
        <td>PPT Adjustment</td><td><?php echo $nb[0]['element_317']; ?></td>
        <?php } ?>
        <?php 
        if(strlen(trim($nb[0]['element_316']))>0){
        ?>
        <td>Additional flat fee/adjustment </td><td><?php echo $nb[0]['element_316'] ?></td>
        <?php } ?>
    </tr>
    
    <tr>
        <?php
            if(strlen(trim($nb[0]['element_318']))>0){
                echo "<td>Additional flat fee/adjustment </td><td>".$nb[0]['element_318']."</td>";
            }
            
            if(strlen(trim($nb[0]['element_316']))>0){
                echo "<td>Load Calculated Price per Ton </td><td>".$nb[0]['element_316']."</td>";
            }
        ?>
    </tr>
    
    <tr>
        <?php
            if($nb[0]['element_155_1'] == 1){
                echo "<td>Calculate Payment/Shrink</td>";
            }
            
            if($nb[0]['element_155_2'] == 1){
                echo "<td>Re-Calculate Payment/Shrink</td>";
            }
            
            if(isset($nb[0]['element_146_1'])){
                echo "<td>Approved</td>";
            }
        ?>
    </tr>
    
    <?php 
    if(strlen(trim($nb[0]['element_316']))>0){
    ?>
    <tr><td colspan="2">Load Calculated Price per Ton </td><td colspan="2"><?php echo $nb[0]['element_316']; ?></td></tr>    
    <?php } ?>
    <tr><td style="height: 10px;border-bottom:1px solid #bbb;text-align:center;vertical-align:bottom;" colspan="4">&nbsp;</td></tr>
    <?php  
    }
    
    
    if(strlen(trim($nb[0]['element_644']))>0){
        ?>
        <tr><td></td></tr>
        <?php
    }
    ?>
    
    <tr><td colspan="2">Technician Note</td><td colspan="2"><?php echo $nb[0]['element_644']; ?></td></tr>
    
</table>
</div>
</body>