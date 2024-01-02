<?php
include "protected/global.php";


    if( isset($_POST['zero_gallon_reason']) ){
        unset($array);
        unset($issue_insert);
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
                    "assigned_to"=>34,
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
        unset($array);
        unset($issue_insert);
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
                    "assigned_to"=>34,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"new",
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
        unset($array);
        unset($issue_insert);
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
                    "assigned_to"=>34,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"new",
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
        unset($array);
        unset($issue_insert);
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
                    "assigned_to"=>34,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"new",
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
        unset($array);
        unset($issue_insert);
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
                    "assigned_to"=>34,
                    "priority_level"=>0,
                    "subject"=>"Route: $_POST[route_id] Schedule: $_POST[schedule_number] Account No: $_POST[account_no] ",
                    "issue_status"=>"new",
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
    
    $h = array(
        "fieldreport"=>$_POST['field_note'],
        "zero_gallon_reason"=>$_POST['zero_gallon_reason'],
        "driver"=>$_POST['driver'],
        "date_of_pickup"=>$_POST['dop'],
        "mileage"=>$_POST['mileage'],
        "zero_2"=>$_POST['zero_gallon_reason2'],
        "zero_3"=>$_POST['zero_gallon_reason3'],
        "zero_4"=>$_POST['zero_gallon_reason4'],
        "zero_5"=>$_POST['zero_gallon_reason5'],
        "day"=>$_POST['day']
    );
    
   $db->where("route_id",$_POST['route_id'])->where("schedule_id",$_POST['schedule_number'])->where("account_no",$_POST['account_no'])->update("iwp_data_table",$h);


?>