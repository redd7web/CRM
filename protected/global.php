<?php
session_start();

date_default_timezone_set('America/Los_Angeles');
ini_set("display_errors",1);
$allen_approve = array("2","4","7","B","C","D","F","G","I","J","K","L","M","N","O","R","RP","RW","S","T","UC","UD","US","V","W","WT"); 
$jason_approve= array("2","4","7","B","C","D","E","F","H","I","J","K","M","N","O","S","T","UC","UD","US","V","W","WT");
$lorenzo_approve = array("4","7","B","C","G","H","I","J","K","L","M","N","O","R","RP","RW","S","T","UC","UD","US","V","W","WT");


$uc_division = array(
    24,
    30,
    31,
    32,
    33
);


$all_pro = array (
    34,
    35,
    36,
    37,
    38,
    39,
    40,
    41,
    42,
    43,
    44,
    45,
    46,
    47,
    48,
    49,
    50
);

$all_selma = array(
    12,
    5,
    13,
    10,
    11
);

static $debug = 31;
static $dbprefix="iwp";
static $fixed_lbs = 7.56;
global $db;
global $facils;
global $coords;

$admin_permit = array (99);




if($debug == 1){ 
    $cfg['connection'] = array( 
        "host"=>"localhost",
        "username"=>"reddawg",
        "password"=>"quyle714",
        "database"=>"$dbprefix"
    );
}
else if ($debug == 2){
     $cfg['connection'] = array( 
        "host"=>"localhost",
        "username"=>"root",
        "password"=>"Ld98Tesn3L2sUm39",
        "database"=>"$dbprefix"
    );
}

else if($debug == 31){ 
    $cfg['connection'] = array( 
        "host"=>"mariadb-049.wc1.lan3.stabletransit.com",
        "username"=>"702797_dawgy",
        "password"=>"Quyle714",
        "database"=>"702797_test"
    );
}else if($debug == 32){ 
    $cfg['connection'] = array( 
        "host"=>"localhost",
        "username"=>"phpmyadmin",
        "password"=>"IwpSoftware1!",
        "database"=>"iwp"
    );
}



//var_dump($cfg);


include "Database.class.php";
include "Person.class.php";
include "x.class.php";
include "Containers.class.php";
include "Scheduled.class.php";
include "Vehicles.class.php";
include "IKG.class.php";
include "Data_Table.class.php";
include "IKG.Grease.class.php";
include "Grease_Sched.class.php";
include "IKG.Utility.class.php";
include "Util_scheds.class.php";
$db = new Database();


function getAllApprovedUsers($compare = NULL){
    //echo $compare;
    global $dbprefix;
    global $db;
    $selected = "";
    $table = $dbprefix."_users";
    $request = $db->query("SELECT user_id,first,last FROM $table WHERE approved = 1 ORDER BY first ASC");
    echo "<select name='to' id='to'><option value=''>--</option>";
    if(count($request) >0){
        foreach ($request as $user){
            echo "<option $selected value='$user[user_id]'>$user[first] $user[last]</option>";        }
    }    echo "</select>";
}


function getContractGroups($compare = NULL){
    global $dbprefix;
    $table = "contract_groups";
   $select = "<select id='contract_group_id' class='field' name='contract_group_id' rel='contract_group_id'><option value='null'>--</option>";
   $db = new Database();
   $request = $db->get($table);
   if(count($request) !=0){
        foreach($request as $contract_group){
            if(trim($compare) == $contract_group['entry_id']){
                $selected = " selected ";
            } else {
                $selected = "  ";
            }
            $select .= "<option $selected value='$contract_group[entry_id]'>$contract_group[group_name]</option>";
        } 
       
   }
   $select .="</select>";
   echo $select; 
}





function origin($compare = NULL){
    $select="";
    $select = "<select name='origin' id='origin' class='field' rel='origination' style='width:232px;'>
        <option></option>
        <option value='1' "; if( $compare == 1 ){  $select .=" selected ";}  $select .= ">Cold Calls</option>
        <option value='2' "; if( $compare == 2 ){  $select .=" selected ";}  $select .= ">Google Adwords</option>
        <option value='3' "; if( $compare == 3 ){  $select .=" selected ";}  $select .= ">Door to Door</option>
        <option value='4' "; if( $compare == 4 ){  $select .=" selected ";}  $select .= ">Referral</option>
        <option value='5' "; if( $compare == 5 ){  $select .=" selected ";} $select .= ">Website</option>
        <option value='6' "; if( $compare == 6 ){  $select .=" selected ";}  $select .= ">Facebook</option>
        <option value='7' "; if( $compare == 7 ){  $select .=" selected ";}  $select .= ">Twitter</option>
        <option value='8' "; if( $compare == 8 ){  $select .=" selected ";} $select .= ">Google Business</option>
        <option value='9' "; if( $compare == 9 ){  $select .=" selected ";}  $select .= ">LinkedIn</option>
        <option value='10' "; if( $compare == 10 ){  $select .=" selected ";}  $select .= ">Trade Shows</option>
        <option value='11' "; if( $compare == 11 ){  $select .=" selected ";}  $select .= ">Mailer</option>
        <option value='12' "; if( $compare == 12 ){  $select .=" selected ";}$select .= ">Mobile Marketing (i.e. trucks)</option>
        <option value='13' "; if( $compare == 13 ){  $select .=" selected ";}  $select .= ">Government Entity</option>
        <option value='14' "; if( $compare == 14 ){  $select .=" selected ";} $select .= ">Third Party Management Company (i.e. Quest)</option>
        <option value='15' "; if( $compare == 15 ){  $select .=" selected ";}  $select .= ">Competitor Recommendation</option>
        <option value='16' "; if( $compare == 16 ){  $select .=" selected ";}  $select .= ">Request from IT</option>                  
        <option value='17' "; if( $compare == 17 ){  $select .=" selected ";}$select .= ">Existing Customer</option>
        <option value='18' "; if( $compare == 18 ){  $select .=" selected ";} $select .= ">New Name / New Owner</option>    
    </select>";   
    return $select; 
}


