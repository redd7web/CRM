
<?php 
ini_set("display_errors",1);
?>
<div id="header">
    <div id="alwaysmiddle">
        <div id="leftx" style="width:59.5%;height:90px;background:transparent;float:left;">
        <div id="quicksearch">
        <?php if(isset($_SESSION['id'])){ ?>
            <div class="mail">
            <a href="message.php<?php if(isset($_GET['id'])){ echo "?account=".$_GET['id'];} ?>" rel="shadowbox;width=900;height=500"><img src="img/msg.jpg" /></a>
            </div>
            <div id="home"></div>
            <div id="search"></div>
            <div id="spare1" style="width:25px;height:19px;float:left;background:url(https://inet.iwpusa.com/bakery/img/charts-512.png) no-repeat center top;margin-right:2px;background-size:contain;cursor:pointer;"></div>
            <div id="spare2" style="width:25px;height:19px;float:left;background:transparent;margin-right:2px;"></div>
            
            <div id="pw" style="width: 100px;height:19px;float:left;margin-right:2px;">
                <button style="width: 100px;height:20px;font-size:9px;font-family:tahoma;text-align:center;font" id="change">Change Password</button>
            </div>
            <script>
               
            </script>
            <div id="name" style="width: auto;min-width:100px;font-size:11px;font-family:tahoma;text-align:center;float:left;margin-right:2px;color:rgb(14, 41, 146);font-weight:bold;"> <?php if( isset($_SESSION['id']) ){ $person = new Person(); echo $person->login_name; } ?>, is logged on&nbsp;&nbsp;
            </div>
            
            <div id="logout" style=""></div>
           
          <?php }else { echo "<span style='float:left;width:auto;'>Please login below</span>"; } ?>  
             <div id="quick_navi" style="width: 103px;height:30px;float:left;margin-left:5px;">
                <select name="module_select" id="module_select"><option>Please select module--</option><option id="bakery">Bakery</option><option id="gt">Grease Trap</option><option id="org">Organics</option></select>
            </div>
        </div> 
        <div id="spacerlogo" style="with:340px;height:11px;"></div> 
        <div id="menu_drown_down"  style="height: 45px;width:100%;background:transparent;"><!--- react drop down menu goes here ---!></div>    
     </div> 
     <div id="blogo">
        <div id="title_top_spacer"></div>
        <div id="title" style="width: 100%;text-align:center;color:rgb(14, 41, 146);font-weight:bold;font-size:22px;float:right;text-transform:uppercase;"><span style="float: right;margin-right:10px;font-size:16px;"><?php echo "$page"; ?></span></div>
    </div>
    
    </div>
     
    
</div>
<?php
 $extra="";
 if(isset($_GET['task'])){
         switch($_GET['task']){ // what search field are you viewing ?
            case "driverslog":
            case "overview":
            case "oilrouting":            
            case "indices": 
            case "roi":
            case "vehicles":
            case "friendly":
            case "jobcost":
            case "freq":
            case "freport":
            case "freportarea":      
            case "crequest":
            case "patch":
            case "maproute":
            case "accounts":
                 $extra = " style='visibility:hidden;display:none;'";
            ?>
            <div id="scaffold" style="height:110px;width:100%;float:left;"></div>
            <?php
                break;
           default:
        }
    }else{
        if(isset($_SESSION['id'])){
             $extra = " style='height:110px;background:transparent;width:100%;display:none;'";//default logged in view.
        }else{
             $extra = " style='height:110px;background:transparent;width:100%;'";//sign in view
        }
        ?>
        <div id="scaffold" style="height:90px;width:100%;float:left;"></div>
        <?php
    }        
