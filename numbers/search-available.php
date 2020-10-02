<?php

use Vonage\Numbers\Filter\AvailableNumbers;
use Vonage\Entity\IterableAPICollection;
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

/** @var IterableAPICollection $response */
/** Note: be careful when specifying "NUMBER_SEARCH_CRITERIA" environment variable: 
  * surround it with quotes if it has a leading zero, otherwise the (string) conversion
  * will assume it is an Octal number and convert it.  e.g., (string)0123 results in "83".
  * NUMBER_SEARCH_PATTERN will be one of 0 (search for numbers that start with pattern);
  * 1 (search for numbers that contain pattern), or 2 (search for numbers that end with pattern).
  * VONAGE_NUMBER_TYPE must be one of: landline, mobile-lvn or landline-toll-free
  * VONAGE_NUMBER_FEATURES Must be one of: SMS, VOICE, SMS,VOICE, MMS, SMS,MMS, VOICE,MMS 
  *  or SMS,MMS,VOICE
  */
$filter = new AvailableNumbers([
    "pattern" => (string)NUMBER_SEARCH_CRITERIA,
    "search_pattern" => (int) NUMBER_SEARCH_PATTERN,
    "type" => VONAGE_NUMBER_TYPE,
    "features" => VONAGE_NUMBER_FEATURES,
]);
$response = $client->numbers()->searchAvailable(COUNTRY_CODE, $filter);

echo "There are " . count($response) . " matching numbers available for purchase:\n";

foreach ($response as $number) {
    echo "Tel: " . $number->getMsisdn() . " Cost: " . $number->getCost() . "\n";
}