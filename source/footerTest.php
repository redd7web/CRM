<div id="footer" style="color: black;background:#cccccc;">
    <style>
        .table_header{
            font-weight: bold;
        }


    </style>
<?php if(isset($_SESSION['id'])){ 
    ini_set("display_errors",0);
    $countf =0;
    $followx = $db->query("SELECT iwp_issue_assign.*,iwp_driver_report.code,iwp_driver_report.description,iwp_issues.account_no FROM iwp_issue_assign LEFT JOIN iwp_issues ON iwp_issues.issue_no LEFT JOIN iwp_driver_report on iwp_driver_report.value = iwp_issues.issue WHERE assigner = $person->user_id OR assignee = $person->user_id GROUP BY iwp_issue_assign.entry ORDER BY date DESC ");                    
    
    
    /*if(count($followx)>0){
        foreach($followx as $co){
            $extra = $db->query("SELECT * FROM iwp_issues WHERE issue_no = $co[issue_no] AND issue_status IN('active','Active','new','New')");
            if(count($extra)>0){
                $countf++;   
            }
        }
    }*/
    
    $mailbyme= $db->query("SELECT * FROM ".$dbprefix."_issues WHERE reported_by =$person->user_id AND issue_status IN('new','open','active') ORDER BY date_created DESC");
     // = $db->where("issue_status","new")->where("issue_status","active")->where('reported_by',$person->user_id)->orderby("date_created","DESC")->get($dbprefix."_issues");
    $mailforme = $db->query("SELECT * FROM ".$dbprefix."_issues WHERE assigned_to =$person->user_id AND issue_status IN('new','open','active') ORDER BY date_created DESC");
    //$mailforme = $db->where("issue_status","new")->where("issue_status","active")->where('assigned_to',$person->user_id)->orderby("date_created","DESC")->get($dbprefix."_issues");
    $privatebyme =  $db->where("status","active")->where('author',$person->user_id)->orderby("date","DESC")->get($dbprefix."_private");
    $privateforme = $db->where("status","active")->where('recipient',$person->user_id)->orderby("date","DESC")->get($dbprefix."_private");
    ?>
    
    <div id="messagenemergncy" style="width: 850px;height:181px;margin:0 auto;">
        <div id="messagebox" style="width: 850px;height:125px;background:white;">
            <div id="tabs">
                <ul>
                    <li style="margin-right: 10px;background:transparent;border:0px solid #bbb;text-transform:uppercase;color:white;">Issues</li>
                    <li><a href="#indbox" style="color:rgb(58, 132, 43) ;">Assigned (<?php if(count($mailforme)>0  ){ echo count($mailforme); } else { echo 0;} ?>)</a></li>
                    <li><a href="#following" style="color:rgb(58, 132, 43) ;">Following (<?php echo count($followx);  ?>)</a></li>
                    <li><a href="#sendboxx" style="color:rgb(58, 132, 43) ;">Created By Me(<?php if(count($mailbyme)>0  ){ echo count($mailbyme); } else { echo 0;} ?>)</a></li>
                    <li><a href="#privatein" style="color:rgb(58, 132, 43) ;">Private for me(<?php if(count($privateforme) >0) {  echo count($privateforme); } else { echo 0;} ?>)</a></li>  
                    <li><a href="#fragment-4" style="color:rgb(58, 132, 43) ;">Private by me(<?php if(count($privatebyme)>0) { echo count($privatebyme); } else { echo 0;} ?>)</a></li>
                 
                </ul>
                <div id="following">
                    <table style="width:100%;">
                    <tr><td>Main Thread</td><td>Account</td><td>Code</td><td>Assigner</td><td>&nbsp;</td><td>Assignee</td><td>&nbsp;</td><td>Message Date</td></tr>
                    <?php 
                    
                    if(count($followx)>0){
                        foreach($followx as $co){                            
                             echo "<tr><td><a href='viewIssuesTest.php?id=$co[issue_no]' rel='shadowbox;width=850px;'> <img src='img/table_edit.png'/></a></td><td>".account_NumToName($co['account_no'])."</td><td><span title='$co[description]'>$co[code]</span></td><td>".uNumToName($co['assigner'])."</td><td>Assigned To</td><td>".uNumToName($co['assignee'])."</td><td>@</td><td>$co[date]</td></tr>";
                        }
                    }
                    ?>
                    
                    </table>
                </div>
                <div id="indbox">
                    <table style="width:100%;">
                    <tr class="table_header table_data">
                        <td style="padding: 0px 0px 0px 0px;" >#</td>
                        <td>Creator</td>
                        <td>Account</td>
                        <td>Date</td>
                        <td>Status</td>
                        <td>Description</td>
                        <td>Info</td>
                        <td>View</td>
                    </tr>
                    <?php
                        if(count($mailforme) !=0){
                            foreach($mailforme as $msg2){
                                echo "<tr>
                                        <td style=\"padding: 0px 0px 0px 0px;\">$msg2[issue_no]</td>
                                        <td>". uNumToName($msg2['reported_by']) ."</td>
                                        <td style='color:black'>".account_NumtoName($msg2['account_no'] ) ."</td>
                                        <td>$msg2[date_created]</td>
                                        <td> " . ucfirst($msg2['issue_status']) . "</td>
                                        <td>";



                    echo ZG_decode_description($msg2['issue']);
                    echo "</td>
                                        <td><br/> $msg2[message]</td>
                                        <td><a href='viewIssuesTest.php?id=$msg2[issue_no]' rel='shadowbox;width=850;'><img src='img/table_edit.png'/></a></td>
                                    </tr>";
                            }
                        }else
                        {
                            echo "<tr><td colspan='4' style='vertical-align:middle;text-align:center;'>No Issues for me</td></tr>";
                        }
                        
                        
                    
                    ?>
                    </table>
                </div>
                <div id="sendboxx">
                    <table style="width: 100%;">
                    <tr class="table_header">
                        <td style="padding: 0px 0px 0px 0px;">#</td>
                        <td>Recipient</td>
                        <td>Account
                        <td>Date</td>
                        <td>Status</td>
                        <td>Category</td>
                        <td>Info</td>
                        <td>View</td>
                    </tr>
                    <?php 
                    if(count($mailbyme) !=0){
                        foreach($mailbyme as $msg){                            
                            echo "<tr>
                                        <td style=\"padding: 0px 0px 0px 0px;\">$msg[issue_no]</td>
                                        <td>". uNumToName($msg['assigned_to']) ."</td>
                                        <td>".account_NumtoName($msg['account_no'] ) ."</td>
                                        <td>$msg[date_created]</td>
                                        <td>" . ucfirst($msg['issue_status']) . "</td>
                                        <td>";
                            echo ZG_decode_description($msg['issue']);
                            echo "
                                        </td>
                                        <td>$msg[message]</td>
                                        <td><a href='viewIssuesTest.php?id=$msg[issue_no]' rel='shadowbox;width=850px;'> <img src='img/table_edit.png'/></a></td>
                                    </tr>";
                        }
                    }else
                        {
                            echo "<tr><td colspan='4' style='vertical-align:middle;text-align:center;'>No Issues</td></tr>";
                        }
                    
                    ?>
                    </table>
                </div>


                <div id="privatein">
                 <table style="width: 100%;">
                    <tr><td style="padding: 0px 0px 0px 0px;">#</td><td>Author</td><td>Message</td><td>Date</td></tr>
                    <?php
                        if(count($privateforme) !=0){
                            foreach($privateforme as $privyx){
                                echo "<tr>
                                <td style=\"padding: 0px 0px 0px 0px;\">$privyx[id]</td>
                                <td>";
                                echo uNumToName($privyx['author']);
                                echo "</td>
                                <td>$privyx[message]</td>                                
                                <td>$privyx[date]</td>
                                <td><a href='pmreply.php?id=$privyx[id]' rel='shadowbox;width=850px;'><img src='img/7866_6129_64_mail_reply_icon.png' style='width:30px;height:30px;'/></td>
                                </tr>";
                            }                        
                        } else {
                            echo "<tr><td colspan='4' style='vertical-align:middle;text-align:center;'>No Private Messages</td></tr>";
                        }                            
                        ?>
                    </table>
                </div>
                
                <div id="fragment-4">
                    <table style="width: 100%;">
                    <tr><td style="padding: 0px 0px 0px 0px;">#</td><td>Recipient</td><td>Message</td><td>Date</td></tr>
                        <?php
                        if(count($privatebyme) !=0){
                             foreach($privatebyme as $privy){
                                echo "<tr>
                                <td style=\"padding: 0px 0px 0px 0px;\">$privy[id]</td>
                                <td>
                                ";
                                echo uNumToName($privy['recipient']);
                                echo "</td>
                                <td>$privy[message]</td>
                                
                                <td>$privy[date]</td>
                                <td><a href='pmreply.php?id=$privy[id]' rel='shadowbox;width=850px;'><img src='img/7866_6129_64_mail_reply_icon.png' style='width:30px;height:30px;'/></td>
                                </tr>";
                            }
                        }else {
                            echo "<tr><td colspan='4' style='vertical-align:middle;text-align:center;'>No Private Messages</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                
            </div>
        
<!--        </div>-->
<!--        <div id="emergency" style="width: 650px;height:56px;background:#ccc;">-->
<!--            <div class="emergbutton" id="ticket" style="margin-top: 3px;margin-bottom:3px;height:50px;width:50px;;float:left;;background:silver url(img/open.jpg) no-repeat center top;cursor:pointer;"></div>-->
<!--            <div class="emergbutton" style="margin-top: 3px;margin-bottom:3px;height:50px;width:50px;;float:left;margin-left:10px;background:silver url(img/iq.jpg) no-repeat center top;cursor:pointer;">-->
<!--            <a href="ticket_queue.php" target="_blank"><img src="img/spot.gif" style="width: 50px;height:50px;"/></a>-->
<!--            </div>-->
<!--            <div class="emergbutton" style="margin-top: 3px;margin-bottom:3px;height:50px;width:50px;;float:left;margin-left:10px;background:silver"></div>-->
<!--            <div class="emergbutton" style="margin-top: 3px;margin-bottom:3px;height:50px;width:50px;;float:left;margin-left:10px;background:silver"></div>-->
<!--            <div class="emergbutton" style="margin-top: 3px;margin-bottom:3px;height:50px;width:50px;;float:left;margin-left:10px;background:silver"></div>-->
<!--            <div class="emergbutton" style="margin-top: 3px;margin-bottom:3px;height:50px;width:50px;;float:left;margin-left:10px;background:silver"></div>-->
<!--        </div>-->
<!--    </div>-->
    <?php } ?>
</div>
<script src="js/general.js"></script>