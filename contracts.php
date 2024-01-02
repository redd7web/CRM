 <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
 <link type="text/css" rel="stylesheet" href="css/jquery.dataTables.min.css"/>
<style>
td{
    padding:5px 5px 5px 5px;
    margin:5px 5px 5px 5px;
    border:1px solid gray;
    text-align:center;
    vertical-align:middle;
}
</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable({
        "lengthMenu": [ [10, 25, 50,100,150, -1], [10, 25, 50,100,150, "All"] ]
   }); 
});
</script>
<?php

include "protected/global.php";
ini_set("display_errors",0);
function dir_is_empty($dir) {
    $handle = opendir($dir);
    $result = true;
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $result = false;
            break;
        }
    }
    closedir($handle);
    return $result;
}

$criteria = "";
$file = "";
if(isset($_POST['search_contracts'])){
    if(!empty($_POST)){
        foreach($_POST as $name=>$value){
            switch($name){
                case "a_name":
                    if(strlen(trim($value))>0){
                        $arrField[] = " Name like '%$value%'";
                    }
                   
                break;
                case "a_id":
                    if(strlen(trim($value))>0){
                        $arrField[] = " account_ID = $value";
                    }
                    
                break;
                case "status":
                    if(strlen(trim($value))>0 && $value !="ignore"){
                        $arrField[] = " status like '%$value%'";
                    }
                    
                break;
                case "in_db":
                
                    if($value ==1){
                        $arrField[] = " contract IS NOT NULL";
                    }else if ($value == 2){
                         $arrField[] = " contract IS NULL";
                    }else if ($value == 3){
                         $file = $value;
                    }else if ($value == 4){
                        $file = $value;
                    }
                
                break;
            }
        }
    }
    
    if(!empty($arrField)){
        $criteria = "AND ".implode(" AND ", $arrField);
    }
    echo "SELECT account_ID,Name,status,contract FROM iwp_accounts WHERE 1 $criteria<br/>";
    $u = $db->query("SELECT account_ID,Name,status,contract FROM iwp_accounts WHERE 1 $criteria");
}else{
    $u = $db->query("SELECT account_ID,Name,status,contract FROM iwp_accounts");
}


?>
<form action="contracts.php" method="POST">
<table style="width: 1000px;margin:auto;">
<tr><td  style="text-align: right;vertical-align:top;width:50%;">Account Name</td><td style="text-align: left;vertical-align:top;"><input type="text" value="<?php echo $_POST['a_name']; ?>" name="a_name"/></td></tr>
<tr><td  style="text-align: right;vertical-align:top;width:50%;">Account Id</td><td style="text-align: left;vertical-align:top;"><input type="text" value="<?php echo $_POST['a_id']; ?>" name="a_id"/></td></tr>
<tr><td  style="text-align: right;vertical-align:top;width:50%;">Account Status</td><td style="text-align: left;vertical-align:top;">
                            <select id="status" name="status" class="field" rel="status" >
                                    <option value="ignore">--</option>
                                   
                                    <option  <?php if($_POST['status'] == "Archive" ) { echo "selected"; } ?>   value="Archive">Archived</option>
                                    <option  <?php if($_POST['status'] == "New" ) { echo "selected"; } ?>   value="New">New</option>
                                    <option  <?php if($_POST['status'] == "Active" ) { echo "selected"; } ?>   value="Active">Active</option>
                                    <option  <?php if($_POST['status'] == "On Hold" ) { echo "selected"; } ?>   value="On Hold">On Hold/Seasonal</option>
                                    <option  <?php if($_POST['status'] == "Ending" ) { echo "selected"; } ?>   value="Ending">Ending</option>
                                    <option  <?php if($_POST['status'] == "Out of Business" ) { echo "selected"; } ?>   value="Out of Business">Out of Business</option>
                                    <option  <?php if($_POST['status'] == "Re-signed Account" ) { echo "selected"; } ?> value="Re-sign" >Re-signed Account</option>
                                </select></td></tr>
