<?php

ini_set("display_errors",1);
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
$string = "";
$year = date("Y");
$now = date("m");
if(isset($_POST['filter'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "from":
                if(strlen($value)>0 && $value !=''){
                    $arrFields[] =" date_created >='$value'";
                }
            break;
            case "to":
                if(strlen($value)>0 && $value !=''){
                    $arrFields[] =" date_created <='$value'";
                }
            break;
            case "status":
               if(strlen($value)>0 && $value !="--"){
                 $arrFields[]= " element_3 like '%$value%'";
               }
            break;
        }
    }
    
    if(!empty($arrFields)){
        $string = "AND ".implode(" AND ",$arrFields);
    }
    echo "SELECT * FROM Inetforms.ap_form_44342 WHERE 1 $string<br/>";
    $compl = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_3  IN ('Completed','rejected') $string");
}else{
    echo "SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_3  IN ('Completed','rejected') AND date_created>='$year-$now-01' AND date_created <='$year-$now-".date("t")."'<br/>";
    $compl = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE ap_form_44342.element_3  IN ('Completed','rejected') AND date_created>='$year-$now-01' AND date_created <='$year-$now-".date("t")."'");
    // AND date_created  >= DATE(NOW()) - INTERVAL 7 DAY
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
    padding:15px 15px 15px 15px;
}
#myTable td {
     padding:15px 15px 15px 15px;  
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
$(document).ready(function(){
   $('#myTable').dataTable({
        "order": [ 5, 'desc' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>   
<div id="space_top" style="height:97px;width:100%;background:rgba(255,255,255,.4)"></div>
<form action="CompletedTests.php" method="POST">
<table style="width: 80%;margin:auto;margin-top:10px;">
<tr><td style="text-align: left;"><div id="space_top" style="height:97px;width:100%;background:rgba(255,255,255,.4)"></div></td><td><input type="text" name="from" placeholder="FROM date created" id="from" style=" border-radius: 10px;" value="<?php
        if(isset($_POST['filter'])){
            echo $_POST['from'];
        }
     ?>"/></td><td style="text-align: center;">TO</td><td><input type="text" name="to" placeholder="TO date created" id="to" value="<?php
        if(isset($_POST['filter'])){
            echo $_POST['to'];
        }
     ?>"/></td><td>Status&nbsp;<select name="status"><option>--</option><option value="completed"  <?php
        if(isset($_POST['filter'])){
           if($_POST['status']=="completed"){ echo " selected ";}
        }
     ?>>Completed</option><option value="rejected"  <?php
        if(isset($_POST['filter'])){
           if($_POST['status']=="rejected"){ echo " selected ";}
        }
     ?>>Rejected</option></select></td><td><input type="submit" value="Filter" name="filter"/></td></tr>
</table>
</form>

<table style="margin:auto;"  id="myTable">
    <thead>
    
    <tr>
    
   
    <th style="width: 55px;">&nbsp;</th>
    <th style="width: 55px;">&nbsp;</th>
    <th style="width: 55px;">&nbsp;</th>
    <th style="width: 55px;">&nbsp;</th>
    <th>Req Id</th>
    <th>Date</th>    
    <th>Source</th>
    <th>Status</th>
    <th>Original Req #</th>
    
    <th>Truck Request #</th>
    <th>Weight Ticket</th>
    <th>Release/Sale #</th>
    <th>Inbound WC</th>
    <th>Note</th>
    <th>Operator Name</th>
    <th>Request Date</th>
    <th>Requestor</th>
    <th>Area</th>
    <th>Type</th>
    <th>Tank</th>
    <th>SPOT #</th>
    <th>Lab Results</th>
   <th>Original Lab Results</th>
    </tr>
    </thead>
    <tbody>
    <?php 
        foreach($compl as $ent){    
             $area = "";
             $type = "";
             $snumber = "";
             $tank = "";
             if($ent['source']=="from_tcl"){
                   $tcl = $db->query("SELECT * FROM Inetforms.ap_form_43256 WHERE ap_form_43256.id = $ent[element_76]");
                    switch($tcl[0]['element_1']){
                        case 1:
                            //****TYPE TRANSLATOR************//
                            switch($tcl[0]['element_14']){
                                case 1:
                                    $type = "Before Stage 1";
                                break;
                                case 2:
                                    $type =  "After Stage 1";
                                break;
                                case 3:
                                    $type =  "GC";
                                break;
                            }
                            //****TYPE TRANSLATOR************//
                            
                            
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
                        break;
                        case 2:
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
                            $tank = $tsl[0]['element_48'];
                        break;
                        case 3:
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
                            
                            
                            //************ AREA TRANSLATOR ********************//
                            switch($tsl[0]['element_26']){
                                case 1:
                                    $area = "WCS";
                                break;
                                case 2:
                                    $area = "Other";
                                break;
                            }
                            //************ AREA TRANSLATOR ********************//
                        break;
                        case 4:
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
                            
                            //************ AREA TRANSLATOR ********************//
                            switch($tsl[0]['element_64']){
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
                        break;
                        case 5:
                        
                             //************ AREA TRANSLATOR ********************//
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
                        case 6:
                        
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
                        case 7:
                        
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
                        case 8:                            
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
                        case 9:
                            
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

                                    $type =  "Waste to Energy";
                                break;
                            }
                            //****TYPE TRANSLATOR************//
                        break;
                    }
                    
                }else if($ent['source']=="from_osr"){
                    $area = $ent['element_11'];
                    $osr = $db->query("SELECT * FROM Inetforms.ap_form_47049 WHERE ap_form_47049.id = $ent[element_16]");
                    if(count($osr)>0){
                        
                        switch( $osr[0]['element_39']){                       
                            case 1:              //Reactor          
                                //****** SPOT NUMBER TRANSLATOR************//
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
                                            $type = "Surge";
                                        break;
                                        case 2:
                                            $type = "Separator 1";
                                        break;   
                                        case 3:
                                            $type = "Separator 2";
                                        break; 
                                        case 4:
                                            $type = "RFE";
                                        break;
                                        
                                        case 5:
                                            $type = "Centrifuge";
                                        $break;
                                        case 6:
                                            $type = "Wash Tank C";
                                        break;
                                        case 7:
                                            $type = "Wash Tank D";
                                        break;
                                        case 8:
                                            $type = "Separator 3";
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
                                        case 6:
                                            $type = "HT-F";
                                        break;
                                        case 7:
                                            $type = "HT-G";
                                        break;
                                        case 8:
                                            $type = "HT-H";
                                        break;
                                        case 9:
                                            $type = "HT-I";
                                        break;
                                        case 10:
                                            $type = "HT-J";
                                        break;
                                        case 11:
                                            $type = "HT-K";
                                        break;
                                        case 12:
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
                                    
                                break;
                        }
                    }else{
                       if(strlen(trim($ent['element_16']))>0){
                           $osr = $db->query("SELECT * FROM Inetforms.ap_form_42682 WHERE ap_form_42682.id = $ent[element_16]");
                        if(count($osr)>0){
                             switch( $osr[0]['element_1']){                       
                                case 1:              //Reactor          
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_7']){
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
                                    switch($osr[0]['element_5']){
                                        case 1:
                                            $type = "Before Stage 1";
                                        break;
                                        case 2:
                                            $type =  "After Stage 1";
                                        break;
                                        case 3:
                                            $type =  "GC";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//
                                    
                                  //*****TANK TRANSLATOR*********//
                                    switch($osr[0]['element_6']){
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
                                    }
                                   //*****TANK TRANSLATOR*********//   
                                break;
                                case 2://glycerin
                                
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_11']){
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
                                    switch($osr[0]['element_9']){
                                        case 1:
                                            $type =  "Acidulated Dried";
                                        break;
                                        case 2:
                                            $type =  "Acidulated Not Dried";
                                        break;
                                        case 3:
                                            $type =  "Raw";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//
                                    
                                    //*****TANK TRANSLATOR*********//
                                      switch($osr[0]['element_10']){
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
                                       
                                      }
                                   //*****TANK TRANSLATOR*********//
                                break;
                                case 3://water condenser
                                    
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_14']){
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
                                      switch($osr[0]['element_13']){
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
                                
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_18']){
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
                                    //********************* TYPE *************************//
                                    switch($osr[0]['element_16']){
                                        case 1: $type =  "WW"; break;
                                        case 2: $type =  "BC"; break;
                                        case 3: $type =  "PC"; break;
                                        break;
                                    }
                                    //********************* TYPE *************************//
                                    
                                    //********************* TANK**************************//
                                    switch($osr[0]['element_17']){
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
                                    }
                                    //********************* TANK**************************//
                                break;
                                
                                case 5://wash tanks
                                     //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_21']){
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
                                    switch($osr[0]['element_20']){
                                       case 1:
                                            $tank = "Surge";
                                        break;
                                        case 2:
                                            $tank = "Separator 1";
                                        break;    
                                        case 3:
                                            $tank = "RFE";
                                        break;
                                        case 4:
                                            $tank = "Separator 2";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//
                                break;
                                case 6:    //G Division
                                    //****** SPOT NUMBER TRANSLATOR************//
                                    switch($osr[0]['element_24']){
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
                                        case 6:
                                             $snumber ="S7";
                                        break;
                                    }
                                     //****** SPOT NUMBER TRANSLATOR************//
                                            
                                    //****TYPE TRANSLATOR************//
                                    switch($osr[0]['element_23']){
                                        case 1:
                                            $type =  "WW";
                                        break;
                                        case 2:
                                            $type =  "BC";
                                        break;
                                        case 3:
                                            $type =  "PC";
                                        break;
                                    }
                                    //****TYPE TRANSLATOR************//                                    
                                    //*****TANK TRANSLATOR*********// 
                                    /*
                                      switch($osr[0]['element_17']){
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
                                       
                                      }*/
                                   //*****TANK TRANSLATOR*********//
                                break;
                            }
                        }
                       }
                    }
                } else if ( $ent['source']=="from_er"){
                    $area = $ent['element_11'];
                    $type = $ent['element_12'];
                    $tank = $ent['element_13'];
                    $snumber = $ent['element_14'];
                }
                
                
                switch($ent['element_4']){
                    case 4:
                    $op ="Ruben";
                    break;
                    case 5:
                    $op ="Ricardo";
                    break;
                    case 6:
                    $op ="Ivan";
                    break;
                    case 7:
                    $op ="Johhny";
                    break;
                    case 8:
                    $op ="Joe";
                    break;
                    case 9:
                    $op ="Daniel";
                    break;
                    case 10:
                    $op ="Omar";
                    break;
                    case 11:
                    $op ="Pablo";
                    break;
                    case 12:
                    $op ="Other";
                    break;
                    default:
                    $op = "";
                    break;
                }
            echo "<tr>
            <td><img src='img/delete-icon.jpg' title='DELETE ENTRY' class='del_entry' rel='$ent[id]' style='cursor:pointer;width:20px;height:20px;'/></td>
            <td  style='width:100px;'>"; 
                if($ent['source']=="from_tcl"){
                    echo "<div class='outline' style='width:20px;height:20px;'><img src='img/edit-icon.jpg' title='Edit Truck Log Sample' style='width:20px;height:20px;cursor:pointer;' rel='$ent[element_76]' title='Edit TCL Sample' class='tcl_edit'/></div>";
                }else if($ent['source']=="from_osr"){
                    echo "<div class='outline' style='width:20px;height:20px;'><img src='img/edit-icon.jpg' title='Edit Operator Sample Request' style='width:20px;height:20px;cursor:pointer;' class='osr_edit' rel='$ent[element_16]'/></div>";
                } else if ($ent['source'] == "from_er"){
                    echo "&nbsp;";
                }
            echo "</td>
            <td style='width:100px;'><div class='outline' style='width:20px;height:20px;'><img src='https://www.nfpt.com/wp-content/uploads/exam-voucher-lg.png' title='Re-Test Sample' class='reject' rel='$ent[id]' style='cursor:pointer;width:20px;height:20px;'/></div></td>
            
            
            <td style='width:100px;'><div class='outline' style='width:20px;height:20px;'><img xlr='$ent[source]' src='img/table_edit.png' title='Enter Lab Result' style='width:20px;height:20px;cursor:pointer;' rel='$ent[id]' ler='$ent[element_76]' class='er' /></div></td>
            <td>$ent[id]</td><!---req id---!>
            <td>$ent[element_1]</td><!---date/time---!>
            <td>$ent[source]</td>
            <td>$ent[element_3]</td><!---status---!>
            <td>$ent[element_85]</td><!---original req id---!>           
            <td>$ent[element_76]</td><!---truck request---!>
            <td>$ent[element_77]</td><!---weight ticket---!>
            <td>$ent[element_82]</td><!---release---!>
            <td>$ent[element_83]</td><!---inbound wc---!>
            <td>$ent[element_84]</td><!---note---!>
            <td>$op</td><!---op name---!>
            <td>$ent[element_8]</td><!---req date + time---!>
            <td>$ent[element_10]</td><!---requestor---!>
            <td>$area</td><!---area---!>                    
            <td>$type</td><!---type---!>
            <td>$tank</td><!---tank---!>
            <td>$snumber</td><!---SPOT---!>
            <td><span rel='$ent[id]' style='cursor:pointer;text-decoration:underline;font-weight:bold;color:blue;' class='lab_results'>Lab Results</span></td>
            <td>"; 
                if($ent['element_3']!="rejected"){
                    echo "<span style='cursor:pointer;text-decoration:underline;font-weight:bold;color:blue;' rel='$ent[element_85]' class='original'>Original Results</span>";
                }
            echo "</td>
            </tr>";
        }
    ?>
    </tbody>
</table>
<iframe id="login_edit" src="" style="width: 1px;height:1px;"></iframe>
<script>
window.onload = function(){
    $("#login_edit").attr('src',"machlogin.php");
}
$(".reject").click(function(){
    
        if(confirm("Are you sure you wish to retest this sample?")){
            $.post("rejectsample.php",{id:$(this).attr('rel'),status:"pending retest"},function(data){
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
        content: 'machforms/machform/edit_entry.php?form_id=42682&entry_id='+$(this).attr('rel')+'',
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

$('.er').click(function(){
    if($(this).attr('xlr')=="from_tcl"){
        var url = 'ER.php?truck='+$(this).attr('ler')+'&id='+$(this).attr('rel')+'';
    }else if($(this).attr('xlr') == "from_osr"){
        var url = 'ER.php?entry_id='+$(this).attr('rel')+'';
    }else if($(this).attr('xlr') == "from_er"){
        var url = 'ER.php?entry_id='+$(this).attr('rel')+'';
    }
    
    Shadowbox.open({
        content: url,
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


$('.original').click(function(){
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
})

//
$('.lab_results').click(function(){
    Shadowbox.open({
        content: 'labresults.php?entry_id='+$(this).attr('rel')+'',
        player:"iframe",
        width:1200,
        height:600,
        loadingImage:"shadow/loading.gif",
        title:"View Lab Results",
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
$("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>