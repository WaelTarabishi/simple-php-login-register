<?php

class AuthService
{
    private SessionManager $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function isLoggedIn(): bool
    {
        return $this->sessionManager->has('user_id');
    }

    public function login(array $user): void
    {
        $this->sessionManager->regenerateId();
        $this->sessionManager->put('user_id', (int) $user['id']);
        $this->sessionManager->put('full_name', $user['full_name']);
        $this->sessionManager->put('email', $user['email']);
    }

    public function logout(): void
    {
        $this->sessionManager->destroy();
    }

    public function getUserId(): ?int
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return (int) $this->sessionManager->get('user_id');
    }
}
