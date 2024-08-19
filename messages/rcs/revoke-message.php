<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$messageUuid = '1a5737ad-efd8-4efb-8edd-70d5b8b4ada7';

$client->messages()->updateRcsStatus($messageUuid, \Vonage\Messages\Client::RCS_STATUS_REVOKED);
