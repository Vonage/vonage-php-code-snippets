<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
  file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
  VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$rcsText = new Vonage\Messages\Channel\RCS\RcsText(
  MESSAGES_TO_NUMBER,
  RCS_SENDER_ID,
  'This is an RCS message.'
);

$rcsText->addFailover(
  new \Vonage\Messages\Channel\SMS\SMSText(MESSAGES_TO_NUMBER, SMS_SENDER_ID, 'A SMS text message sent using the Vonage Messages API')
);

$client->messages()->send($rcsText);
