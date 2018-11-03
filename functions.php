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
* Functions Page
*/

/*
* MySQL Connection Information
*/
$con = new PDO("mysql:host={DB_HOST};dbname={DB_NAME}", "{DB_USER}", "{DB_PASS}");

/*
* Website Title
*/
$web_title = "Website Status System";

/*
* Admin Credentials
*/
$adminUsername = "admin";
$adminPassword = "admin";

/*
* Should main Status page need to be logged in to access or public?
*/
$allow_status_public = true;

/*
* Footer Text
*/
$footer = '<a href="https://sommertechs.com" target="_blank">Built by Sommer Technologies</a> | <a href="https://pixelarity.com" target="_blank">Template by Pixelarity</a>';

/*
* SMTP Settings
* For help see: https://github.com/PHPMailer/PHPMailer/
*/
$smtp_host = "smtp.example.com";
$smtp_authentication = true; //{true or false}
$smtp_username = "";
$smtp_password = "";
$smtp_encryption = "ssl"; //{'ssl' or 'tls'}
$smtp_port = ;
$email_from_addr = "";
$email_to = "";

/*
* Check SESSION Authentication
*/
session_start();
function checkAuth(){
	if($_SESSION['website_status_system'] != true){
		header('Location: login.php');
		die();
	};
}

/*
* Actual function to get Website Up or Down
*/
function getStatus($host){
	if($socket =@ fsockopen($host, 80, $errno, $errstr, 30)) {
		fclose($socket);
		return 1;
	} else {
		return 0;
	}
}

/*
* Safe input to MySQL
*/
function safesql($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
