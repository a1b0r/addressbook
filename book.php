<?php
require 'db.php';

class book
{
    public $field = ["id", "name", "openingHours", "telephone", "country", "locality", "region", "code", "streetAddress"];//, "order", "dir"
    private $table = 'addressbook';
    public function __construct($book)
    {
        $this->db = new db();
        $this->order = in_array($this->order, $this->field) ? $this->order : "id";
        $this->dir = $book->dir == "asc" ? "ASC" : "DESC";
        if ($book) {
            foreach ($book as $key => $value) {
                if (in_array($key, $this->field) && $value != "") {
                    $this->$key = htmlspecialchars(trim($value));
                }
            }
        }
    }
    public function add()
    {
        $sql = "INSERT INTO {$this->table} (name, openingHours, telephone, country, locality, region, code, streetAddress) VALUES (:name, :openingHours, :telephone, :country, :locality, :region, :code, :streetAddress)";
        $this->db->query($sql, [
            ':name' => $this->name,
            ':openingHours' => $this->openingHours,
            ':telephone' => $this->telephone,
            ':country' => $this->country,
            ':locality' => $this->locality,
            ':region' => $this->region,
            ':code' => $this->code,
            ':streetAddress' => $this->streetAddress
        ]);
    }
    public function update()
    {
        $sql = "UPDATE {$this->table} SET name = :name, openingHours = :openingHours, telephone = :telephone, country = :country, locality = :locality, region = :region, code = :code, streetAddress = :streetAddress WHERE id = :id";
        $this->db->query($sql, [
            ':id' => $this->id,
            ':name' => $this->name,
            ':openingHours' => $this->openingHours,
            ':telephone' => $this->telephone,
            ':country' => $this->country,
            ':locality' => $this->locality,
            ':region' => $this->region,
            ':code' => $this->code,
            ':streetAddress' => $this->streetAddress
        ]);
        return $this->id;
    }
    public function read()
    {
        foreach($this->field as $k=>$field){
            if($this->$field != ''){
                $where[] = $field . ' LIKE :'.$field; 
                $params[':'.$field] = '%'.htmlspecialchars(trim($this->$field)).'%';
            }
        }
        $where = $where ? 'WHERE ' . implode(' AND ', $where) : '';
        $sql = "SELECT * FROM {$this->table} {$where} ORDER BY {$this->order} {$this->dir}";
        $stmt = $this->db->query($sql, $params);
        $ret= $stmt->fetchAll();
        return $ret;
    }
    public function delete()
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $this->db->query($sql, [':id' => $this->id]);
        return $this->id;
    }
}
