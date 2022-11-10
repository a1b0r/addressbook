<?php
include_once 'book.php';

$method =  $_SERVER["REQUEST_METHOD"];
$method = ($method == "GET" && !$_GET) ? '' : $method;

$action = ["POST" => 'add', "PUT" => 'update', "GET" => 'read', 'DELETE' => 'delete'];

$input = ($_POST ?: $_GET);
$input = $input ? (object) $input : json_decode(json_decode(file_get_contents('php://input')));

$book = new book($input);
$method ? print json_encode($book->{$action[$method]}()) : readfile("index.html");
