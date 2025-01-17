<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$updateRequest = new UpdateCustomTemplateRequest('my-renamed-template', true);

$client->verify2()->updateCustomTemplate(VERIFY_TEMPLATE_ID, $updateRequest);
