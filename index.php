<?php
include_once 'addressbook.php';
$book = new addressbook();

$method =  $_SERVER["REQUEST_METHOD"];
$method = $method == "GET" ? (!count($_GET) ? '' : $method) : $method;
$action = [
    "POST" => 'add',
    "PUT" => 'update',
    "GET" => 'read',
    "DELETE" => 'delete'
];

$data = $_POST ?: $_GET;
$DATA = $data ?: json_decode(json_decode(file_get_contents('php://input')));
$method ? print(json_encode($book->{$action[$method]}($DATA))) : readfile("index.html");
