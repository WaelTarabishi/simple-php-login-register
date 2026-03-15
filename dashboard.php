<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Dashboard</h2>
    <p>You are logged in.</p>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['full_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>

    <a class="btn" href="index.php">Go to Home</a>
    <div class="links">
        <a href="logout.php">Logout</a>
    </div>
</div>
</body>
</html>
