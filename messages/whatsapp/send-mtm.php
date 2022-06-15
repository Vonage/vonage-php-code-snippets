<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$custom = [
    "name" => WHATSAPP_TEMPLATE_NAMESPACE . ":" . WHATSAPP_TEMPLATE_NAME,
    "parameters" => [
        ["default" => "Vonage Verification"],
        ["default" => "64873"],
        ["default" => "10"],
    ],
];

$sms = new \Vonage\Messages\MessageType\WhatsApp\WhatsAppCustom(
    TO_NUMBER,
    FROM_NUMBER,
    $custom
);
