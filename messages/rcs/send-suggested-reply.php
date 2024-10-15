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
            "text" => "What do you think of Vonage APIs?",
            "suggestions" => [
                [
                    "reply" => [
                        "text" => "They\'re great!",
                        "postbackData" => "suggestion_1",
                    ],
                ],
                [
                    "reply" => [
                        "text" => "They\'re awesome!",
                        "postbackData" => "suggestion_2",
                    ],
                ],
            ],
        ],
    ]
);

$client->messages()->send($rcsCard);
