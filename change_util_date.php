<?php
include "protected/global.php";

$person = new Person();
//ini_set("display_errors",1);

if(isset($_POST['sdsds'])){
    $pack = array(  
        'date_of_service'=>$_POST['date_of_service']
    );
    if($db->where('utility_sched_id',$_GET['util_id'])->update("iwp_utility",$pack)){
        echo "<br/>Scheduled date changed successfully!<br/>";
    }
}

$schedule = new Util_Stop($_GET['util_id']);
//print_r($schedule);
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <?php include "source/scripts.php"; include "source/css.php"; ?>
	<title>Untitled 1</title>
    <style>
    body{
        padding:10px 10px 10px 10px;
        margin:10px 10px 10px 10px;
    }
    </style>
</head>
<body>
<form action="change_util_date.php?util_id=<?php echo $schedule->schedule_id; ?>" method="post">
<table style="margin: auto;">
<tr><td colspan="2" style="text-align: center;"><?php echo account_NumToName($schedule->account_number); ?></td></tr>
<tr><td><input id="sd" name="date_of_service" type="text" placeholder="Scheduled Date" value="<?php echo $schedule->scheduled_start_date; ?>"/></td></tr><tr><td><input name="sdsds" type="submit" value="Change scheduled date"/></td></tr></table>
<input type="hidden" value="<?php echo $schedule->schedule_id;?>" name="util_id"/>
</form>
<script>
  
  $("input#sd").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>
</body>
</html>