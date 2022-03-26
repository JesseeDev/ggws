<?php

include "inc/header.php";

if ($_SESSION['rank'] < "5") {
	header('Location: index.php?error=no-admin');
	exit();
}

$profit = 0;

$result = mysqli_query($con, "SELECT * FROM `subscriptions`") or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result)) {
	$profit = $profit + $row['price'];
}

$profittoday = 0;

$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `date` = '$date'") or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result)) {
	$profittoday = $profittoday + $row['price'];
}

$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `active` = '1' AND `expires` >= '$date'") or die(mysqli_error($con));
$activesubscriptions = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error($con));
$totalusers = mysqli_num_rows($result);

if (isset($_POST['addgenerator'])){
	$name = mysqli_real_escape_string($con, $_POST['addgenerator']);
	mysqli_query($con, "INSERT INTO `generators` (`name`) VALUES ('$name')") or die(mysqli_error($con));
	
	$result = mysqli_query($con, "SELECT * FROM `generators` WHERE `name` = '$name'") or die(mysqli_error($con));
	while($row = mysqli_fetch_assoc($result)) {
		$accountid = $row['id'];
	}
	
	mysqli_query($con, "CREATE TABLE `generator$accountid` (id INT NOT NULL AUTO_INCREMENT,alt VARCHAR(1000),status INT(1) DEFAULT '1',primary key (id))") or die(mysqli_error($con));
}