?>
<div id="transparent"<?php echo $extra; ?>>
    <style>
    table td{
        padding:5px 5px 5px 5px;
    }
    </style>
    <?php if( !isset($_SESSION['id'])){ ?>
    <!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/css/util.css">
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v3/css/main.css">
<!--===============================================================================================-->
    <div class="limiter">
		<div class="container-login100" style="background-image: url('https://colorlib.com/etc/lf/Login_v3/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="protected/biologin.php" method="post" id="form_one">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="biouser" placeholder="Username" style="border: 0px solid #bbb;"/>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
                    
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" name="biopw" type="password" placeholder="Password" style="border: 0px solid #bbb;"/>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
                  
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>
                    
					<div class="container-login100-form-btn">
						<input type="submit" value="Login" class="login100-form-btn" name="biosub" />
							
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
    
    <?php }else {
        //load appropriate search fields / disclaimer
        if(isset($_GET['task'])){
            switch($_GET['task']){
            case "maproute":

                break;

                case "driverslog":

                break;
                case "notes":
                    ?>
                    <form action="management.php?task=notes" method="post">
                   <table style="font-size:smaller; border:1px grey solid;margin:auto; margin-top:20px;width:50%; margin-bottom:20px;"><tbody>
                   <tr>
                   <td>Author</td><td>
                   <select name="author">
                   <option></option>
                   <?php
                         $axix = $db->query("SELECT user_id,first,last FROM iwp_users");
                         if(count($axix)>0){
                            foreach($axix as $acox){
                                $compare ="";
                                if($_POST['author']==$acox['user_id']){
                                    $compare = "selected";
                                }
                                echo "<option $compare value='$acox[user_id]'>$acox[first] $acox[last]</option>";
                            }
                         }
                   ?>
                   </select>
                   </td>
                   </tr><tr>
                   <td>Account</td><td><select name="account">
                   <option></option>
                   <?php
                         $ax = $db->query("SELECT account_ID,name FROM iwp_accounts");
                         if(count($ax)>0){
                            foreach($ax as $aco){
                                $compare ="";
                                if($_POST['account']==$aco['account_ID']){
                                    $compare = "selected";
                                }
                                echo "<option $compare value='$aco[account_ID]'>$aco[name]</option>";
                            }
                         }
                   ?>
                   </select></td>
                   </tr><tr>
                   <td>Facility</td><td>
                   <?php 
                    if(isset($_POST['search_now'])){
                        echo getFacilityList("",$_POST['facility']);
                    } else {
                        echo getFacilityList("","");
                    }
                   ?>
                   </td>
                   </tr>
                   <tr>
                   
                   <td>Keyword(s)</td><td><textarea style="width: 80%;" placeholder="keyword(s)"  name="run_key"/><?php if(isset($_POST['search_now'])){ echo $_POST['run_key'];  } ?></textarea></td>
                   </tr><tr>
                   <td>Created Date</td>
                  <td>
                <input type="text" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" value="<?php if(isset($_POST['from'])){ echo $_POST['from'];  } ?>"  />&nbsp;
                <input value="<?php if(isset($_POST['to'])){ echo $_POST['to'];  } ?>"  type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to" />

</td>
</tr><tr>
<td colspan="2" style="text-align:right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /></td></tr></tbody></table>
                    </form>
                                        
                    <?php
                    break;
                case "csupport":
                    ?>
                        <form action="management.php?task=csupport" method="post">
                        <table style="margin: auto;width:50%;margin-top:20px;margin-bottom:20px;"><tbody>
                        <tr><td>Facility</td><td><?php 
    if(isset($_POST['facility'])){ 
        getFacilityList("",$_POST['facility']);
    } else { 
        getFacilityList(); 
    }   ?></td></tr>
                    <tr><td>Friendly</td><td> <?php
                        if(isset($_POST['friendly'])){ 
                            getFriendLists($_POST['friendly']); 
                        } else { 
                            getFriendLists(); 
                        };
                        
                    ?></td></tr>    
                    <tr><td>State</td><td><input value="" size="3" name="state" value="<?php  
    if( isset($_POST['state']) ){ echo $_POST['state'];} ?>" /></td></tr>
                    <tr><td style="vertical-align: top;">Customer Support Period</td><td><input type="text" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from"  value="<?php if(isset($_POST['from'])){ echo $_POST['from'];  } ?>" /><br /><input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to" value="<?php if(isset($_POST['from'])){ echo $_POST['to'];  } ?>" /></td></tr>
                    
                   
                        <tr><td colspan="2" style="text-align: right;"> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit"value="Search" name="search_now"/></td></tr>
</tbody>
                    </table>
                    </form>
                    <?php
                    break;
                case "alloil":
                    ?>
                    <form action="management.php?task=alloil" method="POST">
                    <table style="margin: auto;width:50%;margin-top:20px;margin-bottom:20px;">
                    <tbody>
                        <tr><td>Facility</td><td><?php if(isset($_POST['facility'])){ getFacilityList("",$_POST['facility']);} else { getFacilityList(); } ?></td></tr>
                        <tr><td>Friendly</td><td> <?php if(isset($_POST['friendly'])){ getFriendLists($_POST['friendly']); } else { getFriendLists(); }
 ?></td></tr>
                        <tr>
                        <td style="vertical-align: top;">Oil Collection Period</td>
                        <td class="field_label">
                            
                            <div>
                                <input type="text" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" value="<?php  
                                if(isset($_POST['from'])){  
                                    echo $_POST['from'];
                                } ?>" />
                            </div>
                            <div>
                                <input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to" value="<?php  if(isset($_POST['to'])){  
                                    echo $_POST['to'];
                                } ?>" />
                            </div>
                            </td>
                            </tr>
                            <tr><td>Account Name</td><td><input value="<?php if(isset($_POST['account_id'])){ echo $_POST['account_id'];  } ?>"  size="15" name="account_name"/></td></tr>
                            
                            <tr><td>Account ID</td><td><input value="" size="10" name="account_id"/></td></tr>
                            <tr><td>City</td><td><input type="text" id="city" name="city" value="<?php echo $_POST['city']; ?>"/></td></tr>
                            <tr><td>State</td><td><input value="<?php if(isset($_POST['state'])){ echo $_POST['state'];  } ?>" size="3" name="state" /></td></tr>
                            
                            
                            <tr>
                          
                            <td colspan="4" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" name="search_now" value="Search Now"/></td></tr>
</tbody>
                    </table>
                    </form>
                    <?php
                    break;
                 case "cancel":
                    ?> 
                    <form method="post" action="management.php?task=cancel">
                    <table style="width: 500px;margin:auto;margin-top:20px;margin-bottom:20px;">
                    <tr><td style="vertical-align: top;">Facility</td><td  style="text-align: left;vertical-align:top;"><?php if(isset($_POST['facility'])){ getFacilityList("",$_POST['facility']);} else { getFacilityList(); }; ?></td></tr>
                    <tr><td style="vertical-align: top;">Date Range</td><td style="text-align:left;vertical-align:top;">
                        <input style="border-radius: 0px 0px 0px;" type="text" name="from"   value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>"  placeholder="Start Date" id="cancelstart"/><br /><br />
                        <input  value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" style="border-radius: 0px 0px 0px;" type="text" name="to"  placeholder="End Date"  id="cancelend"/>
                        </td></tr>
                    <tr><td colspan="2" style="text-align:right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search Now" name="search_now" /></td></tr>
                    </table>
                    </form>
                    <?php
                    break;
                    
                case "asset":
                ?>
                <form action="management.php?task=asset" method="post">
                    <table style="font-size:smaller; border:1px grey solid;margin:auto;margin-bottom:20px; margin-top:20px;width:50%;"><tbody><tr>
                    <td style="text-align:left;">
                    Container 
                    </td>
                    <td style="text-align:left;">
                    <?php
                        if(isset($_POST['search_now'])){
                            containerList($_POST['container_size'],"");
                        } else {
                            containerList("","");    
                        }
                    ?>
                    </td>
                    </tr><tr>
                    <td style="text-align:left;">Facility</td>
                    <td style="text-align:left;">
                    <?php
                        if(isset($_POST['search_now'])){
                            getFacilityList("",$_POST['facility']);
                        }else {
                            getFacilityList("","");        
                        }
                        
                    ?></a>
                    </td>
                    </tr>
                    <tr>
                    <td style="text-align:left;">
                    Date delivered
                    </td>
                    <td>
                        <input type="text" placeholder="Date Delivered" name="delivered" value="<?php  if(isset($_POST['search_now'])){ echo $_POST['delivered']; }?>" id="delivered"/>
                    </td>
                    </tr>
                    <tr>
                    
                    <td style="text-align:left;">Account:</td>
                    <td style="text-align:left;">
                    <select name="accounts"><option></option>
                    <?php 
                    $kl = $db->query("SELECT name,account_ID FROM iwp_accounts WHERE status ='active'");
                    if(count($kl)>0){
                        
                        foreach($kl as $lk){
                            $compare = '';
                            $selected ='';
                            if(isset($_POST['search_now'])){
                                $compare = $_POST['accounts'];
                            }
                            if($compare == $lk['account_ID']){ echo  $selected =" selected "; }
                            
                            echo "<option $selected value='$lk[account_ID]''>$lk[name]</option>";
                        }
                    }
                    ?>
                    </select>
                    </td>
                    </tr><tr>
                    <td colspan="2" style="text-align: right;">&nbsp;<a href="management.php?task=friendly">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="submit now" name="search_now"/></td>
                    </tr></tbody></table></form>
                <?php
                break; 
                case "users":                    
                    ?>
                    <table border="0" align="center" cellpadding="1"><tbody>
                        <tr>
                    
                            <td width="100" style="white-space:nowrap;font-weight:bold;">Name&nbsp;<input  value="<?php  if( isset($_POST['search_value']) ){ echo $_POST['search_value'];} ?>" size="15" name="search_value" id="search_value"/>
                            </td>
                            <td nowrap="" align="right" style="padding-left:10px;font-weight:bold;" class="field_label">
                            User Group
                            </td>
                            <td width="200" align="left">
                                <select id="group_id" name="group_id"><option value="">All</option>
                                <option <?php if($_POST['group_id'] == "1020" ) { echo "selected"; } ?>  value="1020">Data Entry</option>
                                
                                <option  <?php if($_POST['group_id'] == "1056" ) { echo "selected"; } ?>   value="1056">Customer Support (Basic)</option>
                                
                                <option  <?php if($_POST['group_id'] == "1057" ) { echo "selected"; } ?>   value="1057">Customer Support (Full)</option>
                                
                                <option  <?php if($_POST['group_id'] == "1040" ) { echo "selected"; } ?>   value="1040">Sales</option>
                                
                                <option  <?php if($_POST['group_id'] == "1025" ) { echo "selected"; } ?>   value="1025">Driver</option>
                                
                                <option  <?php if($_POST['group_id'] == "1050" ) { echo "selected"; } ?>   value="1050">Routing</option>
                                
                                <option  <?php if($_POST['group_id'] == "1060" ) { echo "selected"; } ?>   value="1060">Advanced Searching</option>
                                
                                <option  <?php if($_POST['group_id'] == "1061" ) { echo "selected"; } ?>   value="1061">Report Access</option>
                                
                                <option  <?php if($_POST['group_id'] == "1020" ) { echo "selected"; } ?>   value="1062">Routing (Advanced)</option>
                                
                                <option  <?php if($_POST['group_id'] == "1058" ) { echo "selected"; } ?>   value="1058">Customer Support (Advanced)</option>
                                
                                <option  <?php if($_POST['group_id'] == "1030" ) { echo "selected"; } ?>   value="1030">Sales Management</option>
                                
                                <option  <?php if($_POST['group_id'] == "1059" ) { echo "selected"; } ?>   value="1059">Staff Management</option>
                                
                                <option  <?php if($_POST['group_id'] == "130" ) { echo "selected"; } ?>   value="130">User Management</option>
                                
                                <option  <?php if($_POST['group_id'] == "1010" ) { echo "selected"; } ?>   value="1010">Data Management</option>
                                
                                <option  <?php if($_POST['group_id'] == "1063" ) { echo "selected"; } ?>   value="1063">User Management (Advanced)</option>
                                
                                <option  <?php if($_POST['group_id'] == "1052" ) { echo "selected"; } ?>   value="1052">Business Management</option>
                                </select></td>
                                
                                <td nowrap="" align="right" style="padding-left:10px;font-weight:bold;" class="field_label">Staff Role</td>
                                <td width="200" align="left">
                            <select id="role_id" name="role_id"><option value="">All</option>
                            <option  <?php if($_POST['role_id'] == "1" ) { echo "selected"; } ?>   value="1">Customer Support</option>
                            
                            <option  <?php if($_POST['role_id'] == "2" ) { echo "selected"; } ?>   value="2">Account Representative</option>
                            
                            <option  <?php if($_POST['role_id'] == "3" ) { echo "selected"; } ?>   value="3">Sales Representative</option>
                            
                            <option  <?php if($_POST['role_id'] == "19" ) { echo "selected"; } ?>   value="19">Sales Leads User</option>
                            
                            <option  <?php if($_POST['role_id'] == "4" ) { echo "selected"; } ?>   value="4">Service Driver</option>
                            
                            <option  <?php if($_POST['role_id'] == "5" ) { echo "selected"; } ?>   value="5">Oil Driver</option>
                            
                            <option  <?php if($_POST['role_id'] == "11" ) { echo "selected"; } ?>   value="11">Scheduler</option>
                            
                            <option  <?php if($_POST['role_id'] == "7" ) { echo "selected"; } ?>   value="7">Facility Manager</option>
                            
                            <option  <?php if($_POST['role_id'] == "8" ) { echo "selected"; } ?>   value="8">Corporate Manager</option>
                            
                            <option  <?php if($_POST['role_id'] == "9" ) { echo "selected"; } ?>   value="9">Shop Crew</option>
                            
                            <option  <?php if($_POST['role_id'] == "10" ) { echo "selected"; } ?>   value="10">Sales Zone Manager</option>
                            
                            <option  <?php if($_POST['role_id'] == "12" ) { echo "selected"; } ?>   value="12">Can be Assigned Issues</option>
                            
                            <option  <?php if($_POST['role_id'] == "13" ) { echo "selected"; } ?>   value="13">MMS for New fires</option>
                            
                            <option  <?php if($_POST['role_id'] == "18" ) { echo "selected"; } ?>   value="18">MMS for Theft Alert</option>
                            
                            <option  <?php if($_POST['role_id'] == "14" ) { echo "selected"; } ?>   value="14">MMS for Call Center Message</option>
                            
                            <option  <?php if($_POST['role_id'] == "15" ) { echo "selected"; } ?>   value="15">Receive Phone Messages</option>
                            
                            
                            
                            <option value="16">CIP Enterprise Contact</option>
                            </select></td><td style="white-space:nowrap;font-weight:bold;"><input type="checkbox" name="include_inactive"  value="<?php  if( isset($_POST['inclued_inactive']) ){ echo "checked";} ?>"  style="margin-right: 10px;" />Show&nbsp;Inactive</td><td width="80" align="left"><input type="submit" value="Search" name="search_now" /><input type="reset"/> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a></td></tr></tbody></table>
                    <?php
                    break;
                case "staff":
                    ?>
                    
                     <table border="0" align="center" cellpadding="1" style="font-size: 12px; border:1px grey solid; margin:auto;width:80%;margin-top:35px;font-weight:normal;"><tbody><tr><td style="white-space:nowrap;">Search for 
                     
                     <input value="" size="15" name="search_value"  value="<?php  if( isset($_POST['search_value']) ){ echo $_POST['search_value'];} ?>"/> and/or choose </td>
                    <td nowrap="" align="right" style="padding-left:10px;vertical-align:middle;" class="field_label">Role</td>
                    <td width="200" align="left">
                    <select id="role_id" name="role_id"><option value="">All</option>
                    <option  <?php if($_POST['role_id'] == "1" ) { echo "selected"; } ?>   value="1">Customer Support</option>
                    
                    <option  <?php if($_POST['role_id'] == "2" ) { echo "selected"; } ?>   value="2">Account Representative</option>
                    
                    <option  <?php if($_POST['role_id'] == "3" ) { echo "selected"; } ?>   value="3">Sales Representative</option>
                    
                    <option  <?php if($_POST['role_id'] == "19" ) { echo "selected"; } ?>   value="19">Sales Leads User</option>
                    
                    <option  <?php if($_POST['role_id'] == "4" ) { echo "selected"; } ?>   value="4">Service Driver</option>
                    
                    <option  <?php if($_POST['role_id'] == "5" ) { echo "selected"; } ?>   value="5">Oil Driver</option>
                    
                    <option  <?php if($_POST['role_id'] == "11" ) { echo "selected"; } ?>   value="11">Scheduler</option>
                    
                    <option  <?php if($_POST['role_id'] == "7" ) { echo "selected"; } ?>   value="7">Facility Manager</option>
                    
                    <option  <?php if($_POST['role_id'] == "8" ) { echo "selected"; } ?>   value="8">Corporate Manager</option>
                    
                    <option  <?php if($_POST['role_id'] == "9" ) { echo "selected"; } ?>   value="9">Shop Crew</option>
                    
                    <option  <?php if($_POST['role_id'] == "10" ) { echo "selected"; } ?>   value="10">Sales Zone Manager</option>
                    
                    <option  <?php if($_POST['role_id'] == "12" ) { echo "selected"; } ?>   value="12">Can be Assigned Issues</option>
                    
                    <option  <?php if($_POST['role_id'] == "13" ) { echo "selected"; } ?>   value="13">MMS for New fires</option>
                    
                    <option  <?php if($_POST['role_id'] == "18" ) { echo "selected"; } ?>   value="18">MMS for Theft Alert</option>
                    
                    <option  <?php if($_POST['role_id'] == "14" ) { echo "selected"; } ?>   value="14">MMS for Call Center Message</option>
                    
                    <option  <?php if($_POST['role_id'] == "15" ) { echo "selected"; } ?>   value="15">Receive Phone Messages</option>
                    
                    
                    <option  <?php if($_POST['role_id'] == "16" ) { echo "selected"; } ?>   value="16">CIP Enterprise Contact</option>
                    </select></td><td style="font-size:80%; white-space:nowrap;width:30%;">
                    
                    <input type="checkbox" name="include_inactive" style="margin-right:5px;"  value="<?php  if( isset($_POST['include_inactive']) ){ echo $_POST['include_inactive'];} ?>"/>&nbsp;&nbsp;&nbsp;Show Inactive</td><td width="80" align="left"><input type="submit" value="Search" name="search_now"/><input type="reset"/> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a></td></tr></tbody></table>
                    
                    <?php
                    break;
    case "accounts":
        ?>
        <style type="text/css">
            input[type=text]{
                width:100px;
                border-radius:0px 0px 0px 0px;
                border:1px solid #bbb;
                height:25px
            }
            ul#facNavi{
                list-style-type:none;
            }
           

            ul#view{
                min-width: 696px;
            	list-style: none;
            	padding-top: 0px;
            }
                    ul#view li{
                        display:inline-block;
                       display: inline;
                    }
                    
        </style>
        <div id="mainHolder" style="width: 1000px;height:auto;min-height:200px;margin:auto;">
            <form method="post" action="customers.php?task=accounts">
                <table style="float: left;margin-right:10px;width:1000px;border-collapse: collapse;">
                    <tr><td>Account Status</td><td style="text-align: right;vertical-align:top;">
                            <select id="status" name="status" class="field" rel="status" > 
                                <option <?php if($_POST['status'] == "all" ) { echo "selected"; } ?>    value="all">All</option>
                                <option <?php if($_POST['status'] == "Active" ) { echo "selected"; } ?>     value="Active">Active( Ready to be serviced )</option>
                                <option<?php if($_POST['status'] == "Archive" ) { echo "selected"; } ?> value="Archive">Archived</option>
                                <option <?php if($_POST['status'] == "Ending" ) { echo "selected"; } ?>    value="Ending">Ending (Final pumping)</option>
                                <option <?php if($_POST['status'] == "New" ) { echo "selected"; } ?>  value="New">New (Needs New Account)</option>
                                <option <?php if($_POST['status'] == "On Hold" ) { echo "selected"; } ?> value="On Hold">On Call (On Call)</option>
                            </select></td></tr>

                    <tr><td>Payment</td><td  style="text-align: right;vertical-align:top;">

                            <select id="payment_type_id" name="payment_type_id">
                                <option value="ignore">All</option>
                                <option <?php if($_POST['payment_type_id'] == "No Pay") { echo "selected";}  ?> value="No Pay"  id="np">No Pay</option>
                                <option  <?php if($_POST['payment_type_id'] == "Jacobson") { echo "selected";}  ?>  value="Jacobson" id="index">Index (Jacobson)</option>
                                <option <?php if($_POST['payment_type_id'] == "Per Gallon") { echo "selected";}  ?>  value="Per Gallon" id="pg">Per Gallon</option>
                                <option <?php if($_POST['payment_type_id'] == "O.T.P. Per Gallon") { echo "selected";}  ?>  value="O.T.P. Per Gallon" id="otppg">One Time Payment Per Gallon</option>
                                <option <?php if($_POST['payment_type_id'] == "One Time Payment") { echo "selected";}  ?> value="One Time Payment" id="otp">One Time Payment</option>
                                <option <?php if($_POST['payment_type_id'] == "both_otp") { echo "selected";}  ?>  value="both_otp" id="both_otp">One Time Payment / One Time Payment Per Gallon</option>
                            </select></td>
                    </tr>
                    <tr><td  style="text-align: left;vertical-align:top;">Competitor Onsite</td><td  style="text-align: right;vertical-align:top;"><input name="onsite" name="onsite" type="checkbox" value="1"/></td></tr>
                    <tr><td style="text-align: left;vertical-align:top;">Competitor Name</td><td style="text-align: right;vertical-align:top;"><select id="comp_name" name="comp_name" style="width:150px;" >
                                <option></option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Advantage Bio"){ echo "checked"; }   } ?>  value="Advantage Bio">Advantage Bio</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Affordable Grease Pumping"){ echo "checked"; }   } ?>   value="Affordable Grease Pumping">Affordable Grease Pumping</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="BioDriven"){ echo "checked"; }   } ?>   value="BioDriven">BioDriven</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Buster Bio"){ echo "checked"; }   } ?>    value="Buster Bio">Buster Bio</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Baker Comm."){ echo "checked"; }   } ?>    value="Baker Comm.">Baker Comm.</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Darling Int."){ echo "checked"; }   } ?>    value="Darling Int.">Darling Int.</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="New Leaf"){ echo "checked"; }   } ?>    value="New Leaf">New Leaf</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Promethian"){ echo "checked"; }   } ?>    value="Promethian">Promethian</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="HT Grease"){ echo "checked"; }   } ?>    value="HT Grease">HT Grease</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Co-West"){ echo "checked"; }   } ?>    value="Co-West">Co-West</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Industrial Bio"){ echo "checked"; }   } ?>    value="Industrial Bio">Industrial Bio</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="JK Collections"){ echo "checked"; }   } ?>    value="JK Collections">JK Collections</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="AWJ"){ echo "checked"; }   } ?>    value="AWJ">AWJ</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Triple A"){ echo "checked"; }   } ?>    value="Triple A">Triple A</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="So-Cal Pumping"){ echo "checked"; }   } ?>    value="So-Cal Pumping">So-Cal Pumping</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Harbor"){ echo "checked"; }   } ?>    value="Harbor">Harbor</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="GCI"){ echo "checked"; }   } ?>    value="GCI">GCI</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="North County"){ echo "checked"; }   } ?>    value="North County">North County</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="OC Bio"){ echo "checked"; }   } ?>    value="OC Bio">OC Bio</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Eco-Fry"){ echo "checked"; }   } ?>    value="Eco-Fry">Eco-Fry</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Grand Natural"){ echo "checked"; }   } ?>    value="Grand Natural">Grand Natural</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Grease Masters"){ echo "checked"; }   } ?>    value="Grease Masters">Grease Masters	</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="LA Grease Solutions"){ echo "checked"; }   } ?>    value="LA Grease Solutions">LA Grease Solutions</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="CGC"){ echo "checked"; }   } ?>    value="CGC">CGC</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Coastal By-Products"){ echo "checked"; }   } ?>    value="Coastal By-Products">Coastal By-Products</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="SMC"){ echo "checked"; }   } ?>    value="SMC">SMC</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="HP Comm."){ echo "checked"; }   } ?>    value="HP Comm.">HP Comm.</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="All Pro"){ echo "checked"; }   } ?>    value="All Pro">All Pro</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Belcito AJAX Pumping"){ echo "checked"; }   } ?>    value="Belcito AJAX Pumping">Belcito AJAX Pumping</option>
                                <option <?php if(isset($_POST['comp_name'])){ if($_POST['comp_name']=="Green Dining Network"){ echo "checked"; }   } ?>    value="Green Dining Network">Green Dining Network</option>

                            </select></td></tr>
                    <tr><td style="width: 50%;"><table style="float: left;margin-right:10px;width:300px; padding: 0; margin: 0; border-collapse:collapse;">
                                <tr><td>Flag</td><td><select id="flag_id" name="flag_id"><option value="">--</option>
                                            <option <?php if($_POST['flag_id'] == 1) { echo "selected";}  ?> value="1">Needs Contract</option>
                                            <option <?php if($_POST['flag_id'] == 2) { echo "selected";}  ?> value="2">Needs Profile</option>
                                            <option <?php if($_POST['flag_id'] == 3) { echo "selected";}  ?> value="3">Needs Cancellation Letter</option>
                                            <option <?php if($_POST['flag_id'] == 6) { echo "selected";}  ?> value="6">Bad Payment Address</option>
                                            <option <?php if($_POST['flag_id'] == 7) { echo "selected";}  ?> value="7">Bad Main Address</option>
                                            <option <?php if($_POST['flag_id'] == 10) { echo "selected";}  ?> value="10">Re-sale Prospect</option>
                                            <option <?php if($_POST['flag_id'] == 4) { echo "selected";}  ?> value="4">Out Of Business</option>
                                            <option <?php if($_POST['flag_id'] == 8) { echo "selected";}  ?> value="8">Restaurant Canceled</option>
                                            <option <?php if($_POST['flag_id'] == 9) { echo "selected";}  ?> value="9">Lost to General</option>
                                            <option <?php if($_POST['flag_id'] == 11) { echo "selected";}  ?> value="11">Lost to Baker</option>
                                            <option <?php if($_POST['flag_id'] == 12 ) { echo "selected";}  ?> value="12">Lost to Darling</option>
                                        </select></td></tr>
                                <tr><td>Original Sale</td><td><?php if(isset($_POST['orig'])){ echo getOrigRep($_POST['orig']); } else {  echo getOrigRep(); }    ?></td></tr>
                                <tr><td>Account Rep</td><td><?php if(isset($_POST['salesrep'])){ echo getSalesRep($_POST['salesrep']); } else {  echo getSalesRep(); }  ?></td></tr>
                            </table></td><td><table style="float: left;width:280px;border-collapse: collapse;">
                                <tr><td>Friendly</td><td><?php if(isset($_POST['friendly'])){ getFriendLists($_POST['friendly']); } else { getFriendLists(); } ?></td></tr>
                                <tr><td>Previous Provider</td><td><?php if(isset($_POST['prev_compet'])){ previousP($_POST['prev_compet']);  } else { previousP();  }  ?></td></tr>
                                <tr><td>Disposition</td><td><select id="disposition" name="disposition">
                                            <option <?php if($_POST['disposition'] == "all" ) { echo "selected";}  ?>  value="all">All</option>
                                            <option <?php if($_POST['disposition'] == "own" ) { echo "selected";}  ?> value="own">Accounts I Own</option>
                                            <option <?php if($_POST['disposition'] == "orig" ) { echo "selected";}  ?> value="orig">Accounts I Originated</option>
                                            <option <?php if($_POST['disposition'] == "own_not_orig" ) { echo "selected";}  ?> value="own_not_orig">Own but did not Originate</option>
                                        </select></td></tr>
                            </table></td></tr>
                        </table>
                        <table style="width: 1000px;margin:auto;">
                    <tr><td colspan="2" style="text-align: center;vertical-align:top;">Facility</td></tr>
                    <tr><td colspan="2" style="text-align: center;"><input id="all" name="all" <?php if(isset($_POST['all'])){ echo "checked"; } ?> type="checkbox" />&nbsp;All</td></tr>
                    
                    <tr><td style="text-align: center;" colspan="2"><input name="allfac" type="checkbox" id="alluc" <?php if(isset($_POST['allfac'])){ echo "checked"; } ?> />&nbsp;ALL UC</td></tr>
                    <tr>
                      
                        <td><input value="24"  <?php if(isset($_POST['fac3'])){ echo "checked"; } ?> name="fac3" type="checkbox" class="fac uc" />&nbsp;LA Division(UC)</td>
                        <td><input value="32"  <?php if(isset($_POST['fac4'])){ echo "checked"; } ?>  name="fac4" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Chato)</td>
                    </tr>
                    <tr>
                        
                        <td><input value="33"  <?php if(isset($_POST['fac5'])){ echo "checked"; } ?> name="fac5" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Chuck)</td>
                         <td><input value="31"  <?php if(isset($_POST['fac6'])){ echo "checked"; } ?>  name="fac6" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Ramon)</td>
                    </tr> 
                    <tr>
                       <td><input value="23"  <?php if(isset($_POST['fac2'])){ echo "checked"; } ?> name="fac2" type="checkbox" class="fac"/>&nbsp;Imperial Western Products</td>
                        <td><input value="30"  <?php if(isset($_POST['fac7'])){ echo "checked"; } ?> name="fac7" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Tony)</td>
                    </tr>  
                    <tr><td><input value="14"  <?php if(isset($_POST['fac14'])){ echo "checked"; } else {  if($person->facility == 14){ echo "checked"; } }?> name="fac14" type="checkbox" class="fac"/>&nbsp;L Division (Coachella)</td><td><input value="22"  <?php if(isset($_POST['fac8'])){ echo "checked"; } ?>  name="fac8" type="checkbox" class="fac"/>&nbsp;San Diego Division (US)</td></tr>         
                    <tr><td colspan="2" style="text-align: center;"><input <?php if(isset($_POST['allselma'])){ echo "checked"; } ?>       name="allselma"     id="allselma" type="checkbox" class="selma"/>&nbsp;All Selma</td></tr>       
                                
                    <tr><td><input value="10"  <?php if(isset($_POST['fac10'])){ echo "checked"; } else {  if($person->facility == 10){ echo "checked"; } }?> name="fac10" type="checkbox" class="fac selma"/>&nbsp;V-BAK</td><td><input value="11"  <?php if(isset($_POST['fac11'])){ echo "checked"; } else {  if($person->facility == 11){ echo "checked"; } }?> name="fac11" type="checkbox" class="fac selma"  />&nbsp;V-Fresno</td></tr>       
                    <tr><td><input value="15" name="fac15" type="checkbox" class="fac uc"  <?php if(isset($_POST['fac15'])){ echo "checked"; } else {  if($person->facility == 15){ echo "checked"; } }?>/>&nbsp;Co West</td><td><input value="5"   <?php if(isset($_POST['fac9'])){ echo "checked"; } ?>   name="fac9" type="checkbox"  class="fac selma"/>&nbsp;Selma (V)</td></tr>            
                    <tr><td><input value="12"  <?php if(isset($_POST['fac12'])){ echo "checked"; } else {  if($person->facility == 12){ echo "checked"; } }?> name="fac12" type="checkbox" class="fac selma"/>&nbsp;V-North</td><td><input value="13"  <?php if(isset($_POST['fac13'])){ echo "checked"; } else {  if($person->facility == 13){ echo "checked"; } }?> name="fac13" type="checkbox" class="fac selma"/>&nbsp;V-Visalia</td></tr>       
                                
                        
                    <tr><td colspan="2" style="text-align: center;"><input value="8"  <?php if(isset($_POST['fac1'])){ echo "checked"; } ?>  name="fac1" type="checkbox"  id="allariz"/>&nbsp;Arizona Division(4)</td></tr>
                    <tr><td><input value="35"  <?php if(isset($_POST['fac35'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac35" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 1</td><td><input value="36"  <?php if(isset($_POST['fac36'])){ echo "checked"; } else {  if($person->facility == 36){ echo "checked"; } }?> name="fac36" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 2</td></tr>            
                    <tr><td><input value="37"  <?php if(isset($_POST['fac37'])){ echo "checked"; } else {  if($person->facility == 37){ echo "checked"; } }?> name="fac37" type="checkbox" class="fac ariz"/>&nbsp;&nbsp;AZ Zone 3</td><td><input value="38"  <?php if(isset($_POST['fac38'])){ echo "checked"; } else {  if($person->facility == 38){ echo "checked"; } }?> name="fac38" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 4</td></tr>       
                    <tr><td><input value="39"  <?php if(isset($_POST['fac39'])){ echo "checked"; } else {  if($person->facility == 39){ echo "checked"; } }?> name="fac39" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 5</td><td><input value="40"  <?php if(isset($_POST['fac40'])){ echo "checked"; } else {  if($person->facility == 40){ echo "checked"; } }?> name="fac40" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 6</td></tr>            
                    <tr><td><input value="41"  <?php if(isset($_POST['fac4'])){ echo "checked"; } else {  if($person->facility == 41){ echo "checked"; } }?> name="fac41" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 7</td><td><input value="42"  <?php if(isset($_POST['fac42'])){ echo "checked"; } else {  if($person->facility == 42){ echo "checked"; } }?> name="fac42" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 8</td></tr>       
                    <tr><td><input value="43"  <?php if(isset($_POST['fac43'])){ echo "checked"; } else {  if($person->facility == 43){ echo "checked"; } }?> name="fac43" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 9</td><td><input value="4"  <?php if(isset($_POST['fac44'])){ echo "checked"; } else {  if($person->facility == 44){ echo "checked"; } }?> name="fac44" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 10</td></tr>            
                    <tr><td><input value="45"  <?php if(isset($_POST['fac45'])){ echo "checked"; } else {  if($person->facility == 45){ echo "checked"; } }?> name="fac45" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 11</td><td><input value="46"  <?php if(isset($_POST['fac46'])){ echo "checked"; } else {  if($person->facility == 46){ echo "checked"; } }?> name="fac47" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 12</td></tr>           
                     <tr><td><input value="47"  <?php if(isset($_POST['fac47'])){ echo "checked"; } else {  if($person->facility == 47){ echo "checked"; } }?> name="fac47" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 13</td><td><input value="48"  <?php if(isset($_POST['fac48'])){ echo "checked"; } else {  if($person->facility == 48){ echo "checked"; } }?> name="fac48" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 14</td></tr>            
                    <tr><td><input value="49"  <?php if(isset($_POST['fac49'])){ echo "checked"; } else {  if($person->facility == 49){ echo "checked"; } }?> name="fac49" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 15</td><td><input value="50"  <?php if(isset($_POST['fac50'])){ echo "checked"; } else {  if($person->facility == 50){ echo "checked"; } }?> name="fac50" type="checkbox" class="fac ariz"/>&nbsp;AZ TEMP</td></tr>  
                    
                    
                    <tr><td colspan="2" style="vertical-align:top;text-align:center;padding: 0px 0px 0px 0px;">
                    
                   </td></tr>
                </table>
                <div style="width: 1000px;clear:both"></div>
                <table style="width: 1000px;margin:auto;">
                    <tr>
                        <td  style="padding: 0px 0px 0px 0px;width:70px;text-align:center;">Id</td>
                        <td style="padding: 0px 0px 0px 0px;text-align:center;">Name</td>
                        <td  style="padding: 0px 0px 0px 0px;text-align:center;">Address</td>
                        <td  style="padding: 0px 0px 0px 0px;text-align:center;">City</td>
                        <td  style="padding: 0px 0px 0px 0px;text-align:center;">State</td>
                        <td  style="padding: 0px 0px 0px 0px;text-align:center;">Zip</td>
                        <td  style="padding: 0px 0px 0px 0px;text-align:center;">Area</td>
                        <td  style="padding: 0px 0px 0px 0px;text-align:center;">Phone</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="id" placeholder="id" name="id"  value="<?php  if( isset($_POST['id']) ){ echo $_POST['id'];} ?>" type="text"/></td>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="name" placeholder="name" name="name"  value="<?php  if( isset($_POST['name']) ){ echo $_POST['name'];} ?>"  type="text"/></td>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="address" placeholder="address" name="address"  value="<?php  if( isset($_POST['address']) ){ echo $_POST['address'];} ?>" type="text"/></td>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="city" placeholder="city" name="city"  value="<?php  if( isset($_POST['city']) ){ echo $_POST['city'];} ?>" type="text"/></td>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="state" placeholder="state" name="state"  value="<?php  if( isset($_POST['state']) ){ echo $_POST['state'];} ?>" type="text"/></td>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="zip" placeholder="zip" name="zip"  value="<?php  if( isset($_POST['zip']) ){ echo $_POST['zip'];} ?>" type="text"/></td>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="area" placeholder="area" name="area"  value="<?php  if( isset($_POST['area']) ){ echo $_POST['area'];} ?>"  type="text"/></td>
                        <td style="padding: 5px 5px 5px 5px;text-align:center;"><input id="phone" placeholder="phone" name="phone"  value="<?php  if( isset($_POST['phone']) ){ echo $_POST['phone'];} ?>"  type="text"/></td>

                    </tr>
                </table>
                <table style="width: 1000px;border:0px solid #bbb;margin:auto;"><tr><td style="border: 0px solid #bbb;"><span style="float:left;margin-right:5px;"><input type="checkbox" id="full_contact"  <?php  if( isset($_POST['full_contact'] ) ){ echo "checked";} ?> name="full_contact"/>&nbsp;More Contact Info</span></td><td  style="border: 0px solid #bbb;"><span style="float:left;margin-right:5px;"><input type="checkbox"  <?php  if( isset($_POST['get_files']) ){ echo "checked";} ?> title="Display uploaded files" id="get_files" name="get_files"/>&nbsp;Uploaded Files</span></td><td  style="border: 0px solid #bbb;"><span style="float:left;margin-right:5px;"><input type="checkbox"  <?php  if( isset($_POST['oil_stats']) ){ echo "checked";} ?> id="oil_stats" name="oil_stats"/>&nbsp;Pickup Info</span>  </td><td  style="border: 0px solid #bbb;"><span style="float:left;margin-right:5px;"><input type="checkbox"  <?php  if( isset($_POST['get_ppg']) ){ echo "checked";} ?> id="get_ppg" name="get_ppg"/>&nbsp;Payment Info</span></td><td  style="border: 0px solid #bbb;"><span style="float:left;margin-right:5px;"><input type="checkbox"  <?php  if( isset($_POST['get_sales_rep']) ){ echo "checked";} ?> id="get_sales_rep" name="get_sales_rep"/>&nbsp;Sales &amp; Rep</span> </td><td  style="border: 0px solid #bbb;"><span style="float:left;margin-right:5px;"><input type="checkbox"  <?php  if( isset($_POST['get_percentage']) ){ echo "checked";} ?> id="get_percentage" name="get_percentage"/>&nbsp;Show Percentage Full</span></td><td  style="border: 0px solid #bbb;"><span style="float:left;margin-right:5px;"><input type="checkbox" <?php if(isset($_POST['show_friendly'])){echo "checked";}?> id="show_friendly" name="show_friendly"/> Show Friendly</span></td></tr></table>
                <table style="width: 1000px;border-collapse: collapse;">
                    <tr><td colspan="10" style="text-align: right;"><input type="reset"/> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>


                            <input type="submit" style="margin-left: 5px;"  value="Search" name="search_now" id="search_now"/></td></tr>
                </table>
                <!--
                <table style="width: 1000px;margin:auto;margin-bottom:15px;">
                    <tbody><tr><td nowrap="" align="center" class="field_label">Sort By</td>
                        <td><select id="sort_fields_0" name="sort_fields[0]">
                        <option  selected="" value="">None</option>
                        <option value="sb_account_id">ID</option>
                        <option value="account_status_id">Status</option>
                        <option value="account_class_id">Class</option>
                        <option value="company_name">Name</option>
                        <option value="city">City</option>
                        <option value="state">State</option>
                        <option value="date_created">Created</option>
                        <option value="date_contract_<br />expires">Expires</option>
                        <option value="lcount">Locations</option>
                        </select>
                        </td><td width="70"><select id="sort_directions_0" name="sort_directions[0]">
                        <option selected="" value=""> - </option>
                        <option value="asc">^</option>
                        <option value="desc">V</option>
                        </select>
                        </td>
                        <td nowrap="" align="center" class="field_label">Then By</td>
                        <td><select id="sort_fields_1" name="sort_fields[1]">
                        <option selected="" value="">None</option>
                        <option value="sb_account_id">ID</option>
                        <option value="account_status_id">Status</option>
                        <option value="account_class_id">Class</option>
                        <option value="company_name">Name</option>
                        <option value="city">City</option>
                        <option value="state">State</option>
                        <option value="date_created">Created</option>
                        <option value="date_contract_expires">Expires</option>
                        <option value="lcount">Locations</option>
                        </select>
                        </td><td width="70"><select id="sort_directions_1" name="sort_directions[1]">
                        <option selected="" value=""> - </option>
                        <option value="asc">^</option>
                        <option value="desc">V</option>
                        </select>
                        </td>
                        <td nowrap="" align="center" class="field_label">Then By</td>
                        <td><select id="sort_fields_2" name="sort_fields[2]">
                        <option selected="" value="">None</option>
                        <option value="sb_account_id">ID</option>
                        <option value="account_status_id">Status</option>
                        <option value="account_class_id">Class</option>
                        <option value="company_name">Name</option>
                        <option value="city">City</option>
                        <option value="state">State</option>
                        <option value="date_created">Created</option>
                        <option value="date_contract_expires">Expires</option>
                        <option value="lcount">Locations</option>
                        </select>
                        </td><td width="70"><select id="sort_directions_2" name="sort_directions[2]">
                        <option selected="" value=""> - </option>
                        <option value="asc">^</option>
                        <option value="desc">V</option>
                        </select>
                        </td>
                        </tr> ---!>



            </form>
        </div>
        <?php
        break;
    case "cop":
                    ?>
                    <form action="scheduling.php?task=cop" method="post">
                    <input type="hidden" value="report_collected_fires" name="task" value="<?php if(isset($_POST['get_stats'])){ echo $_POST['get_stats'];} ?>" />
                    
                    <table style="margin:auto;font-size:smaller;margin-top:20px;margin-bottom:20px;width:50%;"><tbody>
                    <tr><td>Facility</td><td> <?php
                            
                             if(isset($_POST['facility'])){
                                getFacilityList("facility",$_POST['facility']);
                             }else{
                                getFacilityList("facility","");   
                             }
                             ?></td></tr>
                    <tr><td>Include All Arizona Zones?</td><td><input type="checkbox" value="1" id="all_arizona_zones" name="all_arizona_zones" <?php if(isset($_POST['all_arizona_zones'])) echo "checked";?> </td></tr>

             <tr><td>Route title</td><td><input type="text" value="<?php if(isset($_POST['rtitle'])){ echo $_POST['rtitle']; } else {echo "";} ?>" placeholder="route title" id="rtitle" name="rtitle"/></td></tr>
                    <tr>
                     
                   <td>Route id</td>   <td><input type="text" name="rid" placeholder="Route Id" value="<?php if(isset($_POST['rid'])){ echo $_POST['rid']; } else {echo "";} ?>"/></td>
                   </tr>
                   
                   <tr><td class="field_label" style="vertical-align:top;">

Wait Days Range </td><td> <input type="text" id="min" name="min" placeholder="min days" style="width: 90px;"  value="<?php if(isset($_POST['search_now'])){ echo $_POST['min'];  } ?>"/><br /><input type="text" id="max" name="max" placeholder="max days"  style="width: 90px;"   value="<?php if(isset($_POST['search_now'])){ echo $_POST['max'];  } ?>"/>

</td></tr>
                   
             


<tr>
<td class="field_label"  style="vertical-align: top;">
<input type="radio" name="report_type"  <?php 
        if(isset($_POST['search_now'])){  
            if($_POST['report_type'] == 1) { 
                    echo "checked='checked'";
            } 
        } ?>  value="1"/> Date Reported&nbsp;
            
            
            <input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  
                if($_POST['report_type'] == 2) { 
                    echo "checked='checked'";
                    }   
                } ?>  value="2"/> Date Collected</td><td>

            
            
            <input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" id="from" name="from" placeholder="From: "/>
            <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" id="to" name="to" placeholder="To: "/></td></tr>
                   
                   <tr>
                
                    <td nowrap="" align="right" style="padding-right:50px;" class="field_label">Group By</td><td><select id="my_group" name="my_group">
                    <option value="-">--</option>
                    <option value="created_by">Created By</option>
                    <?php if(!$person->isFriendly() && !$person->isCoWest()){ ?>
                    <option value="recieving_facility">Facility</option>
                    <?php } ?>
                    <option value="driver">Driver</option>
                    <option value="created_by">Created By</option>


</select></td>
              </tr>
                <tr>
           
            <td style="text-align: right;" colspan="4"><input type="checkbox" <?php if(isset($_POST['year'])){ echo " checked ";  } ?>   name="year" id="year"/>&nbsp;Include Results Older than 1 year<br /><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/>
</td></tr></tbody></table></form>
<script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>
                    <?php
                    break;  
               
                case "containers":
                ?>
                <table  style="margin:auto;font-size:smaller;width:80%;margin-top:20px;margin-botom:20px;table-layout:fixed;"><tbody><tr>                      <td style="text-align:left;vertical-align:top;width:50%;">Container Class</td>
                    <td style="width: 50%;">
                    
                                   <?php 
                                   
                                   if(isset($_POST['container_size'])){
                                        containerList($_POST['container_size'],""); 
                                   } else {
                                        containerList("","");
                                   }
                                   ?>
                    
                    </td>
                </tr><tr>

                        <tr><td style="text-align:left;vertical-align:top;">Delivered Date</td><td>
                        
                                    <input type="text" value="<?php if(isset($_POST['from'])){ echo $_POST['from'];  } ?>" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" />&nbsp;<input value="<?php if(isset($_POST['to'])){ echo $_POST['from'];  } ?>" type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to" />
                                    
                                    
                        <script>
                        $("input#from").datepicker({dateFormat: "yy-mm-dd"});
                        $("input#to").datepicker({dateFormat: "yy-mm-dd"});
                        </script></td></tr>

                        <tr><td ><button>Export XLS</button></td>
                        <td  style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /> </td></tr>
</table>

             
                    <script>
                        $("input#start").datepicker();
                        $("input#end").datepicker();
                    </script>
                    

                <?php
                    break;     
                case "newloc":
                    ?>
                    <form action="management.php?task=newloc" method="post">
                    <table  style="margin:auto;width:50%;font-size:smaller;margin-top:20px;margin-bottom:20px;"><tbody><tr><td class="field_label">
                    <br/>Sales Rep</td><td>
                    
                    <?php
                        if(isset($_POST['salesrep'])){
                            getSalesRep($_POST['salesrep']);
                        } else {
                            getSalesRep();
                        }
                        
                    ?>
                    </td>
                    </tr><tr>
                    <td>Facility</td><td> <?php if(isset($_POST['facility'])){  getFacilityList("",$_POST['facility']);} else { getFacilityList("",""); }; ?></td>
                    
                    </tr><tr>
                    <td nowrap="" align="right" class="field_label"><div>Start Date</td><td><input type="text" id="from" name="from" value="<?php echo $_POST['from']; ?>"  placeholder="click here to select date" /></div></td>
                    </tr>
                    <tr>
                    <td><div>End Date</td><td><input type="text"  value="<?php echo $_POST['to']; ?>" id="to" name="to"  placeholder="click here to select date" /></div></td>
                    </tr>
                    
                    <tr>
                    <td  colspan="2" style="text-align: right;"><input type="checkbox"  <?php  if( isset($_POST['get_reps']) ){ echo "checked";} ?> name="get_reps" />&nbsp;Show Sales Reps<br /><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /> </td></tr></tbody></table>
                    </form>
 <script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>
                               
                    <?php
                    break; 
                case "gpexp":
                    ?>
                    <form method="post" action="management.php?task=gpexp">
                    <table style="font-size:smaller;margin:auto;margin-bottom:20px;margin-top:20px;width:50%;"><tbody><tr><td style="text-align:left;vertical-align: top;" class="field_label">
                    <table style="width: 100%;height:100%;border:0px solid #bbb;">
                        <tr><td  style="border: 0px solid #bbb;">Account Rep</td><td  style="border: 0px solid #bbb;"><select id="account_rep" name="account_rep">
                        <option value="">--</option>
                    <?php 
                        $table = $dbprefix."_users";
                        $request_rep = $db->query("SELECT * FROM $table WHERE roles like '%Sales%Representative%'");
                        if(count($request_rep)>0){
                            foreach($request_rep as $v){
                                echo "<option "; if($_POST['account_rep'] == $v['user_id']){  echo "selected"; }  echo " value='$v[user_id]'>$v[first] $v[last]</option>";
                            }
                        }
                        else{                            
                            echo "<option>No Representaties created</option>";
                        }
                    
                    ?>
                    </select></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Original Sale By</td><td  style="border: 0px solid #bbb;"> <select id="salesrep" name="salesrep"> <option value="">--</option> 
                    <?php 
                        $table = $dbprefix."_users";
                        $request_rep = $db->query("SELECT * FROM $table WHERE roles like '%Sales%Representative%'");
                        if(count($request_rep)>0){
                            foreach($request_rep as $v){
                                echo "<option "; if($_POST['salesrep'] == $v['user_id']){  echo "selected"; }  echo " value='$v[user_id]'>$v[first] $v[last]</option>";
                            }
                        }
                        else{                            
                            echo "<option>No Representaties created</option>";
                        }
                    
                    ?> </select></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Friendly</td><td  style="border: 0px solid #bbb;"> <?php echo getFriendLists(); ?></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Facility</td><td  style="border: 0px solid #bbb;">
                            <?php 
                            if(isset($_POST['search_now'])){
                                getFacilityList("",$_POST['facility']);
                            } else {
                                getFacilityList("","");
                            }
                                
                            ?>
                        </td></tr>
                        <tr><td style="border: 0px solid #bbb;">Group By</td><td  style="border: 0px solid #bbb;">
                        <select id="my_group" name="my_group">
                        <option value="-">--</option>
                            <option   <?php if($_POST['my_group'] == "original_sales_person"){ echo "selected"; } ?>   value="original_sales_person">Original Sale By</option>

                            <option <?php if($_POST['my_group'] == "account_rep"){ echo "selected"; } ?> value="account_rep">Account Rep</option>
                            
                            <option <?php if($_POST['my_group'] == "account_ID"){ echo "selected"; } ?>  value="account_ID">Account</option>
                            
                            <option <?php if($_POST['my_group'] == "division"){ echo "selected"; } ?> value="division">Facility</option>
                            
                            
</select></td></tr>
<tr><td style="vertical-align: top;border: 0px solid #bbb;">Service Date</td><td style="border: 0px solid #bbb;"><div><input type="text" placeholder="start date"  style="border-radius: 0px 0px 0px 0px;" id="from" name="from"  value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" /></div>


<div><input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to"  value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" /></td></tr>
                    </table>
                    </td></tr>
                    <tr><td colspan="5" style="text-align: right;"> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></td></tr>
                    </tbody></table></form>
                    <?php
                    break;
                case "gps":
                ?>
                    <form method="post" action="management.php?task=gps">
                    <table width="80%" border="0" align="center" cellpadding="1" style="font-size:smaller"><tbody><tr><td style="text-align:left;vertical-align: top;" class="field_label">
                    <table style="width: 100%;height:100%;border:0px solid #bbb;">
                        <tr><td  style="border: 0px solid #bbb;">Account Rep</td><td  style="border: 0px solid #bbb;"><select id="account_rep" name="account_rep">
                        <option value="">--</option>
                    <?php 
                        $table = $dbprefix."_users";
                        $request_rep = $db->query("SELECT * FROM $table WHERE roles like '%Sales%Representative%'");
                        if(count($request_rep)>0){
                            foreach($request_rep as $v){
                                echo "<option "; if($_POST['account_rep'] == $v['user_id']){  echo "selected"; }  echo " value='$v[user_id]'>$v[first] $v[last]</option>";
                            }
                        }
                        else{                            
                            echo "<option>No Representaties created</option>";
                        }
                    
                    ?>
                    </select></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Original Sale By</td><td  style="border: 0px solid #bbb;"> <select id="salesrep" name="salesrep"> <option value="">--</option> 
                    <?php 
                        $table = $dbprefix."_users";
                        $request_rep = $db->query("SELECT * FROM $table WHERE roles like '%Sales%Representative%'");
                        if(count($request_rep)>0){
                            foreach($request_rep as $v){
                                echo "<option "; if($_POST['salesrep'] == $v['user_id']){  echo "selected"; }  echo " value='$v[user_id]'>$v[first] $v[last]</option>";
                            }
                        }
                        else{                            
                            echo "<option>No Representaties created</option>";
                        }
                    
                    ?> </select></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Friendly</td><td  style="border: 0px solid #bbb;"> <?php echo getFriendLists(); ?></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Facility</td><td  style="border: 0px solid #bbb;">
                            <?php 
                            if(isset($_POST['search_now'])){
                                getFacilityList("",$_POST['facility']);
                            } else {
                                getFacilityList("","");
                            }
                                
                            ?>
                        </td></tr>
                        <tr><td style="border: 0px solid #bbb;">Group By</td><td  style="border: 0px solid #bbb;">
                        <select id="my_group" name="my_group">
                        <option value="-">--</option>
                            <option   <?php if($_POST['my_group'] == "original_sales_person"){ echo "selected"; } ?>   value="original_sales_person">Original Sale By</option>

                            <option <?php if($_POST['my_group'] == "account_rep"){ echo "selected"; } ?> value="account_rep">Account Rep</option>
                            
                            <option <?php if($_POST['my_group'] == "account_ID"){ echo "selected"; } ?>  value="account_ID">Account</option>
                            
                            <option <?php if($_POST['my_group'] == "division"){ echo "selected"; } ?> value="division">Facility</option>
                            
                            
</select></td></tr>
                    </table>
                    </td><td nowrap="" align="right" style="padding-left:30px; padding-right:30px;" class="field_label"><div><br /><br /><input type="text" placeholder="start date"  style="border-radius: 0px 0px 0px 0px;" id="from" name="from"  value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" /></div><div><input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to"  value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" /></div><div style="text-align:center;margin-top:30px;"></div></td></tr>
                    <tr><td colspan="5"><input type="submit" style="float: right;" value="Search" name="search_now"/><input type="reset"/> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a></td></tr>
                    </tbody></table></form>
                <?php
                break;   
                case "ops":
                    ?>
                    <form method="post" action="management.php?task=ops">
                    <table width="80%" border="0" align="center" cellpadding="1" style="font-size:smaller"><tbody><tr><td style="text-align:left;vertical-align: top;" class="field_label">
                    <table style="width: 100%;height:100%;border:0px solid #bbb;">
                        <tr><td  style="border: 0px solid #bbb;">Account Rep</td><td  style="border: 0px solid #bbb;"><select id="account_rep" name="account_rep">
                        <option value="">--</option>
                    <?php 
                        $table = $dbprefix."_users";
                        $request_rep = $db->query("SELECT * FROM $table WHERE roles like '%Sales%Representative%'");
                        if(count($request_rep)>0){
                            foreach($request_rep as $v){
                                echo "<option "; if($_POST['account_rep'] == $v['user_id']){  echo "selected"; }  echo " value='$v[user_id]'>$v[first] $v[last]</option>";
                            }
                        }
                        else{                            
                            echo "<option>No Representaties created</option>";
                        }
                    
                    ?>
                    </select></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Original Sale By</td><td  style="border: 0px solid #bbb;"> <select id="salesrep" name="salesrep"> <option value="">--</option> 
                    <?php 
                        $table = $dbprefix."_users";
                        $request_rep = $db->query("SELECT * FROM $table WHERE roles like '%Sales%Representative%'");
                        if(count($request_rep)>0){
                            foreach($request_rep as $v){
                                echo "<option "; if($_POST['salesrep'] == $v['user_id']){  echo "selected"; }  echo " value='$v[user_id]'>$v[first] $v[last]</option>";
                            }
                        }
                        else{                            
                            echo "<option>No Representaties created</option>";
                        }
                    
                    ?> </select></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Friendly</td><td  style="border: 0px solid #bbb;"> <?php if(isset($_POST['search_now'])){ echo getFriendLists($_POST['friendly']);   } else { echo getFriendLists(); } ?></td></tr>
                        <tr><td style="border: 0px solid #bbb;">Group By</td><td  style="border: 0px solid #bbb;">
                        <select id="my_group" name="my_group">
                        <option value="-">--</option>
                            <option   <?php if($_POST['my_group'] == "original_sales_person"){ echo "selected"; } ?>   value="original_sales_person">Original Sale By</option>

                            <option <?php if($_POST['my_group'] == "account_rep"){ echo "selected"; } ?> value="account_rep">Account Rep</option>
                            
                            <option <?php if($_POST['my_group'] == "previous_provider"){ echo "selected"; } ?>  value="previous_provider">Previous Provider</option>
                            
                            <option <?php if($_POST['my_group'] == "division"){ echo "selected"; } ?> value="division">Facility</option>
                            
                            
</select></td></tr>
                    </table>
                    </td><td nowrap="" align="right" style="padding-left:30px; padding-right:30px;" class="field_label"><div><br /><br /><input type="text" placeholder="start date"  style="border-radius: 0px 0px 0px 0px;" id="from" name="from"  value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" /></div><div><input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to"  value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" /></div><div style="text-align:center;margin-top:30px;"></div></td></tr>
                    
                    <tr><td colspan="5" style="text-align: right;">
                        <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;
                        <input type="reset"/>&nbsp;
                        <input type="submit" value="Search" name="search_now"/>
                    </td></tr>
                    </tbody></table></form>
                    <script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>
                <?php
                    break;    
                case "ocd":
                ?>
                    <form action="management.php?task=ocd" method="post">
                    <table border="0" align="center" cellpadding="1" style="font-size:smaller; border:1px grey solid; margin:auto;width:40%;margin-top:20px;margin-bottom:20px;">
                        <tbody>
                            <tr>
                            <td style="padding-left:10px;width:30%;" class="field_label">
                                Driver's Home Facility&nbsp;<?php if(isset($_POST['facility'])){ getFacilityList("",$_POST['facility']);} else { getFacilityList(); } ?>
                            </td>
                            </tr><tr>
                            
                            <td  style="text-align: right;"><input type="checkbox" <?php if(isset($_POST['include_inactive'])){ echo "checked"; } ?>  name="include_inactive" />&nbsp;&nbsp;Show Inactive<br /><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /> </td></tr></tbody></table>
                            </form>
                <?php
                    break;
                case "xlog":
                    ?>
                        <form action="management.php?task=xlog" method="post">
                    <table  style="font-size:smaller;margin:auto;margin-top:20px;margin-bottom:20px;width:50%;"><tbody>
                    
                    <tr><td>Transaction Type<br />Pertaining To<br />User </td><td>
                    
                    <select name="ttype"><option value="">All</option>
                        <option <?php if($_POST['ttype'] == 5){ echo "selected";} ?>  value="5">Update User</option>
                        
                        <option <?php if($_POST['ttype'] == 7){ echo "selected";} ?> value="7">Update Account</option>
                        <option <?php if($_POST['ttype'] == 9){ echo "selected";} ?> value="9">Container Deletion</option>
                        
                        <option <?php if($_POST['ttype'] == 10){ echo "selected";} ?> value="10">User Log In</option>
                        
                        <option <?php if($_POST['ttype'] == 11){ echo "selected";} ?> value="11">Update Person</option>
                        
                        <option <?php if($_POST['ttype'] == 12){ echo "selected";} ?> value="12">Service Center Call</option>
                        
                        <option <?php if($_POST['ttype'] == 13){ echo "selected";} ?> value="13">Assign User to Issue</option>
                        
                        <option <?php if($_POST['ttype'] == 14){ echo "selected";} ?> value="14">Update Oil Pickup</option>
                        
                        <option  <?php if($_POST['ttype'] == 15){ echo "selected";} ?> value="15">Update Index Price</option>
                        
                        <option  <?php if($_POST['ttype'] == 16){ echo "selected";} ?> value="16">Check Zone Status</option>
                        </select>
                        <br />
                        <select id="related_table" name="related_table"><option value="">All</option>
                            
                            <option <?php if($_POST['related_table'] == 2){ echo "selected"; } ?>  value="2">Account</option>
                            <option <?php if($_POST['related_table'] == 9){ echo "selected"; } ?>  value="9">Container Deletion</option>
                            <option <?php if($_POST['related_table'] == 3){ echo "selected"; } ?>  value="3">Issue</option>
                            
                            <option <?php if($_POST['related_table'] == 4){ echo "selected"; } ?>  value="4">User</option>
                            
                            <option  <?php if($_POST['related_table'] == 5){ echo "selected"; } ?>  value="5">Person</option>
                            
                            <option <?php if($_POST['related_table'] == 6){ echo "selected"; } ?>  value="6">Oil Pickup</option>
                            
                            <option <?php if($_POST['related_table'] == 7){ echo "selected"; } ?>  value="7">payment_index</option>
                        </select>

<br />
                        <select name="users" id="users">
                        <?php 
                        echo "<option value=''>All</option>";
                        $all = $db->orderby("last","ASC")->get($dbprefix."_users","first,last,user_id");
                        if(count($all)>0){
                            foreach($all as $ll){
                                echo "<option "; 
                                    if($_POST['users'] == $ll['user_id']){
                                        echo " selected ";
                                    }
                                echo " value='$ll[user_id]'>$ll[last], $ll[first]</option>";
                            }
                        }
                        
                        ?>
                        </select>

                        </td>
                        
                        
                        </tr>
                        
                        <tr><td class="field_label"><div>Start Date&nbsp;</div><div>End Date&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                        <td style="text-align: left;"><input  value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" type="text" id="from" name="from" placeholder="From:"/><br /><input  value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" type="text" id="to" name="to" placeholder="To:"/></td></tr>
                        
                        <tr><td>Account</td><td><input type="text" id="account_no" name="account_no"/></td></tr>
                        <tr>
                        <td colspan="2" style="text-align:right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></td></tr></tbody></table></form>
                    <script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>
                    <?php
                    break;
                case "expire":
                    ?>
                    <form action="management.php?task=expire" method="post">
                        <table  style="font-size:smaller;margin:auto;margin-top:20px;margin-bottom:20px;width:50%"><tbody><tr><td  style="padding-right:5px;" class="field_label">Status</td><td><select id="account_status" name="account_status">
                        
                        <option value="">All</option>

                        <option value="New">New</option>
                        
                        <option value="Active">Active Only</option>
                        
                        
                        <option value="Archive">Archived</option>
                        </select><br /></td>
                        </tr><tr>
                        <td  class="field_label">Account Rep</td><td> <?php getSalesRep("");  ?> <br/>
                            </td>
                        </tr>
                        <tr><td>Friendly&nbsp;
                           </td><td> <?php
                            
                            echo getFriendLists();
                            ?></td></tr>
                        
                        <tr>
                        <tr><td>Expires</td><td><input type="text" placeholder="start date" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" />&nbsp;</div><div><input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to"  value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>"/></div></td></tr>

                        <td style="text-align:center;" class="field_label" colspan="2">
                <input type="checkbox" name="get_acct_reps" <?php  
                    if( isset($_POST['get_acct_reps']) ){ 
                        echo "checked";} 
                    ?> />&nbsp;Show Account Reps&nbsp;&nbsp;
               <input type="checkbox" name="get_sales_reps" <?php  if( isset($_POST['get_sales_reps']) ){ echo "checked";} ?> />&nbsp;Show Sales Reps&nbsp;&nbsp;
                <input type="checkbox" name="get_affs" <?php  if( isset($_POST['get_affs']) ){ echo "checked";} ?> />&nbsp;Show Friendly&nbsp;&nbsp;<span style="margin-right:20px;">
                        <input type="checkbox" id="get_no_exp" name="get_no_exp" <?php  if( isset($_POST['get_no_exp']) ){ echo "checked";} ?> />&nbsp;No Expiration Date</span>
                        
                        </td>
                </tr>
                <tr>
                <td style="text-align:right;" colspan="2"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></td></tr></tbody></table>
</form>
                    <script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>
                    <?php                
                    break;
                case "zero":
                    ?>
                    <form action="management.php?task=zero" method="post">
                    <table border="0" align="center" cellpadding="1" style="width: 50%;">

                        <tbody><tr>
                        <td valign="top">Reason For Zero</td><td nowrap="" align="left" class="field_label"><select id="reason_for_skip_id" name="reason_for_skip_id"><option value="">Any</option>
                        <option <?php if($_POST['reason_for_skip_id'] == 10){ echo "selected"; } ?>  value="10">No oil</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 12){ echo "selected"; } ?> value="12">Skipped: Driver Choice</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 14){ echo "selected"; } ?> value="14">Skipped: Truck Full</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 16){ echo "selected"; } ?> value="16">Skipped: Other</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 22){ echo "selected"; } ?> value="22">Locked: No Key</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 24){ echo "selected"; } ?> value="24">Locked: Our key did not work</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 26){ echo "selected"; } ?> value="26">Blocked</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 32){ echo "selected"; } ?> value="32">Missed time window</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 40){ echo "selected"; } ?> value="40">Oil Frozen</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 42){ echo "selected"; } ?> value="42">Garbage in container</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 44){ echo "selected"; } ?> value="44">Container damaged</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 52){ echo "selected"; } ?> value="52">Oil Theft: Suspected</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 54){ echo "selected"; } ?> value="54">Oil Theft: Confirmed</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 62){ echo "selected"; } ?> value="62">Location Closed: Temporary</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 64){ echo "selected"; } ?> value="64">Location Closed: Out of business</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 66){ echo "selected"; } ?> value="66">Lost Account - Confirmed</option>
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 68){ echo "selected"; } ?> value="68">Manager refused pickup</option><br />
                        
                        <option  <?php if($_POST['reason_for_skip_id'] == 72){ echo "selected"; } ?> value="72">Unneeeded: Added in Error</option>
                        </select></td></tr><tr><td nowrap="" align="right" class="field_label">Other Zeroes Interval</td><td nowrap="" align="left" class="field_label">
                        
                        <select id="my_interval" name="my_interval">
                            <option  <?php if($_POST['my_interval'] == 30){ echo "selected"; } ?> value="30">30 Days</option>
                            
                            <option  <?php if($_POST['my_interval'] == 93){ echo "selected"; } ?>  value="93">3 Months</option>
                            
                            <option   <?php if($_POST['my_interval'] == 185){ echo "selected"; } ?>  value="185">6 Months</option>
                            
                            <option   <?php if($_POST['my_interval'] == 365){ echo "selected"; } ?>  value="365">1 Year</option>
                            
                            <option   <?php if($_POST['my_interval'] == 730){ echo "selected"; } ?>  value="730">2 Years</option>
                        </select> </td></tr>
                        <tr><td colspan="3" style="text-align: center;"><input type="text" value="<?php if(isset($_POST['from'])){ echo "$_POST[from]"; } ?>" id="from" name="from" placeholder="Beginning Date" style="border-radius: 0px 0px 0px 0px;"/>&nbsp;&nbsp;<input type="text" id="to"  value="<?php if(isset($_POST['to'])){ echo "$_POST[to]"; } ?>" name="to" style="border-radius: 0px 0px 0px 0px;" placeholder="End Date"/></td></tr>
                        </tbody>
                        <tr><td style="text-align:right;" class="field_label" colspan="2"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" />
                        </td></tr>
                        </table>
                        </form>
                        <script>
                        $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        </script>
                    <?php
                    break;
                case "theft":
                    ?>
                    <form method="post" action="management.php?task=theft">
                    <table style="font-size:smaller; border:1px grey solid; margin:auto;margin-top:20px;width:50%;margin-bottom:20px;">
                    
                        <tbody>
                        <tr>
                            <td style="padding-left:10px;width:20%;" class="field_label">Friendly</td>
                        <td align="left" style="width: 16%;"><?php getFriendLists(); ?></td>
                        </tr>
                        
                        <tr>                        
                        <td nowrap="" align="right" class="field_label" style="width: 23%;">Zone</td><td><select id="zone_id" name="zone_id"><option value="">All</option>
                        <option value="5010">5010 - Region 5 of UC</option>
                        
                        <option value="5030">5030 - Region 1 of UC NORM</option>
                        
                        <option value="5050">5050 - Region 2 of UC RAMON</option>
                        
                        <option value="5070">5070 - Region 3 of UC CHATO</option>
                        
                        <option value="5090">5090 - Region 4 of UC CHUCK</option>
                        
                        <option value="5105">5105 - CA San Diego Co. - Oceanside</option>
                        
                        <option value="5110">5110 - CA San Diego Central</option>
                        
                        <option value="5115">5115 - CA - San Diego Co. - Escondido</option>
                        
                        <option value="5117">5117 - CA San Diego Co. - Borrego</option>
                        
                        <option value="5120">5120 - CA San Diego Co. - Miramar</option>
                        
                        <option value="5125">5125 - CA San Diego Co. - El Cajon</option>
                        
                        <option value="5130">5130 - CA San Diego Co. -  Border East</option>
                        
                        <option value="5135">5135 - CA San Diego Co. -  Border West</option>
                        
                        <option value="5140">5140 - CA San Diego Co. - Interstate 8 East</option>
                        
                        <option value="5150">5150 - CA - National City - Chula Vista</option>
                        
                        <option value="5160">5160 - CA San Diego East</option>
                        
                        <option value="5165">5165 - CA - San Diego Co. La Mesa</option>
                        
                        <option value="5175">5175 - CA Point Loma</option>
                        
                        <option value="5180">5180 - CA San Diego Co. - Mission Valley</option>
                        
                        <option value="5190">5190 - CA Salton-Brawley</option>
                        
                        <option value="5195">5195 - CA Calexico-El Centro</option>
                        
                        <option value="5210">5210 - CA Orange County - South</option>
                        
                        <option value="5250">5250 - CA Orange County - North</option>
                        
                        <option value="5303">5303 - CA Riverside Co. Blythe</option>
                        
                        <option value="5310">5310 - CA Riverside Co. - Palm Springs</option>
                        
                        <option value="5320">5320 - CA Riverside Co,  Moreno Valley</option>
                        
                        <option value="5330">5330 - CA - Riverside Co. - Paris, Sun City</option>
                        
                        <option value="5340">5340 - CA - Riverside Co. - Temecula</option>
                        
                        <option value="5350">5350 - CA Riverside Central</option>
                        
                        <option value="5380">5380 - CA Riverside - West -Corona</option>
                        
                        <option value="5410">5410 - CA San Bernardino East</option>
                        
                        <option value="5420">5420 - CA San Bernardino West</option>
                        
                        <option value="5440">5440 - CA San Bernardino Mtns</option>
                        
                        <option value="5450">5450 - CA Mojave</option>
                        
                        <option value="5530">5530 - CA - LA Co. - San Gabriel Valley West</option>
                        
                        <option value="5610">5610 - CA - LA Co. - Long Beach</option>
                        
                        <option value="5620">5620 - CA Long Beach North</option>
                        
                        <option value="5660">5660 - CA Los Angeles - Harbor</option>
                        
                        <option value="5680">5680 - CA Los Angeles - South Bay</option>
                        
                        <option value="5685">5685 - CA Los Angeles - Palos Verdes</option>
                        
                        <option value="5740">5740 - CA Los Angeles - Downtown</option>
                        
                        <option value="5750">5750 - CA Los Angeles - West Central</option>
                        
                        <option value="5780">5780 - CA Los Angeles - Beaches</option>
                        
                        <option value="5820">5820 - CA - LA Co. - San Fernando Valley East</option>
                        
                        <option value="5840">5840 - CA - LA Co. - San Fernando Valley West</option>
                        
                        <option value="5870">5870 - CA - LA Co. - Tujunga, La Canada</option>
                        
                        <option value="5880">5880 - CA Victorville Barstow</option>
                        
                        <option value="5890">5890 - CA - LA Co. - Antelope Valley</option>
                        
                        <option value="5910">5910 - CA Ventura County</option>
                        
                        <option value="5950">5950 - CA Santa Barbara County</option>
                        
                        <option value="6401">6401 - AZ Unassigned</option>
                        
                        <option value="38010">38010 - CA North Coast</option>
                        
                        <option value="38015">38015 - CA Biotane-Encore Overlap</option>
                        
                        <option value="38050">38050 - CA North Central Siskiyou</option>
                        
                        <option value="38110">38110 - CA Sonoma</option>
                        
                        <option value="38150">38150 - CA Napa</option>
                        
                        <option value="38210">38210 - CA Marin</option>
                        
                        <option value="38250">38250 - CA - Solano</option>
                        
                        <option value="38310">38310 - CA - Contra Costa and Alameda</option>
                        
                        <option value="38410">38410 - CA San Francisco</option>
                        
                        <option value="38510">38510 - CA San Mateo</option>
                        
                        <option value="38550">38550 - CA San Jose</option>
                        
                        <option value="38610">38610 - CA Sacramento</option>
                        
                        <option value="38630">38630 - CA Sacramento Valley</option>
                        
                        <option value="38710">38710 - CA Stockton - Madera</option>
                        
                        <option value="38810">38810 - CA Santa Cruz</option>
                        
                        <option value="38850">38850 - CA Central Coast</option>
                        
                        <option value="38950">38950 - CA Fresno - Visalia</option>
                        
                        <option value="38970">38970 - CA Inyo Face</option>
                        
                        <option value="38990">38990 - CA Bakersfield - Kern Co.</option>
                        </select></td>
                        </tr>
                        <tr>
                        <td style="text-align: center;" colspan="2">
                        <input type="text" id="from" name="from"  value="<?php if(isset($_POST['from'])){ echo "$_POST[from]"; } ?>" placeholder="Beginning Date" style="border-radius:0px 0px 0px 0px;" />
                        
                        <input type="text" id="to"  value="<?php if(isset($_POST['to'])){ echo "$_POST[to]"; } ?>" name="to" placeholder="End Date" style="border-radius:0px 0px 0px 0px;" />
                        </td>
                        </tr><tr>
                        <td  colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /></td>
                        </tr></tbody>
                        </table>
                        </form>
                    <?php
                    break;
                case "delivery":
                    ?>
                    <form action="management.php?task=delivery" method="post">
                    <table border="0" align="center" cellpadding="1" style="font-size:smaller; border:1px grey solid; margin-top:20px;width:50%">
                    <tbody>
                        <tr>
                            <td>Facility</td>
                            <td><?php 
                                if (isset($_POST['search_now'])   )  { 
                                    getFacilityList("facility",$_POST['facility']);    
                                } else{ 
                                    getFacilityList();
                                } ; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;" class="field_label" colspan="2">
                            <input type="text" placeholder="start date"  value="<?php if(isset($_POST['from'])){ echo "$_POST[from]"; } ?>" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" />&nbsp;
                            <input type="text" placeholder="end date"  value="<?php if(isset($_POST['to'])){ echo "$_POST[to]"; } ?>"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to" />
                        </td>
                        <tr>
                            <td  colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></td>
                        </tr>

