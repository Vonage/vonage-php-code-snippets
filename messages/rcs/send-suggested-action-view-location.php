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
            "text" => "Drop by our office!",
            "suggestions" => [
                [
                    "action" => [
                        "text" => "View map",
                        "postbackData" => "postback_data_1234",
                        "fallbackUrl" =>
                            "https://www.google.com/maps/place/Vonage/@51.5230371,-0.0852492,15z",
                        "viewLocationAction" => [
                            "latLong" => [
                                "latitude" => "51.5230371",
                                "longitude" => "-0.0852492",
                            ],
                            "label" => "Vonage London Office",
                        ],
                    ],
                ],
            ],
        ],
    ]
);

$client->messages()->send($rcsCard);
