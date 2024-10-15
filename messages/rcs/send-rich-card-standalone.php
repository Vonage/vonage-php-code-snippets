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
            "richCard" => [
                "standaloneCard" => [
                    "thumbnailImageAlignment" => "RIGHT",
                    "cardOrientation" => "VERTICAL",
                    "cardContent" => [
                        "title" => "Quick question",
                        "description" => "Do you like this picture?",
                        "media" => [
                            "height" => "TALL",
                            "contentInfo" => [
                                "fileUrl" => "'\$IMAGE_URL'",
                                "forceRefresh" => "false"
                            ]
                        ],
                        "suggestions" => [
                            [
                                "reply" => [
                                    "text" => "Yes",
                                    "postbackData" => "suggestion_1"
                                ]
                            ],
                            [
                                "reply" => [
                                    "text" => "I love it!",
                                    "postbackData" => "suggestion_2"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
);

$client->messages()->send($rcsCard);