</tbody></table></form>
<script>
$("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
$("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
</script>

                    <?php
                    break;
                    case "collected":
                    ?>
                    <form action="management.php?task=collected" method="post">
                    <table  style="font-size:smaller;margin:auto;margin-top:20px;margin-bottom:20px;width:50%;">
                        <tbody><tr>
                        <td style="text-align:left;">Facility </td><td><?php 
    if(isset($_POST['facility'])){ 
        getFacilityList("",$_POST['facility']);
    } else { 
        getFacilityList(); 
    }   ?></td></tr>
                            <tr>
                        <td style="padding: 5px 5px 5px 5px;text-align:left;width:25%;" class="field_label">Group By</td><td>                              <select id="my_group" name="my_group">
                                <option value="-">--</option>
                                <option <?php if( $_POST['my_group'] == "account_rep"){ echo "selected"; } ?>   value="account_rep">Sales Rep</option>
                                
                                <option <?php if( $_POST['my_group'] == "friendly"){ echo "selected"; } ?>   value="friendly">Friendly</option>
                                
                                <option <?php if( $_POST['my_group'] == "previous_provider"){ echo "selected"; } ?>   value="previous_provider">Previous Provider</option>
                                
                                <option <?php if( $_POST['my_group'] == "division"){ echo "selected"; } ?>   value="division">Facility</option>
                            </select></td>
                            </tr>
                            <tr>
                            <td>Sales Rep</td>
                            <td><?php  if(isset($_POST['salesrep'])){ getSalesRep($_POST['salesrep']); } else {getSalesRep();}  ?></td>
                            </tr>
                            <tr>
                            
                            
                            <td style="padding-right:50px;text-align:center;" class="field_label" colspan="2">
                            
                            <input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" />&nbsp;TO&nbsp;
                            <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to" />
                           </td>


                            
                            </tr><tr>
                            <td colspan="2"  style="text-align: right;">
                             <input type="checkbox" name="get_reps" <?php if(isset($_POST['get_reps'])){ echo "checked";  } ?>  /> &nbsp;Show Reps&nbsp;
                           <br />
                            <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /> </td></tr></tbody></table>
</form>
<br />
                            <script>
                            $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                            $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                            </script>
                    <?php
                    break;
                    case "picknpay":
                        ?>
                        <form action="management.php?task=picknpay" method="post">
                        <table style="font-size:smaller;margin:auto;margin-bottom:20px;margin-top:20px;width:50%;">
                            <tbody>
                                <tr><td>Facility</td><td><?php if(isset($_POST['facility'])){ echo getFacilityList("",$_POST['facility']);  } else {echo getFacilityList();} ?></td></tr>
                                <tr><td>Group By</td><td><select name="my_group" id="my_group">
                                                        <option value="-">--</option>
                                                           
                                                            
                                                            <option <?php if(isset($_POST['search_now'])){  if($_POST['my_group'] == "account"){ echo "selected='selected' "; } } ?>  value="account">Account</option>
                                                            
                                                            
                                </select></td></tr>
                                <tr><td style="vertical-align: top;">Pickup Date</td><td style="vertical-align: top;"><div>
                                    <input value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" type="text" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" /></div><div>
                                    <input value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to" /></div></td></tr>
                                <tr>
                                    <td  colspan="2" class="field_label" style="text-align: right;">
                                    
                                    <input type="radio" <?php if(isset($_POST['checks_mode'])){ echo "checked"; } ?>  value="n" name="checks_mode" /> All Accounts (Full info about collections)<br />
                                    <input type="radio"  value="y" name="checks_mode" <?php if(isset($_POST['checks_mode'])){ echo "checked"; } ?> /> Printing Checks (only what is needed for printing checks)<div style="margin-left:30px;color:#dddddd" id="pt_label">Payment Threshold
                                    
                                    <select id="payment_threshold" name="payment_threshold">
                                    <option <?php 
                                    if( isset($_POST['payment_threshold']) ){
                                        if($_POST['payment_threshold'] == 0.00){
                                            echo "selected";
                                        }
                                    } ?> value="0.00"> $0.00</option>
                                    <option <?php 
                                    if( isset($_POST['payment_threshold']) ){
                                        if($_POST['payment_threshold'] == 5.00){
                                            echo "selected";
                                        }
                                    } ?> value="5.00">$5.00</option>
                                    <option <?php 
                                    if( isset($_POST['payment_threshold']) ){
                                        if($_POST['payment_threshold'] == 10.00){
                                            echo "selected";
                                        }
                                    } ?> value="10.00">$10.00</option>
                                    <option <?php 
                                    if( isset($_POST['payment_threshold']) ){
                                        if($_POST['payment_threshold'] == 20.00){
                                            echo "selected";
                                        }
                                    } ?> value="20.00">$20.00</option>
                                    </select> <span style="font-size:smaller;">(Get accounts owed more than...)</span></div></td>
                                    
                                 
                                    </tr>
                                    <tr>
                                    <td style="text-align:right;text-align:right;" colspan="2">
                                    <input type="checkbox" name="archive" <?php if(isset($_POST['archive'])){ echo "checked='checked'";  } ?> />&nbsp;Show Archived Accounts<br />
                                    <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/> &nbsp;<input type="submit" value="Search" name="search_now" /> </td></tr></tbody></table></form>
                        <script>
                            $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                            $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                            </script>
                                    </tr>
                                    </table>
                        <?php
                    break;
                    case"oilperloc":
                        ?>
                        <form action="management.php?task=oilperloc" method="post">
                        <table style="font-size:smaller;margin-top:20px;margin:auto;width:50%;margin-bottom:20px;">
                            <tbody>
                                <tr>
                                    <td style="vertical-align:top;" class="field_label">
                                        Oil Collection Period
                                        
                                    </td>
                                    <td><div>
                                            <input type="text" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" value="<?php if(isset($_POST['from'])){ echo "$_POST[from]"; } ?>" />
                                        </div>
                                        <div><input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to"  value="<?php if(isset($_POST['to'])){ echo "$_POST[to]"; } ?>" /></div></td>
                                        
                                  </tr><tr>      
                                    <td>Friendly</td>
                                    <td><?php if(isset($_POST['friendly'])){ echo getFriendLists($_POST['friendly']); } else { echo getFriendLists();  } ?></td>
                                    </tr>
                                    
                                    <tr>
                                    <td>Account Name</td>
                                    <td > <input value="" size="15"  <?php if(isset($_POST['account_name'])){ echo "$_POST[account_name]"; } ?> name="account_name"/></td>
                                    </tr>
                                    
                                    <tr>
                                    <td>Account ID</td>
                                    <td > <input value="<?php if(isset($_POST['account_id'])){ echo "$_POST[account_id]"; } ?>" size="10" name="account_id" /></td>
                                    </tr>
                                    <tr>
                                    <td>State</td>
                                    <td><input value="<?php if(isset($_POST['state'])){ echo "$_POST[state]"; } ?>" size="3" name="state"/></td></tr>
                                    
                                    
                                    <tr><td colspan="10" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></a></td></tr>
                            </tbody>
                        </table>
                        </form>
                        <script>
                            $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                            $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                            </script>
                        <?php
                    break;
                
                case "affil":
                    ?>
                    <form action="management.php?task=affil" id="exp_form" name="exp_form" method="post">
                    <input type="hidden" value="export_iwp_oil_breakout_per_route" name="task"  value="<?php if(isset($_POST['task'])){ echo "$_POST[task]"; } ?>" />
                    <input type="hidden" value="yes" name="update_search" value="<?php if(isset($_POST['update_search'])){ echo "$_POST[update_search]"; } ?>" />
                    <input type="hidden" value="" name="export_set" value="<?php if(isset($_POST['export_set'])){ echo "$_POST[export_set]"; } ?>"  /> 
                    <input type="hidden" value="iwp_obr" name="event"  value="<?php if(isset($_POST['event'])){ echo "$_POST[event]"; } ?>"/>
                    
                    <table  style="font-size:smaller;width:50%;margin:auto;margin-bottom:20px;margin-top:20px;"><tbody>
                    
                    <tr>
                    <td>Route Manifest Title</td>
                    <td><input value="" size="15" name="title" value="<?php if(isset($_POST['title'])){ echo "$_POST[title]"; } ?>"  /></td>
                    </tr> 
                    
                    <tr><td>Route ID </td><td> <input value="" size="10"  type="text" value="<?php if(isset($_POST['route_id'])){ echo "$_POST[route_id]"; } ?>" name="route_id"/></td></tr>
                    
                   <tr>
                   <td>Facility</td><td class="field_label"><?php if(isset($_POST['search_now'])){  getFacilityList("facility",$_POST['facility']); }else{   getFacilityList();  }  ?></td>
                   </tr>
                   
                   
                    <tr><td style="vertical-align: top;">Date of Pickup</td><td>
                    <input  value="<?php if(isset($_POST['from'])){ echo "$_POST[from]"; } ?>" type="text" placeholder="start date" style="border-radius: 0px 0px 0px 0px;" id="from" name="from" />
                    <input type="text" placeholder="end date"  style="border-radius: 0px 0px 0px 0px;" id="to" name="to"  value="<?php if(isset($_POST['to'])){ echo "$_POST[to]"; } ?>" /></td></tr>

<tr><td colspan="2" style="vertical-align: top;text-align:center;text-align:right;">

<input  <?php if(isset($_POST['biocheck'])){ echo "checked"; } ?> name="biocheck" type="checkbox"/>&nbsp;Biotane<br />
 <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /></td></tr>
</tbody></table>
</form>
                    <script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>

                    <?php
                    break;
                case "issues":
                    ?>
                    <form action="customers.php?task=issues" method="post">
                    <table style="font-size:smaller;width:50%;margin:auto;margin-bottom:20px;margin-top:20px;margni-bottom:20px;"><tbody>
                        <tr>
                            <td class="field_label"  style="text-align: right;vertical-align:top;">Status</td>
                            <td style="text-align: right;">
                                <select id="message_status" name="message_status">
                                    <option value="-">--</option>
                                    <option value="1" <?php if($_POST['message_status'] == 1){ echo 'selected="selected"';} ?>>New and Active</option>
                                    <option value="2" <?php if($_POST['message_status'] == 2){ echo 'selected="selected"';} ?>>New</option>
                                    <option value="3" <?php if($_POST['message_status'] == 3){ echo 'selected="selected"';} ?>>Active</option>
                                    <option value="5" <?php if($_POST['message_status'] == 5){ echo 'selected="selected"';} ?>>Closed</option></select>
                            </td>
                        </tr>
                                    
                        <tr>
                            <td class="field_label" style="text-align: right;vertical-align:top;">Category</td>
                            <td  style="text-align: right;">
                                <?php
                                    if(isset($_POST['reason_for_skip_id'])){
                                         zero_gallons_reasons($_POST['reason_for_skip_id'],"");
                                    }else{
                                         zero_gallons_reasons();
                                    }
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td class="field_label" style="text-align: right;vertical-align:top;">
                                <span title="Users with issues assigned to them. Note that this list will change with the status setting">User Assigned</span></td>
                            <td  style="text-align: right;">
                            <select id="assigned_to_user_id" name="assigned_to_user_id">
                                <option value="-">--</option>
                                <?php
                                $approved_users = $db->query("SELECT first, last, user_id FROM iwp_users WHERE approved = 1 ORDER BY first");
                                    foreach($approved_users as $approved_user){
                                        echo "<option value ='$approved_user[user_id]'";
                                        if($_POST['assigned_to_user_id'] == $approved_user['user_id']){
                                            echo "selected='selected'";
                                        }
                                        echo ">$approved_user[first] $approved_user[last]</option>";
                                    }
                                    ?>
                            </select>
<!--                                <option value="-">--</option><option value="19">Jim Austin</option><option value="22">Chris Beltran</option><option value="35">Ashley Trawick</option><option value="48">Harvey Estrada</option><option value="15">David Isen</option><option value="34">William Keifer</option><option value="16">Adam Parsons</option><option value="21">Ryan Parsons</option><option value="20">Antonio Sanchez</option></select>-->
                            
                            
                            </td>
                        </tr>
                        <tr><td style="text-align: right;vertical-align:top;">Wait Days</td><td  style="text-align: center;"><input name="wait_from" value="<?php echo $_POST['wait_from'] ?>"  id="wait_from" type="text" placeholder="From"/><br/><input type="text" name="wait_to" value="<?php echo $_POST['wait_to'] ?>"   id="wait_to" placeholder="To" /></b></td>
                        </tr>
                        <tr><td style="text-align: right;vertical-align:top;">Subject</td><td  style="text-align: right;"><input type="text" placeholder="Subject"  id="subject" name="subject"/></td></tr>
                        <tr><td  style="text-align: right;vertical-align:top;">Division</td><td  style="text-align: right;vertical-align:top;"><?php if(isset($_POST['facility'])){
                            getFacilityList("",$_POST['facility']);
                        }else{
                            getFacilityList("","");
                        } ?></td></tr>
                        <tr>            
                        <td  colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /></td>
                        </tr>
                                </tr></tbody></table>
                </form>                    
                    <?php
                    break;
                    case "tracker":
                        ?>
                        <form action="customers.php?task=tracker" method="post">
                        <table style="font-size:smaller;width:50%;margin:auto;margin-bottom:20px;margin-top:20px;"><tbody><tr>
                        <td>Location Status</td>
                        <td> <select id="location_status" name="location_status">
                            <option  <?php if( $_POST['location_status'] == 3 ) { echo "selected";} ?> value="3">Both</option>
                            <option <?php if( $_POST['location_status'] == "new" ) { echo "selected";} ?> value="new">New</option>
                            
                            <option <?php if( $_POST['location_status'] == "active" ) { echo "selected";} ?> value="active">Active</option>


                            </select></td>
                        </tr>
                        <tr>
                        <td nowrap="" align="left" class="field_label">Original Sale By </td>
                        <td>
                        <?php
                        
                        
                        if(isset($_POST['salesrep'])){
                            getSalesRep($_POST['salesrep']);    
                        } else {
                            getSalesRep();
                        }
                        
                        ?>
                        
                        </td></tr>
                        
                        <tr>
                        <td>Flags</td>
                        <td> <select id="flag_id" name="flag_id">
                        <option value="-">--</option>
                        <option <?php if($_POST['flag_id'] == 1) { echo "selected";}  ?> value="1">Needs Contract</option>
                        
                        
                                                            
                                                            <option <?php if($_POST['flag_id'] == 6) { echo "selected";}  ?> value="6">Bad Payment Address</option>
                                                            
                                                            <option <?php if($_POST['flag_id'] == 7) { echo "selected";}  ?> value="7">Bad Main Address</option>
                                                            <option  <?php if($_POST['flag_id'] == 8) { echo "selected";}  ?> value="8">No Barrel present</option>
                        </select> </td></tr>
                        
                        <tr>
                            <td colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></td></tr>
                            </tbody></table></form>
                        <?php
                    break;
                case "services":
                ?>
                <form action="customers.php?task=services" method="post">
                <table style="width: 50%;margin:auto;margin-top:20px;margin-bottom:20px;">
                <tr>
                <td class="field_label">Status</td>
                <td width="200"><select id="location_status" name="location_status">
                <option value="ending">Ending Service</option>
                
                <option value="archive">Archived</option>
                
                <option value="both">Both</option>
                </select></td></tr>
                
                <tr>
                <td colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /></td></tr></table></form>
                <?php
                    break;
                case "fgrid":
                    ?>
                    <table width="80%" border="0" align="center" cellpadding="1" style="font-size:smaller"><tbody><tr><td align="left">
<div align="center" style="margin:10px;">&nbsp;</span><span style="padding-left:30px;">&nbsp;</span></div></td><td width="100">
                    <input value="" size="15" name="search_value"  value="<?php if(isset($_POST['search_value'])){ echo "$_POST[search_value]"; } ?>" />
                    
                    </td><td width="80" align="left"><input type="submit" value="Search" name="search" /> <input type="reset"/> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a></td></tr></tbody></table>
                    
                    <?php
                    break;
                case "oilongoing":
                    ?>
                    <form action="scheduling.php?task=oilongoing" method="post">
                    <input type="hidden" value="report_collected_fires" name="task" value="<?php if(isset($_POST['get_stats'])){ echo $_POST['get_stats'];} ?>" />
                    
                    <table style="font-size:smaller;margin:auto;margin-top:20px;margin-bottom:20px;width:50%;"><tbody>
                    <tr><td style="vertical-align: top;">Facility:
                   </td><td> <?php 
                    if(isset($_POST['search_now'])){
                        echo getFacilityList("",$_POST['facility']);
                    } else {
                        echo getFacilityList("","");
                    }
                   ?></td></tr>
                    <tr><td  style="vertical-align: top;">Wait Days Range</td><td><input type="text" id="min" name="min" placeholder="min days" style="width: 90px;"  value="<?php if(isset($_POST['search_now'])){ echo $_POST['min'];  } ?>"/><br /><input type="text" id="max" name="max" placeholder="max days"  style="width: 90px;"   value="<?php if(isset($_POST['search_now'])){ echo $_POST['max'];  } ?>"/></td></tr>
                    
                    <tr><td  style="vertical-align: top;"><input type="radio" name="report_type"  <?php 
        if(isset($_POST['search_now'])){  
            if(isset($_POST['report_type']) == 1) { 
                    echo "checked='checked'";
            } 
        
        }else { 
                echo 'checked="checked"';  
            }  ?>  value="1"/> Date Reported<br /><input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  if(isset($_POST['report_type']) == 1) { echo "checked='checked'";}   } ?>  value="2"/> Date Collected</td><td>
                        <input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" id="from" name="from" placeholder="From: "/><br />
                        <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" id="to" name="to" placeholder="To: "/></td></tr>
                    <tr><td class="field_label">Group By</td><td><select id="my_group" name="my_group">
                    <option value="-">--</option>
                    <option value="account_rep">Account Rep</option>
                    <option value="division">Facility</option>
                    <option value="driver">Driver</option>
                    <option value="created_by">Created By</option>


</select></td>
    </tr>
                   
                   <tr>
            <td colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/>
</td></tr></tbody></table></form>
                    <?php
                    break;
                case "oilcomplete":
                    ?>
                    <form action="scheduling.php?task=oilcomplete" method="post">
                    <input type="hidden" value="report_collected_fires" name="task" value="<?php if(isset($_POST['get_stats'])){ echo $_POST['get_stats'];} ?>" />
                    
                    <table style="font-size:smaller;margin:auto;margin-top:20px;margin-bottom:20px;width:50%;"><tbody>
                    <tr><td style="vertical-align: top;">Facility:
                   </td><td> <?php 
                    if(isset($_POST['search_now'])){
                        echo getFacilityList("",$_POST['facility']);
                    } else {
                        echo getFacilityList("","");
                    }
                   ?></td></tr>
                    <tr><td  style="vertical-align: top;">Wait Days Range</td><td><input type="text" id="min" name="min" placeholder="min days" style="width: 90px;"  value="<?php if(isset($_POST['search_now'])){ echo $_POST['min'];  } ?>"/><br /><input type="text" id="max" name="max" placeholder="max days"  style="width: 90px;"   value="<?php if(isset($_POST['search_now'])){ echo $_POST['max'];  } ?>"/></td></tr>
                    
                    <tr><td  style="vertical-align: top;"><input type="radio" name="report_type"  <?php 
        if(isset($_POST['search_now'])){  
            if(isset($_POST['report_type']) == 1) { 
                    echo "checked='checked'";
            } 
        
        }else { 
                echo 'checked="checked"';  
            }  ?>  value="1"/> Date Reported<br /><input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  if(isset($_POST['report_type']) == 1) { echo "checked='checked'";}   } ?>  value="2"/> Date Collected</td><td>
                        <input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" id="from" name="from" placeholder="From: "/><br />
                        <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" id="to" name="to" placeholder="To: "/></td></tr>
                    <tr><td class="field_label">Group By</td><td><select id="my_group" name="my_group">
                    <option value="-">--</option>
                    <option value="account_rep">Account Rep</option>
                    <option value="division">Facility</option>
                    <option value="driver">Driver</option>
                    <option value="created_by">Created By</option>


