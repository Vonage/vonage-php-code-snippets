<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS(TO_NUMBER, BRAND_NAME, 'A text message sent using the Nexmo SMS API')
);

$message = $response->current();

if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}
