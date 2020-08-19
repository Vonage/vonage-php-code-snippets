<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

$response = $client->account()->updateConfig([
    "sms_callback_url" => SMS_CALLBACK_URL
]);
print_r($response->toArray());
