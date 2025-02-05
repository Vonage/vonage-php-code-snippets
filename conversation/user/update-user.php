<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$user = $client->users()->getUser(USER_ID);
$user->setDisplayName(USER_NEW_DISPLAY_NAME);
$user->setName(USER_NEW_NAME);

$client->users()->updateUser($user);