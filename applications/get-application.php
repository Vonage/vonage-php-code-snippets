<?php 

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

$applicationClient = new \Nexmo\Application\Client();
$applicationClient->setClient($client);

try {
    $application = $applicationClient->get(MESSAGES_APPLICATION_ID);

    error_log($application->getId());
    error_log($application->getName());
} catch (\Nexmo\Client\Exception\Request $e) {
    error_log("There was a problem with the request: " . $e->getMessage());
} catch (\Nexmo\Client\Exception\Server $e) {
    error_log("The server encounted an error: " . $e->getMessage());
}