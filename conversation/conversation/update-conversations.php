<?php

use Vonage\Conversation\ConversationObjects\CreateConversationRequest;
use Vonage\Conversation\ConversationObjects\UpdateConversationRequest;

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$updateConversationRequest = new UpdateConversationRequest(CONVERSATION_ID, [
    'name' => CONV_NEW_NAME,
    'display_name' => CONV_NEW_NAME
]);

$client->conversation()->updateConversationById(CONVERSATION_ID, $updateConversationRequest);