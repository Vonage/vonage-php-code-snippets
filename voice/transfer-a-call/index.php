<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH), VONAGE_APPLICATION_ID);
$client = new \Vonage\Client($keypair);

$call = $client->voice()->get(UUID);
$client->voice()->transferCall(
    $call->getUuid(),
    new \Vonage\Voice\NCCO\Action\Transfer("https://developer.nexmo.com/ncco/transfer.json")
);
