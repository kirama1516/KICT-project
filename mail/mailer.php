<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/kict-project/vendor/autoload.php';

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

// SMTP Configuration (adjust based on your email provider)
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Username = "abdullahifarukadam2001@gmail.com";
$mail->Password = "pntjlvtkalarzqsu";

// Email content
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

return $mail;
