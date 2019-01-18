<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$signed = new Nexmo\Client\Credentials\SignatureSecret(
    NEXMO_API_KEY,
    NEXMO_API_SIGNATURE_SECRET,
    'md5hash'
);
$client = new \Nexmo\Client($signed);

$message = $client->message()->send([
    'to' => TO_NUMBER,
    'from' => FROM_NUMBER,
    'text' => 'Super interesting message',
]);

$response = $message->getResponseData();
echo "Message status: " . $response['messages'][0]['status'] . "\n";
