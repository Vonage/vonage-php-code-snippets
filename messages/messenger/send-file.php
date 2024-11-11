<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$fileObject = new \Vonage\Messages\MessageObjects\FileObject(
    'https://example.com/file.pdf',
);

$message = new \Vonage\Messages\Channel\Messenger\MessengerFile(
    TO_NUMBER,
    FROM_NUMBER,
    $fileObject
);

$client->messages()->send($message);