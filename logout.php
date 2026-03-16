<?php
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/UserRepository.php';
require_once __DIR__ . '/classes/AuthService.php';

$db = new Database();
$conn = $db->getConnection();
$userRepository = new UserRepository($conn);
$authService = new AuthService($userRepository);
$authService->logout();

header('Location: login.php');
exit;
?>
