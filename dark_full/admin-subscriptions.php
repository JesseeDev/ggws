<?php

include "inc/header.php";

if ($_SESSION['rank'] < "5") {
	header('Location: index.php?error=no-admin');
	exit();
}

if (isset($_GET['delete'])){
	$id = mysqli_real_escape_string($con, $_GET['delete']);
	mysqli_query($con, "UPDATE `subscriptions` SET `active` = '0' WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "/admin-subscriptions.php");
		</script>
	';
}

if (isset($_POST['subscriptionid']) && isset($_POST['editpackage']) && isset($_POST['editexpires'])){
	$id = mysqli_real_escape_string($con, $_POST['subscriptionid']);
	$package = mysqli_real_escape_string($con, $_POST['editpackage']);
	$expires = mysqli_real_escape_string($con, $_POST['editexpires']);
	mysqli_query($con, "UPDATE `subscriptions` SET `package` = '$package' WHERE `id` = '$id'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `subscriptions` SET `expires` = '$expires' WHERE `id` = '$id'") or die(mysqli_error($con));
}

if (isset($_POST['addsubscription']) && isset($_POST['package'])){
	$user = mysqli_real_escape_string($con, $_POST['addsubscription']);
	$package = mysqli_real_escape_string($con, $_POST['package']);

	$result = mysqli_query($con,"SELECT * FROM `packages` WHERE `id` = '$package'");
	while ($row = mysqli_fetch_array($result)) 
	{
		$length = $row['length'];
	}

	$today = time();

	if($length == "Lifetime"){
		$expires = strtotime("100 years", $today);
	}elseif($length == "1 Day"){
		$expires = strtotime("+1 day", $today);
	}elseif($length == "3 Days"){
		$expires = strtotime("+3 days", $today);
	}elseif($length == "1 Week"){
		$expires = strtotime("+1 week", $today);
	}elseif($length == "1 Month"){
		$expires = strtotime("+1 month", $today);
	}elseif($length == "2 Months"){
		$expires = strtotime("+2 months", $today);
	}elseif($length == "3 Months"){
		$expires = strtotime("+3 months", $today);
	}elseif($length == "4 Months"){
		$expires = strtotime("+4 months", $today);
	}elseif($length == "5 Months"){
		$expires = strtotime("+5 months", $today);
	}elseif($length == "6 Months"){
		$expires = strtotime("+6 months", $today);
	}elseif($length == "7 Months"){
		$expires = strtotime("+7 months", $today);
	}elseif($length == "8 Months"){
		$expires = strtotime("+8 months", $today);
	}elseif($length == "9 Months"){
		$expires = strtotime("+9 months", $today);
	}elseif($length == "10 Months"){
		$expires = strtotime("+10 months", $today);
	}elseif($length == "11 Months"){
		$expires = strtotime("+11 months", $today);
	}elseif($length == "12 Months"){
		$expires = strtotime("+12 months", $today);
	}else{
	}

	$expires = date('Y-m-d', $expires);
	mysqli_query($con, "INSERT INTO `subscriptions` (`username`, `date`, `price`, `payment`, `package`, `expires`) VALUES ('$user', DATE('$date'), '0.00', 'Gift', '$package', '$expires')") or die(mysqli_error($con));
}

$result = mysqli_query($con, "SELECT * FROM `subscriptions`") or die(mysqli_error($con));
$totalsubscriptions = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `active` = '1' AND `expires` >= '$date'") or die(mysqli_error($con));
$activesubscriptions = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `expires` < '$date'") or die(mysqli_error($con));
$expiredsubscriptions = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `date` = '$date'") or die(mysqli_error($con));
$todayssubscriptions = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `active` = '0'") or die(mysqli_error($con));
$canceledsubscriptions = mysqli_num_rows($result);
	
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

								<h4 class="page-title">Subscriptions</h4>
                                <p class="text-muted page-title-alt">Add subscriptions no giving free subscriptions please thx!!</p>
                            </div>
                        </div>

                       
<section id="main-content">
          <section class="wrapper">

              <div class="row">
				  <div class="col-lg-9">
					  <section class="panel">
						  <div class="panel-body">
							  <div class="task-thumb-details">
								  <h1>Active Subscriptions</h1>
							  </div>
							  <legend></legend>
								<section class="panel">
								  <table class="table table-striped table-advance table-hover">
								  
									<div id="collapse">

										<button class="btn btn-info btn-large btn-block" data-toggle="collapse" data-target="#addsubscription" data-parent="#collapse"><i class="icon-plus"></i> Add Subscription</button></br>

										<div id="addsubscription" class="sublinks collapse">
											<legend></legend>
											<form action="admin-subscriptions.php" method="POST">
												<input type="text" name="addsubscription" class="form-control" placeholder="Username"></br>
												<select name="package" class="form-control">
												<?php
													$packagesquery = mysqli_query($con, "SELECT * FROM `packages`") or die(mysqli_error($con));
													while($row = mysqli_fetch_assoc($packagesquery)){
														echo '<option value="'.$row[id].'">'.$row[name].'</option>';
													}
												?>
												</select></br>
												<button type="submit" class="btn btn-primary btn-large btn-block"><i class="icon-plus"></i> Add Subscription</button>
											</form>
										</div>
										<legend></legend>
										<input id="filter" type="text" class="form-control" placeholder="Filter..">
									  <thead>
									  <tr>
										  <th><i class="icon-user"></i> Username</th>
										  <th><i class="icon-tag"></i> Package</th>
										  <th><i class="icon-calendar"></i> Expires</th>
										  <th></th>
										  <th></th>
									  </tr>
									  </thead>
									  <tbody class="searchable">
										<?php
										$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `active` = '1' AND `expires` >= '$date'") or die(mysqli_error($con));
										while ($row = mysqli_fetch_array($result)) {
											echo'<tr><td><a href="#">'.$row['username'].'</a></td>';
											$packagequery = mysqli_query($con, "SELECT * FROM `packages` WHERE `id` = '$row[package]'") or die(mysqli_error($con));
											while ($packageinfo = mysqli_fetch_array($packagequery)) {
												echo '<td>' . $packageinfo['name'] . '</td>';
												$package = $packageinfo['name'];
											}
											echo '
												  <td>'.$row['expires'].'</td>
												  <td><a class="btn btn-success btn-xs" data-toggle="modal" href="#info" data-username="'.$row['username'].'" data-package="'.$package.'" data-price="'.$row['price'].'" data-payment="'.$row['payment'].'" data-date="'.$row['date'].'" data-expires="'.$row['expires'].'" data-txn="'.$row['txn'].'"><i class="icon-info"></i>&nbsp More Info</a></td>
												  <td>
													  <a class="btn btn-primary btn-xs" data-toggle="modal" href="#edit" data-username="'.$row['username'].'" data-package="'.$row['package'].'" data-expires="'.$row['expires'].'" data-subscriptionid="'.$row['id'].'"><i class="icon-pencil"></i></a>
													  <a class="btn btn-danger btn-xs" href="admin-subscriptions.php?delete=' . $row['id'] . '"><i class="icon-trash "></i></a>
												  </td>
											  </tr>
											';
										}
										?>
									  </tbody>
								  </table>
							  </section>
						  </div>
					  </section>
				  </div>
				  <div class="col-lg-3">
					  <section class="panel">
						  <div class="panel-body">
							  <div class="task-thumb-details">
								  <h1>Subscription Statistics</h1>
							  </div>
							  <legend></legend>
								<ul class="nav nav-pills nav-stacked">
                                  <li><a href="#"> <strong><i class="icon-tags"></i></strong>&nbsp Total Subscriptions<span class="label label-primary pull-right r-activity"><?php echo $totalsubscriptions;?></span></a></li>
                                  <li><a href="#"> <strong><i class="icon-ok"></i></strong>&nbsp Active Subscriptions<span class="label label-warning pull-right r-activity"><?php echo $activesubscriptions;?></span></a></li>
								  <li><a href="#"> <strong><i class="icon-remove"></i></strong>&nbsp Expired Subscriptions<span class="label label-success pull-right r-activity"><?php echo $expiredsubscriptions;?></span></a></li>
								  <li><a href="#"> <strong><i class="icon-calendar"></i></strong>&nbsp Today's Subscriptions<span class="label label-info pull-right r-activity"><?php echo $todayssubscriptions;?></span></a></li>
								  <li><a href="#"> <strong><i class="icon-off"></i></strong>&nbsp Canceled Subscription<span class="label label-default pull-right r-activity"><?php echo $canceledsubscriptions;?></span></a></li>
								</ul>
						  </div>
					  </section>
				  </div>
              </div>

          </section>
		  
		  <!-- Modal -->
		  <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Subscription Info</h4>
					  </div>
					  <div class="modal-body">
						<div class="form-group">
						  <label for="username">Username</label>
						  <input type="text" class="form-control" name="username" disabled>
						</div>
						<div class="form-group">
						  <label for="package">Package</label>
						  <input type="text" class="form-control" name="package" disabled>
						</div>
						<div class="form-group">
						  <label for="price">Price</label>
						  <input type="text" class="form-control" name="price" disabled>
						</div>
						<div class="form-group">
						  <label for="payment">Payment Method</label>
						  <input type="text" class="form-control" name="payment" disabled>
                        </div>
						<div class="form-group">
						  <label for="date">Date</label>
						  <input type="date" class="form-control" name="date" disabled>
                        </div>
						<div class="form-group">
						  <label for="expires">Expires</label>
						  <input type="date" class="form-control" name="expires" disabled>
                        </div>
						<div class="form-group">
						  <label for="txn">Transaction ID</label>
						  <input type="text" class="form-control" name="txn" disabled>
                        </div>
					  </div>
				  </div>
			  </div>
		  </div>
		  <!-- modal -->
		  
		  <!-- Modal -->
		  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Edit Subscription</h4>
					  </div>
					  <div class="modal-body">
					   <form action="admin-subscriptions.php" method="POST">
					    <input type="hidden" name="subscriptionid">
						<div class="form-group">
						  <label>Username</label>
						  <input type="text" class="form-control" name="editusername" disabled>
						</div>
						<div class="form-group">
						  <label>Package</label>
						  <select class="form-control" name="editpackage">
							<?php
								$packagesquery = mysqli_query($con, "SELECT * FROM `packages`") or die(mysqli_error($con));
								while($row = mysqli_fetch_assoc($packagesquery)){
									echo '<option value="'.$row[id].'">'.$row[name].'</option>';
								}
							?>
						  </select>
						</div>
						<div class="form-group">
						  <label>Expires</label>
						  <input type="date" class="form-control" name="editexpires">
                        </div>
					  </div>
					  <div class="modal-footer">
						<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
						<button class="btn btn-warning" type="submit"> Update</button>
                      </div>
					   </form>
				  </div>
			  </div>
		  </div>
		  <!-- modal -->
		  
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
	<script>
		$(document).ready(function () {

			(function ($) {

				$('#filter').keyup(function () {

					var rex = new RegExp($(this).val(), 'i');
					$('.searchable tr').hide();
					$('.searchable tr').filter(function () {
						return rex.test($(this).text());
					}).show();

				})

			}(jQuery));

		});
		
		$('#info').on('show.bs.modal', function(e) {
			var username = $(e.relatedTarget).data('username');
			var package = $(e.relatedTarget).data('package');
			var price = $(e.relatedTarget).data('price');
			var payment = $(e.relatedTarget).data('payment');
			var date = $(e.relatedTarget).data('date');
			var expires = $(e.relatedTarget).data('expires');
			var txn = $(e.relatedTarget).data('txn');
			$(e.currentTarget).find('input[name="username"]').val(username);
			$(e.currentTarget).find('input[name="package"]').val(package);
			$(e.currentTarget).find('input[name="price"]').val(price);
			$(e.currentTarget).find('input[name="payment"]').val(payment);
			$(e.currentTarget).find('input[name="date"]').val(date);
			$(e.currentTarget).find('input[name="expires"]').val(expires);
			$(e.currentTarget).find('input[name="txn"]').val(txn);
		});
		
		$('#edit').on('show.bs.modal', function(e) {
			var editusername = $(e.relatedTarget).data('username');
			var editexpires = $(e.relatedTarget).data('expires');
			var subscriptionid = $(e.relatedTarget).data('subscriptionid');
			var editpackage = $(e.relatedTarget).data('package');
			$(e.currentTarget).find('input[name="editusername"]').val(editusername);
			$(e.currentTarget).find('input[name="editexpires"]').val(editexpires);
			$(e.currentTarget).find('input[name="subscriptionid"]').val(subscriptionid);
		});
	</script>
	</body>
</html>