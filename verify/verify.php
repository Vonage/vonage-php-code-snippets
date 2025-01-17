<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Support direct execution from command line or via a GET request as a web server
if (!defined('VERIFY_REQUEST_ID')) {
    define('VERIFY_REQUEST_ID', isset($argv[1])? $argv[1]: $_GET['request_id']);
}

if (!defined('VERIFY_CODE')) {
    define('VERIFY_CODE', isset($argv[2])? $argv[2]: $_GET['pin_code']);
}

error_log('Verifying code ' . VERIFY_CODE . ' is correct for request ' . VERIFY_REQUEST_ID);

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

$result = $client->verify()->check(VERIFY_REQUEST_ID, VERIFY_CODE);

var_dump($result->getResponseData());