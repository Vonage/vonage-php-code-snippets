<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$inbound = \Vonage\Message\InboundMessage::createFromGlobals();

if ($inbound->isValid()) {
    $params = $inbound->getRequestData();
    $signature = new Vonage\Client\Signature(
        $params,
        VONAGE_API_SIGNATURE_SECRET,
        'md5hash'
    );
    $validSig = $signature->check($params['sig']);

    if($validSig) {
        error_log("Valid signature");
    } else {
        error_log("Invalid signature");
    }

} else {
    error_log('Invalid message');
}
