<?php
session_start();
include('config/db.php');

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $hashed = md5($password);
        $sql = "UPDATE users SET password='$hashed', first_login=0 WHERE username='$username'";
        if (mysqli_query($conn, $sql)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error updating password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Set Your Password</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
    <h2>Set Your Password</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="password" name="password" placeholder="New Password" required><br><br>
        <input type="password" name="confirm" placeholder="Confirm Password" required><br><br>
        <input type="submit" value="Set Password">
    </form>
    </div>
</body>
</html>
