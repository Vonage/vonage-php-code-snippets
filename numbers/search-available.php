<?php

use Vonage\Numbers\Filter\AvailableNumbers;
use Vonage\Entity\IterableAPICollection;
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

/** @var IterableAPICollection $response */
$filter = new AvailableNumbers([
    "pattern" => (string) NUMBER_SEARCH_CRITERIA,
    "search_pattern" => (int) NUMBER_SEARCH_PATTERN,
    "type" => VONAGE_NUMBER_TYPE,
    "features" => VONAGE_NUMBER_FEATURES,
]);
$response = $client->numbers()->searchAvailable(COUNTRY_CODE, $filter);

echo "There are " . count($response) . " matching numbers available for purchase:\n";

foreach ($response as $number) {
    echo "Tel: " . $number->getMsisdn() . " Cost: " . $number->getCost() . "\n";
}
