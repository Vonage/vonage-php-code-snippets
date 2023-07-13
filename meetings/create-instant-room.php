<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$room = new \Vonage\Meetings\Room();
$room->fromArray(['display_name' => ROOM_DISPLAY_NAME]);
$meeting = $client->meetings()->createRoom($room);