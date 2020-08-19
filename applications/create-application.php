<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

try {
    $application = new Nexmo\Application\Application();
    $application->fromArray([
        'name' => 'Should Work2',
        'capabilities' => [
            'voice' => [
                'webhooks' => [
                    'answer_url' => [
                        'address' => "https://example.com/webhooks/answer",
                        'http_method' => "GET"
                    ],
                    'event_url' => [
                        'address' => "https://example.com/webhooks/event",
                        'http_method' => "POST"
                    ]
                ]
            ],
            'messages' => [
                'webhooks' => [
                    'inbound_url' => [
                        'address' => "https://example.com/webhooks/inbound",
                        'http_method' => "POST"
                    ],
                    'status_url' => [
                        'address' => "https://example.com/webhooks/status",
                        'http_method' => "POST"
                    ]
                ]
            ],
            'rtc' => [
                'webhooks' => [
                    'event_url' => [
                        'address' => "https://example.com/webhooks/rtcevent",
                        'http_method' => "POST"
                    ]
                ]
            ]
        ]
    ]);
    $application = $client->applications()->create($application);

    echo $application->getId() . PHP_EOL;
    echo $application->getName() . PHP_EOL;
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}
