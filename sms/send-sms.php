<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$container  = new \Vonage\Client\Credentials\Container(VONAGE_APPLICATION_ID, VONAGE_PRIVATE_KEY);
$client = new \Vonage\Client($container);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS(TO_NUMBER, BRAND_NAME, 'A text message sent using the Vonage SMS API')
);

$message = $response->current();

if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}
