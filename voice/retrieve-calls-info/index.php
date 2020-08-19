<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH), VONAGE_APPLICATION_ID);
$client = new \Vonage\Client($keypair);

$filter = new \Vonage\Voice\Filter\VoiceFilter();
$filter->setDateStart(new DateTime('-1 Day'));
$filter->setDateEnd(new DateTime());

/** @var \Vonage\Voice\Call $call */
foreach ($client->voice()->search($filter) as $call) {
    echo json_encode($call->toArray()) . PHP_EOL;
}
