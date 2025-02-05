<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$userData = [
    'name' => USER_NAME,
    'displayName' => USER_DISPLAY_NAME
];

$user = new \Vonage\Users\User();
$user->fromArray($userData);

$client->users()->createUser($user);