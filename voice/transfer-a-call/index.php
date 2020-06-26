<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Nexmo\Client\Credentials\Keypair(file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH), NEXMO_APPLICATION_ID);
$client = new \Nexmo\Client($keypair);

$call = $client->voice()->get(UUID);
$client->voice()->transferCall(
    $call->getUuid(),
    new \Nexmo\Voice\NCCO\Action\Transfer("https://developer.nexmo.com/ncco/transfer.json")
);
