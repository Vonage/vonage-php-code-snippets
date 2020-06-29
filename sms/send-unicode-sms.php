<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

$response = $client->sms()->send(
    new \Nexmo\SMS\Message\SMS(TO_NUMBER, BRAND_NAME, 'こんにちは世界')
);

var_dump($response->current());
