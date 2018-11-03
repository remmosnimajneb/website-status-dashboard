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
* Cron Job Page
* Auto Check Status every 10 minutes and update DB, if Status is Down twice in a row, send an alert email
*/

//Check this is running CLI
(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die('Invalid Request!');

//Require Functions Page
require 'functions.php';

// Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

//Get all sites
$sql = "SELECT * FROM `websites`";
$stm = $con->prepare($sql);
$stm->execute();
$records = $stm->fetchAll();
foreach ($records as $row) {
	//Case 1 - Site is up
	//Case 2 - Site is Down but lastStatus != down
	//Case 3 - Site is Down and lastStatus == Down 
	if(getStatus($row['domain']) == 1){
		$sql = "UPDATE `websites` SET `lastSeen` = '" . date(DATE_RFC822) . "', `lastStatus` = 'Up', `emailSent` = 'false' WHERE `WebsiteID` = " . $row['WebsiteID'];
		$stm = $con->prepare($sql);
		$stm->execute();
		$msg = "Success! Able to reach domain: '" . $row['domain'] . "' at " . date(DATE_RFC822) . "\n";
		$file = file_put_contents('error.txt', $msg.PHP_EOL , FILE_APPEND | LOCK_EX);
	} else if(getStatus($row['domain']) == 0 && $row['lastStatus'] != "Down") {
		$sql = "UPDATE `websites` SET `lastError` = '" . date(DATE_RFC822) . "', `lastStatus` = 'Down' WHERE `WebsiteID` = " . $row['WebsiteID'];
		$stm = $con->prepare($sql);
		$stm->execute();
		$msg = "Error unable to reach domain '" . $row['domain'] . "' at " . date(DATE_RFC822) . "\n";
		$file = file_put_contents('error.txt', $msg.PHP_EOL , FILE_APPEND | LOCK_EX);
	} else if(getStatus($row['domain']) == 0 && $row['lastStatus'] == "Down"){
		//Check if Email was previously sent
			if($row['emailSent'] != "true"){
				try{
				    $mail = new PHPMailer(true); // Passing `true` enables exceptions
				    //Server settings
				    $mail->SMTPDebug = 0;      // Enable verbose debug output [0 is Disable, 2 is Show all]
		            $mail->isSMTP();
				    $mail->Host = $smtp_host;
				    $mail->SMTPAuth = $smtp_authentication;
				    $mail->Username = $smtp_username;
				    $mail->Password = $smtp_password;
				    $mail->SMTPSecure = $smtp_encryption;
				    $mail->Port = $smtp_port;

				    //Recipients
				    $mail->setFrom($email_from_addr);
				    $mail->addAddress($email_to);

				    //Content
				    $mail->isHTML(true); // Set email format to HTML
				    $mail->Subject = "Website Error! Unable to reach Website: " . $row['domain'];
				    $mail->Body = "This is an automated warning, we tried to reach " . $row['domain'] . " twice and were unable to do so. It was last seen at " . $row['lastSeen'];
				    $mail->send();
				} catch (Exception $e) {
				    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo . '<br />';
				}
			}
			//Then just update SQL and Add to Error Log
		$sql = "UPDATE `websites` SET `lastError` = '" . date(DATE_RFC822) . "', `lastStatus` = 'Down', `emailSent` = 'true' WHERE `WebsiteID` = " . $row['WebsiteID'];
		$stm = $con->prepare($sql);
		$stm->execute();
		$msg = "Error unable to reach domain '" . $row['domain'] . "' at " . date(DATE_RFC822) . "\n";
		$file = file_put_contents('error.txt', $msg.PHP_EOL , FILE_APPEND | LOCK_EX);
	}
}
?>
