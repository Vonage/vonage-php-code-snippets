<?php

use Vonage\Conversation\ConversationObjects\CreateConversationRequest;

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$createConversationRequest = new CreateConversationRequest(CONV_NAME, CONV_DISPLAY_NAME);

$client->conversation()->createConversation($createConversationRequest);