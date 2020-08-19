<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

try {
    $secret = $client->account()->getSecret(VONAGE_API_KEY, VONAGE_SECRET_ID);
    echo "ID: " . $secret->getId() . " (created " . $secret->getCreatedAt() .")\n";
} catch (\Vonage\Client\Exception\Request $e) {
    echo $e->getMessage();
}
