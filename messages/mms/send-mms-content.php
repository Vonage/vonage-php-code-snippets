<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$content = new \Vonage\Messages\MessageObjects\ContentObject(
    MESSAGES_IMAGE_URL,
);

$mms = new \Vonage\Messages\Channel\MMS\MMSContent(
    TO_NUMBER,
    FROM_NUMBER,
    $content
);

$client->messages()->send($mms);


