<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

$event = new \Nexmo\Conversations\Event\Event();
$event->createFromArray([
    'type' => 'custom:my-event',
    'body' => [
        'data' => 'This is my custom data',
        'more-data' => 'This is more custom data'
    ],
    'to' => 'MEM-afe887d8-d587-4280-9aae-dfa4c9227d5e',
    'from' => 'MEM-e46d9542-752a-4786-8f12-25a2e623a793'
]);

$conversation = $client->conversations()->get(CONVERSATION_ID);
$event = $conversation->addEvent($event);

error_log('Custom Event ' . $event->getId() . ' was added to conversation ' . $event->getConversationId());
