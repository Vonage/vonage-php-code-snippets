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
        "namespace" => WHATSAPP_TEMPLATE_NAMESPACE,
        "name" => WHATSAPP_TEMPLATE_NAME,
        "language" => ["policy" => "deterministic", "code" => "en"],
        "components" => [
            [
                "type" => "header",
                "parameters" => [
                    [
                        "type" => "location",
                        "location" => [
                            "longitude" => -122.425332,
                            "latitude" => 37.758056,
                            "name" => "Facebook HQ",
                            "address" => "1 Hacker Way, Menlo Park, CA 94025",
                        ],
                    ],
                ],
            ],
            [
                "type" => "body",
                "parameters" => [
                    "Value 1",
                    "Value 2",
                    "Value 3",
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
