<?php
require_once 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv('.');
$dotenv->load();

foreach($_ENV as $key => $val) {
  define($key, $val);
}