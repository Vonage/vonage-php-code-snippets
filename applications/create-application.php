<?php 

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

$applicationClient = new \Nexmo\Application\Client();
$applicationClient->setClient($client);

try {
    $application = $applicationClient->create(
        [
            'name' => 'Sample PHP V2 Application',
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
        ]
    );

    error_log($application->getId());
    error_log($application->getName());
} catch (\InvalidArgumentException $e) {
    error_log($e->getMessage());
}