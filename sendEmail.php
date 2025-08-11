<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = htmlspecialchars(trim($_POST["contactName"]));
    $email = filter_var(trim($_POST["contactEmail"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["contactMsg"]));


    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'monirul.01401411046@gmail.com'; // Your Gmail
        $mail->Password   = 'cbwe vcih xcts qdpi';   // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);             // From form
        $mail->addAddress('monirul.01401411046@gmail.com');  // Where you want to receive messages

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<strong>Name:</strong> $name<br>
                          <strong>Email:</strong> $email<br><br>
                          <strong>Message:</strong><br>$message";

        // Send
        $mail->send();
        // echo "✅ Message has been sent successfully!";
    } catch (Exception $e) {
        // echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
