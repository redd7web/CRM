<table style="width: 100%;margin:auto;">
<tr style="background:-moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">

    <td class="cell_label">ID</td>
    <td class="cell_label">Employee Num</td>
    <td class="cell_label">Name</td>
    <td class="cell_label">Phone</td>
    <td class="cell_label">User</td>
    <td class="cell_label">Title</td>
</tr>
                  <?php
                  $alter =""; 
                  if(!isset($_GET['filter'])){
                    $result = $db->query("SELECT * FROM iwp_users WHERE roles like '%admin%'");
                  }
                  
                  if(count($result)) { 
                    foreach($result as $user){
                        $alter++;            
                        if($alter%2 == 0){
                            $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
                        }
                        else { 
                            $bg = 'trnsparent';
                        }
                        echo "<tr style='background:$bg;'>
                        <td><span style='font-size:9px;'>$user[user_id]</span></td>
                        <td>Employee Number</td>
                        <td style='padding:0px 0px 0px 0px;'><a style='font-size:9px;text-decoration:underline;color:blue;' href='viewUser.php?id=$user[user_id]'>$user[last] $user[first]</a></td>
                        <td><span style='font-size:9px;'>($user[areacode]) $user[phone]</span></td>
                        <td><span style='font-size:9px;'>$user[login_name]</span></td></td>
                        <td>$user[title]</td>
                        </tr>";
                        
                    }
                  } 
                  ?>
</table>