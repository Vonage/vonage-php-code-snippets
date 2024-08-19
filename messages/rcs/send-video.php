<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$videoObject = new \Vonage\Messages\MessageObjects\VideoObject('https://my-site.com/video.mp4');

$rcsImage = new Vonage\Messages\Channel\RCS\RcsVideo(
    '07778887777',
    '09997485156',
    $videoObject
);

$client->messages()->send($rcsImage);
