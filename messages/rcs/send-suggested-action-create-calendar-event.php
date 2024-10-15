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
            "text" => "Product Launch: Save the date!",
            "suggestions" => [
                [
                    "action" => [
                        "text" => "Save to calendar",
                        "postbackData" => "postback_data_1234",
                        "fallbackUrl" => "https://www.google.com/calendar",
                        "createCalendarEventAction" => [
                            "startTime" => "2024-06-28T19:00:00Z",
                            "endTime" => "2024-06-28T20:00:00Z",
                            "title" => "Vonage API Product Launch",
                            "description" =>
                                "Event to demo Vonage\'s new and exciting API product",
                        ],
                    ],
                ],
            ],
        ],
    ]
);

$client->messages()->send($rcsCard);
