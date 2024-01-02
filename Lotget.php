<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
ini_set("display_errors",1);
$lot = $db->query("SELECT * FROM Inetforms.ap_form_43939 WHERE id = $_GET[Req_ID]");


echo "SELECT * FROM Inetforms.ap_form_47591 WHERE me = ".$lot[0]['element_31'];
$bio_week_sched = $db->query("SELECT * FROM Inetforms.ap_form_47591 WHERE me =  ".$lot[0]['element_31']);
if(count($bio_week_sched)>0){
    
    switch($bio_week_sched[0]['element_3']){
        case 4: $prod ="B100"; break;
        case 5: $prod ="B99.9"; break;
        case 6: $prod ="B80"; break;
        case 7: $prod ="B20"; break;
        case 8: $prod ="GNAC"; break;
        case 9: $prod ="FFA"; break;
        case 10: $prod ="GNAC/Methanol"; break;
    }
    
}else {
    $prod = "";
}


$time_date = explode(" ",$lot[0]['date_created']);


$date = new DateTime($time_date[0]);



$html = "<table style='width:800px;margin:auto;border:1px solid black;padding:5px 5px 5px 5px;'>";
$html .= "<tr><td style='text-align:right;' colspan='4'></td></tr>";
$html .= "<tr><td style='text-align:right;' colspan='4'></td></tr>";
$html .= "<tr><td style='text-align:left;'>Imperial Western Products</td><td style='text-align:right;'><img src='https://inet.iwpusa.com/img/BQ-9000-Producer.png' style='width:30%;'/></td><td></td><td><img src='https://inet.iwpusa.com/img/BQ-9000-Producer.png' style='width:40%;'/></td></tr>";
$html .= "<tr><td style='text-align:center;' colspan='4'>86-600 Avenue 54</td></tr>";
$html .= "<tr><td style='text-align:left;' colspan='4'>Coachella, CA, 92236 <br/> 
                 760-398-0815 (Phone)<br/>
                 760-398-3515 (Fax)<br/>   </td></tr>";
