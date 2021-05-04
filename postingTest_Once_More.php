<?php
ini_set("display_errors",1);
include "protected/global.php";


//$account_id = 44243;
//$subject = 'Route: 47150 Schedule: 1070590 Account No: 44243';
//
//$dateNow = date('Y-m-d');
////echo $dateNow;
//
//$results = $db->where('account_ID', $account_id)->get('iwp_accounts');
//
//$results2 = $db->query("SELECT account_no FROM iwp_issues WHERE DATE_FORMAT(date_created, '%Y-%m-%d') = '$dateNow' AND account_no = $account_id AND subject = '$subject';");
//
//if($results2 > 0){
//	echo $results2[0]['account_no'];
//}
//echo "<br>";
//var_dump($results2);
//
//$array_check = array(
//	'issue'=>'Hello',
//	'number'=>'2'
//);
//
//echo $array_check['issue'];


if(isset($_SESSION['id'])){
	if(isset($_POST['account_id'])){

		if(isset($_POST['competitor_id'])){
			$competitor_id = $_POST['competitor_id'];
		} else {
			$competitor_id = "";
		}

		if(isset($_POST['other_reason'])){
			$other_reason = $_POST['other_reason'];
		} else {
			$other_reason = "";
		}

		$data = array(
			"account_no" => $_POST['account_id'],
			"archive_reason" => $_POST['archive_reason'],
			"competitor_id" => $competitor_id,
			"competitor_other" => $_POST['competitor_other'],
			"other_reason" => $other_reason,
			"date_archived" => date("Y-m-d H:i:s"),
			"user_who_archived" => $_POST['user_id']
		);

//		if($db->insert("iwp_archive_reasons",$data)){
//			echo "Account $_POST[account_id] has been archived!";
//		}



		$scheduled_stops_query = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE account_no = $_POST[account_id] AND route_status='scheduled'");
		if(count($scheduled_stops_query) > 0){
			$db->query("UPDATE iwp_scheduled_routes SET route_status='deleted', deleted=1 WHERE account_no = $_POST[account_id] AND route_status='scheduled'");
		}

		//$db->query("UPDATE iwp_accounts SET status='Archive' WHERE account_ID = $_POST[account_id]");


		$active_issues_query = $db->query("SELECT account_no, issue_no FROM iwp_issues WHERE account_no = $_POST[account_id] AND issue_status IN ('active', 'new')");

		if(count($active_issues_query) > 0){
			$issue_closed_explanation = "Account Marked Archived  by user " . $_POST['user_id'] . " on " . date("Y-m-d H:i:s");
			$close_date = date("Y-m-d H:i:s");
			$db->query("UPDATE iwp_issues SET issue_status = 'closed', completed_by = $_POST[user_id], completed_date = '$close_date', completed_explaination = '$issue_closed_explanation' WHERE account_no = $_POST[account_id] AND issue_status IN ('active', 'new')");
			echo 'Issue closed!';
		} else {
			echo "No issues for account";
		}

		$track = array(
			"date"=>date("Y-m-d H:i:s"),
			"user"=>$_POST['user_id'],
			"actionType"=>"Account Updated",
			"descript"=>"Account $_POST[account_id] changed to archived",
			"account"=>$_POST['account_id'],
			"pertains"=>2,
			"type"=>7
		);

		$dbprefix = 'iwp';
		//$db->insert("xlogs.".$dbprefix."_activity",$track);

	} else {
		echo "Account ID Not Set";
	}
} else {
	echo "Please Log In";
}



?>

