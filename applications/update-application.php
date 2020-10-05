<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

try {
    $application = $client->applications()->get(VONAGE_APPLICATION_ID);
    $application->setName('New Name2');
    $application->getVoiceConfig()->setWebhook(
        Nexmo\Application\VoiceConfig::ANSWER,
        new Nexmo\Application\Webhook('http://test.domain/webhook/voice')
    );
    $application = $client->applications()->update($application);

    echo $application->getId() . PHP_EOL;
    echo $application->getName() . PHP_EOL;
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}