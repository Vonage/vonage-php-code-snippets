<?php 
require_once __DIR__ . '/../config.php';

require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

/** @var \Nexmo\SMS\Webhook\InboundSMS */
$inbound = \Nexmo\SMS\Webhook\Factory::createFromGlobals();

error_log($inbound->getText());
$client->sms()->send(
    new \Nexmo\SMS\Message\SMS($inbound->getFrom(), $inbound->getTo(), 'Thanks for sending a message!' )
);
