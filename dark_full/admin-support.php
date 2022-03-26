<?php

include "inc/header.php";

if ($_SESSION['rank'] < "5") {
	header('Location: index.php?error=no-admin');
	exit();
}

if (isset($_GET['read'])){
	$id = mysqli_real_escape_string($con, $_GET['read']);
	mysqli_query($con, "UPDATE `support` SET `read` = '1' WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "/admin-support.php");
		</script>
	';
}

if (isset($_GET['delete'])){
	$id = mysqli_real_escape_string($con, $_GET['delete']);
	mysqli_query($con, "DELETE FROM `support` WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "/admin-support.php");
		</script>
	';
}

if (isset($_POST['reply']) & isset($_POST['id']) & isset($_POST['to']) & isset($_POST['subject'])){
	$reply = mysqli_real_escape_string($con, $_POST['reply']);
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$to = mysqli_real_escape_string($con, $_POST['to']);
	$subject = mysqli_real_escape_string($con, $_POST['subject']);
	mysqli_query($con, "INSERT INTO `support` (`from`, `to`, `subject`, `message`, `date`) VALUES ('Admin', '$to', '$subject', '$reply', DATE('$date'))") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `support` SET `read` = '1' WHERE `id` = '$id'") or die(mysqli_error($con));
}

$result = mysqli_query($con, "SELECT * FROM `support`") or die(mysqli_error($con));
$totaltickets = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `support` WHERE `to` = 'Admin'") or die(mysqli_error($con));
$receivedtickets = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `support` WHERE `from` = 'Admin'") or die(mysqli_error($con));
$senttickets = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `support` WHERE `read` = '0'") or die(mysqli_error($con));
$unansweredtickets = mysqli_num_rows($result);

if($receivedtickets == 0){
	$replystatus = 0;
}else{
	$replystatus = $senttickets / $receivedtickets * 100;
}
	
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
                                <p class="text-muted page-title-alt">See anything that talks about transaction id contact Nova or Brandon A.S.A.P!!!</p>
                            </div>
                        </div>

                       <section id="main-content">
          <section class="wrapper">

              <div class="row">
				  <div class="col-lg-9">
					  <section class="panel">
						  <div class="panel-body">
							  <div class="task-thumb-details">
								  <h1>Support Tickets</h1>
							  </div>
							  <legend></legend>
							  <div id="menu">
								<div class="list-group">
								<?php
								$supportquery = mysqli_query($con, "SELECT * FROM `support` WHERE `to` = 'Admin' ORDER BY `date` DESC") or die(mysqli_error());
								while ($row = mysqli_fetch_assoc($supportquery)) {
									echo '
										<a href="#" style="margin-top: 5px;" class="list-group-item ';
									if($row['read'] != "1"){
									echo 'active';
									}
									echo '" data-toggle="collapse" data-target="#message'.$row[id].'" data-parent="#menu">
											<span class="name" style="min-width: 120px;display: inline-block;">'.$row["from"].'</span> <span class="">'.$row["subject"].'</span>
												<span class="badge">'.$row["date"].'</span> 
												<span class="badge"><i class="icon-plus"></i></span>
											</span>
										</a>
										<div id="message'.$row[id].'" class="sublinks collapse" style="background:#F1F2F7;">
											<textarea class="form-control" rows="8" disabled>'.$row[message].'</textarea></br>
											<form method="POST" action="admin-support.php" id="reply" name="reply">
												<textarea name="reply" class="form-control" rows="4"></textarea></br>
												<input type="hidden" name="id" value="'.$row[id].'"/>
												<input type="hidden" name="to" value="'.$row[from].'"/>
												<input type="hidden" name="subject" value="'.$row[subject].'"/>
												<button type="submit" style="margin-left: 5px;width:495px;" class="btn btn-info btn-large">Send Reply</button>
												<div class="btn-group">
													<a style="width:150px;" href="admin-support.php?read='.$row[id].'" class="btn btn-success btn-large">Set Read</a>
													<a style="width:150px;" href="admin-support.php?delete='.$row[id].'" class="btn btn-danger btn-large">Delete</a>
												</div></br></br>
											</form>
										</div>
									';
								}
								?>
								</div>
							  </div>
						  </div>
					  </section>
				  </div>
				  <div class="col-lg-3">
					  <section class="panel">
						  <div class="panel-body">
							  <div class="task-thumb-details">
								  <h1>Support Statistics</h1>
							  </div>
							  <legend></legend>
								<ul class="nav nav-pills nav-stacked">
                                  <li><a href="#"> <strong><i class="icon-envelope"></i></strong>&nbsp Total Tickets<span class="label label-primary pull-right r-activity"><?php echo $totaltickets;?></span></a></li>
                                  <li><a href="#"> <strong><i class="icon-download"></i></strong>&nbsp Received Tickets<span class="label label-warning pull-right r-activity"><?php echo $receivedtickets;?></span></a></li>
								  <li><a href="#"> <strong><i class="icon-upload"></i></strong>&nbsp Sent Tickets<span class="label label-success pull-right r-activity"><?php echo $senttickets;?></span></a></li>
								  <li><a href="#"> <strong><i class="icon-remove"></i></strong>&nbsp Unanswered Tickets<span class="label label-info pull-right r-activity"><?php echo $unansweredtickets;?></span></a></li>
								</ul></br>
								<legend></legend>
								<center><font size="3"><strong><i class="icon-upload"></i></strong>&nbsp Reply Status</font></center></br>
								<div class="progress progress-striped active progress-sm">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $replystatus;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $replystatus;?>%">
                                      <span class="sr-only"><?php echo $replystatus;?>% Complete</span>
                                  </div>
                                </div>
						  </div>
					  </section>
				  </div>
              </div>

          </section>


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