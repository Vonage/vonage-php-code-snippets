<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Nexmo\Conversation\Conversation;

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

// search() returns an iterable collection
$conversations = $client->conversations()->search();
// For demonstration purposes, we grab just the first one
$conversation = $conversations->current();

error_log($conversation->getId());
