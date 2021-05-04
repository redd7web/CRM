<?php

include "protected/global.php";
ini_set("display_errors",1);
function customer($c){
    switch($c){
        case 4: return "2 B FARMS"; break;
        case 5: return "3-H DAIRY PROGRESS SITE"; break;
        case 6: return "ABENGOA BIOENERGY CORP"; break;
        case 239: return "ADELANIE FARMS"; break;
        case 7: return "ANDY DYT DAIRY"; break;
        case 8: return "ARROYO DAIRY"; break;
        case 231: return "ARROYO DESLUDGE/LAGOON"; break;
        case 9: return "A-TEX DAIRY"; break;
        case 10: return "AURORA ORGANIC DAIRY"; break;
        case 250: return "Backwards 7 L Cattle Comp"; break;
        case 11: return "BAILEY COUNTY FEEDER"; break;
        case 12: return "BAR G RANCH, LLC"; break;
        case 235: return "BATISTA DAIRY"; break;
        case 13: return "BEETSTRA FAMILY DAIRY"; break;
        case 14: return "BENDORA DAIRY, LLC."; break;
        case 15: return "BLACKRIDGE DAIRY"; break;
        case 16: return "BONESTROO &amp; SONS II"; break;
        case 17: return "BOS DAIRY"; break;
        case 18: return "BOS DAIRY LLC NORTH"; break;
        case 19: return "BOVINA DAIRY"; break;
        case 230: return "BRAND WEST DAIRY"; break;
        case 20: return "BREEDYK DAIRY"; break;
        case 209: return "CABALLERO FARMS"; break;
        case 21: return "CADILLAC RANCH"; break;
        case 221: return "CAL-STAR DAIRY"; break;
        case 22: return "CALVA PRODUCTS INCORPORATED"; break;
        case 23: return "CAPROCK DAIRY"; break;
        case 24: return "CASH MISC SALES / CORONA"; break;
        case 25: return "CASWELL CATTLE CO."; break;
        case 26: return "CHARLIE TADEMA CATTLE CO."; break;
        case 252: return "CHASE FARMS"; break;
        case 27: return "CHEYENNE DAIRY"; break;
        case 195: return "CHEYENNE #3"; break;
        case 28: return "CIRCLE BAR HEIFER RANCH"; break;
        case 29: return "CIRCLE T DAIRY / TX"; break;
        case 30: return "CJM FARMS"; break;
        case 31: return "COCHRAN COUNTY FEEDYARD"; break;
        case 32: return "CONTECH CONSTRUCTION/PA"; break;
        case 33: return "COOPER LEGACY DAIRY"; break;
        case 220: return "CORRALES DAIRY"; break;
        case 241: return "CORRALES STORAGE"; break;
        case 34: return "CORY MARSH"; break;
        case 35: return "COTTONWOOD SPRINGS DAIRY LLC"; break;
        case 242: return "CNOSSEN DAIRY"; break;
        case 36: return "CREEKSIDE"; break;
        case 219: return "CREEKSIDE HEIFER"; break;
        case 37: return "CROSS COUNTRY DAIRY"; break;
        case 38: return "CROSSWINDS DAIRY/NM"; break;
        case 39: return "D&amp;J DAIRY"; break;
        case 40: return "DAIRICONCEPTS,L.P."; break;
        case 41: return "DAIRY FARMERS OF AMERICA"; break;
        case 42: return "DAIRYLAND CATTLE CO."; break;
        case 43: return "DAY-STAR DAIRY"; break;
        case 44: return "DE GROOT DAIRY"; break;
        case 45: return "DE MAIO FEEDLOT"; break;
        case 46: return "DEERFIELD DAIRY, LLC"; break;
        case 47: return "DEL RIO DAIRY/TX"; break;
        case 48: return "DEMAIO FARM &amp; RANCH, INC."; break;
        case 49: return "DEXTER DAIRY"; break;
        case 193: return "DEXTER (LAGOON/DESLUDGE)"; break;
        case 240: return "DEXTER STORAGE"; break;
        case 246: return "DIAMOND CATTLE FEEDERS"; break;
        case 50: return "DICK DYKSTRA"; break;
        case 51: return "DIMMIT VET CLINIC"; break;
        case 52: return "DO-RENE DAIRY"; break;
        case 53: return "DOUBLE D DAIRY"; break;
        case 54: return "DOUBLE D FARMS"; break;
        case 55: return "DUTCH VALLEY FARMS"; break;
        case 56: return "EL DORADO DAIRY"; break;
        case 57: return "ELVISTO DAIRY #2"; break;
        case 194: return "EPICENTER"; break;
        case 58: return "EVERGREEN FARMS"; break;
        case 59: return "F&amp;S LIVESTOCK"; break;
        case 222: return "FB LARIAT DAIRY"; break;
        case 60: return "FLATLAND FEEDS"; break;
        case 215: return "FLOYD - SYRACUSE DAIRY"; break;
        case 61: return "FOX DAIRY, LTD."; break;
        case 62: return "FRANK SOUZA DAIRY"; break;
        case 63: return "FRISIA WEST, LLC. **BK-11**"; break;
        case 64: return "G H DAIRY"; break;
        case 65: return "GOFF DAIRY"; break;
        case 66: return "GOLD STAR DAIRY LLC"; break;
        case 67: return "GRANDE VIDA DAIRY, LLC"; break;
        case 68: return "H &amp; R WESTRA"; break;
        case 69: return "HAAKMA &amp; SONS DAIRY"; break;
        case 70: return "HARKINS CATTLE"; break;
        case 71: return "HARMSEN FAMILY DAIRY"; break;
        case 72: return "HART DAIRY # 1"; break;
        case 73: return "HART DAIRY #2"; break;
        case 74: return "HEARTLAND LIVESTOCK"; break;
        case 75: return "HERITAGE DAIRY-NEW MEXICO"; break;
        case 76: return "HERRING FARMS"; break;
        case 205: return "HI-PRO (QLF)"; break;
        case 77: return "HI PLAINS FEED, LLC"; break;
        case 78: return "HIGH PLAINS DAIRY, LLC"; break;
        case 79: return "HIGH PLAINS RANCH, LLC"; break;
        case 80: return "IMPERIAL WESTERN PRODUCTS"; break;
        case 81: return "INTERNATIONAL INGREDIENT CORP."; break;
        case 202: return "IWP ABENGOA STORAGE"; break;
        case 245: return "IWP BUSHLAND STORAGE"; break;
        case 204: return "IWP HUGOTON STORAGE"; break;
        case 208: return "IWP JOHNSON CITY STORAGE"; break;
        case 201: return "IWP PORTALES STORAGE"; break;
        case 200: return "IWP ROSWELL STORAGE"; break;
        case 203: return "IWP TEXICO STORAGE"; break;
        case 236: return "J.D. HEISKELL/FREIGHT"; break;
        case 82: return "JAMES &amp; JOHN JONGSMA DAIRY"; break;
        case 83: return "JAMES IDSINGA DAIRY"; break;
        case 84: return "JAQUES DAIRY/CHINO"; break;
        case 85: return "JESKO CAPROCK RANCH"; break;
        case 86: return "JIM GRAY LIVESTOCK"; break;
        case 87: return "JIM PAT CLAUNCH"; break;
        case 88: return "JOHN BORBA &amp; SONS DAIRY"; break;
        case 89: return "JT CATTLE CO."; break;
        case 90: return "KEITH WATSON"; break;
        case 91: return "KETZNER FEEDS LLC"; break;
        case 92: return "KEVIN URBANCZYK"; break;
        case 232: return "KOLB MEYER"; break;
        case 243: return "LAMESA DELINTING"; break;
        case 93: return "LAKESIDE DAIRY"; break;
        case 94: return "LAND O' LAKES A/P DEPT"; break;
        case 95: return "LARIOT DAIRY, INC"; break;
        case 223: return "LAS UVAS VALLEY DAIRY"; break;
        case 96: return "LAZBUDDIE FEEDERS, LTD"; break;
        case 97: return "LEGACY FARMS, LP"; break;
        case 98: return "LEPRINO FOODS"; break;
        case 99: return "LOMA VISTA DAIRY"; break;
        case 229: return "DON'T USE LYLE FRAZE STORAGE"; break;
        case 100: return "MACO IMPORT &amp; EXPORT, INC"; break;
        case 101: return "MAJESTIC #2"; break;
        case 102: return "MANNA DAIRY"; break;
        case 103: return "MARIE MINABERRY DAIRY"; break;
        case 224: return "MATHEWS DAIRY"; break;
        case 104: return "MARVO HOLSTEINS DAIRY"; break;
        case 105: return "MASCOW DAIRY"; break;
        case 106: return "MCCLAIN FEED YARD"; break;
        case 107: return "MESA INGREDIENT"; break;
        case 108: return "MESMAN DAIRY FARM"; break;
        case 109: return "MICHEL MINABERRY DAIRY"; break;
        case 110: return "MIDWAY DAIRY"; break;
        case 111: return "MILKY WAY DAIRY / TX"; break;
        case 112: return "MILKY WAY DAIRY LLC"; break;
        case 113: return "MISC CASH SALE / NM"; break;
        case 114: return "MISC CASH SALE / OK"; break;
        case 115: return "MISC CASH SALE / TEXAS"; break;
        case 116: return "MISC CASH SALES / KANSAS"; break;
        case 117: return "MISSION DAIRY"; break;
        case 216: return "MORTON COUNTY - SYRACUSE DAIRY"; break;
        case 118: return "MULESHOE FEEDERS, INC."; break;
        case 225: return "N&amp;N DAIRY"; break;
        case 119: return "NATURE'S DAIRY"; break;
        case 120: return "NEW TEX FEEDYARD INC."; break;
        case 244: return "NORTHFORK FEEDYARD"; break;
        case 121: return "NORTH MULESHOE DAIRY"; break;
        case 122: return "NORTH STAR DAIRY"; break;
        case 123: return "NORTHSTAR DAIRY"; break;
        case 124: return "NORTHVIEW DAIRY"; break;
        case 125: return "OASIS DAIRY FARMS INC."; break;
        case 234: return "OASIS DAIRY FARMS INC. (LAGOON/DESLUDGE)"; break;
        case 206: return "OPPLIGER CATTLE COMPANY"; break;
        case 126: return "OPPORTUNITY DAIRY, LLC"; break;
        case 127: return "OUTLOOK DAIRY"; break;
        case 128: return "P7, LLC"; break;
        case 129: return "PAHRUMP DAIRY"; break;
        case 238: return "PALLA INC"; break;
        case 247: return "PAR 5"; break;
        case 130: return "PASTIME LAKES"; break;
        case 131: return "PETE VANDERHAM"; break;
        case 248: return "Phillip Smith"; break;
        case 132: return "PLAINVIEW FEEDERS II, INC"; break;
        case 133: return "PRAIRIE VIEW"; break;
        case 227: return "PREMIER ALFALFA"; break;
        case 134: return "PRESIDIO FARMS LLC"; break;
        case 196: return "PRO AM"; break;
        case 135: return "PRO SERVE FEEDS"; break;
        case 136: return "QUALITY LIQUID FEEDS/CLOVIS"; break;
        case 137: return "QUALITY LIQUID FEEDS/HOLLYPLNT"; break;
        case 138: return "QUESO GRANDE DAIRY"; break;
        case 139: return "RED ROCK DAIRY"; break;
        case 140: return "RIDGECREST DAIRY"; break;
        case 141: return "RIVER VALLEY DAIRY,LLC"; break;
        case 142: return "ROBIN FARMS"; break;
        case 143: return "ROCKHILL DAIRY"; break;
        case 192: return "ROCKHILL (LAGOON/DESLUDGE)"; break;
        case 207: return "ROCKING HEIFER"; break;
        case 214: return "ROCKING HEIFER - JOHNSON"; break;
        case 144: return "ROCKY TOP DAIRY, LLC"; break;
        case 145: return "ROSWELL CALF RANCH"; break;
        case 146: return "ROUTE 77 DAIRY"; break;
        case 147: return "RUMA-LIC ANIMAL PRODUCTS"; break;
        case 148: return "RUSHELL FARMS"; break;
        case 149: return "S A S DAIRY"; break;
        case 150: return "SAM SOUSA DAIRY"; break;
        case 151: return "SCOTT JOHNSON FARM SVC."; break;
        case 152: return "SD FARMS"; break;
        case 153: return "SD FARMS II"; break;
        case 154: return "SEMINOLE GROWERS"; break;
        case 155: return "SHAWNEE DAIRY"; break;
        case 156: return "SIDELINE DAIRY, LLC."; break;
        case 226: return "SOUTHFORK DAIRY"; break;
        case 157: return "SOUTHERN SKIES DAIRY"; break;
        case 158: return "SPANISH HILLS COUNTRY CLUB"; break;
        case 159: return "SPRINGLAKE DAIRY, LLC"; break;
        case 160: return "STARRY NIGHT DAIRY"; break;
        case 161: return "STATE LINE FEEDERS"; break;
        case 162: return "STRAIN RANCH"; break;
        case 163: return "STRUIKMANS DAIRY"; break;
        case 164: return "STUEVE GOLD DAIRY"; break;
        case 165: return "SUNRISE FARMS"; break;
        case 166: return "SWAGER RANCH"; break;
        case 167: return "SYRACUSE DAIRY"; break;
        case 168: return "T J DAIRY"; break;
        case 169: return "T&amp;K DAIRY"; break;
        case 170: return "THREE AMIGOS DAIRY"; break;
        case 197: return "TIMELINE DAIRY"; break;
        case 171: return "TIM FOOTE CATTLE"; break;
        case 172: return "TODD &amp; HONEY POLING"; break;
        case 173: return "TRACK DAIRY, LLC"; break;
        case 233: return "TULS DAIRY"; break;
        case 174: return "UNITED DAIRYMEN OF ARIZONA"; break;
        case 175: return "VAN RYN JERSEY"; break;
        case 251: return "VALLEYVIEW DAIRY"; break;
        case 237: return "VAZ DAIRY"; break;
        case 176: return "VISTA GRANDE DAIRY"; break;
        case 177: return "W DIAMOND DAIRY"; break;
        case 218: return "WAGONBED DAIRY"; break;
        case 178: return "WALTERSCHEID HOLSTEINS"; break;
        case 179: return "WAYNE E. PALLA DAIRY"; break;
        case 199: return "WEBBER DAIRY"; break;
        case 210: return "WEBBER STORAGE"; break;
        case 180: return "WESLEY RUNYAN"; break;
        case 181: return "WEST TEX CATTLE FEEDER"; break;
        case 182: return "WESTERN STAR DAIRY"; break;
        case 198: return "WESTSIDE DAIRY"; break;
        case 228: return "WESTSIDE DAIRY TEXAS"; break;
        case 183: return "WESTWAY FEED PROD LLC/CLOVIS"; break;
        case 184: return "WESTWAY FEED PROD LLC/HEREFORD"; break;
        case 185: return "WESTWAY FEED PROD. / STRATFORD"; break;
        case 186: return "WESTWAY FEED PRODUCTS LLC"; break;
        case 187: return "WESTWAY FEED PRODUCTS LLC / CA"; break;
        case 188: return "WHITE RIVER RANCH"; break;
        case 189: return "WILD WEST FARMS"; break;
        case 211: return "WKP COMPOST"; break;
        case 190: return "WOODCREST DAIRY / NM"; break;
        case 191: return "ENTER NEW CUSTOMER"; break;
        default: return "N/A"; break;
            
            		
    }
}


