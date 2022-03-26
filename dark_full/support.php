<?php

ob_start();

include 'inc/database.php';
include 'inc/header.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="#1 Account Generator out there well known for working alts and great support team and cheap prices!">
		<meta name="author" content="Ruthless Hacker">

		<link rel="shortcut icon" href="assets/images/favicon_1.ico">

		<title>Universal Gen</title>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

	</head>

	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.php" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Universal Gen</span></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                            <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav hidden-xs">
                                <li><a href="#" class="waves-effect waves-light">Files</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">More <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="https://discord.gg/UjqKBRQ">Discord</a></li>
										<li><a href="http://www.n0va.shop/">N0va Shop</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <form role="search" class="navbar-left app-search pull-left hidden-xs">
			                     <input type="text" placeholder="Search..." class="form-control">
			                     <a href=""><i class="fa fa-search"></i></a>
			                </form>


                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown top-menu-item-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">0</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span class="label label-default pull-right">0</span>Notification</li>
                                        <li class="list-group slimscroll-noti notification-list">
                                          
                                            <!-- list item-->
                                           
                                            <a href="javascript:void(0);" class="list-group-item text-right">
                                                <small class="font-600">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                        <li class="divider"></li>
                                        <li><a href="lib/logout.php"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                        	<li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">
                                <a href="index.php" class="waves-effect"><i class="fa fa-diamond"></i> <span> Dashboard </span></a>
                            </li>
							<li class="has_sub">
                                <a href="purchase.php" class="waves-effect"><i class="fa fa-cc-paypal"></i> <span> Purchase </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="fa fa-refresh"></i> <span> Generator </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="generator.php">Generator</a></li>
									<li><a href="generator-history.php">Generater History</a></li>
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="support.php" class="waves-effect"><i class="fa fa-envelope"></i> <span> Support </span></a>
                            </li>
							<?php
					if (($_SESSION['rank']) == "5") {
                        echo '
						<li class="has_sub">
                                <a href="#" class="waves-effect"><i class="fa fa-database"></i> <span> Admin </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="admin-manage.php">Manage</a></li>
                                    <li><a href="admin-news.php">News</a></li>
									<li><a href="admin-statistics.php">Statistics</a></li>
									<li><a href="admin-support.php">Support</a></li>
                                    <li><a href="admin-subscriptions.php">Subscriptions</a></li>
                                    <li><a href="admin-users.php">Users</a></li>
                                </ul>
                            </li>
					';
					}
				  ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
			<!-- Left Sidebar End -->

			<!-- ============================================================== -->
			<!-- Start right Content here -->
			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                    <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                    <ul class="dropdown-menu drop-menu-right" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>

								<h4 class="page-title">Support</h4>
                                <p class="text-muted page-title-alt">Ticket System</p>
                            </div>
                        </div>

                       <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
  	                  <div class="row">
                          
                            
                           	<div class="col-sm-4">
		<div class="panel panel-default">

			<div class="panel-heading">Submit Support Ticket</div>
			<div class="panel-body">
			    
			    <form method="POST"/>
								<label>Subject:</label></br>
									<select name="subject" class="form-control">
											<option value="N/A" selected>Please Select One</option>
											<option value="General Support">General Support</option>
											<option value="My Account">My Account</option>
											<option value="Generator Issues">Generator Issues</option>
											<option value="My Subscription">My Subscription</option>
											<option value="Advertisement Spot">Advertisement Spot</option>
											<option value="Site Ideas">Site Ideas</option>

										</select></br>
								<label>Message:</label></br>
								<textarea name="message" class="form-control" rows="8" required ></textarea></br>
								<button name="sent" class=" btn btn-primary btn-large btn-block" >Submit Ticket</button>
							<legend></legend>
								
	<?php 
		if (isset($_POST['sent']))
		{
	    	$subject = htmlspecialchars(mysqli_real_escape_string($con, $_POST['subject']));
            $message = htmlspecialchars(mysqli_real_escape_string($con, $_POST['message']));
			if (!empty($message))
			{
			    if(strlen($message) > 5 && isset($_POST['subject']) === true && strlen($message) < 255){
	                $date = date("Y-m-d");
	                mysqli_query($con, "INSERT INTO `support` (`from`, `to`, `subject`, `message`, `date`) VALUES ('$username', 'admin', '$subject', '$message', DATE('$date'))") or die(mysqli_error($con));
				    echo '<div class="alert alert-success"><strong>Successful!</strong> Your support ticket has been sent to the support team. You will get a reply in 4-5 hours please be patient  </div>';
			
			    }elseif(strlen($message) < 5 || strlen($message) > 255){
			        echo '<div class="alert alert-danger"><strong>ERROR:</strong> Your support ticket has not been sent please make sure your message contains 5-255 characters noting more or less!</div>';
			    }
			}else{
			    echo '<div class="alert alert-danger"><strong>ERROR:</strong> Your support ticket has no text please provide a valid ticket more than 5 characters long and less than 255 characters!</div>';
			}
		}
		?>

			</div>
		</div>
	</div>
          
   


    		<div class="col-sm-8">
		<div class="panel panel-default">

			<div class="panel-heading">Support Tickets Sent</div>
			
			<div class="panel-body">
			    			
   <table id="datatable" class="table table-hover table-bordered">
                                       
                                       	  <thead>
									  <tr>
									      
										  <th><i class="fa fa-star"></i> Subject </th>
										  <th><i class="fa fa-star"></i> Message </th>
										  <th><i class="fa fa-star"></i> Status</th>
										  <th><i class="fa fa-star"></i> Delete</th>
									
									  </tr>
									  </thead>
									  <tbody class="searchable">
									      	<?php
									$supportquery = mysqli_query($con, "SELECT * FROM `support` WHERE `from` = '$username' ORDER BY `date` DESC");
									while ($row = mysqli_fetch_assoc($supportquery)) {
										echo '
								<tr>

													<td>'.$row['subject'].'</td>
													<td>'.$row["message"].'</td>
													<td><span class="'.$row["color"].'">'.$row["Status"].'</span> </td>
													<td><a style="width:150px;" id="delete" href="support.php?delete='.$row['id'].'"><i class="fa fa-trash"></i></a></td>
												 </tr>
									
                                       	';
                                       	    if(isset($_GET['delete'])){
                                                $delete = htmlspecialchars(stripslashes(mysqli_real_escape_string($con, $_GET['delete'])));
                                                mysqli_query($con, "DELETE FROM support WHERE id = '$delete'") or die(mysqli_error($con));
                                                	echo '
                                            		<script>
                                            			window.history.replaceState("object or string", "Title", "support.php");
                                            		</script>
                                            	';
                                            }
									}
								?>
                                       
                                       
                                       
                                        </tbody>
                                    </table>
		     
			</div>
		</div>
	</div>
	

    		<div class="col-sm-12">
		<div class="panel panel-default">

			<div class="panel-heading">Support Ticket Replys</div>
			
			<div class="panel-body">
			    			
   <table id="datatable" class="table table-hover table-bordered">
                                       
                                       	  <thead>
									  <tr>
									      
										  <th><i class="fa fa-user"></i> From</th>
										  <th><i class="fa fa-star"></i> Replying to </th>
										  <th><i class="fa fa-star"></i> Message </th>
										  <th><i class="fa fa-star"></i> Delete</th>
									  </tr>
									  </thead>
									  <tbody class="searchable">
									      	<?php
									$supportquery = mysqli_query($con, "SELECT * FROM `support` WHERE `to` = '$username' ORDER BY `date` DESC");
									while ($row = mysqli_fetch_assoc($supportquery)) {
										echo '
								<tr>

													<td>'.$row["from"].'</td>
													<td>'.$row['subject'].'</td>
													<td>'.$row["message"].'</td>
													<td><a style="width:150px;" id="delete" href="support.php?delete='.$row['id'].'" class="btn btn-primary ">Delete</a></td>
											
										

												 </tr>
									
                                       	';
                                       	if(isset($_GET['delete'])){
                                                $delete = htmlspecialchars(stripslashes(mysqli_real_escape_string($con, $_GET['delete'])));
                                                mysqli_query($con, "DELETE FROM support WHERE id = '$delete'") or die(mysqli_error($con));
                                                    echo '
                                            			<script>
                                            			$(document).ready(function(){
                                            				$("#delete").click(function(){
                                            				 $.get("support.php?delete=\'' . $row["id"] .'\'", function(response){
                                            					$("#datatable").val(response);
                                            				 });
                                            				});
                                            			});
                                            			</script>
                                            		';
                                                	echo '
                                                		<script>
                                                			window.history.replaceState("object or string", "Title", "support.php");
                                                		</script>
                                                	';
                                            }
									}
								?>
                                       
                                       
                                       
                                        </tbody>
                                    </table>
		     
			</div>
		</div>
	</div>


                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <footer class="footer">
                    © 2017 Universal Team. All rights reserved.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            
            <!-- /Right-bar -->


        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	
	</body>
</html>