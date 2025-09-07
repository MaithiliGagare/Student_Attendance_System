<?php
session_start();
include('config/db.php');
if (!isset($_SESSION['username'])) header("Location: index.php");

$username = $_SESSION['username'];
$user = $conn->query("SELECT id FROM users WHERE username='$username'")->fetch_assoc();
$user_id = $user['id'];

$result = $conn->query("SELECT * FROM attendance WHERE user_id=$user_id ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        table {
            border-collapse: collapse;
            justify-content: space-around;
        }

        th, td {
            padding: 20px;
            padding-left: 25px;
            padding-right: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2 style="color: #e2b714;">Attendance Records for <?= $_SESSION['username']; ?> </h2>
    <table border="1">
        <tr>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
