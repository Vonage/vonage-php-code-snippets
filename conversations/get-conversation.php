<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Nexmo\Conversations\Conversation;
use Nexmo\Conversations\Filter;

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

/** @var Conversations $entry */
foreach ($client->conversation() as $entry) {
    $filter = new Filter();
    $filter->setId($entry->getId());

    $response = $client->conversation($filter);
    $conversation = $response->current();

    error_log($conversation->getId());
    break;
}