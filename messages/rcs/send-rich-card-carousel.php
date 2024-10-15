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
                "carouselCard" => [
                    "cardWidth" => "MEDIUM",
                    "cardContents" => [
                        [
                            "title" => "Option 1: Photo",
                            "description" => "Do you prefer this photo?",
                            "suggestions" => [
                                [
                                    "reply" => [
                                        "text" => "Option 1",
                                        "postbackData" => "card_1"
                                    ]
                                ]
                            ],
                            "media" => [
                                "height" => "MEDIUM",
                                "contentInfo" => [
                                    "fileUrl" => "'\$IMAGE_URL'",
                                    "forceRefresh" => "false"
                                ]
                            ]
                        ],
                        [
                            "title" => "Option 2: Video",
                            "description" => "Or this video?",
                            "suggestions" => [
                                [
                                    "reply" => [
                                        "text" => "Option 2",
                                        "postbackData" => "card_2"
                                    ]
                                ]
                            ],
                            "media" => [
                                "height" => "MEDIUM",
                                "contentInfo" => [
                                    "fileUrl" => "'\$VIDEO_URL'",
                                    "forceRefresh" => "false"
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
