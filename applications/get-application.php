<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

try {
    $application = $client->applications()->get(MESSAGES_APPLICATION_ID);

    echo $application->getId() . PHP_EOL;
    echo $application->getName() . PHP_EOL;
} catch (\Nexmo\Client\Exception\Request $e) {
    echo "There was a problem with the request: " . $e->getMessage() . PHP_EOL;
} catch (\Nexmo\Client\Exception\Server $e) {
    echo "The server encounted an error: " . $e->getMessage() . PHP_EOL;
}