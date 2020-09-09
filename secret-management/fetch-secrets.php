<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

$secretsCollection = $client->account()->listSecrets(VONAGE_API_KEY);
/** @var \Vonage\Account\Secret $secret */
foreach($secretsCollection->getSecrets() as $secret) {
    echo "ID: " . $secret->getId() . " (created " . $secret->getCreatedAt() .")\n";
}
