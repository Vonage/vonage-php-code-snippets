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

$viber = new \Vonage\Messages\MessageType\Viber\ViberText(
    MESSAGES_SANDBOX_ALLOW_LISTED_TO_NUMBER,
    MESSAGES_SANDBOX_VIBER_SERVICE_ID,
    'This is a Viber text message sent using the Vonage PHP SDK via the Messages Sandbox'
);

$response = $client->messages()->send($message);
