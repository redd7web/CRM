<?php
    include "protected/global.php";
    include "source/css.php";
    include "source/scripts.php";
    ini_set("display_errors",0);

    $account = new Account($_GET['id']);
    $person = new Person();

?>

<style>

tr:nth-child(even).issueTable {
	background-color: #D3D3D3;
}

tr.issueHead {
	background-color:#009900;
	color:white;
	font-size:14px;
}

tr:hover.issueTable {
	background-color:#009900;
}

</style>
<div id="issues" style="height: 100%;">
	<div id="thread" style="width: 100%;height:99%;overflow:auto;">
		<table class="issueTable" id="myTable" style="width: 100%;height:100%;">

			<tr class="issueHead">
				<td style="vertical-align: top;">Update</td>
				<td style="vertical-align: top;">Status</td>
				<td style="vertical-align: top;">Created By</td>
				<td style="vertical-align: top;">Assigned To</td>
				<td style="vertical-align: top;">Priority</td>
				<td style="vertical-align: top;">Subject</td>
				<td style="vertical-align: top;">Note</td>
				<td style="vertical-align: top;">Date</td>
				<td style="vertical-align: top;">Time of Call</td>
			</tr>
			<?php
			 $issues = $db->orderBy("issue_status", "ASC")->orderBy("date_created")->where('account_no',$account->acount_id)->get($dbprefix."_issues");
			 if(count($issues)>0){
				foreach($issues as $issue){
					echo "<tr class='issueTable'>";
					echo "<td style='vertical-align:top;'>";
	
						if ($person->user_id == $issue['assigned_to']){
						    if($issue['issue_status'] == 'closed'){
						        echo "Issue Closed</td>";
                            } else {
                                echo "<a href='viewIssues.php?id=$issue[issue_no]' rel='shadowbox;width=1000px;'>View Issue</a></td>";
                            }
						} else {
								echo "Current User Not Assigned Issue</td>";
						}
				
					echo "<td style='vertical-align:top;'>$issue[issue_status]</td>";
					echo "<td style='vertical-align:top;'>".uNumToName($issue['reported_by']) ."</td>";
					echo "<td style='vertical-align:top;'>".uNumToName($issue['assigned_to']) ."</td>";
					echo "<td style='vertical-align:top;'>".priorityConverter($issue['priority_level'])."</td>";
					echo "<td style='vertical-align:top;'>$issue[subject]</td>";
					echo "<td style='vertical-align:top;'>$issue[message]</td>";
					echo "<td style='vertical-align:top;'>$issue[date_created]</td>";
					echo "<td style='vertical-align:top;'>$issue[time_called]</td>";
					echo "</tr>";
				}
			 }
			?>

		</table>
	</div>
	
<script src="js/general.js">




</script>

