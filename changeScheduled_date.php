<?php
include "protected/global.php";

$person = new Person();

$pack = array(  
    'scheduled_start_date'=>$_POST['scheduled_start_date']
);

$db->where('scheduled_start_date',$_POST['schedule_id'])->update("iwp_scheduled_routes",$pack);
$schedule = new Scheduled_Routes($_GET['schedule_id']);
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />

	<title>Untitled 1</title>
    <style>
    body{
        padding:10px 10px 10px 10px;
        margin:10px 10px 10px 10px;
    }
    </style>
</head>
<body>
<form action="changeScheduled_date.php?schedule_id=<?php echo $schedule->schedule_id; ?>">
<table style="margin: auto;">
<tr><td colspan="2" style="text-align: center;"><?php echo account_NumToName($schedule->account_number); ?></td></tr>
<tr><td><input name="scheduled_start_date" type="text" placeholder="Scheduled Date" value="<?php echo $schedule->scheduled_start_date; ?>"/></td><td><input type="submit" value="Change scheduled date"/></td></tr></table>
<input type="hidden" value="<?php echo $schedule->schedule_id;?>" name="schedule_id"/>
</form>
<script>
   function refreshParent() {              window.opener.location.reload();   window.onunload = refreshParent;                 }  
</script>
</body>
</html>