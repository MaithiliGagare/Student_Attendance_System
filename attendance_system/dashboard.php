<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    <h2 style="color: #d1d0c5;">Welcome, <?= $_SESSION['username']; ?>!</h2>
    <a href="mark_attendance.php">Mark Attendance</a><br><br>
    <a href="view_attendance.php">View Attendance</a><br><br>
    <a href="logout.php">Logout</a>
    </div>
</body>
</html>
