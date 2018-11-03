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
* Add/Edit Domain Page
*/

//Require Functions Page
require 'functions.php';

//Check Authentication
	checkAuth();

//Check if we're updating something
	$msg = "";
	if(isset($_REQUEST['formType'])){
		if(isset($_POST['formType']) && $_POST['formType'] == "add"){
			$sql = "INSERT INTO `websites` (domain, lastSeen, lastError, lastStatus) VALUES ('" . safesql($_POST['domain']) . "', 'Not Checked Yet', 'Not Checked Yet', 'Not Checked Yet')";
			$stm = $con->prepare($sql);
			$stm->execute();
			if($stm){
				$msg = "Domain Add Success!";
			}
		} else if(isset($_POST['formType']) && $_POST['formType'] == "edit"){
			$sql = "UPDATE `websites` SET `domain` = '" . safesql($_POST['newDomain']) . "' WHERE `domain` = '" . safesql($_POST['oldDomain']) . "'";
			$stm = $con->prepare($sql);
			$stm->execute();
			if($stm){
				$msg = "Domain Update Success!";
			}
		} else if($_GET['formType'] == "delete"){
			$sql = "DELETE FROM `websites` WHERE `domain` = '" . safesql($_GET['domain']) . "'";
			$stm = $con->prepare($sql);
			$stm->execute();
			if($stm){
				$msg = "Domain Delete Success!";
			}
		};
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
							<p><?php echo $msg; ?></p>
						</header>
							<a href="index.php"><button>Home</button></a>
								<br /><br /><hr />
						<?php
							if(isset($_GET['action']) == "edit"){
								echo '<h3>Edit Domain</h3>';
								echo '<form action="domains.php" method="POST">
										<input type="hidden" name="formType" value="edit">
										<input type="hidden" name="oldDomain" value="' . $_GET['domain'] . '">
										<input type="text" name="newDomain" required="required" placeholder="Domain Name" value="' . $_GET['domain'] . '"><br />
										<input type="submit" name="submit" value="Edit">
									</form>';
								echo '<hr />';
							}
						?>
						<h3>Add new Domain</h3>
							<form action="domains.php" method="POST">
								<input type="hidden" name="formType" value="add">
								<input type="text" name="domain" required="required" placeholder="Domain Name"><br />
								<input type="submit" name="submit" value="Add">
							</form>
						<table>
								<hr />
						  <caption>Edit Domain</caption>
						  <thead>
						    <tr>
						      <th scope="col">Domain</th>
						      <th scope="col">Edit</th>
						      <th scope="col">Delete</th>
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
										echo "<td data-label='Domain'>" . $row['domain'] . "</td>";
										echo "<td data-label='Edit'><a href='domains.php?action=edit&domain=" . $row['domain'] . "'>Edit</a></td>";
										echo "<td data-label='Delete'><a href='domains.php?formType=delete&domain=" . $row['domain'] . "'>Delete</a></td>";
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