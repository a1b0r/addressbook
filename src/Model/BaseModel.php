<?php

namespace App\Model;

class BaseModel
{
    protected $db;
    protected $tableName;
    public $columns;

    public function __construct(string $tableName)
    {
        $this->db = new Database();
        $this->tableName = $tableName;
    }


    public function create(array $data): int
    {

        $columns = $this->columns;
        unset($columns[0]);
        $sql = "INSERT INTO $this->tableName (" . implode(", ", $columns) .
            ") VALUES (" . ":" . implode(", :", $columns) . ")";
        try {
            $this->db->execute($sql, $data);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }

    public function read(array $data): array
    {
        $sql = "SELECT * FROM $this->tableName WHERE " .
            implode(" = : AND ", $this->columns) . " = : ";
        try {
            return $this->db->query($sql, $data);
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return [];
        }
    }

    public function readAll(): array
    {
        $sql = "SELECT * FROM $this->tableName ORDER BY id DESC";
        try {
            return $this->db->query($sql /*, ["order" => $order,"dir" => $dir]*/);
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return [];
        }
    }

    public function update(array $data): bool
    {
        $sql = "UPDATE $this->tableName SET " .
            implode(" = ?, ", $this->columns) . " = ? WHERE id = ?";
        try {
            $this->db->query($sql,  [...array_values($data), $data["id"]]);
            return true;
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }

    public function delete(array $data): bool
    {
        $sql = "DELETE FROM $this->tableName WHERE id = :id";
        $params = ["id" => $data["id"]];
        try {
            $this->db->execute($sql, $params);
            return true;
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }
}
