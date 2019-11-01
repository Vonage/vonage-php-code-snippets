<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

// $users and $client->users() is iterable, just stopping after the first one
foreach ($client->users() as $user) {
    error_log('User ' . $user->getId() . ' is named ' . $user->getName());
    break;
}
