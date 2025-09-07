<?php
session_start();
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // You can use password_hash for better security

    // Check if username already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username already exists.";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            $success = "Registration successful! Redirecting to login...";
            header("Refresh:2; url=index.php");
        } else {
            $error = "Error creating user.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
    <h2 style="color: #e2b714;">Sign In</h2>
    <?php 
        if (isset($error)) echo "<p style='color:red;'>$error</p>";
        if (isset($success)) echo "<p style='color:green;'>$success</p>"; 
    ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
</body>
</html>
