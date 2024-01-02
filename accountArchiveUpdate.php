<?php
ini_set("display_errors",0);
include "protected/global.php";

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

		if($db->insert("iwp_archive_reasons",$data)){
			echo "Account $_POST[account_id] has been archived!";
		}

		//Delete any scheduled stops for the archived account
		$scheduled_stops_query = $db->query("SELECT account_no FROM iwp_scheduled_routes WHERE account_no = $_POST[account_id] AND route_status='scheduled'");
		if(count($scheduled_stops_query) > 0){
			$db->query("UPDATE iwp_scheduled_routes SET route_status='deleted', deleted=1 WHERE account_no = $_POST[account_id] AND route_status='scheduled'");
		}

		//Change account status to archived
		$db->query("UPDATE iwp_accounts SET status='Archive' WHERE account_ID = $_POST[account_id]");

		//Complete any issues that are assigned to account
		$active_issues_query = $db->query("SELECT account_no, issue_no FROM iwp_issues WHERE account_no = $_POST[account_id] AND issue_status IN ('active', 'new')");
		if(count($active_issues_query) > 0){
			$issue_closed_explanation = "Account Marked Archived  by user " . $_POST['user_id'] . " on " . date("Y-m-d H:i:s");
			$close_date = date("Y-m-d H:i:s");
			$db->query("UPDATE iwp_issues SET issue_status = 'closed', completed_by = $_POST[user_id], completed_date = '$close_date', completed_explaination = '$issue_closed_explanation' WHERE account_no = $_POST[account_id] AND issue_status IN ('active', 'new')");
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
		$db->insert("xlogs.".$dbprefix."_activity",$track);

	} else {
		echo "Account ID Not Set";
	}
} else {
	echo "Please Log In";
}



?>

