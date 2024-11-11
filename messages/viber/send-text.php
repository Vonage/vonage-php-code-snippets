<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$viber = new \Vonage\Messages\Channel\Viber\ViberText(
    TO_NUMBER,
    FROM_NUMBER,
    'This is a text message sent using the Vonage PHP SDK'
);

$client->messages()->send($viber);