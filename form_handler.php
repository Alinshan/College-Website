<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Database Connection
$servername = "localhost";
$username = "root";  // Default XAMPP MySQL username
$password = "";  // Default XAMPP MySQL password (empty)
$dbname = "gpcm_contact";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP Server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'soorajknair666@gmail.com';  // Your Gmail
            $mail->Password   = 'yhgh lpsy pazu lbwe';  // App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Email Settings
            $mail->setFrom($email, $name);
            $mail->addAddress('roooy6666@gmail.com', 'Website Authority');  
            $mail->Subject = "New Contact Form Message from $name";
            $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

            $mail->send();
            echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error sending email: {$mail->ErrorInfo}'); window.location.href='contact.html';</script>";
        }
    } else {
        echo "<script>alert('Error saving message to database!'); window.location.href='contact.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
