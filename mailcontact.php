<?php
session_start();
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

$mail->Subject = "User Feedback/Grievance from {$_SESSION['cname']}";

//set sender email
$mail->setFrom("cashcheck0707@gmail.com");
//Email Body
$mail->IsHTML(true);
$mail->Body = "<p style='font-size:20px;font-family:Times New Roman;color:black'>{$_SESSION['cmsg']}</p> \n {$_SESSION['email']}";
$mail->AltBody = "{$_SESSION['cmsg']}";
//Add recipient
$mail->addAddress("cashcheck0707@gmail.com");
//Finally send email
if ($mail->send()) {

    echo '<script>
    alert("Your response has been recorded");
    window.location="contact.php";
</script>';
} else {
    echo '<script>
    alert("Due to technical glitch we could not send your response")
</script>';
}
//Closing smtp
$mail->smtpClose();
