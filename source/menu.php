<?php if(isset($_SESSION['id'])){ ?>
<ul class="dropdown" style="margin-left: -24px;">
            <?php if( $person->isAdmin() || $person->isFacilityManager()){ ?>
                <li>Management
                    <ul class="sub_menu">
                        <li><a href="management.php?task=overview">Overview</a>
                            <ul><li><a href="management.php?task=driverslog">Drivers Log</a></li></ul>
                        </li>
                        <li><a>Tools</a><ul><li>
                         <a href="roi.php" target="_blank">ROI Calculator</a>
                        </li>
                        <li><a href="management.php?task=jobcost">Job Cost Calculator</a></li>
                        <li><a href="management.php?task=forecast">Oil Forecaster</a></li>
                        </ul></li>
                        <li><a href="management.php?task=reports">Reports</a>
                            <ul>
                            <li><a href="management.php?task=newloc">New Locations</a></li>
                            <!--<li><a href="management.php?task=gps">Grease Trap Pickup Summary</a></li>--!>
                            <li><a href="management.php?task=ops">Oil Pickup Summary</a></li>
                            <li><a href="management.php?task=ocd">Oil Collection by Driver</a></li>
                            <li><a href="management.php?task=cancel">Account Cancellations</a></li>
                            <li><a href="management.php?task=expire">Account Expirations</a></li>
                           <!--- <li><a href="management.php?task=freq">Pickup Frequency</a></li>---!>
                            <li><a href="management.php?task=zero">Zero-Gallon Pickups</a></li>
                            <li><a href="management.php?task=theft">Oil Theft</a></li>
                            <li><a href="management.php?task=delivery">Container Deliveries</a></li>
                            <li><a href="management.php?task=collected">Collected Code Reds</a></li>
                            <li><a href="management.php?task=csupport">Customer Support Activity</a></li>
                            </ul>
                        </li>
                        <li><a href="management.php">Exports </a>
                            <ul>
                                <li><a href="management.php?task=picknpay">Pickups &amp; Payments</a></li>
                                <li><a href="management.php?task=alloil">All Oil Collections</a></li>
                                <li><a href="management.php?task=oilperloc">Oil Collections Per Location</a></li>
                                <li><a href="management.php?task=affil">Affiliate Breakout Per Route</a></li>
                                <!--<li><a href="management.php?task=gpexp">Grease Trap Pickup Payments</a></li>--!>
                            </ul>
                        </li>
                        <li><a href="management.php?task=indices">Payment Indices</a></li>
                        
                        <li><a href="management.php?task=users">Users</a>
                            <ul>
                            <li><a href="management.php?task=staff">Staff</a></li>
                            <li><a href="management.php?task=adduser">Add User</a></li>
                            </ul>
                        </li>                        
                        <li><a href="management.php?task=xlog">Transaction Log</a></li>
                        <li><a href="management.php?task=friendly">Friendly Comp.</a></li>
                        <li><a href="management.php?task=notes">Notes</a></li>
                        <li><a href="management.php?task=patch">Enter Patch Notes</a><ul><li><a href="management.php?task=archives">Patch Archives</a></li></ul></li>
                         <!--<li><a href="management.php?task=asset">Asset List</a></li>--!>
                        <li><a href="management.php?task=containers">Containers</a>
                            <ul><li>Sub Containers</li></ul>
                        </li>
                        <li><a href="management.php?task=vehicles">Vehicles</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li>Customers
                    <ul class="sub_menu">                        
                        <li><a href="customers.php?task=accounts">Accounts</a></li>
                        <?php if(!$person->isFriendly() ){ 
                            
                            if($person->isAdmin() || $person->isFacilityManager() || $person->isSalesRep() || $person->isSalesLeads() || $person->isSalesManagement() ){
                            ?>
                            <li><a href="customers.php?task=newaccount">New Account</a></li>
                        <?php   
                            } 
                        } ?>
                        <li>
                        <?php 
                             if(count($_SESSION['history'])>0){
                                echo "<a href='#'>History</a>";   
                             } else {
                                echo "History";
                             }
                        ?>
                        
                           <ul class="sub_menu">
                            <?php 
                            if(count($_SESSION['history'])>0){
                                foreach ($_SESSION['history'] as $places){
                                    echo "<li><a href='$places[url]'>$places[name]</a></li>";
                                }
                            } else {
                                echo "<li>empty</li>";
                            }
                            
                            ?>
                            
                            </ul>
                        </li>
                        <?php if(!$person->isFriendly() && !$person->isCoWest()){ ?>
                            <li><a href="customers.php?task=issues">Service Issues</a></li>
                            <li><a href="customers.php?task=tracker">Startup Tracker</a></li>
                            <li><a href="customers.php?task=services">Ending Service</a></li>
                        <?php } ?>                           
                    </ul>
                </li> 
                <li>Scheduling
                    <ul class="sub_menu">
                    
                        <?php if(!$person->isFriendly() && !$person->isCoWest()){ ?>
                        <li><a href="scheduling.php?task=fgrid">Facility Grid</a></li>
                        <?php } ?>
                        
                        <?php if(!$person->isCoWest()){ ?>
                        <li><a href="scheduling.php">Oil Code Red</a>
                            <ul>
                                <li><a href="scheduling.php?task=oilcomplete">Completed</a></li>
                                <li><a href="scheduling.php?task=oilongoing">Ongoing</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if(!$person->isFriendly() && !$person->isCoWest()){ ?>
                        <li><a href="scheduling.php">Utility Code Red</a>
                            <ul>
                                <li><a href="scheduling.php?task=utilalarmcomplete">Completed</a></li>
                                <li><a href="scheduling.php?task=utilongoign">Ongoing</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if( (!$person->isFriendly() && !$person->isCoWest() ) || ( $person->isAdmin() )  ){ ?>
                        <li><a href="scheduling.php?task=crequest">Container Requests</a></li>                    
                        <?php } ?>
                        
                        <li><a href="scheduling.php">Oil Pickup</a><ul>
                            <li><a href="scheduling.php?task=schoipu">Scheduled Oil Pickups</a></li>                            
                            <li><a href="scheduling.php?task=rop">Routed Oil Pickups</a></li>
                            <li><a href="scheduling.php?task=cop">Completed Oil Pickups</a></li>
                        </ul>
                        </li>
                        <?php if(!$person->isFriendly()){ ?>
                        <li><a href="scheduling.php">Utility </a>
                            <ul>
                                <li><a href="scheduling.php?task=suc">Scheduled Utility Call</a></li>
                                <li><a href="scheduling.php?task=ruc">Routed Utility Call</a></li>
                                <li><a href="scheduling.php?task=cuc">Completed Utility Call</a></li>
                            </ul>
                        </li>
                        
                        <!--<li><a href="scheduling.php">Grease Traps</a>
                            <ul>
                                 <li><a href="scheduling.php?task=sgt">Scheduled Grease Traps</a></li>
                                <li><a href="scheduling.php?task=rgt">Routed Grease Traps</a></li>
                                <li><a href="scheduling.php?task=cgt">Completed Grease Traps</a></li>
                            </ul>
                        </li>--!>
                        <?php if(!$person->isCoWest()){ ?>
                        <li><a href="scheduling.php?task=shifts">Shifts</a></li>                    
                        <li><a href="scheduling.php?task=pickexp">Pickups Export</a></li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                </li>    
                <!--
                <li>Sales
                    <ul class="sub_menu">
                        <li>My Leads</li>
                        <li>New Sales Lead</li>
                        <li>Sales Reps</li>
                        <li>Sales Lead Assignments</li>
                        <li>Sales Lead Clean Up</li>
                        <li>Report: Monthly Sales by Rep</li>
                    </ul>
                </li>-->                      
            </ul>
<?php } ?>