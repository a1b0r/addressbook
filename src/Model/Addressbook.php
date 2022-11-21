<?php

namespace App\Model;

class Addressbook extends BaseModel
{
    public function __construct()
    {
        parent::__construct('addressbook');
        $this->columns =  ["id", "name", "openingHours", "telephone", "country", "locality", "region", "code", "streetAddress"]; //, "order", "dir"
    }

    public function readAll()
    {

        $sql = "SELECT * FROM $this->tableName ORDER BY id DESC";
        try {
            return $this->db->query(
                $sql
                // , [
                //     "order" => $order,
                //     "dir" => $dir
                // ]
            );
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }
}
