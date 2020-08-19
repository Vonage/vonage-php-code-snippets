<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

$insights = $client->insights()->standardCnam(INSIGHT_NUMBER);

echo "The number ".$insights->getNationalFormatNumber()." is registered to the network " . $insights->getCurrentCarrier()['name'].", and is owned by ".$insights->getCallerName();