function origin_decode($compare){
    switch($compare){
        case 1: return "Cold Calls"; break;
        case 2: return "Google Adwords"; break;
        case 3: return "Door to Door"; break;
        case 4: return "Referral"; break;
        case 5: return "Website"; break;
        case 6: return "Facebook"; break;
        case 7: return "Twitter"; break;
        case 8: return "Google Business"; break;
        case 9: return "LinkedIn"; break;
        case 10: return "Trade Shows"; break;
        case 11: return "Mailer"; break;
        case 12: return "Mobile Marketing (i.e. trucks)"; break;
        case 13: return "Government Entity"; break;
        case 14: return "Third Party Management Company (i.e. Quest)"; break;
        case 15: return "Competitor Recommendation"; break;
        case 16: return "Request from IT"; break;
        case 17: return "Existing Customer"; break;
        case 18: return "New Name / New Owner"; break;
        
    }
}


function new_account_status($account){
    global $db;
    $y  = $db->query("SELECT status FROM iwp_accounts WHERE account_ID = $account");
    if(count($y)>0){
        switch($y[0]['status']){
            case "Active":
                return "Active( Ready to be serviced )";
            break;
            case "Archive":
                return "Archived";
            break;
            case "New":
                return "New (Needs New Account)";
            break;
            case "Ending":
                return "Ending (Final pumping)";
            break;
            case "On Hold":
                return "On Call (On Call)";
            break;
        }
    }
}

function expected_for_route($route_id){
    global $db,$dbprefix;
    $account  = new Account();
    $total = 0;
    $acco_no = $db->where("route_id",$route_id)->get($dbprefix."_data_table","account_no");
    if(count($acco_no)>0){
        foreach($acco_no as $numbers){
            $total =  $account->singleField($numbers['account_no'],"estimated_volume") + $total;
        }
    }
    return $total;
}

function get_zero_collections($route_id){
    global $dbprefix,$db;   
     $route_collected_zero = $db->where("inches_to_gallons",0)->where("route_id",$route_id)->get($dbprefix."_data_table");
    
    return count($route_collected_zero);
}

function collected_for_route($route_id){
    global $dbprefix,$db;
    $total = 0;
    $route_collected = $db->where("route_id",$route_id)->get($dbprefix."_data_table");
    if(count($route_collected)>0){
        foreach($route_collected as $collected){
            $total = $total + $collected['inches_to_gallons'];
        }
    }
    return $total;    
}

function date_different($beginning,$latest){
        $diff = 0;
        if($beginning !="0000-00-00"){    
            $now = strtotime("$latest"); // or your date as well
            $your_date = strtotime("$beginning");
            $datediff = $now - $your_date;
            if($datediff>0){
                return floor($datediff/(60*60*24));
            } else {
                return 0;
            }
        }else {
            return 0;
        }
     
}

function addDayswithdate($date,$days){    
   $date = date_create($date);
    date_add($date, date_interval_create_from_date_string("$days days"));
    return date_format($date, 'Y-m-d');
}
function subDayswithdate($date,$days){    
    $mod_date = strtotime($date."- $days days");
    return date("Y-m-d",$mod_date);
}



function account_issue($issuenumber){
    switch($issuenumber){
        case  1: 
            return "Needs Cancelation letter";
            break;
       case  2: 
            return "Damaged Tote";
            break;
        case  3: 
            return "Need GCP Poster";
            break;
            
        case  4: 
            return "Needs To Be Swapped/Dirty Tote";
            break;
            
        case  5: 
            return "Oil Theft";
            break;
            
        case  6: 
            return "Competitor Onsite";
            break;
            
        case  7: 
            return "Broken Lock";
            break;
            
        case  8: 
            return "Out Of Business";
            break;
        case  9: 
            return "Container Missing";
            break;
        case  60: 
            return "Location Needs Attention";
            break;
        case  70: 
            return "Customer Request";
            break;
        case  72: 
            return "In House Request";
            break;
        case  140: 
            return "Sales Team";
            break;
            
        case  90: 
            return "Competitor On Site";
            break;
        case  100: 
            return "Location Closing";
            break;
        case 150:
            return "Needs UCO pick up";
            break;
    }
}


function issueDecode($number){
    switch($number){
        case 6:
            echo "Site Cleanup";
            break;
        case 3:
            echo "Container Delivery";
            break;
        case 4:
            echo "Container Retrieval";
            break;
        case 7:
            echo "Lid Delivery";
            break;
        case 8:
            echo "Wheels: Add/Modify";
            break;
        case 10:
            echo "Lock: Add/Modify";
            break;
        case 24:
            echo "Sensors: Add/Modify";
            break;
        case 20:
            echo "Other";
            break;
        default:
            echo "";
            break;
    }
}


function payment_label(&$class_object){    
    switch($class_object->payment_method){
        case "Jacobson": case "Index":
            //echo "jacobe hit!";
            echo "Jac. %";
            break;
        case "Per Gallon": case "Normal":
                echo "Per Gallon";
            break;
        case "One Time Payment":case "O.T.P.":
            echo "One Time Payment";
            break;
        case "O.T.P. Per Gallon": case "One Time Payment Per Gallon": case "O.T.P. PG": 
            echo "O.T.P. PG";
            break;
        case "No Pay": case "Free": case "Normal": case "NULL": case "Do Not Pay":
            echo "No Pay";
            break;
        case "Split Account":
            break;
        default:    
            echo "No Pay";
            break;
    }
};


function payment_method(&$class_object){
    $db = new Database();
    global $dbprefix;
    global $fixed_lbs;
    switch($class_object->payment_method){
        case "Jacobson": case "Index":
            //echo "jacobe hit!";
            $jake = $db->orderby("date","DESC")->get($dbprefix."_jacobsen","percentage");
                //pull from jacobsen table per lb
                $hold = $class_object->total_gallons -($class_object->total_gallons*$class_object->miu);
                //echo "total gallons  - .25% =".$hold."<br/>";
                $hold2 = $hold * $fixed_lbs;                
                //echo "ADJ($hold) * 7.56 = ".$hold2."<br/>";    
                $klo = $jake[0]['percentage'] * $class_object->index_percentage;
                echo "$ ".round($hold2 * $klo,2);
            break;
        case "Per Gallon": case "Normal":
               $totalgs = 0;
               $tc = $db->where("account_no",$class_object->acount_id)->get($dbprefix."_data_table");
               if(count($tc)>0){
                    foreach($tc as $value){
                        $totalgs = $totalgs +$value['inches_to_gallons'];
                    }
               }
               echo  round(($totalgs - ($totalgs * $class_object->miu))  * $class_object->ppg_jacobsen_percentage ,2) ; 
               
            break;
         case "O.T.P. Per Gallon": case "One Time Payment Per Gallon": case "O.T.P. PG":
            //display one time payment value
            echo $class_object->ppg_jacobsen_percentage;
            break;
        
            
            break;
        case "No Pay": case "Free": 
            echo "No Pay";
            break;
        case "Split Account":
            break;
    }
}

