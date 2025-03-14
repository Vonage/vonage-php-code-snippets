<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$newRequest = new \Vonage\Verify2\Request\WhatsAppInteractiveRequest(VERIFY_NUMBER, 'my-verification');
$client->verify2()->startVerification($newRequest);
