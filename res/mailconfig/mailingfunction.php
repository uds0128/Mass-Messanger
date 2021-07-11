<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require('../../../vendor/autoload.php');
// require 'vendor/autoload.php';
require 'mailingvariables.php';

function mailfunction($fname, $mname, $lname, $email, $contactno, $subject, $mail_body){

    $mail = new PHPMailer();
    $mail->isSMTP();

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->Host = $GLOBALS['mail_host'];

    $mail->Port = $GLOBALS['mail_port'];

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->SMTPAuth = true;

    $mail->Username = $GLOBALS['mail_sender_email'];

    $mail->Password = $GLOBALS['mail_sender_password'];

    $mail->setFrom($GLOBALS['mail_sender_email'], $GLOBALS['mail_sender_name']);


    $mail->addAddress($email, $fname." ".$mname." ".$lname);

    $mail->Subject = $subject;

    $mail->isHTML($isHTML = true);

    $mail->msgHTML($mail_body);

    $mail->AltBody = 'This is a plain-text message body';
 
    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}


//mailfunction('19ce128@charusat.edu.in', "Testing Mailin", "Uddhav");

?>