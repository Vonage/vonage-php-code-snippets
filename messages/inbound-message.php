<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$incomingWebhookMessage = \Vonage\Messages\Webhook\Factory::createFromArray($data);