?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <?php
        include "source/scripts.php";
        include "source/css.php";
    ?>
    <style type="text/css">
  

/*** Calendar


/*******************************Calendar Top Navigation*********************************/
div#calendar{
  margin:0px auto;
  padding:0px;
  width: 602px;
  font-family:Helvetica, "Times New Roman", Times, serif;
}
 
div#calendar div.box{
    position:relative;
    top:0px;
    left:0px;
    width:100%;
    height:40px;
    background-color:   #787878 ;      
}
 
div#calendar div.header{
    line-height:40px;  
    vertical-align:middle;
    position:absolute;
    left:11px;
    top:0px;
    width:582px;
    height:40px;   
    text-align:center;
}
 
div#calendar div.header a.prev,div#calendar div.header a.next{ 
    position:absolute;
    top:0px;   
    height: 17px;
    display:block;
    cursor:pointer;
    text-decoration:none;
    color:#FFF;
}
 
div#calendar div.header span.title{
    color:#FFF;
    font-size:18px;
}
 
 
div#calendar div.header a.prev{
    left:0px;
}
 
div#calendar div.header a.next{
    right:0px;
}
 
 
 
 
/*******************************Calendar Content Cells*********************************/
div#calendar div.box-content{
    height:1100px;
    width:100%;
    border:1px solid #787878 ;
    border-top:none;
}
 
 
 
