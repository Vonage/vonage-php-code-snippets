<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$image = new \Vonage\Messages\MessageObjects\ImageObject(
    'https://example.com/image.jpg',
    'A MMS image message, with caption, sent using the Vonage Messages API'
);

$mms = new \Vonage\Messages\Channel\MMS\MMSImage(
    TO_NUMBER,
    FROM_NUMBER,
    $image
);