function containerList($compare = NULL,$name = NULL,$allow = NULL){
    if($name == NULL){
        $post_name = "container_size";
        $id = "container_size";
    }
    else {
        $post_name = $name;
        $id = $name;
    }
    
    
    if($allow == "allow"){
        $allow ="";
        
    }else{
        $allow = " WHERE container_label NOT LIKE '%AllPro%' AND container_label NOT LIKE '%All_Pro%' ";
    }
    
    $db = new Database();
    global $dbprefix;
    $jk = $db->query("SELECT * FROM iwp_list_of_containers $allow");
    if(count($jk)>0){
        
        echo '<select  id="'.$id.'" name="'.$post_name.'" style="font-size:11px;">';
        foreach($jk as $value){
                $select ="";
                if($value['container_id'] == $compare){
                    $select = "selected";
                }
            echo "<option $select value='$value[container_id]'>$value[container_label]</option>";
        }
        echo '</select>';
    }
}

function containerNumToName($number){
    $db = new Database();
    global $dbprefix;
    $jk = $db->where("container_id",$number)->get($dbprefix."_list_of_containers");
    
    return $jk[0]['container_label'];
}


function issueConverter($issue){
    switch($issue){
        case 1:
            echo "Needs Cancelation letter";
            break;
        case 2:
            echo "Damaged Tote";
            break;
        case 3:
            echo "Need GCP Poster";
            break;
        case 4:
                echo "Needs To Be Swapped/Dirty Tote";
            break;
        case 5:
            echo "Oil Theft";
            break;
        case 6:
            echo "Competitor Onsite";
            break;
        case 7:
            echo "Broken Lock";
            break;
        case 8:
            echo "Out Of Business";
            break;
        case 9:
            echo "Container Missing";
            break;
        case 60:
            echo "Location Needs Attentio";
            break;
        case 70:
            echo "Customer Request";
            break;
        case 72:
            echo "In House Request";
            break;
        case 140:
            echo "Sales Team";
            break;
        case 90:
            echo "Competitor On Site";
            break;
        case 100:
            echo "Location Closing";
            break;
    }
}

function priorityConverter($pri){
    switch($pri){
        case 20:
            return "Normal";
        break;
        case 10:
            return "Urgent"; 
        break;
    }
}

function uNumToName($number){
    $db = new Database();
    $answer = $db->where("user_id",$number)->get("iwp_users","first,last,user_id");
    if(count($answer) >0){
        return "<a href='viewUser.php?id=$number'>".$answer[0]['first']." ".$answer[0]['last']."</a>";
    }
}

function uNumToName_plain($number){
    $db = new Database();
    $answer = $db->where("user_id",$number)->get("iwp_users","first,last,user_id");
    if(count($answer) >0){
        return $answer[0]['first']." ".$answer[0]['last'];
    }
}

function user_info($number,$field){
    $db = new Database();
    $answer = $db->where("user_id",$number)->get("iwp_users","$field");
    if(count($answer) >0){
        return $answer[0][$field];
    }
}

function account_NumtoName($number){
    global $dbprefix;
    $db = new Database();
    $request = $db->where("account_ID",$number)->get($dbprefix.'_accounts','name,account_ID');
    
   if (count($request)>0){
     foreach($request as $vlue){
         $t = $vlue['account_ID'];
        $name = $vlue['name'];
        return "<a style='color:blue;' href='viewAccount.php?id=$t' target='_blank'>".$name."</a>";
     }
     
   }else {
        return "No such account";
     }
    
}

function account_NumtoName_plain($number){
    global $dbprefix;
    $db = new Database();
    $request = $db->where("account_ID",$number)->get($dbprefix.'_accounts','name,account_ID');
    
   if (count($request)>0){
     foreach($request as $vlue){
         $t = $vlue['account_ID'];
        $name = $vlue['name'];
        return $name;
     }
     
   }else {
        return "No such account";
     }
    
}
function statusColors($id,$status){
    $account = new Account();
    $color = "black";
    if( $account->singleField($id,"barrel_capacity") >0 ){
        $percent =  $account->singleField($id,"estimated_volume")/$account->singleField($id,"barrel_capacity");
        if($percent<.25){
            $color = "green";
        } else if ($percent>=.25 && $percent <.5){
            $color = "#999900";
        } else if ($percent>=.5 && $percent <.75){
            $color = "orange";
        }  else if ($percent>=.75){
            $color = "red";
        }
    } 
    return "<span style='color:$color;font-weight:bold;'>$status</span>";
}


function getJake(){
    global $dbprefix;
    $db = new Database();
    $request = $db->orderby("id","desc")->get("iwp_jacobsen");    
    return $request[0]['percentage'];
}


function getFriendLists($compare = NULL){
    global $dbprefix;
    $table_friendlies = $dbprefix."_friendly";
   $select = "<select id='friendly' class='field' name='friendly' rel='friendly'><option value='null'>--</option>";
   $db = new Database();
   $request = $db->get($table_friendlies);
   if(count($request) !=0){
        foreach($request as $friendly){
            if(trim($compare) == $friendly['comp_name']){
                $selected = " selected ";
            } else {
                $selected = "  ";
            }
            $select .= "<option $selected value='$friendly[comp_name]'>$friendly[comp_name]</option>";
        } 
       
   }
   $select .="</select>";
   echo $select; 
}

