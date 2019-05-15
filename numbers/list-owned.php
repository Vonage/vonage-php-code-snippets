<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

$response = $client->numbers()->searchOwned(
    NUMBER_SEARCH_CRITERIA,
    [
        "search_pattern" => NUMBER_SEARCH_PATTERN,
    ]
);

echo count($response). " of your numbers match:\n";

foreach($response as $number) {
  echo "Tel: " . $number->getMsisdn() . " Type: " . $number->getType() . "\n";
} 