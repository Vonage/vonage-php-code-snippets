<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$createFragmentRequest = new CreateCustomTemplateFragmentRequest(
    'sms',
    'en-us',
    'The authentication code for your ${brand} is: ${code}'
);

$client->verify2()->createCustomTemplateFragment(VERIFY_TEMPLATE_ID, $createFragmentRequest);
