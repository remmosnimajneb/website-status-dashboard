<?php
/********************************
* Project: Website Status Checker
* Code Version: 1.0
* Author: Benjamin Sommer
* GitHub: https://github.com/remmosnimajneb
* Theme Design by: Pixelarity [Pixelarity.com] - Theme `Transit`
* Licensing Information: pixelarity.com/license
***************************************************************************************/

/*
* Index Page
*/

//Require Functions Page
require 'functions.php';

//Start Sessions()
session_start();

//Assume User is logging in for first time and set the Authentication Session False
$_SESSION['website_status_system'] = false;

//If it's a post request, he tried logging in
$error = '';
if(isset($_POST['username']) && isset($_POST['password'])){
		//If credentials match (credentials set in functions.php), set Session, Go to admin.php
	if($_POST['username'] == $adminUsername && $_POST['password'] == $adminPassword){
		$_SESSION['website_status_system'] = true;
		header('Location: index.php');
	} else {
			//Else throw an error!
		$error = "Error! Authentication Failed. Please try again!";
	}
};

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login | <?php echo $web_title ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<a href="index.html" class="logo"><strong><?php echo $web_title ?></strong></a>
					</header>

				<!-- Section -->
					<section class="main">
						<header class="invert accent2">
							<h1>Login</h1>
							<?php echo $error ?>
						</header>
							<form action="login.php" method="POST">
								<input type="text" name="username" placeholder="Username" required="required" style="margin: auto;"><br />
								<input type="password" name="password" placeholder="Password" required="required" style="margin: auto;"><br />
								<input type="submit" name="Submit" value="Login">
							</form>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright"><?php echo $footer; ?></p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>