div#calendar ul.label{
    float:left;
    margin: 0px;
    padding: 0px;
    margin-top:5px;
    margin-left: 5px;
}
 
div#calendar ul.label li{
    margin:0px;
    padding:0px;
    margin-right:5px;  
    float:left;
    list-style-type:none;
    width:80px;
    height:40px;
    line-height:40px;
    vertical-align:middle;
    text-align:center;
    color:#000;
    font-size: 15px;
    background-color: transparent;
}
 
 
div#calendar ul.dates{
    float:left;
    margin: 0px;
    padding: 0px;
    margin-left: 5px;
    margin-bottom: 5px;
}
 
/** overall width = width+padding-right**/
div#calendar ul.dates li{
    margin:0px;
    padding:0px;
    margin-right:5px;
    margin-top: 5px;
    line-height:80px;
    vertical-align:middle;
    float:left;
    list-style-type:none;
    width:160px;
    height:160px;
    font-size:25px;
    background-color: #DDD;
    color:#000;
    text-align:center; 
}
 
:focus{
    outline:none;
}
 
div.clear{
    clear:both;
}   

td{
    font-size:10px;
    border:1px solid black;
}
.ui-tooltip {
    background:#ccf;
}

  label {
    display: inline-block;
    width: 5em;
  }
  </style>
