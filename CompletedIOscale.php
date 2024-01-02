<?php
include "protected/global.php";
include "scaleFunctions.php";
if($_SESSION['username'] == "RDizon" || $_SESSION['username'] == "spyro"){
    ini_set("display_errors",1);
}
//Manager
$permit = array (1,3,8);

if(isset($_GET['task'])){
    unset($_SESSION['billing']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['division']);
    unset($_SESSION['manual_approve']);
    session_destroy();
}


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Manager Dash</title>
<?php 

include "source/scripts.php";
include "source/css.php";
?>
  
  <script>
     $(document).ready(function(){
         $("#fragment-11").html("<img src='img/loading.gif'/>");
        $.get("manager_approval.php",function(data){
            $("#fragment-11").html(data)
        }); 
    });
    $( function() {
        
       
        $( "#tabs" ).tabs({
           
           activate: function( event, ui ) {
                  currentTabIndex =ui.newTab.index().toString();
                  ui.newPanel.html("<img src='img/loading.gif'/>"); 
                  switch(currentTabIndex){
                     case "0":
                        $.get("manager_approval.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "1":
                        
                        $.get("manager_outbound.php",function(data){
                            
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "2":
                       $.get("manager_inbound.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "3":
                         $.get("manager_outboundmx.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "4":
                       $.get("manager_outboundgrease.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "5":
                         $.get("manager_outboundbio.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "6":
                         $.get("manager_rwater.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "7":
                        $.get("manager_outboundmxgrease.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "8":
                        $.get("manager_ingrease.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "9":
                        $.get("manager_petfood.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "10":
                        $.get("manager_wcs.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                     case "11":
                        $.get("manager_manual.php",function(data){
                            ui.newPanel.html(""); 
                            ui.newPanel.html(data); 
                        });
                     break;
                  }
                  
            }
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



td,th{
    background:transparent;
    text-align:center;
    width:1%;
    font-size:12px;
    border:1px solid black;
}

th{
    vertical-align:top;
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}



input[type=checkbox]{
    width:10px;
}

</style>
<link rel="stylesheet" href="css_excel/excel-2007.css"/>
<?php

if(isset($_POST['scale_login'])){
    $hash = crypt(trim($_POST['scale_password']),'$ap_form_64550');
    if($_SESSION['username'] =="RDizon"){
        echo "$hash $_POST[scale_name]";
        echo "SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'";
    }
    
    $lookup = $db->query("SELECT id,element_9,element_5,element_6,element_1,element_10_1,element_10_2,element_10_3,element_10_4,element_10_5,element_10_6,element_10_7,element_10_8,element_10_9,element_10_10,element_10_11,element_10_12,element_10_13,element_10_14,element_10_15,element_10_16,element_10_17,element_10_18,element_10_19,element_10_20,element_10_21,element_10_22,element_10_23,element_10_24,element_10_25,element_10_26,element_10_27,element_10_28,element_10_29,element_10_30,element_10_32,element_11_1,element_11_2,element_11_3,element_11_4,element_11_5,element_11_6,element_11_7,element_11_8,element_11_12,element_11_13,element_11_14,element_11_15,element_11_16,element_11_17,element_11_18,element_11_19,element_11_20,element_11_21,element_11_22,element_11_23,element_11_24,element_11_25,element_11_26,element_11_28 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'");
  
   
    
    if(count($lookup)>0 && in_array($lookup[0]['element_9'],$permit) ){
        divisions($lookup);
        manual_approve($lookup);
        
        $_SESSION['billing'] =$lookup[0]['element_9'];
        $_SESSION['name'] = $lookup[0]['element_5']." ".$lookup[0]['element_6'];
        $_SESSION['username'] = $lookup[0]['element_1'];
        $db->query("UPDATE Inetforms.ap_form_64550 SET element_7 = '".date("Y-m-d")."', element_8='".date("H:i:s")."' WHERE id =".$lookup[0]['id']);
    }
    
    
}
?>
</head>
<body>
<?php



if(!isset($_SESSION['billing'])){ 
    echo $_SESSION['username'];
    if($_SESSION['username'] =="RDizon" || $_SESSION['username']=="spyro"){
         print_r($_SESSION['division']);
    }    
?>
<form action="CompletedIOscale.php" method="POST" style="margin-bottom: 50px;">
<table style="width:200px;position:fixed;top:5px;right:5px;border-radius:10px 10px 10px 10px;border:2px solid green;padding:5px 5px 5px 5px;">
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;" type="text" name="scale_name" placeholder="Username"/></td></tr>
<tr><td style="text-align: left;border:0px solid #bbbbbb;"><input style="width: 100%;-moz-box-shadow:inset 0 0 5px green;-webkit-box-shadow: inset 0 0 5px green;box-shadow:       inset 0 0 5px green;box-shadow:inset 0 0 5px green;padding:5px 5px 5px 5px;"  type="password" name="scale_password" placeholder="Password"/></td></tr>
<tr><td colspan="2" style="text-align: right;border:0px solid #bbbbbb;"><input style="width: 100px;height:30px;background:url(img/login_clean.png) no-repeat center center;background-size:100% 100%;border:0px solid #bbbbbb;margin-top:4px;padding:5px 5px 5px 5px;" type="submit" value="" name="scale_login"/></td></tr>
</table>
</form>
<?php
}else {
    echo "<h2>Welcome, $_SESSION[username]&nbsp; <a href='CompletedIOscale.php?task=logout'><img src='img/logout.jpg' title='Logout'/></a></h2>";
    if( $_SESSION['billing']  == 1){
        echo "<a href='manual_ticket.php' rel='shadowbox;width=450;'>Manual Scale Ticket Input</a>";
    }
    ?>
        
<h1>Completed IO Scale</h1>
<div id="tabs" style="width: auto;display:inline-block;">
  <ul>
    <li><a href="#fragment-11" id="approval">In Approvals</a></li>
    <li><a href="#fragment-1"  id="outbound">OutBound</a></li>
    <li><a href="#fragment-2"  id="inbound">Inbound</a></li>
    <li><a href="#fragment-3"  id="outboundmx">OutBound MX</a></li>
    <li><a href="#fragment-4"  id="outboundgrease">OutBound Grease</a></li>
    <li><a href="#fragment-5"  id="outboundbio">OutBound BIO</a></li>
    <li><a href="#fragment-6"  id="rwater">R-Water</a></li>
    <li><a href="#fragment-7"  id="outboundmxgrease">OutBound MX Grease</a></li>
    <li><a href="#fragment-8"  id="ingrease">IN-Grease</a></li>
    <li><a href="#fragment-9"  id="petfood">Petfood</a></li>
    <li><a href="#fragment-10" id="wcs">IN-WCS</a></li>
    <li><a href="#fragment-12" id="approve_tickets">Manual Tickets</a></li>
  </ul>
  
  
  <div id="fragment-12">
  
  </div>
  
  <div id="fragment-11">
  
  </div>
  
  <div id="fragment-1">
    
  </div>
  <div id="fragment-2">
 
  </div>
  <div id="fragment-3">
  
  </div>
  
  <div id="fragment-4">
  
  </div>
  <div id="fragment-5">
  
  </div>
  <div id="fragment-6">
  
  </div>
  
  <div id="fragment-7">
  
  </div>
  
  
  <div id="fragment-8">
  
  </div>
  
  <div id="fragment-9">
  
  </div> 
  <div id="fragment-10">
   
  </div>
</div>
<script>
$(".from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$(".to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});



<?php

 if($_SESSION['billing']==5 || $_SESSION['billing'] == 1){
        ?>
         $(".em").on("change","body",function(){
             
             var o = $(this).closest("tr").find(".backhaul");
            
            if( o.is(":checked") ){
                var bh = 1;
                var first = $(this).val()*1;
                var second =  ($(this).attr('rel')/2) ;
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }else{
                var bh =0;
                var first = $(this).val()*1;
                var second = $(this).attr('rel')*1;
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }
            $.post("update_miles.php",{weight:$(this).attr("weight"),extra_miles:first,backhaul:bh,total_miles: $(this).closest("tr").find(".tm").val()  },function(data){
                
            });
            
         });
         
         $(".backhaul").on("click","body",function(){
            if( $(this).is(":checked") ){
                var bh = 1;
                var first = $(this).closest("tr").find(".em").val()*1;
                var second =  ( $(this).closest("tr").find(".em").attr('rel')/2);
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }else{
                var bh =0;
                var first = $(this).closest("tr").find(".em").val() *1;
                var second = $(this).closest("tr").find(".em").attr('rel')*1;
                alert(  first+second   );
                $(this).closest("tr").find(".tm").val(first+second   );
            }
            
            $.post("update_miles.php",{weight:$(this).attr("weight"),extra_miles:first,backhaul:bh,total_miles:$(this).closest("tr").find(".tm").val()},function(data){
                
            });
         });
        <?php
    }

?>

</script>

    <?php
}



?>

</body>

</html>