if (isset($_GET['deletegenerator'])){
	$id = mysqli_real_escape_string($con, $_GET['deletegenerator']);
	mysqli_query($con, "DROP TABLE `generator$id`") or die(mysqli_error($con));
	mysqli_query($con, "DELETE FROM `generators` WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "/admin-manage.php");
		</script>
	';
}

if (isset($_POST['editgenerator']) & isset($_POST['generatorid'])){
	$id = mysqli_real_escape_string($con, $_POST['generatorid']);
	$name = mysqli_real_escape_string($con, $_POST['editgenerator']);
	mysqli_query($con, "UPDATE `generators` SET `name` = '$name' WHERE `id` = '$id'") or die(mysqli_error($con));
}

if (isset($_POST['alts']) & isset($_POST['generator'])){
	$id = mysqli_real_escape_string($con, $_POST['generator']);
	mysqli_query($con,"DELETE FROM `generator$id`") or die(mysqli_error($con));
	$values = htmlspecialchars($_POST['alts']);
	$array = explode("\n", $values);
	foreach($array as $line){
		$line = mysqli_real_escape_string($con, $line);
		if (!empty($line)) {
			mysqli_query($con, "INSERT INTO `generator$id` (`alt`) VALUES ('$line')") or die(mysqli_error($con));
		}
	}
}

if (isset($_POST['addpackage']) & isset($_POST['price']) & isset($_POST['generator']) & isset($_POST['length'])){
	$name = mysqli_real_escape_string($con, $_POST['addpackage']);
	$price = mysqli_real_escape_string($con, $_POST['price']);
	$generator = mysqli_real_escape_string($con, $_POST['generator']);
	$max = mysqli_real_escape_string($con, $_POST['max']);
	$length = mysqli_real_escape_string($con, $_POST['length']);
	mysqli_query($con, "INSERT INTO `packages` (`name`, `price`, `length`, `generator`, `accounts`) VALUES ('$name', '$price', '$length', '$generator', '$max')") or die(mysqli_error($con));
}

if (isset($_GET['deletepackage'])){
	$id = mysqli_real_escape_string($con, $_GET['deletepackage']);
	mysqli_query($con, "DELETE FROM `packages` WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "/admin-manage.php");
		</script>
	';
}

if (isset($_POST['editpackage']) & isset($_POST['packageid']) & isset($_POST['editprice']) & isset($_POST['editgenerator']) & isset($_POST['editlength'])){
	$id = mysqli_real_escape_string($con, $_POST['packageid']);
	$name = mysqli_real_escape_string($con, $_POST['editpackage']);
	$price = mysqli_real_escape_string($con, $_POST['editprice']);
	$generator = mysqli_real_escape_string($con, $_POST['editgenerator']);
	$length = mysqli_real_escape_string($con, $_POST['editlength']);
	$max = mysqli_real_escape_string($con, $_POST['editmax']);
	mysqli_query($con, "UPDATE `packages` SET `name` = '$name' WHERE `id` = '$id'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `packages` SET `price` = '$price' WHERE `id` = '$id'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `packages` SET `generator` = '$generator' WHERE `id` = '$id'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `packages` SET `length` = '$length' WHERE `id` = '$id'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `packages` SET `accounts` = '$max' WHERE `id` = '$id'") or die(mysqli_error($con));
}

if (isset($_POST['website']) & isset($_POST['paypal'])){
	$website = mysqli_real_escape_string($con, $_POST['website']);
	$paypal = mysqli_real_escape_string($con, $_POST['paypal']);
	$footer = mysqli_real_escape_string($con, $_POST['footer']);
	$favicon = mysqli_real_escape_string($con, $_POST['favicon']);
	mysqli_query($con, "UPDATE `settings` SET `website` = '$website'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `settings` SET `paypal` = '$paypal'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `settings` SET `footer` = '$footer'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `settings` SET `favicon` = '$favicon'") or die(mysqli_error($con));
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

								<h4 class="page-title">Manage</h4>
                                <p class="text-muted page-title-alt">Add packages and alts and shit!</p>
                            </div>
                        </div>

                       <div class="row">
				  <div class="col-lg-4">
				  <section class="tile transparent">
                  <div class="tile-header color transparent-black textured rounded-top-corners">
							  <div class="task-thumb-details">
								  <h1>Manage Generators</h1>
							  </div>
							  <legend></legend>
							  <div id="collapse">
								<button class="btn btn-info btn-block" data-toggle="collapse" data-target=".addgenerator" data-parent="#collapse"><i class="icon-plus"></i> Add Generator</button></br>
								<form action="admin-manage.php" method="POST">
									<div class="addgenerator sublinks collapse">
										<legend></legend>
										<input name="addgenerator" type="text" class="form-control" placeholder="Ex. Netflix"></br>
										<button type="submit" class="btn btn-primary btn-block"><i class="icon-plus"></i> Add Generator</button></br>
									</div>
								</form>
							  </div>
							  <legend></legend>
							  <div class="panel-group" id="accordion">
								<?php
								$accountsquery = mysqli_query($con, "SELECT * FROM `generators`") or die(mysqli_error($con));
								while($row = mysqli_fetch_assoc($accountsquery)){
									$generatorid = $row[id];
									$getgeneratorsquery = mysqli_query($con, "SELECT * FROM `generator$generatorid`") or die(mysqli_error($con));
									$generatoramount = mysqli_num_rows($getgeneratorsquery);
									echo '
									  <div class="panel panel-info">
										  <div class="panel-heading">
											  <h4 class="panel-title">
												  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row[id].'" aria-expanded="false">'.$row[name].'&nbsp <span class="badge bg-success">'.$generatoramount.'</span></a>
												  <a href="admin-manage.php?deletegenerator='.$row[id].'" class="btn btn-xs btn-danger pull-right"><i class="icon-remove"></i></a>
												  <a class="btn btn-primary btn-xs pull-right" data-toggle="modal" href="#editgenerator" data-generator="'.$row['name'].'" data-generatorid="'.$row['id'].'"><i class="icon-remove"></i></a>
											  </h4>
										  </div>
										  <div id="collapse'.$row[id].'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
											  <div class="panel-body" style="background:#F1F2F7;">
												  <form action="admin-manage.php" method="POST">
													<input type="hidden" name="generator" value="'.$row[id].'">
													<textarea name="alts" rows="5" class="form-control" placeholder="username:password username:password">';
													while($row = mysqli_fetch_assoc($getgeneratorsquery))
													{
														echo $row['alt']."\n";
													}
													echo '</textarea>
													<br>
													<button type="submit" class="btn btn-info btn-large btn-block">Update Alts</button>
												  </form>
											  </div>
										  </div>
									  </div></br>
									  <legend></legend>
									';
								}
								?>
							  </div>
						  </div>
					  </section>
				  </div>
				  <div class="col-lg-4">
				 <section class="tile transparent">
                  <div class="tile-header color transparent-black textured rounded-top-corners">
							  <div class="task-thumb-details">
								  <h1>Manage Packages</h1>
							  </div>
							  <legend></legend>
							  <div id="collapse">
								<button class="btn btn-info btn-block" data-toggle="collapse" data-target=".addpackage" data-parent="#collapse"><i class="icon-plus"></i> Add Package</button></br>
								<form action="admin-manage.php" method="POST">
									<div class="addpackage sublinks collapse">
										<legend></legend>
										<input name="addpackage" type="text" class="form-control" placeholder="Name (Ex. Gold Package)"></br>
										<input name="price" type="text" class="form-control" placeholder="Price (Ex. 0.01)"></br>
										<select name="generator" class="form-control">
											<option value="" selected>All Generators</option>
											<?php
												$accountsquery = mysqli_query($con, "SELECT * FROM `generators`") or die(mysqli_error($con));
												while($row = mysqli_fetch_assoc($accountsquery)){
													echo '<option value="'.$row[id].'">'.$row[name].'</option>';
												}
											?>
										</select></br>
										<select name="length" class="form-control">
											<option value="Lifetime" selected>Lifetime</option>
											<option value="1 Day">1 Day</option>
											<option value="3 Days">3 Days</option>
											<option value="1 Week">1 Week</option>
											<option value="1 Month">1 Month</option>
											<option value="2 Months">2 Months</option>
											<option value="3 Months">3 Months</option>
											<option value="4 Months">4 Months</option>
											<option value="5 Months">5 Months</option>
											<option value="6 Months">6 Months</option>
											<option value="7 Months">7 Months</option>
											<option value="8 Months">8 Months</option>
											<option value="9 Months">9 Months</option>
											<option value="10 Months">10 Months</option>
											<option value="11 Months">11 Months</option>
											<option value="12 Months">12 Months</option>
										</select></br>
										<input type="number" name="max" class="form-control" placeholder="Max accounts/day (Leave empty for unlimited)"></br>
										<button type="submit" class="btn btn-primary btn-block"><i class="icon-plus"></i> Add Package</button></br>
									</div>
								</form>
							  </div>
							  <legend></legend>
							  <div class="panel-group" id="accordion">
								<?php
								$packagesquery = mysqli_query($con, "SELECT * FROM `packages`") or die(mysqli_error($con));
								while($row = mysqli_fetch_assoc($packagesquery)){
									echo '
									  <div class="panel panel-info">
										  <div class="panel-heading">
											  <h4 class="panel-title">
												  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#2collapse'.$row[id].'" aria-expanded="false">'.$row[name].'&nbsp <span class="badge bg-success">$'.$row[price].'</span></a>
												  <a href="admin-manage.php?deletepackage='.$row[id].'" class="btn btn-xs btn-danger pull-right"><i class="icon-remove"></i></a>
												  <a class="btn btn-primary btn-xs pull-right" data-toggle="modal" href="#editpackage" data-package="'.$row['name'].'" data-packageid="'.$row['id'].'" data-price="'.$row['price'].'" data-length="'.$row['length'].'" data-accounts="'.$row['accounts'].'" data-generator="'.$row['generator'].'"><i class="icon-remove"></i></a>
											  </h4>
										  </div>
										  <div id="2collapse'.$row[id].'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
											  <div class="panel-body" style="background:#F1F2F7;">
												  <form action="admin-manage.php" method="POST">
													<input type="hidden" name="package" value="'.$row[id].'">
													<br>
													<button type="submit" class="btn btn-info btn-large btn-block"><i class="icon-edit"></i> Edit Package</button>
												  </form>
											  </div>
										  </div>
									  </div></br>
									  <legend></legend>
									';
								}
								?>
							  </div>
						  </div>
					  </section>
				  </div>
				  <div class="col-lg-4">
					  <section class="tile transparent">
                  <div class="card">
							  <div class="task-thumb-details">
								  <h1>Manage Settings</h1>
							  </div>
							  <legend></legend>
							  <?php
								$accountsquery = mysqli_query($con, "SELECT * FROM `settings` LIMIT 1") or die(mysqli_error($con));
								while($row = mysqli_fetch_assoc($accountsquery)){
									echo '
									  <form class="form-horizontal" action="admin-manage.php" method="POST">
										  <div class="form-group">
											  <label for="website" class="col-lg-2 col-sm-2 control-label">Website Name</label>
											  <div class="col-lg-10">
												  <input type="text" class="form-control" name="website" placeholder="Website Name" value="'.$row['website'].'">
											  </div>
										  </div>
										  <div class="form-group">
											  <label for="paypal" class="col-lg-2 col-sm-2 control-label">Paypal</label>
											  <div class="col-lg-10">
												  <input type="email" class="form-control" name="paypal" placeholder="name@domain.com" value="'.$row['paypal'].'">
											  </div>
										  </div>
										  <div class="form-group">
											  <label for="bitcoin" class="col-lg-2 col-sm-2 control-label">Bitcoin</label>
											  <div class="col-lg-10">
												  <input type="text" class="form-control" name="bitcoin" placeholder="Bitcoin is not enabled." disabled>
											  </div>
										  </div>
										  <div class="form-group">
											  <label for="footer" class="col-lg-2 col-sm-2 control-label">Footer</label>
											  <div class="col-lg-10">
												  <input type="text" class="form-control" name="footer" placeholder="© 2014-2015 | Name Inc."  value="'.$row['footer'].'">
											  </div>
										  </div>
										  <div class="form-group">
											  <label for="favicon" class="col-lg-2 col-sm-2 control-label">Favicon</label>
											  <div class="col-lg-10">
												  <input type="url" class="form-control" name="favicon" placeholder="http://domain.com/image.jpg"  value="'.$row['favicon'].'">
											  </div>
										  </div>
										  <button type="submit" class="btn btn-info btn-large btn-block"><i class="icon-edit"></i> Update Settings</button>
									  </form>
									';
								}
							  ?>
						  </div>
					  </section>
				  </div>
              </div>

          </section>
		  
		  <!-- Modal -->
		  <div class="modal fade" id="editgenerator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Edit Generator</h4>
					  </div>
					  <div class="modal-body">
					   <form action="admin-manage.php" method="POST">
					    <input type="hidden" name="generatorid">
						<div class="form-group">
						  <label>Name</label>
						  <input type="text" class="form-control" name="editgenerator">
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
		  
		  <!-- Modal -->
		  <div class="modal fade" id="editpackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Edit Package</h4>
					  </div>
					  <div class="modal-body">
					   <form action="admin-manage.php" method="POST">
					    <input type="hidden" name="packageid">
						<div class="form-group">
						  <label>Name</label>
						  <input type="text" class="form-control" name="editpackage">
						</div>
						<div class="form-group">
						  <label>Price</label>
						  <input type="text" class="form-control" name="editprice">
						</div>
						<div class="form-group">
							<label>Generator(s)</label>
							<select name="editgenerator" class="form-control">
								<option value="">All Generators</option>
								<?php
									$accountsquery = mysqli_query($con, "SELECT * FROM `generators`") or die(mysqli_error($con));
									while($row = mysqli_fetch_assoc($accountsquery)){
										echo '<option value="'.$row[id].'">'.$row[name].'</option>';
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Length</label>
							<select name="editlength" class="form-control">
								<option value="Lifetime">Lifetime</option>
								<option value="1 Day">1 Day</option>
								<option value="3 Days">3 Days</option>
								<option value="1 Week">1 Week</option>
								<option value="1 Month">1 Month</option>
								<option value="2 Months">2 Months</option>
								<option value="3 Months">3 Months</option>
								<option value="4 Months">4 Months</option>
								<option value="5 Months">5 Months</option>
								<option value="6 Months">6 Months</option>
								<option value="7 Months">7 Months</option>
								<option value="8 Months">8 Months</option>
								<option value="9 Months">9 Months</option>
								<option value="10 Months">10 Months</option>
								<option value="11 Months">11 Months</option>
								<option value="12 Months">12 Months</option>
							</select>
						</div>
						<div class="form-group">
							<label>Max accounts/day</label>
							<input type="number" name="editmax" class="form-control" placeholder="(Leave empty for unlimited)">
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
    $(function(){

      // Initialize card flip
      $('.card.hover').hover(function(){
        $(this).addClass('flip');
      },function(){
        $(this).removeClass('flip');
      });

      // Initialize flot chart
      var d1 =[ [1, 715],
            [2, 985],
            [3, 1525],
            [4, 1254],
            [5, 1861],
            [6, 2621],
            [7, 1987],
            [8, 2136],
            [9, 2364],
            [10, 2851],
            [11, 1546],
            [12, 2541]
      ];
      var d2 =[ [1, 463],
                [2, 578],
                [3, 327],
                [4, 984],
                [5, 1268],
                [6, 1684],
                [7, 1425],
                [8, 1233],
                [9, 1354],
                [10, 1200],
                [11, 1260],
                [12, 1320]
      ];
      var months = ["January", "February", "March", "April", "May", "Juny", "July", "August", "September", "October", "November", "December"];

      // flot chart generate
      var plot = $.plotAnimator($("#statistics-chart"), 
        [
          {
            label: 'Sales', 
            data: d1,    
            lines: {lineWidth:3}, 
            shadowSize:0,
            color: '#ffffff'
          },
          { label: "Visits",
            data: d2, 
            animator: {steps: 99, duration: 500, start:200, direction: "right"},   
            lines: {        
              fill: .15,
              lineWidth: 0
            },
            color:['#ffffff']
          },{
            label: 'Sales',
            data: d1, 
            points: { show: true, fill: true, radius:6,fillColor:"rgba(0,0,0,.5)",lineWidth:2 }, 
            color: '#fff',        
            shadowSize:0
          },
          { label: "Visits",
            data: d2, 
            points: { show: true, fill: true, radius:6,fillColor:"rgba(255,255,255,.2)",lineWidth:2 }, 
            color: '#fff',        
            shadowSize:0
          }
        ],{ 
        
        xaxis: {

          tickLength: 0,
          tickDecimals: 0,
          min:1,
          ticks: [[1,"JAN"], [2, "FEB"], [3, "MAR"], [4, "APR"], [5, "MAY"], [6, "JUN"], [7, "JUL"], [8, "AUG"], [9, "SEP"], [10, "OCT"], [11, "NOV"], [12, "DEC"]],

          font :{
            lineHeight: 24,
            weight: "300",
            color: "#ffffff",
            size: 14
          }
        },
        
        yaxis: {
          ticks: 4,
          tickDecimals: 0,
          tickColor: "rgba(255,255,255,.3)",

          font :{
            lineHeight: 13,
            weight: "300",
            color: "#ffffff"
          }
        },
        
        grid: {
          borderWidth: {
            top: 0,
            right: 0,
            bottom: 1,
            left: 1
          },
          borderColor: 'rgba(255,255,255,.3)',
          margin:0,
          minBorderMargin:0,              
          labelMargin:20,
          hoverable: true,
          clickable: true,
          mouseActiveRadius:6
        },
        
        legend: { show: false}
      });

      $(window).resize(function() {
        // redraw the graph in the correctly sized div
        plot.resize();
        plot.setupGrid();
        plot.draw();
      });

      $('#mmenu').on(
        "opened.mm",
        function()
        {
          // redraw the graph in the correctly sized div
          plot.resize();
          plot.setupGrid();
          plot.draw();
        }
      );

      $('#mmenu').on(
        "closed.mm",
        function()
        {
          // redraw the graph in the correctly sized div
          plot.resize();
          plot.setupGrid();
          plot.draw();
        }
      );

      // tooltips showing
      $("#statistics-chart").bind("plothover", function (event, pos, item) {
        if (item) {
          var x = item.datapoint[0],
              y = item.datapoint[1];

          $("#tooltip").html('<h1 style="color: #418bca">' + months[x - 1] + '</h1>' + '<strong>' + y + '</strong>' + ' ' + item.series.label)
            .css({top: item.pageY-30, left: item.pageX+5})
            .fadeIn(200);
        } else {
          $("#tooltip").hide();
        }
      });

      
      //tooltips options
      $("<div id='tooltip'></div>").css({
        position: "absolute",
        //display: "none",
        padding: "10px 20px",
        "background-color": "#ffffff",
        "z-index":"99999"
      }).appendTo("body");

      //generate actual pie charts
      $('.pie-chart').easyPieChart();


      //server load rickshaw chart
      var graph;

      var seriesData = [ [], []];
      var random = new Rickshaw.Fixtures.RandomData(50);

      for (var i = 0; i < 50; i++) {
        random.addData(seriesData);
      }

      graph = new Rickshaw.Graph( {
        element: document.querySelector("#serverload-chart"),
        height: 150,
        renderer: 'area',
        series: [
          {
            data: seriesData[0],
            color: '#6e6e6e',
            name:'File Server'
          },{
            data: seriesData[1],
            color: '#fff',
            name:'Mail Server'
          }
        ]
      } );

      var hoverDetail = new Rickshaw.Graph.HoverDetail( {
        graph: graph,
      });

      setInterval( function() {
        random.removeData(seriesData);
        random.addData(seriesData);
        graph.update();

      },1000);

      // Morris donut chart
      Morris.Donut({
        element: 'browser-usage',
        data: [
          {label: "Chrome", value: 25},
          {label: "Safari", value: 20},
          {label: "Firefox", value: 15},
          {label: "Opera", value: 5},
          {label: "Internet Explorer", value: 10},
          {label: "Other", value: 25}
        ],
        colors: ['#00a3d8', '#2fbbe8', '#72cae7', '#d9544f', '#ffc100', '#1693A5']
      });

      $('#browser-usage').find("path[stroke='#ffffff']").attr('stroke', 'rgba(0,0,0,0)');

      //sparkline charts
      $('#projectbar1').sparkline('html', {type: 'bar', barColor: '#22beef', barWidth: 4, height: 20});
      $('#projectbar2').sparkline('html', {type: 'bar', barColor: '#cd97eb', barWidth: 4, height: 20});
      $('#projectbar3').sparkline('html', {type: 'bar', barColor: '#a2d200', barWidth: 4, height: 20});
      $('#projectbar4').sparkline('html', {type: 'bar', barColor: '#ffc100', barWidth: 4, height: 20});
      $('#projectbar5').sparkline('html', {type: 'bar', barColor: '#ff4a43', barWidth: 4, height: 20});
      $('#projectbar6').sparkline('html', {type: 'bar', barColor: '#a2d200', barWidth: 4, height: 20});

      // sortable table
      $('.table.table-sortable th.sortable').click(function() {
        var o = $(this).hasClass('sort-asc') ? 'sort-desc' : 'sort-asc';
        $('th.sortable').removeClass('sort-asc').removeClass('sort-desc');
        $(this).addClass(o);
      });

      //todo's
      $('#todolist li label').click(function() {
        $(this).toggleClass('done');
      });

      // Initialize tabDrop
      $('.tabdrop').tabdrop({text: '<i class="fa fa-th-list"></i>'});

      //load wysiwyg editor
      $('#quick-message-content').summernote({
        toolbar: [
          //['style', ['style']], // no style button
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          //['insert', ['picture', 'link']], // no insert buttons
          //['table', ['table']], // no table button
          //['help', ['help']] //no help button
        ],
        height: 143   //set editable area's height
      });

      //multiselect input
      $(".chosen-select").chosen({disable_search_threshold: 10});
      
    })

    </script>
    
    
    	<script>
		$('#editgenerator').on('show.bs.modal', function(e) {
			var generator = $(e.relatedTarget).data('generator');
			var generatorid = $(e.relatedTarget).data('generatorid');
			$(e.currentTarget).find('input[name="editgenerator"]').val(generator);
			$(e.currentTarget).find('input[name="generatorid"]').val(generatorid);
		});
		
		$('#editpackage').on('show.bs.modal', function(e) {
			var package = $(e.relatedTarget).data('package');
			var packageid = $(e.relatedTarget).data('packageid');
			var price = $(e.relatedTarget).data('price');
			var length = $(e.relatedTarget).data('length');
			var accounts = $(e.relatedTarget).data('accounts');
			var generator = $(e.relatedTarget).data('generator');
			$(e.currentTarget).find('input[name="editpackage"]').val(package);
			$(e.currentTarget).find('input[name="packageid"]').val(packageid);
			$(e.currentTarget).find('input[name="editprice"]').val(price);
			$(e.currentTarget).find('input[name="editmax"]').val(accounts);
		});
	</script>
	</body>
</html>