function oilFacList( $list_name = NULL ,$compare = NULL, $account_no = NULL){
    $selected ="";
    if(strlen($list_name)>0){
        
        $name = $list_name;
    }
    else {
        $name = "facility";
    }
    $select = "<select id='$name' name='$name' ";  
        if( $account_no != NULL){
             $select .=" rel='$account_no' ";
        }
    
    $select .= " class='cfac'><option value='ignore' required>--</option>";
    
         $select .=' <option '; if($compare == 22){$select .= 'selected'; }  $select.=' value="22">San Diego (US Division))</option>
                <option '; if($compare == 23){$select .= 'selected'; }  $select.=' value="23">Imperial Western Products</option>
                <option '; if($compare == 99){$select .= 'selected'; }  $select.=' value="99">ALL UC</option>
                <option '; if($compare == 24){$select .= 'selected'; }  $select.=' value="24">UC Division (Corporate)</option>
                <option '; if($compare == 30){$select .= 'selected'; }  $select.=' value="30">UC Division (San Bernadino)</option>
                <option '; if($compare == 31){$select .= 'selected'; }  $select.=' value="31">UC Division (Los Angeles)</option>
                <option '; if($compare == 32){$select .= 'selected'; }  $select.='  value="32">UC Division (Riverside)</option>
                <option '; if($compare == 33){$select .= 'selected'; }  $select.='  value="33">UC Division (Orange County)</option>
                <option '; if($compare == 8){$select .= 'selected'; }  $select.='  value="8">Arizona (4 Division)</option>
                <option '; if($compare == 5){$select .= 'selected'; }  $select.='  value="5">VSLM (V Division)</option>
                <option '; if($compare ==10){ $select .='selected'; }   $select .='  value="10">V-BAK</option>
                <option '; if($compare ==11){ $select .='selected'; }   $select .='  value="11">V-Fres</option>
                <option '; if($compare ==12){ $select .='selected'; }   $select .='  value="12">V-North</option>
                <option '; if($compare ==13){ $select .='selected'; }   $select .='  value="13">V-Vis</option>
                <option '; if($compare ==14){ $select .='selected'; }   $select .='  value="14">L Division</option>
                <option '; if($compare ==15){ $select .='selected'; }   $select .='  value="15">Co-West</option>
                <option '; if($compare ==35){ $select .='selected'; }   $select .='   value="35">Arizona Zone 1</option>
                <option '; if($compare ==36){ $select .='selected'; }   $select .='   value="36">Arizona Zone 2</option>
                <option '; if($compare ==37){ $select .='selected'; }   $select .='   value="37">Arizona Zone 3</option>
                <option '; if($compare ==38){ $select .='selected'; }   $select .='   value="38">Arizona Zone 4</option>
                <option '; if($compare ==39){ $select .='selected'; }   $select .='   value="39">Arizona Zone 5</option>
                <option '; if($compare ==40){ $select .='selected'; }   $select .='   value="40">Arizona Zone 6</option>
                <option '; if($compare ==41){ $select .='selected'; }   $select .='   value="41">Arizona Zone 7</option>
                <option '; if($compare ==42){ $select .='selected'; }   $select .='   value="42">Arizona Zone 8</option>
                <option '; if($compare ==43){ $select .='selected'; }   $select .='   value="43">Arizona Zone 9</option>
                <option '; if($compare ==44){ $select .='selected'; }   $select .='   value="44">Arizona Zone 10</option>
                <option '; if($compare ==45){ $select .='selected'; }   $select .='   value="45">Arizona Zone 11</option>
                <option '; if($compare ==46){ $select .='selected'; }   $select .='   value="46">Arizona Zone 12</option>
                <option '; if($compare ==47){ $select .='selected'; }   $select .='   value="47">Arizona Zone 13</option>
                <option '; if($compare ==48){ $select .='selected'; }   $select .='   value="48">Arizona Zone 14</option>
                <option '; if($compare ==49){ $select .='selected'; }   $select .='   value="49">Arizona Zone 15</option>
                <option '; if($compare ==50){ $select .='selected'; }   $select .='   value="50">Arizona Zone Temp</option>';
                
               
    $select .="</select>";
    return $select;
}


function getFacilityList( $list_name = NULL ,$compare = NULL){  
    $selected ="";
    if(strlen(trim($list_name))>0){
        $name = $list_name;
    }
    else {
        $name = "facility";
    }
    $select = "<select id='$name' name='$name' ";  
        if( $compare != NULL){
             $select .=" rel='$list_name' ";
        }
    
    $select .= "><option value='ignore' required>--</option>";
    
         $select .=' <option '; if($compare == 22){$select .= 'selected'; }  $select.=' value="22">San Diego (US Division))</option>
                <option '; if($compare == 23){$select .= 'selected'; }  $select.=' value="23">Imperial Western Products</option>
                <option '; if($compare == 99){$select .= 'selected'; }  $select.=' value="99">ALL UC</option>
                <option '; if($compare == 24){$select .= 'selected'; }  $select.=' value="24">UC Division (Corporate)</option>
                <option '; if($compare == 30){$select .= 'selected'; }  $select.=' value="30">UC Division (San Bernadino)</option>
                <option '; if($compare == 31){$select .= 'selected'; }  $select.=' value="31">UC Division (Los Angeles)</option>
                <option '; if($compare == 32){$select .= 'selected'; }  $select.='  value="32">UC Division (Riverside)</option>
                <option '; if($compare == 33){$select .= 'selected'; }  $select.='  value="33">UC Division (Orange County)</option>
                <option '; if($compare == 8){$select .= 'selected'; }  $select.='  value="8">Arizona (4 Division)</option>
                 <option '; if($compare == 5){$select .= 'selected'; }  $select.='  value="5">VSLM (V Division)</option>
                <option '; if($compare ==10){ $select .='selected'; }   $select .='  value="10">V-BAK</option>
                <option '; if($compare ==11){ $select .='selected'; }   $select .='  value="11">V-Fres</option>
                <option '; if($compare ==12){ $select .='selected'; }   $select .='  value="12">V-North</option>
                <option '; if($compare ==13){ $select .='selected'; }   $select .='  value="13">V-Vis</option>
                <option '; if($compare ==14){ $select .='selected'; }   $select .='  value="14" >L Division</option>
                <option '; if($compare ==15){ $select .='selected'; }   $select .='  value="15">Co West</option>
                <option '; if($compare ==35){ $select .='selected'; }   $select .='   value="35">Arizona Zone 1</option>
                <option '; if($compare ==36){ $select .='selected'; }   $select .='   value="36">Arizona Zone 2</option>
                <option '; if($compare ==37){ $select .='selected'; }   $select .='   value="37">Arizona Zone 3</option>
                <option '; if($compare ==38){ $select .='selected'; }   $select .='   value="38">Arizona Zone 4</option>
                <option '; if($compare ==39){ $select .='selected'; }   $select .='   value="39">Arizona Zone 5</option>
                <option '; if($compare ==40){ $select .='selected'; }   $select .='   value="40">Arizona Zone 6</option>
                <option '; if($compare ==41){ $select .='selected'; }   $select .='   value="41">Arizona Zone 7</option>
                <option '; if($compare ==42){ $select .='selected'; }   $select .='   value="42">Arizona Zone 8</option>
                <option '; if($compare ==43){ $select .='selected'; }   $select .='   value="43">Arizona Zone 9</option>
                <option '; if($compare ==44){ $select .='selected'; }   $select .='   value="44">Arizona Zone 10</option>
                <option '; if($compare ==45){ $select .='selected'; }   $select .='   value="45">Arizona Zone 11</option>
                <option '; if($compare ==46){ $select .='selected'; }   $select .='   value="46">Arizona Zone 12</option>
                <option '; if($compare ==47){ $select .='selected'; }   $select .='   value="47">Arizona Zone 13</option>
                <option '; if($compare ==48){ $select .='selected'; }   $select .='   value="48">Arizona Zone 14</option>
                <option '; if($compare ==49){ $select .='selected'; }   $select .='   value="49">Arizona Zone 15</option>
                <option '; if($compare ==50){ $select .='selected'; }   $select .='   value="50">Arizona Zone Temp</option>';
                
               
    $select .="</select>";
    echo $select;

}


