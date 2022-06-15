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
        "language" => ["code" => "en", "policy" => "deterministic"],
        "components" => [
            [
                "type" => "header",
                "parameters" => [["type" => "text", "text" => "12/26"]],
            ],
            [
                "type" => "body",
                "parameters" => [
                    ["type" => "text", "text" => "*Ski Trip*"],
                    ["type" => "text", "text" => "2019-12-26"],
                    [
                        "type" => "text",
                        "text" => "*Squaw Valley Ski Resort, Tahoe*",
                    ],
                ],
            ],
            [
                "type" => "button",
                "sub_type" => "quick_reply",
                "index" => 0,
                "parameters" => [
                    ["type" => "payload", "payload" => "Yes-Button-Payload"],
                ],
            ],
            [
                "type" => "button",
                "sub_type" => "quick_reply",
                "index" => 1,
                "parameters" => [
                    ["type" => "payload", "payload" => "No-Button-Payload"],
                ],
            ],
        ],
    ],
];

$sms = new \Vonage\Messages\MessageType\WhatsApp\WhatsAppCustom(
    TO_NUMBER,
    FROM_NUMBER,
    $custom
);
