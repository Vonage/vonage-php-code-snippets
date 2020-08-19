<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

try {
    $number = $client->numbers()->get(VONAGE_NUMBER);
    $number->setAppId(VONAGE_APPLICATION_ID);
    $client->numbers()->update($number);
    echo "Number updated" . PHP_EOL;
    
} catch (Exception $e) {
    echo "Error updating number" . PHP_EOL;
}
