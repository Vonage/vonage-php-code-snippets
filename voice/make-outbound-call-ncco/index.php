<?php

use Nexmo\Voice\NCCO\NCCO;

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Nexmo\Client\Credentials\Keypair(
    file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH),
    NEXMO_APPLICATION_ID
);
$client = new \Nexmo\Client($keypair);

$outboundCall = new \Nexmo\Voice\OutboundCall(
    new \Nexmo\Voice\Endpoint\Phone(TO_NUMBER),
    new \Nexmo\Voice\Endpoint\Phone(NEXMO_NUMBER)
);
$ncco = new NCCO();
$ncco->addAction(new \Nexmo\Voice\NCCO\Action\Talk('This is a text to speech call from Nexmo'));
$outboundCall->setNCCO($ncco);

$response = $client->voice()->createOutboundCall($outboundCall);

var_dump($response);
