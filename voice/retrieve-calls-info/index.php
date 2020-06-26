<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Nexmo\Client\Credentials\Keypair(file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH), NEXMO_APPLICATION_ID);
$client = new \Nexmo\Client($keypair);

$filter = new \Nexmo\Voice\Filter\VoiceFilter();
$filter->setDateStart(new DateTime('-1 Day'));
$filter->setDateEnd(new DateTime());

/** @var \Nexmo\Voice\Call $call */
foreach ($client->voice()->search($filter) as $call) {
    echo json_encode($call->toArray()) . PHP_EOL;
}
