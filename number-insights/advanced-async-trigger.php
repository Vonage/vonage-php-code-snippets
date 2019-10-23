<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic);

$options = getopt('n:c:h');

$helpText = <<<ENDHELP
Generates an async Number Insights lookup. The results will be POSTed to a web address.

Usage:
    php advanced-async-trigger.php [-n <SEARCH_NUMBER>] [-c <CALLBACK_WEBHOOK>]

    -n Telephone number to run Insights against. Must be international format
    -c URL to post the Insight results to

    You may also set the environment variables SEARCH_NUMBER and CALLBACK_WEBHOOK

ENDHELP;

if (array_key_exists('h', $options)) {
    echo $helpText . PHP_EOL;
    exit(1);
}

if (!defined('SEARCH_NUMBER')) {
    define('SEARCH_NUMBER', (array_key_exists('n', $options)) ? $options['n'] : null);
}

if (!defined('CALLBACK_WEBHOOK')) {
    define('CALLBACK_WEBHOOK', (array_key_exists('c', $options)) ? $options['c'] : null);
}

if (is_null(SEARCH_NUMBER) || is_null(CALLBACK_WEBHOOK)) {
    echo "Please supply both a search number and a callback address"
        . PHP_EOL
        . PHP_EOL
        . $helpText
    ;
    exit(1);
}

try {
    $client->insights()->advancedAsync(SEARCH_NUMBER, CALLBACK_WEBHOOK);
    echo "The number will be looked up soon.";
} catch (\Nexmo\Client\Exception\Request $e) {
    error_log("Client error: " . $e->getMessage());
    exit(1);
} catch (\Nexmo\Client\Exception\Server $e) {
    error_log("Server error: " . $e->getMessage());
    exit(1);
}
