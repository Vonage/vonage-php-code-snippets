<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Building Blocks
// 1. Make a Phone Call
// 2. Play Text-to-Speech

$keypair = new \Nexmo\Client\Credentials\Keypair(
    file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH),
    NEXMO_APPLICATION_ID
);
$client = new \Nexmo\Client($keypair);

$outboundCall = new \Nexmo\Voice\OutboundCall(
    new \Nexmo\Voice\Endpoint\Phone(TO_NUMBER),
    new \Nexmo\Voice\Endpoint\Phone(NEXMO_NUMBER)
);
$outboundCall->setAnswerWebhook(
    new \Nexmo\Voice\Webhook(
        'https://developer.nexmo.com/ncco/tts.json',
        \Nexmo\Voice\Webhook::METHOD_GET
    )
);
$response = $client->voice()->createOutboundCall($outboundCall);

var_dump($response);
