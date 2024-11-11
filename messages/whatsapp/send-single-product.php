<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$custom = [
    "to" => TO_NUMBER,
    "from" => WHATSAPP_NUMBER,
    "channel" => "whatsapp",
    "message_type" => "custom",
    "custom" => [
        "type" => "interactive",
        "interactive" => [
            "type" => "product",
            "body" => [
                "text" => "Check out this cool product"
            ],
            "footer" => [
                "text" => "Sale now on!"
            ],
            "action" => [
                "catalog_id" => CATALOG_ID,
                "product_retailer_id" => PRODUCT_ID
            ]
        ]
    ]
];

$whatsApp = new \Vonage\Messages\Channel\WhatsApp\WhatsAppCustom(
    TO_NUMBER,
    FROM_NUMBER,
    $custom
);

$client->messages()->send($whatsApp);