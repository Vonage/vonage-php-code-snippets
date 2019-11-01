<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

// User should be pulled from the API first, or created from an array and saved
// Only users with valid User IDs can be used with Conversations
$user = new \Nexmo\User\User();
$user->setName('ashley');

/** @var \Nexmo\Conversations\Conversation $conversation */
$conversation = $client->conversations()->get(CONVERSATION_ID);
$member = $conversation->addMember($user, 'invite');

error_log('Member ' . $member->getId() . ' has been added to the conversation');