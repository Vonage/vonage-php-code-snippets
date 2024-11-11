<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$custom = [
    "message_type" => "sticker",
    "sticker" => [
        "id" => STICKER_ID
    ],
    "to" => TO_NUMBER,
    "from" => WHATSAPP_NUMBER,
    "channel" => "whatsapp"
];


$whatsApp = new \Vonage\Messages\Channel\WhatsApp\WhatsAppCustom(
    TO_NUMBER,
    FROM_NUMBER,
    $custom
);

$client->messages()->send($whatsApp);