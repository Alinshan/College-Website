<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = ''; // Replace with your Gmail
    $mail->Password   = ''; // Use an App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Email settings
    $mail->setFrom('', 'Your Name');// Replace with your Gmail
    $mail->addAddress('', 'Recipient Name');// Replace with Recipient Gmail
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent using PHPMailer.';

    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>
