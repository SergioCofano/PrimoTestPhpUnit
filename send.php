<?php
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'EmailSender.php'; // Assicurati che il percorso sia corretto

use PrimoTestPhpUnit\EmailSender;

if(isset($_POST["send"])) {
    $emailSender = new EmailSender();
    $to = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $result = $emailSender->sendEmail($to, $subject, $message);

    if ($result) {
        header("Location: success.php"); // Reindirizza a una pagina di successo
        exit();
    } else {
        echo "Failed to send email.";
    }
}
?>