</select></td>
    </tr>
                   
                   <tr>
            <td colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/>
</td></tr></tbody></table></form>

<br />
<script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>
                    <?php
                    break;
                case "rop":
                    ?>
                    <style>
                    div#transparent table td{
    border-color:#ccc;
}                   input[type=text]{
                        border :1px solid #ccc;
                    }
                   table#secondsearchparams td{
font-size: 12px; border:1px green solid; margin:auto;width:80%;margin-top:35px;font-weight:normal;font-weight:bold;
text-align:left;
                  </style>    
                   <form action="scheduling.php?task=rop" method="post">
                                   <table style="margin:auto;font-size:smaller;width:50%;margin-bottom:20px;margin-top:20px;"><tbody><tr>
                                   <td>Route Id</td>
                                   <td><input type="text" name="rid" placeholder="Route Id" value="<?php if(isset($_POST['rid'])){ echo $_POST['rid']; } else {echo "";} ?>"/></td>
                                   </tr><tr>
                                    <td>Route title</td><td><input type="text" value="<?php if(isset($_POST['rtitle'])){ echo $_POST['rtitle']; } else {echo "";} ?>" placeholder="route title" id="rtitle" name="rtitle"/></td>
                                   </tr><tr>
                                   <td nowrap="" align="right" class="field_label" style="width: 20%;">Status</td>
            <td >
            
            <select id="status_id" name="status_id">
            <option value="scheduled">Scheduled</option>
            
            <option selected="" value="enroute">En-route</option>
            
            </select></td>
            </tr>
            
           <?php if(!$person->isCoWest() && !$person->isFriendly()){ ?> 
           <tr>
            <td class="field_label">Facility</td>
            <td style="text-align: left;">
           
            <?php echo getFacilityList("",""); ?>
           </td>
           </tr>
           <?php 
           }
           ?>
           
           <tr>
           <td class="field_label">Driver</td>
            <td>
            <?php 
            getDrivers();
            ?>
            </td>
            </tr>
            <tr>
            <td colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /></td></tr></tbody>

