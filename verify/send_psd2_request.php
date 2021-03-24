<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

$request = new \Vonage\Verify\RequestPSD2(RECIPIENT_NUMBER, PAYEE_NAME, AMOUNT);
$response = $client->verify()->requestPSD2($request);

echo "Started verification, `request_id` is " . $response['request_id'];
