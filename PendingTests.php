<?php

include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
ini_set("display_errors",1);
$year = date("Y");
$now = date("m");

if(isset($_POST['date_sub'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "from":
                if(strlen( trim($value) )>0){
                    $arrFields[] = " date_created >='$value' ";   
                }
                
            break;
            case "to":
                if(strlen(trim($value))>0){
                     $arrFields[] = " date_created<='$value' ";    
                }
                
            break;
        }
    }
    $string = "";
    if(!empty($arrFields)){
        $string .= " AND ".implode(" AND ",$arrFields);   
    }
    //echo "SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_3 IN('Pending','pending retest') $string ";
    $pend = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_3 IN('Pending','pending retest') $string ");
}else{
    $pend = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_3 IN('Pending','pending retest') AND date_created >= ( CURDATE() - INTERVAL 2 DAY ) ");    
}




?>

<style type="text/css">
body{
    background:url(img/bodystrip.jpg) repeat-x left 7px;
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
    border:0px solid #bbb;  
   
    white-space: nowrap;
    
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
    border-spacing: 15px;
    border-collapse: separate;
}
input[type=checkbox]{
    width:10px;
}
</style>
   
<script>
Shadowbox.init();
$(document).ready(function(){    
   $('#myTable').dataTable({
        "order": [ 12, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>   
<div id="space_top" style="height:97px;width:100%;background:rgba(255,255,255,.4)"></div>
<form action="PendingTests.php" method="POST">
<table style="width: 80%;margin:auto;"><tr><td style="text-align: left;" rowspan="2"><img src="img/lab.jpg" style="height: 85px;width:100px;position:relative;"/></td><td style="text-align: left;"><input type="text" placeholder="From" name="from" id="from" value="<?php 
    if( isset($_POST['date_sub']) ) {  
            echo $_POST['from']; 
    } ?>"/></td></tr><tr><td style="text-align: left;"><input type="text" placeholder="To" name="to" id="to" value="<?php 
    if( isset($_POST['date_sub']) ) {  
            echo $_POST['to']; 
    } ?>" /></td></tr><tr><td colspan="2" style="text-align: right;"><input type="submit" value="Submit" name="date_sub"/></td></tr></table></form>
<table style="width: 100%;margin:auto;"  id="myTable"  style="width: 80%;margin:auto;margni-top:10px;">
    <thead>
  
    <tr>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <th>Req Id</th>
    <td>Origination</td>
    <th>Status</th>
   
    <th>Truck Request</th>
    <th>Weight Ticket</th>
    <th>Release/Sale #</th>
    <th>Inbound WC</th>
    <th>Notes</th>
    <th>Request Date</th>
    <th>Requestor</th>
    <th>Area</th>
    <th>Type</th>
    <th>Tank</th>
    <th>SPOT #</th>    
    <th>Original Lab Results</th>
    </tr>
    </thead>
    <tbody>
    <?php 
        if(count($pend)>0){
            foreach($pend as $entry){    
                $type="";
                $tank="";
                $snumber="";
                $area = "";
                switch($entry['element_12']){
                    case 1:
                        $reactor = "Before Stage 1";
                    break;
                    case 2:
                        $reactor = "After Stage 1";
                    break;
                    case 3:
                        $reactor = "GC";
                    break;
                }
                
                
                switch($entry['source']){
                    case "from_tcl":
                    
                        if(strlen(trim($entry['element_76']))>0){
                            
                        
                            $tcl = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE ap_form_43256.id = $entry[element_76]");
                            if(count($tcl)>0){
                                switch($tcl[0]['element_1']){
                                    case 1://Inbound
                                         //********** AREA TRANSLATOR****************//
                                        switch($tcl[0]['element_16']){
                                            case 7:
                                                $area ="Agape Transportation";
                                            break;
                                            case 26:
                                                $area ="Bimbo";
                                            break;
                                            case 21:
                                                $area ="Brenntag";
                                            break;
                                            case 28:
                                                $area ="Connection Chemical";
                                            break;
                                            case 23:
                                                $area ="Giralds";
                                            break;
                                            case 17:
                                                $area ="IWP/AZ";
                                            break;
                                            case 14:
                                                $area ="IWP/Mira Loma";
                                            break;
                                            case 15:
                                                $area ="IWP/Selma";
                                            break;
                                            case 27:
                                                $area ="Kinder Morgan";
                                            break;
                                            case 11:
                                                $area ="LVO";
                                            break;
                                            case 22:
                                                $area ="Nexeo";
                                            break;
                                            case 8:
                                                $area ="North Star Recycling";
                                            break;
                                            case 10:
                                                $area ="Sara Lee";
                                            break;
                                            case 20:
                                                $area ="Schaffner";
                                            break;
                                            case 18:
                                                $area ="Sparkletts";
                                            break;
                                            case 16:
                                                $area ="TARR";
                                            break;
                                            case 25:
                                                $area ="VDFC Victorville";
                                            break;
                                            case 24:
                                                $area ="Ventura Foods Co";
                                            break;
                                            case 1:
                                                $area ="Verhoeven";
                                            break;
                                            case 12:
                                                $area ="Victorville DC";
                                            break;
                                            case 9:
                                                $area ="Other";
                                            break;
                                        }
                                        
                                        //********** AREA TRANSLATOR****************//
                                        //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_14']){
                                            case 6: $type = " Ground Shell"; break;
                                            case 13: $type = "Almond Meal"; break;
                                            case 18: $type = "Bakery"; break;
                                            case 25: $type = "Candy"; break;
                                            case 10: $type = "Chocolate"; break;
                                            case 24: $type = "Clear Diesel"; break;
                                            case 7: $type = "Dehy Bakery"; break;
                                            case 21: $type = "Dressing"; break;
                                            case 11: $type = "Food Waste"; break;
                                            case 17: $type = "Fat Lint"; break;
                                            case 12: $type = "Lint"; break;
                                            case 8:  $type = "Mayo"; break;
                                            case 14: $type = "Methanol"; break;
                                            case 23: $type = "peanut Butter"; break;
                                            case 20: $type = "Sodium Hydroxide"; break;
                                            case 22: $type = "Sulferic Acid"; break;
                                            case 15: $type = "Water"; break;
                                            case 16: $type = "WCS"; break;
                                            case 9: $type = "Other"; break;
                                        }
                                        //****TYPE TRANSLATOR************//
                                        
                                        
                                       
                                    break;
                                    case 2://Inbound Grease
                                       //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_38']){
                                            case 1:
                                                $type = "Brown Grease";
                                            break;
                                            case 2:
                                                $type =  "Other";
                                            break;
                                            case 4:
                                                $type =  "UCO";
                                            break;
                                        }
                                        //****TYPE TRANSLATOR************//
                                        
                                        
                                        //************ AREA TRANSLATOR ********************//                            
                                        switch($tcl[0]['element_40']){
                                            case 18:
                                                $area="4-DIV (AZ)";
                                            break;
                                            case 22:
                                                $area="A-1(AZ)";
                                            break;
                                            case 20:
                                                $area="AZ Grease Services";
                                            break;
                                            case 30:
                                                $area="AZ Grease Services";
                                            break;
                                            case 26:
                                                $area="BA Glenn (AZ)";
                                            break;
                                            case 20:
                                                $area="Crown";
                                            break;
                                            case 27:
                                                $area="Crown (drums)";
                                            break;
                                            case 29:
                                                $area="GT";
                                            break;
                                            case 23:
                                                $area="JN Grease";
                                            break;
                                            case 28:
                                                $area="L-DIV";
                                            break;
                                            case 17:
                                                $area="LSW(SoCal)";
                                            break;
                                            case 33:
                                                $area="Pipe Maintenance";
                                            break;
                                            case 16:
                                                $area="RE";
                                            break;
                                            case 15:
                                                $area="ReNu(NV)";
                                            break;
                                            case 25:
                                                $area="RH";
                                            break;
                                            case 12:
                                                $area="RTI(LA)";
                                            break;
                                            case 31:
                                                $area="S&K (AZ)";
                                            break;
                                            case 32:
                                                $area="Safeway";
                                            break;
                                            case 19:
                                                $area="SMC";
                                            break;
                                            case 21:
                                                $area="U-DIV";
                                            break;
                                            case 24:
                                                $area="U-DIV (ML)";
                                            break;
                                            
                                            case 34:
                                                $area="US Oil";
                                            break;
                                            
                                            case 11:
                                                $area="Other";
                                            break;
                                        }
                                        //************ AREA TRANSLATOR ********************//
                                        $tank = $tcl[0]['element_48'];
                                    break;
                                    case 3://Inbound WCS
                                        $snumber=$tcl[0]['element_36'];
                                        //************ AREA TRANSLATOR ********************//
                                        switch($tcl[0]['element_26']){
                                            case 1:
                                                $area = "WCS";
                                            break;
                                            case 2:
                                                $area = "Other";
                                            break;
                                        }
                                        //************ AREA TRANSLATOR ********************//
                                        
                                        //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_28']){
                                            case 1:
                                                $type = "Modern";
                                            break;
                                            case 2:
                                                $type =  "Other";
                                            break;
                                            case 3:
                                                $type =  "Third Option";
                                            break;
                                        }
                                        //****TYPE TRANSLATOR************//
                                    break;
                                    case 4://Outbound
                                        $snumber=$tcl[0]['element_73'];
                                        //************ AREA TRANSLATOR ********************//
                                        switch($tcl[0]['element_64']){
                                            case 1:
                                                $area = "B+E";
                                            break;
                                            case 10:
                                                $area = "Chino Valley";
                                            break;
                                            case 13:
                                                $area =  "Dutch";
                                            break;
                                            case 8:
                                                $area =  "Frank Konyn";
                                            break;
                                            case 7:
                                                $area =  "Hinkley";
                                            break;
                                            case 5:
                                                $area =  "IWP (ML)";
                                            break;
                                            case 9:
                                                $area =  "IWP (Selma)";
                                            break;
                                            case 12:
                                                $area =  "Marie Minaberry";
                                            break;
                                            case 14:
                                                $area =  "Perez Beltran";
                                            break;
                                            case 4:
                                                $area =  "Schaffner";
                                            break;
                                            case 1:
                                                $area =  "Verhoeven";
                                            break;
                                            case 6:
                                                $area =  "West Star North";
                                            break;      
                                            case 2:
                                                $area = "Other";
                                            break;
                                        }
                                        //************ AREA TRANSLATOR ********************//
                                        //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_62']){
                                            case 1:
                                                $type = "Ammoniated Ground Pima";
                                            break;
                                            case 2:
                                                $type =  "Bakery";
                                            break;
                                            case 4:
                                                $type =  "Fat Lint";
                                            break;   
                                             case 5:
                                                $type =  "Ground Pima";
                                            break;    
                                             case 7:
                                                $type =  "TR/CS";
                                            break;    
                                             case 8:
                                                $type =  "WCS";
                                            break;    
                                             case 3:
                                                $type =  "Other";
                                            break;                                                                                             
                                        }
                                        //****TYPE TRANSLATOR************//
                                        
                                        
                                    break;
                                    case 5:   //Outbound MX                         
                                         //************ AREA TRANSLATOR ********************//
                                         $snumber=$tcl[0]['element_86'];
                                         switch($tcl[0]['element_77']){
                                            case 1:
                                                $area="Isidro Valdez/Gandera Mexicali";
                                            break;
                                            case 6:
                                                $area="Productos Y Subproductos";
                                            break;
                                            case 4:
                                                $area="Schaffner";
                                            break;
                                            case 5:
                                                $area="West Star North";
                                            break;
                                            case 2:
                                                $area="Other";
                                            break;
                                         }
                                         //************ AREA TRANSLATOR ********************//
                                    
                                         //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_75']){
                                            case 1:
                                                $type = "Bakery";
                                            break;
                                            case 2:
                                                $type =  "Brown Grease";
                                            break;
                                            case 3:
                                                $type =  "Glycerin";
                                            break;
                                            case 4:
                                                $type =  "P&G Oil";
                                            break;
                                            case 6:
                                                $type =  "TR/CS";
                                            break;
                                            case 7:
                                                $type =  "Other";
                                            break;
                                        }
                                        //****TYPE TRANSLATOR************//
                                    break;
                                    case 6://Outbound Bio                            
                                        //************ AREA TRANSLATOR ********************//
                                        switch($tcl[0]['element_90']){
                                            case 1:
                                                $area ="#16 Solid Plant";
                                            break;
                                            case 46:
                                                $area ="Apple Recycling";
                                            break;
                                            case 4:
                                                $area ="B-DIV to L-DIV";
                                            break;
                                            case 52:
                                                $area ="B-DIV to BBC Tank";
                                            break;
                                            case 26:
                                                $area ="BBC Tank";
                                            break;
                                            case 32:
                                                $area ="Biosphere";
                                            break;
                                            case 38:
                                                $area ="Bill Kurr";
                                            break;
                                            case 23:
                                                $area ="BFWMR";
                                            break;
                                            case 5:
                                                $area ="Boral (Lathrop)";
                                            break;
                                            case 49:
                                                $area ="Boral Rialto";
                                            break;
                                            case 15:
                                                $area ="Boral (PHX)";
                                            break;
                                            case 47:
                                                $area ="City of Camarillo";
                                            break;
                                            case 11:
                                                $area ="CoWest";
                                            break;
                                            case 6:
                                                $area ="Cheveron";
                                            break;
                                            case 13:
                                                $area ="Eagle (Stockton)";
                                            break;
                                            case 51:
                                                $area ="Everlast Industries";
                                            break;
                                            case 9:
                                                $area ="Flyers";
                                            break;
                                            case 24:
                                                $area ="Forterra Pipe & Precast";
                                            break;
                                            case 34:
                                                $area ="G-DIV to B-DIV";
                                            break;
                                            case 17:
                                                $area ="Half Tank 17 to Lint";
                                            break;
                                            case 18:
                                                $area ="Half Tank 19 to Lint";
                                            break;
                                            case 42:
                                                $area ="Half Tank I to Lint";
                                            break;
                                            case 41:
                                                $area ="Half Tank J to Lint";
                                            break;
                                            case 40:
                                                $area ="Half Tank K to Lint";
                                            break;
                                            case 39:
                                                $area ="Half Tank L to Lint";
                                            break;
                                            case 30:
                                                $area ="Half Tank M to Lint";
                                            break;
                                            case 29:
                                                $area ="Half Tank N to Lint";
                                            break;
                                            case 28:
                                                $area ="Half Tank O to Lint";
                                            break;
                                            case 22:
                                                $area ="IWP (ML)";
                                            break;
                                            case 50:
                                                $area ="Kettle #2 to Half Tank N";
                                            break;
                                            case 48:
                                                $area ="L-DIV to G-DIV";
                                            break;
                                            case 25:
                                                $area ="Lint to Half Tank A";
                                            break;
                                            case 21:
                                                $area ="McNeece";
                                            break;
                                            case 8:
                                                $area ="Musket";
                                            break;
                                            case 12:
                                                $area ="North Central";
                                            break;
                                            case 33:
                                                $area ="Oil Services";
                                            break;
                                            case 27:
                                                $area ="Pete's Road Service";
                                            break;
                                            case 7:
                                                $area ="PBF Holding";
                                            break;
                                            case 16:
                                                $area ="Ramirez Pallets";
                                            break;
                                            case 37:
                                                $area ="Rio Valley Pipe";
                                            break;
                                            case 14:
                                                $area ="Rocky Mountain";
                                            break;
                                            case 31:
                                                $area ="SA Recycling";
                                            break;
                                            case 20:
                                                $area ="Sellers Petroleum";
                                            break;
                                            case 45:
                                                $area ="Tank J to Lint";
                                            break;
                                            case 44:
                                                $area="Tank K to Lint";
                                            break;
                                            case 43:
                                                $area="Tank L to Lint";
                                            break;
                                            case 35:
                                                $area="Tank 18 to Lint";
                                            break;
                                            case 19:
                                                $area="Tank 20 to Lint";
                                            break;
                                            case 36:
                                                $area="Tech lenexa";
                                            break;
                                            case 10:
                                                $area="Tesoro";
                                            break;
                                            case 2:
                                                $area="Other";
                                            break;                                
                                        }
                                        //************ AREA TRANSLATOR ********************//
                                    
                                         //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_88']){
                                            case 1:
                                                $type = "B20";
                                            break;
                                            case 15:
                                                $type =  "B80 CLEAR";
                                            break;
                                            case 12:
                                                $type =  "B 99.9";
                                            break;
                                            case 20:
                                                $type =  "B 99.9 CLEAR";
                                            break;
                                            case 11:
                                                $type =  "B 99.9 RED";
                                            break;
                                            case 5:
                                                $type =  "B100";
                                            break;
                                            case 8:
                                                $type =  "Candy";
                                            break;
                                            case 5:
                                                $type =  "B100";
                                            break;
                                            case 13:
                                                $type =  "Cardboard";
                                            break;
                                            case 2:
                                                $type =  "Esters";
                                            break;
                                            case 4:
                                                $type =  "E44";
                                            break;
                                            case 7:
                                                $type =  "E46";
                                            break;
                                            case 6:
                                                $type =  "FFA's";
                                            break;
                                            case 23:
                                                $type =  "FIN Glycerin";
                                            break;
                                            case 17:
                                                $type =  "Glycerin";
                                            break;
                                            case 18:
                                                $type =  "Glycerin /w Methanol";
                                            break;
                                            
                                             case 21:
                                                $type =  "Low Acid UCO";
                                            break;
                                             case 14:
                                                $type =  "Lubricants";
                                            break;
                                             case 22:
                                                $type =  "Mayo Solids";
                                            break;
                                             case 16:
                                                $type =  "Recovery Oil";
                                            break;
                                             case 19:
                                                $type =  "Scrap Metal";
                                            break;
                                             case 10:
                                                $type =  "Solids";
                                            break;
                                             case 3:
                                                $type =  "Other";
                                            break;                                 
                                        }
                                        //****TYPE TRANSLATOR************//
                                    break;
                                    case 7:// Outbound MX Grease                           
                                         //************ AREA TRANSLATOR ********************//
                                         switch($tcl[0]['element_102']){
                                            case 1:
                                                $area ="Butterspur";
                                            break;
                                            case 6:
                                                $area ="Foster";
                                            break;
                                            case 5:
                                                $area ="Mesquite";
                                            break;
                                            case 2:
                                                $area ="Other";
                                            break;
                                         }
                                         //************ AREA TRANSLATOR ********************//
                                        
                                        //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_100']){
                                            case 1:
                                                $type = "CO WEST YELLOW GREASE";
                                            break;
                                            case 4:
                                                $type =  "YELLOW GREASE";
                                            break;
                                            case 3:
                                                $type =  "Other";
                                            break;
                                        }
                                        //****TYPE TRANSLATOR************//
                                        
                                        
                                        //*****TANK TRANSLATOR*********//
                                        $tank = $tcl[0]['element_112'];
                                       //*****TANK TRANSLATOR*********// 
                                    break;
                                    case 8:  //R - Water                          
                                        //************ AREA TRANSLATOR ********************//
                                        switch($tcl[0]['element_50']){
                                            case 1:
                                                $area ="Boiler (cw)";
                                            break;
                                            case 4:
                                                $area ="B-DIV (WW)";
                                            break;
                                            case 2:
                                                $area ="G-DIV (WW)";
                                            break;
                                            case 5:
                                                $area ="Spent Earth";
                                            break;
                                            case 3:
                                                $area ="Other";
                                            break;
                                        }
                                        //************ AREA TRANSLATOR ********************//
                                        $type ="Reclaimed Water";
                                        $tank = $tcl[0]['element_60'];
                                    break;
                                    case 9://Pet Food
                                        
                                        //************ AREA TRANSLATOR ********************//
                                        switch($tcl[0]['element_131']){
                                            case 1:
                                                $area="Sparks, NV";
                                            break;
                                            case 2:
                                                $area="Other";
                                            break;                                
                                        }
                                        
                                        //************ AREA TRANSLATOR ********************//
                                        
                                        //****TYPE TRANSLATOR************//
                                        switch($tcl[0]['element_129']){
                                            case 1:
                                                $type = "ByProduct Ext Boxed";
                                            break;
                                            case 3:
                                                $type =  "Other";
                                            break;
                                            case 4:
                                                $type =  "Corrugated";
                                            break;
                                            case 5:
                                                $type =  "PP Bags";
                                            break;
                                            case 6:
                                                $type =  "Compost";
                                            break;
                                            case 7:
                                                $type =  "Waste to Energy";
                                            break;
                                        }
                                        //****TYPE TRANSLATOR************//
                                    break;
                                }
                            } 
                        
                        }
                    break;
                    case "from_osr":
                        $osr = $db->query("SELECT * FROM Inetforms.ap_form_47049 WHERE ap_form_47049.id = $entry[element_16]");
                        $area = $entry['element_11'];
                        if(count($osr)>0){
                             switch( $osr[0]['element_39']){                       
                                case 1:              //Reactor                            
                                      
                                    //****TYPE TRANSLATOR************//
                                    switch($osr[0]['element_42']){
                                        case 1:
                                            $type = "Before Stage 1";
                                        break;
                                        case 2:
                                            $type =  "After Stage 1";
                                        break;
                                        case 3:
                                            $type =  "GC";
                                        break;
                                        case 4:
                                            $type = "Before Stage 2";
                                        break;
                                        case 5:
                                            $type = "After Stage 2";
                                        break;
                                        case 6:
                                            $type = "RS-108";
                                        break;
                                        case 7:
                                            $type = "RS-109";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//   
                                    
                                  //*****TANK TRANSLATOR*********//
                                    switch($osr[0]['element_43']){
                                        case 1:
                                            $tank = "Reactor #: R101";
                                        break;
                                        case 2:
                                            $tank = "Reactor #: R102";
                                        break;    
                                        case 3:
                                            $tank = "Reactor #: R103";
                                        break;
                                        case 4:
                                            $tank = "Reactor #: R104";
                                        break;
                                        case 5:
                                            $tank = "Reactor #: R105";
                                        break;
                                        case 6:
                                            $tank = "Reactor #: R106";
                                        break;
                                        case 7:
                                            $tank = "Reactor #: R10";
                                        break;
                                        case 8:
                                            $tank = "Reactor #: R11";
                                        break;
                                        case 9:
                                            $tank = "R10 FFA/MIU";
                                        break;
                                        case 10:
                                            $tank = "R11 FFA";
                                        break;
                                    }
                                   //*****TANK TRANSLATOR*********//   
                                   
                                   //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_44']){
                                        case 1:
                                            $snumber ="S1";
                                        break;
                                        case 2:
                                             $snumber ="S2";
                                        break;
                                        case 3:
                                             $snumber ="S3";
                                        break;
                                        case 4:
                                             $snumber ="S4";
                                        break;
                                        case 5:
                                             $snumber ="S5";
                                        break;
                                        case 6:
                                             $snumber ="S6";
                                        break;
                                    }
                                     //****** SPOT NUMBER TRANSLATOR************//
                                   
                                break;
                                case 2://glycerin
                                
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_48']){
                                        case 1:
                                            $snumber ="S1";
                                        break;
                                        case 2:
                                             $snumber ="S2";
                                        break;
                                        case 3:
                                             $snumber ="S3";
                                        break;
                                        case 4:
                                             $snumber ="S4";
                                        break;
                                        case 5:
                                             $snumber ="S5";
                                        break;
                                        case 6:
                                             $snumber ="S6";
                                        break;
                                    }
                                     //****** SPOT NUMBER TRANSLATOR************//
                                
                                    //****TYPE TRANSLATOR************//
                                    switch($osr[0]['element_46']){
                                        case 1:
                                            $type =  "Acidulated Dried";
                                        break;
                                        case 2:
                                            $type =  "Acidulated Not Dried";
                                        break;
                                        case 3:
                                            $type =  "Raw";
                                        break;
                                        case 4:
                                            $type = "FFAs";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//
                                    
                                    //*****TANK TRANSLATOR*********//
                                      switch($osr[0]['element_47']){
                                        case 1:
                                            $tank = "Dryer";
                                        break;
                                        case 2:
                                            $tank = "Still";
                                        break;    
                                        case 3:
                                            $tank = "New Dryer";
                                        break;
                                        case 4:
                                            $tank = "Holding 1";
                                        break;
                                        case 5:
                                            $tank = "Holding 2";
                                        break;
                                        case 6:
                                            $tank = "Tank 9";
                                        break;
                                        case 7:
                                            $tank = "GS-1";
                                        break;
                                        case 8 :
                                            $tank = "Holding 5";
                                        break;
                                        case 9:
                                            $tank = "ME-10";
                                        break;
                                        case 10:
                                            $tank = "Sep 2B";
                                        break;
                                        case 11:
                                            $tank = "Sep C";
                                        break;
                                        case 12:
                                            $tank = "GS-3";
                                        break;
                                        
                                        case 13:
                                            $tank = "FFA-1";
                                        break;
                                        case 14:
                                            $tank = "FFA-2";
                                        break;
                                        
                                      }
                                   //*****TANK TRANSLATOR*********//
                                break;
                                case 3://water condenser
                                    
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_51']){
                                        case 1:
                                            $snumber ="S1";
                                        break;
                                        case 2:
                                             $snumber ="S2";
                                        break;
                                        case 3:
                                             $snumber ="S3";
                                        break;
                                        case 4:
                                             $snumber ="S4";
                                        break;
                                        case 5:
                                             $snumber ="S5";
                                        break;
                                        case 6:
                                             $snumber ="S6";
                                        break;
                                        case 7:
                                             $snumber ="S7";
                                        break;
                                        case 8:
                                             $snumber ="S8";
                                        break;
                                        case 9:
                                             $snumber ="S9";
                                        break;
                                    }
                                     //****** SPOT NUMBER TRANSLATOR************//
                                
                                     //*****TANK TRANSLATOR*********//
                                      switch($osr[0]['element_50']){
                                        case 1:
                                            $tank = "Tank 1";
                                        break;
                                        case 2:
                                            $tank = "Tank 2";
                                        break;    
                                        case 3:
                                            $tank = "Tank 3";
                                        break;
                                        case 4:
                                            $tank = "Tank 4";
                                        break;
                                        
                                       
                                      }
                                   //*****TANK TRANSLATOR*********//
                                break;
                                case 4://Distiillation
                                    //********************* TYPE *************************//
                                    switch($osr[0]['element_53']){
                                        case 1: $type =  "WW"; break;
                                        case 2: $type =  "BC"; break;
                                        case 3: $type =  "PC"; break;
                                        break;
                                    }
                                    //********************* TYPE *************************//
                                    
                                    //********************* TANK**************************//
                                    switch($osr[0]['element_54']){
                                        case 1:
                                            $tank = "Tank 1";
                                        break;
                                        case 2:
                                            $tank = "Tank 2";
                                        break;    
                                        case 3:
                                            $tank = "Tank 3";
                                        break;
                                        case 4:
                                            $tank = "Tank 5";
                                        break;
                                        case 5:
                                            $tank = "TOP";
                                        break;
                                        case 6:
                                            $tank = "BOTTOM";
                                        break;
                                        case 7:
                                            $tank = "BC 1";
                                        break;
                                        case 8:
                                            $tank = "BC 2";
                                        break;
                                        case 9:
                                            $tank = "WW 7";
                                        break;                                         
                                         case 11:
                                            $tank = "WW 6";
                                        break;
                                         case 12:
                                            $tank = "WW 5";
                                        break;
                                         case 13:
                                            $tank = "WW 4";
                                        break;
                                         case 14:
                                            $tank = "WW 3";
                                        break;
                                         case 15:
                                            $tank = "WW 2";
                                        break;
                                         case 16:
                                            $tank = "WW 1";
                                        break;
                                         case 17:
                                            $tank = "PC 2";
                                        break;
                                         case 18:
                                            $tank = "PC 1";
                                        break;
                                    }
                                    //********************* TANK**************************//
                                    
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_55']){
                                        case 1:
                                            $snumber ="S1";
                                        break;
                                        case 2:
                                             $snumber ="S2";
                                        break;
                                        case 3:
                                             $snumber ="S3";
                                        break;
                                        case 4:
                                             $snumber ="S4";
                                        break;
                                        case 5:
                                             $snumber ="S5";
                                        break;
                                        case 6:
                                             $snumber ="S6";
                                        break;
                                    }
                                     //****** SPOT NUMBER TRANSLATOR************//
                                   
                                    
                                    
                                break;
                                
                                case 5://wash tanks
                                    
                                     //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_58']){
                                        case 1:
                                            $snumber ="S1";
                                        break;
                                        case 2:
                                             $snumber ="S2";
                                        break;
                                        case 3:
                                             $snumber ="S3";
                                        break;
                                        case 4:
                                             $snumber ="S4";
                                        break;
                                        case 5:
                                             $snumber ="S5";
                                        break;
                                        case 6:
                                             $snumber ="S6";
                                        break;
                                    }
                                     //****** SPOT NUMBER TRANSLATOR************//
                                     //****TYPE TRANSLATOR************//
                                    switch($osr[0]['element_57']){
                                       case 1:
                                            $tank = "Surge";
                                        break;
                                        case 2:
                                            $tank = "Separator 1";
                                        break;   
                                        case 3:
                                            $tank = "Separator 2";
                                        break; 
                                        case 4:
                                            $tank = "RFE";
                                        break;
                                        
                                        case 5:
                                            $tank = "Centrifuge";
                                        $break;
                                        case 6:
                                            $tank = "Wash Tank C";
                                        break;
                                        case 7:
                                            $tank = "Wash Tank D";
                                        break;
                                        case 8:
                                            $tank = "Separator 3";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//
                                    
                                    
                                    
                                  
                                break;
                                case 6:    //G Division
                                
                                    //*****TANK TRANSLATOR*********// 
                                   
                                      switch($osr[0]['element_60']){
                                        case 1:
                                            $tank = "T-10";
                                        break;
                                        case 2:
                                            $tank = "T-11";
                                        break;    
                                        case 3:
                                            $tank = "T-12";
                                        break;
                                        case 4:
                                            $tank = "T-13";
                                        break;
                                        case 5:
                                            $tank = "T-14";
                                        break;
                                        case 6:
                                            $tank = "T-15";
                                        break;
                                        
                                         case 7:
                                            $tank = "T-16";
                                        break;
                                        
                                         case 8:
                                            $tank = "T-17";
                                        break;
                                         case 9:
                                            $tank = "T-18";
                                        break;
                                        
                                         case 10:
                                            $tank = "T-19";
                                        break;
                                        
                                         case 11:
                                            $tank = "T-20";
                                        break;
                                       
                                      }
                                   //*****TANK TRANSLATOR*********//
                                
                                
                                    //****** SPOT NUMBER TRANSLATOR (SEPARATOR)************//
                                    switch($osr[0]['element_72']){
                                        case 1:
                                            $snumber ="SEP-A";
                                        break;
                                        case 2:
                                             $snumber ="SEP-B";
                                        break;
                                        case 3:
                                             $snumber ="SEP-C";
                                        break;
                                        case 4:
                                             $snumber ="SEP-D";
                                        break;
                                        case 5:
                                             $snumber ="SEP-E";
                                        break;
                                        case 6:
                                             $snumber ="SEP-F";
                                        break;
                                        case 7:
                                             $snumber ="SEP-G";
                                        break;
                                         case 8:
                                             $snumber ="SEP-H";
                                        break;
                                         case 9:
                                             $snumber ="SEP-I";
                                        break;
                                         case 10:
                                             $snumber ="SEP-J";
                                        break;
                                         case 11:
                                             $snumber ="SEP-K";
                                        break;
                                         case 12:
                                             $snumber ="SEP-L";
                                        break;
                                        
                                    }
                                     //****** SPOT NUMBER TRANSLATOR************//
                                            
                                    //****TYPE TRANSLATOR(HALF TANK)************//
                                    switch($osr[0]['element_71']){
                                        case 1:
                                            $type = "HT-A";
                                        break;
                                        case 2:
                                            $type = "HT-B";
                                        break;
                                        case 3:
                                            $type = "HT-C";
                                        break;
                                        case 4:
                                            $type = "HT-D";
                                        break;
                                        case 5:
                                            $type = "HT-E";
                                        break;
                                        case 5:
                                            $type = "HT-F";
                                        break;
                                        case 5:
                                            $type = "HT-G";
                                        break;
                                        case 5:
                                            $type = "HT-H";
                                        break;
                                        case 5:
                                            $type = "HT-I";
                                        break;
                                        case 5:
                                            $type = "HT-J";
                                        break;
                                        case 5:
                                            $type = "HT-K";
                                        break;
                                        case 5:
                                            $type = "HT-L";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR (HALF TANK)************//
                                    
                                    
                                break;
                                case 7://DAY TANK
                                    switch($osr[0]['element_70']){
                                        case 1:
                                        $tank = "ME-1";
                                        break;
                                        case 2:
                                        $tank = "ME-2";
                                        break;
                                        case 3:
                                        $tank = "ME-3";
                                        break;
                                        case 4:
                                        $tank = "ME-4";
                                        break;
                                        case 5:
                                        $tank = "ME-5";
                                        break;
                                        case 6:
                                        $tank = "ME-6";
                                        break;
                                        case 7:
                                        $tank = "ME-7";
                                        break;
                                    }
                                break;
                                default://other
                                     //****TYPE TRANSLATOR************//
                                    switch($osr[0]['element_66']){
                                         case 1:
                                            $type = "Centrifuge 3";
                                        break;
                                        case 2:
                                            $type = "Centrifuge 4";
                                        break;    
                                        case 3:
                                            $type = "Wash Tank A";
                                        break;
                                        case 4:
                                            $type = "Wash Tank B";
                                        break;
                                        case 5:
                                            $type = "Wash Tank C";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//
                                    
                                         
                                    //****** SEPARATOR************//
                                    switch($osr[0]['element_67']){
                                        case 1:
                                            $snumber ="Separator H";
                                        break;
                                        case 2:
                                            $snumber ="Separator I";
                                        break;
                                        case 3:
                                            $snumber ="Separator J";
                                        break;
                                       
                                        
                                    }
                                     //****** SEPARATOR************//
                                    
                                    //********************* TANK**************************//
                                    switch($osr[0]['element_68']){
                                       case 1:
                                        $tank ="ME-10";
                                       break;
                                       case 2:
                                        $tank ="FFA-1";
                                       break;
                                       case 3:
                                        $tank ="FFA-2";
                                       break;
                                       case 4:
                                        $tank ="Tank-9";
                                       break;
                                       case 5:
                                        $tank ="Sep C";
                                       break;
                                       case 6:
                                        $tank ="Old Still";
                                       break;
                                       case 7:
                                        $tank ="FFA Rec Oil 1";
                                       break;
                                       case 8:
                                        $tank ="FFA Rec Oil";
                                       break;
                                    }
                                    //********************* TANK**************************//
                               
                                break;
                            }
                        }
                    break;
                    case "from_cotton":
                        $area = $entry['element_11'];
                        $type = $entry['element_12'];
                        $tank = $entry['element_13'];
                        $snumber = $entry['element_14'];
                    break;
                    case "from_er":
                        $area = $entry['element_11'];
                        $type = $entry['element_12'];
                        $tank = $entry['element_13'];
                        $snumber = $entry['element_14'];
                    break;
                }
                
                if($entry['source']=="from_osr"){
                    
                } 
                
                switch($entry['element_4']){                
                    case "4":
                        $tech = "Ruben";
                    break;
                    case "5":
                         $tech = "Ricardo";
                    break;
                    case "6":
                         $tech = "Ivan";
                    break;
                    case "7":
                         $tech = "Johhny";
                    break;
                    case "8":
                         $tech = "Joe";
                    break;
                    case "9":
                         $tech = "Daniel";
                    break;
                    case "10":
                         $tech = "Omar";
                    break;
                    case "11":
                         $tech = "Pablo";
                    break;
                    case "12":
                         $tech = "Other";
                    break;
                    
                }
                echo "<tr>          
                    <td><img src='img/delete-icon.jpg' title='DELETE ENTRY' class='del_entry' rel='$entry[id]' style='cursor:pointer;'/></td>      
                    <td>";
                    if(strtolower($entry['element_3'])=="pending retest"){
                        echo "<img src='img/edit-icon.jpg' rel='$entry[id]' title='Edit Pending Retest Sample' class='pending_edit' style='cursor:pointer;'/>";       
                    }else{
                         if(  strtolower(trim($entry['source'])) == "from_tcl"){
                            echo "<img src='img/edit-icon.jpg' rel='$entry[element_76]' title='Edit TCL Sample' class='tcl_edit' style='cursor:pointer;'/>";       
                         }else if($entry['source']=="from_osr"){
                            echo "<img src='img/edit-icon.jpg' rel='$entry[element_16]' title='Edit OSR Sample' class='osr_edit' style='cursor:pointer;'/>";    
                         }else if($entry['source']=="from_cotton"){
                            echo "<img src='img/edit-icon.jpg' rel='$entry[element_16]' title='Edit OSR Sample' class='cotton_edit' style='cursor:pointer;'/>";    
                         }
                    }
                    
                    echo "
                    </td>
                   
                    <td><img src='img/red_cancel.png' title='Reject Sample' class='reject' rel='$entry[id]' style='cursor:pointer;'/></td>
                    <td>"; 
                    if(  $entry['source'] == "from_tcl"){
                        echo "<img class='er_tcl' rel='$entry[element_76]' xlr='$entry[id]' src='img/table_edit.png' title='Enter Lab Result' style='cursor:pointer;'/>";
                    }else if($entry['source']=="from_osr"){
                        echo "<img class='er_osr' rel='$entry[id]' src='img/table_edit.png' title='Enter Lab Result' style='cursor:pointer;'/>";
                    }else if($entry['source']=="from_er"){
                        echo "<img src='img/table_edit.png' title='Enter Lab Result' style='cursor:pointer;' class='edit_lab_result' rel='$entry[id]'/>";
                    }else if($entry['source']=="from_cotton"){
                         echo "<img src='img/table_edit.png' title='Enter Lab Result' style='cursor:pointer;' class='er_cotton' rel='$entry[id]'/>";
                    }
                    echo "</td>
                    <td>$entry[id]</td>
                    <td>$entry[source]</td>
                    <td>$entry[element_3]</td>
                    
                    <td>$entry[element_76]</td>
                    <td>$entry[element_77]</td>
                    <td>$entry[element_82]</td>
                    <td>$entry[element_83]</td>
                  
                    <td>$entry[element_84]</td> 
                    <td>$entry[date_created]</td><!---req date + time---!>  
                    <td>$entry[element_10]</td><!---requestor---!>
                    <td>$area</td><!---area---!>                    
                    <td>$type</td><!---type---!>
                    <td>$tank</td><!---tank---!>
                    <td>$snumber</td><!---SPOT---!>      
                                     
                    <td>"; 
                        if(strtolower($entry['element_3'])=="pending retest"){
                            echo "<span style='cursor:pointer;color:blue;text-decoration:underline;font-weight:bold;' class='original_results' rel='$entry[element_85]'>Original Results</span>";
                        }
                    echo "</td>
                </tr>";
            }
        }else{
            echo "<tr><td colspan='20'>No Data</td></tr>";
        }
    ?>
    </tbody>
