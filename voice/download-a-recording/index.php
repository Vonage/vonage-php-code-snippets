<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH), VONAGE_APPLICATION_ID);
$client = new \Vonage\Client($keypair);

$recordingUrl = 'https://api.nexmo.com/v1/files/'.VONAGE_RECORDING_ID;
$data = $client->get($recordingUrl);
file_put_contents($recordingId.'.mp3', $data->getBody());
