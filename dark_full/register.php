<?php

ob_start();

if(file_exists("install.php") == "1"){
	header('Location: install.php');
	exit();
}

include 'inc/database.php';

$result = mysqli_query($con, "SELECT * FROM `settings` LIMIT 1") or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result)){
	$website = $row['website'];
	$favicon = $row['favicon'];
}

if (!isset($_SESSION)) { 
	session_start(); 
}

if (isset($_SESSION['username'])) {
	header('Location: index.php');
	exit();
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmpassword']) && isset($_POST['email'])){

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, md5($_POST['password']));
	$confirmpassword = mysqli_real_escape_string($con, md5($_POST['confirmpassword']));
	$email = mysqli_real_escape_string($con, $_POST['email']);
	
	if($password != $confirmpassword){
		die("The confirmation password was not equal to the password.");
	}
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("The email entered was not correct.");
    }
	
	$result = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '$username'") or die(mysqli_error($con));
	if(mysqli_num_rows($result) > 0){
		die("This username already exists.");
	}
	
	$result = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'") or die(mysqli_error($con));
	if(mysqli_num_rows($result) > 0){
		die("This email already exists.");
	}
	
	$ip = mysqli_real_escape_string($con, $_SERVER['REMOTE_ADDR']);
	$date = date('Y-m-d');
	
	mysqli_query($con, "INSERT INTO `users` (`username`, `password`, `email`, `date`, `ip`) VALUES ('$username', '$password', '$email', '$date', '$ip')") or die(mysqli_error($con));
	
	header("Location: login.php?action=registered");
	
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="#1 account Generator out known for great hard working team that never gives up!">
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
	<body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">
				<div class="panel-heading">
					<h3 class="text-center"> Sign Up to <strong class="text-custom">Universal Gen</strong> </h3>
				</div>

				<div class="panel-body">
					<form class="form-horizontal m-t-20" action="register.php" method="POST">

						<div class="form-group ">
							<div class="col-xs-12">
							<input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<input type="password" id="password" name="password" class="form-control" placeholder="Password">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12">
							<input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password">
							</div>
						</div>
						
						<div class="form-group ">
							<div class="col-xs-12">
								<input type="text" id="email" name="email" class="form-control" placeholder="Email">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<div class="checkbox checkbox-primary">
									<input id="checkbox-signup" type="checkbox" required="" checked="checked">
									<label for="checkbox-signup">I accept <a data-toggle="modal" data-target="#TOS">Terms and Conditions</a></label>
								</div>
							</div>
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
									Register
								</button>
							</div>
						</div>

					</form>

				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 text-center">
					<p>
						Already have account?<a href="login.php" class="text-primary m-l-5"><b>Sign In</b></a>
					</p>
				</div>
			</div>

		</div>
           <!--T.O.S-->
		   <div id="TOS" class="modal fade" role="dialog">
               <div class="modal-dialog">

    
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Universal Generator T.O.S!</h4>
      </div>
      <div class="modal-body">
      <b>Terms of Service</b>
<p>• No account sharing "Leads to ban"</p>
<p>• We may remove sites at our discretion with or without notice</p>
<p>• We have the right to ban users for any reason, if we deem necessary</p>
<p>• No refunds, at all</p>
<p>• We may shut down this service temporarily or permanently at any time with or without notice</p>
<p>• We reserve the right to change these terms at any time with or without notice</p>
<p>• NO Reversing/Disputing Paypal payments. "if you dispute we hold your 'ip' 'Paypal email' and your 'username' and 'operating system' for case matters"</p>
	
	<b></b>
    <p>
      </p></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
	<!--T.O.S/-->
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