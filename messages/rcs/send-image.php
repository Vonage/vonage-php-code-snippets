<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$imageObject = new \Vonage\Messages\MessageObjects\ImageObject('https://my-site.com/image.png');

$rcsImage = new Vonage\Messages\Channel\RCS\RcsImage(
    '07778887777',
    '09997485156',
    $imageObject
);

$client->messages()->send($rcsImage);
