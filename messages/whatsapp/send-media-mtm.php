<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$custom = [
    "type" => "template",
    "template" => [
        "name" => WHATSAPP_TEMPLATE_NAME,
        "language" => ["policy" => "deterministic", "code" => "en"],
        "components" => [
            [
                "type" => "header",
                "parameters" => [
                    [
                        "type" => "image",
                        "image" => [
                            "link" => IMAGE_URL,
                        ],
                    ],
                ],
            ],
            [
                "type" => "body",
                "parameters" => [
                    "type" => "text",
                    "text" => WHATSAPP_TEMPLATE_REPLACEMENT_TEXT,
                ],
            ],
        ],
    ],
];

$whatsApp = new \Vonage\Messages\MessageType\WhatsApp\WhatsAppCustom(
    TO_NUMBER,
    FROM_NUMBER,
    $custom
);
