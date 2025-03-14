<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(VONAGE_PRIVATE_KEY, VONAGE_APPLICATION_ID);
$client = new \Vonage\Client($keypair);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS(TO_NUMBER, BRAND_NAME, 'A text message sent using the Vonage SMS API')
);

$message = $response->current();

if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}
