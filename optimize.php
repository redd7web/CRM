<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
include "scaleFunctions.php";
ini_set("display_errors",0);
$manage = array (1,3);
$calc_check = array(82,86,20);
$billers = array(1,2);


if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    
    session_destroy();
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
    <script>
    
    
    $(document).ready(function(){
        $("#fragment-3").html("<img src='img/loading.gif'/>");
        $.get("all_io.php",function(data){
            $("#fragment-3").html(data)
        }); 
        
       $('.myTable').dataTable({
            "order": [ 6, 'desc' ],
            "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
       }); 
    });
    
    $( function() {
        $( "#tabs" ).tabs({
        <?php 
        if(isset($_GET['tab'])){
            switch($_GET['tab']){
                case 1:
                    ?>
                    active:0
                    <?php
                break;
                case 2:
                     ?>
                    active:1
                    <?php
                break;
                case 3:
                ?>
                    active:2
                <?php
                break;
            }    
        }
        ?>
        });
    });

  </script>
  <style type="text/css">
  body{
    font-size:12px;
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
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

#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
}

td,th{
    background:transparent;
    text-align:center;
    width:1%;
    font-size:12px;
    vertical-align:middle;
    display:table-cell;
    padding:0px 2px; /* just some padding, if needed*/
    white-space: pre; /* this will avoid line breaks*/
    border:1px solid black;
    
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
    display:table-row
}

tr.odd{
    background:transparent;
    display:table-row
}
.setThisRoute{ 
    z-index:9999;
}



input[type=checkbox]{
    width:10px;
}

</style>
<title>Completed IO Scale</title>
</head>

<body>

<?php
if(isset($_POST['scale_login'])){
    //role, first name,last name, username
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '$_POST[scale_name]' AND element_2 = '$_POST[scale_password]'");
    if(count($lookup)>0){
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }
    
    
}



if(!isset($_SESSION['billing'])){
    

?>
<form action="optimize.php" method="POST" style="margin-bottom: 50px;">
<table>
<tr><td>Username</td><td style="text-align: left;"><input type="text" name="scale_name" placeholder="Username"/></td></tr>
<tr><td>Password</td><td style="text-align: left;"><input type="password" name="scale_password"/></td></tr>
<tr><td colspan="2" colspan="2" style="text-align: right;"><input type="submit" value="Login" name="scale_login"/></td></tr>
</table>
</form>
<?php
}else {
    echo "<h2>Welcome, $_SESSION[username]&nbsp; <a href='IOScale.php?task=logout'><img src='img/logout.jpg' title='Logout'/></a></h2><br/>
    ";
    if( $_SESSION['billing']  == 1 || $_SESSION['billing'] == 5){
        echo "<a href='manual_ticket.php' rel='shadowbox;width=450;'>Manual Scale Ticket Input</a>";
    }
    
}

?>

<h1 style="margin-top: 50px;">IWP SCALE MAIN</h1>
<div id="tabs" style="width: auto;display:inline-block;">
  <ul>
    <li><a id="frag_1" href="#fragment-1">OutBound</a></li>
    <li><a id="frag_2" href="#fragment-2">Inbound</a></li>
    <li><a id="frag_3" href="#fragment-3">All</a></li>
  </ul>
  <?php
  /// OUTBOUND
    
        if(isset($_POST['outbound_submit'])){
            foreach($_POST as $name=>$value){
                switch($name){
                    case "trailer_1":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.TrailerID1  like '%".trim($value)."%'";
                        }
                    break;
                    case "trailer_2":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.TrailerID2  like '%".trim($value)."%'";
                        }
                    break;
                     case "truck_lice":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.truckid  like '%".trim($value)."%'";
                        }
                    break;
                    case "release_number":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.UF1Data like  '%$value%'";
                        }
                    break;
                     case "hauler":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_scale_truck.HaulerKey =$value";
                        }
                    break;
                    case "product":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.ProductKey = $value";
                        }
                    break;
                    case "vendor":
                       if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.VendorKey = $value";
                       }
                    break;
                    case "customer":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.CustomerKey = $value";
                        }
                    break;
                    case "driver":
                        if(strlen(trim($value))>0){
                            $ob[]= " iwp_test_scale.TruckKey = $value";
                        }
                    break;
                    case "wc":
                        if(strlen(trim($value))>0){
                            $ob[]= " tk  =$value";
                        }
                    break;
                    case "outbound_from":
                        if(strlen(trim($value))>0 ){
                            if($_POST['date_type']==1){
                                $ob[] = " iwp_test_scale.WeighIn >='".trim($value)."'";
                            }else{
                                $ob[] = " iwp_test_scale.WeighOut >='".trim($value)."'";
                            }
                            
                        }
                    break;
                    case "outbound_to":
                        if(strlen(trim($value))>0 ){
                             if($_POST['date_type']==1){
                                $ob[] = "iwp_test_scale.WeighIn <='".trim($value)."'";
                             }else{
                                $ob[] = "iwp_test_scale.WeighOut <='".trim($value)."'";
                             }
                             
                        }
                    break;
                }
            }
            if(!empty($ob)){
                $string = " AND ".implode(" AND ", $ob);
            }
            
            $query = "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' $string GROUP BY WeighIn";
            $outbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' $string GROUP BY WeighIn");
        }else{
            $query = "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' GROUP BY WeighIn";
            $outbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' GROUP BY WeighIn");// AND ProductKey IN(29,82,90)
        }
  
  ?>
  <div id="fragment-1"><h1>OutBound</h1>
  
    
  </div>
  <div id="fragment-2"><h1>InBound</h1>
    
  </div>
  <div id="fragment-3"><h1>InBound</h1>
    
  </div>
