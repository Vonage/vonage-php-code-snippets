<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

$response = $client->numbers()->searchAvailable(
    COUNTRY_CODE,
    [
        "pattern" => NUMBER_SEARCH_CRITERIA,
        "search_pattern" => NUMBER_SEARCH_PATTERN,
        "type" => NEXMO_NUMBER_TYPE,
        "features" => NEXMO_NUMBER_FEATURES,
    ]
);

echo "There are " . count($response) . " matching numbers available for purchase:\n";

foreach ($response as $number) {
    echo "Tel: " . $number->getMsisdn() . " Cost: " . $number->getCost() . "\n";
}