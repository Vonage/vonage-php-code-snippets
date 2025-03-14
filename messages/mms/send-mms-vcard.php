<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$card = new \Vonage\Messages\MessageObjects\VCardObject(
    MESSAGES_VCARD_URL,
);

$mms = new \Vonage\Messages\Channel\MMS\MMSvCard(
    TO_NUMBER,
    FROM_NUMBER,
    $card
);

$client->messages()->send($mms);
