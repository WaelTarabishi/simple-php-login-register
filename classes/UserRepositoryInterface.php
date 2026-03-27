<?php

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?array;

    public function findById(int $id): ?array;

    public function create(string $fullName, string $email, string $hashedPassword): bool;
}