$facils[22]="15777 Old Milky Way, Escondidio, CA 92025 USA";
$facils[23]="86-600 Ave 54, Coachella, CA 92236 USA";
$facils[24]="4085 Bain St., Mira Loma, CA 91752 USA";         
$facils[31]="4085 Bain St., Mira Loma, CA 91752 USA";
$facils[25]="4085 Bain St., Mira Loma, CA 91752 USA";
$facils[32]="4085 Bain St., Mira Loma, CA 91752 USA";
$facils[33]="4085 Bain St., Mira Loma, CA 91752 USA";
$facils[30]="4085 Bain St., Mira Loma, CA 91752 USA";
$facils[8]="7401 S. Wilson Rd., Buckeye, AZ 85326 USA";
$facils[5]="3766 E. Conejo, Selma, CA 93662 USA";
$facils[10]="3766 E. Conejo, Selma, CA 93662 USA";
$facils[11]="3766 E. Conejo, Selma, CA 93662 USA";
$facils[12]="3766 E. Conejo, Selma, CA 93662 USA";
$facils[13]="3766 E. Conejo, Selma, CA 93662 USA";
$facils[14]="86-600 Ave 54, Coachella, CA USA";
$facils[15]="2586 Shenandoah Way, San Bernardino, CA USA";
$facils[35]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[36]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[37]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[38]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[39]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[40]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[41]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[42]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[43]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[44]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[45]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[46]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[47]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[48]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[49]="6525 West State Ave, Glendale, AZ 85301 USA";
$facils[50]="6525 West State Ave, Glendale, AZ 85301 USA";
//latt/long
$coords[22]="33.087907,-116.998791";
$coords[23]="33.656551,-116.190472";
$coords[24]="34.012972,-117.507924";
$coords[31]="34.012972,-117.507924";
$coords[25]="34.012972,-117.507924";
$coords[32]="34.012972,-117.507924";
$coords[33]="34.012972,-117.507924";
$coords[8]="33.379422,-112.659971";
$coords[5]="36.519258,-119.722510";
$coords[10]="36.519258,-119.722510";
$coords[11]="36.519258,-119.722510";
$coords[12]="36.519258,-119.722510";
$coords[13]="36.519258,-119.722510";
$coords[14]="33.656551,-116.190472";
$coordss[15]="34.173228,-117346416";
$coords[35]="33.544030,-112.200680";
$coords[36]="33.544030,-112.200680";
$coords[37]="33.544030,-112.200680";
$coords[38]="33.544030,-112.200680";
$coords[39]="33.544030,-112.200680";
$coords[40]="33.544030,-112.200680";
$coords[41]="33.544030,-112.200680";
$coords[42]="33.544030,-112.200680";
$coords[43]="33.544030,-112.200680";
$coords[44]="33.544030,-112.200680";
$coords[45]="33.544030,-112.200680";
$coords[46]="33.544030,-112.200680";
$coords[47]="33.544030,-112.200680";
$coords[48]="33.544030,-112.200680";
$coords[49]="33.544030,-112.200680";
$coords[50]="33.544030,-112.200680";

function numberToFacility($number){
   
    switch($number){
        case 23: 
            return "Imperial Western Products";
            break;
        case 22:
            return "San Diego (Division)";
            break;
        case 24:
            return "UC Division (Corporate)";
            break;
        case 30:
            return "UC Division (San Bernadino)";
            break;
        case 31:case 25:
            return "UC Division (Los Angeles)";
            break;
        case 32:
            return "UC Division (Riverside)";
            break;
        case 33:
            return "UC Division (Orange County)";
            break;
        case 8:
            return "Arizona (Division 4)";
            break;
        case 5:
            return "Selma (Division V)";
            break;
        
        case 10:
            return "V-BAK";
            break;
            
        case 11:
            return "V-Fres";
            break;
        case 12:
            return "V-North";
            break;
        case 13:
            return "V-Vis";
            break;      
        case 14:
            return "Imperial Western Products (L)";
            break;
        case 15:
            return "Co West";                    
           break; 
        case 35:
            return "AZ Zone 1";                    
           break; 
        case 36:
            return "AZ Zone 2";                    
           break; 
        case 37:
            return "AZ Zone 3";                    
           break; 
        case 38:
            return "AZ Zone 4";                    
           break; 
        case 39:
            return "AZ Zone 5";                    
           break; 
        case 40:
            return "AZ Zone 6";                    
           break; 
        case 41:
            return "AZ Zone 7";                    
           break; 
        case 42:
            return "AZ Zone 8";                    
           break; 
        case 43:
            return "AZ Zone 9";                    
           break; 
        case 44:
            return "AZ Zone 10";                    
           break; 
        case 45:
            return "AZ Zone 11";                    
           break; 
        case 46:
            return "AZ Zone 12";                    
           break; 
        case 47:
            return "AZ Zone 13";                    
           break; 
        case 48:
            return "AZ Zone 14";                    
           break; 
        case 49:
            return "AZ Zone 15";                    
           break; 
        case 50:
            return "AZ Zone Temp";                    
           break; 
       
    }
}


