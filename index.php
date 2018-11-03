<?php
/********************************
* Project: Website Status Checker
* Code Version: 1.5
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

//Check Authentication
	//Check if Authentication is enabled
	if($allow_status_public){
		checkAuth();
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $web_title ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<a href="index.php" class="logo"><strong><?php echo $web_title ?></strong></a>
					</header>

				<!-- Section -->
					<section class="main">
						<header class="invert accent2">
							<h1><?php echo $web_title ?></h1>
						</header>
							<?php if(isset($_SESSION['website_status_system']) == true) { echo '<a href="domains.php"><button>Add/Edit Domains</button></a>'; }; ?>
						<table>
						  <caption>Status</caption>
						  <thead>
						    <tr>
						      <th scope="col">Website Domain</th>
						      <th scope="col">Current Status</th>
						      <th scope="col">Last Checked</th>
						      <th scope="col">Last Error</th>						      
						    </tr>
						  </thead>
						  <tbody>
						  	<?php
						  		//Get all sites
						  		$sql = "SELECT * FROM `websites`";
						  		$stm = $con->prepare($sql);
								$stm->execute();
								$records = $stm->fetchAll();
								foreach ($records as $row) {
									echo "<tr>";
										echo "<td data-label='Website Domain'>" . $row['domain'] . "</td>";
										echo "<td data-label='Current Status'>";
											if(getStatus($row['domain'])){
												echo "<span class='up'></span> - Up";
											} else {
												echo "<span class='down'></span> - Down";
											}
										echo "</td>";
										echo "<td data-label='Last Checked'>" . $row['lastSeen'] . "</td>";
										echo "<td data-label='Last Error'>" . $row['lastError'] . "</td>";
									echo "</tr>";
								}
						  	?>
						   
						  </tbody>
						</table>
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