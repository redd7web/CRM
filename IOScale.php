<?php
include "protected/global.php";
include "source/scripts.php";
include "source/css.php";
include "scaleFunctions.php";
if($_SESSION['username'] == "RDizon"){
   
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
    vertical-align:top;
}
#myTable td {
     padding:5px 5px 5px 5px; 
     vertical-align:middle; 
}

td,th{
    background:transparent;
    text-align:center;
    width:1%;
    font-size:12px;
    vertical-align:middle;
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
    $trimmed = trim($_POST['scale_password']);
    $hash = crypt($trimmed,'$ap_form_64550');
    //echo $hash."<br/>";
    if($_SESSION['username'] =="RDizon"){
        echo "$hash $_POST[scale_name] ";
        //echo "SELECT id,element_9,element_5,element_6,element_1 FROM Inetforms.ap_form_64550 WHERE element_1 = '".trim($_POST['scale_name'])."' AND password = '$hash'";
      
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
<iframe style="width: 100%;height:800px;" src="all_io.php">

</iframe>


</body>
<script type='text/javascript'>
    
    $(function(){
    
        var iFrames = $('iframe');
      
    	function iResize() {
    	
    		for (var i = 0, j = iFrames.length; i < j; i++) {
    		  iFrames[i].style.height = iFrames[i].contentWindow.document.body.offsetHeight + 'px';}
    	    }
    	    
        	if ($.browser.safari || $.browser.opera) { 
        	
        	   iFrames.load(function(){
        	       setTimeout(iResize, 0);
               });
            
        	   for (var i = 0, j = iFrames.length; i < j; i++) {
        			var iSource = iFrames[i].src;
        			iFrames[i].src = '';
        			iFrames[i].src = iSource;
               }
               
        	} else {
        	   iFrames.load(function() { 
        	       this.style.height = 100 + this.contentWindow.document.body.offsetHeight + 'px';
        	   });
        	}
        
        });

</script><script>




</script>
    
    <?php
    
}

?>
</body>
</html>