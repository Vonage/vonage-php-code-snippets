<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH), VONAGE_APPLICATION_ID);
$client = new \Vonage\Client($keypair);
$action = new \Vonage\Voice\NCCO\Action\Talk(TEXT);
$action->setLanguage('en-US');

$client->voice()->playTTS(
    UUID,
    $action
);
