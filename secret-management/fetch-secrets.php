<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

$secretsCollection = $client->account()->listSecrets(NEXMO_API_KEY);
/** @var \Nexmo\Account\Secret $secret */
foreach($secretsCollection->getSecrets() as $secret) {
    echo "ID: " . $secret->getId() . " (created " . $secret->getCreatedAt() .")\n";
}
