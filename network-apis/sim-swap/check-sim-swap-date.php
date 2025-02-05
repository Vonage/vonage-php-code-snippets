<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$credentials = new \Vonage\Client\Credentials\Gnp(
    VONAGE_PHONE_NUMBER,
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($credentials);

$result = $client->simswap()->checkSimSwapDate(PHONE_NUMBER);