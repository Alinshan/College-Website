<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.html");
    exit();
}

include 'db_connect.php';
$id = $_GET["id"];

$conn->query("DELETE FROM lectures WHERE id = $id");
header("Location: admin_dashboard.php");
?>
