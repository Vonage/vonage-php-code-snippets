<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

$request = new \Nexmo\Verify\Request(NUMBER, BRAND_NAME);
$response = $client->verify()->start($request);

echo "Started verification, `request_id` is " . $response->getRequestId();