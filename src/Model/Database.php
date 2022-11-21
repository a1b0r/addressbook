<?php

namespace App\Model;


class Database
{
    protected $connection = null;

    public function __construct()
    {
        try {
            $this->connection = new \PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", getenv('DB_USER'), getenv('DB_PASS'));
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "\r\n";
            die();
        }
    }

    public function query(string $sql, array $params = []): array
    {
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException("Unable to prepare statement: " . implode(", ", $this->connection->errorInfo()));
        }
        $result = $stmt->execute($params);
        if ($result === false) {
            throw new \RuntimeException("Unable to execute statement: " . implode(", ", $stmt->errorInfo()));
        }
        $rows = $stmt->fetchAll();
        if ($rows === false) {
            throw new \RuntimeException("Unable to fetch rows: " . implode(", ", $stmt->errorInfo()));
        }
        return $rows;
    }

    public function execute(string $sql, array $params = []): bool
    {
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException('SQL prepare failed');
        }
        $result = $stmt->execute($params);
        if ($result === false) {
            throw new \RuntimeException('SQL execute failed');
        }
        return $result;
    }

    public function lastInsertId(): int
    {
        $id = $this->connection->lastInsertId();
        if ($id === false) {
            throw new \RuntimeException('Could not fetch last insert ID.');
        }
        return (int) $id;
    }
}
