<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(
    file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH),
    VONAGE_APPLICATION_ID
);

$client = new \Vonage\Client($keypair);

$imageContent = new \Vonage\Messages\MessageObjects\ContentObject([
  'type' = 'image',
  'url' =  MESSAGES_IMAGE_URL,
]);

$fileContent = new \Vonage\Messages\MessageObjects\ContentObject([
  'type' = 'file',
  'url' =  MESSAGES_FILE_URL,
]);

$mms = new \Vonage\Messages\Channel\MMS\MMSContent(
    MESSAGES_TO_NUMBER,
    MMS_SENDER_ID,
   [ $imageContent, $fileContent],
);

$client->messages()->send($mms);


