<?php
$app = require __DIR__ . '/bootstrap.php';

$userRepository = $app['userRepository'];
$authService = $app['authService'];
$validator = $app['loginValidator'];


// function just for redreicting logged in users away from login page
$authService->requireGuestRedirect('dashboard.php');

$error = '';
$email = $_COOKIE['remembered_email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $errors = $validator->validate($email, $password);

    if (!empty($errors)) {
        $error = $errors[0];
    } else {
        $user = $userRepository->findByEmail($email);

        if ($user === null) {
            $error = 'No account found with this email.';
        } elseif (!password_verify($password, $user['password'])) {
            $error = 'Incorrect password.';
        } else {
            $authService->login($user);

            setcookie('remembered_email', $user['email'], time() + (86400 * 30), '/', '', false, true);

            header('Location: dashboard.php');
            // critical 
            exit;
        }
    }
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
<div class="container">
    <h2>Login</h2>
    <p class="subtitle">Sign in to continue to your account.</p>

    <?php if ($error !== ''): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" autocomplete="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="password" name="password" placeholder="Password" autocomplete="current-password">
        <button type="submit">Login</button>
    </form>

    <div class="links">
        <a href="register.php">Create new account</a><br>
        <a href="index.php">Back to Home</a>
    </div>
</div>
</body>
</html>
