<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

$options = getopt('h');
$helpText = <<<ENDHELP
Searches for a verify request

Usage:
    php search.php <REQUEST_ID>

    REQUEST_ID is the ID of a verification event

ENDHELP;

if (array_key_exists('h', $options)) {
    echo $helpText;
    exit(1);
}

if (!defined('REQUEST_ID')) {
    define('REQUEST_ID', (array_key_exists(1, $argv)) ? $argv[1] : null);
}

if (is_null(REQUEST_ID)) {
    echo "Please supply a REQUEST_ID to search for."
        . PHP_EOL
        . PHP_EOL
        . $helpText
    ;
    exit(1);
}

try {
    $result = $client->verify()->search(REQUEST_ID);
    echo "Request has a status of " . $result->getStatus() . PHP_EOL;
} catch (\Nexmo\Client\Exception\Request $e) {
    error_log("Client error: " . $e->getMessage());
    exit(1);
} catch (\Nexmo\Client\Exception\Server $e) {
    error_log("Server error: " . $e->getMessage());
    exit(1);
}
