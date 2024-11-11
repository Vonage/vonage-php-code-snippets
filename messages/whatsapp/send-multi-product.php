<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$custom = [
    "type" => "interactive",
    "interactive" => [
        "type" => "product_list",
        "header" => [
            "type" => "text",
            "text" => "Our top products"
        ],
        "body" => [
            "text" => "Check out these great products"
        ],
        "footer" => [
            "text" => "Sale now on!"
        ],
        "action" => [
            "catalog_id" => CATALOG_ID,
            "sections" => [
                [
                    "title" => "Cool products",
                    "product_items" => [
                        ["product_retailer_id" => PRODUCT_ID],
                        ["product_retailer_id" => PRODUCT_ID]
                    ]
                ],
                [
                    "title" => "Awesome products",
                    "product_items" => [
                        ["product_retailer_id" => PRODUCT_ID]
                    ]
                ]
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