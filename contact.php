<?php



require_once "Mail.php";
// Change this options:
$username = 'user@gmail.com';
$password = 'password';
$smtpHost = 'ssl://smtp.gmail.com';
$smtpPort = '465';
$to = 'max.palmer.ball@gmail.com';
$from = 'user@gmail.com';

$subject = 'Contact Form';
$successMessage = 'Message successfully sent!';

$replyTo = $_POST['your-email'];
$name = $_POST['your-name'];
$body = $_POST['your-message'];

$headers = array(
	'From' => $name . " <" . $from . ">",
	'Reply-To' => $name . " <" . $replyTo . ">",
	'To' => $to,
	'Subject' => $subject
);
$smtp = Mail::factory('smtp', array(
	'host' => $smtpHost,
	'port' => $smtpPort,
	'auth' => true,
	'username' => $username,
	'password' => $password
));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
	echo ($mail->getMessage());
} else {
	echo ($successMessage);
}
