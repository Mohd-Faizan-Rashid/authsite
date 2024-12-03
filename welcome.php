<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome</h1>
        <nav>
            <a href="profile.php">Edit Profile</a>
            <a href="reset_password.php">Reset Password</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <p>Welcome to your account, <span id="user-email"><?php echo $_SESSION['user']['email']; ?></span>!</p>
    </main>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="app.js"></script>
</body>
</html>
