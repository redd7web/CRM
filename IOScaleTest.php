<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
include "scaleFunctions.php";
if($_SESSION['username'] == "RDizon"){
    ini_set("display_errors",1);
}
$manage = array (1,3,8);
$calc_check = array(82,86,20);
$billers = array(1,2);
$lab_users = array(1,5,8);

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
    <link rel="stylesheet" href="/sales/bootstraptest/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <?php
        include "source/scripts.php";
        include "source/css.php";
    ?>
    <script>
    
    
    $(document).ready(function(){
        $("#fragment-3").html("<img src='img/loading.gif'/>");
        $.get("all_io_updated.php",function(data){
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

<title>Completed IO Scale</title>
</head>

<body>

<?php
if(isset($_POST['scale_login'])){
    //role, first name,last name, username
    $hash = crypt(trim($_POST['scale_password']),'$ap_form_64550');
    if($_SESSION['username'] =="RDizon"){
        echo "$hash $_POST[scale_name] ";
        echo "SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'";
      
    }
    
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1,element_10_1,element_10_2,element_10_3,element_10_4,element_10_5,element_10_6,element_10_7,element_10_8,element_10_9,element_10_10,element_10_11,element_10_12,element_10_13,element_10_14,element_10_15,element_10_16,element_10_17,element_10_18,element_10_19,element_10_20,element_10_21,element_10_22,element_10_23,element_10_24,element_10_25,element_10_26,element_10_27,element_10_28,element_10_29,element_10_30,element_10_32 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'");
    if($_SESSION['username'] =="RDizon"){
        print_r($lookup);
    }
    if(count($lookup)>0 && in_array($lookup[0]['element_9'],$lab_users)  ){
        $_SESSION['division'] = explode("|",$lookup[0]['element_10_1']."|".$lookup[0]['element_10_2']."|".$lookup[0]['element_10_3']."|".$lookup[0]['element_10_4']."|".$lookup[0]['element_10_5']."|".$lookup[0]['element_10_6']."|".$lookup[0]['element_10_7']."|".$lookup[0]['element_10_8']."|".$lookup[0]['element_10_9']."|".$lookup[0]['element_10_10']."|".$lookup[0]['element_10_11']."|".$lookup[0]['element_10_12']."|".$lookup[0]['element_10_13']."|".$lookup[0]['element_10_14']."|".$lookup[0]['element_10_15']."|".$lookup[0]['element_10_16']."|".$lookup[0]['element_10_17']."|".$lookup[0]['element_10_18']."|".$lookup[0]['element_10_19']."|".$lookup[0]['element_10_20']."|".$lookup[0]['element_10_21']."|".$lookup[0]['element_10_22']."|".$lookup[0]['element_10_23']."|".$lookup[0]['element_10_24']."|".$lookup[0]['element_10_25']."|".$lookup[0]['element_10_26']."|".$lookup[0]['element_10_27']."|".$lookup[0]['element_10_28']."|".$lookup[0]['element_10_29']."|".$lookup[0]['element_10_30']."|".$lookup[0]['element_10_32']);
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }
}



if(!isset($_SESSION['billing'])){  ?>
<form action="IOScale.php" method="POST">
<table style="width:200px;position:fixed;top:5px;right:5px;border-radius:10px 10px 10px 10px;border:2px solid green;padding:5px 5px 5px 5px;">
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;" type="text" name="scale_name" placeholder="Username"/></td></tr>
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;box-shadow:inset 0 0 5px green;padding:5px 5px 5px 5px;"  type="password" name="scale_password" placeholder="Password"/></td></tr>
<tr><td colspan="2" style="text-align: right;border:0px solid #bbbbbb;"><input style="width: 100px;height:30px;background:url(img/login_clean.png) no-repeat center center;background-size:100% 100%;border:0px solid #bbbbbb;margin-top:4px;padding:5px 5px 5px 5px;" type="submit" value="" name="scale_login"/></td></tr>
</table>
</form>
<?php
}else {
    echo "<h2>Welcome, $_SESSION[username]&nbsp; <a href='IOScale.php?task=logout'><img src='img/logout.jpg' title='Logout'/></a></h2><br/>
    ";
    if( $_SESSION['billing']  == 1){
        echo "<a href='manual_ticket.php' rel='shadowbox;width=450;'>Manual Scale Ticket Input</a>";
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
            $query = "SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' AND WeighIn >= DATE_ADD(CURDATE(),INTERVAL -30 DAY) GROUP BY WeighIn";
            $outbound = $db->query("SELECT iwp_test_scale.*,iwp_scale_truck.name,iwp_scale_truck.truckid,iwp_scale_truck.TrailerID1,iwp_scale_truck.TrailerID2,iwp_scale_truck.HaulerKey FROM iwp_test_scale LEFT JOIN iwp_scale_truck ON iwp_test_scale.TruckKey = iwp_scale_truck.TruckKey WHERE ShipMode LIKE '%S%' AND WeighIn >= DATE_ADD(CURDATE(),INTERVAL -30 DAY) GROUP BY WeighIn");// AND ProductKey IN(29,82,90)
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
    $.get("outbound_io_test.php",function(data){
        $("#fragment-1").html(data)
    });
    
    $("#fragment-2").html("");
    $("#fragment-3").html("");
});



$("#frag_2").click(function(){
    $("#fragment-2").html("<img src='img/loading.gif'/>");
    $.get("inbound_io_test.php",function(data){
        $("#fragment-2").html(data)
    });
    
    $("#fragment-1").html("");
    $("#fragment-3").html("");
});


$("#frag_3").click(function(){
    $("#fragment-3").html("<img src='img/loading.gif'/>");
    $.get("all_io_updated.php",function(data){
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
    $.post("outbound_io_test.php",{
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
    $.post("inbound_io_test.php",{
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
    $.post("all_io_updated.php",{
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
    
    <?php
    
}

?>
</body>
</html>