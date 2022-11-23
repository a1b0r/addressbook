<?php
require __DIR__ . './../vendor/autoload.php';

use App\Controller\Api\AddressbookController;
use App\Model\Addressbook;


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

//
$addressbook = new AddressbookController(new Addressbook());
$allowed = [...$addressbook->getUrls()];
if (in_array($uri[2], $allowed)) {
  $addressbook->do($_SERVER["REQUEST_METHOD"]);
} else {
  header('HTTP/1.1 404 Not Found');
  exit();
}
