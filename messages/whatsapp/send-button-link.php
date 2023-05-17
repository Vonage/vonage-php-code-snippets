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
                "parameters" => [
                    [
                        "type" => "image",
                        "image" => ["link" => HEADER_IMAGE_URL],
                    ],
                ],
            ],
            [
                "type" => "body",
                "parameters" => [
                    ["type" => "text", "text" => "Anand"],
                    ["type" => "text", "text" => "Quest"],
                    ["type" => "text", "text" => "113-0921387"],
                    ["type" => "text", "text" => "23rd Nov 2019"],
                ],
            ],
            [
                "type" => "button",
                "index" => "0",
                "sub_type" => "url",
                "parameters" => [
                    ["type" => "text", "text" => "1Z999AA10123456784"],
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
