<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$MAIL_MAILER = $_ENV['MAIL_MAILER'];
$MAIL_HOST = $_ENV['MAIL_HOST'];
$MAIL_PORT = $_ENV['MAIL_PORT'];
$MAIL_USERNAME = $_ENV['MAIL_USERNAME'];
$MAIL_PASSWORD = $_ENV['MAIL_PASSWORD'];
$MAIL_ENCRYPTION = $_ENV['MAIL_ENCRYPTION'];
$MAIL_FROM_ADDRESS = $_ENV['MAIL_FROM_ADDRESS'];
$MAIL_FROM_NAME = $_ENV['MAIL_FROM_NAME'];
var_dump($MAIL_FROM_NAME);

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $subject = $_POST['msg_subject'];
    $body = $_POST['message'];

$mail = new PHPMailer(true);

try {
	// $mail->SMTPDebug = 2;									
	$mail->isSMTP();										
	$mail->Host	 = $MAIL_HOST;				
	$mail->SMTPAuth = true;							
	$mail->Username = $MAIL_USERNAME ;				
	$mail->Password = $MAIL_PASSWORD;					
	$mail->SMTPSecure = $MAIL_ENCRYPTION;							
	$mail->Port	 = $MAIL_PORT;

	$mail->setFrom($MAIL_FROM_ADDRESS,$MAIL_FROM_NAME);		
	$mail->addAddress('wd.nileshh@gmail.com');
	$mail->addAddress('wd.lalit@gmail.com');
	$mail->addAddress($MAIL_FROM_ADDRESS);
	
	$mail->isHTML(true);								
	$mail->Subject = $subject;
	$mail->Body = $body . "<br><br>Name: " . $name . "<br>Email: " . $email."<br>phone: " . $phone;
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
	sleep(10); // Delay for 10 seconds
header("Location: index.php");
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
