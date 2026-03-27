<?php
$app = require __DIR__ . '/bootstrap.php';

$authService = $app['authService'];
$authService->logout();

header('Location: login.php');
exit;
?>
