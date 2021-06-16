    <header class="header">
                <div class="logo-container">
                    <a href="dashboard.php" class="logo">
                        <img src="assets/images/logo5.png" height="35" alt="JSOFT Admin" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
            
                <!-- start: search & user box -->
                <div class="header-right">
            
                
            
                    <span class="separator"></span>
            
                    <ul class="notifications">
               
                        <li>
                            <?php
$psid=$_SESSION['psid'];                            
$sql="SELECT * from tblfir  where Status is null and PoliceStationId=:psid ";
$query = $dbh -> prepare($sql);
$query->bindParam(':psid',$psid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
$newfir=$query->rowCount();
?>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge"><?php echo $newfir;?></span>
                            </a>
            
                            <div class="dropdown-menu notification-menu">

                                <div class="notification-title">
                                    <span class="pull-right label label-default"><?php echo $newfir;?></span>
                                   New FIR
                                </div>
             
                                <div class="content">
                                    <ul><?php

foreach($results as $row)
{ 

  ?>
                                        <li>
                                            <a href="view-fir-details.php?editid=<?php echo htmlentities ($row->ID);?>" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-file-down bg-danger"></i>
                                                </div>
                                                <span class="title"><?php echo $row->FIRNo;?></span>
                                                <span class="message"><?php echo $row->DateofFIR;?></span>
                                            </a>
                                        </li>
                                       
                                       <?php  } ?>
                                    </ul>
            
                                    <hr />
            
                                    <div class="text-right">
                                        <a href="new-fir.php" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
            
                    <span class="separator"></span>
            
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="assets/images/police.png" alt="Profile Pic" class="img-circle" data-lock-picture="assets/images/police.png" />
                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                                <?php
$pid=$_SESSION['crmspid'];
$sql="SELECT Name,PID   from  tblpolice where ID=:pid";
$query = $dbh -> prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $row)
{               ?>
                                <span class="name"><?php  echo $row->Name;?></span>
                                <span class="role"><?php  echo $row->PID;?></span>
                                <?php } ?>
                            </div>
            
                            <i class="fa custom-caret"></i>
                        </a>
            
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="profile.php"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="change-password.php"><i class="fa fa-user"></i>Change Password</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>