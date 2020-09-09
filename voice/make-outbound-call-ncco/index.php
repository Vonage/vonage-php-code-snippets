<?php

use Vonage\Voice\NCCO\NCCO;

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);
$client = new \Vonage\Client($keypair);

$outboundCall = new \Vonage\Voice\OutboundCall(
    new \Vonage\Voice\Endpoint\Phone(TO_NUMBER),
    new \Vonage\Voice\Endpoint\Phone(VONAGE_NUMBER)
);
$ncco = new NCCO();
$ncco->addAction(new \Vonage\Voice\NCCO\Action\Talk('This is a text to speech call from Nexmo'));
$outboundCall->setNCCO($ncco);

$response = $client->voice()->createOutboundCall($outboundCall);

var_dump($response);