function reverseTranslate($facName){
    switch($facName){
        case "San Diego (Division US)":
            return 22;
            break;
//case "L Division":
  //          return 14;
    //        break;
        case "Imperial Western Products (Division R)":
            return 23;
            break;
        case "UC Division (Corporate)":
            return 24;
            break;
        case "LA (Division UC-Norm)":
            break;
        case "UC Division (San Bernadino)":
            return 30;
            break;
        case "LA (Division UC-Ramon)":
            return 25;
            break;
        case "UC Division (Riverside)":
            return 32;
            break;
        case "UC Division (Orange County)":
            return 33;
            break;
        case "UC Division (Los Angeles)":
            return 31;
            break;
        case "Arizona (Division 4)":
            return 8;
            break;
        case "Selma (Division V)":
            return 5;
            break;
        case "Imperial Western Products (Division L)":
            return 14;
            break;
        case "Co West":
            return 15;
            break;
        case "AZ Zone 1":
            return 35;
            break;
        case "AZ Zone 2":
            return 36;
            break;
        case "AZ Zone 3":
            return 37;
            break;
        case "AZ Zone 4":
            return 38;
            break;
        case "AZ Zone 5":
            return 39;
            break;
        case "AZ Zone 6":
            return 40;
            break;
        case "AZ Zone 7":
            return 41;
            break;
        case "AZ Zone 8":
            return 42;
            break;
        case "AZ Zone 9":
            return 43;
            break;
        case "AZ Zone 10":
            return 44;
            break;
        case "AZ Zone 11":
            return 45;
            break;
        case "AZ Zone 12":
            return 46;
            break;
        case "AZ Zone 13":
            return 47;
            break;
        case "AZ Zone 14":
            return 48;
            break;
        case "AZ Zone 15":
            return 49;
            break;
        case "AZ Zone Temp":
            return 50;
            break;
        default:
            return 0;
            break;
    }
}


function getVehiclesList($compare = NULL){
    global $dbprefix;
    $select ="<select id='vehicle' name='vehicle'>";
    $db = new Database();
    $request = $db->query("SELECT * FROM iwp_truck WHERE is_oil=1 AND enabled=1 AND sold = 0");
    if(count($request) >0 ){
        foreach($request as $truck){
            $select .= "<option "; if($compare == $truck['truck_id']) { $select .="selected";}  $select .="  value='$truck[truck_id]'>$truck[name]</option>";
        }
    }
    $select .="</select>";
    return $select;
}


function getTrailers($compare = NULL){
    global $db;
    $comp = $compare;
    $bvc = $db->query("SELECT truck_id,name FROM iwp_trailers WHERE is_oil =1 AND  enabled =1  AND sold = 0");
    $i .= "<select name='trailer' id='trailer'><option>--</option>";
    if(count($bvc)>0){
        foreach($bvc as $trailers){
            $i .=  "<option ";
                if($trailers['truck_id'] == $comp){
                    $i .=  " selected ";
                }
            $i .= " value='$trailers[truck_id]'>$trailers[name]</option>";
        }
    }   
    $i .= "</select>";
    return $i;
}


function vehicle_name($truck_no){
    global $dbprefix;
    global $db;
    $truck = $db->query("SELECT truck.name FROM assets.truck WHERE truck.truck_id = $truck_no AND module='oil'");
    if(count($truck)>0){
        return $truck[0]['name'];
    } else {
        return "N/A";
    }
}

function getDrivers($compare = NULL){   
   //echo $compare;
    global $dbprefix;
    global $db;
    $selected = "";
    $table = $dbprefix."_users";
    $request = $db->query("SELECT user_id,first,last FROM $table WHERE approved = 1 AND roles LIKE '%driver%' OR roles LIKE '%cowestdriver%' ORDER BY first ASC");
    echo "<select name='drivers' id='drivers'><option value='-'>--</option>";    
        if(count($request) >0){
            foreach ($request as $driver){
                $selected="";
                if($compare == $driver['user_id']){
                    $selected = "selected";
                    
                }
                echo "<option $selected value='$driver[user_id]'>$driver[first] $driver[last]</option>";
                
            }
        }
    
    echo "</select>";
   
}


function getAcctRep($compare = NULL){
    global $dbprefix;
    $table = $dbprefix."_users";
    $select ="<select id='accntrep' name='accntrep'><option value='-'>--</option>";
    $db= new Database();
    $request = $db->query("SELECT first, last, user_id FROM $table WHERE approved = 1 AND roles like '%account%represntative%'");
    if(count($request) !=0){
        foreach ($request as $acctrep){
            $select .="<option value='$acctrep[user_id]'>$acctrep[first] $acctrep[last]</option>";
        }
    }
    $select .="</select>";
    return $select;
}


function getSalesRep($compare = NULL){   
    global $dbprefix;
    $table = $dbprefix."_users";
    echo "<select id='salesrep' name='salesrep' rel='account_rep' class='field'>";
    
    echo "<option value=''>ALL</option>";
    $db= new Database();
    $request = $db->query("SELECT user_id, first, last FROM $table WHERE approved = 1 AND roles like '%Sales%Representative%'");
    if(count($request) !=0){
        foreach ($request as $sreps){
            
            echo "<option ";  
                if($compare == $sreps['user_id']){
                    echo " selected ";
                }
            
            echo "value='$sreps[user_id]'>$sreps[first] $sreps[last]</option>";
        }
    }
    echo "</select>";
    
}

function getOrigRep($compare = NULL){
   
    global $dbprefix;
    $table = $dbprefix."_users";
    echo "<select id='orig' name='orig' rel='original_sales_person' class='field'><option value='-'>ALL</option>";
    $db= new Database();
    $request = $db->query("SELECT user_id, first, last FROM $table WHERE roles like '%Sales%Representative%'");
    if(count($request) !=0){
        foreach ($request as $sreps){
            
            echo "<option ";  
                if($compare == $sreps['user_id']){
                    echo " selected ";
                }
            
            echo "value='$sreps[user_id]'>$sreps[first] $sreps[last]</option>";
        }
    }
    echo "</select>";
    
}



function field_report_decode($number){
    switch($number){
        case 10:
            echo "No Oil";
            break;
        case 12:
            echo "Skipped: Driver Choice";
            break;
        case 14:
            echo "Skipped: Truck Full";
            break;
        case 16:
            echo "Skipped: Other";
            break;
        case 22:
            echo "Locked: No Key";
            break;
        case 24:
            echo "Locked: Our key did not work";
            break;
        case 26:
             echo "Blocked";
            break;
        case 32:
            echo "Missed time window";
            break;
        case 40:
            echo "Oil Frozen";
            break;
        case 42:
            echo "Garbage in container";
            break;
        case 44:
            echo "Container damaged";
            break;
        case 52:
            echo "Oil Theft: Suspected";
            echo "";
            break;
        case 54:
            echo "Oil Theft: Confirmed";
            break;
        case 62:
            echo "Location Closed: Temporary";
            break;
        case 64:
            echo "Location Closed: Out of business";
            break;
        case 66:
            echo "Lost Account - Confirmed";
            break;
        case 68:
            echo "Manager refused pickup";
            break;
        case 72:
            echo "Added in Error";
            break;
        case 99:
            echo "Emergency Stop Add";
            break;
        case 0 : 
            echo "No Reason Given";
            break;
    }
}


