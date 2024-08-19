<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$fileObject = new \Vonage\Messages\MessageObjects\FileObject('https://my-site.com/document.pdf');

$rcsFile = new Vonage\Messages\Channel\RCS\RcsFile(
    '07778887777',
    '09997485156',
    $fileObject
);

$client->messages()->send($rcsFile);
