<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>window.location="projectlogin.php"</script>';
}
$code = rand(10000, 100000);

$_SESSION['code'] = $code;

//include required php files
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Create instance of phpmailer
$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//define smtp host
$mail->Host = "smtp.gmail.com";
//enable smtp authentication
$mail->SMTPAuth = "true";
//set type of encryption(ssl/tls)
$mail->SMTPSecure = "tls";
//set port to connect smtp
$mail->Port = "587";
//set gmail username
$mail->Username = "cashcheck0707@gmail.com";
//set gmail password
$mail->Password = "xwku nbgs eolr xviw";
//Set email subject
$mail->Subject = "Verification Code--> " . $code;
//set sender email
$mail->setFrom("cashcheck0707@gmail.com");
//Email Body
$mail->Body = "Cash Check Password Update Verification Code--> " . $code;
//Add recipient
$mail->addAddress("{$_SESSION['email']}");
//Finally send email
if ($mail->send()) {

    echo '<script>alert("A verification code has been send to your email");
    window.location="codecheck3.php";
    </script>';
} else {
    echo '<script>alert("Could not send verification code")</script>';
}
//Closing smtp
$mail->smtpClose();
