<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$room = new \Vonage\Meetings\Room();
$room->fromArray([
    'display_name' => 'my_test_room',
    'type' => 'long_term',
    'expires_at' => '2023-01-30T00:47:04+0000'
]);

$meeting = $client->meetings()->createRoom($room);