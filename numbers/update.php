<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

try {
    $client->numbers()->update([
        "messagesCallbackType" => "app",
        "messagesCallbackValue" => MESSAGES_APPLICATION_ID,
        "voiceCallbackType" => VOICE_CALLBACK_TYPE,
        "voiceCallbackValue" => VOICE_CALLBACK_VALUE,
        "voiceStatusCallback" => VOICE_STATUS_URL,
        "moHttpUrl" => SMS_CALLBACK_URL,
    ], NEXMO_NUMBER);
    echo "Number updated";
    
} catch (Exception $e) {
    echo "Error updating number";
}