</table>
                        
                        </form>
                        <div style="clear: both;"></div> 
                        
                         <script>
                        $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        </script>
                        <div style="clear: both;"></div>   
                    <?php
                    break;
                    case "shifts":
                        ?>
                        <table style="width:50%;margin:auto;margin-top:20px;margin-bottom:20px;"><tbody>
                        
                        <tr><td class="field_label">Status</td>
<td ><select id="trip_status_id" name="trip_status_id"><option value="all">All Shifts</option><option selected="" value="current">Current Shifts</option><option value="coming">New and Scheduled</option>
<option value="10">New</option>

<option value="20">Scheduled</option>

<option value="30">En Route</option>

<option value="40">Returned</option>

<option value="50">Completed</option>
</select></td></tr><tr>

<tr>
<td>&nbsp;</td>
<td class="field_label"><input placeholder="From" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?> " type="text" name="from" id="from"/><br /><input placeholder="To" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?> " type="text" name="to" id="to"/></td></tr>

<tr><td  class="field_label">Driver</td>
<td>
<?php getDrivers(); ?></td>
</tr>

<tr>
<td colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></td></tr>

</tbody></table>
                    <script>
                    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    </script>
                        <?php
                        break;
                 case "pickexp":
                        ?>
                        <form name="exp_form" action="home.php" method="post"><input type="hidden" value="export_pickups" name="task"/>
                        
                        
                        

