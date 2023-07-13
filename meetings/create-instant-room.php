<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$meeting = $client->meetings()->createRoom('my_test_room');