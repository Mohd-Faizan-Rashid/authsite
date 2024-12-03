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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Edit Profile</h1>
        <nav>
            <a href="welcome.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <form id="profile-form">
            <div>
                <label for="displayName">Display Name:</label>
                <input type="text" id="displayName" value="<?php echo $_SESSION['user']['displayName'] ?? ''; ?>">
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </main>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="app.js"></script>
</body>
</html>
