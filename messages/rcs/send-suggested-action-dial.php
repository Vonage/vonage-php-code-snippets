<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$rcsCard = new Vonage\Messages\Channel\RCS\RcsCustom(
    '07778887777',
    '09997485156',
    [
        "contentMessage" => [
            "text" => "Call us to claim your free gift!",
            "suggestions" => [
                [
                    "action" => [
                        "text" => "Call now!",
                        "postbackData" => "postback_data_1234",
                        "fallbackUrl" => "https://www.example.com/contact/",
                        "dialAction" => ["phoneNumber" => "+447900000000"],
                    ],
                ],
            ],
        ],
    ]
);

$client->messages()->send($rcsCard);
