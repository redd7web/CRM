<?php
ini_set("display_errors",1);
include "protected/global.php";
$person = new Person();
$ant = new Account($_POST['account_no']);
$schedx = new Scheduled_Routes($_POST['schedule_number']);
$scheduled_list = $dbprefix."_scheduled_routes";
$account_table = $dbprefix."_accounts";
$list_of_routes = $dbprefix."_list_of_routes";
$header = "From: issue_checker@iwpusa.com\r\n";
$header .= "Reply-To: No-reply@iwpusa.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
$manager = $db->query("SELECT created_by FROM iwp_list_of_routes WHERE route_id = $_POST[route_id]");


function create_issue_stop_messate($route_id,$schedule_id,$account_no,$post){
    global $db;
    
}



if($_POST['entry'] ==0){//does the entry already exist?
    $data = Array(
        "route_id"=> $_POST['route_id'],
        "schedule_id"=>$_POST['schedule_number'],
        "inches_entered"=>$_POST['inches_entered'],
        "inches_to_gallons"=>$_POST['picked_up'],
        "inches_leftover"=>$_POST['inches_left'],
        "inches_to_gallons_leftover"=>$_POST['inches_to_gallons_leftover'],
        "expected_gallons"=>$_POST['gallons_expected'],
        "avg_exp"=>$schedx->onsite,
        "container_label"=>$_POST['label'],
        "issue_number"=>'',
        "account_no"=>$_POST['account_no'],
        "completed"=>1,
        "fieldreport"=>$_POST['field_note'],
        "zero_gallon_reason"=>$_POST['zero_gallon_reason'],
        "driver"=>$_POST['driver'],
        "date_of_pickup"=>$_POST['dop'],
        "sum"=>$_POST['sum'],
        "mileage"=>$_POST['mileage'],
        "zero_2"=>$_POST['zero_gallon_reason2'],
        "zero_3"=>$_POST['zero_gallon_reason3'],
        "zero_4"=>$_POST['zero_gallon_reason4'],
        "zero_5"=>$_POST['zero_gallon_reason5']
    );
    
    $db->insert('iwp_data_table',$data)."<br/>";
    
    $track = array(
        "date"=>date("Y-m-d H:i:s"),
        "user"=> $person->user_id,
        "actionType"=>"Data entered for route $_POST[route_id]",
        "descript"=>"Data entered value $_POST[picked_up] for STOP $_POST[scedule_number] Account $ant->name Route <form action='oil_routing.php' target='_blank' method='post' class='ikg_form'><span style='font-decoration:underline;color:blue;cursor:pointer;'>$_POST[route_id]</span><input type='hidden' value='$_POST[route_id]' name='manifest'/><input type='hidden' value='1' name='from_routed_oil_pickups'/></form>",
        "pertains"=>8,
        "type"=>14,
        "account"=>$ant->acount_id
    );
    $db->insert("xlogs.".$dbprefix."_activity",$track);
    
    
    if( isset($_POST['zero_gallon_reason']) ){
		switch($_POST['facility']){
			case 5: //Selma
				$facilityIssueManager = 48;
				break;
			case 8: //Arizona
				$facilityIssueManager = 21;
				break;
			default:
				$facilityIssueManager = 34;
				break;
		}
	}
	
		
        switch($_POST['zero_gallon_reason']){
            case "--SELECT--":break;
			
            case 10: case 12://email facility manager
                $manager = Person($manager[0]['created_by']);
                if($ant->percent_full >=.75){
                    $include_it = ",IT@iwpusa.com";
                    $message_include ="at 75% or greater";
                    
                }
                mail("$manager->email_address $include_it","Stop Skipped $message_include","Route: $_POST[route_id] \r\n Schedule: $_POST[schedule_number] \r\n Account: $_POST[account_no] \r\n Skip code : $_POST[zero_gallon_reason] \r\n Field Report: $_POST[field_note] \r\n <a href='enterData.php?route_id=$_POST[route_id]&day=1'>View Route Details Here.</a>","$header");
            break;
            
            
            
            default: // insert issue into issue table
                 $issue_insert = array(
                    "issue"=>$_POST['zero_gallon_reason'],
                    "account_no"=>$_POST['account_no'],
                    "date_created"=>date("Y-m-d H:i:s"),
                    "message"=>$_POST['field_note'],
                    "reported_by"=>$person->user_id,
                    "assigned_to"=>$facilityIssueManager,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"active",
                    "route_id"=>$_POST['route_id'],
                    "schedule_id"=>$_POST['schedule_id']
                );
                $db->insert("iwp_issues",$issue_insert);
                $id =$db->getInsertId();
                
                $array = array(
                    "account_no"=>$_POST['account_no'],
                    "route_status"=>"scheduled",
                    "issue_code"=>$_POST['zero_gallon_reason'],
                    "code_red"=>1,
                    "created_by"=>$person->user_id,
                    "issue_associated"=>$id,
                    "driver_note"=>ZG_decode($stops['zero_gallon_reason'])." FROM stop: $_POST[schedule_number] Route $_POST[route_id]"
                );   
                $db->insert("iwp_utility",$array);
                
            break;
        }
    }
    
    
    if(isset($_POST['zero_gallon_reason2'])){
		
		
		switch($_POST['facility']){
			case 5: //Selma
				$facilityIssueManager = 48;
				break;
			case 8: //Arizona
				$facilityIssueManager = 21;
				break;
			default:
				$facilityIssueManager = 34;
				break;
		}
		
	}	
		
        switch($_POST['zero_gallon_reason2']){
            case "--SELECT--": break;
            case 10: case 12://email facility manager
                $manager = Person($manager[0]['created_by']);
                if($ant->percent_full >=.75){
                    $include_it = ",IT@iwpusa.com";
                    $message_include ="at 75% or greater";
                    
                }
                mail("$manager->email_address $include_it","Stop Skipped $message_include","Route: $_POST[route_id] \r\n Schedule: $_POST[schedule_number] \r\n Account: $_POST[account_no] \r\n Skip code : $_POST[zero_gallon_reason] \r\n Field Report: $_POST[field_note] \r\n <a href='enterData.php?route_id=$_POST[route_id]&day=1'>View Route Details Here.</a>","$header");
            break;
            default: // insert issue into issue table
                 $issue_insert = array(
                    "issue"=>$_POST['zero_gallon_reason2'],
                    "account_no"=>$_POST['account_no'],
                    "date_created"=>date("Y-m-d H:i:s"),
                    "message"=>$_POST['field_note'],
                    "reported_by"=>$person->user_id,
                    "assigned_to"=>$facilityIssueManager,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"active",
                    "route_id"=>$_POST['route_id'],
                    "schedule_id"=>$_POST['schedule_id']
                );
                $db->insert("iwp_issues",$issue_insert);
                $id =$db->getInsertId();
                
                $array = array(
                    "account_no"=>$_POST['account_no'],
                    "route_status"=>"scheduled",
                    "issue_code"=>$_POST['zero_gallon_reason2'],
                    "code_red"=>1,
                    "created_by"=>$person->user_id,
                    "issue_associated"=>$id
                );   
                $db->insert("iwp_utility",$array);
                
            break;
        }
    }
    
    if(isset($_POST['zero_gallon_reason3'])){
		
		
		switch($_POST['facility']){
			case 5: //Selma
				$facilityIssueManager = 48;
				break;
			case 8: //Arizona
				$facilityIssueManager = 21;
				break;
			default:
				$facilityIssueManager = 34;
				break;
		}
	}	
		
		
        switch($_POST['zero_gallon_reason3']){
            case "--SELECT--": break;
            case 10: case 12://email facility manager
                $manager = Person($manager[0]['created_by']);
                if($ant->percent_full >=.75){
                    $include_it = ",IT@iwpusa.com";
                    $message_include ="at 75% or greater";
                    
                }
                mail("$manager->email_address $include_it","Stop Skipped $message_include","Route: $_POST[route_id] \r\n Schedule: $_POST[schedule_number] \r\n Account: $_POST[account_no] \r\n Skip code : $_POST[zero_gallon_reason] \r\n Field Report: $_POST[field_note] \r\n <a href='enterData.php?route_id=$_POST[route_id]&day=1'>View Route Details Here.</a>","$header");
            break;
            default: // insert issue into issue table
                 $issue_insert = array(
                    "issue"=>$_POST['zero_gallon_reason3'],
                    "account_no"=>$_POST['account_no'],
                    "date_created"=>date("Y-m-d H:i:s"),
                    "message"=>$_POST['field_note'],
                    "reported_by"=>$person->user_id,
                    "assigned_to"=>$facilityIssueManager,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"active",
                    "route_id"=>$_POST['route_id'],
                    "schedule_id"=>$_POST['schedule_id']
                );
                $db->insert("iwp_issues",$issue_insert);
                $id =$db->getInsertId();
                
                $array = array(
                    "account_no"=>$_POST['account_no'],
                    "route_status"=>"scheduled",
                    "issue_code"=>$_POST['zero_gallon_reason3'],
                    "code_red"=>1,
                    "created_by"=>$person->user_id,
                    "issue_associated"=>$id
                );   
                $db->insert("iwp_utility",$array);
                
            break;
        }
    }
    
    
    if(isset($_POST['zero_gallon_reason4'])){
		
		switch($_POST['facility']){
			case 5: //Selma
				$facilityIssueManager = 48;
				break;
			case 8: //Arizona
				$facilityIssueManager = 21;
				break;
			default:
				$facilityIssueManager = 34;
				break;
		}
	}	
		
        switch($_POST['zero_gallon_reason4']){
            case "--SELECT--": break;
            case 10: case 12://email facility manager
                $manager = Person($manager[0]['created_by']);
                if($ant->percent_full >=.75){
                    $include_it = ",IT@iwpusa.com";
                    $message_include ="at 75% or greater";
                    
                }
                mail("$manager->email_address $include_it","Stop Skipped $message_include","Route: $_POST[route_id] \r\n Schedule: $_POST[schedule_number] \r\n Account: $_POST[account_no] \r\n Skip code : $_POST[zero_gallon_reason] \r\n Field Report: $_POST[field_note] \r\n <a href='enterData.php?route_id=$_POST[route_id]&day=1'>View Route Details Here.</a>","$header");
            break;
            default: // insert issue into issue table
                 $issue_insert = array(
                    "issue"=>$_POST['zero_gallon_reason4'],
                    "account_no"=>$_POST['account_no'],
                    "date_created"=>date("Y-m-d H:i:s"),
                    "message"=>$_POST['field_note'],
                    "reported_by"=>$person->user_id,
                    "assigned_to"=>$facilityIssueManager,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"active",
                    "route_id"=>$_POST['route_id'],
                    "schedule_id"=>$_POST['schedule_id']
                );
                $db->insert("iwp_issues",$issue_insert);
                $id =$db->getInsertId();
                
                $array = array(
                    "account_no"=>$_POST['account_no'],
                    "route_status"=>"scheduled",
                    "issue_code"=>$_POST['zero_gallon_reason4'],
                    "code_red"=>1,
                    "created_by"=>$person->user_id,
                    "issue_associated"=>$id
                );   
                $db->insert("iwp_utility",$array);
                
            break;
        }
    }
    
    
    
    if(isset($_POST['zero_gallon_reason5'])){
		
		switch($_POST['facility']){
			case 5: //Selma
				$facilityIssueManager = 48;
				break;
			case 8: //Arizona
				$facilityIssueManager = 21;
				break;
			default:
				$facilityIssueManager = 34;
				break;
		}
	}	
		
		
        switch($_POST['zero_gallon_reason5']){
            case "--SELECT--": break;
            case 10: case 12://email facility manager
                $manager = Person($manager[0]['created_by']);
                if($ant->percent_full >=.75){
                    $include_it = ",IT@iwpusa.com";
                    $message_include ="at 75% or greater";
                    
                }
                mail("$manager->email_address $include_it","Stop Skipped $message_include","Route: $_POST[route_id] \r\n Schedule: $_POST[schedule_number] \r\n Account: $_POST[account_no] \r\n Skip code : $_POST[zero_gallon_reason] \r\n Field Report: $_POST[field_note] \r\n <a href='enterData.php?route_id=$_POST[route_id]&day=1'>View Route Details Here.</a>","$header");
            break;
            default: // insert issue into issue table
                 $issue_insert = array(
                    "issue"=>$_POST['zero_gallon_reason5'],
                    "account_no"=>$_POST['account_no'],
                    "date_created"=>date("Y-m-d H:i:s"),
                    "message"=>$_POST['field_note'],
                    "reported_by"=>$person->user_id,
                    "assigned_to"=>$facilityIssueManager,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"active",
                    "route_id"=>$_POST['route_id'],
                    "schedule_id"=>$_POST['schedule_id']
                );
                $db->insert("iwp_issues",$issue_insert);
                $id =$db->getInsertId();
                
                $array = array(
                    "account_no"=>$_POST['account_no'],
                    "route_status"=>"scheduled",
                    "issue_code"=>$_POST['zero_gallon_reason5'],
                    "code_red"=>1,
                    "created_by"=>$person->user_id,
                    "issue_associated"=>$id
                );   
                $db->insert("iwp_utility",$array);
                
            break;
        }
    }
    
    //echo  "<img src='img/check_green_2s.png'/>&nbsp;".$ant->name." inserted with $_POST[picked_up] gallons"; 
    $packx = array(
        "date_of_last_pickup"=>$_POST['dop'],
        "amount_of_last_pickup"=>$_POST['picked_up']
    );
    
    
}else {
    $data = Array(
        "route_id"=> $_POST['route_id'],
        "schedule_id"=>$_POST['schedule_number'],
        "inches_entered"=>$_POST['inches_entered'],
        "inches_to_gallons"=>$_POST['picked_up'],
        "inches_leftover"=>$_POST['inches_left'],
        "inches_to_gallons_leftover"=>$_POST['inches_to_gallons_leftover'],
        "expected_gallons"=>$_POST['gallons_expected'],
        "avg_exp"=>$schedx->onsite,
        "container_label"=>$_POST['label'],
        "issue_number"=>'',
        "account_no"=>$_POST['account_no'],
        "completed"=>1,
        "fieldreport"=>$_POST['field_note'],
        "zero_gallon_reason"=>$_POST['zero_gallon_reason'],
        "driver"=>$_POST['driver'],
        "sum"=>$_POST['sum'],
        "mileage"=>$_POST['mileage'],
        "zero_2"=>$_POST['zero_gallon_reason2'],
        "zero_3"=>$_POST['zero_gallon_reason3'],
        "zero_4"=>$_POST['zero_gallon_reason4'],
        "zero_5"=>$_POST['zero_gallon_reason5']
    );
    $packx = array(
        "amount_of_last_pickup"=>$_POST['picked_up']
    );
    //echo "<img src='img/check_green_2s.png'/>&nbsp;".$ant->name." updated with $_POST[picked_up] gallons"; 
    echo $db->where("deleted",0)->where('entry_number',$_POST['entry'])->update($dbprefix."_data_table",$data)."<br/>";
    
    
    $track = array(
        "date"=>date("Y-m-d H:i:s"),
        "user"=> $person->user_id,
        "actionType"=>"Data updated for route $_POST[route_id]",
        "descript"=>"Data Updated value $_POST[picked_up] for STOP $_POST[scedule_number] Account $ant->name Route <form action='oil_routing.php' target='_blank' method='post' class='ikg_form'><span style='font-decoration:underline;color:blue;cursor:pointer;'>$_POST[route_id]</span><input type='hidden' value='$_POST[route_id]' name='manifest'/><input type='hidden' value='1' name='from_routed_oil_pickups'/></form>",
        "pertains"=>8,
        "type"=>14,
        "account"=>$ant->acount_id
    );
    $db->insert("xlogs.".$dbprefix."_activity",$track);
    
}





//mark current schedule complete
$db->query("UPDATE $scheduled_list SET route_status ='completed' WHERE schedule_id = $_POST[schedule_number] AND deleted =0");

/*
echo "<pre>";
print_r($data);
echo "</pre>";
*/


$y = $db->query("SELECT SUM(inches_to_gallons) as cur_tot FROM iwp_data_table WHERE route_id=$_POST[route_id] AND deleted =0");
$db->query("UPDATE iwp_list_of_routes set collected = ".$y[0]['cur_tot']." WHERE route_id=$_POST[route_id]");
$db->query("UPDATE iwp_scheduled_routes SET route_status='completed' WHERE schedule_id=$_POST[schedule_number] AND route_id=$_POST[route_id] AND deleted=0");
$nb =$db->query("SELECT schedule_id FROM iwp_scheduled_routes WHERE route_id= $_POST[route_id] AND route_status='enroute' AND deleted =0");
$incs = count($nb);
$db->query("UPDATE iwp_list_of_routes SET inc = $incs WHERE route_id=$_POST[route_id] AND deleted =0");
$db->where("account_ID",$_POST['account_no'])->update("iwp_accounts",$packx);



?>