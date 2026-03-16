<?php

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function login(array $user): void
    {
        session_regenerate_id(true);

        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                (bool) $params['secure'],
                (bool) $params['httponly']
            );
        }

        session_destroy();
    }

    public function requireGuestRedirect(string $location): void
    {
        if ($this->isLoggedIn()) {
            header('Location: ' . $location);
            exit;
        }
    }

    public function requireAuthRedirect(string $location): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: ' . $location);
            exit;
        }
    }

    public function getUserId(): ?int
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return (int) $_SESSION['user_id'];
    }

    public function getCurrentUser(): ?array
    {
        $userId = $this->getUserId();

        if ($userId === null) {
            return null;
        }

        return $this->userRepository->findById($userId);
    }
}
