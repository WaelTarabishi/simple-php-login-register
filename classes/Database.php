<?php

class Database
{
    private mysqli $connection;

    public function __construct(
        string $host = 'localhost',
        string $username = 'root',
        string $password = 'StrongPassword123!',
        string $database = 'simple_auth'
    ) {
        $this->connection = new mysqli($host, $username, $password, $database);

        if ($this->connection->connect_error) {
            exit('Database connection failed. Please check your database settings.');
        }

        $this->connection->set_charset('utf8mb4');
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}
