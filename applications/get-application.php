<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

try {
    $application = $client->applications()->get(MESSAGES_APPLICATION_ID);

    echo $application->getId() . PHP_EOL;
    echo $application->getName() . PHP_EOL;
} catch (\Vonage\Client\Exception\Request $e) {
    echo "There was a problem with the request: " . $e->getMessage() . PHP_EOL;
} catch (\Vonage\Client\Exception\Server $e) {
    echo "The server encounted an error: " . $e->getMessage() . PHP_EOL;
}