</table>
<iframe id="login_edit" src="" style="width: 1px;height:1px;"></iframe>
<script>

$("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
window.onload = function(){
    $("#login_edit").attr('src',"machlogin.php");
}

$(".er_cotton").click(function(){
        Shadowbox.open({
        content: 'ER.php?entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Lab Result without Operator Sample Request",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});

$(".edit_lab_result").click(function(){
    Shadowbox.open({
        content: 'machforms/machform/edit_entry.php?form_id=44342&entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Lab Result without Operator Sample Request",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});

$(".reject").click(function(){    
    if(confirm("Are you sure you wish to retest this sample?")){
        $.post("rejectsample.php",{id:$(this).attr('rel'),status:"rejected"},function(data){
             alert(data);
             window.location.reload();
        });
    }
    
});

$('.tcl_edit').click(function(){
    Shadowbox.open({
        content: 'machforms/machform/edit_entry.php?form_id=43256&entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Edit Inbound and Outbound Sample Log",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});


$('.osr_edit').click(function(){
    Shadowbox.open({
        content: 'machforms/machform/edit_entry.php?form_id=47049&entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Edit Operator Sample Request",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
})

$('.er_tcl').click(function(){
    Shadowbox.open({
        content: 'ER.php?truck='+$(this).attr('rel')+'&id='+$(this).attr('xlr')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Enter Lab Results & Calculations",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});


$('.er_osr').click(function(){
    Shadowbox.open({
        content: 'ER.php?entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Enter Lab Results & Calculations",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});
//

$('.original_results').click(function(){
    Shadowbox.open({
        content: 'labresults.php?entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"View Original Lab Results",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});

$(".pending_edit").click(function(){
    Shadowbox.open({
        content: 'machforms/machform/edit_entry.php?form_id=44342&entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Edit Pending Retest Sample",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});

$(".del_entry").click(function(){
    var kop = $(this).attr('rel');
    if(confirm("Are you you want to delete this entry completely?")){
        $.post("deletelab_entry.php",{er_id:kop},function(data){           
            alert(data);
            if(confirm("Do you want to delete the original Pending if it exists?")){
                $.post("delete_original_pending.php",{er_id:kop},function(data){
                    alert("Original Pending deleted "+data)
                });
            }
            
            $.post("delete_entry.php",{er_id:kop},function(data){
                alert("Lab Entry Deleted "+data);
            });
        });
    }
});

$(".cotton_edit").click(function(){
    Shadowbox.open({
        content: 'machforms/machform/edit_entry.php?form_id=43646&entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"Edit Pending Retest Sample",
        options: {
            overLayColor:"#ffffff",
            overlayOpacity:".9"
        }
    });
});
</script>