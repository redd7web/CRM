<table style="width: 100%;margin:auto;">
  <tr><td colspan="3" style="height: 20px;"><a href="addUser.php"><img src="img/add_item.big.gif" />&nbsp;<span style="font-size: 12px;">Add User</span></a><br /></td></tr>
  <tr style="background:-moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">
      <td style="border:1px solid #000000;"><a href="" style="font-size: 12px;color:blue;text-decoration:underline;">User ID</a></td>
      <td style="border:1px solid #000000;"><a href="" style="font-size: 12px;color:blue;">Staff ID</a></td>
      <td style="width:5%;border:1px solid #000000;"><a href="" style="font-size: 12px;color:blue;text-decoration:underline">Name</a></span></td>
      <td style="width:7%;underline;border:1px solid #000000;"><a href="" style="font-size: 12px;color:blue;text-decoration:underline;">Last Login</a></span></td>
      <td style="width:5%;border:1px solid #000000;"><a href="" style="font-size: 12px;color:blue;text-decoration:underline;">Facility</a></span></td>
      <td class="cell_label"><span style="font-size:9px;" title="User can enter data: new accounts, collection/trip reports">Data Entry</span></td>

                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Schedule pickups and service calls, Add fires, add a message, etc">Customer Support (Basic)</span></td>
                    
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Change settings, sharing, flags, address and other customer data - locations and accounts ">Customer Support (Full)</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="User can use sales leads system">Sales</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="View routes, enter collection/trip reports">Driver</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="User can perform routing functions">Routing</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Some users may have extra searching options, see full list of facilties, etc">Advanced Searching</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Can see reports">Report Access</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Full access to routing - includes exporting">Routing (Advanced)</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Full access to customer records - includes archiving, etc">Customer Support (Advanced)</span></td>
                    
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Manage, edit and assign Sales Leads">Sales Management</span></td>
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Create and edit Staff Members">Staff Management</span></td>
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Create and edit Users">User Management</span></td>
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Overall data integrity - delete notes, fix completed pickups, etc">Data Management</span></td>
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Can assign Advanced and Management access">User Management (Advanced)</span></td>
                    <td class="cell_label"><span style="font-size:9px;font-weight:bold;" title="Executive and financial functions - see reports, export data">Business Management</span>
                 </tr>
                  <?php 
                  $alter ="";
                  if(!isset($_GET['filter'])){
                    $result = $db->get($dbprefix."_users","*");
                  }
                  $header_again = 0;
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
                        
<td><span style='font-size:12px;'>$user[user_id]</span></td>

<td><span style='font-size:12px;'>$user[staff_id]</span></td>

<td style='padding:0px 0px 0px 0px;'><a style='font-size:12px;text-decoration:underline;color:blue;' href='viewUser.php?id=$user[user_id]'>$user[last] $user[first]</a></td>

<td><span style='font-size:12px;'>$user[last_login]</span></td>

<td><span style='font-size:12px;'>$user[facility]</span></td></td>

<td id='data_entry'></td>

<td id='cust_support_basic'></td>

<td id='cust_support_full'></td>


<td id='sales'></td>

<td id='driver'></td>

<td id='routing'></td>

<td id='adv_search'></td>

<td id='report'></td>

<td id='cust_support_adv'></td>
<td id='sales_manage'></td>
<td id='staff_manage'></td>
<td id='user_manage'></td>
<td id='data_manage'></td>
<td id='user_manage_adv'></td>
<td id='business_manage'></td>
<td></td>
</tr>
";
                        
                    }
                  } 
                  ?>
</table>