</style>
<?php
include "source/scripts.php";
include "source/css.php";
?>
<script>
 $( function() {
    $( ".tooltip" ).tooltip({
        items: '.tooltip',
        content: function () {
              return $(this).prop('title');
        },
        show: null, // show immediately
        open: function(event, ui)
    {
        if (typeof(event.originalEvent) === 'undefined')
        {
            return false;
        }
    
        var $id = $(ui.tooltip).attr('id');
    
        // close any lingering tooltips
        $('div.ui-tooltip').not('#' + $id).remove();
        
        // ajax function to pull in data and add it to the tooltip goes here
    },
    close: function(event, ui)
    {
        ui.tooltip.hover(function()
        {
            $(this).stop(true).fadeTo(400, 1); 
        },
        function()
        {
            $(this).fadeOut('400', function()
            {
                $(this).remove();
            });
        });
    }
});
  } );
</script> 
	<title>Untitled 1</title>
</head>

<body>


 
 <?php
 
 
class Calendar {  
     
    /**
     * Constructor
     */
    public function __construct(){     
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
     
    /********************* PROPERTY ********************/  
    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
     
    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate=null;
     
    private $daysInMonth=0;
     
    private $naviHref= null;
     
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
    public function show() {
        $year = "";
        $month ="";
        $year  == null;
         
        $month == null;
         
        if(null==$year&&isset($_GET['year'])){
 
            $year = $_GET['year'];
         
        }else if(null==$year){
 
            $year = date("Y",time());  
         
        }          
         
        if(null==$month&&isset($_GET['month'])){
 
            $month = $_GET['month'];
         
        }else if(null==$month){
 
            $month = date("m",time());
         
        }                  
         
        $this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year);  
         
        $content='<div id="calendar" style="width:90%;height:2000px;margin:auto;">'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay($i*7+$j);
                                    }
                                }
                                 
                                $content.='</ul>';
                                 
                                $content.='<div class="clear"></div>';     
             
                        $content.='</div>';
                 
        $content.='</div>';
        return $content;   
    }
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber){
         global $db;
        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                 
                $this->currentDay=1;
                 
            }
        }
         
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
             
            $cellContent = $this->currentDay;
            $name_of_day = date('D', strtotime($this->currentDate));
            $this->currentDay++;  
            
            $date = new DateTime("$this->currentDate");
            $day =  $date->format("w");
             
            if( $day == 5){
                $poc = $db->query("SELECT SUM(element_11) as week_totals FROM Inetforms.ap_form_11670 WHERE DATE(element_2) = DATE_SUB(DATE('$this->currentDate'), INTERVAL 5 DAY) GROUP BY DATE(element_2)");
                if(count($poc)>0){
                    $x = number_format($poc[0]['week_totals'],2);
                }else{
                    $x ="0";
                }
            }else{
                $x ="";
            } 
             
        }else{
             $name_of_day = "";
             $x = "";
             $this->currentDate =null;
             $cellContent=null;
        }
             
             
             
        
           
        $uiiui =  '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==null?'mask':'').'"><sub><a style="font-size:12px;float:left;" href="dailytotals.php?date='.$this->currentDate.'" rel="shadowbox">'.$cellContent.'</a>&nbsp;'.$name_of_day.'</sub><br/>'.$x; 
        $uiiui.= '</li>';
        return $uiiui;
    }
     
    /**
    * create navigation
    */
    private function _createNavi(){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
         
        return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }
         
    /**
    * create calendar week labels
    */
    private function _createLabels(){  
                 
        $content='';
         
        foreach($this->dayLabels as $index=>$label){
             
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
 
        }
         
        return $content;
    }
     
     
     
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
         
        if(null==($month)) {
            $month = date("m",time());
        }
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
         
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
         
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
             
            $numOfweeks++;
         
        }
         
        return $numOfweeks;
    }
 
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){
         
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
     
}

$calendar = new Calendar();
 echo "<h1>Click on a day to see daily totals </h1>";
echo $calendar->show();
 ?>
</body>
</html>