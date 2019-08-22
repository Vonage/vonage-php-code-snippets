<?php 

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

$applicationClient = new \Nexmo\Application\Client();
$applicationClient->setClient($client);

try {
    $isDeleted = $applicationClient->delete(MESSAGES_APPLICATION_ID);

    if ($isDeleted) {
        error_log("Deleted application " . MESSAGES_APPLICATION_ID);
    } else {
        error_log("Could not delete application " . MESSAGES_APPLICATION_ID);
    }
} catch (\Nexmo\Client\Exception\Request $e) {
    error_log("There was a problem with the request: " . $e->getMessage());
} catch (\Nexmo\Client\Exception\Server $e) {
    error_log("The server encounted an error: " . $e->getMessage());
}