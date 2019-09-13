<?php 

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

try {
    $isDeleted = $client->applications()->delete(MESSAGES_APPLICATION_ID);

    if ($isDeleted) {
        echo "Deleted application " . MESSAGES_APPLICATION_ID . PHP_EOL;
    } else {
        echo "Could not delete application " . MESSAGES_APPLICATION_ID . PHP_EOL;
    }
} catch (\Nexmo\Client\Exception\Request $e) {
    echo "There was a problem with the request: " . $e->getMessage() . PHP_EOL;
} catch (\Nexmo\Client\Exception\Server $e) {
    echo "The server encounted an error: " . $e->getMessage() . PHP_EOL;
}