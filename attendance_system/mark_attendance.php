<?php
session_start();
include('config/db.php');
if (!isset($_SESSION['username'])) header("Location: index.php");

$username = $_SESSION['username'];
$user = $conn->query("SELECT id FROM users WHERE username='$username'")->fetch_assoc();
$user_id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $date = date('Y-m-d');

    // Prevent duplicate entries
    $check = $conn->query("SELECT * FROM attendance WHERE user_id=$user_id AND date='$date'");
    if ($check->num_rows === 0) {
        $conn->query("INSERT INTO attendance (user_id, date, status) VALUES ($user_id, '$date', '$status')");
        $msg = "Attendance marked!";
    } else {
        $msg = "You already marked today's attendance.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
   <div class="container">
   <h2 style="color: #e2b714;">Mark Attendance</h2>
    <form method="post">
        <label>
            <input type="radio" name="status" value="Present" required> Present
        </label>
        <label>
            <input type="radio" name="status" value="Absent" required> Absent
        </label><br><br>
        <input type="submit" value="Submit">
    </form>
    <p><?= isset($msg) ? $msg : '' ?></p>
    <a href="dashboard.php">Back to Dashboard</a>
   </div>
</body>
</html>
