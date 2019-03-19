<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

try {
    $message = $client->message()->send([
        'to' => TO_NUMBER,
        'from' => 'Acme Inc',
        'text' => 'A text message sent using the Nexmo SMS API'
    ]);
    $response = $message->getResponseData();

    if($response['messages'][0]['status'] == 0) {
        echo "The message was sent successfully\n";
    } else {
        echo "The message failed with status: " . $response['messages'][0]['status'] . "\n";
    }
} catch (Exception $e) {
    echo "The message was not sent. Error: " . $e->getMessage() . "\n";
}

