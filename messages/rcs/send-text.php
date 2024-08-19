<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$rcsText = new Vonage\Messages\Channel\RCS\RcsText(
    '07778887777',
    '09997485156',
    'This is an RCS message.'
);

$client->messages()->send($rcsText);
