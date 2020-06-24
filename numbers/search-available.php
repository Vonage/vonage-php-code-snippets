<?php

use Nexmo\Numbers\Filter\AvailableNumbers;
use Nexmo\Entity\IterableAPICollection;
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

/** @var IterableAPICollection $response */
$filter = new AvailableNumbers([
    "pattern" => (int) NUMBER_SEARCH_CRITERIA,
    "search_pattern" => (int) NUMBER_SEARCH_PATTERN,
    "type" => NEXMO_NUMBER_TYPE,
    "features" => NEXMO_NUMBER_FEATURES,
]);
$response = $client->numbers()->searchAvailable(COUNTRY_CODE, $filter);

echo "There are " . count($response) . " matching numbers available for purchase:\n";

foreach ($response as $number) {
    echo "Tel: " . $number->getMsisdn() . " Cost: " . $number->getCost() . "\n";
}