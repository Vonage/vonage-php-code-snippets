<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$mms = new \Vonage\Messages\Channel\MMS\MMSText(
    MESSAGES_TO_NUMBER,
    MMS_SENDER_ID,
    'A text message sent using the Vonage SMS API'
);

$client->messages()->send($mms);

