<?php


class db
{
    private $db;
    public function __construct()
    {
        $this->db = new \PDO('mysql:host=db;dbname=book', 'root', 'root');
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        // $stmt->debugDumpParams();
        return $stmt;
    }
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
