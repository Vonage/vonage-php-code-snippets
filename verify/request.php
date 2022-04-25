<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

$request = new \Vonage\Verify\Request(NUMBER, BRAND_NAME);

// choose PIN length (4 or 6)
$request->setCodeLength(4);

// set locale
$request->setCountry('de');

$response = $client->verify()->start($request);

echo "Started verification, `request_id` is " . $response->getRequestId();