<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

try {
    $client->numbers()->purchase(NEXMO_NUMBER, COUNTRY_CODE);
    echo "Number purchased";
} catch (Exception $e) {
    echo "Error purchasing number";
}