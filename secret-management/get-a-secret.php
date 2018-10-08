<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic($_ENV['NEXMO_API_KEY'], $_ENV['NEXMO_API_SECRET']);
$client = new \Nexmo\Client($basic);

// set an environment variable API_KEY to work with secrets for a secondary key
$api_key = isset($_ENV['API_KEY']) ? $_ENV['API_KEY'] : $_ENV['NEXMO_API_KEY'];

$secret = $client->account()->getSecret($api_key, $_ENV['NEXMO_SECRET_ID']);
echo "ID: " . $secret['id'] . " (created " . $secret['created_at'] .")\n";
