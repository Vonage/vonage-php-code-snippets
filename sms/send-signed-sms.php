<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// add a 3rd parameter to change the signature from md5hash to something else
$signed = new Nexmo\Client\Credentials\SignatureSecret(NEXMO_API_KEY, NEXMO_API_SIGNATURE_SECRET);
$client = new \Nexmo\Client($signed);

$message = $client->message()->send([
    'to' => TO_NUMBER,
    'from' => FROM_NUMBER,
    'text' => 'Super interesting message',
]);

$response = $message->getResponseData();
echo "Message status: " . $response['messages'][0]['status'] . "\n";
