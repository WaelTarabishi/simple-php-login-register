<?php

class Database
{
    private mysqli $connection;

    public function __construct(
        string $host,
        string $username,
        string $password,
        string $database
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
