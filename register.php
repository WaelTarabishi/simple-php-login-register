<?php
$app = require __DIR__ . '/bootstrap.php';

$userRepository = $app['userRepository'];
$authService = $app['authService'];
$validator = $app['registerValidator'];

$authService->requireGuestRedirect('dashboard.php');

$error = '';
$success = '';
$fullName = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $errors = $validator->validate($fullName, $email, $password);

    if (!empty($errors)) {
        $error = $errors[0];
    } elseif ($userRepository->findByEmail($email) !== null) {
        $error = 'Email is already registered.';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($userRepository->create($fullName, $email, $hashedPassword)) {
            $success = 'Registration successful. You can now login.';
            $fullName = '';
            $email = '';
        } else {
            $error = 'Something went wrong. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <p class="subtitle">Create your account to access the dashboard.</p>

    <?php if ($error !== ''): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($success !== ''): ?>
        <div class="message success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="full_name" placeholder="Full Name" autocomplete="name" value="<?php echo htmlspecialchars($fullName); ?>">
        <input type="email" name="email" placeholder="Email" autocomplete="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="password" name="password" placeholder="Password" autocomplete="new-password">
        <button type="submit">Create Account</button>
    </form>

    <div class="links">
        <a href="login.php">Already have an account? Login</a><br>
        <a href="index.php">Back to Home</a>
    </div>
</div>
</body>
</html>
