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

$channel = new \Vonage\Conversation\ConversationObjects\Channel('app');


$createMemberRequest = new \Vonage\Conversation\ConversationObjects\CreateMemberRequest(
    'invited',
    \Vonage\Conversation\ConversationObjects\Channel::CHANNEL_TYPE_APP,
    USER_ID
);

$client->conversation()->createMember($createMemberRequest, CONVERSATION_ID);