function ZG_decode($value){
    global $db;
    
    $decode = $db->where("value",$value)->get("iwp_driver_report","code,description");
    if(count($decode)>0){
        return "<span title='".$decode[0]['description']."'>".$decode[0]['code']."</span>";
    }else{
        return "N/A";
    }
}

function ZG_decode_description($value){
    global $db;

    $decode = $db->where("value",$value)->get("iwp_driver_report","description");
    if(count($decode)>0){
        return "<span title='".$decode[0]['description']."'>".$decode[0]['description']."</span>";
    }else{
        return "N/A";
    }
}



function zero_gallons_reasons($compare = NULL, $name = NULL){
    global $db;    
    
    if($name == null){
        $name_id = "reason_for_skip_id";
    }else{
        $name_id = $name;
    }
    
    $reason = $db->get("iwp_driver_report");
    echo '<select id="'.$name_id.'" name="'.$name_id.'" class="'.$name_id.'">';
    echo "<option>--SELECT--</option>"; 
    if(count($reason)>0){
        foreach($reason as $n){
            if($compare == $n['value']){
                $select = " selected ";
            }else {
                $select ="";
            }
            echo "<option value='$n[value]' $select >$n[code]&nbsp;$n[description]</option>";
        }
    }
    echo '</select>';
}



function previousP($compare = NULL){
echo '<select name="prev_compet" id="prev_compet" class="field" rel="previous_provider">
    <option '; if($compare =="ignore" || $compare == NULL){ echo "selected";}   echo ' value="ignore">None</option>
    <option '; if($compare =="Advantage Bio"){ echo "selected";}   echo    ' value="Advantage Bio">Advantage Bio</option>
    <option '; if($compare =="Affordable Grease Pumping"){ echo "selected";}   echo    ' value="Affordable Grease Pumping">Affordable Grease Pumping</option>	
    <option '; if($compare =="BioDriven"){ echo "selected";}   echo    ' value="BioDriven">BioDriven</option>	
    <option '; if($compare =="Buster Bio"){ echo "selected";}   echo    ' value="Buster Bio">Buster Bio</option> 
    <option '; if($compare =="Baker Comm.	Darling Int."){ echo "selected";}   echo    ' value="Baker Comm.	Darling Int.">Baker Comm.	Darling Int.</option>	
    <option '; if($compare =="New Leaf"){ echo "selected";}   echo    ' value="New Leaf">New Leaf</option>	
    <option '; if($compare =="Promethian"){ echo "selected";}   echo    ' value="Promethian">Promethian</option> 
    <option '; if($compare =="HT Grease"){ echo "selected";}   echo    ' value="HT Grease">HT Grease</option>	
    <option '; if($compare =="Co-West"){ echo "selected";}   echo    ' value="Co-West">Co-West</option>	
    <option '; if($compare =="Industrial Bio"){ echo "selected";}   echo    ' value="Industrial Bio">Industrial Bio</option>	
    <option '; if($compare =="JK Collections"){ echo "selected";}   echo    ' value="JK Collections">JK Collections</option>	
    <option '; if($compare =="AWJ"){ echo "selected";}   echo    ' value="AWJ">AWJ</option>	
    <option '; if($compare =="Triple A"){ echo "selected";}   echo    ' value="Triple A">Triple A</option>	
    <option '; if($compare =="So-Cal Pumping"){ echo "selected";}   echo    ' value="So-Cal Pumping">So-Cal Pumping</option>
    <option '; if($compare =="Harbor"){ echo "selected";}   echo    ' value="Harbor">Harbor</option>	
    <option '; if($compare =="GCI"){ echo "selected";}   echo    ' value="GCI">GCI</option>	
    <option '; if($compare =="North County"){ echo "selected";}   echo    ' value="North County">North County</option>	
    <option '; if($compare =="OC Bio"){ echo "selected";}   echo    ' value="OC Bio">OC Bio</option>	
    <option '; if($compare =="Eco-Fry"){ echo "selected";}   echo    ' value="Eco-Fry">Eco-Fry</option>
    <option '; if($compare =="Grand Natural"){ echo "selected";}   echo    ' value="Grand Natural">Grand Natural</option>	
    <option '; if($compare =="Grease Masters"){ echo "selected";}   echo    ' value="Grease Masters">Grease Masters</option>	
    <option '; if($compare =="LA Grease Solutions"){ echo "selected";}   echo    ' value="LA Grease Solutions">LA Grease Solutions</option>	
    <option '; if($compare =="CGC"){ echo "selected";}   echo    ' value="CGC">CGC</option>	
    <option '; if($compare =="Coastal By-Products"){ echo "selected";}   echo    ' value="Coastal By-Products">Coastal By-Products</option>	
    <option '; if($compare =="SMC"){ echo "selected";}   echo    ' value="SMC">SMC</option>	
    <option '; if($compare =="HP Comm."){ echo "selected";}   echo    ' value="HP Comm.">HP Comm.</option>	
    <option '; if($compare =="All Pro"){ echo "selected";}   echo    ' value="All Pro">All Pro</option>	
    <option '; if($compare =="Belcito"){ echo "selected";}   echo    ' value="Belcito">Belcito</option>	
    <option '; if($compare =="AJAX Pumping"){ echo "selected";}   echo    ' value="AJAX Pumping">AJAX Pumping</option>	
    <option '; if($compare =="Green Dining Network"){ echo "selected";}   echo    ' value="Green Dining Network">Green Dining Network</option>
</select>';
}


function truck_service_decode($code){
    switch($code){
        case 10:
            echo "In Service";
        break;
        
        case 20:
            echo "Not In Service";
        break;
        
        case 30:
            echo "In the Shop";
        break;
        case 100:
            echo "Sold";    
        break;
    }
}

function truck_service($compare = NULL){
    echo '<select name="vehicle_status_id" id="vehicle_status_id">

<option value="10"'; if($compare == 10){ echo "selected";}  echo ' >In Service</option>

<option value="20" '; if($compare == 20){ echo "selected";}  echo '>Not In Service</option>

<option value="30" '; if($compare == 30){ echo "selected";}  echo '>In the Shop</option>

<option value="100" '; if($compare == 100){ echo "selected";}  echo '>Sold</option>
</select>';
}


