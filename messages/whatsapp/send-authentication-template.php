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
        "type" => "template",
        "template" => [
            "name" => WHATSAPP_AUTH_TEMPLATE_NAME,
            "language" => [
                "policy" => "deterministic",
                "code" => "en"
            ],
            "components" => [
                [
                    "type" => "body",
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => '$OTP'
                        ]
                    ]
                ],
                [
                    "type" => "button",
                    "sub_type" => "url",
                    "index" => "0",
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => '$OTP'
                        ]
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