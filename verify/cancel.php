<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Support direct execution from command line or via a GET request as a web server
define('REQUEST_ID', isset($argv[1])? $argv[1]: $_GET['request_id']);

error_log('Cancelling `request_id` ' . REQUEST_ID);

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

try {
    $result = $client->verify()->cancel(REQUEST_ID);
    var_dump($result->getResponseData());
}

catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}
