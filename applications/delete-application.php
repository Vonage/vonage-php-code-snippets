<?php 

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

try {
    $isDeleted = $client->applications()->delete(VONAGE_APPLICATION_ID);

    if ($isDeleted) {
        echo "Deleted application " . VONAGE_APPLICATION_ID . PHP_EOL;
    } else {
        echo "Could not delete application " . VONAGE_APPLICATION_ID . PHP_EOL;
    }
} catch (\Vonage\Client\Exception\Request $e) {
    echo "There was a problem with the request: " . $e->getMessage() . PHP_EOL;
} catch (\Vonage\Client\Exception\Server $e) {
    echo "The server encounted an error: " . $e->getMessage() . PHP_EOL;
}