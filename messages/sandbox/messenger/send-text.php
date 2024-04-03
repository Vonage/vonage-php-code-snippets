<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client(
    $keypair,
    [
        'base_api_url' => MESSAGES_SANDBOX_URL
    ]   
);

$message = new \Vonage\Messages\MessageType\Messenger\MessengerText(
    MESSAGES_SANDBOX_ALLOW_LISTED_FB_RECIPIENT_ID,
    MESSAGES_SANDBOX_FB_ID,
    'This is a Messenger text message sent using the Vonage PHP SDK via the Messages Sandbox'
);
