<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$audioObject = new \Vonage\Messages\MessageObjects\AudioObject(
    'https://example.com/audio.mp3',
    'This is an audio file'
);

$message = new \Vonage\Messages\Channel\Messenger\MessengerAudio(
    TO_NUMBER,
    FROM_NUMBER,
    $audioObject
);

$client->messages()->send($message);