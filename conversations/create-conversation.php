<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Nexmo\Client\Exception\Request;
use Nexmo\Client\Exception\Server;
use Nexmo\Conversations\Conversation;


$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

$conversation = new Conversation();
$conversation->createFromArray([
    'name' => 'sample_conversation',
    'display_name' => 'Sample Conversation',
    'image_url' => 'https://via.placeholder.com/150',
    'properties' => [
        'sample_property' => 'Some Text'
    ]
]);

$conversation = $client->conversations()->create($conversation);

error_log("Created conversation " . $conversation->getId() . " with name '" . $conversation->getName() . "'");