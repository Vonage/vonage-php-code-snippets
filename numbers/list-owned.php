<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

try {
    $filter = new \Nexmo\Numbers\Filter\OwnedNumbers();
    $filter
        ->setPattern((int) NUMBER_SEARCH_CRITERIA)
        ->setSearchPattern((int) NUMBER_SEARCH_PATTERN)
    ;
    $response = $client->numbers()->searchOwned($filter);

    echo count($response). " of your numbers match:\n";

    foreach($response as $number) {
        echo "Tel: " . $number->getMsisdn() . " Type: " . $number->getType() . "\n";
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