<tr><td  style="text-align: right;vertical-align:top;width:50%;">In Database / Contract exists</td><td  style="text-align: left;vertical-align:top;">
            <select name="in_db">
                    <option>--</option>
                    <option  <?php if($_POST['in_db'] == 1 ) { echo "selected"; } ?>  value="1">In Database</option>
                    <option  <?php if($_POST['in_db'] == 2 ) { echo "selected"; } ?>  value="2">Not In Database</option>
                    <option  <?php if($_POST['in_db'] == 3) { echo "selected"; } ?>  value="3">On file</option>
                    <option   <?php if($_POST['in_db'] == 4) { echo "selected"; } ?> value="4">Not On file</option>
                   </select></td></tr>
                   <tr><td colspan="2" style="text-align: right;"><input type="submit" name="search_contracts" value="Search"/></td></tr>
</table>
</form>
<?php


echo "<table id='myTable'> <thead>
                <tr>
                <td>Name</td>
                <td>Id</td>
                <td>In DB</td>
                <td>File Exists</td>
                <td>status</td>
            </tr>
            </thead>
            <tbody>";
if(count($u)>0){
         if(isset($_POST['search_contracts'])){
            
             foreach ($u as $n){
                if( strlen(trim($n['contract'])>0)){
                    $db= "<img src='img/check_green_2s.png'/>";
                }else{
                        $db = "<img src='img/red_cancel.png'/>";
                }
                if($_POST['in_db'] == 3 && file_exists("$n[account_ID]/contract")  ){
                    echo "<tr><td style='text-align:center;'>$n[Name]</td><td style='text-align:center;'> $n[account_ID]</td> <td style='text-align:center;'>$db</td> <td style='text-align:center;'><img src='img/check_green_2s.png'/></td> <td style='text-align:center;'> $n[status]</td> </tr>";
                }else if($_POST['in_db'] == 4 && !file_exists("$n[account_ID]/contract") ){
                    echo "<tr><td style='text-align:center;'>$n[Name]</td><td style='text-align:center;'> $n[account_ID]</td> <td style='text-align:center;'>$db</td> <td style='text-align:center;'><img src='img/red_cancel.png'/></td> <td style='text-align:center;'> $n[status]</td> </tr>";
                } else if ($_POST['in_db'] !=3 && $_POST['in_db'] !=4 ){
                    
                     if( file_exists("$n[account_ID]/contract") ){
                         if(  dir_is_empty("$n[account_ID]/contract")){
                            $file = "<img src='img/red_cancel.png'/>";
                         }else{
                            $file= "<img src='img/check_green_2s.png'/>"; 
                         }
                        
                     }else{
                       $file = "<img src='img/red_cancel.png'/>";
                     }
                     echo "<tr>
                <td style='text-align:center;'>$n[Name]</td><td style='text-align:center;'> $n[account_ID]</td> <td style='text-align:center;'>$db</td> <td style='text-align:center;'>$file</td> <td style='text-align:center;'> $n[status]</td> </tr>";
                }
             }
         }else{
            foreach($u as $n){
                
                if( strlen(trim($n['contract'])>0)){
                    $db= "<img src='img/check_green_2s.png'/>";
                }else{
                        $db = "<img src='img/red_cancel.png'/>";
                }
                    
                if( file_exists("$n[account_ID]/contract") ){
                    
                     if(  dir_is_empty("$n[account_ID]/contract")){
                        $file = "<img src='img/red_cancel.png'/>";
                     }else{
                        $file= "<img src='img/check_green_2s.png'/>"; 
                     }
                    
                }else{
                   $file = "<img src='img/red_cancel.png'/>";
                }
                
                 echo "<tr>
                <td style='text-align:center;'>$n[Name]</td><td style='text-align:center;'> $n[account_ID]</td> <td style='text-align:center;'>$db</td> <td style='text-align:center;'>$file</td> <td style='text-align:center;'> $n[status]</td> </tr>";
            }
         }       
            
   
        
        
    }
    echo "</tbody></table>";

?>