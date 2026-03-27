<?php

require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/UserRepositoryInterface.php';
require_once __DIR__ . '/classes/UserRepository.php';
require_once __DIR__ . '/classes/AuthService.php';
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
$authService = new AuthService($userRepository);

return [
    'database' => $database,
    'userRepository' => $userRepository,
    'authService' => $authService,
    'loginValidator' => new LoginValidator(),
    'registerValidator' => new RegisterValidator(),
];
