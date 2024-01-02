<?php
include "protected/global.php";
ini_set("display_errors",1);

if(isset($_POST['assign_to'])){
    $db->query("UPDATE iwp_scheduled_routes SET issues_associated = $_POST[issue_to_assign] WHERE schedule_id =$_GET[schedule_id]");
    
    echo "Issue successfully assigned to schedule id: $_GET[schedule_id]";
}

 $i = $db->query("SELECT issue_no,issue FROM iwp_issues WHERE account_no = $_GET[account_no] AND issue_status  = 'new'  AND issue_no NOT IN ( SELECT issue_associated FROM iwp_scheduled_routes WHERE issue_associated IS NOT NULL ) ");

?>

<table><tr><td></td><td><?php  
 
  
  if(count($i)>0){
    echo "<form action='assign_issue.php?account_no=$_GET[account_no]&schedue_id=$_GET[schedule_id]' method='POST'><select name='issue_to_assign'>";
    foreach($i as $m){
        echo "<option value='$m[issue_no]'>$m[issue])".ZG_decode($m['issue'])."</option>";
    }
    echo "</select><input value='Assign this' type='submit' name='assign_to'/></form>";
  }else{
    echo "No open Issues associated with this account.";
  }

?></td></tr></table>