<table style="width:50%;margin:auto;margin-bottom:20px;margin-top:20px;"><tbody>

<tr><td >
<span class="field_label">Facility</span> </td><td><?php echo getFacilityList(); ?>

</td>
</tr>

<tr><td></td>
<td class="field_label">

<input type="checkbox"  id="use_date_range" name="use_date_range" <?php  if( isset($_POST['use_date_range']) ){ echo "checked";} ?>  /> Use Date Range <span class="mini">(Pickup's Scheduled Date)</span>
From&nbsp;<input value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" type="text" id="from" name="from" /><input type="text" id="to" name="to" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" style=""/></td>
</tr>

<tr>
<td style="text-align: right;" colspan="2">
                    <input type="checkbox" id="only_routed" name="only_routed"/> Only Routed<br />
                    <input type="checkbox" <?php  if( isset($_POST['only_fires']) ){ echo "checked";} ?>  id="only_fires" name="only_fires" /> Only Fires<br />
<a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit"  value="Search" name="search_now"/>

</td></tr></tbody></table></form>

                         
    <script>
    $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                    $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
    </script>

                        <?php
                        break;
                
                case "schoipu":                    
                    ?>
                    <style>
                        div#transparent table td{
                            border-color:#ccc;
                        }                   input[type=text]{
                            border :1px solid #ccc;
                            border-radius: 0px 0px 0px 0px;
                        }
                        table#secondsearchparams td{
                                font-size: 12px; border:1px green solid; margin:auto;width:80%;margin-top:35px;font-weight:normal;font-weight:bold;
                                text-align:left;
                                    
                        }
                        input{ 
                            border-radius:0px 0px 0px 0px;
                            width:150px;
                        }
                        
                        ul.facs {
                            float: left;
                            font-size: 12px;    
                            width: 330px;
                            margin-left:-10px;
                        }
                        
                        li.fac {
                            width:330px;
                        }
                    </style>
                      
                       <div id="duplicatesix" style="width: 1000px;margin:auto;height:auto;">
                            <div id="searchTableLeft" style="width: 600px;height:auto;float:left;">
                            <table style="width:600px;border:1px solid #bbb;float:left;">
                              <tr>
                                <td style="vertical-align: middle;text-align:center;border:0px solid #bbb;width:20px;padding:0px 0px 0px 0px;">
                                <form method="post" action="oil_routing.php" name="schedtoikg" class="schedtoikg" target="_blank">                        
                                <input type="radio" class="new" />
                                <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"  readonly=""/>
                                <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers"  readonly=""/>
                                <input type="hidden"  name="from_schoipu" value="1" readonly=""/>
                                </form>
                                </td>
                                <td style="width:580px;">
                                Create New Route
                                </td>
                              </tr>
                             <tr>
                                <td style="vertical-align: middle;text-align:center;border:1px solid #bbb;width:20px;padding:0px 0px 0px 0px;">                 
                                    <form method="post" class="add_to_form" action="oil_routing.php" method="post" target="_blank" name="add_to_form">
                                    <input type="hidden" name="from_routed_oil_pickups" id="from_routed_oil_pickups" title="from_routed_oil_pickups" value="1"/>
                                    <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers" readonly=""/>
                                    <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" readonly=""/>
                                    <input type="hidden" name="extra_mode" value="1"/>
                                    <input type="radio" name="route"  class="existing"  id="route" value="exist"/>
                                </td>
                                <td style="width:580px;text-align:center;"> 
                                    <span style="float: left;">Add to Existing Route</span><br />
                                    <select name="manifest" class="manifest" >
                                    <?php  
                                      $route_list_table = $dbprefix."_list_of_routes";
                                        $scrts = $db->query("SELECT route_id,ikg_manifest_route_number,driver FROM $route_list_table WHERE status IN('new','enroute','scheduled') AND deleted =0");
                                        
                                        if(count($scrts)>0){
                                            foreach($scrts as $add_existing){
                                                echo "<option value='$add_existing[route_id]'>$add_existing[route_id] $add_existing[ikg_manifest_route_number] (".uNumtoName($add_existing['driver']).")</option>";
                                            }
                                        }
                                    ?></select>&nbsp;<input style="color: black;width:60px;" type="submit" value="submit" name="schedule_us" class="schedule_us" />
                                    </form>
                                    <p><input type="checkbox"/>&nbsp;Show Routes from all Facilities</p>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:0px 0p 0px 0px;text-align:center;">
                            <table style="width: 100%;background:red;border:0px solid #bbb;padding:0px 0px 0px 0px;height:auto;">
                                <tr style="background: red;">
                                    <td style="text-align: left;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;">  
                                    <form action="scheduling.php?task=schoipu" method="post">
                                    <input style="color: black;" type="submit" value="Show Emergencies"  name="show_creds"/>
                                    </form>
                                    </td>
                                    <td  style="text-align: center;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;">
                                        <form action="mapcodered.php" method="post" target="_blank">
                                        <input type="text" readonly="" name="facs" id="facsx"/>
                                        <input style="color: black;" type="submit" value="Map Emergencies" id="mapcodered" />
                                        </form>
                                        
                                    </td>
                                    
                                    <td  style="text-align: right;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;">
                                    <form action="prev_r.php?mode=oil" method="post" target="_blank">
                                    <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"/>
                                    <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" />
                                    <input type="submit" value="preview route" id="preview"/>
                                    </form>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="text-align: center;" colspan="3">
                                        <form action="scheduling.php?task=schoipu" method="post">
                                        <input type="text" id="from" name="from" placeholder="Start Date" name="from"/>&nbsp;&nbsp;
                                        <input type="text" id="to" name="to" placeholder="End Date" style="border-radius: 0px 0px 0px 0px;"/>
                                </td>
                            </tr>
                            <tr><td  style="text-align: center;" colspan="3"><input type="text" placeholder="Cap FROM" name="cap_from"  value="<?php $_POST['cap_from'] ?>"/>&nbsp;&nbsp;<input type="text" placeholder="Cap TO" name="cap_to" value="<?php $_POST['cap_to'] ?>"/></td></tr>
                            </table>
                            </td>
                            </tr>
                            <tr><td style="text-align: center;" colspan="3">
                                <input type="text" placeholder="Gal @ Last pickup FROM" name="gal_pu_from" value="<?php $_POST['gal_pu_from'] ?>"/>&nbsp;&nbsp;<input type="text" placeholder="Gal @ Last pickup TO" name="gal_pu_to"  value="<?php $_POST['gal_pu_to'] ?>"/>
                            </td></tr>
                            
                            <tr><td style="text-align: center;" colspan="3">
                                <input type="text" placeholder="EOS FROM" name="eos_from" value="<?php $_POST['eos_from'] ?>"/>&nbsp;&nbsp;<input type="text" placeholder="EOS TO" name="eos_to" value="<?php $_POST['eos_to'] ?>"/>
                            </td></tr>
                            <tr><td colspan="3" style="text-align: center;">Friendly&nbsp;<?php if(isset($_POST['search_now'])){  
                                getFriendLists($_POST['friendly']);
                            }else{
                                getFriendLists();
                            } ?></td></tr>
                            <tr><td colspan="3" style="text-align: right;"><input <?php if(isset($_POST['only_issues'])){
                                echo " checked ";
                            }    ?>  type="checkbox" value="1" name="only_issues"/>&nbsp;Issue Related Stops Only</td></tr>
                            <tr><td>Account Status</td><td style="text-align: right;vertical-align:top;">
                            <select id="status" name="status" class="field" rel="status" >
                                <option>--Please choose a status</option>
                                <option <?php if($_POST['status'] == "Active" ) { echo "selected"; } ?>     value="Active">Active( Ready to be serviced )</option>
                                <option<?php if($_POST['status'] == "Archive" ) { echo "selected"; } ?> value="Archive">Archived</option>
                                <option <?php if($_POST['status'] == "Ending" ) { echo "selected"; } ?>    value="Ending">Ending (Final pumping)</option>
                                <option <?php if($_POST['status'] == "New" ) { echo "selected"; } ?>  value="New">New (Needs New Account)</option>
                                <option <?php if($_POST['status'] == "On Hold" ) { echo "selected"; } ?> value="On Hold">On Call (On Call)</option>
                            </select></td></tr>
                                </table>
                            </div>
                            
                                <div id="spacer" style="width: 30px;height:80px;float:left;">&nbsp;</div>
                                
                                <div id="searchTableRight" style="width: 370px;height:auto;float:left;">
                                    <?php if (!$person->isFriendly() && !$person->isCoWest()){   } ?>
                                     <table style="width:370px;background:white;height:100px;width:100%;">
                                        <tr>
                                            <td style="text-align: center;">Facility</span></td>
                                        </tr>
                                        <tr>
                            <td style="vertical-align:top;width:50%;pading:0px 0px 0px 0px;text-align:left;padding:0px 0px 0px 0px;">
                                <ul class="facs">
                                    <li><input id="all" <?php if(isset($_POST['all'])){ echo "checked"; } ?>  name="all" type="checkbox" style="float: left;"/>&nbsp;All</li>
                                    <li><input value="23" <?php if(isset($_POST['fac2'])){ echo "checked"; } ?> name="fac2"  type="checkbox" class="fac"  />&nbsp;Imperial Western Products</li>
                                    <li><input name="allfac"  <?php if(isset($_POST['allfac'])){ echo "checked"; }  ?>     type="checkbox" id="alluc"/>&nbsp;ALL UC</li>
                                    <li><input value="24" <?php if(isset($_POST['fac3'])){ echo "checked"; } ?>    name="fac3" type="checkbox" class="fac uc" />&nbsp;UC Division (Corporate)</li> 
                                    <li><input value="32" <?php if(isset($_POST['fac4'])){ echo "checked"; } ?>   name="fac4" type="checkbox" class="fac uc"/>&nbsp;UC Division (Riverside)</li>
                                    <li><input value="33" <?php if(isset($_POST['fac5'])){ echo "checked"; }?>   name="fac5" type="checkbox" class="fac uc"/>&nbsp;UC Division (Orange County)</li>
                                    <li><input value="31" <?php if(isset($_POST['fac6'])){ echo "checked"; } ?>   name="fac6" type="checkbox" class="fac uc"/>&nbsp;UC Division (Los Angeles)</li>
                                    <li><input value="30" <?php if(isset($_POST['fac7'])){ echo "checked"; }?>   name="fac7" type="checkbox" class="fac uc"/>&nbsp;UC Division (San Bernadino)</li>
                                    
                                </ul>
                            </td>
                            
                            </tr>
                            
                           <tr>
                            <td style="width: 80%;pading:0px 0px 0px 0px;text-align:left;padding:0px 0px 0px 0px;">
                                <ul class="facs" >          
                                    
                                   
                                    <li><input name="allselma"  id="allselma" type="checkbox" class="selma"/>&nbsp;All Selma</li>
                                    
                                     Division (US)</li>
                                    <li><input value="5"  <?php if(isset($_POST['fac9'])){ echo "checked"; } else {  if($person->facility ==5){ echo "checked"; } }?>   name="fac9" type="checkbox"  class="fac selma"/>&nbsp;Selma (V)</li>
                                    <li><input value="12"  <?php if(isset($_POST['fac12'])){ echo "checked"; } else {  if($person->facility == 12){ echo "checked"; } }?>  name="fac12" type="checkbox" class="fac selma"/>&nbsp;V-North</li>
                                    <li><input value="13"  <?php if(isset($_POST['fac13'])){ echo "checked"; } else {  if($person->facility == 13){ echo "checked"; } }?>  name="fac13" type="checkbox" class="fac selma"/>&nbsp;V-Visalia</li>
                                    <li><input value="10"  <?php if(isset($_POST['fac10'])){ echo "checked"; } else {  if($person->facility == 10){ echo "checked"; } }?>  name="fac10" type="checkbox" class="fac selma"/>&nbsp;V-BAK</li>
                                    <li><input value="11"  <?php if(isset($_POST['fac11'])){ echo "checked"; } else {  if($person->facility == 11){ echo "checked"; } }?>  name="fac11" type="checkbox" class="fac selma"/>&nbsp;V-Fresno</li>
                                     <li><input value="14"  <?php if(isset($_POST['fac14'])){ echo "checked"; } else {  if($person->facility == 14){ echo "checked"; } }?> name="fac14" type="checkbox" class="fac"/>&nbsp;L Division (Coachella)</li>
                                    <li><input value="15" name="fac15" type="checkbox" class="fac uc"  <?php if(isset($_POST['fac15'])){ echo "checked"; } else {  if($person->facility == 15){ echo "checked"; } }?>/>&nbsp;Co West</li>
                                    
                                    <li><input value="22" <?php if(isset($_POST['fac8'])){ echo "checked"; } else {  if($person->facility == 22){ echo "checked"; } }?>  name="fac8" type="checkbox" class="fac"/>&nbsp;San Diego
                                    
                                    
                                </ul>
                            </td>
                           </tr>
                            <tr><td>
                                 <li><input  <?php if(isset($_POST['fac1'])){ echo "checked"; }?>  name="fac1" type="checkbox" id="allariz"  />&nbsp;Arizona Division(4)</li>
                                
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="35"  <?php if(isset($_POST['fac35'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac35" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 1</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="36"  <?php if(isset($_POST['fac36'])){ echo "checked"; } else {  if($person->facility == 36){ echo "checked"; } }?> name="fac36" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 2</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="37"  <?php if(isset($_POST['fac37'])){ echo "checked"; } else {  if($person->facility == 37){ echo "checked"; } }?> name="fac37" type="checkbox" class="fac ariz"/>&nbsp;&nbsp;AZ Zone 3</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="38"  <?php if(isset($_POST['fac38'])){ echo "checked"; } else {  if($person->facility == 38){ echo "checked"; } }?> name="fac38" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 4</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="39"  <?php if(isset($_POST['fac39'])){ echo "checked"; } else {  if($person->facility == 39){ echo "checked"; } }?> name="fac39" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 5</li>
                            <li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="40"  <?php if(isset($_POST['fac40'])){ echo "checked"; } else {  if($person->facility == 40){ echo "checked"; } }?> name="fac40" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 6</li>

<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="41"  <?php if(isset($_POST['fac41'])){ echo "checked"; } else {  if($person->facility == 41){ echo "checked"; } }?> name="fac41" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 7</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="42"  <?php if(isset($_POST['fac42'])){ echo "checked"; } else {  if($person->facility == 42){ echo "checked"; } }?> name="fac42" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 8</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="43"  <?php if(isset($_POST['fac43'])){ echo "checked"; } else {  if($person->facility == 43){ echo "checked"; } }?> name="fac43" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 9</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="44"  <?php if(isset($_POST['fac44'])){ echo "checked"; } else {  if($person->facility == 44){ echo "checked"; } }?> name="fac44" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 10</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="45"  <?php if(isset($_POST['fac45'])){ echo "checked"; } else {  if($person->facility == 45){ echo "checked"; } }?> name="fac45" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 11</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="46"  <?php if(isset($_POST['fac46'])){ echo "checked"; } else {  if($person->facility == 46){ echo "checked"; } }?> name="fac46" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 12</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="47"  <?php if(isset($_POST['fac47'])){ echo "checked"; } else {  if($person->facility == 47){ echo "checked"; } }?> name="fac47" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 13</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="48"  <?php if(isset($_POST['fac48'])){ echo "checked"; } else {  if($person->facility == 48){ echo "checked"; } }?> name="fac48" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 14</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="49"  <?php if(isset($_POST['fac49'])){ echo "checked"; } else {  if($person->facility == 49){ echo "checked"; } }?> name="fac49" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 15</li>
                            <li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="50"  <?php if(isset($_POST['fac50'])){ echo "checked"; } else {  if($person->facility == 50){ echo "checked"; } }?> name="fac50" type="checkbox" class="fac ariz"/>&nbsp;AZ TEMP</li>
                            </td></tr>
                                    </table>
                                   
                                </div>
                                <div style="clear: both;"></div>
                            </div>                            
                       
                       
                       <div id="fullgraysearch" style="width: 100%;background:#bbbbbb;height:auto;float:left;">
                           <table style="width: 1000px;margin:auto;background:white;">
                            <tr>
                                <td style="width:200px;text-align: center;">Id</td>
                                <td style="width:200px;text-align: center;">Name</td>
                                <td style="width:200px;text-align: center;">City</td>
                                <td style="width:200px;text-align: center;">State</td>
                                <td style="width:200px;text-align: center;">Zip</td>
                                
                            </tr>
                          <tr>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['id']) ){ echo $_POST['id'];} ?>" type="text" name="id" id="id" style="width: 190px;"/></td>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['name']) ){ echo $_POST['name'];} ?>" type="text" name="name"  id="name"  style="width: 190px;" />
                                </td>                                            
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['city']) ){ echo $_POST['city'];} ?>" type="text" name="city" id="city"  style="width: 190px;" />
                                </td>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['state']) ){ echo $_POST['state'];} ?>" type="text" name="state" id="state"  style="width: 190px;" />
                                </td>                                                            
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['zip']) ){ echo $_POST['zip'];} ?>" type="text" name="zip" id="zip"   style="width: 190px;"/>
                                </td>
                            </tr>  
                            <tr>
                                <td colspan="10"  style="text-align:right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input style="color: black;" type="submit" value="Search" name="search_now"/> </td>
                            </tr>
                        </table>
                        </div>
                        
                       
                        
                        <div style="clear: both;"></div> 
                        
                         <script>
                        $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        </script>
                        <div style="clear: both;"></div>
                        </form>         
                    <?php
                   
                    
                    break;
                case "cuc":
                    ?>
                    <form action="scheduling.php?task=cuc" method="post">
                    <input type="hidden" value="report_collected_fires" name="task" value="<?php if(isset($_POST['get_stats'])){ echo $_POST['get_stats'];} ?>" />
                    
                    <table style="margin:auto;font-size:smaller;margin-top:20px;margin-bottom:20px;width:50%;"><tbody>                      <tr>
                     <td>Facility</td><td> <?php 
                    if(isset($_POST['facility'])){
                        getFacilityList("facility",$_POST['facility']);
                    }else{
                        getFacilityList("facility","");
                    }
             ?></td>
                    </tr>
                    
                    <tr>
                     <td style="width: 250px;">Route title</td>
                     <td><input type="text" value="<?php if(isset($_POST['rtitle'])){ echo $_POST['rtitle']; } else {echo "";} ?>" placeholder="route title" id="rtitle" name="rtitle"/></td>
                     </tr>
                     
                     <tr>
                   <td>Route id</td>
                   <td><input type="text" name="rid" placeholder="Route Id" value="<?php if(isset($_POST['rid'])){ echo $_POST['rid']; } else {echo "";} ?>"/></td>
                    </tr>
                    
                <tr>
                <td  style="vertical-align:top;"  class="field_label">
                
                Wait Days Range</td><td> <input type="text" id="min" name="min" placeholder="min days" style="width: 90px;"  value="<?php if(isset($_POST['search_now'])){ echo $_POST['min'];  } ?>"/><br /><input type="text" id="max" name="max" placeholder="max days"  style="width: 90px;"   value="<?php if(isset($_POST['search_now'])){ echo $_POST['max'];  } ?>"/>
                
                </td>
                    </tr>
                <tr>
                
                <td style="vertical-align:top;" class="field_label"><div>
