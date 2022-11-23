<?php

namespace App\Model;

class Addressbook extends BaseModel
{
    public function __construct()
    {
        parent::__construct('address');
        $this->columns =  ["id", "name", "openingHours", "telephone", "country", "locality", "region", "code", "streetAddress"]; //, "order", "dir"
    }
}
