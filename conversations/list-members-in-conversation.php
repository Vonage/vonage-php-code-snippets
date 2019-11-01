<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

$conversation = $client->conversations()->get(CONVERSATION_ID);
// $conversation->getMembers() is iterable, but we will grab the first event
$member = $conversation->getMembers()->current();
error_log('Member ' . $member->getId() . ' is part of conversation ' . $member->getConversationId());
