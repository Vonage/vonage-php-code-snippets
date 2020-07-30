<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$signed = new Nexmo\Client\Credentials\SignatureSecret(
    NEXMO_API_KEY,
    NEXMO_API_SIGNATURE_SECRET,
    'md5hash'
);
$client = new \Nexmo\Client($signed);

$response = $client->sms()->send(
    new \Nexmo\SMS\Message\SMS(TO_NUMBER, FROM_NUMBER, 'Super interesting message')
);

echo "Message status: " . $response->current()->getStatus() . "\n";