<input type="radio" name="report_type"  <?php 
        if(isset($_POST['search_now'])){  
            if($_POST['report_type'] == 1) { 
                    echo "checked='checked'";
            } 
        } ?>  value="1"/> Date Reported<br />
            
            
            <input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  
                if($_POST['report_type'] == 2) { 
                    echo "checked='checked'";
                    }   
                } ?>  value="2"/> Date Collected&nbsp;</td><td>
            
            <input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" id="from" name="from" placeholder="From: "/><br />
            <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" id="to" name="to" placeholder="To: "/></td>
           
             </tr>
             
             <tr>
             <td class="field_label">Group By</td><td><select id="my_group" name="my_group">
                    <option value="-">--</option>
                    <option value="created_by">Created By</option>
                    <?php if(!$person->isFriendly() && !$person->isCoWest()) {?>
                    <option value="recieving_facility">Facility</option>
                    <?php } ?>
                    <option value="driver">Driver</option>
                    <option value="created_by">Created By</option>
                </select>
                </td>
             </tr>
             
             <tr>
            <td  style="text-align: right;" colspan="4"><input <?php if(isset($_POST['year'])){ echo " checked "; } ?> type="checkbox" name="year" id="year"/>&nbsp;Include results older than 1 year<br /><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/>

            </td>
            
            </tr></tbody></table></form>
                    <?php
                    break;
                case "suc":
                    ?>                    
                    <style>
                    div#transparent table td{
    border-color:#ccc;
}                   input[type=text]{
    border :1px solid #ccc;}
                    </style>
                       <div id="duplicatesix" style="width: 1000px;margin:auto;height:auto;">
                            <div id="searchTableLeft" style="width: 600px;height:auto;float:left;">
                            <table style="width:600px;border:1px solid #bbb;float:left;">
                              <tr>
                                <td style="vertical-align: middle;text-align:center;border:0px solid #bbb;width:20px;padding:0px 0px 0px 0px;">
                                <form action="ikg_routing.php" method="post" target="_blank" class="newutil">
                                    <input type="radio"  name="route" value="new" class="new"/>
                                    <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers" readonly=""/>
                                    <input type="hidden" class="accounts_checked"  name="accounts_checked" placeholder="account numbers"  readonly=""/>
                                    <input type="hidden" value="1" name="from_schedule_list"/>
                                </td>
                                <td style="width:580px;">
                                Create New Route&nbsp;<input type="submit" value="New Route"/></form>
                                </td>
                              </tr>
                             <tr>
                                <td style="vertical-align: middle;text-align:center;border:0px solid #bbb;width:20px;padding:0px 0px 0px 0px;">
                                <form action="ikg_routing.php" method="post" target="_blank" id="add_to_form">
                                        <input type="hidden" value="1" title="from_utility" id="from_routed_util_list" name="from_routed_util_list"  readonly="" title="From routed Utility value"/>
                                        <input type="hidden" name="add_to_existing" id="add_to_existing" value="1" readonly="" title="Add to existing value"/>
                                        <input type="radio" name="route" value="exist" class="existing"/>
                                        <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"/>
                                        <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" />
                                       
                                </td>
                                <td style="width:580px;text-align:center;"> 
                                    <span style="float: left;">Add to Existing Route</span><br />
                                    <select name="util_number"><?php 
                                        $query = $db->where("status","enroute")->get($dbprefix."_list_of_utility");
                                        if(count($query)>0){
                                            foreach($query as $util_routes){
                                                echo "<option value='$util_routes[route_id]'>$util_routes[ikg_manifest_route_number]</option>";
                                            }
                                        }
                                        
                                    ?></select>&nbsp;<input style="color: black;" type="submit" value="Add to Route" id="schedule_us"  /></form><p  ><input type="checkbox"/>&nbsp;Show Routes from all Facilities</p>
                                </td>
                            </tr>
                            <tr><br />
                                <td colspan="2" style="padding:0px 0p 0px 0px;text-align:center;">
                            <table style="width: 100%;background:transparent;border:0px solid #bbb;padding:0px 0px 0px 0px;height:auto;background:red;">
                            <tr><td style="text-align: left;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;"><form action="scheduling.php?task=suc" method="post"><input style="color: black;" type="submit" value="Show Emergencies" name="scrs"/></form></td>
                            
                            <td  style="text-align: center;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;"><form action="mapcodered_util.php" method="post" target="_blank"><input style="color: black;" type="submit" value="Map Emergencies"  /></form></td>
                            
                            <td  style="text-align: right;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;"><form action="prev_r.php?mode=util" method="post" target="_blank">
                                    <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"/>
                                    <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" />
                                    <input type="submit" value="preview route" id="preview"/>
                                    </form></td></tr></table>
                            
                            </td></tr>
                               <tr>
                                <td style="" colspan="2"><div id="dsds" style="width: 400p;x">Use Date Range</div></td>                                
                            </tr>
                           
                           <tr>
                           <form action="scheduling.php?task=suc" method="post">
                            <td colspan="2" style="text-align:center;">
                            <input value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>  " type="text" id="from" name="from" placeholder="Start Date" name="from"/>&nbsp;&nbsp;
                            <input value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?> " type="text" id="to" name="to" placeholder="End Date" style="border-radius: 0px 0px 0px 0px;"/>
                            </td>
                            
			               </tr>
                           <tr><td colspan="3" style="text-align: right;"><input <?php if(isset($_POST['only_issues'])){  
                                echo " checked ";
                            }    ?>  type="checkbox" value="1" name="only_issues"/>&nbsp;Issue Related Stops Only</td></tr>
                                </table>
                                
                            </div>
                            
                                <div id="spacer" style="width: 30px;height:80px;float:left;">&nbsp;</div>
                                <div id="searchTableRight" style="width: 370px;height:auto;float:left;">
                                    
                                    <?php if (!$person->isFriendly() && !$person->isCoWest()){ ?>     
                                    <table style="width:370px;background:white;height:100px;width:100%;">
                                        <tr>
                                            <td style="text-align: center;">Facility</span></td>
                                        </tr>

                                        <tr>
                            <td style="vertical-align:top;width:50%;pading:0px 0px 0px 0px;text-align:left;padding:0px 0px 0px 0px;">
                                <ul class="facs">
                                         
                                    <li><input id="all" name="all" type="checkbox" style="float: left;"/>&nbsp;All</li>
                                    <li><input value="23" <?php if(isset($_POST['fac2'])){ echo "checked"; } ?> name="fac2" type="checkbox" class="fac"  />&nbsp;Imperial Western Products</li>
                                    <li><input name="allfac" <?php if(isset($_POST['alluc'])){ echo "checked"; } ?> type="checkbox" id="alluc"/>&nbsp;ALL UC</li>
                                    <li><input value="24" <?php if(isset($_POST['fac3'])){ echo "checked"; } ?> name="fac3" type="checkbox" class="fac uc" />&nbsp;UC Division (Corporate)</li>
                                    <li><input value="32" <?php if(isset($_POST['fac4'])){ echo "checked"; } ?> name="fac4" type="checkbox" class="fac uc"/>&nbsp;UC Division (Riverside)</li>
                                    <li><input value="33" <?php if(isset($_POST['fac5'])){ echo "checked"; } ?> name="fac5" type="checkbox" class="fac uc"/>&nbsp;UC Division (Orange County)</li>
                                    <li><input value="31" <?php if(isset($_POST['fac6'])){ echo "checked"; } ?> name="fac6" type="checkbox" class="fac uc"/>&nbsp;UC Division (Los Angeles)</li>
                                    <li><input value="30" <?php if(isset($_POST['fac7'])){ echo "checked"; } ?> name="fac7" type="checkbox" class="fac uc"/>&nbsp;UC Division (San Bernadino)</li>
                                    
                                </ul>
                            </td>
                            
                            </tr>

                           <tr>
                            <td style="width: 80%;pading:0px 0px 0px 0px;text-align:left;padding:0px 0px 0px 0px;">
                                <ul class="facs" >          
                                    

                                    <li><input name="allselma"  id="allselma" type="checkbox" class="selma"/>&nbsp;All Selma</li>
                                    
                                     Division (US)</li>
                                    <li><input value="5" <?php if(isset($_POST['fac9'])){ echo "checked"; } ?> name="fac9" type="checkbox"  class="fac selma"/>&nbsp;Selma (V)</li>
                                    <li><input value="12" <?php if(isset($_POST['fac12'])){ echo "checked"; } ?> name="fac12" type="checkbox" class="fac selma"/>&nbsp;V-North</li>
                                    <li><input value="13" <?php if(isset($_POST['fac13'])){ echo "checked"; } ?> name="fac13" type="checkbox" class="fac selma"/>&nbsp;V-Visalia</li>
                                    <li><input value="10" <?php if(isset($_POST['fac10'])){ echo "checked"; } ?> name="fac10" type="checkbox" class="fac selma"/>&nbsp;V-BAK</li>
                                    <li><input value="11" <?php if(isset($_POST['fac11'])){ echo "checked"; } ?> name="fac11" type="checkbox" class="fac selma"/>&nbsp;V-Fresno</li>
                                     <li><input value="14"  <?php if(isset($_POST['fac14'])){ echo "checked"; } else {  if($person->facility == 14){ echo "checked"; } }?> name="fac14" type="checkbox" class="fac"/>&nbsp;L Division (Coachella)</li>
                                    <li><input value="15"  name="fac15" type="checkbox" class="fac uc"  <?php if(isset($_POST['fac15'])){ echo "checked"; } else {  if($person->facility == 15){ echo "checked"; } }?>/>&nbsp;Co West</li>
                                    
                                    <li><input value="22" <?php if(isset($_POST['fac8'])){ echo "checked"; } ?>   name="fac8" type="checkbox" class="fac"/>&nbsp;San Diego
                                </ul>
                            </td>
                           
                           </tr>
                           <tr><td>
                            <ul>
<!--                                <li><input value="8" name="fac1" type="checkbox" class="fac"  />&nbsp;Arizona Division(4)</li>-->
    <li><input value="8"  <?php if(isset($_POST['fac1'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?>  name="fac1" class="fac" type="checkbox" id="allariz"  />&nbsp;Arizona Division(4)</li>
                                
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="35"  <?php if(isset($_POST['fac35'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac35" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 1</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="36"  <?php if(isset($_POST['fac36'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac36" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 2</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="37"  <?php if(isset($_POST['fac37'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac37" type="checkbox" class="fac ariz"/>&nbsp;&nbsp;AZ Zone 3</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="38"  <?php if(isset($_POST['fac38'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac38" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 4</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="39"  <?php if(isset($_POST['fac39'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac39" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 5</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="40"  <?php if(isset($_POST['fac40'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac40" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 6</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="41"  <?php if(isset($_POST['fac41'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac41" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 7</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="42"  <?php if(isset($_POST['fac42'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac42" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 8</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="43"  <?php if(isset($_POST['fac43'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac43" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 9</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="44"  <?php if(isset($_POST['fac44'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac44" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 10</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="45"  <?php if(isset($_POST['fac45'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac45" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 11</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="46"  <?php if(isset($_POST['fac46'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac46" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 12</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="47"  <?php if(isset($_POST['fac47'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac47" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 13</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="48"  <?php if(isset($_POST['fac48'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac48" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 14</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="49"  <?php if(isset($_POST['fac49'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac49" type="checkbox" class="fac ariz"/>&nbsp;AZ Zone 15</li>
<li style="width: 50%;float: left;list-style: none;margin-bottom:5px;border-bottom:0px solid #bbb;" ><input value="50"  <?php if(isset($_POST['fac50'])){ echo "checked"; } else {  if($person->facility == 35){ echo "checked"; } }?> name="fac50" type="checkbox" class="fac ariz"/>&nbsp;AZ TEMP</li>
                            </ul>
                           </td></tr>
                                    </table>
                                    <?php } ?>     
                        </div>
                                <div style="clear: both;"></div>
                            </div>                            
                      <style type="text/css">
                      
                       table#secondsearchparams td{
    font-size: 12px; border:1px green solid; margin:auto;width:80%;margin-top:35px;font-weight:normal;font-weight:bold;
    text-align:left;
}
                      </style>    
                       
                       <div id="fullgraysearch" style="width: 100%;background:#bbbbbb;height:auto;float:left;">
                          <table style="width: 1000px;margin:auto;background:white;">
                            <tr>
                                <td style="">Id</td>
                                <td style="">Name</td>
                                <td style="">City</td>
                                <td style="">State</td>
                                <td style="">Zip</td>
                                
                            </tr>
                            <tr>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['id']) ){ echo $_POST['id'];} ?>" type="text" name="id" id="id" style="width: 190px;"/></td>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['name']) ){ echo $_POST['name'];} ?>" type="text" name="name"  id="name"  style="width: 190px;" />
                                </td>                                            
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['city']) ){ echo $_POST['city'];} ?>" type="text" name="city" id="city"  style="width: 190px;" />
                                </td>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['state']) ){ echo $_POST['state'];} ?>" type="text" name="state" id="state"  style="width: 190px;" />
                                </td>                                                            
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['zip']) ){ echo $_POST['zip'];} ?>" type="text" name="zip" id="zip"   style="width: 190px;"/></td>
                            </tr>
                            <tr><td colspan="5" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" name="search_now" value="Search"/></td></tr>
                        </table>
                           <div style="clear: both;"></div>
                        </div>
                        </form>
                        
                        
                        <div style="clear: both;"></div> 
                        
                         <script>
                        $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        </script>
                        <div style="clear: both;"></div>   
                    
                    <?php
                    break;
                    case "ruc":
                    ?>
                    
                    <form action="scheduling.php?task=ruc" method="post">
                <table  style="font-size:smaller;margin:auto;margin-bottom:20px;margin-top:20px;width:50%;"><tbody>
                    <tr>
                     <td>Route Id</td>
                                   <td><input type="text" name="rid" placeholder="Route Id" value="<?php if(isset($_POST['rid'])){ echo $_POST['rid']; } else {echo "";} ?>"/></td>
                                   </tr><tr>
                                    <td>Route title</td><td><input type="text" value="<?php if(isset($_POST['rtitle'])){ echo $_POST['rtitle']; } else {echo "";} ?>" placeholder="route title" id="rtitle" name="rtitle"/></td></tr>
                                    
                     <tr>               
                    <td  class="field_label">Status</td>
                <td ><select id="status_id" name="status_id">
                <option value="">All Routes</option>
                <option value="Scheduled">Scheduled</option>
                
                <option value="Enroute">En-route</option>
                
                <option value="Completed">Completed</option>
                </select></td>
                </tr>
                
                <tr>
                <td class="field_label">Driver</td>
                <td>
                <?php echo getDrivers(); ?></td>
                </tr>
                <tr>
                
                <td style="text-align:right;" colspan="2"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now" /></td></tr></tbody>
                
                    </table>
                    </form>
                    <?php
                    break;
                case "sgt":
                    ?>
                    <style>
                    div#transparent table td{
    border-color:#ccc;
}                   input[type=text]{
    border :1px solid #ccc;
}
                    </style>
                        
                       <div id="duplicatesix" style="width: 1000px;margin:auto;height:auto;">
                            <div id="searchTableLeft" style="width: 600px;height:auto;float:left;">
                            <table style="width:600px;border:1px solid #bbb;float:left;">
                              <tr>
                                <td style="vertical-align: middle;text-align:center;border:0px solid #bbb;width:20px;padding:0px 0px 0px 0px;">
                                <form action="grease_ikg.php" method="post" target="_blank" id="schedgreasetoikg">
                                    <input type="hidden" value="1" name="from_schedule_list"/>
                                    <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"/>
                                    <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" />
                                    <input type="hidden" name="from_schedule_list" value="1" readonly=""/>
                                    <input type="radio" name="route" class="new" value="new"/>
                                
                                </form>
                                </td>
                                <td style="width:580px;">
                                Create New Route
                                </td>
                              </tr>
                             <tr>
                                <td style="vertical-align: middle;text-align:center;border:0px solid #bbb;width:20px;padding:0px 0px 0px 0px;">
                                <form action="grease_ikg.php" method="post" target="_blank" id="add_to_form">
                                <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"/>
                                <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" />
                                    <input type="radio" name="route" class="existing" value="exist"/>
                                </td>
                                <td style="width:580px;text-align:center;"> 
                                    <span style="float: left;">Add to Existing Route</span><br />
                                    
                                    <select name="util_routes"><?php  
                                     $rgs = $db->where("status","enroute")->get($dbprefix."_list_of_grease","route_id,ikg_manifest_route_number");

                                        if(count($rgs)>0){
                                            foreach($rgs as $routes){
                                                echo "<option value='$routes[route_id]'>$routes[ikg_manifest_route_number]</option>";
                                            }
                                        }

                                    ?></select>&nbsp;<input style="color: black;" type="submit" value="submit" id="schedule_us" />
                                    <input type="hidden" name="from_routed_grease_list" value="1" />
                                    <input type="hidden" name="add_to_route" value="1"/>
                                    </form>
                                    <p><input type="checkbox"/>&nbsp;Show Routes from all Facilities</p>
                                </td>
                            </tr>
                            <tr>
                            
                                <td colspan="2" style="padding:0px 0p 0px 0px;text-align:center;">
                            <table style="width: 100%;background:transparent;border:0px solid #bbb;padding:0px 0px 0px 0px;height:auto;background:red;">
                            <tr>
                            <td style="text-align: left;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;"><form action="scheduling.php?task=sgt" method="post"><input style="color: black;" type="submit" value="Show Emergencies" name="scrs" /></form></td>
                            <td  style="text-align: center;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;"><form action="mapcodered_grease.php" method="" target="_blank"><input style="color: black;" type="submit" value="Map Emergencies" /></form></td>
                            <td  style="text-align: right;width:33%;padding:0px 0px 0px 0px;border:0px solid #Bbb;"><form action="prev_r.php?mode=sgt" method="post" target="_blank">
                                    <input type="hidden" class="schecheduled_ids"  name="schecheduled_ids" placeholder="schedule numbers"/>
                                    <input type="hidden" class="accounts_checked" name="accounts_checked" placeholder="account numbers" />
                                    <input type="submit" value="preview route" id="preview"/>
                                    </form></td>
                            </tr></table>
                            
                            </td></tr>
                            
                            
                            
                                </table>
                                
                            </div>
                            
                                <div id="spacer" style="width: 30px;height:80px;float:left;">&nbsp;</div>
                                <div id="searchTableRight" style="width: 370px;height:auto;float:left;">
                                    <?php if (!$person->isFriendly() && !$person->isCoWest()){ ?>
                                            <table style="width:370px;background:white;height:100px;width:100%;">
                                        <tr>
                                            <td style="text-align: center;">Facility</span></td>
                                        </tr>
                                        <tr>
                            <td style="vertical-align:top;width:50%;pading:0px 0px 0px 0px;text-align:left;padding:0px 0px 0px 0px;">
                                <form action="scheduling.php?task=sgt" method="post"><ul class="facs">
                                              
                                    <li><input id="all" name="all" type="checkbox" style="float: left;"/>&nbsp;All</li>
                                   
                                   
                                    
                                    <li><input value="23" name="fac2" type="checkbox" class="fac"  />&nbsp;Imperial Western Products</li>
                                    
                                    <li><input name="allfac" type="checkbox" id="alluc"/>&nbsp;ALL UC</li>
                                    <li><input value="24" name="fac3" type="checkbox" class="fac uc" />&nbsp;LA Division(UC)</li> 
                                    <li><input value="32" name="fac4" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Chato)</li>
                                    <li><input value="33"  name="fac5" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Chuck)</li>
                                    <li><input value="31"   name="fac6" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Ramon)</li>
                                    <li><input value="30"  name="fac7" type="checkbox" class="fac uc"/>&nbsp;LA Division(UC-Tony)</li>
                                    
                                </ul>
                            </td>
                            
                            </tr>
                           <tr>
                            <td style="width: 80%;pading:0px 0px 0px 0px;text-align:left;padding:0px 0px 0px 0px;">
                                <ul class="facs" >          
                                    
                                    <li><input value="8" name="fac1" type="checkbox" class="fac"  />&nbsp;Arizona Division(4)</li>
                                    <li><input name="allselma"  id="allselma" type="checkbox" class="selma"/>&nbsp;All Selma</li>
                                    
                                     Division (US)</li>
                                    <li><input value="5"  name="fac9" type="checkbox"  class="fac selma"/>&nbsp;Selma (V)</li>
                                    <li><input value="12" name="fac12" type="checkbox" class="fac selma"/>&nbsp;V-North</li>
                                    <li><input value="13" name="fac13" type="checkbox" class="fac selma"/>&nbsp;V-Visalia</li>
                                    <li><input value="10" name="fac10" type="checkbox" class="fac selma"/>&nbsp;V-BAK</li>
                                    <li><input value="11" name="fac11" type="checkbox" class="fac selma"/>&nbsp;V-Fresno</li>
                                     <li><input value="14"  <?php if(isset($_POST['fac14'])){ echo "checked"; } else {  if($person->facility == 14){ echo "checked"; } }?> name="fac14" type="checkbox" class="fac"/>&nbsp;L Division (Coachella)</li>
                                    <li><input value="15" name="fac15" type="checkbox" class="fac uc"  <?php if(isset($_POST['fac15'])){ echo "checked"; } else {  if($person->facility == 15){ echo "checked"; } }?>/>&nbsp;Co West</li>
                                   
                                    <li><input value="22"   name="fac8" type="checkbox" class="fac"/>&nbsp;San Diego
                                </ul>
                            </td>
                           
                           </tr>
                           
                                    </table>
                                    <?php } ?>     
                    </div>
                           
                          
                                   
                                <div style="clear: both;"></div>
                            </div>                            
                      <style type="text/css">
                      
                       table#secondsearchparams td{
    font-size: 12px; border:1px green solid; margin:auto;width:80%;margin-top:35px;font-weight:normal;font-weight:bold;
    text-align:left;
}
                      </style>    
                       
                       <div id="fullgraysearch" style="width: 100%;background:#bbbbbb;height:auto;float:left;">
                           <table style="width: 1000px;margin:auto;background:white;">
                            <tr>
                                <td style="width:200px;text-align: center;">Id</td>
                                <td style="width:200px;text-align: center;">Name</td>
                                <td style="width:200px;text-align: center;">City</td>
                                <td style="width:200px;text-align: center;">State</td>
                                <td style="width:200px;text-align: center;">Zip</td>
                                
                            </tr>
                          <tr>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['id']) ){ echo $_POST['id'];} ?>" type="text" name="id" id="id" style="width: 190px;"/></td>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['name']) ){ echo $_POST['name'];} ?>" type="text" name="name"  id="name"  style="width: 190px;" />
                                </td>                                            
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['city']) ){ echo $_POST['city'];} ?>" type="text" name="city" id="city"  style="width: 190px;" />
                                </td>
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['state']) ){ echo $_POST['state'];} ?>" type="text" name="state" id="state"  style="width: 190px;" />
                                </td>                                                            
                                <td style="padding: 0px 0px 0px 0px;width:200px;text-align: center;">
                                    <input value="<?php  if( isset($_POST['zip']) ){ echo $_POST['zip'];} ?>" type="text" name="zip" id="zip"   style="width: 190px;"/>
                                </td>
                            </tr>  
                            <tr>
                                
                               
                               
                                <td  style="text-align:right;" colspan="10"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input style="color: black;" type="submit" value="Search" name="search_now"/></td>
                            </tr>
                        </table>
                        </div>
                        </form>
                         <script>
                        $("input#from").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        $("input#to").datepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true});
                        </script>
                        <div style="clear: both;"></div>   
                    <?php
                    break;
                case "rgt":
                    ?>
                    <form action="scheduling.php?task=rgt" method="post">
                    <table  style="font-size:smaller;margin:auto;margin-top:20px;margin-bottom:20px;width:50%;"><tbody><tr>
                    <td>Route Id</td>
                    <td><input type="text" name="rid" placeholder="Route Id" value="<?php if(isset($_POST['rid'])){ echo $_POST['rid']; } else {echo "";} ?>"/></td>
                    </tr>
                                        
                                        <tr>
                                    <td>Route title</td><td><input type="text" value="<?php if(isset($_POST['rtitle'])){ echo $_POST['rtitle']; } else {echo "";} ?>" placeholder="route title" id="rtitle" name="rtitle"/></td>
                                    </tr>
                        
                        <tr>            
                    <td class="field_label">Status</td>
<td>
                            <select id="status_id" name="status_id"><option value="all">All Routes</option>
                            <option <?php if($_POST['status_id'] == "scheduled") { echo "selected";} ?>  value="scheduled">Scheduled</option>
                            
                            <option <?php if($_POST['status_id'] == "enroute") { echo "selected";} ?> value="enroute">En-route</option>
                            
                            <option <?php if($_POST['status_id'] == "completed") { echo "selected";} ?> value="completed">Completed</option>
                            </select></td>
                            </tr>
                            
                            <tr>
<td nowrap="" align="right" style="padding-left:10px;" class="field_label">Driver</td>
<td width="150" align="left">
<?php echo getDrivers(); ?></td>
</tr>
<tr>

<td  colspan="2" style="text-align: right;"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/></td></tr></tbody></table>
                    </form>
                    <?php
                    break;  
                case "cgt":
                    ?>
                    <form action="scheduling.php?task=cgt" method="post">
                    <input type="hidden" value="report_collected_fires" name="task" value="<?php if(isset($_POST['get_stats'])){ echo $_POST['get_stats'];} ?>" />
                    
                    <table style="font-size:smaller; border:1px grey solid;margin:auto; margin-top:20px;width:50%; margin-bottom:20px;">
                    <tbody>
                    <tr>
                     <td style="width: 250px;">Route title</td>
                     <td><input type="text" value="<?php if(isset($_POST['rtitle'])){ echo $_POST['rtitle']; } else {echo "";} ?>" placeholder="route title" id="rtitle" name="rtitle"/></td>
                     </tr>
                     
                     <tr>
                     
                     
                   <td>Route id</td>
                   <td><input type="text" name="rid" placeholder="Route Id" value="<?php if(isset($_POST['rid'])){ echo $_POST['rid']; } else {echo "";} ?>"/></td>
                    </tr>
                <tr>
                <td class="field_label">Group By</td>
                <td>
                <select id="my_group" name="my_group">
                    <option value="-">--</option>
                    <option value="created_by">Created By</option>
                    <?php if(!$person->isFriendly() && !$person->isCoWest()){ ?>
                    <option value="recieving_facility">Facility</option>
                    <?php } ?>
                    <option value="driver">Driver</option>
                    <option value="created_by">Created By</option>


</select>
                </td>
                </tr>
                <tr>
                
                    <td class="field_label">
                    
                    Wait Days Range  
                    
                    </td>
                    <td><input type="text" id="min" name="min" placeholder="min days" style="width: 90px;"  value="<?php if(isset($_POST['search_now'])){ echo $_POST['min'];  } ?>"/>&nbsp;to&nbsp;<input type="text" id="max" name="max" placeholder="max days"  style="width: 90px;"   value="<?php if(isset($_POST['search_now'])){ echo $_POST['max'];  } ?>"/></td>
                    </tr>

                    
                    <tr>
                    <td nowrap="" align="right" class="field_label"><div>
                    <input type="radio" name="report_type"  <?php 
                            if(isset($_POST['search_now'])){  
                                if($_POST['report_type'] == 1) { 
                                        echo "checked='checked'";
                                } 
                            } ?>  value="1"/> Date Reported<br />
                                
                                
                                <input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  
                                    if($_POST['report_type'] == 2) { 
                                        echo "checked='checked'";
                                        }   
                                    } ?>  value="2"/> Date Collected&nbsp;<br />
                  </td>
                    <td>  Start Date&nbsp;
                                
                                
                                <input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" id="from" name="from" placeholder="From: "/></div><div>End Date&nbsp;&nbsp;&nbsp;
                                <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" id="to" name="to" placeholder="To: "/></div></td>            
                    </tr>
                        <td>Facility</td>
                        <td><?php 
                                if(isset($_POST['facility'])){
                                    getFacilityList("facility",$_POST['facility']);
                                }else{
                                    getFacilityList("facility","");
                                }
                         ?></td>
                        </tr>
                        <tr>
            
            <td style="text-align:right;" colspan="4"><input type="checkbox" value="1" name="year" id="year"/>&nbsp;Include Results Older than 1 year<br /><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/>
</td></tr></tbody></table></form>
                    <?php
                    break;  
                case "utilalarmcomplete":
                    ?>
                    <form action="scheduling.php?task=utilalarmcomplete" method="post">
                    <input type="hidden" value="report_collected_fires" name="task" value="<?php if(isset($_POST['get_stats'])){ echo $_POST['get_stats'];} ?>" />
                    
                    <table  style="font-size:smaller;margin:auto;margin-top:20px;margin-bottom:20px;width:50%;"><tbody>
                    <tr><td>Facility</td><td><?php if(isset($_POST['search_now'])){
                getFacilityList("facility",$_POST['facility']);
            } else {
                getFacilityList();
            } ?></td></tr>
            
                    <tr><td style="vertical-align: top;">Wait Days Range</td><td><input type="text" id="min" name="min" placeholder="min days" style="width: 90px;"  value="<?php if(isset($_POST['search_now'])){ echo $_POST['min'];  } ?>"/><br /><input type="text" id="max" name="max" placeholder="max days"  style="width: 90px;"   value="<?php if(isset($_POST['search_now'])){ echo $_POST['max'];  } ?>"/></td></tr>
                    <tr><td style="vertical-align: top;"><input type="radio" name="report_type"  <?php 
        if(isset($_POST['search_now'])){  
            if(isset($_POST['report_type']) == 1) { 
                    echo "checked='checked'";
            } 
        }else {
                if($_POST['report_type'] !=2){
                    echo 'checked="checked"';  
                }
        }  ?>  value="1"/> Date Reported<br /><input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  if(isset($_POST['report_type']) == 2) { echo "checked='checked'";}   } ?>  value="2"/> Date Serviced</td><td> <input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" id="from" name="from" placeholder="From: "/>
            <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" id="to" name="to" placeholder="To: "/></td></tr>
                    
                    <tr><td  style="width:150px;" class="field_label">Group By</td><td><select id="my_group" name="my_group">
                    <option value="-">--</option>
                    <option value="account_rep">Account Rep</option>
                    
                    <option value="division">Facility</option>
                    
                    <option value="driver">Driver</option>
                    <option value="created_by">Created By</option>
                    

</select></td></tr>

<tr>
            <td>
            Service Type</td><td> 
            <?php
                if(isset($_POST['search_now'])){
                   echo  service_list("",$_POST['service_list']);
                } else {
                    echo service_list("","");
                }
            ?></td>
            </tr><tr>
            <td colspan="2" style="text-align: right;"><input type="checkbox" name="year" id="year"/>&nbsp;Include results older than 1 year<br /> <a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/>
</td></tr></tbody></table></form>
                    <?php
                    break;
                case "utilongoign":
                    ?>
                    <form action="scheduling.php?task=utilongoign" method="post">
                    <input type="hidden" value="report_collected_fires" name="task" value="<?php if(isset($_POST['get_stats'])){ echo $_POST['get_stats'];} ?>" />
                    
                    <table style="font-size:smaller;margin:auto;margin-bottom:20px;margin-top:20px;width:50%;"><tbody>                     
                    <tr><td>Facility</td><td><?php if(isset($_POST['search_now'])){
                            getFacilityList("facility",$_POST['facility']);
                        } else {
                            getFacilityList();
                        } ?></td></tr>
                    <tr>
                    <tr><td style="vertical-align: top;">Wait Days Range </td><td><input type="text" id="min" name="min" placeholder="min days" style="width: 90px;"  value="<?php if(isset($_POST['search_now'])){ echo $_POST['min'];  } ?>"/><br /><input type="text" id="max" name="max" placeholder="max days"  style="width: 90px;"   value="<?php if(isset($_POST['search_now'])){ echo $_POST['max'];  } ?>"/></td></tr>
                    
                    <tr><td style="vertical-align: top;"><input type="radio" name="report_type"  <?php 
        if(isset($_POST['search_now'])){  
            if(isset($_POST['report_type']) == 1) { 
                    echo "checked='checked'";
            } 
        }else {
                if($_POST['report_type'] !=2){
                    echo 'checked="checked"';  
                }
        }  ?>  value="1"/>&nbsp;Date Reported<br/><input type="radio" name="report_type" <?php if(isset($_POST['search_now'])){  if(isset($_POST['report_type']) == 2) { echo "checked='checked'";}   } ?>  value="2"/> Date Serviced</td><td><input type="text" value="<?php  if( isset($_POST['from']) ){ echo $_POST['from'];} ?>" id="from" name="from" placeholder="From: "/></div><div>
            <input type="text" value="<?php  if( isset($_POST['to']) ){ echo $_POST['to'];} ?>" id="to" name="to" placeholder="To: "/></div></td></tr>
                    
                    <tr><td>Group By</td><td><select id="my_group" name="my_group">
                    <option value="-">--</option>
                    <option value="account_rep">Account Rep</option>
                    <option value="division">Facility</option>
                    <option value="driver">Driver</option>
                    <option value="created_by">Created By</option>
                    

</select></td></tr>
                    




            </tr>
            
            <tr>
            <td>
            Service Type</td><td>
            <?php
                if(isset($_POST['search_now'])){
                   echo  service_list("",$_POST['service_list']);
                } else {
                    echo service_list("","");
                }
            ?></td>
            
            </tr>
            <tr>
            <td>
            Route Status: </td><td>
            <select  name="r_status" id="r_status"><option></option>
                <option <?php 
                if(isset($_POST['search_now'])){ 
                        if($_POST['r_status'] =="enroute"){ 
                                echo " selected "; 
                        }  
                    } ?>  value="enroute">enroute</option>
                <option <?php 
                if(isset($_POST['search_now'])){ 
                        if($_POST['r_status'] =="scheduled"){ 
                                echo " selected "; 
                        }  
                    } ?>  value="scheduled">scheduled</option>
            </select></td></tr>
            <tr>
            <td  style="text-align: right;" colspan="2"><a href="<?php echo "$_SERVER[REQUEST_URI]"; ?>">Default Data View</a>&nbsp;<input type="reset"/>&nbsp;<input type="submit" value="Search" name="search_now"/>
</td></tr></tbody></table></form>
                    <?php
                    break;
                default:                   
                    echo "";
                    break;
            }
        } else  {
            echo "";
        }
        

        if($person->isCoWest()){
        ?>
            <style>
            #header{   
                width:100%;   
                height:90px;
                background:url(img/cwstrip.jpg) repeat-x left top;
                 position:fixed;
                z-index:9900;
                top:0px;
                left:0px;
            }
            #blogo{
            float: left;height:90px;width:40.5%;background:url(img/cwlogo_line.jpg) no-repeat right top;
        }
            </style>
        <?php
        }

    } ?>
    
    <div style="clear: both;"></div>
</div>


