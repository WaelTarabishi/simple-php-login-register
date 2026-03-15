<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Simple User System</h2>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Welcome back, <strong><?php echo htmlspecialchars($_SESSION['full_name']); ?></strong></p>
        <a class="btn" href="dashboard.php">Go to Dashboard</a>
        <div class="links">
            <a href="logout.php">Logout</a>
        </div>
    <?php else: ?>
        <p>This is a beginner login and registration project.</p>
        <a class="btn" href="register.php">Register</a>
        <div class="links">
            <a href="login.php">Already have an account? Login</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
