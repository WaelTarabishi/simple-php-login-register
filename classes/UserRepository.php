<?php

class UserRepository implements UserRepositoryInterface
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function findByEmail(string $email): ?array
    {
        $sql = 'SELECT id, full_name, email, password, created_at FROM users WHERE email = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc() ?: null;

        $stmt->close();

        return $user;
    }

    public function findById(int $id): ?array
    {
        $sql = 'SELECT id, full_name, email, created_at FROM users WHERE id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc() ?: null;

        $stmt->close();

        return $user;
    }

    public function create(string $fullName, string $email, string $hashedPassword): bool
    {
        $sql = 'INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('sss', $fullName, $email, $hashedPassword);

        $isCreated = $stmt->execute();

        $stmt->close();

        return $isCreated;
    }
}
