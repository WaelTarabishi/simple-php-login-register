<?php

class CurrentUserService
{
    private AuthService $authService;
    private UserRepositoryInterface $userRepository;

    public function __construct(AuthService $authService, UserRepositoryInterface $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    public function getCurrentUser(): ?array
    {
        $userId = $this->authService->getUserId();

        if ($userId === null) {
            return null;
        }

        return $this->userRepository->findById($userId);
    }
}
