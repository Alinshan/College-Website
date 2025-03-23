<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.html");
    exit();
}

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = $_POST["department"];
    $lecture_name = $_POST["lecture_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("INSERT INTO lectures (department, lecture_name, phone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $department, $lecture_name, $phone, $email);
    $stmt->execute();
    header("Location: admin_dashboard.php");
}
?>
