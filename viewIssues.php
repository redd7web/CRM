<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8"/>
<?php 
include "protected/global.php";

$it = array(
    2060,
    2028,
    99,
    2030
);

if(isset($_SESSION['id'])){
    $person = new Person();
    
    if( in_array($person->user_id,$it) ){
        ini_set("display_errors",1);    
    }
    ?>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="css/style.css"/>
    
    
    <style type="text/css">
    
    ::-webkit-scrollbar {
        width: 15px;
        height: 15px;
        border-bottom: 1px solid #eee; 
        border-top: 1px solid #eee;
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 8px;
        background-color: #C3C3C3;
        border: 2px solid #eee;
    }
    
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.2); 
    } 
    
    #adduser { 
        box-shadow:         1px 1px 3px 3px #70a170;
        width: 550px;min-height:400px;height:auto;margin:10px auto;border-radius:10px;border:1px solid black;padding-top:10px;
        padding-bottom:10px;
        
    }
    body{
        font-family:arial;
    }
    td{
        border:1px solid #ccc;
    }
    </style>
    </head>
    <body>
    <?php
    
    if(isset($_POST['upl_corresp'])){
        $temp = explode(".",$_FILES["file"]["name"]);
        $newfilename = "Correspondance_letter-$_POST[account].".end($temp);
        $newfilename = str_replace(" ","_",$newfilename);
        if (!is_dir("container_removal_photos/$_POST[account]")) {
            mkdir("container_removal_photos/$_POST[account]/", 0777, true);
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], "container_removal_photos/$_POST[account]/" . $newfilename);
    }
    
    if(isset($_POST['cancel_'])){ // cancel process
        $update_issue = array(
            "reason_for_not_send"=>$_POST['decision_explaination'],
            "container_removal_notice_not_sent"=>0,
            "container_removal_notice_sent"=>0,
            "container_removal_cancelled"=>1,
            "completed_date"=>date("Y-m-d"),
            "completed_by"=>$person->user_id,
            "issue_status"=>"completed",
            "issue_completed"=>1,
            "completed_explaination"=>$_POST['decision_explaination']
        );
        $db->where("issue_no",$_GET['id'])->update("iwp_issues",$update_issue);//update issues that notice has been cancelled with explaination
        $db->where("issue_associated",$_GET['id'])->where("status","scheduled")->delete("iwp_utility");//delete util stop
        mail("disen@iwpusa.com,akramer@iwpusa.com","Container Removal process cancelled","Account: ".account_NumToName($_POST['accountx'])." \r\n Issue: $_GET[id]"  );
    }
    
    if(isset($_POST['dsrn'])){//notice not sent
        mail("disen@iwpusa.com,akramer@iwpusa.com","Notice not sent for container removal request","Account: ".account_NumToName($_POST['accountx'])." letter not sent for this account\r\n Issue: $_GET[id]"  );
        $update_issue = array(
            "reason_for_not_send"=>$_POST['decision_explaination'],
            "container_removal_notice_not_sent"=>1,
            "container_removal_notice_sent"=>0
        );
        $db->where("issue_no",$_GET['id'])->update("iwp_issues",$update_issue);
    }
    
    if(isset($_POST['srn'])){//notice sent
        
        $update_issue = array(
            "reason_for_not_send"=>$_POST['decision_explaination'],
            "container_removal_notice_not_sent"=>0,
            "container_removal_notice_sent"=>1
        );
        $db->where("issue_no",$_GET['id'])->update("iwp_issues",$update_issue);
        
        $util_sched = array(
            "created_by"=>$person->user_id,
            "account_no"=>$_POST['accountx'],
            "type_of_service"=>4,
            "date_of_service"=>date("Y-m-d",strtotime("+15 days")),
            "container_size"=>0,
            "container_label"=>217,
            "code_red"=>0,
            "route_status"=>"scheduled",
            "deleted"=>0,
            "issue_associated"=>$_GET['id'],
            "stop_notes "=>$_POST['decision_explaination']
        );
        $db->insert("iwp_utility",$util_sched);
    }
    
    if(isset($_POST['route_now'])){
        $at = new Account($_POST['account_no']);
        switch($_POST['stop_type']){
            case "oil":
                $scheduled_stop = array(
                    "account_no"=>$_POST['account_no'],
                    "route_id"=>null,
                    "scheduled_start_date"=>$_POST['schedule_stop'],
                    "issue_associated"=>$_POST['issue_number'],
                    "facility_origin"=>$at->division,
                    "route_status"=>"scheduled",
                    "created_by"=>$person->user_id,
                    "date_created"=>date("Y-m-d"),
                    "code_red"=>2,
                    "driver"=>$_POST['drivers'],
                    "created_by"=>$person->user_id
                );
                $db->insert("iwp_scheduled_routes",$scheduled_stop);
                $id =$db->getInsertId();
                ?>
                <form action="oil_routing.php" target="_blank" method="POST" id="route_now_from">
                <input type="hidden"  name="from_schoipu" value="1" />
                <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers" value="<?php echo $id."|"; ?>" readonly=""/>
                <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" value="<?php echo $_POST['account_no']."|"; ?>" readonly=""/>
                </form>
                 <script>
                    //$("#route_now_from").submit();
                </script>
                <?php
            
                break;
                case "util":
                     /******************** 
                container_size is the account owned container(s) - using entry number for future deletion
                swap_list is the one you want
                *****************************************************************/
                    switch($_POST['call_type']){
                            case 100: // swap
                                $array = array(
                                    "account_no"=>$_POST['account_no'],
                                    "type_of_service"=>$_POST['call_type'],       
                                    "date_of_service"=>$_POST['schedule_stop'],
                                    "container_size"=>container_amountHolds($_POST['swap_list']),
                                    "container_label"=>$_POST['swap_list'], 
                                    "quantity"=>$_POST['num_containers'],
                                    "route_status"=>"scheduled",
                                    "code_red"=>2,
                                    "container_being_swapped_size"=>container_amountHolds_from_containers($_POST['container_size']),//amounts_holds
                                    "container_being_swapped_label"=>container_own_label($_POST['container_size']),       //id->label
                                    "entry_for_deletion"=>$_POST['container_size'],
                                    "created_by"=>$person->user_id,
                                    "issue_associated"=>$_POST['issue_number']
                                );
                            break;
                            case 4: // container retrieval
                                $uy = $db->query("SELECT container_no from iwp_containers WHERE entry = $_POST[container_size] AND account_no= $_POST[account_no]");
                                $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$uy[0]['container_no']);
                                $array = array(
                                    "account_no"=>$_POST['account_no'],
                                    "type_of_service"=>$_POST['call_type'],       
                                    "date_of_service"=>$_POST['schedule_stop'],
                                    "container_size"=>$yv[0]['amount_holds'],
                                    "container_label"=>$_POST['container_size'],        
                                    "dispatcher_note"=>$_POST['dispatcher_note'],
                                    "driver_note"=>$_POST['special_instructions'],
                                    "quantity"=>$_POST['num_containers'],
                                    "route_status"=>"scheduled",
                                    "code_red"=>2,
                                    "entry_for_deletion"=>$_POST['container_size'],
                                    "created_by"=>$person->user_id,
                                    "issue_associated"=>$_POST['issue_number']
                                );    
                            break;
                            default:
                                $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$_POST['container_size']);
                                $array = array(
                                    "account_no"=>$_POST['account_no'],
                                    "type_of_service"=>$_POST['call_type'],       
                                    "date_of_service"=>$_POST['schedule_stop'],
                                    "container_size"=>$yv[0]['amount_holds'],
                                    "container_label"=>$_POST['container_size'],        
                                    "dispatcher_note"=>$_POST['dispatcher_note'],
                                    "driver_note"=>$_POST['special_instructions'],
                                    "quantity"=>$_POST['num_containers'],
                                    "route_status"=>"scheduled",
                                    "code_red"=>2,
                                    "created_by"=>$person->user_id,
                                    "issue_associated"=>$_POST['issue_number']
                                );    
                            break;
                    }
                    $db->insert("iwp_utility",$array);
                    $id =$db->getInsertId();
                ?>
                <form id="schedule_stop" method="post" action="ikg_routing.php" target="_blank">
                    <input type="hidden" name="add_to_existing" id="add_to_existing" value="1" readonly="" title="Add to existing value"/>
                    <input type="hidden" class="schecheduled_ids" value="<?php echo $id."|"; ?>"  name="schecheduled_ids"  placeholder="schedule numbers"/>
                    <input type="hidden" class="accounts_checked" value=" <?php echo $_POST['account_no']."|"; ?>" name="accounts_checked" placeholder="account numbers" />
                    <input type="hidden" value="1" name="from_schedule_list"/>
                </form>
                <script>
                    $("document").ready(function(){
                        $("#schedule_stop").submit();    
                    });
                </script>
            <?php
            break;
            default:
                echo "Please choose a stop type<br/>";
            break;
        }
        
        $act = array (
            "action_taken"=>1
        );
        $db->where("issue_no",$_POST['issue_number'])->update("iwp_issues",$act);
    }
    
    
    if(isset($_POST['add_to_route'])){
        $at = new Account($_POST['account_no']);
        print_r($_POST);
        switch($_POST['stop_type']){
            case "oil":
                $scheduled_stop = array(
                    "account_no"=>$_POST['account_no'],
                    "route_id"=>null,
                    "scheduled_start_date"=>$_POST['schedule_stop'],
                    "issue_associated"=>$_POST['issue_number'],
                    "facility_origin"=>$at->division,
                    "route_status"=>"scheduled",
                    "created_by"=>$person->user_id,
                    "date_created"=>date("Y-m-d"),
                    "code_red"=>2,
                    "driver"=>$_POST['drivers'],
                    "created_by"=>$person->user_id
                );
                $db->insert("iwp_scheduled_routes",$scheduled_stop);
                $id =$db->getInsertId();
                ?>
                <form action="oil_routing.php" method="POST" target="_blank" id="add_form">
                <input type="hidden" name="manifest" value="<?php echo $_POST['manifest']; ?>" readonly=""/>
                <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers" value="<?php echo $id."|"; ?>" readonly=""/>
                <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" value="<?php echo $_POST['account_no']."|"; ?>" readonly=""/>
                <input type="hidden" name="from_routed_oil_pickups" value="1" readonly=""/>
                <input type="hidden" name="extra_mode" value="1" readonly=""/>
                </form>
                <script>
                    $("document").ready(function(){
                        $("#add_form").submit();    
                    });
                </script>
                <?php
            break;
            case "util":
                /******************** 
            container_size is the account owned container(s) - using entry number for future deletion
            swap_list is the one you want
            *****************************************************************/
                switch($_POST['call_type']){
                        case 100: // swap
                            $array = array(
                                "account_no"=>$_POST['account_no'],
                                "type_of_service"=>$_POST['call_type'],       
                                "date_of_service"=>$_POST['schedule_stop'],
                                "container_size"=>container_amountHolds($_POST['swap_list']),
                                "container_label"=>$_POST['swap_list'], 
                                "quantity"=>$_POST['num_containers'],
                                "route_status"=>"scheduled",
                                "code_red"=>2,
                                "container_being_swapped_size"=>container_amountHolds_from_containers($_POST['container_size']),//amounts_holds
                                "container_being_swapped_label"=>container_own_label($_POST['container_size']),       //id->label
                                "entry_for_deletion"=>$_POST['container_size'],
                                "created_by"=>$person->user_id,
                                "issue_associated"=>$_POST['issue_number']
                            );
                        break;
                        case 4: // container retrieval
                            $uy = $db->query("SELECT container_no from iwp_containers WHERE entry = $_POST[container_size] AND account_no= $_POST[account_no]");
                            $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$uy[0]['container_no']);
                            $array = array(
                                "account_no"=>$_POST['account_no'],
                                "type_of_service"=>$_POST['call_type'],       
                                "date_of_service"=>$_POST['schedule_stop'],
                                "container_size"=>$yv[0]['amount_holds'],
                                "container_label"=>$_POST['container_size'],        
                                "dispatcher_note"=>$_POST['dispatcher_note'],
                                "driver_note"=>$_POST['special_instructions'],
                                "quantity"=>$_POST['num_containers'],
                                "route_status"=>"scheduled",
                                "code_red"=>2,
                                "entry_for_deletion"=>$_POST['container_size'],
                                "created_by"=>$person->user_id,
                                "issue_associated"=>$_POST['issue_number']
                            );    
                        break;
                        default:
                            $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$_POST['container_size']);
                            $array = array(
                                "account_no"=>$_POST['account_no'],
                                "type_of_service"=>$_POST['call_type'],       
                                "date_of_service"=>$_POST['schedule_stop'],
                                "container_size"=>$yv[0]['amount_holds'],
                                "container_label"=>$_POST['container_size'],        
                                "dispatcher_note"=>$_POST['dispatcher_note'],
                                "driver_note"=>$_POST['special_instructions'],
                                "quantity"=>$_POST['num_containers'],
                                "route_status"=>"scheduled",
                                "code_red"=>2,
                                "created_by"=>$person->user_id,
                                "issue_associated"=>$_POST['issue_number']
                            );    
                        break;
                }
                $db->insert("iwp_utility",$array);
                $id =$db->getInsertId();
                ?>
                <form id="sent_to_ikg_routing" method="post" action="ikg_routing.php" target="_blank">
                    <input type="hidden" name="add_to_existing" id="add_to_existing" value="1" readonly="" title="Add to existing value"/>
                    <input type="hidden" class="schecheduled_ids" value="<?php echo $id."|"; ?>"  name="schecheduled_ids"  placeholder="schedule numbers"/>
                    <input type="hidden" class="accounts_checked" value=" <?php echo $_POST['account_no']."|"; ?>" name="accounts_checked" placeholder="account numbers" />
                    <input type='hidden' value='<?php echo $_POST['util_routes']; ?>' name='util_number'/>
                    <input type='hidden' value='1' name='from_routed_util_list'/>
                </form>
                 <script>
                    $("document").ready(function(){
                        $("#sent_to_ikg_routing").submit();    
                    });
                </script>
                <?php
            break;
            default:
                echo "Please choose a stop type<br/>";
            break;
        }
    }
    
    
    if(isset($_POST['create_stop'])){
        $at = new Account($_POST['account_no']);
        switch($_POST['stop_type']){
            case "oil":
                $scheduled_stop = array(
                    "account_no"=>$_POST['account_no'],
                    "route_id"=>null,
                    "scheduled_start_date"=>$_POST['schedule_stop'],
                    "issue_associated"=>$_POST['issue_number'],
                    "facility_origin"=>$at->division,
                    "route_status"=>"scheduled",
                    "created_by"=>$person->user_id,
                    "date_created"=>date("Y-m-d"),
                    "code_red"=>0,
                    "driver"=>$_POST['drivers'],
                    "stop_notes"=>$_POST['stop_notes']
                );
                $db->insert("iwp_scheduled_routes",$scheduled_stop);
            break;
            case "util":
                /******************** 
                container_size is the account owned container(s) - using entry number for future deletion
                swap_list is the one you want
                *****************************************************************/
                switch($_POST['call_type']){
                        case 100: // swap
                            $array = array(
                                "account_no"=>$_POST['account_no'],
                                "type_of_service"=>$_POST['call_type'],       
                                "date_of_service"=>$_POST['schedule_stop'],
                                "container_size"=>container_amountHolds($_POST['swap_list']),
                                "container_label"=>$_POST['swap_list'], 
                                "quantity"=>$_POST['num_containers'],
                                "route_status"=>"scheduled",
                                "code_red"=>1,
                                "container_being_swapped_size"=>container_amountHolds_from_containers($_POST['container_size']),//amounts_holds
                                "container_being_swapped_label"=>container_own_label($_POST['container_size']),       //id->label
                                "entry_for_deletion"=>$_POST['container_size'],
                                "created_by"=>$person->user_id,
                                "issue_associated"=>$_POST['issue_number'],
                                "stop_notes"=>$_POST['stop_notes']
                            );
                        break;
                        case 4: // container retrieval
                            $uy = $db->query("SELECT container_no from iwp_containers WHERE entry = $_POST[container_size] AND account_no= $_POST[account_no]");
                            $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$uy[0]['container_no']);
                            $array = array(
                                "account_no"=>$_POST['account_no'],
                                "type_of_service"=>$_POST['call_type'],       
                                "date_of_service"=>$_POST['schedule_stop'],
                                "container_size"=>$yv[0]['amount_holds'],
                                "container_label"=>$_POST['container_size'],        
                                "dispatcher_note"=>$_POST['dispatcher_note'],
                                "driver_note"=>$_POST['special_instructions'],
                                "quantity"=>$_POST['num_containers'],
                                "route_status"=>"scheduled",
                                "code_red"=>1,
                                "entry_for_deletion"=>$_POST['container_size'],
                                "created_by"=>$person->user_id,
                                "issue_associated"=>$_POST['issue_number'],
                                "stop_notes"=>$_POST['stop_notes']
                            );    
                        break;
                        default:
                            $yv = $db->query("SELECT amount_holds FROM iwp_list_of_containers WHERE container_id =".$_POST['container_size']);
                            $array = array(
                                "account_no"=>$_POST['account_no'],
                                "type_of_service"=>$_POST['call_type'],       
                                "date_of_service"=>$_POST['schedule_stop'],
                                "container_size"=>$yv[0]['amount_holds'],
                                "container_label"=>$_POST['container_size'],        
                                "dispatcher_note"=>$_POST['dispatcher_note'],
                                "driver_note"=>$_POST['special_instructions'],
                                "quantity"=>$_POST['num_containers'],
                                "route_status"=>"scheduled",
                                "code_red"=>1,
                                "created_by"=>$person->user_id,
                                "issue_associated"=>$_POST['issue_number'],
                                "stop_notes"=>$_POST['stop_notes']
                            );    
                        break;
                }
                $db->insert("iwp_utility",$array);
                $ik =$db->getInsertId();
                ?>
                <form id="sent_to_ikg_routing" method="post" action="ikg_routing.php" target="_blank">
                    <input type="hidden" class="schecheduled_ids" value="<?php echo $ik."|"; ?>"  name="schecheduled_ids"  placeholder="schedule numbers"/>
                    <input type="hidden" class="accounts_checked" value=" <?php echo $_POST['account_no']."|"; ?>" name="accounts_checked" placeholder="account numbers" />
                    <input type='hidden' value='<?php echo $_POST['util_routes']; ?>' name='util_number'/>
                   <input type="hidden" value="1" name="from_schedule_list"/>
                </form>
                 <script>
                    $("document").ready(function(){
                        $("#sent_to_ikg_routing").submit();    
                    });
                </script>
                <?php
            break;
            default:
                echo "Please choose a stop type.<br/>";
            break;
        }
        $act = array (
            "action_taken"=>1
        );
        $db->where("issue_no",$_POST['issue_number'])->update("iwp_issues",$act);
    }
    
    if(isset($_POST['close_issue'])){
        if(isset($_POST['mark_closed']) && strlen( trim($_POST['explain_text']) ) >0 ){
            $issue_pack = array(
                "issue_status"=>"closed",
                "completed_date"=>date("Y-m-d"),
                "completed_explaination"=>$_POST['explain_text']
            );
            //print_r($issue_pack);

// ___________________________________________________EMAIL SEND ON COMPLETION_________
            $reported_by = $db->query("SELECT email FROM iwp_users WHERE user_id = $_POST[reported_by]");
            $to = $reported_by[0]['email'];

            $issue_information = $db->query("SELECT issue_no, issue, assigned_to, subject, completed_explaination, account_no FROM iwp_issues WHERE issue_no = $_POST[issue_id]");
            //print_r($issue_information);
            //echo $to;
            $subject = "Account: " . account_NumtoName_plain($issue_information[0]['account_no']) . " Issue # " . $issue_information[0]['issue_no']  . " Completed";
            $message = "<style>
                        </style>
                        
                        <body>
                            <p><b>Issue # </b>" . $issue_information[0]['issue_no'] . " has been completed.</p>
                            <p><b>Account:</b> " . account_NumtoName_plain($issue_information[0]['account_no']) . "</p>
                            <p><b>Issue Description: </b>" . ZG_decode_description($issue_information[0]['issue']) . "</p>
                            <p><b>Subject: </b>" . $issue_information[0]['subject'] . "</p>
                            <p><b>Completed By: </b>" . uNumToName_plain($issue_information[0]['assigned_to']) . "</p>
                            <p><b>Completed Date: </b>" . date("Y-m-d") . "</p>
                            <p><b>Completion Explanation:</b> " . $issue_information[0]['completed_explaination'] . "</p>

                            
                            
                        </body>






";

            //echo $message;

            $headers = 'From: noreply@iwpusa.com \r\n';
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to, $subject, $message, $headers);

            if( $db->where("account_no",$_POST['account_no'])->update("iwp_issues",$issue_pack) ){
                echo "<span style='font-size:20px;color:green;'>Issue has been closed</span>";
            }
            
            
        }else{
            echo "<br/>Please Provide an explaination on this issue closing.<br/>";
        }
    }
    
    
    if( isset( $_POST['rep'] ) ) {
        $buff = Array(
            "issue_no"=>$_GET['id'],
            "message"=>$_POST['repxs'],
            "message_date"=>date("Y-m-d H:i:s"),
            "created_by"=>$person->user_id
        );
        $db->insert($dbprefix.'_issue_notes',$buff);
    }
    
    
    
    
     
    $gfd = $mailforme = $db->query("SELECT * FROM ".$dbprefix."_issues WHERE issue_no =$_GET[id]");
    
    
    ?>
    
    <div id="xxxx" style="margin-top:5px;background:transparent;border:0px solid #bbb;outline:0px solid #bbb;width:750px;height:auto;margin:auto;">
        <table style="width: 100%;border:1px solid #bbb;">
        <tr>
            <td style="text-align: center;vertical-align:top;" colspan="2">
            Message or issue regarding <?php
                if(strlen(trim($gfd[0]['account_no']))){
                     echo account_NumtoName($gfd[0]['account_no']); 
                }else{
                    echo "No Account Attached";
                }
                ?>
        </td></tr>
        <tr>
            <td style="text-align: left;vertical-align:top;">Reported Date</td>
            <td style="text-align: right;vertical-align:top;"><?php echo $gfd[0]['date_created']; ?></td>
        </tr>
        <tr>
            <td style="text-align: left;vertical-align:top;">Created By</td>
            <td style="text-align: right;vertical-align:top;"><?php echo uNumToName($gfd[0]['reported_by']); ?></td>
        </tr>
        
    
        <tr>
            <td style="text-align: left;vertical-align:top;">Message Status</td>
            
            <td style="text-align: right;vertical-align:top;">
            <?php echo $gfd[0]['issue_status']; ?>
        </td>
        </tr>
        
        <tr>
            <td style="text-align: left;vertical-align:top;">Priority</td><td  style="text-align: right;">
                <?php
                    switch($gfd[0]['priority_level']){
                        case 20:
                            echo "Normal";
                        break;
                        case 10:
                            echo "Urgent";
                        break;
                    }
                ?>
            </td></tr>
        
        <tr>
              <td style="text-align: left;vertical-align:top;">Category<br /> (mouse over to view description)</td>
              <td style="text-align: right;vertical-align:top;">
                 <?php 
                    echo ZG_decode($gfd[0]['issue']);
                 ?>
            </td>
        </tr>
    <tr><td colspan="2" style="text-align: left;vertical-align:top;border:5px black solid;"><?php echo $gfd[0]['message']; ?></td></tr>
    
    <?php
            $replies = $db->where('issue_no',$gfd[0]['issue_no'])->orderby('message_date','desc')->get($dbprefix.'_issue_notes');
            if ( count($replies) !=0 ){
                foreach($replies as $poi){
                    
                     if(trim($poi['created_by']) == $person->user_id){
                            $align = "right";
                            $border = "#bbbbbb";
                        }else{
                            $align = "left";
                            $border = "black";
                        }
                    
                    echo "<tr>
                                <td  style='vertical-align:top;text-align:right;background:white;border:$border 5px solid'>BY: ".uNumToName(trim($poi['created_by']))."<br/>".trim($poi['message_date'])."</td>
                                <td  style='vertical-align:top;text-align:$align;background:white;border:$border 5px solid'>".trim($poi['message'])."</td>
                        </tr>";
                }
            }
        ?>
    
    <tr>
        <td style="text-align: left;vertical-align:top;">Completed</td>
        <td style="text-align: right;vertical-align:top;;"><?php echo $gfd[0]['completed_date']; ?></td>
    </tr>
    
    <tr>
    
        <td style="text-align: left;vertical-align:top;">Assigned to</td>
        <td style="text-align: right;vertical-align:top;"><select id="assign_to"  rel="<?php echo $gfd[0]['issue_no'];  ?>">
    <?php
        $yup = $db->where('approved', 1)->orderBy("first", "ASC")->get($dbprefix."_users");
        if(count($yup) >0){
            foreach($yup as $vak){
                if($vak['user_id']  == $gfd[0]['assigned_to'] ){
                        $ik = 'selected';
                    }else { 
                        $ik = "";
                    }
                echo "<option $ik value='$vak[user_id]'>$vak[first] $vak[last]</option>";
            }
        }
    ?>
    </select>
    <script>
    $("#assign_to").change(function(){
        //alert($("#assign_to").attr('rel') + " "+$("#assign_to").val());
       $.get("update_assign_to.php",{issue_no:$("#assign_to").attr('rel'),person:$("#assign_to").val()},function(data){
            alert(data);
       }); 
    });
    
    </script>
    
    </td></tr>
    <tr>
        <td style="text-align: left;vertical-align:top;">Requested by</td>
        <td style="text-align: right;vertical-align:top;"><?php echo uNumToName($gfd[0]['reported_by']); ?></td>
    </tr>
    <?php
        if($gfd[0]['issue'] == 32){
            //$container_removal_flag = $db->query("SELECT * FROM iwp_container_removal_photos WHERE issue_no = ".$gfd[0]['issue_no']);
            if(count($container_removal_flag)>0){
            ?>
            <tr><td colspan="2"><h1>Competitor Container(s) At Account</h1></td></tr>
            <tr><td>Account:</td><td><?php echo account_NumToName($container_removal_flag[0]['account_no']); ?></td></tr>
            <tr><td>Competitor On Site Identified?</td><td><?php echo $container_removal_flag[0]['Buster Biofuels'] ?></td></tr>
            <tr><td>Pictures uploaded by driver : <?php echo uNumToName($container_removal_flag[0]['submitted_by']);  ?></td><td>
            <h2>Click on thumbnail to view full view picture</h2>
            <?php 
            foreach($container_removal_flag as $k){
                echo "<a href='container_removal_photos/$k[photo_path]' target='_blank'><img src='container_removal_photos/$k[photo_path]' style='width:100px;height:50px;'/></a>";
            } 
            
            ?></td></tr>
            
            <tr><td style="text-align: center;" colspan="2"><form action="viewIssues.php?id=<?php echo $_GET['id']; ?>" method="POST" ><input type="hidden" readonly="" name="accountx" id="accountx" value="<?php echo $container_removal_flag[0]['account_no']; ?>"/><input type="submit" value="Send Removal Notice (Utility will be scheduled in 15 days)" name="srn" id="srn"/> &nbsp;<input type="submit" value="Do Not Send Removal Notice" name="dsrn" id="dsrn"/>&nbsp;<input type="submit" value="Cancel" name="cancel_" />
                <textarea name="decision_explaination" id="decision_explaination" placeholder="Please explain your decision to either send,not to send, or to cancel the removal notice here."></textarea></form>
            </td></tr><tr><td colspan="2">Upload Correspondence:&nbsp;<form enctype="multipart/form-data" method="POST" action="viewIssues.php?id=<?php echo $_GET['id']; ?>"><input type="file" name="correspondance" id="correspondance"/><input type="submit" value="Upload Correspondance Notice" name="upl_corresp" id="upl_corresp"/></form></td></tr>
            <?php
            }
        }
    ?>
    
    <tr><td colspan="2" style="text-align: left;">Action:&nbsp;<br /><input type="radio" name="stop_type" id="oil_stop"/>&nbsp;Oil Stop&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="stop_type" id="util_stop"/>&nbsp;Utility Stop</td></tr>
    <tr>
       
        <td style="text-align: left;vertical-align:top;" colspan="2">
           
           <div id="tabs">
              <ul>
                <li><a href="#fragment-1">Reply</a></li>
                <li><a href="#fragment-2">Resolved</a></li>
                <li><a href="#fragment-3">Create Stop</a></li>
                <li><a href="#fragment-4">Add to Route</a></li>
                <li><a href="#fragment-5">Route Now</a></li>
              </ul>
              <div id="fragment-1">
                <form action="viewIssues.php?id=<?php echo $_GET['id']; ?>" method="POST"><textarea style="width: 100%;height:60px;" placeholder="reply here" name="repxs" id="repxs"></textarea><br /><input type="submit" value="Reply" name="rep" id="rep"/><input type="hidden" value="<?php  echo $_GET['id']; ?>" name="account_no"/></form> 
              </div>
              <div id="fragment-2">
                    <form action="viewIssues.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <input type="checkbox" value="1" id="mark_closed" name="mark_closed" />&nbsp;Marked as closed
                    <textarea id="explain_text"  style="width: 100%;height:60px;" placeholder="Please explain how this issue was resolved." name="explain_text" ></textarea>
                    <input type="hidden" value="<?php  echo $gfd[0]['account_no']; ?>" name="account_no"/><br />
                        <input type="hidden" value="<?php echo $gfd[0]['reported_by']; ?>" name="reported_by"/>
                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="issue_id" />
                    <input type="submit" value="Close Issue" name="close_issue" id="close_issue"/>
                    </form>
              </div>
              <div id="fragment-3">
                <form action="viewIssues.php?id=<?php echo $_GET['id']; ?>"  class="form_id"  method="POST">
                    <input type="hidden" id="schedule_account_no" name="account_no" value="<?php echo $gfd[0]['account_no']; ?>"/>
                    <input type="hidden" id="issue_number" name="issue_number" value="<?php echo $_GET['id']; ?>" />
                    <?php
                        getDrivers();
                    ?>
                    <br />
                    <input type="text" class="schedule_stop" name="schedule_stop" placeholder="Schedule Stop" />
                     <input type="hidden" id="schedule_account_no" name="account_no" value="<?php echo $gfd[0]['account_no']; ?>"/>
                    <input type="hidden" name="stop_type" class="stop_type"/><br />
                    <div class="util_type" style="width: 100%;height:auto;"></div><br />
                    <textarea name="stop_notes" placeholder="If you have any Route Notes please type them here."></textarea>
                    <input type="submit" value="Create Stop" id="create_stop" name="create_stop"/>
                </form>
              </div>
              <div id="fragment-4">
                <form action="viewIssues.php?id=<?php echo $_GET['id']; ?>" class="form_id" method="POST">
                    <input type="hidden" id="schedule_account_no" name="account_no" value="<?php echo $gfd[0]['account_no']; ?>"/>
                    <input type="hidden" id="issue_number" name="issue_number" value="<?php echo $_GET['id']; ?>" />
                    <?php
                            getDrivers();
                    ?>
                    <br />
                    <input type="text" class="schedule_stop" name="schedule_stop" placeholder="Schedule Stop" /><br />
                    <select name="existing_routes" style="float: left;" id="existing_routes"></select>
                    <div class="util_type" style="width: 100%;height:auto;"></div>
                    <input type="hidden" name="stop_type" class="stop_type"/><br />
                    <textarea name="stop_notes" placeholder="If you have any Route Notes please type them here."></textarea>
                    <input type="submit" id="add_route" name="add_to_route" value="Add to Route" style="float: left;"/>
                </form>
              </div>
              <div id="fragment-5">
                <form action="viewIssues.php?id=<?php echo $_GET['id']; ?>" class="form_id" method="POST">
                <?php
                    getDrivers();
                ?>
                <br />
                <input type="text" class="schedule_stop" name="schedule_stop" placeholder="Schedule Stop" />
                <div class="util_type" style="width: 100%;height:auto;"></div>
                <input type="hidden" id="schedule_account_no" name="account_no" value="<?php echo $gfd[0]['account_no']; ?>"/>
                <input type="hidden" id="issue_number" name="issue_number" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" name="stop_type" class="stop_type"/><br />
                <textarea name="stop_notes" placeholder="If you have any Route Notes please type them here."></textarea>
                <input type="submit" value="Route Now" name="route_now"/>
                </form>
            </div>
           </div>
            
        </td>
    </tr>
    
        
        </table>
    </div>
    <script>
        $("#close_issue").hide();
        $("#mark_closed").click(function(){
            if($("#mark_closed").is(":checked") ){
                $("#close_issue").show();
            }else{
                $("#close_issue").hide();    
            }    
        });
        $("#close_issue").click(function(){
            var text =  $.trim( $("textarea#explain_text").val() );
            if($("#mark_closed").is(":checked") && text.length >0  ){
                $("#explain_text").css("border","0px solid black"); 
            }else{
                alert("Please provide an explaination on how this issue was resolved.");  
                $("#explain_text").css("border","2px solid red");    
                return false;
            }
        });
    
        $("#oil_stop").click(function(){
            $(".util_type").html("");
            $(".stop_type").val("oil");
            
            $.get("get_routes.php",{type:"oil"},function(data){
                $("#existing_routes").attr("name","manifest");
                $("#existing_routes").html(data);
            });
        });
        
        $("#util_stop").click(function(){
            $.get("onsite_fieldset.php",{account_no:<?php echo $gfd[0]['account_no']; ?>},function(data){
                alert(data);
                $(".util_type").html(data);
            });
            $(".stop_type").val("util");
            $.get("get_routes.php",{type:"util"},function(data){
                $("#existing_routes").attr("name","util_routes");
                $("#existing_routes").html(data);
            });
        });
        $(".schedule_stop").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
        $( "#tabs" ).tabs();
        $("#explain_text").hide();
        $("#mark_closed").click(function(){
            if( $(this).is(":checked") ){
                 $("#explain_text").show();
            }else{
                $("#explain_text").hide();
            }    
        });
        $("input#est_compl").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
    </script>
    <?php
}else{
    echo "Please login to respond to your issues.";
}
?>
</body>
</html>