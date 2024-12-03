<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: welcome.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form id="login-form">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p><a href="reset_password.php">Forgot password?</a></p>
    </main>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="app.js"></script>
</body>
</html>
