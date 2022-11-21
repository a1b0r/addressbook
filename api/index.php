<?php
require __DIR__ . './../vendor/autoload.php';

use App\Controller\Api\AddressbookController;

$allowed = ['addressbook', 'addressbooks'];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$controller = new AddressbookController();
if (in_array($uri[2],  $controller->getUrls())) {
  $controller->do($_SERVER["REQUEST_METHOD"]);
} else {
  header('HTTP/1.1 404 Not Found');
  exit();
}
