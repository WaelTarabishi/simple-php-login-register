<?php

require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/UserRepositoryInterface.php';
require_once __DIR__ . '/classes/UserRepository.php';
require_once __DIR__ . '/classes/SessionManagerInterface.php';
require_once __DIR__ . '/classes/SessionManager.php';
require_once __DIR__ . '/classes/AuthService.php';
require_once __DIR__ . '/classes/CurrentUserService.php';
require_once __DIR__ . '/classes/LoginValidator.php';
require_once __DIR__ . '/classes/RegisterValidator.php';

$databaseConfig = require __DIR__ . '/config/database.php';

$database = new Database(
    $databaseConfig['host'],
    $databaseConfig['username'],
    $databaseConfig['password'],
    $databaseConfig['database']
);

$userRepository = new UserRepository($database->getConnection());
$sessionManager = new SessionManager();
$authService = new AuthService($sessionManager);
$currentUserService = new CurrentUserService($authService, $userRepository);

return [
    'database' => $database,
    'userRepository' => $userRepository,
    'sessionManager' => $sessionManager,
    'authService' => $authService,
    'currentUserService' => $currentUserService,
    'loginValidator' => new LoginValidator(),
    'registerValidator' => new RegisterValidator(),
];
