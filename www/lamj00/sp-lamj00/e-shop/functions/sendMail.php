<?php

require_once "PHPmailer/PHPMailer.php";
require_once "PHPmailer/SMTP.php";
require_once "PHPmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($address, $Subject, $body, $attachment = ""): string
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "componentoro@gmail.com";
    $mail->Password = "Penis21Penis21";
    $mail->Subject = $Subject;
    $mail->setFrom('no-reply@componentoro.com');
    $mail->isHTML(true);
    $mail->Body = $body;
    $mail->addAddress($address);
    if ($attachment)
        $mail->AddAttachment($attachment, $name = 'invoice.pdf', $encoding = 'base64', $type = 'application/pdf');
    $return = "";
    if ($mail->send()) {
        $return = "Email Sent..!";
    } else {
        $return = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
    $mail->smtpClose();
    return $return;
}
