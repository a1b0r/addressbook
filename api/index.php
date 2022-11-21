<?php
require __DIR__ . './../vendor/autoload.php';

use App\Controller\Api\AddressbookController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$allowed = ['addressbook', 'addressbooks'];

if (in_array($uri[2], $allowed)) {
  $controller = new AddressbookController();
  $strMethodName = $_SERVER["REQUEST_METHOD"] ;
  $methode = [
    'GET' => 'read',
    'POST' => 'create',
    'PUT' => 'update',
    'DELETE' => 'delete'
  ];
  
  $controller->{$methode[$strMethodName]}();
} else {
  header('HTTP/1.1 404 Not Found');
  exit();
}
// if ($uri[2] !== 'addressbook' && $uri[2] !== 'addressbooks') {
//     header("HTTP/1.1 404 Not Found");
//     exit();
// }

// if ($uri[2] == 'addressbooks' and isset($uri[3])) {
//     header("HTTP/1.1 404 Not Found");
//     exit();
// }
// $addressbookId = null;
// if (isset($uri[3])) {
//     $addressbookId = (int) $uri[2];
// }

// $requestMethod = $_SERVER["REQUEST_METHOD"];

// $cntrl = new AddressbookController();
