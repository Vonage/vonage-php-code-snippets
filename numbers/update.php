<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

try {
    $number = $client->numbers()->get(NEXMO_NUMBER);
    $number->setAppId(NEXMO_APPLICATION_ID);
    $client->numbers()->update($number);
    echo "Number updated" . PHP_EOL;
    
} catch (Exception $e) {
    echo "Error updating number" . PHP_EOL;
}
