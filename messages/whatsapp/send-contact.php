<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$custom = [
    "type" => "contacts",
    "contacts" => [
        [
            "addresses" => [
                [
                    "city" => "Menlo Park",
                    "country" => "United States",
                    "country_code" => "us",
                    "state" => "CA",
                    "street" => "1 Hacker Way",
                    "type" => "HOME",
                    "zip" => "94025",
                ],
                [
                    "city" => "Menlo Park",
                    "country" => "United States",
                    "country_code" => "us",
                    "state" => "CA",
                    "street" => "200 Jefferson Dr",
                    "type" => "WORK",
                    "zip" => "94025",
                ],
            ],
            "birthday" => "2012-08-18",
            "emails" => [
                ["email" => "test@fb.com", "type" => "WORK"],
                ["email" => "test@whatsapp.com", "type" => "WORK"],
            ],
            "name" => [
                "first_name" => "John",
                "formatted_name" => "John Smith",
                "last_name" => "Smith",
            ],
            "org" => [
                "company" => "WhatsApp",
                "department" => "Design",
                "title" => "Manager",
            ],
            "phones" => [
                ["phone" => "+1 (940) 555-1234", "type" => "HOME"],
                [
                    "phone" => "+1 (650) 555-1234",
                    "type" => "WORK",
                    "wa_id" => "16505551234",
                ],
            ],
            "urls" => [["url" => "https://www.facebook.com", "type" => "WORK"]],
        ],
    ],
];

$sms = new \Vonage\Messages\MessageType\WhatsApp\WhatsAppCustom(
    TO_NUMBER,
    FROM_NUMBER,
    $custom
);
