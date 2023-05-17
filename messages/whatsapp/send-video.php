<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$videoObject = new \Vonage\Messages\MessageObjects\VideoObject(
    'https://example.com/video.mp4',
    'This is an video file'
);

$whatsApp = new \Vonage\Messages\MessageType\WhatsApp\WhatsAppVideo(
    TO_NUMBER,
    FROM_NUMBER,
    $videoObject
);
