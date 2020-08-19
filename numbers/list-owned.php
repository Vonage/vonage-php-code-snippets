<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

try {
    $filter = new \Vonage\Numbers\Filter\OwnedNumbers();
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
