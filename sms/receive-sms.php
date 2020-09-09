<?php 
require_once __DIR__ . '/../config.php';

require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

/** @var \Vonage\SMS\Webhook\InboundSMS */
$inbound = \Vonage\SMS\Webhook\Factory::createFromGlobals();

error_log($inbound->getText());
$client->sms()->send(
    new \Vonage\SMS\Message\SMS($inbound->getFrom(), $inbound->getTo(), 'Thanks for sending a message!' )
);
