<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Building Blocks
// 1. Make a Phone Call
// 2. Play Text-to-Speech

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);
$client = new \Vonage\Client($keypair);

$outboundCall = new \Vonage\Voice\OutboundCall(
    new \Vonage\Voice\Endpoint\Phone(TO_NUMBER),
    new \Vonage\Voice\Endpoint\Phone(VONAGE_NUMBER)
);
$outboundCall->setAnswerWebhook(
    new \Vonage\Voice\Webhook(
        'https://raw.githubusercontent.com/nexmo-community/ncco-examples/gh-pages/text-to-speech.json',
        \Vonage\Voice\Webhook::METHOD_GET
    )
);
$response = $client->voice()->createOutboundCall($outboundCall);

var_dump($response);
