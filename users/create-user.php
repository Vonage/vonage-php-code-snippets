<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

$user = new \Nexmo\User\User();
$user
    ->setName('ashley')
    ->setDisplayName('Ashley Aardvark')
    ->setImageUrl('https://via.placeholder.com/150')
;

$user = $client->users()->create($user->toArray());
error_log('User ' . $user->getId() . ' was created');