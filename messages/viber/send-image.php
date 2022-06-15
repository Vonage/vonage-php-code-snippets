<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$imageObject = new \Vonage\Messages\MessageObjects\ImageObject(
    'https://example.com/image.jpg',
    'This is an image'
);

$sms = new \Vonage\Messages\MessageType\Viber\ViberImage(
    TO_NUMBER,
    FROM_NUMBER,
    $imageObject
);
