<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$client->verify2()->updateCustomTemplateFragment(
    TEMPLATE_ID,
    TEMPLATE_FRAGMENT_ID,
    'The authentication code for your ${brand} is: ${code}'
);
