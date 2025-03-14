<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$audio = new \Vonage\Messages\MessageObjects\AudioObject(
    MESSAGES_AUDIO_URL,
);

$mms = new \Vonage\Messages\Channel\MMS\MMSAudio(
    TO_NUMBER,
    FROM_NUMBER,
    $audio
);

$client->messages()->send($mms);
