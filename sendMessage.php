<?php
ini_set("display_errors",1);
include "protected/global.php";
$person = new Person();
$header = "From: issue_checker@iwpusa.com\r\n";
$header .= "Reply-To: No-reply@iwpusa.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
$type= "";
$account = new Account($_POST['acnt']);
switch($_POST['type']){
    case 1:
        $dc = date("Y-m-d")." ".date("H:i:s");
        $data = Array(
            "issue"=>"$_POST[issue]",
            "account_no"=>$_POST['acnt'],
            "date_created"=>$dc,
            "message"=>"$_POST[mesg]",
            "assigned_to"=>$_POST['user_id'],
            "reported_by"=> $person->user_id,
            "issue_status"=>"new",
            "priority_level"=>$_POST['priority'],
            "subject"=>$_POST['subject'],
            "time_called"=>$_POST['time_called']
        );

        echo "Issue Assigned to " . uNumToName_plain($_POST['user_id']);

        $emailAddress = $db->where('user_id',$_POST['user_id'])->get($dbprefix . '_users', 'email');

		if(strlen($emailAddress[0]['email']) > 2){
			$to = $emailAddress[0]['email'];
			$subject = 'Issue Assigned For ' . $account->name_plain;
			
			$issueDecode = $db->where('value',$_POST['issue'])->get('iwp_driver_report', 'description');
			
			switch ($_POST['priority']){
				case 10:
					$priority = 'Normal';
					break;
				case 20:
					$priority = 'Urgent';
					break;
				default:
					break;
			}
			
			$message = '<p>Hello, you have been assigned an issue for <b><a href="https://inet.iwpusa.com/viewAccount.php?id=' . $_POST['acnt'] . '">'. $account->name_plain . '</a></b></p>' . 
						'<p><b>Priority Level: </b>' . $priority . '</p>' . 
						 '<p><b>Issue:</b> ' . $issueDecode[0]['description'] .
						 '<p><b>Message:</b> ' . $_POST['mesg'] . '</p>' . 
						 '<p><b>Time of Call:</b> ' . $_POST['time_called'] . '</p>' . 
						 '<b><a href="https://inet.iwpusa.com/viewAccount.php?id=' . $_POST['acnt'] . '">Click here to view account </a></b>'
						;


			$headers = [
				'MIME-Version: 1.0',
				'Content-Type: text/html; charset=ISO-8859-1',
				'From: noreply@iwpusa.com',
				'Cc: bthomas@iwpusa.com, cnutting@iwpusa.com, aparsons@iwpusa.com'
			];
			
			$headers = implode("\r\n", $headers);


/* 			$headers = 'From: noreply@iwpusa.com \r\n';
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; */
			
			mail($to, $subject, $message, $headers);

		}
		

		
        
         $db->insert($dbprefix.'_issues',$data);
   
         $iq = $db->where('message',$_POST['mesg'])->get($dbprefix.'_issues','issue_no');

        $issue_note = Array( // initial message in thread
            "issue_no"=>$iq[0]['issue_no'],
            "message"=>$_POST['mesg'],
            "message_date"=>$dc,
            "created_by"=>$person->user_id
            //"time_called"=>$_POST['time_called'] Column does not exist in the table
        );
		

		
        $db->insert($dbprefix.'_issue_notes',$issue_note);
  
		
 		//$type = "Issue";
        $track = array(
            "date"=>date("Y-m-d H:i:s"),
            "user"=>$person->user_id,
            "actionType"=>"Message Created",
            "descript"=>$_POST['mesg'],
            "account"=>$_POST['acnt'],
            "type"=>13
        );
        $db->insert($dbprefix."_activity",$track);
        break;
    case 2: 
        $type = "Message";
        break;
    case 3:

        $dd =date("Y-m-d");
        
        $data2 = Array(
            "to"=>$_POST['user_id'],
            "by"=>$person->user_id,
            "message"=>$_POST['mesg'],
            "date"=>$dd,
            "status"=>'new'
        );

        echo "Private Message Sent To: ";

        $db->query("INSERT INTO iwp_private VALUES (0,$_POST[user_id],$person->user_id,'$_POST[mesg]','$dd','new')");

        break;

    default:
        echo "Please Select A Message Category ";
        echo "Issue Not Created!";
        break;
}

//echo "$type Created!";




?>