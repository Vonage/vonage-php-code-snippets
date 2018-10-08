<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic($_ENV['NEXMO_API_KEY'], $_ENV['NEXMO_API_SECRET']);
$client = new \Nexmo\Client($basic);

// set an environment variable API_KEY to work with secrets for a secondary key
$api_key = isset($_ENV['API_KEY']) ? $_ENV['API_KEY'] : $_ENV['NEXMO_API_KEY'];

$response = $client->account()->listSecrets($api_key);
foreach($response['secrets'] as $secret) {
    echo "ID: " . $secret['id'] . " (created " . $secret['created_at'] .")\n";
}
