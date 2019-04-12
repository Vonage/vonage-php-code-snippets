<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Nexmo\Client\Credentials\Keypair(
    file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH),
    NEXMO_APPLICATION_ID
);
$client = new \Nexmo\Client($keypair);

$call = $client->calls()->create([
    'to' => [[
        'type' => 'phone',
        'number' => TO_NUMBER
    ]],
    'from' => [
        'type' => 'phone',
        'number' => NEXMO_NUMBER
    ],
    'ncco' => [
        [
            'action' => 'talk',
            'text' => 'This is a text to speech call from Nexmo'
        ]
    ]
]);

print_r($call);