function service_call_decode($number){ 
    switch($number){
        case 6:
            echo "Site Cleanup";
            break;
        case 392:
            echo "Verify Containment";
            break;
        case 3:
            echo "Container Delivery";
            break;
        case 4:
            echo "Container Retrieval";
            break;
        case 7:
            echo "Lid Delivery";
            break;
        case 8:
            echo "Wheels: Add/Modify";
            break;
        case 10:
            echo "Lock: Add/Modify";
            break;
        case 24:
            echo "Sensors: Add/Modify";
            break;
        case 100:
            echo "Swap";
            break;
        case 20:
            echo "Other";
            break;
    }
    
}


function code_red($number){
    if( $number == 1 ){
        return "<img src='img/graphics-flashing-light-245546.gif' style='width:25px;height:25px;' />";
    }
    else {
        return "<img src='img/redlight.jpg' style='width:25px;height:25px;' />";
    }
}

 function date_ranges($id = NULL){
    global $db;
    global $dbprefix;
    
    $dates = $db->orderby("date_of_pickup","DESC")->get($dbprefix."_data_table","date_of_pickup");
    if(count($dates)>0){        
        return $dates[0]['date_of_pickup']."|".$dates[count($dates)-1]['date_of_pickup'];
    }else {
        return "0|0";
    }
            
}


function total_gallons_for_route($rnumber,$schedule_id,$account_no) { 
    global $db;
    global $dbprefix;
    $data_table =  $dbprefix."_data_table";
    
    $sum = $db->query("SELECT SUM(inches_to_gallons) as gals_for_current_route FROM $data_table WHERE route_id=$rnumber AND schedule_id = $schedule_id AND account_no = $account_no");
    
    if(count($sum)!=0){        
        return round($sum[0]['gals_for_current_route'],2);
    } else {
        return "0";
    }
}

function get_schedule_route_info($route_id,$account_no,$field){
    global $db;
    global $dbprefix;
    
    $result = $db->where('route_id',$route_id)->where('account_no',$account_no)->get($dbprefix."_scheduled_routes",$field);
    if(count($result)>0){
        return $result[0][$field];
    } else {
        return "";
    }
}


function grease_info($grease_number,$field){
    global $db;
    global $dbprefix;
    $info = $db->where("grease_no",$grease_number)->get($dbprefix."_grease_traps",$field);
    if(count($info)>0 ){
        return $info[0][$field];
    }
    else {
        return "";
    }
    
}


function in_assoc($needle, $haystack) {
     if(in_array($needle, $haystack)) {
          return true;
     }
     foreach($haystack as $element) {
          if(is_array($element) && in_assoc($needle, $element))
               return true;
     }
   return false;
}


function gpi($id){
    global $db;
    $t = $db->query("SELECT gpi FROM iwp_list_of_containers WHERE container_id = $id");
    
    if(count($t)>0){
        return $t[0]['gpi'];
    } else {
        return 0;
    }
    
}


function container_amountHolds($number){
    $db = new Database();
    $jk = $db->where("container_id",$number)->get("iwp_list_of_containers","amount_holds");
    return $jk[0]['amount_holds'];
}

function container_amountHolds_from_containers($entry_number){
    $db = new Database();
    $jk = $db->where("entry",$entry_number)->get("iwp_containers","container_no");
    
    $lp = $db->where("container_id",$jk[0]['container_no'])->get("iwp_list_of_containers","amount_holds");
    return $lp[0]['amount_holds']; 
    
    
}

function container_own_label($entry_number){
    $db = new Database();
    $jk = $db->where("entry",$entry_number)->get("iwp_containers","container_no");
    
    $lp = $db->where("container_id",$jk[0]['container_no'])->get("iwp_list_of_containers","container_id");
    return $lp[0]['container_id'];
    
}

function service_list ($name = NULL,$compare =NULL){
    global $db;
    if($name == NULL){
        $namex = "service_list";
        $idx = "service_list";
    } else {
        $namex = $name;
        $idx = $name;
    }
    
    $list ="<select name='$namex' id='$idx'><option></option>";
    $list .="<option "; if($compare == 6) { $list .= " selected "; }  $list .=" value='6'>Site Cleanup</option>";
    $list .="<option "; if($compare == 392) { $list .= " selected "; }  $list .="  value='392'>Verify Containment</option>";
    $list .="<option "; if($compare == 3) { $list .= " selected "; }  $list .="  value='3'>Container Delivery</option>";
    $list .="<option "; if($compare == 7) { $list .= " selected "; }  $list .="  value='7'>Lid Delivery</option>";
    $list .="<option "; if($compare == 8) { $list .= " selected "; }  $list .="  value='8'>Wheels: Add/Modify</option>";
    $list .="<option "; if($compare == 10) { $list .= " selected "; }  $list .="  value='10'>Lock: Add/Modify</option>";
    $list .="<option "; if($compare == 24) { $list .= " selected "; }  $list .="  value='24'>Sensors: Add/Modify</option>";
    $list .="<option "; if($compare == 100) { $list .= " selected "; }  $list .="  value='100'>Swap</option>";
    $list .="<option "; if($compare == 20) { $list .= " selected "; }  $list .="  value='20'>Other</option>";
    $list .="<option "; if($compare == 4) { $list .= " selected "; }  $list .="  value='4'>Container Retrieval</option>";
    $list .="</option>";
    return $list;
}


function product_translate($product){
    switch($product){
        case 66: return "Extruded Pallett"; break;
        case 67: return "Extruded Gaylord"; break;
        case 68: return "Bulk"; break;
        case 69: return "Single Serve"; break;
        case 70: return "Bagged Under 1 Lb"; break;
        case 71: return "Bagged 1 Lb to 5 Lb"; break;
        case 72: return "Bagged Over 5 Lb"; break;
    }
}

function ventura_products($number){
    switch($number){
        case 56: return "Used Cooking Oil"; break;
        case 57: return "Liquid Margarine"; break;
        case 58: return "Skimmed Oil"; break;
        case 59: return "Oil/Mayo/Marg Over 12 oz"; break;
        case 60: return "Oil/Mayo/Marg 8 oz to 11 oz"; break;
        case 61: return "Oil/Mayo/Marg 5 oz to 7 oz"; break;
        case 62: return "Other Liquid Tote/Bulk"; break;
        case 63: return "Other Liquid Over 16 oz"; break;
        case 64: return "Other Liquid 5 oz to 15 oz"; break;
    }
}


$it = array(
    2060,
    2028,
    99
);
?>
