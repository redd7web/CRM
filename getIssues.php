<?php
$person = new Person();

if ($person->user_id == 2030){
    ini_set("display_errors",1);
}



$criteria = "";
$end = "";
 if(isset($_POST['search_now'])){
    foreach($_POST as $name=>$value){
        switch($name){
            case "facility":
                if(strlen(trim($value))>0 && $value !="--SELECT--" && $value !="ignore"){
                    $arrField[] = "iwp_accounts.division = $value ";
                }
            break;
            case "wait_from":
                if(strlen(trim($value))>0){
                    $having[] = " having diff >= $value ";
                }
            
            break;
            case "wait_to":
                if(strlen(trim($value))>0){
                    $having[] = " having diff <= $value ";
                }
            break;
            
            case "reason_for_skip_id":
                if(strlen(trim($value))>0 && $value !="--SELECT--"){
                    $arrField[] = " issue = $value ";
                }
                break;
            case "subject":
                if(strlen(trim($value))>0){
                    $arrField[] = " subject like '%$value%' ";
                }
            break;
            case "message_status":
                 if($value !="-"){
                    if($value == 1){
                        $arrField[] = " issue_status in ('new','active') ";
                     } else if ($value ==2){
                        $arrField[] = " issue_status like '%new%' ";
                     } else if ($value ==3){
                        $arrField[] = " issue_status like '%active%'";
                     } else if($value ==4){
                        $arrField[] = " issue_status like '%resolved%'";
                     } else if($value == 5){
                        $arrField[] = " issue_status like '%closed%'";
                     }
                 }
             break;
            
             case "assigned_to_user_id":
                if($value !="-"){
                    $arrField[] = " assigned_to =".$value;
                }
             break;
        }
    }
    
    if(!empty($having)){
        $end = implode(" AND ", $having);
    }
    
    if(!empty($arrField)){
        $criteria = " AND ".implode(" AND ",$arrField);
    }
    
    $format = "SELECT * , DATEDIFF( CURDATE( ) , date_created )  as diff FROM iwp_issues LEFT JOIN iwp_accounts ON iwp_accounts.account_ID = iwp_issues.account_no WHERE 1 $criteria $end";
    echo $format;
    $issues = $db->query($format);

 } else {
    $issues = $db->query(" SELECT * , DATEDIFF( CURDATE( ) , date_created ) as diff FROM iwp_issues WHERE issue_status != 'Closed'");
 }
 
?>
<style type="text/css">
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}

td{
    background:transparent;
    border:1px solid #bbb;  
    padding:0px 0px 0px 0px; 
    word-wrap: break-word;
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "order": [ 9, 'DESC' ],
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>

<table style="width: 100%;margin:auto;" id="myTable">
    <thead>
        <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
            <td class="cell_label">Task #</td>
            <td class="cell_label">Account Name</td>
            <td class="cell_label" style="width:100px;">Created</td>
            <td class="cell_label" style="width:100px;">Reported</td>
            <td class="cell_label" >Update Task</td>
<!--            <td class="cell_label" style="width:200px;">Completed</td>-->
            <td class="cell_label">Status</td>
<!--            <td class="cell_label" style="width: 70px;">Type</span></td>-->
            <td class="cell_label" style="width: 100px;">Category</td>
            <td class="cell_label">Subject</td>
            <td class="cell_label" style="width: 400px;">Info</td>
            <td class="cell_label">Days Outstanding</td>
            <td class="cell_label" style="width: 100px;"><span title="Who added the message">Created By</span></td>
            <td class="cell_label" style="width: 100px;">User Assigned</td>
        </tr>
    </thead>
<tbody>
<?php


function ZG_decode_keys($value){
    global $db;
    $decode = $db->where("value",$value)->get("iwp_driver_report","code");
    if(count($decode)>0){
        return $decode[0]['code'];
    }else{
        return "N/A";
    }
}




if(count($issues) >0){
    foreach($issues as $content){
        echo"<tr>";
            echo "<td>$content[issue_no]</td>";
            echo "<td>".account_NumtoName($content['account_no'])."</td>";

            echo "<td>$content[date_created]</td>";
            echo "<td>$content[time_called]</td>";

            if($person->isCSupport_Full() || $content['assigned_to'] == $person->user_id || $content['reported_by'] == $person->user_id) {
                echo "<td><a href='viewIssues.php?id=$content[issue_no]' target='blank'> <img src='img/table_edit.png'/></a></td>";
            } else {
                echo "<td></td>";
            }

//            echo "<td>$content[completed_date]</td>";
            echo "<td>$content[issue_status]</td>";           
//            echo "<td>";
//                        issueDecode("$content[priority_level]");
//            echo"</td>";
             echo "<td>";
                if($content['date_created'] <= '2019-07-01' ){
                    echo account_issue("$content[issue]");    
                }else{
                    echo ZG_decode_keys($content['issue']);
                }
               echo "</td>";
            echo "<td>$content[message]</td>";
            echo "<td>";
            if(strlen(trim($content['subject']))>0){
                echo $content['subject'];
            }else{
                echo "N/A";
            }
            echo "</td>";
            echo "<td>$content[diff]</td>";
            echo "<td>".uNumToName_plain("$content[reported_by]")."</td>";
            echo "<td>".uNumToName_plain("$content[assigned_to]")."</td>";
        echo"</tr>";
    }
}
?>
</tbody>
</table>