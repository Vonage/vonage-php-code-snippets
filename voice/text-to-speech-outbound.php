<?php 
require_once __DIR__ . '/../config.php';

require_once 'vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(API_KEY, API_SECRET);
$keypair = new \Nexmo\Client\Credentials\Keypair(file_get_contents(PRIVATE_KEY), APPLICATION_ID);

$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic, $keypair));

$call = $client->calls()->create([
    'to' => [[
        'type' => 'phone',
        'number' => TO_NUMBER
    ]],
    'from' => [
        'type' => 'phone',
        'number' => FROM_NUMBER
    ],
    'answer_url' => ['https://nexmo-community.github.io/ncco-examples/first_call_talk.json'],
]);

error_log($call);