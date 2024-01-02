<?php
ini_set("display_errors",0);
    date_default_timezone_set(@date_default_timezone_get());
    
    include "protected/global.php";
    $mode ="";
    if(isset($_GET['entry_id'])){//osr    
        echo "by osr entry id";
        $hy = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.id = $_GET[entry_id]");
        $mode = "osr";
        //print_r($hy);
    }else if(isset($_GET['truck'])){//tsl        
         $hy = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_76 = $_GET[truck] AND element_3 IN ('Completed','Pending') ORDER BY element_3,date_created DESC LIMIT 0,1");
         
         echo "by tcl truck id";
        $mode = "tsl";
        //echo $mode;
        print_r($hy);
    }else if (isset($_GET['tsl_truck'])){
        $tsl = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE id= $_GET[tsl_truck]");
        print_r($tsl);
    }
?>
<script type="text/javascript" src="js/jquery-1.11.1.js: echo "</script>

<?php 

header("p3p: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""); 
require("/var/www/html/machforms/machform/machform.php");

$mf_param['form_id'] = 44342;
$mf_param['base_path'] = 'https://inet.iwpusa.com/machforms/machform/';
$mf_param['show_border'] = true;
echo "<script>";
echo "</script>";
display_machform($mf_param);

?>
<script>
<?php
     if (isset($_GET['tsl_truck'])){
            switch($tsl[0]['element_1']){
                case 1://inbound
                ?>
                $("input#element_3").val("<?php echo "Pending"; ?>");//status
                $("input#element_76").val("<?php echo $tsl[0]['id'] ?>");//truck request number
                $("input#element_77").val("<?php echo $tsl[0]['element_19'] ?>");//weight ticket number
                $("input#element_82").val("<?php echo $tsl[0]['element_24'] ?>");//release sale #
                $("input#element_83").val("<?php echo $tsl[0]['element_116'] ?>");//Inbound WC
                $("input#element_84").val("<?php echo $tsl[0]['element_25']; ?>");//notes
                $("input#element_10").val("<?php
                        switch($tsl[0]['element_114']){
                            case 1: echo "Johnny"; break;
                            case 2: echo "Mario"; break;
                            case 3: echo "Other"; break;
                        }
                 ?>");
                $("input#element_85").val("<?php echo $_GET['er_id']; ?>");
                <?php
                break;
                case 9://pet food
                ?>
                $("input#element_3").val("<?php echo "Pending"; ?>");//status
                $("input#element_76").val("<?php echo $tsl[0]['id'] ?>");//truck request number
                $("input#element_77").val("<?php echo $tsl[0]['element_134'] ?>");//weight ticket number
                $("input#element_82").val("<?php echo $tsl[0]['element_140'] ?>");//release sale #
                $("input#element_83").val("<?php echo $tsl[0]['element_140'] ?>");//Inbound WC
                $("input#element_84").val("<?php echo $tsl[0]['element_141']; ?>");//notes
                $("input#element_10").val("<?php
                        switch($tsl[0]['element_114']){
                            case 1: echo "Johnny"; break;
                            case 2: echo "Mario"; break;
                            case 3: echo "Other"; break;
                        }
                 ?>");
                 $("input#element_85").val("<?php echo $_GET['er_id']; ?>");
                <?php
                break;
            }
     }else{
        switch(trim($hy[0]['element_3'])){
            case "Pending Retest": case "pending retest":
            $request_date= explode("-",$hy[0]['element_8']);//request
                $req_time = explode(":",$hy[0]['element_9']);
                
                if($req_time[0]>12){
                    $new_time = $req_time[0] - 12;
                }else{
                    $new_time = $req_time[0];
                }
                if($hy[0]['source']=="from_tcl"){//TCL information
                    ?>
                    $("input#element_3").val("<?php echo $hy[0]['element_3'] ?>");
                    $("input#element_8").val("<?php echo $hy[0]['element_8'] ?>");
                    $("input#element_76").val("<?php echo $hy[0]['element_76'] ?>");
                    $("input#element_77").val("<?php echo $hy[0]['element_77'] ?>");
                    $("input#element_82").val("<?php echo $hy[0]['element_82'] ?>");
                    $("input#element_83").val("<?php echo $hy[0]['element_83'] ?>");
                    <?php
                }else{
                    ?>
                    $("input#element_16").val("<?php echo $hy[0]['element_16'] ?>");   
                    <?php
                }
                ?>
                $("input#element_84").val("<?php echo $hy[0]['element_84'] ?>");
                $("input#element_8_1").val("<?php echo $request_date[1]; ?>");
                $("input#element_8_2").val("<?php echo $request_date[2]; ?>");
                $("input#element_8_3").val("<?php echo $request_date[0]; ?>");
                $("input#element_9_1").val("<?php echo $new_time; ?>");
                $("input#element_9_2").val("<?php echo $req_time[1]; ?>");
                $("input#element_85").val("<?php echo $hy[0]['id']; ?>");                    
                $("select#element_4").val("<?php echo $hy[0]['element_4'] ?>");
                $("input#element_10").val("<?php echo $hy[0]['element_10'] ?>");
                $("input#element_11").val("<?php  
                 if($mode == "osr"){   
                    echo $hy[0]['element_11'];
                } else if ( $mode == "tsl"  ){
                    switch($hy[0]['tsl_type']){
                        case 1: 
                            switch($hy[0]['element_11']){
                                case 7:  echo " Agape Transportation"; break;
                                case 26: echo " Bimbo"; break;
                                case 21: echo " Brenntag"; break;
                                case 28: echo " Connection Chemical"; break;
                                case 23: echo " Giralds"; break;
                                case 17: echo " IWP/AZ"; break;
                                case 14: echo " IWP/Mira Loma"; break;
                                case 15: echo " IWP/Selma"; break;
                                case 27: echo " Kinder Morgan"; break;
                                case 11: echo " AVO"; break;
                                case 22: echo " Nexeo"; break;
                                case 8:  echo " North Star Recycling"; break;
                                case 10: echo " Sara Lee"; break;
                                case 20: echo " Schaffner"; break;
                                case 18: echo " Sparkletts"; break;
                                case 16: echo " TARR"; break;
                                case 25: echo " VDFC Victorville"; break;
                                case 24: echo " Ventura Foods Co"; break;
                                case 19: echo " Verhoeven"; break;
                                case 12: echo " Victorville DC"; break;
                                case 9:  echo " Other"; break;
                                default: echo $hy[0]['element_11'];
                            }
                         break;
                        case 2: 
                            switch($hy[0]['element_11']){
                                 case 18:  echo " 4-DIV (AZ)"; break;
                                 case 22:  echo " A-1(AZ)"; break;
                                 case 30:  echo " AZ Grease Services"; break;
                                 case 26:  echo " BA Glenn (AZ)"; break;
                                 case 20:  echo " Crown"; break;
                                 case 27:  echo " Crown (drums)"; break;
                                 case 29:  echo " GT"; break;
                                 case 23:  echo " JN Grease"; break;
                                 case 28:  echo " L-DIV"; break;
                                 case 17:  echo " LSW(SoCal)"; break;
                                 case 33:  echo " Pipe Maintenance"; break;
                                 case 16:  echo " RE"; break;
                                 case 15:  echo " ReNu(NV)"; break;
                                 case 25:  echo " RH"; break;
                                 case 12:  echo " RTI(LA)"; break;
                                 case 31:  echo " S&K (AZ)"; break;
                                 case 32:  echo " Safeway"; break;
                                 case 19:  echo " SMC"; break;
                                 case 21:  echo " U-DIV"; break;
                                 case 24:  echo " U-DIV (ML)"; break;
                                 case 34:  echo " US Oil"; break;
                                 case 11:  echo " Other"; break;
                                 default: echo $hy[0]['element_11'];
                            }
                            break;
                        case 3:
                            switch($hy[0]['element_11']){
                               case 1:  echo " Modern"; break;
                               case 2:  echo " Other"; break;
                               case 3:  echo " Third option"; break;
                               default: echo $hy[0]['element_11'];
                            }
                        break;
                        case 4: 
                            switch($hy[0]['element_11']){
                                case 1:  echo "B+E"; break;
                                case 10:  echo "Chino Valley"; break;
                                case 13:  echo "Dutch"; break;
                                case 8:  echo "Frank Konyn"; break;
                                case 7:  echo "Hinkley"; break;
                                case 5:  echo "IWP (ML)"; break;
                                case 9:  echo "IWP (Selma)"; break;
                                case 12:  echo "Marie Minaberry"; break;
                                case 14:  echo "Perez Beltran"; break;
                                case 4:  echo "Schaffner"; break;
                                case 11:  echo "Verhoeven"; break;
                                case 6:  echo "West Star North"; break;
                                case 2:  echo "Other"; break;
                            }
                        break;
                        case 5: 
                            switch($hy[0]['element_11']){
                                case 1:  echo "Isidro Valdez/Gandera Mexicali"; break;
                                case 6:  echo "Productos Y Subproductos"; break;
                                case 4:  echo "Schaffner"; break;
                                case 5:  echo "West Star North"; break;
                                case 2:  echo "Other"; break;
                            }
                        break;
                        case 6:
                            switch($hy[0]['element_11']){
                                case 1:  echo "#16 Solid Plant"; break;
                                case 46:  echo "Apple Recycling"; break;
                                case 4:  echo "B-DIV to L-DIV"; break;
                                case 52:  echo "B-DIV to BBC Tank"; break;
                                case 26:  echo "BBC Tank"; break;
                                case 32:  echo "Biosphere"; break;
                                case 38:  echo "Bill Kurr"; break;
                                case 23:  echo "BFWMR"; break;
                                case 5:  echo "Boral (Lathrop)"; break;
                                case 49:  echo "Boral Rialto"; break;
                                case 15: echo "Boral (PHX"; break;
                                case 47: echo "City of Camarillo"; break;
                                case 11: echo "CoWest"; break;
                                case 6: echo "Cheveron"; break;
                                case 13: echo "Eagle (Stockton)"; break;
                                case 51: echo "Everlast Industries"; break;
                                case 9: echo "Flyers"; break;
                                case 24: echo "Forterra Pipe & Precast"; break;
                                case 34: echo "G-DIV to B-DIV"; break;
                                case 17: echo "Half Tank 17 to Lint"; break;
                                case 18: echo "Half Tank 19 to Lint"; break;
                                case 42: echo "Half Tank I to Lint"; break;
                                case 41: echo "Half Tank J to Lint"; break;
                                case 40: echo "Half Tank K to Lint"; break;
                                case 39: echo "Half Tank L to Lint"; break;
                                case 30: echo "Half Tank M to Lint"; break;
                                case 29: echo "Half Tank N to Lint"; break;
                                case 28: echo "Half Tank O to Lint"; break;
                                case 22: echo "IWP (ML)"; break;
                                case 50: echo "Kettle #2 to Half Tank N"; break;
                                case 48: echo "L-DIV to G-DIV"; break;
                                case 25: echo "Lint to Half Tank A"; break;
                                case 21: echo "McNeece"; break;
                                case 8: echo "Musket"; break;
                                case 12: echo "North Central"; break;
                                case 33: echo "Oil Services"; break;
                                case 27: echo "Pete's Road Service"; break;
                                case 7: echo "PBF Holding"; break;
                                case 16: echo "Ramirez Pallets"; break;
                                case 37: echo "Rio Valley Pipe"; break;
                                case 14: echo "Rocky Mountain"; break;
                                case 31: echo "SA Recycling"; break;
                                case 20: echo "Sellers Petroleum"; break;
                                case 45: echo "Tank J to Lint"; break;
                                case 44: echo "Tank K to Lint"; break;
                                case 43: echo "Tank L to Lint"; break;
                                case 35: echo "Tank 18 to Lint"; break;
                                case 19: echo "Tank 20 to Lint"; break;
                                case 36: echo "Tech lenexa"; break;
                                case 10: echo "Tesoro"; break;
                                case 2: echo "Other"; break;
                            }
                        break;
                        case 7: 
                            switch($hy[0]['element_11']){
                                case 1: echo "Butterspur"; break;
                                case 6: echo "Foster"; break;
                                case 5: echo "Mesquite"; break;
                                case 2: echo "Other"; break;
                            }
                        break;
                        case 8: 
                            switch($hy[0]['element_11']){
                                case 1: echo "Boiler (cw)"; break;
                                case 4: echo "B-DIV (WW)"; break;
                                case 2: echo "G-DIV (WW)"; break;
                                case 5: echo "Spent Earth"; break;
                                case 3: echo "Other"; break;
                            }
                        break;
                        
                    }
                } ?>");
                $("input#element_12").val("<?php // type
                        if($mode == "osr"){
                            switch($hy[0]['element_11']){
                                case "reactor":
                                    switch($hy[0]['element_12']){
                                        case 1:
                                            echo "Before Stage 1";
                                        break;
                                        case 2:
                                            echo  "After Stage 1";
                                        break;
                                        case 3:
                                            echo  "GC";
                                        break;
                                        case 4:
                                            echo "Before Stage 2";
                                        break;
                                        case 5:
                                            echo "After Stage 2";
                                        break;
                                        case 6:
                                            echo "RS-108";
                                        break;
                                        case 7:
                                            echo "RS-109";
                                        break;
                                        default: echo $hy[0]['element_12'];
                                    }
                                break;
                                case "glycerin":
                                    switch($hy[0]['element_12']){
                                        case 1:
                                            echo  "Acidulated Dried";
                                        break;
                                        case 2:
                                             echo  "Acidulated Dried";
                                        break;
                                        case 2:
                                            echo  "Acidulated Not Dried";
                                        break;
                                        case 3:
                                            echo  "Raw";
                                        break;
                                        case 4:
                                            echo "FFAs";
                                        break;  "Acidulated Not Dried";
                                        break;
                                        case 3:
                                            echo  "Raw";
                                        break;
                                        case 4:
                                            echo "FFAs";
                                        break;
                                        default: echo $hy[0]['element_12'];
                                    }
                                break;
                                case "water codenser":  
                                     echo $hy[0]['element_12'];
                                break;
                                case "distillation":
                                    switch($hy[0]['element_12']){
                                        case 1: echo  "WW"; break;
                                        case 2: echo  "BC"; break;
                                        case 3: echo  "PC"; break;
                                        default: echo $hy[0]['element_12'];
                                        break;
                                    }
                                break;
                                case "wash tanks":
                                    switch($hy[0]['element_12']){
                                        case 1:
                                            echo "Surge";
                                        break;
                                        case 2:
                                            echo "Separator 1";
                                        break;   
                                        case 3:
                                            echo "Separator 2";
                                        break; 
                                        case 4:
                                            echo "RFE";
                                        break;
                                        
                                        case 5:
                                            echo "Centrifuge";
                                        break;
                                        case 6:
                                            echo "Wash Tank C";
                                        break;
                                        case 7:
                                            echo "Wash Tank D";
                                        break;
                                        case 8:
                                            echo "Separator 3";
                                        break;
                                        default: echo $hy[0]['element_12'];
                                    }
                                break;
                                case "G-DIV":
                                    switch($hy[0]['element_12']){
                                        case 1:
                                            echo "HT-A";
                                        break;
                                        case 2:
                                            echo "HT-B";
                                        break;
                                        case 3:
                                            echo "HT-C";
                                        break;
                                        case 4:
                                            echo "HT-D";
                                        break;
                                        case 5:
                                            echo "HT-E";
                                        break;
                                        case 6:
                                            echo "HT-F";
                                        break;
                                        case 7:echo "HT-G";break;
                                        case 8:
                                            echo "HT-H";
                                        break;
                                        case 9:echo "HT-I";break;
                                        case 10:echo "HT-J";break;
                                        case 11:echo "HT-K";break;
                                        case 12:echo "HT-L";break;
                                        
                                        default: echo $hy[0]['element_12'];
                                    }
                                break;
                                case 7:
                                
                                break;
                                default:
                                    echo $hy[0]['element_12'];
                                break;
                            }
                        }else if($mode == "tsl"){
                          switch($hy[0]['tsl_type']){
                            case 1: 
                                switch($hy[0]['element_12']){
                                    case 6:echo "Almond Ground Shell";break;
                                    case 13:echo "Almond Meal";break;
                                    case 18:echo "Bakery";break;
                                    case 25:echo "Candy";break;
                                    case 10:echo "Chocolate";break;
                                    case 24:echo "Clear Diesel";break;
                                    case 7:echo "Dehy Bakery";break;
                                    case 21:echo "Dressing";break;
                                    case 11:echo ">Food Waste";break;
                                    case 17:echo "Fat Lint";break;
                                    case 12:echo "Lin";break;
                                    case 8:echo "Mayo";break;
                                    case 14:echo "Methanol";break;
                                    case 23:echo "peanut Butter";break;
                                    case 20:echo ">Sodium Hydroxide";break;
                                    case 22:echo "Sulferic Acid";break;
                                    case 15:echo "Water";break;
                                    case 16:echo "WCS";break;
                                    case 9:echo "Other";break;
                                }
                            break;
                            case 2: 
                                switch($hy[0]['element_12']){
                                    case 1:echo "Brown Grease";break;
                                    case 4:echo "UCO";break;
                                    case 2:echo "Other";break;
                                }
                            break;
                            case 3: 
                                switch($hy[0]['element_12']){
                                    case 1:echo "Modern";break;
                                    case 2:echo "Other";break;
                                    case 3:echo "Third option";break;
                                }
                            break;
                            case 4: 
                                switch($hy[0]['element_12']){
                                    case 1:echo "Ammoniated Ground Pima";break;
                                    case 2:echo "Bakery";break;
                                    case 4:echo "Fat Lint";break;
                                    case 5:echo "Ground Pima";break;
                                    case 7:echo "TR/CS";break;
                                    case 8:echo "WCS";break;
                                    case 3:echo "Other";break;
                                }
                            break;
                            case 5: 
                                switch($hy[0]['element_12']){
                                    case 1:echo "Bakery";break;
                                    case 4:echo "Brown Grease";break;
                                    case 7:echo "Glycerin";break;
                                    case 2:echo "P&G Oil";break;
                                    case 6:echo "TR/CS";break;
                                    case 3:echo "Other";break;
                                }
                            break;
                            case 6: 
                                switch($hy[0]['element_12']){
                                    case 1: echo  "B20";break;
                                    case 15: echo "B80 CLEAR";break;
                                    case 12: echo "B 99.9";break;
                                    case 20: echo "B 99.9 CLEAR";break;
                                    case 11: echo "B 99.9 RED";break;
                                    case 5: echo  "B100";break;
                                    case 8: echo  "Candy";break;
                                    case 13: echo "Cardboard";break;
                                    case 2: echo  "Esters";break;
                                    case 4: echo  "E44";break;
                                    case 7: echo  "E46";break;
                                    case 6: echo  "FFA's";break;
                                    case 23: echo "FIN Glycerin";break;
                                    case 17: echo "Glycerin";break;
                                    case 18: echo "Glycerin /w Methanol";break;
                                    case 21: echo "Low Acid UCO";break;
                                    case 14: echo "Lubricants";break;
                                    case 22: echo "Mayo Solids";break;
                                    case 9: echo  "Pallets";break;
                                    case 16: echo "Recovery Oil";break;
                                    case 19: echo "Scrap Metal";break;
                                    case 10: echo "Solids";break;
                                    case 3: echo  "Other";break;
                                }
                            break;
                            case 7: 
                               switch($hy[0]['element_12']){
                                    case 1: echo "CO WEST YELLOW GREASE";break;
                                    case 4: echo "YELLOW GREASE";break;
                                    case 3: echo "Other";break;
                               }
                            break;
                            case 8: 
                                echo "Reclaimed Water";
                            break;
                          }
                        }
                   ?>");
                $("input#element_13").val("<?php if($mode == "osr"){//Tank/Tanker
                    switch($hy[0]['element_11']){
                       case "reactor":
                         switch($hy[0]['element_13']){
                            case 1:echo "Reactor #: R101";break;
                            case 2:echo "Reactor #: R102";break;    
                            case 3:echo "Reactor #: R103";break;
                            case 4:echo "Reactor #: R104";break;
                            case 5:echo "Reactor #: R105"; break;
                            case 6:echo "Reactor #: R106";break;
                            case 7:echo "Reactor #: R10";break;
                            case 8:echo "Reactor #: R11";break;
                            case 9:echo "R10 FFA/MIU";break;
                            case 10:echo "R11 FFA";break;
                        }
                       break;
                       case "glycerin":
                        switch($hy[0]['element_13']){
                            case 1:echo "Dryer";break;
                            case 2:echo "Still";break;    
                            case 3:echo "New Dryer";break;
                            case 4:echo "Holding 1";break;
                            case 5:echo "Holding 2";break;
                            case 6:echo "Tank 9";break;
                            case 7:echo "GS-1";break;
                            case 8 :echo "Holding 5";break;
                            case 9:echo "ME-10";break;
                            case 10:echo "Sep 2B"; break;
                            case 11:echo "Sep C";break;
                            case 12:echo "GS-3";break;
                            case 13:echo "FFA-1";break;
                            case 14:echo "FFA-2";break;
                        }
                       break;
                       case "water codenser":
                        switch($hy[0]['element_13']){
                            case 1: echo "Tank 1"; break;
                            case 2: echo "Tank "; break;
                            case 3: echo "Tank 3"; break;
                            case 4: echo "Tank 4"; break;
                        }
                       break;
                       case "distillation":
                        switch($hy[0]['element_13']){
                            case 1:$tank = "Tank 1";break;
                            case 2:$tank = "Tank 2";break;    
                            case 3:$tank = "Tank 3";break;
                            case 4:$tank = "Tank 5";break;
                            case 5:$tank = "TOP";break;
                            case 6:$tank = "BOTTOM";break;
                            case 7:$tank = "BC 1";break;
                            case 8:$tank = "BC 2";break;
                            case 9:$tank = "WW 7";break;                                         
                            case 11:$tank = "WW 6";break;
                            case 12:$tank = "WW 5";break;
                            case 13:$tank = "WW 4";break;
                            case 14:$tank = "WW 3";break;
                            case 15:$tank = "WW 2";break;
                            case 16:$tank = "WW 1";break;
                            case 17:$tank = "PC 2";break;
                            case 18:$tank = "PC 1"; break;
                        }
                       break;
                       case "wash tanks":
                        
                       break;
                       case "G-DIV":
                        switch($hy[0]['element_13']){
                            case 1:echo "T-10";break;
                            case 2:echo "T-11";break;    
                            case 3:echo "T-12";break;
                            case 4:echo "T-13";break;
                            case 5:echo "T-14";break;
                            case 6:echo "T-15";break;
                            case 7:echo "T-16";break;
                            case 8:echo "T-17";break;
                            case 9:echo "T-18";break;
                            case 10:echo "T-19";break;
                            case 11:echo "T-20";break;
                        }
                       break;
                       case "Day Tank":
                        switch($hy[0]['element_13']){
                            case 1:echo "ME-1";break;
                            case 2:echo "ME-2";break;
                            case 3:echo "ME-3";break;
                            case 4:echo "ME-4";break;
                            case 5:echo "ME-5";break;
                            case 6:echo "ME-6";break;
                            case 7:echo "ME-7";break;
                        }
                       break;
                       default:
                        switch($hy[0]['element_13']){
                            case 1:echo "ME-10";break;
                            case 2:echo "FFA-1";break;
                            case 3:echo "FFA-2";break;
                            case 4:echo "Tank-9";break;
                            case 5:echo "Sep C";break;
                            case 6:echo "Old Still";break;
                            case 7:echo "FFA Rec Oil 1";break;
                            case 8:echo "FFA Rec Oil";break;
                            default:echo $hy[0]['element_13'];break;
                        }
                       break;
                    }
                }else if ($mode =="tsl"){
                     echo $hy[0]['element_13']; 
                } ?>");
                $("input#element_14").val("<?php // SPOT NUMBER
                        if($mode =="osr"){
                            switch($hy[0]['element_11']){
                                 case "reactor"://snumber
                                    switch($hy[0]['element_14']){
                                        case 1:echo"S1";break;
                                        case 2:echo"S2";break;
                                        case 3:echo"S3";break;
                                        case 4:echo"S4";break;
                                        case 5:echo"S5";break;
                                        case 6:echo"S6";break;
                                    }
                                 break;
                                 case "glycerin":
                                    switch($hy[0]['element_14']){
                                        case 1:echo"S1";break;
                                        case 2:echo"S2";break;
                                        case 3:echo"S3";break;
                                        case 4:echo"S4";break;
                                        case 5:echo"S5"; break;
                                        case 6:echo"S6";break;
                                    }
                                 break;
                                 case "water codenser":
                                    switch($hy[0]['element_14']){
                                        case 1:echo"S1";break;
                                        case 2:echo"S2";break;
                                        case 3:echo"S3";break;
                                        case 4:echo"S4";break;
                                        case 5:echo"S5";break;
                                        case 6:echo"S6";break;
                                        case 7:echo"S7";break;
                                        case 8:echo"S8";break;
                                        case 9:echo"S9";break;
                                    }
                                 break;
                                 case "distillation":
                                    switch($hy[0]['element_14']){
                                        case 1: echo "S1"; break;
                                        case 2: echo "S2"; break;
                                        case 3: echo "S3"; break;
                                        case 4: echo "S4"; break;
                                        case 5: echo "S5"; break;
                                        case 6: echo "S6"; break;
                                    }
                                 break;
                                 case "wash tanks":
                                    switch($hy[0]['element_14']){
                                        case 1:echo"S1";break;
                                        case 2:echo"S2";break;
                                        case 3:echo"S3";break;
                                        case 4:echo"S4";break;
                                        case 5:echo"S5";break;
                                        case 6:echo"S6";break;
                                    }
                                 break;
                                 case "G-DIV":
                                    switch($hy[0]['element_14']){
                                        case 1:echo "SEP-A";break;
                                        case 2:echo"SEP-B";break;
                                        case 3:echo"SEP-C";break;
                                        case 4:echo"SEP-D";break;
                                        case 5:echo"SEP-E";break;
                                        case 6:echo"SEP-F";break;
                                        case 7:echo"SEP-G"; break;
                                        case 8:echo"SEP-H";break;
                                        case 9:echo"SEP-I";break;
                                        case 10:echo"SEP-J";break;
                                        case 11:echo"SEP-K";break;
                                        case 12:echo"SEP-L";break;
                                    }
                                 break;
                                 case "Day Tank":
                                 echo "";
                                 break;
                                 default:
                                    switch($hy[0]['element_14']){
                                        case 1:echo"Separator H";break;
                                        case 2:echo"Separator I";break;
                                        case 3:echo"Separator J";break;
                                        default:echo $hy[0]['element_14'];break;
                                    }
                                 break;
                                 
                        }
                        }else if ($mode =="tsl"){
                            
                        }
                ?>");
                <?php
                
                if($req_time[0]>11){
                    ?>
                    $("input#element_9_4").val("PM");
                    <?php
                }else{
                    ?>
                    $("input#element_9_4").val("AM");
                   <?php
                }
                ?>
            <?php
            break;
            case "Completed": case "completed":        case "Pending": case "pending":
                $request_date= explode("-",$hy[0]['element_8']);//request
                $req_time = explode(":",$hy[0]['element_9']);
                
                if($req_time[0]>12){
                    $new_time = $req_time[0] - 12;
                }else{
                    $new_time = $req_time[0];
                }
                if($hy[0]['element_6_18']==1){
                    ?>
                    $("#element_6_18").prop("checked",true);
                    $("input#element_90").val("<?Php echo $hy[0]['element_90']; ?>");
                    <?php
                }
                
                if($hy[0]['element_86_18']==1){
                    ?>
                    $("#element_86_18").prop("checked",true);
                    $("input#element_88").val("<?php echo $hy[0]['element_88']; ?>");
                    <?php
                }
                
                if($hy[0]['element_3']=="Completed"){
                    ?>
                    $("#element_81_1").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_86_15'] ==1){
                    ?>
                    $("#element_86_15").prop("checked",true);
                    $("input#element_40").val("<?php echo $hy[0]['element_40'] ?>");
                    $("input#element_41").val("<?php echo $hy[0]['element_41'] ?>");
                    $("input#element_42").val("<?php echo $hy[0]['element_42'] ?>");
                    $("input#element_43").val("<?php echo $hy[0]['element_43'] ?>");
                    $("input#element_45").val("<?php echo $hy[0]['element_45']; ?>");
                    $("input#element_46").val("<?php echo $hy[0]['element_46']; ?>");
                    $("input#element_47").val("<?php echo $hy[0]['element_47']; ?>");
                    $("input#element_48").val("<?php echo $hy[0]['element_48']; ?>");
                    $("input#element_61").val("<?php echo $hy[0]['element_61']; ?>");
                    $("input#element_62").val("<?php echo $hy[0]['element_62']; ?>");
                    $("input#element_63").val("<?php echo $hy[0]['element_63']; ?>");
                    $("input#element_64").val("<?php echo $hy[0]['element_64']; ?>");
                    <?php
                }
                
                if($hy[0]['element_6_14']==1){
                    ?>
                    $("#element_6_14").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_86_4']==1){
                    ?>
                    $("#element_86_4").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_86_12']==1){
                    ?>
                    $("#element_86_12").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_86_17']==1){
                    ?>
                    $("#element_86_17").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_86_16']==1){
                    ?>
                    $("#element_86_16").prop("checked",true);
                    <?php
                }
                if($hy[0]['element_71']==1){
                    ?>
                    $("#element_71_1").prop("checked",true);
                    <?php
                }else{
                    ?>
                    $("#element_71_2").prop("checked",true);
                    <?php
                }
                ?>
                $("input#element_33").val("<?php echo $hy[0]['element_33']; ?>");
                $("input#element_36").val("<?php echo $hy[0]['element_36']; ?>");
                $("input#element_37").val("<?php echo $hy[0]['element_37']; ?>");
                $("input#element_38").val("<?php echo $hy[0]['element_38']; ?>");
                
                $("input#element_51").val("<?php echo $hy[0]['element_51']; ?>");
                $("input#element_52").val("<?php echo $hy[0]['element_52']; ?>");
                $("input#element_53").val("<?php echo $hy[0]['element_53']; ?>");
                $("input#element_54").val("<?php echo $hy[0]['element_54']; ?>");
                
                $("input#element_56").val("<?php echo $hy[0]['element_56']; ?>");
                $("input#element_57").val("<?php echo $hy[0]['element_57']; ?>");
                $("input#element_58").val("<?php echo $hy[0]['element_58']; ?>");
                $("input#element_59").val("<?php echo $hy[0]['element_59']; ?>");
                
                $("input#element_66").val("<?php echo $hy[0]['element_66']; ?>");
                $("input#element_67").val("<?php echo $hy[0]['element_67']; ?>");
                $("input#element_68").val("<?php echo $hy[0]['element_68']; ?>");
                
                $("input#element_78").val("<?php echo $hy[0]['element_78']; ?>");
                $("input#element_79").val("<?php echo $hy[0]['element_79']; ?>");
                $("input#element_91").val("<?php echo $hy[0]['element_91']; ?>");
                $("input#element_8_1").val("<?php echo $request_date[1]; ?>");
                $("input#element_8_2").val("<?php echo $request_date[2]; ?>");
                $("input#element_8_3").val("<?php echo $request_date[0]; ?>");
                $("input#element_9_1").val("<?php echo $new_time; ?>");
                $("input#element_9_2").val("<?php echo $req_time[1]; ?>");
                <?php
                
                if($req_time[0]>11){
                    ?>
                    $("input#element_9_4").val("PM");
                    <?php
                }else{
                    ?>
                    $("input#element_9_4").val("AM");
                   <?php
                }
                if($hy[0]['element_6_1']==1){
                    ?>
                    $("#element_6_1").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_2']==1){
                    ?>
                    $("#element_6_2").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_3']==1){
                    ?>
                    $("#element_6_3").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_4']==1){
                    ?>
                    $("#element_6_4").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_5']==1){
                    ?>
                    $("#element_6_5").prop("checked",true);
                    <?php
                }
                if($hy[0]['element_6_6']==1){
                    ?>
                    $("#element_6_6").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_7']==1){
                    ?>
                    $("#element_6_7").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_8']==1){
                    ?>
                    $("#element_6_8").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_9']==1){
                    ?>
                    $("#element_6_9").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_10']==1){
                    ?>
                    $("#element_6_10").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_11']==1){
                    ?>
                    $("#element_6_11").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_12']==1){
                    ?>
                    $("#element_6_12").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_13']==1){
                    ?>
                    $("#element_6_13").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_70']==1){
                    ?>
                    $("#element_70_1").prop("checked",true);
                    <?php
                } else if ($hy[0]['element_70']==2){
                    ?>
                    $("#element_70_2").prop("checked",true);
                    <?php
                }
                
                
                if($hy[0]['element_81'] == 1){
                    ?>
                    $("#element_81_1").prop("checked",true);
                    <?php
                } else if ($hy[0]['element_81']==2){
                    ?>
                    $("#element_81_2").prop("checked",true);
                    <?php
                }else if($hy[0]['element_81']==3){
                    ?>
                    $("#element_81_3").prop("checked",true);
                    <?php
                }          
                if($hy[0]['element_81'] == 1){
                    ?>
                    $("#element_81_1").prop("checked",true);
                    <?php
                } else if ($hy[0]['element_81']==2){
                    ?>
                    $("#element_81_2").prop("checked",true);
                    <?php
                }else if($hy[0]['element_81']==3){
                    ?>
                    $("#element_81_3").prop("checked",true);
                    <?php
                }    
                ?>
                    $("input#element_3").val("<?php echo $hy[0]['element_3'] ?>");
                    $("input#element_16").val("<?php echo $hy[0]['element_16'] ?>");
                    $("input#element_77").val("<?php if(strlen($hy[0]['element_77'])==0 || $hy[0]['element_77'] == NULL || $hy[0]['element_77'] ==' '){ 
                        echo $_GET['wtn'];
                         }else{ 
                            echo $hy[0]['element_77'];
                     }   ?>");
                    
                    $("input#element_82").val("<?php echo $hy[0]['element_82'] ?>");
                    $("input#element_83").val("<?php echo $hy[0]['element_83'] ?>");
                    $("input#element_84").val("<?php echo $hy[0]['element_84'] ?>");
                    $("select#element_4").val("<?php echo $hy[0]['element_4'] ?>");
                    $("input#element_11").val("<?php  
                 if($mode == "osr"){   
                    echo $hy[0]['element_11'];
                } else if ( $mode == "tsl"  ){
                    switch($hy[0]['tsl_type']){
                                case 1: 
                                    switch($hy[0]['element_11']){
                                        case 7:  echo " Agape Transportation"; break;
                                        case 26: echo " ABimbo"; break;
                                        case 21: echo " ABrenntag"; break;
                                        case 28: echo " AConnection Chemical"; break;
                                        case 23: echo " AGiralds"; break;
                                        case 17: echo " AIWP/AZ"; break;
                                        case 14: echo " AIWP/Mira Loma"; break;
                                        case 15: echo " AIWP/Selma"; break;
                                        case 27: echo " AKinder Morgan"; break;
                                        case 11: echo " AVO"; break;
                                        case 22: echo " ANexeo"; break;
                                        case 8:  echo " ANorth Star Recycling"; break;
                                        case 10: echo " ASara Lee"; break;
                                        case 20: echo " Schaffner"; break;
                                        case 18: echo " Sparkletts"; break;
                                        case 16: echo " TARR"; break;
                                        case 25: echo " VDFC Victorville"; break;
                                        case 24: echo " Ventura Foods Co"; break;
                                        case 19: echo " Verhoeven"; break;
                                        case 12: echo " Victorville DC"; break;
                                        case 9:  echo " Other"; break;
                                    }
                                 break;
                                case 2: 
                                    switch($hy[0]['element_11']){
                                         case 18:  echo " 4-DIV (AZ)"; break;
                                         case 22:  echo " A-1(AZ)"; break;
                                         case 30:  echo " AZ Grease Services"; break;
                                         case 26:  echo " BA Glenn (AZ)"; break;
                                         case 20:  echo " Crown"; break;
                                         case 27:  echo " Crown (drums)"; break;
                                         case 29:  echo " GT"; break;
                                         case 23:  echo " JN Grease"; break;
                                         case 28:  echo " L-DIV"; break;
                                         case 17:  echo " LSW(SoCal)"; break;
                                         case 33:  echo " Pipe Maintenance"; break;
                                         case 16:  echo " RE"; break;
                                         case 15:  echo " ReNu(NV)"; break;
                                         case 25:  echo " RH"; break;
                                         case 12:  echo " RTI(LA)"; break;
                                         case 31:  echo " S&K (AZ)"; break;
                                         case 32:  echo " Safeway"; break;
                                         case 19:  echo " SMC"; break;
                                         case 21:  echo " U-DIV"; break;
                                         case 24:  echo " U-DIV (ML)"; break;
                                         case 34:  echo " US Oil"; break;
                                         case 11:  echo " Other"; break;
                                    }
                                    break;
                                case 3:
                                    switch($hy[0]['element_11']){
                                       case 1:  echo " Modern"; break;
                                       case 2:  echo " Other"; break;
                                       case 3:  echo " Third option"; break;
                                    }
                                break;
                                case 4: 
                                    switch($hy[0]['element_11']){
                                        case 1:  echo "B+E"; break;
                                        case 10:  echo "Chino Valley"; break;
                                        case 13:  echo "Dutch"; break;
                                        case 8:  echo "Frank Konyn"; break;
                                        case 7:  echo "Hinkley"; break;
                                        case 5:  echo "IWP (ML)"; break;
                                        case 9:  echo "IWP (Selma)"; break;
                                        case 12:  echo "Marie Minaberry"; break;
                                        case 14:  echo "Perez Beltran"; break;
                                        case 4:  echo "Schaffner"; break;
                                        case 11:  echo "Verhoeven"; break;
                                        case 6:  echo "West Star North"; break;
                                        case 2:  echo "Other"; break;
                                    }
                                break;
                                case 5: 
                                    switch($hy[0]['element_11']){
                                        case 1:  echo "Isidro Valdez/Gandera Mexicali"; break;
                                        case 6:  echo "Productos Y Subproductos"; break;
                                        case 4:  echo "Schaffner"; break;
                                        case 5:  echo "West Star North"; break;
                                        case 2:  echo "Other"; break;
                                    }
                                break;
                                case 6:
                                    switch($hy[0]['element_11']){
                                        case 1:  echo "#16 Solid Plant"; break;
                                        case 46:  echo "Apple Recycling"; break;
                                        case 4:  echo "B-DIV to L-DIV"; break;
                                        case 52:  echo "B-DIV to BBC Tank"; break;
                                        case 26:  echo "BBC Tank"; break;
                                        case 32:  echo "Biosphere"; break;
                                        case 38:  echo "Bill Kurr"; break;
                                        case 23:  echo "BFWMR"; break;
                                        case 5:  echo "Boral (Lathrop)"; break;
                                        case 49:  echo "Boral Rialto"; break;
                                        case 15: echo "Boral (PHX"; break;
                                        case 47: echo "City of Camarillo"; break;
                                        case 11: echo "CoWest"; break;
                                        case 6: echo "Cheveron"; break;
                                        case 13: echo "Eagle (Stockton)"; break;
                                        case 51: echo "Everlast Industries"; break;
                                        case 9: echo "Flyers"; break;
                                        case 24: echo "Forterra Pipe & Precast"; break;
                                        case 34: echo "G-DIV to B-DIV"; break;
                                        case 17: echo "Half Tank 17 to Lint"; break;
                                        case 18: echo "Half Tank 19 to Lint"; break;
                                        case 42: echo "Half Tank I to Lint"; break;
                                        case 41: echo "Half Tank J to Lint"; break;
                                        case 40: echo "Half Tank K to Lint"; break;
                                        case 39: echo "Half Tank L to Lint"; break;
                                        case 30: echo "Half Tank M to Lint"; break;
                                        case 29: echo "Half Tank N to Lint"; break;
                                        case 28: echo "Half Tank O to Lint"; break;
                                        case 22: echo "IWP (ML)"; break;
                                        case 50: echo "Kettle #2 to Half Tank N"; break;
                                        case 48: echo "L-DIV to G-DIV"; break;
                                        case 25: echo "Lint to Half Tank A"; break;
                                        case 21: echo "McNeece"; break;
                                        case 8: echo "Musket"; break;
                                        case 12: echo "North Central"; break;
                                        case 33: echo "Oil Services"; break;
                                        case 27: echo "Pete's Road Service"; break;
                                        case 7: echo "PBF Holding"; break;
                                        case 16: echo "Ramirez Pallets"; break;
                                        case 37: echo "Rio Valley Pipe"; break;
                                        case 14: echo "Rocky Mountain"; break;
                                        case 31: echo "SA Recycling"; break;
                                        case 20: echo "Sellers Petroleum"; break;
                                        case 45: echo "Tank J to Lint"; break;
                                        case 44: echo "Tank K to Lint"; break;
                                        case 43: echo "Tank L to Lint"; break;
                                        case 35: echo "Tank 18 to Lint"; break;
                                        case 19: echo "Tank 20 to Lint"; break;
                                        case 36: echo "Tech lenexa"; break;
                                        case 10: echo "Tesoro"; break;
                                        case 2: echo "Other"; break;
                                    }
                                break;
                                case 7: 
                                    switch($hy[0]['element_11']){
                                        case 1: echo "Butterspur"; break;
                                        case 6: echo "Foster"; break;
                                        case 5: echo "Mesquite"; break;
                                        case 2: echo "Other"; break;
                                    }
                                break;
                                case 8: 
                                    switch($hy[0]['element_11']){
                                        case 1: echo "Boiler (cw)"; break;
                                        case 4: echo "B-DIV (WW)"; break;
                                        case 2: echo "G-DIV (WW)"; break;
                                        case 5: echo "Spent Earth"; break;
                                        case 3: echo "Other"; break;
                                    }
                                break;
                                
                            }
                } ?>");
                    $("input#element_12").val("<?php
                                if($mode=="osr"){
                                    switch($hy[0]['element_11']){
                                        case "reactor":
                                            switch($hy[0]['element_12']){
                                                case 1:
                                                    echo "Before Stage 1";
                                                break;
                                                case 2:
                                                    echo  "After Stage 1";
                                                break;
                                                case 3:
                                                    echo  "GC";
                                                break;
                                                case 4:
                                                    echo "Before Stage 2";
                                                break;
                                                case 5:
                                                    echo "After Stage 2";
                                                break;
                                                case 6:
                                                    echo "RS-108";
                                                break;
                                                case 7:
                                                    echo "RS-109";
                                                break;
                                                default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        case "glycerin":
                                            switch($hy[0]['element_12']){
                                                case 1:
                                                    echo  "Acidulated Dried";
                                                break;
                                                case 2:
                                                     echo  "Acidulated Dried";
                                                break;
                                                case 2:
                                                    echo  "Acidulated Not Dried";
                                                break;
                                                case 3:
                                                    echo  "Raw";
                                                break;
                                                case 4:
                                                    echo "FFAs";
                                                break;  "Acidulated Not Dried";
                                                break;
                                                case 3:
                                                    echo  "Raw";
                                                break;
                                                case 4:
                                                    echo "FFAs";
                                                break;
                                                default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        case "water codenser":  
                                            echo $hy[0]['element_12'];
                                            break;
                                            case "distillation":
                                                switch($hy[0]['element_12']){
                                                      case 1: echo  "WW"; break;
                                                      case 2: echo  "BC"; break;
                                                      case 3: echo  "PC"; break;
                                                      default: echo $hy[0]['element_12'];
                                                }
                                            break;
                                            case "wash tanks":
                                                switch($hy[0]['element_12']){
                                                    case 1:
                                                    echo "Surge";
                                                    break;
                                                    case 2:
                                                        echo "Separator 1";
                                                    break;   
                                                    case 3:
                                                        echo "Separator 2";
                                                    break; 
                                                    case 4:
                                                        echo "RFE";
                                                    break;
                                                    
                                                    case 5:
                                                        echo "Centrifuge";
                                                    break;
                                                    case 6:
                                                        echo "Wash Tank C";
                                                    break;
                                                    case 7:
                                                        echo "Wash Tank D";
                                                    break;
                                                    case 8:
                                                        echo "Separator 3";
                                                    break;
                                                    default: echo $hy[0]['element_12'];
                                            }
                                            break;
                                            case "G-DIV":
                                                switch($hy[0]['element_12']){
                                                    case 1:
                                                        echo "HT-A";
                                                    break;
                                                    case 2:
                                                        echo "HT-B";
                                                    break;
                                                    case 3:
                                                        echo "HT-C";
                                                    break;
                                                    case 4:
                                                        echo "HT-D";
                                                    break;
                                                    case 5:
                                                        echo "HT-E";
                                                    break;
                                                    case 6:
                                                        echo "HT-F";
                                                    break;
                                                    case 7:echo "HT-G";break;
                                                    case 8:
                                                        echo "HT-H";
                                                    break;
                                                    case 9:echo "HT-I";break;
                                                    case 10:echo "HT-J";break;
                                                    case 11:echo "HT-K";break;
                                                    case 12:echo "HT-L";break;
                                                    
                                                    default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        case 7:
                                
                                        break;
                                        default:
                                            echo $hy[0]['element_12'];
                                        break;
                                    }
                                }else if($mode=="tsl"){
                                   switch($hy[0]['tsl_type']){
                                        case 1: 
                                            switch($hy[0]['element_12']){
                                                case 6:echo "Almond Ground Shell";break;
                                                case 13:echo "Almond Meal";break;
                                                case 18:echo "Bakery";break;
                                                case 25:echo "Candy";break;
                                                case 10:echo "Chocolate";break;
                                                case 24:echo "Clear Diesel";break;
                                                case 7:echo "Dehy Bakery";break;
                                                case 21:echo "Dressing";break;
                                                case 11:echo ">Food Waste";break;
                                                case 17:echo "Fat Lint";break;
                                                case 12:echo "Lin";break;
                                                case 8:echo "Mayo";break;
                                                case 14:echo "Methanol";break;
                                                case 23:echo "peanut Butter";break;
                                                case 20:echo ">Sodium Hydroxide";break;
                                                case 22:echo "Sulferic Acid";break;
                                                case 15:echo "Water";break;
                                                case 16:echo "WCS";break;
                                                case 9:echo "Other";break;
                                            }
                                        break;
                                        case 2: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Brown Grease";break;
                                                case 4:echo "UCO";break;
                                                case 2:echo "Other";break;
                                            }
                                        break;
                                        case 3: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Modern";break;
                                                case 2:echo "Other";break;
                                                case 3:echo "Third option";break;
                                            }
                                        break;
                                        case 4: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Ammoniated Ground Pima";break;
                                                case 2:echo "Bakery";break;
                                                case 4:echo "Fat Lint";break;
                                                case 5:echo "Ground Pima";break;
                                                case 7:echo "TR/CS";break;
                                                case 8:echo "WCS";break;
                                                case 3:echo "Other";break;
                                            }
                                        break;
                                        case 5: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Bakery";break;
                                                case 4:echo "Brown Grease";break;
                                                case 7:echo "Glycerin";break;
                                                case 2:echo "P&G Oil";break;
                                                case 6:echo "TR/CS";break;
                                                case 3:echo "Other";break;
                                            }
                                        break;
                                        case 6: 
                                            switch($hy[0]['element_12']){
                                                case 1: echo  "B20";break;
                                                case 15: echo "B80 CLEAR";break;
                                                case 12: echo "B 99.9";break;
                                                case 20: echo "B 99.9 CLEAR";break;
                                                case 11: echo "B 99.9 RED";break;
                                                case 5: echo  "B100";break;
                                                case 8: echo  "Candy";break;
                                                case 13: echo "Cardboard";break;
                                                case 2: echo  "Esters";break;
                                                case 4: echo  "E44";break;
                                                case 7: echo  "E46";break;
                                                case 6: echo  "FFA's";break;
                                                case 23: echo "FIN Glycerin";break;
                                                case 17: echo "Glycerin";break;
                                                case 18: echo "Glycerin /w Methanol";break;
                                                case 21: echo "Low Acid UCO";break;
                                                case 14: echo "Lubricants";break;
                                                case 22: echo "Mayo Solids";break;
                                                case 9: echo  "Pallets";break;
                                                case 16: echo "Recovery Oil";break;
                                                case 19: echo "Scrap Metal";break;
                                                case 10: echo "Solids";break;
                                                case 3: echo  "Other";break;
                                            }
                                        break;
                                        case 7: 
                                           switch($hy[0]['element_12']){
                                                case 1: echo "CO WEST YELLOW GREASE";break;
                                                case 4: echo "YELLOW GREASE";break;
                                                case 3: echo "Other";break;
                                           }
                                        break;
                                        case 8: 
                                            echo "Reclaimed Water";
                                        break;
                                      }
                                }
                   ?>");
                    $("input#element_13").val("<?php if($mode == "osr"){
                    switch($hy[0]['element_11']){
                       case "reactor":
                         switch($hy[0]['element_13']){
                            case 1:echo "Reactor #: R101";break;
                            case 2:echo "Reactor #: R102";break;    
                            case 3:echo "Reactor #: R103";break;
                            case 4:echo "Reactor #: R104";break;
                            case 5:echo "Reactor #: R105"; break;
                            case 6:echo "Reactor #: R106";break;
                            case 7:echo "Reactor #: R10";break;
                            case 8:echo "Reactor #: R11";break;
                            case 9:echo "R10 FFA/MIU";break;
                            case 10:echo "R11 FFA";break;
                        }
                       break;
                       case "glycerin":
                        switch($hy[0]['element_13']){
                            case 1:echo "Dryer";break;
                            case 2:echo "Still";break;    
                            case 3:echo "New Dryer";break;
                            case 4:echo "Holding 1";break;
                            case 5:echo "Holding 2";break;
                            case 6:echo "Tank 9";break;
                            case 7:echo "GS-1";break;
                            case 8 :echo "Holding 5";break;
                            case 9:echo "ME-10";break;
                            case 10:echo "Sep 2B"; break;
                            case 11:echo "Sep C";break;
                            case 12:echo "GS-3";break;
                            case 13:echo "FFA-1";break;
                            case 14:echo "FFA-2";break;
                        }
                       break;
                       case "water codenser":
                        switch($hy[0]['element_13']){
                            case 1: echo "Tank 1"; break;
                            case 2: echo "Tank "; break;
                            case 3: echo "Tank 3"; break;
                            case 4: echo "Tank 4"; break;
                        }
                       break;
                       case "distillation":
                        switch($hy[0]['element_13']){
                            case 1:$tank = "Tank 1";break;
                            case 2:$tank = "Tank 2";break;    
                            case 3:$tank = "Tank 3";break;
                            case 4:$tank = "Tank 5";break;
                            case 5:$tank = "TOP";break;
                            case 6:$tank = "BOTTOM";break;
                            case 7:$tank = "BC 1";break;
                            case 8:$tank = "BC 2";break;
                            case 9:$tank = "WW 7";break;                                         
                            case 11:$tank = "WW 6";break;
                            case 12:$tank = "WW 5";break;
                            case 13:$tank = "WW 4";break;
                            case 14:$tank = "WW 3";break;
                            case 15:$tank = "WW 2";break;
                            case 16:$tank = "WW 1";break;
                            case 17:$tank = "PC 2";break;
                            case 18:$tank = "PC 1"; break;
                        }
                       break;
                       case "wash tanks":
                        
                       break;
                       case "G-DIV":
                        switch($hy[0]['element_13']){
                            case 1:echo "T-10";break;
                            case 2:echo "T-11";break;    
                            case 3:echo "T-12";break;
                            case 4:echo "T-13";break;
                            case 5:echo "T-14";break;
                            case 6:echo "T-15";break;
                            case 7:echo "T-16";break;
                            case 8:echo "T-17";break;
                            case 9:echo "T-18";break;
                            case 10:echo "T-19";break;
                            case 11:echo "T-20";break;
                        }
                       break;
                       case "Day Tank":
                        switch($hy[0]['element_13']){
                            case 1:echo "ME-1";break;
                            case 2:echo "ME-2";break;
                            case 3:echo "ME-3";break;
                            case 4:echo "ME-4";break;
                            case 5:echo "ME-5";break;
                            case 6:echo "ME-6";break;
                            case 7:echo "ME-7";break;
                        }
                       break;
                       default:
                        switch($hy[0]['element_13']){
                            case 1:echo "ME-10";break;
                            case 2:echo "FFA-1";break;
                            case 3:echo "FFA-2";break;
                            case 4:echo "Tank-9";break;
                            case 5:echo "Sep C";break;
                            case 6:echo "Old Still";break;
                            case 7:echo "FFA Rec Oil 1";break;
                            case 8:echo "FFA Rec Oil";break;
                            default:echo $hy[0]['element_13'];break;
                        }
                       break;
                    }
                }else if ($mode =="tsl"){
                     echo $hy[0]['element_13']; 
                } ?>");
                    $("input#element_14").val("<?php 
                            if($mode == "osr"){
                                switch($hy[0]['element_14']){
                                    case 1: echo "S1"; break;
                                    case 2: echo "S2"; break;
                                    case 3: echo "S3"; break;
                                    case 4: echo "S4"; break;
                                    case 5: echo "S5"; break;
                                    case 6: echo "S6"; break;
                                    case 7: echo "S7"; break;
                                    case 8: echo "S8"; break;
                                    case 9: echo "S9"; break;
                                    default: echo $hy[0]['element_14'];
                                }
                            }else if($mode == "tsl"){
                                echo $hy[0]['element_14'];
                            }
                     ?>");
                    $("input#element_17").val("<?php echo $hy[0]['element_17'] ?>");
                    $("input#element_35").val("<?php echo $hy[0]['element_35'] ?>");
                    $("input#element_72").val("<?php echo $hy[0]['element_72'] ?>");
                    $("input#element_73").val("<?php echo $hy[0]['element_73'] ?>");
                    $("input#element_74").val("<?php echo $hy[0]['element_74'] ?>");  
                    $("input#element_76").val("<?php echo $hy[0]['element_76'] ?>");             
                    $("input#element_10").val("<?php echo $hy[0]['element_10'] ?>");
                    $("input#element_85").val("<?php echo $hy[0]['id']; ?>");
                    $("input#element_31").val("<?php echo $hy[0]['element_31'] ?>");
                    $("input#element_20").val("<?php echo $hy[0]['element_20'] ?>");
                    $("input#element_30").val("<?php echo $hy[0]['element_30'] ?>");
                    $("input#element_32").val("<?php echo $hy[0]['element_30'] ?>");
                <?php
            break;
            case "rejected": case "Rejected":
                $request_date= explode("-",$hy[0]['element_8']);//request
                $req_time = explode(":",$hy[0]['element_9']);
                
                if($req_time[0]>12){
                    $new_time = $req_time[0] - 12;
                }else{
                    $new_time = $req_time[0];
                }
                ?>
                $("input#element_8_1").val("<?php echo $request_date[1]; ?>");
                $("input#element_8_2").val("<?php echo $request_date[2]; ?>");
                $("input#element_8_3").val("<?php echo $request_date[0]; ?>");
                $("input#element_9_1").val("<?php echo $new_time; ?>");
                $("input#element_9_2").val("<?php echo $req_time[1]; ?>");
                <?php
                
                if($req_time[0]>11){
                    ?>
                    $("input#element_9_4").val("PM");
                    <?php
                }else{
                    ?>
                    $("input#element_9_4").val("AM");
                   <?php
                }
                if($hy[0]['element_6_1']==1){
                    ?>
                    $("#element_6_1").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_2']==1){
                    ?>
                    $("#element_6_2").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_3']==1){
                    ?>
                    $("#element_6_3").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_4']==1){
                    ?>
                    $("#element_6_4").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_5']==1){
                    ?>
                    $("#element_6_5").prop("checked",true);
                    <?php
                }
                if($hy[0]['element_6_6']==1){
                    ?>
                    $("#element_6_6").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_7']==1){
                    ?>
                    $("#element_6_7").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_8']==1){
                    ?>
                    $("#element_6_8").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_9']==1){
                    ?>
                    $("#element_6_9").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_10']==1){
                    ?>
                    $("#element_6_10").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_11']==1){
                    ?>
                    $("#element_6_11").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_12']==1){
                    ?>
                    $("#element_6_12").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_6_13']==1){
                    ?>
                    $("#element_6_13").prop("checked",true);
                    <?php
                }
                
                if($hy[0]['element_70']==1){
                    ?>
                    $("#element_70_1").prop("checked",true);
                    <?php
                } else if ($hy[0]['element_70']==2){
                    ?>
                    $("#element_70_2").prop("checked",true);
                    <?php
                }
                
                
                if($hy[0]['element_81'] == 1){
                    ?>
                    $("#element_81_1").prop("checked",true);
                    <?php
                } else if ($hy[0]['element_81']==2){
                    ?>
                    $("#element_81_2").prop("checked",true);
                    <?php
                }else if($hy[0]['element_81']==3){
                    ?>
                    $("#element_81_3").prop("checked",true);
                    <?php
                }          
                if($hy[0]['element_81'] == 1){
                    ?>
                    $("#element_81_1").prop("checked",true);
                    <?php
                } else if ($hy[0]['element_81']==2){
                    ?>
                    $("#element_81_2").prop("checked",true);
                    <?php
                }else if($hy[0]['element_81']==3){
                    ?>
                    $("#element_81_3").prop("checked",true);
                    <?php
                }    
                ?>
                    $("input#element_3").val("<?php echo $hy[0]['element_3'] ?>");
                    $("input#element_16").val("<?php echo $hy[0]['element_16'] ?>");
                    $("input#element_77").val("<?php if(strlen($hy[0]['element_77'])==0 || $hy[0]['element_77'] == NULL || $hy[0]['element_77'] ==' '){ 
                        echo $_GET['wtn'];
                         }else{ 
                            echo $hy[0]['element_77'];
                     }   ?>");
                    
                    $("input#element_82").val("<?php echo $hy[0]['element_82'] ?>");
                    $("input#element_83").val("<?php echo $hy[0]['element_83'] ?>");
                    $("input#element_84").val("<?php echo $hy[0]['element_84'] ?>");
                    $("select#element_4").val("<?php echo $hy[0]['element_4'] ?>");
                    $("input#element_11").val("<?php  
                        if($mode == "osr"){   
                            echo $hy[0]['element_11'];
                        } else if ( $mode == "tsl"  ){
                            switch($hy[0]['tsl_type']){
                                case 1: 
                                    switch($hy[0]['element_11']){
                                        case 7:  echo " Agape Transportation"; break;
                                        case 26: echo " ABimbo"; break;
                                        case 21: echo " ABrenntag"; break;
                                        case 28: echo " AConnection Chemical"; break;
                                        case 23: echo " AGiralds"; break;
                                        case 17: echo " AIWP/AZ"; break;
                                        case 14: echo " AIWP/Mira Loma"; break;
                                        case 15: echo " AIWP/Selma"; break;
                                        case 27: echo " AKinder Morgan"; break;
                                        case 11: echo " AVO"; break;
                                        case 22: echo " ANexeo"; break;
                                        case 8:  echo " ANorth Star Recycling"; break;
                                        case 10: echo " ASara Lee"; break;
                                        case 20: echo " Schaffner"; break;
                                        case 18: echo " Sparkletts"; break;
                                        case 16: echo " TARR"; break;
                                        case 25: echo " VDFC Victorville"; break;
                                        case 24: echo " Ventura Foods Co"; break;
                                        case 19: echo " Verhoeven"; break;
                                        case 12: echo " Victorville DC"; break;
                                        case 9:  echo " Other"; break;
                                    }
                                 break;
                                case 2: 
                                    switch($hy[0]['element_11']){
                                         case 18:  echo " 4-DIV (AZ)"; break;
                                         case 22:  echo " A-1(AZ)"; break;
                                         case 30:  echo " AZ Grease Services"; break;
                                         case 26:  echo " BA Glenn (AZ)"; break;
                                         case 20:  echo " Crown"; break;
                                         case 27:  echo " Crown (drums)"; break;
                                         case 29:  echo " GT"; break;
                                         case 23:  echo " JN Grease"; break;
                                         case 28:  echo " L-DIV"; break;
                                         case 17:  echo " LSW(SoCal)"; break;
                                         case 33:  echo " Pipe Maintenance"; break;
                                         case 16:  echo " RE"; break;
                                         case 15:  echo " ReNu(NV)"; break;
                                         case 25:  echo " RH"; break;
                                         case 12:  echo " RTI(LA)"; break;
                                         case 31:  echo " S&K (AZ)"; break;
                                         case 32:  echo " Safeway"; break;
                                         case 19:  echo " SMC"; break;
                                         case 21:  echo " U-DIV"; break;
                                         case 24:  echo " U-DIV (ML)"; break;
                                         case 34:  echo " US Oil"; break;
                                         case 11:  echo " Other"; break;
                                    }
                                    break;
                                case 3:
                                    switch($hy[0]['element_11']){
                                       case 1:  echo " Modern"; break;
                                       case 2:  echo " Other"; break;
                                       case 3:  echo " Third option"; break;
                                    }
                                break;
                                case 4: 
                                    switch($hy[0]['element_11']){
                                        case 1:  echo "B+E"; break;
                                        case 10:  echo "Chino Valley"; break;
                                        case 13:  echo "Dutch"; break;
                                        case 8:  echo "Frank Konyn"; break;
                                        case 7:  echo "Hinkley"; break;
                                        case 5:  echo "IWP (ML)"; break;
                                        case 9:  echo "IWP (Selma)"; break;
                                        case 12:  echo "Marie Minaberry"; break;
                                        case 14:  echo "Perez Beltran"; break;
                                        case 4:  echo "Schaffner"; break;
                                        case 11:  echo "Verhoeven"; break;
                                        case 6:  echo "West Star North"; break;
                                        case 2:  echo "Other"; break;
                                    }
                                break;
                                case 5: 
                                    switch($hy[0]['element_11']){
                                        case 1:  echo "Isidro Valdez/Gandera Mexicali"; break;
                                        case 6:  echo "Productos Y Subproductos"; break;
                                        case 4:  echo "Schaffner"; break;
                                        case 5:  echo "West Star North"; break;
                                        case 2:  echo "Other"; break;
                                    }
                                break;
                                case 6:
                                    switch($hy[0]['element_11']){
                                        case 1:  echo "#16 Solid Plant"; break;
                                        case 46:  echo "Apple Recycling"; break;
                                        case 4:  echo "B-DIV to L-DIV"; break;
                                        case 52:  echo "B-DIV to BBC Tank"; break;
                                        case 26:  echo "BBC Tank"; break;
                                        case 32:  echo "Biosphere"; break;
                                        case 38:  echo "Bill Kurr"; break;
                                        case 23:  echo "BFWMR"; break;
                                        case 5:  echo "Boral (Lathrop)"; break;
                                        case 49:  echo "Boral Rialto"; break;
                                        case 15: echo "Boral (PHX"; break;
                                        case 47: echo "City of Camarillo"; break;
                                        case 11: echo "CoWest"; break;
                                        case 6: echo "Cheveron"; break;
                                        case 13: echo "Eagle (Stockton)"; break;
                                        case 51: echo "Everlast Industries"; break;
                                        case 9: echo "Flyers"; break;
                                        case 24: echo "Forterra Pipe & Precast"; break;
                                        case 34: echo "G-DIV to B-DIV"; break;
                                        case 17: echo "Half Tank 17 to Lint"; break;
                                        case 18: echo "Half Tank 19 to Lint"; break;
                                        case 42: echo "Half Tank I to Lint"; break;
                                        case 41: echo "Half Tank J to Lint"; break;
                                        case 40: echo "Half Tank K to Lint"; break;
                                        case 39: echo "Half Tank L to Lint"; break;
                                        case 30: echo "Half Tank M to Lint"; break;
                                        case 29: echo "Half Tank N to Lint"; break;
                                        case 28: echo "Half Tank O to Lint"; break;
                                        case 22: echo "IWP (ML)"; break;
                                        case 50: echo "Kettle #2 to Half Tank N"; break;
                                        case 48: echo "L-DIV to G-DIV"; break;
                                        case 25: echo "Lint to Half Tank A"; break;
                                        case 21: echo "McNeece"; break;
                                        case 8: echo "Musket"; break;
                                        case 12: echo "North Central"; break;
                                        case 33: echo "Oil Services"; break;
                                        case 27: echo "Pete's Road Service"; break;
                                        case 7: echo "PBF Holding"; break;
                                        case 16: echo "Ramirez Pallets"; break;
                                        case 37: echo "Rio Valley Pipe"; break;
                                        case 14: echo "Rocky Mountain"; break;
                                        case 31: echo "SA Recycling"; break;
                                        case 20: echo "Sellers Petroleum"; break;
                                        case 45: echo "Tank J to Lint"; break;
                                        case 44: echo "Tank K to Lint"; break;
                                        case 43: echo "Tank L to Lint"; break;
                                        case 35: echo "Tank 18 to Lint"; break;
                                        case 19: echo "Tank 20 to Lint"; break;
                                        case 36: echo "Tech lenexa"; break;
                                        case 10: echo "Tesoro"; break;
                                        case 2: echo "Other"; break;
                                    }
                                break;
                                case 7: 
                                    switch($hy[0]['element_11']){
                                        case 1: echo "Butterspur"; break;
                                        case 6: echo "Foster"; break;
                                        case 5: echo "Mesquite"; break;
                                        case 2: echo "Other"; break;
                                    }
                                break;
                                case 8: 
                                    switch($hy[0]['element_11']){
                                        case 1: echo "Boiler (cw)"; break;
                                        case 4: echo "B-DIV (WW)"; break;
                                        case 2: echo "G-DIV (WW)"; break;
                                        case 5: echo "Spent Earth"; break;
                                        case 3: echo "Other"; break;
                                    }
                                break;
                                
                            }
                        } ?>");
                    $("input#element_12").val("<?php
                                if($mode=="osr"){
                                    switch($hy[0]['element_11']){
                                        case "reactor":
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Before Stage 1";break;
                                                case 2:echo  "After Stage 1";break;
                                                case 3:echo  "GC";break;
                                                default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        case "glycerin":
                                            switch($hy[0]['element_12']){
                                                case 1:echo  "Acidulated Dried";break;
                                                case 2:echo  "Acidulated Not Dried";break;
                                                case 3:echo  "Raw";break;
                                                default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        case "water codenser":  
                                            echo $hy[0]['element_12'];
                                        break;
                                        case "distillation":
                                            switch($hy[0]['element_12']){
                                                case 1: echo  "WW"; break;
                                                case 2: echo  "BC"; break;
                                                case 3: echo  "PC"; break;
                                                default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        case "wash tanks":
                                            switch($hy[0]['element_12']){
                                                case 1: echo "Surge";break;
                                                case 2:echo "Separator 1";break;    
                                                case 3:echo "RFE";break;
                                                case 4:echo "Separator 2";break;
                                                default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        case "G-DIV":
                                            switch($hy[0]['element_12']){
                                                case 1:echo "10-20";break;
                                                case 2:echo "Separator A-G";break;
                                                case 3:echo "Half Tank A-L";break;
                                                case 4:echo "Frat Tank";break;
                                                case 5:echo "White Tank";break;
                                                default: echo $hy[0]['element_12'];
                                            }
                                        break;
                                        default:
                                            echo $hy[0]['element_12'];
                                        break;
                                    }
                                }else if ($mode=="tsl"){
                                    switch($hy[0]['tsl_type']){
                                        case 1: 
                                            switch($hy[0]['element_12']){
                                                case 6:echo "Almond Ground Shell";break;
                                                case 13:echo "Almond Meal";break;
                                                case 18:echo "Bakery";break;
                                                case 25:echo "Candy";break;
                                                case 10:echo "Chocolate";break;
                                                case 24:echo "Clear Diesel";break;
                                                case 7:echo "Dehy Bakery";break;
                                                case 21:echo "Dressing";break;
                                                case 11:echo ">Food Waste";break;
                                                case 17:echo "Fat Lint";break;
                                                case 12:echo "Lin";break;
                                                case 8:echo "Mayo";break;
                                                case 14:echo "Methanol";break;
                                                case 23:echo "peanut Butter";break;
                                                case 20:echo ">Sodium Hydroxide";break;
                                                case 22:echo "Sulferic Acid";break;
                                                case 15:echo "Water";break;
                                                case 16:echo "WCS";break;
                                                case 9:echo "Other";break;
                                            }
                                        break;
                                        case 2: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Brown Grease";break;
                                                case 4:echo "UCO";break;
                                                case 2:echo "Other";break;
                                            }
                                        break;
                                        case 3: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Modern";break;
                                                case 2:echo "Other";break;
                                                case 3:echo "Third option";break;
                                            }
                                        break;
                                        case 4: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Ammoniated Ground Pima";break;
                                                case 2:echo "Bakery";break;
                                                case 4:echo "Fat Lint";break;
                                                case 5:echo "Ground Pima";break;
                                                case 7:echo "TR/CS";break;
                                                case 8:echo "WCS";break;
                                                case 3:echo "Other";break;
                                            }
                                        break;
                                        case 5: 
                                            switch($hy[0]['element_12']){
                                                case 1:echo "Bakery";break;
                                                case 4:echo "Brown Grease";break;
                                                case 7:echo "Glycerin";break;
                                                case 2:echo "P&G Oil";break;
                                                case 6:echo "TR/CS";break;
                                                case 3:echo "Other";break;
                                            }
                                        break;
                                        case 6: 
                                            switch($hy[0]['element_12']){
                                                case 1: echo  "B20";break;
                                                case 15: echo "B80 CLEAR";break;
                                                case 12: echo "B 99.9";break;
                                                case 20: echo "B 99.9 CLEAR";break;
                                                case 11: echo "B 99.9 RED";break;
                                                case 5: echo  "B100";break;
                                                case 8: echo  "Candy";break;
                                                case 13: echo "Cardboard";break;
                                                case 2: echo  "Esters";break;
                                                case 4: echo  "E44";break;
                                                case 7: echo  "E46";break;
                                                case 6: echo  "FFA's";break;
                                                case 23: echo "FIN Glycerin";break;
                                                case 17: echo "Glycerin";break;
                                                case 18: echo "Glycerin /w Methanol";break;
                                                case 21: echo "Low Acid UCO";break;
                                                case 14: echo "Lubricants";break;
                                                case 22: echo "Mayo Solids";break;
                                                case 9: echo  "Pallets";break;
                                                case 16: echo "Recovery Oil";break;
                                                case 19: echo "Scrap Metal";break;
                                                case 10: echo "Solids";break;
                                                case 3: echo  "Other";break;
                                            }
                                        break;
                                        case 7: 
                                           switch($hy[0]['element_12']){
                                                case 1: echo "CO WEST YELLOW GREASE";break;
                                                case 4: echo "YELLOW GREASE";break;
                                                case 3: echo "Other";break;
                                           }
                                        break;
                                        case 8: 
                                            echo "Reclaimed Water";
                                        break;
                                      }
                                }
                   ?>");
                    $("input#element_13").val("<?php echo $hy[0]['element_13'];  ?>");
                    $("input#element_14").val("<?php 
                        if($mode =="osr"){
                            switch($hy[0]['element_11']){
                                 case "reactor"://snumber
                                    switch($hy[0]['element_14']){
                                        case 1:echo"S1";break;
                                        case 2:echo"S2";break;
                                        case 3:echo"S3";break;
                                        case 4:echo"S4";break;
                                        case 5:echo"S5";break;
                                        case 6:echo"S6";break;
                                    }
                                 break;
                                 case "glycerin":
                                    switch($hy[0]['element_14']){
                                        case 1:echo"S1";break;
                                        case 2:echo"S2";break;
                                        case 3:echo"S3";break;
                                        case 4:echo"S4";break;
                                        case 5:echo"S5"; break;
                                        case 6:echo"S6";break;
                                    }
                                 break;
                                 case "water codenser":
                                    switch($hy[0]['element_14']){
                                        case 1:echo"S1";break;
                                        case 2:echo"S2";break;
                                        case 3:echo"S3";break;
                                        case 4:echo"S4";break;
                                        case 5:echo"S5";break;
                                        case 6:echo"S6";break;
                                        case 7:echo"S7";break;
                                        case 8:echo"S8";break;
                                        case 9:echo"S9";break;
                                    }
                                 break;
                                 case "distillation":
                                    switch($hy[0]['element_14']){
                                        case 1: echo "S1"; break;
                                        case 2: echo "S2"; break;
                                        case 3: echo "S3"; break;
                                        case 4: echo "S4"; break;
                                        case 5: echo "S5"; break;
                                        case 6: echo "S6"; break;
                                    }
                                 break;
                                 case "wash tanks":
                                    switch($hy[0]['element_14']){
                                        case 1:$snumber ="S1";break;
                                        case 2:$snumber ="S2";break;
                                        case 3:$snumber ="S3";break;
                                        case 4:$snumber ="S4";break;
                                        case 5:$snumber ="S5";break;
                                        case 6:$snumber ="S6";break;
                                    }
                                 break;
                                 case "G-DIV":
                                    switch($hy[0]['element_14']){
                                        case 1:$snumber ="SEP-A";break;
                                        case 2:$snumber ="SEP-B";break;
                                        case 3:$snumber ="SEP-C";break;
                                        case 4:$snumber ="SEP-D";break;
                                        case 5:$snumber ="SEP-E";break;
                                        case 6:$snumber ="SEP-F";break;
                                        case 7:$snumber ="SEP-G";break;
                                        case 8:$snumber ="SEP-H";break;
                                        case 9:$snumber ="SEP-I";break;
                                        case 10:$snumber ="SEP-J";break;
                                        case 11:$snumber ="SEP-K";break;
                                        case 12:$snumber ="SEP-L";break;
                                    }
                                 break;
                            }
                        }else if($mode =="tsl"){
                            echo $hy[0]['element_14'];
                        }
                
                  ?>");
                    $("input#element_17").val("<?php echo $hy[0]['element_17'] ?>");
                    $("input#element_35").val("<?php echo $hy[0]['element_35'] ?>");
                    $("input#element_72").val("<?php echo $hy[0]['element_72'] ?>");
                    $("input#element_73").val("<?php echo $hy[0]['element_73'] ?>");
                    $("input#element_74").val("<?php echo $hy[0]['element_74'] ?>");  
                    $("input#element_76").val("<?php echo $hy[0]['element_76'] ?>");             
                    $("input#element_10").val("<?php echo $hy[0]['element_10'] ?>");
                    $("input#element_85").val("<?php echo $hy[0]['id']; ?>");
                <?php
            break;
         }
     }
    
     
        
        
            
           
        
   ?>

</script>