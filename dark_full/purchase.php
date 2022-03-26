<?php

include 'inc/header.php';

$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `username` = '$username' AND `active` = '1' AND `expires` >= '$date'") or die(mysqli_error($con));
if (mysqli_num_rows($result) < 1 && $_SESSION['rank'] != "5") {
	$subscription = "0";
}else{
	$subscription = "1";
}

if(isset($_POST['purchase'])){
	$id = mysqli_real_escape_string($con, $_POST['purchase']);
	$result = mysqli_query($con, "SELECT * FROM `packages` WHERE `id` = '$id'") or die(mysqli_error($con));

	while ($row = mysqli_fetch_array($result)) {
		$packageprice = $row['price'];
		$packagename = $website." - ".$row['name'];
		$custom = $row['id']."|".$username;
	}
	
	$paypalurl = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&amount=".urlencode($packageprice)."&business=".urlencode($paypal)."&page_style=primary&item_name=".urlencode($packagename)."&return=http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."/purchase.php?action=buy-success&rm=2&notify_url=http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."/lib/ipn.php"."&cancel_return=http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."/purchase.php?action=buy-error&custom=".urlencode($custom)."&mc_currency=USD";
	header('Location: '.$paypalurl);
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

								<h4 class="page-title">Purchase</h4>
                                <p class="text-muted page-title-alt">After you purchase make a ticket saying your Paypal email and transaction id and we will add your package may take up to 30 min wait time!</p>
                            </div>
                        </div>
						
						<section id="main-content">
              <div class="row product-list">
				<?php
					$result = mysqli_query($con, "SELECT * FROM `packages` ORDER BY CAST(price AS DECIMAL(10,2))");
					while ($row = mysqli_fetch_assoc($result)) {
						if($row['generator'] == ""){
							$generatorname = "All";
						}else{
							$generatorquery = mysqli_query($con, "SELECT * FROM `generators` WHERE `id` = '$row[generator]'") or die(mysqli_error($con));
							while($row1 = mysqli_fetch_array($generatorquery)){
								$generatorname = $row1['name'];
							}
						}
						if($row['accounts'] == "0" || $row['accounts'] == ""){
							$accounts = "Unlimited";
						}else{
							$accounts = $row['accounts']."/day";
						}
						echo '
                          <div class="col-md-4">
                              <section class="panel">
                                  <div class="panel-body text-center">
                                   <div class="tile-header color transparent-black textured rounded-top-corners">
                                      <a href="#" class="pro-title">
                                          <H3>'.$row['name'].'</H3>
                                      </a>
									  <img src="https://i.imgur.com/zhQAojA.png" class=" " height="140" width="160">
                                      <p class="price">$'.$row['price'].'</p>
									  <legend></legend>
									  <label>Generator(s):</label> '.$generatorname.'</br>
									  <label>Length:</label> '.$row[length].'</br>
									  <label>Accounts:</label> '.$accounts.'</br></br>
									  <form method="POST" action="purchase.php">
										<input type="hidden" name="purchase" value="'.$row[id].'"/>
										<button type="submit" class="btn btn-info btn-lg btn-block"
						';
						if ($subscription != "0" || $_SESSION['rank'] == "5"){
							echo "enabled";
						}
						echo '
										><i class="fa fa-cc-paypal"></i> Buy Now</button>
									  </form>
								  </div>
                              </section>
                          </div>
						';
					}	 
				?>
              </div>

          </section>
		  
		  <?php 
		  
		  if($_GET['action'] == "buy-success"){
			  $result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `username` = '$username' AND `date` = '$date'") or die(mysqli_error($con));
			  if (mysqli_num_rows($result) < 1) {
				  echo '
					  <div class="modal fade" id="buy-success" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 15%; overflow-y: visible; display: none;">
						<div class="modal-dialog modal-m">
							<div class="modal-content">
								<div class="modal-header">
									<center><h3 style="margin:0;">Waiting for purchase to complete..</h3></center>
								</div>
								<div class="modal-body">
									<script language="JavaScript" type="text/javascript">  
										var count = 10;
										function countDown(){
										 if (count <=0){  
										  document.getElementById("timer").innerHTML = "<b>Refreshing...</b>";
										 }else{  
										  count--;  
										  document.getElementById("timer").innerHTML = "<center>Refreshing in "+ count + " seconds</center>";
												  setTimeout("countDown()", 1000)
										 }  
										}
									</script>
									<span id="timer"><script>countDown();</script></span></br>
									<script type="text/javascript">
										window.setTimeout(function(){window.location.href="purchase.php?action=buy-success"},10000);
									</script>
									<div id="progress-bar" class="progress progress-striped active" style="margin-bottom:0;">
										<div class="progress-bar" style="width: 100%">
										</div>
									</div>
								</div>
							</div>
						</div>
					  </div>
				  ';
			  }else{
				echo '
					  <div class="modal fade" id="buy-success" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 15%; overflow-y: visible; display: none;">
						<div class="modal-dialog modal-m">
							<div class="modal-content">
								<div class="modal-header">
									<center><h3 style="margin:0;">Purchase Completed!</h3></center>
								</div>
								<div class="modal-body">
									<div id="progress-bar" class="progress progress-striped" style="margin-bottom:0;">
										<div class="progress-bar progress-bar-success" style="width: 100%">
										</div>
									</div>
								</div>
								<center>
									<p>Thanks for your purchase! You have succesfully received your subscription package.</p>
									<p>Visit the <a href="generator.php">Generator Page</a> to start generating.</p></br>
								</center>
							</div>
						</div>
					  </div>
				';
			  }
		  }
		  ?>
		  
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
	<?php
	if($_GET['action'] == "buy-success"){
		echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#buy-success').modal('show');
				});
			  </script>"
		;
	}
	?>
	
	        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>
	</body>
</html>