#!/usr/bin/php5 -q
<?php
//include 'protected/global.php';
include "/var/www/html/protected/global.php";
ini_set("display_errors",0);
 $uid = md5(uniqid(time()));
$header = "From: issue_checker@iwpusa.com\r\n";
$header .= "Reply-To: No-reply@iwpusa.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



$check = $db->query("SELECT iwp_issues.*,iwp_driver_report.*,iwp_accounts.division FROM iwp_issues LEFT JOIN iwp_driver_report ON iwp_issues.issue = iwp_driver_report.value LEFT JOIN iwp_accounts ON iwp_accounts.account_ID = iwp_issues.account_no WHERE iwp_issues.issue_status ='active' AND DATE(iwp_issues.date_created) >='2019-09-01' AND iwp_issues.issue != 0 ORDER BY iwp_issues.date_created DESC");


if(count($check)>0){
    $total = 0;
    $list = "<table style='width:1000px;border:1px solid black;'>";
    $middle ="";
    $summary ="";
    foreach($check as $issue){
         $total++;
         switch($issue['division']){
            case 23: 
               $iwp++;
                break;
            case 22:
                $sd++;
                break;
            case 24:
               $LA_UC++;
                break;
            case 30:
               $LA_TONY++;
                break;
            case 31:case 25:
               $LA_RAMON++;
                break;
            case 32:
                $LA_CHATO++;
                break;
            case 33:
                $LA_CHUCK++;
                break;
            case 8:
                $AZ++;
                break;
            case 5:
                $SELMA++;
                break;
            
            case 10:
               $VBAK++;
                break;
                
            case 11:
                $VFRES++;
                break;
            case 12:
                $VNORTH++;
                break;
            case 13:
                $VVIS++;
                break;      
            case 14:
                $iwp++;
                break;
            case 15:
                $COWEST++;
                break;                    
        }
        $enter_data_link="";
        $manager = new Person($iwp_issue['assigned_to']);
        $diff = 0;
        $diff = abs(strtotime( date("Y-m-d H:i:s") ) - strtotime($issue['date_created']));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $account = new Account($issue['account_no']);
        
        if( strlen(trim($issue['route_id']))>0 && strlen(trim ( $issue['schedule_id'] )) >0 ){
            $enter_data_link = "\r\n View route here: <a href='enterData.php?route_id=$_POST[route_id]' target='_blank'>View Route Details here.</a>";
        }
        
        switch($issue['code']){
            case "4(A)"://Emergency Oil Pickup
                if($days == 3){
                    mail("$manager->email_address","4(A) Emergency Oil Pickup $days day notice","For Account $account->acount_id, $account->name_plain \r\n $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  \r\n code: $issue[code] ( $issue[description]) \r\n Issue Message : $issue[message] $enter_data_link \r\n   Reported: $issue[time_called] " ,$header);
                }else if ($days >=3){
                    //mail jared trent
                    $middle .= "<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>4(A)</td><td style='widht:100px;'> Emergency Oil Pickup </td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td> $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."</td>  <td>( $issue[description]) Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called] </td></tr>";
                    
                }
            break;
            case "4(B)"://Service Records Request
                if($days == 3){
                    //mail Allen
                    mail("aburkett@iwpusa.com","4(B) Service Records Request","For Account $account->acount_id, $account->name_plain \r\n $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  \r\n code: $issue[code] ( $issue[description]) \r\n Issue Message : $issue[message] $enter_data_link  \r\n   Reported: $issue[time_called] ",$header);
                }else if ($days >=3){
                    $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>4(B)</td><td style='widht:100px;'> Service Records Request </td><td style='text-align:center;'>$days</td> <td>$account->acount_id, $account->name_plain</td><td> \r\n $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])." </td> <td>( $issue[description]) Issue Message : $issue[message] $enter_data_link  Reported: $issue[time_called] </td></tr>";
                }
            break;
            case "4(C)":
                if($days == 3){
                     mail("$manager->email_address","4(C) New Account Service Request","For Account $account->acount_id, $account->name_plain \r\n $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  \r\n code: $issue[code] ( $issue[description]) \r\n Issue Message : $issue[message] $enter_data_link  \r\n   Reported: $issue[time_called] ",$header);
                    //mail manager
                }else if ($days >=3){
                    //mail trent jared
                    $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>4(C)</td><td style='widht:100px;'> New Account Service Request</td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td>$account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  </td> <td> ( $issue[description]) \r\n Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called]  </td></tr>";
                    
                }
            break;
            case "4(D)":
                if($days >= 3){
                     $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>4(D)</td><td style='widht:100px;'>Account Service Cancelation </td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td> $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  </td><td> ( $issue[description]) \r\n Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called]  </td></tr>";
                }
            break;
            case "1(F)":
                if($days >= 5){
                    //mail trent jared anna dave )
                     $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>1(F)</td><td>IWP and Competitor Container(s)</td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain</td><td> $account->address, $account->city $account->state $account->zip  Division: ".numberToFacility($issue['division'])."  </td><td> ( $issue[description]) Issue Message : $issue[message] Reported: $issue[time_called]  $enter_data_link </td></tr>";
                }
            break;
            case "1(E)":
                if($days >= 14){
                    //mail jared and trent
                    $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>1(E)</td><td> Restaurant Closed </td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td> $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  </td><td>  ( $issue[description]) \r\n Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called] </td></tr>";
                }
            break;
            case "1(D)"://mail trent and jared
                if($days >= 5){
                    $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>1(D)</td><td>Unidentified Service Provider Account </td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td> $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  </td> <td> code: $issue[code] ( $issue[description]) Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called] </td></tr>";
                }
            break;
            case "1(C)": //Account Name Change
                if($days >= 14  ){
                    mail("$manager->email_address","1(C) Account Name Change $days day notice","For Account $account->acount_id, $account->name_plain \r\n $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  \r\n code: $issue[code] ( $issue[description]) \r\n Issue Message : $issue[message] $enter_data_link   \r\n   Reported: $issue[time_called]",$header);
                }else if ($days >= 14 ){
                    $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>1(C)</td><td> Account Name Change </td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td> $account->address, $account->city $account->state $account->zip </td><td> Division: ".numberToFacility($issue[division])."</td><td> ( $issue[description])  Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called] </td></tr>";
                }
            
            break;
            case "1(B)"://IWP Container Gone / Competitor Container(S) At Account
                if($days >= 5 ){
                   $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>1(B)</td><td> IWP Container Gone / Competitor Container(S) At Account </td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td> $account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  </td><td>( $issue[description]) Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called] </td></tr>";
                }
            break;
            case "1(A)"://No Containers At Account
                if ($days >= 3 ){
                   //mail trent and jared 
                   $middle .="<tr><td style='text-align:right;vertical-align:top;font-weight:bold;'>1(A) </td><td>IWP Container Gone / No Containers At Account </td><td style='text-align:center;'>$days</td><td>$account->acount_id, $account->name_plain </td><td>$account->address, $account->city $account->state $account->zip \r\n Division: ".numberToFacility($issue['division'])."  </td><td>( $issue[description]) Issue Message : $issue[message] $enter_data_link Reported: $issue[time_called]</td></tr>";
                }
            break;
        }
       
      
        
    }
    $iwp_perc  = $iwp/$total;
    $sd_perc = $sd/$total;
    $la_uc_perc = $LA_UC/$total;
    $tony_perc = $LA_TONY/$total;
    $ramon_perc = $LA_RAMON/$total;
    $chato_perc = $LA_CHATO/$total;
    $chuck_perc = $LA_CHUCK/$total;
    $az_perc = $AZ/$total;
    $selma_perc = $SELMA/$total;
    $vbak_perc = $VBAK/$total;
    $vfres_perc= $VFRES/$total;
    $vnorth_perc = $VNORTH/$total;
    $vvis_perc = $VVIS/$total;
    $cowest_perc = $COWEST/$total;
    
    $summary = "<tr><td colspan='6'><span style='font-weight:bold;'>Facility Issue Break Down </span>: \r\n\r\n Imperial Western Products: $iwp (%$iwp_perc) \r\n San Diego (Division): $sd (%$sd_perc), \r\n LA (Division UC): $LA_UC (%$la_uc_perc), \r\n LA (Division UC-Tony): $LA_TONY (%$tony_perc), \r\n  LA (Division-Ramon): $LA_RAMON (%$ramon_perc), \r\n LA (Division UC-Chato): $LA_CHATO (%$chato_perc),  \r\n LA (Division UC-Chuck): $LA_CHUCK (%$chuck_perc) ( \r\n Arizona (Division 4): $AZ (%$az_perc), \r\n Selma (Division V): $SELMA (%$selma_perc),  \r\n V-BAK: $VBAK (%$vbak_perc), \r\n V-Fres: $VFRES (%$vfres_perc), \r\n V-North: $VNORTH (%$vnorth_perc), \r\n V-Vis: $VVIS (%$vvis_perc), \r\n Co West: $COWEST (%$cowest_perc) </td></tr> ";
     $list .= $summary."<tr><td>Code</td><td>Description</td><td>Days</td><td>Account</td><td>Address</td><td>Report Info</td></tr>$middle</table>";
       echo $list. "<br/>";
     
     mail("scano@iwpusa.com,ttrawick@iwpusa.com,jtrawick@iwpusa.com,edizon@iwpusa.com,aparsons@iwpusa.com,rlopez@iwpusa.com,mpires@iwpusa.com,aburkett@iwpusa.com,veronica@co-west.com,wkeifer@iwpusa.com,rparsons@iwpusa.com,EDodgson@iwpusa.com,HEstrada@iwpusa.com","IWP Issue Report",$list,$header);
}/*
}/*
*/
?>