</div>


</body>
<script>
$( "#tabs" ).tabs({ active:2});


$("#frag_1").click(function(){
    $("#fragment-1").html("<img src='img/loading.gif'/>");
    $.get("outbound_io.php",function(data){
        $("#fragment-1").html(data)
    });
    
    $("#fragment-2").html("");
    $("#fragment-3").html("");
});



$("#frag_2").click(function(){
    $("#fragment-2").html("<img src='img/loading.gif'/>");
    $.get("inbound_io.php",function(data){
        $("#fragment-2").html(data)
    });
    
    $("#fragment-1").html("");
    $("#fragment-3").html("");
});


$("#frag_3").click(function(){
    $("#fragment-3").html("<img src='img/loading.gif'/>");
    $.get("all_io.php",function(data){
        $("#fragment-3").html(data);
    });
    
    $("#fragment-1").html("");
    $("#fragment-2").html("");
});


$("#fragment-1").on("click","#outbound_submit",function(){
    var t_1 = $("input#trailer_1").val();
    var t_2 = $("input#trailer_2").val();
    var t_lice = $("input#truck_lice").val();
    var wtc = $("input#wc").val();
    var release_number = $("input#release_number").val();
    var hauler = $("select#hauler").val();
    var product = $("select#product").val();
    var vendor =$("select#vendor").val();
    var customer = $("select#customer").val();
    var driver = $("select#driver").val();
    var to = $("input#to").val();
    var from = $("input#from").val();
    var date_type = $("input[name=date_type]").val();
    $("#fragment-1").html("<img src='img/loading.gif'/>");
    $.post("outbound_io.php",{
            outbound_submit:1,
            trailer_1:t_1,
            trailer_2:t_2,
            truck_lice:t_lice,
            wc: wtc,
            release_number:release_number,
            hauler:hauler,
            product:product,
            vendor:vendor,
            customer:customer,
            driver:driver,
            to:to,
            from:from,
            date_type:date_type
    },function(data){
            $("#fragment-1").html(data);
    });
});


$("#fragment-2").on("click","#inbound_submit",function(){
    alert("click");
    var t_1 = $("input#trailer_1").val();
    var t_2 = $("input#trailer_2").val();
    var t_lice = $("input#truck_lice").val();
    var wtc = $("input#wc").val();
    var release_number = $("input#release_number").val();
    var hauler = $("select#hauler").val();
    var product = $("select#product").val();
    var vendor =$("select#vendor").val();
    var customer = $("select#customer").val();
    var driver = $("select#driver").val();
    var to = $("input#to").val();
    var from = $("input#from").val();
    var date_type = $("input[name=date_type]").val();
    $("#fragment-2").html("<img src='img/loading.gif'/>");
    $.post("inbound_io.php",{
            inbound_submit:1,
            trailer_1:t_1,
            trailer_2:t_2,
            truck_lice:t_lice,
            wc: wtc,
            release_number:release_number,
            hauler:hauler,
            product:product,
            vendor:vendor,
            customer:customer,
            driver:driver,
            to:to,
            from:from,
            date_type:date_type
    },function(data){
            $("#fragment-2").html(data);
    });
});


$("#fragment-3").on("click","#all_submit",function(){
    alert("click");
    var t_1 = $("input#trailer_1").val();
    var t_2 = $("input#trailer_2").val();
    var t_lice = $("input#truck_lice").val();
    var wtc = $("input#wc").val();
    var release_number = $("input#release_number").val();
    var hauler = $("select#hauler").val();
    var product = $("select#product").val();
    var vendor =$("select#vendor").val();
    var customer = $("select#customer").val();
    var driver = $("select#driver").val();
    var to = $("input#to").val();
    var from = $("input#from").val();
    var date_type = $("input[name=date_type]").val();
    $("#fragment-3").html("<img src='img/loading.gif'/>");
    $.post("all_io.php",{
            all_search:1,
            trailer_1:t_1,
            trailer_2:t_2,
            truck_lice:t_lice,
            wc: wtc,
            release_number:release_number,
            hauler:hauler,
            product:product,
            vendor:vendor,
            customer:customer,
            driver:driver,
            to:to,
            from:from,
            date_type:date_type
    },function(data){
            $("#fragment-3").html(data);
    });
});
</script>
</html>