<?php
require_once __DIR__ . '/PHPMailer/SMTP.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/Exception.php';

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $message)
{
    $mail = new PHPMailer(true);
    try {
        //settings
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '6a28cdced9467e';
        $mail->Password = 'd9b0a0ebc86b64';

        $mail->setFrom('no_reply@onlineappetite.com', 'OnlineAppetite');

        //recipient
        $mail->addAddress($to);

        //content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        die();
    }
}
