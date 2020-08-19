<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

try {
  $client->numbers()->cancel(VONAGE_NUMBER);
  echo "Number cancelled";
}

catch(Exception $e) {
  echo "Error cancelling number";
}