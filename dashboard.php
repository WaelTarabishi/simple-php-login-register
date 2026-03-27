<?php
$app = require __DIR__ . '/bootstrap.php';

$authService = $app['authService'];
$currentUserService = $app['currentUserService'];

if (!$authService->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = $currentUserService->getCurrentUser();

if ($user === null) {
    $authService->logout();
    header('Location: login.php');
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
    <p class="subtitle">Your account details are shown below.</p>
    <p>You are logged in.</p>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

    <a class="btn" href="index.php">Go to Home</a>
    <div class="links">
        <a href="logout.php">Logout</a>
    </div>
</div>
</body>
</html>
