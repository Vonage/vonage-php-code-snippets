<?php 

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

$applicationClient = new \Nexmo\Application\Client();
$applicationClient->setClient($client);

foreach ($applicationClient as $application) {
    error_log($application->getId());
    error_log($application->getName());
}