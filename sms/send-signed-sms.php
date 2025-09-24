<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$signed = new \Vonage\Client\Credentials\SignatureSecret(
    VONAGE_API_KEY,
    VONAGE_API_SIGNATURE_SECRET,
    'md5hash'
);
$client = new \Vonage\Client($signed);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS(TO_NUMBER, FROM_NUMBER, 'Super interesting message')
);

echo "Message status: " . $response->current()->getStatus() . "\n";