$html .="<tr><td style='text-align:center;' colspan='4'><img src='https://inet.iwpusa.com/img/biofuels.jpeg'/><br/><h1>Certificate of Analysis</h1></td></tr>";    
$html .="<tr><td style='text-align:left;' colspan='4'>Date: ".$date->format('n-j-y')."<br/><b>Product:</b> $prod</td></tr>"; 
$html .="<tr><td style='text-align:left;width:25%;'>Production Lot No. ".$lot[0]['element_26']."</td><td style='text-align:left;width:25%;'>ME-".$lot[0]['element_31'].": ".$date->format('n-j-y')."</td><td style='text-align:left;width:25%;'></td><td>&nbsp;</td></tr>";
$html .="<tr>
            <td style='text-align:center;font-weight:bold;width:20%;'>Test Method</td>
            <td style='text-align:center;font-weight:bold;width:20%;'>Test</td>
            <td  style='text-align:center;font-weight:bold;width:20%;'>Unit</td><td style='text-align:center;font-weight:bold;width:20%;'>Specification</td><td style='text-align:center;font-weight:bold;width:20%;'>Result</td></tr>";

            $count = 0;

            if(strlen(trim($lot[0]['element_1']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Free Glycerin</td><td style='$bg;'>Mass %</td><td style='$bg;'>0.020 max</td><td style='$bg;'>".$lot[0]['element_1']."</td></tr>";
            }
            if(strlen(trim($lot[0]['element_2']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Total Glycerin</td><td style='$bg;'>Mass %</td><td style='$bg;'>0.240 max</td><td style='$bg;'>".$lot[0]['element_2']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_3']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Monoglycerides</td><td style='$bg;'>Mass %</td><td style='$bg;'>Report</td><td style='$bg;'>".$lot[0]['element_3']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_3']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Diglycerides</td><td style='$bg;'>Mass %</td><td style='$bg;'>Report</td><td style='$bg;'>".$lot[0]['element_3']."</td></tr>";
            }
            
            
            if(strlen(trim($lot[0]['element_5']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Triglycerides</td><td style='$bg;'>Mass %</td><td style='$bg;'>Report</td><td style='$bg;'>".$lot[0]['element_4']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_6']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Water and Sediment </td><td style='$bg;'>Volume %</td><td style='$bg;'>0.050 max</td><td style='$bg;'>".$lot[0]['element_6']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_7']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Cloud Point </td><td style='$bg;'>&#8451;C</td><td style='$bg;'>0.050 max</td><td style='$bg;'>".$lot[0]['element_7']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_8']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Acid Number </td><td style='$bg;'>mg KOH/g</td><td style='$bg;'>0.50 ma</td><td style='$bg;'>".$lot[0]['element_8']."</td></tr>";
            }
            
            
            if(strlen(trim($lot[0]['element_9']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Visual Appearance </td><td style='$bg;'>1-6</td><td style='$bg;'>2 max</td><td style='$bg;'>".$lot[0]['element_9']."</td></tr>";
            }
            
                
            
            if(strlen(trim($lot[0]['element_10']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Methanol Content</td><td style='$bg;'>Mass %</td><td style='$bg;'>2.0 max</td><td style='$bg;'>".$lot[0]['element_10']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_11']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Sulfur </td><td style='$bg;'>ppm</td><td style='$bg;'>15 max</td><td style='$bg;'>".$lot[0]['element_11']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_12']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Oxidative Stability </td><td style='$bg;'>Hours</td><td style='$bg;'>3.0 min</td><td style='$bg;'>".$lot[0]['element_12']."</td></tr>";
            }
            
            if(strlen(trim($lot[0]['element_13']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>KF Moisture </td><td style='$bg;'>ppm</td><td style='$bg;'>500 max</td><td style='$bg;'>".$lot[0]['element_13']."</td></tr>";
            }
            if(strlen(trim($lot[0]['element_14']))>0){
                $count++;
                if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
                $html .="<tr><td style='$bg;'>ASTM D 6751</td><td style='$bg;'>Cold Soak Filtration</td><td style='$bg;'>Seconds</td><td style='$bg;'>360 max</td><td style='$bg;'>".$lot[0]['element_14']."</td></tr>";
            }
            $count++;
            if($count%2==0){
                    $bg= "background:#BFBFBF";
                } else {
                    $bg = "background:#FFFFFF";
                }
            $html .="<tr><td style='$bg;'>ASTM D 93</td><td style='$bg;'>Flash Point</td><td style='$bg;'>&#8451;C</td><td style='$bg;'>130 min</td><td style='$bg;'>171</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>ASTM D 4530</td><td style='$bg;'>Carbon Residue</td><td style='$bg;'>Mass %</td><td style='$bg;'>0.050 max</td><td style='$bg;'>0.025</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>ASTM D 874</td><td style='$bg;'>Sulfated Ash</td><td style='$bg;'>Mass %C</td><td style='$bg;'>0.020 max</td><td style='$bg;'>0.008</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>ASTM D 445</td><td style='$bg;'>Kin. Viscosity</td><td style='$bg;'>mm 2 /sec.</td><td style='$bg;'>1.9-6.0</td><td style='$bg;'>4.6721</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>AASTM D 613</td><td style='$bg;'>Cetane</td><td style='$bg;'>&nbsp;</td><td style='$bg;'>130 min</td><td style='$bg;'>54.5</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>ASTM D 130</td><td style='$bg;'>Copper corrosion</td><td style='$bg;'></td><td style='$bg;'>No. 3 max</td><td style='$bg;'>1A</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>ASTM D 4951</td><td style='$bg;'>Phosphorous</td><td style='$bg;'>Mass %C</td><td style='$bg;'>0.001 max</td><td style='$bg;'>0.000019</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>AASTM D 1160</td><td style='$bg;'>Distillation, T90</td><td style='$bg;'>&#8451;C</td><td style='$bg;'>360 max</td><td style='$bg;'>355.5</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>EN 14538</td><td style='$bg;'>Na+K</td><td style='$bg;'>ppm</td><td style='$bg;'>5.0 max</td><td style='$bg;'>3.3</td></tr>";
            $count++;
            if($count%2==0){
                $bg= "background:#BFBFBF";
            } else {
                $bg = "background:#FFFFFF";
            }
            $html .="<tr><td style='$bg;'>EN 14538</td><td style='$bg;'>Ca+Mg</td><td style='$bg;'>ppm</td><td style='$bg;'>5.0 max</td><td style='$bg;'>0.8</td></tr>";
            
            
            $html .="<tr><td colspan='5'>footnote: <br/>
                <ol>
                    <li>ASTM and EN analyses are performed in accordance with the current revision.</li>
                    <li>Analyses marked with an asterisk are based on most recent 3rd party testing</li>
                    <li>B99.9 blends contain 0.1 % USLD CARB diesel.</li>
                </ol></td></tr>
                <tr><td colspan='3' style='text-align:left;'>Prepare By: <img src='https://inet.iwpusa.com/img/joe_sig.jpg' style='width:30%;height:30%;'> , Lab Manager</td><td colspan='3' style='text-align:left;'>Date: ".$date->format('n-j-y')."</td></tr>";
            $html .= "</table>";
           
             /*echo $html;*/ 
            $path = "coa/";
            $new_string = "$_GET[Req_ID]_Certificate_of_Analysis".date("Ydm").".pdf";
            $db->query("UPDATE Inetforms.ap_form_43939 SET analy_cert='$new_string' WHERE id = $_GET[Req_ID]");
            $pdf_options = array(
              "source_type" => 'html',
              "source" => $html,
              "action" => 'save',
              "save_directory" => $path,
              "page_orientation" => 'portrait',
              "file_name" => $new_string,
              "page_size" => 'letter'
            );
            phptopdf($pdf_options);           

?>   