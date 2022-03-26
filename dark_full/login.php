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

if(isset($_POST['username']) && isset($_POST['password'])){

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, md5($_POST['password']));
	
	$result = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '$username'") or die(mysqli_error($con));
	if(mysqli_num_rows($result) < 1){
		header("Location: login.php?error=incorrect-password");
	}
	while($row = mysqli_fetch_array($result)){
		if($password != $row['password']){
			header("Location: login.php?error=incorrect-password");
		}elseif($row['status'] == "0"){
			header("Location: login.php?error=banned");
		}else{
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $row['email'];
			$_SESSION['rank'] = $row['rank'];
			header("Location: index.php");
		}
	}
	
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
                <h3 class="text-center"> Sign In to <strong class="text-custom">Universal Gen</strong> </h3>
            </div> 

            <div class="panel-body">
            <form class="form-horizontal m-t-20" action="login.php" method="POST">
                
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="username" id="username" required="" placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password" type="password" id="password" required="" placeholder="Password">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="#" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                </div>
            </form> 
            
            </div>   
            </div>                              
                <div class="row">
            	<div class="col-sm-12 text-center">
            		<p>Don't have an account? <a href="register.php" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        
                    </div>
            </div>
            
        </div>
        
        

        
    	<script>
            var resizefunc = [];
        </script>
<?php 
	if($_GET['error'] == "banned"){
		echo '
			<div class="modal fade" id="error" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 15%; overflow-y: visible; display: none;">
				<div class="modal-dialog modal-sm">
					<div class="modal-content panel-danger">
						<div class="modal-header panel-heading">
							<center><h3 style="margin:0;"><i class="icon-warning-sign"></i> Error!</h3></center>
						</div>
						<div class="modal-body">
							<center>
								<strong>Your account has been banned.</strong>
							</center>
						</div>
					</div>
				</div>
			</div>
		';
	}

	if($_GET['error'] == "incorrect-password"){
		echo '
			<div class="modal fade" id="error" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 15%; overflow-y: visible; display: none;">
				<div class="modal-dialog modal-sm">
					<div class="modal-content panel-danger">
						<div class="modal-header panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<center><h3 style="margin:0;"><i class="icon-warning-sign"></i> Error!</h3></center>
						</div>
						<div class="modal-body">
							<center>
								<strong>The password you entered was not correct.</strong>
							</center>
						</div>
					</div>
				</div>
			</div>
		';
	}
	
	if($_GET['error'] == "not-logged-in"){
		echo '
			<div class="modal fade" id="error" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 15%; overflow-y: visible; display: none;">
				<div class="modal-dialog modal-sm">
					<div class="modal-content panel-warning">
						<div class="modal-header panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<center><h3 style="margin:0;"><i class="icon-warning-sign"></i> Error!</h3></center>
						</div>
						<div class="modal-body">
							<center>
								<strong>You must be logged in to do that.</strong>
							</center>
						</div>
					</div>
				</div>
			</div>
		';
	}
	?>
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
	if(isset($_GET['error'])){
		echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#error').modal('show');
				});
			  </script>"
		;
	}
	?>
	</body>
</html>